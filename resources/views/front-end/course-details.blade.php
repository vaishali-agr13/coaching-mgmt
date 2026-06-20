

@extends('front-end.layouts.app')
    <link rel="stylesheet" href="{{ asset('css/course-details.css') }}">

@section('content')

    <section class="hero-banner">
        <div class="container">
            <div class="breadcrumb">
                <a href="/">Home Page</a>
                <i class="fa-solid fa-angle-right"></i>
                <a href="/courses">Courses</a>
                <i class="fa-solid fa-angle-right"></i>
                <span class="active">{{$course->course_name}} Course</span>
            </div>
            
            <div class="tag-sub-title">About Best Home Tutor Coaching</div>
            <h1 class="hero-title">Shaping Futures Through Quality Education</h1>
            <p class="hero-desc">
                Dive deep into the core concepts of Physics with structured lectures, personalized home tutoring guidance, and comprehensive study material tailored for excellent results.
            </p>
        </div>
    </section>

    <main class="wrapper">
        <div class="container">
            <div class="layout-grid">
                
                <div class="main-content">
                    
                    <div class="card">
                        <h2 class="card-title">Course Overview</h2>
                        <p class="card-text">
                            Welcome to Best Home Tutor Coaching, where your journey to knowledge begins! Our range of courses, curated by experts, is designed to help you achieve your personal and academic goals. This specific course sets a rock-solid foundation for students aiming to excel in board examinations as well as competitive medical/engineering entrances.
                        </p>
                        
                        <div class="highlights-box">
                            <h4>Key Learning Benefits</h4>
                            <ul class="highlights-grid">
                                <li>
                                    <i class="fa-solid fa-check-circle"></i>
                                    <span>Expert Guidance from Top Mentors</span>
                                </li>
                                <li>
                                    <i class="fa-solid fa-check-circle"></i>
                                    <span>Quality Content & Easy Study Plans</span>
                                </li>
                                <li>
                                    <i class="fa-solid fa-check-circle"></i>
                                    <span>Personalized Learning Experience</span>
                                </li>
                                <li>
                                    <i class="fa-solid fa-check-circle"></i>
                                    <span>Proven High-Score Results</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                   <!-- CONCEPT 1: COURSE INCLUSIONS -->
                    <div class="card">
                        <h2 class="card-title">What's Included In This Course?</h2>
                        <p class="curriculum-subtitle" style="margin-bottom: 25px;">Everything a student needs to transition from basic learning to top academic ranks.</p>
                        
                        <div class="inclusions-grid">
                            <!-- Item 1 -->
                            <div class="inclusion-box">
                                <div class="inclusion-icon"><i class="fa-solid fa-laptop-file"></i></div>
                                <div class="inclusion-text">
                                    <h5>100+ Hours of Live Interactive Sessions</h5>
                                    <p>Comprehensive live classes covering deep concepts, real-world examples, and step-by-step numerical solving methods.</p>
                                </div>
                            </div>

                            <!-- Item 2 -->
                            <div class="inclusion-box">
                                <div class="inclusion-icon"><i class="fa-solid fa-book-open-reader"></i></div>
                                <div class="inclusion-text">
                                    <h5>Smart Study Material & Printed Notes</h5>
                                    <p>High-yield revision notes, formula cheat sheets, and practice sets designed by India's seasoned subject matter experts.</p>
                                </div>
                            </div>

                            <!-- Item 3 -->
                            <div class="inclusion-box">
                                <div class="inclusion-icon"><i class="fa-solid fa-square-poll-vertical"></i></div>
                                <div class="inclusion-text">
                                    <h5>Weekly Mock Tests & Report Cards</h5>
                                    <p>Computer-based testing environments mimicking actual competitive formats with comprehensive analytics of weak chapters.</p>
                                </div>
                            </div>

                            <!-- Item 4 -->
                            <div class="inclusion-box">
                                <div class="inclusion-icon"><i class="fa-solid fa-comments"></i></div>
                                <div class="inclusion-text">
                                    <h5>24/7 Dedicated Doubt Support</h5>
                                    <p>Never get stuck on a difficult question. Connect directly with specialized tutors via our dedicated one-on-one helpdesks.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @php
                        $name = $course->faculty->user->name ?? '';
                        $parts = explode(' ', trim($name));

                        $initials = strtoupper(
                            substr($parts[0] ?? '', 0, 1) .
                            substr(end($parts) ?: '', 0, 1)
                        );
                    @endphp



                    <div class="card">
                        <div class="faculty-flex">
                            <div class="faculty-profile">
                                <div class="faculty-img-placeholder">{{ $initials }}</div>
                                <div class="faculty-text">
                                    <h4>{{ $course->faculty->user->name ?? 'Not Assigned' }}</h4>
                                    <p>{{$course->course_name}} Expert • {{ $course->faculty->experience_years}}+ Years Experience</p>
                                </div>
                            </div>
                            <a href="/faculty" class="btn-secondary">View Profile</a>
                        </div>
                    </div>

                </div>

                <div class="sidebar-content">
                    <div class="sidebar-box">
                        <div class="sidebar-header-banner">
                            <i class="fa-solid fa-graduation-cap"></i>
                            <h3>Course Admission</h3>
                        </div>
                        
                        <div class="sidebar-body">
                            <div class="price-section">
                                <span class="price-title">Course Price:</span>
                                <div>
                                    <div class="price-val">₹ {{$course->fee}}</div>
                                    <div class="price-tax-info"><i class="fa-solid fa-shield"></i> Secure Admission</div>
                                </div>
                            </div>

                            <a href="/admission" class="btn-primary-action">
                                Online Admission <i class="fa-solid fa-arrow-right" style="margin-left: 6px; font-size: 13px;"></i>
                            </a>

                            <ul class="features-list">
                                <li>
                                    <span class="f-label"><i class="fa-regular fa-clock"></i> Duration</span>
                                    <span class="f-val">Full Session</span>
                                </li>
                                <li>
                                    <span class="f-label"><i class="fa-solid fa-chalkboard-user"></i> Type</span>
                                    <span class="f-val">Home & Online</span>
                                </li>
                                <li>
                                    <span class="f-label"><i class="fa-solid fa-book-open"></i> Materials</span>
                                    <span class="f-val">Included (PDF)</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

@endsection