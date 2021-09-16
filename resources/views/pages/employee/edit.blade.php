@extends('layout.master')

@section('title', 'Employees')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">Edit Employee</h4>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                  <div class="row">
                      <div class="col-md-8 mx-auto pb-5">
                          <form method="post">
                              @csrf

                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="name">First Name</label>
                                          <input type="text" id="name" name="name" class="form-control">
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="name">Last Name</label>
                                          <input type="text" id="name" name="name" class="form-control">
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="phone">Phone Number</label>
                                  <input type="tel" id="phone" name="phone_no" class="form-control">
                              </div>
                              <div class="form-group">
                                  <label for="email">Email</label>
                                  <input type="text" id="email" name="email" class="form-control">
                              </div>

                              <div class="form-group">
                                  <label for="company">Company</label>
                                  <select name="company_id"  id="company" class="form-control">
                                  </select>
                              </div>

                              <div>
                                  <button class="btn btn-primary">Update</button>
                              </div>
                          </form>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection
