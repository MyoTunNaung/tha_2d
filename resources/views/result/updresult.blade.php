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
                <div class="card-header">Edit Hot ဟော့ဂဏန်း အချက်အလက် ပြင်ဆင်ခြင်း</div> 
    
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
                  <option value="{{ $user->id }}" @if($user->id == $result->user_id) selected @endif>
                    {{ $user->name }}
                  </option>
                @endforeach
              </select>
            </div>
          </td>

        
          <td>            
            <div class="form-group">
                <label>Work File</label> <br>
                <select name="select_work_file_id" id="select_work_file_id" class="form-control" >                             
                @foreach($work_files as $work_file)
                  <option value="{{ $work_file->id }}" @if($work_file->id == $result->work_file_id) selected @endif>
                    {{ $work_file->show }}
                  </option>
                @endforeach
              </select>
            </div>
          </td>

        </tr>

        <tr>

          <td>
            <div class="form-group">
              <label>Total Amount</label>
              <input type="text" name="total_amount" class="form-control" value="{{ $result->total_amount}}">
            </div>
          </td>

          
          <td>
            <div class="form-group">
              <label>Commission Amount</label>
              <input type="text" name="commission_amount" class="form-control" value="{{ $result->commission_amount}}">
            </div>
          </td>

        </tr>

        <tr>
          <td>
            <div class="form-group">
              <label>Digit Amount</label>
              <input type="text" name="digit_amount" class="form-control" value="{{ $result->digit_amount}}">
            </div>
          </td>

          <td>
            <div class="form-group">
              <label>Other Amount</label>
              <input type="text" name="other_amount" class="form-control" value="{{ $result->other_amount}}">
            </div>
          </td>
        </tr>

        <tr>
          <td colspan="2">
            <div class="form-group">
              <label>Compensation Amount</label>
              <input type="text" name="compensation_amount" class="form-control" value="{{ $result->compensation_amount}}">
            </div>
          </td>         
        </tr>

        <tr>
          <td>
            <div class="form-group">
              <label>Cash Plus</label>
              <input type="text" name="cash_plus" class="form-control" value="{{ $result->cash_plus}}">
            </div>
          </td>

          <td>
            <div class="form-group">
              <label>Cash Minus</label>
              <input type="text" name="cash_minus" class="form-control" value="{{ $result->cash_minus}}">
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <div class="form-group">
              <label>Cash Balance</label>
              <input type="text" name="cash_balance" class="form-control" value="{{ $result->cash_balance}}">
            </div>
          </td>
        </tr>

      <tr>
        <td><input type="submit" value="Update Result" class="btn btn-primary"></td>
      </tr>
          
      </form>
    </tbody>
    </table>

  </div>
</div>
</div>
</div>

@endsection