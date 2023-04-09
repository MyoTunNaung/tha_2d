<?php 
use App\WorkFile;
use App\User;
use App\Customer;
use App\Choice;

?>

@extends('layouts.app')
@section('content')

<style type="text/css">
  .table1 
  {
    font-size: 12px;
    display: flex;
    flex-flow: column;
    width: 100%;
  }
  .table1 thead 
  {
    flex: 0 0 auto;
  }
  .table1 tbody 
  {
   
    height: 220px;
    flex: 1 1 auto;
    display: block;
    overflow-y: auto;
    overflow-x: auto;
  }
  .table1 tr 
  {
    width: 100%;
    display: table;
    table-layout: fixed;
  }
  .table1 td input
  {
    width: 50px;
    height: 35px;
  }
</style>


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
<div class="container">
<div class="row justify-content-center">
<div class="col-md-6 col-md-offset-2">
          
    <div class="card border-secondary">

        <div class="card-header">
            ပေါက်သီးစာရင်းများ
        </div>

      
                <table class="table table-striped table-sm header-fixed">        
                <tbody>
                  <form method="get" action="{{ url("/result/list/show") }}"  enctype="multipart/form-data">
                  {{ csrf_field() }}

                  
                    <tr>

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
                    </td>                    
                   
          
                      <td>
                        <div class="form-group">
                            <label>အမည်</label> <br>
                            <select name="user_id" id="user_id" class="form-control" >


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


                       <td>
                          <div class="form-group">
                            <label>IN/OUT</label><br>
                            <select name="in_out"  id="in_out" class="form-control">
                              <option value="1" @if($in_out == 1) selected @endif>IN</option>

                              @if(Auth::check())
                              @if(auth()->user()->id == 1 or auth()->user()->id == 2)
                                <option value="2" @if($in_out == 2) selected @endif>OUT</option>
                              @endif
                              @endif

                            </select>
                           
                          </div>
                        </td>


                    </tr>


                  <label hidden >Show</label><br>                          
                  <input hidden type="submit"  value="Show" name="action" id="btnShow"  class="btn btn-info btn-sm">
                        
                         
                  </form>
                </tbody>
                </table>


                
                <!-- Show Table -->                 
                  <table class="table1 table-striped table-sm header-fixed" >
                   
                  <thead>
                      

                      <tr>                        
                      
                        <th>အမည်</th>

                       <!--  <th style="text-align: right;">Total</th> -->
                       <!--  <th>Comm</th>  -->
                        <!-- <th>Net</th> -->

                        <th style="text-align: right;">ဒဲ့</th>
                        <th style="text-align: right;">တွဒ်</th>
