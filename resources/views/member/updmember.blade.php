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

  <div class="card">
  <div class="card-header">Edit Member ပြင်ဆင်ခြင်း</div>

    <table class="table table-sm">        
    <tbody>

      <form method="post" enctype="multipart/form-data">
      {{ csrf_field() }}

        <tr>

          <td>
            <div class="form-group">
              <label>Name</label>
              <input type="text" name="name" class="form-control" autocomplete="off" value="{{ $member->name }}">
            </div>
          </td> 

          <td>
            <div class="form-group">
              <label>Percent</label>
              <input type="text" name="percent" class="form-control" autocomplete="off" value="{{ $member->percent }}">
            </div>
          </td> 

        </tr>

       
      <tr>
        <td><input type="submit" value="Update Member" class="btn btn-primary btn-sm"></td>
      </tr>          
      </form>

    </tbody>
    </table>

  </div>
  </div>

</div>
</div>   

@endsection