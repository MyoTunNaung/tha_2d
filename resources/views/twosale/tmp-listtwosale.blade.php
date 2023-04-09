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
</style>

   @if(session('info'))
    <div class="container">
       <div class="alert alert-danger">
      {{ session('info') }}
      </div>
    </div>     
    @endif

  
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 col-md-offset-2">
            <div class="card">
                
                  <table class="table1 table-sm header-fixed">
                  
                  <tbody>                      
                      <tr>  
                          <td>                       
                          
                                                                                 
                            <a class="form-control btn btn-primary btn-sm" href="{{ url("/2dsale/add/{$work_file_id}") }}"> New Digit (ဂဏန်းအသစ် ထိုးရန်)</a>
                            
                                          
                          </td>
                          
                      </tr>
                    
                  </tbody>
                </table>
               
              
                  
              
                
               </div>
            </div>
        <!-- </div> -->
    </div>
</div>


 <script>
$(document).ready(function()
{ 
  $("#select_workfile_id").change(function()
  {
    $('#btnshow').click();
  });

});
</script>     

@endsection