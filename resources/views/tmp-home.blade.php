@extends('layouts.app')

@section('content')

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





<!-- Main WorkFiles -->
<div class="container h-100">
<div class="row h-100 justify-content-center align-items-center">
<div class="col-md-6">

        <div class="card">                
            <div class="card-body">

                    @foreach($two_workfiles as $two_workfile)
                        <div class="form-group">                        
                        
                        @if(auth()->user()->id == 1 || auth()->user()->id ==2)
                            <a  class="form-control btn btn-info btn-lg" href="{{ url("/2dsale/add/{$two_workfile->id}") }}">

                                {{ $two_workfile->show }}

                            </a>  
                        @else

                            @if($two_workfile->open_time <= $now  && $two_workfile->close_time >= $now && $two_workfile->date <= $today)
                                <a   class="form-control btn btn-info btn-lg" href="{{ url("/2dsale/add/{$two_workfile->id}") }}" >

                                {{ $two_workfile->show }}

                                &nbsp;&nbsp;&nbsp;
                                
                                <span class="bg-success" style=" height: 10px;width: 10px;
                                    background-color: #ff0000;
                                    border-radius: 50%;
                                    display: inline-block;">
                                </span>

                                </a>  
                            @else
                                <a  class="form-control btn btn-info btn-lg" >

                                {{ $two_workfile->show }}

                                &nbsp;&nbsp;&nbsp;

                                <span class="bg-danger" style=" height: 10px;width: 10px;
                                    background-color: #ff0000;
                                    border-radius: 50%;
                                    display: inline-block;">
                                </span>

                                </a>  
                            @endif

                        @endif



                            
                                              
                    </div>
                    @endforeach

                    @foreach($three_workfiles as $three_workfile)
                    <div class="form-group">                        
                        <a  class="form-control btn btn-info btn-lg" href="{{ url("/3dsale/add/{$three_workfile->id}") }}">
                            {{ $three_workfile->show }}
                        </a>                    
                    </div>
                    @endforeach 


            </div>

                @if(auth()->user()->id == 1 || auth()->user()->id == 2)
                <input type="button" value="Previous WorkFiles..." id="Previous" class="btn btn-primary btn-sm">  
                @endif
        </div>

        
</div>
</div>
</div>
<!-- Main WorkFiles -->


@if(auth()->user()->id == 1 || auth()->user()->id == 2)
<!-- Previous WorkFiles -->

<div class="container h-100">
<div class="row h-100 justify-content-center align-items-center">
<div class="col-md-6">

        <div class="card" id="previous_workfiles">

            <div class="card-body">

                    @foreach($previous_two_workfiles as $two_workfile)
                        <div class="form-group">                        
                        
                        @if(auth()->user()->id == 1 || auth()->user()->id ==2)
                            <a  class="form-control btn btn-info btn-lg" href="{{ url("/2dsale/add/{$two_workfile->id}") }}">

                                {{ $two_workfile->show }}

                            </a>  
                        @else

                            @if($two_workfile->open_time <= $now  && $two_workfile->close_time >= $now)
                                <a  class="form-control btn btn-info btn-lg" href="{{ url("/2dsale/add/{$two_workfile->id}") }}">

                                {{ $two_workfile->show }}

                                &nbsp;&nbsp;&nbsp;
                                
                                <span class="bg-success" style=" height: 10px;width: 10px;
                                    background-color: #ff0000;
                                    border-radius: 50%;
                                    display: inline-block;">
                                </span>

                                </a>  
                            @else
                                <a  class="form-control btn btn-info btn-lg" >

                                {{ $two_workfile->show }}

                                &nbsp;&nbsp;&nbsp;

                                <span class="bg-danger" style=" height: 10px;width: 10px;
                                    background-color: #ff0000;
                                    border-radius: 50%;
                                    display: inline-block;">
                                </span>

                                </a>  
                            @endif

                        @endif



                            
                                              
                    </div>
                    @endforeach

                    @foreach($previous_three_workfiles as $three_workfile)
                    <div class="form-group">                        
                        <a  class="form-control btn btn-info btn-lg" href="{{ url("/3dsale/add/{$three_workfile->id}") }}">
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
