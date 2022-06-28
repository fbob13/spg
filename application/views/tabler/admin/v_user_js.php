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
            data: 'id_user',
            visible: false,
            searchable: false,
        }, {
            data: 'spc',
            visible: false,
            searchable: false,
        }, {
            data: 'j_kelamin',
            visible: false,
            searchable: false,
        }, {
            data: 'foto',
            visible: false,
            searchable: false,
        }, {
            data: 'username',
            className: 'text-center'
        }, {
            data: 'nama',
            className: 'text-center'
        }, {
            data: 'nip',
            className: 'text-center'
        }, {
            data: 'deskripsi_spc',
            className: 'text-center'
        }, {
            data: 'alamat',
            className: 'text-center'
        }, {
            data: 'jabatan',
            className: 'text-center'
        }, {
            data: 'j_kelamin_text',
            className: 'text-center'
        }, {
            data: 'telepon',
            className: 'text-center'
        }, {
            data: 'email',
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
            ajax: '<?php echo base_url(); ?>admin/user/data',
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
                $('#upd-id-user').val(data['id_user']);
                $('#upd-username').val(data['username']);
                $('#upd-nama').val(data['nama']);
                $('#upd-spc').val(data['spc']);
                $('#upd-alamat').val(data['alamat']);
                $('#upd-jabatan').val(data['jabatan']);
                $('#upd-jenkel').val(data['j_kelamin']);
                $('#upd-telepon').val(data['telepon']);
                $('#upd-email').val(data['email']);
                $('#upd-nip').val(data['nip']);

                $('#modal-update').modal('show')
            } else if (aksi == 'delete') {
                $('#del-id-user').val(data['id_user']);
                $('#modal-delete').modal('show');
            }
        });
        //Simpan data baru (form insert) 
        $('#form-new').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo base_url(); ?>admin/user/new",
                type: 'post',
                dataType: 'json',
                data: {
                    'username': $('#username').val(),
                    'nama': $('#nama').val(),
                    'spc': $('#spc').val(),
                    'alamat': $('#alamat').val(),
                    'jabatan': $('#jabatan').val(),
                    'j_kelamin': $('#jenkel').val(),
                    'telepon': $('#telepon').val(),
                    'email': $('#email').val(),
                    'nip': $('#nip').val(),

                },
                success: function(response) {
                    if (response.status == 'nok') {
                        cek_error(response.err_username, 'username');
                        cek_error(response.err_nama, 'nama');
                        cek_error(response.err_nip, 'nip');
                        cek_error(response.err_spc, 'spc');
                        cek_error(response.err_alamat, 'alamat');
                        cek_error(response.err_jabatan, 'jabatan');
                        cek_error(response.err_j_kelamin, 'jenkel');
                        cek_error(response.err_telepon, 'telepon');
                        cek_error(response.err_email, 'email');

                    } else {
                        $('#modal-new').modal('hide')
                        $('#modal-success-info').empty();
                        $('#modal-success-info').html(response.info);
                        $('#modal-success').modal('show')
                        $('#modal-success').modal('hide')

                        update_datatables()

                        clear_form('username')
                        clear_form('nama')
                        clear_form('spc')
                        clear_form('alamat')
                        clear_form('jabatan')
                        clear_form('jenkel')
                        clear_form('telepon')
                        clear_form('email')
                        clear_form('nip')



                    }

                }
            });
        });

        //Simpan hasil update (form update)
        $('#form-update').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo base_url(); ?>admin/user/upd",
                type: 'post',
                dataType: 'json',
                data: {
                    'id_user': $('#upd-id-user').val(),
                    //'username': $('#upd-username').val(),
                    'nama': $('#upd-nama').val(),
                    'spc': $('#upd-spc').val(),
                    'alamat': $('#upd-alamat').val(),
                    'jabatan': $('#upd-jabatan').val(),
                    'j_kelamin': $('#upd-jenkel').val(),
                    'telepon': $('#upd-telepon').val(),
                    'email': $('#upd-email').val(),
                    'nip': $('#upd-nip').val(),
                },
                success: function(response) {
                    if (response.status == 'nok') {
                        // Fungsi untuk menampilkan pesan error jika inputan tidak sesuai (form_validation) 

                        //cek_error(response.err_username, 'upd-username');
                        cek_error(response.err_nama, 'upd-nama');
                        cek_error(response.err_nip, 'upd-nip');
                        cek_error(response.err_spc, 'upd-spc');
                        cek_error(response.err_alamat, 'upd-alamat');
                        cek_error(response.err_jabatan, 'upd-jabatan');
                        cek_error(response.err_j_kelamin, 'upd-jenkel');
                        cek_error(response.err_telepon, 'upd-telepon');
                        cek_error(response.err_email, 'upd-email');

                    } else {
                        $('#modal-update').modal('hide')
                        $('#modal-success-info').empty();
                        $('#modal-success-info').html(response.info);
                        $('#modal-success').modal('show')

                        update_datatables()

                        clear_form('upd-username')
                        clear_form('upd-nama')
                        clear_form('upd-spc')
                        clear_form('upd-alamat')
                        clear_form('upd-jabatan')
                        clear_form('upd-jenkel')
                        clear_form('upd-telepon')
                        clear_form('upd-email')
                        clear_form('upd-nip')

                    }

                }
            });
        });

        //Hapus Data
        $('#form-delete').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo base_url(); ?>admin/user/del",
                type: 'post',
                dataType: 'json',
                data: {
                    'id_user': $('#del-id-user').val()
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
            $("#er-" + id).val('')
        }

        $('#modal-new').on('show.bs.modal', function() {
            clear_form('username')
            clear_form('nama')
            clear_form('spc')
            clear_form('alamat')
            clear_form('jabatan')
            clear_form('jenkel')
            clear_form('telepon')
            clear_form('email')
            clear_form('nip')

        })

        function update_datatables() {

            tb = $('#postsList').DataTable({
                destroy: true,
                ajax: '<?php echo base_url(); ?>admin/user/data',
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