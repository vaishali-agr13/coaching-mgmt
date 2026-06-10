<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Coaching Management System</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            min-height: 100vh;
            padding: 20px 0;
            position: fixed;
            width: 250px;
            left: 0;
            top: 0;
            overflow-y: auto;
        }

        .sidebar .logo {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 20px;
        }

        .sidebar .logo h3 {
            margin: 0;
            font-size: 1.5rem;
        }

        .sidebar .nav-menu {
            list-style: none;
        }

        .sidebar .nav-menu li {
            margin: 0;
        }

        .sidebar .nav-menu a {
            color: rgba(255, 255, 255, 0.8);
            padding: 15px 20px;
            display: block;
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .sidebar .nav-menu a:hover,
        .sidebar .nav-menu a.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
            border-left-color: white;
        }

        .sidebar .nav-menu i {
            margin-right: 10px;
            width: 20px;
        }

        .main-content {
            margin-left: 250px;
            min-height: 100vh;
        }

        .topbar {
            background-color: white;
            padding: 15px 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar .user-profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .topbar .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .topbar .dropdown-menu {
            right: 0;
            left: auto;
        }

        .content {
            padding: 30px;
        }

        .card {
            border: none;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            border-radius: 0.35rem;
        }

        .btn-logout {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-logout:hover {
            background-color: #c82333;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                min-height: auto;
                margin-bottom: 20px;
            }

            .main-content {
                margin-left: 0;
            }

            .content {
                padding: 15px;
            }
        }
    </style>

    @yield('styles')
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <h3>🎓 CMS</h3>
                <small>Admin Panel</small>
            </div>

            <ul class="nav-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="@if(Route::currentRouteName() === 'admin.dashboard') active @endif">
                        <i class="fas fa-chart-line"></i> Dashboard
                    </a>
                </li>

                <li>
                    <a href="/admin/users">
                        <i class="fas fa-users"></i> Users
                    </a>
                </li>

                <li>
                    <a href="/admin/faculty">
                        <i class="fas fa-chalkboard-user"></i> Faculty
                    </a>
                </li>

                <li>
                    <a href="/admin/students">
                        <i class="fas fa-users"></i> Students
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.courses.index') }}">
                       <i class="fas fa-chalkboard-user"></i> Course 
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.fees.index') }}">
                       <i class="fas fa-chalkboard-user"></i> Fee 
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('admin.attendance.create') }}">
                       <i class="fas fa-chalkboard-user"></i> Mark Attendance
                    </a>
                </li>
                

                
                <!-- <li>
                    <a href="#">
                        <i class="fas fa-book"></i> Courses
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-clipboard-list"></i> Admissions
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-calendar-check"></i> Attendance
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-credit-card"></i> Fees
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-exam"></i> Exams
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-file-pdf"></i> Study Material
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-tasks"></i> Homework
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-blog"></i> Blog
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-images"></i> Gallery
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-chart-bar"></i> Reports
                    </a>
                </li> -->
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content w-100">
            <!-- Top Bar -->
            <div class="topbar">
                <h2>@yield('title')</h2>

                <div class="user-profile">
                    <span>{{ Auth::user()->name ?? 'Admin' }}</span>
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'Admin' }}&background=667eea&color=fff" alt="User">
                    
                    <div class="dropdown">
                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-cog"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item" style="background: none; border: none; cursor: pointer;">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @yield('scripts')
</body>
</html>