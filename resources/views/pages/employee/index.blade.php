
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
                           @foreach($employees as $employee)
                               <tr>
                                   <td>
                                       {{ $employee->first_name }}
                                   </td>
                                   <td>
                                       {{ $employee->last_name }}
                                   </td>
                                   <td>
                                       {{ $employee->email }}
                                   </td>
                                   <td>{{ $employee->phone_no }}</td>
                                   <td>
                                       {{ $employee->company->name }}
                                   </td>
                                   <td class="text-right">
                                       <div class="btn-group btn-group-sm">
                                           <a href="{{route('employees.edit', $employee->id)}}" class="btn btn-primary">Edit</a>
                                           <button class="btn btn-danger">Delete</button>
                                       </div>
                                   </td>
                               </tr>
                           @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

