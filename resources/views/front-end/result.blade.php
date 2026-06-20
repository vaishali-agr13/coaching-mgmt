@extends('front-end.layouts.app')
<link rel="stylesheet" href="{{ asset('css/result.css') }}">
@section('content')
<section class="gradient-results-universe">
    <div class="blob blob-purple"></div>
    <div class="blob blob-pink"></div>

    <div class="universe-wrapper">
        
        <div class="universe-header">
            <span class="universe-tagline">✨ WALL OF FAME</span>
            <h2>Shaping Futures, Celebrating Success</h2>
            <p>Our students consistently shatter records. Witness the outstanding academic milestones achieved under the personalized guidance of our elite home tutors.</p>
        </div>

        <div class="universe-stats-row">
            <div class="universe-stat-card">
                <div class="stat-icon-box"><i class="fa-solid fa-trophy"></i></div>
                <div>
                    <span class="univ-num">98.4%</span>
                    <span class="univ-lbl">Highest Board Score</span>
                </div>
            </div>
            <div class="universe-stat-card">
                <div class="stat-icon-box"><i class="fa-solid fa-star"></i></div>
                <div>
                    <span class="univ-num">120+</span>
                    <span class="univ-lbl">Students Scored 95%+</span>
                </div>
            </div>
            <div class="universe-stat-card">
                <div class="stat-icon-box"><i class="fa-solid fa-user-check"></i></div>
                <div>
                    <span class="univ-num">450+</span>
                    <span class="univ-lbl">Competitive Cleared</span>
                </div>
            </div>
        </div>

        <div class="universe-grid">
            
            <div class="glass-topper-card">
                <div class="glass-card-header">
                    <span class="glass-badge">Rank 1</span>
                    <div class="glass-avatar">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>
                </div>
                <div class="glass-card-body">
                    <h3>Rahul Sharma</h3>
                    <div class="glass-tags">
                        <span class="gtag">Class 12th</span>
                        <span class="gtag">CBSE Boards</span>
                    </div>
                    <p class="glass-desc">Scored a phenomenal **98.4%** with a perfect 100/100 score in Physics and Core Mathematics.</p>
                </div>
                <div class="card-footer-score">
                    <span>Aggregate: <strong>98.4%</strong></span>
                </div>
            </div>

            <div class="glass-topper-card featured">
                <div class="glass-card-header">
                    <span class="glass-badge dynamic-gradient">District Topper</span>
                    <div class="glass-avatar">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>
                </div>
                <div class="glass-card-body">
                    <h3>Anjali Gupta</h3>
                    <div class="glass-tags">
                        <span class="gtag">Class 10th</span>
                        <span class="gtag">ICSE Board</span>
                    </div>
                    <p class="glass-desc">Achieved school Rank 1 with an exceptional **97.6%**, scoring 99 in Chemistry & Computers.</p>
                </div>
                <div class="card-footer-score">
                    <span>Aggregate: <strong>97.6%</strong></span>
                </div>
            </div>

            <div class="glass-topper-card">
                <div class="glass-card-header">
                    <span class="glass-badge">Rank 3</span>
                    <div class="glass-avatar">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>
                </div>
                <div class="glass-card-body">
                    <h3>Vikram Malhotra</h3>
                    <div class="glass-tags">
                        <span class="gtag">Class 12th</span>
                        <span class="gtag">Commerce</span>
                    </div>
                    <p class="glass-desc">Broke institutional records in Accountancy scoring 99/100 and 98/100 in Economics.</p>
                </div>
                <div class="card-footer-score">
                    <span>Aggregate: <strong>96.8%</strong></span>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
