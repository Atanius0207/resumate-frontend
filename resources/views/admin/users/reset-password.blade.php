@extends('layouts.admin')

@section('title', 'Reset Password Pengguna')

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

    /* --- 2. Page Layout --- */
    .reset-password-layout {
        max-width: 900px;
        margin: 0 auto;
    }

    /* --- 3. User Info Card --- */
    .user-info-card {
        background: var(--bg-card);
        border-radius: 16px;
        border: 1px solid var(--border-color);
        padding: 24px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 20px;
        box-shadow: var(--shadow-md);
    }

    .user-avatar {
        width: 80px;
        height: 80px;
        border-radius: 16px;
        background-size: cover;
        background-position: center;
        border: 3px solid var(--border-color);
        flex-shrink: 0;
    }

    .user-details {
        flex: 1;
    }

    .user-name {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 4px;
    }

    .user-email {
        font-size: 14px;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 8px;
    }

    .user-meta {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        color: var(--text-muted);
    }

    .meta-item i {
        font-size: 12px;
        color: var(--primary-color);
    }

    /* Level Badge */
    .level-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 800;
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

    /* --- 4. Reset Options Card --- */
    .reset-options-card {
        background: var(--bg-card);
        border-radius: 16px;
        border: 1px solid var(--border-color);
        overflow: hidden;
        box-shadow: var(--shadow-md);
        margin-bottom: 24px;
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

    /* --- 5. Reset Method Options --- */
    .reset-methods {
        display: grid;
        gap: 16px;
    }

    .method-option {
        border: 2px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        cursor: pointer;
        transition: 0.3s;
        position: relative;
    }

    .method-option:hover {
        border-color: var(--primary-color);
        background: rgba(76, 175, 80, 0.02);
    }

    .method-option.active {
        border-color: var(--primary-color);
        background: rgba(76, 175, 80, 0.05);
    }

    .method-option input[type="radio"] {
        position: absolute;
        opacity: 0;
    }

    .method-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 12px;
    }

    .method-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: var(--bg-body);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .method-option.active .method-icon {
        background: rgba(76, 175, 80, 0.1);
        color: var(--primary-color);
    }

    .method-info h3 {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 2px;
    }

    .method-info p {
        font-size: 13px;
        color: var(--text-muted);
    }

    .method-content {
        padding-left: 64px;
        display: none;
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid var(--border-color);
    }

    .method-option.active .method-content {
        display: block;
    }

    /* Radio Check Indicator */
    .radio-check {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 24px;
        height: 24px;
        border: 2px solid var(--border-color);
        border-radius: 50%;
        transition: 0.3s;
    }

    .method-option.active .radio-check {
        border-color: var(--primary-color);
        background: var(--primary-color);
    }

    .method-option.active .radio-check::after {
        content: '\f00c';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        color: white;
        font-size: 12px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    /* --- 6. Form Groups --- */
    .form-group {
        margin-bottom: 20px;
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

    .form-input {
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

    .form-input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
    }

    .form-hint {
        font-size: 12px;
        color: var(--text-muted);
        margin-top: 6px;
        display: block;
    }

    /* Password Generator Button */
    .btn-generate {
        background: var(--bg-body);
        border: 1px solid var(--border-color);
        color: var(--text-main);
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 8px;
    }

    .btn-generate:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
        background: rgba(76, 175, 80, 0.05);
    }

    /* Password Display Box */
    .password-display {
        background: var(--bg-body);
        border: 1px solid var(--border-color);
        border-radius: 10px;
        padding: 16px;
        margin-top: 12px;
        display: none;
    }

    .password-display.show {
        display: block;
    }

    .password-value {
        font-family: 'Courier New', monospace;
        font-size: 18px;
        font-weight: 700;
        color: var(--primary-color);
        letter-spacing: 2px;
        text-align: center;
        padding: 12px;
        background: var(--bg-card);
        border-radius: 8px;
        margin-bottom: 12px;
        word-break: break-all;
    }

    .password-actions {
        display: flex;
        gap: 8px;
        justify-content: center;
    }

    .btn-copy {
        flex: 1;
        padding: 8px 16px;
        border-radius: 8px;
        border: 1px solid var(--border-color);
        background: var(--bg-card);
        color: var(--text-main);
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .btn-copy:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
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

    /* --- 7. Alert Box --- */
    .alert-box {
        padding: 16px 20px;
        border-radius: 12px;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-top: 16px;
        font-size: 13px;
        line-height: 1.6;
    }

    .alert-warning {
        background: rgba(245, 158, 11, 0.1);
        border: 1px solid rgba(245, 158, 11, 0.3);
        color: #D97706;
    }

    [data-theme="dark"] .alert-warning {
        background: rgba(245, 158, 11, 0.15);
        color: #FCD34D;
    }

    .alert-box i {
        font-size: 18px;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .alert-box ul {
        margin: 8px 0 0 20px;
        list-style: disc;
    }

    .alert-box li {
        margin-bottom: 4px;
    }

    /* --- 8. Toggle Switch --- */
    .toggle-group {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px;
        border-radius: 10px;
        background: var(--bg-body);
        border: 1px solid var(--border-color);
        margin-top: 16px;
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

    /* --- 9. Activity Log --- */
    .activity-log {
        background: var(--bg-card);
        border-radius: 16px;
        border: 1px solid var(--border-color);
        overflow: hidden;
        box-shadow: var(--shadow-md);
    }

    .log-item {
        padding: 16px 24px;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        gap: 16px;
        font-size: 13px;
    }

    .log-item:last-child {
        border-bottom: none;
    }

    .log-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background: var(--bg-body);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: var(--text-muted);
    }

    .log-content {
        flex: 1;
    }

    .log-text {
        color: var(--text-main);
        margin-bottom: 4px;
    }

    .log-time {
        color: var(--text-muted);
        font-size: 12px;
    }

    /* --- 10. Responsive --- */
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

        .user-info-card {
            flex-direction: column;
            text-align: center;
        }

        .user-meta {
            justify-content: center;
        }

        .method-content {
            padding-left: 0;
        }

        .card-body {
            padding: 16px;
        }
    }
</style>
@endpush

@section('content')

<div class="reset-password-layout">
    <div class="page-header">
        <div>
            <div class="breadcrumb">
                <a href="{{ route('admin.dashboard.index') }}"><i class="fas fa-home"></i> Dashboard</a>
                <i class="fas fa-chevron-right"></i>
                <a href="{{ route('admin.users.index') }}">Pengguna</a>
                <i class="fas fa-chevron-right"></i>
                <span>Reset Password</span>
            </div>
            <h1>Reset Password Pengguna</h1>
            <p>Atur ulang password untuk akun pengguna</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <!-- User Info -->
    <div class="user-info-card">
        <div class="user-avatar" style="background-image: url('https://ui-avatars.com/api/?name=Aditya+Pratama&background=e0f2fe&color=0369a1&size=256');"></div>
        <div class="user-details">
            <div class="user-name">Aditya Pratama</div>
            <div class="user-email">
                <i class="fas fa-envelope"></i> adit.pratama@gmail.com
            </div>
            <div class="user-meta">
                <div class="meta-item">
                    <i class="fas fa-calendar"></i>
                    <span>Bergabung: 12 Jan 2026</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-clock"></i>
                    <span>Login terakhir: 2 menit lalu</span>
                </div>
                <span class="level-badge pro">
                    <i class="fas fa-crown"></i> PRO
                </span>
            </div>
        </div>
    </div>

    <!-- Reset Options -->
    <form id="resetPasswordForm" method="POST" action="#">
        @csrf
        
        <div class="reset-options-card">
            <div class="card-header">
                <h2>Pilih Metode Reset Password</h2>
                <p>Pilih bagaimana Anda ingin mengatur ulang password</p>
            </div>
            <div class="card-body">
                <div class="reset-methods">
                    <!-- Method 1: Send Reset Link -->
                    <label class="method-option active" for="method1">
                        <input type="radio" name="reset_method" id="method1" value="send_link" checked>
                        <div class="radio-check"></div>
                        <div class="method-header">
                            <div class="method-icon">
                                <i class="fas fa-paper-plane"></i>
                            </div>
                            <div class="method-info">
                                <h3>Kirim Link Reset via Email</h3>
                                <p>User akan menerima email dengan link untuk reset password</p>
                            </div>
                        </div>
                        <div class="method-content">
                            <div class="alert-box alert-warning">
                                <i class="fas fa-info-circle"></i>
                                <div>
                                    <strong>Informasi:</strong>
                                    <ul>
                                        <li>Email akan dikirim ke <strong>adit.pratama@gmail.com</strong></li>
                                        <li>Link reset berlaku selama <strong>60 menit</strong></li>
                                        <li>User dapat mengatur password sesuai keinginan</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="toggle-group">
                                <div class="toggle-info">
                                    <h4>Notifikasi Email</h4>
                                    <p>Kirim pemberitahuan bahwa password akan direset</p>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" name="send_notification" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                    </label>

                    <!-- Method 2: Set Manual Password -->
                    <label class="method-option" for="method2">
                        <input type="radio" name="reset_method" id="method2" value="manual_password">
                        <div class="radio-check"></div>
                        <div class="method-header">
                            <div class="method-icon">
                                <i class="fas fa-key"></i>
                            </div>
                            <div class="method-info">
                                <h3>Atur Password Manual</h3>
                                <p>Tentukan password baru untuk user secara manual</p>
                            </div>
                        </div>
                        <div class="method-content">
                            <div class="form-group">
                                <label class="form-label">Password Baru</label>
                                <input type="password" name="manual_password" id="manualPassword" class="form-input" placeholder="Minimal 8 karakter">
                                <div class="password-strength" id="passwordStrength">
                                    <div class="strength-bar">
                                        <div class="strength-fill" id="strengthFill"></div>
                                    </div>
                                    <span class="strength-text" id="strengthText"></span>
                                </div>
                                <small class="form-hint">Pastikan password kuat dengan kombinasi huruf, angka & simbol</small>
                            </div>

                            <div class="toggle-group">
                                <div class="toggle-info">
                                    <h4>Wajib Ganti Password</h4>
                                    <p>User harus mengganti password saat login pertama kali</p>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" name="force_password_change" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>

                            <div class="toggle-group">
                                <div class="toggle-info">
                                    <h4>Kirim Password via Email</h4>
                                    <p>Informasikan password baru kepada user via email</p>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" name="send_password_email">
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                    </label>

                    <!-- Method 3: Generate Random Password -->
                    <label class="method-option" for="method3">
                        <input type="radio" name="reset_method" id="method3" value="generate_password">
                        <div class="radio-check"></div>
                        <div class="method-header">
                            <div class="method-icon">
                                <i class="fas fa-random"></i>
                            </div>
                            <div class="method-info">
                                <h3>Generate Password Otomatis</h3>
                                <p>Sistem akan membuat password acak yang kuat</p>
                            </div>
                        </div>
                        <div class="method-content">
                            <button type="button" class="btn-generate" onclick="generatePassword()">
                                <i class="fas fa-magic"></i> Generate Password Kuat
                            </button>

                            <div class="password-display" id="generatedPasswordBox">
                                <div class="password-value" id="generatedPassword">Klik tombol untuk generate</div>
                                <div class="password-actions">
                                    <button type="button" class="btn-copy" onclick="copyPassword()">
                                        <i class="fas fa-copy"></i> Copy Password
                                    </button>
                                    <button type="button" class="btn-copy" onclick="generatePassword()">
                                        <i class="fas fa-sync"></i> Generate Ulang
                                    </button>
                                </div>
                            </div>

                            <input type="hidden" name="generated_password" id="generatedPasswordInput">

                            <div class="toggle-group">
                                <div class="toggle-info">
                                    <h4>Kirim ke User via Email</h4>
                                    <p>Password akan dikirim ke email user</p>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" name="send_generated_email" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>

                            <div class="alert-box alert-warning">
                                <i class="fas fa-exclamation-triangle"></i>
                                <div>
                                    <strong>Perhatian:</strong> Pastikan Anda menyimpan password ini dengan aman atau langsung mengirimnya ke user.
                                </div>
                            </div>
                        </div>
                    </label>
                </div>

                <div style="margin-top: 24px; text-align: right;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check"></i> Reset Password Sekarang
                    </button>
                </div>
            </div>
        </div>
    </form>

    <!-- Activity Log -->
    <div class="activity-log" style="margin-top: 24px;">
        <div class="card-header">
            <h2>Riwayat Password</h2>
            <p>Log aktivitas reset password untuk user ini</p>
        </div>
        <div class="log-item">
            <div class="log-icon">
                <i class="fas fa-key"></i>
            </div>
            <div class="log-content">
                <div class="log-text">Password terakhir diubah oleh <strong>Admin</strong></div>
                <div class="log-time">12 Januari 2026, 14:30 WIB</div>
            </div>
        </div>
        <div class="log-item">
            <div class="log-icon">
                <i class="fas fa-envelope"></i>
            </div>
            <div class="log-content">
                <div class="log-text">Link reset password dikirim ke email</div>
                <div class="log-time">5 Januari 2026, 09:15 WIB</div>
            </div>
        </div>
        <div class="log-item">
            <div class="log-icon">
                <i class="fas fa-user-check"></i>
            </div>
            <div class="log-content">
                <div class="log-text">Akun dibuat dengan password awal</div>
                <div class="log-time">12 Januari 2026, 08:00 WIB</div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Handle Method Selection
    document.querySelectorAll('.method-option input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('.method-option').forEach(opt => {
                opt.classList.remove('active');
            });
            this.closest('.method-option').classList.add('active');
        });
    });

    // Password Strength Checker for Manual Password
    document.getElementById('manualPassword')?.addEventListener('input', function(e) {
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
        
        if (password.length >= 8) strength++;
        if (password.length >= 12) strength++;
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^a-zA-Z0-9]/.test(password)) strength++;
        
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

    // Generate Random Password
    function generatePassword() {
        const length = 16;
        const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*";
        let password = "";
        
        // Ensure at least one of each type
        password += "ABCDEFGHIJKLMNOPQRSTUVWXYZ"[Math.floor(Math.random() * 26)];
        password += "abcdefghijklmnopqrstuvwxyz"[Math.floor(Math.random() * 26)];
        password += "0123456789"[Math.floor(Math.random() * 10)];
        password += "!@#$%^&*"[Math.floor(Math.random() * 8)];
        
        // Fill the rest
        for (let i = password.length; i < length; i++) {
            password += charset.charAt(Math.floor(Math.random() * charset.length));
        }
        
        // Shuffle
        password = password.split('').sort(() => Math.random() - 0.5).join('');
        
        document.getElementById('generatedPassword').textContent = password;
        document.getElementById('generatedPasswordInput').value = password;
        document.getElementById('generatedPasswordBox').classList.add('show');
    }

    // Copy Password to Clipboard
    function copyPassword() {
        const password = document.getElementById('generatedPassword').textContent;
        
        if (password === 'Klik tombol untuk generate') {
            alert('Generate password terlebih dahulu!');
            return;
        }
        
        navigator.clipboard.writeText(password).then(() => {
            const btn = event.target.closest('.btn-copy');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check"></i> Berhasil Disalin!';
            btn.style.color = 'var(--primary-color)';
            
            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.style.color = '';
            }, 2000);
        }).catch(() => {
            alert('Gagal menyalin password!');
        });
    }

    // Form Validation
    document.getElementById('resetPasswordForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const method = document.querySelector('input[name="reset_method"]:checked').value;
        let isValid = true;
        let confirmMessage = '';
        
        if (method === 'send_link') {
            confirmMessage = '🔐 Kirim link reset password ke email user?\n\nUser: Aditya Pratama\nEmail: adit.pratama@gmail.com';
        } else if (method === 'manual_password') {
            const password = document.getElementById('manualPassword').value;
            if (!password || password.length < 8) {
                alert('⚠️ Password minimal 8 karakter!');
                return;
            }
            confirmMessage = '🔑 Set password manual untuk user ini?\n\nPassword akan langsung diubah.';
        } else if (method === 'generate_password') {
            const generatedPassword = document.getElementById('generatedPasswordInput').value;
            if (!generatedPassword) {
                alert('⚠️ Silakan generate password terlebih dahulu!');
                return;
            }
            confirmMessage = '🎲 Reset password dengan password yang di-generate?\n\nPastikan Anda sudah menyimpan passwordnya.';
        }
        
        if (confirm(confirmMessage)) {
            // Show loading
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
            submitBtn.disabled = true;
            
            // Simulate submission
            setTimeout(() => {
                alert('✅ Password berhasil direset!');
                window.location.href = '{{ route("admin.users.index") }}';
            }, 1500);
        }
    });
</script>
@endpush