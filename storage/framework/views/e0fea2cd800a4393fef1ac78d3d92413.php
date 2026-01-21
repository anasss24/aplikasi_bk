

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="mb-0">Edit Riwayat Konseling</h2>
            <p class="text-muted">Perbarui catatan konseling</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo e(route('riwayat.update', $riwayat)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="mb-3">
                            <label class="form-label">Jadwal Konseling <span class="text-danger">*</span></label>
                            <select name="jadwal_id" class="form-select <?php $__errorArgs = ['jadwal_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <option value="">Pilih Jadwal Konseling...</option>
                                <?php $__currentLoopData = $jadwals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($j->jadwal_id); ?>" <?php echo e(old('jadwal_id', $riwayat->jadwal_id) == $j->jadwal_id ? 'selected' : ''); ?>>
                                        <?php echo e($j->siswa->nama_siswa ?? 'N/A'); ?> - <?php echo e($j->jadwal_datetime->format('d M Y H:i')); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['jadwal_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Topik Konseling <span class="text-danger">*</span></label>
                            <input type="text" name="topik" class="form-control <?php $__errorArgs = ['topik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                value="<?php echo e(old('topik', $riwayat->topik)); ?>" required>
                            <?php $__errorArgs = ['topik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Isi Konseling <span class="text-danger">*</span></label>
                            <textarea name="isi_konseling" class="form-control <?php $__errorArgs = ['isi_konseling'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                rows="5" required><?php echo e(old('isi_konseling', $riwayat->isi_konseling)); ?></textarea>
                            <?php $__errorArgs = ['isi_konseling'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tindak Lanjut</label>
                            <textarea name="tindak_lanjut" class="form-control" rows="3"><?php echo e(old('tindak_lanjut', $riwayat->tindak_lanjut)); ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status Tindak Lanjut</label>
                                <select name="status_tindak_lanjut" class="form-select">
                                    <option value="">Pilih Status...</option>
                                    <option value="belum_dilaksanakan" <?php echo e(old('status_tindak_lanjut', $riwayat->status_tindak_lanjut) == 'belum_dilaksanakan' ? 'selected' : ''); ?>>Belum Dilaksanakan</option>
                                    <option value="sedang_berjalan" <?php echo e(old('status_tindak_lanjut', $riwayat->status_tindak_lanjut) == 'sedang_berjalan' ? 'selected' : ''); ?>>Sedang Berjalan</option>
                                    <option value="selesai" <?php echo e(old('status_tindak_lanjut', $riwayat->status_tindak_lanjut) == 'selesai' ? 'selected' : ''); ?>>Selesai</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Konseling</label>
                                <input type="date" name="tanggal_riwayat" class="form-control" value="<?php echo e(old('tanggal_riwayat', $riwayat->tanggal_riwayat)); ?>">
                            </div>
                        </div>

                        <div class="form-group d-flex gap-2">
                            <a href="<?php echo e(route('riwayat.show', $riwayat)); ?>" class="btn btn-danger" style="padding: 8px 24px; font-weight: 500; min-width: 100px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary" style="padding: 8px 24px; font-weight: 500; min-width: 160px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\aplikasi_bk\resources\views/riwayat/edit.blade.php ENDPATH**/ ?>