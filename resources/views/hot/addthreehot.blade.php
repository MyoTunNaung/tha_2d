@extends('layouts.app')
@section('content')

<style type="text/css">
  #panel3
  {
    display: none;
  }  

  .btn-info {
    color: #212529;
    background-color: #7cc;
    border-color: #5bc2c2;
    font-size: 14px;
    font-weight : bold ;
}

#digit
{
    font-size: 20px;
    font-weight : bold ;
}

</style>


<!-- Keyboard JS -->
<script>

function insert(num) 
{

  var digit = $("#digit").val();
      digit += num;

  if(digit.length < 5)
  {
    $("#digit").val(digit);
  }
  else if(digit.length == 5)
  {
    var last_digit = digit.substring(digit.length - 1, digit.length);
    
    if($.isNumeric(last_digit))
    {
       $("#digit").focus();
    }
    else
    {   $("#digit").val(digit);
        $("#digit").focus();
    }
   
  }
  else
  {
      $("#digit").focus();
  }

}

function enter()
{
  var digit = $("#digit").val();


  if(digit == "")
  {
   
    var digit = $("#digit").val();
    $("#digit").val(digit);    
    $("#digit").focus();

    return ;
  }

 
  if(digit.length > 5 || digit == "")
  {
    $("#digit").focus();

     return ;
  }

  
  $("#digit").change();
  $("#add_hot").click();

}

function clearall()
{
    $("#digit").val("");
    $("#digit").focus();
}


function backspace()
{
  var digit = $("#digit").val();
      digit = digit.substring(0, digit.length - 1);

      $("#digit").val(digit);
      $("#digit").focus();
}
</script>
<!-- End Keyboard JS -->


