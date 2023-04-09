<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use Illuminate\Support\Carbon;

use Carbon\Carbon;
use Carbon\CarbonPeriod;


use DB;
use App\Admin;
use App\WorkFile;
use App\Commission;
use App\User;
use App\BreakAmount;
use App\Hot;
use App\DigitPermission;
use App\OtherPermission;
use App\Choice;

class WorkFileController extends Controller
{
   public function listWorkFile()
    {
        $now            = Carbon::now();

        $today          = Carbon::today()->toDateString();       
        
        $monday         = $now->startOfWeek()->toDateString();
        $friday         = $now->startOfWeek()->add(4,'day')->toDateString();

        
        $from_date    = $monday;
        $to_date      = $friday;
        $name         = "2D";
    
    	$workfiles 		= WorkFile::where([ 
                                    
                                    ["name","=",$name],
                                    ["date",">=",$from_date],
                                    ["date","<=",$to_date],
                                    
                                ])
                            ->get();

    	return view('workfile.listworkfile',[
                                                'workfiles'=>$workfiles,
                                                'from_date'=>$from_date,
                                                'to_date'=>$to_date,
                                                'name'=>$name,

                                            ]);
    }
    public function listWorkFileShow()
    {
        $name         = request()->select_name;
        $from_date    = request()->select_from_date;
        $to_date      = request()->select_to_date;
        

        $workfiles = WorkFile::where([ 
                                    
                                    ["name","=",$name],
                                    ["date",">=",$from_date],
                                    ["date","<=",$to_date],
                                    
                                ])
                            ->get();

        $now            = Carbon::now();

        $today          = Carbon::today()->toDateString();       
        
        $monday         = $now->startOfWeek()->toDateString();
        $friday         = $now->startOfWeek()->add(4,'day')->toDateString();

     
       return view('workfile.addworkfile',[

                                            'monday'  => $monday,
                                            'friday'  => $friday,
                                            'today'   => $today,

                                            'workfiles'=>$workfiles,
                                            'from_date'=>$from_date,
                                            'to_date'=>$to_date,
                                            'name'=>$name,


                                            ]);


    }

