<?php 
use App\WorkFile;
use App\User;
use App\Customer;
use App\Choice;
use App\Result;
use App\Member;

$members                 = Member::all();

?>

@extends('layouts.app')
@section('content')

<div class="container">
<div class="row justify-content-center">
<div class="col-md-6 col-md-offset-2">

      @if(session('info'))
        <div class="alert alert-danger">
        {{ session('info') }}
        </div>
      @endif 

</div>
</div>
</div>

<!-- <h1>Hello</h1> -->

<br>  


<!-- Filter & Show -->
<div class="container_fluid">
<div class="row justify-content-center">
<div class="col-md-12 col-md-offset-2">
          
    <div class="card border-secondary">

      
                <table class="table table-striped table-sm header-fixed">        
                <tbody>
                  
                  <form method="get" action="{{ url("/main/list/show") }}"  enctype="multipart/form-data">
                  {{ csrf_field() }}

                  
                    <tr>

                       <td>
                      <div class="form-group">
                        <label>FromDate</label>
                        <input type="date" name="from_date" id="from_date" class="form-control" value="{{ $from_date }}">
                      </div>
                      </td>

                      <td>
                      <div class="form-group">
                        <label>ToDate</label>
                        <input type="date" name="to_date" id="to_date" class="form-control" value="{{ $to_date }}">
                      </div>
                      </td>  

                        <td >
                        <div class="form-group">
                            <label>Duration</label> <br>
                            <select name="duration" id="duration" class="form-control" >
                              <option value="AM_PM" @if($duration =="AM_PM") selected @endif>AM/PM</option>
                              <option value="AM" @if($duration =="AM") selected @endif>AM</option>
                              <option value="PM" @if($duration =="PM") selected @endif>PM</option>
                          </select>
                        </div>
                      </td>  


                         <!-- <label>Name</label> <br> -->
                            <select hidden name="name" id="name" class="form-control" >
                              <option value="2D_3D" @if($name =="2D_3D") selected @endif>2D/3D</option>
                              <option value="2D" @if($name =="2D") selected @endif>2D</option>
                              <option value="3D" @if($name =="3D") selected @endif>3D</option>                              
                          </select>


                 
          
                      

                     <!--   <td>
                          <div class="form-group">
                            <label>IN/OUT</label><br>
                            <select name="in_out"  id="in_out" class="form-control">
                              <option value="0" @if($in_out == 0) selected @endif>IN/OUT</option>
                              <option value="1" @if($in_out == 1) selected @endif>IN</option>

                              @if(Auth::check())
                              @if(auth()->user()->id == 1 or auth()->user()->id == 2)
                                <option value="2" @if($in_out == 2) selected @endif>OUT</option>
                              @endif
                              @endif

                            </select>
                           
                          </div>
                          </td> -->

                        @if(Auth::check())
                        @if(auth()->user()->id == 1 or auth()->user()->id == 2)
                        <td>
                          <div class="form-group">
                            <label>Main</label><br>

                            <!-- <select name="main"  id="main" class="form-control">
                              <option value="2D">2D</option>
                              <option value="3D">3D</option>
                            </select>  -->
                            @if($name == "2D")
                            <a href="{{ url("/list/") }}" class="btn btn-primary btn-sm" >
                               2D List
                            </a>
                            @endif

                            @if($name == "3D")
                            <a href="{{ url("/list/") }}" class="btn btn-primary btn-sm" >
                               3D List
                            </a>
                            @endif


                          </div>
                        </td>
                        @endif
                        @endif


                    </tr>


                  <label hidden >Show</label><br>                          
                  <input hidden type="submit"  value="Show" name="action" id="btnShow"  class="btn btn-info btn-sm">
                        
                         
                  </form>
                </tbody>
                </table>

                
                
                

                <!-- Position Table -->                 
                  <table class="table table-striped table-sm">  

                  <thead>                      

                      <tr>                       
                      
                        <th>ပွဲ</th>
                        <th>နေ့စွဲ</th>

                        <th>ရောင်းကြေး</th>

                        <th>ကော်နှုတ်</th>

                        <th >ဒဲ့(တွဒ်)</th>

                        <th style="text-align: right;">လျော်ကြေး</th>
                        <th style="text-align: right;">အရှုံးအမြတ်</th>
                      </tr>

                  </thead>
                  <tbody>
                     

                      <?php

                          $wf                 = WorkFile::where('name','=',"$name")->first();

                          $w_comm             = $wf->w_comm;
                          $w_times            = $wf->w_times;
                          $wother_times       = $wf->wother_times;


                          if($user_id == 0){ $user_op = ">="; }   else { $user_op = "="; } 

                         
                          // dd($duration_op);


                          if($duration == "AM_PM" || $duration == "")
                              { $duration_op = "!="; $duration = "";}   
                          
                          if( $duration == "AM")
                              { $duration_op = "="; }
                          
                          if( $duration == "PM")
                          { $duration_op = "="; } 
                        
                      

                        foreach ($work_files as $work_file) 
                        {
                                                   

                            // Calculate ThreeSale
                           
                              $w_comm             = $work_file->w_comm;
                              $w_times            = $work_file->w_times;
                              $wother_times       = $work_file->wother_times;


                            if($in_out == 0) 
                                { $sale_inout = 1; $purchase_inout = 2;}

                            else if($in_out == 1)
                                { $sale_inout = 1; $purchase_inout = 0;  }
                            else
                                {   $sale_inout = 0; $purchase_inout = 2; }



                            $total_sale         =   Result::leftJoin('users', 'results.user_id', '=', 'users.id')
                                                        ->leftJoin('work_files', 'results.work_file_id', '=', 'work_files.id')
                                                        ->where([
                                                           
                                                            ["results.user_id","$user_op",$user_id],
                                                            ['users.in_out', '=', 1],

                                                            ['work_files.id', "=", $work_file->id],
                                                            
                                                        ])
                                                        ->sum("results.total_amount");


                           

                            $total_purchase     =   Result::leftJoin('users', 'results.user_id', '=', 'users.id')
                                                        ->leftJoin('work_files', 'results.work_file_id', '=', 'work_files.id')
                                                        ->where([
                                                           
                                                            ["results.user_id","$user_op",$user_id],
                                                            ['users.in_out', '=', 2],

                                                            ['work_files.id', "=", $work_file->id],
                                                          
                                                        ])
                                                        ->sum("results.total_amount");

                            $total_balance      =   $total_sale - $total_purchase;

                            


                            if($total_balance == 0)
                            {
                                $total_digit_amount     = 0;
                                $total_other_amount     = 0;
                                $total_compensation     = 0;
                                $net_total              = 0;
                            }
                            else
                            {
                                $in_digit_amount        =  Result::leftJoin('users', 'results.user_id', '=', 'users.id')
                                                          ->leftJoin('work_files', 'results.work_file_id', '=', 'work_files.id')
                                                          ->where([
                                                           
                                                            ["results.user_id","$user_op",$user_id],
                                                            ['users.in_out', '=', 1],

                                                            ['work_files.id', "=", $work_file->id],
                                                          
                                                            
                                                        ])
                                                        ->sum("results.digit_amount");

                                 $out_digit_amount        =  Result::leftJoin('users', 'results.user_id', '=', 'users.id')
                                                          ->leftJoin('work_files', 'results.work_file_id', '=', 'work_files.id')
                                                          ->where([
                                                           
                                                            ["results.user_id","$user_op",$user_id],
                                                            ['users.in_out', '=', 2],

                                                            ['work_files.id', "=", $work_file->id],
                                                         
                                                            
                                                        ])
                                                        ->sum("results.digit_amount");


                              
                                $total_digit_amount     =   $in_digit_amount - $out_digit_amount;

                                

                                                               
                                $in_other_amount        =  Result::leftJoin('users', 'results.user_id', '=', 'users.id')
                                                          ->leftJoin('work_files', 'results.work_file_id', '=', 'work_files.id')
                                                          ->where([
                                                           
                                                            ["results.user_id","$user_op",$user_id],
                                                            ['users.in_out', '=', 1],

                                                            ['work_files.id', "=", $work_file->id],
                                                          
                                                            
                                                        ])
                                                        ->sum("results.other_amount");

                                $out_other_amount        =  Result::leftJoin('users', 'results.user_id', '=', 'users.id')
                                                          ->leftJoin('work_files', 'results.work_file_id', '=', 'work_files.id')
                                                          ->where([
                                                           
                                                            ["results.user_id","$user_op",$user_id],
                                                            ['users.in_out', '=', 2],

                                                            ['work_files.id', "=", $work_file->id],
                                                         
                                                            
                                                        ])
                                                        ->sum("results.other_amount");


                                $total_other_amount     =   $in_other_amount - $out_other_amount;



                                $total_compensation     =   ($total_digit_amount * $w_times) + ($total_other_amount + $wother_times);

                                $net_total              =   $total_balance-($total_balance * $w_comm/100);                                              
                              
                                  // dd($total_balance."/".$net_total);

                            }
                          

                       ?>
                    
                      
                      <tr>

                        <td> {{ $work_file->name." ".$work_file->duration }}</td>
                        <td> {{ $work_file->date }}</td>
                        <td> {{ number_format($total_balance) }}</td>
                        <td> {{ number_format($net_total) }}</td>
                        <td >{{ number_format($total_digit_amount) }} ( {{ number_format($total_other_amount) }} ) </td>

                        @if($total_digit_amount < 0)
                        <td style="text-align: right;">{{number_format(abs($total_compensation))}}</td>
                        @else
                        <td style="text-align: right;">-{{number_format($total_compensation)}}</td>
                        @endif

                        @if($total_digit_amount < 0)                                
                          <td style="text-align: right;"> {{ number_format($net_total + abs($total_compensation) ) }} </td>
                        @else
                          <td style="text-align: right;"> {{ number_format($net_total - $total_compensation) }} </td>

                        @endif


                      </tr>

                    <?php }  ?>


                      <?php 




                            $total_sale         =   Result::leftJoin('users', 'results.user_id', '=', 'users.id')
                                                        ->leftJoin('work_files', 'results.work_file_id', '=', 'work_files.id')
                                                        ->where([
                                                           
                                                            // ["results.user_id","$user_op",$user_id],
                                                            ['users.in_out', '=', 1],

                                                            ['work_files.name', '=', $name],
                                                            ['work_files.duration', "$duration_op", $duration],
                                                            ["work_files.date",">=",$from_date],
                                                            ["work_files.date","<=",$to_date],
                                                            
                                                        ])
                                                        ->sum("results.total_amount");
                           
                         

                            $total_purchase     =   Result::leftJoin('users', 'results.user_id', '=', 'users.id')
                                                        ->leftJoin('work_files', 'results.work_file_id', '=', 'work_files.id')
                                                        ->where([
                                                           
                                                            // ["results.user_id","$user_op",$user_id],
                                                            ['users.in_out', '=', 2],

                                                            ['work_files.name', '=', $name],
                                                            ['work_files.duration', "$duration_op", $duration],
                                                            ["work_files.date",">=",$from_date],
                                                            ["work_files.date","<=",$to_date],
                                                          
                                                        ])
                                                        ->sum("results.total_amount");



                            $total_balance      =   $total_sale - $total_purchase;
                           

                            if($total_balance == 0)
                            {
                                $total_digit_amount     = 0;
                                $total_other_amount     = 0;
                                $total_compensation     = 0;
                                $net_total              = 0;
                            }
                            else
                            {
                                $in_digit_amount        =  Result::leftJoin('users', 'results.user_id', '=', 'users.id')
                                                          ->leftJoin('work_files', 'results.work_file_id', '=', 'work_files.id')
                                                          ->where([
                                                           
                                                            ["results.user_id","$user_op",$user_id],
                                                            ['users.in_out', '=', 1],

                                                            ['work_files.name', '=', $name],
                                                            ['work_files.duration', "$duration_op", $duration],
                                                            ["work_files.date",">=",$from_date],
                                                            ["work_files.date","<=",$to_date],
                                                          
                                                            
                                                        ])
                                                        ->sum("results.digit_amount");

                                 $out_digit_amount        =  Result::leftJoin('users', 'results.user_id', '=', 'users.id')
                                                          ->leftJoin('work_files', 'results.work_file_id', '=', 'work_files.id')
                                                          ->where([
                                                           
                                                            ["results.user_id","$user_op",$user_id],
                                                            ['users.in_out', '=', 2],

                                                            ['work_files.name', '=', $name],
                                                            ['work_files.duration', "$duration_op", $duration],
                                                            ["work_files.date",">=",$from_date],
                                                            ["work_files.date","<=",$to_date],
                                                         
                                                            
                                                        ])
                                                        ->sum("results.digit_amount");
                              
                                $total_digit_amount     =   $in_digit_amount - $out_digit_amount;
                              
                                                               
                                $in_other_amount        =  Result::leftJoin('users', 'results.user_id', '=', 'users.id')
                                                          ->leftJoin('work_files', 'results.work_file_id', '=', 'work_files.id')
                                                          ->where([
                                                           
                                                            ["results.user_id","$user_op",$user_id],
                                                            ['users.in_out', '=', 1],

                                                            ['work_files.name', '=', $name],
                                                            ['work_files.duration', "$duration_op", $duration],
                                                            ["work_files.date",">=",$from_date],
                                                            ["work_files.date","<=",$to_date],
                                                          
                                                            
                                                        ])
                                                        ->sum("results.other_amount");

                                $out_other_amount        =  Result::leftJoin('users', 'results.user_id', '=', 'users.id')
                                                          ->leftJoin('work_files', 'results.work_file_id', '=', 'work_files.id')
                                                          ->where([
                                                           
                                                            ["results.user_id","$user_op",$user_id],
                                                            ['users.in_out', '=', 2],

                                                            ['work_files.name', '=', $name],
                                                            ['work_files.duration', "$duration_op", $duration],
                                                            ["work_files.date",">=",$from_date],
                                                            ["work_files.date","<=",$to_date],
                                                         
                                                            
                                                        ])
                                                        ->sum("results.other_amount");


                                $total_other_amount     =   $in_other_amount - $out_other_amount;

                                $total_compensation     =   ($total_digit_amount * $w_times) + ($total_other_amount + $wother_times);

                                $net_total              =   $total_balance-($total_balance * $w_comm/100);   

                            }


                       ?>

                          <tr>
                              <td> ALL </td>
                              <td> TOTAL </td>
                              <td> {{ number_format($total_balance) }}</td>
                              <td> {{ number_format($net_total) }}</td>
                              <td >{{ number_format($total_digit_amount) }} ( {{ number_format($total_other_amount) }} ) </td>

                              @if($total_digit_amount < 0)
                              <td style="text-align: right;">{{number_format(abs($total_compensation))}}</td>
                              @else
                              <td style="text-align: right;">-{{number_format($total_compensation)}}</td>
                              @endif

                              @if($total_digit_amount < 0)                                
                                <td style="text-align: right;"> {{ number_format($net_total + abs($total_compensation) ) }} </td>
                              @else
                                <td style="text-align: right;"> {{ number_format($net_total - $total_compensation) }} </td>

                              @endif  
                          </tr>

                        
                    
                  </tbody>

                </table>



                @if(auth()->user()->id == 2)
                <!-- Members Table -->                 
                <table class="table table-dark table-sm">
                    <thead>                      

                      <tr>                       
                      
                        <th>အမည်</th>
                        <th>ရာခိုင်နှုန်း</th>
                        <th>ရ/ပေး</th> 
                        
                       
                      </tr>

                  </thead>

                  <tbody>
                      @foreach ($members as $member) 
                        <tr>                       
                      
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->percent }}</td>
                        <td>{{ number_format(($net_total - $total_compensation) * $member->percent/100) }}</td>
                       
                      </tr>

                      @endforeach

                      <tr>
                        <td colspan="2" style="text-align: center;">TOTAL</td>
                        <td>{{ number_format($net_total - $total_compensation) }}</td>

                      </tr>
                  </tbody>
                                
                  
                </table>
                  <!-- End Members Table          -->
                @endif
      
    </div>


                <?php 

                  $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');

                  $choice_23      = WorkFile::where('id','=',$work_file_id)->value("name");

              ?>

              <div class="d-flex justify-content-between align-items-right">

                    @if($choice_23 == "2D")
                    <span class="card-text">
                        <a href="{{ url("/2dsale/add/{$work_file_id}") }}" class="btn btn-primary btn-sm" >
                           အရောင်း
                        </a>
                    </span> 
                    @endif

                    @if($choice_23 == "3D")
                    <span class="card-text">
                        <a href="{{ url("/3dsale/add/{$work_file_id}") }}" class="btn btn-primary btn-sm" >
                           အရောင်း
                        </a>
                    </span> 
                    @endif


                     <span class="card-text">
                        <a href="{{ url("/") }}" class="btn btn-primary btn-sm" >
                           Back
                        </a>
                    </span>               

              </div>


