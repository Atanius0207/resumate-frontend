@extends('layouts.admin')

@section('title', 'Buat Template Baru')

@push('styles')
<style>
    /* =========================================
       1. THEME VARIABLES (Sama persis dengan Index)
       ========================================= */
    :root {
        /* --- Light Mode Default --- */
        --primary-color: #4CAF50;
        --primary-soft: rgba(76, 175, 80, 0.1);
        --primary-hover-bg: rgba(76, 175, 80, 0.08);
        
        --bg-body: #f8fafc;
        --bg-card: #ffffff;
        --bg-input: #ffffff;
        --bg-header-builder: #f1f5f9; /* Header untuk section builder */
        
        --text-main: #0f172a;     
        --text-muted: #64748b;    
        --text-light: #94a3b8;
        
        --border-color: #e2e8f0;
        --border-dashed: #cbd5e1;

        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow-card: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        
        /* Button Colors */
        --btn-soft-success-bg: #dcfce7;
        --btn-soft-success-text: #166534;
        --btn-soft-danger-bg: #fef2f2;
        --btn-soft-danger-text: #EF4444;
        --btn-soft-danger-border: #fee2e2;
    }

    /* --- Dark Mode Overrides --- */
    html.dark, [data-theme="dark"] {
        --bg-body: #0f172a;       
        --bg-card: #1e293b;       
        --bg-input: #334155;      
        --bg-header-builder: #334155; 
        
        --text-main: #f8fafc;     
        --text-muted: #94a3b8;    
        --text-light: #64748b;
        
        --border-color: #334155;  
        --border-dashed: #475569;
        
        --primary-soft: rgba(76, 175, 80, 0.2); 
        --primary-hover-bg: rgba(76, 175, 80, 0.15);
        
        --shadow-sm: none;
        --shadow-card: 0 10px 15px -3px rgba(0, 0, 0, 0.5);

        /* Button Colors Dark */
        --btn-soft-success-bg: rgba(22, 101, 52, 0.4);
        --btn-soft-success-text: #86efac;
        --btn-soft-danger-bg: rgba(127, 29, 29, 0.4);
        --btn-soft-danger-text: #fca5a5;
        --btn-soft-danger-border: #7f1d1d;
    }

    /* Auto Dark Mode */
    @media (prefers-color-scheme: dark) {
        :root:not([data-theme="light"]) {
            --bg-body: #0f172a;
            --bg-card: #1e293b;
            --bg-input: #334155;
            --bg-header-builder: #334155;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --text-light: #64748b;
            --border-color: #334155;
            --border-dashed: #475569;
            --primary-soft: rgba(76, 175, 80, 0.2);
            --primary-hover-bg: rgba(76, 175, 80, 0.15);
            --shadow-sm: none;
            --shadow-card: 0 10px 15px -3px rgba(0, 0, 0, 0.5);
            --btn-soft-success-bg: rgba(22, 101, 52, 0.4);
            --btn-soft-success-text: #86efac;
            --btn-soft-danger-bg: rgba(127, 29, 29, 0.4);
            --btn-soft-danger-text: #fca5a5;
            --btn-soft-danger-border: #7f1d1d;
        }
    }

    /* =========================================
       2. LAYOUT & FORM STYLES
       ========================================= */
    body { background-color: var(--bg-body); color: var(--text-main); font-family: sans-serif; }

    /* Layout Grid */
    .create-template-wrapper {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
        align-items: start;
    }

    /* Card Standard */
    .card-section {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 24px;
        box-shadow: var(--shadow-sm);
    }

    .section-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--border-color);
    }

    /* Inputs */
    .form-group { margin-bottom: 20px; }
    .form-label { display: block; font-size: 13px; font-weight: 600; color: var(--text-main); margin-bottom: 8px; }
    
    .form-input, .form-textarea, .form-select {
        width: 100%;
        padding: 10px 14px;
        border-radius: 8px;
        border: 1px solid var(--border-color);
        background: var(--bg-input); 
        color: var(--text-main);
        font-size: 14px;
        outline: none;
        transition: 0.2s;
    }
    .form-input::placeholder { color: var(--text-muted); opacity: 0.7; }
    
    .form-input:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px var(--primary-soft);
    }
    
    .text-danger { color: #EF4444; font-size: 12px; margin-top: 4px; display: block; }
    .is-invalid { border-color: #EF4444 !important; }

    /* --- BUILDER AREA (RESPONSIVE & THEMED) --- */
    .builder-container {
        background: var(--bg-body); /* Agar terlihat 'dalam' */
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        min-height: 200px;
    }
    .builder-section {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        margin-bottom: 15px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }
    .section-header {
        background: var(--bg-header-builder);
        padding: 12px 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid var(--border-color);
        flex-wrap: wrap; 
        gap: 10px;
    }
    
    .builder-field {
        background: var(--bg-card);
        border: 1px dashed var(--border-dashed);
        padding: 12px;
        border-radius: 6px;
        margin-bottom: 10px;
        display: flex;
        gap: 10px;
        align-items: flex-start;
    }

    /* Grid khusus untuk baris input di dalam builder */
    .builder-row-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr 0.5fr; 
        gap: 10px;
        width: 100%;
        align-items: center;
    }

    /* Mini Inputs for Builder */
    .b-input, .b-select {
        padding: 8px 10px;
        border: 1px solid var(--border-color);
        border-radius: 4px;
        font-size: 13px;
        width: 100%;
        background: var(--bg-input);
        color: var(--text-main);
    }
    .b-label { font-size: 10px; color: var(--text-muted); display: block; margin-bottom: 2px; }

    /* Icons inside builder */
    .icon-grip { color: var(--text-light); cursor: move; }

    /* --- BUTTONS & ICONS --- */
    .btn-sm-icon {
        width: 32px; height: 32px; 
        display: flex; align-items: center; justify-content: center;
        border-radius: 6px; border: 1px solid var(--border-color);
        cursor: pointer; background: var(--bg-card); color: var(--text-muted);
        transition: 0.2s;
    }
    .btn-sm-icon:hover { background: var(--primary-hover-bg); color: var(--primary-color); border-color: var(--primary-color); }
    
    /* Specific Button Styles */
    .btn-add {
        background: var(--btn-soft-success-bg); 
        color: var(--btn-soft-success-text);
        border: 1px solid var(--btn-soft-success-bg); 
        padding: 10px 16px;
        border-radius: 6px; cursor: pointer;
        font-size: 13px; font-weight: 600;
        display: inline-flex; align-items: center; gap: 5px;
    }
    .btn-add-sm {
        margin-top: 10px; font-size: 12px; padding: 6px 12px;
    }
    
    .btn-delete-section {
        color: var(--btn-soft-danger-text);
        border-color: var(--btn-soft-danger-border);
        background: var(--btn-soft-danger-bg);
    }
    .btn-delete-section:hover { opacity: 0.8; }

    .btn-submit {
        background: var(--primary-color); color: white;
        border: none; padding: 12px 30px;
        border-radius: 8px; font-weight: 600; cursor: pointer;
        transition: 0.2s;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .btn-submit:hover { opacity: 0.9; transform: translateY(-1px); }

    /* --- UPLOAD & TOGGLES --- */
    .upload-area {
        border: 2px dashed var(--border-color);
        border-radius: 12px; padding: 20px;
        text-align: center; cursor: pointer;
        background: var(--bg-body); transition: 0.2s;
    }
    .upload-area:hover { border-color: var(--primary-color); background: var(--primary-hover-bg); }
    #image-preview { display: none; width: 100%; border-radius: 8px; margin-bottom: 10px; object-fit: cover; }
    
    .switch { position: relative; display: inline-block; width: 44px; height: 24px; }
    .switch input { opacity: 0; width: 0; height: 0; }
    .slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: var(--border-dashed); transition: .4s; border-radius: 34px; }
    .slider:before { position: absolute; content: ""; height: 18px; width: 18px; left: 3px; bottom: 3px; background-color: white; transition: .4s; border-radius: 50%; }
    input:checked + .slider { background-color: var(--primary-color); }
    input:checked + .slider:before { transform: translateX(20px); }

    .bottom-actions { margin-top: 30px; text-align: right; padding-bottom: 50px; }

    /* --- RESPONSIVE MEDIA QUERIES --- */
    @media (max-width: 900px) {
        .create-template-wrapper { grid-template-columns: 1fr; gap: 15px; }
        .builder-container { padding: 10px; }
        .builder-field { padding: 10px 8px; gap: 8px; }
        
        /* Grid Input Builder Mobile */
        .builder-row-grid {
            grid-template-columns: 1fr 1fr; 
            grid-template-rows: auto auto auto;
            gap: 8px 12px;
        }
        .builder-row-grid > div:nth-child(1) { grid-column: 1 / -1; }
        .builder-row-grid > div:nth-child(2) { grid-column: 1 / 2; }
        .builder-row-grid > div:nth-child(3) { grid-column: 2 / 3; }
        .builder-row-grid > div:nth-child(4) { grid-column: 1 / 2; }
        .builder-row-grid > div:nth-child(5) { 
            grid-column: 2 / 3; 
            display: flex; justify-content: flex-end; align-items: flex-end; height: 100%;
        }
        
        .bottom-actions { display: flex; flex-direction: column-reverse; gap: 15px; }
        .bottom-actions button, .bottom-actions a { width: 100%; text-align: center; margin: 0; }
        .btn-submit { width: 100%; padding: 14px; }
        
        .section-header input.b-input { width: 100%; margin-bottom: 5px; }
        .section-header > div:first-child { width: 100%; flex-wrap: wrap; margin-bottom: 8px; }
    }
</style>
@endpush

@section('content')

<div style="margin-bottom: 24px;">
    <h1 style="font-size: 24px; font-weight: 700; color: var(--text-main);">Buat Template Baru</h1>
    <p style="color: var(--text-muted);">Lengkapi informasi template dan atur form input CV-nya.</p>
</div>

<form id="createForm" action="{{ route('admin.templates.store') }}" method="POST" enctype="multipart/form-data">
    @csrf 
    <div class="create-template-wrapper">
        
        <div class="left-col">
            <div class="card-section">
                <h3 class="section-title">Informasi Dasar</h3>
                
                <div class="form-group">
                    <label class="form-label">Nama Template <span style="color:red">*</span></label>
                    <input type="text" name="name" class="form-input @error('name') is-invalid @enderror" 
                           placeholder="Contoh: Modern Blue Professional" value="{{ old('name') }}" required>
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi Singkat</label>
                    <textarea name="description" class="form-textarea" rows="4"
                              placeholder="Jelaskan keunggulan template ini...">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Tags (Pisahkan koma)</label>
                    <input type="text" name="tags" class="form-input" 
                           placeholder="Minimalis, ATS, Biru, Creative" value="{{ old('tags') }}">
                </div>
            </div>

            <div class="card-section">
                <h3 class="section-title">Harga & Tipe</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 20px;">
                    <div class="form-group">
                        <label class="form-label">Tipe Akses <span style="color:red">*</span></label>
                        <select name="type" id="typeSelect" class="form-select @error('type') is-invalid @enderror">
                            <option value="free" {{ old('type') == 'free' ? 'selected' : '' }}>Gratis (Free)</option>
                            <option value="pro" {{ old('type') == 'pro' ? 'selected' : '' }}>Berbayar (Pro)</option>
                        </select>
                        @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group" id="priceField" style="display:none;">
                        <label class="form-label">Harga (Rp)</label>
                        <input type="number" name="price" class="form-input @error('price') is-invalid @enderror" 
                               placeholder="0" value="{{ old('price') }}">
                        @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="right-col">
            <div class="card-section">
                <h3 class="section-title">Gambar Preview <span style="color:red">*</span></h3>
                
                <div class="upload-area @error('thumbnail') is-invalid @enderror" onclick="document.getElementById('fileInput').click()">
                    <img id="image-preview" src="#" alt="Preview">
                    <div id="placeholder-content">
                        <i class="fas fa-cloud-upload-alt" style="font-size:32px; color:var(--text-muted); margin-bottom:10px;"></i>
                        <p style="font-size:13px; font-weight:500; color:var(--text-main);">Klik untuk Upload</p>
                        <p style="font-size:11px; color:var(--text-muted);">Max 2MB (JPG/PNG)</p>
                    </div>
                    <input type="file" name="thumbnail" id="fileInput" hidden accept="image/*" onchange="previewImage(this)" required>
                </div>
                @error('thumbnail') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="card-section">
                <h3 class="section-title">Pengaturan</h3>
                
                <div class="form-group">
                    <label class="form-label">Kategori <span style="color:red">*</span></label>
                    <select name="category" class="form-select @error('category') is-invalid @enderror">
                        <option value="" disabled selected>Pilih Kategori</option>
                        <option value="Professional" {{ old('category') == 'Professional' ? 'selected' : '' }}>Professional</option>
                        <option value="Creative" {{ old('category') == 'Creative' ? 'selected' : '' }}>Creative</option>
                        <option value="Simple" {{ old('category') == 'Simple' ? 'selected' : '' }}>Simple</option>
                        <option value="Akademik" {{ old('category') == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                    </select>
                    @error('category') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div style="display:flex; justify-content:space-between; margin-bottom:15px; align-items:center;">
                    <div><h4 style="font-size:13px; font-weight:600;">Status Aktif</h4><p style="font-size:11px; color:var(--text-muted);">Tampilkan di katalog</p></div>
                    <label class="switch"><input type="checkbox" name="is_active" value="1" checked><span class="slider"></span></label>
                </div>

                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <div><h4 style="font-size:13px; font-weight:600;">Badge "New"</h4><p style="font-size:11px; color:var(--text-muted);">Label produk baru</p></div>
                    <label class="switch"><input type="checkbox" name="is_new" value="1" checked><span class="slider"></span></label>
                </div>
            </div>
        </div>

        <div class="card-section" style="grid-column: 1 / -1; border-top: 4px solid var(--primary-color);">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px; flex-wrap:wrap; gap:10px;">
                <h3 class="section-title" style="border:none; margin:0;">Form Builder (Desain Input User)</h3>
                <span style="font-size:12px; background:var(--bg-body); color:var(--text-muted); border:1px solid var(--border-color); padding:6px 10px; border-radius:4px; display:inline-block;">
                    <i class="fas fa-info-circle"></i> Atur kolom apa saja yang muncul
                </span>
            </div>

            <div id="builder-area" class="builder-container">
                </div>

            <button type="button" onclick="addSection()" class="btn-add" style="margin-top: 15px;">
                <i class="fas fa-plus-circle"></i> Tambah Section Baru
            </button>

            <textarea name="form_schema" id="hidden_schema" style="display: none;"></textarea>
            @error('form_schema') <span class="text-danger" style="margin-top:10px;">{{ $message }}</span> @enderror
        </div>

    </div>

    <div class="bottom-actions">
        <a href="{{ route('admin.templates.index') }}" style="margin-right:15px; color:var(--text-muted); text-decoration:none; font-weight:600; padding:10px;">Batal</a>
        <button type="submit" class="btn-submit">
            <i class="fas fa-save" style="margin-right:5px;"></i> Simpan Template
        </button>
    </div>
</form>

@endsection

@push('scripts')
<script>
    // --- 1. LOGIC IMAGE PREVIEW ---
    function previewImage(input) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('image-preview');
                const ph = document.getElementById('placeholder-content');
                img.src = e.target.result;
                img.style.display = 'block';
                ph.style.display = 'none';
            }
            reader.readAsDataURL(file);
        }
    }

    // --- 2. LOGIC TOGGLE PRICE ---
    const typeSelect = document.getElementById('typeSelect');
    const priceField = document.getElementById('priceField');
    function togglePrice() {
        priceField.style.display = (typeSelect.value === 'pro') ? 'block' : 'none';
    }
    typeSelect.addEventListener('change', togglePrice);
    togglePrice();

    // --- 3. LOGIC FORM BUILDER (UPDATED FOR THEME SUPPORT) ---
    // Note: Inline styles removed and replaced with CSS classes defined in <style>
    
    let schemaData = [
        {
            section_key: "personal",
            label: "Informasi Pribadi",
            is_repeater: false,
            fields: [
                { key: "name", label: "Nama Lengkap", type: "text", width: "100%", align: "center" },
                { key: "job", label: "Posisi / Gelar", type: "text", width: "100%", align: "center" },
                { key: "summary", label: "Deskripsi Diri", type: "textarea", width: "100%", align: "justify" }
            ]
        },
        {
            section_key: "experience",
            label: "Pengalaman Kerja",
            is_repeater: true,
            fields: [
                { key: "company", label: "Nama Perusahaan", type: "text", width: "100%", align: "left" },
                { key: "year", label: "Tahun", type: "text", width: "50%", align: "left" },
                { key: "description", label: "Deskripsi Tugas", type: "textarea", width: "100%", align: "justify" }
            ]
        }
    ];

    function renderBuilder() {
        const container = document.getElementById('builder-area');
        container.innerHTML = ''; 

        schemaData.forEach((section, sIdx) => {
            let html = `
            <div class="builder-section">
                <div class="section-header">
                    <div style="display:flex; align-items:center; gap:10px; flex-grow:1;">
                        <i class="fas fa-grip-vertical icon-grip"></i>
                        <input type="text" class="b-input" value="${section.label}" onchange="updateSection(${sIdx}, 'label', this.value)" placeholder="Judul Section" style="font-weight:600; flex-grow:1;">
                        <select class="b-select" onchange="updateSection(${sIdx}, 'is_repeater', this.value === 'true')" style="width:auto; min-width:100px;">
                            <option value="false" ${!section.is_repeater ? 'selected' : ''}>Tunggal</option>
                            <option value="true" ${section.is_repeater ? 'selected' : ''}>List/Repeater</option>
                        </select>
                    </div>
                    <div style="display:flex; gap:5px; margin-left:auto;">
                        <button type="button" class="btn-sm-icon" onclick="moveSection(${sIdx}, -1)"><i class="fas fa-arrow-up"></i></button>
                        <button type="button" class="btn-sm-icon" onclick="moveSection(${sIdx}, 1)"><i class="fas fa-arrow-down"></i></button>
                        <button type="button" class="btn-sm-icon btn-delete-section" onclick="deleteSection(${sIdx})"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
                <div class="section-body" style="padding:15px;">
                    <div id="fields-wrap-${sIdx}"></div>
                    <button type="button" class="btn-add btn-add-sm" onclick="addField(${sIdx})">
                        <i class="fas fa-plus"></i> Tambah Field
                    </button>
                </div>
            </div>`;
            container.insertAdjacentHTML('beforeend', html);

            const fieldWrap = document.getElementById(`fields-wrap-${sIdx}`);
            section.fields.forEach((field, fIdx) => {
                let fHtml = `
                <div class="builder-field">
                    <div style="padding-top:8px;"><i class="fas fa-grip-lines icon-grip"></i></div>
                    
                    <div class="builder-row-grid">
                        <div>
                            <label class="b-label">Label Input</label>
                            <input type="text" class="b-input" value="${field.label}" onchange="updateField(${sIdx}, ${fIdx}, 'label', this.value)" placeholder="Contoh: Nama Lengkap">
                        </div>
                        <div>
                            <label class="b-label">Tipe</label>
                            <select class="b-select" onchange="updateField(${sIdx}, ${fIdx}, 'type', this.value)">
                                <option value="text" ${field.type === 'text' ? 'selected' : ''}>Text</option>
                                <option value="textarea" ${field.type === 'textarea' ? 'selected' : ''}>Textarea</option>
                                <option value="email" ${field.type === 'email' ? 'selected' : ''}>Email</option>
                                <option value="tel" ${field.type === 'tel' ? 'selected' : ''}>Telp</option>
                                <option value="date" ${field.type === 'date' ? 'selected' : ''}>Tanggal</option>
                            </select>
                        </div>
                        <div>
                            <label class="b-label">Lebar</label>
                            <select class="b-select" onchange="updateField(${sIdx}, ${fIdx}, 'width', this.value)">
                                <option value="100%" ${field.width === '100%' ? 'selected' : ''}>Full (100%)</option>
                                <option value="50%" ${field.width === '50%' ? 'selected' : ''}>Setengah (50%)</option>
                                <option value="33%" ${field.width === '33%' ? 'selected' : ''}>1/3 Baris</option>
                            </select>
                        </div>
                        <div>
                            <label class="b-label">Align</label>
                            <select class="b-select" onchange="updateField(${sIdx}, ${fIdx}, 'align', this.value)">
                                <option value="left" ${field.align === 'left' ? 'selected' : ''}>Kiri</option>
                                <option value="center" ${field.align === 'center' ? 'selected' : ''}>Tengah</option>
                                <option value="justify" ${field.align === 'justify' ? 'selected' : ''}>Justify</option>
                            </select>
                        </div>
                        <div style="padding-top:16px;">
                            <button type="button" class="btn-sm-icon btn-delete-section" onclick="deleteField(${sIdx}, ${fIdx})" style="width:100%;"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                </div>`;
                fieldWrap.insertAdjacentHTML('beforeend', fHtml);
            });
        });

        document.getElementById('hidden_schema').value = JSON.stringify(schemaData);
    }

    // CRUD Helper Functions
    function addSection() { schemaData.push({ section_key: "sec_" + Date.now(), label: "Judul Baru", is_repeater: true, fields: [] }); renderBuilder(); }
    function updateSection(idx, key, val) { schemaData[idx][key] = val; renderBuilder(); }
    function deleteSection(idx) { if(confirm('Hapus section ini?')) { schemaData.splice(idx, 1); renderBuilder(); } }
    function moveSection(idx, dir) { if (idx + dir < 0 || idx + dir >= schemaData.length) return; [schemaData[idx], schemaData[idx+dir]] = [schemaData[idx+dir], schemaData[idx]]; renderBuilder(); }
    
    function addField(sIdx) { schemaData[sIdx].fields.push({ key: "f_" + Date.now(), label: "", type: "text", width: "100%", align: "left" }); renderBuilder(); }
    function updateField(sIdx, fIdx, key, val) { schemaData[sIdx].fields[fIdx][key] = val; document.getElementById('hidden_schema').value = JSON.stringify(schemaData); }
    function deleteField(sIdx, fIdx) { schemaData[sIdx].fields.splice(fIdx, 1); renderBuilder(); }

    document.addEventListener("DOMContentLoaded", function() { renderBuilder(); });
</script>
@endpush