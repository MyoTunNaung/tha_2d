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
    
          <div class="card-header">
              ဘရိတ် အချက်အလက် ပြင်ဆင်ခြင်း
          </div> 
    
          <table class="table table-sm">
              
          <tbody>
            <form method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

              <tr>
                <td>

                  <div class="form-group">
                      <label>Work File</label> <br>
                      <select name="work_file_id" id="work_file_id" class="form-control"> 

                      @foreach($work_files as $work_file) 

                        <option value="{{ $work_file->id }}" @if($work_file->id == $work_file_id) selected @endif>
                          {{ $work_file->show }}
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
                    <input type="number" name="amount" id="amount" class="form-control" value="{{ $break_amount->amount }}">
                  </div>
                </td>
              </tr>

              <tr>
                  <td>
                  <div class="form-group">
                    <label>KeepBreak</label>
                    <input type="number" name="status" id="status" class="form-control" value="{{ $break_amount->status }}">
                  </div>
                  </td>
              </tr>
              
            <tr>
              <td><input type="submit" value="ပြင်ဆင်ရန်" class="btn btn-primary"></td>
            </tr>
                
            </form>
          </tbody>
          </table>

  </div>

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


<script>
$(document).ready(function()
{

 $("#amount").select().focus(); 

  });
</script>  


<script>
  
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
                         $('#status').val(res[count].status);                                                
                          
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