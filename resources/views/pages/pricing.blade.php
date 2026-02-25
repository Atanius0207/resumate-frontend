@extends('layouts.app')

@section('title', 'Paket Harga')

@push('styles')
<style>
    /* --- Global Fixes --- */
    body {
        overflow-x: hidden; /* Mencegah scroll samping */
    }

    /* --- Header Section --- */
    .pricing-header {
        background: var(--bg-body);
        padding: 100px 0 60px;
        text-align: center;
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center; /* Kunci Tengah Vertical */
        justify-content: center; /* Kunci Tengah Horizontal */
    }

    .header-content {
        position: relative; 
        z-index: 1;
        max-width: 800px;
        width: 100%;
        padding: 0 20px;
    }

    .pricing-header h1 {
        font-size: 42px; font-weight: 800; color: var(--text-main); margin-bottom: 20px; letter-spacing: -1px;
    }
    .pricing-header h1 span {
        background: linear-gradient(135deg, var(--primary-color), #2E7D32);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    }
    .pricing-header p {
        font-size: 18px; color: var(--text-secondary); margin: 0 auto; line-height: 1.6;
    }

    /* --- Billing Toggle (Centered) --- */
    .billing-toggle-container {
        display: flex;
        justify-content: center;
        width: 100%;
        margin-top: 40px;
    }

    .billing-toggle {
        background: var(--bg-card);
        padding: 6px;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
        position: relative;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        border: 1px solid var(--border-color);
    }

    .toggle-option {
        padding: 10px 24px;
        border-radius: 30px;
        cursor: pointer;
        font-weight: 600;
        font-size: 14px;
        color: var(--text-secondary);
        transition: all 0.3s ease;
        position: relative;
        z-index: 2;
    }

    .toggle-option.active { color: white; }

    .toggle-bg {
        position: absolute; left: 6px; top: 6px; width: calc(50% - 6px); height: calc(100% - 12px);
        background: var(--primary-color); border-radius: 30px; transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1); z-index: 1;
    }

    .discount-tag {
        position: absolute; top: -12px; right: -20px; background: #FF9800; color: white;
        font-size: 10px; font-weight: 800; padding: 4px 8px; border-radius: 12px;
        transform: rotate(10deg); box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    /* --- Pricing Cards Section (FORCE CENTER) --- */
    .pricing-section {
        padding: 40px 20px 100px; /* Tambah padding kiri kanan */
        background: var(--bg-body);
        display: flex;
        justify-content: center; /* Flexbox Center */
    }

    .pricing-container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto; /* Margin Auto Center */
    }

    .pricing-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr); /* Default 3 kolom */
        gap: 30px;
        width: 100%;
        justify-content: center; /* Grid Center */
        align-items: stretch;
    }

    /* --- Card Styles --- */
    .pricing-card {
        background: var(--bg-card);
        border-radius: 24px;
        padding: 40px 30px;
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        position: relative;
        width: 100%; /* Pastikan card memenuhi grid */
    }

    .pricing-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        border-color: var(--primary-color);
    }

    .pricing-card.popular {
        border: 2px solid var(--primary-color);
        box-shadow: 0 10px 30px rgba(76, 175, 80, 0.1);
        z-index: 2;
        transform: scale(1.05);
    }
    
    /* Fix popular card scaling on hover */
    .pricing-card.popular:hover { transform: scale(1.05) translateY(-8px); }

    .popular-badge {
        position: absolute; top: -15px; left: 50%; transform: translateX(-50%);
        background: var(--primary-color); color: white; padding: 6px 16px;
        border-radius: 20px; font-size: 12px; font-weight: 700; letter-spacing: 0.5px;
        box-shadow: 0 4px 10px rgba(76, 175, 80, 0.3); white-space: nowrap;
    }

    .card-header { text-align: center; margin-bottom: 30px; padding-bottom: 30px; border-bottom: 1px solid var(--border-color); }
    .plan-title { font-size: 18px; font-weight: 600; color: var(--text-secondary); margin-bottom: 15px; text-transform: uppercase; letter-spacing: 1px; }
    
    .plan-price { display: flex; justify-content: center; align-items: baseline; color: var(--text-main); }
    .currency { font-size: 24px; font-weight: 600; top: -15px; position: relative; }
    .amount { font-size: 56px; font-weight: 800; line-height: 1; }
    .unit { font-size: 16px; color: var(--text-secondary); margin-left: 5px; font-weight: 500; }

    .card-features { flex: 1; list-style: none; padding: 0; margin: 0 0 30px 0; }
    .card-features li { margin-bottom: 16px; display: flex; align-items: center; gap: 12px; color: var(--text-main); font-size: 15px; }
    .card-features i { color: var(--primary-color); font-size: 18px; flex-shrink: 0; }
    .card-features li.disabled { color: var(--text-secondary); opacity: 0.6; text-decoration: line-through; }
    .card-features li.disabled i { color: var(--text-secondary); }

    /* Buttons */
    .btn-plan {
        display: block; width: 100%; padding: 16px; border-radius: 12px;
        font-weight: 700; text-align: center; text-decoration: none; transition: all 0.3s; font-size: 16px;
    }
    .btn-outline { background: transparent; border: 2px solid var(--border-color); color: var(--text-main); }
    .btn-outline:hover { border-color: var(--text-main); background: var(--text-main); color: var(--bg-body); }
    
    .btn-filled {
        background: var(--primary-color); color: white; border: 2px solid var(--primary-color);
        box-shadow: 0 8px 20px rgba(76, 175, 80, 0.25);
    }
    .btn-filled:hover {
        background: var(--primary-hover); border-color: var(--primary-hover);
        transform: translateY(-2px); box-shadow: 0 12px 25px rgba(76, 175, 80, 0.35);
    }

    /* --- FAQ Section --- */
    .faq-section { padding: 80px 20px 100px; background: var(--bg-card); border-top: 1px solid var(--border-color); display: flex; justify-content: center; }
    .faq-header { text-align: center; margin-bottom: 50px; }
    .faq-header h2 { font-size: 32px; font-weight: 700; color: var(--text-main); margin-bottom: 10px; }
    .faq-header p { color: var(--text-secondary); }
    .faq-wrapper { max-width: 800px; width: 100%; margin: 0 auto; }
    
    .accordion-item { border-bottom: 1px solid var(--border-color); margin-bottom: 15px; }
    .accordion-button {
        width: 100%; padding: 24px 0; background: none; border: none; outline: none;
        display: flex; justify-content: space-between; align-items: center; cursor: pointer; text-align: left;
        color: var(--text-main); font-size: 18px; font-weight: 600; transition: color 0.3s;
    }
    .accordion-button:hover { color: var(--primary-color); }
    .icon-plus { font-size: 20px; color: var(--primary-color); transition: transform 0.3s ease; }
    .accordion-body { max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; }
    .accordion-body p { padding-bottom: 24px; color: var(--text-secondary); line-height: 1.6; font-size: 16px; margin: 0; }
    .accordion-item.active .accordion-body { max-height: 200px; }
    .accordion-item.active .icon-plus { transform: rotate(45deg); }

    /* --- IMPORTANT: Responsive Fixes --- */
    @media (max-width: 1024px) {
        .pricing-grid {
            grid-template-columns: repeat(2, 1fr); /* Tablet jadi 2 kolom */
            max-width: 800px;
        }
        .pricing-card.popular { transform: scale(1); } /* Matikan scale di tablet agar rapi */
        .pricing-card.popular:hover { transform: translateY(-8px); }
    }

    @media (max-width: 768px) {
        .pricing-header h1 { font-size: 32px; }
        .pricing-grid {
            grid-template-columns: 1fr; /* Mobile jadi 1 kolom */
            max-width: 450px;
        }
        /* Urutan kartu di mobile: Popular ditaruh pertama */
        .pricing-card.popular { order: -1; margin-bottom: 20px; }
    }
