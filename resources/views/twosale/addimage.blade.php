@extends('layouts.app')
@section('content')


    @if(session('info'))
      <div class="alert alert-danger">
      {{ session('info') }}
      </div>
    @endif 

    @if($errors->any())
      <div class="alert alert-warning">
        <ol>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ol>      
      </div>
    @endif

    
<div class="container">
<div class="row justify-content-center">
<div class="col-md-6 col-md-offset-2">
            
    <div class="card">                

    <table class="table table-sm">        
    <tbody>
      <form method="post" enctype="multipart/form-data">

      {{ csrf_field() }}

      <tr>          
          <td>
            <div class="form-group">
              <label>Photo</label>
              <input type="file" name="photo" class="form-control">
            </div>
          </td>
      </tr>

      <tr>
        <td><input type="submit" value="Add Image" class="btn btn-primary btn-sm"></td>
      </tr>

      </form>
    </tbody>
    </table>

  </div>


</div>
</div>
</div>   

@endsection