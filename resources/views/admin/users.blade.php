@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Manajemen User</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Daftar User</h5>
                </div>
                <div class="card-body">
                    @if($users->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Terdaftar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td><span class="badge bg-info text-white">{{ ucfirst($user->role) }}</span></td>
                                    <td>
                                        @if($user->is_verified)
                                            <span class="badge bg-success text-white">Terverifikasi</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Belum Verifikasi</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->format('d M Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group" style="gap: 5px;">
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary" style="min-width: 80px; height: 38px; display: flex; align-items: center; justify-content: center; padding: 6px 12px;"><i class="fas fa-edit me-2"></i>Edit</a>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline;" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" data-delete-message="Yakin ingin menghapus user <strong>{{ $user->name }}</strong>? Tindakan ini tidak dapat dibatalkan." style="min-width: 80px; height: 38px; display: flex; align-items: center; justify-content: center; padding: 6px 12px;"><i class="fas fa-trash me-2"></i>Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Belum ada user terdaftar
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
