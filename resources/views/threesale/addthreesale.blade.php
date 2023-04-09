<?php 

use App\Commission;
use App\TwoSale;
use App\ThreeSale;


$twod_comm = Commission::where('user_id','=',$user_id)->value('twod_comm');

$j_over_digits = json_encode($over_digits);


?>

@extends('layouts.app')
@section('content')


<input hidden  type="text" name="comm"        id="comm"       value="{{ $twod_comm }}" >
<input hidden  type="text" name="total"       id="total"      value="" >
<input hidden  type="text" name="net_total"   id="net_total"  value="" >
<input hidden  type="text" name="auth_id"     id="auth_id"    value="{{ auth()->user()->id }}" >

<style type="text/css">

    .tbl_heading {
   /* fixed keyword is fine too */
   position: sticky;
   top: 0;
   z-index: 100;
   /* z-index works pretty much like a layer:
   the higher the z-index value, the greater
   it will allow the navigation tag to stay on top
   of other tags */
   background-color: #f7f5f5;
   border: 1px solid black;
}

#upper_table tr {border: 1px #DDD solid; cursor: pointer;}

#upper_table tr {border: 1px #DDD solid; cursor: pointer;}

.tbl_heading td, th { border: 1px #DDD solid; cursor: pointer; }


   /*table_box*/
  #table_box
  {
    height: 370px;
    overflow-y: auto;
  }

 .b_id input
 {
   width: 100%;

   font-size: 16px;
   font-weight: bold;

  text-align: left;
  background-color: #f7f7f5;
  border: none;
  background-color: transparent;


 }
 .b_id 
 {
   width: 50px;
   
   font-size: 16px;
   font-weight: bold;

   display: none;
 }


 .b_no input
 {
   width: 100%;

   font-size: 16px;
   font-weight: bold;

    text-align: left;
  background-color: #f7f7f5;
  border: none;
  background-color: transparent;

 }
 .b_no 
 {
   width: 50px;

   font-size: 16px;
   font-weight: bold;

   display: none;
 }


 .b_digit input
 {
   width: 100%;

   font-size: 16px;
   font-weight: bold;

    text-align: center;
  background-color: #f7f7f5;
  border: none;
  background-color: transparent;

 }
 .b_digit
 {
   width: 150px;
   
   text-align: center;

   font-size: 16px;
   font-weight: bold;
 }


 .b_amount input
 {
   width: 100%;

   font-size: 16px;
   font-weight: bold;

  text-align: right;
  background-color: #f7f7f5;
  border: none;
  background-color: transparent;

 }
 .b_amount
 {
   width: 180px;

   text-align: right;
   font-size: 16px;
   font-weight: bold;
 }


 .b_type input
 {
   width: 100%;

   font-size: 16px;
   font-weight: bold;

  text-align: center;
  background-color: #f7f7f5;
  border: none;
  background-color: transparent;

 }
 .b_type 
 {
   width: 180px;

   text-align: center;
   font-size: 16px;
   font-weight: bold;
 }


 .b_save 
 {
   width: 50px;
   display: none;
 }
 .b_save input 
 {
   width: 100%;
 }
 

 .b_group 
 {
   width: 60px;
   text-align: center;
 }
 .b_group input 
 {
   width: 100%;

    border: none;
  background-color: transparent;
 }
 
 .b_one 
 {
   width: 60px;
   text-align: center;


 }
 .b_one input 
 {
   width: 100%;

    border: none;
  background-color: transparent;
 }
 
 #last_slip
 {
  text-align: right;
  font-size: 16px;
  font-weight: bold; 
  width: 80px;
 }

 #slip_id
 {
  text-align: right;
  font-size: 16px;
  font-weight: bold; 
  width: 80px;
 }

 #slip_total
 {
   text-align: right;
   font-size: 16px;
   font-weight: bold; 
   width: 80px;
 }
 /*header*/







  .modal-dialog {
  
   bottom:0;
}  

  #panel3
  {
    display: none;
  }  

  .btn-info {
    color: #212529;
    background-color: #7cc;
    border-color: #5bc2c2;
    font-size: 14px;
    font-weight : bold ;
}

#digit, #amount, #r_amount
{
    font-size: 20px;
    font-weight : bold ;
}

</style>



<script>

function insert(num) 
{
  
  var digit_amount = $("#digit_amount").val();

  var digit = $("#digit").val();



  if(num == '+')
  {
    var amount = $("#amount").val();

    if(amount != "")
    {

      $("#digit_amount").val(2);

      $("#r_amount").val("");
      $("#r_amount").focus();
    }
    else
    {
      digit += num;
      $("#digit").val(digit);
      $("#digit").change();

      $("#digit_amount").val(1);
      $("#amount").focus();

      

    }
   
    return;
  }



  if(digit_amount == 0 )
  {
    var digit = $("#digit").val();
    digit += num;

    $("#digit").val(digit);

    $("#digit_amount").val(0);
    $("#digit").focus();

    
    if(digit.length == 2)
    {

      $("#digit").change();
      
      // if(isNaN(digit)==false)
      // {
          $("#digit_amount").val(1);
          $("#amount").focus();
      // }

    }
   

  }
  if(digit_amount == 1)
  {
     var amount = $("#amount").val();
      amount += num;

      $("#amount").val(amount);

    $("#digit_amount").val(1);
    $("#amount").focus();
  }

   if(digit_amount == 2)
  {
     var r_amount = $("#r_amount").val();
      r_amount += num;

      $("#r_amount").val(r_amount);

      $("#digit_amount").val(2);
      $("#r_amount").focus();
  }



  // if(digit.length == 2 && digit_amount == 0)
  // {
  //   $("#digit").change();
  //   $("#digit_amount").val(1);    
  //   $("#amount").focus();
  // }
   

}


function enter()
{
  
  var digit_amount = $("#digit_amount").val();
  var digit = $("#digit").val();

  if( (digit.length == 1 || digit == "") && $("#keyboard").val() == "On" )
  {
   
    var digit = $("#digit").val();   

    $("#digit").val(digit);
    $("#digit_amount").val(0);
    $("#digit").focus();
    return ;    
  }

  if(digit_amount == 0)
  {
    $("#digit").change();

    $("#digit_amount").val(1);
    $("#amount").focus();

  }
  if(digit_amount == 1)
  {
    $("#digit_amount").val(2);
    var digit = $("#digit").val();
    var amount = $("#amount").val();

    if( digit != "" && amount != "")
    {
        //test code online

                work_file_id    = $('#work_file_id').val();
                                   user_id         = $('#user_id').val();
                                   digit           = $('#digit').val();
                                   amount          = $('#amount').val();
                                   slip_id         = $('#slip_id').val();
                                   in_out          = $('#in_out').val();
                                  

                                    //Show
                                   

                                        var status = navigator.onLine;

                                        // if(!status)
                                        // {
                                        //     alert('No internet Connection !!');
                                            
                                        //     return
                                        // }
                                        // else
                                        // {

                                        
                                        //Max Table Current Showing
                                        $('#max_table tr').each(function(){

                                          var currentRow = $(this);
                                          
                                          // alert(typeof(currentRow));

                                          var max_digit  = $(this).find('td:eq(0)').text();
                                          var max_amount = $(this).find('td:eq(1)').text();

                                          var type_amount = parseInt(amount.trim());
                                              max_amount  = parseInt(max_amount.trim());

                                          // alert(typeof(type_amount) + "/" + type_amount + "/"+ type_amount.length);
                                          
                                          digit     = digit.trim();
                                          max_digit = max_digit.trim();

                                          if(digit.localeCompare(max_digit) === 0)
                                          {
                                            if(in_out.localeCompare('1') === 0)
                                            {
                                              $(this).find('td:eq(1)').text(max_amount + type_amount);
                                            }

                                            if(in_out.localeCompare('2') === 0)
                                            {
                                              $(this).find('td:eq(1)').text(max_amount - type_amount);
                                            }
                                                                                        
                                          }

                                          if($(this).find('td:eq(1)').text() == 0)
                                          { 
                                            $(this).closest("tr").remove();
                                          }

                                        });
                                        //Max Table Current Showing



                                        // var s_id = jQuery('#slip_id').val();

                                        var msBeforeAjaxCall = new Date().getTime();


                                      //sale table
                                      jQuery.ajax({

                                          url: "{{ url('getDigits') }}",                                       
                                          method: 'get',
                                          data: {
                                             work_file_id: jQuery('#work_file_id').val(),
                                             user_id: jQuery('#user_id').val(),
                                             digit: jQuery('#digit').val(),
                                             amount: jQuery('#amount').val(),
                                             r_amount: jQuery('#r_amount').val(),
                                             slip_id: jQuery('#slip_id').val(),
                                             
                                          },
                                          timeout: 2000,                                                                    
                                                    
                                        //   success: function(result)
                                        //   { 

                                        //   }
                                          //success

                                          

                                      }).done(function (result, status, xhr) {

                                        // alert(typeof(result));

                                        // result = JSON.parse(result);

                                        if (typeof(result) == 'object')
                                        {
                                            
                                            
                                        //done
                                            var total_amount = 0;
                                            var show_count = 1;

                                           $("#upper_table").find("tr:not(:first)").remove();

                                           var col_type = "";
                                           var type = "";
                                           var big_recycle = "";

                                           for(var count = 0; count < result.length; count++)
                                           {
                                              total_amount += result[count].amount;
                                             
                                              if(col_type != result[count].type)
                                              {
                                                type = "<td style='width: 70px; text-align: center;'>" + result[count].type  +"</td>"; 
                                              }
                                              else
                                              {
                                                type = "<td style='width: 70px; text-align: center;'>" + " "  +"</td>";
                                              }
                                              if(isNaN(result[count].type) == true && col_type != result[count].type)
                                              {                                                   

                                                  big_recycle = "<td style='width: 30px;'>"+

                                                                  "<div class='btnGroup'>"+

                                                                    "<i class='fa fa-trash' aria-hidden='true' style='color: red; cursor:pointer;'></i>" +
                                                        
                                                                  "</div>"+

                                                                "</td>";
                                              }
                                              else
                                              {
                                                  big_recycle = "<td style='width: 30px;'>"+ " " + "</td>";
                                              }


                                              var trnew = "<tr>"+

                                              "<td hidden>"                                   + result[count].id           +"</td>"+
                                              "<td style='width: 30px; text-align: center;'>" + show_count                 +"</td>"+
                                              "<td style='width: 50px; text-align: center;'>" + result[count].digit        +"</td>"+
                                              "<td style='width: 70px; text-align: right;' >" + result[count].amount       +"</td>"+
                                              
                                              type +

                                              big_recycle +               

                                                         "<td style='width: 30px;' >"+

                                                            "<div class='btnOne'>"+

                                                            "<i class='fa fa-trash' aria-hidden='true' style='color: red; font-size:12px; cursor:pointer;'></i>" +
                                                          
                                                            "</div>"+

                                                          "</td>"+
                                                                       
                                                "</tr>";

                                              $("#upper_table").append(trnew);  

                                              $("#slip_id").val(result[count].slip_id);
                                              $("#u_id").val(result[count].user_id);
                                              $("#s_id").val(result[count].slip_id);

                                              show_count +=1;
                                              col_type = result[count].type;

                                            }

                                              $("#slip_total").val(total_amount);
                                              $("#total").val(total_amount);

                                              var comm          = $("#comm").val();
                                              var comm_amount   = total_amount * comm/100;
                                              var net_total     = total_amount - comm_amount;

                                              $("#total").val(total_amount);
                                              $("#net_total").val(net_total);

                                              $('#show_table').scrollTop( $('#show_table')[0].scrollHeight ); 

                                        //done

                                               

                                        }
                                        else
                                        {
                                            // alert("Slip " + s_id + " Connection is too low !");

                                              var msAfterAjaxCall = new Date().getTime();
                                                var timeTakenInMs = msAfterAjaxCall - msBeforeAjaxCall;
                                                if (timeTakenInMs > 2000) 
                                                {                                                 
                                                    alert(" Connection Long Time ( " + timeTakenInMs + " ) Miliseconds !");
                                                }
                                                    
                                        }

                                        }).fail(function (xhr, status, error) {
                                            
                                            alert("Result: " + status + " " + error + " " + xhr.status + " " + xhr.statusText);
                                            

                                        });// sale table

                                      // $("#refresh").click();
                                        
                                         // }//check connection

                                    
                                    //End Show

                                      $("#digit").val("");
                                      $("#amount").val("");
                                    
                                      $("#digit").focus();

                                      if($('#kb_state').prop("checked") == true)
                                      {
                                        $("#digit").focus();
                                      }
                                      else if($('#kb_state').prop("checked") == false)
                                      {
                                         $('#exampleModalCenter').modal('hide');
                                      }


        //end test code online

        $("#digit").focus();
        $("#digit_amount").val(0);

    }
    else
    {
      var amount = $("#amount").val();      
      $("#amount").val(amount);
      $("#digit_amount").val(1);
      $("#amount").focus();
    }
    
  }

  if(digit_amount == 2)
  {
    var digit = $("#digit").val();
    var amount = $("#amount").val();

    if( digit != "" && amount != "")
    {
        //test code online

                work_file_id    = $('#work_file_id').val();
                                   user_id         = $('#user_id').val();
                                   digit           = $('#digit').val();
                                   amount          = $('#amount').val();
                                   slip_id         = $('#slip_id').val();
                                   in_out          = $('#in_out').val();
                                  

                                    //Show
                                   

                                        // var status = navigator.onLine;

                                        // if(!status)
                                        // {
                                        //     alert('No internet Connection !!');
                                            
                                        //     return
                                        // }
                                        // else
                                        // {

                                        
                                        //Max Table Current Showing
                                        $('#max_table tr').each(function(){

                                          var currentRow = $(this);
                                          
                                          // alert(typeof(currentRow));

                                          var max_digit  = $(this).find('td:eq(0)').text();
                                          var max_amount = $(this).find('td:eq(1)').text();

                                          var type_amount = parseInt(amount.trim());
                                              max_amount  = parseInt(max_amount.trim());

                                          // alert(typeof(type_amount) + "/" + type_amount + "/"+ type_amount.length);
                                          
                                          digit     = digit.trim();
                                          max_digit = max_digit.trim();

                                          if(digit.localeCompare(max_digit) === 0)
                                          {
                                            if(in_out.localeCompare('1') === 0)
                                            {
                                              $(this).find('td:eq(1)').text(max_amount + type_amount);
                                            }

                                            if(in_out.localeCompare('2') === 0)
                                            {
                                              $(this).find('td:eq(1)').text(max_amount - type_amount);
                                            }
                                                                                        
                                          }

                                          if($(this).find('td:eq(1)').text() == 0)
                                          { 
                                            $(this).closest("tr").remove();
                                          }

                                        });
                                        //Max Table Current Showing

                                        // var s_id = jQuery('#slip_id').val();

                                        var msBeforeAjaxCall = new Date().getTime();


                                      //sale table
                                      jQuery.ajax({

                                          url: "{{ url('getDigits') }}",                                       
                                          method: 'get',
                                          data: {
                                             work_file_id: jQuery('#work_file_id').val(),
                                             user_id: jQuery('#user_id').val(),
                                             digit: jQuery('#digit').val(),
                                             amount: jQuery('#amount').val(),
                                             r_amount: jQuery('#r_amount').val(),
                                             slip_id: jQuery('#slip_id').val(),
                                             
                                          },
                                          timeout: 2000,                                                                    
                                                    
                                        //   success: function(result)
                                        //   { 

                                        //   }
                                          //success

                                          

                                      }).done(function (result, status, xhr) {

                                        // alert(typeof(result));

                                        // result = JSON.parse(result);

                                        if (typeof(result) == 'object')
                                        {
                                            
                                            
                                        //done
                                            var total_amount = 0;
                                            var show_count = 1;

                                           $("#upper_table").find("tr:not(:first)").remove();

                                           var col_type = "";
                                           var type = "";
                                           var big_recycle = "";

                                           for(var count = 0; count < result.length; count++)
                                           {
                                              total_amount += result[count].amount;
                                             
                                              if(col_type != result[count].type)
                                              {
                                                type = "<td style='width: 70px; text-align: center;'>" + result[count].type  +"</td>"; 
                                              }
                                              else
                                              {
                                                type = "<td style='width: 70px; text-align: center;'>" + " "  +"</td>";
                                              }
                                              if(isNaN(result[count].type) == true && col_type != result[count].type)
                                              {                                                   

                                                  big_recycle = "<td style='width: 30px;'>"+

                                                                  "<div class='btnGroup'>"+

                                                                    "<i class='fa fa-trash' aria-hidden='true' style='color: red; cursor:pointer;'></i>" +
                                                        
                                                                  "</div>"+

                                                                "</td>";
                                              }
                                              else
                                              {
                                                  big_recycle = "<td style='width: 30px;'>"+ " " + "</td>";
                                              }


                                              var trnew = "<tr>"+

                                              "<td hidden>"                                   + result[count].id           +"</td>"+
                                              "<td style='width: 30px; text-align: center;'>" + show_count                 +"</td>"+
                                              "<td style='width: 50px; text-align: center;'>" + result[count].digit        +"</td>"+
                                              "<td style='width: 70px; text-align: right;' >" + result[count].amount       +"</td>"+
                                              
                                              type +

                                              big_recycle +               

                                                         "<td style='width: 30px;' >"+

                                                            "<div class='btnOne'>"+

                                                            "<i class='fa fa-trash' aria-hidden='true' style='color: red; font-size:12px; cursor:pointer;'></i>" +
                                                          
                                                            "</div>"+

                                                          "</td>"+
                                                                       
                                                "</tr>";

                                              $("#upper_table").append(trnew);  

                                              $("#slip_id").val(result[count].slip_id);
                                              $("#u_id").val(result[count].user_id);
                                              $("#s_id").val(result[count].slip_id);

                                              show_count +=1;
                                              col_type = result[count].type;

                                            }

                                              $("#slip_total").val(total_amount);
                                              $("#total").val(total_amount);

                                              var comm          = $("#comm").val();
                                              var comm_amount   = total_amount * comm/100;
                                              var net_total     = total_amount - comm_amount;

                                              $("#total").val(total_amount);
                                              $("#net_total").val(net_total);

                                              $('#show_table').scrollTop( $('#show_table')[0].scrollHeight ); 

                                        //done

                                               

                                        }
                                        else
                                        {
                                            // alert("Slip " + s_id + " Connection is too low !");

                                              var msAfterAjaxCall = new Date().getTime();
                                                var timeTakenInMs = msAfterAjaxCall - msBeforeAjaxCall;
                                                if (timeTakenInMs > 2000) 
                                                {                                                 
                                                    alert(" Connection Long Time ( " + timeTakenInMs + " ) Miliseconds !");
                                                }
                                                    
                                        }

                                        }).fail(function (xhr, status, error) {
                                            
                                            alert("Result: " + status + " " + error + " " + xhr.status + " " + xhr.statusText);
                                            

                                        });// sale table

                                      // $("#refresh").click();
                                        
                                         // }//check connection

                                    
                                    //End Show

                                      $("#digit").val("");
                                      $("#amount").val("");
                                    
                                      $("#digit").focus();

                                      if($('#kb_state').prop("checked") == true)
                                      {
                                        $("#digit").focus();
                                      }
                                      else if($('#kb_state').prop("checked") == false)
                                      {
                                         $('#exampleModalCenter').modal('hide');
                                      }


        $("#digit").focus();
        $("#digit_amount").val(0);

        $("#amount").val(0);
        $("#r_amount").val(0);

        //end test code online
    }

  }

  
}

function clearall()
{

  var digit_amount = $("#digit_amount").val();

  
  if( digit_amount == 0)
  {
    $("#digit").val("");
  }

  if( digit_amount == 1)
  {
    $("#amount").val("");
  }

  if( digit_amount == 2)
  {
    $("#r_amount").val("");
  }
  
}


function backspace()
{

  
  var digit_amount = $("#digit_amount").val();
 
  if(digit_amount == 0 && $("#keyboard").val() == "On")
  {
     var digit = $("#digit").val();
    digit = digit.substring(0, digit.length - 1);

    $("#digit").val(digit);

    $("#digit_amount").val(0);
    $("#digit").focus();

  }

  if(digit_amount == 1)
  {
     var amount = $("#amount").val();
      amount = amount.substring(0, amount.length - 1);

      $("#amount").val(amount);

    $("#digit_amount").val(1);
    $("#amount").focus();

  }

   if(digit_amount == 2)
  {
     var r_amount = $("#r_amount").val();
      r_amount = r_amount.substring(0, r_amount.length - 1);

      $("#r_amount").val(r_amount);

    $("#digit_amount").val(2);
    $("#r_amount").focus();

  }


  if(digit_amount == 1 && $("#amount").val() == "" && $("#keyboard").val() == "On")
  {
    $("#digit_amount").val(0);
    $("#digit").focus();
  }

   if(digit_amount == 2 && $("#r_amount").val() == "")
  {
    $("#digit_amount").val(1);
    $("#amount").focus();
  }


}


</script>


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
   
    height: 345px;
    flex: 1 1 auto;
    display: block;
    overflow-y: auto;
    overflow-x: auto;
  }
  .table1 tr 
  {
    width: 100%;
    display: table;
    table-layout: fixed;
  }
  .table1 td input
  {
    width: 50px;
    height: 35px;
  }
