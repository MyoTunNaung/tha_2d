
<?php 
    use App\Choice; 
    use App\ThreeSale;
    use App\ThreePosition;
    use App\User;
    use App\WorkFIle;

    $result_digit = WorkFIle::where('id','=',$work_file_id)->value('result_digit');

    // dd($result_digit);

?>

<style type="text/css">
  select
  {
    font-size: 50%;
  }
</style>

@extends('layouts.app')
@section('content')

<div class="container">
<div class="row justify-content-center">
<div class="col-md-8 col-md-offset-2">

    @if(session('info'))
      <div class="alert alert-danger">
      {{ session('info') }}
      </div>
    @endif 

</div>
</div>
</div>

<!-- <h1>Test</h1> -->

<div class="container">
<div class="row justify-content-center">
<div class="col-md-8 col-md-offset-2">
<div class="card">

  <table class="table table-sm header-fixed" >   

    <form method="get" action="{{ url("/confirm/list/show") }}" enctype="multipart/form-data">
  {{ csrf_field() }} 
  <tbody> 

      <tr>                                            
          <td colspan="4">
              <div >                         
              <select name="work_file_id" id="work_file_id" >                  
                @foreach($work_files as $work_file)

                  <?php 
                          $date           = date_create("$work_file->date");
                          $work_file_date = date_format($date,"d-m-Y");
                   ?>

                  @if($work_file->name == "2D")
                  <option value="{{ $work_file->id }}" @if($work_file->id == $work_file_id) selected @endif>
                    {{ $work_file->name. " ". $work_file->duration ." [ ".$work_file_date." ] " }}
                  </option>
                  @endif
                @endforeach
              </select>
            </div>
          </td>
      </tr>

      <tr>                                            
          <td>
            <div>
              <label>Users</label><br>
              <select name="user_id" id="user_id" >

                <!-- @if(auth()->user()->id == 1 || auth()->user()->id == 2) -->
                  <option value="0">All</option>
                <!-- @endif -->

                @foreach($users as $user)
                  <option value="{{ $user->id }}" @if($user->id == $user_id) selected @endif>
                    {{ $user->name}}
                  </option>
                @endforeach
              </select>
            </div>
          </td> 


          @if(auth()->user()->id == 1 || auth()->user()->id == 2)                  
           <td>
            <div >
              <label>IN/OUT</label><br>
              <select name="in_out" id="in_out" >
                
              <option value="1" @if($in_out==1) selected @endif>IN</option>
              <option value="2" @if($in_out==2) selected @endif >OUT</option>
               
              </select>
            </div>
          </td> 
          @else
          <td></td>
          <td></td>
          @endif

           
         <td>
          <div >
            <label>Slips</label><br>
            <select name="slip_id" id="slip_id" >
                <option value="0" @if($slip_id == "0") selected @endif>All</option>

              @foreach($show_slips as $slip)
                <option value="{{ $slip->slip_id }}" @if($slip->slip_id == $slip_id) selected @endif>
                  {{ $slip->slip_id}}
                </option>
              @endforeach

            </select>
          </div>
        </td> 

        </tr>
            
            <label hidden >Show</label><br>  

            <input hidden type="submit"  value="Show"   name="action" id="btnShow"  class="btn btn-info btn-sm">

        </form>

      </tbody>
      </table>  

</div>
</div>
</div>
</div>





