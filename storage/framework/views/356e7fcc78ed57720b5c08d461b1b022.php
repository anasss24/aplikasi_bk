

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Detail Jadwal Konseling</h2>
                <a href="<?php echo e(route('jadwal.index')); ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-muted">Siswa</h6>
                            <p class="mb-3"><?php echo e($jadwal->siswa->nama_siswa ?? '-'); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Guru BK</h6>
                            <p class="mb-3"><?php echo e($jadwal->guru->nama ?? '-'); ?></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-muted">Tanggal & Waktu</h6>
                            <p class="mb-3">
                                <?php echo e($jadwal->jadwal_datetime ? \Carbon\Carbon::parse($jadwal->jadwal_datetime)->format('d/m/Y H:i') : '-'); ?>

                            </p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Metode</h6>
                            <p class="mb-3">
                                <span class="badge bg-<?php echo e($jadwal->metode === 'online' ? 'info' : 'secondary'); ?>">
                                    <?php echo e(ucfirst($jadwal->metode)); ?>

                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-muted">Lokasi</h6>
                            <p class="mb-3"><?php echo e($jadwal->lokasi ?? '-'); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Status</h6>
                            <p class="mb-3">
                                <?php if($jadwal->status === 'diajukan'): ?>
                                    <span class="badge bg-warning">Diajukan</span>
                                <?php elseif($jadwal->status === 'disetujui'): ?>
                                    <span class="badge bg-success">Disetujui</span>
                                <?php elseif($jadwal->status === 'batal'): ?>
                                    <span class="badge bg-danger">Batal</span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-muted">Masalah yang Dialami</h6>
                            <p class="mb-3">
                                <?php
                                    $masalahList = [
                                        'masalah_akademik' => 'Masalah Akademik (Nilai, Kesulitan Belajar)',
                                        'masalah_keluarga' => 'Masalah Keluarga',
                                        'masalah_sosial' => 'Masalah Sosial (Pertemanan, Bullying)',
                                        'masalah_emosional' => 'Masalah Emosional (Stres, Kecemasan, Depresi)',
                                        'masalah_karir' => 'Masalah Karir & Masa Depan',
                                        'masalah_pribadi' => 'Masalah Pribadi (Kepercayaan Diri, Identitas)',
                                        'masalah_kesehatan' => 'Masalah Kesehatan & Kebiasaan',
                                        'masalah_disiplin' => 'Masalah Disiplin & Tata Tertib',
                                        'lainnya' => 'Lainnya'
                                    ];
                                ?>
                                <?php echo e($masalahList[$jadwal->masalah] ?? ($jadwal->masalah ? $jadwal->masalah : '-')); ?>

                            </p>
                        </div>
                    </div>

                    <?php if($jadwal->approved_by): ?>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Disetujui Oleh</h6>
                                <p class="mb-3"><?php echo e($jadwal->approvedBy->name ?? '-'); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="d-flex gap-2 mt-4">
                        <?php if($jadwal->status !== 'batal' && auth()->user()->hasRole('siswa')): ?>
                            <a href="<?php echo e(route('jadwal.edit', $jadwal->jadwal_id)); ?>" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form id="deleteForm" action="<?php echo e(route('jadwal.destroy', $jadwal->jadwal_id)); ?>" method="POST" style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        <?php endif; ?>
                        <?php if($jadwal->status === 'diajukan' && auth()->user()->hasRole('guru_bk')): ?>
                            <form action="<?php echo e(route('jadwal.approve', $jadwal->jadwal_id)); ?>" method="POST" style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <button type="button" class="btn btn-success" onclick="confirmApprove()">
                                    <i class="fas fa-check"></i> Setujui
                                </button>
                            </form>
                        <?php endif; ?>
                        <?php if($jadwal->status === 'disetujui' && auth()->user()->hasRole('guru_bk')): ?>
                            <form id="selesaiForm" action="<?php echo e(route('jadwal.selesai', $jadwal->jadwal_id)); ?>" method="POST" style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <button type="button" class="btn btn-info" onclick="confirmSelesai()">
                                    <i class="fas fa-flag-checkered"></i> Selesai
                                </button>
                            </form>
                        <?php endif; ?>
                        <?php
                            $statusCheck = strtolower(trim($jadwal->status ?? ''));
                        ?>
                        <?php if($statusCheck === 'disetujui'): ?>
                            <?php
                                $targetUserId = null;
                                if(auth()->user()->hasRole('siswa')) {
                                    // Siswa chat dengan Guru BK
                                    $targetUserId = $jadwal->guru?->user_id;
                                } else {
                                    // Guru BK chat dengan Siswa
                                    $targetUserId = $jadwal->siswa?->user_id;
                                }
                            ?>
                            <?php if($targetUserId): ?>
                                <a href="<?php echo e(route('chat.show', $targetUserId)); ?>" class="btn btn-primary">
                                    <i class="fas fa-comments"></i> Mulai Chat
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete() {
        Swal.fire({
            title: 'Hapus Jadwal?',
            text: 'Jadwal konseling ini akan dihapus secara permanen. Pastikan Anda yakin dengan tindakan ini.',
            icon: 'error',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                popup: 'custom-swal-popup',
                confirmButton: 'custom-swal-btn-confirm',
                cancelButton: 'custom-swal-btn-cancel',
                title: 'custom-swal-title',
                htmlContainer: 'custom-swal-text'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm').submit();
            }
        });
    }

    function confirmApprove() {
        Swal.fire({
            title: 'Setujui Jadwal?',
            text: 'Anda akan menyetujui jadwal konseling ini. Pastikan semua data sudah benar.',
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Setujui',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                popup: 'custom-swal-popup',
                confirmButton: 'custom-swal-btn-approve',
                cancelButton: 'custom-swal-btn-cancel',
                title: 'custom-swal-title',
                htmlContainer: 'custom-swal-text'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.form.submit();
            }
        });
    }

    function confirmSelesai() {
        Swal.fire({
            title: 'Tandai Konseling Selesai?',
            text: 'Konseling ini akan ditandai selesai dan otomatis ditambahkan ke riwayat konseling.',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#0dcaf0',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Tandai Selesai',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                popup: 'custom-swal-popup',
                confirmButton: 'custom-swal-btn-info',
                cancelButton: 'custom-swal-btn-cancel',
                title: 'custom-swal-title',
                htmlContainer: 'custom-swal-text'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('selesaiForm').submit();
            }
        });
    }
