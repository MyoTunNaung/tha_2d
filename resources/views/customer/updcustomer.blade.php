@extends('layouts.app')
@section('content')


    

    
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-2">

          @if(session('info'))
            <div class="alert alert-danger">
            {{ session('info') }}
            </div>
          @endif 
    

            <div class="card">
                <div class="card-header">Edit Customer ပြင်ဆင်ခြင်း</div>

    <table class="table table-sm">
        
    <tbody>
      <form method="post" enctype="multipart/form-data">

      {{ csrf_field() }}

        <tr>
          <td>
            <div class="form-group">
              <label>Name</label>
              <input type="text" name="name" class="form-control" autocomplete="off" value="{{ $customer->name }}">
            </div>
          </td> 
        </tr>

        <tr>
          <td>
            <div class="form-group">
              <label id="in_out">IN OUT</label>
              <select name="in_out" id="in_out" class="form-control">
                <option value="1" @if($customer->in_out == 1) selected @endif >IN</option>
                <option value="2" @if($customer->in_out == 2) selected @endif >OUT</option>
              </select>
            </div>
          </td> 
        </tr>

      <tr>
        <td><input type="submit" value="Update Customer" class="btn btn-primary btn-sm"></td>
      </tr>

          
      </form>
    </tbody>
    </table>



            </div>
        </div>
    </div>
    </div>


   

@endsection