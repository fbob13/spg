<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta5
* @link https://tabler.io
* Copyright 2018-2022 The Tabler Authors
* Copyright 2018-2022 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title><?php echo $title; ?></title>
  <!-- CSS files -->
  <link href="<?php echo base_url(); ?>dist/css/tabler.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>dist/css/tabler-flags.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>dist/css/tabler-payments.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>dist/css/tabler-vendors.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>dist/css/demo.min.css" rel="stylesheet" />
  <!-- Custom CSS Files -->
  <?php echo $cust_css; ?>
</head>

<body class="">
  <div aria-live="polite" aria-atomic="true" class="position-relative" style="z-index:999999">
    <!-- Position it: -->
    <!-- - `.toast-container` for spacing between toasts -->
    <!-- - `.position-absolute`, `top-0` & `end-0` to position the toasts in the upper right corner -->
    <!-- - `.p-3` to prevent the toasts from sticking to the edge of the container  -->
    <div class="toast-container position-absolute top-0 end-0 p-3" id="t-cont">

    </div>
  </div>
  <div class="wrapper">

    <aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div><img src="<?php echo base_url(); ?>static/g20-1.png"  class="navbar-brand-image" style="display: block; margin-left: auto;margin-right: auto;width: 70px; height:auto;"></div>
        <!-- <h1 class="navbar-brand navbar-brand-autodark"> -->
        
          <a href="<?php echo base_url(); ?>" style="text-align:center; color:floralwhite ">
            SISFO PEMELIHARAAN GEDUNG
          </a>
        <!-- </h1> -->
        <div class="collapse navbar-collapse" id="navbar-menu">
          <ul class="navbar-nav pt-lg-3">
            <li class="nav-item <?php echo $link == 'dashboard' ? 'active ' : ''; ?>">
              <a class="nav-link" href="<?php echo base_url(); ?>">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                  <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <polyline points="5 12 3 12 12 3 21 12 19 12" />
                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                  </svg>
                </span>
                <span class="nav-link-title">
                  Dashboard
                </span>
              </a>
            </li>
            <li class="nav-item dropdown <?php echo $link == 'master' ? 'active ' : ''; ?>">
              <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                  <!-- Download SVG icon from http://tabler-icons.io/i/database -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <ellipse cx="12" cy="6" rx="8" ry="3"></ellipse>
                    <path d="M4 6v6a8 3 0 0 0 16 0v-6" />
                    <path d="M4 12v6a8 3 0 0 0 16 0v-6" />
                  </svg>
                </span>
                <span class="nav-link-title">
                  Data Master
                </span>
              </a>
              <div class="dropdown-menu <?php echo $link == 'master' ? 'show ' : ''; ?>">
                <div class="dropdown-menu-columns">
                  <div class="dropdown-menu-column">
                  <a class="dropdown-item <?php echo $sublink == 'ktegori' ? 'active ' : ''; ?>" href="<?php echo base_url(); ?>master/kategori">
                      Kategori
                    </a>

                    <a class="dropdown-item <?php echo $sublink == 'gedung' ? 'active ' : ''; ?>" href="<?php echo base_url(); ?>master/gedung">
                      Gedung
                    </a>

                    <a class="dropdown-item <?php echo $sublink == 'ruangan' ? 'active ' : ''; ?>" href="<?php echo base_url(); ?>master/ruangan">
                      Ruangan
                    </a>

                    <a class="dropdown-item <?php echo $sublink == 'item' ? 'active ' : ''; ?>" href="<?php echo base_url(); ?>master/item">
                      Item
                    </a>

                    <a class="dropdown-item <?php echo $sublink == 'ruangan_item' ? 'active ' : ''; ?>" href="<?php echo base_url(); ?>master/ruangan-item">
                      Ruangan Item
                    </a>

                    <a class="dropdown-item <?php echo $sublink == 'prutin' ? 'active ' : ''; ?>" href="<?php echo base_url(); ?>master/prutin">
                      Pekerjaan Rutin
                    </a>
                  </div>
                </div>
              </div>
            </li>
            <li class="nav-item dropdown <?php echo $link == 'rutin' ? 'active ' : ''; ?>">
              <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                  <!-- Download SVG icon from http://tabler-icons.io/i/list-details -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M13 5h8" />
                    <path d="M13 9h5" />
                    <path d="M13 15h8" />
                    <path d="M13 19h5" />
                    <rect x="3" y="4" width="6" height="6" rx="1" />
                    <rect x="3" y="14" width="6" height="6" rx="1" />
                  </svg>
                </span>
                <span class="nav-link-title">
                  Jadwal Rutin
                </span>
              </a>
              <div class="dropdown-menu <?php echo $link == 'rutin' ? 'show ' : ''; ?>">
                <div class="dropdown-menu-columns">
                  <div class="dropdown-menu-column">

                    <a class="dropdown-item <?php echo $sublink == 'input_jadwal' ? 'active ' : ''; ?>" href="<?php echo base_url(); ?>jadwal/rutin/new">
                      Input Jadwal Rutin
                    </a>

                    <a class="dropdown-item <?php echo $sublink == 'lihat_jadwal' ? 'active ' : ''; ?>" href="<?php echo base_url(); ?>jadwal/rutin/view">
                      Lihat Jadwal Rutin
                    </a>
                  </div>
                </div>
              </div>
            </li>
            <li class="nav-item dropdown <?php echo $link == 'nrutin' ? 'active ' : ''; ?>">
              <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                  <!-- Download SVG icon from http://tabler-icons.io/i/tool -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M7 10h3v-3l-3.5 -3.5a6 6 0 0 1 8 8l6 6a2 2 0 0 1 -3 3l-6 -6a6 6 0 0 1 -8 -8l3.5 3.5" />
                  </svg>
                </span>
                <span class="nav-link-title">
                  Perbaikan
                </span>
              </a>
              <div class="dropdown-menu <?php echo $link == 'nrutin' ? 'show ' : ''; ?>">
                <div class="dropdown-menu-columns">
                  <div class="dropdown-menu-column">

                    <a class="dropdown-item <?php echo $sublink == 'kerusakan' ? 'active ' : ''; ?>" href="<?php echo base_url(); ?>kerusakan/new">
                      Permintaan Perbaikan
                    </a>

                    <a class="dropdown-item <?php echo $sublink == 'update_kerusakan' ? 'active ' : ''; ?>" href="<?php echo base_url(); ?>kerusakan/view">
                      Status Perbaikan
                    </a>

                  </div>
                </div>
              </div>
            </li>
            <li class="nav-item dropdown <?php echo $link == 'admin' ? 'active ' : ''; ?>">
              <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                  <!-- Download SVG icon from http://tabler-icons.io/i/users -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <circle cx="9" cy="7" r="4" />
                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                  </svg>
                </span>
                <span class="nav-link-title">
                Admin
                </span>
              </a>
              <div class="dropdown-menu <?php echo $link == 'admin' ? 'show ' : ''; ?>">
                <div class="dropdown-menu-columns">
                  <div class="dropdown-menu-column">

                    <a class="dropdown-item <?php echo $sublink == 'user' ? 'active ' : ''; ?>" href="<?php echo base_url(); ?>admin/user">
                      Kelola User
                    </a>

                    <a class="dropdown-item <?php echo $sublink == 'akses' ? 'active ' : ''; ?>" href="<?php echo base_url(); ?>admin/akses">
                      Hak Akses
                    </a>

                  </div>
                </div>
              </div>
            </li>
            <li class="nav-item <?php echo $link == 'report' ? 'active ' : ''; ?>">
              <a class="nav-link" href="<?php echo base_url(); ?>#">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                  <!-- Download SVG icon from http://tabler-icons.io/i/report-analytics -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                    <rect x="9" y="3" width="6" height="4" rx="2" />
                    <path d="M9 17v-5" />
                    <path d="M12 17v-1" />
                    <path d="M15 17v-3" />
                  </svg>
                </span>
                <span class="nav-link-title">
                  Report
                </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url(); ?>logout">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                  <!-- Download SVG icon from http://tabler-icons.io/i/logout -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                    <path d="M7 12h14l-3 -3m0 6l3 -3" />
                  </svg>
                </span>
                <span class="nav-link-title">
                  Logout
                </span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </aside>
    <header class="navbar navbar-expand-md navbar-light   d-lg-flex d-print-none">
      <div class="container-fluid">
        <div class="navbar-nav flex-row order-last">

        <?php /*
          <a id="icon-booked" href="<?php echo base_url(); ?>dokumen/keluar/booked" class="nav-link text-mute pe-0" title="Booked" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Booked">
            <!-- Download SVG icon from http://tabler-icons.io/i/file-search -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M14 3v4a1 1 0 0 0 1 1h4" />
              <path d="M12 21h-5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v4.5" />
              <circle cx="16.5" cy="17.5" r="2.5" />
              <line x1="18.5" y1="19.5" x2="21" y2="22" />
            </svg>

          </a>
          <span class="badge badge-pill bg-mute" id="badge-booked">0</span>

          <a id="icon-ready" href="<?php echo base_url(); ?>dokumen/keluar/ready" class="nav-link text-mute pe-0" title="Ready" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Ready">
            <!-- Download SVG icon from http://tabler-icons.io/i/file-like -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <rect x="3" y="16" width="3" height="5" rx="1" />
              <path d="M6 20a1 1 0 0 0 1 1h3.756a1 1 0 0 0 .958 -.713l1.2 -3c.09 -.303 .133 -.63 -.056 -.884c-.188 -.254 -.542 -.403 -.858 -.403h-2v-2.467a1.1 1.1 0 0 0 -2.015 -.61l-1.985 3.077v4z" />
              <path d="M14 3v4a1 1 0 0 0 1 1h4" />
              <path d="M5 12.1v-7.1a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-2.3" />
            </svg>

          </a>
          <span class="badge badge-pill bg-mute" id="badge-ready">0</span>
          */
          ?>
          <div class="nav-item dropdown ps-2">

            <a href="#" class="nav-link d-flex lh-1 text-reset p-0 ps-2" data-bs-toggle="dropdown" aria-label="Open user menu">
              <span class="avatar avatar-sm" style="background-image: url(<?php echo base_url(); ?>static/foto/<?php echo $this->session->userdata('avatar'); ?>)"></span>
              <div class="d-none d-md-block d-xl-block ps-2">
                <div><?php echo $this->session->userdata('nama'); ?></div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
              <a href="<?php echo base_url(); ?>profile" class="dropdown-item">Edit Profile</a>
              <a href="<?php echo base_url(); ?>gpass" class="dropdown-item">Ganti Password</a>
              <div class="dropdown-divider"></div>
              <a href="<?php echo base_url(); ?>logout" class="dropdown-item">Logout</a>
            </div>
          </div>
        </div>
        <div class="nav-item dropdown">

        </div>
      </div>
    </header>
    <div class="page-wrapper">