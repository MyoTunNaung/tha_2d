<?php 
use App\ThreeDigit;
use App\ThreeSale;
use App\BreakAmount;
use App\Choice;
use App\Two;
use App\WorkFile;
use App\User;


// $break_amt       = BreakAmount::where("work_file_id","=",$work_file_id)->value('amount');

$w_times         = WorkFile::where('id','=',$work_file_id)->value('w_times');



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

   @if(session('total_all_amount'))
      <div class="alert alert-danger">
      {{ session('total_all_amount') }}
      </div>
    @endif 


</div>
</div>
</div>

<!-- <h1>Here</h1> -->

<!-- Filters -->
<div class="container_fluid">
<div class="row justify-content-center">
<div class="col-md-6 col-md-offset-2">

      <div class="card border-secondary">

           <!--    <div class="card-header">
                  3D ပွဲစဉ်ဇယား
              </div> -->

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

                       <td>
                                                  
                            <select name="user_id" id="user_id" class="form-control">


                            @if(Auth::check())
                                @if(auth()->user()->id == 1 or auth()->user()->id == 2)

                                  <option value="0" @if($user_id =="0") selected @endif> All </option>
                                  @foreach($users as $user)
                                    <option value="{{ $user->id }}" @if($user->id == $user_id) selected @endif >
                                      {{ $user->name }}
                                    </option>
                                  @endforeach

                                @else

                                  @foreach($users as $user)
                                      @if($user->id == auth()->user()->id)
                                      <option value="{{ $user->id }}">
                                        {{ $user->name }}
                                      </option>
                                      @endif 
                                  @endforeach

                                @endif

                            @endif

                          </select>
                       
                      </td> 

                      <td>
                         <input type="text" name="break_amt" id="break_amt"  value="{{ $break_amt }}" style="font-weight: bold;width: 100px;" class="form-control">
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



<div class="container_fluid">
<div class="row justify-content-center mx-auto px-auto">
<div class="col-md-10">

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

