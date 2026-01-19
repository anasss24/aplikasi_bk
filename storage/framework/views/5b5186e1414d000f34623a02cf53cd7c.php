

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>Jadwal Konseling</h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="<?php echo e(route('jadwal.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Jadwal Baru
            </a>
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
                            <td><?php echo e($jadwal->siswa->nama ?? '-'); ?></td>
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
                                <?php elseif($jadwal->status === 'batal'): ?>
                                    <span class="badge bg-danger">Batal</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo e(route('jadwal.show', $jadwal->id)); ?>" class="btn btn-sm btn-info" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <?php if(auth()->user()->hasRole('guru') && $jadwal->status === 'diajukan'): ?>
                                    <form action="<?php echo e(route('jadwal.approve', $jadwal->id)); ?>" method="POST" style="display:inline;">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-sm btn-success" title="Setujui">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                <?php endif; ?>
                                <?php if(auth()->user()->hasRole('siswa') && $jadwal->status === 'diajukan'): ?>
                                    <form action="<?php echo e(route('jadwal.cancel', $jadwal->id)); ?>" method="POST" style="display:inline;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-danger" title="Batal">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\aplikasi_bk\resources\views/jadwal/index.blade.php ENDPATH**/ ?>