<script>
    $(document).ready( 
              function()
              {
                    
                   // $("#keyboard").change();


                   $("#keyboard").change( function()
                                    {
                                      var keyboard = $("#keyboard").val();

                                     
                                      if(keyboard == "Off")
                                      {
                                          $('#digit').prop('readonly',true);                                         
                                      }
                                      if(keyboard == "On")
                                      {
                                          $('#digit').prop('readonly',false);
                                         
                                      }

                                    }
                                  );


                   $("#header3").click
                  ( function()
                    {
                      $("#panel3").toggle("first");
                    }
                  );


                  $("#D").click( function()
                                  {
                                    var digit = $("#digit").val();

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );

                  $("#R").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "R";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );
                  $("#TRI").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "TRI";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );

                  $("#R5").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "R5";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );
                  $("#R4").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "R4";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );
                  $("#R3").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "R3";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );
                  $("#R2").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "R2";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );
                  $("#R1").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "R1";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );
                  $("#RR").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "RR";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );

                  $("#NSE").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "N";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );
                  $("#LSE").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "L";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );
                  $("#SSE").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "S";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );
                  $("#KP").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "KP";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );
                  $("#SKP").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "SKP";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );
                  $("#MKP").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "MKP";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );
                  $("#KS").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "KS";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );
                  $("#KSS").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "KSS";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );
                  $("#KSM").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "KSM";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );

                  $("#B").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "B";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );


              }
            );
  </script>


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
            ဟော့ ဂဏန်းများ
        </div>

      
                <table class="table table-striped table-sm header-fixed">        
                <tbody>
                  <form method="get" action="{{ url("/hot/list/show") }}" enctype="multipart/form-data">
                  {{ csrf_field() }}

                  

                  <tr>
                    <td>
                        <div class="form-group">
                          <label class="form-control">ပွဲစဉ်ဇယား</label>
                        </div>
                    </td>
                    <td>

                      <div class="form-group">                         
                          <select name="work_file_id" id="work_file_id" class="form-control" >                             
                          @foreach($work_files as $work_file)
                            <option value="{{ $work_file->id }}" @if($work_file->id == $work_file_id) selected @endif>
                              {{ $work_file->name ." ".$work_file->duration." [ ". $work_file->date ." ] "}}
                            </option>
                          @endforeach
                        </select>
                      </div>
                    </td>
                  </tr>


                  <label hidden >Show</label><br>                          
                  <input hidden type="submit"  value="Show" name="action" id="btnshow"  class="btn btn-info btn-sm">
                        
                         
                  </form>
                </tbody>
                </table>



                <!-- Show Table -->                 
                  <table class="table table-striped table-sm header-fixed">
                  <thead>
                      <tr>
                        <th>No</th>                        
                        <th>Digit</th>
                        <th>Type</th>   

                        <th>Delete</th> 

                      </tr>
                  </thead>
                  <tbody>
                      
                      <?php
                          $col_type  = "";                        
                          $no        = 1;
                       ?>
                      @foreach($old_hots as $hot)                     
                      
                      <tr>
                         
                          <td>{{ $no }}</td>
                          <td> {{ $hot->digit }} </td>

                          @if($hot->type != $col_type)
                            <td>{{ $hot->type }}</td>                          
                          @else
                            <td></td>                          
                          @endif

                         

                     <td>
                      <a href="{{ url("/hot/del/{$hot->id}") }}" >
                      <i class='fa fa-trash' aria-hidden='true' style='color: red; font-size:12px; cursor:pointer;'></i>
                      </a>
                    </td>



                      </tr>
                     

                      <?php 
                        
                        $col_type     = $hot->type;
                        $no++;
                       
                      ?>
                      @endforeach


                       <tr>
                          <td colspan="4" style="text-align: center;">
                            <a href="{{ url("/hot/alldel/{$work_file_id}") }}" class="btn btn-danger btn-sm" > ဟော့ဂဏန်းအားလုံး ဖျက်ရန်</a>
                          </td>

                      </tr>

                    
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

        <div class="card-header">
            ဟော့ဂဏန်း အသစ်
        </div>

           

            <table class="table table-sm">
                
            <tbody>
              <form method="post" enctype="multipart/form-data" action="{{ url("/hot/add") }}">

              {{ csrf_field() }}

                <input type="text" name="select_work_file_id" id="select_work_file_id"  value="{{ $work_file_id }}"  hidden>
                <input type="text" name="select_slip_id"      id="select_slip_id"       value="{{ $slip_id }}"   hidden>

                <tr>

                  <td>
                    <div class="form-group">
                      <input type="text" name="type" id="digit" class="form-control" autofocus autocomplete="off">
                    </div>
                  </td>          

                </tr>

                <tr>
                  <td>
                     <a href="{{ url("/3dsale/add/{$work_file_id}") }}" class="btn btn-primary btn-sm" >
                                       အရောင်း
                              </a>
                  </td>
                   <td>
                     <a href="{{ url("/") }}" class="btn btn-primary btn-sm" >
                                       Back
                              </a>
                  </td>
                </tr>
            
                
                <input type="submit" value="Add Hot" id="add_hot" class="btn btn-primary btn-sm" hidden>
               

              </form>
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

<h1>Here</h1>
<br>

