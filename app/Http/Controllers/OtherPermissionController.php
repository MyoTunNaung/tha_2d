<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use DB;
use App\Admin;
use App\WorkFile;
use App\Hot;
use App\User;
use App\Customer;
use App\DigitPermission;
use App\Commission;
use App\Choice;
use App\OtherPermission;


class OtherPermissionController extends Controller
{
    public function listOtherPermission()
    {    	
            //Get Info
            $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');
            // $slip           = Choice::where('auth_id','=',auth()->user()->id)->value('slip');

            // $user_id        = Choice::where('auth_id','=',auth()->user()->id)->value('user_id');
            // $choice         = Choice::where('auth_id','=',$user_id)->first();
          
            // $user_id        = $choice->user_id;
            // $customer_id    = $choice->customer_id;
            // $in_out         = $choice->in_out;
            // $entry          = $choice->entry;
            // $view           = $choice->view;
            // $keyboard       = $choice->keyboard;
            // $max_minus      = $choice->max_minus;           
            //End Get Info

        if($work_file_id == null)
        {
            return back();
        }


        return redirect("/otherpermission/add/$work_file_id");

    }   

    

    public function addOtherPermission(Request $request)
    {
             
        if(request()->action == "Show")
        {
            $work_file_id   =   request()->work_file_id;

            $user_id        =   request()->user_id;
            $user_name      =   User::where("id","=",$user_id)->value('name'); 

            if($user_name == null)
            { 
                $user_name = "All"; 

                $old_permissions = OtherPermission::where([

                                ["work_file_id","=",$work_file_id],
                                // ["user_id","=",$user_id],
                            
                                ["status","=",1],
                                ["confirm","=",1],
                            ])                            
                        ->get();
            }
            else
            {
                $old_permissions = OtherPermission::where([

                                ["work_file_id","=",$work_file_id],
                                ["user_id","=",$user_id],
                            
                                ["status","=",1],
                                ["confirm","=",1],
                            ])                            
                        ->get();
            }

        }
        else
        {   
            $work_file_id   = request()->id;

            $user_id        = 0;
            $user_name      = "All";

            $old_permissions = OtherPermission::where([

                                ["work_file_id","=",$work_file_id],
                                // ["user_id","=",$user_id],
                            
                                ["status","=",1],
                                ["confirm","=",1],
                            ])                            
                        ->get();
            

        }


         $users             = User::where([ 

                                        ['id','>',2], 
                                        ['in_out','=',1], 

                                    ])->get();     


         $new_permissions = OtherPermission::where([
                                ["work_file_id","=",$work_file_id],
                                ["user_id","=",$user_id],                              

                                ["status","=",1],
                                ["confirm","=",0],
                            ])                            
                        ->get();


      
       $work_files = WorkFile::all();


      

        return view('otherpermission.addotherpermission',[ 

                                            'work_file_id'       => $work_file_id,
                                            'user_id'            => $user_id,

                                            'work_files'         => $work_files, 
                                            'users'              => $users,                                    
                                            
                                            'user_name'          => $user_name,

                                            
                                            'old_permissions'    => $old_permissions, 
                                            'new_permissions'    => $new_permissions, 
                                         

                                    ]);
       
        
    }

    public function createOtherPermission()
    {
        $validator = validator(request()->all(),
            [
                "w_id"          => "required",
                "u_id"          => "required",
           

                "digit_amount"      => "required",
                "total_amount"      => "required",

                // "file"              => "required",
                // "max"               => "required",

                "special_amount"    => "required",
                               
            ]);

        if($validator->fails())
        {
            return back()->with('info',"Data can not be Blank!!!");
        }

        $work_file_id   = request()->w_id;
        $user_id        = request()->u_id;

        $digit_amount   = request()->digit_amount;
        $total_amount   = request()->total_amount;

        $file           = request()->file;
        $max            = request()->max;

        $special_amount = request()->special_amount;

        if (OtherPermission::where([    ['work_file_id', '=', $work_file_id],
            							['user_id', '=', $user_id],

                            ])->exists()) 
        {
           return back()->with('info',"Already Exist! Please Update!");
        }
        else
        {
            $status = 1;
        }



        $other_permission = new OtherPermission();

                      
            $other_permission->work_file_id     = $work_file_id;
            $other_permission->user_id     		= $user_id;          

         
            $other_permission->digit_amount     = $digit_amount;
            $other_permission->total_amount     = $total_amount;


            $other_permission->file            = $file;
            $other_permission->max             = $max;

            $other_permission->special_amount  = $special_amount;

            $other_permission->status           = $status;
            $other_permission->confirm          = 1;

        $other_permission->save();


     
        $work_files     = WorkFile::all();

         $users             = User::where([ 

                                        ['id','>',2], 
                                        ['in_out','=',1], 

                                    ])->get();     

        $user_name      = User::where("id","=",$user_id)->value('name'); 




        $old_permissions = OtherPermission::where([
                                ["work_file_id","=",$work_file_id],
                                ["user_id","=",$user_id],
                              
                                ["status","=",1],
                                ["confirm","=",1],
                            ])                            
                        ->get();


         $new_permissions = OtherPermission::where([
                                ["work_file_id","=",$work_file_id],
                                ["user_id","=",$user_id],
                           
                                ["status","=",1],
                                ["confirm","=",0],
                            ])                            
                        ->get();


        return view('otherpermission.addotherpermission',[ 

                                        'work_file_id'       => $work_file_id,
                                        'user_id'            => $user_id,

                                        'work_files'         => $work_files, 
                                        'users'              => $users,                                    
                                        
                                        'user_name'          => $user_name,
                                        
                                        'old_permissions'    => $old_permissions, 
                                        'new_permissions'    => $new_permissions, 
                                             

                                    ]);

    }

    public function saveOtherPermission()
    {
       
        $work_file_id = request()->id;

        $other_permissions = OtherPermission::where([
                                ["work_file_id","=",$work_file_id ],
                                ["status","=",1]
                            ])                            
                        ->get();

        foreach ($other_permissions as $other_permission) 
        {
            $other_permission->confirm = 1;
            $other_permission->save();
        }

        DB::table('other_permissions')->where('status', '=', 0)->delete();

        return redirect("/otherpermission/add/{$work_file_id}");

    }

    public function delOtherPermission($id)
    {
    	$other_permissions = OtherPermission::find($id);
        $work_file_id = $other_permissions->work_file_id;



        DB::table('other_permissions')->where('id', '=', "$id")->delete();
                
        return redirect("/otherpermission/add/{$work_file_id}")->with('info',"Digit Permission delete Successfully!!!");
    }
    public function delAllOtherPermission($w_id)
    {
        
        $work_file_id = $w_id;

        DB::table('other_permissions')->where('id', '>', 0)->delete();
                
        return redirect("/otherpermission/add/{$work_file_id}")->with('info',"All Deleted Successfully!");
    }

   

   
}
