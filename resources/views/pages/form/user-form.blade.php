    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Buat CV Anda - ResuMate</title>
        
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        <style>
            /* --- CSS VARIABLES & THEME SETUP --- */
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
                --text-muted: #64748B;
                --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
                --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
                --success-color: #4CAF50;
                --danger-color: #EF4444;
                --warning-color: #F59E0B;
                --secondary-color: #2196F3;
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
                --text-muted: #94A3B8;
            }

            * { margin: 0; padding: 0; box-sizing: border-box; }

            body {
                font-family: 'Inter', sans-serif;
                background-color: var(--bg-body);
                color: var(--text-main);
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                line-height: 1.6;
                transition: background-color 0.3s ease, color 0.3s ease;
            }

            main { flex: 1; }

            /* ============================================
            NAVIGATION BAR — LOGGED IN
            ============================================ */
            nav {
                background: var(--bg-nav);
                padding: 16px 0;
                box-shadow: 0 2px 8px var(--shadow-color);
                border-bottom: 1px solid var(--border-color);
                position: sticky;
                top: 0;
                z-index: 1000;
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
                gap: 10px;
                font-size: 22px;
                font-weight: 700;
                color: var(--text-main);
                text-decoration: none;
                transition: opacity 0.3s ease;
            }

            .logo:hover { opacity: 0.8; }
            .logo-icon { width: 36px; height: 36px; flex-shrink: 0; }

            .nav-right {
                display: flex;
                align-items: center;
                gap: 20px;
            }

            .nav-menu {
                display: flex;
                list-style: none;
                gap: 32px;
                align-items: center;
            }

            .nav-menu li a {
                text-decoration: none;
                color: var(--text-secondary);
                font-weight: 500;
                font-size: 15px;
                transition: color 0.3s ease;
                position: relative;
            }

            .nav-menu li a:hover { color: var(--primary-color); }

            .nav-menu li a.active {
                color: var(--primary-color);
                font-weight: 600;
            }

            .nav-menu li a.active::after {
                content: '';
                position: absolute;
                bottom: -8px;
                left: 0;
                right: 0;
                height: 2px;
                background: var(--primary-color);
            }

            /* Theme Toggle */
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
                transition: all 0.3s ease;
            }

            .theme-toggle-btn:hover {
                background-color: var(--bg-body);
                border-color: var(--primary-color);
            }

            .theme-toggle-btn i { font-size: 16px; }

            /* Avatar + Dropdown */
            .nav-profile { position: relative; }

            .nav-avatar-btn {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background: var(--primary-color);
                color: white;
                border: 2px solid transparent;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 15px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.2s ease;
                outline: none;
            }

            .nav-avatar-btn:hover,
            .nav-profile.open .nav-avatar-btn {
                border-color: var(--primary-hover);
                box-shadow: 0 0 0 4px rgba(76, 175, 80, 0.15);
            }

            .nav-avatar-btn img {
                width: 100%;
                height: 100%;
                border-radius: 50%;
                object-fit: cover;
            }

            .profile-dropdown {
                position: absolute;
                top: calc(100% + 12px);
                right: 0;
                width: 240px;
                background: var(--bg-card);
                border: 1px solid var(--border-color);
                border-radius: 12px;
                box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
                overflow: hidden;
                opacity: 0;
                visibility: hidden;
                transform: translateY(-8px);
                transition: all 0.2s ease;
                z-index: 1100;
            }

            .nav-profile.open .profile-dropdown {
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }

            .dropdown-header {
                padding: 16px;
                border-bottom: 1px solid var(--border-color);
                background: var(--bg-body);
            }

            .dropdown-name {
                font-size: 15px;
                font-weight: 600;
                color: var(--text-main);
                margin-bottom: 4px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .dropdown-email {
                font-size: 13px;
                color: var(--text-secondary);
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .dropdown-menu-list {
                padding: 8px 0;
                list-style: none;
            }

            .dropdown-menu-list li a,
            .dropdown-menu-list li button {
                display: flex;
                align-items: center;
                gap: 12px;
                width: 100%;
                padding: 10px 16px;
                font-size: 14px;
                font-weight: 500;
                color: var(--text-secondary);
                text-decoration: none;
                background: transparent;
                border: none;
                cursor: pointer;
                font-family: inherit;
                text-align: left;
                transition: all 0.15s ease;
            }

            .dropdown-menu-list li a:hover,
            .dropdown-menu-list li button:hover {
                background: var(--bg-body);
                color: var(--primary-color);
            }

            .dropdown-menu-list li a i,
            .dropdown-menu-list li button i {
                width: 18px;
                font-size: 14px;
                color: var(--text-secondary);
                transition: color 0.15s ease;
            }

            .dropdown-menu-list li a:hover i,
            .dropdown-menu-list li button:hover i {
                color: var(--primary-color);
            }

            .dropdown-divider {
                height: 1px;
                background: var(--border-color);
                margin: 6px 0;
            }

            .dropdown-menu-list li.logout-item button { color: #e53935; }
            .dropdown-menu-list li.logout-item button i { color: #e53935; }

            .dropdown-menu-list li.logout-item button:hover {
                background: #fff5f5;
                color: #c62828;
            }

            [data-theme="dark"] .dropdown-menu-list li.logout-item button:hover {
                background: rgba(229, 57, 53, 0.1);
            }

            /* Mobile Menu */
            .mobile-menu-toggle {
                display: none;
                flex-direction: column;
                gap: 5px;
                cursor: pointer;
                padding: 8px;
                background: transparent;
                border: none;
            }

            .mobile-menu-toggle span {
                width: 25px;
                height: 3px;
                background: var(--text-main);
                border-radius: 2px;
                transition: all 0.3s;
            }

            /* --- FOOTER --- */
            footer {
                background: #2C2C2C;
                color: white;
                padding: 60px 0 30px;
                margin-top: auto;
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

            /* --- BACK TO TOP --- */
            #backToTop {
                position: fixed; bottom: 30px; right: 30px; width: 50px; height: 50px;
                background-color: var(--primary-color); color: white; border: none; border-radius: 50%;
                cursor: pointer; display: flex; align-items: center; justify-content: center;
                font-size: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.2); opacity: 0; visibility: hidden;
                transition: all 0.3s ease; z-index: 999;
            }
            #backToTop.show { opacity: 1; visibility: visible; }
            #backToTop:hover { background-color: var(--primary-hover); transform: translateY(-5px); }

            /* --- MAIN CONTAINER --- */
            .main-container {
                max-width: 1400px;
                margin: 40px auto;
                padding: 0 24px;
                display: grid;
                grid-template-columns: 280px 1fr;
                gap: 30px;
                min-height: calc(100vh - 200px);
            }

            /* --- PROGRESS SIDEBAR --- */
            .progress-sidebar {
                background: var(--bg-card);
                border-radius: 16px;
                padding: 24px;
                height: fit-content;
                position: sticky;
                top: 100px;
                box-shadow: var(--shadow-sm);
                border: 1px solid var(--border-color);
            }

            .progress-title {
                font-size: 16px;
                font-weight: 700;
                color: var(--text-main);
                margin-bottom: 20px;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .step-list { display: flex; flex-direction: column; gap: 12px; }

            .step-item {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 12px;
                border-radius: 10px;
                cursor: pointer;
                transition: all 0.3s;
                border: 1px solid transparent;
            }

            .step-item:hover { background: var(--bg-body); }
            .step-item.active { background: rgba(76, 175, 80, 0.1); border-color: var(--primary-color); }
            .step-item.completed { opacity: 0.6; }

            .step-number {
                width: 32px;
                height: 32px;
                border-radius: 50%;
                background: var(--border-color);
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 700;
                font-size: 14px;
                color: var(--text-secondary);
                flex-shrink: 0;
            }

            .step-item.active .step-number {
                background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
                color: white;
            }

            .step-item.completed .step-number {
                background: var(--success-color);
                color: white;
            }

            .step-item.completed .step-number::before {
                content: "\f00c";
                font-family: "Font Awesome 6 Free";
                font-weight: 900;
            }

            .step-item.completed .step-number span { display: none; }

            .step-info { flex: 1; }
            .step-name { font-size: 14px; font-weight: 600; color: var(--text-main); }
            .step-desc { font-size: 11px; color: var(--text-secondary); margin-top: 2px; }

            /* --- FORM CONTENT AREA --- */
            .form-content {
                background: var(--bg-card);
                border-radius: 16px;
                padding: 40px;
                box-shadow: var(--shadow-sm);
                border: 1px solid var(--border-color);
            }

            .section-header { margin-bottom: 32px; }

            .section-title {
                font-size: 26px;
                font-weight: 800;
                color: var(--text-main);
                margin-bottom: 8px;
            }

            .section-subtitle { font-size: 14px; color: var(--text-secondary); }

            /* --- FORM STYLES --- */
            .form-section { display: none; }

            .form-section.active {
                display: block;
                animation: fadeIn 0.4s ease-in;
            }

            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }

            .form-group { margin-bottom: 24px; }

            .form-label {
                display: block;
                font-weight: 600;
                font-size: 14px;
                color: var(--text-main);
                margin-bottom: 8px;
            }

            .form-label .required { color: var(--danger-color); margin-left: 2px; }

            .form-label .optional {
                color: var(--text-secondary);
                font-weight: 400;
                font-size: 12px;
                margin-left: 4px;
            }

            .form-input,
            .form-textarea,
            .form-select {
                width: 100%;
                padding: 12px 16px;
                border: 1px solid var(--border-color);
                border-radius: 10px;
                background: var(--bg-body);
                color: var(--text-main);
                font-size: 14px;
                font-family: 'Inter', sans-serif;
                transition: all 0.3s;
            }

            .form-input:focus,
            .form-textarea:focus,
            .form-select:focus {
                outline: none;
                border-color: var(--primary-color);
                background: var(--bg-card);
                box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
            }

            .form-textarea { resize: vertical; min-height: 100px; }

            .form-help {
                font-size: 12px;
                color: var(--text-secondary);
                margin-top: 6px;
                display: block;
            }

            .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

            /* --- PHOTO UPLOAD --- */
            .photo-upload-area {
                border: 2px dashed var(--border-color);
                border-radius: 12px;
                padding: 40px;
                text-align: center;
                cursor: pointer;
                transition: all 0.3s;
                background: var(--bg-body);
            }

            .photo-upload-area:hover {
                border-color: var(--primary-color);
                background: rgba(76, 175, 80, 0.05);
            }

            .photo-upload-area input { display: none; }

            .upload-icon { font-size: 48px; color: var(--primary-color); margin-bottom: 16px; }
            .upload-text { font-size: 14px; font-weight: 600; color: var(--text-main); margin-bottom: 6px; }
            .upload-hint { font-size: 12px; color: var(--text-secondary); }

            .photo-preview { display: none; margin-top: 20px; align-items: center; gap: 20px; }
            .photo-preview.show { display: flex; }

            .preview-img {
                width: 150px;
                height: 150px;
                border-radius: 12px;
                object-fit: cover;
                border: 2px solid var(--border-color);
            }

            .preview-actions { flex: 1; }

            .btn-change-photo {
                padding: 8px 16px;
                background: var(--secondary-color);
                color: white;
                border: none;
                border-radius: 8px;
                font-size: 13px;
                font-weight: 600;
                cursor: pointer;
                margin-right: 8px;
                transition: 0.3s;
            }

            .btn-change-photo:hover { background: #1976D2; }

            .btn-remove-photo {
                padding: 8px 16px;
                background: var(--danger-color);
                color: white;
                border: none;
                border-radius: 8px;
                font-size: 13px;
                font-weight: 600;
                cursor: pointer;
                transition: 0.3s;
            }

            .btn-remove-photo:hover { background: #DC2626; }

            /* --- DYNAMIC FIELDS --- */
            .dynamic-item {
                background: var(--bg-body);
                padding: 20px;
                border-radius: 12px;
                margin-bottom: 16px;
                border: 1px solid var(--border-color);
                position: relative;
            }

            .dynamic-item-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
                padding-bottom: 12px;
                border-bottom: 1px solid var(--border-color);
            }

            .dynamic-item-title { font-size: 15px; font-weight: 700; color: var(--text-main); }

            .btn-remove-item {
                background: var(--danger-color);
                color: white;
                border: none;
                padding: 6px 12px;
                border-radius: 6px;
                font-size: 12px;
                cursor: pointer;
                transition: 0.3s;
                display: flex;
                align-items: center;
                gap: 4px;
            }

            .btn-remove-item:hover { background: #DC2626; }

            .btn-add-more {
                width: 100%;
                padding: 14px;
                background: transparent;
                border: 2px dashed var(--primary-color);
                color: var(--primary-color);
                border-radius: 10px;
                font-size: 14px;
                font-weight: 600;
                cursor: pointer;
                transition: 0.3s;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                margin-top: 16px;
            }

            .btn-add-more:hover { background: rgba(76, 175, 80, 0.1); }

            /* --- SKILLS TAG INPUT --- */
            .skills-container {
                display: flex;
                flex-wrap: wrap;
                gap: 8px;
                padding: 12px;
                border: 1px solid var(--border-color);
                border-radius: 10px;
                background: var(--bg-body);
                min-height: 80px;
                cursor: text;
            }

            .skill-tag {
                background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
                color: white;
                padding: 6px 12px;
                border-radius: 20px;
                font-size: 13px;
                font-weight: 500;
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .skill-tag i { cursor: pointer; font-size: 10px; transition: 0.2s; }
            .skill-tag i:hover { transform: scale(1.2); }

            .skill-input-wrapper { flex: 1; min-width: 150px; }

            .skill-input {
                border: none;
                background: transparent;
                padding: 6px;
                font-size: 14px;
                width: 100%;
                outline: none;
                color: var(--text-main);
            }

            /* --- NAVIGATION BUTTONS --- */
            .form-navigation {
                display: flex;
                justify-content: space-between;
                margin-top: 40px;
                padding-top: 24px;
                border-top: 1px solid var(--border-color);
            }

            .btn-nav {
                padding: 14px 28px;
                border-radius: 10px;
                font-size: 14px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s;
                border: none;
                font-family: 'Inter', sans-serif;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .btn-prev {
                background: var(--bg-body);
                color: var(--text-main);
                border: 1px solid var(--border-color);
            }

            .btn-prev:hover { background: var(--border-color); }

            .btn-next,
            .btn-submit {
                background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
                color: white;
            }

            .btn-next:hover,
            .btn-submit:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(76, 175, 80, 0.3);
            }

            .btn-submit { background: linear-gradient(135deg, #2196F3, #1976D2); }
            .btn-submit:hover { box-shadow: 0 6px 20px rgba(33, 150, 243, 0.3); }

            /* --- CHECKBOX --- */
            .checkbox-wrapper {
                display: flex;
                align-items: center;
                gap: 8px;
                margin-top: 12px;
            }

            .checkbox-wrapper input[type="checkbox"] {
                width: 18px;
                height: 18px;
                cursor: pointer;
                accent-color: var(--primary-color);
            }

            .checkbox-wrapper label { font-size: 14px; color: var(--text-main); cursor: pointer; }

            /* --- SUCCESS MODAL --- */
            .modal-overlay {
                position: fixed;
                top: 0; left: 0; right: 0; bottom: 0;
                background: rgba(0, 0, 0, 0.6);
                display: none;
                align-items: center;
                justify-content: center;
                z-index: 2000;
                backdrop-filter: blur(4px);
            }

            .modal-overlay.show { display: flex; }

            .modal-content {
                background: var(--bg-card);
                border-radius: 20px;
                padding: 40px;
                max-width: 500px;
                width: 90%;
                text-align: center;
                animation: modalSlideIn 0.4s ease-out;
            }

            @keyframes modalSlideIn {
                from { opacity: 0; transform: translateY(-30px); }
                to { opacity: 1; transform: translateY(0); }
            }

            .modal-icon {
                width: 80px;
                height: 80px;
                background: linear-gradient(135deg, var(--success-color), #66BB6A);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 24px;
                font-size: 40px;
                color: white;
            }

            .modal-title { font-size: 24px; font-weight: 800; color: var(--text-main); margin-bottom: 12px; }
            .modal-text { font-size: 14px; color: var(--text-secondary); margin-bottom: 28px; }

            .btn-modal {
                padding: 14px 32px;
                background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
                color: white;
                border: none;
                border-radius: 10px;
                font-size: 14px;
                font-weight: 600;
                cursor: pointer;
                transition: 0.3s;
                margin: 0 8px;
            }

            .btn-modal:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(76, 175, 80, 0.3); }

            .btn-modal-secondary {
                background: transparent;
                border: 1px solid var(--border-color);
                color: var(--text-main);
            }

            .btn-modal-secondary:hover { background: var(--bg-body); box-shadow: none; }

            /* --- RESPONSIVE --- */
            @media (max-width: 968px) {
                .nav-container { padding: 0 20px; }

                .nav-menu {
                    display: none;
                    position: absolute;
                    top: 73px;
                    left: 0; right: 0;
                    background: var(--bg-nav);
                    flex-direction: column;
                    padding: 20px;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    gap: 20px;
                    border-bottom: 1px solid var(--border-color);
                }

                .nav-menu.active { display: flex; }
                .mobile-menu-toggle { display: flex; }
                .footer-content { grid-template-columns: 1fr; gap: 30px; }
                .footer-container { padding: 0 20px; }
                .main-container { grid-template-columns: 1fr; }

                .progress-sidebar { position: relative; top: 0; }

                .step-list {
                    flex-direction: row;
                    overflow-x: auto;
                    padding-bottom: 8px;
                }

                .step-item { min-width: 200px; }
                .form-row { grid-template-columns: 1fr; }
                .form-content { padding: 24px; }
                .section-title { font-size: 22px; }
                .form-navigation { flex-direction: column; gap: 12px; }
                .btn-nav { width: 100%; justify-content: center; }
            }
        </style>
    </head>
    <body>

        <!-- SUCCESS MODAL -->
        <div class="modal-overlay" id="successModal">
            <div class="modal-content">
                <div class="modal-icon"><i class="fas fa-check"></i></div>
                <h2 class="modal-title">CV Berhasil Dibuat! 🎉</h2>
                <p class="modal-text">Data Anda telah tersimpan. Sekarang Anda bisa download CV atau melakukan edit lebih lanjut.</p>
                <div>
                    <button class="btn-modal" onclick="downloadCV()">
                        <i class="fas fa-download"></i> Download CV
                    </button>
                    <button class="btn-modal btn-modal-secondary" onclick="editCV()">
                        <i class="fas fa-edit"></i> Edit CV
                    </button>
                </div>
            </div>
        </div>

        <!-- ============================================
            NAVBAR — LOGGED IN STATE
        ============================================ -->
        <nav>
            <div class="nav-container">
                <!-- Logo -->
                <a href="index.html" class="logo">
                    <svg class="logo-icon" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 6C6 3.79086 7.79086 2 10 2H20L28 10V28C28 30.2091 26.2091 32 24 32H10C7.79086 32 6 30.2091 6 28V6Z" fill="var(--primary-color)"/>
                        <path d="M20 2V8C20 9.10457 20.8954 10 22 10H28L20 2Z" fill="var(--primary-hover)"/>
                        <rect x="10" y="14" width="12" height="2" rx="1" fill="white" fill-opacity="0.9"/>
                        <rect x="10" y="19" width="12" height="2" rx="1" fill="white" fill-opacity="0.9"/>
                        <rect x="10" y="24" width="8" height="2" rx="1" fill="white" fill-opacity="0.9"/>
                    </svg>
                    <span>ResuMate</span>
                </a>

                <!-- Right Section -->
                <div class="nav-right">
                    <!-- Main Menu -->
                    <ul class="nav-menu" id="navMenu">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="features.html">Features</a></li>
                        <li><a href="templates.html">Templates</a></li>
                        <li><a href="pricing.html">Pricing</a></li>
                    </ul>

                    <!-- Theme Toggle -->
                    <button class="theme-toggle-btn" id="themeToggle" title="Ganti Tema" aria-label="Toggle Theme">
                        <i class="fas fa-moon"></i>
                    </button>

                    <!-- User Profile Dropdown -->
                    <div class="nav-profile" id="navProfile">
                        <button class="nav-avatar-btn" id="profileToggle" aria-label="User menu" title="Andi Pratama">
                            AP
                        </button>

                        <div class="profile-dropdown" id="profileDropdown">
                            <div class="dropdown-header">
                                <div class="dropdown-name">Andi Pratama</div>
                                <div class="dropdown-email">andi.pratama@gmail.com</div>
                            </div>

                            <ul class="dropdown-menu-list">
                                <li>
                                    <a href="edit-profile.html">
                                        <i class="fas fa-user"></i> Profil Saya
                                    </a>
                                </li>
                                <li>
                                    <a href="dashboard.html">
                                        <i class="fas fa-table-columns"></i> Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fas fa-file-alt"></i> CV Saya
                                    </a>
                                </li>

                                <li class="dropdown-divider" role="separator"></li>

                                <li>
                                    <a href="edit-profile.html#preferences">
                                        <i class="fas fa-gear"></i> Pengaturan
                                    </a>
                                </li>

                                <li class="dropdown-divider" role="separator"></li>

                                <li class="logout-item">
                                    <button type="button" onclick="handleLogout()">
                                        <i class="fas fa-right-from-bracket"></i> Keluar
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Mobile Menu Toggle -->
                    <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle menu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </nav>

        <!-- MAIN CONTAINER -->
        <main>
            <div class="main-container">
                <!-- PROGRESS SIDEBAR -->
                <aside class="progress-sidebar">
                    <div class="progress-title">
                        <i class="fas fa-list-check"></i>
                        Progress CV Anda
                    </div>
                    <div class="step-list">
                        <div class="step-item" data-step="1" onclick="goToStep(1)">
                            <div class="step-number"><span>1</span></div>
                            <div class="step-info">
                                <div class="step-name">Data Pribadi</div>
                                <div class="step-desc">Informasi dasar</div>
                            </div>
                        </div>
                        <div class="step-item active" data-step="2" onclick="goToStep(2)">
                            <div class="step-number"><span>2</span></div>
                            <div class="step-info">
                                <div class="step-name">Pendidikan</div>
                                <div class="step-desc">Riwayat pendidikan</div>
                            </div>
                        </div>
                        <div class="step-item" data-step="3" onclick="goToStep(3)">
                            <div class="step-number"><span>3</span></div>
                            <div class="step-info">
                                <div class="step-name">Pengalaman</div>
                                <div class="step-desc">Pengalaman kerja</div>
                            </div>
                        </div>
                        <div class="step-item" data-step="4" onclick="goToStep(4)">
                            <div class="step-number"><span>4</span></div>
                            <div class="step-info">
                                <div class="step-name">Keterampilan</div>
                                <div class="step-desc">Skills & expertise</div>
                            </div>
                        </div>
                        <div class="step-item" data-step="5" onclick="goToStep(5)">
                            <div class="step-number"><span>5</span></div>
                            <div class="step-info">
                                <div class="step-name">Informasi Tambahan</div>
                                <div class="step-desc">Portfolio & lainnya</div>
                            </div>
                        </div>
                    </div>
                </aside>

                <!-- FORM CONTENT -->
                <div class="form-content">
                    <form id="cvForm">
                        <!-- STEP 1: DATA PRIBADI -->
                        <section class="form-section" data-section="1">
                            <div class="section-header">
                                <h1 class="section-title">📋 Data Pribadi</h1>
                                <p class="section-subtitle">Lengkapi informasi dasar Anda untuk memulai membuat CV profesional</p>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Foto Profil <span class="optional">(Opsional)</span></label>
                                <div class="photo-upload-area" onclick="document.getElementById('photoInput').click()">
                                    <input type="file" id="photoInput" accept="image/*" onchange="handlePhotoUpload(event)">
                                    <div class="upload-icon"><i class="fas fa-camera"></i></div>
                                    <div class="upload-text">Klik untuk upload foto</div>
                                    <div class="upload-hint">Format: JPG, PNG (Max: 2MB, Rekomendasi: 400x400px)</div>
                                </div>
                                <div class="photo-preview" id="photoPreview">
                                    <img src="" alt="Photo Preview" class="preview-img" id="photoPreviewImg">
                                    <div class="preview-actions">
                                        <button type="button" class="btn-change-photo" onclick="document.getElementById('photoInput').click()">
                                            <i class="fas fa-sync"></i> Ganti Foto
                                        </button>
                                        <button type="button" class="btn-remove-photo" onclick="removePhoto()">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Nama Lengkap <span class="required">*</span></label>
                                    <input type="text" class="form-input" name="full_name" placeholder="John Doe" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Email <span class="required">*</span></label>
                                    <input type="email" class="form-input" name="email" placeholder="john@example.com" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Nomor Telepon <span class="required">*</span></label>
                                    <input type="tel" class="form-input" name="phone" placeholder="+62 812 3456 7890" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tanggal Lahir <span class="required">*</span></label>
                                    <input type="date" class="form-input" name="birth_date" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Alamat Lengkap <span class="required">*</span></label>
                                <textarea class="form-textarea" name="address" placeholder="Jl. Contoh No. 123, Jakarta" required></textarea>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Kota <span class="required">*</span></label>
                                    <input type="text" class="form-input" name="city" placeholder="Jakarta" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">LinkedIn <span class="optional">(Opsional)</span></label>
                                    <input type="url" class="form-input" name="linkedin" placeholder="https://linkedin.com/in/johndoe">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Ringkasan Profil <span class="required">*</span></label>
                                <textarea class="form-textarea" name="summary" placeholder="Ceritakan tentang diri Anda, keahlian, dan tujuan karir..." required style="min-height: 120px;"></textarea>
                                <small class="form-help">Tuliskan ringkasan singkat tentang diri Anda (2-3 kalimat)</small>
                            </div>

                            <div class="form-navigation">
                                <div></div>
                                <button type="button" class="btn-nav btn-next" onclick="nextStep()">
                                    Selanjutnya <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </section>

                        <!-- STEP 2: PENDIDIKAN -->
                        <section class="form-section active" data-section="2">
                            <div class="section-header">
                                <h1 class="section-title">🎓 Pendidikan</h1>
                                <p class="section-subtitle">Tambahkan riwayat pendidikan Anda, mulai dari yang terbaru</p>
                            </div>

                            <div id="educationContainer"></div>

                            <button type="button" class="btn-add-more" onclick="addEducation()">
                                <i class="fas fa-plus-circle"></i> Tambah Pendidikan
                            </button>

                            <div class="form-navigation">
                                <button type="button" class="btn-nav btn-prev" onclick="prevStep()">
                                    <i class="fas fa-arrow-left"></i> Sebelumnya
                                </button>
                                <button type="button" class="btn-nav btn-next" onclick="nextStep()">
                                    Selanjutnya <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </section>

                        <!-- STEP 3: PENGALAMAN -->
                        <section class="form-section" data-section="3">
                            <div class="section-header">
                                <h1 class="section-title">💼 Pengalaman Kerja</h1>
                                <p class="section-subtitle">Tambahkan pengalaman kerja Anda, mulai dari yang terbaru</p>
                            </div>

                            <div id="experienceContainer"></div>

                            <button type="button" class="btn-add-more" onclick="addExperience()">
                                <i class="fas fa-plus-circle"></i> Tambah Pengalaman
                            </button>

                            <div class="form-navigation">
                                <button type="button" class="btn-nav btn-prev" onclick="prevStep()">
                                    <i class="fas fa-arrow-left"></i> Sebelumnya
                                </button>
                                <button type="button" class="btn-nav btn-next" onclick="nextStep()">
                                    Selanjutnya <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </section>

                        <!-- STEP 4: KETERAMPILAN -->
                        <section class="form-section" data-section="4">
                            <div class="section-header">
                                <h1 class="section-title">🚀 Keterampilan</h1>
                                <p class="section-subtitle">Tambahkan keterampilan yang Anda kuasai</p>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Keterampilan Teknis <span class="required">*</span></label>
                                <div class="skills-container" id="technicalSkillsContainer" onclick="document.getElementById('technicalSkillInput').focus()">
                                    <div class="skill-input-wrapper">
                                        <input type="text" class="skill-input" id="technicalSkillInput" placeholder="Ketik skill, tekan Enter" onkeypress="handleSkillInput(event, 'technical')">
                                    </div>
                                </div>
                                <small class="form-help">Contoh: JavaScript, Python, Adobe Photoshop, Project Management</small>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Soft Skills <span class="optional">(Opsional)</span></label>
                                <div class="skills-container" id="softSkillsContainer" onclick="document.getElementById('softSkillInput').focus()">
                                    <div class="skill-input-wrapper">
                                        <input type="text" class="skill-input" id="softSkillInput" placeholder="Ketik skill, tekan Enter" onkeypress="handleSkillInput(event, 'soft')">
                                    </div>
                                </div>
                                <small class="form-help">Contoh: Leadership, Communication, Problem Solving, Teamwork</small>
                            </div>

                            <div class="form-navigation">
                                <button type="button" class="btn-nav btn-prev" onclick="prevStep()">
                                    <i class="fas fa-arrow-left"></i> Sebelumnya
                                </button>
                                <button type="button" class="btn-nav btn-next" onclick="nextStep()">
                                    Selanjutnya <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </section>

                        <!-- STEP 5: INFORMASI TAMBAHAN -->
                        <section class="form-section" data-section="5">
                            <div class="section-header">
                                <h1 class="section-title">✨ Informasi Tambahan</h1>
                                <p class="section-subtitle">Lengkapi informasi tambahan untuk membuat CV Anda lebih menarik (Opsional)</p>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Portfolio Website <span class="optional">(Opsional)</span></label>
                                <input type="url" class="form-input" name="portfolio" placeholder="https://yourportfolio.com">
                                <small class="form-help">Link ke website portfolio atau karya Anda</small>
                            </div>

                            <div class="form-group">
                                <label class="form-label">GitHub <span class="optional">(Opsional)</span></label>
                                <input type="url" class="form-input" name="github" placeholder="https://github.com/yourusername">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Sertifikat & Penghargaan <span class="optional">(Opsional)</span></label>
                                <textarea class="form-textarea" name="certifications" placeholder="Tuliskan sertifikat atau penghargaan yang pernah Anda dapatkan (pisahkan dengan enter)"></textarea>
                                <small class="form-help">Contoh: AWS Certified Solutions Architect, Google Analytics Certification</small>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Bahasa yang Dikuasai <span class="optional">(Opsional)</span></label>
                                <textarea class="form-textarea" name="languages" placeholder="Bahasa Indonesia - Native&#10;English - Fluent&#10;Mandarin - Intermediate"></textarea>
                                <small class="form-help">Tuliskan bahasa dan tingkat kemahiran (Native, Fluent, Intermediate, Basic)</small>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Hobi & Minat <span class="optional">(Opsional)</span></label>
                                <input type="text" class="form-input" name="hobbies" placeholder="Fotografi, Traveling, Blogging">
                            </div>

                            <div class="form-navigation">
                                <button type="button" class="btn-nav btn-prev" onclick="prevStep()">
                                    <i class="fas fa-arrow-left"></i> Sebelumnya
                                </button>
                                <button type="submit" class="btn-nav btn-submit" onclick="submitForm(event)">
                                    <i class="fas fa-check-circle"></i> Selesai & Buat CV
                                </button>
                            </div>
                        </section>
                    </form>
                </div>
            </div>
        </main>

        <!-- FOOTER -->
        <footer>
            <div class="footer-container">
                <div class="footer-content">
                    <div>
                        <div class="footer-logo">ResuMate</div>
                        <p class="footer-desc">Platform terpercaya untuk membuat CV profesional dengan mudah dan cepat. Wujudkan karir impian Anda bersama kami.</p>
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

        <button id="backToTop" onclick="scrollToTop()">
            <i class="fas fa-arrow-up"></i>
        </button>

        <script>
            // ============================================================
            // THEME TOGGLE
            // ============================================================
            const savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', savedTheme);

            const themeToggle = document.getElementById('themeToggle');
            const themeIcon = themeToggle.querySelector('i');

            if (savedTheme === 'dark') {
                themeIcon.classList.replace('fa-moon', 'fa-sun');
            }

            themeToggle.addEventListener('click', () => {
                const current = document.documentElement.getAttribute('data-theme');
                const next = current === 'dark' ? 'light' : 'dark';
                document.documentElement.setAttribute('data-theme', next);
                localStorage.setItem('theme', next);
                themeIcon.classList.replace(next === 'dark' ? 'fa-moon' : 'fa-sun', next === 'dark' ? 'fa-sun' : 'fa-moon');
            });

            // ============================================================
            // PROFILE DROPDOWN
            // ============================================================
            const navProfile = document.getElementById('navProfile');
            const profileToggle = document.getElementById('profileToggle');

            profileToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                navProfile.classList.toggle('open');
            });

            document.addEventListener('click', function(e) {
                if (!navProfile.contains(e.target)) {
                    navProfile.classList.remove('open');
                }
            });

            function handleLogout() {
                if (confirm('Apakah Anda yakin ingin keluar?')) {
                    window.location.href = 'index.html';
                }
            }

            // ============================================================
            // MOBILE MENU
            // ============================================================
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const navMenu = document.getElementById('navMenu');

            mobileMenuToggle.addEventListener('click', function() {
                navMenu.classList.toggle('active');
            });

            // ============================================================
            // BACK TO TOP
            // ============================================================
            window.addEventListener('scroll', () => {
                document.getElementById('backToTop').classList.toggle('show', window.pageYOffset > 300);
            });

            function scrollToTop() {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }

            // ============================================================
            // FORM LOGIC
            // ============================================================
            let currentStep = 1;
            let educationCount = 0;
            let experienceCount = 0;
            const technicalSkills = [];
            const softSkills = [];

            window.addEventListener('DOMContentLoaded', () => {
                addEducation();
                addExperience();
            });

            function goToStep(step) {
                if (step > currentStep && !validateStep(currentStep)) return;

                document.querySelectorAll('.form-section').forEach(s => s.classList.remove('active'));
                document.querySelector(`[data-section="${step}"]`).classList.add('active');

                document.querySelectorAll('.step-item').forEach(item => {
                    const n = parseInt(item.dataset.step);
                    item.classList.toggle('active', n === step);
                    item.classList.toggle('completed', n < step);
                });

                currentStep = step;
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }

            function nextStep() { if (validateStep(currentStep)) goToStep(currentStep + 1); }
            function prevStep() { goToStep(currentStep - 1); }

            function validateStep(step) {
                const section = document.querySelector(`[data-section="${step}"]`);
                let isValid = true;

                section.querySelectorAll('[required]').forEach(input => {
                    if (!input.value.trim()) {
                        input.style.borderColor = 'var(--danger-color)';
                        isValid = false;
                        setTimeout(() => input.style.borderColor = '', 3000);
                    }
                });

                if (!isValid) alert('Mohon lengkapi semua field yang wajib diisi (*)');
                return isValid;
            }

            // Photo Upload
            function handlePhotoUpload(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        document.getElementById('photoPreviewImg').src = e.target.result;
                        document.getElementById('photoPreview').classList.add('show');
                    };
                    reader.readAsDataURL(file);
                }
            }

            function removePhoto() {
                document.getElementById('photoInput').value = '';
                document.getElementById('photoPreview').classList.remove('show');
            }

            // Education
            function addEducation() {
                const container = document.getElementById('educationContainer');
                const index = educationCount++;

                container.insertAdjacentHTML('beforeend', `
                    <div class="dynamic-item" data-index="${index}">
                        <div class="dynamic-item-header">
                            <h3 class="dynamic-item-title">Pendidikan #${index + 1}</h3>
                            ${index > 0 ? `<button type="button" class="btn-remove-item" onclick="removeEducation(${index})"><i class="fas fa-trash"></i> Hapus</button>` : ''}
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Institusi <span class="required">*</span></label>
                                <input type="text" class="form-input" name="education_institution[]" placeholder="Universitas Indonesia" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Gelar / Jurusan <span class="required">*</span></label>
                                <input type="text" class="form-input" name="education_degree[]" placeholder="S1 Teknik Informatika" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Tahun Mulai <span class="required">*</span></label>
                                <input type="number" class="form-input" name="education_start[]" placeholder="2018" min="1950" max="2030" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tahun Selesai</label>
                                <input type="number" class="form-input" name="education_end[]" placeholder="2022" min="1950" max="2030" id="educationEnd${index}">
                            </div>
                        </div>
                        <div class="checkbox-wrapper">
                            <input type="checkbox" id="currentEducation${index}" onchange="toggleEducationEnd(${index})">
                            <label for="currentEducation${index}">Saat ini masih berkuliah di sini</label>
                        </div>
                        <div class="form-group" style="margin-top:16px;">
                            <label class="form-label">Deskripsi <span class="optional">(Opsional)</span></label>
                            <textarea class="form-textarea" name="education_description[]" placeholder="IPK, prestasi, organisasi..."></textarea>
                        </div>
                    </div>`);
            }

            function removeEducation(index) {
                document.querySelector(`#educationContainer .dynamic-item[data-index="${index}"]`)?.remove();
            }

            function toggleEducationEnd(index) {
                const cb = document.getElementById(`currentEducation${index}`);
                const input = document.getElementById(`educationEnd${index}`);
                input.value = cb.checked ? 'Sekarang' : '';
                input.disabled = cb.checked;
            }

            // Experience
            function addExperience() {
                const container = document.getElementById('experienceContainer');
                const index = experienceCount++;

                container.insertAdjacentHTML('beforeend', `
                    <div class="dynamic-item" data-index="${index}">
                        <div class="dynamic-item-header">
                            <h3 class="dynamic-item-title">Pengalaman #${index + 1}</h3>
                            ${index > 0 ? `<button type="button" class="btn-remove-item" onclick="removeExperience(${index})"><i class="fas fa-trash"></i> Hapus</button>` : ''}
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Perusahaan <span class="required">*</span></label>
                                <input type="text" class="form-input" name="experience_company[]" placeholder="PT. Teknologi Indonesia" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Posisi / Jabatan <span class="required">*</span></label>
                                <input type="text" class="form-input" name="experience_position[]" placeholder="Software Engineer" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Bulan & Tahun Mulai <span class="required">*</span></label>
                                <input type="month" class="form-input" name="experience_start[]" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Bulan & Tahun Selesai</label>
                                <input type="month" class="form-input" name="experience_end[]" id="experienceEnd${index}">
                            </div>
                        </div>
                        <div class="checkbox-wrapper">
                            <input type="checkbox" id="currentWork${index}" onchange="toggleExperienceEnd(${index})">
                            <label for="currentWork${index}">Saat ini masih bekerja di sini</label>
                        </div>
                        <div class="form-group" style="margin-top:16px;">
                            <label class="form-label">Deskripsi Pekerjaan <span class="required">*</span></label>
                            <textarea class="form-textarea" name="experience_description[]" placeholder="Jelaskan tugas, tanggung jawab, dan pencapaian Anda..." required style="min-height: 120px;"></textarea>
                            <small class="form-help">Gunakan bullet points untuk menjelaskan pencapaian Anda</small>
                        </div>
                    </div>`);
            }

            function removeExperience(index) {
                document.querySelector(`#experienceContainer .dynamic-item[data-index="${index}"]`)?.remove();
            }

            function toggleExperienceEnd(index) {
                const cb = document.getElementById(`currentWork${index}`);
                const input = document.getElementById(`experienceEnd${index}`);
                input.value = cb.checked ? 'Sekarang' : '';
                input.disabled = cb.checked;
            }

            // Skills
            function handleSkillInput(event, type) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    const input = event.target;
                    const skill = input.value.trim();
                    if (skill) { addSkillTag(skill, type); input.value = ''; }
                }
            }

            function addSkillTag(skill, type) {
                const container = document.getElementById(`${type}SkillsContainer`);
                const wrapper = container.querySelector('.skill-input-wrapper');
                const tag = document.createElement('span');
                tag.className = 'skill-tag';
                tag.innerHTML = `${skill} <i class="fas fa-times" onclick="removeSkillTag(this, '${skill}', '${type}')"></i>`;
                container.insertBefore(tag, wrapper);
                (type === 'technical' ? technicalSkills : softSkills).push(skill);
            }

            function removeSkillTag(el, skill, type) {
                el.parentElement.remove();
                const arr = type === 'technical' ? technicalSkills : softSkills;
                const i = arr.indexOf(skill);
                if (i > -1) arr.splice(i, 1);
            }

            // Submit
            function submitForm(event) {
                event.preventDefault();
                if (!validateStep(5)) return;
                if (technicalSkills.length === 0) {
                    alert('Mohon tambahkan minimal 1 keterampilan teknis');
                    return;
                }
                document.getElementById('successModal').classList.add('show');
            }

            function downloadCV() {
                alert('Download CV akan dimulai...\n\n(Fitur download akan diintegrasikan dengan backend)');
            }

            function editCV() {
                document.getElementById('successModal').classList.remove('show');
                goToStep(1);
            }
        </script>
    </body>
    </html>