<?php 
use App\WorkFile;
use App\User;
use App\Customer;
use App\Choice;




// dd($w_date);

?>

@extends('layouts.app')
@section('content')

<style type="text/css">
   #list_card
  {
    height: 360px;
    overflow-y: auto;   
    background-color:#f7f7f5; 
  }
</style>

<!-- <h1>Hi</h1> -->

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

<!-- Filter & Show -->
<div class="container_fluid">
<div class="row justify-content-center">
<div class="col-md-12 col-md-offset-2">

              <?php 

                  $wf_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');

                  $choice_23      = WorkFile::where('id','=',$wf_id)->value("name");

              ?>

              <div class="d-flex justify-content-between align-items-right">

                    @if($choice_23 == "2D")
                    <span class="card-text">
                        <a href="{{ url("/2dsale/add/{$wf_id}") }}" class="btn btn-primary btn-sm" >
                           အရောင်း
                        </a>
                    </span> 
                    @endif

                    @if($choice_23 == "3D")
                    <span class="card-text">
                        <a href="{{ url("/3dsale/add/{$wf_id}") }}" class="btn btn-primary btn-sm" >
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
          
    <div class="card border-secondary">

      
                <table class="table table-striped table-sm header-fixed">        
                <tbody>
                  
                  <form method="get" action="{{ url("/list/show") }}"  enctype="multipart/form-data">
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
                            <label>Name</label> <br>
                            <select name="name" id="name" class="form-control" >
                              <option value="2D_3D" @if($name =="2D_3D") selected @endif>2D/3D</option>
                              <option value="2D" @if($name =="2D") selected @endif>2D</option>
                              <option value="3D" @if($name =="3D") selected @endif>3D</option>                              
                          </select>
                        </div>
                      </td>  


                       <td >
                        <div class="form-group">
                            <label>Duration</label> <br>
                            <select name="duration" id="duration" class="form-control" >

                              @if($name == "2D")
                                <option value="AM_PM" @if($duration =="AM_PM") selected @endif>AM/PM</option>
                                <option value="AM" @if($duration =="AM") selected @endif>AM</option>
                                <option value="PM" @if($duration =="PM") selected @endif>PM</option>
                              @elseif($name == "2D_3D")
                                <option value="AM_PM" @if($duration =="AM_PM") selected @endif>AM/PM</option>
                              @elseif($name == "3D")                              
                                <option value="AM_PM" @if($duration =="AM_PM") selected @endif>AM/PM</option>
                              @endif

                          </select>
                        </div>
                      </td>  


                      <td >
                      <div class="form-group">
                          <label>ပွဲစဉ်ဇယား</label> <br>
                          <select name="work_file_id" id="work_file_id" class="form-control" >   
                          
                          <option value="0" @if($work_file_id == 0)  @endif> All </option>

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

                        @if(Auth::check())
                        @if(auth()->user()->id == 1 or auth()->user()->id == 2)
                        <td>
                          <div class="form-group">
                            <label>Main</label><br>
                           <!--  <a href="{{ url("/main/list/") }}" class="btn btn-primary btn-sm" value="2D" name="action">
                               2D Main
                            </a> -->

                            <input type="submit"  value="2D" name="action" id="btn2DMain"  class="btn btn-info btn-sm" class="form-control"> 



                            <!-- <select name="main"  id="main" class="form-control">
                              <option value="2D">2D</option>
                              <option value="3D">3D</option>
                            </select>  -->
                           <!--  <input type="submit"  value="2D" name="action" id="btnMain"  class="btn btn-info btn-sm" class="form-control"> -->

                            

                          </div>
                        </td>

                        <td>
                          <div class="form-group">
                            <label>Main</label><br>
                           <!--  <a href="{{ url("/main/list/") }}" class="btn btn-primary btn-sm" >
                               3D Main
                            </a> -->

                            <input type="submit"  value="3D" name="action" id="btn3DMain"  class="btn btn-info btn-sm" class="form-control"> 
                            

                            <!-- <select name="main"  id="main" class="form-control">
                              <option value="2D">2D</option>
                              <option value="3D">3D</option>
                            </select>  -->
                           <!--  <input type="submit"  value="2D" name="action" id="btnMain"  class="btn btn-info btn-sm" class="form-control"> -->

                            

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

                 <div class="card-footer">

                  <span id="show1"></span>
                  <span id="show2"></span>
                  <span id="show3"></span>
                  <span id="show4"></span>

                </div>
      </div>

      <div class="card border-secondary" id="list_card">

               
                
                <!-- Show Table -->                 
                  <table class="table1 table-striped table-sm header-fixed">
                   
                  <thead>
                      

                      <tr>                        
                      
                        <th>အမည်</th>

                        <th>ထိုးကြေး</th>

                        <th>ကော်နှုတ်</th>

                        <th>လျော်ကြေး</th>

                        <th>ရ/ပေး</th>

                         <th >ဒဲ့(တွဒ်)</th>

                         <th>နေ့စွဲ</th>

                         <th>WorkFile</th>

                        <!--  @if($action != "3D")

                         <th>လုံးပါ/အထိုင်/အတွဲ</th>

                         @endif -->

                       <!--  <th style="text-align: right;">Total</th> -->
                       <!--  <th>Comm</th>  -->
                        <!-- <th>Net</th> -->

                                            
                           
                       <!--  <th>Compen</th>   -->
                        <!-- <th style="text-align: right;">လျော်ကြေး</th> -->
                        <!-- <th>နေ့စ</th>  -->
                       
                      </tr>
                  </thead>
                  <tbody>
                      <?php                         
                          
                          $TOTAL        = 0;
                          $NET          = 0;
                          $COMPENSATION = 0;

                          $DIGIT        = 0;                          
                          $OTHER        = 0;

                          $ONE          = 0;
                          $POS          = 0;
                          $TWO          = 0;

                          $BALANCE      = 0;

                       ?>
                      @foreach($results as $result) 

                      <?php 

                          $user_name   = User::where([ 
                                                        ["id","=","$result->user_id"] 
                                                    ])
                                              ->value('name');

                          $work_file_id = $result->work_file_id;
                          

                          $w_date = WorkFile::where('id','=',$work_file_id)->value('date');
                      

                          $work_file_name   = WorkFile::where([
                                                                ["id","=","$result->work_file_id"],
                                                              ])
                                                        ->value('name');

                          $work_file_duration   = WorkFile::where([
                                                                ["id","=","$result->work_file_id"],
                                                              ])
                                                        ->value('duration');


                          $work_file_date   = WorkFile::where([
                                                                ["id","=","$result->work_file_id"]
                                                              ])
                                                        ->value('date');

                       ?>
                    
                      
                      <tr> 


                            <td> {{ $user_name }}</td>
                      
                        


                        <td> {{ $result->total_amount + $result->p_total_amount}}</td>
                        <td> {{ $result->net_total + $result->p_net_total}}</td>

                        <td> {{ $result->compensation_amount + $result->p_compensation_amount}}</td>

                        

                        @if(auth()->user()->id == 1 || auth()->user()->id == 2)                            

                            @if($in_out == 1)
                              @if($result->balance > 0)
                                  <?php $negative = -$result->balance ?>
                                  <td> {{ $negative }} </td>
                              @else
                                  <?php $positive = abs($result->balance) ?>
                                   <td> {{ $positive }} </td>
                              @endif
                            @endif

                            @if($in_out == 2)
                              @if($result->balance > 0)

                                  <?php $negative = -$result->balance ?>
                                  <td> {{ $result->balance }} </td>
                              @else
                                    <?php $positive = abs($result->balance) ?>
                                   <td> {{ $result->balance }} </td>                                  

                              @endif
                            @endif

                        @else

                          <td >{{ number_format($result->balance) }}</td> 

                        @endif
                        


                        <td >{{ number_format($result->digit_amount) }} ({{ number_format($result->other_amount) }}) </td>

                       <!--  @if($action != "3D")
                        <td >
                              {{ number_format($result->one_amount) }}/
                              {{ number_format($result->pos_amount) }}/
                              {{ number_format($result->two_amount) }}
                        </td>
                         @endif -->

                         <?php  
                                $date_show = date_create($w_date);
                                $date_show = date_format($date_show,"d-m-Y");

                           ?>

                         <td> {{ $w_date }}</td>

                         <td> {{ $work_file_name." ".$work_file_duration }}</td>
                       
                      </tr>

                      <?php 

                       
                        $TOTAL        += $result->total_amount;
                        $NET          += $result->net_total + $result->p_net_total;
                        $COMPENSATION += $result->compensation_amount + $result->p_compensation_amount;

                        $DIGIT        += $result->digit_amount;
                        $OTHER        += $result->other_amount;

                        $ONE          += $result->one_amount;
                        $POS          += $result->pos_amount;
                        $TWO          += $result->two_amount;

                        $BALANCE      += $result->balance;
                      ?>

                      @endforeach

                      @if($action != "3D")
                      <tr style="border: 1px solid black;">

                          <td >TOTAL</td>
                          <td id="v1">{{ number_format($TOTAL) }}</td>
                          <td id="v2">{{ number_format($NET) }}</td>
                          <td id="v3">{{ number_format($COMPENSATION) }}</td>
                          
                         
                          @if(auth()->user()->id == 1 || auth()->user()->id == 2)                            

                            @if($in_out == 1)
                              @if($BALANCE > 0)
                                  <?php $negative = -$BALANCE ?>
                                  <td id="v4"> {{ $negative }} </td>
                              @else
                                  <?php $positive = abs($BALANCE) ?>
                                   <td id="v4"> {{ $positive }} </td>
                              @endif
                            @endif

                            @if($in_out == 2)
                              @if($BALANCE > 0)

                                  <?php $negative = -$BALANCE ?>
                                  <td id="v4"> {{ $BALANCE }} </td>
                              @else
                                    <?php $positive = abs($BALANCE) ?>
                                   <td id="v4"> {{ $BALANCE }} </td>                                  

                              @endif
                            @endif

                        @else

                          <td id="v4">{{ number_format($BALANCE) }}</td> 

                        @endif


                         <!--  @if(auth()->user()->id == 1 || auth()->user()->id == 2)

                            @if($in_out == 1)
                              @if($BALANCE > 0)
                                  <?php $negative = -$BALANCE ?>
                                  <td id="v4"> {{ $negative }} </td>
                              @else
                                  <?php $positive = abs($BALANCE) ?>
                                   <td id="v4"> {{ $positive }} </td>
                              @endif
                            @endif

                            @if($in_out == 2)
                              @if($BALANCE > 0)
                                  <?php $positive = abs($BALANCE) ?>
                                  <td id="v4"> {{ $positive }} </td>
                              @else
                                  <?php $negative = -$BALANCE ?>
                                  <td id="v4"> {{ $negative }} </td>
                              @endif
                            @endif


                          @else


                          <td id="v4">{{ number_format($BALANCE) }}</td> 

                          @endif -->


                          <td >{{ number_format($DIGIT) }} ( {{ number_format($OTHER) }} )</td>

                         <!--  <td>{{ number_format($ONE) }} / {{ number_format($POS) }} / {{ number_format($TWO) }}</td> -->
                         

                      </tr>
                      @endif
                      
                      <!-- @if($action == "3D")
                        <tr>
                            <td>3D</td>

                        </tr>
                      @endif -->

                    
                  </tbody>
                </table>
                  <!-- End Show Table          -->



        <!-- </div> -->
    </div>


              


</div>
</div>
</div>
<!-- End Filters & Show-->


 
<script>
$(document).ready(function()
{

  var show1 = "ထိုးကြေး" + " [ " + $("#v1").text() + " ]"; 
  var show2 = "ကော်နှုတ်" + " [ " + $("#v2").text() + " ]";
  var show3 = "လျော်ကြေး" + " [ " + $("#v3").text() + " ]";
  var show4 = "ရ/ပေး" + " [ " + $("#v4").text() + " ]";

  $("#show1").text(show1);
  $("#show2").text(show2);
  $("#show3").text(show3);
  $("#show4").text(show4);

  // $("#work_file_id").change();
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


    $("#work_file_id").change(function()    
    {

      // $("#w_id").val($("#work_file_id").val());

      $('#btnShow').click();
      
    });


   
    $("#user_id").change(function()   
    {
       
       $('#btnShow').click();

    });  


     $("#duration").change(function()   
     {
       
       $('#btnShow').click();

    });  

      $("#name").change(function()   
      {
       
    
        $('#btnShow').click();

    });  

       $("#from_date").change(function()   {
       
       $('#btnShow').click();

    });  

         $("#to_date").change(function()   {
       
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