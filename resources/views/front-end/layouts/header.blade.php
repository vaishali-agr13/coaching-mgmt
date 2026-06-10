<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elite Coaching Institute</title>

    <link rel="stylesheet" href="{{ asset('frontend/css/welcome.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

<header class="header">
    <div class="container nav">
        <div class="logo">Edu<span>Elite</span></div>

        <ul class="menu">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#courses">Courses</a></li>
            <li><a href="#faculty">Faculty</a></li>
            <li><a href="#results">Results</a></li>
            <li><a href="#gallery">Gallery</a></li>
            <li><a href="#blog">Blog</a></li>
            <li><a href="#admission">Admission</a></li>
            <li><a href="#contact">Contact</a></li>

            <li>
                <a href="{{ route('student.login') }}" class="login-btn">
                    Student Login
                </a>
            </li>

            <li>
                <a href="{{ route('parent.login') }}" class="login-btn">
                    Parent Login
                </a>
            </li>
        </ul>
    </div>
</header>