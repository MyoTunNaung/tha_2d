<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use thiagoalessio\TesseractOCR\TesseractOCR;

use DB;

use App\Admin;
use App\WorkFile;
use App\User;
use App\Customer;

use App\BreakAmount;
use App\Commission;
use App\Hot;
use App\DigitPermission;

use App\TwoSale;
use App\Two;

use App\Choice;


class TwoSaleController extends Controller
{
    private $r_digit;
    private $r_amount;

    public function Type_to_Padaythar_Digits($type)
    {
        $type_array     = str_split($type);
        $digit_array    = array();

        $last = $type_array[count($type_array)-1];
       
        if($last == '*')
        {
            $length = count($type_array)-1;

            for($i=0; $i<$length;$i++)
            {
                for($j=$i; $j<$length;$j++)
                {
                    $digit = $type_array[$i].$type_array[$j];
                    array_push($digit_array, $digit);
                }
            }
        }

        if($last == '+')
        {
            $length = count($type_array)-1;

            for($i=0; $i<$length;$i++)
            {
                for($j=$i+1; $j<$length;$j++)
                {
                    $digit = $type_array[$i].$type_array[$j];
                    array_push($digit_array, $digit);
                }
            }
        }

        if(is_numeric($last))
        {
            $length = count($type_array);

            for($i=0; $i<$length;$i++)
            {
                for($j=$i; $j<$length;$j++)
                {
                    $first      = $type_array[$i];
                    $second     = $type_array[$j];
                      
                        
                        $d2_types = DB::table("d2_types")
                                                ->where([                                           
                                                            ["id",">=",1],
                                                            ["id","<=",2],
                                                        ])
                                                ->get();
                          
                        foreach ($d2_types as $d2_type) 
                        {
                            $d1 = $d2 = "";

                            if( $d2_type->d1 == "first")        { $d1 = $first; }
                            else if( $d2_type->d1 == "second")  { $d1 = $second; }                           
                            else                                { $d1 = $d2_type->d1; }

                            if( $d2_type->d2 == "first")        { $d2 = $first; }
                            else if( $d2_type->d2 == "second")  { $d2 = $second; }                           
                            else                                { $d2 = $d2_type->d2; }

                           
                            if($d1 != $d2 )
                            {
                                $digit = $d1.$d2;
                                array_push($digit_array, $digit);   
                            }
                            

                            
                        }
                    

                    }
                    
                }
            }
       
        
        sort($digit_array);
        $result_digits = array_unique($digit_array);

        // print_r($result_digits);
        return $result_digits;
    }


    