<!-- 
                    [ {{ round($all_total/$break_amt) }} % ]

                    [ <span style="color: red;">  {{ $digit_count_all_amount }}  </span> : 
                      <span style="color: blue;"> {{ 100 - $digit_count_all_amount }} </span> ] 

 -->
                  </div>   
                 <!--  <br>
                  <div>
                    <form method="get" action="{{ url("3d/gameplay") }}" enctype="multipart/form-data">
                      {{ csrf_field() }} 

                        <input type="text" name="work_file_id" value="{{$work_file_id}}" hidden>

                         <div class="float-left">                         
                          <input type="number" name="all"  placeholder="All" style="width: 150px;" >
                        </div>

                        <div class="float-right">
                          <input type="number" name="percent"  placeholder="Percent" style="width: 150px;" >                          
                        </div>

                        <input hidden type="submit"  value="Show"   name="action" id="btnShow"  class="btn btn-info btn-sm">

                    </form>
                  </div>

                  <br><br>
 -->
                  <div>

                    @if(is_numeric($all_amount))
                      <span style="color: blue;"> All </span>
                      <span> {{ $all_amount }} </span>
                      
                      <span style="color: blue;"> Total </span>
                      <span> {{ $total_all_amount }} </span>

                      <span style="color: blue;"> Average </span>
                      <span>  {{ round($total_all_amount / $all_amount) }} % </span> <br>

                      <span style="color: blue;"> Balance </span>
                      <span>   {{ $all_total - $total_all_amount }} </span>

                      <span style="color: blue;">  Average </span>
                      <span>   {{ round( ($all_total - $total_all_amount) / ($break_amt - $all_amount) ) }} %</span>

                      <span style="color: blue;"> NetTotal </span>
                      <span> {{ round(  (($all_amount * $w_times) - ($total_all_amount - ($total_all_amount*25/100)) ))}} </span>
                                           
                    @endif

                    @if(is_numeric($percent_amount))
                      <span style="color: blue;"> Percent </span>
                      <span>  {{ $percent_amount }} </span>

                      <span style="color: blue;"> Total </span>
                      <span> {{ $total_percent_amount }} </span>

                      <span style="color: blue;"> Average </span>
                      <span> {{ round($total_percent_amount / $percent_amount) }} % </span> <br>

                      <span style="color: blue;"> Balance </span>
                      <span>  {{ $all_total - $total_percent_amount }} 

                      <span style="color: blue;"> Average </span>
                      <span>  {{ round( ($all_total - $total_percent_amount) / ($break_amt - $percent_amount) ) }} %</span>

                      <span style="color: blue;"> NetTotal </span>
                      <span>  {{ round(  (($percent_amount * 550) + ($percent_amount * 7 * 10)) -  
                                           ($total_percent_amount - ($total_percent_amount*25/100)) ) }} </span>
                                           
                    @endif

                      
                  </div>
                                  
            </div>


            <div class="table-responsive">
            <table class="table table-bordered table-sm">
              <thead>
                <tr>
                    
                  <th>Digit</th> 
                  <th>Unit</th> 

                  <th>Digit</th> 
                  <th>Unit</th> 

                  <th>Digit</th> 
                  <th>Unit</th> 

                  <th>Digit</th> 
                  <th>Unit</th> 

                  <th>Digit</th> 
                  <th>Unit</th> 

                  <th>Digit</th> 
                  <th>Unit</th> 

                  <th>Digit</th> 
                  <th>Unit</th> 

                  <th>Digit</th> 
                  <th>Unit</th> 

                  <th>Digit</th> 
                  <th>Unit</th> 

                  <th>Digit</th> 
                  <th>Unit</th> 

                 <!--  <th>All</th>
                  <th>Percent</th> -->

                </tr>
              </thead>

              <tbody id="show_table">

                <?php 

                    $break_amount    = $break_amt;
                ?>

                @for($first = 0; $first<10; $first++)

                   <tr> 

                @for($second = 0; $second<10; $second++)

                    <?php 
                          $digit = $second.$first;

                          $threes = Two::where('digit','=',$digit)->get();

                          foreach($threes as $three)
                          {
                            if($user_id == 0)
                            { 
                              $balance = $three->sale_amount - $three->purchase_amount;  
                            }
                            else
                            {
                              $balance = $three->sale_amount;
                            }
                            
                          }
                     ?>

                    @if($first == 0 )

                        <td style="background-color: #e6e8e3;text-align: center; font-weight: bold;">{{ $digit }}</td>
                        
                        @if($balance < 0)                     
                          <td style="color: green;">{{ number_format($balance) }} </td> 
                        @elseif($balance < $break_amount)                     
                          <td style="color: black;">{{ number_format($balance) }} </td> 
                        @elseif($balance == $break_amount)
                          <td style="color: blue;">{{ number_format($balance) }} </td> 
                        @else                    
                          <td style="color: red;">{{ number_format($balance) }} </td> 
                        @endif

                    @endif

                     @if($first == 1 )
                     
                        <td style="background-color: #e6e8e3;text-align: center; font-weight: bold;">{{ $digit }}</td>
                        
                        @if($balance < 0)                     
                          <td style="color: green;">{{ number_format($balance) }} </td> 
                        @elseif($balance < $break_amount)                     
                          <td style="color: black;">{{ number_format($balance) }} </td> 
                        @elseif($balance == $break_amount)
                          <td style="color: blue;">{{ number_format($balance) }} </td> 
                        @else                    
                          <td style="color: red;">{{ number_format($balance) }} </td> 
                        @endif

                    @endif

                     @if($first == 2 )

                        <td style="background-color: #e6e8e3;text-align: center; font-weight: bold;" >{{ $digit }}</td>
                        
                         @if($balance < 0)                     
                          <td style="color: green;">{{ number_format($balance) }} </td> 
                        @elseif($balance < $break_amount)                     
                          <td style="color: black;">{{ number_format($balance) }} </td> 
                        @elseif($balance == $break_amount)
                          <td style="color: blue;">{{ number_format($balance) }} </td> 
                        @else                    
                          <td style="color: red;">{{ number_format($balance) }} </td> 
                        @endif

                    @endif

                     @if($first == 3 )

                        <td style="background-color: #e6e8e3;text-align: center; font-weight: bold;">{{ $digit }}</td>
                        
                        @if($balance < 0)                     
                          <td style="color: green;">{{ number_format($balance) }} </td> 
                        @elseif($balance < $break_amount)                     
                          <td style="color: black;">{{ number_format($balance) }} </td> 
                        @elseif($balance == $break_amount)
                          <td style="color: blue;">{{ number_format($balance) }} </td> 
                        @else                    
                          <td style="color: red;">{{ number_format($balance) }} </td> 
                        @endif

                    @endif

                     @if($first == 4 )

                        <td style="background-color: #e6e8e3;text-align: center; font-weight: bold;">{{ $digit }}</td>
                        
                         @if($balance < 0)                     
                          <td style="color: green;">{{ number_format($balance) }} </td> 
                        @elseif($balance < $break_amount)                     
                          <td style="color: black;">{{ number_format($balance) }} </td> 
                        @elseif($balance == $break_amount)
                          <td style="color: blue;">{{ number_format($balance) }} </td> 
                        @else                    
                          <td style="color: red;">{{ number_format($balance) }} </td> 
                        @endif

                    @endif

                     @if($first == 5 )

                        <td style="background-color: #e6e8e3;text-align: center; font-weight: bold;">{{ $digit }}</td>
                        
                         @if($balance < 0)                     
                          <td style="color: green;">{{ number_format($balance) }} </td> 
                        @elseif($balance < $break_amount)                     
                          <td style="color: black;">{{ number_format($balance) }} </td> 
                        @elseif($balance == $break_amount)
                          <td style="color: blue;">{{ number_format($balance) }} </td> 
                        @else                    
                          <td style="color: red;">{{ number_format($balance) }} </td> 
                        @endif

                    @endif

                     @if($first == 6 )

                        <td style="background-color: #e6e8e3;text-align: center; font-weight: bold;">{{ $digit }}</td>
                        
                         @if($balance < 0)                     
                          <td style="color: green;">{{ number_format($balance) }} </td> 
                        @elseif($balance < $break_amount)                     
                          <td style="color: black;">{{ number_format($balance) }} </td> 
                        @elseif($balance == $break_amount)
                          <td style="color: blue;">{{ number_format($balance) }} </td> 
                        @else                    
                          <td style="color: red;">{{ number_format($balance) }} </td> 
                        @endif

                    @endif

                     @if($first == 7 )

                        <td style="background-color: #e6e8e3;text-align: center; font-weight: bold;">{{ $digit }}</td>
                        
                         @if($balance < 0)                     
                          <td style="color: green;">{{ number_format($balance) }} </td> 
                        @elseif($balance < $break_amount)                     
                          <td style="color: black;">{{ number_format($balance) }} </td> 
                        @elseif($balance == $break_amount)
                          <td style="color: blue;">{{ number_format($balance) }} </td> 
                        @else                    
                          <td style="color: red;">{{ number_format($balance) }} </td> 
                        @endif

                    @endif

                     @if($first == 8 )

                        <td style="background-color: #e6e8e3;text-align: center; font-weight: bold;">{{ $digit }}</td>
                        
                         @if($balance < 0)                     
                          <td style="color: green;">{{ number_format($balance) }} </td> 
                        @elseif($balance < $break_amount)                     
                          <td style="color: black;">{{ number_format($balance) }} </td> 
                        @elseif($balance == $break_amount)
                          <td style="color: blue;">{{ number_format($balance) }} </td> 
                        @else                    
                          <td style="color: red;">{{ number_format($balance) }} </td> 
                        @endif

                    @endif

                     @if($first == 9 )

                        <td style="background-color: #e6e8e3;text-align: center; font-weight: bold;">{{ $digit }}</td>
                        
                         @if($balance < 0)                     
                          <td style="color: green;">{{ number_format($balance) }} </td> 
                        @elseif($balance < $break_amount)                     
                          <td style="color: black;">{{ number_format($balance) }} </td> 
                        @elseif($balance == $break_amount)
                          <td style="color: blue;">{{ number_format($balance) }} </td> 
                        @else                    
                          <td style="color: red;">{{ number_format($balance) }} </td> 
                        @endif

                    @endif

                  

                @endfor

                  </tr>

                @endfor

              </tbody>

            </table>
            </div>
               
            <!-- <table class="table1 table-sm header-fixed">
            <thead>
                <tr>
                    
                  <th>Digit</th> 
                  <th>Amount</th> 

                  <th>All</th>
                  <th>Percent</th>

                </tr>
            </thead>

            <tbody id="show_table">
                <?php  $break_amount    = BreakAmount::where([ ["work_file_id","=",$work_file_id], ])
                                                ->value('amount');

               ?>

              @foreach($threes as $three)

                <?php 
                      $balance = $three->sale_amount - $three->purchase_amount
                 ?>
                <tr>
                    <td>{{ $three->digit }}</td>

                    @if($balance < 0)                     
                      <td style="color: green;">{{ $balance }} </td> 
                    @elseif($balance < $break_amount)                     
                      <td style="color: black;">{{ $balance }} </td> 
                    @elseif($balance == $break_amount)
                      <td style="color: blue;">{{ $balance }} </td> 
                    @else                    
                      <td style="color: red;">{{ $balance }} </td> 
                    @endif
                    
                    <td>{{ $three->all_amount }}</td>
                    <td>{{ $three->percent_amount }}</td>
                </tr>
               @endforeach

            </tbody> -->


            <!-- <tbody id="show_table">

              <?php  $break_amount    = BreakAmount::where([ ["work_file_id","=",$work_file_id], ])
                                                ->value('amount');

               ?>

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
                                        ['users.in_out', '=', 1],                                        
                                    ])                           
                            ->sum('three_sales.amount');

                            // $total_amt   = ThreeSale::where([                                           
                                
                            //                             ["work_file_id","=",$work_file_id], 
                            //                             ["user_id","=",$user_id],                                   
                            //                             ["status","=",1],                                   
                            //                         ])
                            //                     ->sum('amount');


                        
                        $purchase_amt =    DB::table('three_sales')
                            ->leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                            ->where([
                                        ["three_sales.work_file_id","=",$work_file_id],
                                        ['three_sales.digit', '=', "$first$second$third"],
                                        ['users.in_out', '=', 2],
                                        
                                    ])                         
                            ->sum('three_sales.amount');


                          $balance = $total_amt - $purchase_amt;


                     ?>

                    
                     @if($total_amt <= $break_amount)                     
                      <td >{{ $balance }} </td> 
                     @else
                      <td style="color: red;">{{ $balance }} </td> 
                     @endif


                     <td>0</td>
                     <td>0</td>

                  </tr>

                @endfor
                @endfor
                @endfor
            
              
            </tbody> -->


          </table>

          <div class="d-flex justify-content-between align-items-center" style="border-top: 1px solid black;">

             <!--    <span style="padding: 10px;">
                  <button onclick="scrollPrevious()" class="btn btn-sm btn-info" style="background: green; color: white;"> Previous </button>
                </span>

 -->
              
                  <span class="card-text">
                      <a href="{{ url("/3dsale/add/{$work_file_id}") }}" class="btn btn-primary btn-sm" >
                         အရောင်း
                      </a>
                  </span>    

                   <span class="card-text">
                      <button onclick="window.print()">Print</button>
                    </span>           

              
                  <span class="card-text">
                      <a href="{{ url("/") }}" class="btn btn-primary btn-sm" >
                         Back
                      </a>
                  </span> 

              <!--   <span style="padding: 10px;">
                  <button onclick="scrollNext()" class="btn btn-sm btn-info" style="background: #ebb734;color: white;"> Next </button>
                </span> -->
                
            </div>  
               
      </div>

