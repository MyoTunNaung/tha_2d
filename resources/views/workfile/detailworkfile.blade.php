@extends('layouts.app')
@section('content')

<style type="text/css">
  #table1 
  {
    font-size: 12px;
    display: flex;
    flex-flow: column;
    width: 100%;
  }
  #table1  thead 
  {
    flex: 0 0 auto;
  }
  #table1 tbody 
  {
   
    height: 350px;
    flex: 1 1 auto;
    display: block;
    overflow-y: auto;
    overflow-x: hidden;
  }
  #table1 tr 
  {
    width: 100%;
    display: table;
    table-layout: fixed;
  }
</style>

   


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2"> 

        @if(session('info'))
        <div class="container">
           <div class="alert alert-danger">
          {{ session('info') }}
          </div>
        </div>     
        @endif



      
            
          @foreach($workfiles as $workfile)
           
            <div class="card">

                  <div class="card-header">
                    <div class="clear_fix">
                      <div class="float-left">
                        ID: {{ $workfile->id }}
                      </div>
                      <div class="float-right">
                        <a class="btn btn-primary btn-sm" href="{{ url("/workfile/open/{$workfile->id}") }}">
                        Open (ဖိုင် ဖွင့်)
                        </a>
                        <a class="btn btn-primary btn-sm" href="{{ url("/workfile/close/{$workfile->id}") }}">
                        Close (ဖိုင် ပိတ်)
                        </a>
                      </div>
                    </div>

                    
                  </div>
                  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; Name</span>
                      <span class="card-text">{{ $workfile->name }} &nbsp;</span>
                  </div>
                  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; Date</span>
                      <span class="card-text">{{ $workfile->date }} &nbsp;</span>
                  </div>

                  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; Duration</span>
                      <span class="card-text">{{ $workfile->duration }} &nbsp;</span>
                  </div>  
                  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; OpenTime</span>
                      <span class="card-text">{{ $workfile->open_time }} &nbsp;</span>
                  </div>     
                  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; CloseTime</span>
                      <span class="card-text">{{ $workfile->close_time }} &nbsp;</span>
                  </div>

                 <!--  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; Time</span>
                      <span class="card-text">{{ $workfile->time }} &nbsp;</span>
                  </div>   
                   <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; Times</span>
                      <span class="card-text">{{ $workfile->times }} &nbsp;</span>
                  </div>        -->                 

                  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; FromDate</span>
                      <span class="card-text">{{ $workfile->from_date }} &nbsp;</span>
                  </div>   
                   <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; ToDate</span>
                      <span class="card-text">{{ $workfile->to_date }} &nbsp;</span>
                  </div>

                  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; Show</span>
                      <span class="card-text">{{ $workfile->show }} &nbsp;</span>
                  </div>   
                   <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; ResultDigit</span>
                      <span class="card-text">{{ $workfile->result_digit }} &nbsp;</span>
                  </div>     

                  <div class="card-body"> 
                  <div class="d-flex justify-content-between align-items-center">
                      <a href="{{ url("/workfile/upd/{$workfile->id}") }}" class="btn btn-info btn-sm">
                          Update
                      </a>
                      
                      @if(auth()->user()->id == 1 or auth()->user()->id == 2)

                      <a href="{{ url("/workfile/del/{$workfile->id}") }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?') && confirm('Are you ready?') && confirm('Can not get back?')">
                          Delete
                      </a>
                            
                      @endif

                  </div>
                  </div> 

            </div> <!-- Card -->
            @endforeach


        </div>
    </div>
</div>



  <!-- <div class="container_fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 col-md-offset-2">
            <div class="card">
                <div class="card-header">
                  
                  <div class="float-left"> WorkFile ဖိုင်တည် စာရင်း</div> 
                  <div class="float-right">
                    <a class="btn btn-primary btn-sm" href="{{ url("/workfile/add") }}">Add New WorkFile (ဖိုင် အသစ်တည်ရန် )</a>
                  </div>  
                </div>

                  <table class="table table-sm header-fixed">
                  <thead>
                      <tr>
                          
                        <th>Id</th> 
                        <th>Name</th>  
                        <th>Date</th>
                        <th>Duration</th>

                        <th>Open Time</th> 
                        <th>Close Time</th>

                        <th>Time</th> 
                        <th>Times</th>

                        <th>FromDate</th>
                        <th>ToDate</th>

                        <th>Show</th> 
                        <th>ResultDigit</th>

                        <th>Update</th>
                        <th>Delete</th>   
               
                      </tr>
                  </thead>
                  <tbody>
                       @foreach($workfiles as $workfile)
                      <tr>
                          <td>{{ $workfile->id }}</td>
                          <td>{{ $workfile->name }}</td>
                          <td>{{ $workfile->date }}</td>
                          <td>{{ $workfile->duration }}</td>

                          <td>{{ $workfile->open_time }}</td>
                          <td>{{ $workfile->close_time }}</td>

                          <td>{{ $workfile->time }}</td>
                          <td>{{ $workfile->times }}</td>

                          <td>{{ $workfile->from_date }}</td>
                          <td>{{ $workfile->to_date }}</td>

                          <td>{{ $workfile->show }}</td>
                          <td>{{ $workfile->result_digit }}</td>

                          <td>
                            <a href="{{ url("/workfile/upd/{$workfile->id}") }}" class="btn btn-info btn-sm">Update</a>
                          </td>      
                          <td>
                            @if(auth()->user()->id == 1 or auth()->user()->id == 2)

                            <a href="{{ url("/workfile/del/{$workfile->id}") }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?') && confirm('Are you ready?') && confirm('Can not get back?')">Delete</a>
                            
                            @endif

                          </td>
                        
                      </tr>
                  @endforeach
                    
                  </tbody>
                </table>
               
              
                  
              
                
               </div>
            </div>
        </div>
    </div>
</div> -->


@endsection