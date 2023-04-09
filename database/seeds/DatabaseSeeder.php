<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        //Admin Data
        $date         = Carbon::create(2022, 1, 1, 0, 0, 0);
        factory(App\Admin::class)->create([
            "user_name" => "Myo Tun Naung",
            "company_name"=> "Classic_Digit", 
            "machine_id"=> "UUID4C4C4544-0033-3710-804A-B7C04F445431",
            "start_date"=> $date,
        ]);
        //End Admin Data

        //Users Data
        factory(App\User::class)->create([
            "name"       => "THA1",
            'password'   => Hash::make('tha1357'),  
            "pass"       => "tha1357",
            "in_out"     => 1, 
            "type"       => "User",  
                     
        ]);

        factory(App\User::class)->create([
            "name"      => "THA2",
            'password'  => Hash::make('tha2468'), 
            "pass"      => "tha2468",   
            "in_out"    => 1, 
            "type"      => "User", 
        ]);       
        //End Users Data

        //Members Data
        factory(App\Member::class)->create([
            "name"     => "K",
            'percent'  => 50,           
        ]);

        factory(App\Member::class)->create([
            "name"     => "T",
            'percent'  => 10,           
        ]);  

        factory(App\Member::class)->create([
            "name"     => "N",
            'percent'  => 10,           
        ]);   

        factory(App\Member::class)->create([
            "name"     => "M",
            'percent'  => 20,           
        ]);   

        factory(App\Member::class)->create([
            "name"     => "TN",
            'percent'  => 10,           
        ]);   
        //End Members Data
        
        //Choice Data
        factory(App\Choice::class)->create([

            "auth_id"           =>1,
            "user_id"           =>1,
            "customer_id"       =>1,

            "in_out"            =>1,
            "entry"             =>"Cash",
            "view"              =>"Cash",
            "keyboard"          =>"On",
            "max_minus"         =>"Max",
            "slip"              =>"None",
             
        ]);

        factory(App\Choice::class)->create([

            "auth_id"           =>2,
            "user_id"           =>2,
            "customer_id"       =>1,

            "in_out"            =>1,
            "entry"             =>"Cash",
            "view"              =>"Cash",
            "keyboard"          =>"On",
            "max_minus"         =>"Max",
            "slip"              =>"None",
             
        ]);


        //Commission Data
        factory(App\Commission::class)->create([

            "user_id"           =>1,
            "customer_id"       =>1,

            "agent"             =>0,
            "agent_percent"     =>0,
            "refer_user_id"     =>0,

            "twod_comm"         =>15,
            "twod_times"        =>80,

            "threed_comm"       =>20,            
            "threed_times"      =>550,

            "twod_hotpercent"   =>100,
            "threed_hotpercent" =>100,
             
        ]);

        factory(App\Commission::class)->create([

            "user_id"           =>2,
            "customer_id"       =>1,

            "agent"             =>0,
            "agent_percent"     =>0,
            "refer_user_id"     =>0,

            "twod_comm"         =>15,
            "twod_times"        =>80,

            "threed_comm"       =>20,            
            "threed_times"      =>550,

            "twod_hotpercent"   =>100,
            "threed_hotpercent" =>100,
             
        ]);

        //File Permission
        factory(App\FilePermission::class)->create([        

            
            "user_id"              =>1,

            "twod_status"          =>1,                     
            "threed_status"        =>1,
            
                     
        ]); 
        factory(App\FilePermission::class)->create([        

            
            "user_id"              =>2,

            "twod_status"          =>1,                     
            "threed_status"        =>1,
            
                     
        ]); 
        //End File Permission

        //Customer 
        factory(App\Customer::class)->create([

            "name"      => "None",
            "in_out"    => 1,          
            
        ]);   
        factory(App\Customer::class)->create([

            "name"      => "None",
            "in_out"    => 2,          
            
        ]);   
        //End Customer

        // factory(App\Commission::class)->create([

        //     "user_id"           =>3,
        //     "customer_id"       =>0,

        //     "agent"             =>1,
        //     "agent_percent"     =>50,
        //     "refer_user_id"     =>1,

        //     "twod_comm"         =>10,
        //     "twod_times"        =>75,

        //     "threed_comm"       =>15,            
        //     "threed_times"      =>500,

        //     "twod_hotpercent"   =>50,
        //     "threed_hotpercent" =>50,
             
        // ]);

        // factory(App\Commission::class)->create([

        //     "user_id"           =>4,
        //     "customer_id"       =>0,

        //     "agent"             =>1,
        //     "agent_percent"     =>25,
        //     "refer_user_id"     =>2,

        //     "twod_comm"         =>5,
        //     "twod_times"        =>70,

        //     "threed_comm"       =>10,            
        //     "threed_times"      =>500,

        //     "twod_hotpercent"   =>25,
        //     "threed_hotpercent" =>25,
             
        // ]);
        //End Commission Data

        //WorkFile Data
        // $date         = Carbon::today()->toDateString();

        // $from_date              =  $date;
        // $to_date                =  $date;

        // $three_to_date          =  $date;

        // $two_open_time          = Carbon::create(2022, 1, 1, 00, 00, 00);
        // $two_close_time         = Carbon::create(2022, 1, 1, 23, 59, 59);  
                

        // $three_open_time        = Carbon::create(2021, 1, 1, 0, 0, 0);
        // $three_close_time       = Carbon::create(2021, 1, 1, 23, 59, 59); 


        // //$today        = Carbon::today()->toDateString();
        // $result_time            = Carbon::create(2022, 1, 1, 12, 00, 00);

        // factory(App\WorkFile::class)->create([        

        //     "name"          =>"2D",

        //     "date"          =>$date,
        //     "duration"      =>"AM",
            
        //     "open_time"     =>$two_open_time,
        //     "close_time"    =>$two_close_time,

        //     "time"          =>$result_time,

        //     "times"         =>"",
            
        //     "from_date"     =>$from_date,
        //     "to_date"       =>$to_date, 

        //     "show"          =>"2D AM [$date]",
        //     "result_digit"  =>"",            
             
        // ]);        

        // $result_time            = Carbon::create(2022, 1, 1, 16, 00, 00);
        // factory(App\WorkFile::class)->create([        

        //     "name"          =>"2D",

        //     "date"          =>$date,
        //     "duration"      =>"PM",
            
        //     "open_time"     =>$two_open_time,
        //     "close_time"    =>$two_close_time,

        //     "time"          =>$result_time,

        //     "times"         =>"",
            
        //     "from_date"     =>$from_date,
        //     "to_date"       =>$to_date, 

        //     "show"          =>"2D PM [$date]",
        //     "result_digit"  =>"",            
             
        // ]); 
        
        // $result_time            = Carbon::create(2022, 1, 1, 16, 00, 00);
        // factory(App\WorkFile::class)->create([        

        //     "name"          =>"3D",

        //     "date"          =>$date,
        //     "duration"      =>"PM",
            
        //     "open_time"     =>$three_open_time,
        //     "close_time"    =>$three_close_time,

        //     "time"          =>$result_time,

        //     "times"         =>"24 th",
            
        //     "from_date"     =>$from_date,
        //     "to_date"       =>$three_to_date, 

        //     "show"          =>"3D PM [$date] 24th",
        //     "result_digit"  =>"",            
             
        // ]);
        //End WorkFile Data

        //TwoDigit Data              
        //End TwoDigit Data

        //ThreeDigit Data        
        //End ThreeDigit Data


         //TwoSale Data
        // factory(App\TwoSale::class)->create([        

        //     "id"                =>1,

        //     "user_id"           =>1,
        //     "work_file_id"      =>1,
        //     "slip_id"           =>1,
            
        //     "type"              =>"18R", 
        //     "digit"             =>"18",  
        //     "amount"            =>1000,
        //     "status"            =>1,   

        // ]);
        //End TwoSale Data

        //ThreeSale Data
        // factory(App\ThreeSale::class)->create([        

        //     "id"                =>1,

        //     "user_id"           =>1,
        //     "work_file_id"      =>51,
        //     "slip_id"           =>1,
            
        //     "type"              =>"046", 
        //     "digit"             =>"046",  
        //     "amount"            =>1000,  

        // ]);
        
        //End ThreeSale Data

        //BreakAmount Data
        //  factory(App\BreakAmount::class)->create([        

        //     "id"               =>1,
            
        //     "work_file_id"     =>1,
        //     "amount"           =>10000,
        //     "status"           =>1,            
            
        // ]); 

        // factory(App\BreakAmount::class)->create([        

        //     "id"               =>2,
            
        //     "work_file_id"     =>2,
        //     "amount"           =>10000,
        //     "status"           =>1,            
            
        // ]); 

        // factory(App\BreakAmount::class)->create([        

        //     "id"               =>3,
            
        //     "work_file_id"     =>3,
        //     "amount"           =>5000,
        //     "status"           =>1,            
            
        // ]); 
        //End BreakAmount Data

        //Hot Data
        // factory(App\Hot::class)->create([        

        //     "id"               =>1,
            
        //     "work_file_id"     =>1,
        //     "digit"           =>"55",                   
            
        // ]);
        //End Hot Data

         //Digit Permission Data
        // factory(App\DigitPermission::class)->create([        

        //     "id"             =>1,
            
        //     "work_file_id"   =>1,
        //     "user_id"        =>1,
        //     "customer_id"    =>1,

        //     "type"           =>"12R",
        //     "digit"          =>"12",

        //     "status"         =>1,
        //     "confirm"        =>1,
                               
            
        // ]);
        // factory(App\DigitPermission::class)->create([        

        //     "id"             =>2,
            
        //     "work_file_id"   =>1,
        //     "user_id"        =>1,
        //     "customer_id"    =>1,

        //     "type"           =>"12R",
        //     "digit"          =>"21",

        //     "status"         =>1,
        //     "confirm"        =>1,
                               
            
        // ]);
        //End Digit Permission Data


        //Result Data
        // factory(App\Result::class)->create([        

        //     "id"                        =>1,
        //     "user_id"                   =>1,
        //     "work_file_id"              =>1,

        //     "total_amount"              =>100000,                     
        //     "commission_amount"         =>90000,
        //     "digit_amount"              =>80000,
        //     "other_amount"              =>0,

        //     "compensation_amount"       =>70000,

        //     "cash_plus"                 =>50000,
        //     "cash_minus"                =>0,
        //     "cash_balance"              =>20000,            
        // ]); 
        // factory(App\Result::class)->create([        

        //     "id"                        =>2,
        //     "user_id"                   =>2,
        //     "work_file_id"              =>1,

        //     "total_amount"              =>100000,                     
        //     "commission_amount"         =>90000,
        //     "digit_amount"              =>80000,
        //     "other_amount"              =>0,

        //     "compensation_amount"       =>70000,

        //     "cash_plus"                 =>50000,
        //     "cash_minus"                =>0,
        //     "cash_balance"              =>20000,            
        // ]); 
        // factory(App\Result::class)->create([        

        //     "id"                        =>3,
        //     "user_id"                   =>3,
        //     "work_file_id"              =>1,

        //     "total_amount"              =>100000,                     
        //     "commission_amount"         =>90000,
        //     "digit_amount"              =>80000,
        //     "other_amount"              =>0,

        //     "compensation_amount"       =>70000,

        //     "cash_plus"                 =>50000,
        //     "cash_minus"                =>0,
        //     "cash_balance"              =>20000,            
        // ]); 
        //End Result Data

         //Cash Data
        // factory(App\Cash::class)->create([        

        //     "id"                   =>1,
        //     "user_id"              =>1,
            

        //     "deposit"              =>100000,                     
        //     "withdraw"             =>0,
        //     "balance"              =>100000,
                     
        // ]);
        // factory(App\Cash::class)->create([        

        //     "id"                   =>2,
        //     "user_id"              =>2,
            

        //     "deposit"              =>100000,                     
        //     "withdraw"             =>0,
        //     "balance"              =>100000,
                     
        // ]);
        // factory(App\Cash::class)->create([        

        //     "id"                   =>3,
        //     "user_id"              =>3,
            

        //     "deposit"              =>100000,                     
        //     "withdraw"             =>0,
        //     "balance"              =>100000,
                     
        // ]);
        // factory(App\Cash::class)->create([        

        //     "id"                   =>4,
        //     "user_id"              =>4,
            

        //     "deposit"              =>100000,                     
        //     "withdraw"             =>0,
        //     "balance"              =>100000,
                     
        // ]);factory(App\Cash::class)->create([        

        //     "id"                   =>5,
        //     "user_id"              =>5,
            

        //     "deposit"              =>100000,                     
        //     "withdraw"             =>0,
        //     "balance"              =>100000,
                     
        // ]);
        //End Cash Data

        //For Two
        for($i=0;$i<10;$i++)
        {
          for($j=0;$j<10;$j++)
            {
                factory(App\Two::class)->create([ 
                
                "digit"        =>$i.$j,
               
                ]);
            }            
        }                      
        //End Two

        //For Three
        for($i=0;$i<10;$i++)
        {
          for($j=0;$j<10;$j++)
            {
                for($k=0;$k<10;$k++)
                {

                    factory(App\Three::class)->create([ 
                    
                    "digit"        =>$i.$j.$k,
                   
                    ]);
                }
            }            
        }                      
        //End Three


        //D3 Type 
        factory(App\D3Type::class)->create([        

            
            "d1"        =>"first",
            "d2"        =>"second",                     
            "d3"        =>"third",
            "amount"    =>0,            
                     
        ]);

        factory(App\D3Type::class)->create([        

           
            "d1"        =>"first",
            "d2"        =>"third",                     
            "d3"        =>"second",
            "amount"    =>0,            
                     
        ]);

        factory(App\D3Type::class)->create([       

           
            "d1"        =>"second",
            "d2"        =>"first",                     
            "d3"        =>"third",
            "amount"    =>0,            
                     
        ]);

        factory(App\D3Type::class)->create([       

           
            "d1"        =>"second",
            "d2"        =>"third",                     
            "d3"        =>"first",
            "amount"    =>0,            
                     
        ]);

        factory(App\D3Type::class)->create([       

           
            "d1"        =>"third",
            "d2"        =>"first",                     
            "d3"        =>"second",
            "amount"    =>0,            
                     
        ]);

        factory(App\D3Type::class)->create([       

           
            "d1"        =>"third",
            "d2"        =>"second",                     
            "d3"        =>"first",
            "amount"    =>0,            
                     
        ]);


        //End D3 Type

        //For NSE Type
        for($i=0;$i<10;$i++)
        {
            factory(App\NSEType::class)->create([       

           
            "d1"        =>"first",
            "d2"        =>"second",                     
            "d3"        =>$i,
            "amount"    =>0,            
                     
            ]);
        }        
        //End NSE Type

        //For LSE Type
        for($i=0;$i<10;$i++)
        {
            factory(App\LSEType::class)->create([       

           
            "d1"        =>"first",
            "d2"        =>$i,
            "d3"        =>"second",                     
            
            "amount"    =>0,            
                     
            ]);
        }        
        
        for($i=0;$i<10;$i++)
        {
            factory(App\LSEType::class)->create([       

           
            "d1"        =>"first",
            "d2"        =>$i,
            "d3"        =>"third",                     
            
            "amount"    =>0,            
                     
            ]);
        }        
        //End LSE Type

        //For SSE Type
        for($i=0;$i<10;$i++)
        {
            factory(App\SSEType::class)->create([       

           
            
            "d1"        =>$i,
            "d2"        =>"first",
            "d3"        =>"second",                     
            
            "amount"    =>0,            
                     
            ]);
        }  
        for($i=0;$i<10;$i++)
        {
            factory(App\SSEType::class)->create([       

           
            
            "d1"        =>$i,
            "d2"        =>"second",
            "d3"        =>"third",                     
            
            "amount"    =>0,            
                     
            ]);
        }              
        //End SSE Type

        //For TRI Type
        for($i=0;$i<10;$i++)
        {
            factory(App\TRIType::class)->create([       

           
            
            "d1"        =>$i,
            "d2"        =>$i,
            "d3"        =>$i,                     
            
            "amount"    =>0,            
                     
            ]);
        }        
        //End TRI Type

        //For KP Type
        for($i=0;$i<10;$i++)
        {
            factory(App\KPType::class)->create([       

           
            
            "d1"        =>"first",
            "d2"        =>$i,
            "d3"        =>"first",                     
            
            "amount"    =>0,            
                     
            ]);
        } 
        for($i=0;$i<10;$i++)
        {
            factory(App\KPType::class)->create([       

           
            
            "d1"        =>"first",
            "d2"        =>$i,
            "d3"        =>"third",                     
            
            "amount"    =>0,            
                     
            ]);
        }           
        //End KP Type

        //For SKP Type
        for($i=0;$i<10;$i+=2)
        {
            factory(App\SKPType::class)->create([       

           
            
            "d1"        =>"first",
            "d2"        =>$i,
            "d3"        =>"first",                     
            
            "amount"    =>0,            
                     
            ]);
        } 
        for($i=0;$i<10;$i+=2)
        {
            factory(App\SKPType::class)->create([       

           
            
            "d1"        =>"first",
            "d2"        =>$i,
            "d3"        =>"third",                     
            
            "amount"    =>0,            
                     
            ]);
        }               
        //End SKP Type

        //For MKP Type
        for($i=1;$i<10;$i+=2)
        {
            factory(App\MKPType::class)->create([       

           
            
            "d1"        =>"first",
            "d2"        =>$i,
            "d3"        =>"first",                     
            
            "amount"    =>0,            
                     
            ]);
        } 
        for($i=1;$i<10;$i+=2)
        {
            factory(App\MKPType::class)->create([       

           
            
            "d1"        =>"first",
            "d2"        =>$i,
            "d3"        =>"third",                     
            
            "amount"    =>0,            
                     
            ]);
        }       

        //End MKP Type

        //For KS Type
        for($i=0;$i<10;$i++)
        {
            factory(App\KSType::class)->create([       

           
            
            "d1"        =>$i,
            "d2"        =>"first",
            "d3"        =>$i,                     
            
            "amount"    =>0,            
                     
            ]);
        } 
        for($i=0;$i<10;$i++)
        {
            factory(App\KSType::class)->create([       

           
            
            "d1"        =>$i,
            "d2"        =>"second",
            "d3"        =>$i,                     
            
            "amount"    =>0,            
                     
            ]);
        }              
        //End KS Type

        //For KSS Type
        for($i=0;$i<10;$i+=2)
        {
            factory(App\KSSType::class)->create([       

           
            
            "d1"        =>$i,
            "d2"        =>"first",
            "d3"        =>$i,                     
            
            "amount"    =>0,            
                     
            ]);
        } 
        for($i=0;$i<10;$i+=2)
        {
            factory(App\KSSType::class)->create([       

           
            
            "d1"        =>$i,
            "d2"        =>"second",
            "d3"        =>$i,                     
            
            "amount"    =>0,            
                     
            ]);
        }              
        //End KSS Type

        //For KSM Type
        for($i=1;$i<10;$i+=2)
        {
            factory(App\KSMType::class)->create([       

           
            
            "d1"        =>$i,
            "d2"        =>"first",
            "d3"        =>$i,                     
            
            "amount"    =>0,            
                     
            ]);
        } 
        for($i=1;$i<10;$i+=2)
        {
            factory(App\KSMType::class)->create([       

           
            
            "d1"        =>$i,
            "d2"        =>"second",
            "d3"        =>$i,                     
            
            "amount"    =>0,            
                     
            ]);
        }               
        //End KSM Type


        //For D2 Type
        factory(App\D2Type::class)->create([ 
            
            "d1"        =>"first",
            "d2"        =>"second",            
            "amount"    =>0,

            ]);

        factory(App\D2Type::class)->create([ 
            
            "d1"        =>"second",
            "d2"        =>"first",            
            "amount"    =>0,

            ]);
        //End D2 Type

        //For T Type
        for($i=0;$i<10;$i++)
        {
            factory(App\TType::class)->create([ 
                
                "d1"        =>"first",
                "d2"        =>$i,            
                "amount"    =>0,

                ]);
        }        
        //End T Type

         //For N Type
        for($i=0;$i<10;$i++)
        {
            factory(App\NType::class)->create([ 
                
                "d1"        =>$i,
                "d2"        =>"first",            
                "amount"    =>0,

                ]);
        }    
        for($i=0;$i<10;$i++)
        {
            factory(App\NType::class)->create([ 
                
                "d1"        =>$i,
                "d2"        =>"second",            
                "amount"    =>0,

                ]);
        }           
        //End N Type

        //For R Type
        for($i=0;$i<10;$i++)
        {
            factory(App\RType::class)->create([ 
                
                "d1"        =>"first",
                "d2"        =>$i,            
                "amount"    =>0,

                ]);
        }    
        for($i=0;$i<10;$i++)
        {
            factory(App\RType::class)->create([ 
                
                "d1"        =>$i,
                "d2"        =>"first",            
                "amount"    =>0,

                ]);
        }           
        //End R Type

        //For NS Type
        for($i=0;$i<10;$i+=2)
        {
            factory(App\NSType::class)->create([ 
                
                "d1"        =>"first",
                "d2"        =>$i,            
                "amount"    =>0,

                ]);
        }         
        //End NS Type

         //For SN Type
        for($i=0;$i<10;$i+=2)
        {
            factory(App\SNType::class)->create([ 
                
                "d1"        =>$i,
                "d2"        =>"second",            
                "amount"    =>0,

                ]);
        }         
        //End SN Type

         //For NSR Type
        for($i=0;$i<10;$i+=2)
        {
            factory(App\NSRType::class)->create([ 
                
                "d1"        =>"first",
                "d2"        =>$i,            
                "amount"    =>0,

                ]);
        }   
        for($i=0;$i<10;$i+=2)
        {
            factory(App\NSRType::class)->create([ 
                
                "d1"        =>$i,
                "d2"        =>"first",            
                "amount"    =>0,

                ]);
        }            
        //End NSR Type

        //For NM Type
        for($i=1;$i<10;$i+=2)
        {
            factory(App\NMType::class)->create([ 
                
                "d1"        =>"first",
                "d2"        =>$i,            
                "amount"    =>0,

                ]);
        }               
        //End NM Type

        //For MN Type
        for($i=1;$i<10;$i+=2)
        {
            factory(App\MNType::class)->create([ 
                
                "d1"        =>$i,
                "d2"        =>"second",            
                "amount"    =>0,

                ]);
        }               
        //End MN Type

        //For NMR Type
        for($i=1;$i<10;$i+=2)
        {
            factory(App\NMRType::class)->create([ 
                
                "d1"        =>"first",
                "d2"        =>$i,            
                "amount"    =>0,

                ]);
        }   
        for($i=1;$i<10;$i+=2)
        {
            factory(App\NMRType::class)->create([ 
                
                "d1"        =>$i,
                "d2"        =>"first",            
                "amount"    =>0,

                ]);
        }               
        //End NMR Type

        //For SS Type
        for($i=0;$i<10;$i+=2)
        {
          for($j=0;$j<10;$j+=2)
            {
                factory(App\SSType::class)->create([ 
                
                "d1"        =>$i,
                "d2"        =>$j,            
                "amount"    =>0,

                ]);
            }            
        }                      
        //End SS Type

        //For MM Type
        for($i=1;$i<10;$i+=2)
        {
          for($j=1;$j<10;$j+=2)
            {
                factory(App\MMType::class)->create([ 
                
                "d1"        =>$i,
                "d2"        =>$j,            
                "amount"    =>0,

                ]);
            }            
        }                      
        //End MM Type

        //For SM Type
        for($i=0;$i<10;$i+=2)
        {
          for($j=1;$j<10;$j+=2)
            {
                factory(App\SMType::class)->create([ 
                
                "d1"        =>$i,
                "d2"        =>$j,            
                "amount"    =>0,

                ]);
            }            
        }                      
        //End SM Type

        //For MS Type
        for($i=1;$i<10;$i+=2)
        {
          for($j=0;$j<10;$j+=2)
            {
                factory(App\MSType::class)->create([ 
                
                "d1"        =>$i,
                "d2"        =>$j,            
                "amount"    =>0,

                ]);
            }            
        }                      
        //End MS Type

        //For SP Type
        for($i=0;$i<10;$i+=2)
        {
          
            factory(App\SPType::class)->create([ 
            
            "d1"        =>$i,
            "d2"        =>$i,            
            "amount"    =>0,

            ]);
                      
        }                      
        //End SP Type

        //For MP Type
        for($i=1;$i<10;$i+=2)
        {
          
            factory(App\MPType::class)->create([ 
            
            "d1"        =>$i,
            "d2"        =>$i,            
            "amount"    =>0,

            ]);
                      
        }                      
        //End MP Type

        //For PP Type
        for($i=0;$i<10;$i++)
        {
          
            factory(App\PPType::class)->create([ 
            
            "d1"        =>$i,
            "d2"        =>$i,            
            "amount"    =>0,

            ]);
                      
        }                      
        //End PP Type

        //For PW Type
        for($i=0;$i<=4;$i++)
        {
          
            factory(App\PWType::class)->create([ 
            
            "d1"        =>$i,
            "d2"        =>$i+5,            
            "amount"    =>0,

            ]);
                      
        } 
        for($i=5;$i<=9;$i++)
        {
          
            factory(App\PWType::class)->create([ 
            
            "d1"        =>$i,
            "d2"        =>$i-5,            
            "amount"    =>0,

            ]);
                      
        }                          
        //End PW Type

        //For NK Type        
        factory(App\NKType::class)->create([        
        "d1"        =>0,
        "d2"        =>7,            
        "amount"    =>0,
        ]);
        factory(App\NKType::class)->create([         
        "d1"        =>1,
        "d2"        =>8,            
        "amount"    =>0,
        ]);
        factory(App\NKType::class)->create([        
        "d1"        =>2,
        "d2"        =>4,            
        "amount"    =>0,
        ]);
        factory(App\NKType::class)->create([         
        "d1"        =>3,
        "d2"        =>5,            
        "amount"    =>0,
        ]);  
        factory(App\NKType::class)->create([        
        "d1"        =>4,
        "d2"        =>2,            
        "amount"    =>0,
        ]);
        factory(App\NKType::class)->create([         
        "d1"        =>5,
        "d2"        =>3,            
        "amount"    =>0,
        ]);
        factory(App\NKType::class)->create([        
        "d1"        =>6,
        "d2"        =>9,            
        "amount"    =>0,
        ]);
        factory(App\NKType::class)->create([         
        "d1"        =>7,
        "d2"        =>0,            
        "amount"    =>0,
        ]); 
        factory(App\NKType::class)->create([        
        "d1"        =>8,
        "d2"        =>1,            
        "amount"    =>0,
        ]);
        factory(App\NKType::class)->create([         
        "d1"        =>9,
        "d2"        =>6,            
        "amount"    =>0,
        ]);                                      
        //End NK Type

        //For D Type
        for($i=0;$i<10;$i++)
        {
          
            factory(App\DType::class)->create([ 
            
            "d1"        =>$i,
            "d2"        =>0,            
            "amount"    =>0,

            ]);
                      
        }                      
        //End D Type

        //For DS Type
        for($i=0;$i<10;$i+=2)
        {
          
            factory(App\DSType::class)->create([ 
            
            "d1"        =>$i,
            "d2"        =>0,            
            "amount"    =>0,

            ]);
                      
        }                      
        //End DS Type

        //For DM Type
        for($i=1;$i<10;$i+=2)
        {
          
            factory(App\DMType::class)->create([ 
            
            "d1"        =>$i,
            "d2"        =>0,            
            "amount"    =>0,

            ]);
                      
        }                      
        //End DM Type

         //For TK Type
        for($i=0;$i<9;$i++)
        {
          
            factory(App\TKType::class)->create([ 
            
            "d1"        =>$i,
            "d2"        =>$i+1,            
            "amount"    =>0,

            ]);
                      
        }  
        factory(App\TKType::class)->create([ 
            
            "d1"        =>9,
            "d2"        =>0,            
            "amount"    =>0,

            ]);
        //End TK Type

        //For KT Type
        factory(App\KTType::class)->create([ 
            
            "d1"        =>0,
            "d2"        =>9,            
            "amount"    =>0,

            ]);
        for($i=1;$i<10;$i++)
        {
          
            factory(App\KTType::class)->create([ 
            
            "d1"        =>$i,
            "d2"        =>$i-1,            
            "amount"    =>0,

            ]);
                      
        }       
        //End KT Type

        //For BR Type        
        for($i=0;$i<=8;$i++)
        {
          
            factory(App\BRType::class)->create([ 
            
            "d1"        =>$i,
            "d2"        =>$i+1,            
            "amount"    =>0,

            ]);
                      
        } 
        factory(App\BRType::class)->create([ 
            
            "d1"        =>9,
            "d2"        =>0,            
            "amount"    =>0,

            ]);
        factory(App\BRType::class)->create([ 
            
            "d1"        =>0,
            "d2"        =>9,            
            "amount"    =>0,

            ]);
        for($i=1;$i<=9;$i++)
        {
          
            factory(App\BRType::class)->create([ 
            
            "d1"        =>$i,
            "d2"        =>$i-1,            
            "amount"    =>0,

            ]);
                      
        } 
        //End BR Type

        //Customer Data
        // factory(App\Customer::class)->create([ 
            
        //     "name"        =>"Ko Aye Lwin",
        //     "in_out"      =>1,
        //     ]);
        // factory(App\Customer::class)->create([ 
            
        //     "name"        =>"Aung Kyaw Aye",
        //     "in_out"      =>1,
        //     ]);
        // factory(App\Customer::class)->create([ 
            
        //     "name"        =>"UZK",
        //     "in_out"      =>1,
        //     ]);
        // factory(App\Customer::class)->create([ 
            
        //     "name"        =>"KA Htay",
        //     "in_out"      =>1,
        //     ]);
        // factory(App\Customer::class)->create([ 
            
        //     "name"        =>"May Zin",
        //     "in_out"      =>1,
        //     ]);
        // factory(App\Customer::class)->create([ 
            
        //     "name"        =>"Upper 1",
        //     "in_out"      =>2,
        //     ]);
        // factory(App\Customer::class)->create([ 
            
        //     "name"        =>"Upper 2",
        //     "in_out"      =>2,
        //     ]);
        //End Customer



    }
}
