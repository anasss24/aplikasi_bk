<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2 class="mb-4">Buat Jadwal Konseling Baru</h2>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <form action="<?php echo e(route('jadwal.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <div class="mb-3">
                            <label for="siswa_id" class="form-label">Pilih Siswa</label>
                            <select name="siswa_id" id="siswa_id" class="form-control <?php $__errorArgs = ['siswa_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <option value="">-- Pilih Siswa --</option>
                                <?php $__currentLoopData = $siswaList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $siswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($siswa->id); ?>" <?php echo e(old('siswa_id') == $siswa->id ? 'selected' : ''); ?>>
                                        <?php echo e($siswa->nama_siswa); ?> (<?php echo e($siswa->nis); ?>)
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['siswa_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3">
                            <label for="guru_id" class="form-label">Pilih Guru BK</label>
                            <select name="guru_id" id="guru_id" class="form-control <?php $__errorArgs = ['guru_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <option value="">-- Pilih Guru BK --</option>
                                <?php $__currentLoopData = $guruList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guru): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($guru->guru_id); ?>" <?php echo e(old('guru_id') == $guru->guru_id ? 'selected' : ''); ?>>
                                        <?php echo e($guru->nama); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['guru_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3">
                            <label for="jadwal_datetime" class="form-label">Tanggal & Waktu</label>
                            <input type="datetime-local" name="jadwal_datetime" id="jadwal_datetime" 
                                   class="form-control <?php $__errorArgs = ['jadwal_datetime'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   value="<?php echo e(old('jadwal_datetime')); ?>" required>
                            <?php $__errorArgs = ['jadwal_datetime'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3">
                            <label for="metode" class="form-label">Metode Konseling</label>
                            <select name="metode" id="metode" class="form-control <?php $__errorArgs = ['metode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <option value="">-- Pilih Metode --</option>
                                <option value="online" <?php echo e(old('metode') == 'online' ? 'selected' : ''); ?>>Online</option>
                                <option value="offline" <?php echo e(old('metode') == 'offline' ? 'selected' : ''); ?>>Offline</option>
                            </select>
                            <?php $__errorArgs = ['metode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Tempat Konseling</label>
                            <select name="lokasi" id="lokasi" class="form-control <?php $__errorArgs = ['lokasi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="">-- Pilih Tempat Konseling --</option>
                                <option value="ruang_bk" <?php echo e(old('lokasi') == 'ruang_bk' ? 'selected' : ''); ?>>Ruang BK</option>
                                <option value="chat" <?php echo e(old('lokasi') == 'chat' ? 'selected' : ''); ?>>Chat</option>
                            </select>
                            <?php $__errorArgs = ['lokasi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3">
                            <label for="masalah" class="form-label">Masalah yang Sedang Dialami</label>
                            <select name="masalah" id="masalah" class="form-control <?php $__errorArgs = ['masalah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="">-- Pilih Masalah --</option>
                                <option value="masalah_akademik" <?php echo e(old('masalah') == 'masalah_akademik' ? 'selected' : ''); ?>>Masalah Akademik (Nilai, Kesulitan Belajar)</option>
                                <option value="masalah_keluarga" <?php echo e(old('masalah') == 'masalah_keluarga' ? 'selected' : ''); ?>>Masalah Keluarga</option>
                                <option value="masalah_sosial" <?php echo e(old('masalah') == 'masalah_sosial' ? 'selected' : ''); ?>>Masalah Sosial (Pertemanan, Bullying)</option>
                                <option value="masalah_emosional" <?php echo e(old('masalah') == 'masalah_emosional' ? 'selected' : ''); ?>>Masalah Emosional (Stres, Kecemasan, Depresi)</option>
                                <option value="masalah_karir" <?php echo e(old('masalah') == 'masalah_karir' ? 'selected' : ''); ?>>Masalah Karir & Masa Depan</option>
                                <option value="masalah_pribadi" <?php echo e(old('masalah') == 'masalah_pribadi' ? 'selected' : ''); ?>>Masalah Pribadi (Kepercayaan Diri, Identitas)</option>
                                <option value="masalah_kesehatan" <?php echo e(old('masalah') == 'masalah_kesehatan' ? 'selected' : ''); ?>>Masalah Kesehatan & Kebiasaan</option>
                                <option value="masalah_disiplin" <?php echo e(old('masalah') == 'masalah_disiplin' ? 'selected' : ''); ?>>Masalah Disiplin & Tata Tertib</option>
                                <option value="lainnya" <?php echo e(old('masalah') == 'lainnya' ? 'selected' : ''); ?>>Lainnya</option>
                            </select>
                            <?php $__errorArgs = ['masalah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Buat Jadwal
                            </button>
                            <a href="<?php echo e(route('jadwal.index')); ?>" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\PC_07\aplikasi_bk\resources\views/jadwal/create.blade.php ENDPATH**/ ?>