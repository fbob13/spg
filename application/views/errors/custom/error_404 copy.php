<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin - Login</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url();?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url();?>assets/css/sb-admin.css" rel="stylesheet">

  <script type="text/javascript">

            function cekform()

            {

                if(!$("#inputNik").val())

                {

                    alert('Maaf NIK Tidak Boleh Kosong');

                    $("#inputNik").focus();

                    return false;

                }

                if(!$("#inputPassword").val())

                {

                    alert('Maaf Password Tidak Boleh Kosong');

                    $("#inputPassword").focus();

                    return false;

                }

            }



        </script>  

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">

      <div class="card-header text-center"><h3>Aplikasi OAP</h3></div>
      <img class="card-img-top mx-auto mt-3" src="<?php echo base_url();?>assets/img/logo300.png" style="width: 250px;">
      <div class="card-body">
          
        <div class="text-center">
          <h1 class="text-danger"> Halaman Tidak di Temukan </h1>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url();?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url();?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
