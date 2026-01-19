@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="mb-0">Manajemen Siswa</h2>
            <p class="text-muted">Kelola data siswa di sekolah</p>
        </div>
        <div class="col-md-4 text-end">
            @if((Auth::user()->role ?? null) === 'admin' || (Auth::user()->role ?? null) === 'guru_bk')
            <a href="{{ route('siswa.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Siswa
            </a>
            @endif
        </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Table -->
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Jenis Kelamin</th>
                        <th>No. Telepon</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($siswa as $s)
                    <tr>
                        <td><strong>{{ $s->nis }}</strong></td>
                        <td>{{ $s->nama_siswa }}</td>
                        <td>{{ $s->kelas->nama_kelas ?? '-' }}</td>
                        <td>{{ $s->jenis_kelamin }}</td>
                        <td>{{ $s->no_telepon ?? '-' }}</td>
                        <td>
                            <span class="badge bg-{{ $s->status === 'aktif' ? 'success' : 'danger' }}">
                                {{ ucfirst($s->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group" role="group" style="gap: 5px;">
                                <a href="{{ route('siswa.show', $s) }}" class="btn btn-outline-info" title="Lihat" style="min-width: 50px; height: 38px; display: flex; align-items: center; justify-content: center; padding: 6px 12px;">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if((Auth::user()->role ?? null) === 'admin' || (Auth::user()->role ?? null) === 'guru_bk')
                                <a href="{{ route('siswa.edit', $s) }}" class="btn btn-primary" title="Edit" style="min-width: 80px; height: 38px; display: flex; align-items: center; justify-content: center; padding: 6px 12px;">
                                    <i class="fas fa-edit me-2"></i>Edit
                                </a>
                                <form action="{{ route('siswa.destroy', $s) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus?')" style="min-width: 80px; height: 38px; display: flex; align-items: center; justify-content: center; padding: 6px 12px;">
                                        <i class="fas fa-trash me-2"></i>Hapus
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            Tidak ada data siswa
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer border-top">
            {{ $siswa->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>

<style>
    .table-hover tbody tr:hover {
        background-color: #f5f5f5;
    }
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
</style>
@endsection
