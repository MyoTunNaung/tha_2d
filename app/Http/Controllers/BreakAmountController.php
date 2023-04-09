<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use DB;
use App\Admin;
use App\WorkFile;
use App\BreakAmount;
use App\User;
use App\Commission;
use App\Choice;


class BreakAmountController extends Controller
{
    public function listBreakAmount()
    {
        // //check activation
        // $output = shell_exec("echo | C:\windows\System32\wbem\wmic.exe path win32_computersystemproduct get uuid");
        // $output = preg_replace("/[ \r\n]*/","",$output);
        // //dd($output);

        // $admin = Admin::where([
                                            
        //                       ])                                                    
                                
        //                     ->orderBy('id','desc')  
        //                     ->first(); 

        // if ($admin === null) 
        // {
        //     return redirect('/activate');
        // }                            

        // $date   = Carbon::parse($admin->start_date);
        // $now    = Carbon::now();
        // $diff   = $date->diffInDays($now);        

        

        // if($output != $admin->machine_id || $admin->user_name != "Myo Tun Naung" || $admin->company_name != "Classic") 
        // {  
        //   return redirect('/activate'); 
        // }

        // if($diff > 365)
        // { return redirect('/activate'); }
        // //end check activation


        //get Current work_file_id
        $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');
        // dd($work_file_id);

        if($work_file_id == null)
        {
            return back();
        }

    

        $now            = Carbon::now();

        $today          = Carbon::today()->toDateString();       
        
        $monday         = $now->startOfWeek()->toDateString();
        $friday         = $now->startOfWeek()->add(4,'day')->toDateString();

        
        $from_date    = $monday;
        $to_date      = $friday;
        $name         = "2D";


        //get Current work_file_id
        $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');

        // dd($work_file_id);

        if($work_file_id == null)
        {
            return back();
        }


        $from_date    = WorkFile::where('id','=',$work_file_id)->value('from_date');
        $to_date      = WorkFile::where('id','=',$work_file_id)->value('to_date');
        $name         = WorkFile::where('id','=',$work_file_id)->value('name');
        //end get Current work_file_id


    	$break_amounts 		      = BreakAmount::where('work_file_id','=',$work_file_id)->get();

        $previous_break_amounts   = DB::table('break_amounts')
                                            ->leftJoin('work_files', 'break_amounts.work_file_id', '=', 'work_files.id')
                                            ->where([
                                                        ["work_files.id","!=",$work_file_id],
                                                        ['work_files.name', '=', "$name"],
                                                        ['work_files.date', '>=', $from_date],
                                                        ['work_files.date', '<=', $to_date],
                                                        
                                                    ])
                                            ->select('break_amounts.*')
                                            ->get();


    	return view('break.listbreak',[
                                        'break_amounts'             => $break_amounts,
                                        'previous_break_amounts'    => $previous_break_amounts,
                                        'from_date'                 => $from_date,
                                        'to_date'                   => $to_date,
                                        'name'                      => $name,
                                    ]);
    }
    public function listBreakAmountShow()
    {
        $name         = request()->select_name;
        $from_date    = request()->select_from_date;
        $to_date      = request()->select_to_date;
        
        $work_files     = WorkFile::all();

        //get Current work_file_id
        $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');
        //end get Current work_file_id


        $amount            = BreakAmount::where('work_file_id','=',$work_file_id)->value('amount');
      
        $previous_break_amounts   = DB::table('break_amounts')
                                            ->leftJoin('work_files', 'break_amounts.work_file_id', '=', 'work_files.id')
                                            ->where([
                                                        
                                                        ['work_files.name', '=', "$name"],
                                                        ['work_files.date', '>=', $from_date],
                                                        ['work_files.date', '<=', $to_date],
                                                        
                                                    ])
                                            ->select('break_amounts.*')
                                            ->get();

        // dd($name);

        return view('break.addbreak',[
                                        'work_files'                => $work_files,
                                        'work_file_id'              => $work_file_id,

                                        'amount'                    => $amount,
                                        'previous_break_amounts'    => $previous_break_amounts,
                                        'from_date'                 => $from_date,
                                        'to_date'                   => $to_date,
                                        'name'                      => $name,

                                    ]);
    }

