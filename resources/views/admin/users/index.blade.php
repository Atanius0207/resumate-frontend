@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')

@push('styles')
<style>
    /* --- 1. Page Header --- */
    .page-header {
        display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 32px;
        flex-wrap: wrap; gap: 16px;
    }
    .header-title h1 { font-size: 28px; font-weight: 800; color: var(--text-main); margin-bottom: 4px; letter-spacing: -0.5px; }
    .header-title p { color: var(--text-secondary); font-size: 14px; }

    .btn-add-user {
        background: var(--primary-color); border: none; color: white;
        padding: 10px 24px; border-radius: 10px; font-size: 14px; font-weight: 600;
        display: flex; align-items: center; gap: 8px; cursor: pointer; transition: 0.2s;
        box-shadow: 0 4px 12px rgba(76, 175, 80, 0.25); white-space: nowrap;
    }
    .btn-add-user:hover { background: var(--primary-hover); transform: translateY(-2px); }

    /* --- 2. Filter Tabs (Responsive Scroll) --- */
    .filter-tabs {
        display: flex; gap: 24px; 
        border-bottom: 1px solid var(--border-color); 
        margin-bottom: 24px;
        
        /* Horizontal Scroll Logic */
        overflow-x: auto;
        white-space: nowrap;
        -ms-overflow-style: none;  /* IE/Edge */
        scrollbar-width: none;  /* Firefox */
        padding-bottom: 0px; /* Reset padding bottom */
    }
    .filter-tabs::-webkit-scrollbar { display: none; } /* Chrome/Safari */

    .tab-item {
        padding-bottom: 14px; /* Jarak ke border bawah */
        font-size: 14px; font-weight: 600; color: var(--text-secondary);
        cursor: pointer; position: relative; transition: 0.3s;
        display: flex; align-items: center; gap: 8px;
    }
    .tab-item:hover, .tab-item.active { color: var(--primary-color); }
    
    /* Garis indikator aktif */
    .tab-item.active::after {
        content: ''; position: absolute; bottom: -1px; left: 0; width: 100%; height: 2px;
        background: var(--primary-color); border-radius: 2px 2px 0 0;
    }

    .badge-count {
        background: var(--bg-body); padding: 2px 8px; border-radius: 12px; 
        font-size: 11px; font-weight: 700; color: var(--text-main); 
        border: 1px solid var(--border-color);
    }
    .tab-item.active .badge-count { 
        background: rgba(76, 175, 80, 0.1); color: var(--primary-color); border-color: var(--primary-color); 
    }

    /* --- 3. Filter Search Bar --- */
    .filter-bar {
        display: flex; gap: 12px; margin-bottom: 24px; flex-wrap: wrap;
    }
    .search-group {
        flex: 1; position: relative; min-width: 250px;
    }
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

    .btn-filter-icon {
        padding: 12px 20px; border-radius: 12px; display: flex; align-items: center; gap: 8px;
        border: 1px solid var(--border-color); background: var(--bg-card); 
        font-size: 13px; font-weight: 600; cursor: pointer; color: var(--text-main);
        white-space: nowrap; transition: 0.2s;
    }
    .btn-filter-icon:hover { border-color: var(--primary-color); color: var(--primary-color); }

    /* --- 4. Table Design --- */
    .table-card {
        background: var(--bg-card); border-radius: 16px; border: 1px solid var(--border-color);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02); 
        overflow: hidden; /* Rounded corner fix */
        display: flex; flex-direction: column;
    }
    
    .table-responsive {
        width: 100%;
        overflow-x: auto; /* Scroll horizontal jika tabel terlalu lebar */
        -webkit-overflow-scrolling: touch; /* Smooth scroll di iOS */
    }

    .user-table { width: 100%; border-collapse: collapse; min-width: 900px; /* Paksa lebar minimal */ }
    
    .user-table th {
        text-align: left; padding: 16px 24px; font-size: 12px; font-weight: 600;
        text-transform: uppercase; color: var(--text-secondary); background: var(--bg-body);
        border-bottom: 1px solid var(--border-color); letter-spacing: 0.5px; white-space: nowrap;
    }
    .user-table td {
        padding: 16px 24px; border-bottom: 1px solid var(--border-color);
        vertical-align: middle; font-size: 14px; color: var(--text-main); white-space: nowrap;
    }
    .user-table tr:hover { background: var(--bg-body); }
    .user-table tr:last-child td { border-bottom: none; }

    /* --- 5. Components (User, Badges) --- */
    .profile-group { display: flex; align-items: center; gap: 12px; }
    .avatar-circle {
        width: 40px; height: 40px; border-radius: 10px; background-size: cover;
        border: 1px solid var(--border-color); flex-shrink: 0;
    }

    /* Level Tag (PRO/FREE) */
    .level-tag {
        padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 800; text-transform: uppercase;
        display: inline-block; letter-spacing: 0.5px;
    }
    .level-pro { background: #E0E7FF; color: #4338CA; border: 1px solid #C7D2FE; }
    .level-free { background: var(--bg-body); color: var(--text-secondary); border: 1px solid var(--border-color); }

    /* Status Badge (Active/Inactive) */
    .status-badge {
        display: inline-flex; align-items: center; gap: 6px; padding: 4px 12px;
        border-radius: 20px; font-size: 12px; font-weight: 600;
    }
    /* RGBA agar support dark mode */
    .status-active { background: rgba(34, 197, 94, 0.1); color: #16A34A; border: 1px solid rgba(34, 197, 94, 0.2); }
    .status-inactive { background: rgba(107, 114, 128, 0.1); color: #6B7280; border: 1px solid rgba(107, 114, 128, 0.2); }
    .dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; }

    /* Action Buttons */
    .actions { display: flex; gap: 8px; justify-content: flex-end; opacity: 0.8; transition: 0.2s; }
    .user-table tr:hover .actions { opacity: 1; }
    
    .btn-icon {
        width: 32px; height: 32px; border-radius: 8px; border: 1px solid var(--border-color);
        background: var(--bg-card); color: var(--text-secondary); cursor: pointer;
        display: flex; align-items: center; justify-content: center; transition: 0.2s;
    }
    .btn-icon:hover { border-color: var(--primary-color); color: var(--primary-color); }
    .btn-delete:hover { border-color: #EF4444; color: #EF4444; background: rgba(239, 68, 68, 0.05); }

    /* --- 6. Pagination --- */
    .pagination-wrapper {
        padding: 16px 24px; border-top: 1px solid var(--border-color);
        display: flex; justify-content: space-between; align-items: center; background: var(--bg-body);
    }
    .page-info { font-size: 13px; color: var(--text-secondary); }

    /* --- 7. RESPONSIVE MEDIA QUERIES --- */
    @media (max-width: 768px) {
        /* Header Stacking */
        .page-header { flex-direction: column; align-items: flex-start; gap: 16px; }
        .header-title h1 { font-size: 24px; }
        .btn-add-user { width: 100%; justify-content: center; }
        
        /* Filter Bar Stacking */
        .filter-bar { flex-direction: column; align-items: stretch; }
        .search-group { width: 100%; }
        .btn-filter-icon { justify-content: center; }

        /* Pagination Stacking */
        .pagination-wrapper { flex-direction: column; gap: 16px; text-align: center; }
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <div class="header-title">
        <h1>Manajemen Pengguna</h1>
        <p>Total 1,240 pengguna terdaftar dalam sistem Anda.</p>
    </div>
    <a href="{{ route('tambah-user')}}" class="btn-add-user">
        <i class="fas fa-user-plus"></i> Tambah User Baru
    </a>
</div>

<div class="filter-tabs">
    <div class="tab-item active">Semua User <span class="badge-count">1.240</span></div>
    <div class="tab-item">Premium (PRO) <span class="badge-count">412</span></div>
    <div class="tab-item">Pengguna Gratis <span class="badge-count">810</span></div>
    <div class="tab-item">Baru Mendaftar <span class="badge-count">18</span></div>
    <div class="tab-item">Nonaktif <span class="badge-count">5</span></div>
</div>

<div class="filter-bar">
    <div class="search-group">
        <i class="fas fa-search"></i>
        <input type="text" class="search-input" placeholder="Cari nama, email, atau ID user...">
    </div>
    <button class="btn-filter-icon">
        <i class="fas fa-sliders-h"></i> Filter Lanjutan
    </button>
</div>

<div class="table-card">
    <div class="table-responsive">
        <table class="user-table">
            <thead>
                <tr>
                    <th>Identitas Pengguna</th>
                    <th>Status Akun</th>
                    <th>Paket</th>
                    <th>Bergabung Pada</th>
                    <th>Terakhir Aktif</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $users = [
                        [
                            'name' => 'Aditya Pratama', 
                            'email' => 'adit.pratama@gmail.com',
                            'avatar_color' => '0369a1', 'avatar_bg' => 'e0f2fe',
                            'level' => 'PRO', 'joined' => '12 Jan 2026', 'last' => '2 menit yang lalu', 'status' => 'active'
                        ],
                        [
                            'name' => 'Sinta Bella', 
                            'email' => 'sinta.b@perusahaan.id', 
                            'avatar_color' => '9d174d', 'avatar_bg' => 'fce7f3',
                            'level' => 'FREE', 'joined' => '05 Jan 2026', 'last' => '1 jam yang lalu', 'status' => 'active'
                        ],
                        [
                            'name' => 'Rizky Amalia', 
                            'email' => 'rizky.am@yahoo.com', 
                            'avatar_color' => '92400e', 'avatar_bg' => 'fef3c7',
                            'level' => 'PRO', 'joined' => '28 Des 2025', 'last' => 'Hari ini, 09:12', 'status' => 'inactive'
                        ],
                        [
                            'name' => 'Budi Santoso', 
                            'email' => 'budi.santoso@mail.com', 
                            'avatar_color' => '166534', 'avatar_bg' => 'dcfce7',
                            'level' => 'FREE', 'joined' => '10 Feb 2026', 'last' => 'Baru saja', 'status' => 'active'
                        ],
                    ];
                @endphp

                @foreach($users as $user)
                <tr>
                    <td>
                        <div class="profile-group">
                            <div class="avatar-circle" 
                                 style="background-image: url('https://ui-avatars.com/api/?name={{ urlencode($user['name']) }}&background={{ $user['avatar_bg'] }}&color={{ $user['avatar_color'] }}&size=128');">
                            </div>
                            <div>
                                <div style="font-weight: 700; color: var(--text-main);">{{ $user['name'] }}</div>
                                <div style="font-size: 12px; color: var(--text-secondary);">{{ $user['email'] }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        @if($user['status'] == 'active')
                            <span class="status-badge status-active"><span class="dot"></span> Aktif</span>
                        @else
                            <span class="status-badge status-inactive"><span class="dot"></span> Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <span class="level-tag {{ $user['level'] == 'PRO' ? 'level-pro' : 'level-free' }}">
                            {{ $user['level'] }}
                        </span>
                    </td>
                    <td style="font-size: 13px; color: var(--text-secondary);">{{ $user['joined'] }}</td>
                    <td style="font-size: 13px; font-weight: 500;">{{ $user['last'] }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('edit-user')}}" class="btn-icon" title="Edit User"><i class="fas fa-pen"></i></a>
                            <a href="{{ route('reset-password')}}" class="btn-icon" title="Reset Password"><i class="fas fa-key"></i></a>
                            <button class="btn-icon btn-delete" title="Hapus User"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        <div class="page-info">Menampilkan <strong>1-10</strong> dari <strong>1.240</strong> pengguna</div>
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