<div class="container">
<div class="row justify-content-center">
<div class="col-md-8 col-md-offset-2">

            <div class="card">
              <div class="card-header"><span id="header"></span></div> 
                
                  <table class="table1 table-bordered table-striped table-sm header-fixed">
                  <thead>
                      <tr>
                        
                       
                        <th>User</th>
                        <th>Remark</th>                     
                        <th>Slip</th> 
                           
                        <th>Digit</th>  
                        <th>Amount</th>
                        <th>Time</th>    
                        <th>Edit</th>       
                        <th>Del</th>
                     
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                          
                          $col_remark   = "";
                          $col_user     = "";
                        
                          $col_type     = "";
                          $col_slip     = "";

                          $slip_total = 0;


                          $call_total   = 0;
                          $all_total    = 0;                         

                          $ALL = 0;
                       ?>



                     
                @foreach($loop_users as $key => $user_id)

                      <?php


                              
                          if($slip_id  == 0){ $slip_op = ">="; }   else { $slip_op = "="; }

                          $user_name = User::where('id','=',$user_id)->value('name');


                          $slips  = ThreeSale::leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                                      ->where([                                           
                                                
                                                ["three_sales.work_file_id","=",$work_file_id],
                                                ["three_sales.user_id","=",$user_id],
                                                ["three_sales.slip_id","$slip_op",$slip_id],

                                                ["three_sales.amount","!=",0],
                                                ["three_sales.status","=",1],
                                                ["three_sales.confirm","=",1],

                                                ['users.in_out', '=', $in_out],
                                            ])
                                        
                                        ->distinct()
                                        ->groupBy("three_sales.slip_id")
                                        ->select(['three_sales.slip_id',\DB::raw("SUM(three_sales.amount) as call_total")])
                                        ->get();

                          // $sales  =    ThreeSale::leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                          //               ->where([
                          //                     ["three_sales.work_file_id","=",$work_file_id],
                          //                     ["three_sales.user_id","=",$user_id],                                
                          //                     ["three_sales.slip_id","$slip_op",$slip_id],

                          //                     ["three_sales.status","=",1],
                          //                     ["three_sales.confirm","=",1],

                          //                     ['users.in_out', '=', $in_out],

                          //                 ]) 
                          //               ->selectRaw('three_sales.*')                                   
                          //               ->get();


                          $p_slips  = ThreePosition::leftJoin('users', 'three_positions.user_id', '=', 'users.id')
                                      ->where([                                           
                                                
                                                ["three_positions.work_file_id","=",$work_file_id],
                                                ["three_positions.user_id","=",$user_id],
                                                ["three_positions.slip_id","$slip_op",$slip_id],

                                                ["three_positions.status","=",1],
                                                ["three_positions.confirm","=",1],

                                                ['users.in_out', '=', $in_out],
                                            ])
                                        
                                        ->distinct()
                                        ->groupBy("three_positions.slip_id")
                                        ->select(['three_positions.slip_id',\DB::raw("SUM(three_positions.amount) as call_total")])
                                        ->get();

                          $p_sales  =    ThreePosition::leftJoin('users', 'three_positions.user_id', '=', 'users.id')
                                        ->where([
                                              ["three_positions.work_file_id","=",$work_file_id],
                                              ["three_positions.user_id","=",$user_id],                                
                                              ["three_positions.slip_id","$slip_op",$slip_id],

                                              ["three_positions.status","=",1],
                                              ["three_positions.confirm","=",1],

                                              ['users.in_out', '=', $in_out],

                                          ]) 
                                        ->selectRaw('three_positions.*')                                   
                                        ->get();
                       ?>

                      <?php $one_user_total = 0; ?> 

                      @foreach($slips as $slip)  

                          <?php 
                                $sales  =    ThreeSale::leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                                                  ->where([
                                                        ["three_sales.work_file_id","=",$work_file_id],
                                                        ["three_sales.user_id","=",$user_id],                                
                                                        ["three_sales.slip_id","=",$slip->slip_id],

                                                        ["three_sales.amount","!=",0],
                                                        ["three_sales.status","=",1],
                                                        ["three_sales.confirm","=",1],

                                                        ['users.in_out', '=', $in_out],

                                                    ]) 
                                                  ->selectRaw('three_sales.*')                                   
                                                  ->get();

                          ?>

                          @foreach($sales as $sale)                            

                                @if($sale->slip_id == $slip->slip_id)

                                  <tr>
                                     
                                      @if($sale->slip_id != $col_slip)
                                        <td> {{ $sale->user->name }} </td> 
                                      @else
                                          <td></td>
                                      @endif


                                      @if($sale->remark != $col_remark)
                                        <td> {{ $sale->remark  }} </td> 
                                      @else
                                          <td></td>
                                      @endif

                                     
                                      @if($sale->slip_id != $col_slip)
                                        <td>{{ $sale->slip_id }}</td> 
                                      @else
                                          <td></td>
                                      @endif

                                      @if($sale->digit == $result_digit)                                          
                                      <td   style="background-color: lightgreen;">{{ $sale->digit }}</td>
                                      @else
                                      <td   >{{ $sale->digit }}</td>
                                      @endif
                                  
                                      <td>{{ $sale->amount }}</td> 

                                      <td> {{ $sale->created_at->format('h:i:s') }}</td>                        

                                     
                                      <td>
                                          <a href="{{ url("/confirm/upd/{$sale->id}") }}">
                                            <i class="fas fa-edit" style='font-size:12px;'></i> 
                                          </a> 
                                      </td>

                                      <td>
                                          <a href="{{ url("/confirm/del/{$sale->id}") }}">
                                            <i class='fa fa-trash' aria-hidden='true' style='color: red; font-size:12px;' ></i> 
                                          </a> 
                                      </td>
                                    
                                  
                                    </tr>

                                  @endif

                                <?php 

                                  $col_remark   = $sale->remark;
                                  $col_user     = $sale->user_id;

                                  $col_type     = $sale->type;
                                  $col_slip     = $sale->slip_id;
                                  
                                  $all_total  += $sale->amount;
                                ?>

                      @endforeach <!-- sales -->

                                  <tr style="background-color: lightgray;">
                                      <td colspan="2">
                                       <!--  <span class="card-text">
                                            <a style="border: 1px solid red;" href="{{ url("/3dsale/add/{$work_file_id}/{$col_user}/{$slip->slip_id}") }}" class="btn btn-outline-primary btn-sm" >
                                               Edit Slip
                                            </a>
                                        </span>  -->
                                      </td>
                                      <td colspan="2">Call Total </td>
                                      <td>{{ $slip->call_total }} </td>
                                      <td></td>
                                      <td> 
                                        
                                          <a href="{{ url("/confirm/del/slip/{$work_file_id}/{$user_id}/{$slip->slip_id}") }}">
                                            <i class='fa fa-trash' aria-hidden='true' style='color: red; font-size:14px;' ></i> 
                                          </a>
                                        

                                      </td>
                                      <td></td>
                                      
                                  </tr> 
                                  <?php $one_user_total += $slip->call_total; ?>

                      @endforeach <!-- slips -->  




                      <!-- P-User -->

                       <?php
                          
                          $col_remark   = "";
                          $col_user     = "";
                        
                          $col_type     = "";
                          $col_slip     = "";

                          // $slip_total = 0;


                          // $call_total   = 0;
                          // $all_total    = 0;

                         

                       ?>

                        @foreach($p_slips as $slip)  

                          @foreach($p_sales as $sale)                            

                                @if($sale->slip_id == $slip->slip_id)

                                  <tr>
                                     
                                      @if($sale->slip_id != $col_slip)
                                        <td> {{ $user_name }} </td> 
                                      @else
                                          <td></td>
                                      @endif


                                      @if($sale->remark != $col_remark)
                                        <td> {{ $sale->remark  }} </td> 
                                      @else
                                          <td></td>
                                      @endif

                                      
                                      @if($sale->slip_id != $col_slip)
                                        <td>P-{{ $sale->slip_id }}</td>
                                      @else
                                          <td></td>
                                      @endif
                                      
                            
                                          

                                          <td>{{ $sale->d1.$sale->d2 }}</td>
                                      
                                  
                                      <td>{{ $sale->amount }}</td>                         

                                    
                                      <td>
                                          <a href="{{ url("/confirm/upd/{$sale->id}?bet=position") }}">
                                            <i class="fas fa-edit" style='font-size:12px;'></i> 
                                          </a> 
                                      </td>

                                      <td>
                                          <a href="{{ url("/confirm/del/{$sale->id}?bet=position") }}">
                                            <i class='fa fa-trash' aria-hidden='true' style='color: red; font-size:12px;' ></i> 
                                          </a> 
                                      </td>
                                  
                                  
                                    </tr>

                                  @endif

                                <?php 

                                  $col_remark   = $sale->remark;
                                  $col_user     = $sale->user_id;

                                  $col_type     = $sale->type;
                                  $col_slip     = $sale->slip_id;
                                  
                                  $all_total  += $sale->amount;
                                ?>

                      @endforeach <!-- sales -->

                                  <tr style="background-color: lightgray;">                                     
                                      <td colspan="4">Call Total </td>
                                      <td>{{ $slip->call_total }} </td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                  </tr> 

                                  <?php $one_user_total += $slip->call_total; ?>

                      @endforeach <!-- slips -->  

                      <!-- P-User -->

                                  @if( $one_user_total != 0)
                                  <?php $ALL += $one_user_total; ?>
                                  <tr style="background-color: gray;">                                      
                                      <td colspan="4">{{ $user_name }} Total </td>
                                      <td>{{ $one_user_total }} </td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      
                                  </tr> 
                                  @endif
                     
                      @endforeach <!-- users -->

                      
                      <tr>                                      
                                      <td colspan="4">ALL-TOTAL</td>
                                      <td id="all">{{number_format($ALL)}}</td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                      </tr> 
                    
                  </tbody>
                </table>
               
              
                  
              
                
               </div>

               <?php

                  if(Choice::where([ 
                                    ['auth_id','=',auth()->user()->id],
                                    ['work_file_id','!=',null],
                                  ])->exists())
                  {
                    $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');
               ?>

              <div class="d-flex justify-content-between align-items-right">
                    <span class="card-text">
                        <a href="{{ url("/3dsale/add/{$work_file_id}") }}" class="btn btn-primary btn-sm" >
                           အရောင်း
                        </a>
                    </span>

                     <span class="card-text">
                      <button onclick="window.print()">Print</button>
                    </span> 

                    <span class="card-text">
                        <a href="{{ url("/") }}" class="btn btn-primary btn-sm" >
                           Back
                        </a>
                    </span>
              </div>
            <?php } ?>
</div>       
</div>
</div>

<br><br>


 <script>
$(document).ready(function()
{

  var show = "ထိုးပြီး ဂဏန်းများ" + " [ " + $("#all").text() + " ]";
  $("#header").text(show);


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

   

    $("#work_file_id").change(function()
    {
      $('#btnShow').click();

    });

    $("#user_id").change(function()
    {
      $('#btnShow').click();

    });

     $("#slip_id").change(function()
    {
      $('#btnShow').click();
    });



});


</script>       
@endsection