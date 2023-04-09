@extends('layouts.app')
@section('content')


    
  @if(session('info'))
            <div class="alert alert-danger">
            {{ session('info') }}
            </div>
          @endif 




    
<div class="container">
<div class="row justify-content-center">
<div class="col-md-6 col-md-offset-2">

        
    

      <div class="card border-secondary">
                
          <div class="card-header">
                Add Result [ OR ] Clear Result 
          </div>

          <table class="table table-sm">
              
          <tbody>
            <form method="post" enctype="multipart/form-data">

            {{ csrf_field() }}

              <tr>

                        
                <td>            
                  <div class="form-group">
                      <label>Work File</label> <br>
                      <select name="work_file_id" id="work_file_id" class="form-control" >                             
                      @foreach($work_files as $work_file)
                        <option value="{{ $work_file->id }}" @if($work_file->id == $work_file_id) selected @endif>
                          {{ $work_file->show }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </td>

             
                <td>
                  <div class="form-group">
                    <label>Result Digit</label>
                    <input type="text" name="result_digit" id="result_digit" class="form-control" autocomplete="off">
                  </div>
                </td>

               
              </tr>
          
            <tr>
              <td><input type="submit"  value="Add Result"    name="action" id="btnAdd"class="btn btn-primary btn-sm"></td>
              <td><input type="submit"  value="Clear Result"  name="action" id="btnClear"  class="btn btn-primary btn-sm"></td>
            </tr>
                
            </form>
          </tbody>
          </table>



  </div>


</div>
</div>
</div>


   

@endsection