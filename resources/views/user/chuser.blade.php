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
            {{ $user->name }}
        </div>

              <table class="table table-sm">
                  
              <tbody>
                <form method="post" enctype="multipart/form-data">

                {{ csrf_field() }}

                <tr>
                   <td>
                      <div class="form-group">
                        <label>စကားဝှက် အဟောင်း</label>
                        <input type="text" name="old_password" id="old_password" class="form-control" autocomplete="off" value="{{ $user->pass }}" disabled>
                      </div>
                    </td>
                </tr>
                <tr>
                    <td>
                      <div class="form-group">
                        <label>စကားဝှက် အသစ် ထည့်ပါ</label>
                        <input type="text" name="password" id="password" class="form-control" autocomplete="off" >
                      </div>
                    </td>
                </tr>

  
                <tr>
                  <td colspan="2" style="text-align: center;"><input type="submit" value="သိမ်းရန်" class="btn btn-primary btn-sm"></td>
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
                              
    $("#password").select().focus();
                          
  }
);
</script>


@endsection