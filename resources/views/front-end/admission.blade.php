@extends('front-end.layouts.app')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<section class="breadcrumb-section">
    <div class="container">
        <h1>Online Admission</h1>
        <p>Home / Online Admission</p>
    </div>
</section>

<section class="admission-section">
    <div class="container">
        <div class="form-wrapper">
            <div class="section-heading">
                <span>Admission Form</span>
                <h2>Apply For Your Course</h2>
                <p>
                    Fill out the admission form below and our team will
                    review your application shortly.
                </p>
            </div>

            <form action="{{ route('admission.store') }}" method="POST">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" placeholder="Enter first name" required>
                    </div>

                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" placeholder="Enter last name" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Enter email address" required>
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phone" placeholder="Enter phone number" required>
                    </div>

                    <div class="form-group">
                        <label>Date Of Birth</label>
                        <input type="date" name="date_of_birth" required>
                    </div>

                    <div class="form-group">
                        <label>Notes</label>
                        <input type="text" name="notes" required>
                    </div>

                    <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" required>
                            <option value="female">Female</option>
                            <option value="male">Male</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Education Background</label>
                        <textarea name="education_background" rows="4" placeholder="Enter your educational background" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Application Date</label>
                        <input type="date" name="application_date" value="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="form-group">
                        <label>Application Status</label>
                        <select name="application_status" required>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Reviewed By</label>
                        <input type="text" name="reviewed_by" placeholder="Reviewer name" required>
                    </div>

                    <div class="form-group">
                        <label>Review Date</label>
                        <input type="date" name="review_date" required>
                    </div>
                </div>

                <button class="submit-btn">Submit Application</button>
            </form>
        </div>
    </div>
</section>

@endsection

<style>
/* --- UPDATED BREADCRUMB SECTION TO MATCH IMAGE --- */
.breadcrumb-section {
    padding: 80px 0;
    text-align: center;
    /* Purple to Pink gradient as seen in image_f05323.jpg */
    background: linear-gradient(90deg, #c362fa 0%, #f761ae 100%); 
    border-bottom: none;
}

.breadcrumb-section h1 {
    font-size: 48px;
    font-weight: 700;
    color: #ffffff; /* White text for clear contrast */
    margin-bottom: 12px;
}

.breadcrumb-section p {
    color: rgba(255, 255, 255, 0.9); /* Slightly soft white for the breadcrumb path */
    font-size: 16px;
    font-weight: 500;
}
/* ------------------------------------------------ */

.admission-section {
    padding: 80px 0;
}

.container {
    width: 85%;
    max-width: 1200px;
    margin: auto;
}

.form-wrapper {
    background: #fff;
    padding: 60px;
    border-radius: 30px;
    box-shadow: 0 15px 50px rgba(0,0,0,.08);
}

.section-heading {
    text-align: center;
    margin-bottom: 50px;
}

.section-heading span {
    color: #e84f97;
    font-weight: 600;
}

.section-heading h2 {
    font-size: 42px;
    color: #1d2434;
    margin: 15px 0;
}

.section-heading p {
    color: #777;
    max-width: 700px;
    margin: auto;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 25px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.full-width {
    grid-column: 1/-1;
}

label {
    font-weight: 600;
    margin-bottom: 10px;
    color: #1d2434;
}

input,
select,
textarea {
    height: 55px;
    border: 1px solid #ececec;
    border-radius: 15px;
    padding: 0 20px;
    font-size: 16px;
    outline: none;
    transition: .3s;
}

textarea {
    height: 140px;
    padding-top: 18px;
    resize: none;
}

input:focus,
select:focus,
textarea:focus {
    border-color: #9d36ff;
    box-shadow: 0 0 0 4px rgba(157,54,255,.12);
}

.submit-btn {
    border: none;
    margin-top: 40px;
    padding: 16px 45px;
    border-radius: 50px;
    font-size: 17px;
    font-weight: 600;
    cursor: pointer;
    color: #fff;
    background: linear-gradient(90deg, #ea4f97, #8a2be2);
    transition: .3s;
}

.submit-btn:hover {
    transform: translateY(-3px);
}

@media(max-width:768px) {
    .form-wrapper {
        padding: 30px;
    }
    .form-grid {
        grid-template-columns: 1fr;
    }
    .full-width {
        grid-column: auto;
    }
    .section-heading h2 {
        font-size: 32px;
    }
    .breadcrumb-section h1 {
        font-size: 36px;
    }
}
</style>