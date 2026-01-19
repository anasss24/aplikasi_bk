@extends('layouts.app')

@section('content')
    <style>
        .page-header {
            padding: 20px 0 15px 0;
            margin-bottom: 20px;
        }
        .btn-primary.btn-sm {
            padding: 8px 18px;
            font-size: 14px;
            font-weight: 500;
            letter-spacing: 0.3px;
        }
        .col-auto {
            padding-left: 10px;
        }
    </style>
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Data Kelas</h3>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.kelas.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Kelas
                    </a>
                </div>
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Daftar Kelas</h5>
                    </div>
                    <div class="card-body">
                        @if($kelas->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Kelas</th>
                                            <th>Nama Kelas</th>
                                            <th>Jurusan</th>
                                            <th>Tingkat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kelas as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->kode_kelas ?? '-' }}</td>
                                                <td>{{ $item->nama_kelas ?? '-' }}</td>
                                                <td>{{ $item->jurusan->nama_jurusan ?? '-' }}</td>
                                                <td>{{ $item->tingkat ?? '-' }}</td>
                                                <td>
                                                    <div class="btn-group" role="group" style="gap: 5px;">
                                                        <a href="/admin/kelas/{{ $item->kelas_id }}/edit"
                                                            class="btn btn-primary" style="min-width: 80px; height: 38px; display: flex; align-items: center; justify-content: center; padding: 6px 12px;">
                                                            <i class="fas fa-edit me-2"></i>Edit
                                                        </a>
                                                        <button type="button" class="btn btn-danger btn-delete"
                                                            data-kelas-id="{{ $item->kelas_id }}"
                                                            data-kode-kelas="{{ $item->kode_kelas }}"
                                                            style="min-width: 80px; height: 38px; display: flex; align-items: center; justify-content: center; padding: 6px 12px;">
                                                            <i class="fas fa-trash me-2"></i>Hapus
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i> Belum ada data kelas
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <style>
        .swal2-popup {
            width: 350px !important;
            padding: 20px !important;
        }
        .swal2-title {
            font-size: 20px !important;
            margin-bottom: 10px !important;
        }
        .swal2-html-container {
            font-size: 14px !important;
            padding: 10px 0 !important;
        }
        .swal2-html-container p {
            margin: 5px 0 !important;
        }
        .swal2-actions {
            gap: 10px !important;
        }
        .swal2-confirm, .swal2-cancel {
            padding: 8px 20px !important;
            font-size: 14px !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-delete').forEach(btn => {
                btn.addEventListener('click', function() {
                    const kelasId = this.getAttribute('data-kelas-id');
                    const kodeKelas = this.getAttribute('data-kode-kelas');
                    deleteKelas(kelasId, kodeKelas);
                });
            });
        });

        function deleteKelas(kelasId, kodeKelas) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                html: `<p>Apakah Anda yakin ingin menghapus kelas <strong>${kodeKelas}</strong>?</p>
                       <p class="text-muted">Data yang sudah dihapus tidak dapat dipulihkan.</p>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Create form and submit
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/kelas/${kelasId}`;
                    
                    // Add CSRF token
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;
                    form.appendChild(csrfInput);
                    
                    // Add method override
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
                    form.appendChild(methodInput);
                    
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
@endsection