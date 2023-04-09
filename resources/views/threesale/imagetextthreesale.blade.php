<?php 

  $text = "";

  $handle = fopen("..//storage/app//type_img.txt", "r");

  if ($handle) 
  {
      while (($line = fgets($handle)) !== false) 
      {
        
        $text = $text . $line;                    

      }

      fclose($handle);
  } 
  else 
  {
      // error opening the file.
  } 

 ?>


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
   
    height: 400px;
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
                                    digit += "N";

                                    $("#digit").val(digit);
                                    $("#amount").focus();
                                    $("#digit_amount").val(1);
                                  }
                                );
                  $("#LSE").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "L";

                                    $("#digit").val(digit);
                                    $("#amount").focus();
                                    $("#digit_amount").val(1);
                                  }
                                );
                  $("#SSE").click( function()
                                  {
                                    var digit = $("#digit").val();
                                    digit += "S";

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



<!-- Testing -->
<?php 
                          $date           = date_create("$work_file->date");
                          $work_file_date = date_format($date,"d-m-Y");
                   ?>

<div class="container">
    <div class="row justify-content-center">


          <div class="col-md-6 mx-0 px-1">

             <form method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}

            <div class="card" style="height: 450px;">                        
              <textarea class="form-group" name="text" style="height: 450px;"></textarea>   <!-- {{ $text }} -->
            </div>

            <input type="submit" value="စာရင်းသွင်းရန်" name="action" class="btn btn-primary btn-sm"> 

            <input type="text" name="slip_id" value="{{$slip_id}}" hidden>
  
        </form>

         
        </div>



        <div class="col-md-6 col-md-offset-2">

       
            <div class="card">
          
                  <div class="d-flex justify-content-between align-items-center" style="background-color: lightgray;">
                      <span class="card-text"> &nbsp; Slip: {{ $slip_id }}</span>
                      <span class="card-text"> &nbsp; {{ $work_file->name." [ ".$work_file_date." ] " }}</span>
                      <span class="card-text"> &nbsp; User: {{ $user_name }} &nbsp;</span>                                     
                  </div>
                 
                  <table class="table1 table-sm header-fixed">
                  <thead>

                      <tr>
                        
                        <th style="width: 30px;" hidden >ID</th>
                        <th style="width: 30px; text-align: center;">စဉ်</th>

                        <th style="width: 50px; text-align: center;">ဂဏန်း</th>  
                        <th style="width: 70px; text-align: right;">ယူနစ်</th> 
                        <th style="width: 70px; text-align: center;">မှတ်ချက်</th>
                                    
                        <th style="width: 30px;"> </th>
                        <th style="width: 30px;"> </th>
                        
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
                            <a  href="{{ url("/3dsale/typedel/{$three_sale->id}?action=image") }}" class="btn btn-outline-danger btn-sm" >
                              <i class='fa fa-trash' aria-hidden='true' style='color: red; cursor:pointer;'></i>
                            </a>
                          </td>
                          @else
                          <td></td>
                          @endif

                          <td> 
                            <a  href="{{ url("/3dsale/del/{$three_sale->id}?action=image") }}" class="btn btn-outline-danger btn-sm" >
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
                      </tr>
                      </form>
 -->

                      <tr>
                          <td style="text-align: center;">
                            <form action="{{ url('/3dsale/save')}}" method="get" enctype="multipart/form-data">

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
               
              
                  
              
                
               </div> <!-- Card -->

                <div class="d-flex justify-content-center align-items-right">
                   
         <!--  <span class="text-center"> 
            TOTAL: <input type="text" name="slip_total" id="slip_total" style="text-align: right;font-size: 16px;font-family: bold; width: 80px;" value="{{$slip_total}}">
          </span> -->

          <span class="text-center"> 
            <input  type="button" id="save" class="btn btn-success btn-sm" value="သိမ်းရန်" style="width:100px;background: #ebb734;">
            
          </span>

    </div>

        </div> <!-- Col-md6 -->


    </div> <!-- Row -->
</div>  <!-- Container -->




<script>
$(document).ready(function()
{

    $("#keyboard").change();
     
    $("#in_out").change();

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
      var customer_id  = $('#customer_id').val();
      var entry    = $('#entry').val();

         
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

    }

     
    });
    // End Save Entry Info

    // Save View Info 
    $("#view").change(function()
    {

      var user_id  = $('#user_id').val(); 
      var customer_id  = $('#customer_id').val();   
      var view    = $('#view').val();

         
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

    }

     
    });
    // End Save View Info

    // Save View Info 
    $("#keyboard").change(function()
    {

      var user_id       = $('#user_id').val(); 
      var customer_id   = $('#customer_id').val();   
      var keyboard      = $('#keyboard').val();

        
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

    }

     
    });
    // End Save View Info


    // In_Out
    $("#in_out").change(function()
    {
     

      var user_id       = $('#user_id').val(); 
      var customer_id   = $('#customer_id').val();   
      var in_out        = $('#in_out').val();

         
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
                    }
                }
            } 
           );       
      }
     
    });
    // End In_Out




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