    public function detailWorkFile($id)
    {
        

        $workfiles      = WorkFile::where('id','=',$id)->get();

        return view('workfile.detailworkfile',[ 
                                                'workfiles'=>$workfiles,
                                               
                                             ]);
    }
    public function addWorkFile()
    {
        
        $now         = Carbon::now();
        $today       = Carbon::today()->toDateString();       
        
        if($now->dayOfWeek >= 1 && $now->dayOfWeek <= 5)
        {
            $monday       = $now->startOfWeek()->toDateString();
            $friday       = $now->startOfWeek()->add(4,'day')->toDateString();

            // dd(" $monday - $friday ");
        }
        else if($now->dayOfWeek >= 6)
        {
            $monday       = $now->add(2,'day')->toDateString();
            $friday       = $now->add(4,'day')->toDateString();

            // dd(" $monday - $friday ");
        }
        else
        {
            $monday       = $now->add(1,'day')->toDateString();
            $friday       = $now->add(4,'day')->toDateString();

           // dd(" $monday - $friday ");
        }

        
        $from_date    = $monday;
        $to_date      = $friday;
        $name         = "2D";
    
        $workfiles      = WorkFile::where([ 
                                    
                                    ["name","=",$name],
                                   
                                ])
                            ->get();

          

    	return view('workfile.addworkfile',[

                                            'monday'  => $monday,
                                            'friday'  => $friday,
                                            'today'   => $today,

                                            'workfiles'=>$workfiles,
                                            'from_date'=>$from_date,
                                            'to_date'=>$to_date,
                                            'name'=>$name,


    								        ]);
    }
    public function createWorkFile(Request $request)
    {
    	$validator = validator(request()->all(),
    		[
                "from_date"         => "required",
                "to_date"           => "required",

                "am_open_time"     => "required",
                "am_close_time"     => "required",

                "pm_open_time"     => "required",
                "pm_close_time"     => "required",

                "break_amount"      => "required",


    			// "name" 	   		=> "required",
    			// "date"   		=> "required",
    			// "duration"      => "required",
                // "open_time"     => "required",
                // "time"          => "required",
                // "times"     	=> "required",
                // "show"     	     => "required",
                // "result_digit"    => "required",
               
    		]);

    	if($validator->fails())
    	{
    		return back()->with('info',"Data can not be Blank!!!");
    	}


        if( WorkFile::where([
                                ['name','=',request()->name],
                                ['duration','=',request()->duration],
                                ['date','=',request()->date],


                            ])->exists() )
        {
            return back()->with('info','Already Exist !');

        }
        
        if(WorkFile::exists())
        {
            $last = DB::table('work_files')->orderBy('id','desc')->first();

            $last_work_file_id = $last->id;

            // last2 = DB::table('items')->orderBy('id', 'DESC')->first();
        }
        else
        {
            $last_work_file_id = null;
        }


        //Test
            $period = CarbonPeriod::create(request()->from_date, request()->to_date);

            // Iterate over the period
            foreach ($period as $date) 
            {
                $loop_date =  $date->format('d-m-Y');

                //For AM
                $workfile = new WorkFile();

                    $workfile->name         = "2D";
                    $workfile->date         = $date;              
                    $workfile->duration     = "AM";

                    $workfile->open_time    = request()->am_open_time;
                    $workfile->close_time   = request()->am_close_time;

                    $workfile->from_date    = request()->from_date;
                    $workfile->to_date      = request()->to_date;
                   
                    $workfile->show         = "2D"." AM [".request()->am_close_time." ]"."{".$loop_date."}";
                    $workfile->result_digit = "-";

                    // $workfile->time         = request()->time;
                    // $workfile->times        = request()->times;

                    // $workfile->status       = request()->status;
                    // $workfile->position_bet = request()->position_bet;
                   
                $workfile->save();
                // For AM

                //BreakAmount
                    $break_amount = new BreakAmount();
                    
                    $break_amount->work_file_id = $workfile->id;
                    $break_amount->amount       = request()->break_amount;
                    $break_amount->status       = 0;
                    
                    $break_amount->save();
                //End BreakAmount

                // For PM
                 $workfile = new WorkFile();

                    $workfile->name         = "2D";
                    $workfile->date         = $date;              
                    $workfile->duration     = "PM";

                    $workfile->open_time    = request()->pm_open_time;
                    $workfile->close_time   = request()->pm_close_time;

                    $workfile->from_date    = request()->from_date;
                    $workfile->to_date      = request()->to_date;
                   
                    $workfile->show         = "2D"." PM [".request()->pm_close_time." ]"."{".$loop_date."}";
                    $workfile->result_digit = "-";

                $workfile->save();
                // For PM

                //BreakAmount
                    $break_amount = new BreakAmount();
                    
                    $break_amount->work_file_id = $workfile->id;
                    $break_amount->amount       = request()->break_amount;
                    $break_amount->status       = 0;
                    
                    $break_amount->save();
                //End BreakAmount

                // echo "$loop_date"."<br>";
            }

        //End Test
        

        



        $new_work_file_id = $workfile->id;

        // dd("$new_work_file_id / $last_work_file_id");


        //Copy Hots , Digit Permission, Other Permission
        if(is_numeric($last_work_file_id))
        {
            // dd($last_work_file_id);

            //Hots
            $old_hots   = DB::table('hots')
                        ->leftJoin('work_files', 'hots.work_file_id', '=', 'work_files.id')
                        ->where([
                                    ["hots.work_file_id","=",$last_work_file_id],
                                    ["work_files.name","=",request()->name],
                                    ['work_files.duration', '=', request()->duration],                               
                                    
                                ])
                        ->select('hots.*')
                        ->get();

            foreach ($old_hots as $old_hot) 
            {
                $hot = new Hot();
                          
                    $hot->work_file_id     = $new_work_file_id;
                    $hot->slip_id          = $old_hot->slip_id;

                    $hot->type             = $old_hot->type;
                    $hot->digit            = $old_hot->digit;

                    $hot->status           = 1;
                    $hot->confirm          = 1;

                $hot->save();
            }
            //End Hots

            //Digit Permission
            $old_digit_permissions   = DB::table('digit_permissions')
                        ->leftJoin('work_files', 'digit_permissions.work_file_id', '=', 'work_files.id')
                        ->where([
                                    ["digit_permissions.work_file_id","=",$last_work_file_id],
                                    ["work_files.name","=",request()->name],
                                    ['work_files.duration', '=', request()->duration],                               
                                    
                                ])
                        ->select('digit_permissions.*')
                        ->get();

            foreach ($old_digit_permissions as $old_digit_permission) 
            {
                $digit_permission = new DigitPermission();
                          
                    $digit_permission->work_file_id     = $new_work_file_id;
                    $digit_permission->user_id          = $old_digit_permission->user_id;
                   
                    $digit_permission->type             = $old_digit_permission->type;
                    $digit_permission->digit            = $old_digit_permission->digit;

                    $digit_permission->digit_percent    = $old_digit_permission->digit_percent;
                    $digit_permission->type_sale        = $old_digit_permission->type_sale;
                   
                    $digit_permission->status           = 1;
                    $digit_permission->confirm          = 1;

                $digit_permission->save();
            }
            //Digit Permission

            //Other Permission
            $old_other_permissions   = DB::table('other_permissions')
                        ->leftJoin('work_files', 'other_permissions.work_file_id', '=', 'work_files.id')
                        ->where([
                                    ["other_permissions.work_file_id","=",$last_work_file_id],
                                    ["work_files.name","=",request()->name],
                                    ['work_files.duration', '=', request()->duration],                               
                                    
                                ])
                        ->select('other_permissions.*')
                        ->get();

            foreach ($old_other_permissions as $old_other_permission) 
            {
                $other_permission = new OtherPermission();
                      
                    $other_permission->work_file_id     = $new_work_file_id;
                    $other_permission->user_id          = $old_other_permission->user_id;          

                 
                    $other_permission->digit_amount     = $old_other_permission->digit_amount;
                    $other_permission->total_amount     = $old_other_permission->total_amount;


                    $other_permission->file            = $old_other_permission->file;
                    $other_permission->max             = $old_other_permission->max;

                    $other_permission->special_amount  = $old_other_permission->special_amount;

                    $other_permission->status           = 1;
                    $other_permission->confirm          = 1;

                $other_permission->save();
            }
            //Other Permission


        }
        //Copy Hots , Digit Permission, Other Permission

        
       

        

       return redirect('/workfile/add')->with('info',"WorkFile Added Successfully!!!");
    }

