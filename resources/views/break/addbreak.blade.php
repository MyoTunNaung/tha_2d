<?php 
  use App\WorkFile;
 ?>

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
    
</div>
</div>
</div>

<!-- Filters & Show -->
<div class="container">
<div class="row justify-content-center">
<div class="col-md-6 col-md-offset-2">

    <div class="card border-secondary">
                
        <div class="card-header">
          ဘရိတ်
        </div>

                <table class="table table-striped table-sm header-fixed">        
                <tbody>
                  <form method="get" action="{{ url("/break/list/show") }}" enctype="multipart/form-data">
                  {{ csrf_field() }}

                    <tr>
                      <td colspan="2">
                        <div class="form-group">
                            <label>Name</label> <br>
                            <select name="select_name" id="select_name" class="form-control" >
                              <option value="3D" @if($name =="3D") selected @endif>3D</option>
                          </select>
                        </div>
                      </td> 
                  
                      <td>
                      <div class="form-group">
                        <label>FromDate</label>
                        <input type="date" name="select_from_date" id="select_from_date" class="form-control" value="{{ $from_date }}">
                      </div>
                      </td>

                      <td>
                      <div class="form-group">
                        <label>ToDate</label>
                        <input type="date" name="select_to_date" id="select_to_date" class="form-control" value="{{ $to_date }}">
                      </div>
                      </td>        
                    
                  </tr>  

                  <label hidden >Show</label><br>                          
                  <input hidden type="submit"  value="Show" name="action" id="btnshow"  class="btn btn-info btn-sm">
                        
                         
                  </form>
                </tbody>
                </table>


                <table class="table table-sm header-fixed" style="font-size: 80%;">
                  <thead>
                      <tr>

                        <th>WorkFile</th>  
                        <th>Amount</th>                                              

                        <th>Update</th>
                        <th>Delete</th>   
               
                      </tr>
                  </thead>
                  <tbody>
                       @foreach($previous_break_amounts as $break_amount)

                        <?php 

                            $work_file_name   = WorkFile::where("id","=","$break_amount->work_file_id")->value('show');

                         ?>
                      <tr>                         
                          <td>{{ $work_file_name }}</td>

                          <td>{{ $break_amount->amount }}</td>
                         
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
<!-- End Filters & Show -->

<br>

<div class="container">
<div class="row justify-content-center">
<div class="col-md-6 col-md-offset-2">

      <div class="card border-secondary">

          <div class="card-header">
              New Break
          </div>


          <table class="table table-sm">
              
          <tbody>
            <form method="post" enctype="multipart/form-data">

            {{ csrf_field() }}

              <tr>

                <td >
                  <div class="form-group">
                      <label>Name</label> <br>
                      <select name="name" id="name" class="form-control" >
                        <option value="2D" @if($name =="2D") selected @endif>2D</option>
                        <option value="3D" @if($name =="3D") selected @endif>3D</option>
                    </select>
                  </div>
                </td> 

                 <td >
                  <div class="form-group">
                      <label>Duration</label> <br>
                      <select name="duration" id="duration" class="form-control" >
                        <option value="AM" @if($name =="AM") selected @endif>AM</option>
                        <option value="PM" @if($name =="PM") selected @endif>PM</option>
                    </select>
                  </div>
                </td> 

              </tr>

              <tr>

                <td colspan="2">
                  <div class="form-group">
                      <label>Work File</label> <br>
                      <select name="work_file_id" id="work_file_id" class="form-control" >                             
                      @foreach($work_files as $work_file)
                        <option value="{{ $work_file->id }}" @if($work_file->id == $work_file_id) selected @endif>
                          {{ $work_file->name ." ".$work_file->duration." [ ". $work_file->date ." ] "}}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </td>
              </tr>

              <tr>
                <td>
                  <div class="form-group">
                    <label>Amount</label>
                    <input type="number" name="amount" id="amount" class="form-control" value="{{ $amount }}">
                  </div>
                </td>
             
                  <td>
                  <div class="form-group">
                    <label>KeepBreak</label>
                    <input type="number" name="status" id="status" class="form-control" value="1">
                  </div>
                  </td>
              </tr>
          
              <tr>
                <td colspan="2" style="text-align: center;"><input type="submit" value="Add Break Amount" class="btn btn-primary btn-sm"></td>
              </tr>

                
            </form>
            </tbody>
            </table>

    </div>


</div>
</div>
</div>   


<script>
$(document).ready(function()
{

   
    $("#select_name").change(function()
    {
      $('#btnshow').click();
    });  

    
    $("#select_from_date").change(function()
    {
      $('#btnshow').click();
    });  


    $("#select_to_date").change(function()
    {
      $('#btnshow').click();
    });  


   $("#amount").select().focus();  
    
});
</script>  

<script >
  
    // name change
    $("#name").change(function()
    {
     

      var name       = $('#name').val(); 
      var duration   = $('#duration').val();   
      
      
      if(name)
      {
        $.ajax(
            {
                type:   "GET",
                url:  "{{ url('getWorkFile') }}?name="+name
                                              +"&duration="+duration,
                dataType: 'json',             
                success:function(res)
                {                                                   
                    if(res)
                    {
                        var html = '';

                        for(var count = 0; count < res.length; count++)
                        {
                         
                            html += '<option  value="'+res[count].id+'" >'+ res[count].name + ' ' + res[count].duration + ' [' + res[count].date + ']' +'</option>'; 
                                                 
                          
                        }

                        $("#work_file_id").html(html);                        
                        // $('#work_file_id').change();
                        $("#amount").select().focus(); 
                    }
                }
            } 
           );       
      }

     
    });
    // End name change


    // duration change
    $("#duration").change(function()
    {
     

      var name       = $('#name').val(); 
      var duration   = $('#duration').val();   
      
      
      if(name)
      {
        $.ajax(
            {
                type:   "GET",
                url:  "{{ url('getWorkFile') }}?name="+name
                                              +"&duration="+duration,
                dataType: 'json',             
                success:function(res)
                {                                                   
                    if(res)
                    {
                        var html = '';

                        for(var count = 0; count < res.length; count++)
                        {
                         
                            html += '<option  value="'+res[count].id+'" >'+ res[count].name + ' ' + res[count].duration + ' [' + res[count].date + ']' +'</option>'; 
                                                 
                          
                        }

                        $("#work_file_id").html(html);                        
                        // $('#work_file_id').change();
                        $("#amount").select().focus(); 
                    }
                }
            } 
           );       
      }

     
    });
    // End duration change


    // work file change
    $("#work_file_id").change(function()
    {
     

      var work_file_id       = $('#work_file_id').val(); 
           
      
      if(work_file_id)
      {
        $.ajax(
            {
                type:   "GET",
                url:  "{{ url('getBreakAmount') }}?work_file_id="+work_file_id,                                              
                dataType: 'json',             
                success:function(res)
                {                                                   
                    if(res)
                    {
                        var html = '';

                        for(var count = 0; count < res.length; count++)
                        {
                         
                         $('#amount').val(res[count].amount);                                                 
                          
                        }

                        $("#amount").html(html);                        
                        // $('#amount').change();

                        $("#amount").select().focus(); 
                    }
                }
            } 
           );       
      }

     
    });
    // End work file change

</script>

@endsection