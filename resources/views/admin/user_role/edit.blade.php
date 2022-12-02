@extends('admin.layout.master')
@section('content')


<div class="page-section">
                <div class="d-xl-none">
                  <button class="btn btn-danger btn-floated" type="button" data-toggle="sidebar"><i class="fa fa-th-list"></i></button>
                </div><!-- .card -->
                <div id="base-style" class="card">
                  <!-- .card-body -->
                  <div class="card-body"><a href="{{asset('user_role')}}"><button class="btn btn-success "  style="float:right;">back</button></a> 
                    <!-- .form -->
                    <form action="{{route('user_role.update',$user_role->id)}}" method="POST">
                        @csrf
                        @method('PUT')

                        
                        @if ($errors->any())
                          <div class="alert alert-danger">
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                      @endif
                      <!-- .fieldset -->
                      <fieldset>
                        <legend>User Role Edit</legend> <!-- .form-group -->
                      <!-- .form-group -->
                      <div class="col-md-6 mb-3">
                          <label class="col-form-label" for="tfDefault">User Role</label> 
                          <input type="text" class="form-control" id="tfDefault" name="role" value="{{$user_role->role}}">
                        </div><!-- /.form-group -->

                        

                        <div class="form-group">                            
                            <span>Is Active:</span> <!-- .switcher-control -->
                            <label class="switcher-control switcher-control-lg"><input type="checkbox" class="switcher-input" name="status" value="{{$user_role->status}}" checked> <span class="switcher-indicator"></span> <span class="switcher-label-on">ON</span> <span class="switcher-label-off">OFF</span></label>                            
                        </div><!-- /.form-group -->

                      </fieldset><!-- /.fieldset -->
                      <div class="form-actions">
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <button class="btn btn-danger" type="reset">Reset</button>
                      </div>
                    </form><!-- /.form -->
                  </div><!-- /.card-body -->
                  <!-- .card-body -->
                </div>
</div>


@endsection 