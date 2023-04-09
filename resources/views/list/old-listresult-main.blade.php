<?php 
use App\WorkFile;
use App\User;
use App\Customer;
use App\Choice;

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


<!-- Filter & Show -->
<div class="container_fluid">
<div class="row justify-content-center">
<div class="col-md-8 col-md-offset-2">
          
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
                              <option value="AM/PM" @if($duration =="AM/PM") selected @endif>AM/PM</option>
                              <option value="AM" @if($duration =="AM") selected @endif>AM</option>
                              <option value="PM" @if($duration =="PM") selected @endif>PM</option>
                          </select>
                        </div>
                      </td>  



<!-- 
                      <td >
                      <div class="form-group">
                          <label>ပွဲစဉ်ဇယား</label> <br>
                          <select name="work_file_id" id="work_file_id" class="form-control" >                             
                          @foreach($work_files as $work_file)
                            <option value="{{ $work_file->id }}" @if($work_file->id == $work_file_id) selected @endif>
                              {{ $work_file->name ." ".$work_file->duration." [ ". $work_file->date ." ] " ."( ". $work_file->result_digit ." )" }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                    </td>               -->      
                   
          
                      

                       <td>
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
                          </td>

                        @if(Auth::check())
                        @if(auth()->user()->id == 1 or auth()->user()->id == 2)
                        <td>
                          <div class="form-group">
                            <label>Main</label><br>

                            <!-- <select name="main"  id="main" class="form-control">
                              <option value="2D">2D</option>
                              <option value="3D">3D</option>
                            </select>  -->
                            <a href="{{ url("/list/") }}" class="btn btn-primary btn-sm" >
                               2D List
                            </a>

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

                
                
                <!-- ThreeSale Table -->                 
                  <table class="table table-striped table-sm">                   
                  
                </table>
                  <!-- End ThreeSale Table          -->

                <!-- Position Table -->                 
                  <table class="table table-striped table-sm">  

                  <thead>                      

                      <tr>                       
                      
                        <th>ပွဲ</th>

                        <th>ရောင်းကြေး</th>

                        <th>ကော်နှုတ်</th>

                        <th >ဒဲ့(တွဒ်)</th>

                        <th style="text-align: right;">လျော်ကြေး</th>
                        <th style="text-align: right;">အရှုံးအမြတ်</th>
                      </tr>

                  </thead>
                  <tbody>
                     

                      <?php

                          $user_name   = User::where("id","=","$user_id")->value('name');
                          $work_file_name   = WorkFile::where("id","=","$work_file_id")->value('name');
                          $work_file_date   = WorkFile::where("id","=","$work_file_id") ->value('date');
                       ?>
                    
                      
                      <tr>
                        <td> {{ $work_file_name }}</td>
                        <td> {{ number_format($total_balance) }}</td>
                        <td> {{ number_format($net_total) }}</td>
                        <td >{{ number_format($total_digit_amount) }} ( {{ number_format($total_other_amount) }} ) </td>
                        <td style="text-align: right;">{{number_format($total_compensation)}}</td>
                        <td style="text-align: right;"> {{ number_format($net_total - $total_compensation) }} </td>
                      </tr>
                        
                    
                  </tbody>

                </table>

               
      
    </div>


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