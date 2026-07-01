@extends('front-end.layouts.app')

@section('content')

<div class="dashboard-wrapper">

    <!-- Sidebar -->

    <div class="sidebar">

        <div class="profile-box">

            <div class="avatar">

                {{ strtoupper(substr(Auth::user()->name,0,1)) }}

            </div>

            <h3>Welcome Back</h3>

            <p>{{ Auth::user()->email }}</p>

        </div>

        <ul>

            <li>

                <a href="{{ route('student.profile') }}">

                    Edit Profile

                </a>

            </li>

            <li class="active">

                <a href="{{ route('my.courses') }}">

                    My Courses

                </a>

            </li>

            <li>

                <a href="#">

                    Academic Results

                </a>

            </li>

            <li>

                <a href="#">

                    Fees Status

                </a>

            </li>

            <li>

                <a href="#">

                    Settings

                </a>

            </li>

        </ul>

    </div>


    <!-- Content -->

    <div class="content-area">

        <div class="page-header">

            <h2>My Courses</h2>

            <p>Your purchased and enrolled courses</p>

        </div>


        <div class="courses-grid">

            @foreach($courses as $item)

            <div class="course-card">

                <div class="course-image">

                    <img
                    src="{{ asset('uploads/courses/'.$item->course->image) }}"
                    alt="">

                </div>
                <div class="course-body">

                    <h3>

                        {{ $item->course->course_name }}

                    </h3>

                    <h3>

                        {{ $item->course->course_code  }}

                    </h3>

                    <!-- <p>

                        Instructor :
                        {{ $item->course->faculty_name }}

                    </p> -->

                    <p>

                        Duration :
                        {{ $item->course->duration_hours }}

                    </p>

                    <p>

                        Price :
                        ₹{{ $item->course->fee }}

                    </p>

                    <p>

                        Purchased :
                        {{ $item->enrollment_date->format('d M Y') }}

                    </p>

                    


                    <div class="progress">

                        <div class="progress-bar"></div>

                    </div>


                    <span class="badge">

                        {{ $item->status }}

                    </span>

                    <!-- <a href="#"
                    class="continue-btn">

                        Continue Learning

                    </a> -->

                </div>

            </div>

            @endforeach

        </div>

    </div>

</div>

@endsection

<style>

    .dashboard-wrapper{

display:flex;

gap:30px;

padding:30px;

background:#fafafa;
}


.sidebar{

width:300px;

background:#fff;

padding:25px;

border-radius:20px;

box-shadow:0 5px 20px rgba(0,0,0,.08);
}


.profile-box{

text-align:center;

margin-bottom:30px;
}


.avatar{

width:90px;

height:90px;

border-radius:50%;

background:linear-gradient(135deg,#DF528A,#8834E3);

color:#fff;

font-size:40px;

font-weight:700;

display:flex;

justify-content:center;

align-items:center;

margin:auto;

margin-bottom:15px;
}


.profile-box h3{

margin-bottom:8px;
}


.profile-box p{

color:#777;
}


.sidebar ul{

list-style:none;

padding:0;
}


.sidebar ul li{

margin-bottom:15px;
}


.sidebar ul li a{

display:block;

padding:15px;

text-decoration:none;

color:#555;

font-size:18px;

border-radius:12px;
}


.sidebar ul li.active a{

background:#f6e7ef;

color:#DF528A;

font-weight:600;
}


.content-area{

flex:1;
}


.page-header{

background:linear-gradient(135deg,#DF528A,#8834E3);

padding:40px;

border-radius:20px;

color:#fff;

margin-bottom:30px;
}


.page-header h2{

font-size:42px;

margin-bottom:10px;
}


.courses-grid{

display:grid;

grid-template-columns:repeat(3,1fr);

gap:18px;
}

@media(max-width:992px){

.courses-grid{

grid-template-columns:repeat(2,1fr);

}

}

@media(max-width:768px){

.courses-grid{

grid-template-columns:1fr;

}

}


.course-card{

background:#fff;

border-radius:16px;

overflow:hidden;

box-shadow:0 4px 12px rgba(0,0,0,.08);

height:auto;
}


.course-image img{

width:100%;

height:170px;

object-fit:cover;
}


.course-body{
padding:18px;
}


.course-body h3{

font-size:22px;

margin-bottom:12px;}


.course-body p{

margin-bottom:8px;

font-size:14px;
}


.badge{
display:inline-block;

margin-top:8px;

padding:6px 12px;

border-radius:20px;

background:#eaf7ef;

color:green;

font-size:13px;

font-weight:600;
}



.progress{

width:100%;

height:8px;

background:#eee;

border-radius:20px;

margin-bottom:12px;
}


.progress-bar{

width:65%;

height:100%;

border-radius:20px;

background:linear-gradient(135deg,#DF528A,#8834E3);
}


.continue-btn{

display:block;

width:100%;

text-align:center;

padding:12px;

margin-top:12px;

background:linear-gradient(135deg,#DF528A,#8834E3);

color:#fff;

text-decoration:none;

border-radius:10px;
}
    </style>