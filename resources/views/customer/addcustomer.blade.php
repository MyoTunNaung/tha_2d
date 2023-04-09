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
              Customers
          </div>

                  <table class="table table-sm header-fixed">
                  <thead>
                      <tr>
                          
                        <th>Id</th> 
                        <th>Name</th>  
                        <th>In_Out</th>
                                            
                        <th>Update</th>
                        <th>Delete</th>  
               
                      </tr>
                  </thead>
                  <tbody>

                       @foreach($customers as $customer)
                      <tr>
                          <td>{{ $customer->id }}</td>
                          <td>{{ $customer->name }}</td>

                          @if( $customer->in_out == 1)
                            <td>IN</td>
                          @else
                            <td>OUT</td>
                          @endif

                          @if(auth()->user()->id != 1 and auth()->user()->id != 2)

                          <td>
                            <a href="{{ url("/customer/upd/{$customer->id}") }}" class="btn btn-info btn-sm">Update</a>
                          </td> 

                          
                          <td>
                            

                            <a href="{{ url("/customer/del/{$customer->id}") }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?') && confirm('Are you ready?') && confirm('Can not get back?')">Delete</a>
                            
                            

                          </td>
                          @endif
                        
                      </tr>
                  @endforeach                    
                  </tbody>
                </table>

    </div> <!-- Card -->

</div>
</div>
</div>


<br>
    
<div class="container">
<div class="row justify-content-center">
<div class="col-md-6 col-md-offset-2">

    <div class="card border-secondary">

        <div class="card-header">
            New Customer
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
                        <label id="in_out">IN OUT</label>
                        <select name="in_out" id="in_out" class="form-control">
                          <option value="1">IN</option>
                          <option value="2">OUT</option>
                        </select>
                      </div>
                    </td> 
                </tr>

                <tr>
                    <td>
                      <div class="form-group">
                        <label>Agent</label>
                        <select name="agent" id="agent" class="form-control">
                          <option value="0" selected>None</option>
                          <option value="1">Agent</option>
                        </select>
                      </div>
                    </td>

                    <td>
                      <div class="form-group">
                        <label>Agent Percent</label>
                        <input type="number" name="agent_percent" class="form-control" value="0">
                      </div>
                    </td>

                </tr>

                <tr>
                    <td colspan="2">
                      <div class="form-group">
                          <label>Refer UserID</label> <br>
                          <select name="refer_user_id" id="refer_user_id" class="form-control" >
                          <option value="0" selected>None</option>                            
                          @foreach($users as $user)
                           
                            <option value="{{ $user->id }}">
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
                        <label>2D Commission</label>
                        <input type="number" name="twod_comm" class="form-control" value="10">
                      </div>
                    </td>

                      <td>
                      <div class="form-group">
                        <label>2D (X)</label>
                        <input type="number" name="twod_times" class="form-control" value="80">
                      </div>
                    </td>
                  </tr>

                  <tr>

                      <td>
                      <div class="form-group">
                        <label>3D Commission</label>
                        <input type="number" name="threed_comm" class="form-control" value="15">
                      </div>
                    </td>

                      <td>
                      <div class="form-group">
                        <label>3D (X)</label>
                        <input type="number" name="threed_times" class="form-control" value="500">
                      </div>
                    </td>

                  
                    
                  </tr>  

                  <tr>
                      <td>
                      <div class="form-group">
                        <label>2D HotPercent</label>
                        <input type="number" name="twod_hotpercent" class="form-control" value="100">
                      </div>
                      </td>
                      <td>
                      <div class="form-group">
                        <label>3D HotPercent</label>
                        <input type="number" name="threed_hotpercent" class="form-control" value="100">
                      </div>
                      </td>
                  </tr> 

                 
                  

                <tr>
                  <td colspan="2" style="text-align: center;"><input type="submit" value="Add Customer" class="btn btn-primary btn-sm"></td>
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