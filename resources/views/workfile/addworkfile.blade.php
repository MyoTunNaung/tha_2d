<?php 

  use App\Choice;
  use Carbon\Carbon;
  
  $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');  

?>

@extends('layouts.app')
@section('content')

<!-- Show  -->
<style type="text/css">
  #table1 
  {
    font-size: 12px;
    display: flex;
    flex-flow: column;
    width: 100%;
  }
  #table1  thead 
  {
    flex: 0 0 auto;
  }
  #table1 tbody 
  {
   
    height: 350px;
    flex: 1 1 auto;
    display: block;
    overflow-y: auto;
    overflow-x: hidden;
  }
  #table1 tr 
  {
    width: 100%;
    display: table;
    table-layout: fixed;
  }
</style>

<div class="container">
<div class="row justify-content-center">
<div class="col-md-6 col-md-offset-2">

        @if(session('info'))
        <div class="container">
           <div class="alert alert-danger">
          {{ session('info') }}
          </div>
        </div>     
        @endif
</div>
</div>
</div>

   

<!-- Filters -->
<div class="container">
<div class="row justify-content-center">
<div class="col-md-6 col-md-offset-2">
          
    <div class="card border-secondary">

        <div class="card-header">Work Files</div>

       <!--  <div class="card-body"> -->

                <table class="table table-striped table-sm header-fixed">        
                <tbody>
                  <form method="get" action="{{ url("/workfile/list/show") }}" enctype="multipart/form-data">
                  {{ csrf_field() }}

                    <tr>
                      <td colspan="2">
                        <div class="form-group">
                            <label>Name</label> <br>
                            <select name="select_name" id="select_name" class="form-control" >
                              <option value="2D" @if($name =="2D") selected @endif>2D</option>
                          </select>
                        </div>
                      </td> 
                 
                      <td>
                      <div class="form-group">
                        <label>FromDate</label>
                        <input type="date" name="select_from_date" id="select_from_date" class="form-control" value="{{ $from_date }}">
                      </div>
                      </td>

                      <td>
                      <div class="form-group">
                        <label>ToDate</label>
                        <input type="date" name="select_to_date" id="select_to_date" class="form-control" value="{{ $to_date }}">
                      </div>
                      </td>        
                    
                  </tr>  

                  <label hidden >Show</label><br>                          
                  <input hidden type="submit"  value="Show" name="action" id="btnshow"  class="btn btn-info btn-sm">
                        
                         
                  </form>
                </tbody>
                </table>

                <!-- Show Table -->
                 
                  <table class="table table-sm header-fixed">
                    <thead>
                        <tr> 

                          <th>Name</th> 
                          <th>Time</th>  
                          <th>Date</th>
                          <th>Open/Close</th>  
                          <th>Upload</th>                       
                          <th>Delete</th>
                         
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                            $col_date   =  Carbon::today()->toDateString();
                        ?>

                        @foreach($workfiles as $workfile)

                          <?php 
                                $date = Carbon::parse($workfile->date); 

                                $result = $date->toDateString();

                                // dd($result);
                           ?>

                          @if($result != $col_date)
                             <tr style="background-color: lightgray;">
                          @else
                             <tr>
                          @endif

                       


                            <td>{{ $workfile->name }}</td>
                            <td>{{ $workfile->duration }}</td>
                            <td>{{ $workfile->date }}</td>
                            <td style="text-align: center;">{{ $workfile->upload }}</td>

                            @if(auth()->user()->id == 1 or auth()->user()->id == 2)

                           <td>
                              <a href="{{ url("/workfile/upd/{$workfile->id}") }}" class="btn btn-primary btn-sm" ">ဖိုင်တင်ရန်</a>
                            </td>

                           <td>
                              <a href="{{ url("/workfile/del/{$workfile->id}") }}" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure?') "><i class='fa fa-trash' aria-hidden='true' style='color: red; font-size:12px; cursor:pointer;'></i></a>
                            </td>

                            

                            @endif
                          
                        </tr>

                          <?php
                            $col_date   = Carbon::parse($workfile->date); 
                            $col_date = $col_date->toDateString();
                            
                          ?>


                        @endforeach                      
                    </tbody>
                  </table> 
                  <!-- End Show Table          -->

        <!-- </div> -->
    </div>

</div>
</div>
</div>
<!-- End Filters -->

    
<br>
    