    public function delWorkFile($id)
    {

        // dd("Here");
        //Clean All Related with work_file_id

        DB::table('break_amounts')->where('work_file_id', '=', "$id")->delete();
        DB::table('cashes')->where('work_file_id', '=', "$id")->delete();
        DB::table('digit_permissions')->where('work_file_id', '=', "$id")->delete();
        DB::table('hots')->where('work_file_id', '=', "$id")->delete();
        DB::table('other_permissions')->where('work_file_id', '=', "$id")->delete();
        DB::table('position_bets')->where('work_file_id', '=', "$id")->delete();
        DB::table('results')->where('work_file_id', '=', "$id")->delete();
        DB::table('three_positions')->where('work_file_id', '=', "$id")->delete();
        DB::table('three_sales')->where('work_file_id', '=', "$id")->delete();
        DB::table('three_types')->where('work_file_id', '=', "$id")->delete();

        $choices = Choice::where('work_file_id','=',$id)->get();
        foreach ($choices as $choice) 
        {
            $choice->work_file_id = NULL;

            $choice->save();
        }

        //Clean All Related with work_file_id

    	DB::table('work_files')->where('id', '=', "$id")->delete();
                
        return redirect('/workfile/add')->with('info',"WorkFile delete Successfully!!!");
    }
    public function updWorkFile($id)
    {
    	
    	$work_file    = WorkFile::find($id);
        
        

        if($work_file->upload == 0)
        {
            $work_file->upload = 1;
        }
        else
        {
            $work_file->upload = 0;
        }

        $work_file->save();   

        return redirect('/workfile/add');

        // return view('workfile.updworkfile',[ 	
        // 								            'work_file'    => $work_file,
        								
        // 							         ]);
    }
    public function updateWorkFile(Request $request, $id)
    {
    	$validator = validator(request()->all(),
            [
                "upload" 	   		=> "required",
    			  
            ]);

        if($validator->fails())
        {
            return back()->with('info',"Data can not be Blank!!!");
        }

        $work_file = WorkFile::find($id);

        	
            $work_file->upload = request()->upload;
                        
           
    	$work_file->save();

        return redirect('/workfile/add')->with('info',"WorkFile was Successfully Updated !!!");
    }

    public function openWorkFile(Request $request)
    {
        $work_file_id   = request()->w_id;
        
        $work_file  = WorkFile::find($work_file_id);
                                        
        $work_file->status = 1;
        
        $work_file->save();

        return back()->with('info',"Open Already!!!");
    }
    public function closeWorkFile(Request $request)
    {
        $work_file_id   = request()->w_id;
        
        $work_file  = WorkFile::find($work_file_id);
                                        
        $work_file->status = 0;
        
        $work_file->save();


        return back()->with('info',"Close Already!!!");
    }


}
