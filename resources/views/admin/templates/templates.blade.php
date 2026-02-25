<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Template - ResuMate Admin</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* =============================================
           1. THEME VARIABLES (GLOBAL)
           ============================================= */
        :root {
            --primary-color: #4CAF50;
            --primary-hover: #45a049;
            --primary-soft: rgba(76, 175, 80, 0.1);
            --primary-hover-bg: rgba(76, 175, 80, 0.08);

            --bg-body: #F8FAFC;
            --bg-card: #FFFFFF;
            --bg-sidebar: #1E293B;
            --bg-input: #FFFFFF;
            --bg-header-builder: #f1f5f9;

            --text-main: #334155;
            --text-muted: #64748B;
            --text-light: #94a3b8;
            --text-sidebar: #94A3B8;

            --border-color: #E2E8F0;
            --border-dashed: #cbd5e1;

            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-card: 0 10px 15px -3px rgba(0, 0, 0, 0.1);

            --sidebar-width: 260px;
            --header-height: 70px;
            --z-overlay: 40;
            --z-sidebar: 50;

            --btn-soft-success-bg: #dcfce7;
            --btn-soft-success-text: #166534;
            --btn-soft-danger-bg: #fef2f2;
            --btn-soft-danger-text: #EF4444;
            --btn-soft-danger-border: #fee2e2;
        }

        [data-theme="dark"] {
            --bg-body: #0F172A;
            --bg-card: #1E293B;
            --bg-sidebar: #020617;
            --bg-input: #334155;
            --bg-header-builder: #334155;
            --text-main: #F1F5F9;
            --text-muted: #94A3B8;
            --text-light: #64748b;
            --text-sidebar: #64748B;
            --border-color: #334155;
            --border-dashed: #475569;
            --shadow-sm: none;
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.3);
            --shadow-card: 0 10px 15px -3px rgba(0, 0, 0, 0.5);
            --primary-soft: rgba(76, 175, 80, 0.2);
            --primary-hover-bg: rgba(76, 175, 80, 0.15);
            --btn-soft-success-bg: rgba(22, 101, 52, 0.4);
            --btn-soft-success-text: #86efac;
            --btn-soft-danger-bg: rgba(127, 29, 29, 0.4);
            --btn-soft-danger-text: #fca5a5;
            --btn-soft-danger-border: #7f1d1d;
        }

        /* =============================================
           2. GLOBAL RESET
           ============================================= */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: var(--bg-body); color: var(--text-main); transition: background 0.3s, color 0.3s; }
        a { text-decoration: none; }
        ul { list-style: none; }

        /* =============================================
           3. LAYOUT
           ============================================= */
        .admin-wrapper { display: flex; min-height: 100vh; }

        .main-content-wrapper {
            margin-left: var(--sidebar-width);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: calc(100% - var(--sidebar-width));
            transition: margin-left 0.3s;
        }

        .content-body { padding: 30px; flex: 1; }

        @media (max-width: 768px) {
            .main-content-wrapper { margin-left: 0; width: 100%; }
        }

        /* =============================================
           4. SIDEBAR
           ============================================= */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--bg-sidebar);
            height: 100vh;
            position: fixed;
            top: 0; left: 0;
            padding: 24px;
            z-index: var(--z-sidebar);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            transform: translateX(0);
            transition: transform 0.3s ease-in-out;
        }

        .brand {
            display: flex; align-items: center; justify-content: space-between;
            font-size: 20px; font-weight: 800; color: white;
            margin-bottom: 30px; padding-left: 10px; flex-shrink: 0;
        }
        .brand-content { display: flex; align-items: center; gap: 12px; }
        .brand i { color: var(--primary-color); font-size: 24px; }

        .sidebar-close { display: none; cursor: pointer; font-size: 20px; color: #94A3B8; transition: 0.2s; padding: 5px; }
        .sidebar-close:hover { color: #EF4444; }

        .nav-scrollable { flex: 1; overflow-y: auto; margin-right: -10px; padding-right: 10px; }
        .nav-scrollable::-webkit-scrollbar { width: 4px; }
        .nav-scrollable::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 4px; }

        .menu-label {
            font-size: 11px; text-transform: uppercase; letter-spacing: 1px;
            color: var(--text-sidebar); margin-bottom: 10px; padding-left: 12px;
            font-weight: 700; margin-top: 20px;
        }
        .menu-label:first-child { margin-top: 0; }

        .nav-menu { list-style: none; padding: 0; margin: 0; }
        .nav-item { margin-bottom: 4px; }
        .nav-link {
            display: flex; align-items: center; gap: 12px;
            padding: 12px; border-radius: 10px;
            color: var(--text-sidebar); font-size: 14px; font-weight: 500;
            transition: 0.3s; text-decoration: none;
        }
        .nav-link:hover { background: rgba(255,255,255,0.08); color: white; }
        .nav-link.active { background: rgba(255,255,255,0.08); color: white; border-left: 3px solid var(--primary-color); }
        .nav-link.active i { color: var(--primary-color); }

        .sidebar-footer { margin-top: 20px; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.05); flex-shrink: 0; }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); box-shadow: none; }
            .sidebar.open { transform: translateX(0); box-shadow: 10px 0 30px rgba(0,0,0,0.5); }
            .sidebar-close { display: block; }
        }

        /* =============================================
           5. HEADER
           ============================================= */
        .top-header {
            height: var(--header-height);
            background: var(--bg-card);
            border-bottom: 1px solid var(--border-color);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 30px;
            position: sticky; top: 0; z-index: 40;
        }

        .header-left { display: flex; align-items: center; gap: 20px; }
        .toggle-sidebar { display: none; font-size: 20px; cursor: pointer; color: var(--text-main); }

        .search-box { position: relative; }
        .search-box input {
            background: var(--bg-body); border: 1px solid var(--border-color);
            padding: 8px 15px 8px 35px; border-radius: 50px;
            color: var(--text-main); width: 250px; font-size: 13px; outline: none;
        }
        .search-box i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 13px; }

        .header-right { display: flex; align-items: center; gap: 20px; }

        .theme-btn { background: none; border: none; cursor: pointer; font-size: 18px; color: var(--text-main); transition: transform 0.3s; }
        .theme-btn:hover { transform: rotate(15deg); color: var(--primary-color); }

        .admin-profile { display: flex; align-items: center; gap: 10px; cursor: pointer; }
        .admin-info { text-align: right; line-height: 1.2; }
        .admin-name { font-weight: 700; font-size: 14px; color: var(--text-main); }
        .admin-role { font-size: 11px; color: var(--text-muted); }
        .admin-img {
            width: 38px; height: 38px; border-radius: 50%; background: #E2E8F0;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; color: var(--text-muted);
        }

        @media (max-width: 768px) {
            .toggle-sidebar { display: block; }
            .search-box { display: none; }
        }

        /* =============================================
           6. FOOTER
           ============================================= */
        .footer {
            padding: 20px 30px; border-top: 1px solid var(--border-color);
            background: var(--bg-card);
            display: flex; justify-content: space-between; align-items: center;
            color: var(--text-muted); font-size: 13px;
        }

        /* =============================================
           7. PAGE CONTENT — EDIT TEMPLATE
           ============================================= */
        .create-template-wrapper {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
            align-items: start;
        }

        .card-section {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: var(--shadow-sm);
        }
        .section-title {
            font-size: 16px; font-weight: 700; color: var(--text-main);
            margin-bottom: 20px; padding-bottom: 12px; border-bottom: 1px solid var(--border-color);
        }

        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 13px; font-weight: 600; color: var(--text-main); margin-bottom: 8px; }

        .form-input, .form-textarea, .form-select {
            width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid var(--border-color);
            background: var(--bg-input); color: var(--text-main); font-size: 14px; outline: none; transition: 0.2s;
            font-family: 'Inter', sans-serif;
        }
        .form-input::placeholder { color: var(--text-muted); opacity: 0.7; }
        .form-input:focus, .form-select:focus { border-color: var(--primary-color); box-shadow: 0 0 0 3px var(--primary-soft); }
        .form-textarea { resize: vertical; }
        .text-danger { color: #EF4444; font-size: 12px; margin-top: 4px; display: block; }

        /* Builder */
        .builder-container { background: var(--bg-body); border: 1px solid var(--border-color); border-radius: 12px; padding: 20px; min-height: 200px; }
        .builder-section { background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 8px; margin-bottom: 15px; overflow: hidden; box-shadow: var(--shadow-sm); }
        .section-header { background: var(--bg-header-builder); padding: 12px 15px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border-color); flex-wrap: wrap; gap: 10px; }
        .builder-field { background: var(--bg-card); border: 1px dashed var(--border-dashed); padding: 12px; border-radius: 6px; margin-bottom: 10px; display: flex; gap: 10px; align-items: flex-start; }
        .builder-row-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr 0.5fr; gap: 10px; width: 100%; align-items: center; }

        .b-input, .b-select {
            padding: 8px 10px; border: 1px solid var(--border-color); border-radius: 4px;
            font-size: 13px; width: 100%; background: var(--bg-input); color: var(--text-main);
            font-family: 'Inter', sans-serif;
        }
        .b-label { font-size: 10px; color: var(--text-muted); display: block; margin-bottom: 2px; }
        .icon-grip { color: var(--text-light); cursor: move; margin-top: 8px; }

        .btn-sm-icon {
            width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;
            border-radius: 6px; border: 1px solid var(--border-color); cursor: pointer;
            background: var(--bg-card); color: var(--text-muted); transition: 0.2s;
        }
        .btn-sm-icon:hover { background: var(--primary-hover-bg); color: var(--primary-color); border-color: var(--primary-color); }

        .btn-add {
            background: var(--btn-soft-success-bg); color: var(--btn-soft-success-text);
            border: 1px solid var(--btn-soft-success-bg); padding: 10px 16px; border-radius: 6px;
            cursor: pointer; font-size: 13px; font-weight: 600;
            display: inline-flex; align-items: center; gap: 5px;
        }
        .btn-add-sm { margin-top: 10px; font-size: 12px; padding: 6px 12px; }
        .btn-delete-section { color: var(--btn-soft-danger-text); border-color: var(--btn-soft-danger-border); background: var(--btn-soft-danger-bg); }
        .btn-delete-section:hover { color: var(--btn-soft-danger-text); border-color: var(--btn-soft-danger-border); background: var(--btn-soft-danger-bg); }

        .btn-submit {
            background: var(--primary-color); color: white; border: none;
            padding: 12px 30px; border-radius: 8px; font-weight: 600; cursor: pointer;
            transition: 0.2s; box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            font-family: 'Inter', sans-serif;
        }
        .btn-submit:hover { opacity: 0.9; transform: translateY(-1px); }

        /* Upload */
        .upload-area {
            border: 2px dashed var(--border-color); border-radius: 12px; padding: 20px;
            text-align: center; cursor: pointer; background: var(--bg-body); transition: 0.2s; position: relative;
        }
        .upload-area:hover { border-color: var(--primary-color); background: var(--primary-hover-bg); }
        .upload-preview-img { width: 100%; border-radius: 8px; margin-bottom: 10px; object-fit: cover; }

        /* Toggle Switch */
        .switch { position: relative; display: inline-block; width: 44px; height: 24px; }
        .switch input { opacity: 0; width: 0; height: 0; }
        .slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: var(--border-dashed); transition: .4s; border-radius: 34px; }
        .slider:before { position: absolute; content: ""; height: 18px; width: 18px; left: 3px; bottom: 3px; background-color: white; transition: .4s; border-radius: 50%; }
        input:checked + .slider { background-color: var(--primary-color); }
        input:checked + .slider:before { transform: translateX(20px); }

        .bottom-actions { margin-top: 30px; text-align: right; padding-bottom: 50px; }

        /* Full-width builder card */
        .full-width-card { grid-column: 1 / -1; }

        @media (max-width: 900px) {
            .create-template-wrapper { grid-template-columns: 1fr; gap: 15px; }
            .builder-row-grid { grid-template-columns: 1fr 1fr; gap: 8px 12px; }
            .builder-row-grid > div:nth-child(1) { grid-column: 1 / -1; }
            .builder-row-grid > div:nth-child(5) { grid-column: 2 / 3; display: flex; justify-content: flex-end; align-items: flex-end; height: 100%; }
            .bottom-actions { display: flex; flex-direction: column-reverse; gap: 15px; }
        }
    </style>
</head>
<body>
    <div class="admin-wrapper">

        <!-- ===================== SIDEBAR ===================== -->
        <aside class="sidebar" id="sidebar">
            <div class="brand">
                <div class="brand-content">
                    <i class="fas fa-file-invoice"></i>
                    <span>ResuMate<span style="color:var(--primary-color)">.</span></span>
                </div>
                <i class="fas fa-times sidebar-close" onclick="toggleSidebar()"></i>
            </div>

            <div class="nav-scrollable">
                <div class="menu-label">Main Menu</div>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="fas fa-chart-pie"></i> <span>Dashboard</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="fas fa-receipt"></i> <span>Transaksi</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="fas fa-users"></i> <span>Pengguna</span></a>
                    </li>
                </ul>

                <div class="menu-label">Produk</div>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="#" class="nav-link active"><i class="fas fa-layer-group"></i> <span>Template CV</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="fas fa-cog"></i> <span>Pengaturan</span></a>
                    </li>
                </ul>
            </div>

            <div class="sidebar-footer">
                <a href="#" class="nav-link" style="color:#EF4444;">
                    <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                </a>
            </div>
        </aside>

        <!-- ===================== MAIN WRAPPER ===================== -->
        <div class="main-content-wrapper">

            <!-- ===================== HEADER ===================== -->
            <header class="top-header">
                <div class="header-left">
                    <i class="fas fa-bars toggle-sidebar" onclick="document.getElementById('sidebar').classList.toggle('open')"></i>
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Cari data...">
                    </div>
                </div>
                <div class="header-right">
                    <button class="theme-btn" onclick="toggleTheme()">
                        <i class="fas fa-moon" id="theme-icon"></i>
                    </button>
                    <div class="admin-profile">
                        <div class="admin-info">
                            <div class="admin-name">Admin</div>
                            <div class="admin-role">Administrator</div>
                        </div>
                        <div class="admin-img">AD</div>
                    </div>
                </div>
            </header>

            <!-- ===================== CONTENT ===================== -->
            <main class="content-body">

                <!-- Page Header -->
                <div style="margin-bottom:24px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
                    <div>
                        <h1 style="font-size:24px; font-weight:700; color:var(--text-main);">Edit Template</h1>
                        <p style="color:var(--text-muted); font-size:14px; margin-top:4px;">Perbarui informasi dan struktur template <strong>Modern Blue Professional</strong>.</p>
                    </div>
                    <div style="font-size:12px; color:var(--text-muted); background:var(--bg-card); padding:5px 10px; border-radius:6px; border:1px solid var(--border-color);">
                        ID: #12
                    </div>
                </div>

                <div class="create-template-wrapper">

                    <!-- LEFT COLUMN -->
                    <div class="left-col">
                        <!-- Informasi Dasar -->
                        <div class="card-section">
                            <h3 class="section-title">Informasi Dasar</h3>
                            <div class="form-group">
                                <label class="form-label">Nama Template <span style="color:red">*</span></label>
                                <input type="text" class="form-input" placeholder="Contoh: Modern Blue Professional" value="Modern Blue Professional">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Deskripsi Singkat</label>
                                <textarea class="form-textarea" rows="4" placeholder="Jelaskan keunggulan template ini...">Template profesional dengan desain bersih dan modern, cocok untuk berbagai industri.</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tags (Pisahkan koma)</label>
                                <input type="text" class="form-input" placeholder="Minimalis, ATS, Biru, Creative" value="Minimalis, ATS, Biru, Professional">
                            </div>
                        </div>

                        <!-- Harga & Tipe -->
                        <div class="card-section">
                            <h3 class="section-title">Harga & Tipe</h3>
                            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap:20px;">
                                <div class="form-group">
                                    <label class="form-label">Tipe Akses <span style="color:red">*</span></label>
                                    <select class="form-select">
                                        <option value="free">Gratis (Free)</option>
                                        <option value="pro" selected>Berbayar (Pro)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Harga (Rp)</label>
                                    <input type="number" class="form-input" placeholder="0" value="49000">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT COLUMN -->
                    <div class="right-col">
                        <!-- Gambar Preview -->
                        <div class="card-section">
                            <h3 class="section-title">Gambar Preview</h3>
                            <div class="upload-area">
                                <i class="fas fa-cloud-upload-alt" style="font-size:32px; color:var(--text-muted); margin-bottom:10px;"></i>
                                <p style="font-size:13px; font-weight:500; color:var(--text-main);">Klik untuk Ganti Gambar</p>
                                <p style="font-size:11px; color:var(--text-muted); margin-top:4px;">Max 2MB (JPG/PNG)</p>
                            </div>
                            <p style="font-size:11px; color:var(--text-muted); margin-top:5px;">*Biarkan kosong jika tidak ingin mengubah gambar.</p>
                        </div>

                        <!-- Pengaturan -->
                        <div class="card-section">
                            <h3 class="section-title">Pengaturan</h3>
                            <div class="form-group">
                                <label class="form-label">Kategori <span style="color:red">*</span></label>
                                <select class="form-select">
                                    <option value="" disabled>Pilih Kategori</option>
                                    <option value="Professional" selected>Professional</option>
                                    <option value="Creative">Creative</option>
                                    <option value="Simple">Simple</option>
                                    <option value="Akademik">Akademik</option>
                                </select>
                            </div>

                            <div style="display:flex; justify-content:space-between; margin-bottom:15px; align-items:center;">
                                <div>
                                    <h4 style="font-size:13px; font-weight:600; color:var(--text-main);">Status Aktif</h4>
                                    <p style="font-size:11px; color:var(--text-muted);">Tampilkan di katalog</p>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>

                            <div style="display:flex; justify-content:space-between; align-items:center;">
                                <div>
                                    <h4 style="font-size:13px; font-weight:600; color:var(--text-main);">Badge "New"</h4>
                                    <p style="font-size:11px; color:var(--text-muted);">Label produk baru</p>
                                </div>
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- FORM BUILDER — FULL WIDTH -->
                    <div class="card-section full-width-card" style="border-top:4px solid var(--primary-color);">
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px; flex-wrap:wrap; gap:10px;">
                            <h3 class="section-title" style="border:none; margin:0; padding:0;">Form Builder (Desain Input User)</h3>
                            <span style="font-size:12px; background:var(--bg-body); color:var(--text-muted); border:1px solid var(--border-color); padding:6px 10px; border-radius:4px; display:inline-block;">
                                <i class="fas fa-info-circle"></i> Edit struktur input
                            </span>
                        </div>

                        <div class="builder-container">
                            <!-- Section: Informasi Pribadi -->
                            <div class="builder-section">
                                <div class="section-header">
                                    <div style="display:flex; align-items:center; gap:10px; flex-grow:1;">
                                        <i class="fas fa-grip-vertical icon-grip" style="margin-top:0;"></i>
                                        <input type="text" class="b-input" value="Informasi Pribadi" style="font-weight:600; flex-grow:1;">
                                        <select class="b-select" style="width:auto; min-width:100px;">
                                            <option selected>Tunggal</option>
                                            <option>List/Repeater</option>
                                        </select>
                                    </div>
                                    <div style="display:flex; gap:5px; margin-left:auto;">
                                        <button class="btn-sm-icon"><i class="fas fa-arrow-up"></i></button>
                                        <button class="btn-sm-icon"><i class="fas fa-arrow-down"></i></button>
                                        <button class="btn-sm-icon btn-delete-section"><i class="fas fa-trash"></i></button>
                                    </div>
                                </div>
                                <div style="padding:15px;">
                                    <!-- Field Row 1 -->
                                    <div class="builder-field">
                                        <i class="fas fa-grip-lines icon-grip"></i>
                                        <div class="builder-row-grid">
                                            <div>
                                                <label class="b-label">Label Input</label>
                                                <input type="text" class="b-input" value="Nama Lengkap" placeholder="Contoh: Nama Lengkap">
                                            </div>
                                            <div>
                                                <label class="b-label">Tipe</label>
                                                <select class="b-select">
                                                    <option selected>Text</option>
                                                    <option>Textarea</option>
                                                    <option>Email</option>
                                                    <option>Telp</option>
                                                    <option>Tanggal</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="b-label">Lebar</label>
                                                <select class="b-select">
                                                    <option selected>Full (100%)</option>
                                                    <option>Setengah (50%)</option>
                                                    <option>1/3 Baris</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="b-label">Align</label>
                                                <select class="b-select">
                                                    <option selected>Kiri</option>
                                                    <option>Tengah</option>
                                                    <option>Justify</option>
                                                </select>
                                            </div>
                                            <div style="padding-top:16px;">
                                                <button class="btn-sm-icon btn-delete-section" style="width:100%;"><i class="fas fa-times"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Field Row 2 -->
                                    <div class="builder-field">
                                        <i class="fas fa-grip-lines icon-grip"></i>
                                        <div class="builder-row-grid">
                                            <div>
                                                <label class="b-label">Label Input</label>
                                                <input type="text" class="b-input" value="Email" placeholder="Contoh: Email">
                                            </div>
                                            <div>
                                                <label class="b-label">Tipe</label>
                                                <select class="b-select">
                                                    <option>Text</option>
                                                    <option>Textarea</option>
                                                    <option selected>Email</option>
                                                    <option>Telp</option>
                                                    <option>Tanggal</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="b-label">Lebar</label>
                                                <select class="b-select">
                                                    <option>Full (100%)</option>
                                                    <option selected>Setengah (50%)</option>
                                                    <option>1/3 Baris</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="b-label">Align</label>
                                                <select class="b-select">
                                                    <option selected>Kiri</option>
                                                    <option>Tengah</option>
                                                    <option>Justify</option>
                                                </select>
                                            </div>
                                            <div style="padding-top:16px;">
                                                <button class="btn-sm-icon btn-delete-section" style="width:100%;"><i class="fas fa-times"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn-add btn-add-sm"><i class="fas fa-plus"></i> Tambah Field</button>
                                </div>
                            </div>

                            <!-- Section: Pengalaman Kerja -->
                            <div class="builder-section">
                                <div class="section-header">
                                    <div style="display:flex; align-items:center; gap:10px; flex-grow:1;">
                                        <i class="fas fa-grip-vertical icon-grip" style="margin-top:0;"></i>
                                        <input type="text" class="b-input" value="Pengalaman Kerja" style="font-weight:600; flex-grow:1;">
                                        <select class="b-select" style="width:auto; min-width:100px;">
                                            <option>Tunggal</option>
                                            <option selected>List/Repeater</option>
                                        </select>
                                    </div>
                                    <div style="display:flex; gap:5px; margin-left:auto;">
                                        <button class="btn-sm-icon"><i class="fas fa-arrow-up"></i></button>
                                        <button class="btn-sm-icon"><i class="fas fa-arrow-down"></i></button>
                                        <button class="btn-sm-icon btn-delete-section"><i class="fas fa-trash"></i></button>
                                    </div>
                                </div>
                                <div style="padding:15px;">
                                    <div class="builder-field">
                                        <i class="fas fa-grip-lines icon-grip"></i>
                                        <div class="builder-row-grid">
                                            <div>
                                                <label class="b-label">Label Input</label>
                                                <input type="text" class="b-input" value="Nama Perusahaan">
                                            </div>
                                            <div>
                                                <label class="b-label">Tipe</label>
                                                <select class="b-select"><option selected>Text</option></select>
                                            </div>
                                            <div>
                                                <label class="b-label">Lebar</label>
                                                <select class="b-select"><option selected>Full (100%)</option></select>
                                            </div>
                                            <div>
                                                <label class="b-label">Align</label>
                                                <select class="b-select"><option selected>Kiri</option></select>
                                            </div>
                                            <div style="padding-top:16px;">
                                                <button class="btn-sm-icon btn-delete-section" style="width:100%;"><i class="fas fa-times"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn-add btn-add-sm"><i class="fas fa-plus"></i> Tambah Field</button>
                                </div>
                            </div>
                        </div>

                        <button class="btn-add" style="margin-top:15px;">
                            <i class="fas fa-plus-circle"></i> Tambah Section Baru
                        </button>
                    </div>

                </div><!-- end .create-template-wrapper -->

                <!-- Bottom Actions -->
                <div class="bottom-actions">
                    <a href="#" style="margin-right:15px; color:var(--text-muted); font-weight:600; padding:10px; text-decoration:none;">Batal</a>
                    <button class="btn-submit">
                        <i class="fas fa-save" style="margin-right:5px;"></i> Simpan Perubahan
                    </button>
                </div>

            </main>

            <!-- ===================== FOOTER ===================== -->
            <footer class="footer">
                <div>&copy; 2025 ResuMate Admin. All rights reserved.</div>
            </footer>

        </div><!-- end .main-content-wrapper -->
    </div><!-- end .admin-wrapper -->

    <script>
        function toggleTheme() {
            const current = document.documentElement.getAttribute('data-theme');
            const target = current === 'dark' ? 'light' : 'dark';
            document.documentElement.setAttribute('data-theme', target);
            const icon = document.getElementById('theme-icon');
            icon.className = target === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
        }
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
        }
    </script>
</body>
</html>