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
                            @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{session('success')}}
                                </div>
                            @endif


                            @if(session()->has('error'))
                                <div class="alert alert-danger">
                                    {{session('error')}}
                                </div>
                            @endif
                            <form method="post" action="{{route('employees.update', $employee->id)}}">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">First Name</label>
                                            <input type="text" value="{{ $employee->first_name }}" id="name" name="first_name" class="form-control @error('first_name') is-invalid @enderror">
                                            @error('name')
                                            <small class="invalid-feedback">{{$errors->first('first_name')}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Last Name</label>
                                            <input type="text" value="{{ $employee->last_name }}" id="name" name="last_name" class="form-control @error('last_name') is-invalid @enderror">
                                            @error('last_name')
                                            <small class="invalid-feedback">{{$errors->first('last_name')}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="tel" value="{{ $employee->phone_no }}" id="phone" name="phone_no" class="form-control @error('phone_no') is-invalid @enderror">
                                    @error('phone_no')
                                    <small class="invalid-feedback">{{$errors->first('phone_no')}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" id="email" value="{{ $employee->email }}" name="email" class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                    <small class="invalid-feedback">{{$errors->first('email')}}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="company">Company</label>
                                    <select name="company_id"  id="company" class="form-control @error('company_id') is-invalid @enderror">
                                        <option disabled value="" selected> Select company </option>
                                        @foreach($companies as $company)
                                            <option {{ $employee->company_id === $company->id?'selected':''}} value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('company_id')
                                    <small class="invalid-feedback">{{ $errors->first('company_id') }}</small>
                                    @enderror
                                </div>

                                <div>
                                    <button class="btn btn-primary">Save</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
