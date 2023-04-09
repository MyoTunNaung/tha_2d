<?php 
use App\ThreeDigit;
use App\ThreeSale;
use App\BreakAmount;

$total_sale = 0;
$total_purchase = 0;
$all_total = 0;

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
  .table1 thead 
  {
    flex: 0 0 auto;
  }
  .table1 tbody 
  {
   
    height: 290px;
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
                  3D ပွဲစဉ်ဇယား
              </div>

                <table class="table table-sm header-fixed">        
                <tbody>
                  <form method="get" action="{{ url("/3d/list/show") }}" enctype="multipart/form-data">
                  {{ csrf_field() }}

                    <tr>
                      <td>
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
               
            <table class="table1 table-sm header-fixed">
            <thead>
                <tr>
                    
                  <th>Digit</th> 
                  <th>Amount</th> 

                </tr>
            </thead>
            <tbody id="show_table">

              @for($first = 0; $first<10; $first++)
               @for($second = 0; $second<10; $second++)
                @for($third = 0; $third<10 ; $third++)                         
                
                    <tr> 

                    <td>{{ $first.$second.$third }}</td>

                    <?php 
                     

                      //test
                          $total_amt   = DB::table('three_sales')
                            ->leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                            ->where([
                                        ["three_sales.work_file_id","=",$work_file_id],
                                        ['three_sales.digit', '=', "$first$second$third"],
                                        ['three_sales.status', '=', 1],
                                        ['users.in_out', '!=', 2],
                                        
                                    ])
                            ->select('three_sales.*')
                            ->sum('three_sales.amount');
                        
                        $purchase_amt =    DB::table('three_sales')
                            ->leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                            ->where([
                                        ["three_sales.work_file_id","=",$work_file_id],
                                        ['three_sales.digit', '=', "$first$second$third"],
                                        ['users.in_out', '=', 2],
                                        
                                    ])
                            ->select('three_sales.*')
                            ->sum('three_sales.amount');



                          $balance = $total_amt - $purchase_amt;


                        // $break_amt      = BreakAmount::where([
                        //                         ["work_file_id","=",$work_file_id],
                        //                     ])
                        //                 ->value('amount');

                      
                            
                        //     $over_amt               = $total_amt-$break_amt;
                            
                        //     $bal_amt                = $over_amt-$purchase_amt;

                      //end test

                     ?>
<!-- 
                     @if($total_amt >= $break_amt)
                      <td style="color: red;">{{  $bal_amt   }} </td> 
                     @else
                      <td style="color: blue;">{{ -$purchase_amt  }} </td> 
                     @endif -->

                      @if($total_amt > $purchase_amt)
                      <td style="color: red;">{{ $balance }} </td> 
                     @else
                      <td style="color: blue;">{{ $balance }} </td> 
                     @endif
                     

                  </tr>

                @endfor
                @endfor
                @endfor
            
              
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
      // alert($('#show_table tr').height());

      $('#show_table').scrollTop( $('#show_table').scrollTop() + ($('#show_table tr').height()*99) );
    }
  function scrollPrevious()
    {
      $('#show_table').scrollTop( $('#show_table').scrollTop() - ($('#show_table').height()*99) );
    }
</script>  

@endsection