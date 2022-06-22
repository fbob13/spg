<div class="container-fluid">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="d-flex flex-wrap align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Pengguna Aplikasi
                </h2>
            </div>
            <div class="ms-auto">
                <a href="#" class="btn btn-primary d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-new">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Tambah Data
                </a>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive p-3">
                    <table class="table table-vcenter text-nowrap table-bordered" id='postsList' width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="w-1">No.</th>
                                <th>nn id_User</th>
                                <th>nn spc</th>
                                <th>nn foto</th>
                                <th>nn jenkel</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Nip</th>
                                <th>Akses</th>
                                <th>Alamat</th>
                                <th>Jabatan</th>
                                <th>Jenis Kelamin</th>
                                <th>Telp</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tabel-body">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--Modal Add New-->
    <div class="modal modal-blur fade" id="modal-new" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Buat User Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-new">
                    <div class="modal-body">
                        <div class="">
                            <?php
                            //Buat form input fungsi ada di file helper/h_form_helper.php
                            echo create_form(array(
                                'type' => 'text',
                                'id' => 'username',
                                'label' => 'Username',
                                'placeholder' => '',
                                'value' => '',
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'text',
                                'id' => 'nama',
                                'label' => 'Nama',
                                'placeholder' => '',
                                'value' => '',
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'text',
                                'id' => 'nip',
                                'label' => 'Nip',
                                'placeholder' => '',
                                'value' => '',
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'text',
                                'id' => 'jabatan',
                                'label' => 'Jabatan',
                                'placeholder' => '',
                                'value' => '',
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'select',
                                'id' => 'spc',
                                'label' => 'Group Akses',
                                'placeholder' => '',
                                'value' => array(
                                    array('val' => '0', 'deskripsi' => 'Teknisi'),
                                    array('val' => '1', 'deskripsi' => 'Admin'),
                                    array('val' => '2', 'deskripsi' => 'User'),
                                    array('val' => '99', 'deskripsi' => 'Super User'),
                                ),
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'text',
                                'id' => 'alamat',
                                'label' => 'Alamat',
                                'placeholder' => '',
                                'value' => '',
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'select',
                                'id' => 'jenkel',
                                'label' => 'Jenis Kelamin',
                                'placeholder' => '',
                                'value' => array(array('val' => 'l', 'deskripsi' => 'Laki-laki'), array('val' => 'p', 'deskripsi' => 'Perempuan')),
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'text',
                                'id' => 'telepon',
                                'label' => 'Telepon',
                                'placeholder' => '',
                                'value' => '',
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'email',
                                'id' => 'email',
                                'label' => 'Email',
                                'placeholder' => '',
                                'value' => '',
                                'attr' => ''
                            ));

                            ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn me-auto" data-bs-dismiss="modal">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary ms-auto">
                            <!-- Download SVG icon from http://tabler-icons.io/i/checkup-list -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                <rect x="9" y="3" width="6" height="4" rx="2" />
                                <path d="M9 14h.01" />
                                <path d="M9 17h.01" />
                                <path d="M12 16l1 1l3 -3" />
                            </svg>
                            Simpan Data
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--Modal Update-->
    <div class="modal modal-blur fade" id="modal-update" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Master Pekerjaan Rutin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-update">
                    <div class="modal-body">
                        <div class="">
                            <input type="hidden" id="upd-id-user" value="">
                            <?php
                            //Buat form input fungsi ada di file helper/h_form_helper.php
                            echo create_form(array(
                                'type' => 'text',
                                'id' => 'upd-username',
                                'label' => 'Username',
                                'placeholder' => '',
                                'value' => '',
                                'attr' => 'readonly'
                            ));

                            echo create_form(array(
                                'type' => 'text',
                                'id' => 'upd-nama',
                                'label' => 'Nama',
                                'placeholder' => '',
                                'value' => '',
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'text',
                                'id' => 'upd-nip',
                                'label' => 'Nip',
                                'placeholder' => '',
                                'value' => '',
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'text',
                                'id' => 'upd-jabatan',
                                'label' => 'Jabatan',
                                'placeholder' => '',
                                'value' => '',
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'select',
                                'id' => 'upd-spc',
                                'label' => 'Group Akses',
                                'placeholder' => '',
                                'value' => array(
                                    array('val' => '0', 'deskripsi' => 'Teknisi'),
                                    array('val' => '1', 'deskripsi' => 'Admin'),
                                    array('val' => '2', 'deskripsi' => 'User'),
                                ),
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'text',
                                'id' => 'upd-alamat',
                                'label' => 'Alamat',
                                'placeholder' => '',
                                'value' => '',
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'select',
                                'id' => 'upd-jenkel',
                                'label' => 'Jenis Kelamin',
                                'placeholder' => '',
                                'value' => array(array('val' => 'l', 'deskripsi' => 'Laki-laki'), array('val' => 'p', 'deskripsi' => 'Perempuan')),
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'text',
                                'id' => 'upd-telepon',
                                'label' => 'Telepon',
                                'placeholder' => '',
                                'value' => '',
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'email',
                                'id' => 'upd-email',
                                'label' => 'Email',
                                'placeholder' => '',
                                'value' => '',
                                'attr' => ''
                            ));

                            ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn me-auto" data-bs-dismiss="modal">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary ms-auto">
                            <!-- Download SVG icon from http://tabler-icons.io/i/checkup-list -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                <rect x="9" y="3" width="6" height="4" rx="2" />
                                <path d="M9 14h.01" />
                                <path d="M9 17h.01" />
                                <path d="M12 16l1 1l3 -3" />
                            </svg>
                            Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal Delete-->
    <div class="modal modal-blur fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Data Pekerjaan Rutin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-detail-hapus">
                    Yakin akan menghapus data data <span class="text-danger" id="desc_delete"> </span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Batal</button>
                    <form id="form-delete">
                        <input type="hidden" val="" id="del-id-user">
                        <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Hapus Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>