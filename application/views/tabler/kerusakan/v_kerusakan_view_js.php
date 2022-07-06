<script>
    $(document).ready(function() {

        const d = new Date();
        const bulan = ('0' + (d.getMonth() + 1)).slice(-2)
        $('#s-month').val(bulan)
        $('#s-year').val(d.getFullYear())

        var string_btn_tbl = '<a href="#" class="btn btn-icon text-primary btn-light me-2 " c-aksi="update"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg></a>'
        string_btn_tbl += '<a href="#" class="btn btn-icon text-danger btn-light " c-aksi="delete"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>'


        const col = [{
            data: 'xx',
            className: 'text-center ',
            "searchable": false,
            "orderable": false,
            defaultContent: ''
        }, {
            data: 'id_nonrutin',
            visible: false,
            searchable: false,
        }, {
            data: 'status_pekerjaan',
            visible: false,
            searchable: false,
        }, {
            data: 'id_teknisi',
            visible: false,
            searchable: false,
        }, {
            data: 'prioritas',
            visible: false,
            searchable: false,
        }, {
            data: 'tanggal_laporan',
            className: 'text-center'
        }, {
            data: 'nama_teknisi',
            className: 'text-center'
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
            data: 'keluhan',
            className: 'text-center'
        }, {
            data: 'prioritas',
            className: 'text-center',
            render: function(data, type, row) {
                if (row.prioritas == 0) {
                    return '<span class="text-blue">' + row.prioritas_text + '</span>'
                } else if (row.prioritas == 1) {
                    return '<span class="text-blue">' + row.prioritas_text + '</span>'
                } else if (row.prioritas == 2) {
                    return '<span class="text-yellow">' + row.prioritas_text + '</span>'
                } else if (row.prioritas == 3) {
                    return '<span class="text-orange">' + row.prioritas_text + '</span>'
                } else if (row.prioritas == 4) {
                    return '<span class="text-red">' + row.prioritas_text + '</span>'
                }

            }
        }, {
            data: 'status_pekerjaan',
            className: 'text-center',
            render: function(data, type, row) {
                if (row.status_pekerjaan == 0) {
                    return '<span class="text-danger">' + row.status_pekerjaan_text + '</span>'
                } else if (row.status_pekerjaan == 1) {
                    return '<span class="text-warning">' + row.status_pekerjaan_text + '</span>'
                } else if (row.status_pekerjaan == 2) {
                    return '<span class="text-warning">' + row.status_pekerjaan_text + '</span>'
                } else if (row.status_pekerjaan == 3) {
                    return '<span class="text-success">' + row.status_pekerjaan_text + '</span>'
                } else if (row.status_pekerjaan == 4) {
                    return '<span class="text-danger">' + row.status_pekerjaan_text + '</span>'
                }

            }
        }, {
            data: 'keterangan',
            className: 'text-center'
        }, {
            data: null,
            className: 'text-center',
            "searchable": false,
            "orderable": false,
            render: function(data, type, row) {
                if (row.status_pekerjaan == '3') {
                    return ''
                } else {
                    return string_btn_tbl
                }
            },
        }]
        //Inisialisasi Datatable
        var tb = $('#postsList').DataTable({
            ajax: '<?php echo base_url(); ?>kerusakan/view/data',
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
            processing: true,
            serverSide: true,
            "createdRow": function(row, data, dataIndex) {
                if (data['status_pekerjaan'] == 0) {
                    $(row).addClass('bg-danger-lt');
                } else if (data['status_pekerjaan'] == 1) {
                    $(row).addClass('bg-azure-lt');
                } else if (data['status_pekerjaan'] == 2) {
                    $(row).addClass('bg-warning-lt');
                } else if (data['status_pekerjaan'] == 3) {
                    $(row).addClass('bg-success-lt');
                } else if (data['status_pekerjaan'] == 4) {
                    $(row).addClass('bg-purple-lt');
                } else if (data['status_pekerjaan'] == 5) {
                    $(row).addClass('bg-success-lt');
                }
            }
        });

        // Fungsi kasi nomor urut di tabel (kolom pertama)
        tb.on('order.dt search.dt draw.dt', function() {
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
                $('#upd-id-nonrutin').val(data['id_nonrutin']);
                $('#upd-tanggal-laporan').html(data['tanggal_laporan']);
                $('#upd-gedung').html(data['nama_gedung']);
                $('#upd-ruangan').html(data['nama_ruangan']);
                $('#upd-item').html(data['nama_item']);
                $('#upd-keluhan').html(data['keluhan']);
                $('#upd-id-teknisi').val(data['id_teknisi']);
                $('#upd-keterangan').val(data['keterangan']);
                $('#upd-status-pekerjaan').val(data['status_pekerjaan']);
                $('#upd-prioritas').val(data['prioritas']);

                $('#modal-update').modal('show')
            } else if (aksi == 'delete') {
                $('#del-id-nonrutin').val(data['id_nonrutin']);
                $('#modal-delete').modal('show');
            }
        });


        $('#btn-query').on('click', function() {
            update_datatables()
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
                url: "<?php echo base_url(); ?>kerusakan/view/upd",
                type: 'post',
                dataType: 'json',
                data: {
                    'id_nonrutin': $('#upd-id-nonrutin').val(),
                    'status_pekerjaan': $('#upd-status-pekerjaan').val(),
                    'keterangan': $('#upd-keterangan').val(),
                    'id_teknisi': $('#upd-id-teknisi').val(),
                    'prioritas': $('#upd-prioritas').val(),
                },
                success: function(response) {
                    if (response.status == 'nok') {
                        // Fungsi untuk menampilkan pesan error jika inputan tidak sesuai (form_validation) 
                        cek_error(response.err_status_pekerjaan, 'upd-status-pekerjaan');
                        cek_error(response.err_keterangan, 'upd-keterangan');
                        cek_error(response.err_id_teknisi, 'upd-id-teknisi');
                        $('#modal-konfirmasi').modal('hide')
                        $('#modal-update').modal('show')
                    } else {
                        $('#modal-update').modal('hide')
                        $('#modal-konfirmasi').modal('hide')
                        //$('#modal-success-info').empty();
                        //$('#modal-success-info').html(response.info);
                        //$('#modal-success').modal('show')
                        createNotification(3,  response.info)
                        update_datatables()
                        getNonRutin()

                    }

                }
            });


        })


        //Hapus Data
        $('#form-delete').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo base_url(); ?>kerusakan/view/del",
                type: 'post',
                dataType: 'json',
                data: {
                    'id_nonrutin': $('#del-id-nonrutin').val()
                },
                success: function(response) {
                    if (response.status == 'nok') {
                        $('#modal-del').modal('hide')
                        createNotification(1,  response.info)
                    } else {
                        $('#modal-update').modal('hide')
                        createNotification(3,  response.info)

                        update_datatables()
                        getNonRutin()
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
                processing: true,
                serverSide: true,
                ajax: {
                    url: '<?php echo base_url(); ?>kerusakan/view/data',
                    type: 'POST',
                    data: {
                        'status_pekerjaan': $('#s-status').val(),
                        'tahun': $('#s-year').val(),
                        'bulan': $('#s-month').val(),
                        'prioritas': $('#s-prioritas').val(),
                    }
                },
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
                "createdRow": function(row, data, dataIndex) {
                    if (data['status_pekerjaan'] == 0) {
                        $(row).addClass('bg-danger-lt');
                    } else if (data['status_pekerjaan'] == 1) {
                        $(row).addClass('bg-azure-lt');
                    } else if (data['status_pekerjaan'] == 2) {
                        $(row).addClass('bg-warning-lt');
                    } else if (data['status_pekerjaan'] == 3) {
                        $(row).addClass('bg-success-lt');
                    } else if (data['status_pekerjaan'] == 4) {
                        $(row).addClass('bg-purple-lt');
                    } else if (data['status_pekerjaan'] == 5) {
                        $(row).addClass('bg-success-lt');
                    }
                }
            });





        }

    

    });
</script>

 