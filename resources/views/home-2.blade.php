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


@if(Auth::check())
@if(auth()->user()->id == 1 or auth()->user()->id == 2)


<!-- Container -->
<div class="container">
<!-- Row -->
<div class="row justify-content-left">

       <div class="col-6 col-sm-6 col-md-6 col-lg-3  mx-0 px-1" style="width: 30%">
        <div class="card"> 
        <a href="{{ url('/3d/list') }}" >
        <img src="{{ asset('images/logo-16.jpg') }}" alt="image" class="img-thumbnail card-img-top rounded mx-auto d-block " style="max-width: 75%; height: 75%;">
        </a>
        </div>
      </div>


      <div class="col-6 col-sm-6 col-md-6 col-lg-3  mx-0 px-1" style="width: 30%">
        <div class="card"> 
        <a href="{{ url('/user/add') }}" >
        <img src="{{ asset('images/logo-8.jpg') }}" alt="image" class="img-thumbnail card-img-top rounded mx-auto d-block" style="max-width: 75%; height: 75%;">
        </a>
        </div>
      </div> 

      <div class="col-6 col-sm-6 col-md-6 col-lg-3  mx-0 px-1" style="width: 30%">
        <div class="card">  
        <a href="{{ url('/workfile/add') }}" >
        <img src="{{ asset('images/logo-9.jpg') }}" alt="image" class="img-thumbnail card-img-top rounded mx-auto d-block" style="max-width: 75%; height: 75%;">
        </a> 
        </div>
      </div>

      <div class="col-6 col-sm-6 col-md-6 col-lg-3  mx-0 px-1" style="width: 30%">
        <div class="card"> 
        <a href="{{ url('/commission/list') }}" >
        <img src="{{ asset('images/logo-10.jpg') }}" alt="image" class="img-thumbnail card-img-top rounded mx-auto d-block" style="max-width: 75%; height: 75%;">
        </a>
        </div>
      </div> 

      <div class="col-6 col-sm-6 col-md-6 col-lg-3  mx-0 px-1" style="width: 30%">
        <div class="card">  
        <a href="{{ url('break/upd') }}" >
        <img src="{{ asset('images/logo-11.jpg') }}" alt="image" class="img-thumbnail card-img-top rounded mx-auto d-block" style="max-width: 75%; height: 75%;">
        </a> 
        </div>
      </div>

      <div class="col-6 col-sm-6 col-md-6 col-lg-3  mx-0 px-1" style="width: 30%">
        <div class="card"> 
        <a href="{{ url('hot/list') }}">
        <img src="{{ asset('images/logo-12.jpg') }}" alt="image" class="img-thumbnail card-img-top rounded mx-auto d-block" style="max-width: 75%; height: 75%;">
        </a>
        </div>
      </div> 
      <div class="col-6 col-sm-6 col-md-6 col-lg-3  mx-0 px-1" style="width: 30%">
        <div class="card">  
         <a href="{{ url('filepermission/list') }}">
        <img src="{{ asset('images/logo-13.jpg') }}" alt="image" class="img-thumbnail card-img-top rounded mx-auto d-block" style="max-width: 75%; height: 75%;">
        </a> 
        </div>
      </div>

      <div class="col-6 col-sm-6 col-md-6 col-lg-3  mx-0 px-1" style="width: 30%">
        <div class="card"> 
        <a href="{{ url('digitpermission/list') }}">
        <img src="{{ asset('images/logo-14.jpg') }}" alt="image" class="img-thumbnail card-img-top rounded mx-auto d-block" style="max-width: 75%; height: 75%;">
        </a>
        </div>
      </div> 

      <div class="col-6 col-sm-6 col-md-6 col-lg-3 mx-0 px-1" style="width: 30%">
        <div class="card">  

              <p></p><p></p><p></p><p></p><p>

              <div class="d-flex justify-content-between align-items-center">

                <!-- <span style="padding: 10px; ">  <a href="{{ url('/') }}" class="btn btn-sm btn-info" style="background: green; color: white;"> Previous </a> </span> -->
                
                @if(auth()->user()->id == 1 || auth()->user()->id == 2)
                <span >  <a href="{{ url('/') }}" class="btn btn-sm btn-info" style="background: green; color: white;"> Previous </a> </span>
                @endif

                          
            </div>  
        </div>
      </div>


      <div class="col-6 col-sm-6 col-md-6 col-lg-3  mx-0 px-1" style="width: 30%">
        <div class="card">  
        <a href="{{ url('otherpermission/list') }}">
        <img src="{{ asset('images/logo-15.jpg') }}" alt="image" class="img-thumbnail card-img-top rounded mx-auto d-block" style="max-width: 75%; height: 75%;">
        </a> 
        </div>
      </div>

     

    <!--   <div class="col-6 col-sm-6 col-md-6 col-lg-3  mx-0 px-1" style="width: 30%">
        <div class="card">  
        <a href="{{ url('cash/add') }}">
        <img src="{{ asset('images/logo-17.jpg') }}" alt="image" class="img-thumbnail card-img-top rounded mx-auto d-block" style="max-width: 75%; height: 75%;">
        </a> 
        </div>
      </div> -->

     
  <!-- </div> -->

     


   <!-- <div class="d-flex justify-content-between align-items-center" >

      <span style="padding: 10px;">  <a href="{{ url('/') }}" class="btn btn-sm btn-info" style="background: green; color: white;"> Previous </a> </span>

      <span style="padding: 10px;">  <a href="{{ url('/home-2') }}" class="btn btn-sm btn-info"> Next </a> </span>
                
  </div>   -->

</div>
<!-- Row -->

</div>
<!-- Container -->

@endif
@endif


@endsection
