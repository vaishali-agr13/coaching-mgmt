@extends('front-end.layouts.app')

@section('content')

<style>
/* --- 1. Global Layout & Header Overwrite Fixes --- */
/* Ye code aapke global header ko row alignment me fix rakhega */
header, .navbar, .nav-container {
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    flex-wrap: nowrap !important;
    max-width: 1200px;
    margin: 0 auto;
    padding: 10px 20px;
    background: #fff;
}

/* Nav links ko ek line me lock karne ke liye */
.nav-links, header ul, .navbar-nav {
    display: flex !important;
    flex-direction: row !important;
    gap: 20px !important;
    list-style: none;
    margin: 0;
    padding: 0;
    align-items: center;
}

.nav-links a, header ul li a {
    white-space: nowrap !important;
    text-decoration: none;
    font-size: 14px;
    color: #555;
    font-weight: 500;
}

/* Header ke login button ko stretch hone se rokne ke liye */
.nav-auth a, .auth-btn, header .btn {
    white-space: nowrap !important;
    display: inline-block !important;
    width: auto !important;
    padding: 8px 24px !important;
    border-radius: 30px !important;
    background: linear-gradient(135deg,#DF528A 0%,#8834E3 100%) !important;
    color: #fff !important;
}


/* --- 2. Registration Card & Form UI Styles --- */
:root{
    --brand-pink:#DF528A;
    --brand-purple:#8834E3;
    --gradient:linear-gradient(135deg,#DF528A 0%,#8834E3 100%);
}

.auth-section{
    min-height:85vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:60px 20px;
    background: #fcfaff; /* Premium soft background */
}

.auth-card{
    width:100%;
    max-width:580px; /* Card size standard tracking */
    border:none;
    border-radius:25px;
    overflow:hidden;
    box-shadow:0 15px 40px rgba(0,0,0,.12);
    background:#fff;
}

.auth-header{
    background:var(--gradient);
    padding:40px;
    text-align:center;
    color:#fff;
}

.auth-header h2 {
    font-size: 36px;
    margin-bottom: 8px;
    font-weight: 600;
}

.auth-header p {
    margin: 0;
    font-size: 16px;
    color: rgba(255,255,255,.9);
}

.auth-body{
    padding:40px;
    background:#fff;
}

/* Margin add kiya taaki fields ek dusre se chipke na */
.form-group{
    margin-bottom: 18px;
}

.form-group label{
    display:block;
    font-size:14px;
    font-weight:600;
    color:#444;
    margin-bottom:8px;
}

/* Theme input box styles matching your login design */
.form-control{
    width: 100%;
    height:52px;
    border:1px solid #e7dff5;
    border-radius:16px;
    padding:0 18px;
    font-size:15px;
    background:#faf7ff;
    transition:all .3s ease;
}

.form-control:hover{
    border-color:#d38af0;
}

.form-control:focus{
    outline:none !important;
    border:2px solid #8834E3;
    background:#fff;
    box-shadow:0 0 0 5px rgba(136,52,227,.12) !important;
}

/* Dropdown/Select field specific styling */
select.form-control {
    appearance: none;
    -webkit-appearance: none;
    background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='10' height='6' viewBox='0 0 10 6'><path fill='%238834E3' d='M0 0l5 5 5-5z'/></svg>");
    background-repeat: no-repeat;
    background-position: right 18px center;
    cursor: pointer;
}

.btn-theme{
    width:100%;
    height:52px;
    border:none;
    border-radius:50px;
    background:var(--gradient);
    color:#fff;
    font-size: 16px;
    font-weight:600;
    transition: .3s;
    cursor: pointer;
    margin-top: 10px;
}

.btn-theme:hover{
    transform: translateY(-2px);
    color:#fff;
    box-shadow: 0 5px 15px rgba(136,52,227,.3);
}

.auth-link{
    text-align:center;
    margin-top:25px;
    font-size: 14px;
    color: #666;
}

.auth-link a{
    text-decoration:none;
    font-weight:600;
    color:#DF528A;
}

.auth-link a:hover {
    text-decoration: underline;
}
</style>

<section class="auth-section">
    <div class="card auth-card">
        <div class="auth-header">
            <h2>Create Profile</h2>
            <p>Start your learning journey</p>
        </div>

        <div class="auth-body">
            <form action="/register" method="POST">
                @csrf

                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email address" required>
                </div>

                <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="text" name="phone" class="form-control" placeholder="Enter mobile number">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Create password" required>
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password" required>
                </div>

                <div class="form-group">
                    <label>Select Role</label>
                    <select name="role" class="form-control" required>
                        <option value="">Choose Role</option>
                        <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                        <option value="parent" {{ old('role') == 'parent' ? 'selected' : '' }}>Parent</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-theme">
                    Create Profile
                </button>

                <div class="auth-link">
                    Already have an account ? <a href="/sign-in">Sign In</a>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection