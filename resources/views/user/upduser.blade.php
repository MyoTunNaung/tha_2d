<?php 

use App\User;

$user_type = User::where('id','=',$user->id)->value("type");

?>

@extends('layouts.app')
@section('content')


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
            အမည်စာရင်း ပြင်ဆင်ခြင်း
        </div>

              <table class="table table-sm">
                  
              <tbody>
                <form method="post" enctype="multipart/form-data">

                {{ csrf_field() }}

                <tr>
                    <td>
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" id="name" class="form-control" autocomplete="off" value="{{ $user->name }}" disabled>
                      </div>
                    </td>

                    @if($user_type == "User")
                    <td>
                      <div class="form-group">
                        <label>Password ထည့်ပါ</label>
                        <input type="text" name="password" id="password" class="form-control" autocomplete="off" value="{{ $user->pass }}">
                      </div>
                    </td>
                    @endif
                </tr>

                <tr>                  
                  <td colspan="2">
                      <div class="form-group">
                        <label for="in_out">IN/OUT</label>
                        <select name="in_out" id="in_out" class="form-control"  >
                          @if($user->in_out == 1)
                            <option value="1"  selected >IN</option>
                          @endif
                          @if($user->in_out == 2)
                          <option value="2"  selected  >OUT</option>
                          @endif
                        </select>
                      </div>
                  </td>
                </tr>

             
     
                <tr>

                    <td>
                      <div class="form-group">
                        <label>2D ကော်</label>
                        <input type="number" name="twod_comm" class="form-control" value="{{ $commission->twod_comm }}">
                      </div>
                    </td>

                    <td>
                      <div class="form-group">
                        <label>2D အလျော်အဆ</label>
                        <input type="number" name="twod_times" class="form-control" value="{{ $commission->twod_times }}">
                      </div>
                    </td>
                    
                  </tr>  

                  @if($user_type == "User")
                  <tr>                    

                      <td>
                      <div class="form-group">
                        <label>2D Hot ဂဏန်းခွဲတမ်း</label>
                        <input type="number" name="twod_hotpercent" class="form-control" value="{{ $commission->twod_hotpercent }}">
                      </div>
                      </td>
                 
                        
                     <td>
                      <div class="form-group">
                        <label id="twod_status">2D ကစားခွင့်</label>
                        <select name="twod_status" id="twod_status" class="form-control">
                          <option value="0" @if($commission->twod_status == 0) selected @endif >0</option>
                          <option value="1" @if($commission->twod_status == 1) selected @endif >1</option>
                        </select>
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

                  <td>
                    <div class="form-group">
                      <label id="lbl_close_time">Close Time</label>
                      <input type="time" name="close_time" id="close_time" class="form-control" value="{{ $user->close_time }}">
                    </div>
                  </td>

                </tr>

                  @endif

                 

                <tr>
                  <td colspan="2" style="text-align: center;"><input type="submit" value="ပြင်ဆင်ရန်" class="btn btn-primary btn-sm"></td>
                </tr>
                    
                </form>
              </tbody>
              </table>

    </div>

     <div class="d-flex justify-content-end align-items-end">         

           <span class="card-text">
              <a href="{{ url("/user/add") }}" class="btn btn-primary btn-sm" >
                 Back
              </a>
          </span>                 

    </div>


</div>
</div>
</div>



<script>
$(document).ready( 
  function()
  {
                              
    $("#password").select().focus();
                          
  }
);
</script>


@endsection