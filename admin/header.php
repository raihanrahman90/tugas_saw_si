<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<title>Sistem Cerdas SAW</title>
	<link href="../assets/css/app.css" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
  
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.php">
                    <span class="align-middle">AdminKit</span>
                </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>

					<li class=<?php echo ($halaman=="Kriteria"?"sidebar-item active":"sidebar-item") ?>>
						<a class="sidebar-link" href="listKriteria.php">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Kriteria</span>
                        </a>
					</li>

					<li class=<?php echo ($halaman=='Alternatif'?"sidebar-item active":"sidebar-item") ?>>
						<a class="sidebar-link" href="listAlternatif.php">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Alternatif</span>
                        </a>
					</li>
					<li class=<?php echo ($halaman=='Penilaian'?"sidebar-item active":"sidebar-item") ?>>
						<a class="sidebar-link" href="listPenilaian.php">
                            <i class="align-middle" data-feather="star"></i> <span class="align-middle">Penilaian</span>
                        </a>
					</li>

					<li class=<?php echo ($halaman=='Admin'?"sidebar-item active":"sidebar-item") ?>>
						<a class="sidebar-link" href="listAdmin.php">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Admin</span>
                        </a>
					</li>
				</ul>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <span class="text-dark"><?php echo $_SESSION['username']?></span>
                            </a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="changePassword.php">
									<i class="align-middle me-1" data-feather="settings"></i> Change Password
								</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="../action/logout.php">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>
