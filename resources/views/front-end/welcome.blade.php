@extends('front-end.layouts.app')

@section('content')

 <section class="container hero">
        <div class="grid-2">
            <!-- <div class="hero-left">
                <h1>Unlock your <br><span class="gradient-text">Potential with us</span> <br>– Explore, Learn, <br> and Grow!</h1>
                <p>Welcome to Best Home Tutor Coaching, where your journey to knowledge begins! Range of courses, curated by experts, to help you achieve your personal.</p>
                <div class="cta-group">
                    <a href="#admission-form" class="btn-primary">Buy Course</a>
                    <a href="#" class="btn-secondary">Contact Us</a>
                </div>
            </div> -->

            <div class="hero-left">
                <div class="top-tagline">
                    <i class="fa-solid fa-graduation-cap"></i> BEST HOME TUTOR COACHING
                </div>
                
                <h1>Unlock Your <br><span class="gradient-text">Potential with Us</span></h1>
                
                <div class="sub-features">
                    <span class="line">—</span> 
                    <span class="feat-text">Explore</span> <span class="dot">•</span> 
                    <span class="feat-text">Learn</span> <span class="dot">•</span> 
                    <span class="feat-text">Grow</span> 
                    <span class="line">—</span>
                </div>

                <p>Welcome to Best Home Tutor Coaching, where your journey to knowledge begins! Our range of courses, curated by experts, to help you achieve your personal and academic goals.</p>
                
                <div class="features-icon-grid">
                    <div class="feat-icon-box">
                        <div class="icon-circle icon-pink"><i class="fa-solid fa-book-open"></i></div>
                        <p>Expert<br>Guidance</p>
                    </div>
                    <div class="feat-icon-box">
                        <div class="icon-circle icon-purple"><i class="fa-solid fa-chalkboard-user"></i></div>
                        <p>Quality<br>Education</p>
                    </div>
                    <div class="feat-icon-box">
                        <div class="icon-circle icon-dark-pink"><i class="fa-solid fa-bullseye"></i></div>
                        <p>Personalized<br>Learning</p>
                    </div>
                    <div class="feat-icon-box">
                        <div class="icon-circle icon-blue"><i class="fa-solid fa-chart-line"></i></div>
                        <p>Proven<br>Results</p>
                    </div>
                </div>

                <div class="cta-group">
                    <a href="#admission-form" class="btn-primary">Buy Course</a>
                    <a href="#" class="btn-secondary">Contact Us</a>
                </div>

                <div class="bottom-tagline">
                    <span class="star-icon"><i class="fa-solid fa-star"></i></span> 
                    <strong>Learn</strong> Better. <span class="purple-text">Achieve</span> More. <span class="pink-text">Grow</span> Forever.
                </div>
            </div>

            <div class="graphic-wrapper">
                <div class="dashed-circle"></div>
                <div class="avatar-circle">
                   <img src="{{ asset('/images/profile.png') }}"/> 
                   <i class="fa-solid fa-user-graduate"></i></div>
                <div class="badge badge-1">
                    <div class="badge-icon-purple"><i class="fa-solid fa-users"></i></div>
                    <div class="badge-text"><p>1000+</p><p>Students</p></div>
                </div>
                <div class="badge badge-2">
                    <div class="badge-icon-pink"><i class="fa-solid fa-briefcase"></i></div>
                    <div class="badge-text"><p>20+</p><p>Teachers</p></div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-section">
        <div class="about-container">
            
            <div class="about-left-col">
            <div class="image-grid-wrapper">
                
                <div class="exp-badge-box">
                <div class="exp-number">25</div>
                <div class="exp-text">Years Of<br>Experience</div>
                </div>
                
                <div class="main-building-img">
                <img src="{{ asset('/images/coaching-banner.png') }}" alt="BestHomeTutorCoaching Building">
                </div>
                
                <div class="group-photo-img">
                <img src="{{ asset('/images/student_group.jpg') }}" alt="Students Group">
                </div>
                
            </div>
            </div>
            
            <div class="about-right-col">
            
            <div class="welcome-badge">
                <span class="lightning-flash">⚡</span> Welcome to
            </div>
            
            <h2 class="main-heading">Best Home Tutor Coaching<span class="title-dot">.</span></h2>
            
            <p class="content-para text-highlight">
                Established in 1992, <strong>Best Home Tutor Coaching</strong>, Institute has emerged as a beacon of excellence in the field of medical entrance preparation. With a clear vision to nurture talent and ignite academic brilliance, we have been consistently delivering superb results in <strong>NEET (National Eligibility cum Entrance Test)</strong> year after year.
            </p>
            
            <p class="content-para">
                At <strong>Best Home Tutor Coaching</strong>, we believe that success is no miracle—it's the result of hard work, dedication, and the right guidance. Our expert faculty members bring years of experience, deep subject knowledge, and a passion for teaching that transforms students into confident achievers.
            </p>
            
            <div class="features-row">
                <div class="feature-item">
                <span class="tick-icon">✓</span>
                <span class="feature-text">SMART STUDY PLANS</span>
                </div>
                <div class="feature-item">
                <span class="tick-icon">✓</span>
                <span class="feature-text">EXPERIENCED FACULTY</span>
                </div>
            </div>
            
            <div class="btn-container">
                <a href="/about-us" class="read-more-btn">Read More</a>
            </div>
            
            </div>
            
        </div>
    </section>

    <section class="partners">
        <div class="container partner-flex">
            <span><i class="fa-solid fa-atom"></i> Physics</span>
            <span><i class="fa-solid fa-flask"></i> Chemistry</span>
            <span><i class="fa-solid fa-calculator"></i> Maths</span>
            <span><i class="fa-solid fa-dna"></i> Biology</span>
        </div>
    </section>

    <section class="container stats-counter-section">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-book-bookmark"></i></div>
                <h3>{{$activeCoursesCount}}</h3>
                <p>Trending Live Courses</p>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-chalkboard-user"></i></div>
                <h3>{{$facultyCount}}</h3>
                <p>Expert Industry Mentors</p>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-user-check"></i></div>
                <h3>{{$activeEnrolledStudents}}+</h3>
                <p>Active Students Enrolled</p>
            </div>
        </div>
    </section>

    <section class="container search-section">
        <h2>Search Courses</h2>
        <div class="search-bar">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Search the Courses...">
            <button class="btn-search">Search</button>
        </div>
    </section>

    <div class="announcement-wrapper">
        <div class="container">
            <div class="ticker-container">
                <div class="ticker-title">
                    <i class="fa-solid fa-bullhorn animate-bell"></i> Latest Updates
                </div>
                
                <div class="ticker-content-window">
                    <div class="ticker-track">

                    @foreach($latestUpdates as $latestUpdate)
                    
                        <div class="ticker-item">
                            <span class="badge-new">NEW </span>
                            <span class="date-tag">[{{ \Carbon\Carbon::parse($latestUpdate['date'])->format('d F') }}]:</span> 
                            {{ $latestUpdate['title'] }}
                            <i class="fa-solid fa-circle-chevron-right"></i>
                        </div>
                    @endforeach
                        <!-- <div class="ticker-item">
                            <span class="date-tag">[24-June]:</span> 
                            Python Django Live Project Submission Deadline. 
                            <i class="fa-solid fa-circle-chevron-right"></i>
                        </div>
                        <div class="ticker-item">
                            <i class="fa-solid fa-award"></i>
                            Scholarship Exam Results for Phase-1 are live now in student portal! 
                            <i class="fa-solid fa-circle-chevron-right"></i>
                        </div>
                        
                        <div class="ticker-item">
                            <span class="badge-new">NEW</span>
                            <span class="date-tag">[20-June]:</span> 
                            Java Full Stack Monthly Mock Test is scheduled at 10:00 AM. 
                            <i class="fa-solid fa-circle-chevron-right"></i>
                        </div>
                        <div class="ticker-item">
                            <span class="date-tag">[24-June]:</span> 
                            Python Django Live Project Submission Deadline. 
                            <i class="fa-solid fa-circle-chevron-right"></i>
                        </div>
                        <div class="ticker-item">
                            <i class="fa-solid fa-award"></i>
                            Scholarship Exam Results for Phase-1 are live now in student portal! 
                            <i class="fa-solid fa-circle-chevron-right"></i>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

        <section class="features-section">
            <div class="features-header">
                <span class="badge-title"><i class="fa-solid fa-graduation-cap"></i> WHY CHOOSE US</span>
                <h2>Gain for our <span class="gradient-text">Online Learning</span></h2>
                <div class="header-dots">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

            <div class="features-grid">
                
                <div class="images-column">
                    <div class="image-card">
                        <img src="{{ asset('/images/faculty.png') }}" alt="Expert Faculty">
                        <div class="card-overlay overlay-purple">
                            <div class="overlay-icon"><i class="fa-solid fa-user"></i></div>
                            <div class="overlay-text">
                                <h4>Expert Faculty</h4>
                                <p>Experienced teachers dedicated to personalized guidance and student success.</p>
                            </div>
                        </div>
                    </div>

                    <div class="image-card">
                        <img src="{{ asset('/images/certificate.png') }}" alt="Certification">
                        <div class="card-overlay overlay-pink">
                            <div class="overlay-icon"><i class="fa-solid fa-award"></i></div>
                            <div class="overlay-text">
                                <h4>Certification</h4>
                                <p>Earn valid certificates and rewards on successful course completion.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-column">
                    <div class="right-list-item">
                        <div class="list-icon icon-purple"><i class="fa-solid fa-user-graduate"></i></div>
                        <div class="list-text">
                            <h4>Expert Faculty</h4>
                            <p>Learn from experienced teachers who provide personalized guidance and help students build strong academic foundations.</p>
                        </div>
                    </div>

                    <div class="right-list-item">
                        <div class="list-icon icon-pink"><i class="fa-solid fa-ribbon"></i></div>
                        <div class="list-text">
                            <h4>Certification</h4>
                            <p>Valid certificates and rewards are provided to recognize your achievements and encourage continuous learning.</p>
                        </div>
                    </div>

                    <div class="sub-features-grid">
                        <div class="sub-item">
                            <div class="sub-icon"><i class="fa-solid fa-book-open"></i></div>
                            <h5>Quality Content</h5>
                            <p>Well-structured and easy to understand study material.</p>
                        </div>
                        <div class="sub-item">
                            <div class="sub-icon"><i class="fa-solid fa-desktop"></i></div>
                            <h5>Flexible Learning</h5>
                            <p>Learn anytime, anywhere at your own pace.</p>
                        </div>
                        <div class="sub-item">
                            <div class="sub-icon"><i class="fa-solid fa-bullseye"></i></div>
                            <h5>Better Results</h5>
                            <p>Focused learning that helps you achieve your goals.</p>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    <section class="popular-courses">
        <div class="container">
            <div class="courses-header">
                <h2>Our Popular Course</h2>
                <p>These topics provide a comprehensive framework to structure your book and appeal to both beginners and advanced readers.</p>
            </div>
            <div class="cards-grid">
                @foreach($courses as $course)
                    <div class="course-card">
                        <div class="card-img-placeholder java-color"><i class="fa-brands fa-java"></i></div>
                        <div class="card-info">
                            <span class="badge-tag tag-purple">{{$course->course_code}}</span>
                            <h4>{{$course->course_name}}</h4>
                            <p>Return the sorted string. If there are multiple answers, return any of them.</p>
                        </div>
                        <div class="card-footer">
                            <span class="price">₹{{$course->fee}}</span>
                            <a href="#" class="enroll-btn">Enroll Now &rarr;</a>
                        </div>
                    </div>
                <!-- <div class="course-card">
                    <div class="card-img-placeholder python-color"><i class="fa-brands fa-python"></i></div>
                    <div class="card-info">
                        <span class="badge-tag tag-pink">Python</span>
                        <h4>Full Stack Development</h4>
                        <p>Return the sorted string. If there are multiple answers, return any of them.</p>
                    </div>
                    <div class="card-footer">
                        <span class="price">₹0.00</span>
                        <a href="#" class="enroll-btn">Enroll Now &rarr;</a>
                    </div>
                </div>
                <div class="course-card">
                    <div class="card-img-placeholder html-color"><i class="fa-brands fa-html5"></i></div>
                    <div class="card-info">
                        <span class="badge-tag tag-orange">Html & Css</span>
                        <h4>Full Stack Development</h4>
                        <p>Return the sorted string. If there are multiple answers, return any of them.</p>
                    </div>
                    <div class="card-footer">
                        <span class="price">₹3,000.00</span>
                        <a href="#" class="enroll-btn">Enroll Now &rarr;</a>
                    </div>
                </div> -->
                @endforeach
            </div>
        </div>
    </section>

    <section class="container faculty-section">
        <div class="faculty-header">
            <h2>Meet Our <span class="gradient-text">Expert Faculty</span></h2>
            <p>Learn directly from industry professionals synced live from your dashboard admin panel.</p>
        </div>
        <div class="faculty-grid">
            @foreach($faculties as $faculty)

                <div class="faculty-card">
                    <div class="faculty-avatar-wrapper"><i class="fa-solid fa-user-tie"></i></div>
                    <h4>{{$faculty->user->name}}</h4>
                    <p class="designation">{{$faculty->department}}</p>
                    <span class="experience">{{$faculty->experience_years}}+ Yrs Exp</span>
                </div>
                <!-- <div class="faculty-card">
                    <div class="faculty-avatar-wrapper"><i class="fa-solid fa-user-ninja"></i></div>
                    <h4>Er. Neha Verma</h4>
                    <p class="designation">Senior Data Analyst</p>
                    <span class="experience">6+ Yrs Exp</span>
                </div>
                <div class="faculty-card">
                    <div class="faculty-avatar-wrapper"><i class="fa-solid fa-user-doctor"></i></div>
                    <h4>Prof. Rajesh Kumar</h4>
                    <p class="designation">Full Stack Developer</p>
                    <span class="experience">8+ Yrs Exp</span>
                </div> -->
            @endforeach

        </div>
    </section>

    <section class="edu-features-section">
        <div class="container">
            
            <div class="edu-features-header">
                <span class="edu-badge"><i class="fas fa-bolt"></i> BestHomeTutorCoaching</span>
                <h2>What Makes <span class="gradient-text">Best Home Tutor Coaching Diffrent ?</span></h2>
            </div>

            <div class="edu-features-grid">
                
                <div class="edu-feature-card">
                    <div class="edu-icon-box">
                        <img src="https://cdn-icons-png.flaticon.com/512/3512/3512410.png" alt="Testing icon">
                    </div>
                    <div class="edu-feature-content">
                        <span class="edu-feature-number">Features 01</span>
                        <h3>Regular Testing & Feedback</h3>
                    </div>
                </div>

                <div class="edu-feature-card">
                    <div class="edu-icon-box">
                        <img src="https://cdn-icons-png.flaticon.com/512/3048/3048122.png" alt="Attention icon">
                    </div>
                    <div class="edu-feature-content">
                        <span class="edu-feature-number">Features 02</span>
                        <h3>Individual Attention</h3>
                    </div>
                </div>

                <div class="edu-feature-card">
                    <div class="edu-icon-box">
                        <img src="https://cdn-icons-png.flaticon.com/512/2436/2436636.png" alt="Neet icon">
                    </div>
                    <div class="edu-feature-content">
                        <span class="edu-feature-number">Features 03</span>
                        <h3>We Know Neet Inside-Out</h3>
                    </div>
                </div>

                <div class="edu-feature-card">
                    <div class="edu-icon-box">
                        <img src="https://cdn-icons-png.flaticon.com/512/2232/2232688.png" alt="Material icon">
                    </div>
                    <div class="edu-feature-content">
                        <span class="edu-feature-number">Features 04</span>
                        <h3>Smart Study Material</h3>
                    </div>
                </div>

                <div class="edu-feature-card">
                    <div class="edu-icon-box">
                        <img src="https://cdn-icons-png.flaticon.com/512/9357/9357284.png" alt="Focus icon">
                    </div>
                    <div class="edu-feature-content">
                        <span class="edu-feature-number">Features 05</span>
                        <h3>We Focus On You</h3>
                    </div>
                </div>

                <div class="edu-feature-card">
                    <div class="edu-icon-box">
                        <img src="https://cdn-icons-png.flaticon.com/512/2413/2413115.png" alt="Fees icon">
                    </div>
                    <div class="edu-feature-content">
                        <span class="edu-feature-number">Features 06</span>
                        <h3>Affordable Fees</h3>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="testimonials-section">
        <div class="container">
            
            <div class="section-badge">
            <span class="lightning-icon">⚡</span> Our Feedbacks
            </div>
            
            <h2 class="section-title">What Our Student's Says</h2>
            
            <div class="testimonials-grid">
            
                <div class="testimonial-card">
                    <div class="quote-icon">,,</div>
                    <p class="testimonial-text">
                    "What makes this coaching unique is its strong focus on fundamentals. Instead of memorization, teachers emphasize understanding and application. Physics problem-solving skills improve drastically, Chemistry becomes systematic, and Biology revision is very effective. Regular performance tracking and feedback sessions help students identify weaknesses early. Overall, a highly supportive and result-driven institute."
                    </p>
                    <div class="student-info">
                    <h4 class="student-name">Vaibhav Patidar</h4>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <div class="quote-icon">,,</div>
                    <p class="testimonial-text">
                    "They made NEET feel like a game I could actually win. Daily targets, doubts cleared on WhatsApp at night—Best Home Tutor Coaching isn't just a class, it's a family."
                    </p>
                    <div class="student-info">
                    <h4 class="student-name">SUMIT PANWAR, NEET 2024</h4>
                    <span class="student-marks">670 Marks</span>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="quote-icon">,,</div>
                    <p class="testimonial-text">
                    "What makes this coaching unique is its strong focus on fundamentals. Instead of memorization, teachers emphasize understanding and application. Physics problem-solving skills improve drastically, Chemistry becomes systematic, and Biology revision is very effective. Regular performance tracking and feedback sessions help students identify weaknesses early. Overall, a highly supportive and result-driven institute."
                    </p>
                    <div class="student-info">
                    <h4 class="student-name">Vaibhav Patidar</h4>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <div class="quote-icon">,,</div>
                    <p class="testimonial-text">
                    "They made NEET feel like a game I could actually win. Daily targets, doubts cleared on WhatsApp at night—Best Home Tutor Coaching isn't just a class, it's a family."
                    </p>
                    <div class="student-info">
                    <h4 class="student-name">SUMIT PANWAR, NEET 2024</h4>
                    <span class="student-marks">670 Marks</span>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="quote-icon">,,</div>
                    <p class="testimonial-text">
                    "They made NEET feel like a game I could actually win. Daily targets, doubts cleared on WhatsApp at night—Best Home Tutor Coaching isn't just a class, it's a family."
                    </p>
                    <div class="student-info">
                    <h4 class="student-name">SUMIT PANWAR, NEET 2024</h4>
                    <span class="student-marks">670 Marks</span>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="quote-icon">,,</div>
                    <p class="testimonial-text">
                    "They made NEET feel like a game I could actually win. Daily targets, doubts cleared on WhatsApp at night—Best Home Tutor Coaching isn't just a class, it's a family."
                    </p>
                    <div class="student-info">
                    <h4 class="student-name">SUMIT PANWAR, NEET 2024</h4>
                    <span class="student-marks">670 Marks</span>
                    </div>
                </div>
            
            </div>
            
        </div>
    </section>

    <section id="admission-form" class="container admission-lead-section">
        <div class="form-container">
            <div class="form-info-side">
                <h3>Apply for Admission</h3>
                <p>Fill out this form to secure your seat. Your request will instantly project into our admin dashboard under Pending Admissions for verification.</p>
                <div class="bullet-feature"><i class="fa-solid fa-check"></i> Instant Admin Verification</div>
                <div class="bullet-feature"><i class="fa-solid fa-check"></i> Flexible Fee Structure Access</div>
                <div class="bullet-feature"><i class="fa-solid fa-check"></i> Direct Faculty Mentorship</div>
            </div>
            <div class="form-input-side">
                <form action="#" method="POST">
                    <div class="form-group">
                        <label for="student_name">Full Name</label>
                        <input type="text" id="student_name" name="name" placeholder="Enter full name" required>
                    </div>
                    <div class="form-group">
                        <label for="student_email">Email Address</label>
                        <input type="email" id="student_email" name="email" placeholder="Enter email address" required>
                    </div>
                    <div class="form-group">
                        <label for="course_select">Select Desired Course</label>
                        <select id="course_select" name="course" required>
                            <option value="">-- Choose Course --</option>
                            <option value="java">Java Full Stack Development</option>
                            <option value="python">Python Full Stack Development</option>
                            <option value="html">HTML & CSS Frameworks</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-submit-form">Submit Application</button>
                </form>
            </div>
        </div>
    </section>
@endsection