    public function Type_to_Digits($type)
    {
        $type_array = str_split($type);

        $amount1 = "";

        $table_name = "";
        $range1 = "";
        $range2 = "";

        $digit_array = array();


        if(strlen($type) == 1)
        {
            $first      = $type_array[0];

             if( $first == "+" )
            {
                $last_twosale = TwoSale::orderBy('id','desc')->first();

                //dd($last_twosale->digit);

                $type_array = str_split($last_twosale->digit);

                $first      = $type_array[0];
                $second     = $type_array[1];

                $table_name = "d2_types";
                $range1     = 2;
                $range2     = 2;                
            }

            if( $first == "*" )
            {
                $table_name = "p_w_types";
                $range1     = 1;
                $range2     = 10;                
            }
            if( $first == "-" )
            {
                $table_name = "n_k_types";
                $range1     = 1;
                $range2     = 10;                
            }
            if( $first == "D" || $first == "d" || $first == "/" )
            {
                $table_name = "d_types";
                $range1     = 1;
                $range2     = 10;                
            }

        }

        else if(strlen($type) == 2)
        {
            $first      = $type_array[0];
            $second     = $type_array[1];

            if( is_numeric($first) && is_numeric($second) )
            {
                $table_name = "d2_types";
                $range1     = 1;
                $range2     = 1;   

                if(request()->r_amount != 0)
                {
                    $this->r_digit    = "$second"."$first";
                    $this->r_amount   = request()->r_amount;
                }

            }
            if( is_numeric($first) && ($second == "T" || $second == "t" || $second == "*") )
            {
                $table_name = "t_types";
                $range1     = 1;
                $range2     = 10;

                if(request()->r_amount != 0)
                {
                    $this->r_digit    = "$first"."N";
                    $this->r_amount   = request()->r_amount;
                }
            }
            if( is_numeric($first) && ($second == "N" || $second == "n") )
            {
                $table_name = "n_types";
                $range1     = 1;
                $range2     = 10;

                if(request()->r_amount != 0)
                {
                    $this->r_digit    = "$first"."T";
                    $this->r_amount   = request()->r_amount;
                }

            }
            if( ($first == "*") && is_numeric($second) )
            {
                $table_name = "n_types";
                $range1     = 11;
                $range2     = 20;                
            }
            if( is_numeric($first) && ($second == "R" || $second == "r" || $second == "-") )
            {
                $table_name = "r_types";
                $range1     = 1;
                $range2     = 20;                
            }
            if( is_numeric($first) && ($second == "S" || $second == "s") )
            {
                $table_name = "n_s_types";
                $range1     = 1;
                $range2     = 5;

                if(request()->r_amount != 0)
                {
                    $this->r_digit    = "$first"."M";
                    $this->r_amount   = request()->r_amount;
                }                   
            }
            if( ($first == "S" || $first == "s") && is_numeric($second) )
            {
                $table_name = "s_n_types";
                $range1     = 1;
                $range2     = 5;

                if(request()->r_amount != 0)
                {
                    $this->r_digit    = "M"."$second";
                    $this->r_amount   = request()->r_amount;
                }   

                             
            }
            if( is_numeric($first) && ($second == "M" || $second == "m") )
            {
                $table_name = "n_m_types";
                $range1     = 1;
                $range2     = 5;  

                if(request()->r_amount != 0)
                {
                    $this->r_digit    = "$first"."S";
                    $this->r_amount   = request()->r_amount;
                }                 
            }
            if( ($first == "M" || $first == "m") && is_numeric($second) )
            {
                $table_name = "m_n_types";
                $range1     = 1;
                $range2     = 5;  

                if(request()->r_amount != 0)
                {
                    $this->r_digit    = "S"."$second";
                    $this->r_amount   = request()->r_amount;
                }                 
            }
            if( ($first  == "S" || $first  == "s" || $first  == "+") && 
                ($second == "S" || $second =="s"  || $second == "+") 
            )
            {
                $table_name = "s_s_types";
                $range1     = 1;
                $range2     = 25;                
            }
            if( ($first  == "M" || $first  == "m" || $first  == "-") && 
                ($second == "M" || $second =="m"  || $second == "-") 
            )
            {
                $table_name = "m_m_types";
                $range1     = 1;
                $range2     = 25;                
            }
            if( ($first  == "S" || $first  == "s" || $first  == "+") && 
                ($second == "M" || $second =="m"  || $second == "-") 
            )
            {
                $table_name = "s_m_types";
                $range1     = 1;
                $range2     = 25;                
            }
            if( ($first  == "M" || $first  == "m" || $first  == "-") && 
                ($second == "S" || $second =="s"  || $second == "+") 
            )
            {
                $table_name = "m_s_types";
                $range1     = 1;
                $range2     = 25;                
            }
            if( ($first  == "S" || $first  == "s" || $first  == "+") && 
                ($second == "P" || $second =="p"  || $second == "*") 
            )
            {
                $table_name = "s_p_types";
                $range1     = 1;
                $range2     = 5;

                if(request()->r_amount != 0)
                {
                    $this->r_digit    = "MP";
                    $this->r_amount   = request()->r_amount;
                }                   
            }
            if( ($first  == "M" || $first  == "m" || $first  == "-") && 
                ($second == "P" || $second =="p"  || $second == "*") 
            )
            {
                $table_name = "m_p_types";
                $range1     = 1;
                $range2     = 5; 

                if(request()->r_amount != 0)
                {
                    $this->r_digit    = "SP";
                    $this->r_amount   = request()->r_amount;
                }                   
            }
            if( ($first  == "P" || $first  == "p" || $first  == "*") && 
                ($second == "P" || $second =="p"  || $second == "*") 
            )
            {
                $table_name = "p_p_types";
                $range1     = 1;
                $range2     = 10;                
            }
            if( ($first  == "P" || $first  == "p" ) && ($second == "W" || $second == "w" ) )
            {
                $table_name = "p_w_types";
                $range1     = 1;
                $range2     = 10;                
            }
            if( ($first  == "N" || $first  == "n" ) && ($second == "K" || $second == "k" ) )
            {
                $table_name = "n_k_types";
                $range1     = 1;
                $range2     = 10;                
            }
            if( ($first  == "D" || $first  == "d" || $first  == "/") && 
                ($second == "S" || $second =="s"  || $second == "+") 
            )
            {
                $table_name = "d_s_types";
                $range1     = 1;
                $range2     = 5;  

                if(request()->r_amount != 0)
                {
                    $this->r_digit    = "DM";
                    $this->r_amount   = request()->r_amount;
                }                  
            }
            if( ($first  == "D" || $first  == "d" || $first  == "/") && 
                ($second == "M" || $second =="m"  || $second == "-") 
            )
            {
                $table_name = "d_m_types";
                $range1     = 1;
                $range2     = 5;   

                if(request()->r_amount != 0)
                {
                    $this->r_digit    = "DS";
                    $this->r_amount   = request()->r_amount;
                }                 
            }
            if( ($first  == "T" || $first  == "t" || $first  == "+") && 
                ($second == "K" || $second =="k"  || $second == "/") 
            )
            {
                $table_name = "t_k_types";
                $range1     = 1;
                $range2     = 10;  

                if(request()->r_amount != 0)
                {
                    $this->r_digit    = "KT";
                    $this->r_amount   = request()->r_amount;
                }                  
            }
            if( ($first  == "K" || $first  == "k" || $first  == "-") && 
                ($second == "T" || $second =="t"  || $second == "/") 
            )
            {
                $table_name = "k_t_types";
                $range1     = 1;
                $range2     = 10;  

                if(request()->r_amount != 0)
                {
                    $this->r_digit    = "TK";
                    $this->r_amount   = request()->r_amount;
                }                  
            }
            if( ($first  == "B" || $first  == "b" || $first  == "/") && 
                ($second == "R" || $second =="r"  || $second == "/") 
            )
            {
                $table_name = "b_r_types";
                $range1     = 1;
                $range2     = 20;                
            }
            if( is_numeric($first) && ($second == "B" || $second == "b" || $second == "/") )
            {
                //dd('ဘရိတ်');

                 for($d1=0;$d1<10;$d1++)
                    {
                        for($d2=0;$d2<10;$d2++)
                        {
                            if( ((int)$first == (int)$d1 + (int)$d2) || ((int)$first+10 == (int)$d1 + (int)$d2) )
                                {
                                    $digit ="$d1$d2";
                                    array_push($digit_array, $digit); 
                                }
                        }
                    }                 
            }


        }

        else if(strlen($type) == 3)
        {
            $first      = $type_array[0];
            $second     = $type_array[1];
            $third      = $type_array[2];

            if( is_numeric($first) && is_numeric($second) && ($third == "R" || $third == "r" || $third == "+") )
            {
                $table_name = "d2_types";
                $range1     = 1;
                $range2     = 2;                
            }
            if( is_numeric($first) && ($second == "*") && ($third == "+") )
            {
                $table_name = "n_s_types";
                $range1     = 1;
                $range2     = 5;                
            }
            if( ($first == "*") && is_numeric($second) && ($third == "+") )
            {
                $table_name = "s_n_types";
                $range1     = 1;
                $range2     = 5;                
            }
            if( is_numeric($first) && 
                ($second == "S" || $second == "s" || $second == "+") && 
                ($third  == "R" || $third  == "r" || $third  == "+") 
              )
            {
                $table_name = "n_s_r_types";
                $range1     = 1;
                $range2     = 10; 

                if(request()->r_amount != 0)
                {
                    $this->r_digit    = "$first"."MR";
                    $this->r_amount   = request()->r_amount;
                }   

            }
            if( is_numeric($first) && ($second == "*") && ($third == "-") )
            {
                $table_name = "n_m_types";
                $range1     = 1;
                $range2     = 5;                
            }
            if( ($first == "*") && is_numeric($second) && ($third == "-") )
            {
                $table_name = "m_n_types";
                $range1     = 1;
                $range2     = 5;                
            }
            if( is_numeric($first) && 
                ($second == "M" || $second == "m" || $second == "-") && 
                ($third  == "R" || $third  == "r" || $third  == "-") 
              )
            {
                $table_name = "n_m_r_types";
                $range1     = 1;
                $range2     = 10; 

                if(request()->r_amount != 0)
                {
                    $this->r_digit    = "$first"."SR";
                    $this->r_amount   = request()->r_amount;
                }   

            }
            if( is_numeric($first) && is_numeric($second) && ($third == "B" || $third == "b" || $third == "/") )
            {
                for($d1=0;$d1<10;$d1++)
                {
                    for($d2=0;$d2<10;$d2++)
                    {
                        if((int)"$first$second" == (int)$d1 + (int)$d2)
                            {
                                $digit = "$d1$d2";
                                array_push($digit_array, $digit); 
                            }
                    }
                }               
            }



        }

       

        if($table_name != "")
        { $d2_types = DB::table("$table_name")
                            ->where([                                           
                                    ["id",">=",$range1],
                                    ["id","<=",$range2],
                                ])
                            ->get();
        }
        else
        {
          $d2_types = DB::table("d2_types")
                            ->where([                                           
                                    ["id",">=",10],                                    
                                ])
                            ->get();  
        }


        
        if($table_name == "s_s_types")
        {
            foreach ($d2_types as $d2_type) 
            {
                              
                $digit = $d2_type->d1.$d2_type->d2;

                array_push($digit_array, $digit); 
            }
        }
        else
        {
            foreach ($d2_types as $d2_type) 
            {
                $d1 = $d2 = $d3 = "";

                if( $d2_type->d1 == "first")        { $d1 = $first; }
                else if( $d2_type->d1 == "second")  { $d1 = $second; }                
                else                                { $d1 = $d2_type->d1; }

                if( $d2_type->d2 == "first")        { $d2 = $first; }
                else if( $d2_type->d2 == "second")  { $d2 = $second; }                
                else                                { $d2 = $d2_type->d2; }

                $digit = $d1.$d2.$d3;

                array_push($digit_array, $digit); 
            }
        }



        $result_digits = array_unique($digit_array);

        return $result_digits;

    }


    public function addTwoSale()
    {

        //Main Process
        $work_file_id       = request()->id;
        
        if(request()->s_id == null)
            {  $slip_id = 0; }
        else
            {  $slip_id = request()->s_id; }

     
        $over_digits    = $this->overBreakDigits($work_file_id);        
        //End Main Process


        //Get Auth User Info
        if(Choice::where('auth_id','=',auth()->user()->id)->exists())
        { 
            
             //Save Current Work File
            $choice = Choice::where('auth_id','=',auth()->user()->id)->orderBy('id','desc')->first();        
                $choice->work_file_id = $work_file_id;

            $choice->save();
            //End Save Current Work File


            //Get Info
            $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');
            $slip           = Choice::where('auth_id','=',auth()->user()->id)->value('slip');

            $user_id        = Choice::where('auth_id','=',auth()->user()->id)->value('user_id');
            $choice         = Choice::where('auth_id','=',$user_id)->first();
          
            $user_id        = $choice->user_id;
            $customer_id    = $choice->customer_id;
            $in_out         = $choice->in_out;
            $entry          = $choice->entry;
            $view           = $choice->view;
            $keyboard       = $choice->keyboard;
            $max_minus      = $choice->max_minus;           
            //End Get Info
        }   
        else
        {
            $choice = new Choice();

                $choice->work_file_id   = $work_file_id;
                $choice->auth_id        = auth()->user()->id;
                $choice->user_id        = auth()->user()->id;
                $choice->customer_id    = 1;
               
                $choice->in_out         = 1;
                $choice->entry          = "Cash";
                $choice->view           = "Cash";
                $choice->keyboard       = "Off";
                $choice->max_minus      = "Max";                
                $choice->slip           = "Last_Call";

            $choice->save();

            $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');
            $slip           = Choice::where('auth_id','=',auth()->user()->id)->value('slip');

            $choice         = Choice::find($choice->id);
                      
            $user_id        = $choice->user_id;
            $customer_id    = $choice->customer_id;
            $in_out         = $choice->in_out;
            $entry          = $choice->entry;
            $view           = $choice->view;
            $keyboard       = $choice->keyboard;
            $max_minus      = $choice->max_minus;
            $slip           = $choice->slip;
        }

            //Action => 2D_AM, 2D_PM, 3D_PM
            $temp   = WorkFile::find($work_file_id);
            $action                 = $temp->name."_".$temp->duration; 
            $name                   = $temp->name;
            $duration               = $temp->duration;
            $current_work_file_id   = $work_file_id;

            // dd($name." ".$duration);


            //Keep Break
            $keep_break     = BreakAmount::where('work_file_id','=',$work_file_id)
                                        ->orderBy('id','desc')
                                        ->take(1)
                                        ->value('status');


            // dd($user_id."/".$customer_id."/".$work_file_id."/".$in_out."/".$entry."/".$view."/".$keyboard."/".$max_minus."/".$slip);

        //End Get Auth User Info

        

       
       
        // Last Slip (or) All Slip (or) Current Slip
        if($slip_id == 0 && $slip == "Last_Call")
        {
            $last_slip_id = TwoSale::where([                                           
                                        
                                        ["work_file_id","=",$work_file_id],
                                        ["user_id","=",$user_id],
                                        ["customer_id","=",$customer_id],

                                    ])
                                ->orderBy('id','desc')
                                ->take(1)
                                ->value('slip_id');

           $two_sales = TwoSale::where([  

                                    ["work_file_id","=",$work_file_id],
                                    ["user_id","=",$user_id],
                                    ["customer_id","=",$customer_id],
                                    ["slip_id","=",$last_slip_id],
                                ])                            
                            ->get();

            //Call Total
            $slips            = TwoSale::leftJoin('customers', 'two_sales.customer_id', '=', 'customers.id')
                                        ->where([                                           
                                                  
                                                  ["two_sales.work_file_id","=",$work_file_id],
                                                  ["two_sales.user_id","=",$user_id],
                                                  ["two_sales.customer_id","=",$customer_id],
                                                  ["two_sales.slip_id","=",$last_slip_id],

                                                  ["two_sales.status","=",1],
                                                  ["two_sales.confirm","=",1],

                                                  ['customers.in_out', '=', $in_out],
                                              ])
                                          
                                          ->distinct()
                                          ->groupBy("two_sales.slip_id")
                                          ->select(['two_sales.slip_id',\DB::raw("SUM(two_sales.amount) as call_total")])
                                          ->get();
            //End Call Total

        }
        if($slip_id == 0 && $slip == "All_Call")
        {
            $two_sales = TwoSale::where([  

                                    ["work_file_id","=",$work_file_id],
                                    ["user_id","=",$user_id],
                                    ["customer_id","=",$customer_id],                                    
                                ])                            
                            ->get();
            //Call Total
            $slips            = TwoSale::leftJoin('customers', 'two_sales.customer_id', '=', 'customers.id')
                                        ->where([                                           
                                                  
                                                  ["two_sales.work_file_id","=",$work_file_id],
                                                  ["two_sales.user_id","=",$user_id],
                                                  ["two_sales.customer_id","=",$customer_id],
                                                  // ["two_sales.slip_id","=",$slip_id],

                                                  ["two_sales.status","=",1],
                                                  ["two_sales.confirm","=",1],

                                                  ['customers.in_out', '=', $in_out],
                                              ])
                                          
                                          ->distinct()
                                          ->groupBy("two_sales.slip_id")
                                          ->select(['two_sales.slip_id',\DB::raw("SUM(two_sales.amount) as call_total")])
                                          ->get();
            //End Call Total

        }

        if($slip_id != 0)
        {
            $two_sales = TwoSale::where([  

                                    ["work_file_id","=",$work_file_id],
                                    ["user_id","=",$user_id],
                                    ["customer_id","=",$customer_id],
                                    ["slip_id","=",$slip_id],
                                ])                            
                            ->get();

            //Call Total
            $slips            = TwoSale::leftJoin('customers', 'two_sales.customer_id', '=', 'customers.id')
                                        ->where([                                           
                                                  
                                                  ["two_sales.work_file_id","=",$work_file_id],
                                                  ["two_sales.user_id","=",$user_id],
                                                  ["two_sales.customer_id","=",$customer_id],
                                                  ["two_sales.slip_id","=",$slip_id],

                                                  // ["two_sales.status","=",1],
                                                  // ["two_sales.confirm","=",1],

                                                  ['customers.in_out', '=', $in_out],
                                              ])
                                          
                                          ->distinct()
                                          ->groupBy("two_sales.slip_id")
                                          ->select(['two_sales.slip_id',\DB::raw("SUM(two_sales.amount) as call_total")])
                                          ->get();
            //End Call Total
        }
        //End Last Slip (or) All Slip (or) Current Slip




        
        //Data Carry for View File
        $work_files     = WorkFile::where([ 
                                            ["name","=",$name],
                                            ["duration","=",$duration],

                                        ])->get();

        $users          = User::all();
        $customers      = Customer::where("in_out","=",$in_out)->get(); 

        $hots           = Hot::where("work_file_id","=",$work_file_id)->get();
      
        $user_name      = User::where("id","=",$user_id)->value('name');
        $customer_name  = Customer::where("id","=",$customer_id)->value('name'); 

        if($action == "2D_AM") 
            { $two_am_work_file_id    = $work_file_id; }
        else { $two_am_work_file_id   = 0; }
        
        if($action == "2D_PM")
            {  $two_pm_work_file_id   = $work_file_id; }
        else { $two_pm_work_file_id   = 0; }
        
        if($action == "3D_PM")
            { $three_work_file_id     = $work_file_id;  }
        else { $three_work_file_id    = 0;}
        
        // End Data Carry for View File

        return view('twosale.addtwosale',[
                                            'work_files'            => $work_files,
                                            'users'                 => $users,
                                            'customers'             => $customers,

                                            'hots'                  => $hots,

                                            'user_name'             => $user_name,
                                            'customer_name'         => $customer_name,

                                            'two_am_work_file_id'   => $two_am_work_file_id,
                                            'two_pm_work_file_id'   => $two_pm_work_file_id,
                                            'three_work_file_id'    => $three_work_file_id,
                                            

                                            'work_file_id'          => $work_file_id,
                                            'current_work_file_id'          => $current_work_file_id,

                                            'user_id'               => $user_id,
                                            'customer_id'           => $customer_id,
                                            'slip_id'               => $slip_id,

                                            'action'                => $action,
                                            'in_out'                => $in_out,
                                            'entry'                 => $entry,
                                            'view'                  => $view,
                                            'keyboard'              => $keyboard,
                                            'max_minus'             => $max_minus,
                                            'slip'                  => $slip,

                                            'keep_break'            => $keep_break,

                                            'two_sales'             => $two_sales,
                                            'slips'                 => $slips,
                                            'over_digits'           => $over_digits,
                                        ]);
    }


    public function createTwoSale(Request $request)
    {
        $validator = validator(request()->all(),
            [
                // "work_file_id"      => "required",
                // "user_id"           => "required",
                // "customer_id"       => "required",
               
                "type"              =>"required",                           
                "amount"            =>"required", 
            ]);

        if($validator->fails())
        {
            return back()->with('info',"Data can not be Blank!!!");
        }
       
        //Get Auth User Info

            //Get Info
            $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');
            $slip           = Choice::where('auth_id','=',auth()->user()->id)->value('slip');

            $user_id        = Choice::where('auth_id','=',auth()->user()->id)->value('user_id');
            $choice         = Choice::where('auth_id','=',$user_id)->first();
          
            $user_id        = $choice->user_id;
            $customer_id    = $choice->customer_id;
            $in_out         = $choice->in_out;
            $entry          = $choice->entry;
            $view           = $choice->view;
            $keyboard       = $choice->keyboard;
            $max_minus      = $choice->max_minus;           
            //End Get Info

            //Action => 2D_AM, 2D_PM, 3D_PM
            $temp   = WorkFile::find($work_file_id);

            $action                 = $temp->name."_".$temp->duration; 
            $name                   = $temp->name;
            $duration               = $temp->duration;
            $current_work_file_id   = $work_file_id;

            //Keep Break
            $keep_break     = BreakAmount::where('work_file_id','=',$work_file_id)
                                        ->orderBy('id','desc')
                                        ->take(1)
                                        ->value('status');            
        //End Get Auth User Info


    //Main Process

        // Check Unit / Cash
        if($entry == "Unit")
        {
            $amount         = request()->amount * 100;            
            $r_amount       = request()->r_amount * 100;
            $this->r_amount = $r_amount;
        }
        else
        {
            $amount         = request()->amount;            
            $r_amount       = request()->r_amount;            
            $this->r_amount = $r_amount;
        }
        // End Check Unit / Cash

        // Calculate Slip
        if(request()->slip_id == "0")
        {  
            $two_sales = TwoSale::where([                                           
                                        
                                        ["work_file_id","=",$work_file_id],
                                        ["user_id","=",$user_id],
                                        ["customer_id","=",$customer_id],

                                    ])
                                ->orderBy('id','desc')
                                ->first();

            if($two_sales != null)
            {   $slip_id = $two_sales->slip_id +1; }
            else
            {   $slip_id = 1; }
           
        }
        else
        {   $slip_id = request()->slip_id; }        
        // End Calculate Slip

        
        // Normal Digit Save
        $type           = request()->type;        
        $result_digits  = $this->Type_to_Digits($type);  

        // dd($result_digits);

        $this->insertTwoSale($work_file_id,$user_id,$customer_id,$slip_id,$type,$result_digits,$amount);
        
        $over_digits    = $this->overBreakDigits($work_file_id);
        // End Normal Digit Save

    
        // Sub Amount Digit Save
        if($this->r_amount != 0)
        {
            $type       = $this->r_digit;
            $amount     = $r_amount;

            $result_digits  = $this->Type_to_Digits($type);
            
            $this->insertTwoSale($work_file_id,$user_id,$customer_id,$slip_id,$type,$result_digits,$amount);
            
            $over_digits = $this->overBreakDigits($work_file_id);

        }
        // End Sub Amount Digit Save

    //End Main Process



        //Data Carry for View File
        $two_sales = TwoSale::where([  

                                    ["work_file_id","=",$work_file_id],
                                    ["user_id","=",$user_id],
                                    ["customer_id","=",$customer_id],
                                    ["slip_id","=",$slip_id],
                                ])                            
                            ->get();
        //Call Total
        $slips            = TwoSale::leftJoin('customers', 'two_sales.customer_id', '=', 'customers.id')
                                    ->where([                                           
                                              
                                              ["two_sales.work_file_id","=",$work_file_id],
                                              ["two_sales.user_id","=",$user_id],
                                              ["two_sales.customer_id","=",$customer_id],
                                              ["two_sales.slip_id","=",$slip_id],

                                              ["two_sales.status","=",1],
                                              ["two_sales.confirm","=",0],

                                              ['customers.in_out', '=', $in_out],
                                          ])
                                      
                                      ->distinct()
                                      ->groupBy("two_sales.slip_id")
                                      ->select(['two_sales.slip_id',\DB::raw("SUM(two_sales.amount) as call_total")])
                                      ->get();
        // dd($slips);
        //End Call Total


        $work_files     = WorkFile::where([ 
                                            ["name","=",$name],
                                            ["duration","=",$duration],

                                        ])->get();

        $users          = User::all();
        $customers      = Customer::where("in_out","=",$in_out)->get(); 

        $hots           = Hot::where("work_file_id","=",$work_file_id)->get();
      
        $user_name      = User::where("id","=",$user_id)->value('name');
        $customer_name  = Customer::where("id","=",$customer_id)->value('name'); 

        
        if($action == "2D_AM") 
            { $two_am_work_file_id    = $work_file_id; }
        else { $two_am_work_file_id   = 0; }
        
        if($action == "2D_PM")
            {  $two_pm_work_file_id   = $work_file_id; }
        else { $two_pm_work_file_id   = 0; }
        
        if($action == "3D_PM")
            { $three_work_file_id     = $work_file_id;  }
        else { $three_work_file_id    = 0;}
        // End Data Carry for View File


        return view('twosale.addtwosale',[
                                            'work_files'            => $work_files,
                                            'users'                 => $users,
                                            'customers'             => $customers,

                                            'hots'                  => $hots,

                                            'user_name'             => $user_name,
                                            'customer_name'         => $customer_name,

                                            'two_am_work_file_id'   => $two_am_work_file_id,
                                            'two_pm_work_file_id'   => $two_pm_work_file_id,
                                            'three_work_file_id'    => $three_work_file_id,
                                            

                                            'work_file_id'          => $work_file_id,
                                            'current_work_file_id'          => $current_work_file_id,
                                            
                                            'user_id'               => $user_id,
                                            'customer_id'           => $customer_id,
                                            'slip_id'               => $slip_id,

                                            'action'                => $action,
                                            'in_out'                => $in_out,
                                            'entry'                 => $entry,
                                            'view'                  => $view,
                                            'keyboard'              => $keyboard,
                                            'max_minus'             => $max_minus,
                                            'slip'                  => $slip,

                                            'keep_break'            => $keep_break,

                                            'two_sales'             => $two_sales,
                                            'slips'                 => $slips,
                                            'over_digits'           => $over_digits,

                                        ]);

    }

