<?php 

    use App\Choice;
    
 ?>

@extends('layouts.app')
@section('content')

<style type="text/css">
  #panel3
  {
    display: none;
  }
  .btn-info 
  {
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

  if(digit.length < 3)
  {
    $("#digit").val(digit);

    

  } 

  else if(digit.length == 3)
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

 
  if(digit.length > 3 || digit == "")
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

                $("#keyboard").change();

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

                $("#R").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "R";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );
                $("#T").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "T";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );
                $("#N").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "N";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );

                $("#Round").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "R";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );

                $("#NS").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "S";

                                    $("#digit").val(digit);
                                    $("#digit").focus();

                                    $("#header3").click();
                                  }
                                );

                $("#SN").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit = "S" + digit;

                                    $("#digit").val(digit);
                                    $("#digit").focus();

                                    $("#header3").click();
                                  }
                                );

                $("#NSR").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "SR";

                                    $("#digit").val(digit);
                                    $("#digit").focus();

                                    $("#header3").click();
                                  }
                                );

                $("#NM").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "M";

                                    $("#digit").val(digit);
                                    $("#digit").focus();

                                    $("#header3").click();
                                  }
                                );

                $("#MN").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit = "M" + digit;

                                    $("#digit").val(digit);
                                    $("#digit").focus();

                                    $("#header3").click();
                                  }
                                );

                $("#NMR").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "MR";

                                    $("#digit").val(digit);
                                    $("#digit").focus();

                                    $("#header3").click();
                                  }
                                );


                $("#SS").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "SS";

                                    $("#digit").val(digit);
                                    $("#digit").focus();

                                    $("#header3").click();
                                  }
                                );
                $("#MM").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "MM";

                                    $("#digit").val(digit);
                                    $("#digit").focus();

                                    $("#header3").click();
                                  }
                                );
                $("#SM").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "SM";

                                    $("#digit").val(digit);
                                    $("#digit").focus();

                                    $("#header3").click();
                                  }
                                );
                $("#MS").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "MS";

                                    $("#digit").val(digit);
                                    $("#digit").focus();

                                    $("#header3").click();
                                  }
                                );

                $("#SP").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "SP";

                                    $("#digit").val(digit);
                                    $("#digit").focus();

                                    $("#header3").click();
                                  }
                                );

                $("#MP").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "MP";

                                    $("#digit").val(digit);
                                    $("#digit").focus();

                                    $("#header3").click();
                                  }
                                );

                $("#PP").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "PP";

                                    $("#digit").val(digit);
                                    $("#digit").focus();

                                    $("#header3").click();
                                  }
                                );

                $("#PW").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "PW";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );

                $("#NK").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "NK";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );

                $("#TK").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "TK";

                                    $("#digit").val(digit);
                                    $("#digit").focus();

                                    $("#header3").click();
                                  }
                                );

                $("#KT").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "KT";

                                    $("#digit").val(digit);
                                    $("#digit").focus();

                                    $("#header3").click();
                                  }
                                );

                $("#D").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "D";

                                    $("#digit").val(digit);
                                    $("#digit").focus();

                                    $("#header3").click();
                                  }
                                );

                $("#DS").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "DS";

                                    $("#digit").val(digit);
                                    $("#digit").focus();

                                    $("#header3").click();
                                  }
                                );

                $("#DM").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "DM";

                                    $("#digit").val(digit);
                                    $("#digit").focus();

                                    $("#header3").click();
                                  }
                                );

                $("#BR").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "BR";

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

<!-- <h1>Here</h1> -->

