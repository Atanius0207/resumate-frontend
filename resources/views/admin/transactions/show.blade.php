@extends('layouts.admin')

@section('title', 'Detail Transaksi #TX-882910')

@push('styles')
<style>
    /* --- Layout Container --- */
    .detail-container {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 32px;
        align-items: start;
    }

    /* --- Left Column: Evidence & Info --- */
    .main-card {
        background: white;
        border-radius: 24px;
        border: 1px solid var(--border-color);
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.02);
    }

    .card-section {
        padding: 32px;
        border-bottom: 1px solid var(--border-color);
    }

    .card-section:last-child { border-bottom: none; }

    .section-title {
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-secondary);
        font-weight: 700;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Bukti Transfer Styling */
    .payment-proof-wrapper {
        background: #f8fafc;
        border-radius: 16px;
        padding: 16px;
        border: 2px dashed #e2e8f0;
        text-align: center;
        cursor: zoom-in;
        transition: 0.3s;
    }

    .payment-proof-wrapper:hover { border-color: var(--primary-color); background: #f0fdf4; }

    .payment-proof-wrapper img {
        max-width: 100%;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    /* --- Right Column: Sidebar Stats --- */
    .sidebar-card {
        background: #f8fafc;
        border-radius: 24px;
        padding: 32px;
        border: 1px solid var(--border-color);
        position: sticky;
        top: 24px;
    }

    .status-box {
        text-align: center;
        padding: 24px;
        border-radius: 20px;
        background: white;
        margin-bottom: 24px;
        border: 1px solid var(--border-color);
    }

    .amount-display {
        font-family: 'JetBrains Mono', monospace;
        font-size: 32px;
        font-weight: 800;
        color: var(--text-main);
        letter-spacing: -1px;
    }

    /* Action Buttons */
    .action-group {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .btn-approve {
        background: var(--primary-color);
        color: white;
        border: none;
        padding: 16px;
        border-radius: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-size: 15px;
    }

    .btn-approve:hover { background: var(--primary-hover); transform: translateY(-2px); box-shadow: 0 8px 20px rgba(76, 175, 80, 0.2); }

    .btn-reject-trigger {
        background: #fff1f2;
        color: #e11d48;
        border: 1px solid #fecdd3;
        padding: 14px;
        border-radius: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn-reject-trigger:hover { background: #ffe4e6; }

    /* Info List */
    .info-list { list-style: none; padding: 0; margin: 0; }
    .info-item {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid #f1f5f9;
        font-size: 14px;
    }
    .info-item:last-child { border-bottom: none; }
    .info-label { color: var(--text-secondary); }
    .info-value { font-weight: 600; color: var(--text-main); }

    /* --- Modal Styling --- */
    .modal-overlay {
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(4px);
        display: none; align-items: center; justify-content: center; z-index: 1000;
        animation: fadeIn 0.2s ease-out;
    }

    .modal-content {
        background: white; width: 100%; max-width: 480px;
        border-radius: 24px; padding: 32px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.2);
    }

    .modal-header {
        display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;
    }

    .close-modal {
        background: none; border: none; font-size: 24px; color: var(--text-secondary); cursor: pointer;
    }

    .reason-option {
        margin-bottom: 10px; display: flex; align-items: center; gap: 12px;
        padding: 14px; border: 1px solid var(--border-color); border-radius: 12px;
        transition: 0.2s; cursor: pointer;
    }

    .reason-option:hover { border-color: var(--primary-color); }

    .reason-option input[type="radio"] {
        accent-color: #e11d48; width: 18px; height: 18px;
    }

    .reason-option label { font-size: 14px; cursor: pointer; width: 100%; font-weight: 500; }

    .reason-option.selected { border-color: #e11d48; background: #fff1f2; }

    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
</style>
@endpush

@section('content')

<div style="margin-bottom: 32px; display: flex; align-items: center; gap: 16px;">
    <a href="#" class="btn-icon" style="text-decoration: none;"><i class="fas fa-arrow-left"></i></a>
    <div>
        <h1 style="font-size: 24px; font-weight: 800; letter-spacing: -0.5px;">Detail Transaksi #TX-882910</h1>
        <p style="color: var(--text-secondary); font-size: 14px;">Dibuat pada 30 Januari 2026 • 14:20 WIB</p>
    </div>
</div>

<div class="detail-container">
    <div class="main-card">
        <div class="card-section">
            <div class="section-title"><i class="fas fa-image"></i> Bukti Pembayaran</div>
            <div class="payment-proof-wrapper">
                <img src="https://i.pinimg.com/736x/8e/3c/6e/8e3c6e4092923769949f2b34727d5707.jpg" alt="Bukti Transfer">
                <p style="margin-top: 15px; font-size: 13px; color: var(--text-secondary); font-weight: 500;">
                    <i class="fas fa-search-plus"></i> Klik gambar untuk memperbesar
                </p>
            </div>
        </div>

        <div class="card-section">
            <div class="section-title"><i class="fas fa-user-circle"></i> Informasi Pembeli</div>
            <div class="info-list">
                <div class="info-item">
                    <span class="info-label">Nama Lengkap</span>
                    <span class="info-value">Fadhil Muhammad</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Email Terdaftar</span>
                    <span class="info-value">fadhil@studio.com</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Nomor WhatsApp</span>
                    <span class="info-value">+62 812-3456-7890</span>
                </div>
            </div>
        </div>
    </div>

    <div class="sidebar-card">
        <div class="status-box">
            <span class="status-badge status-pending" style="margin-bottom: 16px; border-radius: 8px;">
                <span class="dot"></span> Menunggu Verifikasi
            </span>
            <div class="amount-display">Rp 199.322</div>
            <p style="font-size: 12px; color: var(--text-secondary); margin-top: 8px;">Termasuk kode unik <strong style="color: var(--text-main);">#322</strong></p>
        </div>

        <div class="info-list" style="margin-bottom: 32px; background: white; padding: 20px; border-radius: 16px; border: 1px solid var(--border-color);">
            <div class="info-item">
                <span class="info-label">Paket</span>
                <span class="info-value">Pro Lifetime</span>
            </div>
            <div class="info-item">
                <span class="info-label">Metode</span>
                <span class="info-value">BCA Transfer</span>
            </div>
            <div class="info-item">
                <span class="info-label">Tujuan</span>
                <span class="info-value">Bank BCA - Admin</span>
            </div>
        </div>

        <div class="action-group">
            <button class="btn-approve" onclick="alert('Transaksi Berhasil Diverifikasi!')">
                <i class="fas fa-check-circle"></i> Verifikasi Sekarang
            </button>
            <button class="btn-reject-trigger" onclick="openRejectModal()">
                Tolak Pembayaran
            </button>
        </div>
        
        <div style="background: rgba(245, 158, 11, 0.05); padding: 15px; border-radius: 12px; margin-top: 20px; border: 1px solid rgba(245, 158, 11, 0.1);">
            <p style="font-size: 11px; color: #92400E; line-height: 1.5; margin: 0; text-align: center;">
                <i class="fas fa-exclamation-triangle"></i> Mohon periksa nama pengirim dan nominal secara teliti sebelum menyetujui.
            </p>
        </div>
    </div>
</div>

<div id="rejectModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h3 style="font-weight: 800; font-size: 18px;">Tolak Pembayaran</h3>
            <button class="close-modal" onclick="closeRejectModal()">&times;</button>
        </div>
        <div class="modal-body">
            <p style="font-size: 14px; color: var(--text-secondary); margin-bottom: 20px;">
                Berikan alasan penolakan agar pengguna dapat memperbaiki data mereka.
            </p>
            
            <form id="rejectForm">
                <div class="reason-option">
                    <input type="radio" name="reason" id="r1" value="Bukti Buram">
                    <label for="r1">Bukti transfer tidak terbaca (Buram)</label>
                </div>
                <div class="reason-option">
                    <input type="radio" name="reason" id="r2" value="Nominal Salah">
                    <label for="r2">Nominal tidak sesuai tagihan</label>
                </div>
                <div class="reason-option">
                    <input type="radio" name="reason" id="r3" value="Data Berbeda">
                    <label for="r3">Nama pengirim tidak cocok</label>
                </div>
                
                <div style="margin-top: 15px;">
                    <textarea placeholder="Tambahkan catatan khusus (opsional)..." style="width: 100%; padding: 12px; border-radius: 12px; border: 1px solid var(--border-color); min-height: 80px; font-family: inherit; font-size: 14px; outline: none;"></textarea>
                </div>

                <div style="display: flex; gap: 12px; margin-top: 24px;">
                    <button type="button" class="btn-reject-trigger" style="flex: 1; margin: 0;" onclick="closeRejectModal()">Batal</button>
                    <button type="submit" class="btn-approve" style="flex: 2; background: #e11d48; border-radius: 12px;">Kirim Penolakan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Fungsi buka modal
    function openRejectModal() {
        document.getElementById('rejectModal').style.display = 'flex';
    }

    // Fungsi tutup modal
    function closeRejectModal() {
        document.getElementById('rejectModal').style.display = 'none';
    }

    // Menangani perubahan gaya pada radio button yang dipilih
    document.querySelectorAll('input[name="reason"]').forEach(input => {
        input.addEventListener('change', function() {
            document.querySelectorAll('.reason-option').forEach(opt => opt.classList.remove('selected'));
            if(this.checked) {
                this.parentElement.classList.add('selected');
            }
        });
    });

    // Menutup modal jika area luar diklik
    window.onclick = function(event) {
        let modal = document.getElementById('rejectModal');
        if (event.target == modal) {
            closeRejectModal();
        }
    }
</script>
@endpush