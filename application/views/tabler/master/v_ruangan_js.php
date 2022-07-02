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
            data: 'id_ruangan',
            visible: false,
            searchable: false,
        }, {
            data: 'id_gedung',
            visible: false,
            searchable: false,
        }, {
            data: 'nama_gedung',
            className: 'text-center'
        }, {
            data: 'kode_ruangan',
            className: 'text-center'
        }, {
            data: 'uraian_ruangan',
            className: 'text-center'
        }, {
            data: 'keterangan',
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
            ajax: '<?php echo base_url(); ?>master/ruangan/data',
            pageLength: 10,
            type: 'json',
            columns: col,
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            "lengthMenu": [10, 25, 50, 75, 100],
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
                $('#upd-id-gedung').val(data['id_gedung']);
                $('#upd-id-ruangan').val(data['id_ruangan']);
                $('#upd-kode-ruangan').val(data['kode_ruangan']);
                $('#upd-uraian-ruangan').val(data['uraian_ruangan']);
                $('#upd-keterangan').val(data['keterangan']);

                $('#modal-update').modal('show')
            } else if (aksi == 'delete') {
                $('#del-id-ruangan').val(data['id_ruangan']);
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
                url: "<?php echo base_url(); ?>master/ruangan/new",
                type: 'post',
                dataType: 'json',
                data: {
                    'id_gedung': $('#id-gedung').val(),
                    'kode_ruangan': $('#kode-ruangan').val(),
                    'uraian_ruangan': $('#uraian-ruangan').val(),
                    'keterangan': $('#keterangan').val(),
                },
                success: function(response) {
                    if (response.status == 'nok') {
                        cek_error(response.err_gedung, 'id-gedung');
                        cek_error(response.err_kode_ruangan, 'kode-ruangan');
                        cek_error(response.err_uraian_ruangan, 'uraian-ruangan');
                        cek_error(response.err_keterangan, 'keterangan');
                        $('#modal-konfirmasi-new').modal('hide')
                        $('#modal-new').modal('show')

                    } else {
                        $('#modal-konfirmasi-new').modal('hide')
                        $('#modal-new').modal('hide')
                        createNotification(3,  response.info)

                        update_datatables()

                        clear_form('id-gedung')
                        clear_form('kode-ruangan')
                        clear_form('uraian-ruangan')
                        clear_form('keterangan')
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
                url: "<?php echo base_url(); ?>master/ruangan/upd",
                type: 'post',
                dataType: 'json',
                data: {
                    'id_ruangan': $('#upd-id-ruangan').val(),
                    'id_gedung': $('#upd-id-gedung').val(),
                    'kode_ruangan': $('#upd-kode-ruangan').val(),
                    'uraian_ruangan': $('#upd-uraian-ruangan').val(),
                    'keterangan': $('#upd-keterangan').val(),
                },
                success: function(response) {
                    if (response.status == 'nok') {
                        // Fungsi untuk menampilkan pesan error jika inputan tidak sesuai (form_validation) 
                        cek_error(response.err_gedung, 'upd-id-gedung');
                        cek_error(response.err_kode_ruangan, 'upd-kode-ruangan');
                        cek_error(response.err_uraian_ruangan, 'upd-uraian-ruangan');
                        cek_error(response.err_keterangan, 'upd-keterangan');

                        $('#modal-konfirmasi').modal('hide')
                        $('#modal-update').modal('show')

                    } else {
                        $('#modal-konfirmasi').modal('hide')
                        $('#modal-update').modal('hide')
                        createNotification(3,  response.info)

                        update_datatables()

                    }

                }
            });

            $.ajax({
                url: "<?php echo base_url(); ?>master/gedung/upd",
                type: 'post',
                dataType: 'json',
                data: {

                    'id_gedung': $('#upd-id-gedung').val(),
                    'nama_gedung': $('#upd-nama-gedung').val(),
                    'keterangan': $('#upd-keterangan').val(),
                },
                success: function(response) {
                    if (response.status == 'nok') {
                        // Fungsi untuk menampilkan pesan error jika inputan tidak sesuai (form_validation) 
                        cek_error(response.err_nama_gedung, 'upd-nama-gedung');
                        cek_error(response.err_keterangan, 'upd-keterangan');
                        $('#modal-konfirmasi').modal('hide')
                        $('#modal-update').modal('show')
                    } else {
                        $('#modal-konfirmasi').modal('hide')
                        $('#modal-update').modal('hide')
                        createNotification(3,  response.info)
                        update_datatables()

                    }

                }
            });
        })

        //Hapus Data
        $('#form-delete').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo base_url(); ?>master/ruangan/del",
                type: 'post',
                dataType: 'json',
                data: {
                    'id_ruangan': $('#del-id-ruangan').val()
                },
                success: function(response) {
                    if (response.status == 'nok') {
                        $('#modal-delete').modal('hide')
                        createNotification(1,  response.info)
                    } else {
                        $('#modal-delete').modal('hide')
                        createNotification(3,  response.info)
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

        function clear_form(id) {
            $("#" + id).removeClass("is-invalid");
            $("#" + id).val("");
            $("#er-" + id).val('')

        };

        $('#btn-new').on('click', function() {
            clear_form('id-gedung')
            clear_form('kode-ruangan')
            clear_form('uraian-ruangan')
            clear_form('keterangan')
        })


        function update_datatables() {

            tb = $('#postsList').DataTable({
                destroy: true,
                ajax: '<?php echo base_url(); ?>master/ruangan/data',
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

    });
</script>