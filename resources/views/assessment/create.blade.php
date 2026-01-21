@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="mb-0">Buat Self Assessment</h2>
            <p class="text-muted">Lakukan evaluasi diri dan monitoring kesehatan mental</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('assessment.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Topik Assessmen <span class="text-danger">*</span></label>
                            <input type="text" name="topik" class="form-control @error('topik') is-invalid @enderror" 
                                   value="{{ old('topik') }}" 
                                   placeholder="Contoh: Stress akademik, Masalah percaya diri, dll" required>
                            @error('topik')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Isi Curhat / Keluhan <span class="text-danger">*</span></label>
                            <textarea name="isi_curhat" class="form-control @error('isi_curhat') is-invalid @enderror" 
                                      rows="5" placeholder="Jelaskan masalah atau keluhan yang Anda hadapi..." required>{{ old('isi_curhat') }}</textarea>
                            @error('isi_curhat')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Tingkat Stres <span class="text-danger">*</span></label>
                            <div class="d-flex align-items-center gap-3">
                                <input type="range" name="tingkat_stres" class="form-range" min="1" max="10" 
                                       value="{{ old('tingkat_stres', 5) }}" id="stresRange" required>
                                <span class="badge bg-warning" id="stresValue" style="font-size: 16px; min-width: 40px;">5</span>
                            </div>
                            <small class="text-muted d-block mt-2">1 = Sangat Rendah | 10 = Sangat Tinggi</small>
                        </div>

                        @if($pertanyaan->count() > 0)
                            <div class="mb-4">
                                <h5 class="card-title mb-3">Pertanyaan Screening</h5>
                                @foreach($pertanyaan as $index => $item)
                                    <div class="mb-4 p-3 border rounded bg-light">
                                        <label class="form-label fw-semibold mb-3">
                                            {{ $index + 1 }}. {{ $item->pertanyaan ?? 'Pertanyaan' }}
                                        </label>
                                        
                                        <div class="mb-3">
                                            <div class="btn-group w-100" role="group">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <input type="radio" class="btn-check" name="skor[{{ $item->pertanyaan_id ?? $index }}]" 
                                                           id="skor{{ $item->pertanyaan_id ?? $index }}_{{ $i }}" 
                                                           value="{{ $i }}">
                                                    <label class="btn btn-outline-primary" for="skor{{ $item->pertanyaan_id ?? $index }}_{{ $i }}">
                                                        {{ $i }}
                                                    </label>
                                                @endfor
                                            </div>
                                            <small class="text-muted d-block mt-2">1 = Sangat Tidak Sesuai | 5 = Sangat Sesuai</small>
                                        </div>

                                        <textarea name="jawaban[{{ $item->pertanyaan_id ?? $index }}]" class="form-control" 
                                                  rows="2" placeholder="Penjelasan (opsional)"></textarea>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i> Belum ada pertanyaan assessment tersedia.
                            </div>
                        @endif

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end" style="gap: 8px !important;">
                            <a href="{{ route('assessment.index') }}" class="btn btn-danger" style="padding: 8px 24px; font-weight: 500; min-width: 100px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary" style="padding: 8px 24px; font-weight: 500; min-width: 160px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-save me-2"></i>Simpan Assessment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card bg-light">
                <div class="card-body">
                    <h6 class="card-title mb-3">
                        <i class="fas fa-lightbulb text-warning"></i> Tentang Assessment
                    </h6>
                    <p class="small mb-3">
                        Self Assessment membantu Anda untuk:
                    </p>
                    <ul class="small mb-0">
                        <li>Mengevaluasi kondisi kesehatan mental</li>
                        <li>Mengidentifikasi area yang perlu perhatian</li>
                        <li>Melacak perkembangan seiring waktu</li>
                        <li>Berkomunikasi dengan konselor dengan lebih baik</li>
                    </ul>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h6 class="card-title mb-3">
                        <i class="fas fa-shield-alt text-success"></i> Kerahasiaan
                    </h6>
                    <p class="small mb-0">
                        Semua data assessment Anda bersifat rahasia dan hanya dapat diakses oleh konselor resmi.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Update stress level display
    document.getElementById('stresRange').addEventListener('input', function() {
        document.getElementById('stresValue').textContent = this.value;
        
        // Change badge color based on stress level
        const stres = parseInt(this.value);
        if (stres <= 3) {
            document.getElementById('stresValue').className = 'badge bg-success';
        } else if (stres <= 6) {
            document.getElementById('stresValue').className = 'badge bg-warning';
        } else if (stres <= 8) {
            document.getElementById('stresValue').className = 'badge bg-orange';
        } else {
            document.getElementById('stresValue').className = 'badge bg-danger';
        }
    });

    // Trigger initial update
    document.getElementById('stresRange').dispatchEvent(new Event('input'));
</script>

<style>
    .bg-orange {
        background-color: #fd7e14 !important;
    }
</style>

@endsection
