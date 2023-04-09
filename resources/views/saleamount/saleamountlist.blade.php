<?php 
  use App\ThreeSale;
  use App\ThreePosition;
  use App\User;
  use App\Choice;
  use App\Commission;

 ?>

@extends('layouts.app')
@section('content')

<div class="container">
<div class="row justify-content-center">
<div class="col-md-6">

    @if(session('info'))
      <div class="alert alert-danger">
      {{ session('info') }}
      </div>
    @endif 

</div>
</div>
</div>


<div class="container">
<div class="row justify-content-center">
<div class="col-md-6">

  <div class="card">


  <div class="card-header">

      <table class="table table-striped table-sm header-fixed">        
      <tbody>


      <form method="get" action="{{ url("/saleamount/list/show") }}" enctype="multipart/form-data">

      {{ csrf_field() }}  
 
    

      <tr>
                      <td> ပွဲစဉ်ဇယား :</td>
                      <td >
                      <div>
                         
                          <select name="work_file_id" id="work_file_id" >                             
                          @foreach($work_files as $work_file)
                            <option value="{{ $work_file->id }}" @if($work_file->id == $work_file_id) selected @endif>
                              {{ $work_file->name ." ".$work_file->duration." [ ". $work_file->date ." ] " ."( ". $work_file->result_digit ." )" }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                    </td>                    
                   
      </tr>

      @if(Auth::check())
      @if(auth()->user()->id == 1 or auth()->user()->id == 2)


      <tr>    
                    <td>အမည်:</td>
                     <td>
                        <div>
                            
                            <select name="user_id" id="user_id" >


                            @if(Auth::check())
                            @if(auth()->user()->id == 1 or auth()->user()->id == 2)

                              <option value="0" @if($user_id =="0") selected @endif> All </option>
                              @foreach($show_users as $user)
                                <option value="{{ $user->id }}" @if($user->id == $user_id) selected @endif >
                                  {{ $user->name }}
                                </option>
                              @endforeach

                            @else

                              @foreach($show_users as $user)
                                  @if($user->id == auth()->user()->id)
                                  <option value="{{ $user->id }}">
                                    {{ $user->name }}
                                  </option>
                                  @endif 
                              @endforeach

                            @endif


                            @endif


                          </select>
                        </div>
                      </td> 
      </tr>

      
      <tr>

                      <td> IN/OUT:</td>
                       <td>
                          <div >
                           
                            <select name="in_out"  id="in_out" >
                              <option value="1" @if($in_out == 1) selected @endif>IN</option>
                              <option value="2" @if($in_out == 2) selected @endif>OUT</option>
                            </select>
                           
                          </div>
                        </td>


      </tr>
      @endif
      @endif

             
              <input hidden type="submit" name="action" value="Show"  id="btnShow"  class="btn btn-info btn-sm">
      </form>
      </tbody>
      </table>


    </div> <!-- Card Header -->

  </div> <!-- Card -->

  <div>
      <div class="float-left" id="show1">
        
      </div>
      <div class="float-right" id="show2">
        
      </div>
    </div>


</div>
</div>
</div>





<div class="container">
<div class="row justify-content-center">
<div class="col-md-6">

  <div class="card border-secondary">

      <div class="card-header">
                             
                  <table class="table table-striped table-sm" style="font-size: 12px;">
                  <thead>
                      <tr>

                        <th>နေ့စွဲ</th>

                        <th>ထိုးသား</th>            
                       
                        <th>ယူနစ်</th> 

                        <th>စလစ်</th> 

                        
               
                      </tr>
                  </thead>
                  <tbody>

                      <?php
                        
                          $all_total      = 0;
                          $all_net        = 0;

                         

                       ?>



                      @foreach($users as $key => $user_id)

                          <?php
                                $one_user_total = 0;
                                $one_user_net   = 0;

                                $p_user_total = 0;
                                $p_user_net   = 0;

                                if($user_id     == 0){ $user_op = ">="; }   else { $user_op = "="; }
                                if($slip_id     == 0){ $slip_op = ">="; }   else { $slip_op = "="; }


                              $slips   = ThreeSale::leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                                        ->where([                                           
                                                  
                                                  ["three_sales.work_file_id","=",$work_file_id],
                                                  ["three_sales.user_id","=",$user_id],
                                                  ["slip_id","$slip_op",$slip_id],

                                                  ["three_sales.status","=",1],
                                                  ["three_sales.confirm","=",1],

                                                  ['users.in_out', '=', $in_out],
                                              ]) 
                                        ->groupBy("three_sales.slip_id")
                                        ->select(['three_sales.slip_id',\DB::raw("SUM(three_sales.amount) as call_total")])
                                        ->get();

                                // dd($slips); 

                                $p_slips   = ThreePosition::leftJoin('users', 'three_positions.user_id', '=', 'users.id')
                                        ->where([                                           
                                                  
                                                  ["three_positions.work_file_id","=",$work_file_id],
                                                  ["three_positions.user_id","=",$user_id],
                                                  ["slip_id","$slip_op",$slip_id],

                                                  ["three_positions.status","=",1],
                                                  ["three_positions.confirm","=",1],

                                                  ['users.in_out', '=', $in_out],
                                              ]) 
                                        ->groupBy("three_positions.slip_id")
                                        ->select(['three_positions.slip_id',\DB::raw("SUM(three_positions.amount) as call_total")])
                                        ->get();


                                $user_name = User::where('id','=',$user_id)->value('name');

                                $threed_comm = Commission::where('user_id','=',$user_id)->value('threed_comm');

                                $p_comm = Commission::where('user_id','=',$user_id)->value('position_comm');


                           ?>


                         @foreach($slips as $slip)

                         <?php 

                                $remark   = ThreeSale::where([                                           
                                                
                                                ["work_file_id","=",$work_file_id],
                                                ["user_id","=",$user_id],
                                                ["slip_id","=",$slip->slip_id],

                                                ["status","=",1],
                                                ["confirm","=",1], 

                                            ])->value('remark');                                                              

                                $date   = ThreeSale::where([                                           
                                                
                                                ["work_file_id","=",$work_file_id],
                                                ["user_id","=",$user_id],
                                                ["slip_id","=",$slip->slip_id],

                                                ["status","=",1],
                                                ["confirm","=",1],                                               
                                            ])->value('created_at');

                                $date_show = date_create($date);
                                $date_show = date_format($date_show,"d-m-Y");


                          ?>

                        <tr>
                            
                            <td> {{ $date_show }}</td>

                            <td> {{ $user_name ." -> ". $remark }}</td> 

                            <td> {{ $slip->call_total }}</td> 

                            <td> {{ $slip->slip_id }}</td> 
                            
                             <td> 
                              <a href="{{ url("/slip/list/{$work_file_id}/{$user_id}/{$slip->slip_id}") }}" class="btn btn-primary btn-sm"> 
                                အရောင်း စလစ်
                              </a>
                            </td>

                        </tr>
                        
                        

                       <?php 
                              $all_total += $slip->call_total; 

                              $one_user_total += $slip->call_total;
                        ?>

                      @endforeach




                          <?php 
                                $one_user_net = $one_user_total - ($one_user_total * $threed_comm/100); 

                                $all_net += $one_user_net;
                            ?>

                          @if($one_user_net > 0)
                          <tr>  
                              <td colspan="2">TOTAL</td>
                              <td>{{ number_format($one_user_total) }}</td>                        
                              <td>NetTotal: {{ $one_user_net }}</td>
                          </tr>
                          @endif


                                <!-- P_Slips -->
                      @foreach($p_slips as $slip)

                         <?php 

                                $remark   = ThreePosition::where([                                           
                                                
                                                ["work_file_id","=",$work_file_id],
                                                ["user_id","=",$user_id],
                                                ["slip_id","=",$slip->slip_id],

                                                ["status","=",1],
                                                ["confirm","=",1], 

                                            ])->value('remark');                                                              

                                $date   = ThreePosition::where([                                           
                                                
                                                ["work_file_id","=",$work_file_id],
                                                ["user_id","=",$user_id],
                                                ["slip_id","=",$slip->slip_id],

                                                ["status","=",1],
                                                ["confirm","=",1],                                               
                                            ])->value('created_at');

                                $date_show = date_create($date);
                                $date_show = date_format($date_show,"d-m-Y");

                          ?>

                       <tr>
                            
                            <td> {{ $date_show }}</td>

                            <td> {{ $user_name ." -> ". $remark }}</td> 

                            <td> {{ $slip->call_total }}</td> 

                            <td> P-{{ $slip->slip_id }}</td> 
                            
                            <td> 
                              <a href="{{ url("/slip/list/{$work_file_id}/{$user_id}/{$slip->slip_id}?bet=position") }}" class="btn btn-primary btn-sm"> 
                                အရောင်း စလစ်
                              </a>
                            </td>
                            
                        </tr>

                       <?php 
                              $all_total += $slip->call_total; 
                              $p_user_total += $slip->call_total;
                        ?>
                      @endforeach
                      <!-- End P_Slips -->

                            <?php 
                                $p_user_net = $p_user_total - ($p_user_total * $p_comm/100); 

                                $all_net += $p_user_net;
                            ?>

                          @if($p_user_net > 0)
                          <tr>  
                              <td>P-TOTAL</td>
                              <td>{{ number_format($p_user_total) }}</td>                        
                              <td>ကော်: {{ $p_comm }}</td>
                              <td>P-NetTotal: {{ $p_user_net }}</td>
                              <td></td>
                          </tr>
                          @endif



                      @endforeach
                    

                      <tr style="border: 1px solid black;">  
                          <td>ALL-TOTAL</td>
                          <td id="all_total">{{ number_format($all_total) }}</td>                        
                          <td>ALL-NET: </td>
                          <td id="all_net">{{ number_format($all_net) }}</td>
                          <td></td>
                      </tr>
                    
                  </tbody>
                </table>
                 
        </div> <!-- Card Header -->
    </div> <!-- Card -->

                <?php 

                  $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');  

               ?>

              <div class="d-flex justify-content-between align-items-right">

                    <span class="card-text">
                        <a href="{{ url("/3dsale/add/{$work_file_id}") }}" class="btn btn-primary btn-sm" >
                           အရောင်း
                        </a>
                    </span>              

                    <span class="card-text">
                        <a href="{{ url("/") }}" class="btn btn-primary btn-sm" >
                           Back
                        </a>
                    </span> 

              </div>


</div>
</div>
</div>


 <script>

$(document).ready(function()
{

    var show1 = "ALL-TOTAL" + " [ " + $("#all_total").text() + " ]"; 
    var show2 = "ALL-NET" + " [ " + $("#all_net").text() + " ]";

    $("#show1").text(show1);
    $("#show2").text(show2);



    $("#work_file_id").change(function()
    {
      $('#btnShow').click();

    });

    $("#user_id").change(function()   {
        

       $('#btnShow').click();
    });  

   // In_Out Change => Get User
  $("#in_out").change(function()
    {  
      var in_out        = $('#in_out').val();

      if(in_out)
      {
        $.ajax({
                type:   "GET",
                url:  "{{ url('getUser') }}?in_out="+in_out,
                dataType: 'json',             
                success:function(res)
                {                                                   
                    if(res)
                    {
                        var html = '';

                        html += '<option value="'+ 0 +'" >'+ 'All' +'</option>';

                        for(var count = 0; count < res.length; count++)
                        {                         
                          html += '<option  value="'+res[count].id+'" >'+ res[count].name +'</option>';
                        }

                        $("#user_id").html(html);
                    }
                }
            });       
      }
      
      $("#user_id").val($("#user_id option:first").val());
      $('#btnShow').click();
     
    });
    // End In_Out Change => Get User




});

</script>  

 
@endsection