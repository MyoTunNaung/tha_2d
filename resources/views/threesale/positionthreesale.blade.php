<?php 

use App\Commission;

$position_comm = Commission::where('user_id','=',$user_id)->value('position_comm');

$comm_amount   = $slip_total * $position_comm/100;

$net_total     = $slip_total - $comm_amount;

?>

@extends('layouts.app')
@section('content')


<input hidden  type="text" name="comm"        id="comm"       value="{{ $position_comm }}" >
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

  // if(num == '+')
  // {
  //   var amount = $("#amount").val();

  //   if(amount != "")
  //   {

  //     $("#digit_amount").val(2);

  //     $("#r_amount").val("");
  //     $("#r_amount").focus();
  //   }
  //   else
  //   {
  //     digit += num;
  //     $("#digit").val(digit);
  //     $("#digit").change();

  //     $("#digit_amount").val(1);
  //     $("#amount").focus();
  //   }
   
  //   return;
  // }



  if(digit_amount == 0)
  {
   
    $("#d1").val(num);

    $("#digit_amount").val(1);
    $("#d2").focus();

  }

  if(digit_amount == 1)
  {
    $("#d2").val(num);

    $("#digit_amount").val(2);
   
    $("#amount").focus();
  }

   if(digit_amount == 2)
  {
     var amount = $("#amount").val();
      amount += num;

      $("#amount").val(amount);

      $("#digit_amount").val(2);
      $("#amount").focus();
  }


}


function enter()
{
  
  var digit_amount = $("#digit_amount").val();

  var d1 = $("#d1").val();
  var d2 = $("#d2").val();
  var amount = $("#amount").val();

  if(d1.length == 0 || d1 == "" || d2.length == 0 || d2 == "" || amount == "")
  {

    $("#digit_amount").val(0);
    $("#d1").focus();

    return ;
    
  }


 if( d1 != "" && d2 != "" && amount != "")
  {
    $("#add_digit").click();  
  }

  
}

function clearall()
{

  var digit_amount = $("#digit_amount").val();

  
  if( digit_amount == 0)
  {
    $("#d1").val("");
  }

  if( digit_amount == 1)
  {
    $("#d2").val("");
  }

  if( digit_amount == 2)
  {
    $("#amount").val("");
  }
  
}


function backspace()
{

  
  var digit_amount = $("#digit_amount").val();
 
  if(digit_amount == 0)
  {
    var d1 = $("#d1").val();
    d1 = d1.substring(0, d1.length - 1);

    $("#d1").val(d1);

    $("#digit_amount").val(0);
    $("#d1").focus();

  }

  if(digit_amount == 1)
  {
    var d2 = $("#d2").val();
    d2 = d2.substring(0, d2.length - 1);

    $("#d2").val(d2);

    $("#digit_amount").val(1);
    $("#d2").focus();

  }


  if(digit_amount == 2)
  {
     var amount = $("#amount").val();
      amount = amount.substring(0, amount.length - 1);

      $("#amount").val(amount);

    $("#digit_amount").val(2);
    $("#amount").focus();

  }

 
  if(digit_amount == 2 && $("#amount").val() == "")
  {
    $("#digit_amount").val(1);
    $("#d2").focus();
  }

  if(digit_amount == 1 && $("#d2").val() == "")
  {
    $("#digit_amount").val(0);
    $("#d1").focus();
  }

   if(digit_amount == 0 && $("#d1").val() == "")
  {
    $("#digit_amount").val(0);
    $("#d1").focus();
  }


}


</script>


