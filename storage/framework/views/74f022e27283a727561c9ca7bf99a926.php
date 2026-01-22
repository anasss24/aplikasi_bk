<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="mb-0">Manajemen Siswa</h2>
            <p class="text-muted">Kelola data siswa di sekolah</p>
        </div>
        <div class="col-md-4 text-end">
            <?php if((Auth::user()->role ?? null) === 'admin' || (Auth::user()->role ?? null) === 'guru_bk'): ?>
            <a href="<?php echo e(route('siswa.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Siswa
            </a>
            <?php endif; ?>
        </div>
    </div>

    <?php if($message = Session::get('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo e($message); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <!-- Table -->
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Jenis Kelamin</th>
                        <th>No. Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><strong><?php echo e($s->nis); ?></strong></td>
                        <td><?php echo e($s->nama_siswa); ?></td>
                        <td><?php echo e($s->kelas->nama_kelas ?? '-'); ?></td>
                        <td><?php echo e($s->jenis_kelamin); ?></td>
                        <td><?php echo e($s->no_telepon ?? '-'); ?></td>
                        <td>
                            <div class="btn-group" role="group" style="gap: 5px;">
                                <a href="<?php echo e(route('siswa.show', $s)); ?>" class="btn btn-outline-info" title="Lihat" style="min-width: 50px; height: 38px; display: flex; align-items: center; justify-content: center; padding: 6px 12px;">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <?php if((Auth::user()->role ?? null) === 'admin' || (Auth::user()->role ?? null) === 'guru_bk'): ?>
                                <a href="<?php echo e(route('siswa.edit', $s)); ?>" class="btn btn-primary" title="Edit" style="min-width: 80px; height: 38px; display: flex; align-items: center; justify-content: center; padding: 6px 12px;">
                                    <i class="fas fa-edit me-2"></i>Edit
                                </a>
                                <form action="<?php echo e(route('siswa.destroy', $s)); ?>" method="POST" style="display:inline;" class="delete-form">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger" title="Hapus" style="min-width: 80px; height: 38px; display: flex; align-items: center; justify-content: center; padding: 6px 12px;">
                                        <i class="fas fa-trash me-2"></i>Hapus
                                    </button>
                                </form>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            Tidak ada data siswa
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer border-top">
            <?php echo e($siswa->links('pagination::bootstrap-4')); ?>

        </div>
    </div>
</div>

<style>
    .table-hover tbody tr:hover {
        background-color: #f5f5f5;
    }
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\PC_07\aplikasi_bk\resources\views/siswa/index.blade.php ENDPATH**/ ?>