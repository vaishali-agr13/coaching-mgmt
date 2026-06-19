@extends('front-end.layouts.app')

@section('content')

<!-- Hero -->

<section class="about-banner" style="background: linear-gradient(to right, #b066fe, #ff6fa2); padding: 60px 0; text-align: center;">
  <div class="container">
    <div class="about-heading">
      <span style="color: #ffffff; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 10px;">
        ABOUT Best Home Tutor Coaching
      </span>
      <h1 style="color: #ffffff; font-size: 3rem; margin-bottom: 20px; font-weight: bold;">
        Shaping Futures Through Quality Education
      </h1>
      <p style="color: #ffffff; font-size: 1.1rem; max-width: 800px; margin: 0 auto; line-height: 1.6; opacity: 0.9;">
        At Best Home Tutor Coaching, we are committed to empowering students with knowledge,
        skills, and confidence to excel in academics and build successful careers.
      </p>
    </div>
  </div>
</section>


<!-- About -->

<section class="about-section">

<div class="container">

<div class="about-grid">

<div class="about-image">

<img src="{{ asset('images/about-us.png') }}">

</div>

<div class="about-content">

<h2>

Who We Are

</h2>

<p>

Best Home Tutor Coaching is a modern coaching institute dedicated to helping students achieve academic excellence through innovative learning methods.

</p>

<p>

We provide expert faculty guidance, structured study plans, regular assessments, and career-focused learning experiences.

</p>

<div class="about-features">

<div>✓ Experienced Faculty</div>

<div>✓ Smart Learning</div>

<div>✓ Weekly Assessments</div>

<div>✓ Career Guidance</div>

<div>✓ Performance Tracking</div>

<div>✓ Doubt Sessions</div>

</div>

</div>

</div>

</div>

</section>


<!-- Why Choose Us -->

<section class="why-us">

<div class="container">

<div class="section-title">

<h2>Why Choose Best Home Tutor Coaching?</h2>

<p>

We create an environment where students can learn, grow and succeed.

</p>

</div>

<div class="why-grid">

<div class="why-card">

<h3>Expert Faculty</h3>

<p>

Learn from experienced mentors dedicated to student success.

</p>

</div>

<div class="why-card">

<h3>Practical Learning</h3>

<p>

Concept-based teaching with real-world examples.

</p>

</div>

<div class="why-card">

<h3>Regular Tests</h3>

<p>

Track progress through weekly and monthly evaluations.

</p>

</div>

<div class="why-card">

<h3>Student Support</h3>

<p>

Continuous guidance and doubt-solving sessions.

</p>

</div>

</div>

</div>

</section>


<!-- Stats -->

<section class="stats-section">

<div class="container">

<div class="stats-grid">

<div>

<h2>5000+</h2>

<p>Students</p>

</div>

<div>

<h2>20+</h2>

<p>Faculty</p>

</div>

<div>

<h2>20+</h2>

<p>Courses</p>

</div>

<div>

<h2>95%</h2>

<p>Success Rate</p>

</div>

</div>

</div>

</section>


<!-- CTA -->

<section class="cta-section">

<div class="container">

<h2>

Begin Your Journey With Best Home Tutor Coaching

</h2>

<p>

Join thousands of students building a brighter future.

</p>

<a href="{{ url('/courses') }}">

Explore Courses

</a>

</div>

</section>

@endsection
<style>

    .about-banner{

padding:100px 0 70px;

text-align:center;

}

.about-banner .container{

max-width:1200px;

margin:auto;

padding:0 30px;

}

.about-banner span{

font-size:14px;

font-weight:700;

color:#d84b93;

letter-spacing:2px;

}

.about-banner h1{

font-size:55px;

font-weight:800;

margin:20px 0;

color:#1d2434;

}

.about-banner p{

max-width:700px;

margin:auto;

font-size:18px;

line-height:1.8;

color:#666;

}


/* About */

.about-section{

padding:90px 0;

}

.about-grid{

display:grid;

grid-template-columns:1fr 1fr;

gap:70px;

align-items:center;

}

.about-image img{

width:100%;

border-radius:25px;

}

.about-content h2{

font-size:42px;

margin-bottom:25px;

color:#1d2434;

}

.about-content p{

line-height:1.9;

color:#666;

margin-bottom:20px;

}

.about-features{

display:grid;

grid-template-columns:repeat(2,1fr);

gap:15px;

margin-top:30px;

}

.about-features div{

background:#fff;

padding:15px;

border-radius:12px;

box-shadow:0 6px 18px rgba(0,0,0,.08);

}


/* Why Us */

.why-us{

background:#faf8ff;

padding:90px 0;

}

.section-title{

text-align:center;

margin-bottom:50px;

}

.section-title h2{

font-size:42px;

color:#1d2434;

}

.section-title p{

color:#666;

}

.why-grid{

display:grid;

grid-template-columns:repeat(4,1fr);

gap:25px;

}

.why-card{

background:#fff;

padding:35px;

border-radius:20px;

box-shadow:0 8px 20px rgba(0,0,0,.08);

}

.why-card h3{

margin-bottom:15px;

color:#7b2cff;

}


/* Stats */

.stats-section{

padding:90px 0;

}

.stats-grid{

background:linear-gradient(90deg,#ff4f8b,#7b2cff);

padding:40px;

border-radius:20px;

display:grid;

grid-template-columns:repeat(4,1fr);

text-align:center;

color:#fff;

}

.stats-grid h2{

font-size:45px;

margin-bottom:10px;

}


/* CTA */

.cta-section{

padding:100px 0;

text-align:center;

}

.cta-section h2{

font-size:48px;

margin-bottom:20px;

color:#1d2434;

}

.cta-section p{

color:#666;

margin-bottom:35px;

}

.cta-section a{

display:inline-block;

padding:15px 40px;

border-radius:50px;

text-decoration:none;

background:linear-gradient(90deg,#ff4f8b,#7b2cff);

color:#fff;

font-weight:600;

}


/* Responsive */

@media(max-width:992px){

.about-grid{

grid-template-columns:1fr;

}

.why-grid{

grid-template-columns:1fr 1fr;

}

.stats-grid{

grid-template-columns:1fr 1fr;

}

.about-banner h1{

font-size:42px;

}

}

@media(max-width:768px){

.why-grid{

grid-template-columns:1fr;

}

.about-features{

grid-template-columns:1fr;

}

.stats-grid{

grid-template-columns:1fr;

}

}
    </style>