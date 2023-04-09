<?php 
use App\WorkFile;
use App\User;
?>

@extends('layouts.app')
@section('content')

<style type="text/css">
  table 
  {
    font-size: 12px;
    display: flex;
    flex-flow: column;
    width: 100%;
  }
  thead 
  {
    flex: 0 0 auto;
  }
  tbody 
  {
   
    height: 350px;
    flex: 1 1 auto;
    display: block;
    overflow-y: auto;
    overflow-x: hidden;
  }
  tr 
  {
    width: 100%;
    display: table;
    table-layout: fixed;
  }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-2"> 

        <div class="card">
            <div class="card-header">
              <a class="btn btn-primary btn-sm" href="{{ url("/cash/add") }}">
                    Add New Cash (  အချက်အလက်  အသစ်ထည့်ရန် )
                  </a>
            </div> 
        </div>           
            
          @foreach($cashes as $cash)

                        <?php 

                            $user_name   = User::where([

                                    ["id","=","$cash->user_id"]

                                ])
                            ->value('name');
                           
                         ?>

            <div class="card">

                  <div class="card-header">
                    ID: {{ $user_name }}
                  </div>
                  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; Deposit</span>
                      <span class="card-text">{{ number_format($cash->deposit) }} &nbsp;</span>
                  </div>
                  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; Withdraw</span>
                      <span class="card-text">{{ number_format($cash->withdraw) }} &nbsp;</span>
                  </div>

                  <div class="d-flex justify-content-between align-items-center">
                      <span class="card-text"> &nbsp; Balance</span>
                      <span class="card-text">{{ number_format($cash->balance) }} &nbsp;</span>
                  </div>  
                 
                       

                  <div class="card-body"> 
                  <div class="d-flex justify-content-between align-items-center">
                      <a href="{{ url("/cash/upd/{$cash->id}") }}" class="btn btn-info btn-sm">Update</a>
                      
                       @if(auth()->user()->id == 1 or auth()->user()->id == 2)

                            <a href="{{ url("/cash/del/{$cash->id}") }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?') && confirm('Are you ready?') && confirm('Can not get back?')">Delete</a>
                            
                            @endif

                  </div>
                  </div> 

            </div> <!-- Card -->
            @endforeach


        </div>
    </div>
</div>


   

@endsection