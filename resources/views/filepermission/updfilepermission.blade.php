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
                <div class="card-header">ဖိုင် ကစားခွင့် ပြင်ဆင်ခြင်း</div>

    <table class="table table-sm">
        
    <tbody>
      <form method="post" enctype="multipart/form-data">

      {{ csrf_field() }}

      <input type="text" hidden name="user_id" value="{{ $filepermission->user_id }}">

        <tr>
          <td>
            <div class="form-group">
              <label>အမည်</label>
              <input type="text" name="name" class="form-control" autocomplete="off" value="{{ $filepermission->user->name }}" disabled>
            </div>
          </td> 
        </tr>


     

        <tr>
           <td>
            <div class="form-group">
              <label id="twod_status">2D ကစားခွင့်</label>
              <select name="twod_status" id="twod_status" class="form-control">
                <option value="0" @if($filepermission->twod_status == 0) selected @endif >0</option>
                <option value="1" @if($filepermission->twod_status == 1) selected @endif >1</option>
              </select>
            </div>
          </td> 

        </tr>  

      <tr>
        <td style="text-align: center;"><input type="submit" value="ပြင်ဆင်ရန်" class="btn btn-primary btn-sm"></td>
      </tr>

          
      </form>
    </tbody>
    </table>

    </div>

    
        <div class="d-flex justify-content-end align-items-end">

            <span class="card-text">
                <a href="{{ url("/filepermission/list") }}" class="btn btn-primary btn-sm" >
                   Back
                </a>
            </span>     

      </div> 


    </div>
    </div>
    </div>


   

@endsection