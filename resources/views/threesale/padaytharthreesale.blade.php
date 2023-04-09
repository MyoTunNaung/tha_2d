<?php 

use App\Commission;

$threed_comm = Commission::where('user_id','=',$user_id)->value('threed_comm');

$comm_amount   = $slip_total * $threed_comm/100;

$net_total     = $slip_total - $comm_amount;

?>

@extends('layouts.app')
@section('content')


<input hidden  type="text" name="comm"        id="comm"       value="{{ $threed_comm }}" >
<input hidden  type="text" name="total"       id="total"      value="{{ $slip_total }}" >
<input hidden  type="text" name="net_total"   id="net_total"  value="{{ $net_total }}" >

<input hidden  type="text" name="auth_id"        id="auth_id"       value="{{ auth()->user()->id }}" >
<input hidden  type="text" name="in_out"         id="in_out"       value="{{ $in_out }}" >


<style type="text/css">
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



  if(digit_amount == 0)
  {
    var digit = $("#digit").val();
    digit += num;

    $("#digit").val(digit);

    $("#digit_amount").val(0);
    $("#digit").focus();

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

  if(digit.length == 1 || digit == "")
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
      $("#add_digit").click();  
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
      $("#add_digit").click();  
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
 
  if(digit_amount == 0)
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


  if(digit_amount == 1 && $("#amount").val() == "")
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
   
    height: 300px;
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
   
    height: 235px;
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



                // $('#digit').attr('readonly','readonly');
                // $('#amount').attr('readonly','readonly');
                // $('#r_amount').attr('readonly','readonly');

                $("#keyboard").change();

                $("#keyboard").change( function()
                                    {
                                      var keyboard = $("#keyboard").val();

                                     
                                      if(keyboard == "Off")
                                      {
                                          $('#digit').prop('readonly',true);
                                          $('#amount').prop('readonly',true);
                                          $('#r_amount').prop('readonly',true);
                                      }
                                      if(keyboard == "On")
                                      {
                                          $('#digit').prop('readonly',false);
                                          $('#amount').prop('readonly',false);
                                          $('#r_amount').prop('readonly',false);
                                      }

                                    }
                                  );

              // $(document).bind('keypress', 'a', function () {
              //                                               var keyboard = $("#keyboard").val();

              //                                               if(keyboard == "On")
              //                                               {    $("#keyboard").val("Off");
              //                                                    $("#keyboard").change();
              //                                               }
              //                                               if(keyboard == "Off")
              //                                               {
              //                                                    $("#keyboard").val("On");
              //                                                    $("#keyboard").change();
              //                                               }                                                           

              //                                               });


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



              $("#user_id").keypress(function( event ) 
                          {
                            if ( event.which == 13 ) 
                            {
                              event.preventDefault();                                 
                              $("#digit").focus();
                            }
                           
                          });



              $("#customer_id").keypress(function( event ) 
                          {
                            if ( event.which == 13 ) 
                            {
                              event.preventDefault();                                 
                              $("#digit").focus();
                            }
                           
                          });


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
                                        let text;

                                        let comm        = $("#comm").val();
                                        let total       = $("#total").val();
                                        let net_total   = $("#net_total").val();


                                        let remark = prompt(  "ကော်       = " + comm + "\n" + 
                                                              "ယူနစ်ပေါင်း   = " + total + "\n" + 
                                                              "ကော်နှုတ်ပြီးထိုးကြေး = " + net_total + "\n\n" + 
                                                              "ထိုးသားအမည်မှတ်ရန်:", "");

                                        if(remark != null)
                                        {
                                            $("#remark").val(remark);
                                            $("#saveRemark").click();
                                        }
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

                $("#NS").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "S";

                                    $("#digit").val(digit);

                                    $("#amount").focus();
                                    $("#digit_amount").val(1);

                                    $("#digit").change();
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

                                  }
                                );


                $("#SS").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit = "SS";

                                    $("#digit").val(digit);

                                    $("#amount").focus();
                                    $("#digit_amount").val(1);

                                    
                                   
                                  }
                                );
                


                $("#MM").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit = "MM";

                                    $("#digit").val(digit);

                                    $("#amount").focus();
                                    $("#digit_amount").val(1);

                                    
                                  }
                                );
                $("#SM").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "SM";

                                    $("#digit").val(digit);

                                    $("#amount").focus();
                                    $("#digit_amount").val(1);

                                  }
                                );
                $("#MS").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "MS";

                                    $("#digit").val(digit);

                                    $("#amount").focus();
                                    $("#digit_amount").val(1);
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

                $("#B").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "B";

                                    $("#digit").val(digit);

                                    $("#amount").focus();
                                    $("#digit_amount").val(1);
                                  }
                                );


                $("#digit").keypress(function( event ) 
                            {
                              if ( event.which == 13 ) 
                              {
                                 event.preventDefault();                                 
                                 $("#amount").focus();
                              }
                             
                            });

                $("#amount").keypress(function( event ) 
                            {
                              if ( event.which == 13 ) 
                              {
                                 // event.preventDefault();  

                                 // $("#amount").val("");
                                 // $("#digit").val("");                                                                
                                 $("#digit").focus();
                              }
                             
                            });
                
                // var hasFocus = $('#r_amount').is(':focus')
                // if(hasFocus)
                // {
                //     $('#r_amount').val('7');

                // }

                
                $("#digit").change( function()
                                  {
                                    var digit   = $("#digit").val();

                                    //alert(digit.length);
                                    
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

                                    }  

                                  }
                                );

              }
            );
