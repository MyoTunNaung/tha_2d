<?php 
use App\WorkFile;
use App\User;
use App\Customer;

?>

@extends('layouts.app')
@section('content')

<style type="text/css">
  /*table 
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
  }*/
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

<input type="text" name="two_three" value="{{ $action }}" id="two_three" hidden>





<!-- Filters -->
  <div class="container">
  <div class="row justify-content-center">
  <div class="col-md-6 col-md-offset-2">

      <div class="card">

              <div class="card-header">
                 <ul class="nav nav-tabs" role="tablist">

                    <li role="presentation" class="nav-item active">
                        <a href="#two_am" aria-controls="two_am" role="tab" data-toggle="tab" class="nav-link" id="two_am_panel">2D AM</a>
                    </li>

                    <li role="presentation" class="nav-item ">
                        <a href="#two_pm" aria-controls="two_pm" role="tab" data-toggle="tab" class="nav-link" id="two_pm_panel">2D PM</a>
                    </li>
                  

                    <li role="presentation" class="nav-item">
                        <a href="#three" aria-controls="three" role="tab" data-toggle="tab" class="nav-link" id="three_panel">3D</a>
                    </li>

                    <li role="presentation" class="nav-item">
                        <a href="#all" aria-controls="all" role="tab" data-toggle="tab" class="nav-link" id="all_panel">All</a>
                    </li>

                    <li role="presentation" class="nav-item">
                        <a href="#main" aria-controls="main" role="tab" data-toggle="tab" class="nav-link" id="main_panel">Main</a>
                    </li>

                   

                   
                  </ul>
            </div>




              <!-- Nav tabs -->
<div class="card-body">

  <form method="get" action="{{ url("/user/list/result/show") }}" enctype="multipart/form-data">

  {{ csrf_field() }}  
 
  <!-- Tab panes --> 
  <div class="tab-content">

    <div role="tabpanel" class="tab-pane active"  id="two_am">

        <div class="form-group">                         
        <select name="two_am_work_file_id" id="two_am_work_file_id" class="form-control" > 

            @foreach($work_files as $work_file)
              <?php 
                      $date           = date_create("$work_file->date");
                      $work_file_date = date_format($date,"d-m-Y");
               ?>
             

              @if($work_file->name == "2D" && $work_file->duration == "AM")
              <option value="{{ $work_file->id }}" @if($work_file->id == $two_am_work_file_id) selected @endif>
                {{ $work_file->name." ".$work_file->duration." [ ".$work_file_date." ] "}}
              </option>
              @endif
            @endforeach

        </select>
        </div>       

    </div>

    <div role="tabpanel" class="tab-pane"  id="two_pm">

        <div class="form-group">                         
        <select name="two_pm_work_file_id" id="two_pm_work_file_id" class="form-control" > 

            @foreach($work_files as $work_file)

              <?php 
                      $date           = date_create("$work_file->date");
                      $work_file_date = date_format($date,"d-m-Y");
               ?>

              @if($work_file->name == "2D" && $work_file->duration == "PM")
              <option value="{{ $work_file->id }}" @if($work_file->id == $two_pm_work_file_id) selected @endif>
                  {{ $work_file->name." ".$work_file->duration." [ ".$work_file_date." ] "}}
              </option>
              @endif
            @endforeach

        </select>
        </div>       

    </div>

   


    <div role="tabpanel" class="tab-pane"         id="three">

          <div class="form-group">                         
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
        </div>
    
    </div>

     <div role="tabpanel" class="tab-pane"  id="all">

       <div class="form-group">
              
              <select name="twod_threed" id="twod_threed" class="form-control">                
              <option value="2D" @if($twod_threed=="2D") selected @endif>2D</option>
              <option value="2D/3D" @if($twod_threed=="2D/3D") selected @endif >2D/3D</option>               
              </select>
      </div>  

    </div>

     <div role="tabpanel" class="tab-pane"  id="main">
         <div class="form-group">
                      
                      <select name="main_two_three" id="main_two_three" class="form-control">                
                      <option value="2D_AM" @if($main_two_three=="2D_AM") selected @endif>2D_AM</option>
                      <option value="2D_PM" @if($main_two_three=="2D_PM") selected @endif>2D_PM</option>
                      <option value="3D" @if($main_two_three=="3D") selected @endif >3D</option>               
                      </select>
          </div>     

    </div>

  </div>
