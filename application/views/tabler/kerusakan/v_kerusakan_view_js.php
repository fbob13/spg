<script>
    $(document).ready(function() {

        const d = new Date();
        const bulan = ('0' + (d.getMonth() + 1)).slice(-2)
        $('#s-month').val(bulan)
        $('#s-year').val(d.getFullYear())

        const spc = <?php echo $this->session->userdata('spc'); ?>;

        const akses_edit = '<?php echo $edit; ?>';
        const akses_delete = '<?php echo $delete; ?>';

        var stat = '<?php echo $stat; ?>';
        var string_btn_tbl = ""
        if (akses_edit == 'ok'){
            string_btn_tbl += '<a href="#" class="btn btn-icon text-primary btn-light me-2 " c-aksi="update"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg></a>'
        }

        if (akses_delete == 'ok'){
            string_btn_tbl += '<a href="#" class="btn btn-icon text-danger btn-light " c-aksi="delete"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>'            
        }
        
        

        var string_btn_approve = '<a href="#" class="btn btn-success me-2 " c-aksi="approve"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><rect x="9" y="3" width="6" height="4" rx="2" /><path d="M9 14l2 2l4 -4" /></svg>Approve</a>'

        const star = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="fs-5" style="margin-left:1px;margin-right:1px;" viewBox="0 0 16 16"><path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/></svg>'
        const starfill = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="fs-5" style="margin-left:1px;margin-right:1px;" viewBox="0 0 16 16"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/></svg>'
        var rating = {
            1 : starfill + star + star + star + star,
            2 : starfill + starfill + starfill + star + star,
            3 : starfill + starfill + starfill + starfill + star,
            4 : starfill + starfill + starfill + starfill + starfill        
        }
        

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
                /*
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
                */
               return '<div class="card w-full text-yellow text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="' + row.prioritas_text + '"><div class="card-body text-nowrap fs-5 p-2">' + rating[row.prioritas] + '</div></div>'

            }
        }, {
            data: 'status_pekerjaan',
            className: 'text-center',
            render: function(data, type, row) {
                    return '<div class="card w-full p-1 fs-5">' + row.status_pekerjaan_text + '</div>'
            }
        }, {
            data: 'keterangan',
            className: 'text-center',
            visible: false,
        }, {
            data: null,
            className: 'text-center text-nowrap',
            "searchable": false,
            "orderable": false,
            render: function(data, type, row) {
                if (row.status_pekerjaan == '3') {
                    if (spc == 1 || spc == 99) {
                        return string_btn_approve
                    } else {
                        return ''
                    }
                } else if (row.status_pekerjaan == '5') {
                    return ''
                }else {
                    return string_btn_tbl
                }
            },
        }]
        //Inisialisasi Datatable
        var tb = $('#postsList').DataTable({
            //ajax: '<?php echo base_url(); ?>kerusakan/view/data',
            ajax: {
                    url: '<?php echo base_url(); ?>kerusakan/view/data',
                    type: 'POST',
                    data: {
                        'stat': stat,
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
                    $(row).addClass('bg-teal-lt');
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
            } else if (aksi == 'approve') {
                $('#id-approve').val(data['id_nonrutin']);
                $('#modal-konfirmasi-approve').modal('show');

                $('#approve-nama').text(data['nama_teknisi']);
                $('#approve-jadwal').text(data['tanggal_jadwal']);
                $('#approve-gedung').text(data['nama_gedung']);
                $('#approve-ruangan').text(data['nama_ruangan']);
                $('#approve-item').text(data['nama_item']);
                $('#approve-keluhan').text(data['keluhan']);
                $('#approve-keterangan').text(data['keterangan']);
            }
        });


        $('#btn-query').on('click', function() {
            stat = 'all'
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

        $('#btn-batal-approve').on('click', function(e) {
            e.preventDefault();
            $('#modal-konfirmasi-approve').modal('hide')
        })

        $('#btn-yes-approve').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo base_url(); ?>kerusakan/view/approve",
                type: 'post',
                dataType: 'json',
                data: {
                    'status' : 'ok',
                    'id_nonrutin': $('#id-approve').val(),
                },
                success: function(response) {
                    if (response.status == 'nok') {
                        $('#modal-konfirmasi-approve').modal('hide')
                        $('#id-approve').val('');

                    } else {
                        $('#modal-konfirmasi-approve').modal('hide')
                        //$('#modal-update').modal('hide')
                        $('#id-approve').val('');
                        createNotification(3, response.info)
                        update_datatables()
                        getRutin()

                    }

                }
            });
        })

        $('#btn-no-approve').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo base_url(); ?>kerusakan/view/approve",
                type: 'post',
                dataType: 'json',
                data: {
                    'status' : 'nok',
                    'id_nonrutin': $('#id-approve').val(),
                },
                success: function(response) {
                    if (response.status == 'nok') {
                        $('#modal-konfirmasi-approve').modal('hide')
                        $('#id-approve').val('');

                    } else {
                        $('#modal-konfirmasi-approve').modal('hide')
                        //$('#modal-update').modal('hide')
                        $('#id-approve').val('');
                        createNotification(3, response.info)
                        update_datatables()
                        getRutin()

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
                        'stat': stat,
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

 