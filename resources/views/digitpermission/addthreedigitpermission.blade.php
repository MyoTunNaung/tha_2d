<?php 

  use App\Choice; 
  use App\User;
  
?>


@extends('layouts.app')
@section('content')

<style type="text/css">
  #panel3
  {
    display: block;
  }
</style>

<script>
    $(document).ready( 
              function()
              {
                //for header3 and panel3
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

                  $("#digit").keypress(function( event ) 
                            {
                              if ( event.which == 13 ) 
                              {
                                 event.preventDefault();                                 
                                 $("#digit_percent").select().focus();
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
            ဂဏန်း ကန့်သတ်ချက်များ
        </div>

      
                <table class="table table-striped table-sm header-fixed">        
                <tbody>
                  <form method="get" action="{{ url("/digitpermission/add/{$work_file_id}") }}" enctype="multipart/form-data">

                  {{ csrf_field() }}

           
                  <tr>
                    <td colspan="2">
                      <div class="form-group">
                          <label>ပွဲစဉ်ဇယား</label> <br>
                          <select name="work_file_id" id="work_file_id" class="form-control" >                             
                          @foreach($work_files as $work_file)
                            <option value="{{ $work_file->id }}" @if($work_file->id == $work_file_id) selected @endif>
                              {{ $work_file->name ." ".$work_file->duration." [ ". $work_file->date ." ] "}}
                            </option>
                          @endforeach
                        </select>
                      </div>
                    </td>
                 
                    
                      <td>
                        <div >
                            <label>User</label> <br>
                            <select name="user_id" id="user_id"  class="form-control">                            
                              <option value="0" @if($user_id =="0") selected @endif> All </option>
                            @foreach($users as $user)
                              <option value="{{ $user->id }}" @if($user->id == $user_id) selected @endif>
                                {{ $user->name }}
                              </option>
                            @endforeach
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
                  <table class="table table-striped table-sm header-fixed">

                  <thead>
                     
                      <tr>
                        <th>User</th>
                                         
                        <th>Digit</th>
                        <th>Type</th>

                        <th>Percent</th>
                       <!--  <th>TypeSale</th> -->
                                     
                        <th>Del</th>
                        <th>Del</th>   
                
                      </tr>

                  </thead>
                  <tbody>
                      
                      <?php
                          $col_type     = "";
                          $col_name     = "";                        
                          $no = 1;

                          $old_last_id = 0;
                       ?>
                      @foreach($old_permissions as $digit_permission)                     
                      
                      <tr>
                         
                           @if($digit_permission->user_id == 0)
                            <td>All</td>
                           @else

                              <?php 

                                $user_name = User::where('id','=',$digit_permission->user_id)->value('name');
                             ?>

                              @if($user_name != $col_name) 
                                <td>{{ $user_name }}</td>
                              @else
                                <td></td>  
                              @endif

                           @endif
                        
                          

                          <td> {{ $digit_permission->digit }} </td>

                          @if($digit_permission->type != $col_type)
                            <td>{{ $digit_permission->type }}</td>
                           
                          @else
                            <td></td>
                           
                          @endif

                           <td> {{ $digit_permission->digit_percent }} % </td>

                         <!--  <td> {{ $digit_permission->type_sale }} </td> -->


                          @if($digit_permission->type != $col_type)
                            
                            <td>
                              <a href="{{ url("/digitpermission/typedel/{$digit_permission->id}") }}" class="btn btn-outline-danger btn-sm" >
                                  <i class="fa fa-trash" aria-hidden="true" style="font-size: 16px;"></i>
                              </a>
                          </td>
                          @else
                           
                            <td></td>
                          @endif


                          <td>                          

                            <a href="{{ url("/digitpermission/del/{$digit_permission->id}") }}" class="btn btn-outline-danger btn-sm" >
                                <i class="fa fa-trash" aria-hidden="true" style="font-size: 10px;"></i>
                            </a>                         
                            

                          </td>


                        
                      </tr>
                      <?php 
                        
                        $col_type     = $digit_permission->type;
                        $col_name     = $user_name;
                        $no++;

                        $old_last_id = $digit_permission->id;
                       
                      ?>
                      @endforeach

                      <tr>
                           <td colspan="7" style="text-align: center;">                          

                            <a href="{{ url("/digitpermission/alldel/{$old_last_id}") }}" class="btn btn-danger btn-sm" >Delete All</a>                         
                            

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

    <div class="card-header">ဂဏန်း ကန့်သတ်ချက် အသစ်များ</div>


        <div class="d-flex justify-content-between align-items-center">
            <span class="card-text"> &nbsp; User: {{ $user_name }}</span>                    
        </div>
                                  
      
            <table class="table table-sm">
                
            <tbody>
              <form method="post" enctype="multipart/form-data">

              {{ csrf_field() }}

                <input type="text" name="w_id" id="w_id"  value="{{ $work_file_id }}" hidden>
                <input type="text" name="u_id" id="u_id"  value="{{ $user_id }}" hidden>

                <tr>
                    <td colspan="2"> ထိုးသားအမည် : [ {{ $user_name }} ]</td>  
                </tr>

                <tr>

                  <td>
                    <div class="form-group">
                      <label>Digit</label>
                      <input type="text" name="type" id="digit" class="form-control" autofocus autocomplete="off">
                    </div>
                  </td> 

                   <td>
                    <div class="form-group">
                      <label>Digit Percent</label>
                      <input type="number" name="digit_percent" id="digit_percent" value="100" class="form-control" autofocus autocomplete="off">
                    </div>
                  </td>    


                  <!-- <td>
                      <div class="form-group">
                       <label>Type Sale</label>
                        <select name="type_sale"  id="type_sale" class="form-control">
                            <option value="On"  @if($type_sale == "On") selected @endif>On</option>
                            <option value="Off" @if($type_sale == "Off") selected @endif>Off</option>
                        </select>
                      </div>
                  </td> -->
                  
                </tr>

              <tr>

                  <td><input type="submit" value="သိမ်းရန် " class="btn btn-primary btn-sm" ></td>

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

                  <td>                     


                    <div id="header3">
                      <input type="button" value="More..." class="btn btn-primary btn-sm" hidden>
                    </div>
                  </td>


      </div>


</div>
</div>
</div>

<script>
  
 // name change
  $("#work_file_id").change(function()
  {

    $("#btnShow").click();
   
  });

 // User Change
  $("#user_id").change(function()
  {    

    $("#btnShow").click();

  });
 
</script>   
   

@endsection