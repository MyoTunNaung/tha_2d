<?php 
use App\WorkFile;
?>

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
  #table1 thead 
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
  #table1 td
  {
    font-size: 10px;
  }
</style>

   
<!-- Show Login File -->

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
    
            <div class="card">
                <div class="card-header">
                 
                  <a class="btn btn-primary btn-sm" href="{{ url("/break/add") }}">
                    Add New Break Amount (ဘရိတ်  အချက်အလက်  အသစ်ထည့်ရန် )
                  </a>
                   
                </div>

                  <table class="table table-sm header-fixed" style="font-size: 85%;">
                  <thead>
                      <tr>
                          
                       <!--  <th>Id</th>  -->
                        <th>WorkFile</th>  
                        <th>Amount</th>
                        <!-- <th>KeepBreak</th> -->
                        

                        <th>Update</th>
                        <th>Delete</th>   
               
                      </tr>
                  </thead>
                  <tbody>
                       @foreach($break_amounts as $break_amount)

                        <?php 

                            $work_file_name   = WorkFile::where([

                                    ["id","=","$break_amount->work_file_id"]

                                ])
                            ->value('show');

                         ?>
                      <tr>
                          <!-- <td>{{ $break_amount->id }}</td> -->
                          <td>{{ $work_file_name }}</td>

                          <td>{{ $break_amount->amount }}</td>
                          <!-- <td>{{ $break_amount->status }}</td> -->
                          

                          <td>
                            <a href="{{ url("/break/upd/{$break_amount->id}") }}" class="btn btn-info btn-sm">Update</a>
                          </td>      
                          <td>
                            @if(auth()->user()->id == 1 or auth()->user()->id == 2)

                            <a href="{{ url("/break/del/{$break_amount->id}") }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?') && confirm('Are you ready?') && confirm('Can not get back?')">Delete</a>
                            
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
</div>
<!-- Show Login File -->


<!-- Filters -->
  <div class="container">
     <div class="row justify-content-center">

        <div class="col-md-6 col-md-offset-2">

          
            <div class="card">
                <!-- <div class="card-header">Select Vehicle, Customer & Date</div> -->

                <table class="table table-sm header-fixed">        
                <tbody>
                  <form method="get" action="{{ url("/break/list/show") }}" enctype="multipart/form-data">
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


<!-- Show Privious File -->
<div class="container">
<div class="row justify-content-center">
<div class="col-md-6 col-md-offset-2">

  <div class="card">
                

                  <table class="table table-sm header-fixed" style="font-size: 80%;">
                  <thead>
                      <tr>
                          
                       <!--  <th>Id</th>  -->
                        <th>WorkFile</th>  
                        <th>Amount</th>
                        <!-- <th>KeepBreak</th> -->
                        

                        <th>Update</th>
                        <th>Delete</th>   
               
                      </tr>
                  </thead>
                  <tbody>
                       @foreach($previous_break_amounts as $break_amount)

                        <?php 

                            $work_file_name   = WorkFile::where([

                                    ["id","=","$break_amount->work_file_id"]

                                ])
                            ->value('show');

                         ?>
                      <tr>
                          <!-- <td>{{ $break_amount->id }}</td> -->
                          <td>{{ $work_file_name }}</td>

                          <td>{{ $break_amount->amount }}</td>
                          <!-- <td>{{ $break_amount->status }}</td> -->
                          

                          <td>
                            <a href="{{ url("/break/upd/{$break_amount->id}") }}" class="btn btn-info btn-sm">Update</a>
                          </td>      
                          <td>
                            @if(auth()->user()->id == 1 or auth()->user()->id == 2)

                            <a href="{{ url("/break/del/{$break_amount->id}") }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?') && confirm('Are you ready?') && confirm('Can not get back?')">Delete</a>
                            
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

<!-- Show Privious File -->


  
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


   

});

</script>   


@endsection