<!-- 
                        <th style="text-align: right;">လုံးပါ/အထိုင်/အတွဲ</th>  -->
                                   
                           
                        @if(auth()->user()->id ==1 || auth()->user()->id ==2)
                        <th style="text-align: right;">ယူနစ်</th>
                        @endif
                       
                      </tr>
                  </thead>
                  <tbody id="show_table">
                      <?php                         
                          
                          $TOTAL        = 0;
                          $DIGIT        = 0;
                          $OTHER        = 0;
                          $BALANCE      = 0;
                          $P            = 0;

                       ?>
                      @foreach($results as $result) 

                      <?php 

                          $user_name   = User::where([ 
                                                        ["id","=","$result->user_id"] 
                                                    ])
                                              ->value('name');
                      

                          $work_file_name   = WorkFile::where([
                                                                ["id","=","$result->work_file_id"]
                                                              ])
                                                        ->value('show');

                          $work_file_date   = WorkFile::where([
                                                                ["id","=","$result->work_file_id"]
                                                              ])
                                                        ->value('date');

                          $p_amount = 0;
                       ?>
                    
                      
                      <tr> 

                        
                        <td> {{ $user_name }}</td>
                          <!-- <td style="text-align: right;">{{ number_format($result->total_amount) }}</td>  -->
                         <!--  <td>{{ number_format($result->commission_amount) }}</td> -->
                         <!--  <td>{{ number_format($result->net_total) }}</td>  -->

                          <td style="text-align: right;">{{ number_format($result->digit_amount) }}</td>
                          <td style="text-align: right;">{{ number_format($result->other_amount) }}</td> 


                         <!--  <td style="text-align: right;">
                              {{ number_format($result->one_amount) }}/ 
                              {{ number_format($result->pos_amount) }}/
                              {{ number_format($result->two_amount) }}
                          </td> -->
                        
                        @if(auth()->user()->id ==1 || auth()->user()->id ==2)

                          @if($in_out == 1)
                            @if($result->balance > 0)
                                <?php $negative = -$result->balance ?>
                                <td style="text-align: right;"> {{ $negative }} </td>
                            @else
                                <?php $positive = abs($result->balance) ?>
                                 <td style="text-align: right;"> {{ $positive }} </td>
                            @endif
                          @endif


                           @if($in_out == 2)
                            @if($result->balance > 0)
                                <?php $positive = abs($result->balance) ?>
                                 <td style="text-align: right;"> {{ $positive }} </td>
                            @else
                                <?php $negative = -$result->balance ?>
                                <td style="text-align: right;"> {{ $negative }} </td>
                            @endif
                          @endif
                        
                        @endif

                          <!-- <td style="text-align: right;">{{ number_format($result->balance) }}</td>  -->

                          <!-- <td>{{ date('d:m:Y', strtotime($work_file_date))  }}</td> -->
                        
                      </tr>

                      <?php 

                       
                        $TOTAL        += $result->total_amount;
                        $DIGIT        += $result->digit_amount;
                        $OTHER        += $result->other_amount;
                        $BALANCE      += $result->balance;
                      ?>

                      @endforeach


                      <tr style="border: 1px solid black;">  
                          <td >TOTAL</td>
                         <!--  <td style="text-align: right;">{{ number_format($TOTAL) }}</td> -->
                          <td style="text-align: right;">{{ number_format($DIGIT) }}</td>
                          <td style="text-align: right;">{{ number_format($OTHER) }}</td>

                          <!-- <td style="text-align: right;">
                              {{ number_format($P) }}/
                              {{ number_format($P) }}/
                              {{ number_format($P) }}
                          </td>
 -->
                        @if(auth()->user()->id ==1 || auth()->user()->id ==2)

                          @if($in_out == 1)
                            @if($BALANCE > 0)
                                <?php $negative = -$BALANCE ?>
                                <td style="text-align: right;"> {{ $negative }} </td>
                            @else
                                <?php $positive = abs($BALANCE) ?>
                                 <td style="text-align: right;"> {{ $positive }} </td>
                            @endif
                          @endif

                          @if($in_out == 2)
                            @if($BALANCE > 0)
                                <?php $positive = abs($BALANCE) ?>
                                 <td style="text-align: right;"> {{ $positive }} </td>
                            @else
                                <?php $negative = -$BALANCE ?>
                                <td style="text-align: right;"> {{ $negative }} </td>
                            @endif
                          @endif

                        @endif


                          <!-- <td style="text-align: right;">{{ number_format($BALANCE) }}</td>   -->


                      </tr>
                    
                  </tbody>
                </table>
                  <!-- End Show Table          -->

        <!-- </div> -->
    </div>

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

<br>

@if(Auth::check())
@if(auth()->user()->id == 1 or auth()->user()->id == 2)

<!-- Main Job -->
<div class="container">
<div class="row justify-content-center">
<div class="col-md-6 col-md-offset-2">

        
    

      <div class="card border-secondary">
        
          <table class="table table-sm">
              
          <tbody>
            <form method="post" enctype="multipart/form-data" action="{{ url("/result/add") }}">

            {{ csrf_field() }}

              <tr>

                <input type="text" name="w_id" id="w_id"  value="{{$work_file_id}}" hidden>
             
                <td>
                  <div class="form-group">
                    <label>ပေါက်သီး ထည့်ရန်</label>                   
                  </div>
                </td>

                <td>
                  <div class="form-group">                   
                    <input type="text" name="result_digit" id="result_digit" class="form-control" autocomplete="off" value="{{$result_digit}}">
                  </div>
                </td>               
              </tr>
          
            <tr>
              <td><input type="submit"  value="သိမ်းရန်"    name="action" id="btnAdd"class="btn btn-primary btn-sm"></td>
              <td><a href="{{ url("/3dsale/add/{$work_file_id}") }}" class="btn btn-primary btn-sm" >
                           အရောင်း
                        </a></td>
              <td><a href="{{ url("/") }}" class="btn btn-primary btn-sm" >
                           Back
                        </a></td>
            </tr>
                
            </form>
          </tbody>
          </table>



  </div>

              

             


</div>
</div>
</div>

<!-- End Main Jog -->
@endif
@endif








 
<script>
$(document).ready(function()
{
  
    $('#show_table').scrollTop( $('#show_table')[0].scrollHeight );

     $("#result_digit").select().focus();

});

</script>   



<script>
  
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



</script>  
@endsection