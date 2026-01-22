<?php $__env->startSection('content'); ?>
  <div class="container-fluid">
    <div class="row mb-4">
      <div class="col-md-8">
        <h2 class="mb-0"><?php echo e($materi->judul); ?></h2>
        <p class="text-muted">Materi BK</p>
      </div>
      <div class="col-md-4 text-end">
        <?php if(((Auth::user()->role ?? null) === 'guru_bk' && (Auth::user()->guru_id ?? null) === $materi->guru_id) || (Auth::user()->role ?? null) === 'admin'): ?>
          <a href="<?php echo e(route('materi.edit', $materi)); ?>" class="btn btn-warning">
            <i class="fas fa-edit"></i> Edit
          </a>
          <form action="<?php echo e(route('materi.destroy', $materi)); ?>" method="POST" style="display:inline;" class="delete-form">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit" class="btn btn-danger" data-delete-message="Yakin ingin menghapus materi <strong><?php echo e($materi->judul); ?></strong>? Data ini akan dihapus secara permanen.">
              <i class="fas fa-trash"></i> Hapus
            </button>
          </form>
        <?php endif; ?>
        <a href="<?php echo e(route('materi.index')); ?>" class="btn btn-secondary">
          <i class="fas fa-arrow-left"></i> Kembali
        </a>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8">
        <!-- Konten Utama -->
        <div class="card mb-3">
          <div class="card-body">
            <div class="mb-4">
              <span class="badge bg-info mb-3"><?php echo e(ucfirst($materi->kategori)); ?></span>
              <h3><?php echo e($materi->judul); ?></h3>
            </div>

            <div class="mb-4 pb-4 border-bottom">
              <small class="text-muted">
                <i class="fas fa-user"></i> <strong><?php echo e($materi->guru->nama ?? 'Guru BK'); ?></strong>
              </small>
              <br>
              <small class="text-muted">
                <i class="fas fa-calendar"></i> <?php echo e($materi->tanggal_upload->format('d F Y')); ?>

              </small>
              <br>
              <small class="text-muted">
                <i class="fas fa-eye"></i> <?php echo e($materi->views ?? 0); ?> views
              </small>
            </div>

            <h5>Deskripsi</h5>
            <p style="white-space: pre-wrap;"><?php echo e($materi->deskripsi); ?></p>


          </div>
        </div>
      </div>

      <!-- Sidebar -->
      <div class="col-lg-4">
        <div class="card mb-3">
          <div class="card-header bg-primary text-white">
            <h6 class="mb-0">Informasi</h6>
          </div>
          <div class="list-group list-group-flush">
            <div class="list-group-item">
              <small class="text-muted d-block">Dibuat Oleh</small>
              <strong><?php echo e($materi->guru->nama ?? 'Guru BK'); ?></strong>
            </div>
            <div class="list-group-item">
              <small class="text-muted d-block">Tanggal Upload</small>
              <strong><?php echo e($materi->tanggal_upload->format('d F Y')); ?></strong>
            </div>
            <div class="list-group-item">
              <small class="text-muted d-block">Kategori</small>
              <strong><?php echo e(ucfirst($materi->kategori)); ?></strong>
            </div>
            <div class="list-group-item">
              <small class="text-muted d-block">Jumlah Dilihat</small>
              <strong><?php echo e($materi->views ?? 0); ?> views</strong>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header bg-primary text-white">
            <h6 class="mb-0">Sistem</h6>
          </div>
          <div class="list-group list-group-flush">
            <div class="list-group-item">
              <small class="text-muted d-block">ID Materi</small>
              <strong>#<?php echo e($materi->materi_id); ?></strong>
            </div>
            <div class="list-group-item">
              <small class="text-muted d-block">Dibuat</small>
              <strong><?php echo e($materi->created_at->format('d M Y H:i')); ?></strong>
            </div>
            <div class="list-group-item">
              <small class="text-muted d-block">Diperbarui</small>
              <strong><?php echo e($materi->updated_at->format('d M Y H:i')); ?></strong>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <style>
    .list-group-item {
      padding: 1rem;
    }

    .list-group-item small {
      display: block;
      margin-bottom: 0.25rem;
    }
  </style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\PC_07\aplikasi_bk\resources\views/materi/show.blade.php ENDPATH**/ ?>