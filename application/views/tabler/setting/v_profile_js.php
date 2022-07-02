<script>
  $('#form-update-data').submit(function(e) {
    e.preventDefault();
    $('#modal-konfirmasi').modal('show')
  });

  $('#btn-batal').on('click', function(e) {
    e.preventDefault();
    $('#modal-konfirmasi').modal('hide')
    $('#modal-update').modal('show')


  })

  $('#btn-yes').on('click', function(e) {
    e.preventDefault();

    new_nomor_induk = $('#upd-nomor-induk').val();
    new_nik = $('#upd-nik').val();
    new_nama = $('#upd-nama').val();
    new_alamat = $('#upd-alamat').val();
    new_jabatan = $('#upd-jabatan').val();
    new_j_kelamin = $('#upd-jkelamin').val();
    new_telepon = $('#upd-telepon').val();
    new_email = $('#upd-email').val();

    const files = $('#upd-foto').prop('files')[0];
    const formData = new FormData()
    formData.append('foto', files)
    formData.append('nik', '<?php echo $this->session->userdata('id_user'); ?>')
    formData.append('nomor_induk', new_nomor_induk)
    formData.append('nama', new_nama)
    formData.append('jabatan', new_jabatan)
    formData.append('j_kelamin', new_j_kelamin)
    formData.append('telepon', new_telepon)
    formData.append('alamat', new_alamat)
    formData.append('email', new_email)

    $.ajax({
      url: "<?php echo base_url(); ?>profile/update",
      type: 'post',
      cache: false,
      contentType: false,
      processData: false,
      data: formData,
      dataType: 'json',
      success: function(response) {
        if (response.status == 'nok') {
          //if(response.err_nomor_induk !== "") {$("#new-nomor-induk").addClass("is-invalid"); $("#iv-nomor-induk").html(response.err_nomor_induk)}else{$("#new-nomor-induk").removeClass("is-invalid");$("#iv-nomor-induk").html("")};
          if (response.err_nomor_induk !== "") {
            $("#upd-nomor-induk").addClass("is-invalid");
            $("#iv-upd-nomor-induk").html(response.err_nomor_induk)
          } else {
            $("#upd-nomor-induk").removeClass("is-invalid");
            $("#iv-upd-nomor-induk").html("")
          };
          if (response.err_nama !== "") {
            $("#upd-nama").addClass("is-invalid");
            $("#iv-upd-nama").html(response.err_nama)
          } else {
            $("#upd-nama").removeClass("is-invalid");
            $("#iv-upd-nama").html("")
          };
          if (response.err_jabatan !== "") {
            $("#upd-jabatan").addClass("is-invalid");
            $("#iv-upd-jabatan").html(response.err_kode_cabang)
          } else {
            $("#upd-jabatan").removeClass("is-invalid");
            $("#iv-upd-jabatan").html("")
          };
          if (response.err_telepon !== "") {
            $("#upd-telepon").addClass("is-invalid");
            $("#iv-upd-telepon").html(response.err_kode_cabang)
          } else {
            $("#upd-telepon").removeClass("is-invalid");
            $("#iv-upd-telepon").html("")
          };
          if (response.err_j_kelamin !== "") {
            $("#upd-jkelamin").addClass("is-invalid");
            $("#iv-upd-jkelamin").html(response.err_kode_cabang)
          } else {
            $("#upd-jkelamin").removeClass("is-invalid");
            $("#iv-upd-jkelamin").html("")
          };
          if (response.err_alamat !== "") {
            $("#upd-alamat").addClass("is-invalid");
            $("#iv-upd-alamat").html(response.err_kode_cabang)
          } else {
            $("#upd-alamat").removeClass("is-invalid");
            $("#iv-upd-alamat").html("")
          };
          if (response.err_email !== "") {
            $("#upd-email").addClass("is-invalid");
            $("#iv-upd-email").html(response.err_email)
          } else {
            $("#upd-email").removeClass("is-invalid");
            $("#iv-upd-email").html("")
          };
          if (response.err_foto !== "") {
            $("#upd-foto").addClass("is-invalid");
            $("#iv-upd-foto").html(response.err_foto)
          } else {
            $("#upd-foto").removeClass("is-invalid");
            $("#iv-upd-foto").html("")
          };

          $('#modal-konfirmasi').modal('hide')

        } else {

          $('#modal-konfirmasi').modal('hide')

          createNotification(3, response.info)

          setTimeout(function() {
            $('#modal-success').modal('hide')
          }, 2000);
        }

      }
    });
  })
</script>