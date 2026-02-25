<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit CV - ResuMate</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Sora:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #fafafa;
            color: #1f2937;
            overflow: hidden;
        }

        .editor-layout {
            display: flex;
            height: 100vh;
            background: #fafafa;
        }

        .sidebar {
            width: 380px;
            background: white;
            border-right: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .sidebar-top {
            padding: 24px 20px 20px;
            border-bottom: 1px solid #f3f4f6;
            background: white;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #6b7280;
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 20px;
            font-weight: 500;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: #1f2937;
        }

        .template-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background: #f0fdf4;
            border: 1px solid #86efac;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            color: #16a34a;
            margin-bottom: 16px;
        }

        .sidebar-title {
            font-family: 'Sora', sans-serif;
            font-size: 20px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 8px;
            letter-spacing: -0.02em;
        }

        .sidebar-subtitle {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 24px;
        }

        .tabs {
            display: flex;
            gap: 0;
            background: #f9fafb;
            padding: 4px;
            border-radius: 10px;
        }

        .tab {
            flex: 1;
            padding: 10px 12px;
            background: transparent;
            border: none;
            border-radius: 7px;
            font-size: 13px;
            font-weight: 600;
            color: #6b7280;
            cursor: pointer;
            transition: all 0.15s;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
        }

        .tab i {
            font-size: 16px;
        }

        .tab.active {
            background: white;
            color: #16a34a;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }

        .sidebar-content {
            flex: 1;
            overflow-y: auto;
            padding: 24px 20px;
        }

        .sidebar-content::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-content::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 10px;
        }

        .section {
            display: none;
        }

        .section.active {
            display: block;
        }

        .section-header {
            margin-bottom: 20px;
        }

        .section-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #16a34a;
            margin-bottom: 16px;
        }

        .field {
            margin-bottom: 20px;
        }

        .label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        .required-mark {
            color: #ef4444;
        }

        .input,
        .select,
        .textarea {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            color: #111827;
            background: white;
            transition: all 0.2s;
        }

        .input:focus,
        .select:focus,
        .textarea:focus {
            outline: none;
            border-color: #16a34a;
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.08);
        }

        .input::placeholder {
            color: #9ca3af;
        }

        .textarea {
            min-height: 90px;
            resize: vertical;
        }

        .field-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .photo-upload {
            display: flex;
            gap: 16px;
            align-items: center;
            padding: 16px;
            background: #f9fafb;
            border: 1.5px dashed #d1d5db;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .photo-circle {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            overflow: hidden;
            border: 2px solid #e5e7eb;
        }

        .photo-circle i {
            font-size: 24px;
            color: #9ca3af;
        }

        .photo-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .photo-text {
            flex: 1;
        }

        .photo-text h4 {
            font-size: 14px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 4px;
        }

        .photo-text p {
            font-size: 12px;
            color: #6b7280;
        }

        .upload-btn {
            padding: 8px 16px;
            background: white;
            border: 1.5px solid #d1d5db;
            border-radius: 7px;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            cursor: pointer;
            transition: all 0.2s;
        }

        .upload-btn:hover {
            border-color: #16a34a;
            color: #16a34a;
        }

        .card {
            background: #fafafa;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 16px;
            transition: all 0.2s;
        }

        .card:hover {
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .card-title {
            font-size: 14px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 2px;
        }

        .card-subtitle {
            font-size: 12px;
            color: #6b7280;
        }

        .card-actions {
            display: flex;
            gap: 4px;
        }

        .icon-btn {
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            color: #6b7280;
            cursor: pointer;
            transition: all 0.2s;
        }

        .icon-btn:hover {
            background: #f9fafb;
            color: #111827;
        }

        .icon-btn.delete:hover {
            background: #fef2f2;
            border-color: #fecaca;
            color: #dc2626;
        }

        .add-btn {
            width: 100%;
            padding: 10px;
            background: white;
            border: 1.5px dashed #d1d5db;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #16a34a;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: all 0.2s;
            margin-top: 12px;
        }

        .add-btn:hover {
            background: #f0fdf4;
            border-color: #16a34a;
        }

        .tags-input {
            padding: 10px;
            border: 1.5px solid #e5e7eb;
            border-radius: 8px;
            background: white;
            min-height: 44px;
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            cursor: text;
        }

        .tags-input:focus-within {
            border-color: #16a34a;
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.08);
        }

        .tag-item {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 5px 10px;
            background: #16a34a;
            color: white;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
        }

        .tag-remove {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
            opacity: 0.7;
        }

        .tag-remove:hover {
            opacity: 1;
        }

        .tag-field {
            flex: 1;
            min-width: 100px;
            border: none;
            outline: none;
            font-size: 14px;
            font-family: inherit;
        }

        .preview-area {
            flex: 1;
            background: #f3f4f6;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .preview-header {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .preview-actions {
            display: flex;
            gap: 10px;
        }

        .action-btn {
            padding: 9px 18px;
            border: 1.5px solid #e5e7eb;
            background: white;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .action-btn:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }

        .action-btn.primary {
            background: #16a34a;
            border-color: #16a34a;
            color: white;
        }

        .action-btn.primary:hover {
            background: #15803d;
            box-shadow: 0 2px 8px rgba(22, 163, 74, 0.2);
        }

        .zoom-tools {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 8px;
            background: #f9fafb;
            border-radius: 8px;
        }

        .zoom-btn {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            color: #6b7280;
            cursor: pointer;
            transition: all 0.2s;
        }

        .zoom-btn:hover {
            color: #111827;
            border-color: #d1d5db;
        }

        .zoom-value {
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            min-width: 42px;
            text-align: center;
        }

        .preview-canvas {
            flex: 1;
            overflow: auto;
            padding: 40px;
            display: flex;
            justify-content: center;
        }

        .preview-canvas::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        .preview-canvas::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 10px;
        }

        .cv-sheet {
            width: 210mm;
            min-height: 297mm;
            background: white;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border-radius: 2px;
            transform-origin: top center;
            transition: transform 0.2s;
        }

        .cv-top {
            position: relative;
            padding: 48px 48px 32px;
        }

        .cv-name {
            font-family: 'Sora', sans-serif;
            font-size: 48px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 48px;
            letter-spacing: -0.03em;
            line-height: 1.1;
        }

        .cv-image {
            position: absolute;
            top: 48px;
            right: 48px;
            width: 140px;
            height: 180px;
            border-radius: 4px;
            overflow: hidden;
            background: linear-gradient(135deg, #7c2d12, #991b1b);
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        }

        .cv-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .cv-block {
            padding: 0 48px 5px;
        }

        .block-head {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .block-icon {
            width: 36px;
            height: 36px;
            background: #111827;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .block-icon i {
            color: white;
            font-size: 15px;
        }

        .block-title {
            font-family: 'Sora', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: #111827;
            letter-spacing: 0.03em;
        }

        .data-table {
            width: 100%;
            font-size: 14px;
            line-height: 1.9;
        }

        .data-table td {
            padding: 2px 0;
        }

        .data-label {
            color: #111827;
            font-weight: 600;
            width: 180px;
            padding-right: 20px;
        }

        .data-value {
            color: #4b5563;
        }

        .data-table.split .data-label {
            width: 280px;
        }

        .data-table.split .data-value {
            width: 240px;
        }

        .data-table.split .data-year {
            text-align: right;
            color: #6b7280;
            font-weight: 500;
        }

        .skill-list p {
            font-size: 14px;
            line-height: 1.9;
            color: #4b5563;
            margin-bottom: 4px;
        }

        .skill-list .lang {
            margin-top: 16px;
            font-weight: 600;
            color: #111827;
        }

        .notify {
            position: fixed;
            bottom: 24px;
            right: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            background: white;
            border-left: 4px solid #16a34a;
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
            transform: translateY(120px);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            z-index: 1000;
        }

        .notify.show {
            transform: translateY(0);
            opacity: 1;
        }

        .notify i {
            font-size: 18px;
            color: #16a34a;
        }

        .notify span {
            font-size: 14px;
            font-weight: 600;
            color: #111827;
        }

        .hint-text {
            font-size: 12px;
            color: #6b7280;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        @media (max-width: 1200px) {
            .sidebar {
                width: 340px;
            }
        }

        @media (max-width: 992px) {
            .editor-layout {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                height: 50vh;
            }
            
            .preview-area {
                height: 50vh;
            }
        }
    </style>
</head>
<body>

<div class="editor-layout">
    
    <div class="sidebar">
        
        <div class="sidebar-top">
            <a href="{{ url('/templates') }}" class="back-link">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Template
            </a>
            
            <div class="template-badge">
                <i class="fas fa-check-circle"></i>
                Template Aktif
            </div>
            
            <h1 class="sidebar-title">Edit CV Anda</h1>
            <p class="sidebar-subtitle">Isi informasi dengan lengkap dan jujur</p>
            
            <div class="tabs">
                <button class="tab active" data-section="personal">
                    <i class="fas fa-user"></i>
                    <span>Pribadi</span>
                </button>
                <button class="tab" data-section="experience">
                    <i class="fas fa-briefcase"></i>
                    <span>Pengalaman</span>
                </button>
                <button class="tab" data-section="education">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Pendidikan</span>
                </button>
                <button class="tab" data-section="skills">
                    <i class="fas fa-star"></i>
                    <span>Keahlian</span>
                </button>
            </div>
        </div>

        <div class="sidebar-content">
            
            <div class="section active" id="section-personal">
                
                <div class="section-header">
                    <div class="section-label">
                        <i class="fas fa-user-circle"></i>
                        Data Pribadi
                    </div>
                </div>

                <div class="photo-upload">
                    <div class="photo-circle">
                        <i class="fas fa-camera"></i>
                    </div>
                    <div class="photo-text">
                        <h4>Foto Profil</h4>
                        <p>JPG atau PNG, maks. 2MB</p>
                    </div>
                    <button class="upload-btn">Pilih</button>
                </div>

                <div class="field">
                    <label class="label">Nama Lengkap <span class="required-mark">*</span></label>
                    <input type="text" class="input" placeholder="Contoh: Ahmad Rizki Pratama" value="Muhammad Patel">
                </div>

                <div class="field-row">
                    <div class="field">
                        <label class="label">Tempat Lahir</label>
                        <input type="text" class="input" placeholder="Kota" value="Anywhere">
                    </div>
                    <div class="field">
                        <label class="label">Tanggal Lahir</label>
                        <input type="date" class="input" value="1998-05-16">
                    </div>
                </div>

                <div class="field-row">
                    <div class="field">
                        <label class="label">Jenis Kelamin</label>
                        <select class="select">
                            <option>Laki-laki</option>
                            <option>Perempuan</option>
                        </select>
                    </div>
                    <div class="field">
                        <label class="label">Agama</label>
                        <select class="select">
                            <option>Islam</option>
                            <option>Kristen</option>
                            <option>Katolik</option>
                            <option>Hindu</option>
                            <option>Buddha</option>
                        </select>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Alamat Lengkap</label>
                    <input type="text" class="input" placeholder="Jalan, No, RT/RW, Kelurahan, Kecamatan" value="Anywhere 123 St., Any City">
                </div>

                <div class="field-row">
                    <div class="field">
                        <label class="label">No. Telepon</label>
                        <input type="tel" class="input" placeholder="08xx xxxx xxxx" value="123-456-7890">
                    </div>
                    <div class="field">
                        <label class="label">Email</label>
                        <input type="email" class="input" placeholder="email@domain.com" value="hello@example.com">
                    </div>
                </div>

            </div>

            <div class="section" id="section-experience">
                
                <div class="section-header">
                    <div class="section-label">
                        <i class="fas fa-building"></i>
                        Riwayat Pengalaman
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-title">Ketua Himpunan Mahasiswa</div>
                            <div class="card-subtitle">Universitas Negeri Rimbeno</div>
                        </div>
                        <div class="card-actions">
                            <button class="icon-btn">
                                <i class="fas fa-grip-vertical"></i>
                            </button>
                            <button class="icon-btn delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Jabatan</label>
                        <input type="text" class="input" value="Ketua Himpunan Mahasiswa">
                    </div>

                    <div class="field">
                        <label class="label">Nama Organisasi</label>
                        <input type="text" class="input" value="Universitas Negeri Rimbeno">
                    </div>

                    <div class="field-row">
                        <div class="field">
                            <label class="label">Tahun Mulai</label>
                            <input type="text" class="input" value="2017">
                        </div>
                        <div class="field">
                            <label class="label">Tahun Selesai</label>
                            <input type="text" class="input" value="2021">
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-title">Karyawan Magang</div>
                            <div class="card-subtitle">Perusahaan Liceria</div>
                        </div>
                        <div class="card-actions">
                            <button class="icon-btn">
                                <i class="fas fa-grip-vertical"></i>
                            </button>
                            <button class="icon-btn delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Jabatan</label>
                        <input type="text" class="input" value="Karyawan Magang">
                    </div>

                    <div class="field">
                        <label class="label">Nama Perusahaan</label>
                        <input type="text" class="input" value="Perusahaan Liceria">
                    </div>

                    <div class="field-row">
                        <div class="field">
                            <label class="label">Tahun Mulai</label>
                            <input type="text" class="input" value="2021">
                        </div>
                        <div class="field">
                            <label class="label">Tahun Selesai</label>
                            <input type="text" class="input" value="2022">
                        </div>
                    </div>
                </div>

                <button class="add-btn">
                    <i class="fas fa-plus-circle"></i>
                    Tambah Pengalaman
                </button>

            </div>

            <div class="section" id="section-education">
                
                <div class="section-header">
                    <div class="section-label">
                        <i class="fas fa-school"></i>
                        Riwayat Pendidikan
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-title">Universitas Negeri Rimbeno</div>
                            <div class="card-subtitle">2017 - 2021</div>
                        </div>
                        <div class="card-actions">
                            <button class="icon-btn">
                                <i class="fas fa-grip-vertical"></i>
                            </button>
                            <button class="icon-btn delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Nama Institusi</label>
                        <input type="text" class="input" value="Universitas Negeri Rimbeno">
                    </div>

                    <div class="field-row">
                        <div class="field">
                            <label class="label">Tahun Mulai</label>
                            <input type="number" class="input" value="2017">
                        </div>
                        <div class="field">
                            <label class="label">Tahun Lulus</label>
                            <input type="number" class="input" value="2021">
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-title">SMA Negeri Liceria</div>
                            <div class="card-subtitle">2014 - 2017</div>
                        </div>
                        <div class="card-actions">
                            <button class="icon-btn">
                                <i class="fas fa-grip-vertical"></i>
                            </button>
                            <button class="icon-btn delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Nama Sekolah</label>
                        <input type="text" class="input" value="SMA Negeri Liceria">
                    </div>

                    <div class="field-row">
                        <div class="field">
                            <label class="label">Tahun Mulai</label>
                            <input type="number" class="input" value="2014">
                        </div>
                        <div class="field">
                            <label class="label">Tahun Lulus</label>
                            <input type="number" class="input" value="2017">
                        </div>
                    </div>
                </div>

                <button class="add-btn">
                    <i class="fas fa-plus-circle"></i>
                    Tambah Pendidikan
                </button>

            </div>

            <div class="section" id="section-skills">
                
                <div class="section-header">
                    <div class="section-label">
                        <i class="fas fa-lightbulb"></i>
                        Keahlian & Kemampuan
                    </div>
                </div>

                <div class="field">
                    <label class="label">Keterampilan Utama</label>
                    <div class="tags-input">
                        <div class="tag-item">
                            Mengoperasikan komputer
                            <button class="tag-remove"><i class="fas fa-times"></i></button>
                        </div>
                        <div class="tag-item">
                            Komunikasi tim
                            <button class="tag-remove"><i class="fas fa-times"></i></button>
                        </div>
                        <div class="tag-item">
                            Problem solving
                            <button class="tag-remove"><i class="fas fa-times"></i></button>
                        </div>
                        <input type="text" class="tag-field" placeholder="Ketik & tekan Enter...">
                    </div>
                    <div class="hint-text">
                        <i class="fas fa-info-circle"></i>
                        Tekan Enter untuk menambah keterampilan
                    </div>
                </div>

                <div class="field">
                    <label class="label">Bahasa yang Dikuasai</label>
                    <div class="tags-input">
                        <div class="tag-item">
                            Indonesia (Native)
                            <button class="tag-remove"><i class="fas fa-times"></i></button>
                        </div>
                        <div class="tag-item">
                            Inggris (Pasif)
                            <button class="tag-remove"><i class="fas fa-times"></i></button>
                        </div>
                        <input type="text" class="tag-field" placeholder="Ketik & tekan Enter...">
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="preview-area">
        
        <div class="preview-header">
            <div class="preview-actions">
                <button class="action-btn">
                    <i class="fas fa-file-pdf"></i>
                    Unduh PDF
                </button>
                <button class="action-btn">
                    <i class="fas fa-save"></i>
                    Simpan Draft
                </button>
                <button class="action-btn primary">
                    <i class="fas fa-check-circle"></i>
                    Selesai
                </button>
            </div>

            <div class="zoom-tools">
                <button class="zoom-btn">
                    <i class="fas fa-minus"></i>
                </button>
                <span class="zoom-value">100%</span>
                <button class="zoom-btn">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>

        <div class="preview-canvas">
            <div class="cv-sheet">
                
                <div class="cv-top">
                    <h1 class="cv-name">RIWAYAT HIDUP</h1>
                    <div class="cv-image"></div>
                </div>

                <div class="cv-block">
                    <div class="block-head">
                        <div class="block-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <h2 class="block-title">DATA PRIBADI</h2>
                    </div>

                    <table class="data-table">
                        <tr>
                            <td class="data-label">Nama</td>
                            <td class="data-value">: Muhammad Patel</td>
                        </tr>
                        <tr>
                            <td class="data-label">Tempat, Tanggal Lahir</td>
                            <td class="data-value">: Anywhere, 16 Mei 1998</td>
                        </tr>
                        <tr>
                            <td class="data-label">Jenis Kelamin</td>
                            <td class="data-value">: Laki-laki</td>
                        </tr>
                        <tr>
                            <td class="data-label">Agama</td>
                            <td class="data-value">: Islam</td>
                        </tr>
                        <tr>
                            <td class="data-label">Alamat</td>
                            <td class="data-value">: Anywhere 123 St., Any City</td>
                        </tr>
                        <tr>
                            <td class="data-label">Nomor Telepon</td>
                            <td class="data-value">: 123-456-7890</td>
                        </tr>
                        <tr>
                            <td class="data-label">Email</td>
                            <td class="data-value">: hello@example.com</td>
                        </tr>
                    </table>
                </div>

                <div class="cv-block">
                    <div class="block-head">
                        <div class="block-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h2 class="block-title">RIWAYAT PENDIDIKAN</h2>
                    </div>

                    <table class="data-table">
                        <tr>
                            <td class="data-label">Universitas Negeri Rimbeno</td>
                            <td class="data-year">2017-2021</td>
                        </tr>
                        <tr>
                            <td class="data-label">SMA Negeri Liceria</td>
                            <td class="data-year">2014-2017</td>
                        </tr>
                        <tr>
                            <td class="data-label">SMP Negeri Fauget</td>
                            <td class="data-year">2011-2014</td>
                        </tr>
                        <tr>
                            <td class="data-label">SD Negeri Borcelle</td>
                            <td class="data-year">2005-2011</td>
                        </tr>
                    </table>
                </div>

                <div class="cv-block">
                    <div class="block-head">
                        <div class="block-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h2 class="block-title">PENGALAMAN ORGANISASI</h2>
                    </div>

                    <table class="data-table split">
                        <tr>
                            <td class="data-label">Ketua Himpunan Mahasiswa</td>
                            <td class="data-value">Universitas Negeri Rimbeno</td>
                            <td class="data-year">2017-2021</td>
                        </tr>
                        <tr>
                            <td class="data-label">Ketua Osis</td>
                            <td class="data-value">SMA Negeri Liceria</td>
                            <td class="data-year">2014-2017</td>
                        </tr>
                    </table>
                </div>

                <div class="cv-block">
                    <div class="block-head">
                        <div class="block-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <h2 class="block-title">PENGALAMAN KERJA</h2>
                    </div>

                    <table class="data-table split">
                        <tr>
                            <td class="data-label">Karyawan Magang</td>
                            <td class="data-value">Perusahaan Liceria</td>
                            <td class="data-year">2021-2022</td>
                        </tr>
                        <tr>
                            <td class="data-label">Pekerja Lepas</td>
                            <td class="data-value">Wardiere Inc.</td>
                            <td class="data-year">2020-2021</td>
                        </tr>
                    </table>
                </div>

                <div class="cv-block">
                    <div class="block-head">
                        <div class="block-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <h2 class="block-title">KEMAMPUAN</h2>
                    </div>

                    <div class="skill-list">
                        <p>Mampu mengoperasikan perangkat lunak</p>
                        <p>Mampu berkomunikasi dengan baik</p>
                        <p>Mampu bekerja sama dengan tim</p>
                        <p class="lang"><strong>Bahasa:</strong> Indonesia, Inggris Pasif</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<div class="notify">
    <i class="fas fa-check-circle"></i>
    <span>Perubahan tersimpan!</span>
</div>

<script>
const tabs = document.querySelectorAll('.tab');
const sections = document.querySelectorAll('.section');

tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        tabs.forEach(t => t.classList.remove('active'));
        sections.forEach(s => s.classList.remove('active'));
        tab.classList.add('active');
        document.getElementById('section-' + tab.dataset.section).classList.add('active');
    });
});

