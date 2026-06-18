@extends('front-end.layouts.app')

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

<img src="https://picsum.photos/300/300?1">

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

<style>

.breadcrumb{

padding:20px 80px;

background:#faf5ff;

}


.hero{

       height:450px;
    margin:30px 40px;
    padding:80px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    background:linear-gradient(90deg,#c06eff,#ff91ca);
    color:#fff;
    border-radius:20px;

}

.hero > div{
    padding-left:40px;   /* text ko left se space */
}


.hero h1{

font-size:50px;

margin-bottom:20px;

}


.hero p{

margin-bottom:25px;

line-height:28px;

}


.hero button{

padding:14px 30px;

border:none;

border-radius:30px;

background:#fff;

color:#d26df7;

cursor:pointer;

}


.hero img{
    margin-right:40px;   /* image ko right se space */
}


.search{

padding:50px;

display:flex;

justify-content:center;

gap:10px;

}


.search input{

width:500px;

padding:15px;

border:1px solid #ddd;

border-radius:10px;

}


.search button{

padding:15px 30px;

border:none;

border-radius:10px;

background:#d26df7;

color:#fff;

}


.department{

display:flex;

justify-content:center;

flex-wrap:wrap;

gap:15px;

padding-bottom:40px;

}


.department button{

padding:12px 25px;

border:none;

border-radius:30px;

background:#f5e4ff;

cursor:pointer;

}


.featured{

padding:80px;

text-align:center;

}


.featured-box{

display:grid;

grid-template-columns:repeat(3,1fr);

gap:30px;

margin-top:40px;

}

.faculty-active{

color:#d26df7;

}
.featured-box div{

padding:40px;

border-radius:20px;

box-shadow:0 10px 25px rgba(0,0,0,.08);

}


.featured-box i{

font-size:45px;

color:#d26df7;

margin-bottom:20px;

}


.faculty-grid{

padding:80px;

display:grid;

grid-template-columns:repeat(3,1fr);

gap:30px;

}


.faculty-card{

padding:30px;

text-align:center;

border-radius:25px;

box-shadow:0 10px 30px rgba(0,0,0,.08);

transition:.3s;

}


.faculty-card:hover{

transform:translateY(-10px);

}


.faculty-card img{

width:180px;

height:180px;

border-radius:50%;

object-fit:cover;

}


.faculty-card h3{

margin:20px 0 10px;

}


.rating{

margin:15px 0;

color:#ffb700;

}


.faculty-card button{

padding:12px 25px;

border:none;

border-radius:25px;

background:linear-gradient(90deg,#bb65ff,#ff85c8);

color:#fff;

cursor:pointer;

}


.stats{

padding:80px;

display:flex;

justify-content:space-around;

background:#faf5ff;

text-align:center;

}


.stats h2{

font-size:50px;

color:#d26df7;

}


.testimonial{

padding:80px;

text-align:center;

}


.review{

width:700px;

margin:auto;

padding:40px;

border-radius:25px;

box-shadow:0 10px 25px rgba(0,0,0,.08);

}


.cta{

padding:100px;

text-align:center;

background:linear-gradient(90deg,#c06eff,#ff91ca);

color:#fff;

}


.cta button{

margin-top:25px;

padding:15px 35px;

border:none;

border-radius:30px;

background:#fff;

color:#d26df7;

cursor:pointer;

}



@media(max-width:992px){

.hero{

flex-direction:column;

height:auto;

}

.featured-box,

.faculty-grid{

grid-template-columns:1fr 1fr;

}

}


@media(max-width:768px){

.hero{

padding:40px;

}

.hero h1{

font-size:35px;

}

.search{

flex-direction:column;

}

.search input{

width:100%;

}

.featured-box,

.faculty-grid{

grid-template-columns:1fr;

}

.stats{

flex-direction:column;

gap:30px;

}

.review{

width:100%;

}

}
    </style>