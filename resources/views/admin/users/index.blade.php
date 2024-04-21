@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Users</h1>
@stop

@section('content')
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Users</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 1%">#</th>
                        <th style="width: 20%">Name</th>
                        <th style="width: 20%">Email</th>
                        <th style="width: 20%">Role(s)</th>
                        <th style="width: 20%">Created At</th>
                        <th style="width: 19%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>
                                <a>{{ $user->name }}</a><br>
                                <small>Created: {{ $user->created_at }}</small>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach($user->roles as $role)
                                    {{ $role->name }}
                                    @if (!$loop->last), @endif
                                @endforeach
                            </td>
                            <td>{{ $user->created_at }}</td>

                            <td class="project-actions text-right">
                                <a class="btn btn-info btn-sm" href="{{ route('admin.users.edit', $user->id) }}">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                                @if(!$user->hasRole('admin'))
                                    <a class="btn btn-danger btn-sm delete-user-btn" href="#" data-user-id="{{ $user->id }}">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Delete User Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this user?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteUserForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    // Handle delete button click
    $(document).on('click', '.delete-user-btn', function () {
        var userId = $(this).data('user-id');
        $('#deleteUserForm').attr('action', '/users/' + userId);
        $('#deleteUserModal').modal('show');
    });
</script>
@endpush