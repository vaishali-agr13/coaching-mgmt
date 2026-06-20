@extends('front-end.layouts.app')
    <link rel="stylesheet" href="{{ asset('css/faculty-list.css') }}">

@section('content')



<section class="breadcrumb">

Home / Faculty

</section>


<section class="hero">

<div>

<h1>

Meet Our Expert Faculty

</h1>

<p>

Learn from industry professionals with years of experience.

</p>

<button>

Explore Faculty

</button>

</div>

<img src="https://picsum.photos/450/350">

</section>


<section class="search">

<input type="text"

placeholder="Search Faculty Name...">

<button>

Search

</button>

</section>


<section class="department">

<button class="faculty-active">

All

</button>

<button>

Web Development

</button>

<button>

Java

</button>

<button>

Python

</button>

<button>

UI/UX

</button>

<button>

Data Science

</button>

</section>


<section class="featured">

<h2>

Featured Faculty

</h2>

<div class="featured-box">

<div>

<i class="fa-solid fa-award"></i>

<h3>

50+ Expert Trainers

</h3>

</div>

<div>

<i class="fa-solid fa-graduation-cap"></i>

<h3>

10+ Years Experience

</h3>

</div>

<div>

<i class="fa-solid fa-users"></i>

<h3>

5000+ Students Trained

</h3>

</div>

</div>

</section>


<section class="faculty-grid">
@foreach($faculties as $faculty)

<div class="faculty-card">

<img src="{{ asset('public/uploads/faculty/'. $faculty->faculty_image) }}">

<h3>
{{$faculty->user->name}}

</h3>

<p>

{{$faculty->specialization}}

</p>

<div class="rating">

★★★★★

</div>

<button>

View Profile

</button>

</div>
@endforeach

<!-- <div class="faculty-card">

<img src="https://picsum.photos/300/300?2">

<h3>

Priya Patel

</h3>

<p>

Python Trainer

</p>

<div class="rating">

★★★★★

</div>

<button>

View Profile

</button>

</div>


<div class="faculty-card">

<img src="https://picsum.photos/300/300?3">

<h3>

Aman Gupta

</h3>

<p>

Java Developer

</p>

<div class="rating">

★★★★★

</div>

<button>

View Profile

</button>

</div>


<div class="faculty-card">

<img src="https://picsum.photos/300/300?4">

<h3>

Sneha Jain

</h3>

<p>

UI UX Designer

</p>

<div class="rating">

★★★★★

</div>

<button>

View Profile

</button>

</div>


<div class="faculty-card">

<img src="https://picsum.photos/300/300?5">

<h3>

Rohit Verma

</h3>

<p>

React JS Expert

</p>

<div class="rating">

★★★★★

</div>

<button>

View Profile

</button>

</div>


<div class="faculty-card">

<img src="https://picsum.photos/300/300?6">

<h3>

Neha Singh

</h3>

<p>

Data Science Trainer

</p>

<div class="rating">

★★★★★

</div>

<button>

View Profile

</button>

</div> -->


</section>


<section class="stats">

<div>

<h2>

50+

</h2>

<p>

Faculty Members

</p>

</div>

<div>

<h2>

5000+

</h2>

<p>

Students

</p>

</div>

<div>

<h2>

100+

</h2>

<p>

Courses

</p>

</div>

</section>


<section class="testimonial">

<h2>

Student Reviews

</h2>

<div class="review">

★★★★★

<p>

Faculty are very supportive and explain concepts clearly.

</p>

<h4>

- Vaishali

</h4>

</div>

</section>


<section class="cta">

<h1>

Learn From The Best Faculty

</h1>

<p>

Join 5000+ students today.

</p>

<button>

Join Now

</button>

</section>


@endsection