@extends('layouts.app')

@section('title', 'My Profile - ' . config('app.name'))

@section('content')
<style>
    /* Additional Profile Page Styles */
    .page {
        max-width: 900px;
        margin: 0 auto;
        padding: 48px 24px 80px;
    }

    /* Profile Header */
    .profile-header {
        display: flex;
        align-items: flex-end;
        gap: 28px;
        margin-bottom: 40px;
        padding-bottom: 36px;
        border-bottom: 1px solid var(--rule);
    }

    .avatar-wrap {
        position: relative;
        flex-shrink: 0;
    }

    .avatar-big {
        width: 88px;
        height: 88px;
        border-radius: 50%;
        background: var(--green-mid);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Playfair Display', serif;
        font-size: 32px;
        color: var(--green-dark);
        border: 3px solid var(--white);
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
    }

    .avatar-edit {
        position: absolute;
        bottom: 2px;
        right: 2px;
        width: 24px;
        height: 24px;
        background: var(--white);
        border: 1.5px solid var(--rule);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 10px;
        color: var(--ink-mid);
        transition: border-color .2s, color .2s;
    }

    .avatar-edit:hover {
        border-color: var(--green);
        color: var(--green-dark);
    }

    .profile-info {
        flex: 1;
    }

    .profile-info h1 {
        font-family: 'Playfair Display', serif;
        font-size: 30px;
        letter-spacing: -0.8px;
        color: var(--ink);
        margin-bottom: 4px;
    }

    .profile-info .email {
        font-size: 14px;
        color: var(--ink-faint);
        margin-bottom: 12px;
    }

    .profile-badges {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .badge {
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.04em;
    }

    .badge-plan {
        background: var(--green-pale);
        color: var(--green-dark);
        border: 1px solid var(--green-mid);
    }

    .badge-member {
        background: #f5f5f3;
        color: var(--ink-mid);
        border: 1px solid var(--rule);
    }

    .profile-header-actions {
        flex-shrink: 0;
    }

    .btn-edit-profile {
        padding: 9px 18px;
        background: transparent;
        border: 1.5px solid var(--rule);
        border-radius: 8px;
        font-family: 'Outfit', sans-serif;
        font-size: 13px;
        font-weight: 500;
        color: var(--ink-mid);
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 7px;
        transition: border-color .2s, color .2s;
    }

    .btn-edit-profile:hover {
        border-color: var(--green);
        color: var(--green-dark);
    }

    /* Content Grid */
    .content-grid {
        display: grid;
        grid-template-columns: 1fr 280px;
        gap: 32px;
        align-items: start;
    }

    /* Section Label */
    .section-label {
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--ink-faint);
        margin-bottom: 16px;
    }

    /* CV List */
    .cv-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .cv-card {
        background: var(--white);
        border: 1.5px solid var(--rule);
        border-radius: 10px;
        padding: 18px 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        transition: border-color .2s, box-shadow .2s;
        cursor: pointer;
        text-decoration: none;
        color: inherit;
    }

    .cv-card:hover {
        border-color: var(--green);
        box-shadow: 0 4px 16px rgba(76, 175, 80, .1);
    }

    .cv-thumb-mini {
        width: 44px;
        height: 56px;
        border-radius: 4px;
        background: var(--green-pale);
        border: 1px solid var(--green-mid);
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        gap: 3px;
        padding: 6px 5px;
        overflow: hidden;
    }

    .mini-bar {
        height: 3px;
        background: var(--green-mid);
        border-radius: 2px;
    }

    .mini-bar.accent {
        background: var(--green);
        width: 50%;
    }

    .mini-bar.short {
        width: 65%;
    }

    .cv-info {
        flex: 1;
        min-width: 0;
    }

    .cv-name {
        font-size: 15px;
        font-weight: 600;
        color: var(--ink);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-bottom: 3px;
    }

    .cv-meta {
        font-size: 12px;
        color: var(--ink-faint);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .cv-meta .dot {
        width: 3px;
        height: 3px;
        background: var(--rule);
        border-radius: 50%;
    }

    .cv-status {
        padding: 3px 9px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        flex-shrink: 0;
    }

    .cv-status.done {
        background: var(--green-pale);
        color: var(--green-dark);
    }

    .cv-status.draft {
        background: #fffbf0;
        color: #b45309;
        border: 1px solid #fde68a;
    }

    .cv-actions {
        display: flex;
        gap: 4px;
        flex-shrink: 0;
    }

    .cv-action-btn {
        width: 30px;
        height: 30px;
        border: 1px solid var(--rule);
        border-radius: 6px;
        background: transparent;
        color: var(--ink-faint);
        font-size: 11px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all .2s;
    }

    .cv-action-btn:hover {
        border-color: var(--green);
        color: var(--green-dark);
    }

    .cv-action-btn.del:hover {
        border-color: var(--red);
        color: var(--red);
    }

    /* Sidebar */
    .sidebar {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .side-card {
        background: var(--white);
        border: 1.5px solid var(--rule);
        border-radius: 10px;
        padding: 20px;
    }

    .side-card-title {
        font-size: 13px;
        font-weight: 600;
        color: var(--ink);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid var(--rule);
        font-size: 13px;
    }

    .info-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .info-row .key {
        color: var(--ink-faint);
    }

    .info-row .val {
        color: var(--ink);
        font-weight: 500;
        text-align: right;
    }

    .info-row .val.green {
        color: var(--green-dark);
    }

    .upgrade-box {
        background: var(--green-pale);
        border: 1px solid var(--green-mid);
        border-radius: 8px;
        padding: 16px;
        text-align: center;
    }

    .upgrade-box p {
        font-size: 13px;
        color: var(--green-dark);
        line-height: 1.5;
        margin-bottom: 12px;
    }

    .btn-upgrade {
        width: 100%;
        padding: 9px;
        background: var(--green);
        color: #fff;
        border: none;
        border-radius: 7px;
        font-family: 'Outfit', sans-serif;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: background .2s;
    }

    .btn-upgrade:hover {
        background: var(--green-dark);
    }

    .activity-list {
        display: flex;
        flex-direction: column;
        gap: 0;
    }

    .activity-item {
        display: flex;
        gap: 12px;
        align-items: flex-start;
        padding: 10px 0;
        border-bottom: 1px solid var(--rule);
        font-size: 13px;
    }

    .activity-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .activity-icon {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: var(--green-pale);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        color: var(--green-dark);
        flex-shrink: 0;
        margin-top: 1px;
    }

    .activity-text {
        flex: 1;
        line-height: 1.5;
        color: var(--ink-mid);
    }

    .activity-text strong {
        color: var(--ink);
        font-weight: 600;
    }

    .activity-time {
        font-size: 11px;
        color: var(--ink-faint);
        white-space: nowrap;
    }

    /* Account Settings */
    .settings-section {
        margin-top: 36px;
    }

    .settings-block {
        background: var(--white);
        border: 1.5px solid var(--rule);
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 12px;
    }

    .settings-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 20px;
        border-bottom: 1px solid var(--rule);
        gap: 16px;
    }

    .settings-row:last-child {
        border-bottom: none;
    }

    .settings-row-left {
        flex: 1;
    }

    .settings-row-left .s-title {
        font-size: 14px;
        font-weight: 500;
        color: var(--ink);
    }

    .settings-row-left .s-desc {
        font-size: 12px;
        color: var(--ink-faint);
        margin-top: 2px;
    }

    .btn-setting {
        padding: 7px 14px;
        border: 1.5px solid var(--rule);
        border-radius: 7px;
        background: transparent;
        font-family: 'Outfit', sans-serif;
        font-size: 12px;
        font-weight: 500;
        color: var(--ink-mid);
        cursor: pointer;
        white-space: nowrap;
        transition: all .2s;
        flex-shrink: 0;
    }

    .btn-setting:hover {
        border-color: var(--green);
        color: var(--green-dark);
    }

    .btn-setting.danger {
        color: var(--red);
        border-color: #ffc9c9;
    }

    .btn-setting.danger:hover {
        background: var(--red-soft);
        border-color: var(--red);
    }

    /* Toggle Switch */
    .toggle {
        position: relative;
        width: 40px;
        height: 22px;
        flex-shrink: 0;
    }

    .toggle input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .toggle-slider {
        position: absolute;
        inset: 0;
        background: var(--rule);
        border-radius: 22px;
        cursor: pointer;
        transition: background .2s;
    }

    .toggle-slider::before {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: white;
        left: 3px;
        top: 3px;
        transition: transform .2s;
        box-shadow: 0 1px 4px rgba(0, 0, 0, .15);
    }

    .toggle input:checked + .toggle-slider {
        background: var(--green);
    }

    .toggle input:checked + .toggle-slider::before {
        transform: translateX(18px);
    }

    /* Responsive */
    @media (max-width: 720px) {
        .page {
            padding: 32px 16px 60px;
        }

        .profile-header {
            flex-wrap: wrap;
        }

        .profile-header-actions {
            width: 100%;
        }

        .content-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="page">
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="avatar-wrap">
            <div class="avatar-big">
                {{-- @if(auth()->user()->avatar) --}}
                    {{-- <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;"> --}}
                {{-- @else --}}
                    {{-- {{ strtoupper(substr(auth()->user()->name, 0, 1)) }} --}}
                {{-- @endif --}}
            </div>
            <div class="avatar-edit"><i class="fas fa-pen"></i></div>
        </div>

        <div class="profile-info">
            <h1>{{ auth()->user()->name ?? 'Andi Pratama' }}</h1>
            <p class="email">{{ auth()->user()->email ?? 'andi.pratama@email.com' }}</p>
            <div class="profile-badges">
                <span class="badge badge-plan">Free Plan</span>
                <span class="badge badge-member">Member since Jan 2024</span>
            </div>
        </div>

        <div class="profile-header-actions">
            <button class="btn-edit-profile">
                <i class="fas fa-pen"></i> Edit Profile
            </button>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="content-grid">
        <!-- Left: CV List + Settings -->
        <div>
            <div class="section-label">My CVs</div>

            <div class="cv-list">
                <!-- CV item 1 -->
                <div class="cv-card">
                    <div class="cv-thumb-mini">
                        <div class="mini-bar accent"></div>
                        <div class="mini-bar"></div>
                        <div class="mini-bar short"></div>
                        <div class="mini-bar"></div>
                        <div class="mini-bar short"></div>
                    </div>
                    <div class="cv-info">
                        <div class="cv-name">CV Frontend Developer Application</div>
                        <div class="cv-meta">
                            <span>Modern Template</span>
                            <span class="dot"></span>
                            <span>Updated 2 days ago</span>
                        </div>
                    </div>
                    <span class="cv-status done">Complete</span>
                    <div class="cv-actions">
                        <button class="cv-action-btn" title="Download"><i class="fas fa-download"></i></button>
                        <button class="cv-action-btn" title="Edit"><i class="fas fa-pen"></i></button>
                        <button class="cv-action-btn del" title="Delete"><i class="fas fa-trash"></i></button>
                    </div>
                </div>

                <!-- CV item 2 -->
                <div class="cv-card">
                    <div class="cv-thumb-mini">
                        <div class="mini-bar"></div>
                        <div class="mini-bar accent"></div>
                        <div class="mini-bar short"></div>
                        <div class="mini-bar"></div>
                    </div>
                    <div class="cv-info">
                        <div class="cv-name">CV UI/UX Designer — Startup</div>
                        <div class="cv-meta">
                            <span>Minimal Template</span>
                            <span class="dot"></span>
                            <span>Updated 1 week ago</span>
                        </div>
                    </div>
                    <span class="cv-status done">Complete</span>
                    <div class="cv-actions">
                        <button class="cv-action-btn" title="Download"><i class="fas fa-download"></i></button>
                        <button class="cv-action-btn" title="Edit"><i class="fas fa-pen"></i></button>
                        <button class="cv-action-btn del" title="Delete"><i class="fas fa-trash"></i></button>
                    </div>
                </div>

                <!-- CV item 3 — draft -->
                <div class="cv-card">
                    <div class="cv-thumb-mini">
                        <div class="mini-bar short"></div>
                        <div class="mini-bar"></div>
                        <div class="mini-bar accent short"></div>
                    </div>
                    <div class="cv-info">
                        <div class="cv-name">CV Internship — Incomplete</div>
                        <div class="cv-meta">
                            <span>Classic Template</span>
                            <span class="dot"></span>
                            <span>Updated 3 weeks ago</span>
                        </div>
                    </div>
                    <span class="cv-status draft">Draft</span>
                    <div class="cv-actions">
                        <button class="cv-action-btn" title="Edit"><i class="fas fa-pen"></i></button>
                        <button class="cv-action-btn del" title="Delete"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            </div>

            <!-- Account Settings -->
            <div class="settings-section">
                <div class="section-label">Account Settings</div>

                <div class="settings-block">
                    <div class="settings-row">
                        <div class="settings-row-left">
                            <div class="s-title">Full Name</div>
                            <div class="s-desc">{{ auth()->user()->name ?? 'Andi Pratama' }}</div>
                        </div>
                        <button class="btn-setting">Change</button>
                    </div>
                    <div class="settings-row">
                        <div class="settings-row-left">
                            <div class="s-title">Email</div>
                            <div class="s-desc">{{ auth()->user()->email ?? 'andi.pratama@email.com' }}</div>
                        </div>
                        <button class="btn-setting">Change</button>
                    </div>
                    <div class="settings-row">
                        <div class="settings-row-left">
                            <div class="s-title">Password</div>
                            <div class="s-desc">Last changed 3 months ago</div>
                        </div>
                        <button class="btn-setting">Change</button>
                    </div>
                </div>

                <div class="settings-block">
                    <div class="settings-row">
                        <div class="settings-row-left">
                            <div class="s-title">Email Notifications</div>
                            <div class="s-desc">Career tips and new templates</div>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <div class="settings-row">
                        <div class="settings-row-left">
                            <div class="s-title">Dark Mode</div>
                            <div class="s-desc">Use dark theme</div>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" id="darkModeToggle">
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>

                <div class="settings-block">
                    <div class="settings-row">
                        <div class="settings-row-left">
                            <div class="s-title">Logout from Account</div>
                            <div class="s-desc">Active session on this device</div>
                        </div>
                        <form method="POST" action="#" style="margin: 0;">
                            @csrf
                            <button type="submit" class="btn-setting danger">Logout</button>
                        </form>
                    </div>
                    <div class="settings-row">
                        <div class="settings-row-left">
                            <div class="s-title">Delete Account</div>
                            <div class="s-desc">All data will be permanently deleted</div>
                        </div>
                        <button class="btn-setting danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Sidebar -->
        <div class="sidebar">
            <!-- Account Info -->
            <div class="side-card">
                <div class="side-card-title">Account Info</div>
                <div class="info-row">
                    <span class="key">Plan</span>
                    <span class="val green">Free</span>
                </div>
                <div class="info-row">
                    <span class="key">CVs Created</span>
                    <span class="val">3 / 5</span>
                </div>
                <div class="info-row">
                    <span class="key">Downloads</span>
                    <span class="val">2 times</span>
                </div>
                <div class="info-row">
                    <span class="key">Joined</span>
                    <span class="val">Jan 2024</span>
                </div>
            </div>

            <!-- Upgrade -->
            <div class="side-card">
                <div class="upgrade-box">
                    <p>Access 500+ premium templates & unlimited downloads with <strong>Pro Plan.</strong></p>
                    <button class="btn-upgrade">Upgrade to Pro</button>
                </div>
            </div>

            <!-- Activity -->
            <div class="side-card">
                <div class="side-card-title">Activity</div>
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-icon"><i class="fas fa-download"></i></div>
                        <div>
                            <div class="activity-text"><strong>CV Frontend</strong> downloaded</div>
                            <div class="activity-time">2 days ago</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon"><i class="fas fa-pen"></i></div>
                        <div>
                            <div class="activity-text"><strong>CV UI/UX</strong> edited</div>
                            <div class="activity-time">1 week ago</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon"><i class="fas fa-file-circle-plus"></i></div>
                        <div>
                            <div class="activity-text">New CV created</div>
                            <div class="activity-time">3 weeks ago</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Dark mode toggle in settings
    const darkModeToggle = document.getElementById('darkModeToggle');
    if (darkModeToggle) {
        const currentTheme = localStorage.getItem('theme') || 'light';
        darkModeToggle.checked = (currentTheme === 'dark');
        
        darkModeToggle.addEventListener('change', function() {
            const newTheme = this.checked ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            
            // Update navbar theme icon
            const themeIcon = document.querySelector('.theme-toggle-btn i');
            if (themeIcon) {
                if (newTheme === 'dark') {
                    themeIcon.classList.remove('fa-moon');
                    themeIcon.classList.add('fa-sun');
                } else {
                    themeIcon.classList.remove('fa-sun');
                    themeIcon.classList.add('fa-moon');
                }
            }
        });
    }
</script>
@endpush
@endsection