    public function delTwoSale($id)
    {
        $two_sale       = TwoSale::find($id);

        
        $work_file_id   = $two_sale->work_file_id;
        $user_id        = $two_sale->user_id;
        $customer_id    = $two_sale->customer_id;
        $slip_id        = $two_sale->slip_id;
      
        DB::table('two_sales')->where('id', '=', "$id")->delete();

        return back();
        // return redirect("2dsale/add/{$work_file_id}/{$slip_id}");
    }

    public function typedelTwoSale($id)
    {
        $two_sale       = TwoSale::find($id);

    
        $work_file_id   = $two_sale->work_file_id;
        $user_id        = $two_sale->user_id;
        $customer_id    = $two_sale->customer_id;
        $slip_id        = $two_sale->slip_id;
        $type           = $two_sale->type;

        $result_digits  = $this->Type_to_Digits($type);
        $digits_count   = count($result_digits)-1;

        $from           = $id;
        $to             = $id+$digits_count;

    
        DB::table('two_sales')->where([ 
                                        ['work_file_id', '=', "$work_file_id"],
                                        ['user_id', '=', "$user_id"], 
                                        ['customer_id', '=', "$customer_id"], 
                                        ['slip_id', '=', "$slip_id"], 
                                        ['type', '=', "$type"], 

                                        ['id', '>=', "$from"],
                                        ['id', '<=', "$to"], 

                                    ])->delete();

        return back();
        // return redirect("2dsale/add/{$work_file_id}/{$slip_id}");

    }

    public function alldelTwoSale(Request $request)
    {
        $work_file_id   = request()->w_id;
        $user_id        = request()->u_id;
        $customer_id    = request()->c_id;
        $slip_id        = request()->s_id;
        
        DB::table('two_sales')->where([ 
                                        ['work_file_id', '=', "$work_file_id"],
                                        ['user_id', '=', "$user_id"], 
                                        ['customer_id', '=', "$customer_id"], 
                                        ['slip_id', '=', "$slip_id"],                                        

                                    ])->delete();

        return back();
        // return redirect("2dsale/add/{$work_file_id}/{$slip_id}");

    }


    public function overBreakDigits($work_file_id)
    {
        $over_digits = array();

        $break_amt      = BreakAmount::where("work_file_id","=",$work_file_id)->value('amount');

        $sales  =    DB::table('two_sales')
                    ->leftJoin('twos', 'two_sales.digit', '=', 'twos.digit')
                    ->leftJoin('customers', 'two_sales.customer_id', '=', 'customers.id')
                    ->where([
                                ["two_sales.work_file_id","=",$work_file_id],
                                ['customers.in_out', '=', 1],
                            ])
                    ->groupBy('two_sales.digit')
                    ->selectRaw('two_sales.digit as digit, sum(two_sales.amount) as sum')                    
                    ->get();

        $purchases =    DB::table('two_sales')
                    ->leftJoin('twos', 'two_sales.digit', '=', 'twos.digit')
                    ->leftJoin('customers', 'two_sales.customer_id', '=', 'customers.id')
                    ->where([
                                ["two_sales.work_file_id","=",$work_file_id],
                                ['customers.in_out', '=', 2],
                            ])
                    ->groupBy('two_sales.digit')
                    ->selectRaw('two_sales.digit as digit, sum(two_sales.amount) as sum')                    
                    ->get();


        $twos    = Two::all();

        foreach ($twos as  $two) 
        {
           $two->sale_amount        = 0;
           $two->purchase_amount    = 0;
           $two->max_amount         = 0;

           $two->save();
        }


        foreach ($sales as $key => $sale) 
        {
            $id     = Two::where('digit','=',$sale->digit)->value('id');
            $two    = Two::find($id);


            $two->sale_amount = $sale->sum;
            $two->save();
            
        }

        foreach ($purchases as $key => $purchase) 
        {
            $id     = Two::where('digit','=',$purchase->digit)->value('id');
            $two    = Two::find($id);

            $two->purchase_amount = $purchase->sum;
            $two->save();
        }

        $twos    = Two::all();

        foreach ($twos as  $two) 
        {
           
           if( $two->sale_amount <= $break_amt )
           {               

                if($two->purchase_amount == 0)
                {                   

                    $two->max_amount = 0;
                }
                else if($two->purchase_amount != 0)
                {                    
                    if($two->purchase_amount > $two->sale_amount)
                    { 
                        $two->max_amount = $two->sale_amount - $two->purchase_amount; 
                    }
                    else
                    {
                        $two->max_amount = 0;
                    }
                }

           }
           else if( $two->sale_amount > $break_amt)
           {
                if($two->purchase_amount == 0)
                {
                    $two->max_amount = $two->sale_amount - $break_amt;
                }
                else if( $two->purchase_amount == $two->sale_amount)
                {
                     $two->max_amount = 0;
                }
                else
                {
                    $two->max_amount = ($two->sale_amount - $break_amt) - $two->purchase_amount;
                }
           }


           $two->save();

           if($two->max_amount != 0)
           { $over_digits[$two->digit] = $two->max_amount; }

        }

        return $over_digits;
    }

    public function insertTwoSale($work_file_id,$user_id,$customer_id,$slip_id,$type,$result_digits,$amount)
    {
        $two_hotpercent = Commission::where([

                                    ["user_id","=","$user_id"],
                                    ["customer_id","=","$customer_id"],

                                ])
                            ->value('twod_hotpercent');

        $break_amount   = BreakAmount::where([ 

                                    ["work_file_id","=",$work_file_id],

                                ])
                            ->value('amount');

        $keep_break         = BreakAmount::where('work_file_id','=',$work_file_id)
                                        ->orderBy('id','desc')
                                        ->take(1)
                                        ->value('status');


        // dd($amount);

        //Normal Digit Save
        foreach ($result_digits as $result_digit) 
        {

            //check 2d_hotpercent, break_amount, amount_sum

            //$two_hotpercent = 0;
            //$break_amount   = 0;
            //$total_amount   = 0;
            

            $total_amount     = TwoSale::where([                                           
                                    
                                    ["work_file_id","=","$work_file_id"],
                                    ["user_id","=","$user_id"],
                                    ["customer_id","=","$customer_id"], 

                                    ["digit","=","$result_digit"],
                                    ["status","=",1],
                                ])
                            ->sum('amount');

                          
            $permit_amount = $break_amount * $two_hotpercent/100;

            $two_sale = new TwoSale();

                        
            $two_sale->work_file_id     = $work_file_id;
            $two_sale->user_id          = $user_id;  
            $two_sale->customer_id      = $customer_id; 

            $two_sale->slip_id          = $slip_id;

            $two_sale->type             = $type;
            $two_sale->digit            = $result_digit;



            //check hot
            $hots = Hot::where([                                           
                                    ["work_file_id","=",$work_file_id],                    
                                    ["digit","=",$result_digit],

                                ])
                            ->orderBy('id','desc')
                            ->first();

            //end check hot

            //check digit permit
                            
            //dd($work_file_id." ".$user_id. " ".$customer_id. " ".$result_digit);
            $digit_permit = DigitPermission::where([                                           
                                    ["work_file_id","=",$work_file_id],                    
                                    ["user_id","=",$user_id],
                                    ["customer_id","=",$customer_id],
                                    ["digit","=",$result_digit],

                                ])
                            ->orderBy('id','desc')
                            ->first();

            if($digit_permit != null)
            {
                $two_sale->status           = -2;
                $two_sale->amount           =  $amount;
            }
            // end check digit permit

            else if($hots == null && ($total_amount +  $amount) <= $break_amount )
            {
                $two_sale->status           = 1;
                $two_sale->amount           =  $amount;
            }

            else if($hots == null && ($total_amount +  $amount) >= $break_amount && $keep_break == 1)
            {
                $two_sale->status           = 1;
                $two_sale->amount           =  $amount;
            }

            else if($hots == null && ($total_amount +  $amount) > $break_amount)
            {
                $two_sale->status           = 0;
                $two_sale->amount           =  $amount;
            }
            else if($hots != null && ($total_amount +  $amount) <= $permit_amount)
            {
                $two_sale->status           = 1;
                $two_sale->amount           =  $amount;
            }
            else if($hots != null && ($total_amount +  $amount) > $permit_amount)
            {
                $two_sale->status           = -1;

                $two_sale->amount           = $permit_amount;
            }            
            else
            {   $two_sale->status           = 1;
                $two_sale->amount           =  $amount;
            }
            //end check status
           
            $two_sale->save();

        }
        //End  Normal Digit Save
    }

