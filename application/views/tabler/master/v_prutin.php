<div class="container-fluid">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="d-flex flex-wrap align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Master Pekerjaan Rutin
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
                                <th>nn</th>
                                <th>nn</th>
                                <th>nn</th>
                                <th>nn</th>
                                <th>Jenis Pekerjaan</th>
                                <th>Uraian Pekerjaan</th>
                                <th>Kategori</th>
                                <th>Interval</th>
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
                    <h5 class="modal-title">Buat Master Pekerjaan Rutin Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-new">
                    <div class="modal-body">
                        <div class="">
                            <?php
                            //Buat form input fungsi ada di file helper/h_form_helper.php
                            echo create_form(array(
                                'type' => 'text',
                                'id' => 'jenis-pekerjaan',
                                'label' => 'Jenis Pekerjaan',
                                'placeholder' => '',
                                'value' => '',
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'text',
                                'id' => 'uraian-pekerjaan',
                                'label' => 'Uraian Pekerjaan',
                                'placeholder' => '',
                                'value' => '',
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'select',
                                'id' => 'id-kategori',
                                'label' => 'Kategori',
                                'placeholder' => '',
                                'value' => $kategori,
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'text-select',
                                'id' => 'interval',
                                'label' => 'interval',
                                'placeholder' => 'Interval pekerjaan',
                                'value' => array(array('val'=>1,'deskripsi'=>'Hari'),array('val'=>7,'deskripsi'=>'Minggu'),array('val'=>30,'deskripsi'=>'Bulan'),array('val'=>365,'deskripsi'=>'Tahun')),
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
                            <input type="hidden" id="upd-id-pkrutin" value="">
                            <?php
                            //Buat form input fungsi ada di file helper/h_form_helper.php
                            echo create_form(array(
                                'type' => 'text',
                                'id' => 'upd-jenis-pekerjaan',
                                'label' => 'Jenis Pekerjaan',
                                'placeholder' => 'Jenis Pekerjaan',
                                'value' => '',
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'text',
                                'id' => 'upd-uraian-pekerjaan',
                                'label' => 'Uraian Pekerjaan',
                                'placeholder' => 'Uraian Pekerjaan',
                                'value' => '',
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'select',
                                'id' => 'upd-id-kategori',
                                'label' => 'Kategori',
                                'placeholder' => 'Pilih Kategori',
                                'value' => $kategori,
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'text-select',
                                'id' => 'upd-interval',
                                'label' => 'interval',
                                'placeholder' => 'Interval pekerjaan',
                                'value' => array(array('val'=>1,'deskripsi'=>'Hari'),array('val'=>7,'deskripsi'=>'Minggu'),array('val'=>30,'deskripsi'=>'Bulan'),array('val'=>365,'deskripsi'=>'Tahun')),
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
                        <input type="hidden" val="" id="del-id-pkrutin">
                        <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Hapus Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>