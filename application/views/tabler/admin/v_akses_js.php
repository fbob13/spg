<script>
    $(document).ready(function() {
        var string_btn_tbl = '<a href="#" class="btn btn-icon text-primary btn-light me-2 " c-aksi="update"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg></a>'
        string_btn_tbl += '<a href="#" class="btn btn-icon text-danger btn-light " c-aksi="delete"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>'



        //Fungsi Menampilkan tombol edit & delete di tabel 
        $('#postsList tbody').on('click', 'a', function(e) {
            e.preventDefault()

            aksi = $(this).attr('c-aksi');
            tbspc = $(this).attr('c-spc');

            if (aksi == 'update') {
                $('#modal-update').modal('show')
                $("input[name='check_view']").prop('checked', false)
                $("input[name='check_edit']").prop('checked', false)
                $("input[name='check_delete']").prop('checked', false)

                $('#modal-detail-table').empty();
                hasil = 'nok'
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/akses/data',
                    type: 'post',
                    data: {
                        'spc': tbspc
                    },
                    dataType: 'json',
                    success: function(response) {

                        hasil = '';
                        no = 0;
                        for (index in response.data) {
                            no = no + 1;
                            xview = response.data[index].vw == 1 ? 'checked' : 'nok';
                            xedit = response.data[index].edt == 1 ? 'checked' : 'nok';
                            xdelete = response.data[index].del == 1 ? 'checked' : 'nok';
                            hasil += '<tr>'
                            hasil += '  <td>' + no + '</td>'
                            hasil += '  <td>' + response.data[index].deskripsi_halaman + '</td>'
                            hasil += '  <td class="text-center"><input type="checkbox" name="role_view[]" value="' + response.data[index].kode_halaman + '" ' + xview + '></td>'
                            hasil += '  <td class="text-center"><input type="checkbox" name="role_edit[]" value="' + response.data[index].kode_halaman + '" ' + xedit + '></td>'
                            hasil += '  <td class="text-center"><input type="checkbox" name="role_delete[]" value="' + response.data[index].kode_halaman + '" ' + xdelete + '></td>'
                            hasil += '</tr>'

                        }

                        $('#role-spc').val(tbspc);
                        $('#modal-detail-table').html(hasil);
                        //$('#modal-detail-thead').html(data_username + '(' + data_nik + ')');

                    }
                });
            }

        });



        //Simpan hasil update (form update)
        $('#form-update').submit(function(e) {

            e.preventDefault();
            var role_view = $('input[name="role_view[]"]:checked').map(function() {
                return this.value;
            }).get()
            var role_edit = $('input[name="role_edit[]"]:checked').map(function() {
                return this.value;
            }).get()
            var role_delete = $('input[name="role_delete[]"]:checked').map(function() {
                return this.value;
            }).get()
            role_spc = $('input[name="role-spc"]').val();
            if (role_spc !== '') {
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/akses/upd',
                    type: 'post',
                    data: {
                        'role_view': role_view,
                        'role_edit': role_edit,
                        'role_delete': role_delete,
                        'spc': role_spc
                    },
                    dataType: 'json',
                    success: function(response) {
                        //$('#modal-detail').html(response);

                        $('#modal-update').modal('hide');

                        $('#modal-success-info').empty();
                        $('#modal-success-info').html(response.info);        
                        $('#modal-success').modal('show');

                    }
                });
            } else {
                alert('Silahkan Memilih Data');
            }
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


        $("#check_view").change(function() {
            if (this.checked) {
                $("input[name='role_view[]']").prop('checked', true)
            } else {
                $("input[name='role_view[]']").prop('checked', false)
            }
        })

        $("#check_edit").change(function() {
            if (this.checked) {
                $("input[name='role_edit[]']").prop('checked', true)
            } else {
                $("input[name='role_edit[]']").prop('checked', false)
            }
        })

        $("#check_delete").change(function() {
            if (this.checked) {
                $("input[name='role_delete[]']").prop('checked', true)
            } else {
                $("input[name='role_delete[]']").prop('checked', false)
            }
        })



    });
</script>