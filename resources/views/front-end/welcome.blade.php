<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduExcel | Ultimate Luxury Learning Interface</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Cabinet+Grotesk:wght@700;800&display=swap" rel="stylesheet">
    
    <style>
        /* --- MODERN LIGHT BLUE PALETTE --- */
        :root {
            --bg-main: #f4f8ff;          
            --bg-card: rgba(255, 255, 255, 0.85); 
            --primary: #2563eb;          /* Vibrant Royal Blue */
            --primary-light: #3b82f6;    /* Bright Sky Blue */
            --primary-glow: rgba(37, 99, 235, 0.15);
            --secondary: #090f1d;        /* Deep Premium Midnight Navy */
            --text-muted: #64748b;       
            --white: #ffffff;
            --border-glass: rgba(37, 99, 235, 0.08);
            --radius-lg: 32px;
            --radius-md: 18px;
            --transition-bounce: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            --transition-smooth: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: var(--bg-main);
            color: var(--secondary);
            overflow-x: hidden;
            line-height: 1.6;
            position: relative;
        }

        /* --- BACKGROUND AMBIENT GLOW --- */
        body::before, body::after {
            content: '';
            position: absolute;
            width: 700px;
            height: 700px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(96, 165, 250, 0.22) 0%, transparent 70%);
            z-index: -1;
            filter: blur(100px);
            animation: float-orb 18s ease-in-out infinite alternate;
        }
        body::before { top: -150px; right: -50px; }
        body::after { top: 45%; left: -250px; background: radial-gradient(circle, rgba(37, 99, 235, 0.12) 0%, transparent 70%); }

        @keyframes float-orb {
            0% { transform: scale(1) translate(0, 0); }
            100% { transform: scale(1.2) translate(60px, -30px); }
        }

        .container {
            width: 100%;
            max-width: 1340px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* --- 💎 THE ULTRA-ATTRACTIVE EXECUTIVE HEADER --- */
        header {
            position: fixed;
            top: 24px; /* Suspended spacing from boundary */
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        .header-pill {
            background: rgba(255, 255, 255, 0.65);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border: 1px solid rgba(255, 255, 255, 0.7);
            border-radius: 100px; /* Perfect Capsule Curve */
            box-shadow: 
                0 4px 6px -1px rgba(0, 0, 0, 0.01),
                0 20px 40px -4px rgba(37, 99, 235, 0.06),
                inset 0 1px 0 0 rgba(255, 255, 255, 0.9);
            padding: 10px 14px 10px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: var(--transition-smooth);
        }

        /* Luxury Branding Structure */
        .brand-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .brand-logo-shield {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 1.25rem;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.25);
            position: relative;
            overflow: hidden;
        }

        .brand-logo-shield::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(255,255,255,0.2), transparent);
        }

        .brand-name {
            font-size: 1.5rem;
            font-family: 'Cabinet Grotesk', sans-serif;
            font-weight: 800;
            color: var(--secondary);
            letter-spacing: -0.5px;
        }

        /* Sliding Matrix Navigation Menu */
        .lux-nav {
            display: flex;
            align-items: center;
            gap: 4px;
            background: rgba(15, 23, 42, 0.03);
            padding: 6px;
            border-radius: 100px;
            border: 1px solid rgba(0, 0, 0, 0.02);
        }

        .lux-link {
            text-decoration: none;
            font-weight: 700;
            font-size: 0.88rem;
            color: var(--text-muted);
            padding: 10px 20px;
            border-radius: 100px;
            transition: var(--transition-smooth);
            position: relative;
        }

        .lux-link:hover {
            color: var(--primary);
        }

        /* Smooth Neon Slide Indicator Overlay instead of generic block */
        .lux-link.active {
            color: var(--white);
            background: var(--secondary);
            box-shadow: 0 10px 20px rgba(9, 15, 29, 0.15);
        }

        /* Pulse Dot for Dynamic Link */
        .badge-pulse-dot {
            position: absolute;
            top: 4px;
            right: 12px;
            width: 6px;
            height: 6px;
            background: #f43f5e;
            border-radius: 50%;
        }
        .badge-pulse-dot::after {
            content: '';
            position: absolute;
            inset: 0;
            background: #f43f5e;
            border-radius: 50%;
            animation: pulse-wave 1.6s infinite ease-in-out;
        }

        @keyframes pulse-wave {
            0% { transform: scale(0.9); opacity: 0.6; }
            100% { transform: scale(2.6); opacity: 0; }
        }

        /* Modern CTA Portal Button Hook */
        .header-action-btn {
            background: linear-gradient(135deg, var(--secondary) 0%, #1a2942 100%);
            color: var(--white);
            padding: 12px 26px;
            border-radius: 100px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 10px 25px rgba(9, 15, 29, 0.12);
            transition: var(--transition-bounce);
        }

        .header-action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(37, 99, 235, 0.2);
            background: linear-gradient(135deg, var(--primary) 0%, #1d4ed8 100%);
        }

        /* --- STANDARD REFINED LAYOUT BUTTONS --- */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 16px 36px;
            border-radius: 100px;
            font-weight: 700;
            font-size: 0.95rem;
            transition: var(--transition-bounce);
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), #1d4ed8);
            color: var(--white);
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 15px 30px rgba(37, 99, 235, 0.35);
        }

        .btn-secondary {
            background: rgba(37, 99, 235, 0.05);
            color: var(--primary);
            border: 1px solid rgba(37, 99, 235, 0.1);
        }

        .btn-secondary:hover {
            background: var(--primary);
            color: var(--white);
            transform: translateY(-4px);
        }

        /* --- HERO SECTION --- */
        .hero {
            padding: 240px 0 120px 0;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 60px;
            align-items: center;
        }

        .hero-content h1 {
            font-size: 4.4rem;
            line-height: 1.1;
            font-family: 'Cabinet Grotesk', sans-serif;
            font-weight: 800;
            color: var(--secondary);
            letter-spacing: -1.5px;
            margin-bottom: 24px;
        }

        .hero-content h1 span {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-content p {
            font-size: 1.15rem;
            color: var(--text-muted);
            margin-bottom: 40px;
            max-width: 560px;
        }

        .hero-actions { display: flex; gap: 16px; }

        /* FORM BLOCK WITH INTEGRATED GLASS PATTERN */
        .hero-form-container {
            background: var(--bg-card);
            padding: 45px;
            border-radius: var(--radius-lg);
            border: 1px solid rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            box-shadow: 0 40px 80px rgba(37, 99, 235, 0.04), inset 0 1px 0 rgba(255,255,255,0.8);
            animation: elegant-float 6s ease-in-out infinite alternate;
        }

        @keyframes elegant-float {
            0% { transform: translateY(0px); }
            100% { transform: translateY(-16px); }
        }

        .hero-form-container h3 { font-size: 1.6rem; font-family: 'Cabinet Grotesk', sans-serif; font-weight: 800; margin-bottom: 8px; }
        .hero-form-container p { color: var(--text-muted); font-size: 0.95rem; margin-bottom: 28px; }

        .form-group { margin-bottom: 18px; position: relative; }
        .form-group i { position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: var(--primary-light); }
        .form-control {
            width: 100%; padding: 16px 16px 16px 52px; background: var(--white);
            border: 1px solid rgba(37, 99, 235, 0.08); border-radius: var(--radius-md); font-size: 0.95rem; color: var(--secondary); transition: var(--transition-smooth);
        }
        .form-control:focus { outline: none; border-color: var(--primary-light); box-shadow: 0 0 20px rgba(37, 99, 235, 0.08); }

        /* --- BATCHES / COURSES MATRIX --- */
        .courses-section { padding: 120px 0; }
        .courses-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(360px, 1fr)); gap: 35px; }
        .course-card {
            background: var(--bg-card); border-radius: var(--radius-lg); overflow: hidden; border: 1px solid rgba(255, 255, 255, 0.5); backdrop-filter: blur(15px); transition: var(--transition-bounce);
        }
        .course-card:hover { transform: translateY(-15px); border-color: var(--primary-light); box-shadow: 0 30px 60px rgba(37, 99, 235, 0.05); }
        .course-img {
            height: 230px; background: linear-gradient(135deg, rgba(37, 99, 235, 0.02), rgba(96, 165, 250, 0.1)); position: relative; display: flex; align-items: center; justify-content: center; font-size: 3.8rem; color: var(--primary); transition: var(--transition-smooth);
        }
        .course-card:hover .course-img { background: linear-gradient(135deg, var(--primary), var(--primary-light)); color: var(--white); }
        .course-badge { position: absolute; top: 24px; left: 24px; background: var(--white); color: var(--primary); padding: 6px 16px; border-radius: 50px; font-size: 0.8rem; font-weight: 700; }
        .course-content { padding: 32px; }
        .course-content h3 { font-size: 1.4rem; font-family: 'Cabinet Grotesk', sans-serif; font-weight: 800; margin-bottom: 12px; }
        .course-content p { color: var(--text-muted); font-size: 0.95rem; margin-bottom: 24px; }
        .course-meta { display: flex; justify-content: space-between; border-top: 1px solid rgba(37, 99, 235, 0.05); padding-top: 20px; font-size: 0.9rem; font-weight: 600; }

        /* --- GLOBAL CONTENT SECTIONS CONFIGS --- */
        .section-title { text-align: center; margin-bottom: 70px; }
        .section-title span {
            color: var(--primary); font-weight: 800; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 3px; display: inline-block; background: rgba(37, 99, 235, 0.05); padding: 6px 16px; border-radius: 50px; margin-bottom: 16px;
        }
        .section-title h2 { font-size: 2.8rem; font-family: 'Cabinet Grotesk', sans-serif; font-weight: 800; }

        /* --- SYSTEM ADVANTAGES --- */
        .why-section { padding: 120px 0; }
        .why-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px; }
        .why-card { background: var(--white); padding: 45px 35px; border-radius: var(--radius-lg); text-align: center; border: 1px solid rgba(37, 99, 235, 0.02); transition: var(--transition-smooth); }
        .why-card:hover { transform: translateY(-8px); box-shadow: 0 20px 50px rgba(37, 99, 235, 0.05); }
        .why-icon {
            width: 80px; height: 80px; border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; background: rgba(37, 99, 235, 0.05); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 2rem; margin: 0 auto 28px auto; transition: var(--transition-bounce);
        }
        .why-card:hover .why-icon { border-radius: 50%; background: var(--primary); color: var(--white); }

        /* --- PERFORMANCE MATRIX --- */
        .results-section { padding: 100px 0; background: linear-gradient(135deg, #1e3a8a, #2563eb); color: var(--white); border-radius: 40px; margin: 0 24px; }
        .results-section .section-title h2 { color: var(--white); }
        .results-section .section-title span { background: rgba(255,255,255,0.1); color: var(--white); }
        .results-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 30px; text-align: center; }
        .result-number { font-size: 4rem; font-family: 'Cabinet Grotesk', sans-serif; font-weight: 800; margin-bottom: 8px; background: linear-gradient(to bottom, #ffffff, #93c5fd); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }

        /* --- TESTIMONIAL SHEETS --- */
        .testimonials-section { padding: 120px 0; }
        .testimonial-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 35px; }
        .testi-card { background: var(--white); padding: 45px; border-radius: var(--radius-lg); border: 1px solid rgba(37, 99, 235, 0.04); position: relative; transition: var(--transition-smooth); }
        .testi-card:hover { border-color: var(--primary-light); transform: scale(1.02); }
        .testi-card::before { content: '“'; position: absolute; top: 20px; right: 40px; font-size: 6rem; color: rgba(37, 99, 235, 0.04); font-family: serif; }
        .user-info { display: flex; align-items: center; gap: 16px; margin-top: 28px; }
        .user-img { width: 52px; height: 52px; border-radius: 50%; background: linear-gradient(135deg, var(--primary-light), var(--primary)); display: flex; align-items: center; justify-content: center; font-weight: 700; color: var(--white); }

        /* --- GEOLOCATION CONCIERGE HUB --- */
        .contact-section { padding: 120px 0; }
        .contact-grid { display: grid; grid-template-columns: 1fr 1.2fr; gap: 60px; align-items: center; }
        .info-box { display: flex; gap: 20px; margin-bottom: 32px; background: var(--white); padding: 24px; border-radius: var(--radius-md); border: 1px solid rgba(37, 99, 235, 0.04); transition: var(--transition-smooth); }
        .info-box:hover { transform: translateX(8px); border-color: var(--primary-light); }
        .info-icon { width: 56px; height: 56px; border-radius: 14px; background: rgba(37, 99, 235, 0.04); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 1.4rem; }
        .map-container { border-radius: var(--radius-lg); overflow: hidden; border: 1px solid rgba(37, 99, 235, 0.05); height: 100%; min-height: 380px; background: linear-gradient(135deg, #e0f2fe, #dbeafe); display: flex; align-items: center; justify-content: center; }

        /* --- FOOTER --- */
        footer { background: var(--secondary); color: rgba(255,255,255,0.5); padding: 45px 0; text-align: center; font-size: 0.95rem; }

        /* --- ADVANCED RESPONSIVENESS MATRIX --- */
        @media (max-width: 1200px) {
            header { top: 0; }
            .header-pill { border-radius: 0; padding: 15px 20px; }
            .lux-nav, .header-action-btn { display: none; }
            .hero-grid, .contact-grid { grid-template-columns: 1fr; gap: 40px; }
            .hero-content h1 { font-size: 3.2rem; }
            .results-section { margin: 0 10px; border-radius: 20px; }
        }
    </style>
</head>
<body>

    <header>
        <div class="container">
            <div class="header-pill">
                
                <a href="#" class="brand-wrapper">
                    <div class="brand-logo-shield">
                        <i class="fa-solid fa-feather-pointed"></i>
                    </div>
                    <span class="brand-name">EduExcel</span>
                </a>
                
                <nav class="lux-nav">
                    <a href="#" class="lux-link active">Home</a>
                    <a href="#" class="lux-link">About Us</a>
                    <a href="#" class="lux-link">Courses</a>
                    <a href="#" class="lux-link">Faculty</a>
                    <a href="#" class="lux-link">Results</a>
                    <a href="#" class="lux-link">Gallery</a>
                    <a href="#" class="lux-link">Blog</a>
                    <a href="#" class="lux-link">
                        Online Admission
                        <span class="badge-pulse-dot"></span> </a>
                    <a href="#" class="lux-link">Contact</a>
                </nav>

                <div>
                    <a href="#" class="header-action-btn">
                        <i class="fa-solid fa-bolt-lightning"></i> Student Hub
                    </a>
                </div>

            </div>
        </div>
    </header>

    <section class="hero">
        <div class="container hero-grid">
            <div class="hero-content">
                <h1>Unlock World Class <span>Academic Power</span></h1>
                <p>Empowering minds through structured digital resources, premium mentorship setups, and interactive assessment modules.</p>
                <div class="hero-actions">
                    <button class="btn btn-primary">Our Programs <i class="fa-solid fa-arrow-trend-up"></i></button>
                    <button class="btn btn-secondary">Watch Demo Batches</button>
                </div>
            </div>
            
            <div class="hero-form-container">
                <h3>Book a Free Demo Class</h3>
                <p>Register today to save your digital orientation seat.</p>
                <form action="#">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Student Name" required>
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email Address" required>
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="form-group">
                        <input type="tel" class="form-control" placeholder="Contact Mobile" required>
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Target Course (JEE/NEET/Boards)" required>
                        <i class="fa-solid fa-book-bookmark"></i>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; margin-top: 10px; border-radius: 14px;">Secure My Free Pass</button>
                </form>
            </div>
        </div>
    </section>

    <section class="courses-section">
        <div class="container">
            <div class="section-title">
                <span>Active Batches</span>
                <h2>Explore Supercharged Courses</h2>
            </div>
            
            <div class="courses-grid">
                <div class="course-card">
                    <div class="course-img">
                        <i class="fa-solid fa-cubes"></i>
                        <span class="course-badge">Target Batches</span>
                    </div>
                    <div class="course-content">
                        <h3>IIT-JEE Premium Prep</h3>
                        <p>Complete algorithmic problem sets, interactive physics visuals, and real-time rank trackers.</p>
                        <div class="course-meta">
                            <span><i class="fa-regular fa-clock" style="color: var(--primary);"></i> Full-time Session</span>
                            <span style="color: var(--primary);">Explore Batch <i class="fa-solid fa-arrow-right"></i></span>
                        </div>
                    </div>
                </div>
                <div class="course-card">
                    <div class="course-img" style="color: #0d9488;">
                        <i class="fa-solid fa-heart-pulse"></i>
                        <span class="course-badge" style="color: #0d9488;">Medical Tier</span>
                    </div>
                    <div class="course-content">
                        <h3>NEET Absolute Care</h3>
                        <p>Extensive botany and human anatomy analysis, accompanied by daily mock assessment drills.</p>
                        <div class="course-meta">
                            <span><i class="fa-regular fa-clock" style="color: #0d9488;"></i> 2 Year Blueprint</span>
                            <span style="color: #0d9488;">Explore Batch <i class="fa-solid fa-arrow-right"></i></span>
                        </div>
                    </div>
                </div>
                <div class="course-card">
                    <div class="course-img" style="color: #7c3aed;">
                        <i class="fa-solid fa-book-open-reader"></i>
                        <span class="course-badge" style="color: #7c3aed;">Grades 8-10</span>
                    </div>
                    <div class="course-content">
                        <h3>Early Olympiad Foundation</h3>
                        <p>Sharpening cognitive thinking and core logic mechanisms from early school years.</p>
                        <div class="course-meta">
                            <span><i class="fa-regular fa-clock" style="color: #7c3aed;"></i> 1 Year Course</span>
                            <span style="color: #7c3aed;">Explore Batch <i class="fa-solid fa-arrow-right"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="why-section">
        <div class="container">
            <div class="section-title">
                <span>The Core System</span>
                <h2>Why Students Choose Us</h2>
            </div>
            <div class="why-grid">
                <div class="why-card">
                    <div class="why-icon"><i class="fa-solid fa-bolt"></i></div>
                    <h3>Smart Study Kits</h3>
                    <p>Highly refined modules engineered to make high-level conceptual retention easier.</p>
                </div>
                <div class="why-card">
                    <div class="why-icon" style="color: #0d9488;"><i class="fa-solid fa-user-tie"></i></div>
                    <h3>Mentorship Sync</h3>
                    <p>Get elite advice directly from ex-IITians and veteran industry professors 1-on-1.</p>
                </div>
                <div class="why-card">
                    <div class="why-icon" style="color: #7c3aed;"><i class="fa-solid fa-laptop-file"></i></div>
                    <h3>Hi-Tech Test Engines</h3>
                    <p>Simulate official computer-based testing conditions directly via our web portal.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="results-section">
        <div class="container">
            <div class="section-title">
                <span>Proven Dominance</span>
                <h2>Our Recent Benchmarks</h2>
            </div>
            <div class="results-grid">
                <div class="result-card">
                    <div class="result-number">99.98%</div>
                    <p>State Board Topper Metrics</p>
                </div>
                <div class="result-card">
                    <div class="result-number">720/720</div>
                    <p>Perfect Score In Medical Exams</p>
                </div>
                <div class="result-card">
                    <div class="result-number">1400+</div>
                    <p>Global Tier-1 Selections</p>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonials-section">
        <div class="container">
            <div class="section-title">
                <span>Testimonials</span>
                <h2>Trusted By Parents & Achievers</h2>
            </div>
            <div class="testimonial-grid">
                <div class="testi-card">
                    <p>"The step-by-step logic clarity provided here helped me secure a high rank without any mental burnout. Best light-speed analytics platform!"</p>
                    <div class="user-info">
                        <div class="user-img">KV</div>
                        <div>
                            <h4>Karan Verma</h4>
                            <p style="color: var(--text-muted); font-size: 0.85rem;">Rank 84 - JEE Advanced</p>
                        </div>
                    </div>
                </div>
                <div class="testi-card">
                    <p>"The dashboard system gives complete daily transparent evaluation updates. Highly recommended for absolute structured board prep."</p>
                    <div class="user-info">
                        <div class="user-img" style="background: linear-gradient(135deg, #38bdf8, #2563eb);">SM</div>
                        <div>
                            <h4>Sanjay Mishra</h4>
                            <p style="color: var(--text-muted); font-size: 0.85rem;">Proud Parent</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-section">
        <div class="container">
            <div class="section-title">
                <span>Reach Us</span>
                <h2>Connect With Our Learning Hub</h2>
            </div>
            <div class="contact-grid">
                <div>
                    <div class="info-box">
                        <div class="info-icon"><i class="fa-solid fa-map-pin"></i></div>
                        <div class="info-details">
                            <h4>Central Institute Zone</h4>
                            <p>Plot 48, Knowledge Square, Tech City, India</p>
                        </div>
                    </div>
                    <div class="info-box">
                        <div class="info-icon"><i class="fa-solid fa-phone-flip"></i></div>
                        <div class="info-details">
                            <h4>Direct Admissions Line</h4>
                            <p>+91 99000 11223 (09:00 AM - 07:00 PM)</p>
                        </div>
                    </div>
                    <div class="info-box">
                        <div class="info-icon"><i class="fa-solid fa-envelope"></i></div>
                        <div class="info-details">
                            <h4>Institutional Communication</h4>
                            <p>hello@eduexcel.edu.in</p>
                        </div>
                    </div>
                </div>
                <div class="map-container">
                    <div style="text-align: center; padding: 30px;">
                        <i class="fa-solid fa-compass" style="font-size: 3.5rem; color: var(--primary); margin-bottom: 15px; animation: elegant-float 4s ease-in-out infinite alternate;"></i>
                        <h4 style="font-family: 'Cabinet Grotesk', sans-serif; font-weight: 800;">Radar System Active</h4>
                        <p style="font-size: 0.85rem; color: var(--text-muted); margin-top: 5px;">[ Embed Google Map Location Link Here ]</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2026 EduExcel Educational Ecosystem. Architected with Premium Luxury UI Standards.</p>
        </div>
    </footer>

</body>
</html>