<!-- Filter & Show -->
<div class="container">
<div class="row justify-content-center">
<div class="col-md-6 col-md-offset-2">
          
    <div class="card border-secondary">

        <div class="card-header">
            Hot List
        </div>

      
                <table class="table table-striped table-sm header-fixed">        
                <tbody>
                  <form method="get" action="{{ url("/hot/list/show") }}" enctype="multipart/form-data">
                  {{ csrf_field() }}

                   
                    <tr>
                      <td>
                        <div class="form-group">
                            <label>Name</label> <br>
                            <select name="name" id="name" class="form-control" >
                              <option value="2D" @if($name =="2D") selected @endif>2D</option>
                              <option value="3D" @if($name =="3D") selected @endif>3D</option>
                          </select>
                        </div>
                      </td> 

                      <td >
                        <div class="form-group">
                            <label>Duration</label> <br>
                            <select name="duration" id="duration" class="form-control" >
                              <option value="AM" @if($duration =="AM") selected @endif>AM</option>
                              <option value="PM" @if($duration =="PM") selected @endif>PM</option>
                          </select>
                        </div>
                      </td>  
                  </tr>


                  <tr>
                    <td colspan="2">
                      <div class="form-group">
                          <label>Work File</label> <br>
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
                        <th>Del</th> 
                        <th>Type Del</th>                   
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

                          <td><a href="{{ url("/hot/del/{$hot->id}") }}" class="btn btn-danger btn-sm" >Delete</a></td>

                          @if($hot->type != $col_type)
                            <td><a href="{{ url("/hot/typedel/{$hot->id}") }}" class="btn btn-danger btn-sm" >Type Delete</a></td>                         
                          @else
                            <td></td>                       
                          @endif

                        
                      </tr>
                      <?php 
                        
                        $col_type     = $hot->type;
                        $no++;
                       
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

       <!--  <div class="card-header">
            2D New Hot
        </div> -->

            <!-- Show Table -->                 
                 <!--  <table class="table table-striped table-sm header-fixed">
                  <thead>
                      <tr>
                        <th>No</th>                        
                        <th>Digit</th>
                        <th>Type</th>
                        <th>Type Delete</th>                     
                        <th>Delete</th>
                      </tr>
                  </thead>
                  <tbody>
                      
                      <?php
                          $col_type  = "";                        
                          $no        = 1;
                       ?>
                      @foreach($new_hots as $hot)                     
                      
                      <tr>
                         
                          <td>{{ $no }}</td>
                          <td> {{ $hot->digit }} </td>

                          @if($hot->type != $col_type)
                            <td>{{ $hot->type }}</td>
                            <td>
                                <a href="{{ url("/hot/typedel/{$hot->id}") }}" class="btn btn-danger btn-sm" >Type Delete</a>
                            </td>
                          @else
                            <td></td>
                            <td></td>
                          @endif

                          <td>
                            <a href="{{ url("/hot/del/{$hot->id}") }}" class="btn btn-danger btn-sm" >Delete</a>
                          </td>
                        
                      </tr>
                      <?php 
                        
                        $col_type     = $hot->type;
                        $no++;
                       
                      ?>
                      @endforeach


                      <tr style="border: 1px solid black;">  
                         
                          <td colspan="3">
                            <a class="form-control btn btn-primary btn-sm" href="{{ url("/hot/save/{$work_file_id}") }}"> 
                              Save Digit 
                            </a>
                          </td>

                          <td colspan="2">                                       
                            <a class="form-control btn btn-danger btn-sm" href="{{ url("/hot/alldel/{$work_file_id}/{$slip_id}") }}"> 
                              Delete All 
                            </a>                                               
                          </td>
                          
                      </tr>
                    
                  </tbody>
                </table> -->
                  <!-- End Show Table          -->


            <table class="table table-sm">        
            
            <tbody>
            <form method="post" enctype="multipart/form-data" action="{{ url("/hot/add") }}" >

              {{ csrf_field() }}

                <input type="text" name="select_work_file_id" id="select_work_file_id"  value="{{ $work_file_id }}"  hidden>
                <input type="text" name="select_slip_id"      id="select_slip_id"       value="{{ $slip_id }}"  hidden >

                <tr>
                  <td>
                    <div >
                      <label>Digit</label>
                      <input type="text" name="type" id="digit" class="form-control" autofocus autocomplete="off">
                    </div>
                  </td>
                </tr>
            
                
                  <input type="submit" value="Add Hot" id="add_hot" class="btn btn-primary btn-sm" hidden ></td>
               
                  
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

