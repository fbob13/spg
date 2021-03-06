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
            
            $('#modal-konfirmasi').modal('hide')
            
            createNotification(3,  response.info)

            $('#tanggal-laporan').val(hari_ini())
            clear_form('id-gedung')
            // clear_form('id-ruangan')
            $('#id-ruangan').val('').trigger('change')
            // clear_form('id-item')
            $('#id-item').val('').trigger('change')
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
        url: '<?= base_url() ?>kerusakan/query',
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

    function clear_form(id) {
      $("#" + id).removeClass("is-invalid");
      $("#" + id).val('');
      $("#er-" + id).val('');

    };

    function hari_ini() {
      var today = new Date();
      var dd = ("0" + today.getDate()).slice(-2)

      var mm = ("0" + (today.getMonth() + 1)).slice(-2)
      var yyyy = today.getFullYear();
      return yyyy + '-' + mm + '-' + dd
    }

    $('#id-ruangan').select2({
      //dropdownParent: $('#ruan'),
      theme: "bootstrap-5",
      dropdownParent: $("#id-ruangan").parent(),
    });

    $('#id-item').select2({
      //dropdownParent: $('#ruan'),
      theme: "bootstrap-5",
      dropdownParent: $("#id-item").parent(),
    });


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