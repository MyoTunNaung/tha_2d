@extends('layouts.app')
@section('content')


<!-- <style type="text/css">
    a 
    {
        width: 100%;
    }
</style>
 -->

<div class="container">
<div class="row justify-content-center">
<div class="col-md-6 col-md-offset-2">

        @if(session('info'))
        <div class="container">
           <div class="alert alert-danger">
          {{ session('info') }}
          </div>
        </div>     
        @endif
</div>
</div>
</div>



<!-- Container -->
<div class="container">
<!-- Row -->
<div class="row justify-content-center">

      

       <div class="col-6 col-sm-6 col-md-6 col-lg-3  mx-0 px-1" style="width: 50%">
        <div class="card"> 
        <a href="{{ url('/3dsale/list') }}" >
        <img src="{{ asset('images/logo-1.jpg') }}" alt="image" class="img-thumbnail card-img-top rounded mx-auto d-block " style="max-width: 75%; height: 75%;">
        </a>
        </div>
      </div>


        <div class="col-6 col-sm-6 col-md-6 col-lg-3  mx-0 px-1" style="width: 50%">
        <div class="card"> 
        <a href="{{ url('/3d/list') }}" >
        <img src="{{ asset('images/logo-16.jpg') }}" alt="image" class="img-thumbnail card-img-top rounded mx-auto d-block " style="max-width: 75%; height: 75%;">
        </a>
        </div>
      </div>

       <div class="col-6 col-sm-6 col-md-6 col-lg-3  mx-0 px-1" style="width: 50%">
        <div class="card"> 
        <a href="{{  url('/list') }}" >
        <img src="{{ asset('images/logo-4.jpg') }}" alt="image" class="img-thumbnail card-img-top rounded mx-auto d-block " style="max-width: 75%; height: 75%;">
        </a>
        </div>
      </div>


  </div>

  

</div>
<!-- Row -->

            


</div>
<!-- Container -->



@endsection
