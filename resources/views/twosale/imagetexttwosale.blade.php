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


@extends('layouts.app')
@section('content')


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
                                    var remark = prompt('Remark ?','Something to remark');

                                    $("#remark").val(remark);
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



<!-- Testing -->


<div class="container_fluid">
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
           
          </ul>
   

      <form method="get" action="{{ url("/2dsale/add") }}" enctype="multipart/form-data">
      {{ csrf_field() }}  


        <input type="text" name="action"          value="{{ $action }}"         id="action"         hidden>
        <input type="text" name="file_id"         value="{{ $work_file_id }}"   id="file_id"        hidden>
        <input type="text" name="in_out_value"    value="{{ $in_out }}"         id="in_out_value"   hidden>
      <!-- Tab panes --> 
      <div class="tab-content">

        <div role="tabpanel" class="tab-pane active"  id="two_am">

                                   
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

        <div role="tabpanel" class="tab-pane"  id="two_pm">

                               
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

        <div role="tabpanel" class="tab-pane"         id="three">

                              
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
                <label hidden >Show</label><br>
                <input hidden type="submit"  value="Show"  id="btnshow"  class="btn btn-info btn-sm">
     </form>

    </div>


</div>
</div>
</div>
</div>


<!-- Testing -->



<div class="container_fluid">
    <div class="row justify-content-center">

        <div class="col-md-6 col-md-offset-2">

            <marquee behavior="scrolling" direction="left" loop="infinite" scrolldelay="250" bgcolor="#0b7026" style="font-family:Book Antiqua; color: #FFFFFF">
                
               Hot: 
               @foreach($hots as $hot)
                {{ $hot->digit }}
               @endforeach
            </marquee>

            <div class="card">
                
                 <!--  <div class="card-header">
                      {{ $workfile_name }} 
                  </div>
 -->
                  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; Slip: {{ $slip_id }}</span>
                      <span class="card-text"> &nbsp; User: {{ $user_name }}</span>
                      <span class="card-text">Customer: {{ $customer_name }} &nbsp;</span>                      
                  </div>


                  <table class="table1 table-sm header-fixed">
                  <thead>
                      <tr>
                        
                        <!-- <th>User</th>

                        @if(auth()->user()->id == 1 || auth()->user()->id ==2)
                        <th>Customer</th>
                        @endif -->

                        <!-- <th>Slip</th> -->

                        <th>Digit</th>  
                        <th>Amt</th> 
                        <th>Type</th>
                        <th>Status</th>     
                      
                        <!-- <th>Update</th> -->
                        <th>TypeDel</th>
                        <th>Del</th>   
               
                      </tr>
                  </thead>
                  <tbody style="font-size: 16px;font-weight: bold;" id="show_table">
                      <?php

                          $col_type     = "";
                          $col_slip_id  = "";
                          $total        = 0;
                       ?>
                      @foreach($two_sales as $twosale)                     
                      
                      <tr>
                          
                          <!-- <td>{{ $twosale->user_id }}</td>

                          @if(auth()->user()->id == 1 || auth()->user()->id ==2)
                          <td>{{ $twosale->customer_id }}</td>
                          @endif -->

                         <!--  @if($twosale->slip_id != $col_slip_id)
                            <td>{{ $twosale->slip_id }}</td>
                          @else
                            <td></td>
                          @endif -->

                         
                          @if($twosale->status == 1)
                            <td>{{ $twosale->digit }}</td>
                          @else
                            <td style="color: red;">{{ $twosale->digit }}</td>
                          @endif

                          @if($twosale->status == 1)
                          
                            @if($view == "Unit")
                              <td style="text-align: right;">{{ $twosale->amount/100 }}</td>
                            @else
                              <td style="text-align: right;">{{ $twosale->amount }}</td>
                            @endif
                          @else
                            @if($view == "Unit")
                              <td style="color: red;">{{ $twosale->amount/100 }}</td>
                            @else
                              <td style="color: red;">{{ $twosale->amount }}</td>
                            @endif
                          @endif

                          @if($twosale->type != $col_type)
                            <td style="text-align: center;">{{ $twosale->type }}</td>
                          @else
                            <td></td>
                          @endif



                          @if($twosale->status == 1)
                            <td> OK </td>
                          @elseif($twosale->status == 0)
                            <td style="color: red;"> မရပါ [Break] </td>
                          @elseif($twosale->status == -1)
                            @if($view =="Unit")
                              <td style="color: red;"> {{ $twosale->amount/100 }} သာရမည် [HotPercent]</td>
                            @else
                              <td style="color: red;"> {{ $twosale->amount }} သာရမည် [HotPercent]</td>
                            @endif
                          @else
                            <td style="color: red;"> မရပါ [DigitPermit]</td>
                          @endif

                         <!--  <td>
                            <a href="{{ url("/2dsale/upd/{$twosale->id}") }}" class="btn btn-info btn-sm">Update</a>
                          </td>  -->
                          @if($twosale->type != $col_type)
                          <td> 
                            <a  href="{{ url("/2dsale/typedel/{$twosale->id}") }}" class="btn btn-danger btn-sm" >TypeDel</a>
                          </td>
                          @else
                          <td></td>
                          @endif

                          <td> 
                            <a  href="{{ url("/2dsale/del/{$twosale->id}?action={$action}") }}" class="btn btn-danger btn-sm" >Del</a>
                          </td>
                        
                      </tr>
                      <?php 
                        $col_slip_id  = $twosale->slip_id;
                        $col_type     = $twosale->type;

                        if($twosale->status == 1)
                        {
                             if($view == "Unit")
                              { $total        += $twosale->amount/100; }
                            else
                              { $total        += $twosale->amount; }
                        }
                       
                        
                      ?>
                      @endforeach


                      <tr style="border: 1px solid black;">  
                          
                         
                          <td >                     

                              TOTAL
                          </td>
                          
                          <td style="text-align: right;">{{ number_format($total) }}</td>
                     
                          
                         
                          <form action="{{ url("/2dsale/save/{$work_file_id}/{$user_id}/{$col_slip_id}") }}" method="GET">

                            {{ csrf_field() }}

                           


                          <td>
                            
                           <!--  <a class="form-control btn btn-primary btn-sm" href="{{ url("/2dsale/save/{$work_file_id}/{$user_id}/{$col_slip_id}") }}" id="save"> Save Digit (ဂဏန်း တင်မည်)</a> -->

                           <!--   <a class="form-control btn btn-primary btn-sm" href="{{ url("/2dsale/save/{$work_file_id}/{$user_id}/{$col_slip_id}") }}"  id="save"> Save (ဂဏန်း တင်မည်)</a>
 -->
                           
                            
                              
                              <input type="submit" id="submit" class="btn btn-primary btn-sm" value="Save">
                           


                                               
                          </td>

                          <td> 
                            <a href="{{ url("/2dsale/alldel/{$work_file_id}/{$user_id}/{$customer_id}/{$slip_id}") }}" class="btn btn-danger btn-sm" >AllDel</a>
                          </td>

                          <td colspan="2">
                            <div >
                            <input type="text" name="remark" id="remark" class="form-control" placeholder="ထိုးသားအမည်" style="width: 100%;">
                            </div>
                          </td>


                         
                           

                           

                      </tr>
                      </form>
                     
                    
                  </tbody>
                </table>
               
              
                  
              
                
               </div> <!-- Card -->

        </div> <!-- Col-md6 -->


    </div> <!-- Row -->
