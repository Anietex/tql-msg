
@extends('layout.master')

@section('title', 'Employees')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">Employees</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <a class="btn btn-primary" href="{{route('employees.create')}}">Add New</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                            <th>
                                First name
                            </th>
                            <th>
                                Last name
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Phone Number
                            </th>
                            <th>
                                Company
                            </th>
                            <th class="text-right">
                                ***
                            </th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    Dakota
                                </td>
                                <td>
                                    Rice
                                </td>
                                <td>
                                    Rice@mail.com
                                </td>
                                <td>0000500505050</td>
                                <td>
                                    Oud-Turnhout
                                </td>
                                <td class="text-right">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{route('employees.edit', 1)}}" class="btn btn-primary">Edit</a>
                                        <button class="btn btn-danger">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

