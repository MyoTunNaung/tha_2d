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
<div class="row justify-content-left">
  
      <div class="col-6 col-sm-6 col-md-6 col-lg-3  mx-0 px-1" style="width: 50%">
        <div class="card">  
        <a href="{{ url('/3dsale/list') }}">
        <img src="{{ asset('images/logo-1.jpg') }}" alt="image" class="img-thumbnail card-img-top rounded mx-auto d-block" >
        </a> 
        </div>
      </div>

      <div class="col-6 col-sm-6 col-md-6 col-lg-3  mx-0 px-1" style="width: 50%">
        <div class="card"> 
        <a href="{{ url('/confirm/list') }}" >
        <img src="{{ asset('images/logo-2.jpg') }}" alt="image" class="img-thumbnail card-img-top rounded mx-auto d-block" >
        </a>
        </div>
      </div> 

      <div class="col-6 col-sm-6 col-md-6 col-lg-3  mx-0 px-1" style="width: 50%">
        <div class="card">  
        <a href="{{ url('/slip/list') }}" >
        <img src="{{ asset('images/logo-3.jpg') }}" alt="image" class="img-thumbnail card-img-top rounded mx-auto d-block" >
        </a> 
        </div>
      </div>

      <div class="col-6 col-sm-6 col-md-6 col-lg-3  mx-0 px-1" style="width: 50%">
        <div class="card"> 
        <a href="{{ url('/list') }}">
        <img src="{{ asset('images/logo-4.jpg') }}" alt="image" class="img-thumbnail card-img-top rounded mx-auto d-block" >
        </a>
        </div>
      </div> 
      <div class="col-6 col-sm-6 col-md-6 col-lg-3  mx-0 px-1" style="width: 50%">
        <div class="card">  
         <a href="{{ url('/result/list') }}">
        <img src="{{ asset('images/logo-5.jpg') }}" alt="image" class="img-thumbnail card-img-top rounded mx-auto d-block" >
        </a> 
        </div>
      </div>

      <div class="col-6 col-sm-6 col-md-6 col-lg-3  mx-0 px-1" style="width: 50%">
        <div class="card"> 
        <a href="{{ url('/ledger/list') }}">
        <img src="{{ asset('images/logo-6.jpg') }}" alt="image" class="img-thumbnail card-img-top rounded mx-auto d-block" >
        </a>
        </div>
      </div> 

      <div class="col-6 col-sm-6 col-md-6 col-lg-3 mx-0 px-1" style="width: 50%">
        <div class="card">  
        <a href="{{ url('/saleamount/list') }}">
        <img src="{{ asset('images/logo-7.jpg') }}" alt="image" class="img-thumbnail card-img-top rounded mx-auto d-block" >
        </a> 
        </div>
      </div>

    
      <div class="col-6 col-sm-6 col-md-6 col-lg-3 mx-0 px-1" style="width: 50%">
        <div class="card">  

              <p></p><p></p><p></p><p></p><p></p><p></p>

              <div class="d-flex justify-content-between align-items-center">

                <span style="padding: 10px; ">  <!-- <a href="{{ url('/') }}" class="btn btn-sm btn-info" style="background: green; color: white;"> Previous </a>  --></span>
                
                @if(auth()->user()->id == 1 || auth()->user()->id == 2)
                <span style="padding: 10px; ">  <a href="{{ url('/home-2') }}" class="btn btn-sm btn-info" style="background: #ebb734;color: white;"> Next </a> </span>
                @endif

                          
            </div>  
        </div>
      </div>

  </div>

  

</div>
<!-- Row -->

            


</div>
<!-- Container -->



@endsection
