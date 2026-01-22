<?php $__env->startSection('content'); ?>
  <div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
      <div class="col-md-8">
        <h2 class="mb-0">Materi BK</h2>
        <p class="text-muted">Koleksi materi bimbingan dan konseling</p>
      </div>
      <div class="col-md-4 text-end">
        <?php if((Auth::user()->role ?? null) === 'guru_bk' || (Auth::user()->role ?? null) === 'admin'): ?>
          <a href="<?php echo e(route('materi.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Unggah Materi
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

    <!-- Stats -->
    <div class="row mb-4">
      <div class="col-md-4">
        <div class="card stat-card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <p class="text-muted small mb-1">Total Materi</p>
                <h4 class="mb-0"><?php echo e($materi->total()); ?></h4>
              </div>
              <i class="fas fa-book text-primary" style="font-size: 2rem; opacity: 0.5;"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Grid View -->
    <div class="row">
      <?php $__empty_1 = true; $__currentLoopData = $materi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="card h-100 shadow-sm">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start mb-2">
                <h6 class="card-title"><?php echo e($m->judul); ?></h6>
                <span class="badge bg-info"><?php echo e(ucfirst($m->kategori)); ?></span>
              </div>

              <p class="card-text text-muted small"><?php echo e(Str::limit($m->deskripsi, 100)); ?></p>

              <div class="mb-3">
                <small class="text-muted">
                  <i class="fas fa-user"></i> <?php echo e($m->guru->nama ?? 'Guru BK'); ?>

                </small>
                <br>
                <small class="text-muted">
                  <i class="fas fa-calendar"></i> <?php echo e($m->tanggal_upload->format('d M Y')); ?>

                </small>
              </div>

              <div class="mb-3">
                <span class="badge bg-secondary">
                  <i class="fas fa-eye"></i> <?php echo e($m->views ?? 0); ?> views
                </span>
              </div>

              <div class="btn-group w-100" role="group" style="gap: 5px;">
                <a href="<?php echo e(route('materi.show', $m)); ?>" class="btn btn-outline-primary" style="flex: 1; display: flex; align-items: center; justify-content: center; padding: 6px 12px; height: 38px;" title="Lihat">
                  <i class="fas fa-eye"></i>
                </a>
                <?php
                  $currentUserGuruId = null;
                  if ((Auth::user()->role ?? null) === 'guru_bk') {
                    $guru = \App\Models\GuruBK::where('user_id', Auth::id())->first();
                    $currentUserGuruId = $guru?->guru_id;
                  }
                  $canEdit = ((Auth::user()->role ?? null) === 'guru_bk' && $currentUserGuruId === $m->guru_id) || (Auth::user()->role ?? null) === 'admin';
                ?>
                <?php if($canEdit): ?>
                  <a href="<?php echo e(route('materi.edit', $m)); ?>" class="btn btn-primary" style="flex: 0 0 80px; display: flex; align-items: center; justify-content: center; padding: 6px 12px; height: 38px;">
                    <i class="fas fa-edit me-2"></i> Edit
                  </a>
                  <form action="<?php echo e(route('materi.destroy', $m)); ?>" method="POST" style="display:inline; width: 80px;" class="delete-form">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger w-100" style="display: flex; align-items: center; justify-content: center; padding: 6px 12px; height: 38px;" data-delete-message="Yakin ingin menghapus materi <strong><?php echo e($m->judul); ?></strong>?">
                      <i class="fas fa-trash me-2"></i>Hapus
                    </button>
                  </form>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <?php endif; ?>
    </div>

    <!-- Pagination -->
    <div class="row mt-4">
      <div class="col-12">
        <?php echo e($materi->links('pagination::bootstrap-4')); ?>

      </div>
    </div>
  </div>

  <style>
    .stat-card {
      border-left: 4px solid #667eea;
    }

    .card {
      transition: none;
    }

    .card:hover {
      transform: none;
      box-shadow: none !important;
    }

    .btn {
      background-color: #0066cc !important;
      color: white !important;
      border: none !important;
    }

    .btn:hover, .btn:focus, .btn:active, .btn.active {
      background-color: #0066cc !important;
      color: white !important;
      border: none !important;
      box-shadow: none !important;
      outline: none !important;
    }
  </style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\PC_07\aplikasi_bk\resources\views/materi/index.blade.php ENDPATH**/ ?>