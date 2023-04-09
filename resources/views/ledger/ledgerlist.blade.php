<?php 
    use App\ThreeSale;
    use App\User;
    use App\Choice;
    use App\WorkFIle;

    $result_digit = WorkFIle::where('id','=',$work_file_id)->value('result_digit');

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


      <form method="get" action="{{ url("/ledger/list/show") }}" enctype="multipart/form-data">

      {{ csrf_field() }}  
 
    

      <tr>
                      <td> ပွဲစဉ်ဇယား </td>
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
                    <td>အမည်</td>
                     <td>
                        <div>
                            
                            <select name="user_id" id="user_id" >


                            @if(Auth::check())
                            @if(auth()->user()->id == 1 or auth()->user()->id == 2)

                              <option value="0" @if($user_id =="0") selected @endif> All </option>
                              @foreach($users as $user)
                                <option value="{{ $user->id }}" @if($user->id == $user_id) selected @endif >
                                  {{ $user->name }}
                                </option>
                              @endforeach

                            @else

                              @foreach($users as $user)
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

                        <th>အမည်</th>

                        <th>ဂဏန်း</th>                            
                       
                        <th>ယူနစ်</th> 
                       
                      </tr>
                  </thead>
                  <tbody>

                      <?php
                        
                          $all_total    = 0;
                          $col_user     = "";

                       ?>

                      @foreach($loop_users as $user)

                          <?php

                              $one_user_total = 0;

                              $sales  =    ThreeSale::leftJoin('threes', 'three_sales.digit', '=', 'threes.digit')
                                                  ->where([

                                                        ["three_sales.work_file_id","=",$work_file_id],
                                                        ["three_sales.user_id","=",$user->id],
                                                        ["three_sales.customer_id","=",1],
                                                       

                                                        ["three_sales.status","=",1],
                                                        ["three_sales.confirm","=",1],
                                                    ])
                                            ->orderBy("three_sales.digit","asc") 
                                            ->groupBy("three_sales.digit")
                                            ->select(['three_sales.digit',\DB::raw("SUM(three_sales.amount) as digit_total")])
                                            ->get();


                              $user_name = User::where('id','=',$user->id)->value('name');

                           ?>


                         @foreach($sales as $sale)

                         <?php 

                               
                                $date   = ThreeSale::where([                                           
                                                
                                                ["work_file_id","=",$work_file_id],
                                                ["user_id","=",$user->id],
                                               

                                                ["status","=",1],
                                                ["confirm","=",1],                                               
                                            ])->value('created_at');

                                $date_show = date_create($date);
                                $date_show = date_format($date_show,"d-m-Y");

                                

                          ?>

                        @if($sale->digit_total > 0)

                        <tr>
                            
                            @if($user_name != $col_user)
                              <td> {{ $user_name }} </td> 
                            @else
                                <td></td>
                            @endif

                            
                            <!-- <td> {{ $sale->digit }}</td>  -->

                            @if($sale->digit == $result_digit)                                          
                            <td   style="background-color: lightgreen;">{{ $sale->digit }}</td>
                            @else
                            <td   >{{ $sale->digit }}</td>
                            @endif


                            <td> {{ $sale->digit_total }}</td> 
                            
                        </tr>
                        
                        @endif

                       <?php  
                              $one_user_total += $sale->digit_total;
                              $all_total += $sale->digit_total; 
                              $col_user     = $user_name;
                        ?>

                      @endforeach

                        @if($one_user_total != 0)
                        <tr>  
                              <td colspan="2">{{ $user_name }} Total</td>
                              <td>{{ number_format($one_user_total) }}</td>
                              
                        </tr>
                        @endif

                      @endforeach
                    

                      <tr>  
                          <td colspan="2">ALL-TOTAL</td>
                          <td>{{ number_format($all_total) }}</td> 
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
                      <button onclick="window.print()">Print</button>
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