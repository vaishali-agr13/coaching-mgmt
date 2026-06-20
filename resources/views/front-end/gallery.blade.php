<!-- Gallery Section Start -->
@extends('front-end.layouts.app')
    <link rel="stylesheet" href="{{ asset('css/gallery.css') }}">

@section('content')

<section class="coaching-gallery">
    <div class="container">
        <!-- Section Heading -->
        <div class="gallery-heading text-center">
            <span class="sub-title"><i class="fas fa-graduation-cap"></i> OUR MEMORIES & ACHIEVEMENTS</span>
            <h2>Our Campus <span>Gallery</span></h2>
            <p>Glimpses of our vibrant learning environment, advanced classrooms, campus celebrations, and proud academic moments.</p>
        </div>

        <!-- Gallery Grid -->
        <div class="gallery-grid">
            <!-- Image 1: Classrooms -->

            @foreach($galleryImages as $galleryImage)
                <div class="gallery-item classrooms">
                    <div class="gallery-box">
                        <img src="{{ asset('public/uploads/gallery-covers/' . $galleryImage->cover_image) }}" alt="Modern Classroom">
                        <div class="gallery-overlay">
                            <div class="overlay-content">
                                <h5>Modern Classrooms</h5>
                                <p>Interactive & smart learning environment</p>
                                <a href="{{ asset('public/uploads/gallery-covers/' . $galleryImage->cover_image) }}" class="view-btn" target="_blank"><i class="fas fa-search-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

           
        </div>
    </div>
</section>
<!-- Gallery Section End -->

<!-- FontAwesome Icons aur Google Fonts include krna mat bhulna agar pehle se nahi hai -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@endsection