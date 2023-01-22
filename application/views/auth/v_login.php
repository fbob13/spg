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
  <title>Login - <?php echo $this->config->item('app_name'); ?></title>
  <!-- CSS files -->

  <link href="<?php echo base_url(); ?>dist/css/tabler.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>dist/css/tabler-flags.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>dist/css/tabler-payments.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>dist/css/tabler-vendors.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>dist/css/demo.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>dist/css/custom.css?v=1.0" rel="stylesheet" />

  <!-- favicon -->
  <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico" />

  <style>
    .fstyle {
      font-family: 'frs' !important;
      font-size: 25pt;
      white-space: nowrap;

    }

    .fsize-25 {
      font-size: 25pt;
    }

    .fsize-30 {
      font-size: 30pt;
    }

    .g20 {
      /* position: absolute;
      top: 60px;
      left: 60px;
      z-index: 99999; */
      margin-left: auto;
      margin-right: auto;
      display: block;
      width: 150px;
    }
  </style>

  <script type="text/javascript">
    console.log('mulai loading')

    //      $("#eloader").addClass("d-none");
    //    $("#econtent").removeClass("d-none");


    window.onload = function() {
      var el = document.getElementById('eloader');
      var el2 = document.getElementById('econtent');
      //el.style.display = 'none';
      el.classList.add("dimmer");
      el2.style.display = 'block';
      console.log('selesai loading')
    };
  </script>

</head>

<body class="d-flex flex-column ">

  <!-- <div class="g20  "><img src="<?php echo base_url(); ?>static/g20-1.png"></div> -->
  <div class="page page-center container-login100" style="background-image: url('<?php echo base_url(); ?>static/bg1.jpg');">

    <div id="eloader" class="">
      <div class="">
        <div class="loader mx-auto">
        </div>
      </div>

    </div>
    <!-- <div class="text-center ms-auto d-none" style="width : 50px"><img src="<?php echo base_url(); ?>static/g20-1.png"></div> -->
    <div id="econtent" class="container-narrow py-md-4 p-sm-0" style="display:none;">

      <div class="text-center mb-2">
        <?php
        $info = $this->session->flashdata('info');
        if (!empty($info)) {
          echo $info;
        }
        ?>
      </div>

      <form class="card card-md bg-transparent border-0 shadow-none" action="<?php echo base_url(); ?>login" method="post" autocomplete="off">

        <div class="card-body">
          <div class="row">

            <div class="row d-flex justify-content-center">

              <div class="col-md-12  ">
                
                <div class="g20"><img src="<?php echo base_url(); ?>static/g20-1.png"></div>
                <h2 class="text-center"> <?php echo $this->config->item('app_name'); ?></h2>
              </div>

            </div>

            <div class="row d-flex justify-content-center">
              <div class="col-md-6">

                <div class="mb-2">
                  <label class="form-label d-none d-md-block d-lg-block">Username</label>
                  <input type="text" class="form-control" placeholder="Username" name="nik" value="">
                </div>
                <div class="mb-2">
                  <label class="form-label d-none d-md-block d-lg-block">
                    Password
                  </label>
                  <div class="input-group input-group-flat">
                    <input type="password" class="form-control" value="" autocomplete="off" id="pass_log_id" name="password" placeholder="Password">
                    <span class="input-group-text bg-white">
                      <a href="#" class="input-group-link toggle-password"><svg xmlns="http://www.w3.org/2000/svg" class="icon ms-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                          <line x1="3" y1="3" x2="21" y2="21" />
                          <path d="M10.584 10.587a2 2 0 0 0 2.828 2.83" />
                          <path d="M9.363 5.365a9.466 9.466 0 0 1 2.637 -.365c4 0 7.333 2.333 10 7c-.778 1.361 -1.612 2.524 -2.503 3.488m-2.14 1.861c-1.631 1.1 -3.415 1.651 -5.357 1.651c-4 0 -7.333 -2.333 -10 -7c1.369 -2.395 2.913 -4.175 4.632 -5.341" />
                        </svg></a>
                    </span>
                  </div>
                  <!-- div class="input-group input-group-flat">
                    <input type="password" class="form-control" placeholder="Password" autocomplete="off" name="password" value="123456">
                  </div -->
                </div>
                <div class="form-footer text-center">
                  <button type="submit" class="btn btn-primary w-100 mb-2">Masuk</button>
                  <a href="<?php echo base_url(); ?>reset">Lupa Password</a>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="align-middle text-center">
                <span class="text-indigo"><?php echo $this->config->item('app_name'); ?></span> | Copyright &copy; <?php $tanggal = time () ;$tahun= date("Y",$tanggal);echo  $tahun; ?>
                <a href="<?php echo base_url(); ?>" class="link-secondary">BPK Perwakilan Papua Barat</a>
                <br>All rights reserved.
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- Libs JS -->
  <script src="<?php echo base_url(); ?>dist/libs/jquery/jquery-3.6.0.min.js"></script>
  <!-- Tabler Core -->
  <script src="<?php echo base_url(); ?>dist/js/tabler.min.js"></script>
  <script src="<?php echo base_url(); ?>dist/js/demo.min.js"></script>

  <script type="text/javascript">
    $("body").on('click', '.toggle-password', function() {
      eyeon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon ms-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="2" /><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" /></svg>'
      eyeoff = '<svg xmlns="http://www.w3.org/2000/svg" class="icon ms-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="3" y1="3" x2="21" y2="21" /><path d="M10.584 10.587a2 2 0 0 0 2.828 2.83" /><path d="M9.363 5.365a9.466 9.466 0 0 1 2.637 -.365c4 0 7.333 2.333 10 7c-.778 1.361 -1.612 2.524 -2.503 3.488m-2.14 1.861c-1.631 1.1 -3.415 1.651 -5.357 1.651c-4 0 -7.333 -2.333 -10 -7c1.369 -2.395 2.913 -4.175 4.632 -5.341" /></svg>'
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $("#pass_log_id");
      if (input.attr("type") === "password") {
        input.attr("type", "text");
        $('.toggle-password').html(eyeon);
      } else {
        input.attr("type", "password");
        $('.toggle-password').html(eyeoff);
      }

    });
  </script>
</body>

</html>