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
                                            <button data-id="{{ $admin->id }}" class="btn btn-danger delete-btn">Delete</button>
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

    <form method="post" id="delete-form">
        @csrf
        @method('DELETE')
    </form>
@endsection
@push('scripts')
    <script>
        $('.delete-btn').on('click', function (){
            let id =  $(this).data('id');
            swal({
                title: "Are you sure?",
                text: "Are you sure want to delete admin",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                    if (willDelete) {
                        let form = document.getElementById('delete-form');
                        form.action = '/admins/'+id;
                        form.submit()
                    }
                });
        })
    </script>
@endpush
