@extends('layout.master')

@section('content')


    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Welcome</h3>
                </div>
                <div class="card-body">
                    @if(auth()->user()->role->name === 'superadmin')
                        <h4>Role:</h4>
                        <p>Super Admin</p>
                        <h4>Name:</h4>
                        <p>{{auth()->user()->first_name}}</p>
                    @endif

                    @if(auth()->user()->role->name === 'admin')
                        <h4>Role:</h4>
                        <p>Admin</p>
                        <h4>Name:</h4>
                        <p>{{auth()->user()->first_name}}</p>
                    @endif

                    @if(auth()->user()->role->name === 'company')
                        <h4>Role:</h4>
                        <p>Company</p>
                        <h4>Company:</h4>
                        <p>{{auth()->user()->company->name}}</p>
                    @endif


                    @if(auth()->user()->role->name === 'employee')

                        <h4>Role:</h4>
                        <p>Employee</p>
                            <h4>Name: </h4>
                            <p>{{auth()->user()->employee->first_name}} {{auth()->user()->employee->last_name}}</h4>
                        <h4>Company:</h4>
                        <p>{{auth()->user()->employee->company->name}}</p>
                    @endif


                </div>
            </div>
        </div>
    </div>
@endsection
