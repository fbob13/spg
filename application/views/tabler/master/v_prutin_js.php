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
            data: 'id_pkrutin',
            visible: false,
            searchable: false,
        }, {
            data: 'id_kategori',
            visible: false,
            searchable: false,
        },{
            data: 'pengali',
            visible: false,
            searchable: false,
        },{
            data: 'interval_hari',
            visible: false,
            searchable: false,
        }, {
            data: 'jenis_pekerjaan',
            className: 'text-center'
        }, {
            data: 'uraian_pekerjaan',
            className: 'text-center'
        }, {
            data: '',
            className: 'text-center',
            render : function (data, value, row){
                return row.uraian_kategori //+ ' (' + row.kode_kategori + ')'
            }
        },{
            data: 'xx',
            className: 'text-center',
            render : function(data,value,row){
                str_pengali = ''
                if(row.pengali == 1) str_pengali = 'Hari'
                else if(row.pengali == 7) str_pengali = 'Minggu'
                else if(row.pengali == 30) str_pengali = 'Bulan'
                else if(row.pengali == 365) str_pengali = 'Tahun'
                
                return row.interval_hari + " " + str_pengali;
            }

        }, {
            data: null,
            className: 'text-center',
            "searchable": false,
            "orderable": false,
            defaultContent: string_btn_tbl
        }]
        //Inisialisasi Datatable
        var tb = $('#postsList').DataTable({
            ajax: '<?php echo base_url(); ?>master/prutin/data',
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
                $('#upd-id-pkrutin').val(data['id_pkrutin']);
                $('#upd-jenis-pekerjaan').val(data['jenis_pekerjaan']);
                $('#upd-uraian-pekerjaan').val(data['uraian_pekerjaan']);
                $('#upd-id-kategori').val(data['id_kategori']);

                $('#upd-interval').val(data['interval_hari']);
                $('#upd-interval-sel').val(data['pengali']);

                $('#modal-update').modal('show')
            } else if (aksi == 'delete') {
                $('#del-id-pkrutin').val(data['id_pkrutin']);
                $('#modal-delete').modal('show');
            }
        });
        //Simpan data baru (form insert) 
        $('#form-new').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo base_url(); ?>master/prutin/new",
                type: 'post',
                dataType: 'json',
                data: {
                    'jenis_pekerjaan': $('#jenis-pekerjaan').val(),
                    'uraian_pekerjaan': $('#uraian-pekerjaan').val(),
                    'id_kategori': $('#id-kategori').val(),
                    'interval_hari': $('#interval').val(),
                    'pengali': $('#interval-sel').val(),
                },
                success: function(response) {
                    if (response.status == 'nok') {
                        cek_error(response.err_jenis_pekerjaan, 'jenis-pekerjaan');
                        cek_error(response.err_uraian_pekerjaan, 'uraian-pekerjaan');
                        cek_error(response.err_id_kategori, 'id-kategori');
                        cek_error(response.err_interval_hari, 'interval');

                    } else {
                        $('#modal-new').modal('hide')
                        $('#modal-success-info').empty();
                        $('#modal-success-info').html(response.info);
                        $('#modal-success').modal('show')
                        $('#modal-success').modal('hide')

                        update_datatables()

                        clear_form('jenis-pekerjaan')
                        clear_form('uraian-pekerjaan')
                        clear_form('id-kategori')


                    }

                }
            });
        });

        //Simpan hasil update (form update)
        $('#form-update').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo base_url(); ?>master/prutin/upd",
                type: 'post',
                dataType: 'json',
                data: {
                    'id_pkrutin': $('#upd-id-pkrutin').val(),
                    'jenis_pekerjaan': $('#upd-jenis-pekerjaan').val(),
                    'uraian_pekerjaan': $('#upd-uraian-pekerjaan').val(),
                    'id_kategori': $('#upd-id-kategori').val(),
                    'interval_hari': $('#upd-interval').val(),
                    'pengali': $('#upd-interval-sel').val(),
                },
                success: function(response) {
                    if (response.status == 'nok') {
                        // Fungsi untuk menampilkan pesan error jika inputan tidak sesuai (form_validation) 
                        cek_error(response.err_jenis_pekerjaan, 'upd-jenis-pekerjaan');
                        cek_error(response.err_uraian_pekerjaan, 'upd-uraian-pekerjaan');
                        cek_error(response.err_id_kategori, 'upd-id-kategori');
                        cek_error(response.err_interval_hari, 'upd-interval');

                    } else {
                        $('#modal-update').modal('hide')
                        $('#modal-success-info').empty();
                        $('#modal-success-info').html(response.info);
                        $('#modal-success').modal('show')

                        update_datatables()

                    }

                }
            });
        });

        //Hapus Data
        $('#form-delete').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo base_url(); ?>master/prutin/del",
                type: 'post',
                dataType: 'json',
                data: {
                    'id_pkrutin': $('#del-id-pkrutin').val()
                },
                success: function(response) {
                    if (response.status == 'nok') {
                        $('#modal-del').modal('hide')
                        $('#modal-danger-info').empty();
                        $('#modal-danger-info').html(response.info);
                        $('#modal-danger').modal('show')
                    } else {
                        $('#modal-update').modal('hide')
                        $('#modal-success-info').empty();
                        $('#modal-success-info').html(response.info);
                        $('#modal-success').modal('show')

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
            $("#er-" + id).val('');
        }

        $('#modal-new').on('show.bs.modal', function() {
            clear_form('jenis-pekerjaan')
            clear_form('uraian-pekerjaan')
            clear_form('id-kategori')
            clear_form('interval')

        })

        function update_datatables() {

            tb = $('#postsList').DataTable({
                destroy: true,
                ajax: '<?php echo base_url(); ?>master/prutin/data',
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