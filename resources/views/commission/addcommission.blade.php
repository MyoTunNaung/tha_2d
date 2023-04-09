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
                <div class="card-header">Add New Commission ကော်မရှင် အချက်အလက် အသစ်</div>

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
                  <option value="{{ $user->id }}" @if($user->id == $select_user_id) selected @endif>
                    {{ $user->name }}
                  </option>
                @endforeach
              </select>
            </div>
          </td>
        

          <td>
            <div class="form-group">
              <label>Agent</label>
              <select name="agent" id="agent" class="form-control">
                <option value="0" selected>None</option>
                <option value="1">Agent</option>
              </select>
            </div>
          </td>

        </tr>
        <tr>

          <td>
            <div class="form-group">
              <label>Agent Percent</label>
              <input type="number" name="agent_percent" class="form-control" value="0">
            </div>
          </td>

          <td>
            <div class="form-group">
                <label>Refer UserID</label> <br>
                <select name="refer_user_id" id="refer_user_id" class="form-control" >
                <option value="0" selected>None</option>                            
                @foreach($users as $user)
                  @if($user->id != auth()->user()->id )
                  <option value="{{ $user->id }}">
                    {{ $user->name }}
                  </option>
                  @endif

                @endforeach
              </select>
            </div>
          </td>

        </tr>

        <tr>
            <td colspan="2">
            <div class="form-group">
              <label id="customer_id">Customer</label>
              <select name="customer_id" id="customer_id" class="form-control">
                <option value="1" selected>Admin</option>
                @foreach($customers as $customer)
                <option value="{{ $customer->id }}"> {{ $customer->name }}</option>
                @endforeach
              </select>
            </div>         
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
              <label>2D Times</label>
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
              <label>3D Times</label>
              <input type="number" name="threed_times" class="form-control" value="500">
            </div>
          </td>

        
          
        </tr>  

        <tr>
            <td>
            <div class="form-group">
              <label>2D HotPercent</label>
              <input type="number" name="twod_hotpercent" class="form-control" value="0">
            </div>
            </td>
            <td>
            <div class="form-group">
              <label>3D HotPercent</label>
              <input type="number" name="threed_hotpercent" class="form-control" value="0">
            </div>
            </td>
        </tr>   

        <tr>
          <td>
            <div class="form-group">
              <label id="entry">Entry</label>
              <select name="entry" id="entry" class="form-control">
                <option value="Cash" selected>Cash</option>
                <option value="Unit" >Unit</option>
              </select>
            </div>
          </td> 
       
           <td>
            <div class="form-group">
              <label id="view">View</label>
              <select name="view" id="view" class="form-control">
                <option value="Cash" selected>Cash</option>
                <option value="Unit" >Unit</option>
              </select>
            </div>
          </td> 

        </tr> 
       
    
      <tr>
        <td colspan="2"><input type="submit" value="Add Commission" class="btn btn-primary btn-sm"></td>
      </tr>

          
      </form>
    </tbody>
    </table>



            </div>
</div>
</div>
</div>



@endsection