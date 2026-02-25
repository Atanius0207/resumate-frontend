@extends('layouts.app')

@section('title', 'Fitur Unggulan')

@push('styles')
<style>
    /* --- Header Section --- */
    .features-header {
        background: var(--bg-body); /* Theme Var */
        padding: 100px 0 80px;
        text-align: center;
        border-bottom: 1px solid var(--border-color); /* Theme Var */
    }

    .features-header h1 {
        font-size: 42px;
        color: var(--text-main); /* Theme Var */
        font-weight: 700;
        margin-bottom: 20px;
    }

    .features-header h1 span {
        color: var(--primary-color);
    }

    .features-header p {
        max-width: 600px;
        margin: 0 auto;
        color: var(--text-secondary); /* Theme Var */
        font-size: 18px;
        line-height: 1.6;
    }

    /* --- Iconic Features Grid --- */
    .feature-grid-section {
        padding: 80px 0;
        background: var(--bg-body); /* Theme Var */
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 40px;
    }

    .grid-layout {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 40px;
    }

    .feature-box {
        padding: 40px;
        border-radius: 20px;
        background: var(--bg-card); /* Theme Var */
        border: 1px solid var(--border-color); /* Theme Var */
        transition: all 0.3s ease;
        text-align: center;
    }

    .feature-box:hover {
        border-color: var(--primary-color);
        box-shadow: 0 10px 30px var(--shadow-color);
        transform: translateY(-5px);
    }

    .icon-wrapper {
        width: 70px;
        height: 70px;
        background: var(--feature-icon-bg); /* Theme Var */
        color: var(--primary-color);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        border-radius: 15px;
        margin: 0 auto 24px;
    }

    .feature-box h3 {
        font-size: 22px;
        margin-bottom: 16px;
        color: var(--text-main); /* Theme Var */
    }

    .feature-box p {
        color: var(--text-secondary); /* Theme Var */
        line-height: 1.6;
    }

    /* --- Detailed Showcase (Zigzag) --- */
    .detail-section {
        padding: 100px 0;
        background: var(--bg-card); /* Theme Var (Alternating BG) */
        border-top: 1px solid var(--border-color);
    }

    .detail-row {
        display: flex;
        align-items: center;
        gap: 80px;
        margin-bottom: 120px;
    }

    .detail-row:last-child {
        margin-bottom: 0;
    }

    .detail-row:nth-child(even) {
        flex-direction: row-reverse;
    }

    .detail-image {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--template-preview-bg); /* Theme Var */
        border-radius: 24px;
        padding: 40px;
        border: 1px solid var(--border-color);
    }

    .detail-image img {
        width: 100%;
        max-width: 480px;
        height: auto;
        filter: drop-shadow(0 10px 20px rgba(0,0,0,0.08));
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
        100% { transform: translateY(0px); }
    }

    .detail-content {
        flex: 1;
    }

    .detail-content h2 {
        font-size: 34px;
        margin-bottom: 24px;
        color: var(--text-main); /* Theme Var */
        font-weight: 700;
    }

    .detail-content p {
        font-size: 18px;
        color: var(--text-secondary); /* Theme Var */
        line-height: 1.8;
        margin-bottom: 30px;
    }

    /* List items in details */
    .detail-content ul li {
        margin-bottom: 15px;
        color: var(--text-secondary); /* Theme Var */
        display: flex;
        align-items: center;
    }
    
    .detail-content ul li i {
        color: var(--primary-color);
        margin-right: 12px;
    }

    /* --- CTA Section --- */
    .cta-banner {
        background: var(--primary-color);
        padding: 80px 0;
        text-align: center;
        color: white;
    }

    .cta-banner h2 {
        font-size: 36px;
        margin-bottom: 24px;
        font-weight: 700;
        color: white;
    }
    
    .cta-banner p {
        color: white;
    }

    .btn-white {
        display: inline-block;
        padding: 16px 40px;
        background: white;
        color: var(--primary-color);
        font-weight: 700;
        border-radius: 10px;
        text-decoration: none;
        transition: 0.3s;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .btn-white:hover {
        background: #f8f8f8;
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }

    /* Responsive */
    @media (max-width: 992px) {
        .grid-layout { grid-template-columns: repeat(2, 1fr); }
        .detail-row, .detail-row:nth-child(even) { 
            flex-direction: column; 
            text-align: center; 
            gap: 50px; 
            margin-bottom: 80px;
        }
        .detail-content ul {
            display: inline-block;
            text-align: left;
        }
    }

    @media (max-width: 640px) {
        .grid-layout { grid-template-columns: 1fr; }
        .features-header h1 { font-size: 32px; }
        .detail-content h2 { font-size: 28px; }
    }
</style>
@endpush

@section('content')

<section class="features-header">
    <div class="container">
        <div class="section-tag" style="display: inline-block; background: var(--feature-icon-bg); padding: 8px 20px; border-radius: 20px; font-size: 14px; font-weight: 600; color: var(--primary-color); margin-bottom: 20px; border: 1px solid var(--border-color);">
            <i class="fas fa-star"></i> FITUR UNGGULAN
        </div>
        <h1>Segala yang Anda Butuhkan untuk <span>Sukses Karir</span></h1>
        <p>Gunakan teknologi cerdas untuk membangun CV profesional dalam hitungan menit.</p>
    </div>
</section>

<section class="feature-grid-section">
    <div class="container">
        <div class="grid-layout">
            <div class="feature-box">
                <div class="icon-wrapper"><i class="fas fa-magic"></i></div>
                <h3>AI Assistant</h3>
                <p>AI kami membantu merangkai kata-kata profesional untuk deskripsi pengalaman kerja Anda secara otomatis.</p>
            </div>
            <div class="feature-box">
                <div class="icon-wrapper"><i class="fas fa-check-circle"></i></div>
                <h3>ATS Friendly</h3>
                <p>Template yang dirancang khusus agar mudah dibaca oleh sistem rekrutmen otomatis (ATS) perusahaan besar.</p>
            </div>
            <div class="feature-box">
                <div class="icon-wrapper"><i class="fas fa-file-pdf"></i></div>
                <h3>Export PDF</h3>
                <p>Unduh hasil akhir CV Anda dalam format PDF standar industri dengan satu klik saja, siap kirim!</p>
            </div>
        </div>
    </div>
</section>

<section class="detail-section">
    <div class="container">
        
        <div class="detail-row">
            <div class="detail-image">
                <img src="{{ asset('images/undraw_resume.png') }}" alt="Real-time Editor" onerror="this.style.display='none'; this.parentNode.innerHTML='<i class=\'fas fa-edit fa-5x\' style=\'color: var(--text-secondary); opacity: 0.5;\'></i>'">
            </div>
            <div class="detail-content">
                <div class="section-tag" style="color: var(--primary-color); font-weight: 700; margin-bottom: 12px; display: block; letter-spacing: 1px;">SMART INTERFACE</div>
                <h2>Editor Real-time & Intuitif</h2>
                <p>Lupakan proses edit yang rumit di Microsoft Word. Dengan editor kami, apa yang Anda lihat adalah apa yang Anda dapatkan. Perubahan font, warna, dan tata letak terjadi secara instan.</p>
                <ul style="list-style: none; padding: 0;">
                    <li><i class="fas fa-check-circle"></i> Auto-save otomatis di cloud</li>
                    <li><i class="fas fa-check-circle"></i> Kustomisasi margin dan spasi baris</li>
                    <li><i class="fas fa-check-circle"></i> Pengaturan urutan section yang fleksibel</li>
                </ul>
            </div>
        </div>

        <div class="detail-row">
            <div class="detail-image">
                <img src="{{ asset('images/undraw_analytics.png') }}" alt="CV Analysis" onerror="this.style.display='none'; this.parentNode.innerHTML='<i class=\'fas fa-chart-bar fa-5x\' style=\'color: var(--text-secondary); opacity: 0.5;\'></i>'">
            </div>
            <div class="detail-content">
                <div class="section-tag" style="color: var(--primary-color); font-weight: 700; margin-bottom: 12px; display: block; letter-spacing: 1px;">OPTIMASI SKOR</div>
                <h2>Analisis Kekuatan CV</h2>
                <p>Sistem kami akan memindai konten CV Anda dan memberikan saran perbaikan berdasarkan kata kunci yang paling dicari oleh rekruter di industri Anda.</p>
                <p>Dapatkan skor kelayakan dan tips untuk menonjolkan pencapaian terbaik Anda di mata HRD.</p>
            </div>
        </div>

    </div>
</section>

<section class="cta-banner">
    <div class="container">
        <h2>Siap Membuat CV Impian Anda?</h2>
        <p style="margin-bottom: 40px; font-size: 18px; opacity: 0.9;">Gabung dengan ribuan profesional yang telah berhasil mendapatkan pekerjaan impian.</p>
        @auth
            <a href="{{ url('/templates') }}" class="btn-white">Mulai Buat CV Sekarang</a>
        @else
            <a href="{{ route('register') }}" class="btn-white">Mulai Buat CV Sekarang</a>
        @endauth
    </div>
</section>

@endsection