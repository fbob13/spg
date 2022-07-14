<script>
    $(document).ready(function() {
        const d = new Date();
        const bulan = ('0' + (d.getMonth() + 1)).slice(-2);
        const spc = <?php echo $this->session->userdata('spc'); ?>;
        $('#s-month').val(bulan)
        $('#s-year').val(d.getFullYear())
        //2console.log(('0' + (d.getMonth() + 1)).slice(-2))

        const subkategori = <?php echo json_encode($subkategori); ?>;

        function ceksub(currentValue) {
            return currentValue.id_subkategori == this;
        }



        var string_btn_tbl = ''
        var today = '<?php echo $today; ?>';

        const akses_edit = '<?php echo $edit; ?>';
        const akses_delete = '<?php echo $delete; ?>';
        var string_btn_tbl = ""
        if (akses_edit == 'ok') {
            string_btn_tbl += '<a href="#" class="btn btn-icon text-primary btn-light me-2 " c-aksi="update"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg></a>'
        }

        if (akses_delete == 'ok') {
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
            data: 'id_subkategori',
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
                } else {
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

                clear_form('upd-status-pekerjaan')
                clear_form('upd-id-user')
                clear_form('upd-keterangan-new')

                $('#upd-id-rutin').val(data['id_rutin']);
                $('#upd-tanggal-jadwal').html(data['tanggal_jadwal']);
                $('#upd-gedung').html(data['nama_gedung']);
                $('#upd-ruangan').html(data['nama_ruangan']);
                $('#upd-item').html(data['nama_item']);
                $('#upd-pekerjaan').html(data['jenis_pekerjaan']);

                //Keterangan
                //Data keterangan baru pake -new
                if (data['keterangan'] == null || data['keterangan'] == '') {
                    $('#upd-keterangan').addClass("d-none");
                } else {
                    $('#upd-keterangan').removeClass("d-none");

                }
                $('#upd-keterangan-new').val('');
                $('#upd-keterangan').val(data['keterangan']);

                //end Keterangan

                $('#upd-status-pekerjaan').val(data['status_pekerjaan']);
                $('#upd-id-user').val(data['id_user']);

                $('#upd-pk').val(data['pk']);
                $('#upd-arus-r').val(data['arus_r']);
                $('#upd-arus-s').val(data['arus_s']);
                $('#upd-arus-t').val(data['arus_t']);
                $('#upd-teg-r').val(data['teg_r']);
                $('#upd-teg-s').val(data['teg_s']);
                $('#upd-teg-t').val(data['teg_t']);
                $('#upd-teg-v').val(data['teg_v']);
                $('#upd-psi').val(data['psi']);
                $('#upd-oli').val(data['oli']);
                $('#upd-solar').val(data['solar']);
                $('#upd-radiator').val(data['radiator']);
                $('#upd-eng-hours').val(data['eng_hours']);
                $('#upd-accu').val(data['accu']);
                $('#upd-temp').val(data['temp']);
                $('#upd-kap').val(data['kap']);
                $('#upd-noice').val(data['noice']);
                $('#upd-qty').val(data['qty']);
                $('#upd-vol').val(data['vol']);
                $('#upd-tgl-kadaluarsa').val(data['tgl_kadaluarsa']);
                $('#upd-kondisi').val(data['kondisi']);
                $('#upd-tindakan').val(data['tindakan']);



                var testx = subkategori.filter(ceksub, data['id_subkategori']);
                //menampilkan kolom yang perlu di isi
                testx.map(function(arr) {
                    (arr.pk == 1) ? $('#cont-upd-pk').removeClass('d-none'): $('#cont-upd-pk').addClass('d-none');
                    (arr.arus_r == 1) ? $('#cont-upd-arus-r').removeClass('d-none'): $('#cont-upd-arus-r').addClass('d-none');
                    (arr.arus_s == 1) ? $('#cont-upd-arus-s').removeClass('d-none'): $('#cont-upd-arus-s').addClass('d-none');
                    (arr.arus_t == 1) ? $('#cont-upd-arus-t').removeClass('d-none'): $('#cont-upd-arus-t').addClass('d-none');
                    (arr.teg_r == 1) ? $('#cont-upd-teg-r').removeClass('d-none'): $('#cont-upd-teg-r').addClass('d-none');
                    (arr.teg_s == 1) ? $('#cont-upd-teg-s').removeClass('d-none'): $('#cont-upd-teg-s').addClass('d-none');
                    (arr.teg_t == 1) ? $('#cont-upd-teg-t').removeClass('d-none'): $('#cont-upd-teg-t').addClass('d-none');
                    (arr.teg_v == 1) ? $('#cont-upd-teg-v').removeClass('d-none'): $('#cont-upd-teg-v').addClass('d-none');
                    (arr.psi == 1) ? $('#cont-upd-psi').removeClass('d-none'): $('#cont-upd-psi').addClass('d-none');
                    (arr.oli == 1) ? $('#cont-upd-oli').removeClass('d-none'): $('#cont-upd-oli').addClass('d-none');
                    (arr.solar == 1) ? $('#cont-upd-solar').removeClass('d-none'): $('#cont-upd-solar').addClass('d-none');
                    (arr.radiator == 1) ? $('#cont-upd-radiator').removeClass('d-none'): $('#cont-upd-radiator').addClass('d-none');
                    (arr.eng_hours == 1) ? $('#cont-upd-eng-hours').removeClass('d-none'): $('#cont-upd-eng-hours').addClass('d-none');
                    (arr.accu == 1) ? $('#cont-upd-accu').removeClass('d-none'): $('#cont-upd-accu').addClass('d-none');
                    (arr.temp == 1) ? $('#cont-upd-temp').removeClass('d-none'): $('#cont-upd-temp').addClass('d-none');
                    (arr.kap == 1) ? $('#cont-upd-kap').removeClass('d-none'): $('#cont-upd-kap').addClass('d-none');
                    (arr.noice == 1) ? $('#cont-upd-noice').removeClass('d-none'): $('#cont-upd-noice').addClass('d-none');
                    (arr.qty == 1) ? $('#cont-upd-qty').removeClass('d-none'): $('#cont-upd-qty').addClass('d-none');
                    (arr.vol == 1) ? $('#cont-upd-vol').removeClass('d-none'): $('#cont-upd-vol').addClass('d-none');
                    (arr.tgl_kadaluarsa == 1) ? $('#cont-upd-tgl-kadaluarsa').removeClass('d-none'): $('#cont-upd-tgl-kadaluarsa').addClass('d-none');
                    (arr.kondisi == 1) ? $('#cont-upd-kondisi').removeClass('d-none'): $('#cont-upd-kondisi').addClass('d-none');
                    (arr.tindakan == 1) ? $('#cont-upd-tindakan').removeClass('d-none'): $('#cont-upd-tindakan').addClass('d-none');

                })

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
                //$('#approve-keterangan').val(data['keterangan']);

                //Keterangan
                //Data keterangan baru pake -new
                if (data['keterangan'] == null || data['keterangan'] == '') {
                    $('#approve-keterangan').addClass("d-none");
                } else {
                    $('#approve-keterangan').removeClass("d-none");

                }
                $('#approve-keterangan-new').val('');
                $('#approve-keterangan').val(data['keterangan']);

                //end Keterangan



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
                    'keterangan': $('#upd-keterangan-new').val(),
                    'id_user': $('#upd-id-user').val(),

                    'pk': $('#upd-pk').val(),
                    'arus_r': $('#upd-arus-r').val(),
                    'arus_s': $('#upd-arus-s').val(),
                    'arus_t': $('#upd-arus-t').val(),
                    'teg_r': $('#upd-teg-r').val(),
                    'teg_s': $('#upd-teg-s').val(),
                    'teg_t': $('#upd-teg-t').val(),
                    'teg_v': $('#upd-teg-v').val(),
                    'psi': $('#upd-psi').val(),
                    'oli': $('#upd-oli').val(),
                    'solar': $('#upd-solar').val(),
                    'radiator': $('#upd-radiator').val(),
                    'eng_hours': $('#upd-eng-hours').val(),
                    'accu': $('#upd-accu').val(),
                    'temp': $('#upd-temp').val(),
                    'kap': $('#upd-kap').val(),
                    'noice': $('#upd-noice').val(),
                    'qty': $('#upd-qty').val(),
                    'vol': $('#upd-vol').val(),
                    'tgl_kadaluarsa': $('#upd-tgl-kadaluarsa').val(),
                    'kondisi': $('#upd-kondisi').val(),
                    'tindakan': $('#upd-tindakan').val(),

                },
                success: function(response) {
                    if (response.status == 'nok') {
                        $('#modal-konfirmasi').modal('hide')
                        $('#modal-update').modal('show')

                        // Fungsi untuk menampilkan pesan error jika inputan tidak sesuai (form_validation) 
                        cek_error(response.err_jenis_pekerjaan, 'upd-jenis-pekerjaan');
                        cek_error(response.err_uraian_pekerjaan, 'upd-uraian-pekerjaan');
                        cek_error(response.err_keterangan, 'upd-keterangan-new');

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



        //konfirmasi Approve yes
        $('#btn-yes-approve').on('click', function(e) {
            e.preventDefault();
            //$('#modal-update').modal('hide')
            $('#modal-konfirmasi-approve').modal('hide')
            $('#modal-konfirmasi-apryes').modal('show')

        });

        $('#btn-batal-apryes').on('click', function(e) {
            e.preventDefault();

            $('#modal-konfirmasi-apryes').modal('hide')
            $('#modal-konfirmasi-approve').modal('show')



        })

        $('#btn-yes-apryes').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo base_url(); ?>jadwal/rutin/view/approve",
                type: 'post',
                dataType: 'json',
                data: {
                    'status': 'ok',
                    'id_rutin': $('#id-approve').val(),
                    'keterangan': $('#approve-keterangan-new').val(),
                },
                success: function(response) {
                    if (response.status == 'nok') {
                        $('#modal-konfirmasi-apryes').modal('hide')
                        $('#id-approve').val('');
                        createNotification(1, response.info)
                    } else {
                        $('#modal-konfirmasi-apryes').modal('hide')
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
            //$('#modal-update').modal('hide')
            if ($('#approve-keterangan-new').val() == "") {
                add_error('approve-keterangan-new')
            } else {
                $('#modal-konfirmasi-approve').modal('hide')
                $('#modal-konfirmasi-aprno').modal('show')
            }


        });

        $('#btn-batal-aprno').on('click', function(e) {
            e.preventDefault();

            $('#modal-konfirmasi-aprno').modal('hide')
            $('#modal-konfirmasi-approve').modal('show')



        })

        $('#btn-yes-aprno').on('click', function(e) {
            e.preventDefault();

            $.ajax({
                url: "<?php echo base_url(); ?>jadwal/rutin/view/approve",
                type: 'post',
                dataType: 'json',
                data: {
                    'status': 'nok',
                    'id_rutin': $('#id-approve').val(),
                    'keterangan': $('#approve-keterangan-new').val(),
                },
                success: function(response) {
                    if (response.status == 'nok') {
                        $('#modal-konfirmasi-aprno').modal('hide')
                        $('#id-approve').val('');

                    } else {
                        $('#modal-konfirmasi-aprno').modal('hide')
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
            today = 'nok'
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

        function clear_form(id) {
            $("#" + id).removeClass("is-invalid");
            $("#" + id).val("");
            $("#er-" + id).val('')

        };

        function add_error(id) {
            $("#" + id).addClass("is-invalid");
            $("#er-" + id).html('Harus di isi')
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
                        'today': today,
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