@extends('front-end.layouts.app')
<link rel="stylesheet" href="{{ asset('css/contact-us.css') }}">
@section('content')
    <!-- Banner Section -->
    <section class="contact-banner">
        <div class="container">
            <span>GET IN TOUCH WITH US</span>
            <h1>Contact Our Team</h1>
            <p>Have questions about courses, admissions, or home tutoring? Reach out to Best Home Tutor Coaching, and our educational experts will guide you step by step.</p>
        </div>
    </section>

    <!-- Main Content Grid -->
    <div class="contact-container">
        
        <!-- Left Column: Contact Details -->
        <div class="contact-info-card">
            <h2>Contact Information</h2>
            <p>Fill out the form or reach us through the official contact channels listed below.</p>
            
            <!-- Address -->
            <div class="info-item">
                <div class="info-icon">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div class="info-text">
                    <h4>Our Corporate Office</h4>
                    <p>H.No, 7, Ravidas Nagar, Narela Shankari, Chatrasal Nagar, Indrapuri, Bhopal, Madhya Pradesh 462021</p>
                </div>
            </div>

            <!-- Phone -->
            <div class="info-item">
                <div class="info-icon">
                    <i class="fa-solid fa-phone"></i>
                </div>
                <div class="info-text">
                    <h4>Call / WhatsApp</h4>
                    <p>+91 98765 43210<br>+91 91234 56789</p>
                </div>
            </div>

            <!-- Email -->
            <div class="info-item">
                <div class="info-icon">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <div class="info-text">
                    <h4>Email Address</h4>
                    <p>info@bhtc.com<br>support@bhtc.com</p>
                </div>
            </div>
        </div>

        <!-- Right Column: Enquiry Form -->
        <div class="contact-form-card">
            <h2>Send Us A Message</h2>
            
            <form action="#" method="POST">
                <div class="form-grid">
                    <!-- Full Name -->
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                    </div>

                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>

                    <!-- Mobile Number -->
                    <div class="form-group">
                        <label for="phone">Mobile Number</label>
                        <input type="tel" id="phone" name="phone" placeholder="Enter 10-digit mobile number" required>
                    </div>

                    <!-- Student Class / Course Selection -->
                    <div class="form-group">
                        <label for="interest">Interested In</label>
                        <select id="interest" name="interest">
                            <option value="" disabled selected>Select Course / Service</option>
                            <option value="home-tuition">Home Tutors Enquiry</option>
                            <option value="academic-coaching">Academic Coaching Classes</option>
                            <option value="competitive-exams">Competitive Exams Prep</option>
                            <option value="other">Other Enquiry</option>
                        </select>
                    </div>
                </div>

                <!-- Message Box -->
                <div class="form-group full-width">
                    <label for="message">Your Message / Requirements</label>
                    <textarea id="message" name="message" placeholder="Briefly explain your query or tuition requirements..." required></textarea>
                </div>

                <!-- Action Button -->
                <button type="submit" class="submit-btn">
                    Submit Form <i class="fa-solid fa-paper-plane"></i>
                </button>
            </form>
        </div>

    </div>


@endsection