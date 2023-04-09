@extends('layouts.app')
@section('content')


    

    
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 col-md-offset-2">

          @if(session('info'))
            <div class="alert alert-danger">
            {{ session('info') }}
            </div>
          @endif 
    

            <div class="card">
                <div class="card-header">Add New File Permission အသစ်</div>

    <table class="table table-sm">
        
    <tbody>
      <form method="post" enctype="multipart/form-data">

      {{ csrf_field() }}

        <input type="text" hidden name="user_id" value="{{ $user->id }}">

        <tr>
          <td>
            <div class="form-group">
              <label>Name</label>
              <input type="text" name="name" class="form-control" autocomplete="off" value="{{ $user->name }}" disabled>
            </div>
          </td> 
        </tr>

        <tr>
          <td>
            <div class="form-group">
              <label id="twod_status">2D Status</label>
              <select name="twod_status" id="twod_status" class="form-control">
                <option value="0">0</option>
                <option value="1">1</option>
              </select>
            </div>
          </td> 
        </tr>
        <tr>
           <td>
            <div class="form-group">
              <label id="threed_status">3D Status</label>
              <select name="threed_status" id="threed_status" class="form-control">
                <option value="0">0</option>
                <option value="1">1</option>
              </select>
            </div>
          </td> 

        </tr>

      <tr>
        <td><input type="submit" value="Add Permission" class="btn btn-primary btn-sm"></td>
      </tr>

          
      </form>
    </tbody>
    </table>



            </div>
        </div>
    </div>
    </div>


   

@endsection