</style>


<style type="text/css">
  .table2 
  {
    font-size: 12px;
    display: flex;
    flex-flow: column;
    width: 100%;
  }
  .table2 thead 
  {
    flex: 0 0 auto;
  }
  .table2 tbody 
  {
   
    height: 345px;
    flex: 1 1 auto;
    display: block;
    overflow-y: auto;
    overflow-x: auto;
  }
  .table2 tr 
  {
    width: 100%;
    display: table;
    table-layout: fixed;
  }
   .table2 td input
  {
    width: 50px;
    height: 35px;
  }

</style>



<script>
    $(document).ready( 
              function()
              {



                                

                var session_info = $("#session_info").val();

                if(session_info)
                {
                        var st = $("#st").val();

                        if(st == "timeup")
                        {
                          alert('<?php echo session('info'); ?>')
                          $("#home").click();
                        }
                        else
                        {
                          alert('<?php echo session('info'); ?>')
                        }
                }
               
               $('#show_table').scrollTop( $('#show_table')[0].scrollHeight );

                var keyboard = $("#keyboard").val();

                if(keyboard == "Off")
                {
                    $('#digit').prop('readonly',true);
                    $('#amount').prop('readonly',true);
                    $('#r_amount').prop('readonly',true);

                    $("#keypad").show();
                }
                if(keyboard == "On")
                {
                    $('#digit').prop('readonly',false);
                    $('#amount').prop('readonly',false);
                    $('#r_amount').prop('readonly',false);

                    $("#keypad").hide();

                    $('#digit').focus();
                }



                $("#keyboard").change( function()
                                    {
                                      var keyboard = $("#keyboard").val();

                                     
                                      if(keyboard == "Off")
                                      {
                                          $('#digit').prop('readonly',true);
                                          $('#amount').prop('readonly',true);
                                          $('#r_amount').prop('readonly',true);

                                          $("#keypad").show();
                                      }
                                      if(keyboard == "On")
                                      {
                                          $('#digit').prop('readonly',false);
                                          $('#amount').prop('readonly',false);
                                          $('#r_amount').prop('readonly',false);

                                          $("#keypad").hide();

                                          $('#digit').focus();
                                      }



                                    }
                                  );

           

              $("#digit").click( function()
                                  {
                                    $("#digit_amount").val(0);
                                    $("#digit").focus();

                                    $("#r_amount").val(0);
                                  }
                                );


              $("#amount").click( function()
                                  {
                                    $("#digit_amount").val(1);

                                    $("#digit").change();

                                    $("#amount").focus();

                                    $("#r_amount").val(0);
                                  }
                                );
              $("#r_amount").click( function()
                                  {
                                    $("#digit_amount").val(2);

                                    $("#r_amount").val("");
                                    $("#r_amount").focus();
                                  }
                                );


              $("#save").click( function()
                                  {
                                    var in_out = $("#in_out").val();

                                    var auth_id = $("#auth_id").val();

                                    if(auth_id == 1 || auth_id == 2)
                                    {
                                      $("#saveOut").click();
                                    }

                                    else if(in_out == 1)
                                    {
                                        // let text;

                                        // let comm        = $("#comm").val();
                                        // let total       = $("#total").val();
                                        // let net_total   = $("#net_total").val();


                                        // let remark = prompt(  "ကော်       = " + comm + "\n" + 
                                        //                       "ယူနစ်ပေါင်း   = " + total + "\n" + 
                                        //                       "ကော်နှုတ်ပြီးထိုးကြေး = " + net_total + "\n\n" + 
                                        //                       "ထိုးသားအမည်မှတ်ရန်:", "");

                                        // if(remark != null)
                                        // {
                                        //     $("#remark").val(remark);
                                        //     $("#saveRemark").click();
                                        // }

                                        $("#saveOut").click();
                                        
                                    }                                    

                                    if(in_out == 2 )
                                    {
                                      $("#saveOut").click();
                                    }

                                  }

                                );


                $("#header3").click
                  ( function()
                    {
                      $("#panel3").toggle("first");
                    }
                  );

                $("#R").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "R";

                                    $("#digit").val(digit);

                                    $("#amount").focus();
                                    $("#digit_amount").val(1);

                                  }
                                );
                $("#T").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    
                                    //r_digit = digit + "N";

                                    digit += "T";
                                    

                                    $("#digit").val(digit);

                                    $("#amount").focus();
                                    $("#digit_amount").val(1);

                                    $("#digit").change();

                                   

                                    //$("#r_label").html(r_digit);

                                  }
                                );
                $("#N").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "N";

                                    $("#digit").val(digit);

                                    $("#amount").focus();
                                    $("#digit_amount").val(1);

                                    $("#digit").change();
                                  }
                                );

                $("#Round").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "R";

                                    $("#digit").val(digit);

                                    $("#amount").focus();
                                    $("#digit_amount").val(1);
                                  }
                                );

                //Three Logic

                  $("#NSE").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    
                                      if( digit.length ==2)
                                      {
                                        var d1  = digit.substr(0, 1);
                                        var d2  = digit.substr(1, 1);
                                     
                                        digit = d1  + d2 + "*";

                                      }


                                      $("#digit").val(digit);
                                      $("#amount").focus();
                                      $("#digit_amount").val(1);
                                  }
                                );
                  $("#LSE").click( function()
                                  {
                                      var digit = $("#digit").val();
                                    
                                      if( digit.length ==2)
                                      {
                                        var d1  = digit.substr(0, 1);
                                        var d2  = digit.substr(1, 1);
                                     
                                        digit = d1 + "*" + d2 ;

                                      }


                                      $("#digit").val(digit);
                                      $("#amount").focus();
                                      $("#digit_amount").val(1);
                                  }
                                );
                  $("#SSE").click( function()
                                  {
                                      var digit = $("#digit").val();
                                    
                                      if( digit.length ==2)
                                      {
                                        var d1  = digit.substr(0, 1);
                                        var d2  = digit.substr(1, 1);
                                     
                                        digit = "*" + d1 + d2 ;

                                      }


                                      $("#digit").val(digit);
                                      $("#amount").focus();
                                      $("#digit_amount").val(1);
                                  }
                                );

                  $("#TRI").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "TRI";

                                    $("#digit").val(digit);
                                    $("#amount").focus();
                                    $("#digit_amount").val(1);
                                  }
                                );

                  $("#KP").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "KP";

                                    $("#digit").val(digit);
                                    $("#amount").focus();
                                    $("#digit_amount").val(1);
                                  }
                                );
                  $("#SKP").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "SKP";

                                    $("#digit").val(digit);
                                    $("#amount").focus();
                                    $("#digit_amount").val(1);
                                  }
                                );
                  $("#MKP").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "MKP";

                                    $("#digit").val(digit);
                                    $("#amount").focus();
                                    $("#digit_amount").val(1);
                                  }
                                );

                  $("#KS").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "KS";

                                    $("#digit").val(digit);
                                    $("#amount").focus();
                                    $("#digit_amount").val(1);
                                  }
                                );
                  $("#KSS").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "KSS";

                                    $("#digit").val(digit);
                                    $("#amount").focus();
                                    $("#digit_amount").val(1);
                                  }
                                );
                  $("#KSM").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "KSM";

                                    $("#digit").val(digit);
                                    $("#amount").focus();
                                    $("#digit_amount").val(1);
                                  }
                                );

                  $("#B").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "B";

                                    $("#digit").val(digit);
                                    $("#amount").focus();
                                    $("#digit_amount").val(1);
                                  }
                                );

                //End Three Logic

                $("#NS").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "S";

                                    $("#digit").val(digit);

                                    $("#amount").focus();
                                    $("#digit_amount").val(1);

                                    $("#digit").change();

                                    $("#header3").click();

                                  }
                                );

                $("#SN").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit = "S" + digit;

                                    $("#digit").val(digit);
                                    
                                    $("#amount").focus();
                                    $("#digit_amount").val(1);

                                    $("#digit").change();

                                    $("#header3").click();

                                  }
                                );

                $("#NSR").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "SR";

                                    $("#digit").val(digit);

                                    $("#amount").focus();
                                    $("#digit_amount").val(1);

                                    $("#digit").change();

                                    $("#header3").click();

                                  }
                                );

                $("#NM").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "M";

                                    $("#digit").val(digit);

                                    $("#amount").focus();
                                    $("#digit_amount").val(1);

                                    $("#digit").change();

                                    $("#header3").click();

                                  }
                                );

                $("#MN").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit = "M" + digit;

                                    $("#digit").val(digit);

                                    $("#amount").focus();
                                    $("#digit_amount").val(1);

                                    $("#digit").change();

                                    $("#header3").click();

                                  }
                                );

                $("#NMR").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "MR";

                                    $("#digit").val(digit);

                                    $("#amount").focus();
                                    $("#digit_amount").val(1);

                                    $("#digit").change();

                                    $("#header3").click();

                                  }
                                );


                $("#SS").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit = "SS";

                                    $("#digit").val(digit);

                                    $("#amount").focus();
                                    $("#digit_amount").val(1);

                                    $("#header3").click();
                                   
                                  }
                                );
                


                $("#MM").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit = "MM";

                                    $("#digit").val(digit);

                                    $("#amount").focus();
                                    $("#digit_amount").val(1);

                                    $("#header3").click();
                                  }
                                );
                $("#SM").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "SM";

                                    $("#digit").val(digit);

                                    $("#amount").focus();
                                    $("#digit_amount").val(1);

                                    $("#header3").click();

                                  }
                                );
                $("#MS").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "MS";

                                    $("#digit").val(digit);

                                    $("#amount").focus();
                                    $("#digit_amount").val(1);

                                    $("#header3").click();

                                  }
                                );

                $("#SP").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "SP";

                                    $("#digit").val(digit);

                                    $("#amount").focus();
                                    $("#digit_amount").val(1);

                                    $("#digit").change();

                                    $("#header3").click();

                                  }
                                );

                $("#MP").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "MP";

                                    $("#digit").val(digit);

                                    $("#amount").focus();
                                    $("#digit_amount").val(1);

                                    $("#digit").change();

                                    $("#header3").click();

                                  }
                                );

                $("#PP").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "PP";

                                    $("#digit").val(digit);

                                    $("#amount").focus();
                                    $("#digit_amount").val(1);


                                  }
                                );

                $("#PW").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "PW";

                                    $("#digit").val(digit);

                                    $("#amount").focus();
                                    $("#digit_amount").val(1);
                                  }
                                );

                $("#NK").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "NK";

                                    $("#digit").val(digit);

                                    $("#amount").focus();
                                    $("#digit_amount").val(1);
                                  }
                                );

                $("#TK").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "TK";

                                    $("#digit").val(digit);

                                    $("#amount").focus();
                                    $("#digit_amount").val(1);

                                    $("#digit").change();

                                  }
                                );

                $("#KT").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "KT";

                                    $("#digit").val(digit);

                                    $("#amount").focus();
                                    $("#digit_amount").val(1);

                                    $("#digit").change();

                                  }
                                );

                $("#D").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "D";

                                    $("#digit").val(digit);

                                    $("#amount").focus();
                                    $("#digit_amount").val(1);

                                    $("#header3").click();

                                  }
                                );

                $("#DS").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "DS";

                                    $("#digit").val(digit);

                                    $("#amount").focus();
                                    $("#digit_amount").val(1);

                                    $("#digit").change();

                                    $("#header3").click();

                                  }
                                );

                $("#DM").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "DM";

                                    $("#digit").val(digit);

                                    $("#amount").focus();
                                    $("#digit_amount").val(1);

                                    $("#digit").change();

                                    $("#header3").click();
                                    
                                  }
                                );

                $("#BR").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "BR";

                                    $("#digit").val(digit);

                                    $("#amount").focus();
                                    $("#digit_amount").val(1);
                                  }
                                );


                //last test
                $("#close_modal").click( function()
                                  {
                                    
                                    $("#save").focus();
                                  }
                                );
                //last test
                


               

                $("#refresh").click(function( event ) 
                            {

                                work_file_id    = $('#work_file_id').val();
                                digit           = $('#digit').val();
                                amount          = $('#amount').val();

                                // $("#max_table").find("tr:not(:first)").remove();

                                $("#max_table").find("tr:first").remove();

                                var max_minus = $("#max_minus").val();

                                var over_digits = {};

                                $('#max_table tr').each(function(){

                                    var key = $(this).find('td:eq(0)').text();
                                    var value = $(this).find('td:eq(1)').text();

                                     over_digits[key] = value;

                                    

                                  });

                                // Object.keys(over_digits).map(function(k)
                                //                        { 
                                //                         alert("key with value: "+ k +" = "+ over_digits[k]);
                                //                       });

                                //OverDigits

                                    if(work_file_id)
                                    {
                                      jQuery.ajax({
                                                    url: "{{ url('getOverBreakDigits') }}",
                                                    method: 'get',
                                                    data: {
                                                       work_file_id: jQuery('#work_file_id').val(),
                                                       digit: jQuery('#digit').val(),
                                                       amount: jQuery('#amount').val(),
                                                       in_out: jQuery('#in_out').val(), 
                                                       max_minus: jQuery('#max_minus').val(), 
                                                       // over_digits:JSON.parse('<?php echo $j_over_digits; ?>')
                                                       over_digits:over_digits

                                                    },
                                                    success: function(result)
                                                    { 
                                                      // alert(Object.keys(result));

                                                       Object.keys(result).map(function(k)
                                                       { 
                                                        alert("key with value: "+ k +" = "+ result[k]);
                                                      });


                                                      //  for (var i = 0; i < result.length; i++) 
                                                      // {

                                                      // }

                                                      var total_amount = 0;

                                                      // var tuples = [];

                                                      // for (var key in result) tuples.push([key, result[key]]);

                                                      // tuples.sort(function(b, a) {
                                                      //     a = a[1];
                                                      //     b = b[1];

                                                      //     return a < b ? -1 : (a > b ? 1 : 0);
                                                      // });


                                                      // for (var i = 0; i < tuples.length; i++) 
                                                      // {
                                                      //     var key = tuples[i][0];
                                                      //     var value = tuples[i][1];

                                                      //    // alert(key + " => " + value);

                                                      //     var trnew = "<tr>"+
                                                      //                     "<td style='font-size: 2vw;' >" + key      +"</td>"+
                                                      //                     "<td style='font-size: 2vw;' >" + value    +"</td>"+              
                                                      //               "</tr>";

                                                      //     total_amount += value;

                                                      //     $("#max_table").append(trnew);
                                                      // }





                                                        $("#top_max_total").html(total_amount);

                                                    }});                                               
                                      }


                                      //End OverDigits

                            });


                $("#digit").keyup(function( event ) 
                            { 

                                //Digit 2 လုံး ဖြစ်ရင် Amount ဘက်ကိုသွား

                                // var digit   = $("#digit").val();

                                //  if( digit.length == 2)
                                // {
                                //     var first   = digit.substr(0, 1);
                                //     var second  = digit.substr(1, 1);

                                //     if( (isNaN(first) == false) && 
                                //         (second == "/" || second == "b" || second == "B")
                                //       )
                                //     {
                                //        $("#amount").focus();
                                //     } 

                                // }

                                // if( digit.length == 2)
                                // {
                                //     var first   = digit.substr(0, 1);
                                //     var second  = digit.substr(1, 1);
                                    

                                //     if( (isNaN(first) == false || first == "*" ) && 
                                //         (isNaN(second) == false || second == "*") 
                                            
                                //       )
                                //     {
                                //        $("#amount").focus();
                                //     } 
                                // }

                                // if( digit.length == 2)
                                // {
                                //     var first   = digit.substr(0, 1);
                                //     var second  = digit.substr(1, 1);
                                    

                                //     if( (isNaN(first) == false || first == "*" ) && 
                                //         (second == "r" || second == "-") 
                                            
                                //       )
                                //     {
                                //        $("#amount").focus();
                                //     } 
                                // }


                                // if(digit.length == 1 && (digit == "+" || digit == "r" || digit == "R" || digit == "-" || digit == "*"))
                                // {
                                //     $("#amount").focus();
                                // }

                                //Digit 2 လုံး ဖြစ်ရင် Amount ဘက်ကိုသွား

                               
                             
                            });

                $("#digit").keypress(function( event ) 
                            {  
                                if ( event.which == 13 ) 
                                {
                                   event.preventDefault();                                 
                                   $("#amount").select().focus();
                                }
                             
                            });



                //12R, 12+, 12/ Logic
                $("#amount").keyup(function( event ) 
                            { 
                                var amount   = $("#amount").val();

                                if(amount.length == 1 && (amount == "+" || amount == "R" || amount == "r" || amount == "/" || amount == "*") )
                                {
                                   var digit = $("#digit").val();
                                   $("#digit").val(digit + amount)

                                   $("#amount").val("");                                   
                                }
                             
                            });

                //12R, 12+, 12/ Logic
                
                $("#amount").keypress(function( event ) 
                            {
                              if ( event.which == 13 && $("#keyboard").val() == "On") 
                              {
                                  event.preventDefault();

                                   work_file_id    = $('#work_file_id').val();
                                   user_id         = $('#user_id').val();
                                   digit           = $('#digit').val();
                                   amount          = $('#amount').val();
                                   slip_id         = $('#slip_id').val();
                                   in_out          = $('#in_out').val();
                                  

                                    //Show
                                    if(event.which == 13)
                                    {

                                        // var status = navigator.onLine;

                                        // if(!status)
                                        // {
                                        //     alert('No internet Connection !!');
                                            
                                        //     return
                                        // }
                                        // else
                                        // {

                                        
                                        //Max Table Current Showing
                                        $('#max_table tr').each(function(){

                                          var currentRow = $(this);
                                          
                                          // alert(typeof(currentRow));

                                          var max_digit  = $(this).find('td:eq(0)').text();
                                          var max_amount = $(this).find('td:eq(1)').text();

                                          var type_amount = parseInt(amount.trim());
                                              max_amount  = parseInt(max_amount.trim());

                                          // alert(typeof(type_amount) + "/" + type_amount + "/"+ type_amount.length);
                                          
                                          digit     = digit.trim();
                                          max_digit = max_digit.trim();

                                          if(digit.localeCompare(max_digit) === 0)
                                          {
                                            if(in_out.localeCompare('1') === 0)
                                            {
                                              $(this).find('td:eq(1)').text(max_amount + type_amount);
                                            }

                                            if(in_out.localeCompare('2') === 0)
                                            {
                                              $(this).find('td:eq(1)').text(max_amount - type_amount);
                                            }
                                                                                        
                                          }

                                          if($(this).find('td:eq(1)').text() == 0)
                                          { 
                                            $(this).closest("tr").remove();
                                          }

                                        });
                                        //Max Table Current Showing



                                        // var s_id = jQuery('#slip_id').val();

                                        var msBeforeAjaxCall = new Date().getTime();


                                      //sale table
                                      jQuery.ajax({

                                          url: "{{ url('getDigits') }}",                                       
                                          method: 'get',
                                          data: {
                                             work_file_id: jQuery('#work_file_id').val(),
                                             user_id: jQuery('#user_id').val(),
                                             digit: jQuery('#digit').val(),
                                             amount: jQuery('#amount').val(),
                                             r_amount: jQuery('#r_amount').val(),
                                             slip_id: jQuery('#slip_id').val(),
                                             max_minus: jQuery('#max_minus').val(),                                             
                                             
                                          },
                                          timeout: 2000,                                                                    
                                                    
                                        //   success: function(result)
                                        //   { 

                                        //   }
                                          //success

                                          

                                      }).done(function (result, status, xhr) {

                                        // alert(typeof(result));

                                        // result = JSON.parse(result);

                                        var result1 = result.three_sales;

                                        var result2 = result.over_digits;

                                        $("#top_max_total").html(result.max_total);

                                        if(result2)
                                        {
                                          //For Break Table

                                                // var result2 = result.over_digits;

                                                $("#max_table").find("tr").remove();

                                                // var total_amount = 0;
                                                var tuples = [];

                                                for (var key in result2) tuples.push([key, result2[key]]);

                                                tuples.sort(function(b, a) {
                                                    a = a[1];
                                                    b = b[1];

                                                    return a < b ? -1 : (a > b ? 1 : 0);
                                                });


                                                for (var i = 0; i < tuples.length; i++) 
                                                {
                                                    var key   = tuples[i][0];
                                                    var value = tuples[i][1];

                                                    // alert(key + " => " + value);

                                                    var trnew = "<tr>"+
                                                                    "<td style='font-size: 14px;' >" + key      +"</td>"+
                                                                    "<td style='font-size: 14px;' >" + value    +"</td>"+
                                                              "</tr>";

                                                    // total_amount += value;

                                                    $("#max_table").append(trnew);
                                                }

                                                // $("#max_total").html(total_amount);

                                              //For Break Table
                                        }


                                        if(result1)
                                        {
                                            
                                            
                                        //done
                                            var total_amount = 0;
                                            var show_count = 1;

                                          $("#upper_table").find("tr").remove();

                                          $("#upper_table form").remove();
                                        
                                          var trnew;
                                          var tdnew;


                                           var col_type = "";
                                           var type = "";
                                           var big_recycle = "";

                                           for(var count = 0; count < result1.length; count++)
                                           {
                                              total_amount += result1[count].amount;
                                             
                                              if(col_type != result1[count].type)
                                              {
                                                 var t = "<input name='type' type='text' value='" + result1[count].type + "'  />";
                                              }
                                              else
                                              {
                                                 var t = "";
                                              }

                                               var ty = result1[count].type;


                                              if ( (isNaN(ty) == true && col_type != ty ) || (isNaN(ty) == false && ty.length >=3 && col_type != ty ) )
                                              {                                                   

                                                  var type_del =  "<button type='submit' name='action' value='Type-Del' class='btnGroup'>"+

                                                                    "<i class='fa fa-trash' aria-hidden='true' style='color: red; cursor:pointer;'></i>" +
                                                        
                                                                  "</button>";                                                               
                                              }
                                              else
                                              {
                                                  var type_del = " ";
                                              }

                                               var id = "<input name='id' style='color: black;' type='text' value='" + result1[count].id + "'  />";

                                               var no = "<input style='color: black;' type='text' value='" + show_count + "'  />";

                                               var d = "<input name='digit' style='color: black;' type='text' value='" + result1[count].digit + "' readonly />";

                                               var a = "<input name='amount' style='color: black;' type='text' value='" + result1[count].amount + "'  />";

                                               var save    = "<input type='submit' name='action' value='Save' class='btn btn-primary btn-sm' id='d_save'>";

                                                // var type_del    = "<input type='submit' name='action' value='Type-Del' class='btn btn-primary btn-sm' id='d_save'>";

                                                 // var del    = "<input type='submit' name='action' value='Del' class='btn btn-primary btn-sm' id='d_save'>";



                                               var del =  "<button type='submit' name='action' value='Del' class='btnOne'>"+

                                                              "<i class='fa fa-trash' aria-hidden='true' style='color: red; font-size:12px; cursor:pointer;'></i>" +
                                                          
                                                              "</button>";


                                              trnew   = "<tr></tr>";

                                              tdnew   = 

                                              "<td class='b_id' >"          +   id                      + "</td>" +
                                              "<td class='b_no' >"          +   no              + "</td>" +
                                              "<td class='b_digit' >"       +   d                       + "</td>" +
                                              "<td class='b_amount'>"       +   a                       + "</td>" +
                                              "<td class='b_type' >"        +   t                       + "</td>" +
                                              "<td class='b_save' >"        +   save                    + "</td>" +
                                              "<td class='b_one' >"         +   type_del               + "</td>" +
                                              "<td class='b_group' >"       +   del                 + "</td>";
                                                                                         


                              $("#upper_table").append(trnew);

                              $("#upper_table tr:last").append('<div class="share"> </div>'); 

                              $("#upper_table tr:last .share").css('margin-left',-5);

                              $("#upper_table tr:last .share").append('<form action="http://localhost/tha_2d/public/3dsale/update-del" method="get"> </form>');                             

                              $("#upper_table tr:last .share form").append(tdnew);


                                              // $("#upper_table").append(trnew);  

                                              $("#slip_id").val(result1[count].slip_id);
                                              $("#last_slip").val(result1[count].slip_id);

                                              $("#u_id").val(result1[count].user_id);
                                              $("#s_id").val(result1[count].slip_id);

                                              show_count +=1;
                                              col_type = result1[count].type;

                                            }

                                              $("#slip_total").val(total_amount);
                                              $("#total").val(total_amount);

                                              var comm          = $("#comm").val();
                                              var comm_amount   = total_amount * comm/100;
                                              var net_total     = total_amount - comm_amount;

                                              $("#total").val(total_amount);
                                              $("#net_total").val(net_total);

                                              $('#table_box').scrollTop( $('#table_box')[0].scrollHeight ); 

                                        //done

                                               

                                        }
                                        else
                                        {
                                            // alert("Slip " + s_id + " Connection is too low !");

                                              var msAfterAjaxCall = new Date().getTime();
                                                var timeTakenInMs = msAfterAjaxCall - msBeforeAjaxCall;
                                                if (timeTakenInMs > 2000) 
                                                {                                                 
                                                    alert(" Connection Long Time ( " + timeTakenInMs + " ) Miliseconds !");
                                                }
                                                    
                                        }

                                        }).fail(function (xhr, status, error) {
                                            
                                            alert("Result: " + status + " " + error + " " + xhr.status + " " + xhr.statusText);
                                            

                                        });// sale table

                                      // $("#refresh").click();
                                        
                                         // }//check connection

                                    }
                                    //End Show

                                      $("#digit").val("");
                                      // $("#amount").val("");
                                    
                                      $("#digit").focus();

                                      if($('#kb_state').prop("checked") == true)
                                      {
                                        $("#digit").focus();
                                      }
                                      else if($('#kb_state').prop("checked") == false)
                                      {
                                         $('#exampleModalCenter').modal('hide');
                                      }


                                      
                              }



                               

                             
                            });

              
              //Testing R Amount
                  $("#r_amount").keypress(function( event ) 
                            {
                              if ( event.which == 13 && $("#keyboard").val() == "On") 
                              {
                                  event.preventDefault();

                                   work_file_id    = $('#work_file_id').val();
                                   user_id         = $('#user_id').val();
                                   digit           = $('#digit').val();
                                   amount          = $('#amount').val();
                                   r_amount          = $('#r_amount').val();
                                   slip_id         = $('#slip_id').val();
                                   in_out          = $('#in_out').val();
                                  

                                    //Show
                                    if(event.which == 13)
                                    {

                                        // var status = navigator.onLine;

                                        // if(!status)
                                        // {
                                        //     alert('No internet Connection !!');
                                            
                                        //     return
                                        // }
                                        // else
                                        // {

                                        
                                        //Max Table Current Showing
                                        $('#max_table tr').each(function(){

                                          var currentRow = $(this);
                                          
                                          // alert(typeof(currentRow));

                                          var max_digit  = $(this).find('td:eq(0)').text();
                                          var max_amount = $(this).find('td:eq(1)').text();

                                          var type_amount = parseInt(amount.trim());
                                              max_amount  = parseInt(max_amount.trim());

                                          // alert(typeof(type_amount) + "/" + type_amount + "/"+ type_amount.length);
                                          
                                          digit     = digit.trim();
                                          max_digit = max_digit.trim();

                                          if(digit.localeCompare(max_digit) === 0)
                                          {
                                            if(in_out.localeCompare('1') === 0)
                                            {
                                              $(this).find('td:eq(1)').text(max_amount + type_amount);
                                            }

                                            if(in_out.localeCompare('2') === 0)
                                            {
                                              $(this).find('td:eq(1)').text(max_amount - type_amount);
                                            }
                                                                                        
                                          }

                                          if($(this).find('td:eq(1)').text() == 0)
                                          { 
                                            $(this).closest("tr").remove();
                                          }

                                        });
                                        //Max Table Current Showing

                                        // var s_id = jQuery('#slip_id').val();

                                        var msBeforeAjaxCall = new Date().getTime();


                                      //sale table
                                      jQuery.ajax({

                                          url: "{{ url('getDigits') }}",                                       
                                          method: 'get',
                                          data: {
                                             work_file_id: jQuery('#work_file_id').val(),
                                             user_id: jQuery('#user_id').val(),
                                             digit: jQuery('#digit').val(),
                                             amount: jQuery('#amount').val(),
                                             r_amount: jQuery('#r_amount').val(),
                                             slip_id: jQuery('#slip_id').val(),
                                             
                                          },
                                          timeout: 2000,                                                                    
                                                    
                                        //   success: function(result)
                                        //   { 

                                        //   }
                                          //success

                                          

                                      }).done(function (result, status, xhr) {

                                        // alert(typeof(result));

                                        // result = JSON.parse(result);

                                        if (typeof(result) == 'object')
                                        {
                                            
                                            
                                        //done
                                            var total_amount = 0;
                                            var show_count = 1;

                                           $("#upper_table").find("tr:not(:first)").remove();

                                           var col_type = "";
                                           var type = "";
                                           var big_recycle = "";

                                           for(var count = 0; count < result.length; count++)
                                           {
                                              total_amount += result[count].amount;
                                             
                                              if(col_type != result[count].type)
                                              {
                                                type = "<td style='width: 70px; text-align: center;'>" + result[count].type  +"</td>"; 
                                              }
                                              else
                                              {
                                                type = "<td style='width: 70px; text-align: center;'>" + " "  +"</td>";
                                              }
                                              if(isNaN(result[count].type) == true && col_type != result[count].type)
                                              {                                                   

                                                  big_recycle = "<td style='width: 30px;'>"+

                                                                  "<div class='btnGroup'>"+

                                                                    "<i class='fa fa-trash' aria-hidden='true' style='color: red; cursor:pointer;'></i>" +
                                                        
                                                                  "</div>"+

                                                                "</td>";
                                              }
                                              else
                                              {
                                                  big_recycle = "<td style='width: 30px;'>"+ " " + "</td>";
                                              }


                                              var trnew = "<tr>"+

                                              "<td hidden>"                                   + result[count].id           +"</td>"+
                                              "<td style='width: 30px; text-align: center;'>" + show_count                 +"</td>"+
                                              "<td style='width: 50px; text-align: center;'>" + result[count].digit        +"</td>"+
                                              "<td style='width: 70px; text-align: right;' >" + result[count].amount       +"</td>"+
                                              
                                              type +

                                              big_recycle +               

                                                         "<td style='width: 30px;' >"+

                                                            "<div class='btnOne'>"+

                                                            "<i class='fa fa-trash' aria-hidden='true' style='color: red; font-size:12px; cursor:pointer;'></i>" +
                                                          
                                                            "</div>"+

                                                          "</td>"+
                                                                       
                                                "</tr>";

                                              $("#upper_table").append(trnew);  

                                              $("#slip_id").val(result[count].slip_id);
                                              $("#u_id").val(result[count].user_id);
                                              $("#s_id").val(result[count].slip_id);

                                              show_count +=1;
                                              col_type = result[count].type;

                                            }

                                              $("#slip_total").val(total_amount);
                                              $("#total").val(total_amount);

                                              var comm          = $("#comm").val();
                                              var comm_amount   = total_amount * comm/100;
                                              var net_total     = total_amount - comm_amount;

                                              $("#total").val(total_amount);
                                              $("#net_total").val(net_total);

                                              $('#show_table').scrollTop( $('#show_table')[0].scrollHeight ); 

                                        //done

                                               

                                        }
                                        else
                                        {
                                            // alert("Slip " + s_id + " Connection is too low !");

                                              var msAfterAjaxCall = new Date().getTime();
                                                var timeTakenInMs = msAfterAjaxCall - msBeforeAjaxCall;
                                                if (timeTakenInMs > 2000) 
                                                {                                                 
                                                    alert(" Connection Long Time ( " + timeTakenInMs + " ) Miliseconds !");
                                                }
                                                    
                                        }

                                        }).fail(function (xhr, status, error) {
                                            
                                            alert("Result: " + status + " " + error + " " + xhr.status + " " + xhr.statusText);
                                            

                                        });// sale table

                                      // $("#refresh").click();
                                        
                                         // }//check connection

                                    }
                                    //End Show

                                      
                                       $("#digit").val("");
                                       $("#amount").val("");
                                       $("#r_amount").val("0");
                                      
                                       $("#digit").focus();

                                      if($('#kb_state').prop("checked") == true)
                                      {
                                        $("#digit").focus();
                                      }
                                      else if($('#kb_state').prop("checked") == false)
                                      {
                                         $('#exampleModalCenter').modal('hide');
                                      }

                              }

                               

                             
                            });
              //End Testing R Amount
                
              

               $("#upper_table").on('click','.btnOne',function(){
                                 // get the current row
                                 var currentRow=$(this).closest("tr"); 
                                 
                                 var id=currentRow.find("td:eq(0)").text(); 

                                 
                                 //testing
                                 if(id)
                                 {
                                    jQuery.ajax({
                                                    url: "{{ url('delDigits') }}",
                                                    method: 'get',
                                                    data: {
                                                       
                                                       id: id
                                                       
                                                    },
                                                    
                                                    success: function(result)
                                          {

                                            var total_amount = 0;
                                            var show_count = 1;

                                           $("#upper_table").find("tr:not(:first)").remove();

                                           var col_type = "";
                                           var type = "";
                                           var big_recycle = "";

                                           for(var count = 0; count < result.length; count++)
                                           {
                                              total_amount += result[count].amount;
                                             
                                              if(col_type != result[count].type)
                                              {
                                                type = "<td style='width: 70px; text-align: center;'>" + result[count].type  +"</td>"; 
                                              }
                                              else
                                              {
                                                type = "<td style='width: 70px; text-align: center;'>" + " "  +"</td>";
                                              }
                                              if(isNaN(result[count].type) == true && col_type != result[count].type)
                                              {                                                   

                                                  big_recycle = "<td style='width: 30px;'>"+

                                                                  "<div class='btnGroup'>"+

                                                                    "<i class='fa fa-trash' aria-hidden='true' style='color: red; cursor:pointer;'></i>" +
                                                        
                                                                  "</div>"+

                                                                "</td>";
                                              }
                                              else
                                              {
                                                  big_recycle = "<td style='width: 30px;'>"+ " " + "</td>";
                                              }


                                              var trnew = "<tr>"+

                                              "<td hidden>"                                   + result[count].id           +"</td>"+
                                              "<td style='width: 30px; text-align: center;'>" + show_count                 +"</td>"+
                                              "<td style='width: 50px; text-align: center;'>" + result[count].digit        +"</td>"+
                                              "<td style='width: 70px; text-align: right;' >" + result[count].amount       +"</td>"+
                                              
                                              type +

                                              big_recycle +               

                                                         "<td style='width: 30px;' >"+

                                                            "<div class='btnOne'>"+

                                                            "<i class='fa fa-trash' aria-hidden='true' style='color: red; font-size:12px; cursor:pointer;'></i>" +
                                                          
                                                            "</div>"+

                                                          "</td>"+
                                                                       
                                                "</tr>";

                                              $("#upper_table").append(trnew);  

                                              $("#slip_id").val(result[count].slip_id);
                                              $("#u_id").val(result[count].user_id);
                                              $("#s_id").val(result[count].slip_id);

                                              show_count +=1;
                                              col_type = result[count].type;

                                            }

                                              $("#slip_total").val(total_amount);
                                              $("#total").val(total_amount);

                                              var comm          = $("#comm").val();
                                              var comm_amount   = total_amount * comm/100;
                                              var net_total     = total_amount - comm_amount;

                                              $("#total").val(total_amount);
                                              $("#net_total").val(net_total);

                                              $('#show_table').scrollTop( $('#show_table')[0].scrollHeight );

                                          }//success


                                              });
                                 }

                                 //end testing
                                       $("#digit").val("");
                                       $("#amount").val("");
                                       
                                       $("#digit").focus();

                                      if($('#kb_state').prop("checked") == true)
                                      {
                                        $("#digit").focus();
                                      }
                                      else if($('#kb_state').prop("checked") == false)
                                      {
                                         $('#exampleModalCenter').modal('hide');
                                      }
                                     

                            });


                  $("#upper_table").on('click','.btnGroup',function(){
                                 // get the current row
                                 var currentRow=$(this).closest("tr"); 
                                 
                                 var id=currentRow.find("td:eq(0)").text(); // get current row 1st TD value
                                 // var col2=currentRow.find("td:eq(1)").text(); // get current row 2nd TD
                                 // var col3=currentRow.find("td:eq(2)").text(); // get current row 3rd TD
                                 // var data=col1+"\n"+col2+"\n"+col3;
                                 
                                 //testing
                                 if(id)
                                 {
                                    jQuery.ajax({
                                                    url: "{{ url('groupdelDigits') }}",
                                                    method: 'get',
                                                    data: {
                                                       
                                                       id: id
                                                       
                                                    },
                                                    success: function(result)
                                          {

                                            var total_amount = 0;
                                            var show_count = 1;

                                           $("#upper_table").find("tr:not(:first)").remove();

                                           var col_type = "";
                                           var type = "";
                                           var big_recycle = "";

                                           for(var count = 0; count < result.length; count++)
                                           {
                                              total_amount += result[count].amount;
                                             
                                              if(col_type != result[count].type)
                                              {
                                                type = "<td style='width: 70px; text-align: center;'>" + result[count].type  +"</td>"; 
                                              }
                                              else
                                              {
                                                type = "<td style='width: 70px; text-align: center;'>" + " "  +"</td>";
                                              }
                                              if(isNaN(result[count].type) == true && col_type != result[count].type)
                                              {                                                   

                                                  big_recycle = "<td style='width: 30px;'>"+

                                                                  "<div class='btnGroup'>"+

                                                                    "<i class='fa fa-trash' aria-hidden='true' style='color: red; cursor:pointer;'></i>" +
                                                        
                                                                  "</div>"+

                                                                "</td>";
                                              }
                                              else
                                              {
                                                  big_recycle = "<td style='width: 30px;'>"+ " " + "</td>";
                                              }


                                              var trnew = "<tr>"+

                                              "<td hidden>"                                   + result[count].id           +"</td>"+
                                              "<td style='width: 30px; text-align: center;'>" + show_count                 +"</td>"+
                                              "<td style='width: 50px; text-align: center;'>" + result[count].digit        +"</td>"+
                                              "<td style='width: 70px; text-align: right;' >" + result[count].amount       +"</td>"+
                                              
                                              type +

                                              big_recycle +               

                                                         "<td style='width: 30px;' >"+

                                                            "<div class='btnOne'>"+

                                                            "<i class='fa fa-trash' aria-hidden='true' style='color: red; font-size:12px; cursor:pointer;'></i>" +
                                                          
                                                            "</div>"+

                                                          "</td>"+
                                                                       
                                                "</tr>";

                                              $("#upper_table").append(trnew);  

                                              $("#slip_id").val(result[count].slip_id);
                                              $("#u_id").val(result[count].user_id);
                                              $("#s_id").val(result[count].slip_id);

                                              show_count +=1;
                                              col_type = result[count].type;

                                            }

                                              $("#slip_total").val(total_amount);
                                              $("#total").val(total_amount);

                                              var comm          = $("#comm").val();
                                              var comm_amount   = total_amount * comm/100;
                                              var net_total     = total_amount - comm_amount;

                                              $("#total").val(total_amount);
                                              $("#net_total").val(net_total);

                                              $('#show_table').scrollTop( $('#show_table')[0].scrollHeight );

                                          }//success


                                              });
                                 }

                                 //end testing
                                       $("#digit").val("");
                                       $("#amount").val("");
                                       
                                       $("#digit").focus();

                                      if($('#kb_state').prop("checked") == true)
                                      {
                                        $("#digit").focus();
                                      }
                                      else if($('#kb_state').prop("checked") == false)
                                      {
                                         $('#exampleModalCenter').modal('hide');
                                      }

                            });



                
                $("#digit").change( function()
                                  {
                                    var digit   = $("#digit").val();

                                    // alert(digit.length);
                                    
                                    if( digit.length ==2)
                                    {
                                      var first   = digit.substr(0, 1);
                                      var second  = digit.substr(1, 1);

                                       // Digit => R
                                      if( isNaN(first) == false && isNaN(second) == false )
                                        {

                                          r_digit = second + first;

                                          $("#r_label").html(r_digit);  
                                        }

                                      // ထိပ် => ပိတ်
                                      else if( isNaN(first) == false && (second == "T" || second == "t" || second == "*") )
                                        {
                                          r_digit = first + "N";                                        
                                          $("#r_label").html(r_digit);  
                                        }

                                      //ပိတ် => ထိပ်
                                      else if( isNaN(first) == false && (second == "N" || second == "n") )
                                        {
                                          r_digit = first + "T";                                        
                                          $("#r_label").html(r_digit);  
                                        }
                                      else if( (first == "*") && isNaN(second) == false)
                                        {
                                          r_digit = second + "T";                                        
                                          $("#r_label").html(r_digit);  
                                        }

                                      //နောက်စုံ => နောက်မ
                                      else if( isNaN(first) == false && (second == "S" || second == "s") )
                                        {
                                          r_digit = first + "M";                                        
                                          $("#r_label").html(r_digit);  
                                        }

                                      //နောက်မ => နောက်စုံ
                                      else if( isNaN(first) == false && (second == "M" || second == "m") )
                                        {
                                          r_digit = first + "S";                                        
                                          $("#r_label").html(r_digit);  
                                        }

                                      //ရှေ့စုံ => ရှေ့မ
                                       else if( (first == "S" || first == "s") && isNaN(second) == false )
                                        {
                                          r_digit = "M" + second;                                        
                                          $("#r_label").html(r_digit);  
                                        }

                                      //ရှေ့မ => ရှေ့စုံ
                                       else if( (first == "M" || first == "m") && isNaN(second) == false )
                                        {
                                          r_digit = "S" + second;                                        
                                          $("#r_label").html(r_digit);  
                                        }

                                      //စုံပူး => မပူး
                                      else if( (first == "S" || first == "s" || first == "+") && (second == "P" || second == "p" || second == "*") )
                                        {
                                          r_digit = "MP";                                        
                                          $("#r_label").html(r_digit);  
                                        }

                                      //မပူး => စုံပူး
                                      else if( (first == "M" || first == "m" || first == "-") && (second == "P" || second == "p" || second== "*") )
                                        {
                                          r_digit = "SP";                                        
                                          $("#r_label").html(r_digit);  
                                        }

                                      //စုံဆယ်ပြည့် => မဆယ်ပြည့်
                                      else if( (first == "D" || first == "d" ) && (second == "S" || second == "s") )
                                        {
                                          r_digit = "DM";                                        
                                          $("#r_label").html(r_digit);  
                                        }
                                      else if( (first == "/") && (second == "+") )
                                        {
                                          r_digit = "/-";                                        
                                          $("#r_label").html(r_digit);  
                                        }

                                      //မဆယ်ပြည့်  => စုံဆယ်ပြည့်
                                      else if( (first == "D" || first == "d" ) && (second == "M" || second == "m") )
                                        {
                                          r_digit = "DS";                                        
                                          $("#r_label").html(r_digit);  
                                        }
                                      else if( (first == "/") && (second == "-") )
                                        {
                                          r_digit = "/+";                                        
                                          $("#r_label").html(r_digit);  
                                        }

                                      //သေးကြီး => ကြီးသေး
                                      else if( (first == "T" || first == "t" ) && (second == "K" || second == "k") )
                                        {
                                          r_digit = "KT";                                        
                                          $("#r_label").html(r_digit);  
                                        }
                                      else if( (first == "+") && (second == "/") )
                                        {
                                          r_digit = "-/";                                        
                                          $("#r_label").html(r_digit);  
                                        }

                                      //ကြီးသေး  => သေးကြီး
                                      else if( (first == "K" || first == "k" ) && (second == "T" || second == "t") )
                                        {
                                          r_digit = "TK";                                        
                                          $("#r_label").html(r_digit);  
                                        }
                                      else if( (first == "-") && (second == "/") )
                                        {
                                          r_digit = "+/";                                        
                                          $("#r_label").html(r_digit);  
                                        }
                                     else
                                        {
                                          r_digit = "R Amount";                                        
                                          $("#r_label").html(r_digit); 
                                        }
                                       

                                    }

                                    if( digit.length == 3)
                                    {
                                      var first   = digit.substr(0, 1);
                                      var second  = digit.substr(1, 1);
                                      var third   = digit.substr(2, 1);

                                      //စုံကပ်လည် => မကပ်လည်
                                      if(   isNaN(first) === false && 
                                            (second == "S" || second == "s" || second == "+") &&
                                            (third == "R" || third == "r" || third == "+")
                                        )
                                      {
                                        r_digit = first + "MR";                                      
                                        $("#r_label").html(r_digit);  
                                      }

                                      //မကပ်လည် => စုံကပ်လည်
                                      else if(  isNaN(first) == false && 
                                                (second == "M" || second == "m" || second == "-") &&
                                                (third == "R" || third == "r" || third == "+")
                                              )
                                      {
                                        r_digit = first + "SR";                                      
                                        $("#r_label").html(r_digit);  
                                      }

                                      //နောက်စုံ => နောက်မ
                                      else if( isNaN(first) == false && (second == "*") && (third == "+") )
                                      {
                                        r_digit = first + "*-";                                      
                                        $("#r_label").html(r_digit);  
                                      }

                                      //နောက်မ => နောက်စုံ
                                      else if( isNaN(first) == false && (second == "*") && (third == "-") )
                                      {
                                        r_digit = first + "*+";                                      
                                        $("#r_label").html(r_digit);  
                                      }

                                      //ရှေ့စုံ  => ရှေ့မ
                                      else if( (first == "*")  && isNaN(second) == false && (third == "+") )
                                      {
                                        r_digit = "*" + second + "-";                                      
                                        $("#r_label").html(r_digit);  
                                      }

                                      //ရှေ့မ  => ရှေ့စုံ
                                      else if( (first == "*")  && isNaN(second) == false && (third == "-") )
                                      {
                                        r_digit = "*" + second + "+";                                      
                                        $("#r_label").html(r_digit);  
                                      } 

                                      else if( (isNaN(first) == false) && 
                                               (isNaN(second) == false) && 
                                               (isNaN(third) == false) 
                                              )
                                      {
                                         $("#amount").focus();
                                      }                                   

                                    }  

                                  }
                                );

              }
            );
</script>



<!-- <h1>Test</h1> -->

<div class="container">
<div class="row justify-content-center">

<div class="col-md-7 col-md-offset-2">

      <div class="card no-gutters">

      <input type="text" name="session_info" id="session_info"  @if(session('info'))  value="{{ session('info') }}" @else value="" @endif hidden >

      <input type="text" name="st" id="st"  @if($st != null)  value="{{ $st }}" @else value="" @endif hidden>


         
                  <div class="d-flex justify-content-between align-items-center">
                           
                       <span class="card-text"> 

                           <select name="work_file_id" id="work_file_id">                                         
                                <?php 
                                      $date           = date_create("$work_file->date");
                                      $work_file_date = date_format($date,"d-m-Y");
                                 ?>
                                <option value="{{ $work_file->id }}" @if($work_file->id == $work_file_id) selected @endif>
                                  {{ $work_file->name." ".$work_file->duration." [ ".$work_file_date." ] " }}
                                </option>
                            </select>                     

                        </span>

                        <span class="card-text">  

                          <select name="user_id" id="user_id"  style="width: 100px;">                                              
                          @foreach($users as $user)
                            <option value="{{ $user->id }}" @if($user->id == $user_id) selected @endif>
                              {{ $user->name }}
                            </option>
                          @endforeach
                        </select>

                        </span>

                         <span class="card-text">
                         <select  name="in_out"  id="in_out" style="width: 50px;">
                          
                          @if(auth()->user()->id == 1 || auth()->user()->id ==2)
                            <option value="1" @if($in_out == 1) selected @endif>IN</option>
                            <option value="2" @if($in_out == 2) selected @endif>OUT</option>
                          @else
                            <option value="1" @if($in_out == 1) selected @endif>IN</option>
                          @endif


                        </select>

                       </span>


                      

                  </div> 

            <!--  <marquee behavior="scrolling" direction="left" loop="infinite" scrolldelay="250" bgcolor="#0b7026" style="font-family:Book Antiqua; color: #FFFFFF">          
                         Hot: 
                         @foreach($hots as $hot)
                          {{ $hot->digit }}
                         @endforeach
              </marquee> -->


      </div>
</div>

<div class="col-3 col-sm-3 col-md-3 col-lg-3  mx-0 px-1">
    <div class="d-flex justify-content-center align-items-center">

       <span class="card-text">
          <a href="{{ url('/slip/list') }}" class="btn btn-primary btn-sm" >
             စလစ်
          </a>
      </span>              

    </div> 
</div>



</div>
</div>


<!-- Testing -->

<div class="container">
<div class="row justify-content-center">

     <div class="col-7 col-sm-7 col-md-7 col-lg-7  mx-0 px-1">
        <div class="card">
               
                  

                  <div  id="table_box" class="">

                    <table class="tbl_heading">
                      <thead>
                      <tr >
                    
                        <th class="b_id">         ID             </th>
                        <th class="b_no">         No            </th>
                        <th class="b_digit">      Digit          </th>  
                        <th class="b_amount">     Amount          </th> 
                        <th class="b_type">       Type           </th>     
                        <th class="b_save">       Save           </th>                               
                        <th class="b_group">      Group      </th>
                        <th class="b_one">        One        </th>   

                      </tr>

                    </thead>
                  </table>

                  <table id="upper_table" >
                    <tbody id="show_table" >


                     
                       <?php 
                                $col_type = "";

                                $show_count = 1;
                           ?>


                      @foreach($three_sales as $three_sale)

                      
                     



                            <tr>

                               <form action="http://localhost/tha_2d/public/3dsale/update-del" method="get" enctype="multipart/form-data">
                      {{ csrf_field() }}


                                  <td class='b_id' >
                                    <input name='id' type='text' value="{{$three_sale->id}}"  />
                                  </td>
                                  <td class='b_no' >
                                    <input name='no' type='text' value="{{$show_count}}"  />
                                  </td>
                                  <td class='b_digit' >
                                    <input name='digit' type='text' value="{{$three_sale->digit}}" readonly />
                                  </td>
                                  <td class='b_amount'>
                                    <input name='amount' type='text' value="{{$three_sale->amount}}"  />
                                  </td>
                                  <td class='b_type' >
                                    @if($col_type != $three_sale->type)
                                      <input name='type' type='text' value="{{$three_sale->type}}"  />
                                    @else
                                      <input name='blank' type='text' value="" readonly />
                                    @endif

                                  </td>
                                  <td class='b_save' >
                                    <input type='submit' name='action' value='Save' class='btn btn-primary btn-sm' >
                                  </td>
                                  
                                  <td class='b_one' >
                                     @if( $col_type != $three_sale->type && !is_numeric($three_sale->type))
                                              
                                    <button type='submit' name='action' value='Type-Del' class='btnGroup'>

                                     <i class='fa fa-trash' aria-hidden='true' style='color: red; cursor:pointer;'></i>
                          
                                    </button>
                                    @else
                                      <input name='blank' type='text' value="" readonly />
                                    @endif
                                  </td>

                                  <td class='b_group' >
                                    <button type='submit' name='action' value='Del' class='btnOne'>

                                    <i class='fa fa-trash' aria-hidden='true' style='color: red; font-size:12px; cursor:pointer;'></i>
                                
                                    </button>
                                  </td>

                               </form>

                            </tr>

                     

                            <?php 
                                $col_type = $three_sale->type;
                                $show_count++;
                           ?>


                      @endforeach



                    </tbody>
                  </table>

                </div>
               
                
      </div>   
      </div>

      @if(Auth::check())
      @if(auth()->user()->id == 1 or auth()->user()->id == 2)


      <div class="col-3 col-sm-3 col-md-3 col-lg-3  mx-0 px-1">


           <?php 
                      $max_total = 0;
                      foreach($over_digits as $key => $value)
                      {
                         $max_total += $value;
                      } 
                ?>

               


            
            <div class="d-flex justify-content-between align-items-center">

                    <span class="text-center"> 
                        <select name="max_minus"  id="max_minus" style="width: 100%; font-size: 12px;">
                          <option value="Max"  @if($max_minus == "Max") selected @endif>Max</option>
                          <option value="Minus" @if($max_minus == "Minus") selected @endif>Minus</option>
                        </select>
                    </span>

                    <span class="text-center" style="color: red; font-size: 12px;">
                      Total : <b id="top_max_total">{{ $max_total }}</b>
                    </span>

            </div>


            <div class="card" id="max_box" style="background-color: lightgray;">

               

                

                
                <a hidden id="refresh" name ="refresh" class="btn btn-primary btn-sm"> Refresh  </a>
                           
                
                <table class="table2" >
                    
                <tbody id="max_table" style="color: black;font-style: bold;" >

                  <form method="post" enctype="multipart/form-data">

                  {{ csrf_field() }}
                  
                 <!--  <tr>
                     <th style="font-size: 12px;">Digit</th>
                     <th style="font-size: 12px;">Amt</th>
                  </tr>  -->

                  <?php $max_total = 0; ?>

                  @foreach($over_digits as $key => $value)

                    @if($max_minus == "Max" && $value > 0)
                         <tr>
                           <td style="font-size: 11px;">  {{ $key }} </td>
                           <td style="font-size: 11px;">  {{ $value }} </td>
                         </tr>
                          <?php $max_total += $value; ?>
                    @endif

                    @if($max_minus == "Minus" && $value < 0)
                         <tr>
                           <td style="font-size: 11px;">  {{ $key }} </td>
                           <td style="font-size: 11px;">  {{ $value }} </td>
                         </tr>
                          <?php $max_total += $value; ?>
                    @endif

                  @endforeach                  
                   
                  </form>

                </tbody>
                </table>

              </div> <!-- Card -->  
            

        </div> 
        
        @else

        <div class="col-3 col-sm-3 col-md-3 col-lg-3  mx-0 px-1">

        </div>
        

        @endif

        @endif 



</div> 
</div>  

<div class="container">
<div class="row justify-content-center">
<div class="col-7 col-sm-7 col-md-7 col-lg-7  mx-0 px-1">


      <div class="d-flex justify-content-between align-items-right">  

           <span class="text-center"> 
          Last Slip: <input  type="text"   name="last_slip" id="last_slip" value="{{ $last_slip }}"  >
          </span>

           <span class="text-center"> 
          Total Amount: <input type="text" name="slip_total" id="slip_total" value="{{ $slip_total }}">
          </span>



          <span class="text-center"> 
          Current Slip: <input  type="text"   name="slip_id" id="slip_id" value="{{ $slip_id }}"  >
          </span>

         
           <span class="card-text">
                <a  class="btn btn-secondary btn-sm" href="{{ url("3dsale/padaythar") }}" id="image-text">
                 Padaythar
                </a>
           </span>

          

          <!--  <span class="card-text">
                <a  class="btn btn-secondary btn-sm" href="{{ url("3dsale/position") }}" id="image-text">
                 Position
                </a>
           </span> -->

           

      </div>

     

      
</div>

<div class="col-3 col-sm-3 col-md-3 col-lg-3  mx-0 px-1">

    <div class="d-flex justify-content-between align-items-right"> 
            
          <span class="card-text">
            <input type=button value="Copy" onClick="copytable('max_table')">
          </span>

            <span class="card-text">
                <a  class="btn btn-secondary btn-sm" href="{{ url("3dsale/image-text") }}" id="image-text">
                  Message
                </a>
            </span>

    </div>


</div>


</div>
</div>


<div class="container">
<div class="row justify-content-center">

<div class="col-7 col-sm-7 col-md-7 col-lg-7  mx-0 px-1">

       <div class="d-flex justify-content-between align-items-center" id="computer_keyboard">  
          <table id="d_a_r">
            <tr >

              <td>
                  <div>
                      <!-- <label name="digit_label" id="digit_label">Digit</label>                        -->
                      <input type="text" name="digit" id="digit" class="form-control"  value="" >
                  </div>
              </td>

              <td>
                  <div>  
                      <!-- <label name="amount_label" id="amount_label">Amount</label>                       -->
                      <input type="text" step="0.01" name="amount" id="amount" class="form-control"  value="">
                  </div>
              </td>

              <td>
                  <div>
                        <!-- <label name="r_label" id="r_label">R_Amt</label> -->
                      <input type="number" name="r_amount" class="form-control" id="r_amount" value="0">
                  </div>
              </td>

              <td>
                  <div>
                     <!-- <td style="text-align: left;"> -->
                        <input  type="button" id="save" class="btn btn-success" value="သိမ်းရန်" style="background: #ebb734;">
                    <!-- </td> -->
                  </div>
              </td>

          </tr>
          </table>


      </div>
</div>



<div class="col-3 col-sm-3 col-md-3 col-lg-3  mx-0 px-1">
      <table class="table table-sm" id="computer_box">
                  
                  <tr >
                    
                    <td style="text-align: center;">
                        <button type="button" id="start" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter" style="width: 200px; background: green;">
                             Mobile သုံးရန်
                            </button>
                    </td>

                    </tr>     

                  
                  <tr> 

                    <td style="text-align: center;">
                        <form action="{{ url('/3dsale/save')}}" method="get" enctype="multipart/form-data">

                            {{ csrf_field() }}

                            <input hidden  type="text" name="w_id"   id="w_id"  value="{{$work_file_id}}" style="width: 50px;" > 
                            <input hidden type="text" name="u_id"   id="u_id"  value="{{$user_id}}" style="width: 50px;" > 
                            <input hidden  type="text" name="s_id"   id="s_id"  value="{{$slip_id}}" style="width: 50px;" > 

                            <input hidden type="text" name="remark"   id="remark"  value="" >                              
                             
                            <input hidden type="submit" id="saveRemark"  class="btn btn-primary" value="သိမ်းရန်" >
                             
                            <input hidden type="submit" id="saveOut"  class="btn btn-primary" value="သိမ်းရန်" >

                            

                        </form>
                    </td>

                  </tr>
                </table>
</div>

</div>
</div>



<!-- Max Box -->

<div class="container">
<div class="row justify-content-center">
<div class="col-md-7 col-md-offset-2">


  <!-- Modal Box -->
  <!-- Button trigger modal -->


<!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered" role="document" style="align-items: flex-end;">
      <div class="modal-content">

          <div class="card" id="mobile_keyboard">

            


          <div class="d-flex justify-content-between align-items-center">

              <span class="card-text"> 
                Keyboard:             
                <select name="keyboard"  id="keyboard">
                    <option value="On"  @if($keyboard == "On") selected @endif>On</option>
                    <option value="Off" @if($keyboard == "Off") selected @endif>Off</option>
                </select>
              </span>

              <span class="card-text">
                  <div class="row">
                      <div class="btn-group toggle-switch">
                          <input type="checkbox"  class="check" id="kb_state" />
                          <button type="button" class="btn btn-info locked-active" style="font-size: 8px;" hidden >OFF</button>
                          <button type="button" class="btn btn-default unlocked-inactive" style="font-size: 8px;" hidden >ON</button>
                      </div>
                  </div>
              </span>

             

              <span class="card-text">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close_modal" style="font-size: 16px;">
                      <span aria-hidden="true" >&times;</span>
                    </button>
              </span>

          </div>

      <!-- Start Keypad -->
          <tr >

          <td colspan="3">
       
            <input hidden type="text" name="digit_amount" value="0" id="digit_amount" >

           <table class="table table-stripped table-sm" id="keypad">

                <tr>

                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="PW" value="ပါဝါ" style="width: 100%;font-size: 16px;">
                    </td>  
                                  
                     <td>
                      <input type="button" class="btn btn-info btn-sm" id="NK" value="နက္ခတ်" style="width: 100%;font-size: 16px;">
                    </td>
               
                    

                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="B" value="ဘရိတ်"  style="width: 100%;font-size: 16px;">
                    </td>

                   <!--  <td>
                      <input type="button" class="btn btn-info btn-sm" id="BR" value="ညီနောင်" style="width: 100%;font-size: 16px;">
                    </td> -->

                     <td >
                      <div id="header3" class="text-center">
                        <input type="button" value="More..." class="btn btn-info btn-sm" style="width: 100%;">
                      </div>
                    </td>


                     <td>
                      <input type="button" class="btn btn-info btn-sm"  value="Back" onclick = "backspace()" style="width: 100%; font-size: 18px;">
                    </td>     

                </tr>
                
               

                <tr>   

                     <td>
                      <input type="button" class="btn btn-info btn-sm"  value="- (အပါ)" onclick = "insert('-')" style="width: 100%;font-size: 16px;">
                    </td>           
                   
                    <td>                                          
                        <input type="button" class="btn btn-info btn-sm"  value="7" onclick = "insert(7)" style="width: 100%;font-size: 20px;">
                    </td> 

                     <td>
                      <input type="button" class="btn btn-info btn-sm"  value="8" onclick = "insert(8)" style="width: 100%;font-size: 20px;" >
                    </td>                   
               
                    <td>
                      <input type="button" class="btn btn-info btn-sm"  value="9" onclick = "insert(9)" style="width: 100%;font-size: 20px;">
                    </td>

                    <td>
                      <input type="button" class="btn btn-info btn-sm"  value="*(ထိပ်)" onclick = "insert('*')" style="width: 100%;font-size: 16px;">
                    </td>   


                                  
                </tr>

                


                <tr>  

                      <td>
                      <input type="button" class="btn btn-info btn-sm"  value="+ (R)" onclick = "insert('+')" style="width: 100%;font-size: 16px;">
                    </td>              
                   
                    <td>                                          
                        <input type="button" class="btn btn-info btn-sm"  value="4" onclick = "insert(4)" style="width: 100%;font-size: 20px;">
                    </td> 

                     <td>
                      <input type="button" class="btn btn-info btn-sm"  value="5" onclick = "insert(5)" style="width: 100%;font-size: 20px;">
                    </td>                   
               
                    <td>
                      <input type="button" class="btn btn-info btn-sm"  value="6" onclick = "insert(6)" style="width: 100%;font-size: 20px;">
                    </td>


                     <td>
                      <input type="button" class="btn btn-info btn-sm"  value="*(ပိတ်)" onclick = "insert('*')" style="width: 100%;font-size: 16px;">
                    </td>   

                   
                  
                                  
                </tr>

                <tr>  

                      <td>
                      <input type="button" class="btn btn-info btn-sm" id="TK" value="သေးကြီး" style="width: 100%;">
                    </td>                
                   
                    <td>                                          
                        <input type="button" class="btn btn-info btn-sm"  value="1" onclick = "insert(1)" style="width: 100%;font-size: 20px;">
                    </td> 

                     <td>
                      <input type="button" class="btn btn-info btn-sm"  value="2" onclick = "insert(2)" style="width: 100%;font-size: 20px;">
                    </td>                   
               
                    <td>
                      <input type="button" class="btn btn-info btn-sm"  value="3" onclick = "insert(3)" style="width: 100%;font-size: 20px;">
                    </td>

                    
                     <td>
                      <input type="button" class="btn btn-info btn-sm"  value="*(အပူး)" onclick = "insert('**')" style="width: 100%;font-size: 16px;">
                    </td>  
                                  
                </tr>

                <tr>  


                     <td>
                      <input type="button" class="btn btn-info btn-sm" id="KT" value="ကြီးသေး" style="width: 100%;">
                    </td>   


                    <td>                                          
                        <input type="button" class="btn btn-info btn-sm"  value="0" onclick = "insert('0')" style="width: 100%;font-size: 20px;">
                    </td> 

                    <td>
                      <input type="button" class="btn btn-info btn-sm"  value="00" onclick = "insert('00')" style="width: 100%;font-size: 20px;" >
                    </td>  


                      <td>                                          
                        <input type="button" class="btn btn-info btn-sm"  value="Del" onclick = "clearall()" style="width: 100%; font-size: 18px;">
                    </td> 

                    <td  colspan="2" >
                      <input type="button" class="btn btn-info btn-sm"  value="OK" onclick = "enter()" style="width: 100%;font-size: 18px;">
                    </td>
                                  
                </tr>

              

          </td>
          </tr>
          <!-- End Keypad -->


              <table class="table table-stripped table-sm" id="panel3" style="font-size: 12px;">

                 <tr>
                  
                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="SN" value="ရှေ့စုံ" style="width: 100%;">
                    </td>

                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="NS" value="နောက်စုံ" style="width: 100%;">
                    </td>

                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="MN" value="ရှေ့မ" style="width: 100%;">
                    </td>

                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="NM" value="နောက်မ" style="width: 100%;">
                    </td>                    

                </tr>


                <tr>
                    
                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="NSR" value="စုံကပ်လည်" style="width: 100%; " >
                    </td>

                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="NMR" value="မကပ်လည်" style="width: 100%; ">
                    </td>

                     <td>
                      <input type="button" class="btn btn-info btn-sm" id="SS" value="စုံစုံ" style="width: 100%;">
                    </td> 
                     <td>
                      <input type="button" class="btn btn-info btn-sm" id="MM" value="မမ" style="width: 100%;">
                    </td>  

                </tr>
               

                 <tr>
                     <td>
                      <input type="button" class="btn btn-info btn-sm" id="SM" value="စုံမ" style="width: 100%;">
                    </td>

                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="MS" value="မစုံ" style="width: 100%;">
                    </td>

                    
                     <td>
                      <input type="button" class="btn btn-info btn-sm" id="SP" value="စုံပူး" style="width: 100%;">
                    </td>
                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="MP" value="မပူး" style="width: 100%;">
                    </td>
                   
                </tr>

                 <tr> 
                    
               
                     <td>
                      <input type="button" class="btn btn-info btn-sm" id="DS" value="စုံဆယ်ပြည့်" style="width: 100%;">
                    </td>
                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="DM" value="မဆယ်ပြည့်" style="width: 100%;">
                    </td>

                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="D" value="ဆယ်ပြည့်" style="width: 100%;">
                    </td>
                                      
                </tr>

            
              </table>

             
            
        </td>      
       </tr>
        <!-- End Buttons -->      
       
    
      </form>
    </tbody>
    </table>


  </div>


        </div>

      </div>

    </div>
  </div>
  <!-- End Modal Box -->


</div>
</div>
</div>


<script>
$(document).ready(function()
{


  //   // Slip Enter
  // $("#slip_id").keypress(function( event ) 
  //               {  
  //                   if ( event.which == 13 ) 
  //                   {
  //                     var slip_id   = $("#slip_id").val();

  //                     $("#s_id").val(slip_id);

  //                     $("#saveOut").click();

  //                   }
                             
  //               });
  //   // Slip Enter


  // var slip_id   = $("#slip_id").val();
  // $("#s_id").val(slip_id);



  $("#slip_id").keypress(function( event ) 
                            {
                              if ( event.which == 13 && $("#keyboard").val() == "On") 
                              {

                                  var slip_id   = $("#slip_id").val();
                                  $("#s_id").val(slip_id);

                                  event.preventDefault();

                                   work_file_id    = $('#work_file_id').val();
                                   user_id         = $('#user_id').val();
                                   digit           = $('#digit').val();
                                   amount          = $('#amount').val();
                                   slip_id         = $('#slip_id').val();
                                   in_out          = $('#in_out').val();
                                  

                                    //Show
                                    if(event.which == 13)
                                    {

                                        // var status = navigator.onLine;

                                        // if(!status)
                                        // {
                                        //     alert('No internet Connection !!');
                                            
                                        //     return
                                        // }
                                        // else
                                        // {

                                        
                                        //Max Table Current Showing
                                        $('#max_table tr').each(function(){

                                          var currentRow = $(this);
                                          
                                          // alert(typeof(currentRow));

                                          var max_digit  = $(this).find('td:eq(0)').text();
                                          var max_amount = $(this).find('td:eq(1)').text();

                                          var type_amount = parseInt(amount.trim());
                                              max_amount  = parseInt(max_amount.trim());

                                          // alert(typeof(type_amount) + "/" + type_amount + "/"+ type_amount.length);
                                          
                                          digit     = digit.trim();
                                          max_digit = max_digit.trim();

                                          if(digit.localeCompare(max_digit) === 0)
                                          {
                                            if(in_out.localeCompare('1') === 0)
                                            {
                                              $(this).find('td:eq(1)').text(max_amount + type_amount);
                                            }

                                            if(in_out.localeCompare('2') === 0)
                                            {
                                              $(this).find('td:eq(1)').text(max_amount - type_amount);
                                            }
                                                                                        
                                          }

                                          if($(this).find('td:eq(1)').text() == 0)
                                          { 
                                            $(this).closest("tr").remove();
                                          }

                                        });
                                        //Max Table Current Showing



                                        // var s_id = jQuery('#slip_id').val();

                                        var msBeforeAjaxCall = new Date().getTime();


                                      //sale table
                                      jQuery.ajax({

                                          url: "{{ url('getDigits') }}",                                       
                                          method: 'get',
                                          data: {
                                             work_file_id: jQuery('#work_file_id').val(),
                                             user_id: jQuery('#user_id').val(),
                                             digit: jQuery('#digit').val(),
                                             amount: jQuery('#amount').val(),
                                             r_amount: jQuery('#r_amount').val(),
                                             slip_id: jQuery('#slip_id').val(),
                                             max_minus: jQuery('#max_minus').val(),                                             
                                             
                                          },
                                          timeout: 2000,                                                                    
                                                    
                                        //   success: function(result)
                                        //   { 

                                        //   }
                                          //success

                                          

                                      }).done(function (result, status, xhr) {

                                        // alert(typeof(result));

                                        // result = JSON.parse(result);

                                        var result1 = result.three_sales;

                                        var result2 = result.over_digits;

                                        $("#top_max_total").html(result.max_total);

                                        if(result2)
                                        {
                                          //For Break Table

                                                // var result2 = result.over_digits;

                                                $("#max_table").find("tr").remove();

                                                // var total_amount = 0;
                                                var tuples = [];

                                                for (var key in result2) tuples.push([key, result2[key]]);

                                                tuples.sort(function(b, a) {
                                                    a = a[1];
                                                    b = b[1];

                                                    return a < b ? -1 : (a > b ? 1 : 0);
                                                });


                                                for (var i = 0; i < tuples.length; i++) 
                                                {
                                                    var key   = tuples[i][0];
                                                    var value = tuples[i][1];

                                                    // alert(key + " => " + value);

                                                    var trnew = "<tr>"+
                                                                    "<td style='font-size: 14px;' >" + key      +"</td>"+
                                                                    "<td style='font-size: 14px;' >" + value    +"</td>"+
                                                              "</tr>";

                                                    // total_amount += value;

                                                    $("#max_table").append(trnew);
                                                }

                                                // $("#max_total").html(total_amount);

                                              //For Break Table
                                        }


                                        if(result1)
                                        {
                                            
                                            
                                        //done
                                            var total_amount = 0;
                                            var show_count = 1;

                                          $("#upper_table").find("tr").remove();

                                          $("#upper_table form").remove();
                                        
                                          var trnew;
                                          var tdnew;


                                           var col_type = "";
                                           var type = "";
                                           var big_recycle = "";

                                           for(var count = 0; count < result1.length; count++)
                                           {
                                              total_amount += result1[count].amount;
                                             
                                              if(col_type != result1[count].type)
                                              {
                                                 var t = "<input name='type' type='text' value='" + result1[count].type + "'  />";
                                              }
                                              else
                                              {
                                                 var t = "";
                                              }

                                              var ty = result1[count].type;


                                              if ( (isNaN(ty) == true && col_type != ty ) || (isNaN(ty) == false && ty.length >=3 && col_type != ty ) )
                                              {                                                   

                                                  var type_del =  "<button type='submit' name='action' value='Type-Del' class='btnGroup'>"+

                                                                    "<i class='fa fa-trash' aria-hidden='true' style='color: red; cursor:pointer;'></i>" +
                                                        
                                                                  "</button>";                                                               
                                              }
                                              else
                                              {
                                                  var type_del = " ";
                                              }

                                               var id = "<input name='id' style='color: black;' type='text' value='" + result1[count].id + "'  />";

                                               var no = "<input style='color: black;' type='text' value='" + show_count + "'  />";

                                               var d = "<input name='digit' style='color: black;' type='text' value='" + result1[count].digit + "' readonly />";

                                               var a = "<input name='amount' style='color: black;' type='text' value='" + result1[count].amount + "'  />";

                                               var save    = "<input type='submit' name='action' value='Save' class='btn btn-primary btn-sm' id='d_save'>";

                                                // var type_del    = "<input type='submit' name='action' value='Type-Del' class='btn btn-primary btn-sm' id='d_save'>";

                                                 // var del    = "<input type='submit' name='action' value='Del' class='btn btn-primary btn-sm' id='d_save'>";



                                               var del =  "<button type='submit' name='action' value='Del' class='btnOne'>"+

                                                              "<i class='fa fa-trash' aria-hidden='true' style='color: red; font-size:12px; cursor:pointer;'></i>" +
                                                          
                                                              "</button>";


                                              trnew   = "<tr></tr>";

                                              tdnew   = 

                                              "<td class='b_id' >"          +   id                      + "</td>" +
                                              "<td class='b_no' >"          +   no              + "</td>" +
                                              "<td class='b_digit' >"       +   d                       + "</td>" +
                                              "<td class='b_amount'>"       +   a                       + "</td>" +
                                              "<td class='b_type' >"        +   t                       + "</td>" +
                                              "<td class='b_save' >"        +   save                    + "</td>" +
                                              "<td class='b_one' >"         +   type_del               + "</td>" +
                                              "<td class='b_group' >"       +   del                 + "</td>";
                                                                                         


                              $("#upper_table").append(trnew);

                              $("#upper_table tr:last").append('<div class="share"> </div>'); 

                              $("#upper_table tr:last .share").css('margin-left',-5);

                              $("#upper_table tr:last .share").append('<form action="http://localhost/tha_2d/public/3dsale/update-del" method="get"> </form>');                             

                              $("#upper_table tr:last .share form").append(tdnew);


                                              // $("#upper_table").append(trnew);  

                                              $("#slip_id").val(result1[count].slip_id);
                                              $("#last_slip").val(result1[count].slip_id);

                                              $("#u_id").val(result1[count].user_id);
                                              $("#s_id").val(result1[count].slip_id);

                                              show_count +=1;
                                              col_type = result1[count].type;

                                            }

                                              $("#slip_total").val(total_amount);
                                              $("#total").val(total_amount);

                                              var comm          = $("#comm").val();
                                              var comm_amount   = total_amount * comm/100;
                                              var net_total     = total_amount - comm_amount;

                                              $("#total").val(total_amount);
                                              $("#net_total").val(net_total);

                                              $('#table_box').scrollTop( $('#table_box')[0].scrollHeight ); 

                                        //done

                                               

                                        }
                                        else
                                        {
                                            // alert("Slip " + s_id + " Connection is too low !");

                                              var msAfterAjaxCall = new Date().getTime();
                                                var timeTakenInMs = msAfterAjaxCall - msBeforeAjaxCall;
                                                if (timeTakenInMs > 2000) 
                                                {                                                 
                                                    alert(" Connection Long Time ( " + timeTakenInMs + " ) Miliseconds !");
                                                }
                                                    
                                        }

                                        }).fail(function (xhr, status, error) {
                                            
                                            alert("Result: " + status + " " + error + " " + xhr.status + " " + xhr.statusText);
                                            

                                        });// sale table

                                      // $("#refresh").click();
                                        
                                         // }//check connection

                                    }
                                    //End Show

                                      $("#digit").val("");
                                      // $("#amount").val("");
                                    
                                      $("#digit").focus();

                                      if($('#kb_state').prop("checked") == true)
                                      {
                                        $("#digit").focus();
                                      }
                                      else if($('#kb_state').prop("checked") == false)
                                      {
                                         $('#exampleModalCenter').modal('hide');
                                      }


                                      
                              }



                               

                             
                            });


    



    
    // Save Keep Break Info 
    $("#keep_break").change(function()
    {

      var keep_break    = $('#keep_break').val();
      var work_file_id  = $('#work_file_id').val();     
        
      if(work_file_id)
      {
        $.ajax(
            {
                type:   "GET",
                url:  "{{ url('saveBreak') }}?work_file_id="+work_file_id
                                              +"&keep_break="+keep_break,
                dataType: 'json',             
                success:function(res)
                {                                                   

                }
            } 
            );

    }

     
    });
    // End Save Keep Break Info

      
    // Save Entry Info 
    $("#entry").change(function()
    {

      
      var user_id  = $('#user_id').val();      
      var entry    = $('#entry').val();

         
      if(entry)
      {
        $.ajax(
            {
                type:   "GET",
                url:  "{{ url('saveEntry') }}?user_id="+user_id                                             
                                              +"&entry="+entry,
                dataType: 'json',             
                success:function(res)
                {                                                   

                }
            } 
            );

    }

     
    });
    // End Save Entry Info

    // Save View Info 
    $("#view").change(function()
    {

      var user_id  = $('#user_id').val();      
      var view    = $('#view').val();

         
      if(view)
      {
        $.ajax(
            {
                type:   "GET",
                url:  "{{ url('saveView') }}?user_id="+user_id                                             
                                              +"&view="+view,
                dataType: 'json',             
                success:function(res)
                {                                                   

                }
            } 
            );

    }

     
    });
    // End Save View Info

    // Save View Info 
    $("#keyboard").change(function()
    {

      var user_id       = $('#user_id').val();      
      var keyboard      = $('#keyboard').val();

        
      if(keyboard)
      {
        $.ajax(
            {
                type:   "GET",
                url:  "{{ url('saveKeyboard') }}?user_id="+user_id                                            
                                              +"&keyboard="+keyboard,
                dataType: 'json',             
                success:function(res)
                {                                                   

                }
            } 
            );

    }

     
    });
    // End Save View Info


   // In_Out Change => Get User
    $("#in_out").change(function()
    {
     

      var in_out = $('#in_out').val();

     
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
                        $("#user_id").change();
                    }
                }
            } 
           );       
      }

     
      // $('#btnShow').click();
     
    });
    // End In_Out Change => Get User


    // user_id Change
    $("#user_id").change(function()
    {    

      var user_id  = $('#user_id').val();

     
            jQuery.ajax({

                url: "{{ url('getThreeUserTotal') }}",
                method: 'get',
                data: {
                   
                   work_file_id: jQuery('#work_file_id').val(),
                   user_id: jQuery('#user_id').val(),
                   in_out: jQuery('#in_out').val(),
                },
                success:function(result)
                {  
                  if(result)
                  {
                    // for(var count = 0; count < result.length; count++)
                    // {
                     
                    //    $("#comm").val(result[count].threed_comm);
                                             
                      
                    // }

                    $("#last_slip").val(result.last_slip);
                    $("#slip_id").val(result.last_slip +1);
                    $('#slip_total').val(result.slip_total); 

                  } 
                   
                }

            });

    
          $("#u_id").val(user_id);
     
          $("#upper_table").find("tr").remove();

    });
    // End user_id Change


    // Slip Change
    $("#slip").change(function()
    {    

      var slip       = $('#slip').val(); 
         
      if(slip)
      {
        $.ajax(
            {
                type:   "GET",
                url:  "{{ url('saveSlip') }}?slip="+slip,
                dataType: 'json',             
                success:function(res)
                {                                                   
                   
                }
            } 
           );       
      }


    });
    // End Slip Change

   
     // Max_Minus Change
    $("#max_minus").change(function()
    {    

      var max_minus       = $('#max_minus').val(); 
      
      if(max_minus)
      {
        $.ajax(
            {
                type:   "GET",
                url:  "{{ url('saveMaxMinus') }}?max_minus="+max_minus,
                dataType: 'json',             
                success:function(res)
                {                                                   
                   
                }
            } 
           );       
      }

     // $("#refresh").click();

      // location. reload();
      

    });
    // End Max_Minus Change

    

    $("html, body").animate({ scrollTop: $(document).height() }, 10);

});

</script>

<script>
$(document).ready(function(){


  // var slip_id = $("#slip_id").val();

  // if(slip_id == 0)
  // {
  //   $("#saveOut").click();
  // }
  


  // Start Click
    $("#start").click(function()
    {    

      $("#d_a_r").prependTo($("#mobile_keyboard"));

      $("#keyboard").val("Off");
      $("#keyboard").change();

      $("#digit").select().focus();

    });
    // Start Click


    // Start Click
    $("#close_modal").click(function()
    {    

      $("#d_a_r").prependTo($("#computer_keyboard"));

      $("#keyboard").val("On");
      $("#keyboard").change();

      $("#digit").select().focus();


    });
    // Start Click


    
  $("#exampleModalCenter").on('shown.bs.modal', function(){

       $("#digit").val(""); 
       $("#amount").val("");

       $("#digit").focus();

       $('#exampleModalCenter').modal('show');


    });
  

});
</script>



<script type="text/javascript">
    (function ($) {

  $.fn.enableCellNavigation = function () {

    var arrow = {
      left: 37,
      up: 38,
      right: 39,
      down: 40
    };

      

    // select all on focus
    // works for input elements, and will put focus into
    // adjacent input or textarea. once in a textarea,
    // however, it will not attempt to break out because
    // that just seems too messy imho.
    this.find('input').keydown(function (e) {

        // alert("Hi");

      // shortcut for key other than arrow keys
      if ($.inArray(e.which, [arrow.left, arrow.up, arrow.right, arrow.down]) < 0) {
        return;
      }

      var input = e.target;
      var td = $(e.target).closest('td');
      var moveTo = null;

      switch (e.which) {

        case arrow.left:
          {
            if (input.selectionStart == 0) {
              moveTo = td.prev('td:has(input,textarea)');
            }
            break;
          }
        case arrow.right:
          {
            if (input.selectionEnd == input.value.length) {
              moveTo = td.next('td:has(input,textarea)');
            }
            break;
          }

        case arrow.up:
        case arrow.down:
          {

            // $("#type_card").hide();
            // $("#digit_card").hide();


            var tr = td.closest('tr');
            var pos = td[0].cellIndex;

            var moveToRow = null;
            if (e.which == arrow.down) 
            {
              moveToRow = tr.next('tr');
            } 
            else if (e.which == arrow.up) 
            {
              moveToRow = tr.prev('tr');
            }

            if (moveToRow.length) 
            {
              moveTo = $(moveToRow[0].cells[pos]);              
            }

            break;
          }

      }

      if (moveTo && moveTo.length) {

        e.preventDefault();

        moveTo.find('input,textarea').each(function (i, input) {

          input.focus();
          input.select();

        });

      }

    });

  };

})(jQuery);


// use the plugin
$(function () {
  $('#upper_table').enableCellNavigation();
});


  </script>


<script>

  $(document.body).on("keydown", this, function (event) {

     $("#user_id").keydown(function(event) {

        if(event.which == 13) 
        {
          event.preventDefault();
                         
          if(event.which == 13)
          {
              var slip_id = $("#slip_id").val();
              
              if(slip_id == 0)
              {
                $("#upper_table").find("tr").remove();
              }              

              $("#digit").focus();
          
          }          

        }

    });



    if (event.keyCode == 120) 
    {    
     
       $("#user_id").focus();
    }

  

});

</script>

<script type="text/javascript">

function copytable(el) {
    var urlField = document.getElementById(el)   
    var range = document.createRange()
    range.selectNode(urlField)
    window.getSelection().addRange(range) 
    document.execCommand('copy')
}

</script>


@endsection