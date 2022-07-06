<script>
    $(document).ready(function() {
        var string_btn_tbl = '<a href="#" class="btn btn-icon text-primary btn-light me-2 " c-aksi="update"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg></a>'
        string_btn_tbl += '<a href="#" class="btn btn-icon text-danger btn-light " c-aksi="delete"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>'
        const col = [{
            data: 'xx',
            className: 'text-center ',
            "searchable": false,
            "orderable": false,
            defaultContent: ''
        }, {
            data: 'id_item',
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
            data: 'id_ruangan_item',
            visible: false,
            searchable: false,
        }, {
            data: 'nama_gedung',
            className: 'text-center'
        }, {
            data: 'uraian_ruangan',
            className: 'text-center'
        }, {
            data: 'nama_item',
            className: 'text-center'
        }, {
            data: 'merek_item',
            className: 'text-center'
        }, {
            data: 'tahun_pengadaan',
            className: 'text-center'
        }, {
            data: null,
            className: 'text-center',
            "searchable": false,
            "orderable": false,
            defaultContent: string_btn_tbl
        }]
        //Inisialisasi Datatable
        var tb = $('#postsList').DataTable({
            ajax: '<?php echo base_url(); ?>master/ruangan-item/data',
            pageLength: 10,
            type: 'json',
            columns: col,
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [
                'pdfHtml5',
                'excel',
                'print'
            ],
        });

        // Fungsi kasi nomor urut di tabel (kolom pertama)
        tb.on('order.dt search.dt', function() {
            tb.column(0, {
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
            let data = tb.row($(this).parents('tr')).data();
            //alert(data['merek_item'] + "'s salary is: " + data[2]);
            aksi = $(this).attr('c-aksi');

            if (aksi == 'update') {
                $('#upd-gedung').val(data['id_gedung']);
                ambil_gedung_update(data['id_ruangan'])
                //$('#upd-ruangan').val(data['id_ruangan']);
                $('#upd-id-ruangan-item').val(data['id_ruangan_item']);
                $('#upd-item').val(data['id_item']);
                $('#upd-tahun-pengadaan').val(data['tahun_pengadaan']);
                $('#modal-update').modal('show')
            } else if (aksi == 'delete') {
                $('#del-id-ruangan-item').val(data['id_ruangan_item']);
                $('#modal-delete').modal('show');
            }
        });
        //Simpan data baru (form insert) 
        $('#form-new').submit(function(e) {
            e.preventDefault();
            $('#modal-new').modal('hide')
            $('#modal-konfirmasi-new').modal('show')

        });

        $('#btn-batal-new').on('click', function(e) {
            e.preventDefault();
            $('#modal-konfirmasi-new').modal('hide')
            $('#modal-new').modal('show')


        })

        $('#btn-yes-new').on('click', function(e) {
            e.preventDefault();

            $.ajax({
                url: "<?php echo base_url(); ?>master/ruangan-item/new",
                type: 'post',
                dataType: 'json',
                data: {
                    'id_gedung': $('#gedung').val(),
                    'id_ruangan': $('#ruangan').val(),
                    'id_item': $('#item').val(),
                    'tahun_pengadaan': $('#tahun-pengadaan').val(),
                },
                success: function(response) {
                    if (response.status == 'nok') {
                        cek_error(response.err_id_gedung, 'gedung');
                        cek_error(response.err_id_item, 'item');
                        cek_error(response.err_id_ruangan, 'ruangan');
                        cek_error(response.err_tahun_pengadaan, 'tahun-pengadaan');
                        $('#modal-konfirmasi-new').modal('hide')
                        $('#modal-new').modal('show')

                    } else {
                        $('#modal-konfirmasi-new').modal('hide')
                        $('#modal-new').modal('hide')
                        createNotification(3, response.info)

                        clear_form('gedung')
                        clear_form('ruangan')
                        clear_form('item')
                        clear_form('tahun-pengadaan')

                        update_datatables()


                    }

                }
            });
        })


        //Simpan hasil update (form update)
        $('#form-update').submit(function(e) {
            e.preventDefault();
            $('#modal-update').modal('hide')
            $('#modal-konfirmasi').modal('show')

        });

        $('#btn-batal').on('click', function(e) {
            e.preventDefault();
            $('#modal-konfirmasi').modal('hide')
            $('#modal-update').modal('show')


        })

        $('#btn-yes').on('click', function(e) {
            e.preventDefault();

            $.ajax({
                url: "<?php echo base_url(); ?>master/ruangan-item/upd",
                type: 'post',
                dataType: 'json',
                data: {
                    'id_ruangan_item': $('#upd-id-ruangan-item').val(),
                    'id_gedung': $('#upd-gedung').val(),
                    'id_ruangan': $('#upd-ruangan').val(),
                    'id_item': $('#upd-item').val(),
                    'tahun_pengadaan': $('#upd-tahun-pengadaan').val(),
                },
                success: function(response) {
                    if (response.status == 'nok') {
                        // Fungsi untuk menampilkan pesan error jika inputan tidak sesuai (form_validation) 
                        cek_error(response.err_id_gedung, 'upd-gedung');
                        cek_error(response.err_id_ruangan, 'upd-ruangan');
                        cek_error(response.err_id_item, 'upd-item');
                        cek_error(response.err_tahun_pengadaan, 'upd-tahun-pengadaan');
                        $('#modal-konfirmasi').modal('hide')
                        $('#modal-update').modal('show')
                    } else {
                        $('#modal-konfirmasi').modal('hide')
                        $('#modal-update').modal('hide')
                        createNotification(3, response.info)

                        clear_form('upd-gedung')
                        clear_form('upd-ruangan')
                        clear_form('upd-item')
                        clear_form('upd-tahun-pengadaan')

                        update_datatables()

                    }

                }
            });
        })


        //Hapus Data
        $('#form-delete').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo base_url(); ?>master/ruangan-item/del",
                type: 'post',
                dataType: 'json',
                data: {
                    'id_ruangan_item': $('#del-id-ruangan-item').val()
                },
                success: function(response) {
                    if (response.status == 'nok') {
                        $('#modal-delete').modal('hide')

                        createNotification(1, response.info)
                    } else {
                        $('#modal-delete').modal('hide')
                        createNotification(3, response.info)
                        update_datatables()
                    }

                }
            });
        });


        function cek_error(err_result, id) {
            if (err_result !== "") {
                $("#" + id).addClass("is-invalid");
                $("#er-" + id).html(err_result)
            } else {
                $("#" + id).removeClass("is-invalid");
                $("#er-" + id).html("")
            };
        }

        function update_datatables() {

            tb = $('#postsList').DataTable({
                destroy: true,
                ajax: '<?php echo base_url(); ?>master/ruangan-item/data',
                pageLength: 10,
                type: 'json',
                columns: col,
                dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: [
                    'pdfHtml5',
                    'excel',
                    'print'
                ],
            });





        }

        function create_option(datalist) {

            hasil = '<option value=""></option>'
            for (index in datalist) {
                qid_item = datalist[index].val;
                qdeskripsi = datalist[index].deskripsi;
                hasil += '<option value="' + qid_item + '">' + qdeskripsi + '</option>'
            }
            return hasil
        }

        $('#gedung').change(function(e) {
            ambil_gedung()
        });

        $('#upd-gedung').change(function(e) {
            ambil_gedung_update()
        });

        function ambil_gedung() {
            //$("#cari_kelurahan").empty();
            gedung = $('#gedung').val();

            $.ajax({
                url: '<?= base_url() ?>master/ruangan-item/query',
                type: 'post',
                data: {
                    'tabel': 'ruangan',
                    'id_gedung': gedung,
                },
                dataType: 'json',
                success: function(response) {

                    $('#ruangan').html(create_option(response.data));
                }
            });
        }

        function ambil_gedung_update(value = "") {
            //$("#cari_kelurahan").empty();
            gedung = $('#upd-gedung').val();

            $.ajax({
                url: '<?= base_url() ?>master/ruangan-item/query',
                type: 'post',
                data: {
                    'tabel': 'ruangan',
                    'id_gedung': gedung,
                },
                dataType: 'json',
                success: function(response) {

                    $('#upd-ruangan').html(create_option(response.data));
                    $('#upd-ruangan').val(value);
                }
            });
        }

        function clear_form(id) {
            $("#" + id).removeClass("is-invalid");
            $("#" + id).val("");
            $("#er-" + id).val('')
        }

        $('#btn-new').on('click', function() {
            clear_form('gedung')
            clear_form('ruangan')
            clear_form('item')
            clear_form('tahun-pengadaan')
        })


        $('#ruangan').select2({
            //dropdownParent: $('#ruan'),
            theme: "bootstrap-5",
            dropdownParent: $("#ruangan").parent(),  
        });

        $('#upd-ruangan').select2({
            //dropdownParent: $('#ruan'),
            theme: "bootstrap-5",
            dropdownParent: $("#upd-ruangan").parent(),  
        });

        $('#upd-item').select2({
            //dropdownParent: $('#ruan'),
            theme: "bootstrap-5",
            dropdownParent: $("#upd-item").parent(),  
        });

        $('#item').select2({
            //dropdownParent: $('#ruan'),
            theme: "bootstrap-5",
            dropdownParent: $("#item").parent(),  
        });




    });
</script>