<!-- <h1>Here</h1> -->

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


          <tr>

          <td colspan="3">
          
       
            <input type="text" name="digit_amount" value="0" id="digit_amount" hidden>

           <table class="table1 table-stripped table-sm" style="font-size: 12px;">

                <tr>

                   

                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="PW" value="ပါဝါ" style="width: 100%;">
                    </td>  
                                  
                     <td>
                      <input type="button" class="btn btn-info btn-sm" id="NK" value="နက္ခတ်" style="width: 100%;">
                    </td>
                   
               
                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="BR" value="ညီနောင်" style="width: 100%;">
                    </td>

                    <td >
                      <div id="header3" class="text-center">
                        <input type="button" value="More..." class="btn btn-info btn-sm" style="width: 100%;">
                      </div>
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

                     <td>
                      <input type="button" class="btn btn-info btn-sm"  value="." onclick = "insert('.')" style="width: 100%;font-size: 20px;height:35px; line-height: 35px;" disabled >
                    </td>
                                  
                </tr>

                <tr>                 
                   
                    <td>                                          
                        <input type="button" class="btn btn-info btn-sm"  value="0" onclick = "insert(0)" style="width: 100%;font-size: 20px;">
                    </td> 

                     <td>
                      <input type="button" class="btn btn-info btn-sm"  value="00" onclick = "insert('00')" style="width: 100%;font-size: 20px;" disabled>
                    </td>  

                    <td colspan="2" >
                      <input type="button" class="btn btn-info btn-sm"  value="OK" onclick = "enter()" style="width: 100%;font-size: 18px;">
                    </td>
                                  
                </tr>

           <!-- </div> -->

          </td>
          </tr>
          <!-- End Keypad -->


              <table class="table1 table-stripped table-sm" id="panel3" style="font-size: 12px;">

                <tr>
                  
                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="SN" value="ရှေ့စုံ" style="width: 100%;">
                    </td>

                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="NS" value="နောက်စုံ" style="width: 100%;">
                    </td>

                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="MN" value="ရှေ့မ" style="width: 100%;">
                    </td>

                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="NM" value="နောက်မ" style="width: 100%;">
                    </td>

                    

                </tr>
                
                <tr>
                    
                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="NSR" value="စုံကပ်လည်" style="width: 100%; " >
                    </td>

                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="NMR" value="မကပ်လည်" style="width: 100%; ">
                    </td>

                     <td>
                      <input type="button" class="btn btn-info btn-sm" id="SS" value="စုံစုံ" style="width: 100%;">
                    </td> 
                     <td>
                      <input type="button" class="btn btn-info btn-sm" id="MM" value="မမ" style="width: 100%;">
                    </td>  

                </tr>
               

              
                <tr>
                     <td>
                      <input type="button" class="btn btn-info btn-sm" id="SM" value="စုံမ" style="width: 100%;">
                    </td>

                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="MS" value="မစုံ" style="width: 100%;">
                    </td>

                    
                     <td>
                      <input type="button" class="btn btn-info btn-sm" id="SP" value="စုံပူး" style="width: 100%;">
                    </td>
                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="MP" value="မပူး" style="width: 100%;">
                    </td>
                   
                </tr>

               
                <tr> 
                    
                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="TK" value="သေးကြီး" style="width: 100%;">
                    </td> 

                     <td>
                      <input type="button" class="btn btn-info btn-sm" id="KT" value="ကြီးသေး" style="width: 100%;">
                    </td>   

                     <td>
                      <input type="button" class="btn btn-info btn-sm" id="DS" value="စုံဆယ်ပြည့်" style="width: 100%;">
                    </td>
                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="DM" value="မဆယ်ပြည့်" style="width: 100%;">
                    </td>
                                      
                </tr>

                <tr>
                  <td>
                      <input type="button" class="btn btn-info btn-sm" id="D" value="ဆယ်ပြည့်" style="width: 100%;">
                    </td>
                   
                </tr>
               
              

              </table>

             
            
        </td>      
       </tr>
       

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