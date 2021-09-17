
@extends('layout.master')

@section('title', 'Companies')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">Companies</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <a class="btn btn-primary" href="{{route('companies.create')}}">Add New</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                            <tr>
                                <th></th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>Website</th>
                                <th>Created by</th>
                                <th>
                                    **
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($companies as $company)
                                <tr>
                                    <td></td>
                                    <td>
                                        {{$company->name}}
                                    </td>
                                    <td>
                                        {{$company->email}}
                                    </td>
                                    <td>
                                        {{$company->website}}
                                    </td>
                                    <td>
                                        {{$company->createdBy->first_name}}
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{route('companies.edit', $company->id)}}" class="btn btn-primary">Edit</a>
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
