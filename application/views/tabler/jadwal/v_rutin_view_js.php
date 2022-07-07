<script>
    $(document).ready(function() {
        const d = new Date();
        const bulan = ('0' + (d.getMonth() + 1)).slice(-2);
        const spc = <?php echo $this->session->userdata('spc'); ?>;
        $('#s-month').val(bulan)
        $('#s-year').val(d.getFullYear())
        //2console.log(('0' + (d.getMonth() + 1)).slice(-2))

        var string_btn_tbl = ''
        const today = '<?php echo $today; ?>';
        
        const akses_edit = '<?php echo $edit; ?>';
        const akses_delete = '<?php echo $delete; ?>';
        var string_btn_tbl = ""
        if (akses_edit == 'ok'){
            string_btn_tbl += '<a href="#" class="btn btn-icon text-primary btn-light me-2 " c-aksi="update"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg></a>'
        }

        if (akses_delete == 'ok'){
            string_btn_tbl += '<a href="#" class="btn btn-icon text-danger btn-light " c-aksi="delete"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>'
        }

        var string_btn_approve = '<a href="#" class="btn btn-success me-2 " c-aksi="approve"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><rect x="9" y="3" width="6" height="4" rx="2" /><path d="M9 14l2 2l4 -4" /></svg>Approve</a>'

        const col = [{
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
            data: 'id_user',
            visible: false,
            searchable: false,
        }, {
            data: 'status_pekerjaan',
            visible: false,
            searchable: false,
        }, {
            data: 'tanggal_jadwal',
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
            data: 'jenis_pekerjaan',
            className: 'text-center'
        }, {
            data: 'status_pekerjaan',
            className: 'text-center',
            render: function(data,type,row){
                return '<div class="btn w-full px-2">' +  row.status_pekerjaan_text + '</div>'
            }
        }, {
            data: 'keterangan',
            className: 'text-center'
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

                } else if(row.status_pekerjaan == '5') {
                    return ''
                }else {
                    return string_btn_tbl
                }
            },
            //defaultContent: string_btn_tbl
        }]
        //Inisialisasi Datatable
        var tb = $('#postsList').DataTable({
            processing: true,
            serverSide: true,
            //ajax: '<?php echo base_url(); ?>jadwal/rutin/view/data',
            ajax: {
                    url: '<?php echo base_url(); ?>jadwal/rutin/view/data',
                    type: 'POST',
                    data: {
                        'today': today,
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
                    //$(row).attr('style','color:white !important;');
                } else if (data['status_pekerjaan'] == 1) {
                    $(row).addClass('bg-azure-lt');
                    //$(row).attr('style','color:white !important;');
                } else if (data['status_pekerjaan'] == 2) {
                    $(row).addClass('bg-warning-lt');
                    //$(row).attr('style','color:white !important;');
                } else if (data['status_pekerjaan'] == 3) {
                    $(row).addClass('bg-success-lt');
                    //$(row).attr('style','color:white !important;');
                } else if (data['status_pekerjaan'] == 4) {
                    $(row).addClass('bg-purple-lt');
                    //$(row).attr('style','color:white !important;');
                } else if (data['status_pekerjaan'] == 5) {
                    $(row).addClass('bg-teal-lt');
                    //$(row).attr('style','color:white !important;');
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
                $('#upd-id-rutin').val(data['id_rutin']);
                $('#upd-tanggal-jadwal').html(data['tanggal_jadwal']);
                $('#upd-gedung').html(data['nama_gedung']);
                $('#upd-ruangan').html(data['nama_ruangan']);
                $('#upd-item').html(data['nama_item']);
                $('#upd-pekerjaan').html(data['jenis_pekerjaan']);
                $('#upd-keterangan').val(data['keterangan']);

                $('#upd-status-pekerjaan').val(data['status_pekerjaan']);
                $('#upd-id-user').val(data['id_user']);

                $('#modal-update').modal('show')
            } else if (aksi == 'delete') {
                $('#del-id-rutin').val(data['id_rutin']);
                $('#modal-delete').modal('show');
            } else if (aksi == 'approve') {
                $('#id-approve').val(data['id_rutin']);
                $('#modal-konfirmasi-approve').modal('show');

                $('#approve-nama').text(data['nama_teknisi']);
                $('#approve-jadwal').text(data['tanggal_jadwal']);
                $('#approve-gedung').text(data['nama_gedung']);
                $('#approve-ruangan').text(data['nama_ruangan']);
                $('#approve-item').text(data['nama_item']);
                $('#approve-pekerjaan').text(data['jenis_pekerjaan']);
                $('#approve-keterangan').text(data['keterangan']);

            }
        });


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
                url: "<?php echo base_url(); ?>jadwal/rutin/view/upd",
                type: 'post',
                dataType: 'json',
                data: {
                    'id_rutin': $('#upd-id-rutin').val(),
                    'status_pekerjaan': $('#upd-status-pekerjaan').val(),
                    'keterangan': $('#upd-keterangan').val(),
                    'id_user': $('#upd-id-user').val(),
                },
                success: function(response) {
                    if (response.status == 'nok') {
                        $('#modal-konfirmasi').modal('hide')
                        $('#modal-update').modal('show')

                        // Fungsi untuk menampilkan pesan error jika inputan tidak sesuai (form_validation) 
                        cek_error(response.err_jenis_pekerjaan, 'upd-jenis-pekerjaan');
                        cek_error(response.err_uraian_pekerjaan, 'upd-uraian-pekerjaan');
                        cek_error(response.err_keterangan, 'upd-keterangan');

                    } else {
                        $('#modal-konfirmasi').modal('hide')
                        //$('#modal-update').modal('hide')

                        createNotification(3, response.info)
                        update_datatables()
                        getRutin()

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
                url: "<?php echo base_url(); ?>jadwal/rutin/view/approve",
                type: 'post',
                dataType: 'json',
                data: {
                    'status' : 'ok',
                    'id_rutin': $('#id-approve').val(),
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
                url: "<?php echo base_url(); ?>jadwal/rutin/view/approve",
                type: 'post',
                dataType: 'json',
                data: {
                    'status' : 'nok',
                    'id_rutin': $('#id-approve').val(),
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
                url: "<?php echo base_url(); ?>jadwal/rutin/view/del",
                type: 'post',
                dataType: 'json',
                data: {
                    'id_rutin': $('#del-id-rutin').val()
                },
                success: function(response) {
                    if (response.status == 'nok') {
                        $('#modal-del').modal('hide')

                        createNotification(1, response.info)
                    } else {
                        $('#modal-update').modal('hide')

                        createNotification(3, response.info)
                        update_datatables()
                        getRutin()
                    }

                }
            });
        });

        $('#btn-query').on('click', function() {
            update_datatables()
        })


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
                ajax: {
                    url: '<?php echo base_url(); ?>jadwal/rutin/view/data',
                    type: 'POST',
                    data: {
                        'status_pekerjaan': $('#s-status').val(),
                        'tahun': $('#s-year').val(),
                        'bulan': $('#s-month').val(),
                    }
                },
                pageLength: 10,
                type: 'json',
                columns: col,
                processing: true,
                serverSide: true,
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
                        //$(row).attr('style','color:white !important;');
                    } else if (data['status_pekerjaan'] == 1) {
                        $(row).addClass('bg-azure-lt');
                        //$(row).attr('style','color:white !important;');
                    } else if (data['status_pekerjaan'] == 2) {
                        $(row).addClass('bg-warning-lt');
                        //$(row).attr('style','color:white !important;');
                    } else if (data['status_pekerjaan'] == 3) {
                        $(row).addClass('bg-success-lt');
                        //$(row).attr('style','color:white !important;');
                    } else if (data['status_pekerjaan'] == 4) {
                        $(row).addClass('bg-purple-lt');
                        //$(row).attr('style','color:white !important;');
                    } else if (data['status_pekerjaan'] == 5) {
                        $(row).addClass('bg-teal-lt');
                        //$(row).attr('style','color:white !important;');
                    }
                }
            });





        }

        var counter = 0

        function createNotification(icon, pesan) {
            counter = counter + 1
            $('#t-cont').prepend(createToast(icon, pesan, counter))
            var id_show = 'toast-' + counter
            var myToastEl = document.getElementById(id_show)
            var myToast = bootstrap.Toast.getOrCreateInstance(myToastEl)
            myToast.show()
        }

        function createToast(icon, pesan, count) {
            const tstyle = [];
            tstyle[1] = 'bg-danger'
            tstyle[2] = 'bg-warning'
            tstyle[3] = 'bg-success'
            //console.log('notif#' + data.flag_icon + '#' + data.header + '#' + data.created_at + '#' + data.info)
            //console.log("create toast")
            wr = ""
            wr += '<div class="toast ' + tstyle[icon] + ' text-white" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-toggle="toast" id="toast-' + count + '">'
            wr += '  <div class="d-flex">'
            wr += '     <div class="toast-body">'
            wr += pesan
            wr += '     </div>'
            wr += '     <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>'
            wr += '  </div>'
            wr += '   </div>'
            return wr
        }

    });
</script>