@extends('front-end.layouts.app')

@section('content')

<div class="checkout-wrapper">

    <!-- LEFT SIDE -->

    <div class="checkout-left">

        <div class="page-header">

            <h1>Checkout</h1>

            <p>Home > My Courses > Checkout</p>

        </div>


        <div class="checkout-box">

            <h2>Billing Details</h2>

            <form action="{{ route('course.order') }}" method="POST">

                @csrf

                <input type="hidden"
                name="course_id"
                value="{{ $course->id }}">

                <div class="form-grid">

                    <div class="form-group">

                        <label>Full Name *</label>

                        <input type="text"
                        value="{{ Auth::user()->name }}"
                        readonly>

                    </div>

                  

                    <div class="form-group">

                        <label>Email *</label>

                        <input type="email"
                        value="{{ Auth::user()->email }}"
                        readonly>

                    </div>

                    <div class="form-group">

                        <label>Phone *</label>

                        <input type="text"
                        value="{{ Auth::user()->phone ?? '' }}">

                    </div>

                    <div class="form-group">

                        <label>Pincode *</label>

                        <input type="text">

                    </div>

                    <div class="form-group">

                        <label>City *</label>

                        <input type="text">

                    </div>

                    <div class="form-group">

                        <label>State *</label>

                        <input type="text">

                     </div>
                    

                    <div class="form-group">

                        <label>Country *</label>

                        <input type="text">

                    </div>
                    <div class="form-group">

                        <label>Address *</label>

                        <input type="text">

                    </div>
                   

                </div>

                 <div class="form-group">

                        <label>Additional Information</label>

                        <textarea></textarea>

                    </div>


                <h2>Payment Method</h2>


                <div class="payment-method">

                    <label>

                        <input type="radio"
                        name="payment_method"
                        checked>

                        Online Payment (UPI/Card)

                    </label>

                </div>


                <div class="payment-method">

                    <label>

                        <input type="radio"
                        name="payment_method">

                        Net Banking

                    </label>

                </div>


                <div class="payment-method">

                    <label>

                        <input type="radio"
                        name="payment_method">

                        UPI

                    </label>

                </div>


                <div class="action-row">

                    <a href="{{ route('my.courses') }}">

                        ← Back

                    </a>

                    <button type="submit">

                        Proceed To Payment

                    </button>

                </div>

            </form>

        </div>

    </div>


    <!-- RIGHT SIDE -->


    <div class="checkout-right">

        <div class="summary-box">

            <h2>Order Summary</h2>

            <div class="course-info">

                <img
                src="{{ asset('uploads/courses/'.$course->image) }}">

                <div>

                    <h3>

                        {{ $course->course_name }}

</h3>

                </div>

            </div>


            <div class="price-row">

                <span>Course Price</span>

                <span>

                    ₹{{ $course->fee }}

                </span>

            </div>


            <div class="price-row">

                <span>Discount</span>

                <span>- ₹0</span>

            </div>


            <div class="price-row">

                <span>GST (18%)</span>

                <span>

                    ₹{{ ($course->fee *18)/100 }}

                </span>

            </div>


            <div class="total-row">

                <span>Total Amount</span>

                <span>

                    ₹{{ $course->fee + (($course->fee *18)/100) }}

                </span>

            </div>


            <div class="secure-box">

                <h4>Secure Checkout</h4>

                <p>

                    SSL Protected Payment

                </p>

            </div>


            <div class="features">

                <p>✓ Lifetime Access</p>

                <p>✓ Certificate</p>

                <p>✓ Student Support</p>

                <p>✓ Money Back Guarantee</p>

            </div>

        </div>

    </div>

</div>

@endsection
<style>
    .checkout-wrapper{

display:grid;

grid-template-columns:2fr 1fr;

gap:30px;

padding:35px;
}


.page-header{

background:linear-gradient(135deg,#DF528A,#8834E3);

padding:35px 40px;

border-radius:25px;

margin-bottom:25px;

color:#fff;
}


.page-header h1{

font-size:52px;

margin-bottom:10px;
}


.checkout-box{

background:#fff;

padding:35px;

border-radius:25px;

box-shadow:0 5px 20px rgba(0,0,0,.08);
}


.checkout-box h2{

margin-bottom:25px;
}


.form-grid{

display:grid;

grid-template-columns:1fr 1fr;

gap:20px;
}


.form-group{

display:flex;

flex-direction:column;
}


.form-group label{

font-weight:600;

margin-bottom:8px;
}


input,
select,
textarea{

height:55px;

padding:15px;

border:1px solid #ddd;

border-radius:12px;

outline:none;

font-size:15px;
}


textarea{

height:120px;
}


.full-width{

margin-top:20px;

display:flex;

flex-direction:column;
}


.payment-method{

border:1px solid #eee;

padding:18px;

border-radius:12px;

margin-bottom:15px;
}


.action-row{

display:flex;

justify-content:space-between;

align-items:center;

margin-top:30px;
}


button{

background:linear-gradient(135deg,#DF528A,#8834E3);

border:none;

padding:16px 35px;

color:#fff;

border-radius:12px;

font-size:16px;

cursor:pointer;
}


.summary-box{

background:#fff;

padding:30px;

border-radius:25px;

box-shadow:0 5px 20px rgba(0,0,0,.08);

position:sticky;

top:20px;
}


.course-info{

display:flex;

gap:18px;

margin:25px 0;
}


.course-info img{

width:100px;

height:100px;

object-fit:cover;

border-radius:12px;
}


.price-row{

display:flex;

justify-content:space-between;

margin:18px 0;
}


.total-row{

display:flex;

justify-content:space-between;

padding:18px;

background:#fff0f6;

font-weight:700;

font-size:24px;

color:#DF528A;

border-radius:12px;

margin-top:20px;
}


.secure-box{

margin-top:25px;
}


.features{

margin-top:30px;
}


.features p{

margin-bottom:12px;
}


@media(max-width:992px){

.checkout-wrapper{

grid-template-columns:1fr;

}

.form-grid{

grid-template-columns:1fr;

}

}
    </style>