</script>

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


<?php 
    $st = ""; 

    $date           = date_create("$work_file->date");
    $work_file_date = date_format($date,"d-m-Y");

?>



<div class="card no-gutters">

<input type="text" name="session_info" id="session_info"  @if(session('info'))  value="{{ session('info') }}" @else value="" @endif hidden >

<input type="text" name="st" id="st"  @if($st != null)  value="{{ $st }}" @else value="" @endif hidden>



<div class="container">
<div class="row justify-content-center">



     <div class="col-md-6 mx-0 px-1">

            <div class="card" id="table_box">

                   <div class="d-flex justify-content-between align-items-center" style="background-color: lightgray;">
                      <span class="card-text"> &nbsp; Slip: {{ $slip_id }}</span>
                      <span class="card-text"> &nbsp; {{ $work_file->name." [ ".$work_file_date." ] " }}</span>
                      <span class="card-text"> &nbsp; User: {{ $user_name }} &nbsp;</span>                                     
                  </div>

               
                  <table class="table1" id="upper_table" >
                  <thead>
                      <tr>
                        
                        <th  hidden >ID</th>
                        <th >စဉ်</th>

                        <th >ဂဏန်း</th>  
                        <th >ယူနစ်</th> 
                        <th >မှတ်ချက်</th>
                                    
                        <th > </th>
                        <th > </th>
                        
                      </tr>

                  </thead>

                  <tbody style="font-size: 16px;font-weight: bold;" id="show_table">
                      <?php

                          $col_type     = "";
                          $col_slip_id  = "";
                          $total        = 0;
                          $count = 1;
                       ?>
                      @foreach($three_sales as $three_sale)                     
                      
                      <tr>                         
                             <td hidden>{{ $three_sale->id }} </td>
                            <td>{{ $count }} </td>
                         
                          @if($three_sale->status == 1)
                            <td>{{ $three_sale->digit }}</td>
                          @else
                            <td style="color: red;">{{ $three_sale->digit }}</td>
                          @endif

                          @if($three_sale->status == 1)
                          
                            @if($view == "Unit")
                              <td >{{ $three_sale->amount/100 }}</td>
                            @else
                              <td >{{ $three_sale->amount }}</td>
                            @endif
                          @else
                            @if($view == "Unit")
                              <td style="color: red;">{{ $three_sale->amount/100 }}</td>
                            @else
                              <td style="color: red;">{{ $three_sale->amount }}</td>
                            @endif
                          @endif

                          @if($three_sale->type != $col_type)
                            <td >{{ $three_sale->type }}</td>
                          @else
                            <td></td>
                          @endif



                                               
                          @if($three_sale->type != $col_type)
                          <td> 
                            <a  href="{{ url("/3dsale/typedel/{$three_sale->id}") }}" class="btn btn-outline-danger btn-sm" >
                              <i class='fa fa-trash' aria-hidden='true' style='color: red; cursor:pointer;'></i>
                            </a>
                          </td>
                          @else
                          <td></td>
                          @endif

                          <td> 
                            <a  href="{{ url("/3dsale/del/{$three_sale->id}?action={$action}") }}" class="btn btn-outline-danger btn-sm" >
                              <i class='fa fa-trash' aria-hidden='true' style='color: red; font-size:12px; cursor:pointer;'></i>
                            </a>
                          </td>
                        
                      </tr>
                      <?php 
                        $col_slip_id  = $three_sale->slip_id;
                        $col_type     = $three_sale->type;

                        if($three_sale->status == 1)
                        {
                             if($view == "Unit")
                              { $total        += $three_sale->amount/100; }
                            else
                              { $total        += $three_sale->amount; }
                        }

                        $count++;
                       
                        
                      ?>
                      @endforeach


                     <!--  <tr style="border: 1px solid black;">  
                          
                         
                          <td >TOTAL</td>                          
                          <td style="text-align: right;">{{ number_format($total) }}</td>
                          <td >
                          <input  type="button" id="save" class="btn btn-success btn-sm" value="သိမ်းရန်" style="width:200px;background: #ebb734;">
                           </td> 
                           <td></td>
                           <td></td>
                      </tr> -->
                      </form>


                      <tr>
                          <td style="text-align: center;">
                            <form action="{{ url('/3dsale/save?bet=padaythar')}}" method="get" enctype="multipart/form-data">

                                {{ csrf_field() }}

                                <input hidden type="text" name="w_id"   id="w_id"  value="{{ $work_file_id }}" > 
                                <input hidden type="text" name="u_id"   id="u_id"  value="{{ $user_id }}" > 
                                <input hidden type="text" name="s_id"   id="s_id"  value="{{ $slip_id }}" > 

                                <input hidden type="text" name="remark"   id="remark"  value="" >                              
                                 
                                <input hidden type="submit" id="saveRemark"  class="btn btn-primary" value="သိမ်းရန်" >
                                 
                                <input hidden type="submit" id="saveOut"  class="btn btn-primary" value="သိမ်းရန်" >

                            </form>
                        </td>
                      </tr>  
                     
                    
                  </tbody>

                </table>                 
               
                
              </div> 

              
               
      </div>


</div> 
</div>  


<div class="container">
<div class="row justify-content-center">
<div class="col-md-6 mx-0 px-1" >

      <div class="d-flex justify-content-between align-items-center">
          
          &nbsp;      
          <span class="text-center"> 
            TOTAL: <input type="text" name="slip_total" id="slip_total" style="text-align: right;font-size: 16px;font-family: bold; width: 80px;" value="{{$slip_total}}">
          </span>

          <span class="text-center"> 
            <input  type="button" id="save" class="btn btn-success btn-sm" value="သိမ်းရန်" style="width:100px;background: #ebb734;">
          </span>
          &nbsp;

    </div>
</div>
</div>
</div>

<br>

<!-- Test -->
<div class="container">
<div class="row justify-content-center no-gutters">

<div class="col-md-6  mx-0 px-1">  
<div class="card">
  
    <form method="post" enctype="multipart/form-data">
      {{ csrf_field() }}

    <table class="table table-sm">        
    <tbody>

        <input type="text" hidden name="work_file_id" id="work_file_id" value="{{ $work_file_id }}">
        <input type="text" hidden name="slip_id" id="slip_id" value="{{ $slip_id }}">

        <tr>

          <td>
            <div >
             
              <input type="text" name="type" class="form-control" id="digit" autofocus autocomplete="off" value="">
            </div>
          </td>

          <td>
            <div >
             
              <input type="number" step="0.01" name="amount" class="form-control" id="amount" value="">
            </div>
          </td>

          <td>
              <div>
              <label name="r_label" id="r_label" hidden >R_Amt</label>
              <input type="number" name="r_amount" class="form-control" id="r_amount" value="0" hidden>
              </div>
          </td>

        </tr>

        <input type="submit" value="Add Digit" class="btn btn-primary btn-sm" id="add_digit" hidden>

    </tbody>
    </table> 
    </form>


  </div> <!-- Card -->  
  </div> <!-- Col -->

</div>
</div>
<!-- End Test -->


