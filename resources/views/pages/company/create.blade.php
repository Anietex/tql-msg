@extends('layout.master')

@section('title', 'Companies')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">Add Company</h4>
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
                            <form method="post" action="{{route('companies.save')}}"  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" value="{{ old('name') }}" id="name" name="name" class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                    <small class="invalid-feedback">{{$errors->first('name')}}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" value="{{ old('email') }}" id="email" name="email" class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                    <small class="invalid-feedback">{{$errors->first('email')}}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="website">Website</label>
                                    <input type="url" value="{{ old('website') }}" id="email" name="website" class="form-control @error('website') is-invalid @enderror">
                                    @error('website')
                                    <small class="invalid-feedback">{{$errors->first('website')}}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="logo">Logo</label>
                                    <input type="file" accept="image/*" id="logo" name="logo" class="@error('logo') is-invalid @enderror">
                                    @error('logo')
                                    <small class="invalid-feedback">{{$errors->first('logo')}}</small>
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

