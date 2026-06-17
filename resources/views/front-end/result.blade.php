<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Student Result</title>

<link rel="stylesheet" href="result.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>


<header>

<div class="logo">

NavSkills

</div>

<nav>

<a href="/">Home</a>

<a href="/courses">Courses</a>

<a href="/faculty">Faculty</a>

<a href="#" class="active">Results</a>

<a href="/contact">Contact</a>

</nav>

<button>Sign In</button>

</header>


<section class="breadcrumb">

Home / Results

</section>


<section class="hero">

<div>

<h1>

Academic Results

</h1>

<p>

Track your performance and monitor your learning journey.

</p>

<button>

View Performance

</button>

</div>

<img src="https://picsum.photos/400/350">

</section>


<section class="search">

<input type="text"

placeholder="Enter Enrollment Number">

<button>

Search Result

</button>

</section>


<section class="student-card">

<img src="https://picsum.photos/200/200">

<div>

<h2>

Vaishali Agrawal

</h2>

<p>

Enrollment : NAV2026001

</p>

<p>

Course : Laravel Full Stack

</p>

<p>

Batch : 2026

</p>

</div>

</section>


<section class="summary">

<div>

<h2>89%</h2>

<p>Overall Percentage</p>

</div>

<div>

<h2>A+</h2>

<p>Grade</p>

</div>

<div>

<h2>1</h2>

<p>Rank</p>

</div>

<div>

<h2>95%</h2>

<p>Attendance</p>

</div>

</section>


<section class="semester">

<h2>Semester Results</h2>

<div class="semester-grid">

<div>

<h3>Semester 1</h3>

<p>88%</p>

</div>

<div>

<h3>Semester 2</h3>

<p>90%</p>

</div>

<div>

<h3>Semester 3</h3>

<p>89%</p>

</div>

</div>

</section>


<section class="subject-result">

<h2>Subject Wise Result</h2>

<table>

<tr>

<th>Subject</th>

<th>Marks</th>

<th>Grade</th>

<th>Status</th>

</tr>

<tr>

<td>HTML CSS</td>

<td>95</td>

<td>A+</td>

<td>Pass</td>

</tr>

<tr>

<td>JavaScript</td>

<td>92</td>

<td>A+</td>

<td>Pass</td>

</tr>

<tr>

<td>Laravel</td>

<td>88</td>

<td>A</td>

<td>Pass</td>

</tr>

<tr>

<td>Database</td>

<td>84</td>

<td>A</td>

<td>Pass</td>

</tr>

</table>

</section>


<section class="chart">

<h2>Performance Progress</h2>

<div class="bar">

<div class="fill html">

95%

</div>

</div>

<div class="bar">

<div class="fill js">

92%

</div>

</div>

<div class="bar">

<div class="fill laravel">

88%

</div>

</div>

</section>


<section class="achievement">

<h2>Achievements</h2>

<div class="ach-grid">

<div>

🏆 Top Performer

</div>

<div>

⭐ Best Attendance

</div>

<div>

🎓 Course Completion

</div>

</div>

</section>


<section class="download">

<button>

<i class="fa-solid fa-download"></i>

Download Result PDF

</button>

</section>


<section class="faq">

<h2>FAQ</h2>

<div>

<h3>

Can I download my result?

</h3>

<p>

Yes.

</p>

</div>

<div>

<h3>

Can I view previous results?

</h3>

<p>

Yes.

</p>

</div>

</section>


<section class="cta">

<h1>

Keep Learning Keep Growing

</h1>

<p>

Track your progress every day.

</p>

<button>

Explore More

</button>

</section>


<footer>

© 2026 NavSkills | All Rights Reserved

</footer>


</body>

</html>

<style>
    *{

margin:0;

padding:0;

box-sizing:border-box;

font-family:'Poppins',sans-serif;

}

body{

background:#fff;

}

header{

padding:20px 80px;

display:flex;

justify-content:space-between;

align-items:center;

}

