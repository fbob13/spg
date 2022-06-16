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
  <link href="<?php echo base_url(); ?>dist/css/custom.css" rel="stylesheet" />

</head>

<body class="d-flex flex-column ">
  <div class="page page-center container-login100" style="background-image: url('static/bg1.jpg');">
    <div class="container-narrow py-4 ">

      <div class="text-center mb-2">
        <?php
        $info = $this->session->flashdata('info');
        if (!empty($info)) {
          echo $info;
        }
        ?>
      </div>
      <form class="card card-md bg-transparent border-0 shadow-none" id="form-reset">

        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <h1 class="text-center mb-2">Reset Password Aplikasi E-Warkah</h2>
            </div>
            <div class="col-md-12 mt-3">

              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="Alamat Email" id="res-email" value="" required>
              </div>
              <div class="form-footer text-center">
                <button id="submit-button" type="submit" class="btn btn-primary w-100 mb-2">Reset Password</button>
                <a href="<?php echo base_url(); ?>">Kembali</a>
              </div>
            </div>
            <div class="col-12 mt-3">
              <div class="align-middle text-center">
                Copyright &copy; 2022
                <a href="<?php echo base_url(); ?>" class="link-secondary">BPN Kota Palopo</a>.
                All rights reserved.
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- MODAL SUCCESS green-->
  <div class="modal modal-blur fade" id="modal-success" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-status bg-success"></div>
        <div class="modal-body text-center py-4">
          <!-- Download SVG icon from http://tabler-icons.io/i/circle-check -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-success icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <circle cx="12" cy="12" r="9" />
            <path d="M9 12l2 2l4 -4" />
          </svg>
          <h3>Selamat</h3>
          <div class="text-muted" id="modal-success-info">...</div>
        </div>
        <div class="modal-footer">
          <div class="w-100">
            <div class="row">
              <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                  Tutup
                </a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL SUCCESS red-->
  <div class="modal modal-blur fade" id="modal-danger" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-status bg-danger"></div>
        <div class="modal-body text-center py-4">
          <!-- Download SVG icon from http://tabler-icons.io/i/circle-x -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <circle cx="12" cy="12" r="9" />
            <path d="M10 10l4 4m0 -4l-4 4" />
          </svg>
          <h3>Perhatian</h3>
          <div class="text-muted" id="modal-danger-info">...</div>
        </div>
        <div class="modal-footer">
          <div class="w-100">
            <div class="row">
              <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                  Tutup
                </a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Libs JS -->
  <script src="<?php echo base_url(); ?>dist/libs/jquery/jquery-3.6.0.min.js"></script>
  <!-- Tabler Core -->
  <script src="<?php echo base_url(); ?>dist/js/tabler.min.js"></script>
  <script src="<?php echo base_url(); ?>dist/js/demo.min.js"></script>
  <script>
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
  <script type='text/javascript'>
    $('#form-reset').submit(function(e) {
      e.preventDefault();

      email = $('#res-email').val();
      //new_nama_kecamatan = $('#upd-nama-kecamatan').val();
      $('#submit-button').html('<span id="loading-status" class="spinner-border me-2" role="status"></span>Mereset Password')

      $.ajax({
        url: "<?php echo base_url(); ?>reset_send",
        type: 'post',
        data: {
          'email': email
        },
        dataType: 'json',
        success: function(response) {
          $('#submit-button').html('Reset Password')
          if (response.status == 'nok') {

            //if(response.kode_kategori !== "") {$("#new-kode-kategori").addClass("is-invalid"); $("#iv-kode-kategori").html(response.err_nomor_induk)}else{$("#new-kode-kategori").removeClass("is-invalid");$("#iv-kode-kategori").html("")};
            //if(response.err_nama_kategori !== "") {$("#upd-nama-kategori").addClass("is-invalid"); $("#iv-upd-nama-kategori").html(response.err_nama_kategori)}else{$("#upd-nama-kategori").removeClass("is-invalid");$("#iv-upd-nama-kategori").html("")};
            //if(response.err_nama_kecamatan !== "") {$("#upd-nama-kecamatan").addClass("is-invalid"); $("#iv-upd-nama-kecamatan").html(response.err_nama_kecamatan)}else{$("#upd-nama-kecamatan").removeClass("is-invalid");$("#iv-upd-nama-kecamatan").html("")};
            $('#modal-danger-info').empty();
            $('#modal-danger-info').html(response.info);   
            $('#modal-danger').modal('show') 

          } else {
            $('#modal-success-info').empty();
            $('#modal-success-info').html(response.info);   
            $('#modal-success').modal('show') 
          }

        }
      });
    });
  </script>
</body>

</html>