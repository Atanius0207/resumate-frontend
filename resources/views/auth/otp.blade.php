<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP -  ResuMate</title>
    
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* --- 1. DEFINISI VARIABEL TEMA --- */
        :root {
            /* Default: LIGHT MODE */
            --primary-color: #4CAF50;
            --primary-hover: #45a049;
            --bg-body: #F7F7F7;       
            --bg-card: #FFFFFF;       
            --text-main: #333333;     
            --text-secondary: #666666; 
            --border-color: #E5E5E5;
            --input-bg: #FAFAFA;
            --shadow-color: rgba(0, 0, 0, 0.1);
        }

        /* Override untuk DARK MODE */
        [data-theme="dark"] {
            --bg-body: #121212;       
            --bg-card: #1E1E1E;       
            --text-main: #E0E0E0;     
            --text-secondary: #A0A0A0;
            --border-color: #333333;
            --input-bg: #2C2C2C;
            --shadow-color: rgba(0, 0, 0, 0.5);
        }

        /* --- 2. BASE STYLES --- */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: var(--bg-body); color: var(--text-main); line-height: 1.5; transition: background 0.3s, color 0.3s; }

        /* --- 3. LAYOUT --- */
        .otp-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            position: relative;
            background: linear-gradient(135deg, var(--bg-body) 0%, var(--border-color) 100%);
        }

        .otp-container {
            max-width: 1100px;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: var(--bg-card);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px var(--shadow-color);
            position: relative;
            z-index: 1;
            border: 1px solid var(--border-color);
        }

        /* --- LEFT SIDE: BRANDING (Static Green) --- */
        .otp-branding {
            background: linear-gradient(135deg, var(--primary-color) 0%, #2E7D32 100%);
            padding: 60px 50px;
            display: flex; flex-direction: column; justify-content: center; align-items: center;
            text-align: center; color: white; position: relative; overflow: hidden;
        }

        .branding-content { position: relative; z-index: 2; }
        .branding-logo {
            width: 80px; height: 80px; background: white;
            border-radius: 20px; display: flex; align-items: center; justify-content: center;
            margin: 0 auto 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .branding-logo i { font-size: 40px; color: var(--primary-color); }

        .branding-content h2 { font-size: 32px; font-weight: 800; margin-bottom: 20px; line-height: 1.2; }
        .branding-content p { font-size: 16px; opacity: 0.9; margin-bottom: 40px; line-height: 1.6; }

        /* Icon Illustration */
        .otp-illustration {
            width: 120px;
            height: 120px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            animation: pulse 2s infinite;
        }
        .otp-illustration i {
            font-size: 60px;
            color: white;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        /* --- RIGHT SIDE: FORM --- */
        .otp-form-container {
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .otp-header { margin-bottom: 40px; text-align: center; }
        .otp-header h1 { font-size: 32px; font-weight: 700; color: var(--text-main); margin-bottom: 8px; }
        .otp-header p { color: var(--text-secondary); font-size: 15px; line-height: 1.6; }
        .otp-header .email-sent { 
            color: var(--primary-color); 
            font-weight: 600; 
            margin-top: 8px;
            display: block;
        }

        /* Alert Success */
        .alert-success {
            background: rgba(76, 175, 80, 0.1);
            border-left: 4px solid var(--primary-color);
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 30px;
            display: flex;
            gap: 12px;
        }
        .alert-success i {
            color: var(--primary-color);
            font-size: 20px;
            flex-shrink: 0;
        }
        .alert-success p {
            font-size: 14px;
            color: var(--text-secondary);
            margin: 0;
        }

        /* OTP Input Container */
        .otp-input-container {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin: 30px 0;
        }

        .otp-input {
            width: 60px;
            height: 60px;
            text-align: center;
            font-size: 24px;
            font-weight: 700;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            background: var(--input-bg);
            color: var(--text-main);
            transition: all 0.3s;
        }

        .otp-input:focus {
            outline: none;
            border-color: var(--primary-color);
            background: var(--bg-card);
            box-shadow: 0 0 0 4px rgba(76, 175, 80, 0.1);
        }

        .otp-input::-webkit-inner-spin-button,
        .otp-input::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Timer */
        .otp-timer {
            text-align: center;
            margin: 20px 0;
            font-size: 14px;
            color: var(--text-secondary);
        }
        .otp-timer .time {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 16px;
        }

        /* Resend Link */
        .resend-container {
            text-align: center;
            margin: 20px 0;
            font-size: 14px;
            color: var(--text-secondary);
        }
        .resend-link {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: 0.3s;
        }
        .resend-link:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }
        .resend-link.disabled {
            color: var(--text-secondary);
            cursor: not-allowed;
            opacity: 0.5;
        }

        /* Button */
        .btn-verify {
            width: 100%; padding: 14px; background: var(--primary-color);
            color: white; border: none; border-radius: 10px;
            font-size: 16px; font-weight: 600; cursor: pointer;
            transition: all 0.3s; box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
            margin-top: 20px;
        }
        .btn-verify:hover { background: var(--primary-hover); transform: translateY(-2px); }
        .btn-verify:disabled {
            background: var(--border-color);
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .btn-back {
            width: 100%; padding: 14px; background: transparent;
            color: var(--text-secondary); border: 2px solid var(--border-color);
            border-radius: 10px; font-size: 16px; font-weight: 600; 
            cursor: pointer; transition: all 0.3s; margin-top: 15px;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        .btn-back:hover { 
            border-color: var(--primary-color); 
            color: var(--primary-color); 
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 1024px) {
            .otp-container { grid-template-columns: 1fr; max-width: 500px; }
            .otp-branding { display: none; }
            .otp-form-container { padding: 50px 30px; }
        }

        @media (max-width: 480px) {
            .otp-input {
                width: 50px;
                height: 50px;
                font-size: 20px;
            }
            .otp-input-container {
                gap: 8px;
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
            } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches) {
                document.documentElement.setAttribute('data-theme', 'light');
            }
        })();
    </script>

    <div class="otp-page">
        <div class="otp-container">
            
            <!-- LEFT SIDE: BRANDING -->
            <div class="otp-branding">
                <div class="branding-content">
                    <div class="branding-logo">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    
                    <div class="otp-illustration">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    
                    <h2>Verifikasi Keamanan</h2>
                    <p>Kami telah mengirimkan kode verifikasi 6 digit ke email Anda untuk memastikan keamanan akun.</p>
                </div>
            </div>

            <!-- RIGHT SIDE: FORM -->
            <div class="otp-form-container">
                <div class="otp-header">
                    <h1>Masukkan Kode OTP</h1>
                    <p>Kode verifikasi telah dikirim ke:</p>
                    <span class="email-sent">user@example.com</span>
                </div>

                <div class="alert-success">
                    <i class="fas fa-check-circle"></i>
                    <p>Kode OTP berhasil dikirim! Silakan cek inbox atau folder spam email Anda.</p>
                </div>

                <form action="#" method="POST" id="otpForm">
                    
                    <div class="otp-input-container">
                        <input type="number" class="otp-input" maxlength="1" pattern="\d" inputmode="numeric" id="otp1" required>
                        <input type="number" class="otp-input" maxlength="1" pattern="\d" inputmode="numeric" id="otp2" required>
                        <input type="number" class="otp-input" maxlength="1" pattern="\d" inputmode="numeric" id="otp3" required>
                        <input type="number" class="otp-input" maxlength="1" pattern="\d" inputmode="numeric" id="otp4" required>
                        <input type="number" class="otp-input" maxlength="1" pattern="\d" inputmode="numeric" id="otp5" required>
                        <input type="number" class="otp-input" maxlength="1" pattern="\d" inputmode="numeric" id="otp6" required>
                    </div>

                    <input type="hidden" name="otp_code" id="otpCode">

                    <div class="otp-timer">
                        Kode akan kadaluarsa dalam <span class="time" id="timer">05:00</span>
                    </div>

                    <div class="resend-container">
                        Tidak menerima kode? 
                        <a href="#" class="resend-link disabled" id="resendLink">Kirim ulang kode</a>
                    </div>

                    <button type="submit" class="btn-verify" id="verifyBtn" disabled>
                        <i class="fas fa-check"></i> Verifikasi Kode
                    </button>

                    <a href="{{ route('forgot-password') }}" style="text-decoration: none;">
                        <button type="button" class="btn-back">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </button>
                    </a>
                </form>
            </div>

        </div>
    </div>

    <script>
        // OTP Input Handler
        const otpInputs = document.querySelectorAll('.otp-input');
        const otpForm = document.getElementById('otpForm');
        const verifyBtn = document.getElementById('verifyBtn');
        const otpCodeInput = document.getElementById('otpCode');

        otpInputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                // Hanya izinkan satu digit
                if (e.target.value.length > 1) {
                    e.target.value = e.target.value.slice(0, 1);
                }

                // Auto focus ke input selanjutnya
                if (e.target.value && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }

                // Check if all inputs are filled
                checkOTPComplete();
            });

            input.addEventListener('keydown', (e) => {
                // Handle backspace
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    otpInputs[index - 1].focus();
                }

                // Handle arrow keys
                if (e.key === 'ArrowLeft' && index > 0) {
                    otpInputs[index - 1].focus();
                }
                if (e.key === 'ArrowRight' && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
            });

            // Paste handler
            input.addEventListener('paste', (e) => {
                e.preventDefault();
                const pastedData = e.clipboardData.getData('text').trim();
                
                if (/^\d{6}$/.test(pastedData)) {
                    pastedData.split('').forEach((char, i) => {
                        if (otpInputs[i]) {
                            otpInputs[i].value = char;
                        }
                    });
                    otpInputs[5].focus();
                    checkOTPComplete();
                }
            });
        });

        function checkOTPComplete() {
            const allFilled = Array.from(otpInputs).every(input => input.value.length === 1);
            verifyBtn.disabled = !allFilled;

            if (allFilled) {
                const otpCode = Array.from(otpInputs).map(input => input.value).join('');
                otpCodeInput.value = otpCode;
            }
        }

        // Timer Countdown
        let timeLeft = 300; // 5 minutes in seconds
        const timerElement = document.getElementById('timer');
        const resendLink = document.getElementById('resendLink');

        function updateTimer() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            timerElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

            if (timeLeft === 0) {
                clearInterval(timerInterval);
                resendLink.classList.remove('disabled');
                timerElement.textContent = '00:00';
                timerElement.parentElement.innerHTML = '<span style="color: var(--text-secondary);">Kode telah kadaluarsa</span>';
            }

            timeLeft--;
        }

        const timerInterval = setInterval(updateTimer, 1000);
        updateTimer();

        // Resend OTP Handler
        resendLink.addEventListener('click', (e) => {
            e.preventDefault();
            
            if (!resendLink.classList.contains('disabled')) {
                // Reset timer
                timeLeft = 300;
                resendLink.classList.add('disabled');
                updateTimer();
                
                // Clear inputs
                otpInputs.forEach(input => input.value = '');
                otpInputs[0].focus();
                verifyBtn.disabled = true;

                // Simulate resend (replace with actual AJAX call)
                alert('Kode OTP baru telah dikirim ke email Anda!');
            }
        });

        // Auto-focus first input on page load
        window.addEventListener('load', () => {
            otpInputs[0].focus();
        });
    </script>

</body>
</html>