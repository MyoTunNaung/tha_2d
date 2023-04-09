<?php 

  use App\Choice;
  
  $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');  

  $refer_user_id  = 1;

?>


@extends('layouts.app')
@section('content')


<script>
$(document).ready( 
  function()
  {

                                  
    $("#name").keypress(function( event ) 
                            {
                              if ( event.which == 13 ) 
                              {
                                 event.preventDefault();
                                
                                  $("#password").focus();
                              }
                             
                            });
                          
  }
);
</script>


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



<div class="container">
<div class="row justify-content-center">
<div class="col-md-6 col-md-offset-2">

      <div class="card border-secondary">

            <div class="card-header"> 
              အမည်စာရင်းများ
            </div>
              
                <table class="table table-sm header-fixed">
                  <thead>
                      <tr>
                          
                        <th>စဉ်</th> 
                        <th>အမည်</th>

                        <th>Type</th>

                        <th>Password</th>

                        <th>Change</th>

                        <th>Delete</th>  
               
                      </tr>
                  </thead>
                  <tbody>

                    <?php $count=1; ?>

                  @foreach($users as $user)


                  <tr>
                      <td>{{ $count }}</td>

                      <td>{{ $user->name }}</td>

                      @if( $user->in_out == 1 && $user->type == "User")
                        <td>အကောင့်</td>  
                      @elseif($user->in_out == 1 && $user->type == "Customer")
                        <td>ထိုးသား</td>
                      @elseif($user->in_out == 2 && $user->type == "Customer")
                        <td>တင်ဒိုင်</td>
                      @endif

                      <td>
                          {{ $user->pass }}
                      </td>
                      <td> 
                          <a href="{{ url("/user/upd/{$user->id}") }}" class="btn btn-primary btn-sm">
                            Change
                          </a> 
                      </td>
                      
                      <td>
                        @if($user->id != 1 and $user->id != 2)

                        <a href="{{ url("/user/del/{$user->id}") }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?') && confirm('Are you ready?') && confirm('Can not get back?')">Delete</a>
                        
                        @endif

                      </td>
                        
                  </tr>

                      <?php $count++; ?>
                  @endforeach
                    
                  </tbody>
                </table>
                
    </div>

</div>
</div>
</div>


<br>

<div class="container">
<div class="row justify-content-center">
<div class="col-md-6 col-md-offset-2">

    <div class="card border-secondary">

        <div class="card-header">

            
            <button name="user" id="user">အကောင့်ဖွင့်ရန်</button>
            <button name="customer" id="customer">ထိုးသား/တင်ဒိုင် </button>


        </div>

              <table class="table table-sm">
                  
              <tbody>
                <form method="post" enctype="multipart/form-data">

                {{ csrf_field() }}

                <input type="text" name="type" id="type" class="form-control" autocomplete="off" value="User">

                 <tr>                  
                  <td colspan="2">

                      <div class="form-group">                        
                       <select name="in_out" id="in_out" class="form-control">
                          <option value="1" selected>IN</option>
                          <option value="2" >OUT</option>
                        </select>
                      </div>
                  </td>
                </tr>

                <tr>
                  <td colspan="2">
                    <label>Refer User</label>
                     <select name="refer_user_id" id="refer_user_id"  style="width: 100px;">                                              
                      @foreach($users as $user)
                        <option value="{{ $user->id }}" @if($user->id == $refer_user_id) selected @endif>
                          {{ $user->name }}
                        </option>
                      @endforeach
                    </select>
                  </td>
                </tr>

                <tr>
                    <td>
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" id="name" class="form-control" autocomplete="off">
                      </div>
                    </td>

                    <td>
                      <div class="form-group">
                        <label id="lbl_password">Password</label>
                        <input type="text" name="password" id="password" class="form-control" autocomplete="off">
                      </div>
                    </td>
                </tr>

               

             
     
                <tr>

                    <td>
                      <div class="form-group">
                        <label>2D ကော်</label>
                        <input type="number" name="twod_comm" class="form-control" value="15">
                      </div>
                    </td>

                    <td>
                      <div class="form-group">
                        <label>2D အလျော်အဆ</label>
                        <input type="number" name="twod_times" class="form-control" value="80">
                      </div>
                    </td>
                    
                  </tr>  

                  <tr>                    

                      <td>
                      <div class="form-group">
                        <label for="twod_hotpercent" id="lbl_threed_hotpercent">2D Hot ဂဏန်းခွဲတမ်း</label>
                        <input type="number" name="twod_hotpercent" id="twod_hotpercent" class="form-control" value="0">
                      </div>
                      </td>
                 
                        
                     <td>
                      <div class="form-group">
                        <label for="twod_status" id="lbl_twod_status">2D ကစားခွင့်</label>
                        <select name="twod_status" id="twod_status" class="form-control">
                          <option value="0">0</option>
                          <option value="1" selected>1</option>
                        </select>
                      </div>
                    </td> 

                  </tr>

                 <!--  <tr>                    

                      <td>
                      <div class="form-group">
                        <label for="onebet_times" id="lbl_onebet_times">လုံးပါ အလျော်အဆ</label>
                        <input type="number" name="onebet_times" id="onebet_times" class="form-control" value="3">
                      </div>
                      </td>
                 
                       <td>
                      <div class="form-group">
                        <label for="position_times" id="lbl_position_times">အထိုင် အလျော်အဆ</label>
                        <input type="number" name="position_times" id="position_times" class="form-control" value="6">
                      </div>
                      </td>
                        
                    

                  </tr> -->

                 <!--  <tr>                    

                     
                       <td>
                      <div class="form-group">
                        <label for="twobet_times" id="lbl_twobet_times">အတွဲ အလျော်အဆ</label>
                        <input type="number" name="twobet_times" id="twobet_times" class="form-control" value="10">
                      </div>
                    </td> 
                        
                     <td>
                      <div class="form-group">
                        <label for="position_comm" id="lbl_position_comm">လုံးပါ ကော်</label>
                        <input type="number" name="position_comm" id="position_comm" class="form-control" value="10">
                      </div>
                    </td> 

                  </tr> -->

                  <tr>

                 <!--  <td>
                    <div class="form-group">
                      <label id="lbl_open_time">Open Time</label>
                      <input type="time" name="open_time" id="open_time" class="form-control" value="09:35">
                    </div>
                  </td> -->

                  <td>
                    <div class="form-group">
                      <label id="lbl_close_time">Close Time</label>
                      <input type="time" name="close_time" id="close_time" class="form-control" value="15:45">
                    </div>
                  </td>

                </tr>


                 

                <tr>

                  <td>
                    <input type="submit" value="သိမ်းရန်" class="btn btn-primary btn-sm">
                  </td>

                  <td>
                  <?php

                  if(Choice::where([ 
                                    ['auth_id','=',auth()->user()->id],
                                    ['work_file_id','!=',null],
                                  ])->exists())
                  {
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
                <?php } ?>

                </td>
                </tr>
                    
                </form>
              </tbody>
              </table>

    </div>

     <?php

        if(!Choice::where([ 
                          ['auth_id','=',auth()->user()->id],
                          ['work_file_id','!=',null],
                        ])->exists())
        {
      ?>

    <div class="d-flex justify-content-end align-items-end">
                      
        <span class="card-text">
            <a href="{{ url("/") }}" class="btn btn-primary btn-sm" >
               Back
            </a>
        </span>

    </div> 
     <?php } ?>

</div>
</div>
</div>


<script>
$(document).ready( 
  function()
  {
                              
    $("#name").select().focus();

    $("#user").click();


                          
  }
);
</script>


<script >

   $("#customer").click( function()
                                  {
                                    
                                    $("#lbl_twod_hotpercent").show();
                                    $("#lbl_twod_status").show();

                                    $("#twod_status").show();
                                    $("#twod_hotpercent").show();


                                    $("#in_out").show();

                                    $("#lbl_password").hide();
                                    $("#password").val("*");
                                    $("#password").hide();
                                    
                                    $("#type").val("Customer");
                                    $("#type").hide();

                                    $("#lbl_open_time").hide();
                                    $("#lbl_close_time").hide();                                    
                                    $("#open_time").hide();
                                    $("#close_time").hide();

                                  }
                                );

   $("#user").click( function()
                                  {

                                    $("#lbl_twod_hotpercent").show();
                                    $("#lbl_twod_status").show();
                                    
                                    $("#twod_status").show();
                                    $("#twod_hotpercent").show();
                                   
                                    $("#in_out").hide();

                                    $("#lbl_password").show();
                                    $("#password").val("");
                                    $("#password").show();

                                    $("#type").val("User");
                                    $("#type").hide();

                                    $("#lbl_open_time").show();
                                    $("#lbl_close_time").show();                                    
                                    $("#open_time").show();
                                    $("#close_time").show();

                                   
                                  }
                                );

</script>




@endsection