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
                  Hot ဟော့ဂဏန်း အချက်အလက် စာရင်း
                </div>

                  <table class="table table-sm header-fixed">
                  <thead>
                      <tr>
                         
                        <th>WorkFile</th>                        
                        <th>Add Hot</th>                         
               
                      </tr>
                  </thead>
                  <tbody>
                       
                  @foreach($work_files as $work_file)
                  <tr>
                    <td>{{ $work_file->show }}</td>  
                   
                    <td>
                      <a href="{{ url("/hot/add/{$work_file->id}") }}" class="btn btn-info btn-sm">
                      Add Hot
                      </a>
                    </td>
                  </tr>
                  @endforeach

                  </tbody>
                </table>                
               </div>


            </div>
        </div>
    </div>
@endsection