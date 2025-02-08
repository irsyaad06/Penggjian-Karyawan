<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Penggajian')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>

        body {
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
            background-color: #f8f9fa;
        }


        .sidebar {
            width: 250px;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 15px;
            background-color:  #12052a;
            transition: all 0.3s ease-in-out;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
        }


        .logo-container {
            text-align: center;
            margin-bottom: 15px;

        }


        .logo-container img {
            width: 120px;
            display: block;
            margin: 0 auto;
        }


        .sidebar ul {
            list-style: none;
            padding: 0;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-top: 10px;
        }


        .sidebar ul li {
            width: 100%;
        }

        .sidebar ul li a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            text-decoration: none;
            color: white;
            font-size: 16px;
            transition: background 0.3s ease;
        }

        .sidebar ul li a:hover {
            background-color: #495057;
        }
        .sidebar ul li a i {
            margin-right: 10px;
            font-size: 18px;
        }
        .logout-form {
            margin-top: auto;
            width: 100%;
            padding: 20px;
        }

        .logout-btn {
            width: 100%;
            padding: 12px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease;
        }

        .logout-btn i {
            margin-right: 8px;
        }


        .logout-btn:hover {
            background-color: #c82333;
        }


        .content {
            margin-left: 250px;
            width: 100%;
            padding: 20px;
            transition: all 0.3s ease-in-out;
        }


        .sidebar-hidden {
            width: 0;
            padding: 0;
            overflow: hidden;
        }


        .content-expanded {
            margin-left: 0;
        }


        .toggle-btn {
            position: absolute;
            top: 20px;
            left: 225px;
            background: #343a40;
            color: white;
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            z-index: 10000;
        }

        .toggle-btn:hover {
            background: #495057;
        }

        .sidebar-hidden+.toggle-btn {
            left: 10px;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="logo-container">
            <img src="{{ asset('logo.webp') }}" alt="SIGAWAi Logo">
        </div>

        <ul>
            <li><a href="{{ route('karyawan.index') }}"><i class="fas fa-users"></i> Karyawan</a></li>
            <li><a href="{{ route('jabatan.index') }}"><i class="fas fa-briefcase"></i> Jabatan</a></li>
            <li><a href="{{ route('slip-gaji.index') }}"><i class="fas fa-file-invoice-dollar"></i> Slip Gaji</a></li>
            <li><a href="{{ route('laporan-gaji.index') }}"><i class="fas fa-chart-line"></i> Laporan Gaji</a></li>
        </ul>

        <!-- Tombol Logout -->
        <form class="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </form>
    </div>


    <button class="toggle-btn" id="toggleSidebar">
        <i class="fas fa-bars"></i>
    </button>


    <div class="content" id="content">
        <div class="container mt-4">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            let sidebar = document.querySelector('.sidebar');
            let content = document.querySelector('.content');
            let button = document.getElementById('toggleSidebar');

            if (sidebar.classList.contains('sidebar-hidden')) {
                sidebar.classList.remove('sidebar-hidden');
                content.classList.remove('content-expanded');
                button.style.left = '225px';
            } else {
                sidebar.classList.add('sidebar-hidden');
                content.classList.add('content-expanded');
                button.style.left = '10px';
            }
        });
    </script>

</body>

</html>