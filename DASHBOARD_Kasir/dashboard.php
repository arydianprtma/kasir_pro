<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard-Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar collapse active">
                <div class="sidebar-header">
                    <h3>Kasir Oke<?php echo isset($_SESSION['role']) ? htmlspecialchars($_SESSION['role']) . ' Panel' : 'User Panel'; ?></h3>
                </div>
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="bi bi-house-door-fill"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard-admin.html">
                                <i class="bi bi-shield-shaded"></i> Dashboard Admin
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="absensi.html">
                                <i class="bi bi-calendar-check-fill"></i> Absensi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="tambah-anggota.html">
                                <i class="bi bi-person-plus-fill"></i> Tambah Anggota
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="kasir.html">
                                <i class="bi bi-cash-stack"></i> Kasir
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="gudang.html">
                                <i class="bi bi-building"></i> Gudang
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="laporan-keuangan.html">
                                <i class="bi bi-graph-up"></i> Laporan Keuangan
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link" href="logout.html">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>


            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="main-header d-flex justify-content-between align-items-center">
                    <h1 class="main-title">Dashboard</h1>
                    <button class="btn sidebar-toggle d-md-none">
                        <i class="bi bi-list"></i>
                    </button>
                </div>

                <!-- Informasi Login -->
                <div class="alert alert-info" role="alert">
                    Anda Sedang Masuk Sebagai <strong><?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest'; ?></strong> | <strong><?php echo isset($_SESSION['role']) ? htmlspecialchars($_SESSION['role']) : 'Unknown'; ?></strong>
                </div>

                <div>
                    <h2 class="main-title">Selamat Datang</h2>
                    <p class="main-description">Berikut adalah sistem unggulan dari website kami.</p>
                </div>

                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card dashboard-card bg-primary text-white">
                            <div class="card-body">
                                <i class="bi bi-calendar-check-fill mb-3" style="font-size: 2rem;"></i>
                                <h5 class="card-title">Absensi</h5>
                                <p class="card-text">Cek dan update data absensi karyawan secara real-time.</p>
                                <a href="absensi.html" class="btn btn-light btn-card">Lihat Absensi</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card dashboard-card bg-success text-white">
                            <div class="card-body">
                                <i class="bi bi-person-plus-fill mb-3" style="font-size: 2rem;"></i>
                                <h5 class="card-title">Tambah Anggota</h5>
                                <p class="card-text">Tambahkan anggota baru ke dalam sistem dengan mudah.</p>
                                <a href="tambah-anggota.html" class="btn btn-light btn-card">Tambah Sekarang</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card dashboard-card bg-warning text-white">
                            <div class="card-body">
                                <i class="bi bi-building mb-3" style="font-size: 2rem;"></i>
                                <h5 class="card-title">Gudang</h5>
                                <p class="card-text">Kelola dan monitor stok barang di gudang sistem.</p>
                                <a href="gudang.html" class="btn btn-light btn-card">Lihat Stok</a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar on mobile
        document.querySelector('.sidebar-toggle')?.addEventListener('click', () => {
            document.querySelector('#sidebar').classList.toggle('active');
        });
    </script>
</body>
</html>
