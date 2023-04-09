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

   

<!-- Filters -->
  <div class="container">
     <div class="row justify-content-center">

        <div class="col-md-6 col-md-offset-2">

          
            <div class="card">
                <!-- <div class="card-header">Select Vehicle, Customer & Date</div> -->

                <table class="table table-sm header-fixed">        
                <tbody>
                  <form method="get" action="{{ url("/workfile/list/show") }}" enctype="multipart/form-data">
                  {{ csrf_field() }}

                    <tr>
                      <td colspan="2">
                        <div class="form-group">
                            <label>Name</label> <br>
                            <select name="name" id="name" class="form-control" >
                              <option value="2D" @if($name =="2D") selected @endif>2D</option>
                              <option value="3D" @if($name =="3D") selected @endif>3D</option>
                          </select>
                        </div>
                      </td> 
                    </tr>

                    <tr>

                      <td>
                      <div class="form-group">
                        <label>FromDate</label>
                        <input type="date" name="from_date" id="from_date" class="form-control" value="{{ $from_date }}">
                      </div>
                      </td>

                      <td>
                      <div class="form-group">
                        <label>ToDate</label>
                        <input type="date" name="to_date" id="to_date" class="form-control" value="{{ $to_date }}">
                      </div>
                      </td>        
                    
                  </tr>  

                  <label hidden >Show</label><br>                          
                  <input hidden type="submit"  value="Show" name="action" id="btnshow"  class="btn btn-info btn-sm">
                        
                         
                  </form>
                </tbody>
                </table>

            </div>
        </div>


    </div>
  </div>
  <!-- End Filters -->

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



        <div class="card">
            <div class="card-header">
                
                <a class="btn btn-primary btn-sm" href="{{ url("/workfile/add") }}">
                Add New WorkFile (ဖိုင် အသစ်တည်ရန် )
                </a>

            </div> 
        </div>  

        <!-- Show Table -->
        <div class="card">

        <table class="table table-sm header-fixed" style="font-size: 85%;">
          <thead>
              <tr>
                  
                <th>Name</th> 
                <th>Time</th>  
                <th>Date</th>
                

                <th>Details</th>
                <th>Update</th>
                <th>Delete</th>  
       
              </tr>
          </thead>

          <tbody>

              @foreach($workfiles as $workfile)
              <tr>
                  <td>{{ $workfile->name }}</td>
                  <td>{{ $workfile->duration }}</td>
                  <td>{{ $workfile->date }}</td>
                  

                  <td>
                    <a href="{{ url("/workfile/list/{$workfile->id}") }}" class="btn btn-primary btn-sm">Details</a>
                  </td>   

                  @if(auth()->user()->id == 1 or auth()->user()->id == 2)
                  <td>
                    <a href="{{ url("/workfile/upd/{$workfile->id}") }}" class="btn btn-primary btn-sm">Update</a>
                  </td>                              
                  <td>
                    
                    <a href="{{ url("/workfile/del/{$workfile->id}") }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>                                
                   
                  </td>
                  @endif
                
              </tr>
          @endforeach
            
          </tbody>
        </table>
      </div>

        <!-- End Show Table          -->
            
          


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


<script>
$(document).ready(function()
{

     $("#name").change(function()
    {
      $('#btnshow').click();
    });  

    
    $("#from_date").change(function()
    {
      $('#btnshow').click();
    });  


    $("#to_date").change(function()
    {
      $('#btnshow').click();
    });  


    $("#work_file_id").change(function()
    {
      $('#btnshow').click();
    });   



});

</script>       

@endsection