@extends('layouts.app')

@section('title', 'Konfirmasi Pembayaran')

@push('styles')
<style>
    /* --- Checkout Layout --- */
    .checkout-section {
        padding: 60px 0 100px;
        background: var(--bg-body); /* Theme Var */
        min-height: calc(100vh - 80px);
    }

    .checkout-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 20px;
        display: grid;
        grid-template-columns: 1fr 1.5fr;
        gap: 40px;
        align-items: start;
    }

    /* --- Summary Card (Sticky) --- */
    .summary-card {
        background: var(--bg-card); /* Theme Var */
        padding: 30px;
        border-radius: 20px;
        border: 1px solid var(--border-color); /* Theme Var */
        box-shadow: 0 10px 30px var(--shadow-color);
        position: sticky;
        top: 100px;
    }

    .summary-card h3 {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-main); /* Theme Var */
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid var(--border-color);
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        font-size: 15px;
        color: var(--text-secondary);
    }

    .summary-item span:last-child {
        font-weight: 600;
        color: var(--text-main);
    }

    .total-pay {
        margin-top: 25px;
        padding: 20px;
        background: var(--feature-icon-bg); /* Theme Var */
        border-radius: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: 1px dashed var(--primary-color);
    }

    .total-label {
        font-size: 14px;
        color: var(--text-secondary);
    }

    .total-amount {
        font-size: 24px;
        font-weight: 800;
        color: var(--primary-color);
    }

    .info-note {
        margin-top: 20px;
        font-size: 13px;
        color: var(--text-secondary);
        line-height: 1.5;
        display: flex;
        gap: 8px;
        padding: 10px;
        background: var(--bg-body);
        border-radius: 8px;
    }

    /* --- Payment Methods Tabs --- */
    .payment-methods {
        background: var(--bg-card); /* Theme Var */
        padding: 40px;
        border-radius: 24px;
        border: 1px solid var(--border-color); /* Theme Var */
        box-shadow: 0 4px 20px var(--shadow-color);
    }

    .step-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
        font-weight: 700;
        color: var(--text-main); /* Theme Var */
        font-size: 18px;
    }

    .step-num {
        background: var(--primary-color);
        color: white;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .method-tabs {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
    }

    .tab-btn {
        flex: 1;
        padding: 15px;
        border: 1px solid var(--border-color); /* Theme Var */
        border-radius: 12px;
        background: var(--bg-body); /* Theme Var */
        cursor: pointer;
        font-weight: 600;
        font-size: 14px;
        color: var(--text-secondary); /* Theme Var */
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .tab-btn:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
    }

    .tab-btn.active {
        border-color: var(--primary-color);
        background: var(--feature-icon-bg); /* Theme Var */
        color: var(--primary-color);
        box-shadow: 0 4px 12px rgba(76, 175, 80, 0.1);
    }

    /* --- Method Content --- */
    .method-content {
        animation: fadeIn 0.4s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* QRIS Styles */
    .qris-container {
        text-align: center;
        padding: 30px;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        background: var(--bg-body); /* Theme Var */
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .qris-image {
        width: 200px;
        height: 200px;
        margin: 0 auto 15px;
        background: white;
        padding: 10px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    
    .qris-image img { width: 100%; height: 100%; object-fit: contain; }

    .qris-logos {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 15px;
        opacity: 0.7;
        font-size: 12px;
        font-weight: 600;
        color: var(--text-secondary);
    }

    /* Button Download QR */
    .btn-download-qr {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 15px;
        padding: 8px 20px;
        border: 1px solid var(--primary-color);
        color: var(--primary-color);
        border-radius: 8px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.3s;
        background: transparent;
    }

    .btn-download-qr:hover {
        background: var(--primary-color);
        color: white;
    }

    /* Bank Info Styles */
    .bank-info {
        background: var(--feature-icon-bg); /* Theme Var */
        padding: 25px;
        border-radius: 16px;
        border: 1px solid var(--border-color);
        text-align: center;
    }

    .bank-name { font-size: 14px; color: var(--text-secondary); margin-bottom: 5px; }
    
    .account-number {
        font-family: 'Courier New', monospace;
        font-size: 28px;
        font-weight: 800;
        letter-spacing: 2px;
        display: block;
        margin: 10px 0;
        color: var(--text-main); /* Theme Var */
    }

    .account-name { font-size: 14px; font-weight: 600; color: var(--text-main); }

    /* --- Upload & Button --- */
    .upload-section {
        margin-top: 40px;
        padding-top: 40px;
        border-top: 1px dashed var(--border-color);
    }

    .upload-zone {
        border: 2px dashed var(--border-color); /* Theme Var */
        padding: 30px;
        border-radius: 16px;
        text-align: center;
        cursor: pointer;
        margin: 20px 0;
        transition: all 0.3s;
        background: var(--bg-body);
    }

    .upload-zone:hover {
        border-color: var(--primary-color);
        background: var(--feature-icon-bg);
    }

    .upload-icon {
        font-size: 32px;
        color: var(--primary-color);
        margin-bottom: 10px;
    }

    .upload-text {
        font-size: 14px;
        color: var(--text-secondary);
    }

    .btn-wa {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        background: #25D366; /* WA Brand Color */
        color: white;
        padding: 18px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 700;
        font-size: 16px;
        width: 100%;
        margin-top: 20px;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(37, 211, 102, 0.2);
    }

    .btn-wa:hover {
        background: #128C7E;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(37, 211, 102, 0.3);
    }

    /* Responsive */
    @media (max-width: 992px) {
        .checkout-container { grid-template-columns: 1fr; max-width: 600px; gap: 30px; }
        .summary-card { position: relative; top: 0; order: -1; } /* Summary pindah ke atas di mobile */
    }
</style>
@endpush

@section('content')
<div class="checkout-section">
    <div class="checkout-container">
        
        <div class="summary-side">
            <div class="summary-card">
                <h3>Ringkasan Pesanan</h3>
                <div class="summary-item">
                    <span>Paket</span>
                    <span>Pro Member (Monthly)</span>
                </div>
                <div class="summary-item">
                    <span>Harga Paket</span>
                    <span>Rp 49.000</span>
                </div>
                <div class="summary-item">
                    <span>Kode Unik</span>
                    <span>#823</span>
                </div>
                
                <div class="total-pay">
                    <span class="total-label">Total Bayar</span>
                    <span class="total-amount">Rp 49.823</span>
                </div>
                
                <div class="info-note">
                    <i class="fas fa-info-circle" style="color: var(--primary-color); margin-top: 2px;"></i>
                    <span>Mohon transfer tepat hingga 3 digit terakhir agar sistem dapat memverifikasi otomatis.</span>
                </div>
            </div>
        </div>

        <div class="payment-side">
            <div class="payment-methods">
                
                <div class="step-header">
                    <span class="step-num">1</span> Pilih Metode Pembayaran
                </div>
                
                <div class="method-tabs">
                    <button class="tab-btn active" onclick="switchMethod('bank', event)">
                        <i class="fas fa-university"></i> Bank Transfer
                    </button>
                    <button class="tab-btn" onclick="switchMethod('qris', event)">
                        <i class="fas fa-qrcode"></i> QRIS (E-Wallet)
                    </button>
                </div>

                <div id="method-bank" class="method-content">
                    <div class="bank-info">
                        <div class="bank-name">Bank Central Asia (BCA)</div>
                        <strong class="account-number">8291 002 391</strong>
                        <div class="account-name">a/n PT CV Kreatif Indonesia</div>
                        <div style="margin-top: 15px; font-size: 12px; color: var(--text-secondary);">
                            <i class="far fa-copy"></i> Klik nomor untuk menyalin
                        </div>
                    </div>
                </div>

                <div id="method-qris" class="method-content" style="display: none;">
                    <div class="qris-container">
                        <div class="qris-image">
                            <img src="{{ asset('images/sample-qris.png') }}" alt="Scan QRIS" onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg'">
                        </div>
                        <p style="font-size: 14px; font-weight: 600; color: var(--text-main);">Scan QRIS untuk Membayar</p>
                        
                        <a href="{{ asset('images/report.png') }}" download="QRIS-ResuMate.png" class="btn-download-qr">
                            <i class="fas fa-download"></i> Unduh QR Code
                        </a>

                        <div class="qris-logos">
                            <span>GOPAY</span> • <span>OVO</span> • <span>DANA</span> • <span>SHOPEEPAY</span>
                        </div>
                    </div>
                </div>

                <div class="upload-section">
                    <div class="step-header">
                        <span class="step-num">2</span> Upload Bukti & Konfirmasi
                    </div>
                    
                    <div class="upload-zone" onclick="document.getElementById('fileInput').click()">
                        <i class="fas fa-cloud-upload-alt upload-icon"></i>
                        <p class="upload-text">Klik di sini untuk upload screenshot bukti transfer</p>
                        <input type="file" id="fileInput" hidden accept="image/*">
                    </div>

                    <a href="https://wa.me/628123456789?text=Halo%20Admin,%20saya%20sudah%20bayar%20paket%20Pro%20Rp49.823.%20Mohon%20cek%20bukti%20terlampir." target="_blank" class="btn-wa">
                        <i class="fab fa-whatsapp" style="font-size: 20px;"></i> 
                        Kirim Bukti via WhatsApp
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    function switchMethod(method, event) {
        // Reset active class on buttons
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        
        // Set clicked button as active
        event.currentTarget.classList.add('active');

        // Hide all contents
        document.getElementById('method-bank').style.display = 'none';
        document.getElementById('method-qris').style.display = 'none';

        // Show selected content with animation reset
        const selected = document.getElementById('method-' + method);
        selected.style.display = 'block';
    }
</script>
@endpush