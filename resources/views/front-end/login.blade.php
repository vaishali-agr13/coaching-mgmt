@extends('front-end.layouts.app')

@section('content')

<style>
/* --- 1. Global Layout & Header Overwrite Fixes --- */
/* Ye hissa aapki image_17b35b.jpg ke header alignment ko fix karega */
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

/* Nav links ko ek line me lane ke liye */
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
    white-space: nowrap !important; /* Text break nahi hoga */
    text-decoration: none;
    font-size: 14px;
    color: #555;
    font-weight: 500;
}

/* Sign In button ko bada stretch hone se rokne ke liye */
.nav-auth a, .auth-btn, header .btn {
    white-space: nowrap !important;
    display: inline-block !important;
    width: auto !important;
    padding: 8px 24px !important;
    border-radius: 30px !important;
    background: linear-gradient(135deg,#DF528A 0%,#8834E3 100%) !important;
    color: #fff !important;
}


/* --- 2. Auth Card & Body Styles --- */
.auth-body{
    padding:30px 45px;   
    background:#fff;
}

.form-group{
    margin-bottom:18px;  
}

.auth-section{
    min-height:85vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:60px 20px;
    background: #fcfaff; /* Soft premium background */
}

.auth-card{
    width:100%;
    max-width:580px;   
    margin:auto;
    border:none;
    border-radius:26px;
    overflow:hidden;
    background:#fff;
    box-shadow:0 18px 45px rgba(0,0,0,.12);
}

.auth-header{
    background:linear-gradient(135deg,#DF528A 0%,#8834E3 100%);
    padding:32px 35px;   
    text-align:center;
    color:#fff;
}

.auth-header h2{
    font-size:36px;
    margin-bottom:8px;
    font-weight: 600;
}

.auth-header p{
    margin:0;
    font-size:16px;
    color:rgba(255,255,255,.9);
}

.form-group label{
    display:block;
    font-size:14px;
    font-weight:600;
    color:#444;
    margin-bottom:10px;
}

/* Exact Input Colors and Styles from your reference image */
.form-control{
    width:100%;
    height:52px;
    border:1px solid #e7dff5;
    border-radius:16px;
    padding:0 18px;
    font-size:15px;
    background:#faf7ff;
    transition:all .3s ease;
}

.form-control::placeholder{
    color:#b0b0b0;
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

.btn-theme{
    width:100%;
    height:52px;
    border:none;
    border-radius:50px;
    background:linear-gradient(135deg,#DF528A 0%,#8834E3 100%);
    color:#fff;
    font-size:16px;
    font-weight:600;
    transition:.3s;
    cursor: pointer;
}

.btn-theme:hover{
    transform:translateY(-2px);
    box-shadow: 0 5px 15px rgba(136,52,227,.3);
}

.auth-link{
    text-align:center;
    margin-top:25px;
    font-size: 14px;
    color: #666;
}

.auth-link a {
    color: #8834E3;
    text-decoration: none;
    font-weight: 600;
}
.auth-link a:hover {
    text-decoration: underline;
}
</style>

<section class="auth-section">
    <div class="card auth-card">
        <div class="auth-header">
            <h2>Welcome Back</h2>
            <p>Sign in to continue learning</p>
        </div>

        <div class="auth-body">
            <form action="" method="POST">
                @csrf

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                </div>

                <button type="submit" class="btn btn-theme">
                    Sign In
                </button>

                <div class="auth-link">
                    Don't have a profile ? <a href="/register">Create Profile</a>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection