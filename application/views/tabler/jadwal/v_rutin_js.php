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
      data: 'id_rutin',
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
            'id_rutin': datax['id_rutin'],
          },
          dataType: 'json',
          success: function(response) {
            create_draft()
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
            create_draft()
          } else {
            cek_error(response.err_id_gedung, 'id-gedung');
            cek_error(response.err_id_ruangan, 'id-ruangan');
            cek_error(response.err_id_item, 'id-item');
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