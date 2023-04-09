<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use DB;
use App\Admin;
use App\WorkFile;
use App\Commission;
use App\User;
use App\BreakAmount;

use App\TwoDigit;
use App\TwoSale;
use App\Two;

use App\Choice;

class TwoDigitController extends Controller
{
    public function listTwoDigit()
    {
        
    

        $work_files         = WorkFile::where('name','=','2D')->get();

        $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');

        if($work_file_id == null)
        {
            return back();
        }


        $break_amt      = BreakAmount::where("work_file_id","=",$work_file_id)->value('amount');

        $this->overBreakDigits($work_file_id);

        $all_total          = 0; 
        $total_sale         = Two::sum('sale_amount');
        $total_purchase     = Two::sum('purchase_amount');
        $all_total          = $total_sale - $total_purchase;


    	return view('twodigit.listtwodigit',[               
                                                'work_file_id'      => $work_file_id,
                                                'work_files'        => $work_files,
                                                
                                                'total_sale'        => $total_sale,
                                                'total_purchase'    => $total_purchase,
                                                'all_total'         => $all_total,
                                            ]);
    }
    public function listTwoDigitShow()
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

           
        return view('twodigit.listtwodigit',[               
                                                'work_file_id' => $work_file_id,
                                                'work_files'   => $work_files,
                                                
                                                'total_sale'   => $total_sale,
                                                'total_purchase' => $total_purchase,
                                                'all_total'    => $all_total,
                                            ]);
    }


    public function overBreakDigits($work_file_id)
    {
        

        $break_amt  = BreakAmount::where("work_file_id","=",$work_file_id)->value('amount');

        $sales      =    DB::table('two_sales')
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

          

        }

       
    }


    
}
