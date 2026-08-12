@extends('layouts.app')

@section('content')
<style>
    /* Premium Profile Design System */
    .profile-wrapper {
        background-color: #faf8f5; /* Warm boutique cream-tinted background */
        min-height: calc(100vh - 120px);
        padding: 50px 0;
    }
    
    .profile-container {
        max-width: 1150px;
        margin: 0 auto;
        padding: 0 20px;
        display: grid;
        grid-template-columns: 290px 1fr;
        gap: 35px;
    }
    
    @media (max-width: 992px) {
        .profile-container {
            grid-template-columns: 1fr;
            gap: 30px;
        }
    }
    
    /* Left Sidebar Card */
    .profile-sidebar {
        background: #ffffff;
        border-radius: 24px;
        box-shadow: 0 8px 30px rgba(163, 116, 88, 0.05);
        padding: 35px 25px;
        text-align: center;
        border: 1px solid var(--border-soft);
        height: fit-content;
        position: sticky;
        top: 20px;
        transition: all 0.3s ease;
    }
    
    .profile-sidebar:hover {
        box-shadow: 0 12px 40px rgba(163, 116, 88, 0.09);
        transform: translateY(-2px);
    }
    
    /* Avatar Upload Wiggle & Pulse */
    .sidebar-avatar-wrapper {
        position: relative;
        width: 120px;
        height: 120px;
        margin: 0 auto 20px;
        cursor: pointer;
    }
    
    .sidebar-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 3.5px solid var(--luxury-gold);
        box-shadow: 0 6px 15px rgba(211, 158, 130, 0.15);
        transition: all 0.3s ease;
    }
    
    .sidebar-avatar-placeholder {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: #fdf3eb;
        color: var(--accent-peach);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        font-weight: 700;
        border: 3.5px solid var(--luxury-gold);
        text-transform: uppercase;
        box-shadow: 0 6px 15px rgba(211, 158, 130, 0.1);
        transition: all 0.3s ease;
    }
    
    .avatar-edit-overlay {
        position: absolute;
        bottom: 4px;
        right: 4px;
        background: var(--dark-charcoal);
        color: white;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid white;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        font-size: 0.8rem;
        box-shadow: 0 2px 5px rgba(0,0,0,0.15);
    }
    
    .sidebar-avatar-wrapper:hover .avatar-edit-overlay {
        background: var(--accent-peach);
        transform: scale(1.15) rotate(15deg);
    }
    
    .sidebar-avatar-wrapper:hover .sidebar-avatar,
    .sidebar-avatar-wrapper:hover .sidebar-avatar-placeholder {
        filter: brightness(0.92);
        transform: translateY(-2px);
    }
    
    .sidebar-name {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--dark-charcoal);
        margin-bottom: 4px;
        letter-spacing: -0.3px;
    }
    
    .sidebar-email {
        font-size: 0.88rem;
        color: var(--slate-gray);
        margin-bottom: 20px;
        word-break: break-all;
    }
    
    .sidebar-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #fdf5f0;
        color: var(--accent-peach);
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 600;
        border: 1px solid #fce8dd;
        margin-bottom: 15px;
    }
    
    .sidebar-badge.google-linked {
        background: #e8f0fe;
        color: #1967d2;
        border-color: #d2e3fc;
    }
    
    .sidebar-badge.google-linked img {
        width: 14px;
        height: 14px;
    }
    

    
    /* Sidebar stats layout */
    .sidebar-stats {
        margin-top: 20px;
        border-top: 1px solid #f6f3ee;
        padding-top: 20px;
        text-align: left;
        display: grid;
        gap: 10px;
    }
    
    .stat-row {
        display: flex;
        justify-content: space-between;
        font-size: 0.85rem;
    }
    
    .stat-row span {
        color: var(--slate-gray);
    }
    
    .stat-row strong {
        color: var(--dark-charcoal);
        font-weight: 600;
    }
    
    /* Right Main Layout */
    .profile-main {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }
    
    /* Main Page Header styling */
    .profile-header-block {
        margin-bottom: 10px;
    }
    
    .profile-header-title h2 {
        font-size: 1.6rem;
        font-weight: 700;
        color: var(--dark-charcoal);
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
        letter-spacing: -0.3px;
    }
    
    .profile-header-title h2 i {
        color: var(--accent-peach);
    }
    
    .profile-header-title p {
        margin: 4px 0 0 0;
        font-size: 0.88rem;
        color: var(--slate-gray);
    }
    
    /* Premium Profile Cards */
    .profile-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(163, 116, 88, 0.03);
        padding: 35px;
        border: 1px solid var(--border-soft);
        transition: all 0.3s ease;
    }
    
    .profile-card:hover {
        box-shadow: 0 8px 30px rgba(163, 116, 88, 0.06);
    }
    
    .profile-section-title {
        font-size: 1.15rem;
        font-weight: 600;
        color: var(--dark-charcoal);
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
        border-bottom: 1px solid #f6f3ee;
        padding-bottom: 12px;
    }
    
    .profile-section-title i {
        color: var(--accent-peach);
        font-size: 1.25rem;
    }
    
    .form-group {
        margin-bottom: 22px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-size: 0.88rem;
        font-weight: 600;
        color: var(--dark-charcoal);
    }
    
    .profile-input {
        width: 100%;
        padding: 12px 18px;
        border: 1px solid var(--border-soft);
        border-radius: 10px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: #fff;
        font-family: inherit;
        color: var(--dark-charcoal);
    }
    
    .profile-input:focus {
        border-color: var(--accent-peach);
        outline: none;
        box-shadow: 0 0 0 3.5px rgba(211, 158, 130, 0.15);
    }
    
    .profile-input[readonly] {
        background-color: #faf8f6;
        color: var(--slate-gray);
        cursor: not-allowed;
    }
    
    /* Submit Button Wrapper */
    .btn-submit-wrapper {
        text-align: right;
        margin-top: 10px;
    }
    
    .profile-btn {
        background: var(--dark-charcoal);
        color: white;
        border: none;
        padding: 14px 35px;
        border-radius: 30px;
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 4px 12px rgba(28, 34, 30, 0.15);
        font-family: inherit;
    }
    
    .profile-btn:hover {
        background: var(--accent-peach);
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(211, 158, 130, 0.25);
    }
    
    .profile-btn:active {
        transform: translateY(0);
    }
    
    .profile-btn i {
        transition: transform 0.3s ease;
    }
    
    .profile-btn:hover i {
        animation: wiggles 0.5s ease infinite alternate;
    }
    
    /* Alert styles */
    .alert-success {
        background: #f0fdf4;
        color: #15803d;
        padding: 16px 20px;
        border-radius: 14px;
        border: 1px solid #dcfce7;
        font-size: 0.92rem;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 500;
    }
    
    .alert-success i {
        font-size: 1.15rem;
    }
    
    /* Animations */
    @keyframes heartbeat {
        0% { transform: scale(1); }
        14% { transform: scale(1.15); }
        28% { transform: scale(1); }
        42% { transform: scale(1.15); }
        70% { transform: scale(1); }
    }
    
    @keyframes wiggles {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(15deg); }
    }