<div class="container">
<div class="row justify-content-center">
<div class="col-md-6 col-md-offset-2">

  <div hidden class="card">

          <div class="d-flex justify-content-between align-items-center">

              <span class="card-text">
                Keyboard: 
                <select name="keyboard"  id="keyboard">
                    <option value="On"  @if($keyboard == "On") selected @endif>On</option>
                    <option value="Off" @if($keyboard == "Off") selected @endif>Off</option>
                </select>
              </span>

          

          </div>




      <!-- Start Keypad -->
          <tr>

          <td colspan="3">
          
          <!-- <div class= "formstyle"> -->
           
           <!-- <form name = "form1">
           <input class= "textview" name = "textview">
           </form>
 -->
            <input type="text" name="digit_amount" value="0" id="digit_amount" hidden>

           <table class="table1 table-stripped table-sm" style="font-size: 12px;">

                <tr>                 
                   
                    <td>                                          
                        <input type="button" class="btn btn-info btn-sm"  value="ပဒေသာ"  style="width: 100%; font-size: 20px;" disabled>
                    </td> 

                     <td>
                      <input type="button" class="btn btn-info btn-sm"  value="ထိပ်"  onclick = "insert('T')"style="width: 100%; ">
                    </td>                   
               
                    <td>
                      <input type="button" class="btn btn-info btn-sm"  value="လယ်" onclick = "insert('L')" style="width: 100%;" >
                    </td>

                    <td>
                      <input type="button" class="btn btn-info btn-sm"  value="နောက်ပိတ်" onclick = "insert('N')" style="width: 100%;">
                    </td>
                                  
                </tr>

                <tr>                 
                   
                    <td>                                          
                        <input type="button" class="btn btn-info btn-sm"  value="Del" onclick = "clearall()" style="width: 100%; font-size: 18px;">
                    </td> 

                     <td>
                      <input type="button" class="btn btn-info btn-sm"  value="Back" onclick = "backspace()" style="width: 100%; font-size: 18px;">
                    </td>                   
               
                    <td>
                      <input type="button" class="btn btn-info btn-sm"  value="/(ဘရိတ်)" onclick = "insert('/')" style="width: 100%;" >
                    </td>

                    <td>
                      <input type="button" class="btn btn-info btn-sm"  value="*(အပြီးရှင်း)" onclick = "insert('*')" style="width: 100%;">
                    </td>
                                  
                </tr>

                <tr>                 
                   
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
                      <input type="button" class="btn btn-info btn-sm"  value="- (အပါ)" onclick = "insert('-')" style="width: 100%;">
                    </td>
                                  
                </tr>

                


                <tr>                 
                   
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
                      <input type="button" class="btn btn-info btn-sm"  value="+ (R)" onclick = "insert('+')" style="width: 100%;">
                    </td>
                                  
                </tr>

                <tr>                 
                   
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
                      <input type="button" class="btn btn-info btn-sm"  value="." onclick = "insert('.')" style="width: 100%;font-size: 20px;height:35px; line-height: 35px;">
                    </td>
                                  
                </tr>

                <tr>                 
                   
                    <td>                                          
                        <input type="button" class="btn btn-info btn-sm"  value="0" onclick = "insert(0)" style="width: 100%;font-size: 20px;">
                    </td> 

                     <td>
                      <input type="button" class="btn btn-info btn-sm"  value="00" onclick = "insert('00')" style="width: 100%;font-size: 20px;">
                    </td>  

                    <td colspan="2" >
                      <input type="button" class="btn btn-info btn-sm"  value="OK" onclick = "enter()" style="width: 100%;font-size: 18px;">
                    </td>
                                  
                </tr>

           <!-- </div> -->

          </td>
          </tr>
          <!-- End Keypad -->


              <table class="table1 table-stripped table-sm" id="panel3" style="font-size: 12px;">

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
                      <input type="button" class="btn btn-info btn-sm" id="TK" value="သေးကြီး" style="width: 100%;">
                    </td> 

                     <td>
                      <input type="button" class="btn btn-info btn-sm" id="KT" value="ကြီးသေး" style="width: 100%;">
                    </td>   

                     <td>
                      <input type="button" class="btn btn-info btn-sm" id="DS" value="စုံဆယ်ပြည့်" style="width: 100%;">
                    </td>
                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="DM" value="မဆယ်ပြည့်" style="width: 100%;">
                    </td>
                                      
                </tr>

                <tr>
                  <td>
                      <input type="button" class="btn btn-info btn-sm" id="D" value="ဆယ်ပြည့်" style="width: 100%;">
                    </td>
                   
                </tr>
               
              

              </table>

             
            
        </td>      
       </tr>
        <!-- End Buttons -->      
       
    
     

     <!--  <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr> -->

      </form>
    </tbody>
    </table>


  </div>

