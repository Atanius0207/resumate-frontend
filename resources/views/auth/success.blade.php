<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modal Variations - ResuMate</title>
    
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* --- VARIABLES --- */
        :root {
            --success-color: #4CAF50;
            --error-color: #f44336;
            --warning-color: #ff9800;
            --info-color: #2196F3;
            --bg-card: #FFFFFF;
            --text-main: #333333;
            --text-secondary: #666666;
            --border-color: #E5E5E5;
            --input-bg: #FAFAFA;
            --shadow-color: rgba(0, 0, 0, 0.1);
        }

        [data-theme="dark"] {
            --bg-card: #1E1E1E;
            --text-main: #E0E0E0;
            --text-secondary: #A0A0A0;
            --border-color: #333333;
            --input-bg: #2C2C2C;
            --shadow-color: rgba(0, 0, 0, 0.5);
        }

        /* --- BASE --- */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Inter', sans-serif;
            background: rgba(0, 0, 0, 0.6);
            color: var(--text-main);
            line-height: 1.5;
            padding: 40px 20px;
            min-height: 100vh;
        }

        /* --- LAYOUT GRID --- */
        .modal-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(480px, 1fr));
            gap: 40px;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* --- MODAL CARD --- */
        .modal-card {
            background: var(--bg-card);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px var(--shadow-color);
            border: 1px solid var(--border-color);
        }

        /* --- MODAL ICONS --- */
        .modal-icon {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            position: relative;
            animation: bounceIn 0.6s ease;
        }

        .modal-icon i {
            font-size: 50px;
            color: white;
        }

        .modal-icon::after {
            content: '';
            position: absolute;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            opacity: 0.3;
            animation: ripple 1.5s infinite;
        }

        /* Success */
        .modal-icon.success {
            background: linear-gradient(135deg, var(--success-color) 0%, #45a049 100%);
        }
        .modal-icon.success::after {
            border: 3px solid var(--success-color);
        }

        /* Error */
        .modal-icon.error {
            background: linear-gradient(135deg, var(--error-color) 0%, #d32f2f 100%);
        }
        .modal-icon.error::after {
            border: 3px solid var(--error-color);
        }

        /* Warning */
        .modal-icon.warning {
            background: linear-gradient(135deg, var(--warning-color) 0%, #f57c00 100%);
        }
        .modal-icon.warning::after {
            border: 3px solid var(--warning-color);
        }

        /* Info */
        .modal-icon.info {
            background: linear-gradient(135deg, var(--info-color) 0%, #1976D2 100%);
        }
        .modal-icon.info::after {
            border: 3px solid var(--info-color);
        }

        /* --- ANIMATIONS --- */
        @keyframes bounceIn {
            0% { transform: scale(0); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @keyframes ripple {
            0% { transform: scale(1); opacity: 0.3; }
            100% { transform: scale(1.3); opacity: 0; }
        }

        /* --- TEXT --- */
        .modal-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-main);
            text-align: center;
            margin-bottom: 15px;
        }

        .modal-message {
            font-size: 15px;
            color: var(--text-secondary);
            text-align: center;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        /* --- BUTTONS --- */
        .modal-buttons {
            display: flex;
            gap: 12px;
        }

        .btn-modal {
            flex: 1;
            padding: 14px;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-modal.success {
            background: linear-gradient(135deg, var(--success-color) 0%, #45a049 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
        }

        .btn-modal.error {
            background: linear-gradient(135deg, var(--error-color) 0%, #d32f2f 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(244, 67, 54, 0.3);
        }

        .btn-modal.warning {
            background: linear-gradient(135deg, var(--warning-color) 0%, #f57c00 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(255, 152, 0, 0.3);
        }

        .btn-modal.info {
            background: linear-gradient(135deg, var(--info-color) 0%, #1976D2 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(33, 150, 243, 0.3);
        }

        .btn-modal.secondary {
            background: transparent;
            color: var(--text-secondary);
            border: 2px solid var(--border-color);
        }

        .btn-modal:hover {
            transform: translateY(-2px);
        }

        .btn-modal.secondary:hover {
            border-color: var(--success-color);
            color: var(--success-color);
        }

        /* --- SINGLE BUTTON --- */
        .btn-modal.full-width {
            width: 100%;
        }

        /* --- INFO BOX --- */
        .info-box {
            background: var(--input-bg);
            border: 1px solid var(--border-color);
            border-left: 4px solid var(--info-color);
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 20px;
            font-size: 14px;
            color: var(--text-secondary);
            line-height: 1.5;
        }

        /* --- COUNTDOWN --- */
        .countdown-box {
            background: var(--input-bg);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
            text-align: center;
        }

        .countdown-box p {
            font-size: 14px;
            color: var(--text-secondary);
            margin: 0 0 10px;
        }

        .countdown {
            font-size: 48px;
            font-weight: 800;
            color: var(--success-color);
            font-family: 'Courier New', Courier, monospace;
        }

        /* --- THEME TOGGLE --- */
        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--bg-card);
            border: 2px solid var(--border-color);
            border-radius: 10px;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 20px;
            color: var(--text-main);
            z-index: 10000;
            transition: all 0.3s;
        }

        .theme-toggle:hover {
            transform: scale(1.1);
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 1024px) {
            .modal-grid {
                grid-template-columns: 1fr;
                max-width: 600px;
            }
        }

        @media (max-width: 480px) {
            .modal-card {
                padding: 30px 25px;
            }
            .modal-icon {
                width: 80px;
                height: 80px;
            }
            .modal-icon i {
                font-size: 40px;
            }
            .modal-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme) {
                document.documentElement.setAttribute('data-theme', savedTheme);
            }
        })();
    </script>

    <!-- Theme Toggle -->
    <button class="theme-toggle" id="themeToggle">
        <i class="fas fa-moon"></i>
    </button>

    <!-- Modal Grid -->
    <div class="modal-grid">

        <!-- 1. SUCCESS MODAL - Password Reset -->
        <div class="modal-card">
            <div class="modal-icon success">
                <i class="fas fa-check"></i>
            </div>
            <h2 class="modal-title">Password Berhasil Direset!</h2>
            <p class="modal-message">
                Password Anda telah berhasil diperbarui. Anda sekarang dapat login menggunakan password baru Anda.
            </p>
            <div class="countdown-box">
                <p>Anda akan dialihkan ke halaman login dalam</p>
                <div class="countdown">5</div>
            </div>
            <div class="modal-buttons">
                <button class="btn-modal success">
                    <i class="fas fa-sign-in-alt"></i> Login Sekarang
                </button>
                <button class="btn-modal secondary">
                    <i class="fas fa-times"></i> Tutup
                </button>
            </div>
        </div>

        <!-- 2. ERROR MODAL - Password Reset Failed -->
        <div class="modal-card">
            <div class="modal-icon error">
                <i class="fas fa-times"></i>
            </div>
            <h2 class="modal-title">Reset Password Gagal!</h2>
            <p class="modal-message">
                Terjadi kesalahan saat mereset password Anda. Link verifikasi mungkin sudah kadaluarsa atau tidak valid.
            </p>
            <div class="info-box">
                <strong>Error:</strong> Token verifikasi tidak valid atau sudah kadaluarsa.
            </div>
            <div class="modal-buttons">
                <button class="btn-modal error">
                    <i class="fas fa-redo"></i> Kirim Ulang Link
                </button>
                <button class="btn-modal secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </button>
            </div>
        </div>

        <!-- 3. WARNING MODAL - Account Security -->

        <!-- 4. INFO MODAL - Email Verification -->
        <div class="modal-card">
            <div class="modal-icon info">
                <i class="fas fa-envelope"></i>
            </div>
            <h2 class="modal-title">Email Verifikasi Terkirim!</h2>
            <p class="modal-message">
                Kami telah mengirimkan kode verifikasi ke email Anda. Silakan cek inbox atau folder spam.
            </p>
            <div class="info-box">
                Email dikirim ke: <strong>user@example.com</strong><br>
                Kode akan kadaluarsa dalam 15 menit.
            </div>
            <button class="btn-modal info full-width">
                <i class="fas fa-check"></i> Mengerti
            </button>
        </div>

        <!-- 5. SUCCESS MODAL - Account Created -->
        <div class="modal-card">
            <div class="modal-icon success">
                <i class="fas fa-user-check"></i>
            </div>
            <h2 class="modal-title">Akun Berhasil Dibuat!</h2>
            <p class="modal-message">
                Selamat! Akun ResuMate Anda telah berhasil dibuat. Mulai buat CV profesional Anda sekarang.
            </p>
            <div class="modal-buttons">
                <button class="btn-modal success">
                    <i class="fas fa-rocket"></i> Mulai Sekarang
                </button>
                <button class="btn-modal secondary">
                    <i class="fas fa-home"></i> Ke Beranda
                </button>
            </div>
        </div>

    </div>

    <script>
        // Theme Toggle
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = themeToggle.querySelector('i');

        themeToggle.addEventListener('click', function() {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            
            if (newTheme === 'dark') {
                themeIcon.className = 'fas fa-sun';
            } else {
                themeIcon.className = 'fas fa-moon';
            }
        });

        // Countdown animation
        let countdown = 5;
        const countdownEl = document.querySelector('.countdown');
        
        setInterval(() => {
            countdown--;
            if (countdown < 0) countdown = 5;
            if (countdownEl) countdownEl.textContent = countdown;
        }, 1000);
    </script>

</body>
</html>