</script>

<style>
    .custom-swal-popup {
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15) !important;
        padding: 30px !important;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%) !important;
    }

    .custom-swal-title {
        font-size: 22px !important;
        font-weight: 700 !important;
        color: #1a1a1a !important;
        margin-bottom: 12px !important;
    }

    .custom-swal-text {
        font-size: 15px !important;
        color: #666666 !important;
        line-height: 1.6 !important;
    }

    .custom-swal-btn-confirm {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%) !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 12px 28px !important;
        font-weight: 600 !important;
        font-size: 15px !important;
        transition: all 0.3s ease !important;
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3) !important;
    }

    .custom-swal-btn-confirm:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 16px rgba(220, 53, 69, 0.4) !important;
    }

    .custom-swal-btn-approve {
        background: linear-gradient(135deg, #198754 0%, #157347 100%) !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 12px 28px !important;
        font-weight: 600 !important;
        font-size: 15px !important;
        transition: all 0.3s ease !important;
        box-shadow: 0 4px 12px rgba(25, 135, 84, 0.3) !important;
    }

    .custom-swal-btn-approve:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 16px rgba(25, 135, 84, 0.4) !important;
    }

    .custom-swal-btn-info {
        background: linear-gradient(135deg, #0dcaf0 0%, #0bb5e0 100%) !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 12px 28px !important;
        font-weight: 600 !important;
        font-size: 15px !important;
        transition: all 0.3s ease !important;
        box-shadow: 0 4px 12px rgba(13, 202, 240, 0.3) !important;
    }

    .custom-swal-btn-info:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 16px rgba(13, 202, 240, 0.4) !important;
    }

    .custom-swal-btn-cancel {
        background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%) !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 12px 28px !important;
        font-weight: 600 !important;
        font-size: 15px !important;
        color: #495057 !important;
        transition: all 0.3s ease !important;
    }

    .custom-swal-btn-cancel:hover {
        transform: translateY(-2px) !important;
        background: linear-gradient(135deg, #dee2e6 0%, #ced4da 100%) !important;
    }

    .swal2-icon {
        width: 60px !important;
        height: 60px !important;
        margin-bottom: 15px !important;
    }
</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\aplikasi_bk\resources\views/jadwal/show.blade.php ENDPATH**/ ?>