@extends('layouts.admin')

@section('title', 'Edit Pengguna')

@push('styles')
<style>
    /* --- 1. Page Header --- */
    .page-header {
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        margin-bottom: 32px;
        flex-wrap: wrap; 
        gap: 16px;
    }
    
    .breadcrumb {
        display: flex; 
        align-items: center; 
        gap: 8px; 
        font-size: 14px; 
        color: var(--text-muted);
        margin-bottom: 8px;
    }
    
    .breadcrumb a {
        color: var(--primary-color); 
        transition: 0.2s;
    }
    
    .breadcrumb a:hover {
        color: var(--primary-hover);
    }
    
    .breadcrumb i {
        font-size: 10px;
    }
    
    .header-title h1 { 
        font-size: 28px; 
        font-weight: 800; 
        color: var(--text-main); 
        letter-spacing: -0.5px; 
    }

    .header-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .btn {
        padding: 10px 24px; 
        border-radius: 10px; 
        font-size: 14px; 
        font-weight: 600;
        display: inline-flex; 
        align-items: center; 
        gap: 8px; 
        cursor: pointer; 
        transition: 0.2s;
        border: none;
        white-space: nowrap;
    }

    .btn-secondary {
        background: var(--bg-card);
        color: var(--text-main);
        border: 1px solid var(--border-color);
    }

    .btn-secondary:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
    }

    .btn-primary {
        background: var(--primary-color);
        color: white;
        box-shadow: 0 4px 12px rgba(76, 175, 80, 0.25);
    }

    .btn-primary:hover {
        background: var(--primary-hover);
        transform: translateY(-2px);
    }

    /* --- 2. Form Layout Grid --- */
    .form-layout {
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 24px;
        align-items: start;
    }

    /* --- 3. Form Card --- */
    .form-card {
        background: var(--bg-card);
        border-radius: 16px;
        border: 1px solid var(--border-color);
        box-shadow: var(--shadow-md);
        overflow: hidden;
    }

    .card-header {
        padding: 24px;
        border-bottom: 1px solid var(--border-color);
        background: var(--bg-body);
    }

    .card-header h2 {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 4px;
    }

    .card-header p {
        font-size: 13px;
        color: var(--text-muted);
    }

    .card-body {
        padding: 24px;
    }

    /* --- 4. Form Groups --- */
    .form-group {
        margin-bottom: 24px;
    }

    .form-group:last-child {
        margin-bottom: 0;
    }

    .form-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 8px;
        letter-spacing: 0.2px;
    }

    .form-label.required::after {
        content: '*';
        color: #EF4444;
        margin-left: 4px;
    }

    .form-input,
    .form-select,
    .form-textarea {
        width: 100%;
        padding: 12px 16px;
        border-radius: 10px;
        border: 1px solid var(--border-color);
        background: var(--bg-card);
        color: var(--text-main);
        font-size: 14px;
        font-family: 'Inter', sans-serif;
        outline: none;
        transition: 0.3s;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
    }

    .form-textarea {
        resize: vertical;
        min-height: 100px;
    }

    .form-hint {
        font-size: 12px;
        color: var(--text-muted);
        margin-top: 6px;
        display: block;
    }

    /* Two Column Layout for Form */
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    /* --- 5. Toggle Switch --- */
    .toggle-group {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px;
        border-radius: 10px;
        background: var(--bg-body);
        border: 1px solid var(--border-color);
    }

    .toggle-info h4 {
        font-size: 14px;
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 2px;
    }

    .toggle-info p {
        font-size: 12px;
        color: var(--text-muted);
    }

    .toggle-switch {
        position: relative;
        width: 48px;
        height: 26px;
    }

    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .toggle-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #CBD5E1;
        transition: 0.3s;
        border-radius: 34px;
    }

    .toggle-slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: 0.3s;
        border-radius: 50%;
    }

    .toggle-switch input:checked + .toggle-slider {
        background-color: var(--primary-color);
    }

    .toggle-switch input:checked + .toggle-slider:before {
        transform: translateX(22px);
    }

    /* --- 6. Sidebar Widgets --- */
    .widget {
        background: var(--bg-card);
        border-radius: 16px;
        border: 1px solid var(--border-color);
        padding: 20px;
        margin-bottom: 20px;
    }

    .widget:last-child {
        margin-bottom: 0;
    }

    .widget-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 16px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Avatar Upload */
    .avatar-upload {
        text-align: center;
    }

    .avatar-preview {
        width: 120px;
        height: 120px;
        border-radius: 16px;
        background-size: cover;
        background-position: center;
        margin: 0 auto 16px;
        border: 3px solid var(--border-color);
        position: relative;
        overflow: hidden;
    }

    .avatar-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: 0.3s;
        cursor: pointer;
    }

    .avatar-preview:hover .avatar-overlay {
        opacity: 1;
    }

    .avatar-overlay i {
        color: white;
        font-size: 24px;
    }

    .btn-upload {
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        border: 1px dashed var(--border-color);
        background: var(--bg-body);
        color: var(--text-main);
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-upload:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
        background: rgba(76, 175, 80, 0.05);
    }

    /* Info List */
    .info-list {
        list-style: none;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid var(--border-color);
        font-size: 13px;
    }

    .info-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .info-item:first-child {
        padding-top: 0;
    }

    .info-label {
        color: var(--text-muted);
        font-weight: 500;
    }

    .info-value {
        color: var(--text-main);
        font-weight: 600;
    }

    /* Level Badge in Widget */
    .level-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .level-badge.pro {
        background: #E0E7FF;
        color: #4338CA;
        border: 1px solid #C7D2FE;
    }

    .level-badge.free {
        background: var(--bg-body);
        color: var(--text-muted);
        border: 1px solid var(--border-color);
    }

    .level-badge i {
        font-size: 10px;
    }

    /* --- 7. Danger Zone --- */
    .danger-zone {
        border: 1px solid #FEE2E2;
        background: #FEF2F2;
        border-radius: 12px;
        padding: 20px;
    }

    [data-theme="dark"] .danger-zone {
        background: rgba(239, 68, 68, 0.05);
        border-color: rgba(239, 68, 68, 0.2);
    }

    .danger-zone h3 {
        font-size: 14px;
        font-weight: 700;
        color: #DC2626;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .danger-zone p {
        font-size: 13px;
        color: #991B1B;
        margin-bottom: 16px;
        line-height: 1.5;
    }

    [data-theme="dark"] .danger-zone p {
        color: #FCA5A5;
    }

    .btn-danger {
        background: #DC2626;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-danger:hover {
        background: #B91C1C;
        transform: translateY(-1px);
    }

    /* --- 8. Responsive --- */
    @media (max-width: 1024px) {
        .form-layout {
            grid-template-columns: 1fr;
        }

        .form-row {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .header-actions {
            width: 100%;
        }

        .btn {
            flex: 1;
            justify-content: center;
        }

        .card-body {
            padding: 16px;
        }
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <div>
        <div class="breadcrumb">
            <a href="{{ route('admin.dashboard.index') }}"><i class="fas fa-home"></i> Dashboard</a>
            <i class="fas fa-chevron-right"></i>
            <a href="{{ route('admin.users.index') }}">Pengguna</a>
            <i class="fas fa-chevron-right"></i>
            <span>Edit Pengguna</span>
        </div>
        <h1>Edit Pengguna</h1>
    </div>
    <div class="header-actions">
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <button type="submit" form="editUserForm" class="btn btn-primary">
            <i class="fas fa-save"></i> Simpan Perubahan
        </button>
    </div>
</div>

<form id="editUserForm" action="#" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="form-layout">
        <!-- Main Form -->
        <div>
            <!-- Informasi Dasar -->
            <div class="form-card">
                <div class="card-header">
                    <h2>Informasi Dasar</h2>
                    <p>Data pribadi dan kontak pengguna</p>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label required">Nama Lengkap</label>
                            <input type="text" name="name" class="form-input" value="Aditya Pratama" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-input" value="adit.pratama">
                            <small class="form-hint">Username unik untuk login</small>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label required">Email</label>
                            <input type="email" name="email" class="form-input" value="adit.pratama@gmail.com" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="tel" name="phone" class="form-input" value="+62 812-3456-7890">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Bio / Deskripsi</label>
                        <textarea name="bio" class="form-textarea" placeholder="Ceritakan sedikit tentang pengguna ini...">UI/UX Designer dengan pengalaman 5+ tahun di industri teknologi.</textarea>
                    </div>
                </div>
            </div>

            <!-- Pengaturan Akun -->
            <div class="form-card" style="margin-top: 24px;">
                <div class="card-header">
                    <h2>Pengaturan Akun</h2>
                    <p>Kelola akses dan status pengguna</p>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Paket Berlangganan</label>
                            <select name="subscription_plan" class="form-select">
                                <option value="free">Gratis</option>
                                <option value="pro" selected>PRO</option>
                                <option value="enterprise">Enterprise</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Role / Peran</label>
                            <select name="role" class="form-select">
                                <option value="user" selected>User</option>
                                <option value="admin">Admin</option>
                                <option value="moderator">Moderator</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="toggle-group">
                            <div class="toggle-info">
                                <h4>Status Akun Aktif</h4>
                                <p>Pengguna dapat login dan mengakses sistem</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="is_active" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="toggle-group">
                            <div class="toggle-info">
                                <h4>Email Terverifikasi</h4>
                                <p>Tandai email pengguna sebagai terverifikasi</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="email_verified" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reset Password -->
            <div class="form-card" style="margin-top: 24px;">
                <div class="card-header">
                    <h2>Reset Password</h2>
                    <p>Kosongkan jika tidak ingin mengubah password</p>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="password" class="form-input" placeholder="Masukkan password baru (minimal 8 karakter)">
                        <small class="form-hint">Minimal 8 karakter, kombinasi huruf dan angka</small>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-input" placeholder="Ketik ulang password baru">
                    </div>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="form-card" style="margin-top: 24px;">
                <div class="card-body">
                    <div class="danger-zone">
                        <h3><i class="fas fa-exclamation-triangle"></i> Zona Berbahaya</h3>
                        <p>Tindakan ini bersifat permanen dan tidak dapat dibatalkan. Seluruh data pengguna, CV yang dibuat, dan riwayat transaksi akan dihapus dari sistem.</p>
                        <button type="button" class="btn-danger" onclick="confirmDelete()">
                            <i class="fas fa-trash-alt"></i> Hapus Akun Pengguna
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div>
            <!-- Avatar Upload -->
            <div class="widget">
                <h3 class="widget-title">Foto Profil</h3>
                <div class="avatar-upload">
                    <div class="avatar-preview" style="background-image: url('https://ui-avatars.com/api/?name=Aditya+Pratama&background=e0f2fe&color=0369a1&size=256');">
                        <div class="avatar-overlay">
                            <i class="fas fa-camera"></i>
                        </div>
                    </div>
                    <input type="file" name="avatar" id="avatarInput" accept="image/*" style="display: none;">
                    <label for="avatarInput" class="btn-upload">
                        <i class="fas fa-upload"></i> Upload Foto Baru
                    </label>
                    <small class="form-hint" style="display: block; margin-top: 8px;">JPG, PNG atau GIF. Max 2MB</small>
                </div>
            </div>

            <!-- User Info -->
            <div class="widget">
                <h3 class="widget-title">Informasi Akun</h3>
                <ul class="info-list">
                    <li class="info-item">
                        <span class="info-label">User ID</span>
                        <span class="info-value">#UM-00412</span>
                    </li>
                    <li class="info-item">
                        <span class="info-label">Status Paket</span>
                        <span class="level-badge pro">
                            <i class="fas fa-crown"></i> PRO
                        </span>
                    </li>
                    <li class="info-item">
                        <span class="info-label">Bergabung</span>
                        <span class="info-value">12 Jan 2026</span>
                    </li>
                    <li class="info-item">
                        <span class="info-label">Terakhir Login</span>
                        <span class="info-value">2 menit lalu</span>
                    </li>
                    <li class="info-item">
                        <span class="info-label">Total CV Dibuat</span>
                        <span class="info-value">23 Dokumen</span>
                    </li>
                </ul>
            </div>

            <!-- Quick Actions -->
            <div class="widget">
                <h3 class="widget-title">Aksi Cepat</h3>
                <button type="button" class="btn btn-secondary" style="width: 100%; margin-bottom: 8px;">
                    <i class="fas fa-envelope"></i> Kirim Email
                </button>
                <button type="button" class="btn btn-secondary" style="width: 100%; margin-bottom: 8px;">
                    <i class="fas fa-file-alt"></i> Lihat CV User
                </button>
                <button type="button" class="btn btn-secondary" style="width: 100%;">
                    <i class="fas fa-history"></i> Riwayat Aktivitas
                </button>
            </div>
        </div>
    </div>
</form>

@endsection

@push('scripts')
<script>
    // Preview Avatar Upload
    document.getElementById('avatarInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('.avatar-preview').style.backgroundImage = `url(${e.target.result})`;
            }
            reader.readAsDataURL(file);
        }
    });

    // Confirm Delete
    function confirmDelete() {
        if (confirm('⚠️ PERINGATAN!\n\nAnda yakin ingin menghapus akun pengguna ini?\n\nSemua data termasuk CV, transaksi, dan riwayat akan dihapus permanen!\n\nKetik "HAPUS" untuk melanjutkan')) {
            const confirmText = prompt('Ketik "HAPUS" untuk konfirmasi:');
            if (confirmText === 'HAPUS') {
                // Submit delete form
                alert('Akun pengguna berhasil dihapus!');
                window.location.href = '{{ route("admin.users.index") }}';
            }
        }
    }

    // Form Validation
    document.getElementById('editUserForm').addEventListener('submit', function(e) {
        const password = document.querySelector('input[name="password"]').value;
        const passwordConfirm = document.querySelector('input[name="password_confirmation"]').value;
        
        if (password && password !== passwordConfirm) {
            e.preventDefault();
            alert('Password dan konfirmasi password tidak cocok!');
            return false;
        }
        
        if (password && password.length < 8) {
            e.preventDefault();
            alert('Password minimal 8 karakter!');
            return false;
        }
    });
</script>
@endpush