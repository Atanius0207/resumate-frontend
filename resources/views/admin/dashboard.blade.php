@extends('layouts.admin')

@section('title', 'Dashboard')

@push('styles')
<style>
    /* Stats Cards */
    .stats-grid {
        display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px;
        margin-bottom: 40px;
    }
    .stat-card {
        background: var(--bg-card); padding: 24px; border-radius: 16px;
        box-shadow: var(--shadow-sm); border: 1px solid var(--border-color);
        display: flex; flex-direction: column; gap: 15px; transition: 0.3s;
    }
    .stat-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-md); border-color: var(--primary-color); }
    
    .stat-header { display: flex; justify-content: space-between; align-items: flex-start; }
    .stat-icon {
        width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 20px;
    }
    .icon-income { background: rgba(76, 175, 80, 0.1); color: var(--primary-color); }
    .icon-user { background: rgba(59, 130, 246, 0.1); color: #3B82F6; }
    .icon-pending { background: rgba(245, 158, 11, 0.1); color: #F59E0B; }
    
    .stat-val { font-size: 26px; font-weight: 800; color: var(--text-main); line-height: 1; }
    .stat-label { font-size: 13px; color: var(--text-muted); font-weight: 500; }
    
    /* Table */
    .table-card {
        background: var(--bg-card); border-radius: 16px; 
        border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);
        overflow: hidden;
    }
    .table-header {
        padding: 20px 24px; border-bottom: 1px solid var(--border-color);
        display: flex; justify-content: space-between; align-items: center;
    }
    .table-header h3 { font-size: 16px; font-weight: 700; color: var(--text-main); }

    table { width: 100%; border-collapse: collapse; }
    th { text-align: left; padding: 14px 24px; font-size: 12px; color: var(--text-muted); font-weight: 600; text-transform: uppercase; background: var(--bg-body); }
    td { padding: 16px 24px; font-size: 14px; border-bottom: 1px solid var(--border-color); color: var(--text-main); }
    tr:last-child td { border-bottom: none; }

    .status-badge {
        padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 700;
    }
    .status-pending { background: rgba(245, 158, 11, 0.15); color: #D97706; }
    .status-success { background: rgba(76, 175, 80, 0.15); color: var(--primary-color); }

    .btn-xs {
        padding: 6px 12px; font-size: 12px; border-radius: 6px; 
        border: 1px solid var(--border-color); background: var(--bg-body);
        color: var(--text-main); cursor: pointer; transition: 0.2s; font-weight: 600;
    }
    .btn-xs:hover { border-color: var(--primary-color); color: var(--primary-color); }

    @media (max-width: 1200px) { .stats-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 600px) { .stats-grid { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<div style="margin-bottom: 30px;">
    <h2 style="font-size: 24px; font-weight: 700; color: var(--text-main);">Dashboard</h2>
    <p style="color: var(--text-muted); font-size: 14px;">Ringkasan performa aplikasi hari ini.</p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-val">Rp 128.5M</div>
                <div class="stat-label">Total Pendapatan</div>
            </div>
            <div class="stat-icon icon-income"><i class="fas fa-wallet"></i></div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-val">1,240</div>
                <div class="stat-label">Total Pengguna</div>
            </div>
            <div class="stat-icon icon-user"><i class="fas fa-users"></i></div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-val">24</div>
                <div class="stat-label">Perlu Verifikasi</div>
            </div>
            <div class="stat-icon icon-pending"><i class="fas fa-clock"></i></div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-val">56</div>
                <div class="stat-label">Template Aktif</div>
            </div>
            <div class="stat-icon" style="background: rgba(124, 58, 237, 0.1); color: #7C3AED;"><i class="fas fa-layer-group"></i></div>
        </div>
    </div>
</div>

<div class="table-card">
    <div class="table-header">
        <h3>Pembayaran Terbaru</h3>
        <a href="#" style="font-size: 13px; color: var(--primary-color); font-weight: 600;">Lihat Semua</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Paket</th>
                <th>Nominal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div style="font-weight: 600;">Andi Pratama</div>
                    <div style="font-size: 12px; color: var(--text-muted);">andi@mail.com</div>
                </td>
                <td>Pro Monthly</td>
                <td style="font-family: monospace; font-weight: 700;">Rp 49.823</td>
                <td><span class="status-badge status-pending">Pending</span></td>
                <td><button class="btn-xs">Cek Bukti</button></td>
            </tr>
            <tr>
                <td>
                    <div style="font-weight: 600;">Siti Aminah</div>
                    <div style="font-size: 12px; color: var(--text-muted);">siti@mail.com</div>
                </td>
                <td>Lifetime</td>
                <td style="font-family: monospace; font-weight: 700;">Rp 199.102</td>
                <td><span class="status-badge status-success">Lunas</span></td>
                <td><button class="btn-xs">Detail</button></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection