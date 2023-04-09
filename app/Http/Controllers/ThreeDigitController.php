<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use DB;
use App\Admin;
use App\WorkFile;
use App\Commission;
use App\User;

use App\ThreeDigit;
use App\ThreeSale;

use App\Choice;
use App\BreakAmount;
use App\Three;
use App\Two;


class ThreeDigitController extends Controller
{
   public function listThreeDigit()
    {
        

        $work_files     = WorkFile::where('name','=','2D')->get();

        $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');

        if($work_file_id == null)
        {
            return back();
        }


        $break_amt      = BreakAmount::where("work_file_id","=",$work_file_id)->value('amount');

        $users    = User::where('in_out','=',1)->get();

        $user_id  = 0;


        $this->overBreakDigits($work_file_id,$user_id,$break_amt);

        $all_total          = 0; 
        $total_sale         = Two::sum('sale_amount');
        $total_purchase     = Two::sum('purchase_amount');
        $all_total          = $total_sale - $total_purchase;


        $threes = Two::all();

        foreach ($threes as $key => $three) 
        {
            $three->all_amount      = 0;
            $three->percent_amount  = 0;

            $three->save();
        }

        $total_all_amount           = null;
        $total_percent_amount       = null;

        $digit_count_all_amount     = Two::where('max_amount','>',0)->count();
        $digit_count_percent_amount = null;

        $all_amount     = "All";
        $percent_amount = "Percent";


       


    	return view('threedigit.listthreedigit',[
                                                    'work_file_id'      => $work_file_id,
                                                    'work_files'        => $work_files,

                                                    'users'             => $users,
                                                    'user_id'           => $user_id,

                                                    'break_amt'         => $break_amt,
                                                
                                                    'total_sale'        => $total_sale,
                                                    'total_purchase'    => $total_purchase,
                                                    'all_total'         => $all_total,

                                                    'threes'            => $threes,

                                                    'total_all_amount'      => $total_all_amount,
                                                    'total_percent_amount'  => $total_percent_amount,

                                                    'all_amount'        => $all_amount,
                                                    'percent_amount'    => $percent_amount,

                                                    'digit_count_all_amount'        => $digit_count_all_amount,
                                                    'digit_count_percent_amount'    => $digit_count_percent_amount,

                                                ]);
    }
    public function listThreeDigitShow()
    {

        $work_file_id    = request()->work_file_id;

        $user_id         = request()->user_id;

        $break_amt       = request()->break_amt;



        $work_files      = WorkFile::where('name','=','2D')->get();

        $users    = User::where('in_out','=',1)->get();


        // $break_amt       = BreakAmount::where("work_file_id","=",$work_file_id)->value('amount');

        $this->overBreakDigits($work_file_id,$user_id,$break_amt);

        //Total Amount
        $all_total      = 0;      

        $total_sale     = Two::sum('sale_amount');
        $total_purchase = Two::sum('purchase_amount');

        $all_total      = $total_sale - $total_purchase;
        //Total Amount


      
       $threes = Two::all();

       foreach ($threes as $key => $three) 
        {
            $three->all_amount = 0;
            $three->percent_amount = 0;

            $three->save();
        }

        $total_all_amount           = null;
        $total_percent_amount       = null;

        $digit_count_all_amount     = null;
        $digit_count_percent_amount = null;

        $all_amount                 = "All";
        $percent_amount             = "Percent";


        return view('threedigit.listthreedigit',[
                                                    'work_file_id'      => $work_file_id,
                                                    'work_files'        => $work_files,

                                                    'users'             => $users,
                                                    'user_id'           => $user_id,

                                                    'break_amt'         => $break_amt,

                                                    
                                                    'total_sale'        => $total_sale,
                                                    'total_purchase'    => $total_purchase,
                                                    'all_total'         => $all_total,

                                                    'threes'            => $threes,

                                                    'total_all_amount'      => $total_all_amount,
                                                    'total_percent_amount'  => $total_percent_amount,

                                                    'all_amount'        => $all_amount,
                                                    'percent_amount'    => $percent_amount,

                                                    'digit_count_all_amount'        => $digit_count_all_amount,
                                                    'digit_count_percent_amount'    => $digit_count_percent_amount,


                                                ]);
    }


