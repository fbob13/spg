<script>
  $(document).ready(function() {


    //Simpan Data Dokumen
    $('#form-profile-kantor').submit(function(e) {
      e.preventDefault();


      $.ajax({
        url: '<?php echo base_url(); ?>setting/kprofiles',
        type: 'post',
        data: {
          'kop1' : $('#sel-kop1').val(),
          'kop2' : $('#sel-kop2').val(),
          'kop3' : $('#sel-kop3').val(),
          'kop4' : $('#sel-kop4').val(),
          'alamat' : $('#sel-alamat').val(),
          'kodepos' : $('#sel-kodepos').val(),
          'email' : $('#sel-email').val(),
          'telp' : $('#sel-telp').val(),
        },
        dataType: 'json',
        success: function(response) {
          if (response.status == 'nok') {


            if (response.err_kop1 !== "") {
              $("#sel-kop1").addClass("is-invalid");
              $("#iv-sel-kop1").html(response.err_kop1)
            } else {
              $("#sel-kop1").removeClass("is-invalid");
              $("#iv-sel-kop1").html("")
            };
            if (response.err_kop2 !== "") {
              $("#sel-kop2").addClass("is-invalid");
              $("#iv-sel-kop2").html(response.err_kop2)
            } else {
              $("#sel-kop2").removeClass("is-invalid");
              $("#iv-sel-kop2").html("")
            };
            if (response.err_kop3 !== "") {
              $("#sel-kop3").addClass("is-invalid");
              $("#iv-sel-kop3").html(response.err_kop3)
            } else {
              $("#sel-kop3").removeClass("is-invalid");
              $("#iv-sel-kop3").html("")
            };
            if (response.err_kop4 !== "") {
              $("#sel-kop4").addClass("is-invalid");
              $("#iv-sel-kop4").html(response.err_kop4)
            } else {
              $("#sel-kop4").removeClass("is-invalid");
              $("#iv-sel-kop4").html("")
            };
            if (response.err_alamat !== "") {
              $("#sel-alamat").addClass("is-invalid");
              $("#iv-sel-alamat").html(response.err_alamat)
            } else {
              $("#sel-alamat").removeClass("is-invalid");
              $("#iv-sel-alamat").html("")
            };
            if (response.err_kodepos !== "") {
              $("#sel-kodepos").addClass("is-invalid");
              $("#iv-sel-kodepos").html(response.err_kodepos)
            } else {
              $("#sel-kodepos").removeClass("is-invalid");
              $("#iv-sel-kodepos").html("")
            };
            if (response.err_email !== "") {
              $("#sel-email").addClass("is-invalid");
              $("#iv-sel-email").html(response.err_email)
            } else {
              $("#sel-email").removeClass("is-invalid");
              $("#iv-sel-email").html("")
            };
            if (response.err_telp !== "") {
              $("#sel-telp").addClass("is-invalid");
              $("#iv-sel-telp").html(response.err_telp)
            } else {
              $("#sel-telp").removeClass("is-invalid");
              $("#iv-sel-telp").html("")
            };
            
          } else {

            $('#modal-success-info').empty();
            $('#modal-success-info').html(response.info);
            $('#modal-success').modal('show')

            setTimeout(function() {
              $('#modal-success').modal('hide')
            }, 2000);

            $('#sel-kop1').val(response.result.kop1);
            $('#sel-kop2').val(response.result.kop2);
            $('#sel-kop3').val(response.result.kop3);
            $('#sel-kop4').val(response.result.kop4);
            $('#sel-alamat').val(response.result.alamat);
            $('#sel-kodepos').val(response.result.kode_pos);
            $('#sel-email').val(response.result.email);

            $('#sel-kop1').removeClass("is-invalid")
            $('#sel-kop2').removeClass("is-invalid")
            $('#sel-kop3').removeClass("is-invalid");
            $('#sel-kop4').removeClass("is-invalid");
            $('#sel-alamat').removeClass("is-invalid");
            $('#sel-kodepos').removeClass("is-invalid");
            $('#sel-email').removeClass("is-invalid");

          }
        }
      });
    });

    //update user
    $('#form-upload-dokumen').submit(function(e) {
      e.preventDefault();

      const files = $('#upload-file').prop('files')[0];
      const formData = new FormData()
      formData.append('dokumen', files)

      $.ajax({
        url: "<?php echo base_url(); ?>dokumen/upload",
        type: 'post',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        dataType: 'json',
        success: function(response) {
          if (response.status == 'nok') {
            //if(response.err_nomor_induk !== "") {$("#new-nomor-induk").addClass("is-invalid"); $("#iv-nomor-induk").html(response.err_nomor_induk)}else{$("#new-nomor-induk").removeClass("is-invalid");$("#iv-nomor-induk").html("")};
            if (response.err_file !== "") {
              $("#upload-file").addClass("is-invalid");
              $("#iv-upload-file").html(response.err_file)
            }

          } else {
            $('#modal-update').modal('hide')

            $('#modal-success-info').empty();
            $('#modal-success-info').html(response.info);
            $('#modal-success').modal('show')

            setTimeout(function() {
              $('#modal-success').modal('hide')
            }, 2000);

          }

        }
      });
    });


  });
</script>