@extends('admin.layout.master')
@section('content')


<div class="page-section">
                <div class="d-xl-none">
                  <button class="btn btn-danger btn-floated" type="button" data-toggle="sidebar"><i class="fa fa-th-list"></i></button>
                </div><!-- .card -->
                <div id="base-style" class="card">
                  <!-- .card-body -->
                 
                    <!-- .form -->
                    <form action="{{route('student.update',$student->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                      <!-- .fieldset -->
                      <h3>Student Manage</h3> <!-- .form-group -->
                      <div class="row page-section">

                      <div class="col-md-12 mb-3">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        </div>

                        
                        <div class="col-md-6 col-sm-6 col-xs-12">

                        <!-- .form-group -->
                        <div class="form-group">
                          <label class="control-label" for="select2-branch">branch:</label> 
                          <select id="select2-branch" class="form-control" name="branch_id" data-toggle="select2" data-placeholder="Select a Branch" data-allow-clear="true">
                            @foreach ($branch as $branchs)
                              <option value="{{$branchs->id}}">{{$branchs->name}}</option>
                            @endforeach
                          </select>
                        </div><!-- /.form-group -->


                      <!-- .form-group -->
                      <div class="form-group">
                          <label class="control-label" for="select2-faculty">Faculty:</label> 
                          <select id="select2-faculty" class="form-control" name="faculty_id" data-toggle="select2" data-placeholder="Select a Faculty" data-allow-clear="true">
                            @foreach ($faculty as $facultys)
                              <option value="{{$facultys->id}}">{{$facultys->name}}</option>
                            @endforeach
                          </select>
                        </div><!-- /.form-group -->



                      <!-- .form-group -->
                      <div class="form-group">
                          <label class="control-label" for="select2-batch">Batch:</label> 
                          <select id="select2-batch" class="form-control" name="batch_id" data-toggle="select2" data-placeholder="Select a Batch" data-allow-clear="true">
                            @foreach ($batch as $batchs)
                              <option value="{{$batchs->id}}">{{$batchs->name}}</option>
                            @endforeach
                          </select>
                        </div><!-- /.form-group -->


                         <!-- .form-group -->
                         <div class="form-group">
                          <label class="col-form-label" for="tfDefault">Student Name</label> 
                          <abbr title="Required">*</abbr>
                          <input type="text" class="form-control" id="tfDefault" placeholder="Enter Student Name" name="name" value="{{$student->name}}">
                        </div><!-- /.form-group -->

                        <!-- .form-group -->
                        <div class="form-group">
                          <label class="col-form-label" for="selDefault">Gender</label> 
                          <abbr title="Required">*</abbr>
                          <select class="custom-select" id="selDefault" name="gender" value="{{$student->gender}}">
                            <option>Male</option>
                            <option>Female</option>
                            <option>Other</option>
                            
                          </select>
                        </div><!-- /.form-group -->

                        
                        
                        <!-- .form-group -->
                        <div class="form-group">
                          <label class="col-form-label" for="tfDefault">Qualification</label> 
                          <input type="text" class="form-control" id="tfDefault" placeholder="Enter Qualification" name="qualification" value="{{$student->qualification}}">
                        </div><!-- /.form-group -->
                        
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <!-- .form-group -->
                         <div class="form-group">
                          <label for="tf3">Student Photo</label>
                          <abbr title="Required">*</abbr>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="tf3" name="photo"> <label class="custom-file-label" for="tf3">Photo</label>
                          </div>
                        </div><!-- /.form-group -->

                        <div class="form-group">
                            <span>Email</span>
                            <abbr title="Required">*</abbr>
                            <input type="email" class="form-control" id="fl1" placeholder="Enter Email address" required="" name="email" value="{{$student->email}}">
                        </div><!-- /.form-group -->

                        <!-- .form-group -->
                        <div class="form-group">
                          <label class="col-form-label" for="tfDefault">Date Of Birth:</label> 
                          <abbr title="Required">*</abbr>
                          <input type="date" class="form-control" id="tfDefault"  name="DOB" value="{{$student->DOB}}">
                        </div><!-- /.form-group -->

                         
                         <!-- .form-group -->
                         <div class="form-group">
                          <label for="tf2">Phone No:</label> <abbr title="Required">*</abbr>
                          <div class="custom-number">
                            <input type="number" class="form-control"  name="phone" placeholder="Enter Student Phone NO" value="{{$student->phone}}">
                          </div>
                        </div><!-- /.form-group -->
                        
                  
                      </div>
                      </div>
                <hr>
                <div class="row page-section">
                      <div class="col-md-6 col-sm-6 col-xs-12">

                      <h3>Father Information</h3>
                    <!-- .form-group -->
                    <div class="form-group">
                          <label class="col-form-label" for="tfDefault">Father Name</label> 
                          <abbr title="Required">*</abbr>
                          <input type="text" class="form-control" id="tfDefault" placeholder="Enter Father Name" name="fatherName" value="{{$student->fatherName}}">
                        </div><!-- /.form-group -->

                        <div class="form-group">
                            <span>Email</span>
                            <abbr title="Required">*</abbr>
                            <input type="email" class="form-control" id="fl1" placeholder="Enter Email address" required="" name="fatherEmail" value="{{$student->fatherEmail}}">
                        </div><!-- /.form-group -->

                         <!-- .form-group -->
                         <div class="form-group">
                          <label for="tf2">Phone No:</label> <abbr title="Required">*</abbr>
                          <div class="custom-number">
                            <input type="number" class="form-control"  name="fatherPhone" placeholder="Enter Father Phone No" value="{{$student->fatherPhone}}">
                          </div>
                        </div><!-- /.form-group -->
                        
                    <!-- .form-group -->
                    <div class="form-group">
                          <label class="col-form-label" for="tfDefault">Occupation</label> 
                          
                          <input type="text" class="form-control" id="tfDefault" placeholder="Enter Father Occupation" name="fatherOccupation" value="{{$student->fatherOccupation}}">
                        </div><!-- /.form-group -->



                    <!-- .form-group -->
                    <div class="form-group">
                          <label class="col-form-label" for="tfDefault">Office Name</label> 
                          
                          <input type="text" class="form-control" id="tfDefault" placeholder="Enter Office Name" name="fatherOffice" value="{{$student->fatherOffice}}">
                        </div><!-- /.form-group -->



                    <!-- .form-group -->
                    <div class="form-group">
                          <label class="col-form-label" for="tfDefault">Designation</label> 
                          
                          <input type="text" class="form-control" id="tfDefault" placeholder="Enter Designation" name="fatherDesignation" value="{{$student->fatherDesignation}}">
                        </div><!-- /.form-group -->


                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12">
                       <h3>Mother Information</h3>
                        
                         <!-- .form-group -->
                         <div class="form-group">
                          <label class="col-form-label" for="tfDefault">Mother Name</label> 
                          <abbr title="Required">*</abbr>
                          <input type="text" class="form-control" id="tfDefault" name="motherName" placeholder="Enter Mother Name" value="{{$student->motherName}}">
                        </div><!-- /.form-group -->

                        <div class="form-group">
                            <span>Email</span>
                            <abbr title="Required">*</abbr>
                            <input type="email" class="form-control" id="fl1" placeholder="Enter Email address" required="" name="motherEmail" value="{{$student->motherEmail}}">
                        </div><!-- /.form-group -->

                         <!-- .form-group -->
                         <div class="form-group">
                          <label for="tf2">Phone No:</label> <abbr title="Required">*</abbr>
                          <div class="custom-number">
                            <input type="number" class="form-control"  name="motherPhone" placeholder="Enter Mother Phone No" value="{{$student->motherPhone}}">
                          </div>
                        </div><!-- /.form-group -->
                        
                    <!-- .form-group -->
                    <div class="form-group">
                          <label class="col-form-label" for="tfDefault">Occupation</label> 
                          
                          <input type="text" class="form-control" id="tfDefault" placeholder="Enter Mother Occupation" name="motherOccupation" value="{{$student->motherOccupation}}">
                        </div><!-- /.form-group -->



                    <!-- .form-group -->
                    <div class="form-group">
                          <label class="col-form-label" for="tfDefault">Office Name</label> 
                          
                          <input type="text" class="form-control" id="tfDefault" placeholder="Enter Office Name" name="motherOffice" value="{{$student->motherOffice}}">
                        </div><!-- /.form-group -->



                    <!-- .form-group -->
                    <div class="form-group">
                          <label class="col-form-label" for="tfDefault">Designation</label> 
                          
                          <input type="text" class="form-control" id="tfDefault" placeholder="Enter Designation" name="motherDesignation" value="{{$student->motherDesignation}}">
                        </div><!-- /.form-group -->


                      </div>
                      </div><!-- /.row -->
                     
                   
                      <hr>

                      <div class="row page-section">
                      <div class="col-md-6 col-sm-6 col-xs-12">
                    <h3>Temprory Address</h3>

                         <!-- .form-group -->
                         <div class="form-group">
                          <label class="col-form-label" for="tfDefault">Country</label> 
                          <input type="text" class="form-control" id="tfDefault" placeholder="Enter Country" name="t_country" value="{{$student->t_country}}">
                        </div><!-- /.form-group -->

                         <!-- .form-group -->
                         <div class="form-group">
                          <label class="col-form-label" for="tfDefault">State</label> 
                          <input type="text" class="form-control" id="tfDefault" placeholder="Enter State" name="t_state" value="{{$student->t_state}}">
                        </div><!-- /.form-group -->

                         <!-- .form-group -->
                         <div class="form-group">
                          <label class="col-form-label" for="tfDefault">City</label> 
                          <input type="text" class="form-control" id="tfDefault" placeholder="Enter city" name="t_city" value="{{$student->t_city}}">
                        </div><!-- /.form-group -->

                         <!-- .form-group -->
                         <div class="form-group">
                          <label class="col-form-label" for="tfDefault">Zip Code</label> 
                          <input type="text" class="form-control" id="tfDefault" placeholder="Enter Zip Code" name="t_zipcode" value="{{$student->t_zipcode}}">
                        </div><!-- /.form-group -->

                         <!-- .form-group -->
                         <div class="form-group">
                          <label class="col-form-label" for="tfDefault">Nationality</label> 
                          <input type="text" class="form-control" id="tfDefault" placeholder="Enter Nationality" name="t_nationality" value="{{$student->t_nationality}}">
                        </div><!-- /.form-group -->


                    </div>

                     <div class="col-md-6 col-sm-6 col-xs-12">
                    <h3>Permanent Address</h3>
                    
                         <!-- .form-group -->
                         <div class="form-group">
                          <label class="col-form-label" for="tfDefault">Country</label> 
                          <input type="text" class="form-control" id="tfDefault" placeholder="Enter Country" name="p_country" value="{{$student->p_country}}">
                        </div><!-- /.form-group -->

                         <!-- .form-group -->
                         <div class="form-group">
                          <label class="col-form-label" for="tfDefault">State</label> 
                          <input type="text" class="form-control" id="tfDefault" placeholder="Enter State" name="p_state" value="{{$student->p_state}}">
                        </div><!-- /.form-group -->

                         <!-- .form-group -->
                         <div class="form-group">
                          <label class="col-form-label" for="tfDefault">City</label> 
                          <input type="text" class="form-control" id="tfDefault" placeholder="Enter city" name="p_city" value="{{$student->p_city}}">
                        </div><!-- /.form-group -->

                         <!-- .form-group -->
                         <div class="form-group">
                          <label class="col-form-label" for="tfDefault">Zip Code</label> 
                          <input type="text" class="form-control" id="tfDefault" placeholder="Enter Zip Code" name="p_zipcode" value="{{$student->p_zipcode}}">
                        </div><!-- /.form-group -->

                         <!-- .form-group -->
                         <div class="form-group">
                          <label class="col-form-label" for="tfDefault">Nationality</label> 
                          <input type="text" class="form-control" id="tfDefault" placeholder="Enter Nationality" name="p_nationality" value="{{$student->p_nationality}}">
                        </div><!-- /.form-group -->


                    </div>
                      </div>
                      <div class="form-actions">
                        <div class="card-body"><a href="{{url('student')}}"><button class="btn btn-success "  style="float:right;">back</button></a> 
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <button class="btn btn-danger" type="reset">Reset</button>
                      </div>
                      </div>
                    </form><!-- /.form -->
                  </div><!-- /.card-body -->
                  <!-- .card-body -->
                </div>
</div>


@endsection 