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
                                        <td>{{ $kuisioner->tanggal->format('d M Y') }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ $kuisioner->skor_total }}</span>
                                        </td>
                                        <td>{{ Str::limit($kuisioner->komentar, 50) }}</td>
                                        <td>
                                            <a href="{{ route('kuisioner.show', $kuisioner->kuisioner_id) }}" class="btn btn-sm btn-outline-primary">
                                                Lihat
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
@endsection
