@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="mb-0">Detail Self Assessment</h2>
            <p class="text-muted">Hasil evaluasi diri Anda</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('assessment.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Informasi Assessment</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-muted small">Tanggal Isi</h6>
                            <p class="mb-0">{{ $assessment->tanggal_isi ? \Carbon\Carbon::parse($assessment->tanggal_isi)->format('d M Y') : '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted small">Topik</h6>
                            <p class="mb-0">{{ $assessment->topik ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-muted small">Tingkat Stres</h6>
                            <p class="mb-0">
                                <span class="badge bg-{{ $assessment->tingkat_stres <= 3 ? 'success' : ($assessment->tingkat_stres <= 6 ? 'warning' : 'danger') }}">
                                    {{ $assessment->tingkat_stres ?? '-' }} / 10
                                </span>
                            </p>
                        </div>
                    </div>

                    <hr>

                    <h6 class="text-muted small mb-3">Isi Curhat / Keluhan</h6>
                    <div class="alert alert-light border">
                        <p class="mb-0">{{ $assessment->isi_curhat ?? '-' }}</p>
                    </div>
                </div>
            </div>

            @if($details->count() > 0)
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Jawaban Screening</h5>
                    </div>
                    <div class="card-body">
                        @foreach($details as $index => $detail)
                            <div class="mb-4 pb-4 border-bottom">
                                <h6 class="text-muted small">Pertanyaan {{ $index + 1 }}</h6>
                                <p class="mb-2">
                                    <strong>Skor: </strong>
                                    <span class="badge bg-info">{{ $detail->skor ?? '-' }}</span>
                                </p>
                                @if($detail->jawaban)
                                    <p class="mb-0">
                                        <strong>Penjelasan: </strong><br>
                                        {{ $detail->jawaban }}
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div class="col-lg-4">
            <div class="card bg-light">
                <div class="card-body">
                    <h6 class="card-title mb-3">
                        <i class="fas fa-chart-pie text-primary"></i> Ringkasan
                    </h6>
                    <p class="small mb-2">
                        <strong>Total Jawaban:</strong> {{ $details->count() ?? 0 }}
                    </p>
                    @if($details->count() > 0)
                        <p class="small mb-2">
                            <strong>Rata-rata Skor:</strong> 
                            {{ number_format($details->avg('skor'), 2) }}
                        </p>
                    @endif
                    <hr>
                    <p class="small mb-0 text-muted">
                        Hasil assessment ini membantu Anda dan konselor untuk memahami kondisi kesehatan mental Anda dengan lebih baik.
                    </p>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h6 class="card-title mb-3">
                        <i class="fas fa-lightbulb text-warning"></i> Saran
                    </h6>
                    <p class="small mb-0">
                        @if($assessment->tingkat_stres > 7)
                            Tingkat stres Anda cukup tinggi. Pertimbangkan untuk berkonsultasi dengan konselor untuk mendapatkan dukungan.
                        @elseif($assessment->tingkat_stres > 4)
                            Tingkat stres Anda sedang. Cobalah untuk melakukan aktivitas relaksasi dan self-care.
                        @else
                            Tingkat stres Anda terkontrol dengan baik. Pertahankan pola hidup sehat Anda.
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