    public function saveTwoSale()
    {
               
        $work_file_id   = request()->w_id;
        $user_id        = request()->u_id;
        $slip_id        = request()->s_id;

        $remark         = request()->remark;

       

        $two_sales = TwoSale::where([                                           
                                    ["user_id","=",$user_id],
                                    ["work_file_id","=",$work_file_id],
                                    ["slip_id","=",$slip_id],
                                    ["status","=",1],
                                ])
                            ->orWhere([
                                    ["user_id","=",$user_id],
                                    ["work_file_id","=",$work_file_id],
                                    ["slip_id","=",$slip_id],
                                    ["status","=",-1],
                                ])
                            ->get();

        foreach($two_sales as $two_sale)
        {
            $two_sale->status = 1;

            $two_sale->confirm = 1;

            $two_sale->remark = $remark;

            $two_sale->save();
        }

        DB::table('two_sales')->where([
                                        ['status', '!=', 1],
                                        
                                ])
                                ->orWhere([
                                    
                                        ['confirm', '!=', 1],
                                ])
                                ->delete();

        return redirect("2dsale/add/{$work_file_id}");

    }

    public function chooseTwoSale(Request $request)
    {
        // $action     = request()->action;
        // $file_id    = request()->file_id;

        $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');

        //Action => 2D_AM, 2D_PM, 3D_PM
        // $temp   = WorkFile::find($work_file_id);
        // $action = $temp->name."_".$temp->duration; 

        $action     = request()->action;


        // dd($work_file_id);

        if($action == "2D_AM" || $action == "2D_PM")
        {
            return redirect("2dsale/add/{$work_file_id}?action={$action}");
        }
        if($action == "3D_PM")
        {
            return redirect("3dsale/add/{$work_file_id}?action={$action}");
        }
    }

    public function positionbetTwoSale(Request $request)
    {
        $work_file_id = request()->work_file_id;

        // dd($work_file_id);
    }

    public function padaytharbetTwoSale(Request $request)
    {
        //slip_id        
         if(request()->img_slip_id == null)
            {  $slip_id = 0; }
        else
            {  $slip_id = request()->img_slip_id; }
        
        //Get Auth User Info

            //Get Info
            $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');
            $slip           = Choice::where('auth_id','=',auth()->user()->id)->value('slip');

            $user_id        = Choice::where('auth_id','=',auth()->user()->id)->value('user_id');
            $choice         = Choice::where('auth_id','=',$user_id)->first();
          
            $user_id        = $choice->user_id;
            $customer_id    = $choice->customer_id;
            $in_out         = $choice->in_out;
            $entry          = $choice->entry;
            $view           = $choice->view;
            $keyboard       = $choice->keyboard;
            $max_minus      = $choice->max_minus;           
            //End Get Info

            //Action => 2D_AM, 2D_PM, 3D_PM
            $temp   = WorkFile::find($work_file_id);
            $action = $temp->name."_".$temp->duration; 

            //Keep Break
            $keep_break     = BreakAmount::where('work_file_id','=',$work_file_id)
                                        ->orderBy('id','desc')
                                        ->take(1)
                                        ->value('status');            
        //End Get Auth User Info
        

        //Get => OverBreakDigits
        $over_digits = $this->overBreakDigits($work_file_id);
        //End Get => OverBreakDigits

       
        $two_sales = TwoSale::where([  

                                    ["work_file_id","=",$work_file_id],
                                    ["user_id","=",auth()->user()->id],
                                    ["customer_id","=",$customer_id],
                                    ["slip_id","=",$slip_id],
                                ])                            
                            ->get();

        //Data Carry
        $work_files     = WorkFile::all();
        $users          = User::all();
        $customers      = Customer::where("in_out","=",$in_out)->get();
        $hots           = Hot::where("work_file_id","=",$work_file_id)->get();
        $workfile_name  = WorkFile::where("id","=",$work_file_id)->value('show');
        $user_name      = User::where("id","=",$user_id)->value('name');
        $customer_name  = Customer::where("id","=",$customer_id)->value('name'); 
        
        $two_am_work_file_id    = $work_file_id;
        $two_pm_work_file_id    = $work_file_id;
        $three_work_file_id     = $work_file_id;
        //End Data Carry

        return view('twosale.padaythartwosale',[

                                            'work_files'            => $work_files,
                                            'two_am_work_file_id'   => $two_am_work_file_id,
                                            'two_pm_work_file_id'   => $two_pm_work_file_id,
                                            'three_work_file_id'    => $three_work_file_id,
                                            'action'                => $action,

                                            'work_file_id'          => $work_file_id,
                                            'user_id'               => $user_id,
                                            'customer_id'           => $customer_id,
                                            'slip_id'               => $slip_id,

                                            'keep_break'            => $keep_break,
                                            'entry'                 => $entry,
                                            'view'                  => $view,
                                            'keyboard'              => $keyboard,
                                            'in_out'                => $in_out,

                                            'two_sales'             => $two_sales,
                                            'users'                 => $users,
                                            'customers'             => $customers,
                                            'over_digits'           => $over_digits,
                                            'hots'                  => $hots,

                                            'workfile_name'         => $workfile_name,
                                            'user_name'             => $user_name,
                                            'customer_name'         => $customer_name,
                                        ]);
    }

