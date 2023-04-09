<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use thiagoalessio\TesseractOCR\TesseractOCR;

use Illuminate\Support\Facades\URL;


use DB;

use App\Admin;
use App\WorkFile;

use App\ThreeSale;
use App\Three;
use App\Two;

use App\Hot;
use App\Commission;
use App\BreakAmount;
use App\D3Type;
use App\User;
use App\Customer;
use App\DigitPermission;
use App\PositionBet;
use App\Choice;
use App\OtherPermission;
use App\ThreeType;

use App\ThreePosition;


class ThreeSaleController extends Controller
{
    private $select_work_file_id;
    private $select_user_id;
    private $select_slip_id;

    private $three_type_condition = false;


    private $r_digit;
    private $r_amount;


    public function saveInfo($w_id,$u_id,$slip_id)
    {
        $this->select_work_file_id = $w_id;
        $this->select_user_id = $u_id;
        $this->select_slip_id = $slip_id;
    }

    public function Type_to_Position_Digits($type)
    {
        $type_array = str_split($type);

        $amount1 = "";

        $table_name = "";
        $range1 = "";
        $range2 = "";

        $digit_array = array();

         if(strlen($type) == 2)
        {
            $first      = $type_array[0];
            $second     = $type_array[1];

            if( is_numeric($first) && $second == "-")
            {
                for($i=0; $i<=9;$i++)
                {
                    for($j=0; $j<=9;$j++)
                    {
                        for($k=0; $k<=9;$k++)
                        { 
                            if($i == $first)
                            {
                                $digit = $i.$j.$k;

                                array_push($digit_array, $digit); 
                            }
                        }
                    }
                }

                for($i=0; $i<=9;$i++)
                {
                    for($j=0; $j<=9;$j++)
                    {
                        for($k=0; $k<=9;$k++)
                        { 
                            if($j == $first)
                            {
                                $digit = $i.$j.$k;

                                array_push($digit_array, $digit); 
                            }
                        }
                    }
                }

                for($i=0; $i<=9;$i++)
                {
                    for($j=0; $j<=9;$j++)
                    {
                        for($k=0; $k<=9;$k++)
                        { 
                            if($k == $first)
                            {
                                $digit = $i.$j.$k;

                                array_push($digit_array, $digit); 
                            }
                        }
                    }
                }


                $result_digits = array_unique($digit_array);

               
            }


            if( is_numeric($first) && ( $second == "T" || $second == "t") )
            {
                for($i=0; $i<=9;$i++)
                {
                    for($j=0; $j<=9;$j++)
                    {
                        for($k=0; $k<=9;$k++)
                        { 
                            if($i == $first)
                            {
                                $digit = $i.$j.$k;

                                array_push($digit_array, $digit); 
                            }
                        }
                    }
                }

                $result_digits = array_unique($digit_array);

            }

            if( is_numeric($first) && $second == "L")
            {   
                for($i=0; $i<=9;$i++)
                {
                    for($j=0; $j<=9;$j++)
                    {
                        for($k=0; $k<=9;$k++)
                        { 
                            if($j == $first)
                            {
                                $digit = $i.$j.$k;

                                array_push($digit_array, $digit); 
                            }
                        }
                    }
                }

                $result_digits = $digit_array; 
            }

             if( is_numeric($first) && $second == "N")
            {
                for($i=0; $i<=9;$i++)
                {
                    for($j=0; $j<=9;$j++)
                    {
                        for($k=0; $k<=9;$k++)
                        { 
                            if($k == $first)
                            {
                                $digit = $i.$j.$k;

                                array_push($digit_array, $digit); 
                            }
                        }
                    }
                }

                $result_digits = $digit_array; 
            }

        }


        if(strlen($type) == 3)
        {
            $first      = $type_array[0];
            $second     = $type_array[1];
            $third      = $type_array[2];

            if( is_numeric($first) && $second == "*" && $third == "*" )
            {
                for($i=0; $i<=9;$i++)
                {
                    for($j=0; $j<=9;$j++)
                    {
                        for($k=0; $k<=9;$k++)
                        { 
                            if($i == $first)
                            {
                                $digit = $i.$j.$k;

                                array_push($digit_array, $digit); 
                            }
                        }
                    }
                }

                $result_digits = $digit_array;
            }

            if( $first == "*" && is_numeric($second) && $third == "*"  )
            {
                for($i=0; $i<=9;$i++)
                {
                    for($j=0; $j<=9;$j++)
                    {
                        for($k=0; $k<=9;$k++)
                        { 
                            if($j == $second)
                            {
                                $digit = $i.$j.$k;

                                array_push($digit_array, $digit); 
                            }
                        }
                    }
                }

                $result_digits = $digit_array;       
            }
            if( $first == "*" && $second == "*" && is_numeric($third) )
            {
                for($i=0; $i<=9;$i++)
                {
                    for($j=0; $j<=9;$j++)
                    {
                        for($k=0; $k<=9;$k++)
                        { 
                            if($k == $third)
                            {
                                $digit = $i.$j.$k;

                                array_push($digit_array, $digit); 
                            }
                        }
                    }
                }

                $result_digits = $digit_array;       
            }

        }

        return $result_digits;


    }

    public function checkSameDigits($N)
    {
        $type_array = str_split($N);

        $current_digit = $type_array[0];

        for($i=0;$i<count($type_array);$i++)
        {
            if ($current_digit != $type_array[$i])
            {                
                return "No";
            }
        }

       return "Yes";

       
    }

     public function Type_to_Padaythar_Two_Digits($type)
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

