<?php 
use App\TwoDigit;
use App\TwoSale;
use App\BreakAmount;
?>

@extends('layouts.app')
@section('content')

<style type="text/css">
  .table1 
  {
    font-size: 12px;
    display: flex;
    flex-flow: column;
    width: 100%;
  }
  .table1  thead 
  {
    flex: 0 0 auto;
  }
  .table1 tbody 
  {
   
    height: 320px;
    flex: 1 1 auto;
    display: block;
    overflow-y: auto;
    overflow-x: hidden;
  }
  .table1 tr 
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
      <div class="alert alert-danger">
      {{ session('info') }}
      </div>
    @endif 

</div>
</div>
</div>

<!-- Filters -->
<div class="container">
<div class="row justify-content-center">
<div class="col-md-6 col-md-offset-2">

      <div class="card border-secondary">

          <div class="card-header">
              2D Work File
          </div>

          <table class="table table-sm header-fixed">        
          <tbody>
            <form method="get" action="{{ url("/2d/list/show") }}" enctype="multipart/form-data">
            {{ csrf_field() }}

              <tr>
                <td >
                                         
                    <select name="work_file_id" id="work_file_id" class="form-control">
                        
                      @foreach($work_files as $work_file)
                        <option value="{{ $work_file->id }}" @if($work_file->id == $work_file_id) selected @endif>
                          {{ $work_file->show }}
                        </option>
                      @endforeach
                    </select>
                 
                </td>                
              </tr>                                
                                
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
<div class="col-md-6 col-md-offset-2">         

      <div class="card border-secondary">

            <div class="card-header">
                  <div class="float-left">

                    <span style="color: blue;">IN</span>  [ {{ number_format($total_sale) }} ]  

                    @if($all_total <0)
                      <span style="color: red;"> Net </span> [ {{ number_format($all_total) }} ] 
                    @else
                      <span style="color: blue;"> Net </span> [ {{ number_format($all_total) }} ] 
                    @endif                    
                    
                    <span style="color: red;">OUT </span>[ {{ number_format($total_purchase) }} ]
                  </div>                   
            </div>

            <table class="table1 table-stripped table-sm">
            <thead>
                <tr>
                  <th>Digit</th> 
                  <th>Amount</th> 

                </tr>
            </thead>
            <tbody id="show_table">

               @for($col = 0; $col<10; $col++)                                       
                    @for($row = 0; $row<10 ; $row++) 
                    
                    <tr > 
                   
                    <td >{{ $col.$row }}</td>

                    <?php 
                            $digit = "$col.$row";

                            $total_amt   = DB::table('two_sales')
                                              ->leftJoin('customers', 'two_sales.customer_id', '=', 'customers.id')
                                              ->where([
                                                          ["two_sales.work_file_id","=",$work_file_id],
                                                          ['two_sales.digit', '=', "$col$row"],
                                                          ['two_sales.status', '=', 1],
                                                          ['customers.in_out', '!=', 2],
                                                          
                                                      ])
                                              ->select('two_sales.*')
                                              ->sum('two_sales.amount');
                                          
                            $purchase_amt =    DB::table('two_sales')
                                              ->leftJoin('customers', 'two_sales.customer_id', '=', 'customers.id')
                                              ->where([
                                                          ["two_sales.work_file_id","=",$work_file_id],
                                                          ['two_sales.digit', '=', "$col$row"],
                                                          ['customers.in_out', '=', 2],
                                                          
                                                      ])
                                              ->select('two_sales.*')
                                              ->sum('two_sales.amount'); 
                                              
                            $balance = $total_amt - $purchase_amt                                
                      
                     ?>

                     @if($total_amt > $purchase_amt)
                      <td style="color: red;">{{ $balance }} </td> 
                     @else
                      <td style="color: blue;">{{ $balance }} </td> 
                     @endif

                     </tr>

                    @endfor

                @endfor               
                
                <tr>
                  <td> </td>
                  <td></td>
                </tr>

            </tbody>  

            

          </table>  

           <div class="d-flex justify-content-between align-items-center" style="border-top: 1px solid black;">

                <span style="padding: 10px;"><button onclick="scrollPrevious()" class="btn btn-sm btn-info" > Previous </button></span>
                <span style="padding: 10px;"><button onclick="scrollNext()" class="btn btn-sm btn-info"> Next </button></span>
                
            </div>            

    </div>

</div>
</div>
</div>


  
<script>
$(document).ready(function()
{

    $("#work_file_id").change(function()
    {
      $('#btnshow').click();
    }); 
    
});
</script>  


<script>
   function scrollNext()
    {
      

      $('#show_table').scrollTop( $('#show_table').scrollTop() + $('#show_table').height() );
    }
  function scrollPrevious()
    {
      $('#show_table').scrollTop( $('#show_table').scrollTop() - $('#show_table').height() );
    }
</script>

@endsection