    public function addBreakAmount()
    {

        //get Current work_file_id
        $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');
        // dd($work_file_id);

        if($work_file_id == null)
        {
            return back();
        }


    	$work_files = WorkFile::all();

       
        $now            = Carbon::now();
        $today          = Carbon::today()->toDateString();
        $monday         = $now->startOfWeek()->toDateString();
        $friday         = $now->startOfWeek()->add(4,'day')->toDateString();

        $from_date      = $monday;
        $to_date        = $friday;
        $name           = "2D";

        //get Current work_file_id
        $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');

        // dd($work_file_id);
       

        if($work_file_id == null)
        {
            return back();
        }


        $from_date    = WorkFile::where('id','=',$work_file_id)->value('from_date');
        $to_date      = WorkFile::where('id','=',$work_file_id)->value('to_date');
        $name         = WorkFile::where('id','=',$work_file_id)->value('name');
        //end get Current work_file_id


        $amount            = BreakAmount::where('work_file_id','=',$work_file_id)->value('amount');

        $previous_break_amounts   = DB::table('break_amounts')
                                            ->leftJoin('work_files', 'break_amounts.work_file_id', '=', 'work_files.id')
                                            ->where([
                                                        ["work_files.id","!=",$work_file_id],
                                                        ['work_files.name', '=', "$name"],
                                                        ['work_files.date', '>=', $from_date],
                                                        ['work_files.date', '<=', $to_date],
                                                        
                                                    ])
                                            ->select('break_amounts.*')
                                            ->get();

    	

    	return view('break.addbreak',[
    									'work_files'			    => $work_files,
    									'work_file_id' 	            => $work_file_id,

                                        'amount'                    => $amount,
                                        'previous_break_amounts'    => $previous_break_amounts,
                                        'from_date'                 => $from_date,
                                        'to_date'                   => $to_date,
                                        'name'                      => $name,

    								]);


    }
    public function createBreakAmount(Request $request)
    {
    	$validator = validator(request()->all(),
    		[
    			"work_file_id" 	   => "required",
    			"amount"   		   => "required",
    			"status"           => "required", 
                               
    		]);

    	if($validator->fails())
    	{
    		return back()->with('info',"Data can not be Blank!!!");
    	}

        if (BreakAmount::where('work_file_id', '=', request()->work_file_id)->exists()) 
        {
           return back()->with('info',"Already Exist!!!");
        }

       
        $break_amount = new BreakAmount();

        	$break_amount->work_file_id           = request()->work_file_id; 
            
            $break_amount->amount                 = request()->amount;              
            $break_amount->status                 = request()->status;
                      
    	$break_amount->save();
    	
        return redirect('/break/list')->with('info',"Breack Amount Added Successfully!!!");
    }

    public function delBreakAmount($id)
    {
    	DB::table('break_amounts')->where('id', '=', "$id")->delete();
                
        return redirect('/break/add')->with('info',"Break Amount delete Successfully!!!");
    }
    public function updBreakAmount()
    {
    	$work_files         = WorkFile::all();


        $work_file_id = Choice::where('auth_id','=',auth()->user()->id)->orderBy('id','desc')->value('work_file_id');

        //get Current work_file_id
        $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');
        // dd($work_file_id);

        if($work_file_id == null)
        {
            return back();
        }
        

    	$break_amount       = BreakAmount::where('work_file_id','=',$work_file_id)->first();

        
        return view('break.updbreak',[ 	'work_files' 	  => $work_files,
        								'break_amount'    => $break_amount,
                                        'work_file_id'    => $work_file_id,
        								
        							         ]);
    }
    public function updateBreakAmount()
    {
    	$validator = validator(request()->all(),
            [
                "work_file_id"      => "required",
                "amount"                 => "required",
                "status"          => "required",             
            ]);

        if($validator->fails())
        {
            return back()->with('info',"Data can not be Blank!!!");
        }
        
        $work_file_id = request()->work_file_id;

        $break_amount = BreakAmount::where('work_file_id','=',request()->work_file_id)->first();

        	$break_amount->work_file_id           = request()->work_file_id; 
            
            $break_amount->amount                 = request()->amount;              
            $break_amount->status                 = request()->status;        
           
    	$break_amount->save();

        return redirect("/3dsale/add/{$work_file_id}");
    }

    public function saveBreak(Request $request)
    {
        $work_file_id   = request()->work_file_id;
        $keep_break     = request()->keep_break;


        $break_amount_files  = BreakAmount::where('work_file_id','=',$work_file_id)
                                        ->orderBy('id','desc')
                                        ->take(1)
                                        ->get();
                                        
        foreach ($break_amount_files as  $break_amount_file) 
        {
            $break_amount_file->status = $keep_break;
        
            $break_amount_file->save();

        }
    }
}
