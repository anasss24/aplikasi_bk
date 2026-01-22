<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>Jadwal Konseling</h2>
            <?php if(auth()->user()->role === 'guru_bk'): ?>
                <p class="text-muted small mb-0">Kelola permohonan jadwal konseling dari siswa</p>
            <?php endif; ?>
        </div>
        <div class="col-md-4 text-end">
            <?php if(auth()->user()->role !== 'guru_bk'): ?>
                <a href="<?php echo e(route('jadwal.create')); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Jadwal Baru
                </a>
            <?php endif; ?>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal & Waktu</th>
                        <th>Siswa</th>
                        <th>Guru BK</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $jadwals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jadwal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <?php echo e($jadwal->jadwal_datetime ? \Carbon\Carbon::parse($jadwal->jadwal_datetime)->format('d/m/Y H:i') : '-'); ?>

                            </td>
                            <td><?php echo e($jadwal->siswa->nama_siswa ?? '-'); ?></td>
                            <td><?php echo e($jadwal->guru->nama ?? '-'); ?></td>
                            <td>
                                <span class="badge bg-<?php echo e($jadwal->metode === 'online' ? 'info' : 'secondary'); ?>">
                                    <?php echo e(ucfirst($jadwal->metode)); ?>

                                </span>
                            </td>
                            <td>
                                <?php if($jadwal->status === 'diajukan'): ?>
                                    <span class="badge bg-warning">Diajukan</span>
                                <?php elseif($jadwal->status === 'disetujui'): ?>
                                    <span class="badge bg-success">Disetujui</span>
                                <?php elseif($jadwal->status === 'ditolak'): ?>
                                    <span class="badge bg-danger">Ditolak</span>
                                <?php elseif($jadwal->status === 'batal'): ?>
                                    <span class="badge bg-danger">Batal</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                
                                <?php if(auth()->user()->role === 'guru_bk' && $jadwal->status === 'diajukan'): ?>
                                    <form action="<?php echo e(route('jadwal.approve', $jadwal->jadwal_id)); ?>" method="POST" style="display:inline;">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-sm btn-success" title="Setuju">
                                            <i class="fas fa-check"></i> Setuju
                                        </button>
                                    </form>
                                    <form action="<?php echo e(route('jadwal.reject', $jadwal->jadwal_id)); ?>" method="POST" style="display:inline;">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-sm btn-danger" title="Tolak" onclick="return confirm('Tolak jadwal konseling ini?')">
                                            <i class="fas fa-times"></i> Tolak
                                        </button>
                                    </form>
                                <?php endif; ?>
                                
                                <?php if(auth()->user()->role === 'siswa' && $jadwal->status === 'diajukan'): ?>
                                    <form id="cancelForm<?php echo e($jadwal->jadwal_id); ?>" action="<?php echo e(route('jadwal.cancel', $jadwal->jadwal_id)); ?>" method="POST" style="display:inline;">
                                        <?php echo csrf_field(); ?>
                                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmCancel(<?php echo e($jadwal->jadwal_id); ?>)">
                                            <i class="fas fa-trash"></i> Batalkan
                                        </button>
                                    </form>
                                <?php endif; ?>
                                
                                <?php
                                    $statusCheck = strtolower(trim($jadwal->status ?? ''));
                                    if($statusCheck === 'disetujui') {
                                        if(auth()->user()->role === 'siswa') {
                                            $chatTargetUserId = $jadwal->guru?->user_id;
                                        } else {
                                            $chatTargetUserId = $jadwal->siswa?->user_id;
                                        }
                                    } else {
                                        $chatTargetUserId = null;
                                    }
                                ?>
                                <?php if($chatTargetUserId): ?>
                                    <a href="<?php echo e(route('chat.show', $chatTargetUserId)); ?>" class="btn btn-sm btn-primary" title="Mulai Chat">
                                        <i class="fas fa-comments"></i> Chat
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="fas fa-inbox"></i> Tidak ada jadwal
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <?php echo e($jadwals->links()); ?>

        </div>
    </div>
</div>

<script>
    function confirmCancel(jadwalId) {
        Swal.fire({
            title: 'Batalkan Jadwal?',
            text: 'Anda akan membatalkan jadwal konseling ini. Tindakan ini tidak dapat dibatalkan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Batalkan',
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
                document.getElementById('cancelForm' + jadwalId).submit();
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\PC_07\aplikasi_bk\resources\views/jadwal/index.blade.php ENDPATH**/ ?>