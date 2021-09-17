@extends('layout.master')

@section('title', 'Admins')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <div class="row">
                     <div class="col-md-6">
                         <h4 class="card-title">Admins</h4>
                     </div>
                       <div class="col-md-6 text-right">
                           <a class="btn btn-primary" href="{{route('admins.create')}}">Add New</a>
                       </div>
                   </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                            <th>
                                Name
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                **
                            </th>

                            </thead>
                            <tbody>

                            @foreach($admins as $admin)
                            <tr>
                                <td>
                                    {{$admin->first_name}}
                                </td>
                                <td>
                                    {{$admin->email}}
                                </td>
                                <td>
                                   <div class="btn-group btn-group-sm">
                                       <a href="{{route('admins.edit', $admin->id)}}" class="btn btn-primary">Edit</a>
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