<!-- Tab panes --> 



  <table class="table table-sm header-fixed" >        
  <tbody> 

      <tr>
              <td colspan="2">
              <div class="form-group">
                <label>FromDate</label>
                <input type="date" name="from_date" id="from_date" class="form-control" value="{{ $from_date }}">
              </div>
              </td>

            <td colspan="2">
            <div class="form-group">
              <label>ToDate</label>
              <input type="date" name="to_date" id="to_date" class="form-control" value="{{ $to_date }}">
            </div>
            </td>        
      </tr>

      <tr>                                            
          <td>
            <div>
              <label>Users</label><br>
              <select name="user_id" id="user_id" >

                @if(auth()->user()->id == 1 || auth()->user()->id == 2)
                  <option value="0">None</option>
                @endif

                @foreach($users as $user)
                  <option value="{{ $user->id }}" @if($user->id == $user_id) selected @endif>
                    {{ $user->name}}
                  </option>
                @endforeach
              </select>
            </div>
          </td> 


          @if(auth()->user()->id == 1 || auth()->user()->id == 2)

          <td>
            <div >
              <label>Customers</label><br>
              <select name="customer_id" id="customer_id" >
                  
                @foreach($customers as $customer)
                  <option value="{{ $customer->id }}" @if($customer->id == $customer_id) selected @endif>
                    
                      {{ $customer->name }}
                    
                  </option>
                @endforeach
              </select>
            </div>
          </td> 

         
           <td>
            <div >
              <label>IN/OUT</label><br>
              <select name="in_out" id="in_out" >
                
              <option value="1" @if($in_out==1) selected @endif>IN</option>
              <option value="2" @if($in_out==2) selected @endif >OUT</option>
               
              </select>
            </div>
          </td> 
          @else
          <td></td>
          <td></td>
          @endif

           
         <td>
          <div >
            <label>Slips</label><br>
            <select name="slip_id" id="slip_id" >
                <option value="0" @if($slip_id == "0") selected @endif>All</option>
              @foreach($slips as $slip)
                <option value="{{ $slip->slip_id }}" @if($slip->slip_id == $slip_id) selected @endif>
                  {{ $slip->slip_id}}
                </option>
              @endforeach
            </select>
          </div>
        </td> 

        </tr>


            
            <label hidden >Show</label><br>  

            <input hidden type="submit"  value="Show"       name="action" id="btnshow"  class="btn btn-info btn-sm">

            <input hidden type="submit"  value="Two_AM"    name="action" id="btnTwo_AM"   class="btn btn-info btn-sm">
            <input hidden type="submit"  value="Two_PM"    name="action" id="btnTwo_PM"   class="btn btn-info btn-sm">

            <input hidden type="submit"  value="Three"     name="action" id="btnThree"    class="btn btn-info btn-sm">

            <input hidden type="submit"  value="All"     name="action" id="btnAll"    class="btn btn-info btn-sm">
            <input hidden type="submit"  value="Main"     name="action" id="btnMain"    class="btn btn-info btn-sm">

           

        </form>
      </tbody>
      </table>  

   
  
 



</div>
</div>
</div>
</div>
  <!-- End Filters -->




@if($total_amount != 0)

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-2"> 

        <!-- <div class="card">
            <div class="card-header">
              <a class="btn btn-primary btn-sm" href="{{ url("/result/add") }}">
                Add New Result (Result  အချက်အလက်  အသစ်ထည့်ရန် )
              </a>
            </div> 
        </div>   -->         
            
         

            <?php 

                $user_name   = User::where([ 
                                              ["id","=","$user_id"] 
                                          ])
                                    ->value('name');

                $customer_name   = Customer::where([ 
                                              ["id","=","$customer_id"] 
                                          ])
                                    ->value('name');

                if($work_file_id == 0)
                {
                  $work_file_name = "ပွဲစဉ်အားလုံး";
                }
                else
                {
                  $work_file_name   = WorkFile::where([
                                                      ["id","=","$work_file_id"]
                                                    ])
                                              ->value('show');
                }

                
             ?>

         

            <div class="card">

                  <div class="card-header">
                    @if($customer_name == "Admin")
                      ID: {{ $user_name }}
                    @elseif( ($user_id == 1 || $user_id == 2) && $customer_name != "Admin")
                      ID: {{ $customer_name }}
                    @Endif
                  </div>
                 <!--  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; UserId</span>
                      <span class="card-text">{{ $user_name }} &nbsp;</span>
                  </div> -->
                  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; WorkFile [ပွဲစဉ်]</span>
                      <span class="card-text">{{ $work_file_name }} &nbsp;</span>
                  </div>

                  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; TotalAmount [ထိုးကြေး]</span>
                      <span class="card-text">{{ number_format($total_amount) }} &nbsp;</span>
                  </div>  
                  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; CommissionAmount [ကော်မရှင်]</span>
                      <span class="card-text">{{ number_format($commission_amount) }} &nbsp;</span>
                  </div> 
                  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; NetTotal [ကော်နုတ်ပြီး ထိုးကြေး]</span>
                      <span class="card-text">
                            {{ number_format($net_total) }} &nbsp;
                      </span>
                  </div>     
                  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; DigitAmount [ဒဲ့]</span>
                      <span class="card-text">{{ number_format($digit_amount) }} &nbsp;</span>
                  </div>

                  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; OtherAmount [တွတ်]</span>
                      <span class="card-text">{{ number_format($other_amount) }} &nbsp;</span>
                  </div>   

                   <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; CompensationAmount [လျော်ကြေး]</span>
                      <span class="card-text">{{ number_format($compensation_amount) }} &nbsp;</span>
                  </div>

                  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; NetBalance [ရ/ပေး]</span>
                      <span class="card-text">
                        {{ number_format($balance) }} &nbsp;
                      </span>
                  </div>                          

                                       

                  <div class="card-body"> 
                  <div class="d-flex justify-content-between align-items-center">
                      
                      
                      @if(auth()->user()->id == 1 or auth()->user()->id == 2)

                      <a href="{{ url("/result/upd/") }}" class="btn btn-info btn-sm">
                        Update
                      </a>

                       <a href="{{ url("/result/del/") }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?') && confirm('Are you ready?') && confirm('Can not get back?')">
                       Delete
                      </a>
                            
                      @endif

                  </div>
                  </div> 

            </div> <!-- Card -->

            
            


        </div>
    </div>
