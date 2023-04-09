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
                <div class="card-header">Edit Cash ငွေစာရင်း အချက်အလက် ပြင်ဆင်ခြင်း</div> 
    
    <table class="table table-sm">
        
    <tbody>
      <form method="post" enctype="multipart/form-data">
      {{ csrf_field() }}

      <tr>
          <td>            
            <div class="form-group">
                <label>User</label> <br>
                <select name="select_user_id" id="select_user_id" class="form-control" >                             
                @foreach($users as $user)
                  <option value="{{ $user->id }}" @if($user->id == $cash->user_id) selected @endif>
                    {{ $user->name }}
                  </option>
                @endforeach
              </select>
            </div>
          </td>
      </tr>

      <tr>
          <td>
            <div class="form-group">
              <label>Deposit</label>
              <input type="text" name="deposit" class="form-control" value="{{ $cash->deposit }}">
            </div>
          </td>
      </tr>

      <tr>          
          <td>
            <div class="form-group">
              <label>Withdraw</label>
              <input type="text" name="withdraw" class="form-control" value="{{ $cash->withdraw }}">
            </div>
          </td>
      </tr>

      <tr>       
          <td>
            <div class="form-group">
              <label>Balance</label>
              <input type="text" name="balance" class="form-control" value="{{ $cash->balance }}">
            </div>
          </td>         
      </tr>      

      <tr>
        <td><input type="submit" value="Update Cash" class="btn btn-primary"></td>
      </tr>
          
      </form>
    </tbody>
    </table>

  </div>
</div>
</div>
</div>

@endsection