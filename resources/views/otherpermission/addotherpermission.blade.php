<?php 
use App\User;
 ?>

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


                $("#digit_amount").keypress(function( event ) 
                            {
                              if ( event.which == 13 ) 
                              {
                                 event.preventDefault();                                 
                                 $("#total_amount").select().focus();
                              }
                             
                            });

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
            ထိုးကြေး ကန့်သတ်ချက်များ
        </div>

      
                <table class="table table-striped table-sm header-fixed">        
                <tbody>
                  <form method="get" action="{{ url("/otherpermission/add/{$work_file_id}") }}" enctype="multipart/form-data">
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
                        <div class="form-group">
                            <label>User</label> <br>
                            
                            <select name="user_id" id="user_id" class="form-control" >
                              <option value="0" @if($user_id =="0") selected @endif> All </option>
                            @foreach($users as $user)
                              <option value="{{ $user->id }}" @if($user->id == $user_id) selected @endif >
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
               
                        <th>၁ ကွက်</th>
                        <th>စုစုပေါင်း</th> 
                        <th>အထူး</th>
                       <!--  <th>အကွက်</th>
                        <th>အကျွံ</th>
 -->
                                                   
                        <th>Del</th>
                      
                    
               
                      </tr>
                  </thead>
                  <tbody>
                      
                     
                      @foreach($old_permissions as $digit_permission)                     
                      

                      <tr>
                         
                          @if($digit_permission->user_id == 0)
                            <td>All</td>
                           @else
                              <?php 
                                $user_name = User::where('id','=',$digit_permission->user_id)->value('name');
                             ?>
                              <td>{{ $user_name }}</td>
                           @endif   
                                                 

                          <td> {{ $digit_permission->digit_amount }} </td>
                          <td> {{ $digit_permission->total_amount }} </td>
                          <td> {{ $digit_permission->special_amount }} </td>

                          <!--  <td> {{ $digit_permission->file }} </td>
                          <td> {{ $digit_permission->max }} </td> -->


                        
                          <td>                          

                            <a href="{{ url("/otherpermission/del/{$digit_permission->id}") }}" class="btn btn-outline-danger btn-sm" >
                                <i class="fa fa-trash" aria-hidden="true" style="font-size: 10px;"></i>
                            </a>                         
                            

                          </td>


                      </tr>

                                           
                      @endforeach

                       <tr>
                           <td colspan="7" style="text-align: center;">                          

                            <a href="{{ url("/otherpermission/delall/{$work_file_id}") }}" class="btn btn-danger btn-sm" >All Delete</a>                         
                            

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
                 ထိုးကြေးကန့်သတ်ချက် အသစ်များ
                </div>
              
                  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; User: {{ $user_name }}</span>                     
                  </div>
           
                <table class="table table-sm">
        
                  <tbody>
                    <form method="post" enctype="multipart/form-data" > 

                    {{ csrf_field() }}

                      <input type="text" name="w_id" id="w_id"  value="{{$work_file_id}}" hidden >
                      <input type="text" name="u_id" id="u_id"  value="{{$user_id}}" hidden >
                   
                     

                      <tr>

                        <td >
                          <div class="form-group">
                            <label> ၁ကွက် ထိုးကြေး</label>
                            <input type="number" name="digit_amount" id="digit_amount" class="form-control" autofocus autocomplete="off" value="0">
                          </div>
                        </td>

                        <td >
                          <div class="form-group">
                            <label>ထိုးကြေး စုစုပေါင်း</label>
                            <input type="number" name="total_amount" id="total_amount" class="form-control" autofocus autocomplete="off" value="0">
                          </div>
                        </td>

                      </tr>

                     <!--  <tr>

                        <td >
                          <div class="form-group">
                            <label>File</label>
                            <input type="number" name="file" id="file" class="form-control" autofocus autocomplete="off" value="100">
                          </div>
                        </td>

                        <td >
                          <div class="form-group">
                            <label>Max</label>
                            <input type="number" name="max" id="max" class="form-control" autofocus autocomplete="off" value="0">
                          </div>
                        </td>

                      </tr> -->

                      <tr>
                      <td >
                          
                            <label> အထူးခွင့်ပြု ထိုးကြေး</label>
                            <input type="number" name="special_amount" id="special_amount"  autofocus autocomplete="off" value="0">
                         
                        </td>
                     </tr>

                      <tr>
                          <td style="text-align: center;">
                            
                            <div class="form-group">    
                                                      
                              <input type="submit" value="သိမ်းရန်" class="btn btn-primary btn-sm" class="form-control">

                              

                            </div>

                                                       
                             
                                  

                        </td>

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

                      <tr >
                          
                      </tr>

                    <!-- Buttons -->
                      <tr>

                        

                        
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

<script>

$(document).ready(function() {

  $("#digit_amount").select().focus();

});
            
</script>

@endsection