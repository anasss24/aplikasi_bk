@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h2 fw-bold text-dark mb-0">Kuisioner</h1>
                    <p class="text-muted mb-0">Survei kepuasan dan evaluasi layanan</p>
                </div>
                <a href="{{ route('kuisioner.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Isi Kuisioner Baru
                </a>
            </div>
        </div>
    </div>

    @if($kuisioners->count() > 0)
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Total Skor</th>
                                    <th>Komentar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kuisioners as $kuisioner)
                                    <tr>
                                        <td>{{ $kuisioner->tanggal ? \Carbon\Carbon::parse($kuisioner->tanggal)->format('d M Y') : '-' }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ $kuisioner->skor_total ?? '-' }}</span>
                                        </td>
                                        <td>{{ $kuisioner->komentar ? Str::limit($kuisioner->komentar, 50) : '-' }}</td>
                                        <td>
                                            <a href="{{ route('kuisioner.show', $kuisioner->id ?? $kuisioner->kuisioner_id) }}" class="btn btn-sm btn-icon-view" title="Lihat Detail" style="width: 40px; height: 40px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; background: linear-gradient(135deg, #0099C9, #0077B6); border: none; color: white; transition: all 0.3s ease;">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                {{ $kuisioners->links() }}
            </div>
        </div>
    @else
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <i class="fas fa-survey fa-3x text-muted mb-3 opacity-25"></i>
                <p class="text-muted">Belum ada kuisioner</p>
                <a href="{{ route('kuisioner.create') }}" class="btn btn-primary">
                    Isi Kuisioner Sekarang
                </a>
            </div>
        </div>
    @endif
</div>

<style>
    .btn-icon-view:hover {
        transform: scale(1.1) !important;
        box-shadow: 0 6px 16px rgba(0, 153, 201, 0.4) !important;
    }
</style>

@endsection