    public function Type_to_Padaythar_Three_Digits($type)
    {

     
        $type_array     = str_split($type);
        $digit_array    = array();

        $last = $type_array[count($type_array)-1];
       
        // Start ပဒေသာ
        if($last == '*')
        {
            $length = count($type_array)-1;

            for($i=0; $i<$length;$i++)
            {
                for($j=$i; $j<$length;$j++)
                {
                    for($k=$j; $k<$length;$k++)
                    {
                        
                        $first      = $type_array[$i];
                        $second     = $type_array[$j];
                        $third      = $type_array[$k];

                           
                        $d3_types = DB::table("d3_types")
                                                ->where([                                           
                                                            ["id",">=",1],
                                                            ["id","<=",6],
                                                        ])
                                                ->get();
                          
                        foreach ($d3_types as $d3_type) 
                        {
                            $d1 = $d2 = $d3 = "";

                            if( $d3_type->d1 == "first")        { $d1 = $first; }
                            else if( $d3_type->d1 == "second")  { $d1 = $second; }
                            else if( $d3_type->d1 == "third")   { $d1 = $third; }
                            else                                { $d1 = $d3_type->d1; }

                            if( $d3_type->d2 == "first")        { $d2 = $first; }
                            else if( $d3_type->d2 == "second")  { $d2 = $second; }
                            else if( $d3_type->d2 == "third")   { $d2 = $third; }
                            else                                { $d2 = $d3_type->d2; }

                            if( $d3_type->d3 == "first")        { $d3 = $first; }
                            else if( $d3_type->d3 == "second")  { $d3 = $second; }
                            else if( $d3_type->d3 == "third")   { $d3 = $third; }
                            else                                { $d3 = $d3_type->d3; }

                            $digit = $d1.$d2.$d3;

                            array_push($digit_array, $digit); 
                        }

                       
                    }
                    
                }
            }
        }

        else if($last == '+')
        {
            $length = count($type_array)-1;

            for($i=0; $i<$length;$i++)
            {
                for($j=$i; $j<$length;$j++)
                {
                    for($k=$j; $k<$length;$k++)
                    {
                       

                        $first      = $type_array[$i];
                        $second     = $type_array[$j];
                        $third      = $type_array[$k];

                           
                        $d3_types = DB::table("d3_types")
                                                ->where([                                           
                                                            ["id",">=",1],
                                                            ["id","<=",6],
                                                        ])
                                                ->get();
                          
                        foreach ($d3_types as $d3_type) 
                        {
                            $d1 = $d2 = $d3 = "";

                            if( $d3_type->d1 == "first")        { $d1 = $first; }
                            else if( $d3_type->d1 == "second")  { $d1 = $second; }
                            else if( $d3_type->d1 == "third")   { $d1 = $third; }
                            else                                { $d1 = $d3_type->d1; }

                            if( $d3_type->d2 == "first")        { $d2 = $first; }
                            else if( $d3_type->d2 == "second")  { $d2 = $second; }
                            else if( $d3_type->d2 == "third")   { $d2 = $third; }
                            else                                { $d2 = $d3_type->d2; }

                            if( $d3_type->d3 == "first")        { $d3 = $first; }
                            else if( $d3_type->d3 == "second")  { $d3 = $second; }
                            else if( $d3_type->d3 == "third")   { $d3 = $third; }
                            else                                { $d3 = $d3_type->d3; }

                            $digit = $d1.$d2.$d3;

                            
                            if( $this->checkSameDigits($digit) == "No")
                            {
                               array_push($digit_array, $digit);
                            }
                            
                             
                        }

                       
                    }
                    
                }
            }
        }


        else if(is_numeric($last))
        {
            $length = count($type_array);

            for($i=0; $i<$length;$i++)
            {
                for($j=$i; $j<$length;$j++)
                {
                    for($k=$j; $k<$length;$k++)
                    {
                        $first      = $type_array[$i];
                        $second     = $type_array[$j];
                        $third      = $type_array[$k];

                        
                        $d3_types = DB::table("d3_types")
                                                ->where([                                           
                                                            ["id",">=",1],
                                                            ["id","<=",6],
                                                        ])
                                                ->get();
                          
                        foreach ($d3_types as $d3_type) 
                        {
                            $d1 = $d2 = $d3 = "";

                            if( $d3_type->d1 == "first")        { $d1 = $first; }
                            else if( $d3_type->d1 == "second")  { $d1 = $second; }
                            else if( $d3_type->d1 == "third")   { $d1 = $third; }
                            else                                { $d1 = $d3_type->d1; }

                            if( $d3_type->d2 == "first")        { $d2 = $first; }
                            else if( $d3_type->d2 == "second")  { $d2 = $second; }
                            else if( $d3_type->d2 == "third")   { $d2 = $third; }
                            else                                { $d2 = $d3_type->d2; }

                            if( $d3_type->d3 == "first")        { $d3 = $first; }
                            else if( $d3_type->d3 == "second")  { $d3 = $second; }
                            else if( $d3_type->d3 == "third")   { $d3 = $third; }
                            else                                { $d3 = $d3_type->d3; }

                            if($d1 != $d2 && $d1 != $d3 && $d2 != $d3)
                            {
                                $digit = $d1.$d2.$d3;  
                                array_push($digit_array, $digit);   
                            }
                            

                            
                        }
                    

                    }
                    
                }
            }
        }
        // Start ပဒေသာ


        
        else if(strlen($type) == 2)
        {
            $first      = $type_array[0];
            $second     = $type_array[1];

            // Start ထိပ် - လည် - ပိတ်            
            if( is_numeric($first) && ($second == "T" || $second == "t") )
            {
                
                    for($d2=0;$d2<10;$d2++)
                    {
                        for($d3=0;$d3<10;$d3++)
                        {
                            $digit = "$first$d2$d3";
                            array_push($digit_array, $digit);
                            
                            
                        }
                        
                    }
                           
            }
            if( is_numeric($first) && ($second == "L" || $second == "l") )
            {
                
                    for($d2=0;$d2<10;$d2++)
                    {
                        for($d3=0;$d3<10;$d3++)
                        {
                            $digit = "$d2$first$d3";
                            array_push($digit_array, $digit);
                            
                            
                        }
                        
                    }
                           
            }
            if( is_numeric($first) && ($second == "N" || $second == "n") )
            {
                
                    for($d2=0;$d2<10;$d2++)
                    {
                        for($d3=0;$d3<10;$d3++)
                        {
                            $digit = "$d2$d3$first";
                            array_push($digit_array, $digit);
                            
                            
                        }
                        
                    }
                           
            }
            // End ထိပ် - လည် - ပိတ်

            // Start ဘရိတ်
            if( is_numeric($first) && ($second == "B" || $second == "b" || $second == "/") )
            {
                for($d1=0;$d1<10;$d1++)
                {
                    for($d2=0;$d2<10;$d2++)
                    {
                        for($d3=0;$d3<10;$d3++)
                        {
                            if( (int)"$first" == (int)$d1 + (int)$d2 + (int)$d3)
                            {
                                $digit = "$d1$d2$d3";
                                array_push($digit_array, $digit);
                            }
                            // dd(10+(int)"$first");                            
                            if( 10+(int)"$first" == (int)$d1 + (int)$d2 + (int)$d3)
                            {
                                $digit = "$d1$d2$d3";
                                array_push($digit_array, $digit);
                            }
                            if( 20+(int)"$first" == (int)$d1 + (int)$d2 + (int)$d3)
                            {
                                $digit = "$d1$d2$d3";
                                array_push($digit_array, $digit);
                            }
                        }
                        
                    }
                }              
            }
            // End ဘရိတ်

            //Start  1 အပါ
            if( is_numeric($first) && ( $second == "-" || $second == "R" || $second == "r") )
            {
                for($i=0; $i<=9;$i++)
                {
                    for($j=0; $j<=9;$j++)
                    {
                        for($k=0; $k<=9;$k++)
                        { 
                            if($i == $first)
                            {
                                $digit = $i.$j.$k;

                                array_push($digit_array, $digit); 
                            }
                        }
                    }
                }

                for($i=0; $i<=9;$i++)
                {
                    for($j=0; $j<=9;$j++)
                    {
                        for($k=0; $k<=9;$k++)
                        { 
                            if($j == $first)
                            {
                                $digit = $i.$j.$k;

                                array_push($digit_array, $digit); 
                            }
                        }
                    }
                }

                for($i=0; $i<=9;$i++)
                {
                    for($j=0; $j<=9;$j++)
                    {
                        for($k=0; $k<=9;$k++)
                        { 
                            if($k == $first)
                            {
                                $digit = $i.$j.$k;

                                array_push($digit_array, $digit); 
                            }
                        }
                    }
                }

                // $result_digits = array_unique($digit_array);
               
            }
            //End  1 အပါ


        }
        

        

        sort($digit_array);
        $result_digits = array_unique($digit_array);

        // dd($result_digits);

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


    public function chooseThreeSale(Request $request)
    {
        
        $today         = Carbon::today()->toDateString(); 
        $now           = Carbon::now()->toTimeString();
       
        if(WorkFile::where('upload','=',1)->exists())
        {
            $work_file = WorkFile::where('upload','=',1)->first();

            
          
          
            $previous_three_workfiles  = WorkFile::where([
                                              ["name","=","2D"],                                             
                                              ["upload","=",0],
                                          ])
                                      ->orderBy('id','asc')                                     
                                      ->get();
      
           
            return view('threesale.listthreesale',[ 
                                                    'work_file'  => $work_file, 
                                                    'previous_three_workfiles' => $previous_three_workfiles,

                                                    'now' => $now,
                                                    'today' => $today,

                                                ]);
            
        }
        else if(WorkFile::exists())
        {
            if(auth()->user()->id == 1 || auth()->user()->id == 2) 
            {
                $work_file = WorkFile::orderBy('id','asc')->first();

                $last_id = WorkFile::where([
                                              ["name","=","2D"],
                                          ])
                                      ->orderBy('id','asc')
                                      ->take(1)
                                      ->value('id');
              
                $previous_three_workfiles  = WorkFile::where([
                                                  ["name","=","2D"],
                                                  // ["id","<=",$last_id-1],
                                                  ["upload","=",0],
                                              ])
                                          ->orderBy('id','asc')                                     
                                          ->get();

                return view('threesale.listthreesale',[ 
                                                    'work_file'  => $work_file, 
                                                    'previous_three_workfiles' => $previous_three_workfiles,

                                                    'now' => $now,
                                                    'today' => $today,
                                                    
                                                ]);
            }
            else
            {
                return back()->with('info',"2D ဖိုင် မရှိသေးပါ");
            }
        }
        else
        {
           if(auth()->user()->id == 1 || auth()->user()->id == 2) 
           {
                 return back()->with('info',"2D ဖိုင် မရှိသေးပါ၊ ဖိုင်အသစ်တည်ပါ။");
           }
           else
           {
                 return back()->with('info',"2D ဖိုင် မရှိသေးပါ");
           }

        }

    }


    public function showThreeSale(Request $request)
    {
        $work_file_id   = request()->w_id;
        $slip_id        = request()->s_id;

        dd(" $work_file_id / $slip_id ");

    }

    public function editThreeSale($w_id,$u_id,$s_id)
    {
        

        $work_file_id   = $w_id;
        $user_id        = $u_id;
        $slip_id        = $s_id;

        $customer_id    = 1;


        $choice = Choice::where('auth_id','=',auth()->user()->id)->orderBy('id','desc')->first();        
                $choice->work_file_id = $work_file_id;
        $choice->save();


        $in_out         = Choice::where('auth_id','=',auth()->user()->id)->value('in_out');
        $max_minus      = Choice::where('auth_id','=',auth()->user()->id)->value('max_minus');
        $keyboard       = Choice::where('auth_id','=',auth()->user()->id)->value('keyboard');

        $slip           = Choice::where('auth_id','=',auth()->user()->id)->value('slip');
        $entry          = Choice::where('auth_id','=',auth()->user()->id)->value('entry');
        $view           = Choice::where('auth_id','=',auth()->user()->id)->value('view');



        $keep_break     = BreakAmount::where('work_file_id','=',$work_file_id)
                                        ->orderBy('id','desc')
                                        ->take(1)
                                        ->value('status');

       
        
        $three_sales = ThreeSale::where([  

                                    ["work_file_id","=",$work_file_id],
                                    ["user_id","=",$user_id],
                                    ["customer_id","=",$customer_id],
                                    ["slip_id","=",$slip_id],
                                    
                                ])                            
                            ->get(); 

      
        if(auth()->user()->id == 1 or auth()->user()->id == 2)
        {
            $users          = User::where('in_out','=',$in_out)->get();
        }
        else
        {
             $users          = User::where('id','=',auth()->user()->id)
                                    ->orWhere('refer_user_id','=',auth()->user()->id)
                                    ->get();
        }

        //Data Carry for View File
        $work_file     = WorkFile::find($work_file_id);
        $user_name     = User::where("id","=",$user_id)->value('name');

        $over_digits    = $this->overBreakDigits($work_file_id);
        $hots           = Hot::where("work_file_id","=",$work_file_id)->get();


        $st = request()->st;



         return view('threesale.addthreesale',[

                                            'work_file'             => $work_file,
                                            'users'                 => $users,
                                            'hots'                  => $hots,

                                            'user_name'             => $user_name,

                                            'work_file_id'          => $work_file_id,
                                            'user_id'               => $user_id,
                                            'slip_id'               => $slip_id,
                                            'in_out'                => $in_out,

                                            'entry'                 => $entry,
                                            'view'                  => $view,
                                            'keyboard'              => $keyboard,
                                            'max_minus'             => $max_minus,
                                            'slip'                  => $slip,

                                            'keep_break'            => $keep_break,

                                            // 'three_sales'           => $three_sales,
                                            'over_digits'           => $over_digits,
                                            'st'                    => $st,
                                        ]);


        // dd(" $work_file_id /  $user_id / $slip_id ");


    }

    public function addThreeSale($id)
    {

        $st = request()->st;

        
        $work_file_id   = $id;
        
        $choice = Choice::where('auth_id','=',auth()->user()->id)->orderBy('id','desc')->first();        
                $choice->work_file_id = $work_file_id;
        $choice->save();
                   
           
      
        //Get Auth User Info
        if(Choice::where('auth_id','=',auth()->user()->id)->exists())
        {  
            //Get Info
            $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');            
            $user_id        = Choice::where('auth_id','=',auth()->user()->id)->value('user_id');
            $customer_id    = Choice::where('auth_id','=',auth()->user()->id)->value('customer_id');

            $in_out         = Choice::where('auth_id','=',auth()->user()->id)->value('in_out');
            $max_minus      = Choice::where('auth_id','=',auth()->user()->id)->value('max_minus');
            $keyboard       = Choice::where('auth_id','=',auth()->user()->id)->value('keyboard');

            $slip           = Choice::where('auth_id','=',auth()->user()->id)->value('slip');
            $entry          = Choice::where('auth_id','=',auth()->user()->id)->value('entry');
            $view           = Choice::where('auth_id','=',auth()->user()->id)->value('view');
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
                $choice->slip           = "None";

            $choice->save();

           //Get Info
            $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');            
            $user_id        = Choice::where('auth_id','=',auth()->user()->id)->value('user_id');
            $customer_id    = Choice::where('auth_id','=',auth()->user()->id)->value('customer_id');

            $in_out         = Choice::where('auth_id','=',auth()->user()->id)->value('in_out');
            $max_minus      = Choice::where('auth_id','=',auth()->user()->id)->value('max_minus');
            $keyboard       = Choice::where('auth_id','=',auth()->user()->id)->value('keyboard');

            $slip           = Choice::where('auth_id','=',auth()->user()->id)->value('slip');
            $entry          = Choice::where('auth_id','=',auth()->user()->id)->value('entry');
            $view           = Choice::where('auth_id','=',auth()->user()->id)->value('view');
            //End Get Info
           
        }

         
        $keep_break     = BreakAmount::where('work_file_id','=',$work_file_id)
                                        ->orderBy('id','desc')
                                        ->take(1)
                                        ->value('status');

        //  if(request()->s_id == null)
        //     {  $slip_id = 0; }
        // else
        //     {  $slip_id = request()->s_id; }        
     
                 
        //     $three_sales = ThreeType::where([  

        //                             ["work_file_id","=",$work_file_id],
        //                             ["user_id","=",$user_id],
        //                             ["customer_id","=",$customer_id],
        //                             ["slip_id","=",$slip_id],
                                    
        //                         ])                            
        //                     ->get();           
     
        
        if(auth()->user()->id == 1 or auth()->user()->id == 2)
        {
            $users          = User::where('in_out','=',$in_out)->get();
        }
        else
        {
            $users          = User::where('id','=',auth()->user()->id)
                                    ->orWhere('refer_user_id','=',auth()->user()->id)
                                    ->get();
        }

        //Data Carry for View File
        $work_file     = WorkFile::find($work_file_id);
        $user_name     = User::where("id","=",$user_id)->value('name');
        $over_digits    = $this->overBreakDigits($work_file_id);
        $hots           = Hot::where("work_file_id","=",$work_file_id)->get();


        // $last_record = ThreeSale::where([  

        //                             ["work_file_id","=",$work_file_id],
        //                             ["user_id","=",$user_id],
        //                             ["customer_id","=",1],
                                    
                                    
        //                         ])->orderBy('slip_id','desc')
        //                           ->first();


        //  if($last_record != null)
        //  {
        //     $last_slip =  $last_record->slip_id; 
        //  }
        //  else
        //  {
        //    $last_slip = 0;
        //  }

          // $slip_total = ThreeSale::where([  

          //                       ["work_file_id","=",$work_file_id],
          //                       ["user_id","=",$user_id],
          //                       ["customer_id","=",1], 
          //                       // ["slip_id","=",$last_slip],                                    

          //                   ])->sum("amount");

        if(request()->st == null)
        {
            

            $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');            
            $user_id        = Choice::where('auth_id','=',auth()->user()->id)->value('user_id');
            $customer_id    = Choice::where('auth_id','=',auth()->user()->id)->value('customer_id');

            $last_record    = ThreeSale::where([  

                                    ["work_file_id","=",$work_file_id],
                                    ["user_id","=",$user_id],
                                    ["customer_id","=",1],
                                    
                                    
                                ])->orderBy('slip_id','desc')
                                  ->first();

            

             if($last_record != null)
             {
                $last_slip =  $last_record->slip_id; 
             }
             else
             {
               $last_slip = 0;
             }


            $slip_id        = $last_slip + 1;

            $slip_total = ThreeSale::where([  

                                ["work_file_id","=",$work_file_id],
                                ["user_id","=",$user_id],
                                ["customer_id","=",1], 
                                // ["slip_id","=",$last_slip],                                    

                            ])->sum("amount");


             $three_sales = ThreeType::where([  

                                    ["work_file_id","=",$work_file_id],
                                    ["user_id","=",$user_id],
                                    ["customer_id","=",$customer_id],
                                    ["slip_id","=",$slip_id],
                                    
                                ])                            
                            ->get();          

            // dd("$last_slip -> $slip_id");

        }


        if(request()->st == "edit")
        {
            // $id             = request()->id;
            
            // $three_sale     = ThreeType::find($id);

            $work_file_id   = request()->work_file_id;
            $user_id        = request()->user_id;
            $customer_id    = request()->customer_id;           
            $slip_id        = request()->slip_id;

            $three_sales = ThreeType::where([  

                                    ["work_file_id","=",$work_file_id],
                                    ["user_id","=",$user_id],
                                    ["customer_id","=",$customer_id],                                  
                                    ["slip_id","=",$slip_id],
                                    
                                ])                            
                            ->get();  

            $last_record = ThreeSale::where([  

                                    ["work_file_id","=",$work_file_id],
                                    ["user_id","=",$user_id],
                                    ["customer_id","=",1],
                                    
                                    
                                ])->orderBy('slip_id','desc')
                                  ->first();


             if($last_record != null)
             {
                $last_slip =  $last_record->slip_id; 
             }
             else
             {
               $last_slip = 0;
             }

              $slip_total = ThreeSale::where([  

                                    ["work_file_id","=",$work_file_id],
                                    ["user_id","=",$user_id],
                                    ["customer_id","=",1], 
                                    // ["slip_id","=",$last_slip],                                    

                                ])->sum("amount");         
     


        }

        return view('threesale.addthreesale',[

                                            'work_file'             => $work_file,
                                            'users'                 => $users,
                                            'hots'                  => $hots,

                                            'user_name'             => $user_name,

                                            'work_file_id'          => $work_file_id,
                                            'user_id'               => $user_id,
                                            'slip_id'               => $slip_id,
                                            'in_out'                => $in_out,

                                            'entry'                 => $entry,
                                            'view'                  => $view,
                                            'keyboard'              => $keyboard,
                                            'max_minus'             => $max_minus,
                                            'slip'                  => $slip,

                                            'keep_break'            => $keep_break,

                                            'three_sales'           => $three_sales,
                                            'over_digits'           => $over_digits,
                                            'st'                    => $st,

                                            'last_slip'             => $last_slip,
                                            'slip_total'            => $slip_total,

                                        ]);
    }

  
    public function saveThreeSale()
    {
        $work_file_id   = request()->w_id;
        $user_id        = request()->u_id;
        $slip_id        = request()->s_id;

        if(auth()->user()->id == 1)
        {
            $remark         = User::where('id','=',1)->value('name');
        }
        else if(auth()->user()->id == 2)
        {
            $remark         = User::where('id','=',2)->value('name');
        }
        else
        {
            $remark         = request()->remark;
        }
        

        $in_out         = User::where('id','=',$user_id)->value("in_out");

        $today          = Carbon::today()->toDateString(); 
        $now            = Carbon::now()->toTimeString();

        $work_file      = WorkFile::find($work_file_id);

        $user         = User::where('id','=',$user_id)->first();

        // dd($slip_id);


        //For Admin Transfer (Stand Alone)
         if(auth()->user()->id == 1 || auth()->user()->id == 2)
        {
            return redirect("3dsale/add/{$work_file_id}");
        }
        if($in_out == 1)
        {
            // return redirect("3dsale/add/{$work_file_id}")->with('info',"$msg"); 

            return redirect("3dsale/add/{$work_file_id}"); 
        }
        if($in_out == 2)
        {
            return redirect("3dsale/add/{$work_file_id}");
        }
        //For Admin Transfer (Stand Alone)



        
        if(auth()->user()->id != 1 && auth()->user()->id != 2)
        {
            if($work_file->date == $today)
            {

                       if( $work_file->close_time < $now)
                        {
                            $msg =  " သတ်မှန်ချိန် ကျော်သွားပါပြီ ". "\\n";

                            $msg .= " လုပ်ငန်းစဉ် မအောင်မြင်ပါ ". "\\n";

                            //Clear Three Types
                            DB::table('three_types')->where([ 

                                                        ["work_file_id","=",$work_file_id],
                                                        ["user_id","=",$user_id],
                                                        ["customer_id","=",1],
                                                        ["slip_id","=",$slip_id],

                                                        ['status','=',1], 
                                                        
                                                    ])->delete();

                           


                            return redirect("3dsale/add/{$work_file_id}?st=timeup")->with('info',"$msg");
                        }
                        else if($user->close_time != null && $user->close_time < $now )
                        {
                            $msg =  " သတ်မှန်ချိန် ကျော်သွားပါပြီ ". "\\n";

                            $msg .= " လုပ်ငန်းစဉ် မအောင်မြင်ပါ ". "\\n";

                            //Clear Three Types
                            DB::table('three_types')->where([ 

                                                        ["work_file_id","=",$work_file_id],
                                                        ["user_id","=",$user_id],
                                                        ["customer_id","=",1],
                                                        ["slip_id","=",$slip_id],

                                                        ['status','=',1], 
                                                        
                                                    ])->delete();

                            // dd("Here Down");


                            return redirect("3dsale/add/{$work_file_id}?st=timeup")->with('info',"$msg");
                        }
             
            }
        }
    
        $three_types = ThreeType::where([ 
                                            ["work_file_id","=",$work_file_id],
                                            ["user_id","=",$user_id],
                                            ["customer_id","=",1],
                                            ["slip_id","=",$slip_id],

                                            ['status','=',1], 
                                        ])->orderBy('id','asc')->get();

        $bet = request()->bet;

        if($bet == "padaythar")
        {
            foreach($three_types as $three_type)
            {
                $this->padaythar_transferThreeType($three_type->id,$remark);

                // $three_sale = new ThreeSale();
                            
                //     $three_sale->work_file_id     = $three_type->work_file_id;
                //     $three_sale->user_id          = $three_type->user_id ;
                //     $three_sale->customer_id      = $three_type->customer_id;

                //     $three_sale->slip_id          = $three_type->slip_id;

                //     $three_sale->type             = $three_type->type;
                //     $three_sale->digit            = $three_type->digit;

                //     $three_sale->amount           = $three_type->amount; 
                    
                //     $three_sale->status           = 1;
                //     $three_sale->confirm          = 1;

                //     $three_sale->remark           = $remark;

                //     $three_sale->three_type_id      = $three_type->id;
                //     $three_sale->three_type_amount  = $three_type->amount;

                // $three_sale->save(); 

            } 
        }
        else if($bet == "position")
        {
            $three_positions = ThreePosition::where([                                           
                                    
                                    ["work_file_id","=",$work_file_id],
                                    ["user_id","=",$user_id],
                                    ["customer_id","=",1],
                                    ["slip_id","=",$slip_id],

                                    ['status','=',1], 
                                ])
                            ->get();

            foreach($three_positions as $three_position)
            {
                $three_position->confirm = 1;
                $three_position->remark  = $remark;

                $three_position->save();
            }

            DB::table('three_positions')->where([                                        
                                        ['confirm', '!=', 1],
                                ])->delete();
        }
        else
        {
            foreach($three_types as $three_type)
            {               
                if(auth()->user()->id == 1 || auth()->user()->id == 2)
                {
                    $this->admin_transferThreeType($three_type->id,$remark);
                }
                else
                {
                    $break_status       = BreakAmount::where('work_file_id','=',$work_file_id)->value('status');

                    if($break_status == 1)
                    {
                        $this->breakone_transferThreeType($three_type->id,$remark);
                    }

                    if($break_status == 0)
                    {
                        $this->breakzero_transferThreeType($three_type->id,$remark);
                    }
                }

                
            }   
        }

          

        $three_sales = ThreeSale::whereRaw('amount < three_type_amount AND 
                                 work_file_id = ? AND 
                                 user_id = ? AND 
                                 slip_id = ?', 

                                [   $work_file_id,
                                    $user_id,
                                    $slip_id
                                ]
                            )->get();


        if(ThreeSale::whereRaw('amount < three_type_amount')                        
                        ->where([ 
                                    ['work_file_id','=',$work_file_id], 
                                    ['user_id','=',$user_id], 
                                    ['slip_id','=',$slip_id], 

                                ])                      
                        ->exists())
        {
            
            $msg =  " အောက်ပါ အကျွံဂဏန်းနှင့် ယူနစ်များ မရပါ ". "\\n";


            if($user_id == 1 || $user_id ==2 )
            {
                $msg .= " ရ ဂဏန်းများကို စလစ်(သို့)ထိုးပြီးဂဏန်းများ တွင် ကြည့်ပါ  ". "\\n";    
            }
            else
            {
                $msg .= " ရ ဂဏန်းများကို စလစ်(သို့)ထိုးပြီးဂဏန်းများ တွင် ကြည့်ပါ  ". "\\n";
            }    


       
            foreach ($three_sales as $key => $three_sale) 
            {
                $balance = $three_sale->three_type_amount-$three_sale->amount;

                $msg .= $three_sale->digit . "  " .$balance. "\\n";
            
            }

        }
        else
        {
            $msg =  " ထိုးဂဏန်း အားလုံး ရပါသည် ". "\\n";

            if($user_id == 1 || $user_id ==2)
            {
                $msg .= " စလစ်(သို့)ထိုးပြီးဂဏန်းများ တွင် ကြည့်ပါ  ". "\\n";
            }
            else
            {
                $msg .= " စလစ်(သို့)ထိုးပြီးဂဏန်းများ တွင် ကြည့်ပါ  ". "\\n";           
            }
            
        }

        //Clear Three Types
        // DB::table('three_types')->where('id', '>', 0)->delete();

        $three_types = ThreeType::where([ 
                                            ["work_file_id","=",$work_file_id],
                                            ["user_id","=",$user_id],
                                            ["customer_id","=",1],
                                            ["slip_id","=",$slip_id],

                                            ['status','=',1], 
                                            
                                        ])->get();

        foreach($three_types as $three_type)
        {
            $three_type->status = 0;

            $three_type->save();
        }

        //End Three Types Clear
        
        dd($slip_id);

        
        if(auth()->user()->id == 1 || auth()->user()->id == 2)
        {
            return redirect("3dsale/add/{$work_file_id}");
        }
        if($in_out == 1)
        {
            // return redirect("3dsale/add/{$work_file_id}")->with('info',"$msg"); 

            return redirect("3dsale/add/{$work_file_id}"); 
        }
        if($in_out == 2)
        {
            return redirect("3dsale/add/{$work_file_id}");
        }

        

    }

   

    public function insertPositionBet($work_file_id,$user_id,$customer_id,$slip_id,$type,$result_digits,$amount)
    {
        //Normal Digit Save
        foreach ($result_digits as $result_digit) 
        {
          

            $position_bet = new PositionBet();

                        
            $position_bet->work_file_id     = $work_file_id;
            $position_bet->user_id          = $user_id;  
            $position_bet->customer_id      = $customer_id; 

            $position_bet->slip_id          = $slip_id;

            $position_bet->type             = request()->type;
            $position_bet->digit            = $result_digit;
            $position_bet->amount           = request()->amount;

            $position_bet->status           = 1;            
           
            $position_bet->save();    

        }
        //End  Normal Digit Save
    }


    public function insertThreeType($work_file_id,$user_id,$customer_id,$slip_id,$type,$result_digits,$amount)
    {
        //12R = 2000 => 12 = 1000, 21 = 1000 Logic
        $type_array = str_split($type);

        if(strlen($type) == 3)
        {

            $first      = $type_array[0];
            $second     = $type_array[1];
            $third      = $type_array[2];

            if( is_numeric($first) && is_numeric($second) && ($third == "R" || $third == "r" || $third == "+") )
            {
                $amount = $amount / 2;            
            }

        }
        //12R = 2000 => 12 = 1000, 21 = 1000 Logic


        foreach ($result_digits as $result_digit) 
        {

            $three_type = new ThreeType();
                            
                    $three_type->work_file_id     = $work_file_id;
                    $three_type->user_id          = $user_id;  
                    $three_type->customer_id      = 1; 

                    $three_type->slip_id          = $slip_id;

                    $three_type->type             = $type;
                    $three_type->digit            = $result_digit;

                    $three_type->amount           = $amount;
                    
                    $three_type->status           = 1;
                    $three_type->confirm          = 1;

            $three_type->save(); 

            $three_sale = new ThreeSale();
                            
                    $three_sale->work_file_id     = $work_file_id;
                    $three_sale->user_id          = $user_id;  
                    $three_sale->customer_id      = 1; 

                    $three_sale->slip_id          = $slip_id;

                    $three_sale->type             = $type;
                    $three_sale->digit            = $result_digit;

                    $three_sale->amount           = $amount;
                    
                    $three_sale->status           = 1;
                    $three_sale->confirm          = 1;

                    $three_sale->three_type_id    = $three_type->id;
                    $three_sale->three_type_amount= $amount;

            $three_sale->save(); 

        }

    }

    public function insertThreePosition($work_file_id,$user_id,$customer_id,$slip_id,$d1,$d2,$amount)
    {

         $three_position = new ThreePosition();
                            
                    $three_position->work_file_id       = $work_file_id;
                    $three_position->user_id            = $user_id;  
                    $three_position->customer_id        = 1; 

                    $three_position->slip_id            = $slip_id;

                    $three_position->d1                 = $d1;
                    $three_position->d2                 = $d2;

                    $three_position->amount             = $amount;
                    
                    $three_position->status             = 1;
                    $three_position->confirm            = 0;

            $three_position->save(); 
     

    }

    public function insertThreeSale($work_file_id,$user_id,$customer_id,$slip_id,$type,$result_digits,$amount)
    {

        foreach ($result_digits as $result_digit) 
        {

            $three_type = new ThreeType();
                            
                    $three_type->work_file_id     = $work_file_id;
                    $three_type->user_id          = $user_id;  
                    $three_type->customer_id      = 1; 

                    $three_type->slip_id          = $slip_id;

                    $three_type->type             = $type;
                    $three_type->digit            = $result_digit;

                    $three_type->amount           = $amount;
                    
                    $three_type->status           = 1;
                    $three_type->confirm          = 1;

            $three_type->save(); 
        }

    }

    public function admin_transferThreeType($id,$remark)
    {
        $three_type         = ThreeType::find($id);

        $work_file_id       = $three_type->work_file_id;
        $user_id            = $three_type->user_id;
        $customer_id        = $three_type->customer_id;
        $slip_id            = $three_type->slip_id;
        $type               = $three_type->type;
        $result_digit       = $three_type->digit;
        $amount             = $three_type->amount;

        $break_status       = BreakAmount::where('work_file_id','=',$work_file_id)->value('status');
        $break_amount       = BreakAmount::where("work_file_id","=",$work_file_id)->value('amount');

        $all_user_taken_digit_amount    = ThreeSale::where([                                           
                                
                                                        ["work_file_id","=",$work_file_id], 
                                                        ['digit','=',"$result_digit"],

                                                        ["status","=",1], 
                                                        ["confirm","=",1],  

                                                    ])->sum('amount');

        

        $in_out = User::where('id','=',$user_id)->value('in_out');

        // dd("Admin Transfer $in_out ");

        //Break Status = 1
        if($in_out == 1)
        {
            if($break_status == 1)
            {
                $avaliable_amount = $break_amount - $all_user_taken_digit_amount;

                // dd($avaliable_amount);

                if($amount <= $avaliable_amount)
                {
                    $pay_amount = $amount;
                }
                else
                {
                    if($avaliable_amount>0)
                    {
                        $pay_amount = $avaliable_amount;
                    }
                    else
                    {
                        $pay_amount = 0;
                    }
                }

                // dd("Here is Admin Right Break = 1");
            }
        }
        else
        {
            $pay_amount = $amount;
        }
        

        //Break Status == 0
        if($break_status == 0)
        {
            $pay_amount = $amount;

            // dd("Here is Admin Right Break = 0");
        }


        //Save to ThreeSale
        if($pay_amount >= 0)
        {
            $three_sale = new ThreeSale();
                    
                $three_sale->work_file_id     = $work_file_id;
                $three_sale->user_id          = $user_id;  
                $three_sale->customer_id      = $customer_id; 

                $three_sale->slip_id          = $slip_id;

                $three_sale->type             = $type;
                $three_sale->digit            = $result_digit;

                $three_sale->amount           = $pay_amount;
                
                $three_sale->status           = 1;
                $three_sale->confirm          = 1;

                $three_sale->remark           = $remark;

                $three_sale->three_type_id      = $id;
                $three_sale->three_type_amount  = $amount;


            $three_sale->save(); 

            $this->three_type_condition = true;
        }
        //Save to ThreeSale

    }

    public function padaythar_transferThreeType($id,$remark)
    {
        $three_type         = ThreeType::find($id);

        $work_file_id       = $three_type->work_file_id;
        $user_id            = $three_type->user_id;
        $customer_id        = $three_type->customer_id;
        $slip_id            = $three_type->slip_id;
        $type               = $three_type->type;
        $result_digit       = $three_type->digit;
        $amount             = $three_type->amount;

        $break_status       = BreakAmount::where('work_file_id','=',$work_file_id)->value('status');
        $break_amount       = BreakAmount::where("work_file_id","=",$work_file_id)->value('amount');

        //testing
        $user_taken_digit_amount           = DB::table('three_sales')
                                                    ->leftJoin('users', 'users.id', '=', 'three_sales.user_id')
                                                    ->where([                                           
                                
                                                        ["three_sales.work_file_id","=",$work_file_id], 
                                                        ["three_sales.user_id","=",$user_id], 
                                                        ['three_sales.digit','=',"$result_digit"],

                                                        ["three_sales.status","=",1], 
                                                        ["three_sales.confirm","=",1],

                                                        ["users.in_out","=",1],  

                                                    ])->sum('three_sales.amount');

        $all_user_taken_digit_amount_in          = DB::table('three_sales')
                                                    ->leftJoin('users', 'users.id', '=', 'three_sales.user_id')
                                                    ->where([                                           
                                
                                                        ["three_sales.work_file_id","=",$work_file_id], 
                                                        ['three_sales.digit','=',"$result_digit"],

                                                        ["three_sales.status","=",1], 
                                                        ["three_sales.confirm","=",1],                                  

                                                        ["users.in_out","=",1],
                                                    ])->sum('three_sales.amount');

        $all_user_taken_digit_amount_out          = DB::table('three_sales')
                                                    ->leftJoin('users', 'users.id', '=', 'three_sales.user_id')
                                                    ->where([                                           
                                
                                                        ["three_sales.work_file_id","=",$work_file_id], 
                                                        ['three_sales.digit','=',"$result_digit"],

                                                        ["three_sales.status","=",1], 
                                                        ["three_sales.confirm","=",1],                                  

                                                        ["users.in_out","=",2],
                                                    ])->sum('three_sales.amount');


        $all_user_taken_digit_amount = $all_user_taken_digit_amount_in - $all_user_taken_digit_amount_out;

        
        $break_available_amount = $break_amount - $all_user_taken_digit_amount; 
        
       


        $user_taken_total_amount           = DB::table('three_sales')
                                                    ->leftJoin('users', 'users.id', '=', 'three_sales.user_id')
                                                    ->where([                                           
                                
                                                        ["three_sales.work_file_id","=",$work_file_id], 
                                                        ["three_sales.user_id","=",$user_id], 

                                                        ["three_sales.status","=",1], 
                                                        ["three_sales.confirm","=",1],                                  

                                                        ["users.in_out","=",1],

                                                    ])->sum('three_sales.amount');


        


        $one_user_total_amount       = OtherPermission::where([
                                                        ['work_file_id','=',$work_file_id], 
                                                        ['user_id','=',$user_id],

                                                    ])->value('total_amount');

        $one_user_digit_amount       = OtherPermission::where([

                                                        ['work_file_id','=',$work_file_id], 
                                                        ['user_id','=',$user_id],

                                                    ])->value('digit_amount');


        $all_user_total_amount       = OtherPermission::where([
                                                        ['work_file_id','=',$work_file_id], 
                                                        ['user_id','=',0],

                                                    ])->value('total_amount');

        $all_user_digit_amount       = OtherPermission::where([

                                                        ['work_file_id','=',$work_file_id], 
                                                        ['user_id','=',0],

                                                    ])->value('digit_amount');

        if($one_user_digit_amount)
        {   $digit_amount = $one_user_digit_amount; }
        else
        {   $digit_amount = $all_user_digit_amount; }

        if($one_user_total_amount)
        {   $total_amount = $one_user_total_amount; }
        else
        {   $total_amount = $all_user_total_amount; }

        $user_available_amount = $digit_amount - $user_taken_digit_amount;



        
        $user_avaliable_total_amount = $total_amount - $user_taken_total_amount;

        //No Total
        if($total_amount == null || $total_amount == 0)
        {
                    //Digit Amount
                   if($digit_amount != 0)
                   {

                       
                            if($amount + $user_taken_digit_amount <= $digit_amount)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {
                                $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                if($amount <= $avaliable_amount)
                                {
                                    $pay_amount = $amount;
                                }
                                else
                                {
                                    $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                    if($avaliable_amount >0)
                                    {
                                        $pay_amount = $avaliable_amount;
                                    }
                                    else
                                    {
                                         $pay_amount = 0;
                                    }                                
                                }
                            }                     
                      
                        
                   }
                   //Digit Amount
        }
        //No Total


        //Total Amount
        if($total_amount != 0)
        {
            $pay_amount = 0;

           


            if($amount + $user_taken_total_amount <= $total_amount)
            {  
                        //Digit Amount
                        if($amount + $user_taken_digit_amount <= $digit_amount)
                        {
                            $pay_amount = $amount;
                        }
                        else
                        {
                            $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                            if($amount <= $avaliable_amount)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {
                                $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                if($avaliable_amount >0)
                                {
                                    $pay_amount = $avaliable_amount;
                                }
                                else
                                {
                                     $pay_amount = 0;
                                }                                
                            }
                        }
                        //Digit Amount

            }

            //Over Total
            else
            {
                // dd("Here". ($amount + $user_avaliable_total_amount));

                 $user_avaliable_total_amount = $total_amount - $user_taken_total_amount;

                    if($amount <= $user_avaliable_total_amount)
                    {
                        //Digit Amount
                        if($amount + $user_taken_digit_amount <= $digit_amount)
                        {
                            $pay_amount = $amount;
                        }
                        else
                        {
                            $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                            if($amount <= $avaliable_amount)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {
                                $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                if($avaliable_amount >0)
                                {
                                    $pay_amount = $avaliable_amount;
                                }
                                else
                                {
                                     $pay_amount = 0;
                                }                                
                            }
                        }
                        //Digit Amount
                    }
                    else
                    {  
                        // dd("Here". ($amount + $user_avaliable_total_amount));

                        $tmp_amount = $user_avaliable_total_amount;

                        //Digit Amount
                        if($tmp_amount + $user_taken_digit_amount <= $digit_amount)
                        {
                            $pay_amount = $tmp_amount;
                        }
                        else
                        {
                            $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                            if($tmp_amount <= $avaliable_amount)
                            {
                                $pay_amount = $tmp_amount;
                            }
                            else
                            {
                                $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                if($avaliable_amount >0)
                                {
                                    $pay_amount = $avaliable_amount;
                                }
                                else
                                {
                                     $pay_amount = 0;
                                }                                
                            }
                        }
                        //Digit Amount
                    }   
            }
            //Over Total
        }

        // dd($pay_amount);


         //Save to ThreeSale
        if($pay_amount >= 0)
        {
            $three_sale = new ThreeSale();
                    
                $three_sale->work_file_id       = $work_file_id;
                $three_sale->user_id            = $user_id;  
                $three_sale->customer_id        = $customer_id; 

                $three_sale->slip_id            = $slip_id;

                $three_sale->type               = $type;
                $three_sale->digit              = $result_digit;

                $three_sale->amount             = $pay_amount;
                
                $three_sale->status             = 1;
                $three_sale->confirm            = 1;

                $three_sale->remark             = $remark;

                $three_sale->three_type_id      = $id;
                $three_sale->three_type_amount  = $amount;


            $three_sale->save(); 

            $this->three_type_condition = true;
        }
        //Save to ThreeSale



    }

    public function breakone_transferThreeType($id,$remark)
    {
        // dd("Break 1 Transfer");

        $three_type         = ThreeType::find($id);

        $work_file_id       = $three_type->work_file_id;
        $user_id            = $three_type->user_id;
        $customer_id        = $three_type->customer_id;
        $slip_id            = $three_type->slip_id;
        $type               = $three_type->type;
        $result_digit       = $three_type->digit;
        $amount             = $three_type->amount;



        $break_status       = BreakAmount::where('work_file_id','=',$work_file_id)->value('status');
        $break_amount       = BreakAmount::where("work_file_id","=",$work_file_id)->value('amount');

         

        $special_amount         = OtherPermission::where([ 
                                            ['work_file_id','=',$work_file_id], 
                                            ['user_id','=',$user_id],
                                        ])->value('special_amount');
        
        $hot_digit                  = Hot::where([                                           
                                                    ["work_file_id","=",$work_file_id],
                                                    ["digit","=",$result_digit],

                                                ])->value('digit');

        //testing
        $user_taken_digit_amount           = DB::table('three_sales')
                                                    ->leftJoin('users', 'users.id', '=', 'three_sales.user_id')
                                                    ->where([                                           
                                
                                                        ["three_sales.work_file_id","=",$work_file_id], 
                                                        ["three_sales.user_id","=",$user_id], 
                                                        ['three_sales.digit','=',"$result_digit"],

                                                        ["three_sales.status","=",1], 
                                                        ["three_sales.confirm","=",1],

                                                        ["users.in_out","=",1],  

                                                    ])->sum('three_sales.amount');

        $all_user_taken_digit_amount_in          = DB::table('three_sales')
                                                    ->leftJoin('users', 'users.id', '=', 'three_sales.user_id')
                                                    ->where([                                           
                                
                                                        ["three_sales.work_file_id","=",$work_file_id], 
                                                        ['three_sales.digit','=',"$result_digit"],

                                                        ["three_sales.status","=",1], 
                                                        ["three_sales.confirm","=",1],                                  

                                                        ["users.in_out","=",1],
                                                    ])->sum('three_sales.amount');

        $all_user_taken_digit_amount_out          = DB::table('three_sales')
                                                    ->leftJoin('users', 'users.id', '=', 'three_sales.user_id')
                                                    ->where([                                           
                                
                                                        ["three_sales.work_file_id","=",$work_file_id], 
                                                        ['three_sales.digit','=',"$result_digit"],

                                                        ["three_sales.status","=",1], 
                                                        ["three_sales.confirm","=",1],                                  

                                                        ["users.in_out","=",2],
                                                    ])->sum('three_sales.amount');


        $all_user_taken_digit_amount = $all_user_taken_digit_amount_in - $all_user_taken_digit_amount_out;

        


        // dd(" $user_taken_digit_amount / $all_user_taken_digit_amount_in / $all_user_taken_digit_amount_out / $all_user_taken_digit_amount ");

        //testing

        // $user_taken_digit_amount           = ThreeSale::where([                                           
                                
        //                                                 ["work_file_id","=",$work_file_id], 
        //                                                 ["user_id","=",$user_id], 
        //                                                 ['digit','=',"$result_digit"],

        //                                                 ["status","=",1], 
        //                                                 ["confirm","=",1],                                  
        //                                             ])->sum('amount');

        // $all_user_taken_digit_amount           = ThreeSale::where([                                           
                                
        //                                                 ["work_file_id","=",$work_file_id], 
        //                                                 ['digit','=',"$result_digit"],

        //                                                 ["status","=",1], 
        //                                                 ["confirm","=",1],                                  
        //                                             ])->sum('amount');

        $break_available_amount = $break_amount - $all_user_taken_digit_amount; 
        
        


        $user_taken_total_amount           = DB::table('three_sales')
                                                    ->leftJoin('users', 'users.id', '=', 'three_sales.user_id')
                                                    ->where([                                           
                                
                                                        ["three_sales.work_file_id","=",$work_file_id], 
                                                        ["three_sales.user_id","=",$user_id], 

                                                        ["three_sales.status","=",1], 
                                                        ["three_sales.confirm","=",1],                                  

                                                        ["users.in_out","=",1],

                                                    ])->sum('three_sales.amount');


        

        $hot_percent            = Commission::where("user_id","=","$user_id")->value('threed_hotpercent');   

        if($hot_digit == null)
        {
            $hot_percent_amount     = null;
        }
        else
        {
            $break_available_amount = $break_amount - $all_user_taken_digit_amount;  

            $hot_percent_amount     = $break_available_amount * $hot_percent/100;
        }

        
        $digit_percent = null;

        if(DigitPermission::where([ 
                                                    ['work_file_id','=',$work_file_id],
                                                    ['user_id','=',0],
                                                    ['digit','=',"$result_digit"],
                                                ])->exists())
        {
            $all_user_digit_percent          = DigitPermission::where([ 
                                                    ['work_file_id','=',$work_file_id],
                                                    ['user_id','=',0],
                                                    ['digit','=',"$result_digit"],
                                                ])->value('digit_percent');

            $digit_percent          = $all_user_digit_percent;
            // $digit_percent_amount   = $break_amount * $digit_percent/100;

            $break_available_amount = $break_amount - $all_user_taken_digit_amount;        
            $digit_percent_amount   = $break_available_amount * $digit_percent/100; 
        }        

        else if(DigitPermission::where([ 
                                                    ['work_file_id','=',$work_file_id], 
                                                    ['user_id','=',$user_id], 
                                                    ['digit','=',"$result_digit"],
                                                ])->exists())
        {
            $one_user_digit_percent          = DigitPermission::where([ 
                                                    ['work_file_id','=',$work_file_id], 
                                                    ['user_id','=',$user_id], 
                                                    ['digit','=',"$result_digit"],
                                                ])->value('digit_percent');

            $digit_percent          = $one_user_digit_percent;
            // $digit_percent_amount   = $break_amount * $digit_percent/100; 

            $break_available_amount = $break_amount - $all_user_taken_digit_amount;        
            $digit_percent_amount   = $break_available_amount * $digit_percent/100; 
        }
        else
        {
            $digit_percent          = null;
            $digit_percent_amount   = null;  
        }


        // dd($hot_percent_amount."/".$digit_percent_amount);

       


        $one_user_total_amount       = OtherPermission::where([
                                                        ['work_file_id','=',$work_file_id], 
                                                        ['user_id','=',$user_id],

                                                    ])->value('total_amount');

        $one_user_digit_amount       = OtherPermission::where([

                                                        ['work_file_id','=',$work_file_id], 
                                                        ['user_id','=',$user_id],

                                                    ])->value('digit_amount');


        $all_user_total_amount       = OtherPermission::where([
                                                        ['work_file_id','=',$work_file_id], 
                                                        ['user_id','=',0],

                                                    ])->value('total_amount');

        $all_user_digit_amount       = OtherPermission::where([

                                                        ['work_file_id','=',$work_file_id], 
                                                        ['user_id','=',0],

                                                    ])->value('digit_amount');

        if($one_user_digit_amount)
        {   $digit_amount = $one_user_digit_amount; }
        else
        {   $digit_amount = $all_user_digit_amount; }

        if($one_user_total_amount)
        {   $total_amount = $one_user_total_amount; }
        else
        {   $total_amount = $all_user_total_amount; }

        $user_available_amount = $digit_amount - $user_taken_digit_amount; 
        
        // dd(" $all_user_taken_digit_amount / $break_available_amount / $user_taken_digit_amount / $user_available_amount");


    //Special                                                                                 
    if($special_amount != null && $special_amount != 0)
    {
         $user_avaliable_total_amount = $total_amount - $user_taken_total_amount;

        // dd("$hot_percent_amount / $digit_percent_amount");

        //Hot & Digit
        if( is_numeric($hot_percent_amount) || is_numeric($digit_percent_amount))
        {
            // dd("Digit Amount = $digit_amount / Total Amount = $total_amount / Special = $special_amount ( Hot or Digit ) ");

            $available_special_amount = $special_amount - $user_taken_digit_amount;

                //No Total Amount
                if($total_amount == null || $total_amount == 0)
                {
                    

                    if($available_special_amount !=0)
                    {
                        if($amount > $available_special_amount)
                        {
                            $pay_amount = $available_special_amount;
                        }
                        else
                        {
                            $pay_amount = $amount;
                        }
                    }   
                    else
                    {
                        $pay_amount = 0;
                    } 

                }
                //No Total Amount

                //Total Amount 
                if($total_amount != 0)
                {
                    
                    $user_avaliable_total_amount = $total_amount - $user_taken_total_amount;

                    if($amount + $user_taken_total_amount <= $total_amount)
                    {
                        if($available_special_amount !=0)
                        {
                            if($amount > $available_special_amount)
                            {
                                $pay_amount = $available_special_amount;
                            }
                            else
                            {
                                $pay_amount = $amount;
                            }
                        }   
                        else
                        {
                            $pay_amount = 0;
                        }            
                       
                    }           
                       
                    else
                    {
                        if($user_avaliable_total_amount > 0)
                        {
                            if($available_special_amount !=0)
                            {
                                if($user_avaliable_total_amount > $available_special_amount)
                                {
                                    $pay_amount = $available_special_amount;
                                }
                                else
                                {
                                    $pay_amount = $user_avaliable_total_amount;
                                }
                            }
                            else
                            {
                                $pay_amount = $user_avaliable_total_amount;
                            }
                            
                        }
                        else
                        {
                            $pay_amount = 0;       
                        }
                    }
                    
                }        
                //Total Amount
        }
        else
        {

             //Total Amount
            if($total_amount != 0)
            {  
                $pay_amount = 0;

                if($amount + $user_taken_total_amount <= $total_amount)
                {
                     
                     $digit_amount = OtherPermission::where('user_id','=',$user_id)->value('digit_amount');

                     // dd($digit_amount);

                    //Digit Amount
                   if(is_numeric($digit_amount))
                   {
                        
                        // dd("Digit Amount = $digit_amount / Total Amount = $total_amount");
                        if($digit_amount > 0)
                        {

                            if($amount + $user_taken_digit_amount <= $digit_amount)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {
                                $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                if($amount <= $avaliable_amount)
                                {
                                    $pay_amount = $amount;
                                }
                                else
                                {
                                    $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                    if($avaliable_amount >0)
                                    {
                                        $pay_amount = $avaliable_amount;
                                    }
                                    else
                                    {
                                         $pay_amount = 0;
                                    }                                
                                }
                            }
                        }
                        else
                        {
                            $pay_amount = $amount;
                            
                        }

                        // dd("Digit Amount $digit_amount / Pay Amount $pay_amount ");

                   }
                   //Digit Amount
                }
                else
                {  
                    // dd("Here". ($amount + $user_avaliable_total_amount));

                    $digit_amount = OtherPermission::where('user_id','=',$user_id)->value('digit_amount');
                    
                    if(is_numeric($digit_amount))
                    {
                        $tmp_amount = $user_avaliable_total_amount;

                        if($digit_amount > 0)
                        {   

                            //Digit Amount
                            if($tmp_amount + $user_taken_digit_amount <= $digit_amount)
                            {
                                $pay_amount = $tmp_amount;
                            }
                            else
                            {
                                $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                if($tmp_amount <= $avaliable_amount)
                                {
                                    $pay_amount = $tmp_amount;
                                }
                                else
                                {
                                    $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                    if($avaliable_amount >0)
                                    {
                                        $pay_amount = $avaliable_amount;
                                    }
                                    else
                                    {
                                         $pay_amount = 0;
                                    }                                
                                }
                            }
                            //Digit Amount
                        }
                        else
                        {
                            $pay_amount = $tmp_amount;
                        }

                    }

                }

            }
            //Total Amount


            $available_special_amount = $special_amount - $user_taken_digit_amount;

            //No Total Amount
            if($total_amount == null || $total_amount == 0)
            {
                
                $digit_amount = OtherPermission::where('user_id','=',$user_id)->value('digit_amount');
                    
                if(is_numeric($digit_amount))
                {
                    if($digit_amount > 0)
                    {
                            //Digit Amount
                            if($amount + $user_taken_digit_amount <= $digit_amount)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {
                                $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                if($amount <= $avaliable_amount)
                                {
                                    $pay_amount = $amount;
                                }
                                else
                                {
                                    $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                    if($avaliable_amount >0)
                                    {
                                        $pay_amount = $avaliable_amount;
                                    }
                                    else
                                    {
                                         $pay_amount = 0;
                                    }                                
                                }
                            }
                            //Digit Amount
                    }
                    else
                    {
                        $pay_amount = $amount;
                    }
                }

            }
            //No Total Amount

             //No Hot & Digit
            // dd("Digit Amount = $digit_amount / Total Amount = $total_amount / Special = $special_amount (No Hot & Digit) ");
            //No Hot & Digit
        }
        
    }
    //Special


    //No Special
    if($special_amount == null || $special_amount == 0)
    {   
        

        if($break_status == 1)
        {
            $user_avaliable_total_amount = $total_amount - $user_taken_total_amount;

           
            //No Total
            if($total_amount == null || $total_amount == 0)
            {
                   

                    //Hot & Digit
                   if( $hot_percent_amount != null && $digit_percent_amount != null)
                   {

                       

                        $small = $hot_percent_amount < $digit_percent_amount ? $hot_percent_amount : $digit_percent_amount;
  

                        if($small < $digit_amount)
                        {
                            $digit_amount = $small;
                        }
                        else
                        {
                            $digit_amount = $digit_amount;
                        }

                      
                        if($small + $user_taken_digit_amount <= $digit_amount)
                        {
                            if($amount + $user_taken_digit_amount <= $small)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {
                                $avaliable_amount = $small - $user_taken_digit_amount;

                                if($avaliable_amount>0)
                                {
                                    $pay_amount = $avaliable_amount;
                                }
                                else
                                {
                                    $pay_amount = 0;
                                }
                            }
                            
                        }
                        else
                        {
                            $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                            if($amount <= $avaliable_amount)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {
                                $pay_amount = $avaliable_amount;
                            }

                        }

                        // dd($pay_amount);

                        
                   }
                   // dd("Hot & Digit");

                   //Digit Only
                   else if(is_numeric($digit_percent_amount))
                    {
                        
                        // dd("Digit Only $digit_percent_amount");

                        $small = $digit_percent_amount;

                        if($small < $digit_amount || $digit_amount == null)
                        {
                            $digit_amount = $small;
                        }
                        else
                        {
                            $digit_amount = $digit_amount;
                        }


                        if($small + $user_taken_digit_amount <= $digit_amount)
                        {
                            if($amount + $user_taken_digit_amount <= $small)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {
                                $avaliable_amount = $small - $user_taken_digit_amount;
                                if($avaliable_amount>0)
                                {
                                    $pay_amount = $avaliable_amount;
                                }
                                else
                                {
                                    $pay_amount = 0;
                                }
                            }
                            
                        }
                        else
                        {
                            $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                            if($amount <= $avaliable_amount)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {

                                $pay_amount = $avaliable_amount;
                            }

                        }


                        // dd("Digit Only $digit_percent_amount / Pay Amount $pay_amount ");
                        
                    }
                    // dd("Digit Only");

                    //Hot Only
                    else if(is_numeric($hot_percent_amount))
                    {
                        

                        $small = $hot_percent_amount;

                      
                        if($small < $digit_amount)
                        {
                            $digit_amount = $small;
                        }
                        else
                        {
                            $digit_amount = $digit_amount;
                        }



                        if($small + $user_taken_digit_amount <= $digit_amount)
                        {
                            if($amount + $user_taken_digit_amount <= $small)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {
                                $avaliable_amount = $small - $user_taken_digit_amount;
                                if($avaliable_amount>0)
                                {
                                    $pay_amount = $avaliable_amount;
                                }
                                else
                                {
                                    $pay_amount = 0;
                                }
                            }
                            
                        }
                        else
                        {
                            $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                            if($amount <= $avaliable_amount)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {

                                $pay_amount = $avaliable_amount;
                            }

                        }

                        // dd("Hot Only $pay_amount");
                       
                       
                    }
                    // dd("Hot Only");

                    //Digit Amount
                   else if($digit_amount != 0)
                   {
                        // dd("Digit Amount");

                       
                        if($digit_amount <= $break_available_amount)
                        {    

                            if($amount + $user_taken_digit_amount <= $digit_amount)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {
                                $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                if($amount <= $avaliable_amount)
                                {
                                    $pay_amount = $amount;
                                }
                                else
                                {
                                    $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                    if($avaliable_amount >0)
                                    {
                                        $pay_amount = $avaliable_amount;
                                    }
                                    else
                                    {
                                         $pay_amount = 0;
                                    }                                
                                }
                            }

                        }
                        else
                        {
                            if($break_available_amount >0)
                            {
                                $pay_amount = $break_available_amount;
                            }
                            else
                            {
                                $pay_amount = 0;
                            }
                         
                        }
                        // dd("Digit Amount $pay_amount");

                        
                   }
                    // dd("Digit Amount");


                   //Normal
                   else
                   {

                        // dd("Here Break One Normal  $break_available_amount ");

                        if($amount <= $break_available_amount)
                        {
                            $pay_amount = $amount;    
                        }
                        else
                        {
                            $pay_amount = $break_available_amount;
                        }    

                        

                        // if($amount <= $user_avaliable_total_amount)
                        // {
                        //     $pay_amount = $amount;    
                        // }
                        // else
                        // {
                        //     $pay_amount = $user_avaliable_total_amount;
                        // }                        
                   }
                   //Normal

            }//No Total Amount

            

            //Total Amount
            if($total_amount != 0)
            {
                
                
              


                $pay_amount = 0;

                

                if($amount + $user_taken_total_amount <= $total_amount)
                {  

                    //Hot & Digit
                   if( $hot_digit != null && $digit_percent != null)
                   {
                        $small = $hot_percent_amount < $digit_percent_amount ? $hot_percent_amount : $digit_percent_amount;

                      
                        // dd($hot_percent_amount."/".$digit_percent_amount."/".$small);

                        //No Digit Amount
                        if($digit_amount == 0)
                        {
                            if($amount + $user_taken_digit_amount <= $small)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {
                                $avaliable_amount = $small - $user_taken_digit_amount;
                                if($avaliable_amount>0)
                                {
                                    $pay_amount = $avaliable_amount;
                                }
                                else
                                {
                                    $pay_amount = 0;
                                }
                            }

                        }
                        //No Digit Amount

                        //Digit Amount
                        else
                        {  
                            if($small < $digit_amount)
                            {
                                $digit_amount = $small;
                            }

                            if($small + $user_taken_digit_amount <= $digit_amount)
                            {
                                if($amount + $user_taken_digit_amount <= $small)
                                {
                                    $pay_amount = $amount;
                                }
                                else
                                {
                                    $avaliable_amount = $small - $user_taken_digit_amount;
                                    if($avaliable_amount>0)
                                    {
                                        $pay_amount = $avaliable_amount;
                                    }
                                    else
                                    {
                                        $pay_amount = 0;
                                    }
                                }
                                
                            }
                            else
                            {
                                $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                if($amount <= $avaliable_amount)
                                {
                                    $pay_amount = $amount;
                                }
                                else
                                {

                                    $pay_amount = $avaliable_amount;
                                }
                            }

                        }
                        //Digit Amount



                        
                   }
                   // Hot & Digit

                   //Digit Only
                   else if(is_numeric($digit_percent_amount))
                    {
                       

                        $small = $digit_percent_amount;
                         
                       

                        //No Digit Amount
                        if($digit_amount == 0)
                        {
                            if($amount + $user_taken_digit_amount <= $small)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {
                                $avaliable_amount = $small - $user_taken_digit_amount;
                                if($avaliable_amount>0)
                                {
                                    $pay_amount = $avaliable_amount;
                                }
                                else
                                {
                                    $pay_amount = 0;
                                }
                            }

                        }
                        //No Digit Amount

                        //Digit Amount
                        else
                        {
                            if($small < $digit_amount)
                            {
                                $digit_amount = $small;
                            }

                            if($small + $user_taken_digit_amount <= $digit_amount)
                            {
                                if($amount + $user_taken_digit_amount <= $small)
                                {
                                    $pay_amount = $amount;
                                }
                                else
                                {
                                    $avaliable_amount = $small - $user_taken_digit_amount;
                                    if($avaliable_amount>0)
                                    {
                                        $pay_amount = $avaliable_amount;
                                    }
                                    else
                                    {
                                        $pay_amount = 0;
                                    }
                                }
                                
                            }
                            else
                            {
                                $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                if($amount <= $avaliable_amount)
                                {
                                    $pay_amount = $amount;
                                }
                                else
                                {
                                    $pay_amount = $avaliable_amount;
                                }

                            }

                        }
                        //Digit Amount

                        

                        
                    }
                    // Digit Only

                    //Hot Only
                    else if(is_numeric($hot_percent_amount))
                    {                        
                        

                        $small = $hot_percent_amount;                        

                        //No Digit Amount
                        if($digit_amount == 0)
                        {
                            if($amount + $user_taken_digit_amount <= $small)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {
                                $avaliable_amount = $small - $user_taken_digit_amount;
                                if($avaliable_amount>0)
                                {
                                    $pay_amount = $avaliable_amount;
                                }
                                else
                                {
                                    $pay_amount = 0;
                                }
                            }
                        }                        
                        //No Digit Amount

                        //Digit Amount
                        else
                        {
                                if($small < $digit_amount)
                                {
                                    $digit_amount = $small;
                                }

                                if($small + $user_taken_digit_amount <= $digit_amount)
                                {
                                    if($amount + $user_taken_digit_amount <= $small)
                                    {
                                        $pay_amount = $amount;
                                    }
                                    else
                                    {
                                        $avaliable_amount = $small - $user_taken_digit_amount;
                                        if($avaliable_amount>0)
                                        {
                                            $pay_amount = $avaliable_amount;
                                        }
                                        else
                                        {
                                            $pay_amount = 0;
                                        }
                                    }
                                    
                                }
                                else
                                {
                                    $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                    if($amount <= $avaliable_amount)
                                    {
                                        $pay_amount = $amount;
                                    }
                                    else
                                    {

                                        $pay_amount = $avaliable_amount;
                                    }

                                }
                                
                        }
                        //Digit Amount
                        


                      
                       
                    }
                    // Hot Only

                    //Digit Amount
                   else if($digit_amount != null)
                   {

                         

                      
                        $avaliable_total_amount = $total_amount - $user_taken_total_amount;


                       


                        if($amount + $user_taken_total_amount <= $avaliable_total_amount)
                        {
                            
                            $user_avaliable_amount = $digit_amount - $user_taken_digit_amount;

                            if($break_available_amount <= $user_avaliable_amount)
                            {
                                $available_amount = $break_available_amount;
                            }
                            else
                            {
                                $available_amount = $user_avaliable_amount;
                            }



                            if($amount + $user_taken_digit_amount <= $available_amount)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {
                                if($available_amount>0)
                                {
                                    $pay_amount = $available_amount;
                                }
                                else
                                {
                                    $pay_amount = 0;
                                }
                            }



                        }
                        else
                        {

                            $user_avaliable_amount = $digit_amount - $user_taken_digit_amount;

                             // dd($user_avaliable_amount);
                            
                            if($break_available_amount <= $user_avaliable_amount)
                            {
                                $available_amount = $break_available_amount;
                            }
                            else
                            {
                                $available_amount = $user_avaliable_amount;
                            }

                            if($amount <= $available_amount)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {
                                if($available_amount>0)
                                {
                                    $pay_amount = $available_amount;
                                }
                                else
                                {
                                    $pay_amount = 0;
                                }
                            }
                        }


                        // dd(" Total = $total_amount / User Taken = $user_taken_total_amount / Digit Amount = $digit_amount / Available = $avaliable_amount / Pay Amount = $pay_amount");

                        // dd("Digit Amount $pay_amount");

                        
                   }
                    // dd("Digit Amount");

                   //Normal
                   else
                   {
                        if($amount <= $user_avaliable_total_amount)
                        {
                            $pay_amount = $amount;    
                        }
                        else
                        {
                            $pay_amount = $user_avaliable_total_amount;
                        }                        
                   }
                   //Normal
                

                }//Check Total


                //Over Total
                else
                {
                    // dd("Here". ($amount + $user_avaliable_total_amount));

                     $user_avaliable_total_amount = $total_amount - $user_taken_total_amount;

                        if($amount <= $user_avaliable_total_amount)
                        {
                            //Digit Amount
                            if($amount + $user_taken_digit_amount <= $digit_amount)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {
                                $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                if($amount <= $avaliable_amount)
                                {
                                    $pay_amount = $amount;
                                }
                                else
                                {
                                    $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                    if($avaliable_amount >0)
                                    {
                                        $pay_amount = $avaliable_amount;
                                    }
                                    else
                                    {
                                         $pay_amount = 0;
                                    }                                
                                }
                            }
                            //Digit Amount
                        }
                        else
                        {  
                            // dd("Here". ($amount + $user_avaliable_total_amount));

                            $tmp_amount = $user_avaliable_total_amount;

                            //Digit Amount
                            if($tmp_amount + $user_taken_digit_amount <= $digit_amount)
                            {
                                $pay_amount = $tmp_amount;
                            }
                            else
                            {
                                $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                if($tmp_amount <= $avaliable_amount)
                                {
                                    $pay_amount = $tmp_amount;
                                }
                                else
                                {
                                    $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                    if($avaliable_amount >0)
                                    {
                                        $pay_amount = $avaliable_amount;
                                    }
                                    else
                                    {
                                         $pay_amount = 0;
                                    }                                
                                }
                            }
                            //Digit Amount
                        }   
                }
                //Over Total



            } //Total Amount

           

        } // BreakStatus = 0

            
    } //No Special


        if($pay_amount < 0)
        {
            $pay_amount = 0;
        }

        //Save to ThreeSale
        if($pay_amount >= 0)
        {
            $three_sale = new ThreeSale();
                    
                $three_sale->work_file_id       = $work_file_id;
                $three_sale->user_id            = $user_id;  
                $three_sale->customer_id        = $customer_id; 

                $three_sale->slip_id            = $slip_id;

                $three_sale->type               = $type;
                $three_sale->digit              = $result_digit;

                $three_sale->amount             = $pay_amount;
                
                $three_sale->status             = 1;
                $three_sale->confirm            = 1;

                $three_sale->remark             = $remark;

                $three_sale->three_type_id      = $id;
                $three_sale->three_type_amount  = $amount;


            $three_sale->save(); 

            $this->three_type_condition = true;
        }
        //Save to ThreeSale


        
    }

    public function breakzero_transferThreeType($id,$remark)
    {
        // dd("Break 0 Transfer");

        $three_type         = ThreeType::find($id);

        $work_file_id       = $three_type->work_file_id;
        $user_id            = $three_type->user_id;
        $customer_id        = $three_type->customer_id;
        $slip_id            = $three_type->slip_id;
        $type               = $three_type->type;
        $result_digit       = $three_type->digit;
        $amount             = $three_type->amount;

        $break_status       = BreakAmount::where('work_file_id','=',$work_file_id)->value('status');
        $break_amount       = BreakAmount::where("work_file_id","=",$work_file_id)->value('amount');

        $special_amount         = OtherPermission::where([ 
                                            ['work_file_id','=',$work_file_id], 
                                            ['user_id','=',$user_id],
                                        ])->value('special_amount');
        
        $hot_digit                  = Hot::where([                                           
                                                    ["work_file_id","=",$work_file_id],
                                                    ["digit","=",$result_digit],

                                                ])->value('digit');

        $user_taken_digit_amount           = ThreeSale::where([                                           
                                
                                                        ["work_file_id","=",$work_file_id], 
                                                        ["user_id","=",$user_id], 
                                                        ['digit','=',"$result_digit"],

                                                        ["status","=",1], 
                                                        ["confirm","=",1],                                  
                                                    ])->sum('amount');

        $all_user_taken_digit_amount           = ThreeSale::where([                                           
                                
                                                        ["work_file_id","=",$work_file_id], 
                                                        ['digit','=',"$result_digit"],

                                                        ["status","=",1], 
                                                        ["confirm","=",1],                                  
                                                    ])->sum('amount');

        $user_taken_total_amount           = ThreeSale::where([                                           
                                
                                                        ["work_file_id","=",$work_file_id], 
                                                        ["user_id","=",$user_id], 

                                                        ["status","=",1], 
                                                        ["confirm","=",1],                                  
                                                    ])->sum('amount');




        $hot_percent            = Commission::where("user_id","=","$user_id")->value('threed_hotpercent');   

        if($hot_digit == null)
        {
            $hot_percent_amount     = null;
        }
        else
        {
            $hot_percent_amount     = $break_amount * $hot_percent/100;
        }

        
        $digit_percent = null;

        if(DigitPermission::where([ 
                                                    ['work_file_id','=',$work_file_id],
                                                    ['user_id','=',0],
                                                    ['digit','=',"$result_digit"],
                                                ])->exists())
        {
            $all_user_digit_percent          = DigitPermission::where([ 
                                                    ['work_file_id','=',$work_file_id],
                                                    ['user_id','=',0],
                                                    ['digit','=',"$result_digit"],
                                                ])->value('digit_percent');

            $digit_percent          = $all_user_digit_percent;
            $digit_percent_amount   = $break_amount * $digit_percent/100;

        }        

        else if(DigitPermission::where([ 
                                                    ['work_file_id','=',$work_file_id], 
                                                    ['user_id','=',$user_id], 
                                                    ['digit','=',"$result_digit"],
                                                ])->exists())
        {
            $one_user_digit_percent          = DigitPermission::where([ 
                                                    ['work_file_id','=',$work_file_id], 
                                                    ['user_id','=',$user_id], 
                                                    ['digit','=',"$result_digit"],
                                                ])->value('digit_percent');

            $digit_percent          = $one_user_digit_percent;
            $digit_percent_amount   = $break_amount * $digit_percent/100;         

        }
        else
        {
            $digit_percent          = null;
            $digit_percent_amount   = null;  
        }


        // dd($hot_percent_amount."/".$digit_percent_amount);

       


        $one_user_total_amount       = OtherPermission::where([
                                                        ['work_file_id','=',$work_file_id], 
                                                        ['user_id','=',$user_id],

                                                    ])->value('total_amount');

        $one_user_digit_amount       = OtherPermission::where([

                                                        ['work_file_id','=',$work_file_id], 
                                                        ['user_id','=',$user_id],

                                                    ])->value('digit_amount');


        $all_user_total_amount       = OtherPermission::where([
                                                        ['work_file_id','=',$work_file_id], 
                                                        ['user_id','=',0],

                                                    ])->value('total_amount');

        $all_user_digit_amount       = OtherPermission::where([

                                                        ['work_file_id','=',$work_file_id], 
                                                        ['user_id','=',0],

                                                    ])->value('digit_amount');

        if($one_user_digit_amount)
        {   $digit_amount = $one_user_digit_amount; }
        else
        {   $digit_amount = $all_user_digit_amount; }

        if($one_user_total_amount)
        {   $total_amount = $one_user_total_amount; }
        else
        {   $total_amount = $all_user_total_amount; }



     //Special                                                                                 
    if($special_amount != null && $special_amount != 0)
    {
         $user_avaliable_total_amount = $total_amount - $user_taken_total_amount;

        // dd("$hot_percent_amount / $digit_percent_amount");

        //Hot & Digit
        if( is_numeric($hot_percent_amount) || is_numeric($digit_percent_amount))
        {
            // dd("Digit Amount = $digit_amount / Total Amount = $total_amount / Special = $special_amount ( Hot or Digit ) ");

            $available_special_amount = $special_amount - $user_taken_digit_amount;

                //No Total Amount
                if($total_amount == null || $total_amount == 0)
                {
                    

                    if($available_special_amount !=0)
                    {
                        if($amount > $available_special_amount)
                        {
                            $pay_amount = $available_special_amount;
                        }
                        else
                        {
                            $pay_amount = $amount;
                        }
                    }   
                    else
                    {
                        $pay_amount = 0;
                    } 

                }
                //No Total Amount

                //Total Amount 
                if($total_amount != 0)
                {
                    
                    $user_avaliable_total_amount = $total_amount - $user_taken_total_amount;

                    if($amount + $user_taken_total_amount <= $total_amount)
                    {
                        if($available_special_amount !=0)
                        {
                            if($amount > $available_special_amount)
                            {
                                $pay_amount = $available_special_amount;
                            }
                            else
                            {
                                $pay_amount = $amount;
                            }
                        }   
                        else
                        {
                            $pay_amount = 0;
                        }            
                       
                    }           
                       
                    else
                    {
                        if($user_avaliable_total_amount > 0)
                        {
                            if($available_special_amount !=0)
                            {
                                if($user_avaliable_total_amount > $available_special_amount)
                                {
                                    $pay_amount = $available_special_amount;
                                }
                                else
                                {
                                    $pay_amount = $user_avaliable_total_amount;
                                }
                            }
                            else
                            {
                                $pay_amount = $user_avaliable_total_amount;
                            }
                            
                        }
                        else
                        {
                            $pay_amount = 0;       
                        }
                    }
                    
                }        
                //Total Amount
        }
        else
        {


            //Total Amount
            if($total_amount != 0)
            {  
                $pay_amount = 0;

                if($amount + $user_taken_total_amount <= $total_amount)
                {
                     
                     $digit_amount = OtherPermission::where('user_id','=',$user_id)->value('digit_amount');

                     // dd($digit_amount);

                    //Digit Amount
                   if(is_numeric($digit_amount))
                   {
                        
                        // dd("Digit Amount = $digit_amount / Total Amount = $total_amount");
                        if($digit_amount > 0)
                        {

                            if($amount + $user_taken_digit_amount <= $digit_amount)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {
                                $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                if($amount <= $avaliable_amount)
                                {
                                    $pay_amount = $amount;
                                }
                                else
                                {
                                    $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                    if($avaliable_amount >0)
                                    {
                                        $pay_amount = $avaliable_amount;
                                    }
                                    else
                                    {
                                         $pay_amount = 0;
                                    }                                
                                }
                            }
                        }
                        else
                        {
                            $pay_amount = $amount;
                            
                        }

                        // dd("Digit Amount $digit_amount / Pay Amount $pay_amount ");

                   }
                   //Digit Amount
                }
                else
                {  
                    // dd("Here". ($amount + $user_avaliable_total_amount));

                    $digit_amount = OtherPermission::where('user_id','=',$user_id)->value('digit_amount');
                    
                    if(is_numeric($digit_amount))
                    {
                        $tmp_amount = $user_avaliable_total_amount;

                        if($digit_amount > 0)
                        {   

                            //Digit Amount
                            if($tmp_amount + $user_taken_digit_amount <= $digit_amount)
                            {
                                $pay_amount = $tmp_amount;
                            }
                            else
                            {
                                $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                if($tmp_amount <= $avaliable_amount)
                                {
                                    $pay_amount = $tmp_amount;
                                }
                                else
                                {
                                    $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                    if($avaliable_amount >0)
                                    {
                                        $pay_amount = $avaliable_amount;
                                    }
                                    else
                                    {
                                         $pay_amount = 0;
                                    }                                
                                }
                            }
                            //Digit Amount
                        }
                        else
                        {
                            $pay_amount = $tmp_amount;
                        }

                    }

                }

            }
            //Total Amount


            $available_special_amount = $special_amount - $user_taken_digit_amount;

            //No Total Amount
            if($total_amount == null || $total_amount == 0)
            {
                
                $digit_amount = OtherPermission::where('user_id','=',$user_id)->value('digit_amount');
                    
                if(is_numeric($digit_amount))
                {
                    if($digit_amount > 0)
                    {
                            //Digit Amount
                            if($amount + $user_taken_digit_amount <= $digit_amount)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {
                                $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                if($amount <= $avaliable_amount)
                                {
                                    $pay_amount = $amount;
                                }
                                else
                                {
                                    $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                    if($avaliable_amount >0)
                                    {
                                        $pay_amount = $avaliable_amount;
                                    }
                                    else
                                    {
                                         $pay_amount = 0;
                                    }                                
                                }
                            }
                            //Digit Amount
                    }
                    else
                    {
                        $pay_amount = $amount;
                    }
                }

            }
            //No Total Amount

             //No Hot & Digit
            // dd("Digit Amount = $digit_amount / Total Amount = $total_amount / Special = $special_amount (No Hot & Digit) ");
            //No Hot & Digit
        }

       

        
        
    }
    //Special





    //No Special
    if($special_amount == null || $special_amount == 0)
    {   
        
        if($break_status == 0)
        {
            $user_avaliable_total_amount = $total_amount - $user_taken_total_amount;



            //No Total Amount
            if($total_amount == null || $total_amount == 0)
            {
                    
                 

                    //Hot & Digit
                   if( $hot_percent_amount != null && $digit_percent_amount != null)
                   {

                        
                        $small = $hot_percent_amount < $digit_percent_amount ? $hot_percent_amount : $digit_percent_amount;


                        if($small < $digit_amount)
                        {
                            $digit_amount = $small;
                        }
                        else
                        {
                            $digit_amount = $digit_amount;
                        }

                        if($small + $user_taken_digit_amount <= $digit_amount)
                        {
                            if($amount + $user_taken_digit_amount <= $small)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {
                                $avaliable_amount = $small - $user_taken_digit_amount;
                                if($avaliable_amount>0)
                                {
                                    $pay_amount = $avaliable_amount;
                                }
                                else
                                {
                                    $pay_amount = 0;
                                }
                            }
                            
                        }
                        else
                        {
                            $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                            if($amount <= $avaliable_amount)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {

                                $pay_amount = $avaliable_amount;
                            }

                        }

                        
                   }
                   // dd("Hot & Digit");

                   //Digit Only
                   else if(is_numeric($digit_percent_amount))
                    {
                        
                         // dd("Digit Only $digit_percent_amount");

                        $small = $digit_percent_amount;

                        if($small < $digit_amount)
                        {
                            $digit_amount = $small;
                        }
                        else
                        {
                            $digit_amount = $digit_amount;
                        }


                        if($small + $user_taken_digit_amount <= $digit_amount)
                        {
                            if($amount + $user_taken_digit_amount <= $small)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {
                                $avaliable_amount = $small - $user_taken_digit_amount;
                                if($avaliable_amount>0)
                                {
                                    $pay_amount = $avaliable_amount;
                                }
                                else
                                {
                                    $pay_amount = 0;
                                }
                            }
                            
                        }
                        else
                        {
                            $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                            if($amount <= $avaliable_amount)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {

                                $pay_amount = $avaliable_amount;
                            }

                        }

                        
                    }
                    // dd("Digit Only");

                    //Hot Only
                    else if(is_numeric($hot_percent_amount))
                    {
                        // dd("Hot Only $hot_percent_amount");

                        $small = $hot_percent_amount;

                      
                        if($small < $digit_amount)
                        {
                            $digit_amount = $small;
                        }
                        else
                        {
                            $digit_amount = $digit_amount;
                        }

                        if($small + $user_taken_digit_amount <= $digit_amount)
                        {
                            if($amount + $user_taken_digit_amount <= $small)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {
                                $avaliable_amount = $small - $user_taken_digit_amount;
                                if($avaliable_amount>0)
                                {
                                    $pay_amount = $avaliable_amount;
                                }
                                else
                                {
                                    $pay_amount = 0;
                                }
                            }
                            
                        }
                        else
                        {
                            $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                            if($amount <= $avaliable_amount)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {

                                $pay_amount = $avaliable_amount;
                            }

                        }
                       
                       
                    }
                    // dd("Hot Only");

                    //Digit Amount
                   else if($digit_amount != 0)
                   {
                         


                            if($amount + $user_taken_digit_amount <= $digit_amount)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {
                                $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                if($amount <= $avaliable_amount)
                                {
                                    $pay_amount = $amount;
                                }
                                else
                                {
                                    $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                    if($avaliable_amount >0)
                                    {
                                        $pay_amount = $avaliable_amount;
                                    }
                                    else
                                    {
                                         $pay_amount = 0;
                                    }                                
                                }
                            }

                        
                   }
                    // dd("Digit Amount");


                   //Normal
                   else
                   {    
                      
                        // dd("Here Break Zero Normal ");
                        $pay_amount = $amount;

                        // if($amount <= $user_avaliable_total_amount)
                        // {
                        //     $pay_amount = $amount;    
                        // }
                        // else
                        // {
                        //     $pay_amount = $user_avaliable_total_amount;
                        // }                        
                   }
                   //Normal



            }//No Total Amount

            //Total Amount
            if($total_amount != 0)
            {
                
      
                $pay_amount = 0;

                if($amount + $user_taken_total_amount <= $total_amount)
                {
                    

                    //Hot & Digit
                   if( $hot_digit != null && $digit_percent != null)
                   {
                        $small = $hot_percent_amount < $digit_percent_amount ? $hot_percent_amount : $digit_percent_amount;

                      
                        // dd($hot_percent_amount."/".$digit_percent_amount."/".$small);

                        //No Digit Amount
                        if($digit_amount == 0)
                        {
                            if($amount + $user_taken_digit_amount <= $small)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {
                                $avaliable_amount = $small - $user_taken_digit_amount;
                                if($avaliable_amount>0)
                                {
                                    $pay_amount = $avaliable_amount;
                                }
                                else
                                {
                                    $pay_amount = 0;
                                }
                            }

                        }
                        //No Digit Amount

                        //Digit Amount
                        else
                        {  
                            if($small < $digit_amount)
                            {
                                $digit_amount = $small;
                            }

                            if($small + $user_taken_digit_amount <= $digit_amount)
                            {
                                if($amount + $user_taken_digit_amount <= $small)
                                {
                                    $pay_amount = $amount;
                                }
                                else
                                {
                                    $avaliable_amount = $small - $user_taken_digit_amount;
                                    if($avaliable_amount>0)
                                    {
                                        $pay_amount = $avaliable_amount;
                                    }
                                    else
                                    {
                                        $pay_amount = 0;
                                    }
                                }
                                
                            }
                            else
                            {
                                $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                if($amount <= $avaliable_amount)
                                {
                                    $pay_amount = $amount;
                                }
                                else
                                {

                                    $pay_amount = $avaliable_amount;
                                }
                            }

                        }
                        //Digit Amount



                        
                   }
                   // Hot & Digit

                   //Digit Only
                   else if(is_numeric($digit_percent_amount))
                    {
                       

                        $small = $digit_percent_amount;
                         
                        

                        //No Digit Amount
                        if($digit_amount == 0)
                        {
                            if($amount + $user_taken_digit_amount <= $small)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {
                                $avaliable_amount = $small - $user_taken_digit_amount;
                                if($avaliable_amount>0)
                                {
                                    $pay_amount = $avaliable_amount;
                                }
                                else
                                {
                                    $pay_amount = 0;
                                }
                            }

                        }
                        //No Digit Amount

                        //Digit Amount
                        else
                        {
                            if($small < $digit_amount)
                            {
                                $digit_amount = $small;
                            }

                            if($small + $user_taken_digit_amount <= $digit_amount)
                            {
                                if($amount + $user_taken_digit_amount <= $small)
                                {
                                    $pay_amount = $amount;
                                }
                                else
                                {
                                    $avaliable_amount = $small - $user_taken_digit_amount;
                                    if($avaliable_amount>0)
                                    {
                                        $pay_amount = $avaliable_amount;
                                    }
                                    else
                                    {
                                        $pay_amount = 0;
                                    }
                                }
                                
                            }
                            else
                            {
                                $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                if($amount <= $avaliable_amount)
                                {
                                    $pay_amount = $amount;
                                }
                                else
                                {
                                    $pay_amount = $avaliable_amount;
                                }

                            }

                        }
                        //Digit Amount

                        

                        
                    }
                    // Digit Only

                    //Hot Only
                    else if(is_numeric($hot_percent_amount))
                    {                        
                        

                        $small = $hot_percent_amount;                        

                        //No Digit Amount
                        if($digit_amount == 0)
                        {
                            if($amount + $user_taken_digit_amount <= $small)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {
                                $avaliable_amount = $small - $user_taken_digit_amount;
                                if($avaliable_amount>0)
                                {
                                    $pay_amount = $avaliable_amount;
                                }
                                else
                                {
                                    $pay_amount = 0;
                                }
                            }
                        }                        
                        //No Digit Amount

                        //Digit Amount
                        else
                        {
                                if($small < $digit_amount)
                                {
                                    $digit_amount = $small;
                                }

                                if($small + $user_taken_digit_amount <= $digit_amount)
                                {
                                    if($amount + $user_taken_digit_amount <= $small)
                                    {
                                        $pay_amount = $amount;
                                    }
                                    else
                                    {
                                        $avaliable_amount = $small - $user_taken_digit_amount;
                                        if($avaliable_amount>0)
                                        {
                                            $pay_amount = $avaliable_amount;
                                        }
                                        else
                                        {
                                            $pay_amount = 0;
                                        }
                                    }
                                    
                                }
                                else
                                {
                                    $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                    if($amount <= $avaliable_amount)
                                    {
                                        $pay_amount = $amount;
                                    }
                                    else
                                    {

                                        $pay_amount = $avaliable_amount;
                                    }

                                }
                                
                        }
                        //Digit Amount
                        


                      
                       
                    }
                    // Hot Only

                    //Digit Amount
                   else if($digit_amount != null)
                   {
                        

                            if($amount + $user_taken_digit_amount <= $digit_amount)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {
                                $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                if($amount <= $avaliable_amount)
                                {
                                    $pay_amount = $amount;
                                }
                                else
                                {
                                    $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                    if($avaliable_amount >0)
                                    {
                                        $pay_amount = $avaliable_amount;
                                    }
                                    else
                                    {
                                         $pay_amount = 0;
                                    }                                
                                }
                            }

                        
                   }
                    // dd("Digit Amount");

                   //Normal
                   else
                   {
                        if($amount <= $user_avaliable_total_amount)
                        {
                            $pay_amount = $amount;    
                        }
                        else
                        {
                            $pay_amount = $user_avaliable_total_amount;
                        }                        
                   }
                   //Normal
                

                }//Check Total


                //Over Total
                else
                {
                    // dd("Here". ($amount + $user_avaliable_total_amount));

                     $user_avaliable_total_amount = $total_amount - $user_taken_total_amount;

                        if($amount <= $user_avaliable_total_amount)
                        {
                            //Digit Amount
                            if($amount + $user_taken_digit_amount <= $digit_amount)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {
                                $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                if($amount <= $avaliable_amount)
                                {
                                    $pay_amount = $amount;
                                }
                                else
                                {
                                    $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                    if($avaliable_amount >0)
                                    {
                                        $pay_amount = $avaliable_amount;
                                    }
                                    else
                                    {
                                         $pay_amount = 0;
                                    }                                
                                }
                            }
                            //Digit Amount
                        }
                        else
                        {  
                            // dd("Here". ($amount + $user_avaliable_total_amount));

                            $tmp_amount = $user_avaliable_total_amount;

                            //Digit Amount
                            if($tmp_amount + $user_taken_digit_amount <= $digit_amount)
                            {
                                $pay_amount = $tmp_amount;
                            }
                            else
                            {
                                $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                if($tmp_amount <= $avaliable_amount)
                                {
                                    $pay_amount = $tmp_amount;
                                }
                                else
                                {
                                    $avaliable_amount = $digit_amount - $user_taken_digit_amount;

                                    if($avaliable_amount >0)
                                    {
                                        $pay_amount = $avaliable_amount;
                                    }
                                    else
                                    {
                                         $pay_amount = 0;
                                    }                                
                                }
                            }
                            //Digit Amount
                        }   
                }
                //Over Total



            } //Total Amount

           

        } // BreakStatus = 0

            
    } //No Special


        //Save to ThreeSale
        if($pay_amount >= 0)
        {
            $three_sale = new ThreeSale();
                    
                $three_sale->work_file_id     = $work_file_id;
                $three_sale->user_id          = $user_id;  
                $three_sale->customer_id      = $customer_id; 

                $three_sale->slip_id          = $slip_id;

                $three_sale->type             = $type;
                $three_sale->digit            = $result_digit;

                $three_sale->amount           = $pay_amount;
                
                $three_sale->status           = 1;
                $three_sale->confirm          = 1;

                $three_sale->remark           = $remark;

                $three_sale->three_type_id      = $id;
                $three_sale->three_type_amount  = $amount;


            $three_sale->save(); 

            $this->three_type_condition = true;
        }
        //Save to ThreeSale

    }

    public function checkThreeType($id,$remark)
    {

        $three_type         = ThreeType::find($id);


        $work_file_id       = $three_type->work_file_id;
        $user_id            = $three_type->user_id;
        $customer_id        = $three_type->customer_id;
        $slip_id            = $three_type->slip_id;
        $type               = $three_type->type;
        $result_digit       = $three_type->digit;
        $amount             = $three_type->amount;



        $three_hotpercent           = Commission::where([  ["user_id","=","$user_id"], ])
                                                ->value('threed_hotpercent');

       

        $break_amount               = BreakAmount::where([ ["work_file_id","=",$work_file_id], ])
                                                ->value('amount');

        $keep_break                 = BreakAmount::where('work_file_id','=',$work_file_id)
                                                ->orderBy('id','desc')
                                                ->take(1)
                                                ->value('status');        

        $digit_amount               = OtherPermission::where([

                                                    ['work_file_id','=',$work_file_id], 
                                                    ['user_id','=',0],

                                                    ])->value('digit_amount');

        

        $one_total_amount           = ThreeSale::where([                                           
                                
                                                        ["work_file_id","=",$work_file_id], 
                                                        ["user_id","=",$user_id],                                   
                                                        ["status","=",1],                                   
                                                    ])
                                                ->sum('amount');


       

        $hot_digit                  = Hot::where([                                           
                                                    ["work_file_id","=",$work_file_id],                    
                                                    ["digit","=",$result_digit],

                                                ])->value('digit');
                       
        

        $break_status               = BreakAmount::where('work_file_id','=',$work_file_id)
                                                ->orderBy('id','desc')
                                                ->take(1)
                                                ->value('status');

        $one_digit_amount           = OtherPermission::where([

                                                            ['work_file_id','=',$work_file_id], 
                                                            ['user_id','=',$user_id],

                                                    ])->value('digit_amount');


            $one_permit_total_amount    = OtherPermission::where([    

                                                                ['work_file_id','=',$work_file_id], 
                                                                ['user_id','=',$user_id],

                                                        ])->value('total_amount');

          $one_available_total_amount = $one_permit_total_amount - $one_total_amount;   

            if($one_digit_amount)
            {
                $digit_amount = $one_digit_amount;
            }


          
            //Special Amount
            if(OtherPermission::where([ 
                                        ['work_file_id','=',$work_file_id], 
                                        ['user_id','=',$user_id],
                                        
                                    ])->value('special_amount'))
            {
                $this->SpecialAmount($work_file_id,$user_id,$customer_id,$slip_id,$type,$result_digit,$amount,$id,$remark);
            }
            //Special Amount


            //Other Permission
            

            // else if($one_digit_amount || $one_permit_total_amount )
            // {
            //     
            // }

            //End Other Permission

           

            //DigitAmount
            else if(    DigitPermission::where([    ['work_file_id','=',$work_file_id], 
                                                    ['user_id','=',$user_id], 
                                                    ['digit','=',$result_digit], 

                                            ])->exists() ||

                        DigitPermission::where([    ['work_file_id','=',$work_file_id], 
                                                    ['user_id','=',0], 
                                                    ['digit','=',$result_digit], 

                                            ])->exists() || 
                        $digit_amount || $one_permit_total_amount || $hot_digit)
            {
               

                $this->DigitAmount($work_file_id,$user_id,$customer_id,$slip_id,$type,$result_digit,$amount,$digit_amount,$one_available_total_amount,$one_total_amount,$hot_digit,$id,$remark);
            }

            //DigitAmount

            else if($break_status == 0)
            {
                $three_sale = new ThreeSale();
                            
                    $three_sale->work_file_id     = $work_file_id;
                    $three_sale->user_id          = $user_id;  
                    $three_sale->customer_id      = $customer_id; 

                    $three_sale->slip_id          = $slip_id;

                    $three_sale->type             = $type;
                    $three_sale->digit            = $result_digit;

                    $three_sale->amount           = $amount;
                    
                    $three_sale->status           = 1;
                    $three_sale->confirm          = 1;

                    $three_sale->remark           = $remark;

                    $three_sale->three_type_id      = $id;
                    $three_sale->three_type_amount  = $amount;

                $three_sale->save(); 

                $this->three_type_condition = true;

            }

            else if($break_status == 1)
            {
                $digit_all_user_total_amount     = ThreeSale::where([                                           
                                    
                                    ["work_file_id","=",$work_file_id],
                                    ["digit","=","$result_digit"],

                                    ["status","=",1],
                                   
                                ])
                            ->sum('amount');

                $break_amount = BreakAmount::where('work_file_id','=',$work_file_id)
                                                ->orderBy('id','desc')
                                                ->take(1)
                                                ->value('amount');

                $break_available_amount = $break_amount - $digit_all_user_total_amount;   

                if( $amount <= $break_available_amount)
                {                    
                    $pay_amount = $amount;
                }
                else
                {
                    if($break_available_amount > 0)
                    {
                        $pay_amount = $break_available_amount;
                    }
                    else
                    {
                        $pay_amount = 0;       
                    }
                }
             

              
               
                if($pay_amount >= 0)
                {
                    $three_sale = new ThreeSale();
                            
                        $three_sale->work_file_id     = $work_file_id;
                        $three_sale->user_id          = $user_id;  
                        $three_sale->customer_id      = $customer_id; 

                        $three_sale->slip_id          = $slip_id;

                        $three_sale->type             = $type;
                        $three_sale->digit            = $result_digit;

                        $three_sale->amount           = $pay_amount;
                        
                        $three_sale->status           = 1;
                        $three_sale->confirm          = 1;

                        $three_sale->remark           = $remark;

                        $three_sale->three_type_id      = $id;
                        $three_sale->three_type_amount  = $amount;


                    $three_sale->save(); 

                    $this->three_type_condition = true;
                }
              


            }


    }

    public function DigitAmount($work_file_id,$user_id,$customer_id,$slip_id,$type,$result_digit,$amount,$digit_amount,$one_available_total_amount,$one_total_amount,$hot_digit,$id,$remark)
    {

       

        $type_sale = DigitPermission::where([ 
                                                    ['work_file_id','=',$work_file_id], 
                                                    ['user_id','=',$user_id],
                                                    ['digit','=',$result_digit],
                                                ])
                                                ->orderBy('id','desc')
                                                ->take(1)
                                                ->value('type_sale');

      
        $digit_percent = DigitPermission::where([ 
                                                    ['work_file_id','=',$work_file_id], 
                                                    ['user_id','=',$user_id], 
                                                    ['digit','=',"$result_digit"],
                                                ])
                                        ->orderBy('id','desc')
                                        ->take(1)
                                        ->value('digit_percent');
        
       

        // dd($digit_percent);


        // $digit_amount = $digit_amount;

        //last edit
        if($digit_amount == null)
        {
            $digit_amount = 0;
        }
        //last edit

        
          

       

                $break_status = BreakAmount::where('work_file_id','=',$work_file_id)
                                        ->orderBy('id','desc')
                                        ->take(1)
                                        ->value('status');

                $break_amount = BreakAmount::where('work_file_id','=',$work_file_id)
                                                ->orderBy('id','desc')
                                                ->take(1)
                                                ->value('amount');


                $total_amount     = ThreeSale::where([                                           
                                    
                                    ["work_file_id","=",$work_file_id],
                                    ["digit","=","$result_digit"],

                                    ["status","=",1],
                                   
                                ])
                            ->sum('amount');


                $one_total_amount     = ThreeSale::where([                                           
                                    
                                    ["work_file_id","=",$work_file_id],
                                    ["user_id","=",$user_id],
                                    ["digit","=","$result_digit"],

                                    ["status","=",1],
                                   
                                ])
                            ->sum('amount');

                 

                if($digit_amount != 0)
                {
                    $total_amount     = ThreeSale::where([                                           
                                    
                                    ["work_file_id","=",$work_file_id],
                                    ["user_id","=",$user_id],
                                    ["digit","=","$result_digit"],
                                    ["status","=",1],
                                   
                                ])
                            ->sum('amount');

                    $avaliable_amount = $digit_amount - $total_amount;

                    if($break_status == 0)
                    {
                            if($amount <= $avaliable_amount)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {
                                if($avaliable_amount > 0)
                                {
                                    $pay_amount = $avaliable_amount;
                                }
                                else
                                {
                                    $pay_amount = 0;
                                }
                            }
                    }

                    if($break_status == 1)
                    {
                       

                            if($total_amount < $digit_amount)
                            {
                                 $all_total_amount     = ThreeSale::where([                                           
                                    
                                    ["work_file_id","=",$work_file_id],                                   
                                    ["digit","=","$result_digit"],
                                    ["status","=",1],
                                   
                                ])
                            ->sum('amount');
                            }

                            $all_avaliable_amount = $break_amount - $all_total_amount;

                             

                            if($avaliable_amount <= $all_avaliable_amount)
                            {
                                if($amount <= $avaliable_amount)
                                 { $pay_amount = $amount; }
                                else
                                { $pay_amount = $avaliable_amount; }
                            }
                            else
                            {
                                if($all_avaliable_amount > 0)
                                {
                                    $pay_amount = $all_avaliable_amount;
                                }
                                else
                                {
                                    $pay_amount = 0;
                                }
                            }

                            // dd("$pay_amount Here $avaliable_amount");

                    }

                    

                    if($pay_amount >= 0)
                        {
                            $three_sale = new ThreeSale();
                            
                            $three_sale->work_file_id     = $work_file_id;
                            $three_sale->user_id          = $user_id;  
                            $three_sale->customer_id      = $customer_id; 

                            $three_sale->slip_id          = $slip_id;

                            $three_sale->type             = $type;
                            $three_sale->digit            = $result_digit;

                            $three_sale->amount           = $pay_amount;
                            
                            $three_sale->status           = 1;
                            $three_sale->confirm          = 1;

                            $three_sale->remark           = $remark;

                            $three_sale->three_type_id      = $id;
                            $three_sale->three_type_amount  = $amount;

                            $three_sale->save(); 

                            $this->three_type_condition = true;
                        }
                }






                if($break_status == 0 && $digit_percent != null)
                {
                     
                    
                    
                    $total_amount     = ThreeSale::where([                                           
                                    
                                    ["work_file_id","=",$work_file_id],
                                    ["user_id","=",$user_id],
                                    ["digit","=","$result_digit"],

                                    ["status","=",1],
                                   
                                ])
                            ->sum('amount');


                    

                    $avaliable_amount = $digit_amount - $total_amount;

                    $percent_amount = $amount * $digit_percent /100;

                    if($percent_amount <= $avaliable_amount)
                    {
                        $pay_amount = $percent_amount;
                    }
                    else
                    {
                        if($avaliable_amount > 0)
                        {
                            $pay_amount = $avaliable_amount;
                        }
                        else
                        {
                            $pay_amount = 0;
                        }
                    }

                    // dd($pay_amount == 0);

                    //last edit
                    if($pay_amount == 0)
                    {
                            $three_sale = new ThreeSale();
                            
                            $three_sale->work_file_id     = $work_file_id;
                            $three_sale->user_id          = $user_id;  
                            $three_sale->customer_id      = $customer_id; 

                            $three_sale->slip_id          = $slip_id;

                            $three_sale->type             = $type;
                            $three_sale->digit            = $result_digit;

                            $three_sale->amount           = $pay_amount;
                            
                            $three_sale->status           = 1;
                            $three_sale->confirm          = 1;

                            $three_sale->remark           = $remark;

                            $three_sale->three_type_id      = $id;
                            $three_sale->three_type_amount  = $amount;

                            $three_sale->save(); 

                            $this->three_type_condition = true;
                    }
                    //last edit

                    //Insert DB
                    if($pay_amount > 0 )
                    {
                        if($pay_amount <= $one_available_total_amount)
                        {
                            $pay_amount = $pay_amount;
                        }
                        else
                        {
                            $pay_amount = $one_available_total_amount;
                        }

                        if($pay_amount > 0)
                        {
                            $three_sale = new ThreeSale();
                            
                            $three_sale->work_file_id     = $work_file_id;
                            $three_sale->user_id          = $user_id;  
                            $three_sale->customer_id      = $customer_id; 

                            $three_sale->slip_id          = $slip_id;

                            $three_sale->type             = $type;
                            $three_sale->digit            = $result_digit;

                            $three_sale->amount           = $pay_amount;
                            
                            $three_sale->status           = 1;
                            $three_sale->confirm          = 1;

                            $three_sale->remark           = $remark;

                            $three_sale->three_type_id      = $id;
                            $three_sale->three_type_amount  = $amount;

                            $three_sale->save(); 

                            $this->three_type_condition = true;
                        }
                         
                    }
                    //End Insert DB
           
                }

                else if($break_status == 1 && $digit_percent !=null)
                {
                    
                    $avaliable_amount = $break_amount - $total_amount;

                    $percent_amount = $amount * $digit_percent /100;

                    if($avaliable_amount >= $digit_amount)
                    {
                        if($percent_amount <= $digit_amount)
                        {
                            $pay_amount = $percent_amount;
                        }
                        else
                        {
                            $pay_amount = $digit_amount;
                        }
                    }
                    else
                    {
                        if($avaliable_amount >= $percent_amount)
                        {
                            $pay_amount = $percent_amount;
                        }
                        else
                        {
                            if($avaliable_amount > 0)
                            {
                                $pay_amount = $avaliable_amount * $digit_percent/100;
                            }
                            else
                            {
                                $pay_amount = 0;
                            }
                        }
                    }
                    
                                   

                    //Insert DB
                    if($pay_amount > 0 )
                    {
                         if($pay_amount <= $one_available_total_amount)
                        {
                            $pay_amount = $pay_amount;
                        }
                        else
                        {
                            $pay_amount = $one_available_total_amount;
                        }

                        if($pay_amount >= 0)
                        {
                            $three_sale = new ThreeSale();
                            
                            $three_sale->work_file_id     = $work_file_id;
                            $three_sale->user_id          = $user_id;  
                            $three_sale->customer_id      = $customer_id; 

                            $three_sale->slip_id          = $slip_id;

                            $three_sale->type             = $type;
                            $three_sale->digit            = $result_digit;

                            $three_sale->amount           = $pay_amount;
                            
                            $three_sale->status           = 1;
                            $three_sale->confirm          = 1;

                            $three_sale->remark           = $remark;

                            $three_sale->three_type_id      = $id;
                            $three_sale->three_type_amount  = $amount;

                            $three_sale->save(); 

                            $this->three_type_condition = true;
                        }
                         
                    }
                    //End Insert DB

                   
                                 
                }
                else if( $break_status == 0  && $digit_percent == null)
                {
                    
                     

                     // dd($break_status);

                    $total_amount     = ThreeSale::where([                                           
                                    
                                    ["work_file_id","=",$work_file_id],
                                    ["user_id","=",$user_id],
                                    ["digit","=","$result_digit"],

                                    ["status","=",1],
                                   
                                ])
                            ->sum('amount');

                    if($amount <= $digit_amount)
                    {
                        $pay_amount = $amount;
                    }
                    else
                    {
                        $pay_amount = $digit_amount - $total_amount;
                    }

                    //Insert DB
                    if($pay_amount > 0)
                    {
                         if($pay_amount <= $one_available_total_amount)
                        {
                            $pay_amount = $pay_amount;
                        }
                        else
                        {
                            $pay_amount = $one_available_total_amount;
                        }

                        if($pay_amount >= 0)
                        {
                            $three_sale = new ThreeSale();
                            
                            $three_sale->work_file_id     = $work_file_id;
                            $three_sale->user_id          = $user_id;  
                            $three_sale->customer_id      = $customer_id; 

                            $three_sale->slip_id          = $slip_id;

                            $three_sale->type             = $type;
                            $three_sale->digit            = $result_digit;

                            $three_sale->amount           = $pay_amount;
                            
                            $three_sale->status           = 1;
                            $three_sale->confirm          = 1;

                            $three_sale->remark           = $remark;

                            $three_sale->three_type_id      = $id;
                            $three_sale->three_type_amount  = $amount;

                            $three_sale->save(); 

                            $this->three_type_condition = true; 
                        }
                        
                    }
                    //End Insert DB

                    

                    //Hot Logic                    
                    if($hot_digit)
                    {
                       
                         

                         $hot_percent = Commission::where([ 
                                                   
                                                    ['user_id','=',$user_id], 
                                                  
                                                ])
                                        ->orderBy('id','desc')
                                        ->take(1)
                                        ->value('threed_hotpercent');
                        
                        

                        $total_amount     = ThreeSale::where([                                           
                                    
                                    ["work_file_id","=",$work_file_id],
                                    ["user_id","=",$user_id],
                                    ["digit","=","$result_digit"],

                                    ["status","=",1],
                                   
                                ])
                            ->sum('amount');

                        
                        $hot_amount = $break_amount * $hot_percent/100;
                        $all_total  = $amount + $total_amount;

                        if($all_total <= $hot_amount)
                        {
                            $pay_amount = $amount;
                        }
                        else
                        {
                            if($hot_amount > $total_amount)
                            {
                                $pay_amount = $hot_amount-$total_amount;
                            }
                            else
                            {
                                $pay_amount = 0;
                            }                                                                                
                        }
                         

                        if($pay_amount >= 0)
                        {

                            $three_sale = new ThreeSale();
                                
                                $three_sale->work_file_id     = $work_file_id;
                                $three_sale->user_id          = $user_id;  
                                $three_sale->customer_id      = $customer_id; 

                                $three_sale->slip_id          = $slip_id;

                                $three_sale->type             = $type;
                                $three_sale->digit            = $result_digit;

                                $three_sale->amount           = $pay_amount;
                                
                                $three_sale->status           = 1;
                                $three_sale->confirm          = 1;

                                $three_sale->remark           = $remark;

                                $three_sale->three_type_id      = $id;
                                $three_sale->three_type_amount  = $amount;

                            $three_sale->save();  

                            $this->three_type_condition = true;

                         }

                       // dd($pay_amount); 
                    }
                    //End Hot Logic



                }
                else if( $break_status == 1  && $digit_percent == null)
                {
                    $total_amount     = ThreeSale::where([                                           
                                    
                                    ["work_file_id","=",$work_file_id],                                   
                                    ["digit","=","$result_digit"],

                                    ["status","=",1],
                                   
                                ])
                            ->sum('amount');
                    
                    $avaliable_amount = $break_amount - $total_amount;



                    if($amount <= $avaliable_amount)
                    {
                        $pay_amount = $amount;
                    }
                    else
                    {
                        if($avaliable_amount > 0)
                        {
                            $pay_amount = $avaliable_amount;    
                        }
                        else
                        {
                            $pay_amount = 0;
                        }
                        
                    }

                    
                    //Insert DB
                    if($pay_amount > 0 )
                    {
                        

                        if($pay_amount <= $one_available_total_amount)
                        {
                            $pay_amount = $pay_amount;
                        }
                        else
                        {
                            $pay_amount = $one_available_total_amount;
                        }



                        if($pay_amount >= 0)
                        {
                            

                            $three_sale = new ThreeSale();
                            
                            $three_sale->work_file_id     = $work_file_id;
                            $three_sale->user_id          = $user_id;  
                            $three_sale->customer_id      = $customer_id; 

                            $three_sale->slip_id          = $slip_id;

                            $three_sale->type             = $type;
                            $three_sale->digit            = $result_digit;

                            $three_sale->amount           = $pay_amount;
                            
                            $three_sale->status           = 1;
                            $three_sale->confirm          = 1;

                            $three_sale->remark           = $remark;

                            $three_sale->three_type_id      = $id;
                            $three_sale->three_type_amount  = $amount;

                            $three_sale->save(); 

                            $this->three_type_condition = true;
                        }
                         
                    }
                    //End Insert DB

                    //Hot Logic                    
                    if($hot_digit)
                    {
                        

                         $hot_percent = Commission::where([ 
                                                   
                                                    ['user_id','=',$user_id], 
                                                  
                                                ])
                                        ->orderBy('id','desc')
                                        ->take(1)
                                        ->value('threed_hotpercent');
                        
                        $total_amount     = ThreeSale::where([                                           
                                    
                                    ["work_file_id","=",$work_file_id],
                                    ["user_id","=",$user_id],
                                    ["digit","=","$result_digit"],

                                    ["status","=",1],
                                   
                                ])
                            ->sum('amount');

                        $user_all_digit_total = ThreeSale::where([                                         
                                    
                                    ["work_file_id","=",$work_file_id],                                   
                                    ["digit","=","$result_digit"],
                                    ["status","=",1],                                   
                                ])
                            ->sum('amount');



                        $hot_amount = $break_amount * $hot_percent/100;



                        if($hot_percent == 100)
                        {
                            if($break_amount > $user_all_digit_total )
                            {
                                if( $amount <= ($break_amount-$user_all_digit_total) )
                                {
                                    $pay_amount = $amount;
                                }
                                else
                                {
                                    $pay_amount = $break_amount - $user_all_digit_total;
                                }                               
                               
                            }
                            else
                            {
                                $pay_amount = 0;
                            }

                            
                        }
                        else
                        {
                            $all_total  = $amount + $total_amount;

                            if($all_total <= $hot_amount)
                            {
                                $pay_amount = $amount;
                            }
                            else
                            {
                                if($hot_amount > $total_amount)
                                {
                                    $pay_amount = $hot_amount-$total_amount;
                                }
                                else
                                {
                                    $pay_amount = 0;
                                }                                                                                
                            }
                        }

                        
                        // dd($pay_amount." / ".$hot_amount);
                         
                        // dd($pay_amount);
                        

                        if($pay_amount >= 0)
                        {

                            $three_sale = new ThreeSale();
                                
                                $three_sale->work_file_id     = $work_file_id;
                                $three_sale->user_id          = $user_id;  
                                $three_sale->customer_id      = $customer_id; 

                                $three_sale->slip_id          = $slip_id;

                                $three_sale->type             = $type;
                                $three_sale->digit            = $result_digit;

                                $three_sale->amount           = $pay_amount;
                                
                                $three_sale->status           = 1;
                                $three_sale->confirm          = 1;

                                $three_sale->remark           = $remark;

                                $three_sale->three_type_id      = $id;
                                $three_sale->three_type_amount  = $amount;

                            $three_sale->save();  

                            $this->three_type_condition = true;

                         }

                       
                    }
                    //End Hot Logic


                }

  
      

    }

    public function SpecialAmount($work_file_id,$user_id,$customer_id,$slip_id,$type,$result_digit,$amount,$id,$remark)
    {
        $special_amount = OtherPermission::where([ 
                                                    ['work_file_id','=',$work_file_id],
                                                    ['user_id','=',$user_id],

                                                ])->value('special_amount');
        $total_amount    = ThreeSale::where([                                           
                            
                                            ["work_file_id","=","$work_file_id"],
                                            ["user_id","=","$user_id"],                                    

                                            ["digit","=","$result_digit"],
                                            ["status","=",1],
                                        ])
                                    ->sum('amount');


        $avaliable_amount       = $special_amount - $total_amount;         
        $not_avaliable_amount   = $amount - $avaliable_amount;
      
       if($avaliable_amount == 0)
       {
        return;
       }

        if($special_amount != 0 && ($amount + $total_amount) <= $special_amount)
        {
           
             $three_sale = new ThreeSale();
                            
                    $three_sale->work_file_id     = $work_file_id;
                    $three_sale->user_id          = $user_id;  
                    $three_sale->customer_id      = $customer_id; 

                    $three_sale->slip_id          = $slip_id;

                    $three_sale->type             = $type;
                    $three_sale->digit            = $result_digit;

                    $three_sale->amount           = $amount;
                    
                    $three_sale->status           = 1;
                    $three_sale->confirm          = 1;

                    $three_sale->remark           = $remark;

                    $three_sale->three_type_id      = $id;
                    $three_sale->three_type_amount  = $amount;

            $three_sale->save(); 

            $this->three_type_condition = true;
          

        }
        else
        { 
           // dd($avaliable_amount." / ". $not_avaliable_amount);
           
                $three_sale = new ThreeSale();
                        
                $three_sale->work_file_id     = $work_file_id;
                $three_sale->user_id          = $user_id;  
                $three_sale->customer_id      = $customer_id; 

                $three_sale->slip_id          = $slip_id;

                $three_sale->type             = $type;
                $three_sale->digit            = $result_digit;

                $three_sale->amount           = $avaliable_amount;
                
                $three_sale->status           = 1;
                $three_sale->confirm          = 1;

                $three_sale->remark           = $remark;

                $three_sale->three_type_id      = $id;
                $three_sale->three_type_amount  = $amount;

                $three_sale->save(); 
        
          
        }
        
    }

    public function overBreakDigitsThreeSale($work_file_id,$max_minus)
    {
        $over_digits = array();

        $break_amt      = BreakAmount::where("work_file_id","=",$work_file_id)->value('amount');

        $sales  =    DB::table('three_sales')
                    ->leftJoin('threes', 'three_sales.digit', '=', 'threes.digit')
                    ->leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                    ->where([
                                ["three_sales.work_file_id","=",$work_file_id],
                                ['users.in_out', '=', 1],
                            ])
                    ->groupBy('three_sales.digit')
                    ->selectRaw('three_sales.digit as digit, sum(three_sales.amount) as sum')                    
                    ->get();

        $purchases =    DB::table('three_sales')
                    ->leftJoin('threes', 'three_sales.digit', '=', 'threes.digit')
                    ->leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                    ->where([
                                ["three_sales.work_file_id","=",$work_file_id],
                                ['users.in_out', '=', 2],
                            ])
                    ->groupBy('three_sales.digit')
                    ->selectRaw('three_sales.digit as digit, sum(three_sales.amount) as sum')                    
                    ->get();


        $threes    = Three::all();

        foreach ($threes as  $three) 
        {
           $three->sale_amount        = 0;
           $three->purchase_amount    = 0;
           $three->max_amount         = 0;

           $three->save();
        }


        foreach ($sales as $key => $sale) 
        {
            $id         = Three::where('digit','=',$sale->digit)->value('id');
            $three      = Three::find($id);


            $three->sale_amount = $sale->sum;
            $three->save();
            
        }

        foreach ($purchases as $key => $purchase) 
        {
            $id     = Three::where('digit','=',$purchase->digit)->value('id');
            $three    = Three::find($id);

            $three->purchase_amount = $purchase->sum;
            $three->save();
        }

        $threes    = Three::all();

        foreach ($threes as  $three) 
        {
           
           if( $three->sale_amount <= $break_amt )
           {               

                if($three->purchase_amount == 0)
                {                   

                    $three->max_amount = 0;
                }
                else if($three->purchase_amount != 0)
                {                    
                    if($three->purchase_amount > $three->sale_amount)
                    { 
                        $three->max_amount = $three->sale_amount - $three->purchase_amount; 
                    }
                    else
                    {
                        $three->max_amount = 0;
                    }
                }

           }
           else if( $three->sale_amount > $break_amt)
           {
                if($three->purchase_amount == 0)
                {
                    $three->max_amount = $three->sale_amount - $break_amt;
                }
                else
                {
                    $three->max_amount = ($three->sale_amount - $break_amt) - $three->purchase_amount;
                }
           }


           $three->save();

           if($three->max_amount > 0 && $max_minus == "Max")
           { $over_digits["$three->digit"] = $three->max_amount; }

           if($three->max_amount < 0 && $max_minus == "Minus")
           { $over_digits["$three->digit"] = $three->max_amount; }

        }

        arsort($over_digits);
 
        return $over_digits;
    }

    public function overBreakDigitsThreeType($work_file_id,$max_minus)
    {
        $over_digits = array();

        $break_amt      = BreakAmount::where("work_file_id","=",$work_file_id)->value('amount');

        $sales  =    DB::table('three_types')
                    ->leftJoin('twos', 'three_types.digit', '=', 'twos.digit')
                    ->leftJoin('users', 'three_types.user_id', '=', 'users.id')
                    ->where([
                                ["three_types.work_file_id","=",$work_file_id],
                                ['users.in_out', '=', 1],
                            ])
                    ->groupBy('three_types.digit')
                    ->selectRaw('three_types.digit as digit, sum(three_types.amount) as sum')                    
                    ->get();

        $purchases =    DB::table('three_types')
                    ->leftJoin('twos', 'three_types.digit', '=', 'twos.digit')
                    ->leftJoin('users', 'three_types.user_id', '=', 'users.id')
                    ->where([
                                ["three_types.work_file_id","=",$work_file_id],
                                ['users.in_out', '=', 2],
                            ])
                    ->groupBy('three_types.digit')
                    ->selectRaw('three_types.digit as digit, sum(three_types.amount) as sum')                    
                    ->get();


        $twos    = Two::all();

        foreach ($twos as  $three) 
        {
           $three->sale_amount        = 0;
           $three->purchase_amount    = 0;
           $three->max_amount         = 0;

           $three->save();
        }


        foreach ($sales as $key => $sale) 
        {
            $id         = Two::where('digit','=',$sale->digit)->value('id');
            $three      = Two::find($id);


            $three->sale_amount = $sale->sum;
            $three->save();
            
        }

        foreach ($purchases as $key => $purchase) 
        {
            $id     = Two::where('digit','=',$purchase->digit)->value('id');
            $three    = Two::find($id);

            $three->purchase_amount = $purchase->sum;
            $three->save();
        }

        $threes    = Two::all();

        foreach ($threes as  $three) 
        {
           
           if( $three->sale_amount <= $break_amt )
           {               

                if($three->purchase_amount == 0)
                {                   

                    $three->max_amount = 0;
                }
                else if($three->purchase_amount != 0)
                {                    
                    if($three->purchase_amount > $three->sale_amount)
                    { 
                        $three->max_amount = $three->sale_amount - $three->purchase_amount; 
                    }
                    else
                    {
                        $three->max_amount = 0;
                    }
                }

           }
           else if( $three->sale_amount > $break_amt)
           {
                if($three->purchase_amount == 0)
                {
                    $three->max_amount = $three->sale_amount - $break_amt;
                }
                else
                {
                    $three->max_amount = ($three->sale_amount - $break_amt) - $three->purchase_amount;
                }
           }


           $three->save();

           if($three->max_amount > 0 && $max_minus == "Max")
           { $over_digits["$three->digit"] = $three->max_amount; }

           if($three->max_amount < 0 && $max_minus == "Minus")
           { $over_digits["$three->digit"] = $three->max_amount; }

        }

        arsort($over_digits);
 
        return $over_digits;
    }


    public function overBreakDigits($work_file_id)
    {
        $over_digits = array();

        $max_minus      = Choice::where('auth_id','=',auth()->user()->id)->value('max_minus');

        $break_amt      = BreakAmount::where("work_file_id","=",$work_file_id)->value('amount');

        $sales          =    DB::table('three_sales')
                            ->leftJoin('threes', 'three_sales.digit', '=', 'threes.digit')
                            ->leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                            ->where([
                                        ["three_sales.work_file_id","=",$work_file_id],
                                        ['users.in_out', '=', 1],
                                    ])
                            ->groupBy('three_sales.digit')
                            ->selectRaw('three_sales.digit as digit, sum(three_sales.amount) as sum')                    
                            ->get();

       


        $purchases =    DB::table('three_sales')
                            ->leftJoin('threes', 'three_sales.digit', '=', 'threes.digit')
                            ->leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                            ->where([
                                        ["three_sales.work_file_id","=",$work_file_id],
                                        ['users.in_out', '=', 2],
                                    ])
                            ->groupBy('three_sales.digit')
                            ->selectRaw('three_sales.digit as digit, sum(three_sales.amount) as sum')                    
                            ->get();



        $threes    = Two::all();

        foreach ($threes as  $three) 
        {
           $three->sale_amount        = 0;
           $three->purchase_amount    = 0;
           $three->max_amount         = 0;

           $three->save();
        }       

        foreach ($sales as  $sale) 
        {
            $id       = Two::where('digit','=',$sale->digit)->value('id');
            $three    = Two::find($id);


            $three->sale_amount = $sale->sum;
            $three->save();
            
        }

        foreach ($purchases as $key => $purchase) 
        {
            $id     = Two::where('digit','=',$purchase->digit)->value('id');
            $three    = Two::find($id);

            $three->purchase_amount = $purchase->sum;
            $three->save();
        }

        


        $threes    = Two::all();

        foreach ($threes as  $three) 
        {
           
            $balance = $three->sale_amount - $three->purchase_amount;

            if($balance > 0)
            {
                if($balance <= $break_amt)
                {
                    $three->max_amount = 0;
                }
                else
                {
                    $three->max_amount = $balance - $break_amt;
                }
            }
            else
            {
                $three->max_amount = $balance;
            }
            

           if($three->max_amount > 0 && $max_minus == "Max")
           { $over_digits["$three->digit"] = $three->max_amount; }

           if($three->max_amount < 0 && $max_minus == "Minus")
           { $over_digits["$three->digit"] = $three->max_amount; }



           $three->save();

        }
        //calculate sale,purchase,max
          
        arsort($over_digits);

        return $over_digits;

    }




    public function padaytharbetThreeSale(Request $request)
    {
        //Get Info
        $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');            
        $user_id        = Choice::where('auth_id','=',auth()->user()->id)->value('user_id');
        $customer_id    = Choice::where('auth_id','=',auth()->user()->id)->value('customer_id');

        $in_out         = Choice::where('auth_id','=',auth()->user()->id)->value('in_out');
        $max_minus      = Choice::where('auth_id','=',auth()->user()->id)->value('max_minus');
        $keyboard       = Choice::where('auth_id','=',auth()->user()->id)->value('keyboard');

        $slip           = Choice::where('auth_id','=',auth()->user()->id)->value('slip');
        $entry          = Choice::where('auth_id','=',auth()->user()->id)->value('entry');
        $view           = Choice::where('auth_id','=',auth()->user()->id)->value('view');
        //End Get Info

        if(request()->slip_id == null)
        {          
            $slip_total = 0;

             $three_sales = ThreeSale::where([                                           
                                        
                                        ["work_file_id","=",$work_file_id],
                                        ["user_id","=",$user_id],
                                        ["customer_id","=",1],

                                    ])
                                ->orderBy('id','desc')
                                ->first();

            if($three_sales != null)
            {
                $slip_id = $three_sales->slip_id +1;
            }
            else
            {
                $slip_id = 1;
            }
           
        }
        else
        {
            $slip_id = request()->slip_id;

             $slips            = ThreeType::leftJoin('customers', 'three_types.customer_id', '=', 'customers.id')
                                      ->where([                                           
                                                
                                                ["three_types.work_file_id","=",$work_file_id],
                                                ["three_types.user_id","=",$user_id],
                                                ["three_types.customer_id","=",1],
                                                ["three_types.slip_id","=",$slip_id],

                                                ["three_types.status","=",1],                                               

                                                ['customers.in_out', '=', $in_out],
                                            ])
                                        
                                        ->distinct()
                                        ->groupBy("three_types.slip_id")
                                        ->select(['three_types.slip_id',\DB::raw("SUM(three_types.amount) as call_total")])
                                        ->get();

            foreach ($slips as $key => $slip) 
            {
               $slip_total = $slip->call_total;
            }
            
        }

        $action  = "2D AM";
        
        $keep_break         = BreakAmount::where('work_file_id','=',$work_file_id)
                                        ->orderBy('id','desc')
                                        ->take(1)
                                        ->value('status');
        
        $users          = User::all();
        $customers      = Customer::all();

        $three_sales = ThreeType::where([  

                                    ["work_file_id","=",$work_file_id],
                                    ["user_id","=",$user_id],
                                    ["customer_id","=",1],
                                    ["slip_id","=",$slip_id],
                                ])                            
                            ->get();

        $hots       = Hot::where([
                                    ["work_file_id","=",$work_file_id],
                                ])
                            ->get();


        $workfile_name  =   WorkFile::where([
                                                ["id","=",$work_file_id]

                                            ])->value('show');

        $user_name      =   User::where([
                                                ["id","=",$user_id]
                                                
                                            ])->value('name');

        $customer_name  =   Customer::where([
                                                ["id","=",$customer_id]
                                                
                                            ])->value('name'); 


        $work_file             = WorkFile::find($work_file_id);
       

        $slip_total = 0;

        return view('threesale.padaytharthreesale',[

                                            'work_file'            => $work_file,
                                            'work_file_id'          => $work_file_id,
                                           
                                            'action'                => $action,

                                            
                                            'user_id'               => $user_id,
                                            'customer_id'           => $customer_id,
                                            'slip_id'               => $slip_id,

                                            'keep_break'            => $keep_break,
                                            'entry'                 => $entry,
                                            'view'                  => $view,
                                            'keyboard'              => $keyboard,
                                            'in_out'                => $in_out,

                                            'three_sales'           => $three_sales,
                                            'users'                 => $users,
                                            'customers'             => $customers,
                                          
                                            'hots'                  => $hots,

                                            'workfile_name'         => $workfile_name,
                                            'user_name'             => $user_name,
                                            'customer_name'         => $customer_name,
                                            'slip_total'            => $slip_total,

                                        ]);

    }

    public function createpadaytharbetThreeSale (Request $request)
    {
       
        //Get Info
        $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');            
        $user_id        = Choice::where('auth_id','=',auth()->user()->id)->value('user_id');
        $customer_id    = Choice::where('auth_id','=',auth()->user()->id)->value('customer_id');

        $in_out         = Choice::where('auth_id','=',auth()->user()->id)->value('in_out');
        $max_minus      = Choice::where('auth_id','=',auth()->user()->id)->value('max_minus');
        $keyboard       = Choice::where('auth_id','=',auth()->user()->id)->value('keyboard');

        $slip           = Choice::where('auth_id','=',auth()->user()->id)->value('slip');
        $entry          = Choice::where('auth_id','=',auth()->user()->id)->value('entry');
        $view           = Choice::where('auth_id','=',auth()->user()->id)->value('view');
        //End Get Info


        // dd(request()->action." / ". request()->slip_id);

        $keep_break         = BreakAmount::where('work_file_id','=',$work_file_id)
                                        ->orderBy('id','desc')
                                        ->take(1)
                                        ->value('status');

        if(request()->slip_id == "0")
        {          
            $three_sales = ThreeSale::where([                                           
                                        
                                        ["work_file_id","=",$work_file_id],
                                        ["user_id","=",$user_id],
                                        ["customer_id","=",1],

                                    ])
                                ->orderBy('id','desc')
                                ->first();

            if($three_sales != null)
            {
                $slip_id = $three_sales->slip_id +1;
            }
            else
            {
                $slip_id = 1;
            }
           
        }
        else
        {
            $slip_id = request()->slip_id;

            $slips            = ThreeType::leftJoin('customers', 'three_types.customer_id', '=', 'customers.id')
                                      ->where([                                           
                                                
                                                ["three_types.work_file_id","=",$work_file_id],
                                                ["three_types.user_id","=",$user_id],
                                                ["three_types.customer_id","=",1],
                                                ["three_types.slip_id","=",$slip_id],

                                                ["three_types.status","=",1],                                               

                                                ['customers.in_out', '=', $in_out],
                                            ])
                                        
                                        ->distinct()
                                        ->groupBy("three_types.slip_id")
                                        ->select(['three_types.slip_id',\DB::raw("SUM(three_types.amount) as call_total")])
                                        ->get();

            foreach ($slips as $key => $slip) 
            {
               $slip_total = $slip->call_total;
            }

        } 


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
        
        //Type => Digits
        $type           = request()->type;
        $result_digits  = $this->Type_to_Padaythar_Two_Digits($type);
        //Type => Digits

        //Insert => Digits        
        $this->insertThreeType($work_file_id,$user_id,$customer_id,$slip_id,$type,$result_digits,$amount);
        //End Insert => Digits
   
       return redirect("/3dsale/padaythar?slip_id={$slip_id}");

      
        $users          = User::all();
        $customers      = Customer::all();

        $hots           = Hot::where("work_file_id","=",$work_file_id)->get();
        $workfile_name  = WorkFile::where("id","=",$work_file_id)->value('show');
        $user_name      = User::where("id","=",$user_id)->value('name');
        $customer_name  = Customer::where("id","=",$customer_id)->value('name'); 

        $three_sales = ThreeSale::where([ 

                                    ["work_file_id","=",$work_file_id],
                                    ["user_id","=",$user_id],
                                    ["customer_id","=",$customer_id],
                                    ["slip_id","=",$slip_id],          
                                ])
                            ->get();

        
        $work_files             = WorkFile::all();
        $two_am_work_file_id    = $work_file_id;
        $two_pm_work_file_id    = $work_file_id;
        $three_work_file_id     = $work_file_id;


        return view('threesale.addthreesale',[

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

                                            
                                            'three_sales'           => $three_sales,
                                            'users'                 => $users,
                                            'customers'             => $customers,
                                            'over_digits'           => $over_digits,
                                            'hots'                  => $hots,

                                            'workfile_name'         => $workfile_name,
                                            'user_name'             => $user_name,
                                            'customer_name'         => $customer_name,
                                        ]);
    }

    public function positionbetThreeSale(Request $request)
    {
        //Get Info
        $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');            
        $user_id        = Choice::where('auth_id','=',auth()->user()->id)->value('user_id');
        $customer_id    = Choice::where('auth_id','=',auth()->user()->id)->value('customer_id');

        $in_out         = Choice::where('auth_id','=',auth()->user()->id)->value('in_out');
        $max_minus      = Choice::where('auth_id','=',auth()->user()->id)->value('max_minus');
        $keyboard       = Choice::where('auth_id','=',auth()->user()->id)->value('keyboard');

        $slip           = Choice::where('auth_id','=',auth()->user()->id)->value('slip');
        $entry          = Choice::where('auth_id','=',auth()->user()->id)->value('entry');
        $view           = Choice::where('auth_id','=',auth()->user()->id)->value('view');
        //End Get Info

        if(request()->slip_id == null)
        {          
            $slip_total = 0;

             $three_position = ThreePosition::where([                                           
                                        
                                        ["work_file_id","=",$work_file_id],
                                        ["user_id","=",$user_id],
                                        ["customer_id","=",1],

                                    ])
                                ->orderBy('id','desc')
                                ->first();

            if($three_position != null)
            {
                $slip_id = $three_position->slip_id +1;
            }
            else
            {
                $slip_id = 1;
            }
           
        }
        else
        {
            $slip_id = request()->slip_id;

            $slips            = ThreePosition::leftJoin('customers', 'three_positions.customer_id', '=', 'customers.id')
                                      ->where([                                           
                                                
                                                ["three_positions.work_file_id","=",$work_file_id],
                                                ["three_positions.user_id","=",$user_id],
                                                ["three_positions.customer_id","=",1],
                                                ["three_positions.slip_id","=",$slip_id],

                                                ["three_positions.status","=",1],                                               

                                                ['customers.in_out', '=', $in_out],
                                            ])
                                        
                                        ->distinct()
                                        ->groupBy("three_positions.slip_id")
                                        ->select(['three_positions.slip_id',\DB::raw("SUM(three_positions.amount) as call_total")])
                                        ->get();

            foreach ($slips as $key => $slip) 
            {
               $slip_total = $slip->call_total;
            }
            
        }

        $action  = "2D AM";
        
             
        $users          = User::all();
        $customers      = Customer::all();

        $three_positions = ThreePosition::where([
                                    ["work_file_id","=",$work_file_id],
                                    ["user_id","=",$user_id],
                                    ["customer_id","=",1],
                                    ["slip_id","=",$slip_id],
                                ])                            
                            ->get();

        $workfile_name  =   WorkFile::where("id","=",$work_file_id)->value('show');

        $user_name      =   User::where("id","=",$user_id)->value('name');

        $customer_name  =   Customer::where("id","=",$customer_id)->value('name'); 

        $work_file      =   WorkFile::find($work_file_id);
       

        return view('threesale.positionthreesale',[

                                            'work_file'             => $work_file,

                                            'work_file_id'          => $work_file_id,
                                            'user_id'               => $user_id,
                                            'customer_id'           => $customer_id,
                                            'slip_id'               => $slip_id,

                                            'action'                => $action,

                                            'entry'                 => $entry,
                                            'view'                  => $view,
                                            'keyboard'              => $keyboard,
                                            'in_out'                => $in_out,

                                            'three_positions'       => $three_positions,
                                            'users'                 => $users,
                                            'customers'             => $customers,
                                       
                                            'workfile_name'         => $workfile_name,
                                            'user_name'             => $user_name,
                                            'customer_name'         => $customer_name,
                                            'slip_total'            => $slip_total,

                                        ]);

    }

    public function createpositionbetThreeSale(Request $request)
    {
        //Get Info
        $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');            
        $user_id        = Choice::where('auth_id','=',auth()->user()->id)->value('user_id');
        $customer_id    = Choice::where('auth_id','=',auth()->user()->id)->value('customer_id');

        $in_out         = Choice::where('auth_id','=',auth()->user()->id)->value('in_out');
        $max_minus      = Choice::where('auth_id','=',auth()->user()->id)->value('max_minus');
        $keyboard       = Choice::where('auth_id','=',auth()->user()->id)->value('keyboard');

        $slip           = Choice::where('auth_id','=',auth()->user()->id)->value('slip');
        $entry          = Choice::where('auth_id','=',auth()->user()->id)->value('entry');
        $view           = Choice::where('auth_id','=',auth()->user()->id)->value('view');
        //End Get Info

        if(request()->slip_id == "0")
        {          
            $three_position = ThreePosition::where([                                           
                                        
                                        ["work_file_id","=",$work_file_id],
                                        ["user_id","=",$user_id],
                                        ["customer_id","=",1],

                                    ])
                                ->orderBy('id','desc')
                                ->first();

            if($three_position != null)
            {
                $slip_id = $three_position->slip_id +1;
            }
            else
            {
                $slip_id = 1;
            }
           
        }
        else
        {
            $slip_id = request()->slip_id;

            $slips            = ThreePosition::leftJoin('customers', 'three_positions.customer_id', '=', 'customers.id')
                                      ->where([                                           
                                                
                                                ["three_positions.work_file_id","=",$work_file_id],
                                                ["three_positions.user_id","=",$user_id],
                                                ["three_positions.customer_id","=",1],
                                                ["three_positions.slip_id","=",$slip_id],

                                                ["three_positions.status","=",1],                                               

                                                ['customers.in_out', '=', $in_out],
                                            ])
                                        
                                        ->distinct()
                                        ->groupBy("three_positions.slip_id")
                                        ->select(['three_positions.slip_id',\DB::raw("SUM(three_positions.amount) as call_total")])
                                        ->get();

            foreach ($slips as $key => $slip) 
            {
               $slip_total = $slip->call_total;
            }

        } 


        if($entry == "Unit")
        {
            $amount     = request()->amount * 100;      
        }
        else
        {
            $amount     = request()->amount;            
        }
        
        //Type 
        $d1           = request()->d1;
        $d2           = request()->d2;
        //Type 

        //Insert => Digits        
        $this->insertThreePosition($work_file_id,$user_id,$customer_id,$slip_id,$d1,$d2,$amount);
        //End Insert => Digits
   
       return redirect("/3dsale/position?slip_id={$slip_id}");


        $users          = User::all();
        $customers      = Customer::all();

        $hots           = Hot::where("work_file_id","=",$work_file_id)->get();
        $workfile_name  = WorkFile::where("id","=",$work_file_id)->value('show');
        $user_name      = User::where("id","=",$user_id)->value('name');
        $customer_name  = Customer::where("id","=",$customer_id)->value('name'); 

        
        
        $work_files             = WorkFile::all();
        $two_am_work_file_id    = $work_file_id;
        $two_pm_work_file_id    = $work_file_id;
        $three_work_file_id     = $work_file_id;


        return view('threesale.positionthreesale',[

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

                                            
                                            'three_sales'           => $three_sales,
                                            'users'                 => $users,
                                            'customers'             => $customers,
                                            'over_digits'           => $over_digits,
                                            'hots'                  => $hots,

                                            'workfile_name'         => $workfile_name,
                                            'user_name'             => $user_name,
                                            'customer_name'         => $customer_name,
                                        ]);
    }

    public function imagetextThreeSale(Request $request)
    {
        //Get Info
        $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');            
        $user_id        = Choice::where('auth_id','=',auth()->user()->id)->value('user_id');
        $customer_id    = Choice::where('auth_id','=',auth()->user()->id)->value('customer_id');

        $in_out         = Choice::where('auth_id','=',auth()->user()->id)->value('in_out');
        $max_minus      = Choice::where('auth_id','=',auth()->user()->id)->value('max_minus');
        $keyboard       = Choice::where('auth_id','=',auth()->user()->id)->value('keyboard');

        $slip           = Choice::where('auth_id','=',auth()->user()->id)->value('slip');
        $entry          = Choice::where('auth_id','=',auth()->user()->id)->value('entry');
        $view           = Choice::where('auth_id','=',auth()->user()->id)->value('view');
        //End Get Info

        $slip_total = 0;
        
        if(request()->slip_id == null)
        {          
            

             $three_sales = ThreeSale::where([                                           
                                        
                                        ["work_file_id","=",$work_file_id],
                                        ["user_id","=",$user_id],
                                        ["customer_id","=",1],

                                    ])
                                ->orderBy('id','desc')
                                ->first();

            if($three_sales != null)
            {
                $slip_id = $three_sales->slip_id +1;
            }
            else
            {
                $slip_id = 1;
            }
           
        }
        else
        {
            $slip_id = request()->slip_id;

             $slips            = ThreeType::leftJoin('customers', 'three_types.customer_id', '=', 'customers.id')
                                      ->where([                                           
                                                
                                                ["three_types.work_file_id","=",$work_file_id],
                                                ["three_types.user_id","=",$user_id],
                                                ["three_types.customer_id","=",1],
                                                ["three_types.slip_id","=",$slip_id],

                                                ["three_types.status","=",1],                                               

                                                ['customers.in_out', '=', $in_out],
                                            ])
                                        
                                        ->distinct()
                                        ->groupBy("three_types.slip_id")
                                        ->select(['three_types.slip_id',\DB::raw("SUM(three_types.amount) as call_total")])
                                        ->get();

            foreach ($slips as $key => $slip) 
            {
               $slip_total = $slip->call_total;
            }
            
        }



        $action  = "2D AM";

        //Get => OverBreakDigits
        $over_digits = $this->overBreakDigits($work_file_id);
        //End Get => OverBreakDigits

        $keep_break         = BreakAmount::where('work_file_id','=',$work_file_id)
                                        ->orderBy('id','desc')
                                        ->take(1)
                                        ->value('status');

        $users          = User::all();
        $customers      = Customer::where("in_out","=",$in_out)->get();

        $three_sales = ThreeType::where([  

                                    ["work_file_id","=",$work_file_id],
                                    ["user_id","=",$user_id],
                                    ["customer_id","=",1],
                                    ["slip_id","=",$slip_id],
                                ])                            
                            ->get();

       


        $hots       = Hot::where([
                                    ["work_file_id","=",$work_file_id],
                                ])
                            ->get();


        $workfile_name  =   WorkFile::where([
                                                ["id","=",$work_file_id]

                                            ])->value('show');

        $user_name      =   User::where([
                                                ["id","=",$user_id]
                                                
                                            ])->value('name');

        $customer_name  =   Customer::where([
                                                ["id","=",$customer_id]
                                                
                                            ])->value('name'); 

        

        $work_file             = WorkFile::find($work_file_id);
      
        

        $text = "";

        return view('threesale.imagetextthreesale',[

                                            'work_file'            => $work_file,
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
                                            'three_sales'           => $three_sales,
                                            'users'                 => $users,
                                            'customers'             => $customers,
                                            'over_digits'           => $over_digits,
                                            'hots'                  => $hots,
                                            'workfile_name'         => $workfile_name,
                                            'user_name'             => $user_name,
                                            'customer_name'         => $customer_name,
                                            'text'                  => $text,
                                            'slip_total'            => $slip_total,
                                        ]);
    }

    public function createimagetextThreeSale(Request $request)
    {

        //Get Info
        $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');            
        $user_id        = Choice::where('auth_id','=',auth()->user()->id)->value('user_id');
        $customer_id    = Choice::where('auth_id','=',auth()->user()->id)->value('customer_id');

        $in_out         = Choice::where('auth_id','=',auth()->user()->id)->value('in_out');
        $max_minus      = Choice::where('auth_id','=',auth()->user()->id)->value('max_minus');
        $keyboard       = Choice::where('auth_id','=',auth()->user()->id)->value('keyboard');

        $slip           = Choice::where('auth_id','=',auth()->user()->id)->value('slip');
        $entry          = Choice::where('auth_id','=',auth()->user()->id)->value('entry');
        $view           = Choice::where('auth_id','=',auth()->user()->id)->value('view');
        //End Get Info


        // dd(request()->action." / ". request()->slip_id);

        $keep_break         = BreakAmount::where('work_file_id','=',$work_file_id)
                                        ->orderBy('id','desc')
                                        ->take(1)
                                        ->value('status');

        if(request()->slip_id == "0")
        {          
            $three_sales = ThreeSale::where([                                           
                                        
                                        ["work_file_id","=",$work_file_id],
                                        ["user_id","=",$user_id],
                                        ["customer_id","=",1],

                                    ])
                                ->orderBy('id','desc')
                                ->first();

            if($three_sales != null)
            {
                $slip_id = $three_sales->slip_id +1;
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


        switch (request()->action)
        {
           
            case 'စာရင်းသွင်းရန်': 

                   

                    $text   =  request()->text;            
                    Storage::disk('local')->put('type_img.txt', $text);


                    $text = "";
                    $handle = fopen("..//storage/app//type_img.txt", "r");

                  if ($handle) 
                  {
                        

                      while (($line = fgets($handle)) !== false) 
                      {
                         
                        $new_array = array();
                        if($line) 
                        { 
                            $line = trim($line);
                            $line = str_replace("  "," ",$line);

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
                            $this->insertThreeType($work_file_id,$user_id,$customer_id,$slip_id,$type,$result_digits,$amount);
                            //End Insert => Digits


                        }
                              

                      }
                      fclose($handle);


                      return redirect("/3dsale/image-text?slip_id={$slip_id}");
                  } 
                 
            break;      
        }

     
        $users          = User::all();
        $customers      = Customer::all();

        $hots           = Hot::where("work_file_id","=",$work_file_id)->get();
        $workfile_name  = WorkFile::where("id","=",$work_file_id)->value('show');
        $user_name      = User::where("id","=",$user_id)->value('name');
        $customer_name  = Customer::where("id","=",$customer_id)->value('name'); 

        $three_sales = ThreeSale::where([ 

                                    ["work_file_id","=",$work_file_id],
                                    ["user_id","=",$user_id],
                                    ["customer_id","=",$customer_id],
                                    ["slip_id","=",$slip_id],          
                                ])
                            ->get();

        
        $work_file             = WorkFile::find($work_file_id);
      
        
        $action = "NEW";
        $text = "";

        return view('threesale.imagetextthreesale',[

                                            'work_file'            => $work_file,
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
                                            'three_sales'           => $three_sales,
                                            'users'                 => $users,
                                            'customers'             => $customers,
                                           
                                            'hots'                  => $hots,
                                            'workfile_name'         => $workfile_name,
                                            'user_name'             => $user_name,
                                            'customer_name'         => $customer_name,
                                            'text'                  => $text,
                                        ]);

    }


    public function addImage(Request $request)
    {
        return view('threesale.addimage');
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

 
            if($request->hasfile('photo'))
            {
                $file       = $request->file('photo');
                $extension  = $file->getClientOriginalExtension();
          

                $filename   = "type_img.png";


                $file->move('..//vendor//thiagoalessio//tesseract_ocr//src//',$filename);
               
            }
          else
            {
                return $request;
              
            } 



        $path   = "..//vendor//thiagoalessio//tesseract_ocr//src//$filename";       

        $ocr    = new TesseractOCR($path);

        $text   =  $ocr->run();
            
        Storage::disk('local')->put('type_img.txt', $text);

        $contents = Storage::get('type_img.txt');


        return redirect("3dsale/image-text")->with('info',"Image Uploaded Successfully!");
    }

    public function updDelThreeSale(Request $request)
    {
        $id             = request()->id;

        $new_digit      = request()->digit;
        $new_amount     = request()->amount;
        $new_type       = request()->type;

        $action         = request()->action;

        $id             = request()->id;
        $three_sale     = ThreeType::find($id);

        $work_file_id   = $three_sale->work_file_id;
        $user_id        = $three_sale->user_id;
        $customer_id    = $three_sale->customer_id;
        $in_out         = $three_sale->in_out;
        $slip_id        = $three_sale->slip_id;

        
        $old_digit      = $three_sale->digit;
        $old_amount     = $three_sale->amount;
        $old_type       = $three_sale->type;

        if( is_numeric($old_type) && strlen($old_type) >= 3 )
        {
            // dd("padaythar");

            $old_result_digits  = $this->Type_to_Padaythar_Two_Digits($old_type);
            $old_count          = count($old_result_digits);

            $new_result_digits  = $this->Type_to_Padaythar_Two_Digits($new_type);
            $new_count          = count($new_result_digits);

        } 
        else
        {
            $old_result_digits  = $this->Type_to_Digits($old_type);
            $old_count          = count($old_result_digits);

            $new_result_digits  = $this->Type_to_Digits($new_type);
            $new_count          = count($new_result_digits);
        }

       
        if($old_count == $new_count)
        {
            $from           = $id;
            $to             = $id+$new_count-1;
        }


        if(request()->action == "Save" && $new_type == null)
        {
            $two_sale = ThreeType::find($id);
                                    
                    $two_sale->work_file_id     = $three_sale->work_file_id;
                    $two_sale->user_id          = $three_sale->user_id;  
                    $two_sale->customer_id      = $three_sale->customer_id;
                    $two_sale->slip_id          = $three_sale->slip_id;

                    $two_sale->type             = $old_type;
                    $two_sale->digit            = $old_digit;

                    $two_sale->amount           = $new_amount;
                    
                    $two_sale->status           = 1;
                    $two_sale->confirm          = 1;

            $two_sale->save(); 

             $two_sale = ThreeSale::find($id);
                                    
                    $two_sale->work_file_id     = $three_sale->work_file_id;
                    $two_sale->user_id          = $three_sale->user_id;  
                    $two_sale->customer_id      = $three_sale->customer_id;
                    $two_sale->slip_id          = $three_sale->slip_id;

                    $two_sale->type             = $old_type;
                    $two_sale->digit            = $old_digit;

                    $two_sale->amount           = $new_amount;
                    
                    $two_sale->status           = 1;
                    $two_sale->confirm          = 1;

                    $two_sale->three_type_id        = $three_sale->id;
                    $two_sale->three_type_amount    = $new_amount;

            $two_sale->save(); 
        }

       
        if(request()->action == "Save" && $new_type != null)
        {

            if($old_count != $new_count)
            {
                return back();
            }
            else
            {
                $from           = $id;
                $to             = $id+$new_count-1;

                // dd($from." -> ". $to);
            }

        }




            if(request()->action == "Save" && $new_type != null)
            {
                        
                foreach ($new_result_digits as $result_digit) 
                {

                    $two_sale = ThreeType::find($from);
                                    
                            $two_sale->work_file_id     = $three_sale->work_file_id;
                            $two_sale->user_id          = $three_sale->user_id;  
                            $two_sale->customer_id      = $three_sale->customer_id;
                            $two_sale->slip_id          = $three_sale->slip_id;

                            $two_sale->type             = $new_type;
                            $two_sale->digit            = $result_digit;

                            $two_sale->amount           = $new_amount;
                            
                            $two_sale->status           = 1;
                            $two_sale->confirm          = 1;

                    $two_sale->save(); 

                    $two_sale = ThreeSale::find($from);
                                    
                            $two_sale->work_file_id     = $three_sale->work_file_id;
                            $two_sale->user_id          = $three_sale->user_id;  
                            $two_sale->customer_id      = $three_sale->customer_id;
                            $two_sale->slip_id          = $three_sale->slip_id;

                            $two_sale->type             = $new_type;
                            $two_sale->digit            = $result_digit;

                            $two_sale->amount           = $new_amount;
                            
                            $two_sale->status           = 1;
                            $two_sale->confirm          = 1;

                            $two_sale->three_type_id        = $from;
                            $two_sale->three_type_amount    = $new_amount;


                    $two_sale->save(); 


                    $from++;
                }

            }

            if(request()->action == "Type-Del")
            {
                        
                DB::table('three_types')->where([ 
                                    ['work_file_id', '=', "$work_file_id"],
                                    ['user_id', '=', "$user_id"], 
                                    ['customer_id', '=', "$customer_id"], 
                                    ['slip_id', '=', "$slip_id"], 
                                    ['type', '=', "$old_type"], 

                                    ['id', '>=', "$from"],
                                    ['id', '<=', "$to"], 

                                ])->delete();

                DB::table('three_sales')->where([ 
                                    ['work_file_id', '=', "$work_file_id"],
                                    ['user_id', '=', "$user_id"], 
                                    ['customer_id', '=', "$customer_id"], 
                                    ['slip_id', '=', "$slip_id"], 
                                    ['type', '=', "$old_type"], 

                                    ['id', '>=', "$from"],
                                    ['id', '<=', "$to"], 

                                ])->delete();

            }

            if(request()->action == "Del")
            {
                        
                DB::table('three_types')->where([ 
                                   
                                    ['id', '=', "$id"],
                                   

                                ])->delete();

                DB::table('three_sales')->where([ 

                                   ['id', '=', "$id"],

                                ])->delete();

            }




         //Get Info        
            $max_minus      = Choice::where('auth_id','=',auth()->user()->id)->value('max_minus');
            $keyboard       = Choice::where('auth_id','=',auth()->user()->id)->value('keyboard');

            $slip           = Choice::where('auth_id','=',auth()->user()->id)->value('slip');
            $entry          = Choice::where('auth_id','=',auth()->user()->id)->value('entry');
            $view           = Choice::where('auth_id','=',auth()->user()->id)->value('view');
        //End Get Info
           
               
            $keep_break     = BreakAmount::where('work_file_id','=',$work_file_id)
                                        ->orderBy('id','desc')
                                        ->take(1)
                                        ->value('status');
    
                     
            $three_sales = ThreeType::where([  

                                ["work_file_id","=",$work_file_id],
                                ["user_id","=",$user_id],
                                ["customer_id","=",$customer_id],
                                ["slip_id","=",$slip_id],
                                
                            ])                            
                        ->get();           
     
        
        if(auth()->user()->id == 1 or auth()->user()->id == 2)
        {
            $users          = User::where('in_out','=',$in_out)->get();
        }
        else
        {
            $users          = User::where('id','=',auth()->user()->id)
                                    ->orWhere('refer_user_id','=',auth()->user()->id)
                                    ->get();
        }

        //Data Carry for View File
        $work_file     = WorkFile::find($work_file_id);
        $user_name     = User::where("id","=",$user_id)->value('name');

        $over_digits    = $this->overBreakDigits($work_file_id);
        $hots           = Hot::where("work_file_id","=",$work_file_id)->get();

        $st="";

        return redirect("/3dsale/add/{$work_file_id}?st=edit&work_file_id=$work_file_id&user_id=$user_id&customer_id=$customer_id&slip_id=$slip_id");

        
        

        return view('threesale.addthreesale',[

                                            'work_file'             => $work_file,
                                            'users'                 => $users,
                                            'hots'                  => $hots,

                                            'user_name'             => $user_name,

                                            'work_file_id'          => $work_file_id,
                                            'user_id'               => $user_id,
                                            'slip_id'               => $slip_id,
                                            'in_out'                => $in_out,

                                            'entry'                 => $entry,
                                            'view'                  => $view,
                                            'keyboard'              => $keyboard,
                                            'max_minus'             => $max_minus,
                                            'slip'                  => $slip,

                                            'keep_break'            => $keep_break,

                                            'three_sales'           => $three_sales,
                                            'over_digits'           => $over_digits,
                                            'st'                    => $st,

                                            'last_slip'                    => $last_slip,
                                            'slip_total'                    => $slip_total,

                                        ]);


      

    }

    public function groupdelDigits(Request $request)
    {
        $id         = request()->id;

        $three_sale = ThreeType::find($id);

        $work_file_id   = $three_sale->work_file_id;
        $user_id        = $three_sale->user_id;
        $customer_id    = $three_sale->customer_id;
        $slip_id        = $three_sale->slip_id;
        $type           = $three_sale->type;


        $result_digits  = $this->Type_to_Digits($type);
        $digits_count   = count($result_digits)-1;

        $from           = $id;
        $to             = $id+$digits_count;



        DB::table('three_types')->where([ 
                                    ['work_file_id', '=', "$work_file_id"],
                                    ['user_id', '=', "$user_id"], 
                                    ['customer_id', '=', "$customer_id"], 
                                    ['slip_id', '=', "$slip_id"], 
                                    ['type', '=', "$type"], 

                                    ['id', '>=', "$from"],
                                    ['id', '<=', "$to"], 

                                ])->delete();

        DB::table('three_sales')->where([ 
                                    ['work_file_id', '=', "$work_file_id"],
                                    ['user_id', '=', "$user_id"], 
                                    ['customer_id', '=', "$customer_id"], 
                                    ['slip_id', '=', "$slip_id"], 
                                    ['type', '=', "$type"], 

                                    ['id', '>=', "$from"],
                                    ['id', '<=', "$to"], 

                                ])->delete();



        $three_sales = ThreeType::where([  

                                ["work_file_id","=",$work_file_id],
                                ["user_id","=",$user_id],
                                ["customer_id","=",$customer_id],
                                ["slip_id","=",$slip_id],
                            ])                            
                        ->get();


        return response()->json($three_sales);

    }

    public function delDigits(Request $request)
    {
        $id         = request()->id;

        $three_sale = ThreeType::find($id);

        $work_file_id   = $three_sale->work_file_id;
        $user_id        = $three_sale->user_id;
        $customer_id    = $three_sale->customer_id;
        $slip_id        = $three_sale->slip_id;


        DB::table('three_types')->where('id', '=', "$id")->delete();
        DB::table('three_sales')->where('id', '=', "$id")->delete();


         //Data Carry for View File
        $three_sales = ThreeType::where([  

                                    ["work_file_id","=",$work_file_id],
                                    ["user_id","=",$user_id],
                                    ["customer_id","=",$customer_id],
                                    ["slip_id","=",$slip_id],
                                ])                            
                            ->get();


        
                           

        return response()->json($three_sales);
    }

    public function showDigits(Request $request)
    {
        $work_file_id   = request()->work_file_id;  
        $user_id        = request()->user_id; 
        $customer_id    = 1;
        $slip_id        = request()->slip_id;

        //Data Carry for View File
        // $three_sales = ThreeType::where([  

        //                             ["work_file_id","=",$work_file_id],
        //                             ["user_id","=",$user_id],
        //                             ["customer_id","=",$customer_id],
        //                             ["slip_id","=",$slip_id],
        //                         ])                            
        //                     ->get();
               

       return redirect("/3dsale/add/$work_file_id?s_id=$slip_id");


    }

     public function getDigits(Request $request)
    {


        $work_file_id   = request()->work_file_id;  
        $user_id        = request()->user_id; 
        $type           = request()->digit;  
        $amount         = request()->amount;
        $r_amount       = request()->r_amount;

        $customer_id    = 1;
        $slip_id        = request()->slip_id;


       
        if(stripos($type,".") != null)
        {
            //same amount type logic
            $type_arr       = explode(".",$type);
            $count          = count($type_arr);
            $first_type     = $type_arr[0];
            $last_type      = $type_arr[$count-1];
            

            if(!is_numeric($first_type))
            {
                 array_shift($type_arr);
            }

            if(!is_numeric($last_type))
            {
                 array_pop($type_arr);
            }
            //same amount type logic
        }
        else
        {
            $result_digits  = $this->Type_to_Digits($type); 
        }
       
       
        // Calculate Slip
        if($slip_id == 0)
        {  
            $three_sales = ThreeType::where([                                           
                                        
                                        ["work_file_id","=",$work_file_id],
                                        ["user_id","=",$user_id],
                                        ["customer_id","=",$customer_id],

                                    ])
                                ->orderBy('id','desc')
                                ->first();

            if($three_sales != null)
            {   $slip_id = $three_sales->slip_id + 1; }
            else
            {   $slip_id = 1; }
           
        }
        else
        {   $slip_id = request()->slip_id; }        
        // End Calculate Slip


        

        if(stripos($type,".") != null)
        {
            //same amount type logic
            foreach ($type_arr as $type) 
            {
                if(!is_numeric($first_type))
                {
                    $type = $first_type.$type;
                }

                else if(!is_numeric($last_type))
                {
                    $type = $type.$last_type;
                }

                $result_digits  = $this->Type_to_Digits($type);

                $this->insertThreeType($work_file_id,$user_id,$customer_id,$slip_id,$type,$result_digits,$amount);

            }
            //same amount type logic

        }
        else
        {
            $this->insertThreeType($work_file_id,$user_id,$customer_id,$slip_id,$type,$result_digits,$amount);
        }


        //r_amount Digit Save
        if($this->r_amount != 0)
        {
            $type   = $this->r_digit;
            $amount = $this->r_amount;

            //dd($type. " / ".$amount);

           //Type => Digits               
            $result_digits  = $this->Type_to_Digits($type);
            //Type => Digits

            //Insert => Digits
            $this->insertThreeType($work_file_id,$user_id,$customer_id,$slip_id,$type,$result_digits,$amount);
            //End Insert => Digits
            

        }
        //End r_amount Digit Save



        //max table
        $over_digits    = array();

        $work_file_id   = request()->work_file_id;
        $max_minus      = request()->max_minus;

        $break_amt      = BreakAmount::where("work_file_id","=",$work_file_id)->value('amount');

        $sales          =    DB::table('three_sales')
                            ->leftJoin('threes', 'three_sales.digit', '=', 'threes.digit')
                            ->leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                            ->where([
                                        ["three_sales.work_file_id","=",$work_file_id],
                                        ['users.in_out', '=', 1],
                                    ])
                            ->groupBy('three_sales.digit')
                            ->selectRaw('three_sales.digit as digit, sum(three_sales.amount) as sum')                    
                            ->get();

        $purchases =    DB::table('three_sales')
                            ->leftJoin('threes', 'three_sales.digit', '=', 'threes.digit')
                            ->leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                            ->where([
                                        ["three_sales.work_file_id","=",$work_file_id],
                                        ['users.in_out', '=', 2],
                                    ])
                            ->groupBy('three_sales.digit')
                            ->selectRaw('three_sales.digit as digit, sum(three_sales.amount) as sum')                    
                            ->get();

        $threes    = Two::all();

        foreach ($threes as  $three) 
        {
           $three->sale_amount        = 0;
           $three->purchase_amount    = 0;
           $three->max_amount         = 0;

           $three->save();
        }



        foreach ($sales as $key => $sale) 
        {
            $id       = Two::where('digit','=',$sale->digit)->value('id');
            $three    = Two::find($id);


            $three->sale_amount = $sale->sum;
            $three->save();
            
        }

        foreach ($purchases as $key => $purchase) 
        {
            $id     = Two::where('digit','=',$purchase->digit)->value('id');
            $three    = Two::find($id);

            $three->purchase_amount = $purchase->sum;
            $three->save();
        }

        $threes    = Two::all();

        foreach ($threes as  $three) 
        {

            $balance = $three->sale_amount - $three->purchase_amount;

            if($balance > 0)
            {
                if($balance <= $break_amt)
                {
                    $three->max_amount = 0;
                }
                else
                {
                    $three->max_amount = $balance - $break_amt;
                }
            }
            else
            {
                $three->max_amount = $balance;
            }        


           if($three->max_amount > 0 && $max_minus == "Max")
           { $over_digits["$three->digit"] = $three->max_amount; }

           if($three->max_amount < 0 && $max_minus == "Minus")
           { $over_digits["$three->digit"] = $three->max_amount; }

           $three->save();

        }

        arsort($over_digits);

        $max_total = 0;

        foreach($over_digits as $key => $value)
        {
            if($max_minus == "Max" && $value > 0)
            {   $max_total += $value;   }

            if($max_minus == "Minus" && $value < 0)
            {   $max_total += $value;   }
        }

        //max table     


        //Data Carry for View File
        $three_sales = ThreeType::where([  

                                    ["work_file_id","=",$work_file_id],
                                    ["user_id","=",$user_id],
                                    ["customer_id","=",$customer_id],
                                    ["slip_id","=",$slip_id],
                                ])                            
                            ->get();
               

        return response()->json(array( 
                                        "three_sales" => $three_sales, 
                                        "over_digits" => $over_digits, 
                                        "max_total" => $max_total, 
                                    )
                                );
        
    }



    public function getOverBreakDigits(Request $request)
    {

        $work_file_id   = request()->work_file_id;

        $type           = request()->digit;  
        $amt            = request()->amount;

        $in_out         = request()->in_out;
        $max_minus      = request()->max_minus;

        $over_digits    = request()->over_digits;


        $result_digits  = $this->Type_to_Digits($type);

      
        // $o_digits = array();

        foreach ($result_digits as $digit) 
        {
          $key = $digit;

          // $key = array_search($digit, $over_digits);

          // if($key)
          // {
          //     $old_amt = $over_digits[$key];

             
          //     $new_amt = $old_amt - $amt;
            
          //     $over_digits[$key] = $new_amt; 
          // }


          if(array_key_exists($key, $over_digits)) 
          {
             
              $old_amt = $over_digits[$key];

             
              $new_amt = $old_amt - $amt;
            
              $over_digits[$key] = $new_amt;      
          }

          

        }
        

        $over_digits['789'] = 480;
        $over_digits['456'] = 480;
        $over_digits['123'] = 360;

        // $over_digits = $o_digits;  

        arsort($over_digits); 

        // $object = (object) $over_digits;

        return response()->json($over_digits);

    }

    public function ledgerList(Request $request)
    {

        //get Current work_file_id
        $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');
        // dd($work_file_id);

        if($work_file_id == null)
        {
            return back();
        }
        
             //Get Info
            $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');            
            $user_id        = Choice::where('auth_id','=',auth()->user()->id)->value('user_id');
            $customer_id    = Choice::where('auth_id','=',auth()->user()->id)->value('customer_id');

            $in_out         = Choice::where('auth_id','=',auth()->user()->id)->value('in_out');
            $max_minus      = Choice::where('auth_id','=',auth()->user()->id)->value('max_minus');
            $keyboard       = Choice::where('auth_id','=',auth()->user()->id)->value('keyboard');

            $slip           = Choice::where('auth_id','=',auth()->user()->id)->value('slip');
            $entry          = Choice::where('auth_id','=',auth()->user()->id)->value('entry');
            $view           = Choice::where('auth_id','=',auth()->user()->id)->value('view');
            //End Get Info     
     
      $slip_id     = 0;
      $in_out      = 1;
      $user_id     = 0;
     
      $work_files    = WorkFile::orderBy('id','desc')->get();

      if(auth()->user()->id == 1 || auth()->user()->id == 2)
      { 
        $users         = User::where('in_out','=',$in_out)->get(); 

        $loop_users      = User::where('in_out','=',$in_out)->get();  
      }
      else
      {
        $users         = User::where('id','=',auth()->user()->id)->get();  

        $loop_users      = User::where('id','=',auth()->user()->id)->get();  
      }
      

      return view('ledger.ledgerlist',[

                       
                            'work_file_id'    =>$work_file_id,
                            'user_id'       =>$user_id,
                            'customer_id'   =>$customer_id,
                            'slip_id'       =>$slip_id,
                            'in_out'       =>$in_out,

                            
                            'work_files'    =>$work_files,
                            'users'         =>$users,
                            'loop_users'    =>$loop_users,                         

                          ]);
    }

    public function ledgerListShow(Request $request)
    {
        //Get Info
            $work_file_id   = request()->work_file_id;           
            $user_id        = request()->user_id;
            $in_out         = request()->in_out;

            $customer_id    = Choice::where('auth_id','=',auth()->user()->id)->value('customer_id');
            $max_minus      = Choice::where('auth_id','=',auth()->user()->id)->value('max_minus');
            $keyboard       = Choice::where('auth_id','=',auth()->user()->id)->value('keyboard');

            $slip           = Choice::where('auth_id','=',auth()->user()->id)->value('slip');
            $entry          = Choice::where('auth_id','=',auth()->user()->id)->value('entry');
            $view           = Choice::where('auth_id','=',auth()->user()->id)->value('view');
        //End Get Info     
     
     
      $work_files    = WorkFile::orderBy('id','desc')->get();

      if(auth()->user()->id == 1 || auth()->user()->id == 2)
      { 
        $users         = User::where('in_out','=',$in_out)->get(); 

        if($user_id == 0)
        {
            $loop_users      = User::where('in_out','=',$in_out)->get(); 
        }
        else
        {
            $loop_users      = User::where('id','=',$user_id)->get(); 
        }
        
      }
      else
      {
        $users         = User::where('id','=',auth()->user()->id)->get();  

        $loop_users      = User::where('id','=',auth()->user()->id)->get(); 
      }   
    

      return view('ledger.ledgerlist',[

                       
                            'work_file_id'  =>$work_file_id,
                            'user_id'       =>$user_id,
                            'customer_id'   =>$customer_id,
                           
                            'in_out'        =>$in_out,

                            
                            'work_files'    =>$work_files,
                            'users'         =>$users,

                            'loop_users'         =>$loop_users,
                                                      

                          ]);
    }

    public function delThreeSale($id)
    {
        DB::table('three_types')->where('id', '=', "$id")->delete();

        return back()->with('info','Deleted Record Successfully!');
    }

    public function typedelThreeSale($id)
    {
        $three_type = ThreeType::find($id);

        $work_file_id   = $three_type->work_file_id;
        $user_id        = $three_type->user_id;
        $customer_id    = $three_type->customer_id;
        $slip_id        = $three_type->slip_id;
        $type           = $three_type->type;

        if(request()->action == "image")
        {
            $result_digits  = $this->Type_to_Digits($type);


        }
        else
        {
            $result_digits  = $this->Type_to_Padaythar_Two_Digits($type);


        }

        
        $digits_count   = count($result_digits)-1;

        $from           = $id;
        $to             = $id+$digits_count;


         DB::table('three_types')->where([ 

                                    ['work_file_id', '=', "$work_file_id"],
                                    ['user_id', '=', "$user_id"], 
                                    ['customer_id', '=', "$customer_id"], 
                                    ['slip_id', '=', "$slip_id"], 
                                    ['type', '=', "$type"], 

                                    ['id', '>=', "$from"],
                                    ['id', '<=', "$to"], 

                                ])->delete();

        return back()->with('info','Deleted Record Successfully!');

    }

    public function getUserTotal(Request $request)
    {

        $work_file_id   = request()->work_file_id; 
        $in_out         = request()->in_out;
        $user_id        = request()->user_id;

        $choice = Choice::where('auth_id','=',auth()->user()->id)->orderBy('id','desc')->first();        
                
                $choice->user_id = $user_id;

        $choice->save();


         $last_record = ThreeSale::where([  

                                    ["work_file_id","=",$work_file_id],
                                    ["user_id","=",$user_id],
                                    ["customer_id","=",1],
                                    
                                    
                                ])->orderBy('slip_id','desc')->first();

        if($last_record != null)
         {
            $last_slip = $last_record->slip_id; 
         }
         else
         {
           $last_slip = 0;
         }


        $slip_id = 0;

        $slip_total = ThreeSale::where([  

                                ["work_file_id","=",$work_file_id],
                                ["user_id","=",$user_id],
                                ["customer_id","=",1], 
                                // ["slip_id","=",$last_slip],                                    

                            ])->sum("amount");


         return response()->json( array( 

                                        "last_slip"     => $last_slip,                                       
                                        "slip_id"       => $slip_id, 
                                        "slip_total"    => $slip_total
                                    )
                                );
    }



}
