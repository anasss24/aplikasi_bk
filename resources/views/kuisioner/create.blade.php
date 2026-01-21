@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="mb-0">Isi Kuisioner</h2>
            <p class="text-muted">Bagikan feedback dan masukan Anda</p>
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
                    <form action="{{ route('kuisioner.store') }}" method="POST">
                        @csrf

                        @if($pertanyaan->count() > 0)
                            <div class="mb-4">
                                <h5 class="card-title mb-3">Pertanyaan Kuisioner</h5>
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
                                                           value="{{ $i }}" 
                                                           required>
                                                    <label class="btn btn-outline-primary" for="skor{{ $item->pertanyaan_id ?? $index }}_{{ $i }}">
                                                        {{ $i }}
                                                    </label>
                                                @endfor
                                            </div>
                                            <small class="text-muted d-block mt-2">1 = Sangat Tidak Setuju | 5 = Sangat Setuju</small>
                                        </div>

                                        <textarea name="jawaban[{{ $item->pertanyaan_id ?? $index }}]" class="form-control" 
                                                  rows="2" placeholder="Komentar atau penjelasan (opsional)"></textarea>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i> Belum ada pertanyaan kuisioner tersedia.
                            </div>
                        @endif

                        <div class="mb-4">
                            <label class="form-label fw-semibold mb-2">Komentar Umum</label>
                            <textarea name="komentar" class="form-control" rows="4" 
                                      placeholder="Berikan masukan dan saran tambahan Anda..."></textarea>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end" style="gap: 8px !important;">
                            <a href="{{ route('kuisioner.index') }}" class="btn btn-danger" style="padding: 8px 24px; font-weight: 500; min-width: 100px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary" style="padding: 8px 24px; font-weight: 500; min-width: 160px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-save me-2"></i>Simpan Kuisioner
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
                        <i class="fas fa-lightbulb text-warning"></i> Tips Pengisian
                    </h6>
                    <ul class="small mb-0">
                        <li>Jawab dengan jujur dan sesuai kondisi Anda</li>
                        <li>Skala 1-5 menunjukkan tingkat kesepakatan</li>
                        <li>Tambahkan komentar untuk memperkuat jawaban</li>
                        <li>Informasi Anda dijaga kerahasiaannya</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
