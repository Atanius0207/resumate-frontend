@extends('layouts.admin')

@section('title', 'Manajemen Transaksi')

@push('styles')
<style>
    /* --- Page Header & Stats --- */
    .page-header {
        display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 32px;
        flex-wrap: wrap; gap: 16px;
    }
    .header-title h1 { font-size: 28px; font-weight: 800; color: var(--text-main); margin-bottom: 4px; letter-spacing: -0.5px; }
    .header-title p { color: var(--text-secondary); font-size: 14px; }

    .btn-export {
        background: var(--bg-card); border: 1px solid var(--border-color); color: var(--text-main);
        padding: 10px 20px; border-radius: 8px; font-size: 13px; font-weight: 600;
        display: flex; align-items: center; gap: 8px; cursor: pointer; transition: 0.2s;
    }
    .btn-export:hover { border-color: var(--primary-color); color: var(--primary-color); }

    /* --- Filter Tabs (Height Adjusted) --- */
    .filter-tabs {
        display: flex; gap: 25px; border-bottom: 1px solid var(--border-color); margin-bottom: 24px;
        overflow-x: auto; scrollbar-width: none;
    }
    .tab-item {
        /* Padding dikurangi agar tidak terlalu tinggi */
        padding-bottom: 10px; 
        font-size: 14px; font-weight: 600; color: var(--text-secondary);
        cursor: pointer; position: relative; transition: 0.3s; white-space: nowrap;
        display: flex; align-items: center; gap: 6px;
    }
    .tab-item:hover, .tab-item.active { color: var(--primary-color); }
    
    /* Garis bawah aktif */
    .tab-item.active::after {
        content: ''; position: absolute; bottom: -1px; left: 0; width: 100%; height: 2px;
        background: var(--primary-color);
    }
    
    .badge-count {
        background: var(--bg-body); padding: 2px 8px; border-radius: 10px; font-size: 11px;
        color: var(--text-main); border: 1px solid var(--border-color);
    }
    .tab-item.active .badge-count { background: rgba(76, 175, 80, 0.1); color: var(--primary-color); border-color: var(--primary-color); }

    /* --- Filter Bar --- */
    .filter-bar { display: flex; gap: 12px; margin-bottom: 24px; flex-wrap: wrap; }
    
    .search-group { flex: 1; position: relative; min-width: 250px; }
    .search-group i {
        position: absolute; left: 16px; top: 50%; transform: translateY(-50%);
        color: var(--text-secondary); font-size: 14px;
    }
    .search-input {
        width: 100%; padding: 12px 16px 12px 42px; border-radius: 12px;
        border: 1px solid var(--border-color); background: var(--bg-card);
        color: var(--text-main); outline: none; font-size: 14px; transition: 0.3s;
    }
    .search-input:focus { border-color: var(--primary-color); box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1); }

    .date-picker {
        background: var(--bg-card); border: 1px solid var(--border-color);
        padding: 10px 16px; border-radius: 12px; display: flex; align-items: center; justify-content: space-between; gap: 10px;
        color: var(--text-main); font-size: 13px; font-weight: 500; cursor: pointer; min-width: 180px;
    }

    /* --- Table Styling --- */
    .table-card {
        background: var(--bg-card); border-radius: 16px; border: 1px solid var(--border-color);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02); overflow-x: auto;
    }
    .transaction-table { width: 100%; border-collapse: collapse; min-width: 800px; }
    
    .transaction-table th {
        text-align: left; padding: 16px 24px; font-size: 12px; font-weight: 600;
        text-transform: uppercase; color: var(--text-secondary); letter-spacing: 0.5px;
        background: var(--bg-body); border-bottom: 1px solid var(--border-color);
    }
    .transaction-table td {
        padding: 20px 24px; border-bottom: 1px solid var(--border-color);
        vertical-align: middle; font-size: 14px; color: var(--text-main);
    }
    .transaction-table tr:hover { background: var(--bg-body); }
    .transaction-table tr:last-child td { border-bottom: none; }

    /* --- Components --- */
    /* User */
    .user-profile { display: flex; align-items: center; gap: 12px; }
    .user-avatar {
        width: 40px; height: 40px; border-radius: 10px; background-size: cover;
        border: 1px solid var(--border-color); flex-shrink: 0;
    }
    .user-details div { font-weight: 600; color: var(--text-main); }
    .user-details small { font-size: 12px; color: var(--text-secondary); }

    /* Badges */
    .status-badge {
        display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px;
        border-radius: 20px; font-size: 12px; font-weight: 600;
    }
    .status-success { background: rgba(34, 197, 94, 0.1); color: #22c55e; }
    .status-pending { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }
    .status-failed { background: rgba(239, 68, 68, 0.1); color: #ef4444; }
    .dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; }

    /* Actions */
    .actions { display: flex; gap: 8px; justify-content: flex-end; opacity: 0.8; transition: 0.2s; }
    .transaction-table tr:hover .actions { opacity: 1; }
    
    .btn-icon {
        width: 32px; height: 32px; border-radius: 8px; border: 1px solid var(--border-color);
        background: var(--bg-card); color: var(--text-secondary); cursor: pointer;
        display: flex; align-items: center; justify-content: center; transition: 0.2s; text-decoration: none;
    }
    .btn-icon:hover { border-color: var(--primary-color); color: var(--primary-color); }
    .btn-verify { background: var(--primary-color); color: white; border: none; }
    .btn-verify:hover { background: var(--primary-hover); color: white; }
    .btn-delete:hover { border-color: #ef4444; color: #ef4444; }

    /* Other */
    .price-tag { font-family: 'Courier New', monospace; font-weight: 700; letter-spacing: -0.5px; color: var(--text-main); }
    .text-icon { display: flex; align-items: center; gap: 6px; font-size: 13px; }
    .text-icon i { color: var(--text-secondary); width: 16px; text-align: center; }

    /* Pagination */
    .pagination-wrapper {
        padding: 16px 24px; border-top: 1px solid var(--border-color);
        display: flex; justify-content: space-between; align-items: center;
        background: var(--bg-body);
    }
    .page-info { font-size: 13px; color: var(--text-secondary); }

    @media (max-width: 768px) {
        .filter-bar { flex-direction: column; align-items: stretch; }
        .date-picker { justify-content: space-between; }
        .pagination-wrapper { flex-direction: column; gap: 15px; }
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <div class="header-title">
        <h1>Riwayat Transaksi</h1>
        <p>Pantau dan kelola semua pembayaran masuk dari pengguna.</p>
    </div>
    <button class="btn-export">
        <i class="fas fa-file-export"></i> Export CSV
    </button>
</div>

<div class="filter-tabs">
    <div class="tab-item active">Semua <span class="badge-count">142</span></div>
    <div class="tab-item">Menunggu <span class="badge-count">24</span></div>
    <div class="tab-item">Berhasil <span class="badge-count">112</span></div>
    <div class="tab-item">Gagal <span class="badge-count">6</span></div>
</div>

<div class="filter-bar">
    <div class="search-group">
        <i class="fas fa-search"></i>
        <input type="text" class="search-input" placeholder="Cari nama, email, atau ID transaksi...">
    </div>
    <div class="date-picker">
        <div style="display: flex; align-items: center; gap: 8px;">
            <i class="far fa-calendar-alt"></i>
            <span>Jan 01 - Jan 31, 2026</span>
        </div>
        <i class="fas fa-chevron-down" style="font-size: 10px;"></i>
    </div>
</div>

<div class="table-card">
    <table class="transaction-table">
        <thead>
            <tr>
                <th>Pengguna</th>
                <th>Paket</th>
                <th>Metode</th>
                <th>Tanggal</th>
                <th>Nominal</th>
                <th>Status</th>
                <th style="text-align: right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $transactions = [
                    [
                        'id' => 'TX-882910', 'name' => 'Fadhil Muhammad', 'email' => 'fadhil@studio.com',
                        'avatar_url' => 'https://ui-avatars.com/api/?name=Fadhil+M&background=e0f2fe&color=0369a1',
                        'plan' => 'Pro Lifetime', 'method' => 'BCA', 'icon' => 'university',
                        'date' => 'Hari ini, 14:20', 'amount' => 'Rp 199.322', 'status' => 'pending'
                    ],
                    [
                        'id' => 'TX-882909', 'name' => 'Sarah Clarissa', 'email' => 'sarah.cl@gmail.com',
                        'avatar_url' => 'https://ui-avatars.com/api/?name=Sarah+C&background=dcfce7&color=166534',
                        'plan' => 'Monthly Plan', 'method' => 'QRIS', 'icon' => 'qrcode',
                        'date' => '29 Jan, 10:15', 'amount' => 'Rp 49.000', 'status' => 'success'
                    ],
                    [
                        'id' => 'TX-882908', 'name' => 'Budi Santoso', 'email' => 'budi.s@corporate.id',
                        'avatar_url' => 'https://ui-avatars.com/api/?name=Budi+S&background=fef3c7&color=92400e',
                        'plan' => 'Pro Yearly', 'method' => 'Mandiri', 'icon' => 'university',
                        'date' => '28 Jan, 16:45', 'amount' => 'Rp 450.000', 'status' => 'failed'
                    ],
                ];
            @endphp

            @foreach($transactions as $trx)
            <tr>
                <td>
                    <div class="user-profile">
                        <div class="user-avatar" style="background-image: url('{{ $trx['avatar_url'] }}');"></div>
                        <div class="user-details">
                            <div>{{ $trx['name'] }}</div>
                            <small>{{ $trx['id'] }}</small>
                        </div>
                    </div>
                </td>
                <td><span style="font-weight: 600;">{{ $trx['plan'] }}</span></td>
                <td>
                    <div class="text-icon">
                        <i class="fas fa-{{ $trx['icon'] }}"></i> {{ $trx['method'] }}
                    </div>
                </td>
                <td style="color: var(--text-secondary); font-size: 13px;">{{ $trx['date'] }}</td>
                <td class="price-tag">{{ $trx['amount'] }}</td>
                <td>
                    @if($trx['status'] == 'success')
                        <span class="status-badge status-success"><span class="dot"></span> Berhasil</span>
                    @elseif($trx['status'] == 'pending')
                        <span class="status-badge status-pending"><span class="dot"></span> Menunggu</span>
                    @else
                        <span class="status-badge status-failed"><span class="dot"></span> Gagal</span>
                    @endif
                </td>
                <td>
                    <div class="actions">
                        @if($trx['status'] == 'pending')
                            <button class="btn-icon btn-verify" title="Verifikasi"><i class="fas fa-check"></i></button>
                        @elseif($trx['status'] == 'success')
                            <button class="btn-icon" title="Cetak Invoice"><i class="fas fa-print"></i></button>
                        @else
                            <button class="btn-icon btn-delete" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                        @endif
                        <a href="#" class="btn-icon" title="Detail"><i class="fas fa-eye"></i></a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination-wrapper">
        <div class="page-info">Menampilkan <strong>1-10</strong> dari <strong>142</strong> transaksi</div>
        <div style="display: flex; gap: 5px;">
            <button class="btn-icon"><i class="fas fa-chevron-left"></i></button>
            <button class="btn-icon" style="background: var(--primary-color); color: white; border-color: var(--primary-color);">1</button>
            <button class="btn-icon">2</button>
            <button class="btn-icon">3</button>
            <button class="btn-icon"><i class="fas fa-chevron-right"></i></button>
        </div>
    </div>
</div>

@endsection