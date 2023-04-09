<?php use App\Choice; ?>

@extends('layouts.app')
@section('content')


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


<!-- Filter and Show -->

<div class="container">
<div class="row justify-content-center">
<div class="col-md-6 col-md-offset-2"> 

  <div class="card border-secondary">

            <div class="card-header">
             
              အွန်လိုင်း ငွေစာရင်း
             
            </div>

            <table class="table table-striped table-sm header-fixed">        
                <tbody>
                  <form method="get" action="{{ url("/cash/add") }}"  enctype="multipart/form-data">
                  {{ csrf_field() }}

               
                    <tr>

                      <td >
                      <div class="form-group">
                          <label>ပွဲစဉ်ဇယား</label> <br>
                          <select name="work_file_id" id="work_file_id" class="form-control" >                             
                          @foreach($work_files as $work_file)
                            <option value="{{ $work_file->id }}" @if($work_file->id == $work_file_id) selected @endif>
                              {{ $work_file->name ." ".$work_file->duration." [ ". $work_file->date ." ] " ."( ". $work_file->result_digit ." )" }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                    </td>                    
                   
          
                      <td>
                        <div class="form-group">
                            <label>အမည်</label> <br>
                            <select name="user_id" id="user_id" class="form-control" >
                              <option value="0" @if($user_id =="0") selected @endif> All </option>
                            @foreach($paid_users as $user)
                              <option value="{{ $user->id }}" @if($user->id == $user_id) selected @endif >
                                {{ $user->name }}
                              </option>
                            @endforeach
                          </select>
                        </div>
                      </td> 


                  

                    </tr>


                  <label hidden >Show</label><br>                          
                  <input hidden type="submit"  value="Show" name="action" id="btnShow"  class="btn btn-info btn-sm">
                        
                         
                  </form>
                </tbody>
                </table>

            <!-- Show Table -->                 
                  <table class="table1 table-striped table-sm header-fixed">
                   
                  <thead>
                      

                      <tr>  

                        <th> ပွဲစဉ်ဇယား </th>                      
                      
                        <th >အမည်</th>

                        <th >သွင်းငွေ</th>

                        <th >ထိုးကြေး</th>

                        <th >ပေါက်သီး</th>

                        <th >လက်ကျန်</th>

                        <th></th>
                     
                      </tr>

                  </thead>
                  <tbody>

                      <?php foreach ($cashes as $key => $cash): ?>
                          <tr>
                            <td>{{ $cash->work_file_id }}</td>
                            <td>{{ $cash->user->name }}</td>

                            <td>{{ $cash->deposit }}</td>
                            <td>{{ $cash->bet_amount }}</td>

                            <td>{{ $cash->result_amount }}</td>
                            <td>{{ $cash->balance }}</td>   

                            <td><a href="{{ url("/cash/del/{$cash->id}") }}" class="btn btn-outline-light btn-sm"><i class='fa fa-trash' aria-hidden='true' style='color: red; font-size:12px; cursor:pointer;'></i></a></td> 

                          </tr>
                      <?php endforeach ?>
                      
                    
                  </tbody>
                </table>
                  <!-- End Show Table          -->
              
            
         




  </div>        

</div>
</div>
</div>




<!-- Filter and Show -->

<br>

    
<div class="container">
<div class="row justify-content-center">
<div class="col-md-6 col-md-offset-2">
        
    
    <div class="card border-secondary">
                
                <div class="card-header">
                  အွန်လိုင်း ငွေစာရင်း အသစ်
                </div>

          <table class="table table-sm">
              
          <tbody>
            <form method="post" enctype="multipart/form-data">

            {{ csrf_field() }}

              <input type="text" name="w_id" id="w_id"  value="{{ $work_file_id }}" >

              <tr>

                <td colspan="3">            
                  <div class="form-group">
                      <label>အမည်</label> <br>
                      <select name="select_user_id" id="select_user_id" class="form-control" >                             
                      @foreach($users as $user)
                        <option value="{{ $user->id }}" @if($user->id == $user_id) selected @endif>
                          {{ $user->name }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </td>
               

              </tr>

              <tr>

                <td>
                  <div class="form-group">
                    <label>သွင်းငွေ</label>
                    <input type="text" name="deposit" id="deposit" class="form-control" value="0">
                  </div>
                </td>
            
                <td>
                  <div class="form-group">
                    <label>ထိုးကြေး</label>
                    <input type="text" name="bet_amount" id="bet_amount" class="form-control" value="0" readonly >
                  </div>
                </td>
            
             
                <td>
                  <div class="form-group">
                    <label>ပေါက်သီး</label>
                    <input type="text" name="result_amount" id="result_amount" class="form-control" value="0" readonly >
                  </div>
                </td>

                <td>
                  <div class="form-group">
                    <label>လက်ကျန်</label>
                    <input type="text" name="balance" id="balance" class="form-control" value="0" readonly >
                  </div>
                </td>


               
              </tr>
          
            <tr>
              <td>
                  <input type="submit" value="သိမ်းရန်" class="btn btn-primary btn-sm">
              </td>

              <td>
                  <a href="{{ url("/3dsale/add/{$work_file_id}") }}" class="btn btn-primary btn-sm" >
                       အရောင်း
                    </a>
              </td>

            </tr>



                
            </form>
          </tbody>
          </table>



    </div>




</div>
</div>
</div>



<script>
  
 // name change
  $("#work_file_id").change(function()
  {

    $("#btnShow").click();
   
  });

 // User Change
  $("#user_id").change(function()
  {    

    $("#btnShow").click();

  });
 

//Deposit => get Cash Info
 $("#deposit").keypress(function( event ) 
  {
        if ( event.which == 13) 
        {
            event.preventDefault();  

            var deposit       = $("#deposit").val();
            var user_id       = $("#select_user_id").val();
            var work_file_id  = $("#work_file_id").val();

              
            if(deposit)
              {
                $.ajax(
                    {
                        type:   "GET",
                        url:  "{{ url('getCashInfo') }}?user_id="+user_id                                             
                                                      +"&work_file_id="+work_file_id
                                                      +"&deposit="+deposit,

                        dataType: 'json',             
                        success:function(res)
                        {                                                   
                            if(res)
                            {
                                
                              // alert(res.total_amount);

                                
                                $("#deposit").val(res.deposit);

                                if(res.net_total)
                                {
                                    $("#bet_amount").val(res.total_amount);  
                                }
                                else
                                {
                                    $("#bet_amount").val(0); 
                                }
                                
                                if(res.result_amount)
                                {
                                    $("#result_amount").val(res.result_amount);
                                }
                                else
                                {
                                    $("#result_amount").val(0);
                                   
                                }
                                

                                $("#balance").val(res.balance);
                               


                                // var html = '';

                                // for(var count = 0; count < res.length; count++)
                                // {
                                 
                                //     // html += '<option  value="'+res[count].id+'" >'+ res[count].name +'</option>'; 

                                //     alert(res[count].balance);
                                                         
                                  
                                // }

                                // $("#customer_id").html(html);
                            }
                        }
                    } 
                   );       
              }


        }
   
  });

//Deposit => get Cash Info


</script>   
@endsection