<!-- Keyboard -->
<div class="container">
<div class="row justify-content-center">
<div class="col-md-6 col-md-offset-2">

     <div class="card border-secondary">

          <div class="d-flex justify-content-between align-items-center">

              <span class="card-text">
                Keyboard: 
                <select name="keyboard"  id="keyboard">
                    <option value="On"  @if($keyboard == "On") selected @endif>On</option>
                    <option value="Off" @if($keyboard == "Off") selected @endif>Off</option>
                </select>
              </span>

         </div>




      <!-- Start Keypad -->
          <tr>

          <td colspan="3">
       
            <input type="text" name="digit_amount" value="0" id="digit_amount" hidden>

           <table class="table table-stripped table-sm" style="font-size: 12px;">

                <tr>

                   

                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="SSE" value="ရှေ့စီးရီး" style="width: 100%; font-size: 18px;">
                    </td> 
                     <td>
                      <input type="button" class="btn btn-info btn-sm" id="LSE" value="လယ်စီးရီး" style="width: 100%; font-size: 18px;">
                    </td>               
                     <td>
                      <input type="button" class="btn btn-info btn-sm" id="NSE" value="နောက်စီးရီး" style="width: 100%; font-size: 18px;">
                    </td>

                     <td>
                      <input type="button" class="btn btn-info btn-sm" id="TRI" value="ထွိုင်" style="width: 100%;">
                    </td>   


                </tr>
                
                <tr>                 
                   
                    <td>                                          
                        <input type="button" class="btn btn-info btn-sm"  value="Del" onclick = "clearall()" style="width: 100%; font-size: 18px;">
                    </td> 

                     <td>
                      <input type="button" class="btn btn-info btn-sm"  value="Back" onclick = "backspace()" style="width: 100%; font-size: 18px;">
                    </td>                   
               
                    <td>
                      <input type="button" class="btn btn-info btn-sm"  value="/ (ဘရိတ်)" onclick = "insert('/')" style="width: 100%;">
                    </td>

                    <td>
                      <input type="button" class="btn btn-info btn-sm"  value="* (T/N/PP)" onclick = "insert('*')" style="width: 100%;">
                    </td>
                                  
                </tr>

                <tr>                 
                   
                    <td>                                          
                        <input type="button" class="btn btn-info btn-sm"  value="7" onclick = "insert(7)" style="width: 100%;font-size: 20px;">
                    </td> 

                     <td>
                      <input type="button" class="btn btn-info btn-sm"  value="8" onclick = "insert(8)" style="width: 100%;font-size: 20px;" >
                    </td>                   
               
                    <td>
                      <input type="button" class="btn btn-info btn-sm"  value="9" onclick = "insert(9)" style="width: 100%;font-size: 20px;">
                    </td>

                    <td>
                      <input type="button" class="btn btn-info btn-sm"  value="- (အပါ)" onclick = "insert('-')" style="width: 100%;">
                    </td>
                                  
                </tr>

                


                <tr>                 
                   
                    <td>                                          
                        <input type="button" class="btn btn-info btn-sm"  value="4" onclick = "insert(4)" style="width: 100%;font-size: 20px;">
                    </td> 

                     <td>
                      <input type="button" class="btn btn-info btn-sm"  value="5" onclick = "insert(5)" style="width: 100%;font-size: 20px;">
                    </td>                   
               
                    <td>
                      <input type="button" class="btn btn-info btn-sm"  value="6" onclick = "insert(6)" style="width: 100%;font-size: 20px;">
                    </td>

                    <td>
                      <input type="button" class="btn btn-info btn-sm"  value="+ (R)" onclick = "insert('+')" style="width: 100%;">
                    </td>
                                  
                </tr>

                <tr>                 
                   
                    <td>                                          
                        <input type="button" class="btn btn-info btn-sm"  value="1" onclick = "insert(1)" style="width: 100%;font-size: 20px;">
                    </td> 

                     <td>
                      <input type="button" class="btn btn-info btn-sm"  value="2" onclick = "insert(2)" style="width: 100%;font-size: 20px;">
                    </td>                   
               
                    <td>
                      <input type="button" class="btn btn-info btn-sm"  value="3" onclick = "insert(3)" style="width: 100%;font-size: 20px;">
                    </td>

                    <td >
                      <div id="header3" class="text-center">
                        <input type="button" value="More..." class="btn btn-info btn-sm" style="width: 100%;">
                      </div>
                    </td>

                    <!--  <td>
                      <input type="button" class="btn btn-info btn-sm"  value="." onclick = "insert('.')" style="width: 100%;font-size: 20px;height:35px; line-height: 35px;" disabled >
                    </td> -->
                                  
                </tr>

                <tr>                 
                   
                    <td>                                          
                        <input type="button" class="btn btn-info btn-sm"  value="0" onclick = "insert(0)" style="width: 100%;font-size: 20px;">
                    </td> 

                    <!--  <td>
                      <input type="button" class="btn btn-info btn-sm"  value="00" onclick = "insert('00')" style="width: 100%;font-size: 20px;" disabled>
                    </td>   -->

                    <td colspan="3" >
                      <input type="button" class="btn btn-info btn-sm"  value="OK" onclick = "enter()" style="width: 100%;font-size: 18px;">
                    </td>
                                  
                </tr>

           <!-- </div> -->

          </td>
          </tr>
          <!-- End Keypad -->


              <table class="table table-stripped table-sm" id="panel3" style="font-size: 12px;">

                <tr>

                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="KP" value="ခွပူး" style="width: 100%;">
                    </td>
                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="SKP" value="စုံခွပူး" style="width: 100%;">
                    </td>
                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="MKP" value="မခွပူး" style="width: 100%;">
                    </td>
                    

                </tr>
                
                <tr>
                    
                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="KS" value="စီးရီးခွပူး" style="width: 100%;">
                    </td>                
                     <td>
                      <input type="button" class="btn btn-info btn-sm" id="KSS" value="စီးရီးစုံခွပူး" style="width: 100%;">
                    </td>
                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="KSM" value="စီးရီးမခွပူး" style="width: 100%;">
                    </td>  
                     <td>
                      <input type="button" class="btn btn-info btn-sm" id="B" value="ဘရိတ်" style="width: 100%;">
                    </td>

                </tr>
               


              </table>

             
            
        </td>      
       </tr>
        <!-- End Buttons -->      
       
    
     

     <!--  <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr> -->

      </form>
    </tbody>
    </table>


  </div>

