@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>Jadwal Konseling</h2>
            @if(auth()->user()->role === 'guru_bk')
                <p class="text-muted small mb-0">Kelola permohonan jadwal konseling dari siswa</p>
            @endif
        </div>
        <div class="col-md-4 text-end">
            @if(auth()->user()->role !== 'guru_bk')
                <a href="{{ route('jadwal.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Jadwal Baru
                </a>
            @endif
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
                            <td>{{ $jadwal->siswa->nama_siswa ?? '-' }}</td>
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
                                @elseif($jadwal->status === 'ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                @elseif($jadwal->status === 'batal')
                                    <span class="badge bg-danger">Batal</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('jadwal.show', $jadwal->jadwal_id) }}" class="btn btn-sm btn-info" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </a>
                                {{-- Untuk Guru BK: Tombol Setuju dan Tolak --}}
                                @if(auth()->user()->role === 'guru_bk' && $jadwal->status === 'diajukan')
                                    <form action="{{ route('jadwal.approve', $jadwal->jadwal_id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success" title="Setuju">
                                            <i class="fas fa-check"></i> Setuju
                                        </button>
                                    </form>
                                    <form action="{{ route('jadwal.reject', $jadwal->jadwal_id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger" title="Tolak" onclick="return confirm('Tolak jadwal konseling ini?')">
                                            <i class="fas fa-times"></i> Tolak
                                        </button>
                                    </form>
                                @endif
                                {{-- Untuk Siswa: Tombol Batalkan --}}
                                @if(auth()->user()->role === 'siswa' && $jadwal->status === 'diajukan')
                                    <form id="cancelForm{{ $jadwal->jadwal_id }}" action="{{ route('jadwal.cancel', $jadwal->jadwal_id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmCancel({{ $jadwal->jadwal_id }})">
                                            <i class="fas fa-trash"></i> Batalkan
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

<script>
    function confirmCancel(jadwalId) {
        Swal.fire({
            title: 'Batalkan Jadwal?',
            text: 'Anda akan membatalkan jadwal konseling ini. Tindakan ini tidak dapat dibatalkan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Batalkan',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                popup: 'custom-swal-popup',
                confirmButton: 'custom-swal-btn-confirm',
                cancelButton: 'custom-swal-btn-cancel',
                title: 'custom-swal-title',
                htmlContainer: 'custom-swal-text'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('cancelForm' + jadwalId).submit();
            }
        });
    }
</script>

<style>
    .custom-swal-popup {
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15) !important;
        padding: 30px !important;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%) !important;
    }

    .custom-swal-title {
        font-size: 22px !important;
        font-weight: 700 !important;
        color: #1a1a1a !important;
        margin-bottom: 12px !important;
    }

    .custom-swal-text {
        font-size: 15px !important;
        color: #666666 !important;
        line-height: 1.6 !important;
    }

    .custom-swal-btn-confirm {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%) !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 12px 28px !important;
        font-weight: 600 !important;
        font-size: 15px !important;
        transition: all 0.3s ease !important;
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3) !important;
    }

    .custom-swal-btn-confirm:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 16px rgba(220, 53, 69, 0.4) !important;
    }

    .custom-swal-btn-cancel {
        background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%) !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 12px 28px !important;
        font-weight: 600 !important;
        font-size: 15px !important;
        color: #495057 !important;
        transition: all 0.3s ease !important;
    }

    .custom-swal-btn-cancel:hover {
        transform: translateY(-2px) !important;
        background: linear-gradient(135deg, #dee2e6 0%, #ced4da 100%) !important;
    }

    .swal2-icon {
        width: 60px !important;
        height: 60px !important;
        margin-bottom: 15px !important;
    }
</style>

@endsection
