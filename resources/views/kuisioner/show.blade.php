@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="mb-0">Detail Kuisioner</h2>
            <p class="text-muted">Hasil pengisian kuisioner Anda</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('kuisioner.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Informasi Kuisioner</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-muted small">Tanggal Isi</h6>
                            <p class="mb-0">{{ $kuisioner->tanggal ? \Carbon\Carbon::parse($kuisioner->tanggal)->format('d M Y') : '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted small">Skor Total</h6>
                            <p class="mb-0">
                                <span class="badge bg-info">{{ $kuisioner->skor_total ?? '-' }}</span>
                            </p>
                        </div>
                    </div>

                    @if($kuisioner->komentar)
                        <hr>
                        <h6 class="text-muted small mb-3">Komentar Umum</h6>
                        <div class="alert alert-light border">
                            <p class="mb-0">{{ $kuisioner->komentar }}</p>
                        </div>
                    @endif
                </div>
            </div>

            @if($details->count() > 0)
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Detail Jawaban Kuisioner</h5>
                    </div>
                    <div class="card-body">
                        @foreach($details as $index => $detail)
                            <div class="mb-4 pb-4 border-bottom">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="text-muted small">Pertanyaan {{ $index + 1 }}</h6>
                                    <span class="badge bg-success">Skor: {{ $detail->skor ?? '-' }}</span>
                                </div>
                                
                                @if($detail->jawaban)
                                    <p class="small mb-0">
                                        <strong>Jawaban: </strong><br>
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
                        <i class="fas fa-chart-bar text-primary"></i> Statistik
                    </h6>
                    <p class="small mb-2">
                        <strong>Total Pertanyaan:</strong> {{ $details->count() ?? 0 }}
                    </p>
                    @if($details->count() > 0)
                        <p class="small mb-2">
                            <strong>Rata-rata Skor:</strong> 
                            {{ number_format($details->avg('skor'), 2) }}
                        </p>
                        <p class="small mb-2">
                            <strong>Skor Tertinggi:</strong> 
                            {{ $details->max('skor') ?? '-' }}
                        </p>
                        <p class="small mb-2">
                            <strong>Skor Terendah:</strong> 
                            {{ $details->min('skor') ?? '-' }}
                        </p>
                    @endif
                    <hr>
                    <p class="small mb-0 text-muted">
                        Terima kasih telah mengisi kuisioner ini. Feedback Anda sangat berharga untuk kami.
                    </p>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h6 class="card-title mb-3">
                        <i class="fas fa-info-circle text-info"></i> Interpretasi Skor
                    </h6>
                    <p class="small mb-0">
                        @php
                            $skorRata = $details->count() > 0 ? $details->avg('skor') : 0;
                        @endphp
                        @if($skorRata >= 4)
                            Skor Anda menunjukkan respons yang sangat positif terhadap pertanyaan-pertanyaan dalam kuisioner ini.
                        @elseif($skorRata >= 3)
                            Skor Anda menunjukkan respons yang cukup positif. Ada beberapa area yang mungkin perlu perhatian lebih.
                        @else
                            Skor Anda menunjukkan perlunya evaluasi lebih lanjut. Silakan diskusikan hasil ini dengan konselor.
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