</div>
</div>
</div>
<!-- End Keyboard -->



<script>
$(document).ready(function()
{

     $("#keyboard").change(); 

   // keyboard change
    $("#keyboard").change(function()
    {

      
      var keyboard      = $('#keyboard').val();

      //alert(user_id + " " + view);
    
      if(keyboard)
      {
        $.ajax(
            {
                type:   "GET",
                url:  "{{ url('saveKeyboard') }}?keyboard="+keyboard,
                                             
                dataType: 'json',             
                success:function(res)
                {                                                   

                }
            } 
            );

       
    }

     
    });
    // End keyboard change

   // name change
    $("#name").change(function()
    {
     

      var name       = $('#name').val(); 
      var duration   = $('#duration').val();   
      
      
      if(name)
      {
        $.ajax(
            {
                type:   "GET",
                url:  "{{ url('getWorkFile') }}?name="+name
                                              +"&duration="+duration,
                dataType: 'json',             
                success:function(res)
                {                                                   
                    if(res)
                    {
                        var html = '';

                        for(var count = 0; count < res.length; count++)
                        {
                         
                            html += '<option  value="'+res[count].id+'" >'+ res[count].name + ' ' + res[count].duration + ' [' + res[count].date + ']' +'</option>'; 
                                                 
                          
                        }

                        $("#work_file_id").html(html);                        
                        $('#work_file_id').change();
                       
                    }
                }
            } 
           );       
      }

     
    });
    // End name change


    // duration change
    $("#duration").change(function()
    {
     

      var name       = $('#name').val(); 
      var duration   = $('#duration').val();   
      
      
      if(name)
      {
        $.ajax(
            {
                type:   "GET",
                url:  "{{ url('getWorkFile') }}?name="+name
                                              +"&duration="+duration,
                dataType: 'json',             
                success:function(res)
                {                                                   
                    if(res)
                    {
                        var html = '';

                        for(var count = 0; count < res.length; count++)
                        {
                         
                            html += '<option  value="'+res[count].id+'" >'+ res[count].name + ' ' + res[count].duration + ' [' + res[count].date + ']' +'</option>'; 
                                                 
                          
                        }

                        $("#work_file_id").html(html);                        
                        $('#work_file_id').change();
                        
                    }
                }
            } 
           );       
      }

     
    });
    // End duration change


    $("#work_file_id").change(function()
    {
      $('#btnshow').click();
    });  
   
    
});
</script>   


@endsection