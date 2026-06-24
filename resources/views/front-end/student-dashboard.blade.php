@extends('front-end.layouts.app')
@section('content')

    <main class="dashboard-container">
        
        <aside class="sidebar">
            <div class="sidebar-user">
                <div class="avatar-placeholder">V</div>
                <h3>Welcome Back</h3>
                <p>student@bhtc.com</p>
            </div>
            <ul class="sidebar-menu">
                <li class="active"><a href="#"><i class="fa-solid fa-user"></i> Edit Profile</a></li>
                <li><a href="#"><i class="fa-solid fa-book"></i> My Courses</a></li>
                <li><a href="#"><i class="fa-solid fa-graduation-cap"></i> Academic Results</a></li>
                <li><a href="#"><i class="fa-solid fa-receipt"></i> Fees Status</a></li>
                <li><a href="#"><i class="fa-solid fa-gear"></i> Settings</a></li>
            </ul>
        </aside>

        <section class="content-area">
            <div class="profile-card">
                <div class="card-header">
                    <h2>Edit Your Profile</h2>
                    <p>Keep your information updated to continue learning smooth</p>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('student.profile.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="avatar-upload-section">
                            <div class="current-avatar">V</div>
                            <div class="upload-actions">
                                <label for="profile_pix" class="upload-label">Change Photo</label>
                                <input type="file" id="profile_pix" style="display: none;">
                                <p class="upload-info">JPG or PNG. Max size 2MB</p>
                            </div>
                        </div>

                        <div class="form-grid">
                             <div class="form-group">
                                <label for="fullname">Full Name</label>
                                <input type="text" id="fullname" name="name" value="{{ old('name', $user->name) }}" placeholder="Enter your full name">
                            </div>

                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Enter email address">
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="phone" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Enter phone number">
                            </div>

                            <div class="form-group">
                                <label for="date_of_birth">Date of Birth</label>
                                <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value="{{ old('date_of_birth',$user->student?->date_of_birth) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="gender">Select Gender</label>
                                <select name="gender" id="gender" class="form-control" required>
                                    <option value="">Choose Gender</option>
                                    
                                    <option value="male" {{ old('gender', $user->student?->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender', $user->student?->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('gender', $user->student?->gender) == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="address"> Address</label>
                                <textarea id="address" name="address" rows="3" placeholder="Enter your complete address">{{ old('address', $user->student?->address) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="city">city</label>
                                <input type="text" name="city" id="city" value="{{ old('city', $user->student?->city) }}" >
                            </div>

                            <div class="form-group">
                                <label for="state">state</label>
                                <input type="text" id="state" name="state" value="{{ old('state', $user->student?->state) }}" >
                            </div>

                            <div class="form-group">
                                <label for="postal_code">postal_code</label>
                                <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code', $user->student?->postal_code) }}" >
                            </div>

                            <div class="form-group">
                                <label>Select Parent</label>
                                <select name="parent_id" class="form-control" required>
                                    <option value="">Choose Option</option>
                                    @foreach($parents as $parent)
                                        <option value="{{ $parent->id }}" {{ old('parent_id', $user->student?->parent_id) == $parent->id ? 'selected' : '' }}>
                                            {{ $parent->father_name }} (ID: {{ $parent->id }})
                                        </option>
                                    @endforeach                                    
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="password">New Password (Leave blank to keep current)</label>
                                <input type="password" name="password" id="password" placeholder="••••••" autocomplete="new-password">
                            </div>

                            <div class="form-group">
                                <label for="confirm-password">Confirm New Password</label>
                                <input type="password" name="confirm-password"  id="confirm-password" placeholder="••••••" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="save-btn">Save Changes</button>
                        </div>

                    </form>
                </div>
            </div>
        </section>

    </main>

@endsection

<style>
    /* Universal Styles & Color Palette matching your exact Image Theme */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

:root {
    --primary-gradient: linear-gradient(135deg, #d64786 0%, #a83279 30%, #8222a7 100%);
    --button-gradient: linear-gradient(90deg, #d64786 0%, #8222a7 100%);
    --bg-light: #f7f9fc;
    --text-dark: #333333;
    --text-muted: #666666;
    --input-bg: #ebf1fa;
    --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
}

body {
    background-color: var(--bg-light);
    color: var(--text-dark);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

/* --- Navbar Styling --- */
.navbar {
    background-color: #ffffff;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    position: sticky;
    top: 0;
    z-index: 1000;
}

.nav-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    display: flex;
    align-items: center;
    gap: 8px;
}

.logo-icon {
    font-size: 24px;
    color: #d64786;
}

.logo-text {
    font-size: 22px;
    font-weight: 700;
    color: #333;
    letter-spacing: 0.5px;
}

.nav-links {
    display: flex;
    gap: 20px;
}

.nav-links a {
    text-decoration: none;
    color: var(--text-muted);
    font-size: 14px;
    font-weight: 500;
    transition: color 0.3s ease;
}

.nav-links a:hover {
    color: #d64786;
}

.logout-btn {
    background: var(--button-gradient);
    color: white;
    border: none;
    padding: 8px 22px;
    border-radius: 20px;
    font-weight: 600;
    cursor: pointer;
    font-size: 14px;
    transition: opacity 0.3s;
}

.logout-btn:hover {
    opacity: 0.9;
}

/* --- Dashboard Layout --- */
.dashboard-container {
    display: flex;
    flex: 1;
    max-width: 1400px;
    width: 100%;
    margin: 30px auto;
    padding: 0 20px;
    gap: 30px;
}

/* --- Sidebar Styling --- */
.sidebar {
    width: 280px;
    background: white;
    border-radius: 20px;
    padding: 30px 20px;
    box-shadow: var(--card-shadow);
    height: fit-content;
}

.sidebar-user {
    text-align: center;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 1px solid #eee;
}

.avatar-placeholder {
    width: 80px;
    height: 80px;
    background: var(--primary-gradient);
    color: white;
    font-size: 32px;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    margin: 0 auto 15px;
    box-shadow: 0 4px 15px rgba(214, 71, 134, 0.3);
}

.sidebar-user h3 {
    font-size: 18px;
    color: var(--text-dark);
    margin-bottom: 5px;
}

.sidebar-user p {
    font-size: 13px;
    color: var(--text-muted);
}

.sidebar-menu {
    list-style: none;
}

.sidebar-menu li {
    margin-bottom: 10px;
}

.sidebar-menu li a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 15px;
    text-decoration: none;
    color: var(--text-muted);
    font-weight: 500;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.sidebar-menu li a i {
    width: 20px;
    font-size: 16px;
}

.sidebar-menu li.active a, 
.sidebar-menu li a:hover {
    background: #fdf2f7;
    color: #a83279;
}

/* --- Main Content & Profile Form Styling --- */
.content-area {
    flex: 1;
}

.profile-card {
    background: white;
    border-radius: 25px;
    overflow: hidden;
    box-shadow: var(--card-shadow);
}

/* Gradient Header Matching Image */
.card-header {
    background: var(--primary-gradient);
    padding: 35px 40px;
    color: white;
}

.card-header h2 {
    font-size: 26px;
    font-weight: 600;
    margin-bottom: 8px;
}

.card-header p {
    font-size: 14px;
    opacity: 0.85;
}

/* Card Body & Fields */
.card-body {
    padding: 40px;
}

.avatar-upload-section {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 35px;
    background-color: #fafafa;
    padding: 15px;
    border-radius: 15px;
}

.current-avatar {
    width: 65px;
    height: 65px;
    background: #ddd;
    color: #555;
    font-size: 24px;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}

.upload-label {
    background: #ffffff;
    border: 1px solid #d64786;
    color: #d64786;
    padding: 6px 15px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
}

.upload-label:hover {
    background: #d64786;
    color: white;
}

.upload-info {
    font-size: 12px;
    color: var(--text-muted);
    margin-top: 5px;
}

/* Form Layout Grid */
.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 25px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.form-group.full-width {
    grid-column: span 2;
}

.form-group label {
    font-size: 14px;
    font-weight: 600;
    color: var(--text-dark);
}

/* Light Blue Inputs matching sign-in container inputs */
.form-group input, 
.form-group textarea {
    background-color: var(--input-bg);
    border: 1px solid transparent;
    padding: 14px 18px;
    border-radius: 10px;
    font-size: 14px;
    color: #333;
    outline: none;
    transition: all 0.3s;
}

.form-group input:focus, 
.form-group textarea:focus {
    border-color: #a83279;
    background-color: #ffffff;
    box-shadow: 0 0 8px rgba(168, 50, 121, 0.15);
}

.form-group .readonly-input {
    background-color: #e2e8f0;
    color: #718096;
    cursor: not-allowed;
}

/* Form Action Button styling matches sign-in button */
.form-actions {
    margin-top: 35px;
    display: flex;
    justify-content: flex-end;
}

.save-btn {
    background: var(--button-gradient);
    color: white;
    border: none;
    padding: 14px 45px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 25px;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(168, 50, 121, 0.3);
    transition: transform 0.2s, opacity 0.3s;
}

.save-btn:hover {
    transform: translateY(-2px);
    opacity: 0.95;
}

/* Responsive UI Adjustment for Smaller Screens */
@media (max-width: 992px) {
    .dashboard-container {
        flex-direction: column;
    }
    .sidebar {
        width: 100%;
    }
    .form-grid {
        grid-template-columns: 1fr;
    }
    .form-group.full-width {
        grid-column: span 1;
    }
    .nav-links {
        display: none; /* Can be handled via burger menu toggle later */
    }
}
    </style>