</style>
@endpush

@section('content')

<header class="pricing-header">
    <div class="header-content">
        <h1>Investasi Karir <span>Terbaik Anda</span></h1>
        <p>Pilih paket fleksibel. Mulai gratis, upgrade saat Anda siap melamar kerja secara serius.</p>
        
        <div class="billing-toggle-container">
            <div class="billing-toggle">
                <div class="toggle-bg" id="toggleBg"></div>
                <div class="toggle-option active" id="btnMonthly">Bulanan</div>
                <div class="toggle-option" id="btnYearly">
                    Tahunan <span class="discount-tag">-20%</span>
                </div>
            </div>
        </div>
    </div>
</header>

<section class="pricing-section">
    <div class="pricing-container">
        <div class="pricing-grid">
            
            <div class="pricing-card">
                <div class="card-header">
                    <div class="plan-title">Starter</div>
                    <div class="plan-price">
                        <span class="currency">Rp</span>
                        <span class="amount">0</span>
                    </div>
                    <div class="unit">Selamanya</div>
                </div>
                <ul class="card-features">
                    <li><i class="fas fa-check-circle"></i> 1 Template Dasar</li>
                    <li><i class="fas fa-check-circle"></i> Export PDF (Watermark)</li>
                    <li><i class="fas fa-check-circle"></i> Editor Standar</li>
                    <li class="disabled"><i class="fas fa-times-circle"></i> AI Writer Assistant</li>
                    <li class="disabled"><i class="fas fa-times-circle"></i> Analisis Skor ATS</li>
                </ul>
                <a href="#" class="btn-plan btn-outline">Mulai Gratis</a>
            </div>

            <div class="pricing-card popular">
                <div class="popular-badge">PALING DIMINATI</div>
                <div class="card-header">
                    <div class="plan-title">Pro</div>
                    <div class="plan-price">
                        <span class="currency">Rp</span>
                        <span class="amount" id="pricePro">49</span>
                        <span class="currency" style="font-size: 20px; top: -5px;">rb</span>
                    </div>
                    <div class="unit" id="unitPro">/Bulan</div>
                </div>
                <ul class="card-features">
                    <li><i class="fas fa-check-circle"></i> <strong>Semua</strong> Template Premium</li>
                    <li><i class="fas fa-check-circle"></i> <strong>Unlimited</strong> Export PDF</li>
                    <li><i class="fas fa-check-circle"></i> AI Writer Assistant</li>
                    <li><i class="fas fa-check-circle"></i> Analisis Skor ATS</li>
                    <li><i class="fas fa-check-circle"></i> Tanpa Watermark</li>
                </ul>
                <a href="{{ route('checkout')}}" class="btn-plan btn-filled">Pilih Paket Pro</a>
            </div>

            <div class="pricing-card">
                <div class="card-header">
                    <div class="plan-title">Lifetime</div>
                    <div class="plan-price">
                        <span class="currency">Rp</span>
                        <span class="amount">199</span>
                        <span class="currency" style="font-size: 20px; top: -5px;">rb</span>
                    </div>
                    <div class="unit">Sekali Bayar</div>
                </div>
                <ul class="card-features">
                    <li><i class="fas fa-check-circle"></i> Akses Selamanya</li>
                    <li><i class="fas fa-check-circle"></i> Semua Fitur Pro</li>
                    <li><i class="fas fa-check-circle"></i> Update Template Masa Depan</li>
                    <li><i class="fas fa-check-circle"></i> Prioritas Support 24/7</li>
                    <li><i class="fas fa-check-circle"></i> Simpan hingga 10 Versi CV</li>
                </ul>
                <a href="#" class="btn-plan btn-outline">Beli Sekali</a>
            </div>

        </div>
    </div>
