<?php 
  use App\Choice;
  use App\User;

  $user_name = User::where('id','=',$user_id)->value('name');

  $in_out = 1;

 ?>

@extends('layouts.app')
@section('content')

<div class="container">
<div class="row justify-content-center">
<div class="col-md-6">

    @if(session('info'))
      <div class="alert alert-danger">
      {{ session('info') }}
      </div>
    @endif 

</div>
</div>
</div>



<div class="container">
<div class="row justify-content-center">
<div class="col-md-6">

  <div class="card border-secondary">

      <div class="card-header">

            <div class="d-flex justify-content-between align-items-right">

                    <span class="card-text">
                       Name = {{ $user_name }}
                    </span> 

                     <span class="card-text">
                        <a href="{{ url("/3dsale/add/{$work_file_id}?s_id={$slip_id}&u_id={$user_id}") }}" class="btn btn-primary btn-sm" >
                           Edit Slip
                        </a>
                    </span> 
                  

                     <span class="card-text">
                        Slip = {{ $slip_id }}
                    </span> 
                    
              </div>


                             
                  <table class="table table-bordered">

                  <!-- <table class="table1 table-bordered table-striped table-sm header-fixed"> -->

                  <thead>
                      <tr>
                   
                        <th>စဉ်</th>      

                        <th>ဂဏန်း</th>  
                        <th>ယူနစ်</th>                      
                        <th>နေ့စွဲ</th>
               
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                          
                          $col_remark   = "";
                          $col_user     = "";
                          $col_customer = "";

                          $col_type     = "";
                          $col_slip     = "";


                          
                          $call_total   = 0;
                          $all_total    = 0;

                          $temp_slip = "";

                          $no = 1;

                       ?>

                     
                    
                     
                       @foreach($sales as $sale)  

                     
                                         
                            <tr>

                        
                           
                              

                              @if($bet == null)
                            
                                  <!-- <td>{{ $sale->slip_id }}</td> -->
                                  <td>{{ $no }} </td>
                                  <td>{{ $sale->digit }}</td>
                              
                              @endif

                              @if($bet == "position")
                             
                                  <!-- <td>P-{{ $sale->slip_id }}</td> -->
                                  <td>{{ $no }} </td>
                                  <td>{{ $sale->d1.$sale->d2 }}</td>
                            
                              @endif
                              


                              <td>{{ $sale->amount }}</td>

                              <td> {{ $sale->created_at->format('d/m/y h:m:s') }}</td>
                            
                          </tr>
                          

                          <?php 

                            $col_remark   = $sale->remark;
                            $col_user     = $sale->user_id;
                            $col_customer = $sale->customer_id;
                            $col_type     = $sale->type;
                            $col_slip     = $sale->slip_id;                            
                            
                            $all_total  += $sale->amount;
                            $no++;
                            
                          ?>           

                      @endforeach
                    


                      <tr style="border: 1px solid black;">  
                          <td colspan="2">TOTAL</td>
                          <td>{{ number_format($all_total) }}</td>                        
                          <td></td>
                      </tr>


                    
                  </tbody>
                </table>
                 
        </div> <!-- Card Header -->

        <div class="card-body">
          
          
        </div>
    </div> <!-- Card -->


              <?php 

                  $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');  

               ?>

              <div class="d-flex justify-content-between align-items-right">

                    <span class="card-text">
                        <a href="{{ url("/3dsale/add/{$work_file_id}") }}" class="btn btn-primary btn-sm" >
                           အရောင်း
                        </a>
                    </span> 


                    <span class="card-text">
                      <button onclick="window.print()">Print</button>
                    </span> 

                     <span class="card-text">
                        <a href="{{ url("/slip/list") }}" class="btn btn-primary btn-sm" >
                           Back
                        </a>
                    </span>                 

              </div>



</div>
</div>
</div>


@endsection