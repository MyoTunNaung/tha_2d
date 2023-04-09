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
            New Member
        </div>

              <table class="table table-sm">
                  
              <tbody>
                <form method="post" enctype="multipart/form-data">

                {{ csrf_field() }}

                <tr>
                    <td>
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" id="name" class="form-control" autocomplete="off">
                      </div>
                    </td> 

                     <td>
                      <div class="form-group">
                        <label>Percent</label>
                        <input type="number" name="percent" class="form-control" value="0">
                      </div>
                    </td>                 
                </tr>

                <tr>
                  <td colspan="2" style="text-align: center;"><input type="submit" value="Add Member" class="btn btn-primary btn-sm"></td>
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
                              
    $("#name").focus();
                          
  }
);
</script>

@endsection