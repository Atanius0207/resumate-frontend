@extends('layouts.admin')

@section('title', 'Tambah Pengguna Baru')

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

    .header-title p {
        font-size: 14px;
        color: var(--text-muted);
        margin-top: 4px;
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

    /* Input Error State */
    .form-input.error,
    .form-select.error {
        border-color: #EF4444;
    }

    .error-message {
        color: #EF4444;
        font-size: 12px;
        margin-top: 6px;
        display: none;
    }

    .error-message.show {
        display: block;
    }

    /* Password Strength Indicator */
    .password-strength {
        margin-top: 8px;
        display: none;
    }

    .password-strength.show {
        display: block;
    }

    .strength-bar {
        height: 4px;
        border-radius: 2px;
        background: var(--border-color);
        overflow: hidden;
        margin-bottom: 6px;
    }

    .strength-fill {
        height: 100%;
        transition: 0.3s;
        border-radius: 2px;
    }

    .strength-weak { width: 33%; background: #EF4444; }
    .strength-medium { width: 66%; background: #F59E0B; }
    .strength-strong { width: 100%; background: #10B981; }

    .strength-text {
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .text-weak { color: #EF4444; }
    .text-medium { color: #F59E0B; }
    .text-strong { color: #10B981; }

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
        background: var(--bg-body);
        margin: 0 auto 16px;
        border: 3px dashed var(--border-color);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 8px;
        color: var(--text-muted);
        position: relative;
        overflow: hidden;
        background-size: cover;
        background-position: center;
        transition: 0.3s;
    }

    .avatar-preview.has-image {
        border-style: solid;
    }

    .avatar-preview:hover {
        border-color: var(--primary-color);
    }

    .avatar-placeholder i {
        font-size: 32px;
    }

    .avatar-placeholder span {
        font-size: 11px;
        font-weight: 600;
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

    /* Info Box */
    .info-box {
        background: rgba(76, 175, 80, 0.05);
        border: 1px solid rgba(76, 175, 80, 0.2);
        border-radius: 10px;
        padding: 16px;
    }

    [data-theme="dark"] .info-box {
        background: rgba(76, 175, 80, 0.08);
    }

    .info-box-title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 8px;
    }

    .info-box-content {
        font-size: 12px;
        line-height: 1.6;
        color: var(--text-muted);
    }

    .info-box-content ul {
        margin: 8px 0 0 20px;
        list-style: disc;
    }

    .info-box-content li {
        margin-bottom: 4px;
    }

    /* Tips List */
    .tips-list {
        list-style: none;
        padding: 0;
    }

    .tip-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px;
        border-radius: 8px;
        background: var(--bg-body);
        margin-bottom: 8px;
        font-size: 13px;
        line-height: 1.5;
    }

    .tip-item:last-child {
        margin-bottom: 0;
    }

    .tip-icon {
        width: 24px;
        height: 24px;
        border-radius: 6px;
        background: rgba(76, 175, 80, 0.1);
        color: var(--primary-color);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 11px;
    }

    /* --- 7. Responsive --- */
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
            <span>Tambah Pengguna</span>
        </div>
        <h1>Tambah Pengguna Baru</h1>
        <p>Buat akun pengguna baru untuk sistem ResuMate</p>
    </div>
    <div class="header-actions">
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            <i class="fas fa-times"></i> Batal
        </a>
        <button type="submit" form="createUserForm" class="btn btn-primary">
            <i class="fas fa-user-plus"></i> Buat Pengguna
        </button>
    </div>
</div>

<form id="createUserForm" action="#" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="form-layout">
        <!-- Main Form -->
        <div>
            <!-- Informasi Dasar -->
            <div class="form-card">
                <div class="card-header">
                    <h2>Informasi Dasar</h2>
                    <p>Data pribadi dan kontak pengguna baru</p>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label required">Nama Lengkap</label>
                            <input type="text" name="name" id="name" class="form-input" placeholder="Contoh: Budi Santoso" required>
                            <span class="error-message" id="nameError">Nama lengkap wajib diisi</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-input" placeholder="Contoh: budi.santoso">
                            <small class="form-hint">Otomatis dibuat dari nama jika kosong</small>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label required">Email</label>
                            <input type="email" name="email" id="email" class="form-input" placeholder="Contoh: budi@email.com" required>
                            <span class="error-message" id="emailError">Format email tidak valid</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="tel" name="phone" id="phone" class="form-input" placeholder="+62 812-3456-7890">
                            <small class="form-hint">Opsional, format: +62 xxx-xxxx-xxxx</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Bio / Deskripsi</label>
                        <textarea name="bio" class="form-textarea" placeholder="Ceritakan sedikit tentang pengguna ini (opsional)..."></textarea>
                    </div>
                </div>
            </div>

            <!-- Keamanan Akun -->
            <div class="form-card" style="margin-top: 24px;">
                <div class="card-header">
                    <h2>Keamanan Akun</h2>
                    <p>Set password dan pengaturan keamanan</p>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label required">Password</label>
                            <input type="password" name="password" id="password" class="form-input" placeholder="Minimal 8 karakter" required>
                            <div class="password-strength" id="passwordStrength">
                                <div class="strength-bar">
                                    <div class="strength-fill" id="strengthFill"></div>
                                </div>
                                <span class="strength-text" id="strengthText"></span>
                            </div>
                            <small class="form-hint">Minimal 8 karakter, kombinasi huruf, angka & simbol</small>
                        </div>
                        <div class="form-group">
                            <label class="form-label required">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="passwordConfirm" class="form-input" placeholder="Ketik ulang password" required>
                            <span class="error-message" id="passwordError">Password tidak cocok</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="toggle-group">
                            <div class="toggle-info">
                                <h4>Kirim Email Verifikasi</h4>
                                <p>User akan menerima email untuk verifikasi akun</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="send_verification" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pengaturan Akun -->
            <div class="form-card" style="margin-top: 24px;">
                <div class="card-header">
                    <h2>Pengaturan Akun</h2>
                    <p>Role, paket, dan status akun</p>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Paket Berlangganan</label>
                            <select name="subscription_plan" class="form-select">
                                <option value="free" selected>Gratis</option>
                                <option value="pro">PRO</option>
                                <option value="enterprise">Enterprise</option>
                            </select>
                            <small class="form-hint">Paket default adalah Gratis</small>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Role / Peran</label>
                            <select name="role" class="form-select">
                                <option value="user" selected>User</option>
                                <option value="moderator">Moderator</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="toggle-group">
                            <div class="toggle-info">
                                <h4>Status Akun Aktif</h4>
                                <p>User dapat langsung login setelah dibuat</p>
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
                                <h4>Tandai Email Terverifikasi</h4>
                                <p>Lewati proses verifikasi email</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="email_verified">
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
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
                    <div class="avatar-preview" id="avatarPreview">
                        <div class="avatar-placeholder">
                            <i class="fas fa-user"></i>
                            <span>Belum ada foto</span>
                        </div>
                        <div class="avatar-overlay" style="display: none;">
                            <i class="fas fa-camera"></i>
                        </div>
                    </div>
                    <input type="file" name="avatar" id="avatarInput" accept="image/*" style="display: none;">
                    <label for="avatarInput" class="btn-upload">
                        <i class="fas fa-upload"></i> Upload Foto
                    </label>
                    <small class="form-hint" style="display: block; margin-top: 8px;">JPG, PNG atau GIF. Max 2MB</small>
                </div>
            </div>

            <!-- Info Box -->
            <div class="widget">
                <div class="info-box">
                    <div class="info-box-title">
                        <i class="fas fa-info-circle"></i>
                        <span>Informasi Penting</span>
                    </div>
                    <div class="info-box-content">
                        Setelah pengguna dibuat:
                        <ul>
                            <li>User akan menerima email notifikasi</li>
                            <li>Password dapat direset kapan saja</li>
                            <li>Data dapat diedit di menu Edit User</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Best Practices -->
            <div class="widget">
                <h3 class="widget-title">Tips Password Kuat</h3>
                <ul class="tips-list">
                    <li class="tip-item">
                        <div class="tip-icon"><i class="fas fa-check"></i></div>
                        <div>Gunakan minimal <strong>8 karakter</strong></div>
                    </li>
                    <li class="tip-item">
                        <div class="tip-icon"><i class="fas fa-check"></i></div>
                        <div>Kombinasi huruf <strong>besar & kecil</strong></div>
                    </li>
                    <li class="tip-item">
                        <div class="tip-icon"><i class="fas fa-check"></i></div>
                        <div>Sertakan <strong>angka dan simbol</strong></div>
                    </li>
                    <li class="tip-item">
                        <div class="tip-icon"><i class="fas fa-check"></i></div>
                        <div>Hindari kata yang <strong>mudah ditebak</strong></div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</form>

@endsection

@push('scripts')
<script>
    // Auto-generate username from name
    document.getElementById('name').addEventListener('input', function(e) {
        const usernameField = document.getElementById('username');
        if (usernameField.value === '') {
            const username = e.target.value
                .toLowerCase()
                .replace(/\s+/g, '.')
                .replace(/[^a-z0-9.]/g, '');
            usernameField.value = username;
        }
    });

    // Preview Avatar Upload
    document.getElementById('avatarInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('avatarPreview');
        
        if (file) {
            // Check file size (2MB max)
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file maksimal 2MB!');
                this.value = '';
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.style.backgroundImage = `url(${e.target.result})`;
                preview.classList.add('has-image');
                preview.querySelector('.avatar-placeholder').style.display = 'none';
                preview.querySelector('.avatar-overlay').style.display = 'flex';
            }
            reader.readAsDataURL(file);
        }
    });

    // Password Strength Checker
    document.getElementById('password').addEventListener('input', function(e) {
        const password = e.target.value;
        const strengthDiv = document.getElementById('passwordStrength');
        const strengthFill = document.getElementById('strengthFill');
        const strengthText = document.getElementById('strengthText');
        
        if (password.length === 0) {
            strengthDiv.classList.remove('show');
            return;
        }
        
        strengthDiv.classList.add('show');
        
        let strength = 0;
        
        // Length check
        if (password.length >= 8) strength++;
        if (password.length >= 12) strength++;
        
        // Character variety
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^a-zA-Z0-9]/.test(password)) strength++;
        
        // Update UI
        strengthFill.className = 'strength-fill';
        strengthText.className = 'strength-text';
        
        if (strength <= 2) {
            strengthFill.classList.add('strength-weak');
            strengthText.classList.add('text-weak');
            strengthText.textContent = '⚠️ Password Lemah';
        } else if (strength <= 4) {
            strengthFill.classList.add('strength-medium');
            strengthText.classList.add('text-medium');
            strengthText.textContent = '🔒 Password Sedang';
        } else {
            strengthFill.classList.add('strength-strong');
            strengthText.classList.add('text-strong');
            strengthText.textContent = '✅ Password Kuat';
        }
    });

    // Form Validation
    document.getElementById('createUserForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        let isValid = true;
        
        // Clear previous errors
        document.querySelectorAll('.error-message').forEach(el => el.classList.remove('show'));
        document.querySelectorAll('.form-input, .form-select').forEach(el => el.classList.remove('error'));
        
        // Name validation
        const name = document.getElementById('name').value.trim();
        if (name === '') {
            document.getElementById('name').classList.add('error');
            document.getElementById('nameError').classList.add('show');
            isValid = false;
        }
        
        // Email validation
        const email = document.getElementById('email').value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            document.getElementById('email').classList.add('error');
            document.getElementById('emailError').classList.add('show');
            isValid = false;
        }
        
        // Password validation
        const password = document.getElementById('password').value;
        const passwordConfirm = document.getElementById('passwordConfirm').value;
        
        if (password.length < 8) {
            document.getElementById('password').classList.add('error');
            alert('Password minimal 8 karakter!');
            isValid = false;
        }
        
        if (password !== passwordConfirm) {
            document.getElementById('passwordConfirm').classList.add('error');
            document.getElementById('passwordError').classList.add('show');
            isValid = false;
        }
        
        if (isValid) {
            // Show loading state
            const submitBtn = document.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Membuat User...';
            submitBtn.disabled = true;
            
            // Simulate form submission (replace with actual submit)
            setTimeout(() => {
                alert('✅ Pengguna berhasil dibuat!');
                window.location.href = '{{ route("admin.users.index") }}';
            }, 1500);
        } else {
            // Scroll to first error
            const firstError = document.querySelector('.error');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });

    // Real-time password match validation
    document.getElementById('passwordConfirm').addEventListener('input', function() {
        const password = document.getElementById('password').value;
        const passwordConfirm = this.value;
        const errorMsg = document.getElementById('passwordError');
        
        if (passwordConfirm === '') {
            this.classList.remove('error');
            errorMsg.classList.remove('show');
        } else if (password !== passwordConfirm) {
            this.classList.add('error');
            errorMsg.classList.add('show');
        } else {
            this.classList.remove('error');
            errorMsg.classList.remove('show');
        }
    });
</script>
@endpush