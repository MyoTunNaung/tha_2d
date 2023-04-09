<?php  
  use App\Customer;
  use App\User;
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

             
            
          @foreach($commissions as $commission)
           <?php 
              $customer = Customer::find($commission->customer_id);
              if($customer != null)
                { $customer_name = $customer->name; }
              else
                { $customer_name = ""; }

              $refer_user = User::find($commission->refer_user_id);
              if($refer_user != null)
                { $refer_user_name = $refer_user->name; }
              else
                { $refer_user_name = ""; }
            ?>

            <div class="card">

                  <div class="card-header">
                    ID: {{ $commission->id }}
                  </div>
                  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; UserId</span>
                      <span class="card-text">{{ $commission->user->name }} &nbsp;</span>
                  </div>
                  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; CustomerId</span>
                      <span class="card-text">{{ $customer_name }} &nbsp;</span>
                  </div>

                  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; Agent</span>
                      <span class="card-text">{{ $commission->agent }} &nbsp;</span>
                  </div>  
                  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; AgentPercent</span>
                      <span class="card-text">{{ $commission->agent_percent }} &nbsp;</span>
                  </div>     
                  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; ReferUserID</span>
                      <span class="card-text">{{ $refer_user_name }} &nbsp;</span>
                  </div>

                  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; 2D_Comm</span>
                      <span class="card-text">{{ $commission->twod_comm }} &nbsp;</span>
                  </div>   
                   <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; 2D_Times</span>
                      <span class="card-text">{{ $commission->twod_times }} &nbsp;</span>
                  </div>                        

                  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; 3D_Comm</span>
                      <span class="card-text">{{ $commission->threed_comm }} &nbsp;</span>
                  </div>   
                   <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; 3D_Times</span>
                      <span class="card-text">{{ $commission->threed_times }} &nbsp;</span>
                  </div>

                  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; 2D_HotPercent</span>
                      <span class="card-text">{{ $commission->twod_hotpercent }} &nbsp;</span>
                  </div>   
                   <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; 3D_HotPercent</span>
                      <span class="card-text">{{ $commission->threed_hotpercent }} &nbsp;</span>
                  </div> 
                  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; Entry</span>
                      <span class="card-text">{{ $commission->entry }} &nbsp;</span>
                  </div>  
                  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; View</span>
                      <span class="card-text">{{ $commission->view }} &nbsp;</span>
                  </div>  


                  <div class="card-body"> 
                  <div class="d-flex justify-content-between align-items-center">
                      <a href="{{ url("/commission/upd/{$commission->id}") }}" class="btn btn-info btn-sm">
                          Update
                      </a>
                      
                      @if(auth()->user()->id == 1 or auth()->user()->id == 2)

                       <a href="{{ url("/commission/del/{$commission->id}") }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?') && confirm('Are you ready?') && confirm('Can not get back?')">
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
                  
                  <div class="float-left"> Commission ကော်မရှင် အချက်အလက် စာရင်း</div> 
                  <div class="float-right">
                    <a class="btn btn-primary btn-sm" href="{{ url("/commission/add") }}">Add New Commission (ကော်မရှင်  အချက်အလက်  အသစ်ထည့်ရန် )</a>
                  </div>  
                </div>

                  <table class="table table-sm header-fixed">
                  <thead>
                      <tr>
                          
                        <th>Id</th> 
                        <th>UserID</th>
                        <th>CustomerID</th>  

                        <th>Agent</th>
                        <th>AgentPercent</th>
                        <th>ReferUserID</th> 

                        <th>2D_Comm</th>
                        <th>2D_Times</th> 

                        <th>3D_Comm</th>
                        <th>3D_Times</th>       
                      
                        <th>2D_HotPercent</th>
                        <th>3D_HotPercent</th> 

                        <th>Update</th>
                        <th>Delete</th>   
               
                      </tr>
                  </thead>
                  <tbody>
                       @foreach($commissions as $commission)
                       <?php 
                          $customer = Customer::find($commission->customer_id);
                          if($customer != null)
                            { $customer_name = $customer->name; }
                          else
                            { $customer_name = ""; }

                          $refer_user = User::find($commission->refer_user_id);
                          if($refer_user != null)
                            { $refer_user_name = $refer_user->name; }
                          else
                            { $refer_user_name = ""; }
                        ?>
                      <tr>
                          <td>{{ $commission->id }}</td>
                          <td>{{ $commission->user->name }}</td>
                          <td>{{ $customer_name }}</td>

                          <td>{{ $commission->agent }}</td>
                          <td>{{ $commission->agent_percent }}</td>
                          <td>{{ $refer_user_name }}</td>

                          <td>{{ $commission->twod_comm }}</td>
                          <td>{{ $commission->twod_times }}</td>

                          <td>{{ $commission->threed_comm }}</td>
                          <td>{{ $commission->threed_times }}</td>

                          <td>{{ $commission->twod_hotpercent }}</td>
                          <td>{{ $commission->threed_hotpercent }}</td>

                          <td>
                            <a href="{{ url("/commission/upd/{$commission->id}") }}" class="btn btn-info btn-sm">Update</a>
                          </td>      
                          <td>
                            @if(auth()->user()->id == 1 or auth()->user()->id == 2)

                            <a href="{{ url("/commission/del/{$commission->id}") }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?') && confirm('Are you ready?') && confirm('Can not get back?')">Delete</a>
                            
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

   

    
    $("#user_id").change(function()
    {
      $('#btnshow').click();
    });  


    $("#customer_id").change(function()
    {
      $('#btnshow').click();
    });  


   



});

</script>         

@endsection