<style>
    .top-header {
        height: var(--header-height);
        background: var(--bg-card);
        border-bottom: 1px solid var(--border-color);
        display: flex; align-items: center; justify-content: space-between;
        padding: 0 30px;
        position: sticky; top: 0; z-index: 40;
    }

    .header-left { display: flex; align-items: center; gap: 20px; }
    .toggle-sidebar { display: none; font-size: 20px; cursor: pointer; color: var(--text-main); }

    .search-box {
        position: relative;
    }
    .search-box input {
        background: var(--bg-body);
        border: 1px solid var(--border-color);
        padding: 8px 15px 8px 35px;
        border-radius: 50px;
        color: var(--text-main);
        width: 250px;
        font-size: 13px;
        outline: none;
    }
    .search-box i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 13px; }

    .header-right { display: flex; align-items: center; gap: 20px; }

    .theme-btn {
        background: none; border: none; cursor: pointer;
        font-size: 18px; color: var(--text-main);
        transition: transform 0.3s;
    }
    .theme-btn:hover { transform: rotate(15deg); color: var(--primary-color); }

    .admin-profile { display: flex; align-items: center; gap: 10px; cursor: pointer; }
    .admin-info { text-align: right; line-height: 1.2; }
    .admin-name { font-weight: 700; font-size: 14px; color: var(--text-main); }
    .admin-role { font-size: 11px; color: var(--text-muted); }
    .admin-img {
        width: 38px; height: 38px; border-radius: 50%; background: #E2E8F0;
        display: flex; align-items: center; justify-content: center;
        font-weight: 700; color: var(--text-muted);
    }

    @media (max-width: 768px) {
        .toggle-sidebar { display: block; }
        .search-box { display: none; } /* Hide search on mobile */
    }
</style>

<header class="top-header">
    <div class="header-left">
        <i class="fas fa-bars toggle-sidebar" onclick="document.getElementById('sidebar').classList.toggle('open')"></i>
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Cari data transaksi...">
        </div>
    </div>

    <div class="header-right">
        <button class="theme-btn" onclick="toggleTheme()">
            <i class="fas fa-moon" id="theme-icon"></i>
        </button>

        <div class="admin-profile">
            <div class="admin-info">
                <div class="admin-name">Admin</div>
                <div class="admin-role">Administrator</div>
            </div>
            <div class="admin-img">AD</div>
        </div>
    </div>
</header>