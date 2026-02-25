<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - {{ config('app.name', 'ResuMate') }}</title>
    
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
        .forgot-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            position: relative;
            background: linear-gradient(135deg, var(--bg-body) 0%, var(--border-color) 100%);
        }

        .forgot-container {
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
        .forgot-branding {
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
        .forgot-illustration {
            width: 120px;
            height: 120px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
        }
        .forgot-illustration i {
            font-size: 60px;
            color: white;
        }

        /* --- RIGHT SIDE: FORM --- */
        .forgot-form-container {
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .forgot-header { margin-bottom: 40px; }
        .forgot-header h1 { font-size: 32px; font-weight: 700; color: var(--text-main); margin-bottom: 8px; }
        .forgot-header p { color: var(--text-secondary); font-size: 15px; line-height: 1.6; }

        /* Alert Info */
        .alert-info {
            background: rgba(76, 175, 80, 0.1);
            border-left: 4px solid var(--primary-color);
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 30px;
            display: flex;
            gap: 12px;
        }
        .alert-info i {
            color: var(--primary-color);
            font-size: 20px;
            flex-shrink: 0;
        }
        .alert-info p {
            font-size: 14px;
            color: var(--text-secondary);
            margin: 0;
        }

        /* Form Elements */
        .form-group { margin-bottom: 24px; }
        
        .form-label {
            display: block; font-size: 14px; font-weight: 600; 
            color: var(--text-main); margin-bottom: 8px;
        }

        .form-input {
            width: 100%; padding: 14px 16px;
            border: 2px solid var(--border-color);
            border-radius: 10px; font-size: 15px;
            color: var(--text-main); 
            background: var(--input-bg);
            transition: all 0.3s;
        }

        .form-input:focus {
            outline: none; border-color: var(--primary-color);
            background: var(--bg-card);
            box-shadow: 0 0 0 4px rgba(76, 175, 80, 0.1);
        }

        /* Button */
        .btn-submit {
            width: 100%; padding: 14px; background: var(--primary-color);
            color: white; border: none; border-radius: 10px;
            font-size: 16px; font-weight: 600; cursor: pointer;
            transition: all 0.3s; box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
        }
        .btn-submit:hover { background: var(--primary-hover); transform: translateY(-2px); }

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
            .forgot-container { grid-template-columns: 1fr; max-width: 500px; }
            .forgot-branding { display: none; }
            .forgot-form-container { padding: 50px 30px; }
        }
    </style>
</head>
<body>

    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme) {
                document.documentElement.setAttribute('data-theme', savedTheme);
            } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.setAttribute('data-theme', 'dark');
            }
        })();
    </script>

    <div class="forgot-page">
        <div class="forgot-container">
            
            <!-- LEFT SIDE: BRANDING -->
            <div class="forgot-branding">
                <div class="branding-content">
                    <div class="branding-logo">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    
                    <div class="forgot-illustration">
                        <i class="fas fa-lock"></i>
                    </div>
                    
                    <h2>Lupa Password?</h2>
                    <p>Jangan khawatir! Kami akan mengirimkan kode verifikasi ke email Anda untuk reset password.</p>
                </div>
            </div>

            <!-- RIGHT SIDE: FORM -->
            <div class="forgot-form-container">
                <div class="forgot-header">
                    <h1>Reset Password</h1>
                    <p>Masukkan alamat email Anda dan kami akan mengirimkan kode OTP untuk reset password.</p>
                </div>

                <div class="alert-info">
                    <i class="fas fa-info-circle"></i>
                    <p>Pastikan email yang Anda masukkan adalah email yang terdaftar di akun ResuMate Anda.</p>
                </div>

                <form action="#" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label class="form-label">Alamat Email</label>
                        <input type="email" name="email" class="form-input" placeholder="nama@email.com" required autofocus>
                    </div>

                    <button type="submit" class="btn-submit">
                        <i class="fas fa-paper-plane"></i> Kirim Kode OTP
                    </button>

                    <a href="{{ route('login') }}" style="text-decoration: none;">
                        <button type="button" class="btn-back">
                            <i class="fas fa-arrow-left"></i> Kembali ke Login
                        </button>
                    </a>
                </form>

                <div style="text-align: center; margin-top: 30px; font-size: 14px; color: var(--text-secondary);">
                    Tidak menerima email? <a href="#" style="color: var(--primary-color); font-weight: 600; text-decoration: none;">Kirim ulang kode</a>
                </div>
            </div>

        </div>
    </div>

</body>
</html>