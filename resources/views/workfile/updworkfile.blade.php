<?php 

  use App\Choice;
  
  $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');  

?>

@extends('layouts.app')
@section('content')


    @if(session('info'))
    <div class="container">
       <div class="alert alert-danger">
      {{ session('info') }}
      </div>
    </div>     
    @endif

     <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header">Edit WorkFile ဖိုင်တည် အချက်အလက် ပြင်ဆင်ခြင်း</div> 
    
    <table class="table table-sm">
        
    <tbody>
      <form method="post" enctype="multipart/form-data">
      {{ csrf_field() }}

 
        <tr>
            <td>
            <div class="form-group">
              <label>Work File</label>
              <input type="text" name="show" id="show" class="form-control" value="{{ $work_file->show }}">
            </div>
            </td>
            <td>
            <div class="form-group">
              <label>Upload</label>
              <input type="text" name="upload" class="form-control" value="{{ $work_file->upload }}">
            </div>
            </td>
        </tr>     

      
        <tr>
          <td style="text-align: center;">
            <input type="submit" value="တင်ရန်" class="btn btn-primary">
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

                  $("#name").change
                  ( function()
                    {
                      if($('#name').val() == "3D")
                      {
                        
                          $('#open_time').val("05:00");
                          $('#close_time').val("14:00");
                        
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
                      var date      = $('#date').val();
                      var duration  = $('#duration').val();
                      var close_time = $('#close_time').val();

                      date = new Date(date);
                      var show_date = formatDate(date);

                      close_time = new Date("1970-01-01 " + close_time);
                      var show_close_time = formatTime(close_time);

                      var show = name + " " + duration + " [ " + show_close_time +  " ] " + " { " + show_date + " } ";

                      $("#show").val(show);
                    }
                  );

                  $("#date").change
                  ( function()
                    {
                      if($('#name').val() == "3D")
                      {
                        
                          $('#open_time').val("05:00");
                          $('#close_time').val("14:00");
                        
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
                      var date      = $('#date').val();
                      var duration  = $('#duration').val();
                      var close_time = $('#close_time').val();

                      date = new Date(date);
                      var show_date = formatDate(date);

                      close_time = new Date("1970-01-01 " + close_time);
                      var show_close_time = formatTime(close_time);

                      var show = name + " " + duration + " [ " + show_close_time +  " ] " + " { " + show_date + " } ";

                      $("#show").val(show);
                    }
                  );

                  $("#duration").change
                  ( function()
                    {
                      if($('#name').val() == "3D")
                      {
                        
                          $('#open_time').val("05:00");
                          $('#close_time').val("14:00");
                        
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
                      var date      = $('#date').val();
                      var duration  = $('#duration').val();
                      var close_time = $('#close_time').val();

                     
                      date = new Date(date);
                      var show_date = formatDate(date);

                      close_time = new Date("1970-01-01 " + close_time);
                      var show_close_time = formatTime(close_time);

                      var show = name + " " + duration + " [ " + show_close_time +  " ] " + " { " + show_date + " } ";

                      $("#show").val(show);
                    }
                  );

                   $("#from_date").change
                  ( function()
                    {
                      var name      = $('#name').val();
                      var date      = $('#date').val();
                      var duration  = $('#duration').val();
                      var close_time = $('#close_time').val();

                      date = new Date(date);
                      var show_date = formatDate(date);

                      close_time = new Date("1970-01-01 " + close_time);
                      var show_close_time = formatTime(close_time);

                      var show = name + " " + duration + " [ " + show_close_time +  " ] " + " { " + show_date + " } ";

                      $("#show").val(show);
                    }
                  );

                   $("#to_date").change
                  ( function()
                    {
                      var name      = $('#name').val();
                      var date      = $('#date').val();
                      var duration  = $('#duration').val();
                      var close_time = $('#close_time').val();

                      date = new Date(date);
                      var show_date = formatDate(date);

                      close_time = new Date("1970-01-01 " + close_time);
                      var show_close_time = formatTime(close_time);

                      var show = name + " " + duration + " [ " + show_close_time +  " ] " + " { " + show_date + " } ";

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

@endsection