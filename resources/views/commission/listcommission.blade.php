<?php  
  use App\Customer;
  use App\User;
  use App\Choice;
  use App\WorkFile;
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
<div class="col-md-8 col-md-offset-2">

    @if(session('info'))
    <div class="container">
       <div class="alert alert-danger">
      {{ session('info') }}
      </div>
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
              ကော်မရှင် အလျော်အဆ
          </div>

              <table class="table table-sm header-fixed" >
                  <thead>
                      <tr>
                        <th>WorkFile</th>
                        <th>ကော်</th>
                        <th>ဒဲ့ အလျော်အဆ</th>                       
                        <th>ပြင်ဆင်ရန်</th>
                      </tr>
                  </thead>

                  <form method="get" action="{{ url("/filecommission/add") }}" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <tbody>

                      <?php 
                            $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');
                            $work_file = WorkFile::find($work_file_id); 
                       ?>                     
                    
                      <tr> 
                          <td >
                              <select name="w_file" id="w_file">                                
                                <option value="{{ $work_file->name }}">{{ $work_file->name }}</option>
                              </select>
                          </td>   

                          <td ><input type="text" name="w_comm" id="w_comm" value="{{ $work_file->w_comm }}" style="width: 50px;"> </td> 
                          <td ><input type="text" name="w_times" id="w_times" value="{{ $work_file->w_times }}" style="width: 50px;"> </td>                         

                          <td>                              
                              <input type="submit" name="edit" id="edit"  value="သိမ်းရန်" class="btn btn-info btn-sm" >
                          </td> 
                      </tr>                
                  </tbody>
                  </form>

                </table>



                <table class="table table-striped table-sm header-fixed">        
                <tbody>
                  <form method="get" action="{{ url("/commission/list/show") }}" enctype="multipart/form-data">
                  {{ csrf_field() }}

                    <tr>

                      <td>
                        <div class="form-group">
                         
                          <select name="user_id" id="user_id" class="form-control">
                           
                              <option value="0">All Users</option>
                                                        
                          </select>
                        </div>
                      </td> 

                       <td>
                          <div>
                           
                            <select name="in_out"  id="in_out" class="form-control">
                              <option value="1" @if($in_out == 1) selected @endif>IN</option>
                              <option value="2" @if($in_out == 2) selected @endif>OUT</option>
                            </select>
                           
                          </div>
                        </td>

                    </tr>                    

                  <label hidden >Show</label><br>                          
                  <input hidden type="submit"  value="Show" name="action" id="btnShow"  class="btn btn-info btn-sm">                        
                         
                  </form>
                </tbody>
                </table>


                <table class="table table-sm header-fixed" id="tbl1">
                  <thead>
                      <tr>
                        <th>User</th>
                        <th>2D ကော်</th>
                        <th>2D အလျော်အဆ</th>
                        <th>ပြင်ဆင်ရန်</th>
                      </tr>
                  </thead>
                  <tbody>
                     
                      @foreach($commissions as $commission)                       
                    
                      <?php
                          $user_name      = User::where("id","=","$commission->user_id")->value('name');
                          $customer_name  = Customer::where("id","=","$commission->customer_id")->value('name');
                       ?>
                      <tr> 
                          <td >{{ $user_name }}</td>              
                          <td >{{ $commission->twod_comm }}</td> 
                          <td >{{ $commission->twod_times }}</td>

                          <td>
                               <a href="{{ url("/commission/upd/{$commission->id}?type=user") }}" class="btn btn-info btn-sm">
                                  ပြင်ဆင်ရန်
                              </a>
                          </td> 
                      </tr>
                     @endforeach
                  </tbody>
                </table>

                


    </div>


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
                <a href="{{ url("/") }}" class="btn btn-primary btn-sm" >
                   Back
                </a>
            </span>     

      </div> 


</div>
</div>
</div>
  <!-- End Filters -->


<script>
  $(document).ready(function()
{
    $("#tbl2").hide();
   
    $("#user_id").change(function()
    {
        var user_id = $("#user_id").val();

        if(user_id == 1)
        {         
          $("#in_out").hide();
          $("#tbl1").hide();
          $("#tbl2").show();

          $("#w_comm").select().focus();

        }
        if(user_id == 0)
        {         
          $("#in_out").show();
          $("#tbl1").show();
          $("#tbl2").hide();
        }

    });


    $("#w_comm").keypress(function( event ) 
                            {  
                                if ( event.which == 13 ) 
                                {
                                   event.preventDefault();                                 
                                   $("#w_times").select().focus();
                                }
                             
                            });

     $("#w_times").keypress(function( event ) 
                            {  
                                if ( event.which == 13 ) 
                                {
                                   event.preventDefault();                                 
                                   $("#edit").focus();
                                }
                             
                            });


    // In_Out
    $("#in_out").change(function()
    {
     
       
      var in_out        = $('#in_out').val();
           
      if(in_out)
      {
        $.ajax(
            {
                type:   "GET",
                url:  "{{ url('getUser') }}?in_out="+in_out,
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

                        $("#user_id").html(html);
                    }
                }
            } 
           );       
      }

      $('#btnShow').click();
     
    });
    // End In_Out

   

});
</script>


 @endsection