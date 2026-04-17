<div class="dashboard">

    <!-- Sidebar -->
    <aside class="sidebar">
    <div class="sidebar__section">
        <span class="sidebar__label">Main</span>

        <a href="<?php echo home_url('/dashboard'); ?>" 
           class="sidebar__link <?php echo is_page('dashboard') ? 'active' : ''; ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7"/>
                <rect x="14" y="3" width="7" height="7"/>
                <rect x="3" y="14" width="7" height="7"/>
                <rect x="14" y="14" width="7" height="7"/>
            </svg>
            Dashboard
        </a>

        <a href="<?php echo home_url('/edit-profile'); ?>" 
           class="sidebar__link <?php echo is_page('edit-profile') ? 'active' : ''; ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
            Edit Profile
        </a>

        <a href="<?php echo home_url('/projects'); ?>" 
           class="sidebar__link <?php echo is_page('projects') ? 'active' : ''; ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
            </svg>
            Projects
        </a>

        <a href="<?php echo home_url('/skills'); ?>" 
           class="sidebar__link <?php echo is_page('skills') ? 'active' : ''; ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
            </svg>
            Skills
        </a>
    </div>

    <div class="sidebar__section" style="margin-top:1rem;">
        <span class="sidebar__label">Account</span>

        <a href="<?php echo home_url('/settings'); ?>" 
           class="sidebar__link <?php echo is_page('settings') ? 'active' : ''; ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="3"/>
                <path d="M19.07 4.93a10 10 0 0 1 0 14.14"/>
                <path d="M4.93 4.93a10 10 0 0 0 0 14.14"/>
            </svg>
            Settings
        </a>

        <a href="<?php echo wp_logout_url( home_url('/login') ); ?>" class="sidebar__link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
            Log out
        </a>
    </div>
</aside>