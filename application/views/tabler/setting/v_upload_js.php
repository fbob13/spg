<script type='text/javascript'>
  $(document).ready(function() {

    var datacari = "";

    //Simpan hasil update (form update)
    $('#form-new-user').submit(function(e) {
      e.preventDefault();

      new_nomor_induk = $('#new-nomor-induk').val();
      new_nama = $('#new-nama').val();
      new_alamat = $('#new-alamat').val();
      new_jabatan = $('#new-jabatan').val();
      new_j_kelamin = $('#new-jkelamin').val();
      new_telepon = $('#new-telepon').val();
      new_email = $('#new-email').val();

      const files = $('#new-foto').prop('files')[0];
      const formData = new FormData()
      formData.append('foto', files)
      formData.append('nomor_induk', new_nomor_induk)
      formData.append('nama', new_nama)
      formData.append('jabatan', new_jabatan)
      formData.append('j_kelamin', new_j_kelamin)
      formData.append('telepon', new_telepon)
      formData.append('alamat', new_alamat)
      formData.append('email', new_email)

      $.ajax({
        url: "<?php echo base_url(); ?>master/pegawai_new",
        type: 'post',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        dataType: 'json',
        success: function(response) {
          if (response.status == 'nok') {
            if (response.err_nomor_induk !== "") {
              $("#new-nomor-induk").addClass("is-invalid");
              $("#iv-nomor-induk").html(response.err_nomor_induk)
            } else {
              $("#new-nomor-induk").removeClass("is-invalid");
              $("#iv-nomor-induk").html("")
            };
            if (response.err_nama !== "") {
              $("#new-nama").addClass("is-invalid");
              $("#iv-nama").html(response.err_nama)
            } else {
              $("#new-nama").removeClass("is-invalid");
              $("#iv-nama").html("")
            };
            if (response.err_jabatan !== "") {
              $("#new-jabatan").addClass("is-invalid");
              $("#iv-jabatan").html(response.err_kode_cabang)
            } else {
              $("#new-jabatan").removeClass("is-invalid");
              $("#iv-jabatan").html("")
            };
            if (response.err_telepon !== "") {
              $("#new-telepon").addClass("is-invalid");
              $("#iv-telepon").html(response.err_kode_cabang)
            } else {
              $("#new-telepon").removeClass("is-invalid");
              $("#iv-telepon").html("")
            };
            if (response.err_j_kelamin !== "") {
              $("#new-jkelamin").addClass("is-invalid");
              $("#iv-jkelamin").html(response.err_kode_cabang)
            } else {
              $("#new-jkelamin").removeClass("is-invalid");
              $("#iv-jkelamin").html("")
            };
            if (response.err_alamat !== "") {
              $("#new-alamat").addClass("is-invalid");
              $("#iv-alamat").html(response.err_kode_cabang)
            } else {
              $("#new-alamat").removeClass("is-invalid");
              $("#iv-alamat").html("")
            };
            if (response.err_email !== "") {
              $("#new-email").addClass("is-invalid");
              $("#iv-email").html(response.err_email)
            } else {
              $("#new-email").removeClass("is-invalid");
              $("#iv-email").html("")
            };
            if (response.err_foto !== "") {
              $("#new-foto").addClass("is-invalid");
              $("#iv-foto").html(response.err_foto)
            } else {
              $("#new-foto").removeClass("is-invalid");
              $("#iv-foto").html("")
            };

          } else {
            $('#modal-new').modal('hide')

            $('#modal-success-info').empty();
            $('#modal-success-info').html(response.info);
            $('#modal-success').modal('show')

            setTimeout(function() {
              $('#modal-success').modal('hide')
            }, 2000);

            setTimeout(function() {
              //loadPagination();
              loadPagination(0, '<?php echo $sorting; ?>', '<?php echo $arah; ?>', '<?php echo $cari; ?>');
            }, 2300);
          }

        }
      });
    });



  });
</script>