@extends('front-end.layouts.app')
    <link rel="stylesheet" href="{{ asset('css/about-us.css') }}">

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
