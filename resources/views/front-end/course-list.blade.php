@extends('front-end.layouts.app')
    <link rel="stylesheet" href="{{ asset('css/course-list.css') }}">

@section('content')


<!-- Breadcrumb -->

<section class="breadcrumb">

Home / Courses

</section>


<!-- Banner -->

<section class="banner">

<h1>Explore Our Courses</h1>

<p>

Upgrade your skills and build your future with industry experts.

</p>

</section>


<!-- Search -->

<section class="search-section">

<input type="text"

placeholder="Search Courses...">

<button>

Search

</button>

</section>


<!-- Categories -->

<section class="categories">

<button class="active">

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

Laravel

</button>

</section>


<!-- Course Grid -->

<section class="course-container">
@foreach($courses as $course)

<div class="card">

<img src="{{ asset('public/uploads/courses/' . $course->course_image) }}">

<div class="card-body">

<h3>{{$course->course_name}}</h3>

<p>

{{$course->description}}
</p>

<div class="rating">

★★★★★ (4.8)

</div>

<div class="bottom">

<span>₹{{$course->fee}}</span>

<button>

Enroll Now

</button>

</div>

</div>

</div>
@endforeach

</section>


<!-- Pagination -->

<section class="pagination">

<button>1</button>

<button>2</button>

<button>3</button>

<button>

Next

</button>

</section>


@endsection