.logo{

font-size:28px;

font-weight:700;

}

nav a{

margin:0 15px;

text-decoration:none;

color:#333;

}

.active{

color:#d46df7;

}

header button{

padding:10px 25px;

border:none;

border-radius:25px;

background:linear-gradient(90deg,#bb65ff,#ff88ca);

color:#fff;

cursor:pointer;

}

.breadcrumb{

padding:20px 80px;

background:#faf5ff;

}

.hero{

height:450px;

display:flex;

justify-content:space-between;

align-items:center;

padding:80px;

background:linear-gradient(90deg,#c36eff,#ff91cb);

color:#fff;

}

.hero h1{

font-size:50px;

margin-bottom:20px;

}

.hero button{

margin-top:20px;

padding:14px 30px;

border:none;

border-radius:30px;

background:#fff;

color:#d46df7;

cursor:pointer;

}

.hero img{

height:320px;

border-radius:20px;

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

background:#d46df7;

color:#fff;

}

.student-card{

width:80%;

margin:auto;

padding:40px;

display:flex;

gap:30px;

align-items:center;

border-radius:25px;

box-shadow:0 10px 25px rgba(0,0,0,.08);

}

.student-card img{

width:150px;

height:150px;

border-radius:50%;

}

.summary{

padding:80px;

display:grid;

grid-template-columns:repeat(4,1fr);

gap:30px;

}

.summary div{

padding:40px;

text-align:center;

border-radius:25px;

box-shadow:0 10px 25px rgba(0,0,0,.08);

}

.summary h2{

font-size:45px;

color:#d46df7;

}

.semester{

padding:80px;

background:#faf5ff;

}

.semester-grid{

display:grid;

grid-template-columns:repeat(3,1fr);

gap:30px;

margin-top:30px;

}

.semester-grid div{

padding:40px;

text-align:center;

background:#fff;

border-radius:25px;

}

.subject-result{

padding:80px;

}

table{

width:100%;

border-collapse:collapse;

}

th,td{

padding:20px;

text-align:center;

}

th{

background:#d46df7;

color:#fff;

}

tr:nth-child(even){

background:#faf5ff;

}

.chart{

padding:80px;

}

.bar{

height:30px;

background:#eee;

border-radius:30px;

margin:25px 0;

overflow:hidden;

}

.fill{

height:100%;

display:flex;

align-items:center;

justify-content:center;

color:#fff;

}

.html{

width:95%;

background:#d46df7;

}

.js{

width:92%;

background:#ff91cb;

}

.laravel{

width:88%;

background:#c36eff;

}

.achievement{

padding:80px;

background:#faf5ff;

}

.ach-grid{

display:grid;

grid-template-columns:repeat(3,1fr);

gap:30px;

margin-top:30px;

}

.ach-grid div{

padding:40px;

text-align:center;

background:#fff;

border-radius:25px;

}

.download{

padding:60px;

text-align:center;

}

.download button{

padding:16px 35px;

border:none;

border-radius:30px;

background:linear-gradient(90deg,#bb65ff,#ff88ca);

color:#fff;

cursor:pointer;

}

.faq{

padding:80px;

}

.faq div{

margin:20px 0;

padding:30px;

background:#faf5ff;

border-radius:20px;

}

.cta{

padding:100px;

text-align:center;

background:linear-gradient(90deg,#c36eff,#ff91cb);

color:#fff;

}

.cta button{

margin-top:25px;

padding:15px 35px;

border:none;

border-radius:30px;

background:#fff;

color:#d46df7;

cursor:pointer;

}

footer{

padding:40px;

text-align:center;

}

@media(max-width:768px){

.hero{

flex-direction:column;

height:auto;

padding:40px;

}

.student-card{

flex-direction:column;

}

.summary,

.semester-grid,

.ach-grid{

grid-template-columns:1fr;

}

.search{

flex-direction:column;

}

.search input{

width:100%;

}

}
    </style>