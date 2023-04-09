
<?php 
    use App\Choice; 
    use App\ThreeSale;
?>

<style type="text/css">
  select
  {
    font-size: 50%;
  }
</style>

@extends('layouts.app')
@section('content')

<div class="container">
<div class="row justify-content-center">
<div class="col-md-6 col-md-offset-2">

    @if(session('info'))
      <div class="alert alert-danger">
      {{ session('info') }}
      </div>
    @endif 

</div>
</div>
</div>



<div class="container">
<div class="row justify-content-center">
<div class="col-md-6 col-md-offset-2">

    <div class="card border-secondary">

        <div class="card-header">
           Digit/Amount ပြင်ဆင်ခြင်း
        </div>

              <table class="table table-sm">
                  
              <tbody>
                <form method="post" enctype="multipart/form-data">

                {{ csrf_field() }}

                <tr>
                    <td>
                      <div class="form-group">
                       <!--  <label>Digit</label> -->
                        <input type="text" name="digit" id="digit" class="form-control" autocomplete="off" value="{{ $three_sale->digit }}" >
                      </div>
                    </td>

                    <td>
                      <div class="form-group">
                       <!--  <label>Amount</label> -->
                        <input type="text" name="amount" id="amount" class="form-control" autocomplete="off" value="{{ $three_sale->amount }}" >
                      </div>
                    </td>
                   
                </tr>

                <tr>
                  <td colspan="2" style="text-align: center;"><input type="submit" value="ပြင်ဆင်ရန်" class="btn btn-primary btn-sm"></td>
                </tr>
                         
                </form>
              </tbody>
              </table>

    </div>


    <div class="d-flex justify-content-end align-items-end">        
          <span class="card-text">
              <a href="{{ url("/") }}" class="btn btn-primary btn-sm" >
                 Back
              </a>
          </span>
    </div>

</div>
</div>
</div>

@endsection