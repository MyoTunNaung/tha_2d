<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use DB;
use App\Admin;
use App\FilePermission;
use App\User;
use App\Choice;

class FilePermissionController extends Controller
{
    public function listFilePermission()
    {
         //get Current work_file_id
        $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');
        // dd($work_file_id);

        if($work_file_id == null)
        {
            return back();
        }

    	$users 					= User::all();
        $file_permissions       = FilePermission::all();

        return view('filepermission.listfilepermission',[
        													'file_permissions'=>$file_permissions,
        													'users'=>$users,
        												]);
    }

    public function addFilePermission()
    {
    	$user = User::find(request()->user_id);

        return view('filepermission.addfilepermission',[ 'user' => $user ]);
    }

    public function createFilePermission(Request $request)
    {
        $validator = validator(request()->all(),
            [
                'user_id'      		=> ['required', 'string', 'max:255'],
                'twod_status'    	=> ['required', 'string', 'max:255'],
                'threed_status'    	=> ['required', 'string', 'max:255'],
                
            ]);

        if($validator->fails())
        {
            return back()->with('info',"Data can not be Blank!!!");
        }

        $filepermission = new FilePermission();

            $filepermission->user_id     	= request()->user_id;
            $filepermission->twod_status   	= request()->twod_status;
            $filepermission->threed_status  = request()->threed_status;
            
        $filepermission->save();

        return redirect('/filepermission/list')->with('info',"New File Permission Added Successfully!!!");

    }
    public function delFilePermission($id)
    {
        DB::table('file_permissions')->where('id', '=', "$id")->delete();
                
        return redirect('/filepermission/list')->with('info',"FilePermission delete Successfully!!!");
    }
    public function updFilePermission($id)
    {
        $filepermission = FilePermission::find($id);

        return view('filepermission.updfilepermission',['filepermission' => $filepermission]);
    }

    public function updateFilePermission($id)
    {
        $validator = validator(request()->all(),
            [
                'user_id'      		=> ['required', 'string', 'max:255'],                
                'twod_status'    	=> ['required', 'string', 'max:255'],                
            ]);

        if($validator->fails())
        {
            return back()->with('info',"Data can not be Blank!!!");
        }

        $filepermission = FilePermission::find($id);

            $filepermission->user_id      = request()->user_id;           
            $filepermission->twod_status  = request()->twod_status;
            
        $filepermission->save();

        return redirect('/filepermission/list')->with('info',"File Permission Updated Successfully!!!");
    }
}
