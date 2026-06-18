@extends('front-end.layouts.app')

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

<img src="https://picsum.photos/400/250?1">

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

<div class="card">

<img src="https://picsum.photos/400/250?2">

<div class="card-body">

<h3>Python Full Stack</h3>

<p>

Learn Python + Django + Projects

</p>

<div class="rating">

★★★★★ (4.9)

</div>

<div class="bottom">

<span>₹1499</span>

<button>

Enroll Now

</button>

</div>

</div>

</div>


<div class="card">

<img src="https://picsum.photos/400/250?3">

<div class="card-body">

<h3>Java Development</h3>

<p>

Master Core Java & Advanced Java

</p>

<div class="rating">

★★★★★ (4.7)

</div>

<div class="bottom">

<span>₹1299</span>

<button>

Enroll Now

</button>

</div>

</div>

</div>


<div class="card">

<img src="https://picsum.photos/400/250?4">

<div class="card-body">

<h3>HTML & CSS</h3>

<p>

Frontend Development Masterclass

</p>

<div class="rating">

★★★★★ (4.8)

</div>

<div class="bottom">

<span>₹799</span>

<button>

Enroll Now

</button>

</div>

</div>

</div>


<div class="card">

<img src="https://picsum.photos/400/250?5">

<div class="card-body">

<h3>React JS</h3>

<p>

Modern Frontend Development

</p>

<div class="rating">

★★★★★ (4.9)

</div>

<div class="bottom">

<span>₹1699</span>

<button>

Enroll Now

</button>

</div>

</div>

</div>


<div class="card">

<img src="https://picsum.photos/400/250?6">

<div class="card-body">

<h3>UI UX Design</h3>

<p>

Become a Professional Designer

</p>

<div class="rating">

★★★★★ (4.8)

</div>

<div class="bottom">

<span>₹899</span>

<button>

Enroll Now

</button>

</div>

</div>

</div>


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

<style>



.breadcrumb{

padding:20px 80px;

background:#faf5ff;

font-size:14px;

}


.banner{

padding:60px;

text-align:center;

background:linear-gradient(90deg,#c975ff,#ff8fc7);

color:#fff;

}


.banner h1{

font-size:45px;

margin-bottom:15px;

}


.search-section{

display:flex;

justify-content:center;

padding:40px;

gap:10px;

}


.search-section input{

width:500px;

padding:15px;

border:1px solid #ddd;

border-radius:10px;

}


.search-section button{

padding:15px 30px;

border:none;

border-radius:10px;

background:#d36cff;

color:#fff;

}


.categories{

display:flex;

justify-content:center;

flex-wrap:wrap;

gap:15px;

padding:20px;

}


.categories button{

padding:12px 25px;

border:none;

border-radius:30px;

background:#f5e4ff;

cursor:pointer;

}


.course-container{

padding:60px 80px;

display:grid;

grid-template-columns:repeat(3,1fr);

gap:30px;

}


.card{

background:#fff;

border-radius:20px;

overflow:hidden;

box-shadow:0 10px 30px rgba(0,0,0,.1);

transition:.3s;

}


.card:hover{

transform:translateY(-10px);

}


.card img{

width:100%;

height:220px;

object-fit:cover;

}


.card-body{

padding:25px;

}


.card h3{

margin-bottom:15px;

}


.card p{

margin-bottom:15px;

color:#666;

}


.rating{

margin-bottom:20px;

color:#ffb700;

}


.bottom{

display:flex;

justify-content:space-between;

align-items:center;

}


.bottom span{

font-size:25px;

font-weight:bold;

color:#c75bf4;

}


.bottom button{

padding:10px 20px;

border:none;

border-radius:25px;

background:linear-gradient(90deg,#bb65ff,#ff78c7);

color:#fff;

cursor:pointer;

}


.pagination{

display:flex;

justify-content:center;

padding:50px;

gap:15px;

}


.pagination button{

width:45px;

height:45px;

border:none;

border-radius:50%;

background:#e8c9ff;

cursor:pointer;

}

@media(max-width:992px){

.course-container{

grid-template-columns:repeat(2,1fr);

}

}


@media(max-width:768px){



.search-section{

flex-direction:column;

}

.search-section input{

width:100%;

}

.course-container{

grid-template-columns:1fr;

padding:20px;

}

}
    </style>