const uploadBtn = document.querySelector('.upload-btn');
const photoCircle = document.querySelector('.photo-circle');
const cvImage = document.querySelector('.cv-image');

uploadBtn.addEventListener('click', () => {
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';
    input.onchange = (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                photoCircle.innerHTML = `<img src="${e.target.result}">`;
                cvImage.innerHTML = `<img src="${e.target.result}">`;
            };
            reader.readAsDataURL(file);
        }
    };
    input.click();
});

document.querySelectorAll('.tags-input').forEach(container => {
    const input = container.querySelector('.tag-field');
    input.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' && input.value.trim()) {
            e.preventDefault();
            const tag = document.createElement('div');
            tag.className = 'tag-item';
            tag.innerHTML = `${input.value.trim()}<button class="tag-remove"><i class="fas fa-times"></i></button>`;
            container.insertBefore(tag, input);
            input.value = '';
            tag.querySelector('.tag-remove').addEventListener('click', () => tag.remove());
        }
    });
});

document.querySelectorAll('.tag-remove').forEach(btn => {
    btn.addEventListener('click', () => btn.closest('.tag-item').remove());
});

const addBtns = document.querySelectorAll('.add-btn');
addBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        const notify = document.querySelector('.notify');
        notify.classList.add('show');
        setTimeout(() => notify.classList.remove('show'), 2000);
    });
});

const zoomBtns = document.querySelectorAll('.zoom-btn');
const zoomValue = document.querySelector('.zoom-value');
const cvSheet = document.querySelector('.cv-sheet');
let zoom = 100;

zoomBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        if (btn.querySelector('.fa-plus') && zoom < 150) {
            zoom += 10;
        } else if (btn.querySelector('.fa-minus') && zoom > 50) {
            zoom -= 10;
        }
        zoomValue.textContent = zoom + '%';
        cvSheet.style.transform = `scale(${zoom / 100})`;
    });
});

const actionBtns = document.querySelectorAll('.action-btn');
actionBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        const notify = document.querySelector('.notify');
        const span = notify.querySelector('span');
        
        if (btn.textContent.includes('PDF')) {
            span.textContent = 'PDF berhasil diunduh!';
        } else if (btn.textContent.includes('Draft')) {
            span.textContent = 'Draft tersimpan!';
        } else {
            span.textContent = 'CV selesai dibuat!';
        }
        
        notify.classList.add('show');
        setTimeout(() => notify.classList.remove('show'), 2500);
    });
});

console.log('Editor ready');
</script>

</body>
</html>