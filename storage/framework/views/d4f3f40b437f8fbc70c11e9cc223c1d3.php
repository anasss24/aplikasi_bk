<?php $__env->startSection('content'); ?>
  <div class="container-fluid">
    <div class="row mb-4">
      <div class="col-md-8">
        <h2 class="mb-0"><i class="fas fa-file-medical me-2"></i>Catat Sesi Konseling</h2>
        <p class="text-muted">Dokumentasikan hasil dan progres konseling dengan siswa</p>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8">
        <div class="card shadow-sm border-0">
          <div class="card-body p-4">
            <form action="<?php echo e(route('riwayat.store')); ?>" method="POST" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
              
              <?php if($jadwal_id): ?>
                <input type="hidden" name="jadwal_id" value="<?php echo e($jadwal_id); ?>">
              <?php endif; ?>

              
              <div class="mb-4">
                <h5 class="card-title mb-3"><i class="fas fa-user me-2"></i>Informasi Siswa & Waktu</h5>
                
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Siswa <span class="text-danger">*</span></label>
                    <select name="siswa_id" class="form-select <?php $__errorArgs = ['siswa_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required <?php if($selectedJadwal): ?> disabled <?php endif; ?>>
                      <option value="">-- Pilih Siswa --</option>
                      <?php $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($s->id); ?>" <?php echo e(old('siswa_id', $selectedJadwal->siswa_id ?? '') == $s->id ? 'selected' : ''); ?>>
                          <?php echo e($s->nama_siswa); ?> (<?php echo e($s->nis); ?>)
                        </option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($selectedJadwal): ?>
                      <input type="hidden" name="siswa_id" value="<?php echo e($selectedJadwal->siswa_id); ?>">
                    <?php endif; ?>
                    <?php $__errorArgs = ['siswa_id'];
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

                  <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Konseling <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_riwayat" class="form-control <?php $__errorArgs = ['tanggal_riwayat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                      value="<?php echo e(old('tanggal_riwayat', $selectedJadwal?->jadwal_datetime?->format('Y-m-d') ?? date('Y-m-d'))); ?>" required>
                    <?php $__errorArgs = ['tanggal_riwayat'];
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
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Waktu Mulai <span class="text-danger">*</span></label>
                    <input type="time" name="waktu_mulai" class="form-control <?php $__errorArgs = ['waktu_mulai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                      value="<?php echo e(old('waktu_mulai', $selectedJadwal?->jadwal_datetime?->format('H:i') ?? '')); ?>" required <?php if($selectedJadwal): ?> disabled <?php endif; ?>>
                    <?php if($selectedJadwal): ?>
                      <input type="hidden" name="waktu_mulai" value="<?php echo e($selectedJadwal->jadwal_datetime->format('H:i')); ?>">
                    <?php endif; ?>
                    <?php $__errorArgs = ['waktu_mulai'];
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

                  <div class="col-md-6 mb-3">
                    <label class="form-label">Durasi Konseling (menit) <span class="text-danger">*</span></label>
                    <input type="number" name="durasi" class="form-control <?php $__errorArgs = ['durasi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                      value="<?php echo e(old('durasi')); ?>" min="5" max="180" required>
                    <small class="text-muted">Contoh: 30, 45, 60</small>
                    <?php $__errorArgs = ['durasi'];
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
                </div>
              </div>

              <hr>

              
              <div class="mb-4">
                <h5 class="card-title mb-3"><i class="fas fa-comment-dots me-2"></i>Topik & Metode Konseling</h5>

                <div class="mb-3">
                  <label class="form-label">Topik/Masalah yang Dibahas <span class="text-danger">*</span></label>
                  <?php
                    $masalahToTopikMap = [
                      'masalah_akademik' => 'Akademik',
                      'masalah_keluarga' => 'Keluarga',
                      'masalah_sosial' => 'Sosial',
                      'masalah_emosional' => 'Pribadi',
                      'masalah_karir' => 'Karir',
                      'masalah_pribadi' => 'Pribadi',
                      'masalah_kesehatan' => 'Pribadi',
                      'masalah_disiplin' => 'Perilaku',
                      'lainnya' => 'Lainnya',
                    ];
                    $autoSelectedTopik = $selectedJadwal ? ($masalahToTopikMap[$selectedJadwal->masalah] ?? '') : old('topik');
                  ?>
                  <select name="topik" class="form-select <?php $__errorArgs = ['topik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required <?php if($selectedJadwal): ?> disabled <?php endif; ?>>
                    <option value="">-- Pilih Topik --</option>
                    <option value="Akademik" <?php echo e($autoSelectedTopik == 'Akademik' ? 'selected' : ''); ?>>Akademik</option>
                    <option value="Pribadi" <?php echo e($autoSelectedTopik == 'Pribadi' ? 'selected' : ''); ?>>Pribadi</option>
                    <option value="Sosial" <?php echo e($autoSelectedTopik == 'Sosial' ? 'selected' : ''); ?>>Sosial</option>
                    <option value="Perilaku" <?php echo e($autoSelectedTopik == 'Perilaku' ? 'selected' : ''); ?>>Perilaku</option>
                    <option value="Karir" <?php echo e($autoSelectedTopik == 'Karir' ? 'selected' : ''); ?>>Karir</option>
                    <option value="Bullying/Kekerasan" <?php echo e($autoSelectedTopik == 'Bullying/Kekerasan' ? 'selected' : ''); ?>>Bullying/Kekerasan</option>
                    <option value="Keluarga" <?php echo e($autoSelectedTopik == 'Keluarga' ? 'selected' : ''); ?>>Keluarga</option>
                    <option value="Lainnya" <?php echo e($autoSelectedTopik == 'Lainnya' ? 'selected' : ''); ?>>Lainnya</option>
                  </select>
                  <?php if($selectedJadwal): ?>
                    <input type="hidden" name="topik" value="<?php echo e($autoSelectedTopik); ?>">
                  <?php endif; ?>
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

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Metode Konseling <span class="text-danger">*</span></label>
                    <select name="metode" class="form-select <?php $__errorArgs = ['metode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required <?php if($isFromChat): ?> disabled <?php endif; ?>>
                      <option value="">-- Pilih Metode --</option>
                      <option value="tatap_muka" <?php echo e(old('metode', 'tatap_muka') == 'tatap_muka' ? 'selected' : ''); ?>>Tatap Muka</option>
                      <option value="online" <?php echo e(old('metode', $isFromChat ? 'online' : '') == 'online' ? 'selected' : ''); ?>>Online</option>
                    </select>
                    <?php if($isFromChat): ?>
                      <input type="hidden" name="metode" value="online">
                    <?php endif; ?>
                    <?php $__errorArgs = ['metode'];
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

                  <div class="col-md-6 mb-3">
                    <label class="form-label">Lokasi Konseling</label>
                    <select name="lokasi" class="form-select" <?php if($isFromChat): ?> disabled <?php endif; ?>>
                      <option value="">-- Pilih Lokasi --</option>
                      <option value="ruang_bk" <?php echo e(old('lokasi') == 'ruang_bk' ? 'selected' : ''); ?>>Ruang BK</option>
                      <option value="chat" <?php echo e(old('lokasi', $isFromChat ? 'chat' : '') == 'chat' ? 'selected' : ''); ?>>Chat</option>
                    </select>
                    <?php if($isFromChat): ?>
                      <input type="hidden" name="lokasi" value="chat">
                    <?php endif; ?>
                  </div>
                </div>
              </div>

              <hr>

              
              <div class="mb-4">
                <h5 class="card-title mb-3"><i class="fas fa-clipboard-list me-2"></i>Hasil & Pembahasan</h5>

                <div class="mb-3">
                  <label class="form-label">Hasil Konseling/Pembahasan <span class="text-danger">*</span></label>
                  <textarea name="isi_konseling" class="form-control <?php $__errorArgs = ['isi_konseling'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                    rows="5" required placeholder="Jelaskan hasil konseling, apa yang dibahas, dan kondisi emosional siswa..."><?php echo e(old('isi_konseling')); ?></textarea>
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
                  <label class="form-label">Perkembangan/Progres Siswa</label>
                  <textarea name="progres" class="form-control" rows="3" 
                    placeholder="Catatan tentang perkembangan atau perubahan perilaku siswa..."><?php echo e(old('progres')); ?></textarea>
                </div>
              </div>

              <hr>

              
              <div class="mb-4">
                <h5 class="card-title mb-3"><i class="fas fa-tasks me-2"></i>Rencana Tindak Lanjut</h5>

                <div class="mb-3">
                  <label class="form-label">Rekomendasi/Rencana Tindak Lanjut</label>
                  <textarea name="tindak_lanjut" class="form-control" rows="3" 
                    placeholder="Apa yang perlu dilakukan selanjutnya? Apakah ada konseling lanjutan, rujukan, atau tindakan lainnya?"><?php echo e(old('tindak_lanjut')); ?></textarea>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Status Tindak Lanjut</label>
                    <select name="status_tindak_lanjut" class="form-select">
                      <option value="">-- Pilih Status --</option>
                      <option value="selesai" <?php echo e(old('status_tindak_lanjut') == 'selesai' ? 'selected' : ''); ?>>Selesai</option>
                      <option value="perlu_follow_up" <?php echo e(old('status_tindak_lanjut') == 'perlu_follow_up' ? 'selected' : ''); ?>>Perlu Follow-up</option>
                    </select>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="form-label">Jadwalkan Follow-up (Opsional)</label>
                    <input type="date" name="tanggal_follow_up" class="form-control" value="<?php echo e(old('tanggal_follow_up')); ?>">
                  </div>
                </div>
              </div>

              
              <div class="form-group d-flex gap-2 mt-4">
                <a href="<?php echo e(route('riwayat.index')); ?>" class="btn btn-secondary" style="padding: 10px 28px; font-weight: 600;">
                  <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
                <button type="submit" class="btn btn-primary" style="padding: 10px 28px; font-weight: 600;">
                  <i class="fas fa-save me-2"></i>Simpan Riwayat Konseling
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\PC_07\aplikasi_bk\resources\views/riwayat/create.blade.php ENDPATH**/ ?>