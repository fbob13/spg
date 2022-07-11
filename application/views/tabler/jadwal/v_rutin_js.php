<script>
  $(document).ready(function() {

    //---------------------------------------------------
    //-------------DATATABLES----------------------------
    //---------------------------------------------------

    var string_btn_tbl = '<a href="#" class="btn btn-icon text-danger btn-light me-2 " c-aksi="delete_list"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="4" width="16" height="16" rx="2" /><path d="M10 10l4 4m0 -4l-4 4" /></svg></a>'


    const col = [{
      data: null,
      className: 'text-center',
      "searchable": false,
      "orderable": false,
      defaultContent: string_btn_tbl
    }, {
      data: 'xx',
      className: 'text-center ',
      "searchable": false,
      "orderable": false,
      defaultContent: ''
    }, {
      data: 'id_rutin_draft',
      visible: false,
      searchable: false,
    }, {
      data: 'id_ruangan',
      visible: false,
      searchable: false,
    }, {
      data: 'id_gedung',
      visible: false,
      searchable: false,
    }, {
      data: 'id_item',
      visible: false,
      searchable: false,
    }, {
      data: 'id_pkrutin',
      visible: false,
      searchable: false,
    }, {
      data: 'nama_gedung',
      className: 'text-center'
    }, {
      data: 'nama_ruangan',
      className: 'text-center'
    }, {
      data: 'nama_item',
      className: 'text-center'
    }, {
      data: 'jenis_pekerjaan',
      className: 'text-center'
    }]
    //Inisialisasi Datatable
    var tb = $('#postsList').DataTable({
      ajax: {
        url: '<?php echo base_url(); ?>empty',
        type: 'POST',
        data: {
          'tipe': 'draft'
        }
      },
      pageLength: 10,
      type: 'json',
      columns: col,
      dom: 'frtip',
      buttons: [
        'pdfHtml5',
        'excel',
        'print'
      ],
    });

    // Fungsi kasi nomor urut di tabel (kolom pertama)
    tb.on('order.dt search.dt', function() {
      tb.column(1, {
        search: 'applied',
        order: 'applied'
      }).nodes().each(function(cell, i) {
        cell.innerHTML = i + 1;
        tb.cell(cell).invalidate('dom');
      });
    }).draw();
    //Fungsi Menampilkan tombol edit & delete di tabel 
    $('#postsList tbody').on('click', 'a', function(e) {
      e.preventDefault()
      var datax = tb.row($(this).parents('tr')).data();
      //alert(data['merek_item'] + "'s salary is: " + data[2]);
      aksi = $(this).attr('c-aksi');

      if (aksi == 'delete_list') {

        $.ajax({
          url: '<?= base_url() ?>jadwal/rutin/query',
          type: 'post',
          data: {
            'tipe': 'delete_list',
            'id_rutin': datax['id_rutin_draft'],
          },
          dataType: 'json',
          success: function(response) {
            create_draft()
            createNotification(3, "Jadwal berhasil di hapus")
            getRutin()
          }
        });

      }
    });


    function create_draft() {
      tb = $('#postsList').DataTable({
        destroy: true,
        ajax: {
          url: '<?php echo base_url(); ?>jadwal/rutin/query',
          type: 'POST',
          data: {
            'tipe': 'draft',
            'id_user': $('#id-user').val(),
            'tanggal_jadwal': $('#tanggal-jadwal').val()
          }
        },
        pageLength: 10,
        type: 'json',
        columns: col,
        dom: 'frtip',
        buttons: [
          'pdfHtml5',
          'excel',
          'print'
        ],
      });
    }

    function create_draft_empty() {
      tb = $('#postsList').DataTable({
        destroy: true,
        ajax: {
          url: '<?php echo base_url(); ?>empty',
          type: 'POST',
          data: {
            'tipe': 'draft'
          },
        },
        pageLength: 10,
        type: 'json',
        columns: col,
        dom: 'frtip',
        buttons: [
          'pdfHtml5',
          'excel',
          'print'
        ],
      });
    }


    //---------------------------------------------------
    //-------------END DATATABLES----------------------------
    //---------------------------------------------------

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


    $('#form-head').submit(function(e) {
      e.preventDefault()

      if ($('#id-user').val() == "") {
        $('#id-user').addClass("is-invalid")
        $('#er-id-user').html("Silahkan memilii teknisi terlebih dahulu")
        $('#draft-ok').removeClass('d-none')
      } else {
        $('#cont-det').removeClass('d-none')
        $('#id-user').removeClass("is-invalid").prop('disabled', true)
        $('#tanggal-jadwal').prop('disabled', true)
        $('#er-id-user').html("")
        $('#draft-ok').addClass('d-none')
        create_draft()

      }
    })

    //Fungsi mengupdate list item setiap list gedung berubah
    $('#id-gedung').change(function(e) {
      if ($('#id-gedung').val() == "") {
        $('#id-ruangan').html("");
        $('#id-item').html("");
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
          $('#id-item').html("");
          $('#id-pkrutin').html("");
        }
      });
    });

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

    $('#id-item').change(function(e) {
      if ($('#id-item').val() == "") {
        $('#id-pkrutin').html("");
        return
      }
      $.ajax({
        url: '<?= base_url() ?>jadwal/rutin/query',
        type: 'post',
        data: {
          'tipe': 'pkrutin',
          'id_item': $('#id-item').val(),
        },
        dataType: 'json',
        success: function(response) {
          $('#id-pkrutin').html(create_option(response.data));
        }
      });
    });

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
            clear_form('id-gedung')
            clear_form_h('id-ruangan')
            clear_form_h('id-item')
            //$('#id-item').val('').trigger('change')
            clear_form_h('id-pkrutin')
            create_draft()
            createNotification(3, "List Draft berhasil di tambahkah")

            //getRutin()
          } else {
            cek_error(response.err_id_gedung, 'id-gedung');
            cek_error(response.err_id_ruangan, 'id-ruangan');
            cek_error(response.err_id_item, 'id-item');
            cek_error(response.err_id_pkrutin, 'id-pkrutin');
          }

        }
      });
    })

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

    $('#id-pkrutin').select2({
      //dropdownParent: $('#ruan'),
      theme: "bootstrap-5",
      dropdownParent: $("#id-pkrutin").parent(),
    });


    $('#btn-save').on('click', function(e) {
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
        url: '<?= base_url() ?>jadwal/rutin/save/jadwal',
        type: 'post',
        data: {
          'id_user': $('#id-user').val(),
          'tanggal_jadwal': $('#tanggal-jadwal').val()
        },
        dataType: 'json',
        success: function(response) {
          if (response.status == "ok") {
            create_draft_empty()
            createNotification(3, response.info)
            getRutin()
            reset_form()
            $('#modal-konfirmasi').modal('hide')
          } else {
            $('#modal-konfirmasi').modal('hide')
            createNotification(1, response.info)

          }

        }
      });

    })


    $('#btn-delete').on('click', function(e) {
      e.preventDefault()
      $('#modal-konfirmasi-del').modal('show')
    })


    $('#btn-batal-del').on('click', function(e) {
      e.preventDefault();
      $('#modal-konfirmasi-del').modal('hide')
    })

    $('#btn-yes-del').on('click', function(e) {
      e.preventDefault();

      $.ajax({
        url: '<?= base_url() ?>jadwal/rutin/del/draft',
        type: 'post',
        data: {
          'id_user': $('#id-user').val(),
          'tanggal_jadwal': $('#tanggal-jadwal').val()
        },
        dataType: 'json',
        success: function(response) {
          if (response.status == "ok") {
            create_draft_empty()
            createNotification(3, response.info)
            getRutin()
            reset_form()
            $('#modal-konfirmasi-del').modal('hide')
          } else {
            $('#modal-konfirmasi-del').modal('hide')
            createNotification(1, response.info)

          }

        }
      });

    })



    //Upload Dokumen
    $('#form-upload-dokumen').submit(function(e) {
      e.preventDefault();
      $('#modal-konfirmasi-upload').modal('show')

    });

    $('#btn-batal-upload').on('click', function(e) {
      e.preventDefault();
      $('#modal-konfirmasi-upload').modal('hide')
    })

    $('#btn-yes-upload').on('click', function(e) {
      e.preventDefault();

      const files = $('#upload-file').prop('files')[0];
      const formData = new FormData()
      formData.append('dokumen', files)
      formData.append('id_user', $('#id-user').val())
      formData.append('tanggal_jadwal', $('#tanggal-jadwal').val())

      $.ajax({
        url: "<?php echo base_url(); ?>jadwal/rutin/upload",
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
            else{
              clear_form('upload-file')
            }

            createNotification(1, response.info)
            


          } else {
            $('#modal-konfirmasi-upload').modal('hide')
            createNotification(3, response.info)
            clear_form('upload-file')
            getRutin()

          }

        }
      });


    })





    function reset_form() {

      $('#tanggal-jadwal').val('<?php echo date("Y-m-d"); ?>')
      $('#id-user').val('')

      clear_form('id-gedung')
      clear_form_h('id-ruangan')
      clear_form_h('id-item')
      //$('#id-item').val('').trigger('change')
      clear_form_h('id-pkrutin')

      $('#cont-det').addClass('d-none')
      $('#id-user').removeClass("is-invalid").prop('disabled', false)
      $('#tanggal-jadwal').prop('disabled', false)
      $('#er-id-user').html("")
      $('#draft-ok').removeClass('d-none')


    }

    function clear_form(id) {
      $("#" + id).removeClass("is-invalid");
      $("#" + id).val("");
      $("#er-" + id).val('')

    };

    function clear_form_h(id) {
      $("#" + id).removeClass("is-invalid");
      $("#" + id).html("");
      $("#er-" + id).val('')

    };

    $('#btn-new').on('click', function() {
      clear_form('nama-gedung')
      clear_form('keterangan')
    })


  });

  // @formatter:off
  document.addEventListener("DOMContentLoaded", function() {
    window.Litepicker && (new Litepicker({
      element: document.getElementById('tanggal-jadwal'),
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