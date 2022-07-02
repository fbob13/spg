<script>
  $(document).ready(function() {



    function create_option(datalist) {

      hasil = '<option value=""></option>'
      for (index in datalist) {
        qid_item = datalist[index].val;
        qdeskripsi = datalist[index].deskripsi;
        hasil += '<option value="' + qid_item + '">' + qdeskripsi + '</option>'
      }
      return hasil
    }

    function cek_error(err_result, id) {
      if (err_result !== "") {
        $("#" + id).addClass("is-invalid");
        $("#er-" + id).html(err_result)
      } else {
        $("#" + id).removeClass("is-invalid");
        $("#er-" + id).html("")
      };
    }


    $('#form-new').submit(function(e) {
      e.preventDefault()
      $('#modal-konfirmasi').modal('show')
      
    })



    $('#btn-batal').on('click', function(e) {
      e.preventDefault();
      $('#modal-konfirmasi').modal('hide')

    })

    $('#btn-yes').on('click', function(e) {
      e.preventDefault();

      $.ajax({
        url: '<?= base_url() ?>kerusakan/save',
        type: 'post',
        data: {
          'id_gedung': $('#id-gedung').val(),
          'id_ruangan': $('#id-ruangan').val(),
          'id_item': $('#id-item').val(),
          'id_pkrutin': $('#id-pkrutin').val(),
          'tanggal_laporan': $('#tanggal-laporan').val(),
          'keluhan': $('#keluhan').val(),
          'prioritas': $('#prioritas').val(),
        },
        dataType: 'json',
        success: function(response) {
          if (response.status == "ok") {
            $('#modal-new').modal('hide')
            $('#modal-konfirmasi').modal('hide')
            $('#modal-success-info').empty();
            $('#modal-success-info').html(response.info);
            $('#modal-success').modal('show')

            $('#tanggal-laporan').val(hari_ini())
            clear_form('id-gedung')
            clear_form('id-ruangan')
            clear_form('id-item')
            clear_form('prioritas')
            clear_form('keluhan')
            getNonRutin()
          } else {
            cek_error(response.err_id_gedung, 'id-gedung');
            cek_error(response.err_id_ruangan, 'id-ruangan');
            cek_error(response.err_id_item, 'id-item');
            cek_error(response.err_id_pkrutin, 'id-pkrutin');
            cek_error(response.err_keluhan, 'keluhan');
            cek_error(response.err_prioritas, 'prioritas');
            $('#modal-konfirmasi').modal('hide')
          }

        }
      });


    })

    //Fungsi mengupdate list item setiap list gedung berubah
    $('#id-gedung').change(function(e) {
      if ($('#id-gedung').val() == "") {
        $('#id-ruangan').html("");
        //$('#id-item').html("");
        $('#id-pkrutin').html("");
        return
      }
      $.ajax({
        url: '<?= base_url() ?>jadwal/rutin/query',
        type: 'post',
        data: {
          'tipe': 'ruangan',
          'id_gedung': $('#id-gedung').val(),
        },
        dataType: 'json',
        success: function(response) {
          $('#id-ruangan').html(create_option(response.data));
          //$('#id-item').html("");
          $('#id-pkrutin').html("");
        }
      });
    });

    /*
    $('#id-ruangan').change(function(e) {
      if ($('#id-ruangan').val() == "") {
        $('#id-item').html("");
        $('#id-pkrutin').html("");
        return
      }
      $.ajax({
        url: '<?= base_url() ?>jadwal/rutin/query',
        type: 'post',
        data: {
          'tipe': 'item',
          'id_gedung': $('#id-gedung').val(),
          'id_ruangan': $('#id-ruangan').val()
        },
        dataType: 'json',
        success: function(response) {
          $('#id-item').html(create_option(response.data));
          $('#id-pkrutin').html("");
        }
      });
    });
    */

    $('#form-draft').submit(function(e) {
      e.preventDefault()
      $.ajax({
        url: '<?= base_url() ?>jadwal/rutin/save/list',
        type: 'post',
        data: {
          'id_gedung': $('#id-gedung').val(),
          'id_ruangan': $('#id-ruangan').val(),
          'id_item': $('#id-item').val(),
          'id_pkrutin': $('#id-pkrutin').val(),
          'id_user': $('#id-user').val(),
          'tanggal_jadwal': $('#tanggal-jadwal').val()
        },
        dataType: 'json',
        success: function(response) {
          if (response.status == "ok") {
            $('#modal-new').modal('hide')
            $('#modal-success-info').empty();
            $('#modal-success-info').html(response.info);
            $('#modal-success').modal('show')
          } else {
            cek_error(response.err_id_gedung, 'id-gedung');
            cek_error(response.err_id_ruangan, 'id-ruangan');
            cek_error(response.err_id_item, 'id-item');
            cek_error(response.err_id_pkrutin, 'id-pkrutin');
            cek_error(response.err_id_pkrutin, 'id-pkrutin');
          }

        }
      });
    })







    //Simpan Data Dokumen
    $('#form-new-dokumen').submit(function(e) {
      e.preventDefault();

      const files = $('#upd-foto').prop('files')[0];
      const formData = new FormData()
      formData.append('foto', files)
      formData.append('nomor_dokumen', $('#sel-nomor-dokumen').val())
      formData.append('nomor_dokumen_lain', $('#sel-nomor-dokumen-lain').val())
      formData.append('nama_dokumen', $('#sel-nama-dokumen').val())
      formData.append('kode_kategori', $('#sel-kategori').val())
      formData.append('kode_subkategori', $('#sel-subkategori').val())
      formData.append('kode_kecamatan', $('#sel-kecamatan').val())
      formData.append('kode_kelurahan', $('#sel-kelurahan').val())
      formData.append('tahun', $('#sel-tahun').val())
      formData.append('nomor_rak', $('#sel-rak').val())
      formData.append('keterangan', $('#sel-keterangan').val())
      formData.append('tahun_lain1', $('#sel-tahun-lain1').val())
      formData.append('tahun_lain2', $('#sel-tahun-lain2').val())
      formData.append('nomor_bundel', $('#sel-nomor-bundel').val())
      formData.append('kordinat', $('#sel-kordinat').val())
      formData.append('nomor_punggung', $('#sel-punggung').val())


      $.ajax({
        url: '<?php echo base_url(); ?>dokumen/save',
        type: 'post',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        dataType: 'json',
        success: function(response) {
          if (response.status == 'nok') {


            if (response.err_nomor_dokumen !== "") {
              $("#sel-nomor-dokumen").addClass("is-invalid");
              $("#iv-sel-nomor-dokumen").html(response.err_nomor_dokumen)
            } else {
              $("#sel-nomor-dokumen").removeClass("is-invalid");
              $("#iv-sel-nomor-dokumen").html("")
            };
            if (response.err_nomor_dokumen_lain !== "") {
              $("#sel-nomor-dokumen-lain").addClass("is-invalid");
              $("#iv-sel-nomor-dokumen-lain").html(response.err_nomor_dokumen_lain)
            } else {
              $("#sel-nomor-dokumen-lain").removeClass("is-invalid");
              $("#iv-sel-nomor-dokumen-lain").html("")
            };
            if (response.err_nama_dokumen !== "") {
              $("#sel-nama-dokumen").addClass("is-invalid");
              $("#iv-sel-nama-dokumen").html(response.err_nama_dokumen)
            } else {
              $("#sel-nama-dokumen").removeClass("is-invalid");
              $("#iv-sel-nama-dokumen").html("")
            };
            if (response.err_kode_kategori !== "") {
              $("#sel-kategori").addClass("is-invalid");
              $("#iv-sel-kategori").html(response.err_kode_kategori)
            } else {
              $("#sel-kategori").removeClass("is-invalid");
              $("#iv-sel-kategori").html("")
            };
            if (response.err_kode_subkategori !== "") {
              $("#sel-subkategori").addClass("is-invalid");
              $("#iv-sel-subkategori").html(response.err_kode_subkategori)
            } else {
              $("#sel-subkategori").removeClass("is-invalid");
              $("#iv-sel-subkategori").html("")
            };
            if (response.err_kode_kecamatan !== "") {
              $("#sel-kecamatan").addClass("is-invalid");
              $("#iv-sel-kecamatan").html(response.err_kode_kecamatan)
            } else {
              $("#sel-kecamatan").removeClass("is-invalid");
              $("#iv-sel-kecamatan").html("")
            };
            if (response.err_kode_kelurahan !== "") {
              $("#sel-kelurahan").addClass("is-invalid");
              $("#iv-sel-kelurahan").html(response.err_kode_kelurahan)
            } else {
              $("#sel-kelurahan").removeClass("is-invalid");
              $("#iv-sel-kelurahan").html("")
            };
            if (response.err_tahun !== "") {
              $("#sel-tahun").addClass("is-invalid");
              $("#iv-sel-tahun").html(response.err_tahun)
            } else {
              $("#sel-tahun").removeClass("is-invalid");
              $("#iv-sel-tahun").html("")
            };
            if (response.err_nomor_rak !== "") {
              $("#sel-rak").addClass("is-invalid");
              $("#iv-sel-rak").html(response.err_nomor_rak)
            } else {
              $("#sel-rak").removeClass("is-invalid");
              $("#iv-sel-rak").html("")
            };
            if (response.err_keterangan !== "") {
              $("#sel-keterangan").addClass("is-invalid");
              $("#iv-sel-keterangan").html(response.err_keterangan)
            } else {
              $("#sel-keterangan").removeClass("is-invalid");
              $("#iv-sel-keterangan").html("")
            };
            if (response.err_foto !== "") {
              $("#upd-foto").addClass("is-invalid");
              $("#iv-upd-foto").html(response.err_foto)
            } else {
              $("#upd-foto").removeClass("is-invalid");
              $("#iv-upd-foto").html("")
            };

          } else {

            $('#modal-success-info').empty();
            $('#modal-success-info').html(response.info);
            $('#modal-success').modal('show')

            setTimeout(function() {
              $('#modal-success').modal('hide')
            }, 2000);

            $('#sel-nomor-dokumen').val('');
            $('#sel-nomor-dokumen-lain').val('');
            $('#sel-nama-dokumen').val('');
            $('#sel-kategori').val('');
            $('#sel-subkategori').val('');
            $('#sel-kecamatan').val('');
            $('#sel-kelurahan').val('');
            $('#sel-tahun').val('');
            $('#sel-rak').val('');
            $('#sel-keterangan').val('');
            $('#sel-tahun-lain1').val('');
            $('#sel-tahun-lain2').val('');
            $('#sel-nomor-bundel').val('');

            $('#sel-kordinat').val('');
            $('#sel-punggung').val('');
            $('#upd-foto').val('');
            $('#upd-foto').removeClass("is-invalid");

            $('#sel-nomor-dokumen').removeClass("is-invalid");
            $('#sel-nomor-dokumen-lain').removeClass("is-invalid");
            $('#sel-nama-dokumen').removeClass("is-invalid");
            $('#sel-kategori').removeClass("is-invalid");
            $('#sel-subkategori').removeClass("is-invalid");
            $('#sel-kecamatan').removeClass("is-invalid");
            $('#sel-kelurahan').removeClass("is-invalid");
            $('#sel-tahun').removeClass("is-invalid");
            $('#sel-rak').removeClass("is-invalid");
            $('#sel-keterangan').removeClass("is-invalid");

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


    function clear_form(id) {
      $("#" + id).removeClass("is-invalid");
      $("#" + id).val("");
      $("#er-" + id).val('')

    };

    function hari_ini() {
      var today = new Date();
      var dd = ("0" + today.getDate()).slice(-2)

      var mm = ("0" + (today.getMonth() + 1)).slice(-2)
      var yyyy = today.getFullYear();
      return yyyy + '-' + mm + '-' + dd
    }


  });

  // @formatter:off
  document.addEventListener("DOMContentLoaded", function() {
    window.Litepicker && (new Litepicker({
      element: document.getElementById('tanggal-laporan'),
      buttonText: {
        previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
        nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
      },
    }));
  });
  // @formatter:on
</script>