<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use App\Admin;
use App\WorkFile;
use App\FilePermission;

use App\User;
use App\Customer;

use App\TwoSale;
use App\ThreeSale;
use App\Commission;
use App\Choice;
use App\ThreePosition;

// use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

      //check activation
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

        

        // if($output != $admin->machine_id || $admin->user_name != "Myo Tun Naung" || $admin->company_name != "Classic_Digit") 
        // {  
        //   return redirect('/activate'); 
        // }

        // if($diff > 365)
        // { return redirect('/activate'); }
        //end check activation




              
       
        $today         = Carbon::today()->toDateString(); 
        $now           = Carbon::now()->toTimeString();

       //dd($today);

       if(WorkFile::where('date','<',$today)->exists())
       {
          $test1 = "Pass";
       }  
       

       if(WorkFile::where('date','>=',$today)->exists())
       {
          $test2 = "Future";
       }  

       //dd($test1. "/".$test2);


        //get 2D Workfiles
        if( WorkFile::where("name","=","2D")->exists() )
        {

            if((auth()->user()->id ==1 || auth()->user()->id == 2))
            { 

               if(WorkFile::where('date','<',$today)->exists())
               {
                  $two_workfiles = WorkFile::where([
                                      ["name","=","2D"],
                                      ["date","<",$today],
                                  ])
                              ->orderBy('id','desc')
                              ->take(2)
                              ->get();
               }               

               if(WorkFile::where('date','>=',$today)->exists())
               {
                  $two_workfiles = WorkFile::where([
                                      ["name","=","2D"],
                                      ["date",">=",$today],
                                  ])
                              ->orderBy('id','asc')
                              ->take(2)
                              ->get();
               }  


              // $two_workfiles = WorkFile::where([
              //                         ["name","=","2D"],
              //                     ])
              //                 ->orderBy('id','desc')
              //                 ->take(2)
              //                 ->get();




               

              $previous_two_workfiles  = WorkFile::where([
                                                ["name","=","2D"], 
                                                ["date","<",$today],                                               
                                            ])
                                        ->orderBy('id','desc')                                     
                                        ->get();


            }
            else
            { 
               $previous_two_workfiles = WorkFile::where("id","<",1)->get();

               $filepermission = FilePermission::where([                                           
                                      
                                      ["user_id","=",auth()->user()->id],
                                      ["twod_status","=",1],
                                  ])

                              ->first();

              if($filepermission != null)
              {
                  if(WorkFile::where('date','<',$today)->exists())
                 {
                    $two_workfiles = WorkFile::where([
                                        ["name","=","2D"],
                                        ["date","<",$today],
                                    ])
                                ->orderBy('id','desc')
                                ->take(2)
                                ->get();
                 }               

                 if(WorkFile::where('date','>=',$today)->exists())
                 {
                    $two_workfiles = WorkFile::where([
                                        ["name","=","2D"],
                                        ["date",">=",$today],
                                    ])
                                ->orderBy('id','asc')
                                ->take(2)
                                ->get();
                 }       
              }

            }

      }
      else
      {
        $two_workfiles          = WorkFile::where("id","<",1)->get();
        $previous_two_workfiles = WorkFile::where("id","<",1)->get();
      }
      //End get 2D Workfiles




      //get 3D Workfiles
      if( WorkFile::where("name","=","3D")->exists() )
      {

          if((auth()->user()->id ==1 || auth()->user()->id == 2))
          {
            $three_workfiles = WorkFile::where([                                           
                                    
                                    ["name","=","3D"],
                                    // ["date","<=",$today],
                                    // ["date",">=",$today],                                    
                                ])
                            ->orderBy('id','desc')
                            ->take(1)
                            ->get();

             $last_id = WorkFile::where([
                                          ["name","=","3D"],
                                      ])
                                  ->orderBy('id','desc')
                                  ->take(1)
                                  ->value('id');
            //dd($last_id);

            $previous_three_workfiles  = WorkFile::where([
                                              ["name","=","3D"],
                                              ["id","<=",$last_id-1],
                                          ])
                                      ->orderBy('id','desc')                                     
                                      ->get();

          }
          else
          {
            $previous_three_workfiles = WorkFile::where("id","<",1)->get();
            
            $filepermission = FilePermission::where([                                           
                                    
                                    ["user_id","=",auth()->user()->id],
                                    ["threed_status","=",1],
                                ])

                            ->first();

            if($filepermission != null)
            { 

              
                  $three_workfiles = WorkFile::where([                                           
                                    
                                  ["name","=","3D"],
                                  ["status","=",1],
                                    // ["open_time","<=",$now],
                                    // ["close_time",">=",$now],
                                ])
                            ->get();
              
            }

          }
    }
    else
    {
        $three_workfiles          = WorkFile::all();
        $previous_three_workfiles = WorkFile::where("id","<",1)->get();
    }
    //end get 3D Workfile

    $three_workfiles          = WorkFile::all();
    

         return view('home',[
                         // 'two_workfiles'            => $two_workfiles,
                         'previous_two_workfiles'   => $previous_two_workfiles,

                         'three_workfiles'          => $three_workfiles,
                         'previous_three_workfiles' => $previous_three_workfiles,

                         'now'                      => $now,
                         'today'                    => $today,
                         
                      ]);
   
    }


    public function slipListDetail(Request $request)
    {
      $work_file_id = request()->w_id;
      $user_id      = request()->u_id;
      $slip_id      = request()->s_id;

      $bet = request()->bet;

      $in_out       = User::where('id','=',$user_id)->value('in_out');

      if($bet == null)
      {
          $sales  =    ThreeSale::leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                          ->where([
                                ["three_sales.work_file_id","=",$work_file_id],
                                ["three_sales.user_id","=",$user_id],                                
                                ["three_sales.slip_id","=",$slip_id],

                                ["three_sales.amount","!=",0],
                                ["three_sales.status","=",1],
                                ["three_sales.confirm","=",1],

                                ['users.in_out', '=', $in_out],

                            ]) 
                    ->selectRaw('three_sales.*')                                   
                    ->get();
      }
      if($bet == "position")
      {
          $sales  =    ThreePosition::leftJoin('users', 'three_positions.user_id', '=', 'users.id')
                          ->where([
                                ["three_positions.work_file_id","=",$work_file_id],
                                ["three_positions.user_id","=",$user_id],                                
                                ["three_positions.slip_id","=",$slip_id],

                                ["three_positions.status","=",1],
                                ["three_positions.confirm","=",1],

                                ['users.in_out', '=', $in_out],

                            ]) 
                    ->selectRaw('three_positions.*')                                   
                    ->get();
      }
      


       return view('amountslip.amountsliplistdetail',[

                            'sales'         => $sales, 
                            'bet'           => $bet,

                            'work_file_id'  => $work_file_id,
                            'user_id'       => $user_id,
                            'slip_id'       => $slip_id,
                            
                          ]);

    }

    //အရောင်း စလစ်
    public function saleslipList()
    {
        $choice =  Choice::where('auth_id','=',auth()->user()->id)
                                    ->orderBy('id','desc')
                                    ->first();
      $work_file_id = $choice->work_file_id;

      // $work_file = WorkFile::find($work_file_id);

      $action = "Three";


      $two_am_work_file_id     = $work_file_id;
      $two_pm_work_file_id     = $work_file_id;

      $three_work_file_id      = $work_file_id;

      $user_id       = 0;
      $customer_id   = 1;
      $slip_id       = 0;

      //dd($work_file_id." / ". $user_id. " / ". $customer_id. " / ". $slip_id);


      $work_files    = WorkFile::orderBy('id','desc')->get();
      
      $in_out = 1;

      if(auth()->user()->id == 1 || auth()->user()->id == 2)
      { 
        $users         = User::all();
        $customers     = Customer::where([
                                          ['in_out','=',$in_out],
                                         

                                      ])->get();
      }
      else
      {
        $users         = User::where([
                                          ['id','=',auth()->user()->id],
                                         
                                      ])->get();
        
        $customers     = Customer::where([
                                          ['in_out','=',$in_out],
                                         

                                      ])->get();
      }
      

      $work_file     = WorkFile::find($work_file_id);
      $from_date     = $work_file->from_date;
      $to_date       = $work_file->to_date;

      //dd($work_file->name);

      
      if($user_id     == 0){ $user_op = ">="; }   else { $user_op = "="; }
      if($customer_id == 1){ $cu_op = ">="; }     else { $cu_op = "="; }
      if($slip_id     == 0){ $slip_op = ">="; }   else { $slip_op = "="; }


      // dd($work_file_id);


      

      if($work_file->name == "3D")
      {
          $action = "Three";

          if(auth()->user()->id == 1 || auth()->user()->id == 2)
          {
                $sales  =    ThreeSale::leftJoin('customers', 'three_sales.customer_id', '=', 'customers.id')
                          ->where([
                                ["three_sales.work_file_id","=",$work_file_id],
                                ["three_sales.user_id","$user_op",$user_id],
                                ["three_sales.customer_id","$cu_op",$customer_id],
                                ["three_sales.slip_id","$slip_op",$slip_id],

                                ["three_sales.status","=",1],
                                ["three_sales.confirm","=",1],

                                ['customers.in_out', '=', $in_out],

                            ]) 
                    ->selectRaw('three_sales.*')                                   
                    ->get();


              $slips            = ThreeSale::leftJoin('customers', 'three_sales.customer_id', '=', 'customers.id')
                                      ->where([                                           
                                                
                                                ["three_sales.work_file_id","=",$work_file_id],
                                                ["three_sales.user_id","$user_op",$user_id],
                                                ["three_sales.customer_id","$cu_op",$customer_id],
                                                ["three_sales.slip_id","$slip_op",$slip_id],

                                                ["three_sales.status","=",1],
                                                ["three_sales.confirm","=",1],

                                                ['customers.in_out', '=', $in_out],
                                            ])
                                        
                                        ->distinct()
                                        ->groupBy("three_sales.slip_id")
                                        ->select(['three_sales.slip_id',\DB::raw("SUM(three_sales.amount) as call_total")])
                                        ->get();

          }
          else
          {
                $sales  =    ThreeSale::leftJoin('customers', 'three_sales.customer_id', '=', 'customers.id')
                          ->where([
                                ["three_sales.work_file_id","=",$work_file_id],
                                ["three_sales.user_id","$user_op",$user_id],
                                ["three_sales.customer_id","$cu_op",$customer_id],
                                ["three_sales.slip_id","$slip_op",$slip_id],

                                ["three_sales.status","=",1],
                                ["three_sales.confirm","=",1],

                                ['customers.in_out', '=', $in_out],

                            ]) 
                    ->selectRaw('three_sales.*')                                   
                    ->get();


            $slips            = ThreeSale::leftJoin('customers', 'three_sales.customer_id', '=', 'customers.id')
                                    ->where([                                           
                                              
                                              ["three_sales.work_file_id","=",$work_file_id],
                                              ["three_sales.user_id","$user_op",$user_id],
                                              ["three_sales.customer_id","$cu_op",$customer_id],
                                              ["three_sales.slip_id","$slip_op",$slip_id],

                                              ["three_sales.status","=",1],
                                              ["three_sales.confirm","=",1],

                                              ['customers.in_out', '=', $in_out],
                                          ])
                                      
                                      ->distinct()
                                      ->groupBy("three_sales.slip_id")
                                      ->select(['three_sales.slip_id',\DB::raw("SUM(three_sales.amount) as call_total")])
                                      ->get();
          }
      }

      return view('saleslip.salesliplist',[

                            'from_date'     =>$from_date,
                            'to_date'       =>$to_date,

                            
                            'two_am_work_file_id'   =>$two_am_work_file_id,
                            'two_pm_work_file_id'   =>$two_pm_work_file_id,
                            'three_work_file_id'    =>$three_work_file_id,

                            'user_id'       =>$user_id,
                            'customer_id'   =>$customer_id,
                            'slip_id'       =>$slip_id,
                            'in_out'       =>$in_out,

                            
                            'work_files'    =>$work_files,
                            'users'         =>$users,
                            'customers'     =>$customers,

                            'slips'         =>$slips,
                            'sales'         =>$sales, 

                            'action'        =>$action,                          

                          ]);
    }
    public function saleslipListShow()
    {
      $action         = request()->action;

      $user_id        = Choice::where('auth_id','=',auth()->user()->id)->value('user_id');
      
      $three_work_file_id   = request()->three_work_file_id;

      $work_file      = WorkFile::find($three_work_file_id);

      $slip_id        = request()->slip_id;

      if($slip_id     == 0){ $slip_op = ">="; }   else { $slip_op = "="; }

      

      $work_files    = WorkFile::all();

    
      if($work_file->name == "3D")
      {
         $sales  =    ThreeSale::
                          where([
                                    ["work_file_id","=",$three_work_file_id],
                                    ["user_id","=",$user_id],                               
                                    ["slip_id","$slip_op",$slip_id],

                                    ["status","=",1],
                                    ["confirm","=",1],

                            ]) 
                    ->selectRaw('three_sales.*')                                   
                    ->get();


              $slips            = ThreeSale::
                                            where([                                           
                                                
                                                ["work_file_id","=",$three_work_file_id],
                                                ["user_id","=",$user_id],                               
                                                ["slip_id",">=",0],

                                                ["status","=",1],
                                                ["confirm","=",1],
                                               
                                            ])
                                        
                                        ->distinct()
                                        ->groupBy("slip_id")
                                        ->select(['slip_id',\DB::raw("SUM(amount) as call_total")])
                                        ->get();

         
      }

      return view('saleslip.salesliplist',[

                       
                            'three_work_file_id'  =>$three_work_file_id,


                            'user_id'       =>$user_id,
                            'slip_id'       =>$slip_id,

                            'work_files'    =>$work_files,
                            'sales'         =>$sales,

                   
                            'slips'         =>$slips,

                            'action'        =>$action,                        

                          ]);
    }
    //အရောင်း စလစ်


    //Start ရောင်းကြေး
    public function saleAmountList()
    {
        //get Current work_file_id
        $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');
        // dd($work_file_id);

        if($work_file_id == null)
        {
            return back();
        }
        
           
     
      $slip_id      = 0;
      $in_out       = 1;
    
      
      
      

      if(auth()->user()->id == 1 || auth()->user()->id == 2)
      { 
        $show_users    = User::where('in_out','=',$in_out)->get(); 
        $user_id       = 0;    

        $work_files    = WorkFile::all();
      }
      else
      {
        $show_users    = User::where('id','=',auth()->user()->id)->get();   
        $user_id       = User::where('id','=',auth()->user()->id)->value('id'); 

        $work_files    = WorkFile::where('id','=',$work_file_id)->get();    
      }
      

      $work_file     = WorkFile::find($work_file_id);
      $from_date     = $work_file->from_date;
      $to_date       = $work_file->to_date;

     
      if($user_id     == 0){ $user_op = ">="; }   else { $user_op = "="; }     
      if($slip_id     == 0){ $slip_op = ">="; }   else { $slip_op = "="; }



     $sale_users   = ThreeSale::leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                              ->where([                                           
                                        
                                        ["three_sales.work_file_id","=",$work_file_id],
                                        ["three_sales.user_id","$user_op",$user_id],
                                        ["slip_id","$slip_op",$slip_id],

                                        ["three_sales.status","=",1],
                                        ["three_sales.confirm","=",1],

                                        ['users.in_out', '=', $in_out],
                                    ]) 
                                        ->groupBy("three_sales.user_id")
                                        ->select('three_sales.user_id')
                                        ->get();
      $position_users   = ThreePosition::leftJoin('users', 'three_positions.user_id', '=', 'users.id')
                              ->where([                                           
                                        
                                        ["three_positions.work_file_id","=",$work_file_id],
                                        ["three_positions.user_id","$user_op",$user_id],
                                        ["slip_id","$slip_op",$slip_id],

                                        ["three_positions.status","=",1],
                                        ["three_positions.confirm","=",1],

                                        ['users.in_out', '=', $in_out],
                                    ]) 
                                        ->groupBy("three_positions.user_id")
                                        ->select('three_positions.user_id')
                                        ->get();


      $users = array();

      foreach ($sale_users as $sale_user) 
      {
        array_push($users, $sale_user->user_id); 
      }
      foreach ($position_users as $position_user) 
      {
        array_push($users, $position_user->user_id); 
      }

      sort($users);
      $users = array_unique($users);

        

      return view('saleamount.saleamountlist',[

                            'work_file_id'  => $work_file_id,
                            'user_id'       => $user_id,
                            'slip_id'       => $slip_id,
                            'in_out'        => $in_out,

                            'work_files'    =>  $work_files,
                            'users'         =>  $users,                              
                         
                            'show_users'    =>  $show_users,  
                         
                          ]);  
    }

    public function saleAmountListShow()
    {
        $work_file_id   = request()->work_file_id;
        $user_id        = request()->user_id;
        $in_out         = request()->in_out;
        $slip_id        = 0;

      

      if(auth()->user()->id == 1 || auth()->user()->id == 2)
      { 
        $show_users    = User::where('in_out','=',$in_out)->get();
        $work_files    = WorkFile::all();
      }
      else
      {
        $show_users    = User::where('id','=',auth()->user()->id)->get();  
        $work_files    = WorkFile::where('id','=',$work_file_id)->get();    
      }      
    
      $work_file     = WorkFile::find($work_file_id);

      $from_date     = $work_file->from_date;
      $to_date       = $work_file->to_date;
     

      if($user_id     == 0){ $user_op = ">="; }   else { $user_op = "="; }
      if($slip_id     == 0){ $slip_op = ">="; }   else { $slip_op = "="; }

    
     
      $sale_users   = ThreeSale::leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                              ->where([                                           
                                        
                                        ["three_sales.work_file_id","=",$work_file_id],
                                        ["three_sales.user_id","$user_op",$user_id],
                                        ["slip_id","$slip_op",$slip_id],

                                        ["three_sales.status","=",1],
                                        ["three_sales.confirm","=",1],

                                        ['users.in_out', '=', $in_out],
                                    ]) 
                                        ->groupBy("three_sales.user_id")
                                        ->select('three_sales.user_id')
                                        ->get();
      $position_users   = ThreePosition::leftJoin('users', 'three_positions.user_id', '=', 'users.id')
                              ->where([                                           
                                        
                                        ["three_positions.work_file_id","=",$work_file_id],
                                        ["three_positions.user_id","$user_op",$user_id],
                                        ["slip_id","$slip_op",$slip_id],

                                        ["three_positions.status","=",1],
                                        ["three_positions.confirm","=",1],

                                        ['users.in_out', '=', $in_out],
                                    ]) 
                                        ->groupBy("three_positions.user_id")
                                        ->select('three_positions.user_id')
                                        ->get();


      $users = array();

      foreach ($sale_users as $sale_user) 
      {
        array_push($users, $sale_user->user_id); 
      }
      foreach ($position_users as $position_user) 
      {
        array_push($users, $position_user->user_id); 
      }

      sort($users);
      $users = array_unique($users);

      
      return view('saleamount.saleamountlist',[

                            'work_file_id'  => $work_file_id,
                            'user_id'       => $user_id,
                            'slip_id'       => $slip_id,
                            'in_out'        => $in_out,

                            'work_files'    =>  $work_files,
                            'users'         =>  $users,                              
                         
                            'show_users'    =>  $show_users,  
                         
                          ]);      

     
    }

    //End ရောင်းကြေး

    //စလစ်
    public function slipList()
    {
        //get Current work_file_id
        $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');
        // dd($work_file_id);

        if($work_file_id == null)
        {
            return back();
        }
        
      
      // $choice =  Choice::where('auth_id','=',auth()->user()->id)
      //                               ->orderBy('id','desc')
      //                               ->first();

      // $work_file_id = $choice->work_file_id;

      
     
      $slip_id      = 0;
      $in_out       = 1;
    
      
      
      

      if(auth()->user()->id == 1 || auth()->user()->id == 2)
      { 
        $show_users    = User::where('in_out','=',$in_out)->get(); 
        $user_id       = 0;    

        $work_files    = WorkFile::all();
      }
      else
      {
        $show_users    = User::where('id','=',auth()->user()->id)->get();   
        $user_id       = User::where('id','=',auth()->user()->id)->value('id'); 

        $work_files    = WorkFile::where('id','=',$work_file_id)->get();    
      }
      

      $work_file     = WorkFile::find($work_file_id);
      $from_date     = $work_file->from_date;
      $to_date       = $work_file->to_date;

     
      if($user_id     == 0){ $user_op = ">="; }   else { $user_op = "="; }     
      if($slip_id     == 0){ $slip_op = ">="; }   else { $slip_op = "="; }


      $sale_users   = ThreeSale::leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                              ->where([                                           
                                        
                                        ["three_sales.work_file_id","=",$work_file_id],
                                        ["three_sales.user_id","$user_op",$user_id],
                                        ["slip_id","$slip_op",$slip_id],

                                        ["three_sales.status","=",1],
                                        ["three_sales.confirm","=",1],

                                        ['users.in_out', '=', $in_out],
                                    ]) 
                                        ->groupBy("three_sales.user_id")
                                        ->select('three_sales.user_id')
                                        ->get();
      $position_users   = ThreePosition::leftJoin('users', 'three_positions.user_id', '=', 'users.id')
                              ->where([                                           
                                        
                                        ["three_positions.work_file_id","=",$work_file_id],
                                        ["three_positions.user_id","$user_op",$user_id],
                                        ["slip_id","$slip_op",$slip_id],

                                        ["three_positions.status","=",1],
                                        ["three_positions.confirm","=",1],

                                        ['users.in_out', '=', $in_out],
                                    ]) 
                                        ->groupBy("three_positions.user_id")
                                        ->select('three_positions.user_id')
                                        ->get();


      $users = array();

      foreach ($sale_users as $sale_user) 
      {
        array_push($users, $sale_user->user_id); 
      }
      foreach ($position_users as $position_user) 
      {
        array_push($users, $position_user->user_id); 
      }

      sort($users);
      $users = array_unique($users);
      
      // dd($users);


      return view('amountslip.amountsliplist',[

                            'work_file_id'  => $work_file_id,
                            'user_id'       => $user_id,
                            'slip_id'       => $slip_id,
                            'in_out'        => $in_out,

                            'work_files'    =>  $work_files,
                            'users'         =>  $users,
                         
                            'show_users'    =>  $show_users,  
                         
                          ]);    

    }

    public function slipListShow()
    {
        $work_file_id   = request()->work_file_id;
        $user_id        = request()->user_id;
        $in_out         = request()->in_out;
        $slip_id        = 0;

      

      if(auth()->user()->id == 1 || auth()->user()->id == 2)
      { 
        $show_users    = User::where('in_out','=',$in_out)->get();
        $work_files    = WorkFile::all();
      }
      else
      {
        $show_users    = User::where('id','=',auth()->user()->id)->get();  
        $work_files    = WorkFile::where('id','=',$work_file_id)->get();    
      }      
    
      $work_file     = WorkFile::find($work_file_id);

      $from_date     = $work_file->from_date;
      $to_date       = $work_file->to_date;
     

      if($user_id     == 0){ $user_op = ">="; }   else { $user_op = "="; }
      if($slip_id     == 0){ $slip_op = ">="; }   else { $slip_op = "="; }

    
     
      $sale_users   = ThreeSale::leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                              ->where([                                           
                                        
                                        ["three_sales.work_file_id","=",$work_file_id],
                                        ["three_sales.user_id","$user_op",$user_id],
                                        ["slip_id","$slip_op",$slip_id],

                                        ["three_sales.status","=",1],
                                        ["three_sales.confirm","=",1],

                                        ['users.in_out', '=', $in_out],
                                    ]) 
                                        ->groupBy("three_sales.user_id")
                                        ->select('three_sales.user_id')
                                        ->get();
      $position_users   = ThreePosition::leftJoin('users', 'three_positions.user_id', '=', 'users.id')
                              ->where([                                           
                                        
                                        ["three_positions.work_file_id","=",$work_file_id],
                                        ["three_positions.user_id","$user_op",$user_id],
                                        ["slip_id","$slip_op",$slip_id],

                                        ["three_positions.status","=",1],
                                        ["three_positions.confirm","=",1],

                                        ['users.in_out', '=', $in_out],
                                    ]) 
                                        ->groupBy("three_positions.user_id")
                                        ->select('three_positions.user_id')
                                        ->get();


      $users = array();

      foreach ($sale_users as $sale_user) 
      {
        array_push($users, $sale_user->user_id); 
      }
      foreach ($position_users as $position_user) 
      {
        array_push($users, $position_user->user_id); 
      }

      sort($users);
      $users = array_unique($users);


      return view('amountslip.amountsliplist',[

                            'work_file_id'  => $work_file_id,
                            'user_id'       => $user_id,
                            'slip_id'       => $slip_id,
                            'in_out'        => $in_out,

                            'work_files'    =>  $work_files,
                            'users'         =>  $users,                              
                          
                            'show_users'    =>  $show_users,  
                         
                          ]);  
    }
    //စလစ်



    public function confirmList()
    {

        //get Current work_file_id
        $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');
        // dd($work_file_id);

        if($work_file_id == null)
        {
            return back();
        }
        
      
      $choice =  Choice::where('auth_id','=',auth()->user()->id)
                                    ->orderBy('id','desc')
                                    ->first();
      $work_file_id = $choice->work_file_id;

      
     
      $slip_id       = 0;

    
      $work_files    = WorkFile::orderBy('id','desc')->get();
      
      $in_out = 1;

      if(auth()->user()->id == 1 || auth()->user()->id == 2)
      { 
        $user_id        = 0;
        $users          = User::where('in_out','=',$in_out)->get();

        $loop_users     = User::where('in_out','=',$in_out)->get();

        $work_files     = WorkFile::all();
      }
      else
      {
        $user_id        = auth()->user()->id;
        
        $users          = User::where('id','=',auth()->user()->id)
                                ->orWhere('refer_user_id','=',auth()->user()->id)
                                ->get(); 

        $loop_users     = User::where('id','=',auth()->user()->id)
                                 ->orWhere('refer_user_id','=',auth()->user()->id)
                                 ->get();

        $work_files     = WorkFile::where('id','=',$work_file_id)->get();    
      }     
      

      $work_file     = WorkFile::find($work_file_id);
      $from_date     = $work_file->from_date;
      $to_date       = $work_file->to_date;

     
      if($user_id     == 0){ $user_op = ">="; }   else { $user_op = "="; }     
      if($slip_id     == 0){ $slip_op = ">="; }   else { $slip_op = "="; }


      if(auth()->user()->id == 1 || auth()->user()->id == 2)
          {


                $sales  =    ThreeSale::leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                          ->where([
                                ["three_sales.work_file_id","=",$work_file_id],
                                ["three_sales.user_id","$user_op",$user_id],                                
                                ["three_sales.slip_id","$slip_op",$slip_id],

                                ["three_sales.status","=",1],
                                ["three_sales.confirm","=",1],

                                ['users.in_out', '=', $in_out],

                            ]) 
                    ->selectRaw('three_sales.*')                                   
                    ->get();


              $slips       = ThreeSale::leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                                      ->where([                                           
                                                
                                                ["three_sales.work_file_id","=",$work_file_id],
                                                ["three_sales.user_id","$user_op",$user_id],
                                                ["three_sales.slip_id","$slip_op",$slip_id],

                                                ["three_sales.status","=",1],
                                                ["three_sales.confirm","=",1],

                                                ['users.in_out', '=', $in_out],
                                            ])
                                        
                                        ->distinct()
                                        ->groupBy("three_sales.slip_id")
                                        ->select(['three_sales.slip_id',\DB::raw("SUM(three_sales.amount) as call_total")])
                                        ->get();

              $show_slips = ThreeSale::leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                                      ->where([                                           
                                                
                                                ["three_sales.work_file_id","=",$work_file_id],
                                                ["three_sales.user_id","$user_op",$user_id],

                                                ["three_sales.status","=",1],
                                                ["three_sales.confirm","=",1],

                                                ['users.in_out', '=', $in_out],
                                            ])
                                        
                                        ->distinct()
                                        ->groupBy("three_sales.slip_id")
                                        ->select(['three_sales.slip_id',\DB::raw("SUM(three_sales.amount) as call_total")])
                                        ->get();

          }
          else
          {
                $sales  =    ThreeSale::leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                          ->where([
                                ["three_sales.work_file_id","=",$work_file_id],
                                ["three_sales.user_id","$user_op",$user_id],                                
                                ["three_sales.slip_id","$slip_op",$slip_id],

                                ["three_sales.status","=",1],
                                ["three_sales.confirm","=",1],

                                ['users.in_out', '=', $in_out],

                            ]) 
                    ->selectRaw('three_sales.*')                                   
                    ->get();


            $slips            = ThreeSale::leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                                    ->where([                                           
                                              
                                              ["three_sales.work_file_id","=",$work_file_id],
                                              ["three_sales.user_id","$user_op",$user_id],
                                              
                                              ["three_sales.slip_id","$slip_op",$slip_id],

                                              ["three_sales.status","=",1],
                                              ["three_sales.confirm","=",1],

                                              ['users.in_out', '=', $in_out],
                                          ])
                                      
                                      ->distinct()
                                      ->groupBy("three_sales.slip_id")
                                      ->select(['three_sales.slip_id',\DB::raw("SUM(three_sales.amount) as call_total")])
                                      ->get();

              $show_slips = ThreeSale::leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                                      ->where([                                           
                                                
                                                ["three_sales.work_file_id","=",$work_file_id],
                                                ["three_sales.user_id","$user_op",$user_id],

                                                ["three_sales.status","=",1],
                                                ["three_sales.confirm","=",1],

                                                ['users.in_out', '=', $in_out],
                                            ])
                                        
                                        ->distinct()
                                        ->groupBy("three_sales.slip_id")
                                        ->select(['three_sales.slip_id',\DB::raw("SUM(three_sales.amount) as call_total")])
                                        ->get();
          }



      $sale_users   = ThreeSale::leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                              ->where([                                           
                                        
                                        ["three_sales.work_file_id","=",$work_file_id],
                                        ["three_sales.user_id","$user_op",$user_id],
                                        ["slip_id","$slip_op",$slip_id],

                                        ["three_sales.status","=",1],
                                        ["three_sales.confirm","=",1],

                                        ['users.in_out', '=', $in_out],
                                    ]) 
                                        ->groupBy("three_sales.user_id")
                                        ->select('three_sales.user_id')
                                        ->get();
      $position_users   = ThreePosition::leftJoin('users', 'three_positions.user_id', '=', 'users.id')
                              ->where([                                           
                                        
                                        ["three_positions.work_file_id","=",$work_file_id],
                                        ["three_positions.user_id","$user_op",$user_id],
                                        ["slip_id","$slip_op",$slip_id],

                                        ["three_positions.status","=",1],
                                        ["three_positions.confirm","=",1],

                                        ['users.in_out', '=', $in_out],
                                    ]) 
                                        ->groupBy("three_positions.user_id")
                                        ->select('three_positions.user_id')
                                        ->get();


      $loop_users = array();

      foreach ($sale_users as $sale_user) 
      {
        array_push($loop_users, $sale_user->user_id); 
      }
      foreach ($position_users as $position_user) 
      {
        array_push($loop_users, $position_user->user_id); 
      }

      sort($loop_users);
      $loop_users = array_unique($loop_users);

      // dd($loop_users);

      return view('confirmlist',[

                            'from_date'     =>$from_date,
                            'to_date'       =>$to_date,

                          
                            'work_file_id'  =>$work_file_id,
                            'user_id'       =>$user_id,
                            'slip_id'       =>$slip_id,
                            'in_out'        =>$in_out,

                            
                            'work_files'    =>$work_files,
                            'users'         =>$users, 
                            'loop_users'    =>$loop_users,                          
                            'slips'         =>$slips,
                            'show_slips'    =>$show_slips,

                            'sales'         =>$sales, 
                          
                          ]);
    
    }

    public function confirmListShow()
    {
      

      $work_file_id   = request()->work_file_id;
      $user_id        = request()->user_id;
      $in_out         = request()->in_out;
      $slip_id        = request()->slip_id;

     
      $work_files    = WorkFile::all();

      if(auth()->user()->id == 1 || auth()->user()->id == 2)
      { 
         $users         = User::where('in_out','=',$in_out)->get();

        if($user_id != 0)
        {
          $loop_users         = User::where('id','=',$user_id)->get();
        }
        else
        {
          $loop_users         = User::where('in_out','=',$in_out)->get();
        }
        
      }
      else
      {
         $users          = User::where('id','=',auth()->user()->id)
                                ->orWhere('refer_user_id','=',auth()->user()->id)
                                ->get(); 

         $loop_users     = User::where('id','=',auth()->user()->id)
                                 ->orWhere('refer_user_id','=',auth()->user()->id)
                                 ->get();


        $in_out             = 1;
      }


    
      $work_file     = WorkFile::find($work_file_id);
      $from_date     = $work_file->from_date;
      $to_date       = $work_file->to_date;


      
     

      if($user_id     == 0){ $user_op = ">="; }   else { $user_op = "="; }
      if($slip_id     == 0){ $slip_op = ">="; }   else { $slip_op = "="; }


          if(auth()->user()->id == 1 || auth()->user()->id == 2)
          {
              $sales  =    ThreeSale::leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                                    ->where([
                                          ["three_sales.work_file_id","=",$work_file_id],
                                          ["three_sales.user_id","$user_op",$user_id],
                                          ["three_sales.slip_id","$slip_op",$slip_id],

                                          ["three_sales.status","=",1],
                                          ["three_sales.confirm","=",1],

                                          ['users.in_out', '=', $in_out],

                                      ]) 
                                    ->selectRaw('three_sales.*')                                   
                                    ->get();


              $slips            = ThreeSale::leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                                      ->where([                                           
                                                
                                                ["three_sales.work_file_id","=",$work_file_id],
                                                ["three_sales.user_id","$user_op",$user_id],
                                                ["three_sales.slip_id","$slip_op",$slip_id],

                                                ["three_sales.status","=",1],
                                                ["three_sales.confirm","=",1],

                                                ['users.in_out', '=', $in_out],
                                            ])
                                        
                                        ->distinct()
                                        ->groupBy("three_sales.slip_id")
                                        ->select(['three_sales.slip_id',\DB::raw("SUM(three_sales.amount) as call_total")])
                                        ->get();

              $show_slips = ThreeSale::leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                                      ->where([                                           
                                                
                                                ["three_sales.work_file_id","=",$work_file_id],
                                                ["three_sales.user_id","$user_op",$user_id],

                                                ["three_sales.status","=",1],
                                                ["three_sales.confirm","=",1],

                                                ['users.in_out', '=', $in_out],
                                            ])
                                        
                                        ->distinct()
                                        ->groupBy("three_sales.slip_id")
                                        ->select(['three_sales.slip_id',\DB::raw("SUM(three_sales.amount) as call_total")])
                                        ->get();

          }

          else
          {
                $sales  =    ThreeSale::leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                          ->where([
                                ["three_sales.work_file_id","=",$work_file_id],
                                ["three_sales.user_id","$user_op",$user_id],
                                ["three_sales.slip_id","$slip_op",$slip_id],

                                ["three_sales.status","=",1],
                                ["three_sales.confirm","=",1],

                                ['users.in_out', '=', $in_out],

                            ]) 
                    ->selectRaw('three_sales.*')                                   
                    ->get();


              $slips            = ThreeSale::leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                                      ->where([                                           
                                                
                                                ["three_sales.work_file_id","=",$work_file_id],
                                                ["three_sales.user_id","$user_op",$user_id],
                                                ["three_sales.slip_id","$slip_op",$slip_id],

                                                ["three_sales.status","=",1],
                                                ["three_sales.confirm","=",1],

                                                ['users.in_out', '=', $in_out],
                                            ])
                                        
                                        ->distinct()
                                        ->groupBy("three_sales.slip_id")
                                        ->select(['three_sales.slip_id',\DB::raw("SUM(three_sales.amount) as call_total")])
                                        ->get();

              $show_slips = ThreeSale::leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                                      ->where([                                           
                                                
                                                ["three_sales.work_file_id","=",$work_file_id],
                                                ["three_sales.user_id","$user_op",$user_id],

                                                ["three_sales.status","=",1],
                                                ["three_sales.confirm","=",1],

                                                ['users.in_out', '=', $in_out],
                                            ])
                                        
                                        ->distinct()
                                        ->groupBy("three_sales.slip_id")
                                        ->select(['three_sales.slip_id',\DB::raw("SUM(three_sales.amount) as call_total")])
                                        ->get();

          }




        $sale_users   = ThreeSale::leftJoin('users', 'three_sales.user_id', '=', 'users.id')
                              ->where([                                           
                                        
                                        ["three_sales.work_file_id","=",$work_file_id],
                                        ["three_sales.user_id","$user_op",$user_id],
                                        ["slip_id","$slip_op",$slip_id],

                                        ["three_sales.status","=",1],
                                        ["three_sales.confirm","=",1],

                                        ['users.in_out', '=', $in_out],                                        
                                    ]) 
                                        ->groupBy("three_sales.user_id")
                                        ->select('three_sales.user_id')
                                        ->get();

        $outlet_users   = User::where('refer_user_id','=',$user_id)                                        
                                        ->select('id')
                                        ->get();
        // dd($outlet_users);




      $position_users   = ThreePosition::leftJoin('users', 'three_positions.user_id', '=', 'users.id')
                              ->where([                                           
                                        
                                        ["three_positions.work_file_id","=",$work_file_id],
                                        ["three_positions.user_id","$user_op",$user_id],
                                        ["slip_id","$slip_op",$slip_id],

                                        ["three_positions.status","=",1],
                                        ["three_positions.confirm","=",1],

                                        ['users.in_out', '=', $in_out],
                                    ]) 
                                        ->groupBy("three_positions.user_id")
                                        ->select('three_positions.user_id')
                                        ->get();


      $loop_users = array();

      foreach ($sale_users as $sale_user) 
      {
        array_push($loop_users, $sale_user->user_id); 
      }
      
       foreach ($outlet_users as $outlet_user) 
      {
        array_push($loop_users, $outlet_user->id); 
      }

      foreach ($position_users as $position_user) 
      {
        array_push($loop_users, $position_user->user_id); 
      }

      sort($loop_users);
      $loop_users = array_unique($loop_users);

    


      return view('confirmlist',[

                            'from_date'     =>$from_date,
                            'to_date'       =>$to_date,                            
                           
                            'work_file_id'  =>$work_file_id,
                            'user_id'       =>$user_id,
                            'slip_id'       =>$slip_id,
                            'in_out'         =>$in_out,
                            
                            'work_files'    =>$work_files,
                            'users'         =>$users,
                            'loop_users'    =>$loop_users,
                            'slips'         =>$slips,

                            'slips'         =>$slips,
                            'show_slips'    =>$show_slips,

                            'sales'         =>$sales,                        

                          ]);
    }

    public function delSlipConfirmList($w_id,$u_id,$s_id)
    {
        $bet = request()->bet;

        // $three_sale = ThreeSale::find($id);

        $work_file_id   = $w_id;
        $user_id        = $u_id;
        $customer_id    = 1;
        $slip_id        = $s_id;



        if($bet == null)
        {

            DB::table('three_sales')->where([ 
                                              ['work_file_id', '=', "$work_file_id"], 
                                              ['user_id', '=', "$user_id"], 
                                              ['customer_id', '=', "$customer_id"], 
                                              ['slip_id', '=', "$slip_id"], 

                                            ] )->delete();

            DB::table('three_types')->where([ 
                                              ['work_file_id', '=', "$work_file_id"], 
                                              ['user_id', '=', "$user_id"], 
                                              ['customer_id', '=', "$customer_id"], 
                                              ['slip_id', '=', "$slip_id"], 

                                            ] )->delete();

        }

        if($bet == "position")
        {
            DB::table('three_positions')->where('id', '=', "$id")->delete();
        }

        return back()->with('info',"Record Deleted Successfully");

    }

    public function delConfirmList($id)
    {
       $bet = request()->bet;

      if($bet == null)
      {

          DB::table('three_sales')->where('id', '=', "$id")->delete();

          DB::table('three_types')->where('id', '=', "$id")->delete();

      }

      if($bet == "position")
      {
          DB::table('three_positions')->where('id', '=', "$id")->delete();
      }

      return back()->with('info',"Record Deleted Successfully");

    }
    public function updConfirmList($id)
    {
       $bet = request()->bet;

       if($bet == null)
      {
          $three_sale = ThreeSale::find($id);

           return view('updconfirmlist',[
                         
                          'three_sale'    =>$three_sale,                                    

                        ]);
      }

      if($bet == "position")
      {
          $three_sale = ThreePosition::find($id);

          return view('updposconfirmlist',[
                         
                          'three_sale'    =>$three_sale,                                    

                        ]);
      }


       

      
    }
    public function updateConfirmList($id)
    {
        $validator = validator(request()->all(),
            [              
              'amount'      => ['required'],                

            ]);

        if($validator->fails())
        {
            return back()->with('info',"Data is Blank!!!");
        }

        $bet = request()->bet;

        if($bet == null)
        {
            $three_sale = ThreeSale::find($id);

              $three_sale->digit    = request()->digit;
              $three_sale->amount   = request()->amount;

            $three_sale->save();
        }

        if($bet == "position")
        {
            $three_sale = ThreePosition::find($id);

              $three_sale->d1    = request()->d1;
              $three_sale->d2    = request()->d2;

              $three_sale->amount   = request()->amount;
                      
            $three_sale->save();
        }


        

        return redirect('/confirm/list')->with('info',"Record Updated Successfully");
    }

}
