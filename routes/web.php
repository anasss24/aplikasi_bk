<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\RiwayatKonselingController;
use App\Http\Controllers\MateriBKController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\SelfAssessmentController;
use App\Http\Controllers\KuisionerController;
use App\Http\Controllers\LogAktivitasController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OtpPasswordResetController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\SiswaController as AdminSiswaController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('landing');
});

// OTP Verification routes - withoutMiddleware Authenticate
Route::withoutMiddleware(\App\Http\Middleware\Authenticate::class)->group(function () {
    Route::get('/verify-otp', [OtpController::class, 'showVerificationForm'])->name('verify.otp.form');
    Route::post('/verify-otp', [OtpController::class, 'verifyOtp'])->name('verify.otp');
});

// User routes
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    
    // Profile routes
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Siswa Management
    Route::resource('siswa', SiswaController::class)->except(['show']);
    Route::get('/siswa/{siswa}', [SiswaController::class, 'show'])->name('siswa.show');
    
    // Jadwal Konseling
    Route::resource('jadwal', JadwalController::class)->parameters(['jadwal' => 'jadwal']);
    Route::post('/jadwal/{jadwal}/approve', [JadwalController::class, 'approve'])->name('jadwal.approve');
    Route::post('/jadwal/{jadwal}/reject', [JadwalController::class, 'reject'])->name('jadwal.reject');
    Route::post('/jadwal/{jadwal}/cancel', [JadwalController::class, 'cancel'])->name('jadwal.cancel');
    Route::post('/jadwal/{jadwal}/selesai', [JadwalController::class, 'selesai'])->name('jadwal.selesai');
    
    // Riwayat Konseling
    Route::get('/riwayat/create', [RiwayatKonselingController::class, 'create'])->name('riwayat.create');
    Route::get('/riwayat/{riwayat}/catat', [RiwayatKonselingController::class, 'catat'])->name('riwayat.catat');
    Route::resource('riwayat', RiwayatKonselingController::class)->except(['show', 'create']);
    Route::get('/riwayat/{riwayat}', [RiwayatKonselingController::class, 'show'])->name('riwayat.show');
    
    // Materi BK
    Route::resource('materi', MateriBKController::class)->except(['show']);
    Route::get('/materi/{materi}', [MateriBKController::class, 'show'])->name('materi.show');
    Route::get('/materi/{materi}/download', [MateriBKController::class, 'download'])->name('materi.download');
    
    // Chat
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{userId}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat', [ChatController::class, 'store'])->name('chat.store');
    Route::post('/chat/{userId}/selesai', [ChatController::class, 'selesai'])->name('chat.selesai');
    Route::get('/api/chat/{userId}/messages', [ChatController::class, 'getMessages']);
    
    // Self Assessment
    Route::resource('assessment', SelfAssessmentController::class)->only(['index', 'create', 'store', 'show']);
    
    // Kuisioner
    Route::resource('kuisioner', KuisionerController::class)->only(['index', 'create', 'store', 'show']);
});

// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    
    // Kelas routes
    Route::get('/admin/kelas', [KelasController::class, 'index'])->name('admin.kelas.index');
    Route::get('/admin/kelas/create', [KelasController::class, 'create'])->name('admin.kelas.create');
    Route::post('/admin/kelas', [KelasController::class, 'store'])->name('admin.kelas.store');
    Route::get('/admin/kelas/{id}/edit', [KelasController::class, 'edit'])->name('admin.kelas.edit');
    Route::put('/admin/kelas/{id}', [KelasController::class, 'update'])->name('admin.kelas.update');
    Route::delete('/admin/kelas/{id}', [KelasController::class, 'destroy'])->name('admin.kelas.destroy');
    
    Route::get('/admin/jurusan', [AdminController::class, 'jurusan'])->name('admin.jurusan.index');
    Route::get('/admin/jurusan/create', [JurusanController::class, 'create'])->name('admin.jurusan.create');
    Route::post('/admin/jurusan', [JurusanController::class, 'store'])->name('admin.jurusan.store');
    Route::get('/admin/jurusan/{jurusan}/edit', [JurusanController::class, 'edit'])->name('admin.jurusan.edit');
    Route::put('/admin/jurusan/{jurusan}', [JurusanController::class, 'update'])->name('admin.jurusan.update');
    Route::delete('/admin/jurusan/{jurusan}', [JurusanController::class, 'destroy'])->name('admin.jurusan.destroy');
    Route::get('/admin/laporan', [AdminController::class, 'laporan'])->name('admin.laporan.index');
    Route::get('/admin/laporan/siswa', [AdminController::class, 'laporanSiswa'])->name('admin.laporan.siswa');
    Route::get('/admin/laporan/jadwal', [AdminController::class, 'laporanJadwal'])->name('admin.laporan.jadwal');
    Route::get('/admin/laporan/prestasi', [AdminController::class, 'laporanPrestasi'])->name('admin.laporan.prestasi');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    
    // Admin Siswa Management
    Route::get('/admin/siswa', [AdminSiswaController::class, 'index'])->name('admin.siswa.index');
    Route::get('/admin/siswa/create', [AdminSiswaController::class, 'create'])->name('admin.siswa.create');
    Route::post('/admin/siswa', [AdminSiswaController::class, 'store'])->name('admin.siswa.store');
    Route::get('/admin/siswa/{id}/edit', [AdminSiswaController::class, 'edit'])->name('admin.siswa.edit');
    Route::put('/admin/siswa/{id}', [AdminSiswaController::class, 'update'])->name('admin.siswa.update');
    Route::delete('/admin/siswa/{id}', [AdminSiswaController::class, 'destroy'])->name('admin.siswa.destroy');
    
    // Log Aktivitas
    Route::get('/admin/log-aktivitas', [LogAktivitasController::class, 'index'])->name('log.index');
});

// ============ AUTH ROUTES ============
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'register']);

    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    // OTP Password Reset Routes
    Route::get('/verify-otp-reset', [OtpPasswordResetController::class, 'showOtpForm'])
        ->name('password.verify-otp');

    Route::post('/verify-otp-reset', [OtpPasswordResetController::class, 'verifyOtp'])
        ->name('password.verify-otp-check');

    Route::post('/reset-password-otp', [OtpPasswordResetController::class, 'updatePassword'])
        ->name('password.update-otp');

    Route::post('/resend-otp-reset', [OtpPasswordResetController::class, 'resendOtp'])
        ->name('password.resend-otp');

    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('/reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::post('/resend-otp', [OtpController::class, 'resendOtp'])
        ->name('resend.otp');

    Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');
});