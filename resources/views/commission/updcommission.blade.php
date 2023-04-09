<?php 

use App\User;

$user_type = User::where('id','=',$user->id)->value("type");

?>

@extends('layouts.app')
@section('content')

<div class="container">
<div class="row justify-content-center">
<div class="col-md-8 col-md-offset-2">

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

      <div class="card">

                <div class="card-header">
                ကော်မရှင် အချက်အလက် ပြင်ဆင်ခြင်း
              </div> 
    
    <table class="table table-sm">
        
    <tbody>
      <form method="post" enctype="multipart/form-data">
      {{ csrf_field() }}

        <tr>
          <td >

            <div class="form-group">
                <label>User </label>

                <select name="user_id" id="user_id" class="form-control" readonly >
               
                  <option value="{{ $commission->user_id}}">
                    {{ $user->name }}
                  </option>
              

              </select>
            </div>
          </td>  

          <td >
            <div class="form-group">
              <label for="in_out">IN/OUT</label>
              <select name="in_out" id="in_out" class="form-control" readonly >
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
              <label>2D ဂဏန်းခွဲတမ်း</label>
              <input type="number" name="twod_hotpercent" class="form-control" value="{{ $commission->twod_hotpercent }}">
            </div>
            </td>

             <td>
            <div class="form-group">
              <label>2D ကစားခွင့်</label>
              <input type="number" name="twod_status" class="form-control" value="{{ $commission->twod_status }}">
            </div>
            </td>

        </tr> 
        @endif

        <!-- <tr>                    

                      <td>
                      <div class="form-group">
                        <label for="onebet_times" id="lbl_onebet_times">လုံးပါ အလျော်အဆ</label>
                        <input type="number" name="onebet_times" id="onebet_times" class="form-control" value="{{ $commission->onebet_times }}">
                      </div>
                      </td>
                 
                       <td>
                      <div class="form-group">
                        <label for="position_times" id="lbl_position_times">အထိုင် အလျော်အဆ</label>
                        <input type="number" name="position_times" id="position_times" class="form-control" value="{{ $commission->position_times }}">
                      </div>
                      </td>
                        
                    

                  </tr> -->

                 <!--  <tr>                    

                     
                       <td>
                      <div class="form-group">
                        <label for="twobet_times" id="lbl_twobet_times">အတွဲ အလျော်အဆ</label>
                        <input type="number" name="twobet_times" id="twobet_times" class="form-control" value="{{ $commission->twobet_times }}">
                      </div>
                    </td> 
                        
                     <td>
                      <div class="form-group">
                        <label for="position_comm" id="lbl_position_comm">လုံးပါ ကော်</label>
                        <input type="number" name="position_comm" id="position_comm" class="form-control" value="{{ $commission->position_comm }}">
                      </div>
                    </td> 

                  </tr> -->

        <!-- <tr>
                  <td>
                    <div class="form-group">
                      <label id="lbl_close_time">Close Time</label>
                      <input type="time" name="close_time" id="close_time" class="form-control" value="{{$user->close_time}}">
                    </div>
                  </td>
        </tr> -->

     
      

        <tr>
          <td colspan="2" style="text-align: center;"><input type="submit" value="ပြင်ဆင်ရန်" class="btn btn-primary btn-sm"></td>
        </tr>
          
      </form>
    </tbody>
    </table>

  </div>


     <div class="d-flex justify-content-end align-items-end">

             <span class="card-text">
                <a href="{{ url("/commission/list") }}" class="btn btn-primary btn-sm" >
                   Back
                </a>
            </span>     

      </div> 


</div>
</div>
</div>

@endsection