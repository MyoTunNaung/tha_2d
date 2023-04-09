@extends('layouts.app')
@section('content')

<style type="text/css">
  table 
  {
    font-size: 12px;
    display: flex;
    flex-flow: column;
    width: 100%;
  }
  thead 
  {
    flex: 0 0 auto;
  }
  tbody 
  {
   
    height: 350px;
    flex: 1 1 auto;
    display: block;
    overflow-y: auto;
    overflow-x: hidden;
  }
  tr 
  {
    width: 100%;
    display: table;
    table-layout: fixed;
  }
</style>

   

<div class="container">
<div class="row justify-content-center">
<div class="col-md-10 col-md-offset-2">

            @if(session('info'))
            <div class="container">
               <div class="alert alert-danger">
              {{ session('info') }}
              </div>
            </div>     
            @endif
    
            <div class="card">
                <div class="card-header">
                  
                  <a class="btn btn-primary btn-sm" href="{{ url("/member/add") }}">
                    Add New Member (Member အသစ်ထည့်ရန် )
                  </a>
                 
                </div>

                  <table class="table table-sm header-fixed">
                  <thead>
                      <tr>
                          
                        <th>Id</th> 
                        <th>Name</th>  
                        <th>Percent</th>
                                            
                        <th>Update</th>
                        <th>Delete</th>  
               
                      </tr>
                  </thead>
                  <tbody>
                       @foreach($members as $member)
                      <tr>
                          <td>{{ $member->id }}</td>
                          <td>{{ $member->name }}</td>
                          <td>{{ $member->percent }}</td>

                          <td>
                            <a href="{{ url("/member/upd/{$member->id}") }}" class="btn btn-info btn-sm">Update</a>
                          </td> 

                          
                          <td>
                            @if(auth()->user()->id == 1 || auth()->user()->id == 2)

                            <a href="{{ url("/member/del/{$member->id}") }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?') && confirm('Are you ready?') ">Delete</a>
                            
                            @endif

                          </td>
                        
                      </tr>
                  @endforeach
                    
                  </tbody>
                </table>

               </div> <!-- Card -->


</div>
</div>
</div>



  

@endsection