<div class="container">
<div class="row justify-content-center">
<div class="col-md-6 col-md-offset-2">

    <div class="card border-secondary">

          <div class="card-header">New WorkFile</div>

            <table class="table table-sm">                
            <tbody>

              <form method="post" action="{{ url("/workfile/add") }}" enctype="multipart/form-data">
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
                  
                </tr>  

                <tr>

                <!--   <td>
                    <div class="form-group">
                        <label>Name</label> <br>
                        <select name="name" id="name" class="form-control" >
                          <option value="2D">2D</option>
                      </select>
                    </div>
                  </td>        --> 

                <!--   <td>
                    <div class="form-group">
                      <label >Date</label>
                      <input type="date" name="date" id="date" class="form-control" value="{{ $to_date }}" >
                    </div>
                  </td> -->

                </tr>
                
                <tr>
                 <!--  <td >
                    <div class="form-group">
                        <label>Duration</label> <br>
                        <select name="duration" id="duration" class="form-control" >                          
                          <option value="PM">PM</option>
                      </select>
                    </div>
                  </td>  

                   -->

                   <td>
                    <div class="form-group">
                      <label>Open Time</label>
                      <input type="time" name="am_open_time" id="am_open_time" class="form-control" value="09:30">
                    </div>
                  </td> 


                  <td>
                    <div class="form-group">
                      <label>Close Time</label>
                      <input type="time" name="am_close_time" id="am_close_time" class="form-control" value="10:30">
                    </div>
                  </td> 

                </tr>
                <tr>

                   <td>
                    <div class="form-group">
                      <label>Open Time</label>
                      <input type="time" name="pm_open_time" id="pm_open_time" class="form-control" value="13:00">
                    </div>
                  </td>   

                  <td>
                    <div class="form-group">
                      <label>Close Time</label>
                      <input type="time" name="pm_close_time" id="pm_close_time" class="form-control" value="15:45">
                    </div>
                  </td>   


                </tr>

                <tr>

                 <!--  <td>
                    <div class="form-group">
                      <label id="lbl_open_time">Open Time</label>
                      <input type="time" name="open_time" id="open_time" class="form-control" value="09:35">
                    </div>
                  </td> -->

                  

                </tr>

                <tr>
                    <td>
                    <div class="form-group">
                      <label>Break Amount</label>
                      <input type="number" name="break_amount" class="form-control" value="10000">
                    </div>
                    </td>

                  <!--   <td >
                    <div class="form-group">
                      <label>Show</label>
                      <input type="text" name="show" id="show" class="form-control" value="" readonly="true">
                    </div>
                    </td> -->
           
                </tr>              
            
              <tr>
                <td style="text-align: center;">
                    <input type="submit" value="သိမ်းရန်" class="btn btn-primary btn-sm">
                </td>
                <td style="text-align: center;">
                    <a href="{{ url("/3dsale/add/{$work_file_id}") }}" class="btn btn-primary btn-sm" >
                      အရောင်း
                    </a>
                </td>
                 <td style="text-align: center;">
                    <a href="{{ url("/") }}" class="btn btn-primary btn-sm" >
                      Back
                    </a>
                </td>
              </tr>
                  
              </form>
            </tbody>
            </table>



            </div>
</div>
</div>
</div>






