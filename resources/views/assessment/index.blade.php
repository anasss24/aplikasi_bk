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
                                    <h6 class="card-title fw-bold mb-1">{{ $assessment->topik }}</h6>
                                    <small class="text-muted">{{ $assessment->tanggal_isi->format('d M Y') }}</small>
                                </div>
                                <span class="badge bg-warning">Stres: {{ $assessment->tingkat_stres }}/10</span>
                            </div>
                            <p class="text-truncate text-muted">{{ Str::limit($assessment->isi_curhat, 100) }}</p>
                            <a href="{{ route('assessment.show', $assessment->assessment_id) }}" class="btn btn-sm btn-outline-primary">
                                Lihat Detail
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
@endsection
