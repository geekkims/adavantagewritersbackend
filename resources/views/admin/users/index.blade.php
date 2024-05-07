<!-- resources/views/admin/users/index.blade.php -->

@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <h1>Users</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">User List</h3>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">User List</h3>
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="search" class="form-control float-right" placeholder="Search">
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>User Type</th>
                        <th>Status</th>
                        <th>Mobile Number</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($paginatedUsers as $user)
                    <tr>
                        <td>{{ $user['email'] }}</td>
                        <td>{{ $user['firstname'] }}</td>
                        <td>{{ $user['middlename'] }}</td>
                        <td>{{ $user['lastname'] }}</td>
                        <td>{{ $user['usertype'] }}</td>
                        <td>{{ $user['status'] }}</td>
                        <td>{{ $user['mobile_number'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
                {{ $paginatedUsers->links('pagination::bootstrap-5') }}
            </ul>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('input[name="search"]').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('table tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

</div>

    <!-- /.card -->
@stop
