@extends('layouts.app')
@section('content')

<style type="text/css">
  #panel3
  {
    display: none;
  }
</style>

<script>
    $(document).ready( 
              function()
              {

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
                                  }
                                );

                $("#SN").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit = "S" + digit;

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );

                $("#NSR").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "SR";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );

                $("#NM").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "M";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );

                $("#MN").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit = "M" + digit;

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );

                $("#NMR").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "MR";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );


                $("#SS").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "SS";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );
                $("#MM").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "MM";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );
                $("#SM").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "SM";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );
                $("#MS").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "MS";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );

                $("#SP").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "SP";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );

                $("#MP").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "MP";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );

                $("#PP").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "PP";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
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
                                  }
                                );

                $("#KT").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "KT";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );

                $("#D").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "D";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );

                $("#DS").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "DS";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
                                  }
                                );

                $("#DM").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "DM";

                                    $("#digit").val(digit);
                                    $("#digit").focus();
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


                $("#sale_off").click( function()
                                  {
                                    if ($('#sale_off').is(":checked"))
                                      {
                                        $('#file').val(0);
                                        $('#max').val(0);
                                      }
                                    else
                                    {
                                      $('#file').val(100);
                                      $('#max').val(0);
                                    }
                                    
                                    
                                  }
                                );


                // $("#digit").keypress(function( event ) 
                //             {
                //               if ( event.which == 13 ) 
                //               {
                //                  event.preventDefault();                                 
                //                  $("#file").focus();
                //               }
                             
                //             });

                $("#file").keypress(function( event ) 
                            {
                              if ( event.which == 13 ) 
                              {
                                 event.preventDefault(); 
                                 
                                 var file = $("#file").val();
                                 var max = 100 - file;
                                 $("#max").val(max);

                                 $("#max").focus();
                              }
                             
                            });



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
            2D Digit Permission List
        </div>

      
                <table class="table table-striped table-sm header-fixed">        
                <tbody>
                  <form method="get" action="{{ url("/digitpermission/add/{$work_file_id}") }}" enctype="multipart/form-data">
                  {{ csrf_field() }}

                    <input type="text" name="select_work_file_id" id="select_work_file_id"  value="{{$work_file_id}}" hidden >
                    <input type="text" name="select_user_id"      id="select_user_id"       value="{{$select_user_id}}" hidden >
                    <input type="text" name="select_customer_id"  id="select_customer_id"   value="{{$select_customer_id}}" hidden >
                   
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

                  <tr>
          
                      <td>
                        <div class="form-group">
                            <label>User</label> <br>
                            <select name="user_id" id="user_id" class="form-control" >
                            @foreach($users as $user)
                              <option value="{{ $user->id }}" @if($user->id == $select_user_id) selected @endif >
                                {{ $user->name }}
                              </option>
                            @endforeach
                          </select>
                        </div>
                      </td>        

                      <td>
                        <div class="form-group">
                            <label>Customer</label> <br>
                            <select name="customer_id" id="customer_id" class="form-control" >                  
                            @foreach($customers as $customer)
                              <option value="{{ $customer->id }}" @if($customer->id == $select_customer_id) selected @endif>
                                {{ $customer->name }}
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
                        <th>User</th>
                        <th>Customer</th>

                        <th>Digit</th>
                        <th>Type</th> 
                
                      </tr>

                  </thead>
                  <tbody>
                      
                      <?php
                          $col_type     = "";                        
                          $no = 1;
                       ?>
                      @foreach($old_permissions as $digit_permission)                     
                      
                      <tr>
                         
                          <td>{{ $digit_permission->user_id }}</td>
                          <td>{{ $digit_permission->customer_id }}</td>
                          

                          <td> {{ $digit_permission->digit }} </td>

                          @if($digit_permission->type != $col_type)
                            <td>{{ $digit_permission->type }}</td>
                           
                          @else
                            <td></td>
                           
                          @endif


                        
                      </tr>
                      <?php 
                        
                        $col_type     = $digit_permission->type;
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



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-2">
            <div class="card border-secondary">

                <div class="card-header">
                  New Digit Permission
                </div>
              
                  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; User: {{ $user_name }}</span>
                      <span class="card-text">Customer: {{ $customer_name }} &nbsp;</span>
                  </div>
                                  
                  <table class="table1 table-sm header-fixed">
                  <thead>
                      <tr>
                       <th>User</th>
                        <th>Customer</th>

                        
                        <th>Digit</th>
                        <th>Type</th>
                                     
                        <th>Type Delete</th>
                        <th>Delete</th>   
               
                      </tr>
                  </thead>
                  <tbody>
                      
                      <?php
                          $col_type     = "";                        
                          $no = 1;
                       ?>
                      @foreach($new_permissions as $digit_permission)                     
                      
                      <tr>
                         
                          <td>{{ $digit_permission->user_id }}</td>
                          <td>{{ $digit_permission->customer_id }}</td>

                          

                          <td> {{ $digit_permission->digit }} </td>

                          @if($digit_permission->type != $col_type)
                            <td>{{ $digit_permission->type }}</td>
                           
                          @else
                            <td></td>
                           
                          @endif

                    

                           @if($digit_permission->type != $col_type)
                            
                            <td><a href="{{ url("/digitpermission/deltype/{$work_file_id}/{$digit_permission->type}") }}" class="btn btn-danger btn-sm" >Type Delete</a></td>
                          @else
                           
                            <td></td>
                          @endif


                          <td>                          

                            <a href="{{ url("/digitpermission/del/{$digit_permission->id}") }}" class="btn btn-danger btn-sm" >Delete</a>                         
                            

                          </td>

                          

                        
                      </tr>
                      <?php 
                        
                        $col_type     = $digit_permission->type;
                        $no++;
                       
                      ?>
                      @endforeach


                      <tr style="border: 1px solid black;">  
                         
                          <td colspan="4">                       
                          
                                                                                 
                          <a class="form-control btn btn-primary btn-sm" href="{{ url("/digitpermission/confirm/{$work_file_id}") }}"> 
                            Save Digit
                          </a>
                            
                                               
                          </td>

                          <td colspan="3">                       
                          
                                                                                 
                            <a class="form-control btn btn-danger btn-sm" href="{{ url("/digitpermission/delall/{$work_file_id}") }}"> 
                            Delete All 
                            </a>
                            
                                               
                          </td>

                          
                      </tr>
                    
                  </tbody>
                </table>



               
              
                  
              
                
               </div>
            </div>
        <!-- </div> -->
    </div>
</div>

  

    
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-2">

   

            <div class="card border-secondary">
               

    <table class="table table-sm">
        
    <tbody>
      <form method="post" enctype="multipart/form-data" > 

      {{ csrf_field() }}

        <input type="text" name="w_id" id="w_id"  value="{{$work_file_id}}" hidden>
         
        <tr>

          <td colspan="2">
            <div class="form-group">
              <label>Digit</label>
              <input type="text" name="type" id="digit" class="form-control" autofocus autocomplete="off">
            </div>
          </td>

       

        </tr>

      
      

      <!-- Buttons -->
        <tr>

          <td ><input type="submit" value="Add" class="btn btn-primary btn-sm" hidden ></td>

          
          <td >
            <div id="header3">
              <input type="button" value="More..." class="btn btn-primary btn-sm" hidden >
            </div>
          </td>


              <table class="table table-default" id="panel3">
                <tr>                 
                    <!-- <td>                      
                        <input type="button" class="btn btn-primary btn-sm" id="D" value="ဒဲ့" style="width: 100%;">
                    </td> -->
                    <td>                                          
                        <input type="button" class="btn btn-primary btn-sm" id="R" value="ပတ်လည်" style="width: 100%;">
                    </td> 
                     <td>
                      <input type="button" class="btn btn-primary btn-sm" id="T" value="ထိပ်" style="width: 100%;">
                    </td>                   
               
                    <td>
                      <input type="button" class="btn btn-primary btn-sm" id="N" value="ပိတ်" style="width: 100%;">
                    </td>
                                     
                </tr>
                <tr>
                    <td>
                      <input type="button" class="btn btn-primary btn-sm" id="NS" value="နောက်စုံ" style="width: 100%;">
                    </td>
                    <td>
                      <input type="button" class="btn btn-primary btn-sm" id="SN" value="ရှေ့စုံ" style="width: 100%;">
                    </td>
                    <td>
                      <input type="button" class="btn btn-primary btn-sm" id="NSR" value="စုံကပ်လည်" style="width: 100%;">
                    </td>
                </tr>
                <tr>
                    <td>
                      <input type="button" class="btn btn-primary btn-sm" id="NM" value="နောက်မ" style="width: 100%;">
                    </td>
                    <td>
                      <input type="button" class="btn btn-primary btn-sm" id="MN" value="ရှေ့မ" style="width: 100%;">
                    </td>
                    <td>
                      <input type="button" class="btn btn-primary btn-sm" id="NMR" value="မကပ်လည်" style="width: 100%;">
                    </td>
                </tr>


                <tr> 
                    <td>
                      <input type="button" class="btn btn-primary btn-sm" id="SS" value="စုံစုံ" style="width: 100%;">
                    </td> 
                     <td>
                      <input type="button" class="btn btn-primary btn-sm" id="MM" value="မမ" style="width: 100%;">
                    </td>               
                     <td>
                      <input type="button" class="btn btn-primary btn-sm" id="SM" value="စုံမ" style="width: 100%;">
                    </td>
                    
                   
                </tr>

                <tr>                 
                     <td>
                      <input type="button" class="btn btn-primary btn-sm" id="SP" value="စုံပူး" style="width: 100%;">
                    </td>
                    <td>
                      <input type="button" class="btn btn-primary btn-sm" id="MP" value="မပူး" style="width: 100%;">
                    </td>
                    <td>
                      <input type="button" class="btn btn-primary btn-sm" id="PP" value="အပူး" style="width: 100%;">
                    </td>
                    
                </tr>
                <tr> 
                    <td>
                      <input type="button" class="btn btn-primary btn-sm" id="PW" value="ပါဝါ" style="width: 100%;">
                    </td>                
                     <td>
                      <input type="button" class="btn btn-primary btn-sm" id="NK" value="နက္ခတ်" style="width: 100%;">
                    </td>
                    <td>
                      <input type="button" class="btn btn-primary btn-sm" id="TK" value="သေးကြီး" style="width: 100%;">
                    </td> 
                                  
                </tr>
                <tr>
                  <td>
                      <input type="button" class="btn btn-primary btn-sm" id="D" value="ဆယ်ပြည့်" style="width: 100%;">
                    </td>
                    <td>
                      <input type="button" class="btn btn-primary btn-sm" id="DS" value="စုံဆယ်ပြည့်" style="width: 100%;">
                    </td>
                    <td>
                      <input type="button" class="btn btn-primary btn-sm" id="DM" value="မဆယ်ပြည့်" style="width: 100%;">
                    </td>
                </tr>
                <tr>
                  <td>
                      <input type="button" class="btn btn-primary btn-sm" id="BR" value="ညီနောင်" style="width: 100%;">
                    </td>
                   
                   <td>
                      <input type="button" class="btn btn-primary btn-sm" id="Round" value="အပါ" style="width: 100%;">
                    </td>   

                     <td>
                      <input type="button" class="btn btn-primary btn-sm" id="MS" value="မစုံ" style="width: 100%;">
                    </td>

                </tr>
                <tr>
                     <td>
                      <input type="button" class="btn btn-primary btn-sm" id="KT" value="ကြီးသေး" style="width: 100%;">
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



<script>
$(document).ready(function()
{

       
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
      $('#select_work_file_id').val( $("#work_file_id").val());
      $('#w_id').val( $("#work_file_id").val());

      $('#btnshow').click();
    });  
   
    $("#user_id").change(function()
    {
      $('#select_user_id').val( $("#user_id").val());
       $('#btnshow').click();
    });  

     $("#customer_id").change(function()
    {
      $('#select_customer_id').val($("#customer_id").val());
       $('#btnshow').click();
    });  

    
});
</script>   

@endsection