<style type="text/css">
  .table1 
  {
    font-size: 10px;
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
   
    height: 270px;
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
   /* width: 50px;
    height: 30px;*/
    padding: 3px;
  }
  .table1 td
  {
    border: 1px solid black;
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
   
    height: 250px;
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
                                          $('#d1').prop('readonly',true);
                                          $('#d2').prop('readonly',true);
                                          $('#amount').prop('readonly',true);
                                          
                                      }
                                      if(keyboard == "On")
                                      {
                                          $('#d1').prop('readonly',false);
                                          $('#d2').prop('readonly',false);
                                          $('#amount').prop('readonly',false);
                                          
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

              $("#d1").keypress(function( event ) 
                            {
                              if ( event.which == 13 ) 
                              {
                                 event.preventDefault(); 

                                 if($("#d1").val() == "")
                                 {
                                    $("#d1").focus();   
                                 }
                                 else
                                 {
                                    $("#d2").focus();
                                 }                                                               
                                 
                              }
                             
                            });

              $("#d2").keypress(function( event ) 
                            {
                              if ( event.which == 13 ) 
                              {
                                 event.preventDefault();                                                                
                                 if($("#d2").val() == "")
                                 {
                                    $("#d2").focus();   
                                 }
                                 else
                                 {
                                    $("#amount").focus();
                                 }    
                              }
                             
                            });

              $("#amount").keypress(function( event ) 
                            {
                              if ( event.which == 13 ) 
                              {
                                                                                                
                                 if($("#amount").val() == "")
                                 {
                                    event.preventDefault(); 
                                    $("#amount").focus();   
                                 }
                                 else
                                 {
                                    $("#d1").focus();
                                 }    
                              }
                             
                            });

              $("#d1").click( function()
                                  {
                                    $("#digit_amount").val(0);
                                    $("#d1").focus();                                   
                                  }
                                );

               $("#d2").click( function()
                                  {
                                    $("#digit_amount").val(1);
                                    $("#d2").focus();                                   
                                  }
                                );


              $("#amount").click( function()
                                  {
                                    $("#digit_amount").val(2);                                   
                                    $("#amount").focus();                                   
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

   <div class="d-flex justify-content-between align-items-center" style="background-color: lightgray;">
            <span class="card-text"> &nbsp; Slip: {{ $slip_id }}</span>
            <span class="card-text"> &nbsp; {{ $work_file->name." [ ".$work_file_date." ] " }}</span>
            <span class="card-text"> &nbsp; User: {{ $user_name }} &nbsp;</span>                                     
        </div>

<div class="row justify-content-center">

       

        <div class="col-9 mx-0 px-1">
        <div class="card" id="table_box">

                   

               
                  <table class="table1" id="upper_table">
                  <thead>
                      <tr>                        
                        <th  hidden >ID</th>
                        <th style="width: 20px;">No</th>
                        <th style="width: 58px; text-align: center;">ထိပ်</th>  
                        <th style="width: 58px; text-align: center;">လည်</th> 
                        <th style="width: 58px; text-align: center;">ပိတ်</th>
                        <th style="width: 58px; text-align: center;">အပါ</th>

                      </tr>
                  </thead>

                  <tbody style="font-size: 14px;font-weight: bold;" id="show_table">
                     
                    

                    @for($count = 0;$count<=9;$count++)
                      <?php 
                          $t_amount   = 0;
                          $l_amount   = 0;
                          $n_amount   = 0;
                          $apa_amount = 0;
                     ?>
                     
                      @foreach($three_positions as $three_position)
                       
                          @if(($three_position->d2 == "T" || $three_position->d2 == "t") && $three_position->d1 == $count)
                            <?php $t_amount += $three_position->amount; ?>

                          @elseif(($three_position->d2 == "L" || $three_position->d2 == "l" ) && $three_position->d1 == $count) 
                            <?php $l_amount += $three_position->amount; ?>

                          @elseif(($three_position->d2 == "N" || $three_position->d2 == "n") && $three_position->d1 == $count)
                            <?php $n_amount += $three_position->amount ?>

                          @elseif($three_position->d2 == "-" && $three_position->d1 == $count)
                            <?php $apa_amount += $three_position->amount; ?>

                          @else
                        
                          @endif

                      @endforeach

                       <tr>

                          <td style="width: 20px; text-align: right;">{{ $count }}</td>
                          <td style="width: 58px; text-align: right;">{{ $t_amount }}</td>
                          <td style="width: 58px; text-align: right;">{{ $l_amount }}</td>
                          <td style="width: 58px; text-align: right;">{{ $n_amount }}</td>
                          <td style="width: 58px; text-align: right;">{{ $apa_amount }}</td>

                        </tr> 


                    @endfor
                  </tbody>
                </table>
                
      </div> 
      </div>

      <div class="col-3 mx-0 px-1">
        <div class="card" id="table_box">

                                
                  <table class="table1" id="upper_table" >
                  <thead>
                      <tr>
                        
                        <th  hidden >ID</th>
                        <th style="width: 30px; text-align: center;">အတွဲ</th>
                        <th style="width: 60px; text-align: center;">ယူနစ်</th>  
                   
                                           
                      </tr>
                  </thead>

                  <tbody style="font-size: 16px;font-weight: bold;" id="show_table">
                      
                       @foreach($three_positions as $three_position)
                       
                          @if(is_numeric($three_position->d1) && is_numeric($three_position->d2))
                            <tr>
                              <td style="width: 30px; text-align: center;">{{ $three_position->d1.$three_position->d2 }}</td>
                              <td style="width: 40px; text-align: right;">{{ $three_position->amount }}</td>
                            </tr>
                        
                          @endif

                      @endforeach


                      <tr>
                          <td style="text-align: center;">
                            <form action="{{ url('/3dsale/save?bet=position')}}" method="post" enctype="multipart/form-data">

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
            <input type="text" name="slip_total" id="slip_total" style="text-align: right;font-style: bold; width: 80px;height: 25px;" value="{{$slip_total}}">
          </span>

          <span class="text-center"> 
            <input  type="button" id="save" class="btn btn-success btn-sm" value="သိမ်းရန်" style="width:100px;background: #ebb734;height: 25px;">
          </span>
          &nbsp;


    </div>
</div>
</div>
</div>


<div class="container">
<div class="row justify-content-center">
<div class="col-md-6 mx-0 px-1" >

  <div class="card mx-0 px-1">

          <form method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <input hidden type="text"  name="work_file_id" id="work_file_id" value="{{ $work_file_id }}">
        <input hidden type="text"  name="slip_id" id="slip_id" value="{{ $slip_id }}">
        <input hidden type="text"  name="digit_amount" id="digit_amount" value="0">


      <div class="d-flex justify-content-between align-items-center">        
          &nbsp;      
          <span class="text-center"> 
            <input type="text" name="d1"  id="d1" autofocus autocomplete="off" value="" style="text-align: center;font-size: 16px;font-family: Impact; width: 100%;height: 30px;" class="form-control">
          </span>
          &nbsp;
          <span class="text-center"> 
            <input type="text" name="d2"  id="d2" autofocus autocomplete="off" value="" style="text-align: center;font-size: 16px;font-family: Impact; width: 100%;height: 30px;" class="form-control">
          </span>
          &nbsp;
          <span class="text-center"> 
            <input type="number" step="0.01" name="amount" id="amount" value="" style="text-align: right;font-size: 16px;font-family: bold; width: 100%;height: 30px;" class="form-control">
          </span>
          &nbsp;
      </div>
      <input type="submit" value="Add Digit" class="btn btn-primary btn-sm" id="add_digit" hidden>
      </form>


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

           <table class="table1 table-stripped table-sm" style="font-size: 10px;">

                <tr>                 
                   
                    <td>                                          
                        <input type="button" class="btn btn-info btn-sm"  value="လုံးပိုင်/အပါ"  style="width: 100%; font-size: 15px;" disabled>
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
                        <input type="button" class="btn btn-info btn-sm"  value="7" onclick = "insert(7)" style="width: 100%;font-size: 18px; height: 30px;">
                    </td> 

                     <td>
                      <input type="button" class="btn btn-info btn-sm"  value="8" onclick = "insert(8)" style="width: 100%;font-size: 18px; height: 30px;" >
                    </td>                   
               
                    <td>
                      <input type="button" class="btn btn-info btn-sm"  value="9" onclick = "insert(9)" style="width: 100%;font-size: 18px; height: 30px;">
                    </td>

                    <td>
                      <input type="button" class="btn btn-info btn-sm"  value="- (အပါ)" onclick = "insert('-')" style="width: 100%; height: 30px;">
                    </td>
                                  
                </tr>

                


                <tr>                 
                   
                    <td>                                          
                        <input type="button" class="btn btn-info btn-sm"  value="4" onclick = "insert(4)" style="width: 100%;font-size: 18px;height: 30px;">
                    </td> 

                     <td>
                      <input type="button" class="btn btn-info btn-sm"  value="5" onclick = "insert(5)" style="width: 100%;font-size: 18px;height: 30px;">
                    </td>                   
               
                    <td>
                      <input type="button" class="btn btn-info btn-sm"  value="6" onclick = "insert(6)" style="width: 100%;font-size: 18px;height: 30px;">
                    </td>

                    <td>
                      <input type="button" class="btn btn-info btn-sm"  value="Back" onclick = "backspace()" style="width: 100%; font-size: 17px;height: 30px;">
                    </td> 
                                  
                </tr>

                <tr>                 
                   
                    <td>                                          
                        <input type="button" class="btn btn-info btn-sm"  value="1" onclick = "insert(1)" style="width: 100%;font-size: 18px;height: 30px;">
                    </td> 

                     <td>
                      <input type="button" class="btn btn-info btn-sm"  value="2" onclick = "insert(2)" style="width: 100%;font-size: 18px;height: 30px;">
                    </td>                   
               
                    <td>
                      <input type="button" class="btn btn-info btn-sm"  value="3" onclick = "insert(3)" style="width: 100%;font-size: 18px;height: 30px;">
                    </td>

                    <td>                                          
                        <input type="button" class="btn btn-info btn-sm"  value="Del" onclick = "clearall()" style="width: 100%; font-size: 17px;height: 30px;">
                    </td> 
                                  
                </tr>

                <tr>                 
                   
                    <td>                                          
                        <input type="button" class="btn btn-info btn-sm"  value="0" onclick = "insert(0)" style="width: 100%;font-size: 18px;height: 30px;">
                    </td> 

                     <td>
                      <input type="button" class="btn btn-info btn-sm"  value="00" onclick = "insert('00')" style="width: 100%;font-size: 18px;height: 30px;">
                    </td> 

                    <td>
                      <input type="button" class="btn btn-info btn-sm"  value="." onclick = "insert('.')" style="width: 100%;font-size: 18px;height: 30px;">
                    </td> 

                    <td >
                      <input type="button" class="btn btn-info btn-sm"  value="OK" onclick = "enter()" style="width: 100%;font-size: 18px;height: 30px;">
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