</section>

<section class="faq-section">
    <div class="container">
        <div class="faq-header">
            <h2>Pertanyaan Umum</h2>
            <p>Jawaban untuk hal-hal yang mungkin Anda bingungkan.</p>
        </div>
        
        <div class="faq-wrapper">
            <div class="accordion-item">
                <button class="accordion-button">
                    Apakah saya bisa membatalkan langganan?
                    <i class="fas fa-plus icon-plus"></i>
                </button>
                <div class="accordion-body">
                    <p>Tentu saja. Anda dapat membatalkan langganan paket Pro kapan saja melalui menu pengaturan akun. Akses pro akan tetap aktif hingga akhir periode penagihan saat ini.</p>
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-button">
                    Metode pembayaran apa saja yang tersedia?
                    <i class="fas fa-plus icon-plus"></i>
                </button>
                <div class="accordion-body">
                    <p>Kami menerima berbagai metode pembayaran lokal yang aman dan nyaman, termasuk Transfer Bank (Virtual Account), QRIS (GoPay, OVO, Dana, ShopeePay), dan Kartu Kredit/Debit.</p>
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-button">
                    Apa bedanya template gratis dan premium?
                    <i class="fas fa-plus icon-plus"></i>
                </button>
                <div class="accordion-body">
                    <p>Template gratis memiliki desain standar yang solid. Template premium dirancang lebih eksklusif dengan tata letak yang dioptimalkan untuk ATS tingkat lanjut dan memiliki variasi warna serta font yang lebih banyak.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // --- Billing Toggle Logic ---
    const btnMonthly = document.getElementById('btnMonthly');
    const btnYearly = document.getElementById('btnYearly');
    const toggleBg = document.getElementById('toggleBg');
    const priceElement = document.getElementById('pricePro');
    const unitPro = document.getElementById('unitPro');

    btnMonthly.addEventListener('click', () => {
        toggleBg.style.left = '6px';
        toggleBg.style.width = 'calc(50% - 6px)'; 
        btnMonthly.classList.add('active');
        btnYearly.classList.remove('active');
        
        // Update Price Monthly
        priceElement.innerText = "49";
        unitPro.innerText = "/Bulan";
    });

    btnYearly.addEventListener('click', () => {
        toggleBg.style.left = '50%';
        toggleBg.style.width = 'calc(50% - 6px)';
        btnYearly.classList.add('active');
        btnMonthly.classList.remove('active');

        // Update Price Annual Discount
        priceElement.innerText = "39";
        unitPro.innerText = "/Bulan (Bayar Tahunan)";
    });

    // --- FAQ Accordion Logic ---
    const accButtons = document.querySelectorAll('.accordion-button');

    accButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const item = this.parentElement;
            
            // Auto close other items (optional)
            document.querySelectorAll('.accordion-item').forEach(i => {
                if(i !== item) i.classList.remove('active');
            });

            item.classList.toggle('active');
        });
    });
</script>
@endpush