    public function createpadaytharbetTwoSale(Request $request)
    {
        $validator = validator(request()->all(),
            [
                "work_file_id"      => "required",
                "user_id"           => "required",
                "customer_id"       => "required",               
                "type"              =>"required",                           
                "amount"            =>"required", 
            ]);

        if($validator->fails())
        {
            return back()->with('info',"Data can not be Blank!!!");
        }
       
        //Get Auth User Info

            //Get Info
            $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');
            $slip           = Choice::where('auth_id','=',auth()->user()->id)->value('slip');

            $user_id        = Choice::where('auth_id','=',auth()->user()->id)->value('user_id');
            $choice         = Choice::where('auth_id','=',$user_id)->first();
          
            $user_id        = $choice->user_id;
            $customer_id    = $choice->customer_id;
            $in_out         = $choice->in_out;
            $entry          = $choice->entry;
            $view           = $choice->view;
            $keyboard       = $choice->keyboard;
            $max_minus      = $choice->max_minus;           
            //End Get Info

            //Action => 2D_AM, 2D_PM, 3D_PM
            $temp   = WorkFile::find($work_file_id);
            $action = $temp->name."_".$temp->duration; 

            //Keep Break
            $keep_break     = BreakAmount::where('work_file_id','=',$work_file_id)
                                        ->orderBy('id','desc')
                                        ->take(1)
                                        ->value('status');            
        //End Get Auth User Info  


        if($entry == "Unit")
        {
            $amount     = request()->amount * 100;
            
            $r_amount   = request()->r_amount * 100;

            $this->r_amount = $r_amount;
        }
        else
        {
            $amount     = request()->amount;
            
            $r_amount   = request()->r_amount;
            
            $this->r_amount = $r_amount;
        }

               

        //Slip
        if(request()->slip_id == "0")
        {
            
            $two_sales = TwoSale::where([                                           
                                        
                                        ["work_file_id","=",$work_file_id],
                                        ["user_id","=",$user_id],
                                        ["customer_id","=",$customer_id],

                                    ])
                                ->orderBy('id','desc')
                                ->first();

            if($two_sales != null)
            {
                $slip_id = $two_sales->slip_id +1;
            }
            else
            {
                $slip_id = 1;
            }
           
        }
        else
        {
            $slip_id = request()->slip_id;
        } 
         //End Slip


        
        //Type => Digits
        $type           = request()->type;
        $result_digits  = $this->Type_to_Padaythar_Digits($type);
        //Type => Digits
        
        //Insert => Digits        
        $this->insertTwoSale($work_file_id,$user_id,$customer_id,$slip_id,$type,$result_digits,$amount);
        //End Insert => Digits
        
        //Get => OverBreakDigits
        $over_digits = $this->overBreakDigits($work_file_id);
        //End Get => OverBreakDigits


        //r_amount Digit Save
        if($this->r_amount != 0)
        {
            $type   = $this->r_digit;
            $amount = $r_amount;

            //dd($type. " / ".$amount);

           //Type => Digits               
            $result_digits  = $this->Type_to_Digits($type);
            //Type => Digits

            //Insert => Digits
            $this->insertTwoSale($work_file_id,$user_id,$customer_id,$slip_id,$type,$result_digits,$amount);
            //End Insert => Digits
            
            //Get => OverBreakDigits
            $over_digits = $this->overBreakDigits($work_file_id);
            //End Get => OverBreakDigits

        }
        //End r_amount Digit Save


        return redirect("/2dsale/add/{$work_file_id}/{$slip_id}");


        // $users          = User::all();
        // $customers      = Customer::all();

        // $hots           = Hot::where("work_file_id","=",$work_file_id)->get();
        // $workfile_name  = WorkFile::where("id","=",$work_file_id)->value('show');
        // $user_name      = User::where("id","=",$user_id)->value('name');
        // $customer_name  = Customer::where("id","=",$customer_id)->value('name'); 

        // $two_sales = TwoSale::where([ 

        //                             ["work_file_id","=",$work_file_id],
        //                             ["user_id","=",$user_id],
        //                             ["customer_id","=",$customer_id],
        //                             ["slip_id","=",$slip_id],          
        //                         ])
        //                     ->get();

        
        // $work_files             = WorkFile::all();
        // $two_am_work_file_id    = $work_file_id;
        // $two_pm_work_file_id    = $work_file_id;
        // $three_work_file_id     = $work_file_id;


        // return view('twosale.padaythartwosale',[
        //                                     'work_files'            => $work_files,
        //                                     'two_am_work_file_id'   => $two_am_work_file_id,
        //                                     'two_pm_work_file_id'   => $two_pm_work_file_id,
        //                                     'three_work_file_id'    => $three_work_file_id,
        //                                     'action'                => $action,

        //                                     'work_file_id'          => $work_file_id,
        //                                     'user_id'               => $user_id,
        //                                     'customer_id'           => $customer_id,
        //                                     'slip_id'               => $slip_id,

        //                                     'keep_break'            => $keep_break,
        //                                     'entry'                 => $entry,
        //                                     'view'                  => $view,
        //                                     'keyboard'              => $keyboard,
        //                                     'in_out'                => $in_out,

                                            
        //                                     'two_sales'             => $two_sales,
        //                                     'users'                 => $users,
        //                                     'customers'             => $customers,
        //                                     'over_digits'           => $over_digits,
        //                                     'hots'                  => $hots,

        //                                     'workfile_name'         => $workfile_name,
        //                                     'user_name'             => $user_name,
        //                                     'customer_name'         => $customer_name,
        //                                 ]);
    }

    public function imagetextTwoSale(Request $request)
    {
        
        //slip_id        
         if(request()->img_slip_id == null)
            {  $slip_id = 0; }
        else
            {  $slip_id = request()->img_slip_id; }

        
        //Get Auth User Info

           //Get Info
            $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');
            $slip           = Choice::where('auth_id','=',auth()->user()->id)->value('slip');

            $user_id        = Choice::where('auth_id','=',auth()->user()->id)->value('user_id');
            $choice         = Choice::where('auth_id','=',$user_id)->first();
          
            $user_id        = $choice->user_id;
            $customer_id    = $choice->customer_id;
            $in_out         = $choice->in_out;
            $entry          = $choice->entry;
            $view           = $choice->view;
            $keyboard       = $choice->keyboard;
            $max_minus      = $choice->max_minus;           
            //End Get Info

            //Action => 2D_AM, 2D_PM, 3D_PM
            $temp   = WorkFile::find($work_file_id);
            $action = $temp->name."_".$temp->duration; 

            //Keep Break
            $keep_break     = BreakAmount::where('work_file_id','=',$work_file_id)
                                        ->orderBy('id','desc')
                                        ->take(1)
                                        ->value('status');            
        //End Get Auth User Info


        
        //Get => OverBreakDigits
        $over_digits = $this->overBreakDigits($work_file_id);
        //End Get => OverBreakDigits
        
       
        $two_sales = TwoSale::where([  

                                    ["work_file_id","=",$work_file_id],
                                    ["user_id","=",auth()->user()->id],
                                    ["customer_id","=",$customer_id],
                                    ["slip_id","=",$slip_id],
                                ])                            
                            ->get();

             
        //Data Carry
        $work_files     = WorkFile::all();
        $users          = User::all();
        $customers      = Customer::where("in_out","=",$in_out)->get();
        $hots           = Hot::where("work_file_id","=",$work_file_id)->get();
        $workfile_name  = WorkFile::where("id","=",$work_file_id)->value('show');
        $user_name      = User::where("id","=",$user_id)->value('name');
        $customer_name  = Customer::where("id","=",$customer_id)->value('name'); 
        
        $two_am_work_file_id    = $work_file_id;
        $two_pm_work_file_id    = $work_file_id;
        $three_work_file_id     = $work_file_id;

        $text = "";
        //End Data Carry

        return view('twosale.imagetexttwosale',[

                                            'work_files'            => $work_files,
                                            'two_am_work_file_id'   => $two_am_work_file_id,
                                            'two_pm_work_file_id'   => $two_pm_work_file_id,
                                            'three_work_file_id'    => $three_work_file_id,
                                            'action'                => $action,

                                            'work_file_id'          => $work_file_id,
                                            'user_id'               => $user_id,
                                            'customer_id'           => $customer_id,
                                            'slip_id'               => $slip_id,

                                            'keep_break'            => $keep_break,
                                            'entry'                 => $entry,
                                            'view'                  => $view,
                                            'keyboard'              => $keyboard,
                                            'in_out'                => $in_out,

                                            'two_sales'             => $two_sales,
                                            'users'                 => $users,
                                            'customers'             => $customers,
                                            'over_digits'           => $over_digits,
                                            'hots'                  => $hots,

                                            'workfile_name'         => $workfile_name,
                                            'user_name'             => $user_name,
                                            'customer_name'         => $customer_name,

                                            'text'                  => $text,
                                        ]);
    }