<script>
    $(document).ready( 
              function()
              {

                      var name      = $('#name').val();
                      var date      = $('#to_date').val();
                      var duration  = $('#duration').val();
                      var close_time = $('#close_time').val();

                      $('#date').val(date);

                      date = new Date(date);
                      var show_date = formatDate(date);

                      close_time = new Date("1970-01-01 " + close_time);
                      var show_close_time = formatTime(close_time);

                      var show = name + " " + duration + "[ " + show_close_time +  " ]" + "{ " + show_date + " } ";

                      $("#show").val(show);



                  $("#name").change
                  ( function()
                    {
                      if($('#name').val() == "3D")
                      {
                        
                          $('#open_time').prop('hidden',true);
                          $('#lbl_open_time').prop('hidden',true);


                          $('#open_time').val("23:59");
                          $('#close_time').val("14:00");
                          $('#duration').val("PM");

                        
                      }

                      if($('#name').val() == "2D")
                      {
                        $('#open_time').prop('hidden',false);
                        $('#lbl_open_time').prop('hidden',false);

                        if($('#duration').val() == "AM")
                        {
                          $('#open_time').val("09:35");
                          $('#close_time').val("10:25");
                          $('#time').val("12:00");
                        }
                        else
                        {
                          $('#open_time').val("14:00");
                          $('#close_time').val("15:50");
                          $('#time').val("16:30");
                        }

                      }

                      var name      = $('#name').val();
                      var date      = $('#to_date').val();
                      var duration  = $('#duration').val();
                      var close_time = $('#close_time').val();

                      date = new Date(date);
                      var show_date = formatDate(date);

                      close_time = new Date("1970-01-01 " + close_time);
                      var show_close_time = formatTime(close_time);

                      var show = name + " " + duration + "[ " + show_close_time +  " ]" + "{ " + show_date + " } ";

                      $("#show").val(show);
                    }
                  );

                  $("#date").change
                  ( function()
                    {
                      if($('#name').val() == "3D")
                      {
                        
                          $('#open_time').val("23:59");
                          $('#close_time').val("14:00");
                          $('#duration').val("PM");
                        
                      }
                      if($('#name').val() == "2D")
                      {
                        if($('#duration').val() == "AM")
                        {
                          $('#open_time').val("09:35");
                          $('#close_time').val("10:25");
                          $('#time').val("12:00");
                        }
                        else
                        {
                          $('#open_time').val("14:00");
                          $('#close_time').val("15:50");
                          $('#time').val("16:30");
                        }

                      }

                      var name      = $('#name').val();
                      var date      = $('#to_date').val();
                      var duration  = $('#duration').val();
                      var close_time = $('#close_time').val();

                      $('#date').val(date);

                      date = new Date(date);
                      var show_date = formatDate(date);

                      close_time = new Date("1970-01-01 " + close_time);
                      var show_close_time = formatTime(close_time);

                      var show = name + " " + duration + "[ " + show_close_time +  " ]" + "{ " + show_date + " } ";

                      $("#show").val(show);
                    }
                  );

                  $("#duration").change
                  ( function()
                    {
                      if($('#name').val() == "3D")
                      {
                        
                          $('#open_time').val("23:59");
                          $('#close_time').val("14:00");
                          $('#duration').val("PM");
                        
                      }
                      if($('#name').val() == "2D")
                      {
                        if($('#duration').val() == "AM")
                        {
                          $('#open_time').val("09:35");
                          $('#close_time').val("10:25");
                          $('#time').val("12:00");
                        }
                        else
                        {
                          $('#open_time').val("14:00");
                          $('#close_time').val("15:50");
                          $('#time').val("16:30");
                        }

                      }

                      var name      = $('#name').val();
                      var date      = $('#to_date').val();
                      var duration  = $('#duration').val();
                      var close_time = $('#close_time').val();

                     
                      date = new Date(date);
                      var show_date = formatDate(date);

                      close_time = new Date("1970-01-01 " + close_time);
                      var show_close_time = formatTime(close_time);

                      var show = name + " " + duration + "[ " + show_close_time +  " ]" + "{ " + show_date + " } ";

                      $("#show").val(show);
                    }
                  );

                   $("#from_date").change
                  ( function()
                    {
                      var name      = $('#name').val();
                      var date      = $('#to_date').val();
                      var duration  = $('#duration').val();
                      var close_time = $('#close_time').val();

                      date = new Date(date);
                      var show_date = formatDate(date);

                      close_time = new Date("1970-01-01 " + close_time);
                      var show_close_time = formatTime(close_time);

                      var show = name + " " + duration + "[ " + show_close_time +  " ]" + "{ " + show_date + " } ";

                      $("#show").val(show);
                    }
                  );

                   $("#to_date").change
                  ( function()
                    {
                      var name      = $('#name').val();
                      var date      = $('#to_date').val();
                      var duration  = $('#duration').val();
                      var close_time = $('#close_time').val();

                      $('#date').val(date);

                      date = new Date(date);
                      var show_date = formatDate(date);

                      close_time = new Date("1970-01-01 " + close_time);
                      var show_close_time = formatTime(close_time);

                      var show = name + " " + duration + "[ " + show_close_time +  " ]" + "{ " + show_date + " } ";

                      $("#show").val(show);
                    }
                  );




              }
            );

function formatTime(date) {
                        var hours = date.getHours();
                        var minutes = date.getMinutes();
                        var ampm = hours >= 12 ? "PM" : "AM";

                        hours = hours % 12;
                        hours = hours ? hours : 12; // the hour "0" should be "12"
                        minutes = minutes < 10 ? "0" + minutes : minutes;
                        //var strTime = hours + ":" + minutes + " " + ampm;

                        var strTime = hours + ":" + minutes;

                        // return date.getDate() + "/" + new Intl.DateTimeFormat('en', { month: 'short' }).format(date) + "/" + date.getFullYear() + " " + strTime;

                        return strTime;
                    }

function formatDate(date) {
                        // var hours = date.getHours();
                        // var minutes = date.getMinutes();
                        // var ampm = hours >= 12 ? "PM" : "AM";

                        // hours = hours % 12;
                        // hours = hours ? hours : 12; // the hour "0" should be "12"
                        // minutes = minutes < 10 ? "0" + minutes : minutes;
                        // //var strTime = hours + ":" + minutes + " " + ampm;

                        // var strTime = hours + ":" + minutes;

                        return date.getDate() + "-" + new Intl.DateTimeFormat('en', { month: 'numeric' }).format(date) + "-" + date.getFullYear();

                        return strTime;
                    }





</script>  


<script>
$(document).ready(function()
{

     $("#select_name").change(function()
    {
      $('#btnshow').click();
    });  

    
    $("#select_from_date").change(function()
    {
      $('#btnshow').click();
    });  


    $("#select_to_date").change(function()
    {
      $('#btnshow').click();
    });  


    $("#to_date").focus();
    
});

</script>   

@endsection