</div>
@endif

 
<script>
$(document).ready(function()
{
    $("#name").change(function()
    {
      $('#btnshow').click();
    });  

    $("#from_date").change(function()
    {
      $('#btnshow').click();
    });  

    $("#to_date").change(function()
    {
      $('#btnshow').click();
    });  


    $("#work_file_id").change(function()
    {
      $('#btnshow').click();
    });       

});

</script>   

<script>
$(document).ready(function()
{

    var two_three = $("#two_three").val();

    if(two_three == "Two_AM")
    {
      $("#two_am_panel").click();
    }

     if(two_three == "Two_PM")
    {
      $("#two_pm_panel").click();
    }


    if(two_three == "Three")
    {
      $("#three_panel").click();
    }

    if(two_three == "All")
    {
      $("#all_panel").click();
    }
    
     if(two_three == "Main")
    {
      $("#main_panel").click();
    }

   


     $("#two_am_panel").click(function()
    {
      $('#two_am_work_file_id').change();
    });

    $("#two_pm_panel").click(function()
    {
      $('#two_pm_work_file_id').change();
    });


     $("#three_panel").click(function()
    {
      $('#three_work_file_id').change();
    });

      $("#all_panel").click(function()
    {
      $('#twod_threed').change();
    });

       $("#main_panel").click(function()
    {
      $('#main_two_three').change();
    });



    $("#two_am_work_file_id").change(function()
    {
      $('#btnTwo_AM').click();
    });

     $("#two_pm_work_file_id").change(function()
    {
      $('#btnTwo_PM').click();
    });


     $("#three_work_file_id").change(function()
    {
      $('#btnThree').click();
    });

      $("#twod_threed").change(function()
    {
      $('#btnAll').click();
    });

       $("#main_two_three").change(function()
    {
      $('#btnMain').click();
    });



     $("#in_out").change(function()
    {
      $('#btnshow').click();

    });



    $("#slip_id").change(function()
    {
      $('#btnshow').click();
    });


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

<script>
$(document).ready(function()
{

  
    // In_Out
    $("#in_out").change(function()
    {
     

      var user_id       = $('#user_id').val(); 
      var customer_id   = $('#customer_id').val();   
      var in_out        = $('#in_out').val();

      $('#in_out_value').val(in_out);

         
      if(in_out)
      {
        $.ajax(
            {
                type:   "GET",
                url:  "{{ url('getCustomer') }}?user_id="+user_id
                                              +"&customer_id="+customer_id
                                              +"&in_out="+in_out,
                dataType: 'json',             
                success:function(res)
                {                                                   
                    if(res)
                    {
                        var html = '';

                        for(var count = 0; count < res.length; count++)
                        {
                         
                            html += '<option  value="'+res[count].id+'" >'+ res[count].name +'</option>'; 
                                                 
                          
                        }

                        $("#customer_id").html(html);                        
                        $('#customer_id').change();
                    }
                }
            } 
           );       
      }

      

     
    });
    // End In_Out



});

</script>    

@endsection