
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




<input type="text" name="two_three" value="{{ $action }}" id="two_three" hidden>


<div class="container">
<div class="row justify-content-center">
<div class="col-md-6">

  <div class="card">


  <div class="card-header">

      <form method="get" action="{{ url("/saleslip/list/show") }}" enctype="multipart/form-data">

      {{ csrf_field() }}  
 
      <input type="text" name="action"    value="{{ $action }}"         id="action"  hidden >

      <div class="d-flex justify-content-between align-items-center">
                     
          <span class="card-text"> 
                <select name="three_work_file_id" id="three_work_file_id" class="form-control">              
                    @foreach($work_files as $work_file)
                      <?php 
                              $date           = date_create("$work_file->date");
                              $work_file_date = date_format($date,"d-m-Y");
                       ?>
                      @if($work_file->name == "3D")
                      <option value="{{ $work_file->id }}" @if($work_file->id == $three_work_file_id) selected @endif>
                        {{ $work_file->name." [ ".$work_file_date." ] " }}
                      </option>
                      @endif
                    @endforeach
                  </select>
          </span>

          <span class="card-text">
              Slips
          </span>

          <span class="card-text">
                  
                  <select name="slip_id" id="slip_id" class="form-control">
                      <option value="0" @if($slip_id == "0") selected @endif>All</option>
                    @foreach($slips as $slip)
                      <option value="{{ $slip->slip_id }}" @if($slip->slip_id == $slip_id) selected @endif>
                        {{ $slip->slip_id}}
                      </option>
                    @endforeach
                  </select>   
          </span> 

      </div>                     
              <label hidden >Show</label><br>
              <input hidden type="submit"  value="Show"  id="btnShow"  class="btn btn-info btn-sm">
      </form>

    </div> <!-- Card Header -->

  </div> <!-- Card -->


</div>
</div>
</div>





<div class="container">
<div class="row justify-content-center">
<div class="col-md-6">

  <div class="card border-secondary">

      <div class="card-header">
                             
                  <table class="table table-striped table-sm">
                  <thead>
                      <tr>
                   
                        <th>စလစ်</th>                            
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

                       ?>

                     
                      @foreach($slips as $slip)

                       @if(auth()->user()->id == 1 || auth()->user()->id == 2 )
                     
                       @foreach($sales as $sale)  

                     
                            @if($sale->slip_id == $slip->slip_id)

                       
                            <tr>

                        
                           
                              <td>{{ $sale->slip_id }}</td>
                              <td>{{ $sale->digit }}</td>
                              <td>{{ $sale->amount }}</td>

                              <td> {{ $sale->created_at->format('d/m/Y') }}</td>
                            
                          </tr>
                          

                          <?php 

                            $col_remark   = $sale->remark;
                            $col_user     = $sale->user_id;
                            $col_customer = $sale->customer_id;
                            $col_type     = $sale->type;
                            $col_slip     = $sale->slip_id;
                            
                            
                            $all_total  += $sale->amount;
                          ?>           


                          @endif

                          @endforeach

                          <tr style="background-color: lightgray;">
                         

                           <td colspan="2">Call Total </td>
                            <td>{{ $slip->call_total }} </td>
                            <td></td>

                          </tr>      

                   
                    @else
                    
                          @foreach($sales as $sale)  

                     
                            @if($sale->slip_id == $slip->slip_id && $sale->user_id == auth()->user()->id )

                       
                            <tr>
                             
                           
                              <td>{{ $sale->slip_id }}</td>
                              <td>{{ $sale->digit }}</td>
                              <td>{{ $sale->amount }}</td>

                              <td> {{ $sale->created_at->format('d/m/Y') }}</td>
                            
                          </tr>
                          

                          <?php 

                            $col_remark   = $sale->remark;
                            $col_user     = $sale->user_id;
                            $col_customer = $sale->customer_id;
                            $col_type     = $sale->type;
                            $col_slip     = $sale->slip_id;
                            
                            
                            $all_total  += $sale->amount;
                            
                          ?>     

                          <?php $temp_slip = $slip->slip_id;  ?>


                          @endif

                          @endforeach


                        @if(auth()->user()->id == 1 || auth()->user()->id == 2)

                        <tr style="background-color: lightgray;">
                          <td colspan="2">Call Total </td>
                          <td>{{ $slip->call_total }} </td>
                          <td></td>
                        </tr>   

                        @else

                            @if($slip->slip_id == $temp_slip)

                                 <tr style="background-color: lightgray;">
                                    <td colspan="2">Call Total </td>
                                    <td>{{ $slip->call_total }} </td>
                                    <td></td>
                                  </tr>   

                            @endif

                        @endif




                  
                    @endif                  

                       

                      @endforeach
                    


                      <tr style="border: 1px solid black;">  
                          <td colspan="2">TOTAL</td>
                          <td>{{ number_format($all_total) }}</td>                        
                          <td></td>
                      </tr>


                    
                  </tbody>
                </table>
                 
        </div> <!-- Card Header -->
    </div> <!-- Card -->


</div>
</div>
</div>


 <script>
$(document).ready(function()
{

    var two_three = $("#two_three").val();

    // if(two_three == "Two_AM")
    // {
    //   $("#two_am_panel").click();
    // }

    //  if(two_three == "Two_PM")
    // {
    //   $("#two_pm_panel").click();
    // }


    if(two_three == "Three")
    {
      $("#three_panel").click();
    }


    //  $("#two_am_panel").click(function()
    // {
    //   $('#two_am_work_file_id').change();
    // });

    // $("#two_pm_panel").click(function()
    // {
    //   $('#two_pm_work_file_id').change();
    // });


    //  $("#three_panel").click(function()
    // {
    //   $('#three_work_file_id').change();
    // });



    // $("#two_am_work_file_id").change(function()
    // {
    //   $('#btnTwo_AM').click();
    // });

    //  $("#two_pm_work_file_id").change(function()
    // {
    //   $('#btnTwo_PM').click();
    // });


     $("#three_work_file_id").change(function()
    {
      $('#btnShow').click();
    });

      $("#slip_id").change(function()
    {
      $('#btnShow').click();
    });





    //  $("#in_out").change(function()
    // {
    //   $('#btnshow').click();

    // });



    // $("#slip_id").change(function()
    // {
    //   $('#btnshow').click();
    // });


    // $("#user_id").change(function()
    // {
    //   $('#btnshow').click();
    // });

    // $("#customer_id").change(function()
    // {
    //   $('#btnshow').click();
    // });

  
    

});


</script>       
@endsection