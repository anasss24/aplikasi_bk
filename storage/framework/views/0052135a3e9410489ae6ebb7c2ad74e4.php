<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h2 fw-bold text-dark mb-0">Kuisioner</h1>
                    <p class="text-muted mb-0">Survei kepuasan dan evaluasi layanan</p>
                </div>
                <a href="<?php echo e(route('kuisioner.create')); ?>" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Isi Kuisioner Baru
                </a>
            </div>
        </div>
    </div>

    <?php if($kuisioners->count() > 0): ?>
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Total Skor</th>
                                    <th>Komentar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $kuisioners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kuisioner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($kuisioner->tanggal ? \Carbon\Carbon::parse($kuisioner->tanggal)->format('d M Y') : '-'); ?></td>
                                        <td>
                                            <span class="badge bg-info"><?php echo e($kuisioner->skor_total ?? '-'); ?></span>
                                        </td>
                                        <td><?php echo e($kuisioner->komentar ? Str::limit($kuisioner->komentar, 50) : '-'); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('kuisioner.show', $kuisioner->id ?? $kuisioner->kuisioner_id)); ?>" class="btn btn-sm btn-icon-view" title="Lihat Detail" style="width: 40px; height: 40px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; background: linear-gradient(135deg, #0099C9, #0077B6); border: none; color: white; transition: all 0.3s ease;">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <?php echo e($kuisioners->links()); ?>

            </div>
        </div>
    <?php else: ?>
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <i class="fas fa-survey fa-3x text-muted mb-3 opacity-25"></i>
                <p class="text-muted">Belum ada kuisioner</p>
                <a href="<?php echo e(route('kuisioner.create')); ?>" class="btn btn-primary">
                    Isi Kuisioner Sekarang
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>

<style>
    .btn-icon-view:hover {
        transform: scale(1.1) !important;
        box-shadow: 0 6px 16px rgba(0, 153, 201, 0.4) !important;
    }
</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\PC_07\aplikasi_bk\resources\views/kuisioner/index.blade.php ENDPATH**/ ?>