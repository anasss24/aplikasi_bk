@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>Jadwal Konseling</h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('jadwal.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Jadwal Baru
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal & Waktu</th>
                        <th>Siswa</th>
                        <th>Guru BK</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwals as $jadwal)
                        <tr>
                            <td>
                                {{ $jadwal->jadwal_datetime ? \Carbon\Carbon::parse($jadwal->jadwal_datetime)->format('d/m/Y H:i') : '-' }}
                            </td>
                            <td>{{ $jadwal->siswa->nama ?? '-' }}</td>
                            <td>{{ $jadwal->guru->nama ?? '-' }}</td>
                            <td>
                                <span class="badge bg-{{ $jadwal->metode === 'online' ? 'info' : 'secondary' }}">
                                    {{ ucfirst($jadwal->metode) }}
                                </span>
                            </td>
                            <td>
                                @if($jadwal->status === 'diajukan')
                                    <span class="badge bg-warning">Diajukan</span>
                                @elseif($jadwal->status === 'disetujui')
                                    <span class="badge bg-success">Disetujui</span>
                                @elseif($jadwal->status === 'batal')
                                    <span class="badge bg-danger">Batal</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('jadwal.show', $jadwal->id) }}" class="btn btn-sm btn-info" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if(auth()->user()->hasRole('guru') && $jadwal->status === 'diajukan')
                                    <form action="{{ route('jadwal.approve', $jadwal->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success" title="Setujui">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                @endif
                                @if(auth()->user()->hasRole('siswa') && $jadwal->status === 'diajukan')
                                    <form action="{{ route('jadwal.cancel', $jadwal->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Batal">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="fas fa-inbox"></i> Tidak ada jadwal
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $jadwals->links() }}
        </div>
    </div>
</div>
@endsection
