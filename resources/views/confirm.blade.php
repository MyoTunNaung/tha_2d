@extends('layouts.app')

@section('content')

<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card"> -->
                <!-- <div class="card-header">{{ __('Dashboard') }}</div> -->

                <!-- <div class="card-body"> -->
                    <!-- @if (session('status')) -->
                        <!-- <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div> -->
                    <!-- @endif -->

                    <!-- {{ __('You are logged in!') }} -->                  

                <!-- </div>
            </div>
        </div>
    </div>
</div> -->


<div class="container h-100">
<div class="row h-100 justify-content-center align-items-center">
<div class="col-md-4">

        <div class="card">                
            <div class="card-body">

                    @foreach($two_workfiles as $two_workfile)
                        <div class="form-group">                        
                        <a  class="form-control btn btn-warning btn-lg" href="{{ url("/2dconfirm/list/{$two_workfile->id}") }}">
                            {{ $two_workfile->name ." ". $two_workfile->duration }}
                        </a>                        
                    </div>
                    @endforeach

                    @foreach($three_workfiles as $three_workfile)
                    <div class="form-group">                        
                        <a  class="form-control btn btn-warning btn-lg" href="{{ url("/3dconfirm/list/{$three_workfile->id}") }}">
                            {{ $three_workfile->name ." ". $three_workfile->duration }}
                        </a>                    
                    </div>
                    @endforeach   
            </div>
        </div>
</div>
</div>
</div>


@endsection
