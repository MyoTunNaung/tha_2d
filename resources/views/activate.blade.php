<?php  use Illuminate\Support\Carbon; ?>

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


    @if(session('info'))
    <div class="container">
       <div class="alert alert-danger text-center">
      {{ session('info') }}
      </div>
    </div>     
    @endif


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header text-danger text-center">
                {{ __("Activation Expired! Please Contact to [ Myo Tun Naung ] [ Classic_PKU ] [ 0943071844 ]") }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-sm header-fixed">

                      <form method="post" action="{{ url("/activate") }}" enctype="multipart/form-data">
                      {{ csrf_field() }}                        


                      <tr>

                             <td>
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" name="start_date" id="start_date" value = "{{ Carbon::today()->toDateString() }}" class="form-control" >
                                </div>
                            </td>
                      </tr>
                      <tr>
                            <td>
                              <div class="form-group">
                                <label>User Name</label>
                                <input type="text" name="user_name" class="form-control" >
                              </div>
                            </td> 
                      </tr>
                      <tr>
                            <td>
                              <div class="form-group">
                                <label>Company Name</label>
                                <input type="text" name="company_name" class="form-control" >
                              </div>
                            </td> 
                    </tr>
                    <tr>
                            
                            <td>
                              <div class="form-group">
                                <label>MachineID</label>
                                <input type="text" name="machine_id" class="form-control" >
                              </div>
                            </td> 

                    </tr>

                    <tr>

                      <td colspan="5" class="justify-content-center">
                      <div class="form-group">
                        <!-- <label>Activate</label><br> -->
                         <input type="submit"  value="Activate" name="action" id="btnactivate"   class="btn btn-info btn-xs">
                      </div>            
                    </td>

                        </tr>


                          
                    </table>
                  
                </div>
            </div>         



        </div>
    </div>
</div>



@endsection
