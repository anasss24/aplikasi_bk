@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h2 fw-bold text-dark mb-0">Self Assessment</h1>
                    <p class="text-muted mb-0">Penilaian diri untuk pengembangan pribadi</p>
                </div>
                <a href="{{ route('assessment.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Buat Assessment Baru
                </a>
            </div>
        </div>
    </div>

    @if($assessments->count() > 0)
        <div class="row g-3">
            @foreach($assessments as $assessment)
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h6 class="card-title fw-bold mb-1">{{ $assessment->topik ?? '-' }}</h6>
                                    <small class="text-muted">{{ $assessment->tanggal_isi ? \Carbon\Carbon::parse($assessment->tanggal_isi)->format('d M Y') : '-' }}</small>
                                </div>
                                <span class="badge bg-warning">Stres: {{ $assessment->tingkat_stres ?? '-' }}/10</span>
                            </div>
                            <p class="text-truncate text-muted">{{ $assessment->isi_curhat ? Str::limit($assessment->isi_curhat, 100) : 'Tidak ada deskripsi' }}</p>
                            <a href="{{ route('assessment.show', $assessment->id ?? $assessment->assessment_id) }}" class="btn btn-sm btn-icon-view" title="Lihat Detail" style="width: 40px; height: 40px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; background: linear-gradient(135deg, #0099C9, #0077B6); border: none; color: white; transition: all 0.3s ease;">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row mt-4">
            <div class="col-12">
                {{ $assessments->links() }}
            </div>
        </div>
    @else
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <i class="fas fa-clipboard fa-3x text-muted mb-3 opacity-25"></i>
                <p class="text-muted">Belum ada self assessment</p>
                <a href="{{ route('assessment.create') }}" class="btn btn-primary">
                    Mulai Assessment
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
