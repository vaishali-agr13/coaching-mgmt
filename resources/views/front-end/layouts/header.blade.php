<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Best Home Tutor Coaching</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<link rel="stylesheet" href="{{ asset('css/welcome.css') }}">

</head>

<body>

<header>

<div class="container nav-container">

<div class="logo">
<span><i class="fa-solid fa-graduation-cap"></i></span>

<span>BHTC</span>


</div>

<nav>

<a href="/">Home Page</a>

<a href="/about-us">About Us</a>

<a href="/courses">Courses</a>

<a href="/faculty">Faculty</a>

<a href="/result">Results</a>
<a href="/gallery">Gallery</a>
<a href="/blogs">Blog</a>
<a href="/admission">Online Admission</a>
<a href="/contact-us">Contact Us</a>


</nav>

@if(Auth::check())
<div>
<form action="{{ route('logoutFrontEnd') }}" method="POST">

    @csrf

    <button type="submit" class="btn-signin">

        Logout

    </button>



</form>

@else

<a href="{{ route('sign-in') }}" class="btn btn-theme">

    Login

</a>
</div>
@endif

</div>

</header>