</div>  <!-- Container -->


<!-- Test -->
<div class="container_fluid">
<div class="row justify-content-center no-gutters">

<div class="col-9">  
<div class="card">
  
    <form method="post" enctype="multipart/form-data">

    <table class="table table-sm">        
    <tbody>

      

      {{ csrf_field() }}
        

        <input type="text" hidden name="work_file_id" id="work_file_id" value="{{ $work_file_id }}">
        <input type="text" hidden name="slip_id" id="slip_id" value="{{ $slip_id }}">

        <!-- Admin for User / Customer -->
        
        @if(auth()->user()->id == 1 || auth()->user()->id == 2)
        <tr>
            

            <td>
              <div>
                <label>Keep Break</label> <br>
                <select name="keep_break"  id="keep_break">
                  <option value="0" @if($keep_break == "0") selected @endif >Off</option>
                  <option value="1" @if($keep_break == "1") selected @endif>On</option>
                </select>
               
              </div>
            </td>

            <td>
              <div>
                <label>Entry</label> <br>
                <select name="entry"  id="entry">
                  <option value="Cash" @if($entry == "Cash") selected @endif>Cash</option>
                  <option value="Unit" @if($entry == "Unit") selected @endif>Unit</option>
                </select>
               
              </div>
            </td>

            <td>
              <div>
                <label>View</label> <br>

                <select name="view"  id="view">
                  <option value="Cash" @if($view == "Cash") selected @endif>Cash</option>
                  <option value="Unit" @if($view == "Unit") selected @endif>Unit</option>
                </select>
               
              </div>
            </td>


        </tr>
        
        <tr>

          <td>
            <div >
                <label>User</label> <br>
                <select name="user_id" id="user_id"  >                            
                  <option value="0" @if($user_id =="0") selected @endif> None </option>
                @foreach($users as $user)
                  <option value="{{ $user->id }}" @if($user->id == $user_id) selected @endif>
                    {{ $user->name }}
                  </option>
                @endforeach
              </select>
            </div>
          </td>

          <td>
            <div >
                <label>Customer</label> <br>
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
              <div>
                <label>IN/OUT</label><br>
                <select name="in_out"  id="in_out">
                  <option value="1" @if($in_out == 1) selected @endif>IN</option>
                  <option value="2" @if($in_out == 2) selected @endif>OUT</option>
                </select>
               
              </div>
            </td>

            
        </tr>
       

        @else

          <tr>
              <td>
              <div>
                <label>Entry</label>
                <select name="entry"  id="entry">
                  <option value="Cash" @if($entry == "Cash") selected @endif>Cash</option>
                  <option value="Unit" @if($entry == "Unit") selected @endif>Unit</option>
                </select>
               
              </div>
            </td>

            <td>
              <div>
                <label>View</label>

                <select name="view"  id="view">
                  <option value="Cash" @if($view == "Cash") selected @endif>Cash</option>
                  <option value="Unit" @if($view == "Unit") selected @endif>Unit</option>
                </select>
               
              </div>
            </td>
          </tr>
          
          <input type="text" hidden name="user_id" id="user_id" value="{{ $user_id }}">
          <input type="text" hidden name="customer_id" id="customer_id" value="1">
          <input type="text" hidden name="keep_break" id="keep_break" value="{{ $keep_break }}">

        @endif
        <!-- End Admin for User / Customer -->

               

        <tr>

          <td>
            <div>
              <label>Digit</label>
              <input type="text" name="type" class="form-control" id="digit" autofocus autocomplete="off" value="">
            </div>
          </td>

       

          <td>
            <div >
              <label>Amt</label>
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



<div class="col-3">  
<div class="card">
  
    <table class="table2 table-sm header-fixed" style="font-size: 10px;">
        
    <tbody>

      <form method="post" enctype="multipart/form-data">

      {{ csrf_field() }}
      
      <tr>
         <th>Digit</th>
         <th>Amt</th>
      </tr> 

       <?php 
          $max_total = 0;
          foreach($over_digits as $key => $value)
          {
        ?>
         <tr>
           <td> <b> {{ $key }} </b></td>
           <td> <b> {{ $value }} </b></td>
         </tr>
      <?php 
            $max_total += $value;
        } 
      ?>
       
      </form>

    </tbody>
    </table>

    <div class="text-center" style="font-size: 10px;color: red;">MaxTotal : {{ number_format($max_total) }}</div>

  </div> <!-- Card -->      
</div> <!-- Col -->


</div>
</div>
<!-- End Test -->


<!-- Image-Text -->
<div class="container">
<div class="row justify-content-center">
<div class="col-md-6 col-md-offset-2">

          <div class="card">

                <div class="card-header">                  
                  <div class="float-left">Upload Image</div> 
                  <div class="float-right">
                    <a class="btn btn-primary btn-sm" href="{{ url("2dsale/image/add/{$work_file_id}?action={$action}&in_out={$in_out}") }}">
                        Choose Image (ပုံထည့်ရန်)
                    </a>
                  </div> 
                </div>

                <form method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}

                  <input type="text" hidden name="img_work_file_id" id="img_work_file_id"   value="{{ $work_file_id }}">
                  <input type="text" hidden name="img_user_id"      id="img_user_id"        value="{{ $user_id }}">
                  <input type="text" hidden name="img_customer_id"  id="img_customer_id"    value="{{ $customer_id }}">                  
                  <input type="text" hidden name="img_slip_id"      id="img_slip_id"        value="{{ $slip_id }}">



                  <div class="form-group" class="text-center">
                    <!-- <label class="form-control">Upload Image</label> -->
                    <img src="{{ asset('..//vendor//thiagoalessio//tesseract_ocr//src//type_img.png')}}" alt="Image" class="img-fluid" style="height: 100px;">
                  </div>
          </div>

          <div class="card">

                  <div class="card-header"> 
                    <div class="float-left">Image => Text Result</div> 
                  </div>

                  <div class="form-group" class="text-center">
                    <!-- <label class="form-control">Image => Text (Result)</label> -->
                    <textarea class="form-control" name="text" style="height: 150px;">{{ $text }}</textarea>                  
                  </div>

                  
                  <div class="form-group" class="text-center">
                    <input type="submit" value="Update_Text" name="action" class="btn btn-primary">
                    <input type="submit" value="Insert_Text" name="action" class="btn btn-primary">
                  </div>

                </form>
          </div>
          

</div>
</div>
</div>

<!-- End Image-Text -->


<div class="container">
<div class="row justify-content-center">
<div class="col-md-6 col-md-offset-2">

  <div class="card">

          <div class="d-flex justify-content-between align-items-center">

              <span class="card-text">
                Keyboard: 
                <select name="keyboard"  id="keyboard">
                    <option value="On"  @if($keyboard == "On") selected @endif>On</option>
                    <option value="Off" @if($keyboard == "Off") selected @endif>Off</option>
                </select>
              </span>

              <!-- <span class="card-text">
                    <a  class="btn btn-secondary btn-sm" href="{{ url("/position/bet/{$work_file_id}") }}" id="position_bet">
                      Position Bet
                    </a>
               </span>
 -->
              <span class="card-text">
                    <a  class="btn btn-secondary btn-sm" href="{{ url("/padaythar/bet/{$work_file_id}") }}" id="padaythar_bet">
                      Padaythar Bet
                    </a>
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
                      <input type="button" class="btn btn-info btn-sm" id="PW" value="ပါဝါ" style="width: 100%;" disabled>
                    </td>                
                     <td>
                      <input type="button" class="btn btn-info btn-sm" id="NK" value="နက္ခတ်" style="width: 100%;" disabled>
                    </td>
                   
               
                    <td>
                      <input type="button" class="btn btn-info btn-sm" id="BR" value="ညီနောင်" style="width: 100%;" disabled>
                    </td>

                    <td >
                      <div id="header3" class="text-center">
                        <input type="button" value="More..." class="btn btn-info btn-sm" style="width: 100%;" disabled>
                      </div>
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
                      <input type="button" class="btn btn-info btn-sm"  value="/ (ဘရိတ်)" onclick = "insert('/')" style="width: 100%;" disabled>
                    </td>

                    <td>
                      <input type="button" class="btn btn-info btn-sm"  value="* (T/N/PP)" onclick = "insert('*')" style="width: 100%;">
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

    $("#in_out").change();
     

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