</div>

<!-- Max Box -->
<div class="col-md-2">
  <div class="card border-secondary">


      <div class="table-responsive">
            <table class="table1 table-bordered table-sm">
            <tbody id="max_table" style="color: black;font-style: bold;height: 400px;" >

                                  
                  <tr>
                     <th style="font-size: 12px;">Digit</th>
                     <th style="font-size: 12px;">Amt</th>
                  </tr> 

                  <?php $max_total = 0; ?>

                  @for($first = 0; $first<10; $first++)
                  @for($second = 0; $second<10; $second++)

                  <?php 
                        $digit = $first.$second;

                        $threes = Two::where('digit','=',$digit)->get();

                        foreach($threes as $three)
                        {
                          
                            if($user_id == 0)
                            { 
                              $balance = $three->sale_amount - $three->purchase_amount;  
                            }
                            else
                            {
                              $balance = $three->sale_amount;
                            }
                        }
                   ?>

                   @if($balance > $break_amt)
                      <?php $over = $balance - $break_amt; $max_total += $over; ?>

                      <tr>
                          <td>{{$digit}}</td>
                          <td>{{$over}}</td>
                      </tr>

                   @endif

                  @endfor
                  @endfor

            </tbody>
            </table>

            <div class="d-flex justify-content-between align-items-center" style="border-top: 1px solid black;">
                <span></span>
                <span class="card-text" style="color: red;font-size: 14px;">
                  Max-Total : {{number_format($max_total)}}
                </span>
                <span></span>
            </div>


      </div>


  </div>
</div>
<!-- Max Box -->

</div>
</div>



<script>
$(document).ready(function()
{

    $("#work_file_id").change(function()
    {
      $('#btnshow').click();
    });

     $("#user_id").change(function()
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