</div>
</div>
</div>


<script>
$(document).ready(function()
{

    $("#keyboard").change();
     

    // Save Keep Break Info 
    $("#keep_break").change(function()
    {

      var keep_break    = $('#keep_break').val();
      var work_file_id  = $('#work_file_id').val();     
     //alert(keep_break + " " + work_file_id);
    
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

        //alert('Saved Successfully!!!');
        //location.reload();
    }

     
    });
    // End Save Keep Break Info

    // Save Entry Info 
    $("#entry").change(function()
    {

      
      var user_id  = $('#user_id').val(); 
      var customer_id  = $('#customer_id').val();
      var entry    = $('#entry').val();


      //alert(user_id + " " + entry);
    
      if(entry)
      {
        $.ajax(
            {
                type:   "GET",
                url:  "{{ url('saveEntry') }}?user_id="+user_id
                                              +"&customer_id="+customer_id
                                              +"&entry="+entry,
                dataType: 'json',             
                success:function(res)
                {                                                   

                }
            } 
            );

        //alert('Saved Successfully!!!');
        //location.reload();
    }

     
    });
    // End Save Entry Info

    // Save View Info 
    $("#view").change(function()
    {

      var user_id  = $('#user_id').val(); 
      var customer_id  = $('#customer_id').val();   
      var view    = $('#view').val();

      //alert(user_id + " " + view);
    
      if(view)
      {
        $.ajax(
            {
                type:   "GET",
                url:  "{{ url('saveView') }}?user_id="+user_id
                                              +"&customer_id="+customer_id
                                              +"&view="+view,
                dataType: 'json',             
                success:function(res)
                {                                                   

                }
            } 
            );

        //alert('Saved Successfully!!!');
        //location.reload();
    }

     
    });
    // End Save View Info

    // Save View Info 
    $("#keyboard").change(function()
    {

      var user_id       = $('#user_id').val(); 
      var customer_id   = $('#customer_id').val();   
      var keyboard      = $('#keyboard').val();

      //alert(user_id + " " + view);
    
      if(keyboard)
      {
        $.ajax(
            {
                type:   "GET",
                url:  "{{ url('saveKeyboard') }}?user_id="+user_id
                                              +"&customer_id="+customer_id
                                              +"&keyboard="+keyboard,
                dataType: 'json',             
                success:function(res)
                {                                                   

                }
            } 
            );

        //alert('Saved Successfully!!!');
        //location.reload();
    }

     
    });
    // End Save View Info







});
</script>

<script>
  $(document).ready(function()
{
    var action = $("#action").val();

    if(action == "2D_AM")
    {
      $("#two_am_panel").click();
    }

     if(action == "2D_PM")
    {
      $("#two_pm_panel").click();
    }


    if(action == "3D")
    {
      $("#three_panel").click();
    }



    $("#two_am_panel").click(function()
    {
      $("#action").val("2D_AM");

      $('#two_am_work_file_id').change();
      $('#btnshow').click();
    });


    $("#two_pm_panel").click(function()
    {
      $("#action").val("2D_PM");
      $('#two_pm_work_file_id').change();
      $('#btnshow').click();
    });


    $("#three_panel").click(function()
    {
      $("#action").val("3D");
      $('#three_work_file_id').change();
      $('#btnshow').click();
    });


    $("#two_am_work_file_id").change(function()
    {
      $("#file_id").val($("#two_am_work_file_id").val());
      $('#btnshow').click();
    });


    $("#two_pm_work_file_id").change(function()
    {
      $("#file_id").val($("#two_pm_work_file_id").val());
      $('#btnshow').click();
      
    });

    $("#three_work_file_id").change(function()
    {
      $("#file_id").val($("#three_work_file_id").val());
      $('#btnshow').click();
    });
    

    $('#show_table').scrollTop( $('#show_table')[0].scrollHeight );

});
</script>
@endsection