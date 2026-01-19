@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Tambah Jurusan Baru</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Form Tambah Jurusan</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.jurusan.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group mb-3">
                            <label class="form-label">Kode Jurusan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('kode_jurusan') is-invalid @enderror" 
                                   name="kode_jurusan" value="{{ old('kode_jurusan') }}" placeholder="Contoh: RPL, TPM, TKR" required>
                            @error('kode_jurusan')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Nama Jurusan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_jurusan') is-invalid @enderror" 
                                   name="nama_jurusan" value="{{ old('nama_jurusan') }}" placeholder="Contoh: Rekayasa Perangkat Lunak" required>
                            @error('nama_jurusan')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      name="deskripsi" rows="4" placeholder="Deskripsi singkat tentang jurusan">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.jurusan.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