</div>
</div>
</div>
<!-- End Filters & Show-->


 
<script>
$(document).ready(function()
{
  
  
    $("#work_file_id").change();

    $("#result_digit").select().focus();

});

</script>   



<script>


  $("#from_date").change(function()   {
       
       $('#btnShow').click();

    });  

         $("#to_date").change(function()   {
       
       $('#btnShow').click();

    });  

          $("#duration").change(function()   {
       
       $('#btnShow').click();

    });  

  
   $("#result_digit").keypress(function( event ) 
                            {
                              if ( event.which == 13 ) 
                              {
                                if($("#result_digit").val()=="")
                                {
                                     event.preventDefault();                                 
                                
                                    $("#result_digit").focus();
                                }
                                
                              }
                             
                            });



   
    $("#work_file_id").change(function()    {

      $("#w_id").val($("#work_file_id").val());
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
        $.ajax(
            {
                type:   "GET",
                url:  "{{ url('getUser') }}?in_out="+in_out,
                dataType: 'json',             
                success:function(res)
                {                                                   
                    if(res)
                    {
                        var html = '';

                        html += '<option  value="'+ 0 +'" >'+ 'All' +'</option>';

                        for(var count = 0; count < res.length; count++)
                        {
                         
                            html += '<option  value="'+res[count].id+'" >'+ res[count].name +'</option>'; 
                                                 
                          
                        }

                        $("#user_id").html(html);
                    }
                }
            } 
           );       
      }

      $('#btnShow').click();
     
    });
    // End In_Out Change => Get User



</script>  
@endsection