    public function createimagetextTwoSale(Request $request)
    {

        //Get Auth User Info

           //Get Info
            $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');
            $slip           = Choice::where('auth_id','=',auth()->user()->id)->value('slip');

            $user_id        = Choice::where('auth_id','=',auth()->user()->id)->value('user_id');
            $choice         = Choice::where('auth_id','=',$user_id)->first();
          
            $user_id        = $choice->user_id;
            $customer_id    = $choice->customer_id;
            $in_out         = $choice->in_out;
            $entry          = $choice->entry;
            $view           = $choice->view;
            $keyboard       = $choice->keyboard;
            $max_minus      = $choice->max_minus;           
            //End Get Info

            //Action => 2D_AM, 2D_PM, 3D_PM
            $temp   = WorkFile::find($work_file_id);
            $action = $temp->name."_".$temp->duration; 

            //Keep Break
            $keep_break     = BreakAmount::where('work_file_id','=',$work_file_id)
                                        ->orderBy('id','desc')
                                        ->take(1)
                                        ->value('status');            
        //End Get Auth User Info      

               

         //Slip
        if(request()->img_slip_id == "0")
        {           
            $two_sales = TwoSale::where([                                           
                                        
                                        ["work_file_id","=",$work_file_id],
                                        ["user_id","=",$user_id],
                                        ["customer_id","=",$customer_id],

                                    ])
                                ->orderBy('id','desc')
                                ->first();

            if($two_sales != null)
            {   $slip_id = $two_sales->slip_id +1; }
            else
            {   $slip_id = 1; }
           
        }
        else
        {
            $slip_id = request()->img_slip_id;
        }        
         //End Slip
       
        
        

        switch (request()->action)
        {
            case 'Update_Text':

                $text   =  request()->text;            
                Storage::disk('local')->put('type_img.txt', $text);

                return back()->with('info',"Text Updated Successfully!");

            break;

            case 'Insert_Text':                

                  $text = "";
                  $handle = fopen("..//storage/app//type_img.txt", "r");

                  if ($handle) 
                  {
                      while (($line = fgets($handle)) !== false) 
                      {
                        // //echo $line."<br>";
                        // $text = $text . $line;

                        $new_array = array();
                        if($line) 
                        { 
                            $line = trim(preg_replace('/\t+/', ' ', $line));
                            
                            // dd($line);

                            $new_array = explode(' ',$line);
                        }
                        if (is_array($new_array) && count($new_array) == 2)
                        {
                          $type   = $new_array[0];
                          $amount = $new_array[1];

                            if($entry == "Unit")
                            { $amount     = (int)$amount * 100; }
                            else
                            { $amount     = (int)$amount; }

                           //Type => Digits 
                            $result_digits  = $this->Type_to_Digits($type);
                            //Type => Digits

                            //Insert => Digits        
                            $this->insertTwoSale($work_file_id,$user_id,$customer_id,$slip_id,$type,$result_digits,$amount);
                            //End Insert => Digits


                        }
                              

                      }

                      fclose($handle);
                  } 
                  else 
                  {
                      // error opening the file.
                  } 

 
            break;      
        }

        return redirect("/2dsale/add/{$work_file_id}/{$slip_id}");

        // //Get => OverBreakDigits
        // $over_digits = $this->overBreakDigits($work_file_id);
        // //End Get => OverBreakDigits

       

        // $users          = User::all();
        // $customers      = Customer::all();

        // $hots           = Hot::where("work_file_id","=",$work_file_id)->get();
        // $workfile_name  = WorkFile::where("id","=",$work_file_id)->value('show');
        // $user_name      = User::where("id","=",$user_id)->value('name');
        // $customer_name  = Customer::where("id","=",$customer_id)->value('name'); 

        // $two_sales = TwoSale::where([ 

        //                             ["work_file_id","=",$work_file_id],
        //                             ["user_id","=",$user_id],
        //                             ["customer_id","=",$customer_id],
        //                             ["slip_id","=",$slip_id],          
        //                         ])
        //                     ->get();

        
        // $work_files             = WorkFile::all();
        // $two_am_work_file_id    = $work_file_id;
        // $two_pm_work_file_id    = $work_file_id;
        // $three_work_file_id     = $work_file_id;


        // return view('twosale.imagetexttwosale',[

        //                                     'work_files'            => $work_files,
        //                                     'two_am_work_file_id'   => $two_am_work_file_id,
        //                                     'two_pm_work_file_id'   => $two_pm_work_file_id,
        //                                     'three_work_file_id'    => $three_work_file_id,
        //                                     'action'                => $action,

        //                                     'work_file_id'          => $work_file_id,
        //                                     'user_id'               => $user_id,
        //                                     'customer_id'           => $customer_id,
        //                                     'slip_id'               => $slip_id,

        //                                     'keep_break'            => $keep_break,
        //                                     'entry'                 => $entry,
        //                                     'view'                  => $view,
        //                                     'keyboard'              => $keyboard,
        //                                     'in_out'                => $in_out,

                                            
        //                                     'two_sales'             => $two_sales,
        //                                     'users'                 => $users,
        //                                     'customers'             => $customers,
        //                                     'over_digits'           => $over_digits,
        //                                     'hots'                  => $hots,

        //                                     'workfile_name'         => $workfile_name,
        //                                     'user_name'             => $user_name,
        //                                     'customer_name'         => $customer_name,
        //                                 ]);

    }

    public function addImage(Request $request)
    {
        return view('twosale.addimage');
    }
    public function createImage(Request $request)
    {
        $validator = validator(request()->all(),
            [
                
                "photo"          =>"required",
                                       
            ]);

        if($validator->fails())
        {
            return back()->withErrors($validator);
        }

        
        $work_file_id = request()->work_file_id;
        $action       = request()->action;
        $in_out       = request()->in_out;

        // dd($work_file_id.$action.$in_out);

            

            if($request->hasfile('photo'))
            {
                $file       = $request->file('photo');
                $extension  = $file->getClientOriginalExtension();
                // $filename   = time(). '.' . $extension;
                //$filename   = request()->name. '.' . $extension;

                $filename   = "type_img.png";


                $file->move('..//vendor//thiagoalessio//tesseract_ocr//src//',$filename);
                // $team->photo= $filename;
            }
          else
            {
                return $request;
                // $team->photo = '';
            }           
                     
        

        $path   = "..//vendor//thiagoalessio//tesseract_ocr//src//$filename";       

        $ocr    = new TesseractOCR($path);

        $text   =  $ocr->run();
            
        Storage::disk('local')->put('type_img.txt', $text);

        $contents = Storage::get('type_img.txt');

        


        return redirect("2dsale/image-text/bet/{$work_file_id}?action={$action}&in_out={$in_out}")->with('info',"Image Uploaded Successfully!");
    }

   
   
}
