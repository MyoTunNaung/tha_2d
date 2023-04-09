<?php 
    use App\FilePermission;
    use App\Choice;
 ?>

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
                    ဖိုင် ကစားခွင့်                 
                </div>

                  <table class="table table-striped table-sm header-fixed">
                  <thead>
                      <tr>
                          
                        <th>User</th>                        
                        <th>2D</th>                        
                                   
                        <th>Update</th>
                                 
                      </tr>
                  </thead>
                  <tbody>
                      
                      @foreach($users as $user)
                      @if($user->id != 1 && $user->id !=2)
                      <tr>
                          <td>{{ $user->name }}</td>

                          <?php 
                              $file_permission = FilePermission::where("user_id","=","$user->id")->first();                             
                           ?>

                          @if($file_permission)

                              

                              <td>{{ $file_permission->twod_status }}</td>

                              <td>
                                <a href="{{ url("/filepermission/upd/{$file_permission->id}") }}" class="btn btn-primary btn-sm">ပြင်ဆင်ရန်</a>
                              </td> 

                          @else
                            
                              <td>
                                <a href="{{ url("/filepermission/add/{$user->id}") }}" class="btn btn-primary btn-sm">Add</a>
                              </td> 

                          @endif
                        
                      </tr>
                      @endif
                      @endforeach
                    
                  </tbody>
                </table>
               
  
      </div>

        <?php 

          $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');  

       ?>

      <div class="d-flex justify-content-between align-items-right">

            <span class="card-text">
                <a href="{{ url("/3dsale/add/{$work_file_id}") }}" class="btn btn-primary btn-sm" >
                   အရောင်း
                </a>
            </span>              

            <span class="card-text">
                <a href="{{ url("/") }}" class="btn btn-primary btn-sm" >
                   Back
                </a>
            </span>     

      </div> 



</div>
</div>
</div>

 

@endsection