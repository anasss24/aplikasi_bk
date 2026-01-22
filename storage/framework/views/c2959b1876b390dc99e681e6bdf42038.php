<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h2 fw-bold text-dark mb-0">Chat</h1>
            <p class="text-muted mb-0">Berkomunikasi dengan pengguna lain</p>
        </div>
    </div>

    <div class="row g-3">
        <?php if(!Auth::user()->hasRole('guru_bk')): ?>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 fw-bold">Chat</h5>
                </div>
                <div class="card-body p-0">
                    <?php
                        $guruBK = \App\Models\GuruBK::with('user')->get();
                    ?>
                    
                    <?php if($guruBK->count() > 0): ?>
                        <div class="list-group list-group-flush">
                            <?php $__currentLoopData = $guruBK; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guru): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('chat.show', $guru->user->id)); ?>" class="list-group-item list-group-item-action p-3 border-0 border-bottom hover-light" style="text-decoration: none; transition: all 0.3s ease;">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; flex-shrink: 0;">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0 fw-semibold text-dark"><?php echo e($guru->user->name); ?></h6>
                                            <small class="text-muted">
                                                <i class="fas fa-circle" style="color: #198754; font-size: 6px;"></i> Online
                                            </small>
                                        </div>
                                        <i class="fas fa-chevron-right text-muted"></i>
                                    </div>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <div class="p-4 text-center text-muted">
                            <i class="fas fa-user-slash fa-2x mb-3 opacity-50"></i>
                            <p>Belum ada guru BK</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php else: ?>
        
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 fw-bold">Chat</h5>
                </div>
                <div class="card-body p-0">
                    <?php if($chats->count() > 0): ?>
                        <div class="list-group list-group-flush">
                            <?php $__currentLoopData = $chats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userId => $messages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $otherUser = \App\Models\User::find($userId);
                                ?>
                                <?php if($otherUser): ?>
                                    <a href="<?php echo e(route('chat.show', $userId)); ?>" class="list-group-item list-group-item-action p-3 border-0 border-bottom hover-light" style="text-decoration: none; transition: all 0.3s ease;">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; flex-shrink: 0;">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0 fw-semibold text-dark"><?php echo e($otherUser->name); ?></h6>
                                                <small class="text-muted">
                                                    <i class="fas fa-circle" style="color: #198754; font-size: 6px;"></i> Online
                                                </small>
                                            </div>
                                            <i class="fas fa-chevron-right text-muted"></i>
                                        </div>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <div class="p-4 text-center text-muted">
                            <i class="fas fa-comments fa-2x mb-3 opacity-50"></i>
                            <p>Tidak ada percakapan</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="col-md-9">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom">
                    <?php
                        $headerTitle = 'Daftar Percakapan';
                        if($chats->count() > 0) {
                            $firstChat = collect($chats)->first();
                            if($firstChat) {
                                $firstUserId = collect($chats)->keys()->first();
                                $firstUser = \App\Models\User::find($firstUserId);
                                $headerTitle = $firstUser ? 'Percakapan dengan ' . $firstUser->name : 'Percakapan Aktif';
                            }
                        } else {
                            $headerTitle = 'Belum Ada Percakapan';
                        }
                    ?>
                    <h5 class="mb-0 fw-bold"><?php echo e($headerTitle); ?></h5>
                </div>
                <div class="card-body p-0">
                    <?php if($chats->count() > 0): ?>
                        <div class="list-group list-group-flush">
                            <?php $__currentLoopData = $chats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userId => $messages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $otherUser = \App\Models\User::find($userId);
                                    $lastMessage = $messages->first();  // Ambil yang pertama (terbaru)
                                    $unreadCount = $messages->where('penerima_id', Auth::id())->where('is_read', false)->count();
                                ?>
                                
                                <?php if($otherUser): ?>
                                    <a href="<?php echo e(route('chat.show', $userId)); ?>" class="list-group-item list-group-item-action p-3 border-0 border-bottom hover-light" style="text-decoration: none; transition: all 0.3s ease;">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="mb-0 fw-semibold text-dark"><?php echo e($otherUser->name); ?></h6>
                                            <?php if($unreadCount > 0): ?>
                                                <span class="badge bg-danger"><?php echo e($unreadCount); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <p class="text-muted small mb-0 text-truncate">
                                            <?php if($lastMessage->pengirim_id == Auth::id()): ?>
                                                <strong>Anda:</strong>
                                            <?php endif; ?>
                                            <?php echo e($lastMessage->isi_pesan); ?>

                                        </p>
                                        <small class="text-muted d-block mt-2">
                                            <?php echo e($lastMessage->waktu_kirim->diffForHumans()); ?>

                                        </small>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <div class="p-4 text-center text-muted">
                            <i class="fas fa-comments fa-2x mb-3 opacity-50"></i>
                            <p>Tidak ada percakapan</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-light:hover {
        background-color: #f8f9fa !important;
    }
</style>

<script>
    // Real-time polling untuk update list chat
    function refreshChatList() {
        fetch('<?php echo e(route("chat.index")); ?>', {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.text())
        .then(html => {
            // Parse HTML untuk extract chat list
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newChatList = doc.querySelector('.list-group.list-group-flush');
            const currentChatList = document.querySelector('.list-group.list-group-flush');
            
            if(newChatList && currentChatList) {
                currentChatList.innerHTML = newChatList.innerHTML;
            }
        })
        .catch(error => console.error('Error refreshing chat list:', error));
    }

    // Polling setiap 2 detik untuk update list
    const chatListInterval = setInterval(refreshChatList, 2000);

    // Cleanup saat halaman ditutup
    window.addEventListener('unload', () => clearInterval(chatListInterval));
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\PC_07\aplikasi_bk\resources\views/chat/index.blade.php ENDPATH**/ ?>