    public function overBreakDigits($work_file_id,$user_id,$break_amt)
    {
        if($user_id     == 0){ $user_op = ">="; }   else { $user_op = "="; }


        // $break_amt  = BreakAmount::where("work_file_id","=",$work_file_id)->value('amount');

        $sales      =    DB::table('three_sales')
                            ->leftJoin('twos', 'three_sales.digit', '=', 'twos.digit')
                            ->leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                            ->where([
                                        ["three_sales.work_file_id","=",$work_file_id],
                                        ['users.in_out', '=', 1],
                                        ['users.id', "$user_op", $user_id],

                                    ])
                            ->orWhere([
                                        ["three_sales.work_file_id","=",$work_file_id],
                                        ['users.in_out', '=', 1],
                                        ['users.refer_user_id', "=", $user_id],

                                        ])
                            ->groupBy('three_sales.digit')
                            ->selectRaw('three_sales.digit as digit, sum(three_sales.amount) as sum')                    
                            ->get();

       


        $purchases =    DB::table('three_sales')
                            ->leftJoin('twos', 'three_sales.digit', '=', 'twos.digit')
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
                else if( $three->purchase_amount == $three->sale_amount)
                {
                     $three->max_amount = 0;
                }
                else
                {
                    $three->max_amount = ($three->sale_amount - $break_amt) - $three->purchase_amount;
                }
           }


           $three->save();

          

        }

       
    }

    public function gameplayThreeDigit()
    {
        $work_file_id    = request()->work_file_id;

        $work_files      = WorkFile::where('name','=','2D')->get();

        $break_amt       = BreakAmount::where("work_file_id","=",$work_file_id)->value('amount');

        $this->overBreakDigits($work_file_id);

        //Total Amount
        $all_total      = 0;      

        $total_sale     = Two::sum('sale_amount');
        $total_purchase = Two::sum('purchase_amount');
        $all_total      = $total_sale - $total_purchase;
        //Total Amount

        $all_amount         = request()->all;
        $percent_amount     = request()->percent;

        // dd(" $all_amount / $percent_amount ");

        if(is_numeric($all_amount))
        {
            $threes = Two::all();

            foreach ($threes as $key => $three) 
            {
                $tmp_amount = $three->sale_amount - $three->purchase_amount;

                if($tmp_amount > $break_amt)
                {
                    $tmp_amount = $break_amt;
                }


                if($all_amount <= $tmp_amount )
                {
                    $three->all_amount = $all_amount;                    
                }
                else
                {
                    $three->all_amount = $tmp_amount;
                }

                $three->percent_amount = 0;

                $three->save();


            }

        //Total All 
            $total_all_amount           = Two::sum('all_amount');
            $digit_count_all_amount     = Two::where('all_amount','!=',0)->count();

           
            $total_percent_amount       = null;
            $digit_count_percent_amount = null;
            $percent_amount             = "Percent";
        //Total All 
       

        return view('threedigit.listthreedigit',[
                                                    'work_file_id'      => $work_file_id,
                                                    'work_files'        => $work_files,
                                                    
                                                    'total_sale'        => $total_sale,
                                                    'total_purchase'    => $total_purchase,
                                                    'all_total'         => $all_total,

                                                    'threes'            => $threes,

                                                    'total_all_amount'      => $total_all_amount,
                                                    'total_percent_amount'  => $total_percent_amount,

                                                    'all_amount'        => $all_amount,
                                                    'percent_amount'    => $percent_amount,

                                                    'digit_count_all_amount'        => $digit_count_all_amount,
                                                    'digit_count_percent_amount'    => $digit_count_percent_amount,

                                                ]);

        }
        
        if(is_numeric($percent_amount))
        {
            $threes = Two::all();

            foreach ($threes as $key => $three) 
            {
                $tmp_amount = $three->sale_amount - $three->purchase_amount;

                if($tmp_amount > $break_amt)
                {
                    $tmp_amount = $break_amt;
                }

                $three->percent_amount = ($tmp_amount * $percent_amount/100)/100;

                $three->all_amount = 0;
                $three->save();

            }


        //Total All 
            $total_percent_amount           = Two::sum('percent_amount');
            $digit_count_percent_amount     = Two::where('percent_amount','!=',0)->count();

            $total_all_amount               = null;
            $digit_count_all_amount         = null;
            $all_amount                     = "All";
        //Total All 
       

        return view('threedigit.listthreedigit',[
                                                    'work_file_id'      => $work_file_id,
                                                    'work_files'        => $work_files,
                                                    
                                                    'total_sale'        => $total_sale,
                                                    'total_purchase'    => $total_purchase,
                                                    'all_total'         => $all_total,

                                                    'threes'            => $threes,

                                                    'total_all_amount'      => $total_all_amount,
                                                    'total_percent_amount'  => $total_percent_amount,

                                                    'all_amount'        => $all_amount,
                                                    'percent_amount'    => $percent_amount,

                                                    'digit_count_all_amount'        => $digit_count_all_amount,
                                                    'digit_count_percent_amount'    => $digit_count_percent_amount,

                                                ]);

        }


        
    }
    
}