</style>

<div class="profile-wrapper">
    <div class="profile-container">
        
        <!-- Sidebar Card -->
        <div class="profile-sidebar">
            <div class="sidebar-avatar-wrapper" onclick="triggerAvatarUpload()" title="Change profile picture">
                @if($user->avatar)
                    <img src="{{ $user->avatar }}" alt="User Avatar" class="sidebar-avatar">
                @else
                    <div class="sidebar-avatar-placeholder">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                @endif
                <div class="avatar-edit-overlay">
                    <i class="fa-solid fa-camera"></i>
                </div>
            </div>
            
            <!-- Hidden Profile Update Form for Avatar Upload -->
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="profileUpdateForm" style="display: none;">
                @csrf
                <input type="hidden" name="name" value="{{ $user->name }}">
                <input type="file" name="avatar" id="avatarInput" accept="image/*" onchange="previewAvatar(event)">
            </form>
            
            <h2 class="sidebar-name">{{ $user->name }}</h2>
            <p class="sidebar-email">{{ $user->email }}</p>
            
            @if($user->google_id)
                <span class="sidebar-badge google-linked">
                    <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google"> Google Account
                </span>
            @else
                <span class="sidebar-badge">
                    <i class="fa-regular fa-envelope"></i> Email Verified
                </span>
            @endif
            

            
            <div class="sidebar-stats">
                <div class="stat-row">
                    <span>Member Since</span>
                    <strong>{{ $user->created_at->format('M Y') }}</strong>
                </div>
                <div class="stat-row">
                    <span>Total Orders</span>
                    <strong>{{ $orderCount }}</strong>
                </div>
            </div>
        </div>

        <!-- Main Form Content -->
        <div class="profile-main">
            
            <!-- Profile Settings Header -->
            <div class="profile-header-block">
                <div class="profile-header-title">
                    <h2><i class="fa-regular fa-id-card"></i> Account Settings</h2>
                    <p>Update your personal information and standard credentials.</p>
                </div>
            </div>

            <!-- Success Alert -->
            @if(session('success'))
                <div class="alert-success">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
                <div style="background: #fdf3f4; color: #d02c3a; padding: 15px; border-radius: 12px; border: 1px solid #fad7da; font-size: 14px; margin-bottom: 20px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="profileSettingsForm">
                @csrf
                
                <!-- Personal Info Card -->
                <div class="profile-card">
                    <h3 class="profile-section-title"><i class="fa-regular fa-user"></i> Personal Details</h3>
                    
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" id="name" class="profile-input" value="{{ old('name', $user->name) }}" required placeholder="Enter your full name">
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" class="profile-input" value="{{ $user->email }}" readonly title="Email address cannot be changed." placeholder="Enter your email address">
                        <small style="color: var(--slate-gray); margin-top: 6px; display: block; font-size: 0.8rem; line-height: 1.45;">
                            Your login email is managed securely and cannot be changed here.
                        </small>
                    </div>
                </div>

                <!-- Password/Security Card -->
                <div class="profile-card" style="margin-top: 30px;">
                    <h3 class="profile-section-title"><i class="fa-solid fa-shield-halved"></i> Password & Security</h3>
                    
                    @if($user->google_id)
                        <p style="margin-bottom: 25px; color: var(--slate-gray); font-size: 0.9rem; line-height: 1.5;">
                            You log in using your Google account. You don't have a local password. If you'd like to set one, fill in the fields below.
                        </p>
                        <div class="form-group">
                            <label for="password">Create Password</label>
                            <input type="password" name="password" id="password" class="profile-input" placeholder="Set password for standard email login" autocomplete="new-password">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="profile-input" placeholder="Confirm your new password" autocomplete="new-password">
                        </div>
                    @else
                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" name="current_password" id="current_password" class="profile-input" placeholder="Enter current password to save changes" autocomplete="current-password">
                        </div>
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" name="password" id="password" class="profile-input" placeholder="Leave blank to keep your current password" autocomplete="new-password">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="profile-input" placeholder="Confirm your new password" autocomplete="new-password">
                        </div>
                    @endif
                </div>

                <div class="btn-submit-wrapper" style="margin-top: 30px;">
                    <button type="submit" class="profile-btn"><i class="fa-solid fa-check"></i> Save Changes</button>
                </div>
            </form>

        </div>

    </div>
</div>

<script>
    // Avatar preview and file pick triggers
    function triggerAvatarUpload() {
        document.getElementById('avatarInput').click();
    }

    function previewAvatar(event) {
        const file = event.target.files[0];
        if (file) {
            // Check file size (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                if (window.showToast) {
                    window.showToast("Error! ❌", "Image size must be less than 2MB.");
                } else {
                    alert("Image size must be less than 2MB.");
                }
                event.target.value = "";
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                // Update sidebar avatar image
                let avatarEl = document.querySelector('.sidebar-avatar');
                if (avatarEl) {
                    avatarEl.src = e.target.result;
                } else {
                    // Replace placeholder with img tag
                    const placeholder = document.querySelector('.sidebar-avatar-placeholder');
                    if (placeholder) {
                        const newImg = document.createElement('img');
                        newImg.src = e.target.result;
                        newImg.className = 'sidebar-avatar';
                        placeholder.parentNode.replaceChild(newImg, placeholder);
                    }
                }
                
                // Immediately submit the form to update avatar in database
                document.getElementById('profileUpdateForm').submit();
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
