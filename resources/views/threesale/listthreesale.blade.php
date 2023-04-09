<?php 
  use App\FilePermission; 
  use App\User;
?>

@extends('layouts.app')
@section('content')

<style type="text/css">
  #table1 
  {
    font-size: 12px;
    display: flex;
    flex-flow: column;
    width: 100%;
  }
  #table1 thead 
  {
    flex: 0 0 auto;
  }
  #table1 tbody 
  {
   
    height: 350px;
    flex: 1 1 auto;
    display: block;
    overflow-y: auto;
    overflow-x: hidden;
  }
  #table1 tr 
  {
    width: 100%;
    display: table;
    table-layout: fixed;
  }
</style>

<style type="text/css">
    #previous_workfiles
    {
        display: none;
    }
   .btn-info {
    color: #212529;
    background-color: #34ebae;
    border-color: #5bc2c2;
    font-size: 14px;
    font-weight : bold ;
}
</style>

<script>
    $(document).ready( 
              function()
              {


                $("#Previous").click
                  ( function()
                    {
                      $("#previous_workfiles").toggle("first");
                    }
                  );



              }
            );
</script>



   @if(session('info'))
    <div class="container">
       <div class="alert alert-danger">
      {{ session('info') }}
      </div>
    </div>     
    @endif


  <!-- <h1>Test</h1> -->

  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-2">
            <div class="card">
                
                  <table class="table1 table-sm header-fixed">
                  
                  <tbody>

                    

                      <?php 
                            $user = User::find(auth()->user()->id);


                            $filepermission = FilePermission::where([                                           
                                    
                                    ["user_id","=",auth()->user()->id],
                                    ["twod_status","=",1],
                                ])

                            ->first();

                          if($filepermission != null)
                          { 

                       ?>

                      
                     
                      <tr>  
                          <td>

                            @if(auth()->user()->id == 1 || auth()->user()->id ==2)
                                <a style="background: #8fe3c8; color: black;font-size: 18px;font-family: bold;" class="form-control btn btn-primary btn-sm" href="{{ url("/3dsale/add/{$work_file->id}") }}"> 

                                {{ $work_file->show }}

                              </a>
                            @else

                               

                                @if($work_file->date > $today)

                                <a style="background: #8fe3c8; color: black;font-size: 18px;font-family: bold;" class="form-control btn btn-primary btn-sm" href="{{ url("/3dsale/add/{$work_file->id}") }}"> 

                                  {{ $work_file->show }}

                                </a>
                                @endif


                                

                              @if($work_file->date == $today)


                               
                                @if( $work_file->close_time > $now)

                                    @if($user->close_time != null && $user->close_time > $now)

                                    <a style="background: #8fe3c8; color: black;font-size: 18px;font-family: bold;" class="form-control btn btn-primary btn-sm" href="{{ url("/3dsale/add/{$work_file->id}") }}"> 

                                      {{ $work_file->show }}

                                    </a>

                                    @endif

                                @endif

                              @endif



                            @endif                       
                          
                            

                                               
                          </td>
                          
                      </tr>

                    <?php  }  ?>
                                            
                      
                                  
                      
                  </tbody>
                </table>
               
              
                  @if(auth()->user()->id == 1 || auth()->user()->id == 2)
                    <input type="button" value="Previous WorkFiles..." id="Previous" class="btn btn-primary btn-sm">  
                  @endif
              
                
               </div>
            </div>
        <!-- </div> -->
    </div>
</div>


@if(auth()->user()->id == 1 || auth()->user()->id == 2)
<!-- Previous WorkFiles -->

<div class="container h-100">
<div class="row h-100 justify-content-center align-items-center">
<div class="col-md-6">

        <div class="card" id="previous_workfiles">

            <div class="card-body">

                    @foreach($previous_three_workfiles as $three_workfile)
                    <div class="form-group">                        
                        <a style="background: #8fe3c8; color: black;font-size: 18px;"  class="form-control btn btn-info btn-lg" href="{{ url("/3dsale/add/{$three_workfile->id}") }}">
                            {{ $three_workfile->show }}
                        </a>                    
                    </div>
                    @endforeach   
            </div>
        </div>
</div>
</div>
</div>

<!-- Previous WorkFiles -->
@endif

 
@endsection