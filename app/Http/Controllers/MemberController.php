<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Member;
use DB;

class MemberController extends Controller
{
    
   public function listMember()
    {
    	
        $members        = Member::all();

        return view('member.listmember',['members'=>$members]);
    }

    public function addMember()
    {        
        return view('member.addmember');
    }

    public function createMember(Request $request)
    {
        $validator = validator(request()->all(),
            [
                'name'      => ['required', 'string', 'max:255'],
                'percent'   => ['required'],
                
            ]);

        if($validator->fails())
        {
            return back()->with('info',"Data can not be Blank!!!");
        }

        $member = new Member();

            $member->name     	= request()->name;
            $member->percent   	= request()->percent;
            
        $member->save();

        return redirect('/member/list')->with('info',"New Member Added Successfully!!!");

    }
    public function delMember($id)
    {
        DB::table('members')->where('id', '=', "$id")->delete();
                
        return redirect('/member/list')->with('info',"Member delete Successfully!!!");
    }
    public function updMember($id)
    {
        $member = Member::find($id);

        return view('member.updmember',['member' => $member]);
    }

    public function updateMember($id)
    {
        $validator = validator(request()->all(),
            [
                'name'      => ['required', 'string', 'max:255'],
                'percent'   => ['required'],
                
            ]);

        if($validator->fails())
        {
            return back()->with('info',"Data can not be Blank!!!");
        }

        $member = Member::find($id);

            $member->name     	= request()->name;
            $member->percent   	= request()->percent;
            
        $member->save();

        return redirect('/member/list')->with('info',"Member Updated Successfully!!!");
    }
}
