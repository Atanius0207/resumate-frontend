<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="YiCMi0wa0O7fXCik8yFpUFii6fo85mXwTWDF2AFP">
    <title>ResuMate - Buat CV Profesional & Mudah</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --primary-color: #4CAF50;
            --primary-hover: #45a049;
            --bg-body: #F7F7F7;
            --bg-card: #FFFFFF;
            --bg-nav: #FFFFFF;
            --text-main: #333333;
            --text-secondary: #666666;
            --border-color: #E5E5E5;
            --shadow-color: rgba(0, 0, 0, 0.05);
            --feature-icon-bg: #F1F8F4;
            --template-preview-bg: #F5F5F5;
        }

        [data-theme="dark"] {
            --primary-color: #4CAF50;
            --primary-hover: #66BB6A;
            --bg-body: #121212;
            --bg-card: #1E1E1E;
            --bg-nav: #1E1E1E;
            --text-main: #E0E0E0;
            --text-secondary: #A0A0A0;
            --border-color: #333333;
            --shadow-color: rgba(0, 0, 0, 0.3);
            --feature-icon-bg: #2C3E30;
            --template-preview-bg: #2A2A2A;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main { flex: 1; }

        nav {
            background: var(--bg-nav);
            padding: 20px 0;
            box-shadow: 0 1px 3px var(--shadow-color);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid var(--border-color);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 20px;
            font-weight: 600;
            color: var(--text-main);
            text-decoration: none;
        }

        .logo-icon { width: 32px; height: 32px; }

        nav ul {
            display: flex;
            list-style: none;
            gap: 30px;
            align-items: center;
        }

        nav a {
            text-decoration: none;
            color: var(--text-secondary);
            font-weight: 500;
            font-size: 15px;
            transition: color 0.3s;
        }

        nav a:hover { color: var(--primary-color); }
        nav a.active { color: var(--primary-color); font-weight: 600; }

        .btn-register {
            background: var(--primary-color);
            color: white !important;
            padding: 10px 24px;
            border-radius: 4px;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.3s;
            font-size: 15px;
        }

        .btn-register:hover { background: var(--primary-hover); }

        .theme-toggle-btn {
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-main);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            margin-left: 10px;
        }
        .theme-toggle-btn:hover { background-color: var(--bg-body); }

        .mobile-menu-toggle {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 8px;
        }

        .mobile-menu-toggle span {
            width: 25px;
            height: 3px;
            background: var(--text-main);
            border-radius: 2px;
            transition: all 0.3s;
        }

        .hero-section {
            background: var(--bg-body);
            padding: 80px 0 100px;
        }

        .hero-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 40px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
        }

        .hero-text h1 {
            font-size: 40px;
            font-weight: 600;
            line-height: 1.3;
            color: var(--text-main);
            margin-bottom: 20px;
        }

        .hero-text h1 .green-text { color: var(--primary-color); }

        .hero-text p {
            font-size: 16px;
            line-height: 1.7;
            color: var(--text-secondary);
            margin-bottom: 30px;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
            padding: 12px 32px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary:hover { background: var(--primary-hover); }

        .stats-section {
            background: var(--bg-card);
            padding: 80px 0;
            position: relative;
            border-bottom: 1px solid var(--border-color);
        }

        .stats-container { max-width: 1200px; margin: 0 auto; padding: 0 40px; }
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; }

        .stat-item {
            background: var(--bg-card);
            padding: 32px 24px;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-4px);
            border-color: var(--primary-color);
            box-shadow: 0 8px 24px rgba(76, 175, 80, 0.12);
        }

        .stat-icon {
            width: 48px; height: 48px;
            background: var(--feature-icon-bg);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 16px;
            color: var(--primary-color);
            font-size: 20px;
        }

        .stat-item h3 {
            font-size: 42px; font-weight: 700; color: var(--text-main); margin-bottom: 4px; line-height: 1;
        }
        .stat-item h3 span { color: var(--primary-color); }
        .stat-item p { font-size: 15px; color: var(--text-secondary); font-weight: 500; }

        .popular-templates-section { background: var(--bg-card); padding: 100px 0; }
        .templates-container { max-width: 1200px; margin: 0 auto; padding: 0 40px; }
        
        .templates-header { text-align: center; margin-bottom: 60px; }
        .templates-header .section-tag {
            display: inline-block;
            background: var(--bg-card);
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 14px; font-weight: 600; color: var(--primary-color);
            margin-bottom: 16px;
            border: 1px solid var(--border-color);
        }
        .templates-header h2 { font-size: 36px; font-weight: 600; color: var(--text-main); margin-bottom: 12px; }
        .templates-header p { font-size: 16px; color: var(--text-secondary); max-width: 600px; margin: 0 auto; }

        .templates-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 32px; }

        .template-card {
            background: var(--bg-card);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 12px var(--shadow-color);
            transition: all 0.3s ease;
            position: relative;
            cursor: pointer;
            border: 1px solid var(--border-color);
        }
        .template-card:hover { transform: translateY(-8px); box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12); }

        .template-preview {
            width: 100%; height: 380px;
            background: var(--template-preview-bg);
            position: relative; display: flex; align-items: center; justify-content: center;
        }
        .template-preview::before {
            content: ''; position: absolute; top: 20px; left: 20px; right: 20px; bottom: 20px;
            background: var(--bg-card); border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        .template-preview-text { position: relative; z-index: 1; font-size: 14px; color: var(--text-secondary); font-weight: 500; }

        .template-badge {
            position: absolute; top: 16px; right: 16px; background: var(--primary-color);
            color: white; padding: 6px 14px; border-radius: 6px; font-size: 11px; font-weight: 700; text-transform: uppercase; z-index: 2;
        }
        .template-badge.premium { background: linear-gradient(135deg, #FFB74D, #FF9800); }
        .template-badge.new { background: linear-gradient(135deg, #42A5F5, #2196F3); }

        .template-info { padding: 24px; }
        .template-info h3 { font-size: 20px; font-weight: 600; color: var(--text-main); margin-bottom: 8px; }
        .template-info p { font-size: 14px; color: var(--text-secondary); margin-bottom: 16px; line-height: 1.5; }

        .template-meta {
            display: flex; justify-content: space-between; align-items: center;
            padding-top: 16px; border-top: 1px solid var(--border-color);
        }
        .template-stats { display: flex; gap: 16px; font-size: 13px; color: var(--text-secondary); }
        .template-stats i { color: var(--primary-color); }
        .template-action { color: var(--primary-color); font-size: 14px; font-weight: 600; text-decoration: none; }

        .view-all-templates { text-align: center; margin-top: 48px; }
        .btn-outline {
            display: inline-block; padding: 14px 32px;
            border: 2px solid var(--primary-color); border-radius: 8px;
            color: var(--primary-color); font-weight: 600; text-decoration: none; transition: all 0.3s ease;
        }
        .btn-outline:hover { background: var(--primary-color); color: white; }

        .features-section { background: var(--bg-body); padding: 80px 0; }
        .features-container { max-width: 1200px; margin: 0 auto; padding: 0 40px; }
        .section-header h2 { color: var(--text-main); }
        .section-header p { color: var(--text-secondary); }

        .features-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 40px; }
        .feature-card {
            background: var(--bg-card);
            padding: 40px 30px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 2px 8px var(--shadow-color);
            transition: all 0.3s;
            border: 1px solid var(--border-color);
        }
        .feature-card:hover { transform: translateY(-5px); box-shadow: 0 4px 16px rgba(0,0,0,0.1); }

        .feature-icon {
            width: 80px; height: 80px;
            background: var(--feature-icon-bg);
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 20px;
            font-size: 36px; color: var(--primary-color);
        }
        .feature-card h3 { font-size: 20px; font-weight: 600; color: var(--text-main); margin-bottom: 12px; }
        .feature-card p { font-size: 15px; line-height: 1.6; color: var(--text-secondary); }

        .cta-section { background: var(--primary-color); padding: 80px 0; text-align: center; color: white; }
        .cta-container { max-width: 800px; margin: 0 auto; padding: 0 40px; }
        .cta-section h2 { font-size: 40px; font-weight: 600; margin-bottom: 16px; color: white; }
        .cta-section p { font-size: 18px; margin-bottom: 30px; opacity: 0.95; color: white; }
        
        .btn-white {
            background: white; color: var(--primary-color); padding: 14px 36px;
            border: none; border-radius: 4px; font-size: 16px; font-weight: 600;
            cursor: pointer; transition: all 0.3s; text-decoration: none; display: inline-block;
        }
        .btn-white:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.15); }

        footer {
            background: #2C2C2C; 
            color: white; padding: 60px 0 30px; margin-top: auto;
        }
        [data-theme="dark"] footer { background: #151515; }

        .footer-container { max-width: 1200px; margin: 0 auto; padding: 0 40px; }
        .footer-content { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 50px; margin-bottom: 40px; }
        
        .footer-logo { font-size: 22px; font-weight: 600; margin-bottom: 16px; color: white; }
        .footer-desc { font-size: 14px; line-height: 1.7; color: #B0B0B0; margin-bottom: 20px; }
        .footer-column h4 { font-size: 16px; font-weight: 600; margin-bottom: 20px; color: white; }
        .footer-column ul { list-style: none; }
        .footer-column ul li { margin-bottom: 12px; }
        .footer-column a { color: #B0B0B0; text-decoration: none; font-size: 14px; transition: color 0.3s; }
        .footer-column a:hover { color: var(--primary-color); }
        .footer-bottom { padding-top: 30px; border-top: 1px solid #444; text-align: center; color: #888; font-size: 14px; }

        #backToTop {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1001;
        }
        #backToTop.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        #backToTop:hover {
            background-color: var(--primary-hover);
            transform: translateY(-5px);
        }

        /* --- RESPONSIVE MEDIA QUERIES --- */
        @media (max-width: 968px) {
            .nav-container { padding: 0 20px; }
            
            nav ul {
                display: none;
                position: absolute;
                top: 80px;
                left: 0;
                right: 0;
                background: var(--bg-nav);
                flex-direction: column;
                padding: 20px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                gap: 20px;
                border-bottom: 1px solid var(--border-color);
            }
            
            nav ul.active { display: flex; }
            .mobile-menu-toggle { display: flex; }
            
            .hero-container { grid-template-columns: 1fr; gap: 40px; text-align: center; }
            .hero-text { order: 1; }
            .hero-image { order: 0; }
            
            .stats-grid, .features-grid, .templates-grid { grid-template-columns: 1fr; }
            .footer-content { grid-template-columns: 1fr; gap: 30px; }
            .footer-container { padding: 0 20px; }
            
            .hero-text h1 { font-size: 32px; }
            .section-header h2 { font-size: 28px; }
        }
    </style>
</head>
<body>

    <nav>
        <div class="nav-container">
            <a href="#" class="logo">
                <svg class="logo-icon" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16 2L4 8V24L16 30L28 24V8L16 2Z" fill="var(--primary-color)"/>
                    <path d="M16 2L28 8V24L16 30" fill="var(--primary-hover)"/>
                </svg>
                <span>ResuMate</span>
            </a>

            <div style="display: flex; align-items: center; gap: 15px;">
                <ul id="navMenu">
                    <li><a href="#" class="active">Home</a></li>
                    <li><a href="#" class="">Features</a></li>
                    <li><a href="#" class="">Templates</a></li>
                    <li><a href="#" class="">Pricing</a></li>
                    <li><a href="#" class="">Blog</a></li>
                    <li><a href="{{ route('login') }}"">Login</a></li>
                    <li><a href="#" class="btn-register">Register Now →</a></li>
                </ul>

                <button class="theme-toggle-btn" id="themeToggle" title="Ganti Tema">
                    <i class="fas fa-moon"></i>
                </button>

                <div class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </nav>

    <button id="backToTop" onclick="scrollToTop()">
        <i class="fas fa-arrow-up"></i>
    </button>

    <main>
        <section class="hero-section">
            <div class="hero-container">
                <div class="hero-text">
                    <h1>
                        CV Profesional. Cepat. Mudah.<br>
                        <span class="green-text">Buat CV online dengan template modern dan siap dikirim hari ini.</span>
                    </h1>
                    <p>
                        Template CV standar yang kami sediakan tidak hanya menarik dan terlihat profesional di mata recruiter.
                    </p>
                    <a href="/login" class="btn-primary">Register</a>
                </div>
                <div class="hero-image">
                    <svg width="500" height="400" viewBox="0 0 500 400" fill="none" xmlns="http://www.w3.org/2000/svg" style="max-width: 100%; height: auto;">
                        <rect x="80" y="60" width="340" height="240" rx="8" fill="#E8F5E9"/>
                        <rect x="95" y="75" width="310" height="200" rx="4" fill="white"/>
                        <rect x="120" y="95" width="120" height="160" rx="4" fill="#F5F5F5"/>
                        <rect x="130" y="105" width="40" height="40" rx="20" fill="#4CAF50"/>
                        <rect x="130" y="155" width="90" height="8" rx="4" fill="#E0E0E0"/>
                        <rect x="130" y="170" width="70" height="6" rx="3" fill="#E8E8E8"/>
                        <rect x="130" y="185" width="100" height="4" rx="2" fill="#EEEEEE"/>
                        <rect x="130" y="194" width="95" height="4" rx="2" fill="#EEEEEE"/>
                        <rect x="130" y="203" width="85" height="4" rx="2" fill="#EEEEEE"/>
                        <rect x="255" y="95" width="120" height="160" rx="4" fill="#F5F5F5"/>
                        <rect x="265" y="105" width="40" height="40" rx="20" fill="#2196F3"/>
                        <rect x="265" y="155" width="90" height="8" rx="4" fill="#E0E0E0"/>
                        <rect x="265" y="170" width="70" height="6" rx="3" fill="#E8E8E8"/>
                        <rect x="220" y="300" width="60" height="10" rx="2" fill="#BDBDBD"/>
                        <rect x="180" y="310" width="140" height="15" rx="4" fill="#9E9E9E"/>
                        <circle cx="430" cy="240" r="40" fill="#4CAF50"/>
                        <path d="M430 280 C430 280 410 300 410 340 L450 340 C450 300 430 280 430 280 Z" fill="#45a049"/>
                        <rect x="410" y="270" width="40" height="60" rx="20" fill="#4CAF50"/>
                        <circle cx="400" cy="130" r="18" fill="#4CAF50"/>
                        <path d="M392 130 L398 136 L408 126" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="460" cy="90" r="20" fill="#FFB74D" opacity="0.6"/>
                    </svg>
                </div>
            </div>
        </section>

        <section class="stats-section">
            <div class="stats-container">
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-icon"><i class="fas fa-file-alt"></i></div>
                        <h3><span>50</span>K+</h3>
                        <p>CV Dibuat</p>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon"><i class="fas fa-layer-group"></i></div>
                        <h3><span>500</span>+</h3>
                        <p>Template Premium</p>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon"><i class="fas fa-smile"></i></div>
                        <h3><span>98</span>%</h3>
                        <p>Kepuasan User</p>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon"><i class="fas fa-headset"></i></div>
                        <h3><span>24</span>/7</h3>
                        <p>Customer Support</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="popular-templates-section">
            <div class="templates-container">
                <div class="templates-header">
                    <div class="section-tag"><i class="fas fa-star"></i> Template Populer</div>
                    <h2>Template CV Paling Direkomendasikan</h2>
                    <p>Pilih dari template yang telah terbukti meningkatkan peluang diterima kerja hingga 3x lipat</p>
                </div>

                <div class="templates-grid">
                    <div class="template-card">
                        <div class="template-badge">Populer</div>
                        <div class="template-preview">
                            <span class="template-preview-text">Preview Template</span>
                        </div>
                        <div class="template-info">
                            <h3>Professional Modern</h3>
                            <p>Template minimalis dan clean untuk profesional.</p>
                            <div class="template-meta">
                                <div class="template-stats">
                                    <span><i class="fas fa-download"></i> 15.2K</span>
                                    <span><i class="fas fa-star"></i> 4.9</span>
                                </div>
                                <a href="#" class="template-action">Detail <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="template-card">
                        <div class="template-badge new">Terbaru</div>
                        <div class="template-preview">
                            <span class="template-preview-text">Preview Template</span>
                        </div>
                        <div class="template-info">
                            <h3>Creative Bold</h3>
                            <p>Desain berani untuk industri kreatif.</p>
                            <div class="template-meta">
                                <div class="template-stats">
                                    <span><i class="fas fa-download"></i> 8.5K</span>
                                    <span><i class="fas fa-star"></i> 4.8</span>
                                </div>
                                <a href="#" class="template-action">Detail <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="template-card">
                        <div class="template-badge premium">Premium</div>
                        <div class="template-preview">
                            <span class="template-preview-text">Preview Template</span>
                        </div>
                        <div class="template-info">
                            <h3>Executive Classic</h3>
                            <p>Template formal untuk posisi senior.</p>
                            <div class="template-meta">
                                <div class="template-stats">
                                    <span><i class="fas fa-download"></i> 12.8K</span>
                                    <span><i class="fas fa-star"></i> 5.0</span>
                                </div>
                                <a href="#" class="template-action">Detail <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="view-all-templates">
                    <a href="#" class="btn-outline">Lihat Semua Template <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </section>

        <section class="features-section">
            <div class="features-container">
                <div class="section-header">
                    <h2>Kenapa Memilih CV Builder?</h2>
                    <p>Fitur lengkap untuk membuat CV profesional dengan mudah</p>
                </div>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-file-alt"></i></div>
                        <h3>Template Modern</h3>
                        <p>Ratusan template profesional yang dirancang khusus untuk berbagai industri.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-bolt"></i></div>
                        <h3>Cepat & Mudah</h3>
                        <p>Buat CV dalam 10 menit dengan interface yang intuitif.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-palette"></i></div>
                        <h3>Kustomisasi Penuh</h3>
                        <p>Ubah warna, font, dan layout sesuai keinginan Anda.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="cta-section">
            <div class="cta-container">
                <h2>Siap Membuat CV Profesional?</h2>
                <p>Bergabunglah dengan ribuan profesional yang telah berhasil mendapatkan pekerjaan impian</p>
                <a href="#" class="btn-white">Mulai Sekarang →</a>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-container">
            <div class="footer-content">
                <div>
                    <div class="footer-logo">ResuMate</div>
                    <p class="footer-desc">
                        Platform terpercaya untuk membuat CV profesional dengan mudah dan cepat.
                        Wujudkan karir impian Anda bersama kami.
                    </p>
                </div>
                <div class="footer-column">
                    <h4>Produk</h4>
                    <ul>
                        <li><a href="#">Template CV</a></li>
                        <li><a href="#">Contoh CV</a></li>
                        <li><a href="#">Tips Karir</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Perusahaan</h4>
                    <ul>
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Karir</a></li>
                        <li><a href="#">Kontak</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Legal</h4>
                    <ul>
                        <li><a href="#">Privasi</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                        <li><a href="#">Bantuan</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 ResuMate. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('navMenu');
            menu.classList.toggle('active');
        }

        document.addEventListener('click', function(event) {
            const nav = document.querySelector('nav');
            const menu = document.getElementById('navMenu');
            const toggle = document.querySelector('.mobile-menu-toggle');
            
            if (!nav.contains(event.target) && !toggle.contains(event.target)) {
                menu.classList.remove('active');
            }
        });

        const themeToggle = document.getElementById('themeToggle');
        const icon = themeToggle.querySelector('i');
        const htmlElement = document.documentElement;

        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            htmlElement.setAttribute('data-theme', savedTheme);
            updateIcon(savedTheme);
        }

        themeToggle.addEventListener('click', () => {
            const currentTheme = htmlElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            htmlElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateIcon(newTheme);
        });

        function updateIcon(theme) {
            if (theme === 'dark') {
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun'); 
                icon.style.color = '#FFD700'; 
            } else {
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon'); 
                icon.style.color = '#333';
            }
        }

        const backToTopBtn = document.getElementById('backToTop');

        window.onscroll = function() {
            if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
                backToTopBtn.classList.add('show');
            } else {
                backToTopBtn.classList.remove('show');
            }
        };

        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    </script>
</body>
</html>