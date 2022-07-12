<div class="container-fluid">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="d-flex flex-wrap align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Master Item
                </h2>
            </div>
            <div class="ms-auto">
                <a href="#" class="btn btn-primary d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-new" id="btn-new">
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
                                <th>Nama Item</th>
                                <th>Merek</th>
                                <th>tipe</th>
                                <th>Kategori</th>
                                <th>Subkategori</th>
                                <th>Aksi</th>
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
                    <h5 class="modal-title">Buat Master Item Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-new">
                    <div class="modal-body">
                        <div class="">
                            <?php
                            //Buat form, fungsi ada di file helper/h_form_helper.php
                            echo create_form(array(
                                'type' => 'text',
                                'id' => 'nama-item',
                                'label' => 'Nama Item',
                                'placeholder' => 'Nama Item',
                                'value' => '',
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'text',
                                'id' => 'merek-item',
                                'label' => 'Merek Item',
                                'placeholder' => 'Merek Item',
                                'value' => '',
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'text',
                                'id' => 'tipe-item',
                                'label' => 'Tipe Item',
                                'placeholder' => 'Tipe Item',
                                'value' => '',
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'select',
                                'id' => 'kategori',
                                'label' => 'Kategori',
                                'placeholder' => 'Kategori',
                                'value' => $kategori,
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'select',
                                'id' => 'subkategori',
                                'label' => 'Subkategori',
                                'placeholder' => 'Subkategori',
                                'value' => array(),
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
                    <h5 class="modal-title">Update Master Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-update">
                    <div class="modal-body">
                        <div class="">
                            <input type="hidden" id="upd-id-item" value="">
                            <?php
                            //Buat form, fungsi ada di file helper/h_form_helper.php
                            echo create_form(array(
                                'type' => 'text',
                                'id' => 'upd-nama-item',
                                'label' => 'Nama Item',
                                'placeholder' => 'Nama Item',
                                'value' => '',
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'text',
                                'id' => 'upd-merek-item',
                                'label' => 'Merek Item',
                                'placeholder' => 'Merek Item',
                                'value' => '',
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'text',
                                'id' => 'upd-tipe-item',
                                'label' => 'Tipe Item',
                                'placeholder' => 'Tipe Item',
                                'value' => '',
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'select',
                                'id' => 'upd-kategori',
                                'label' => 'Kategori',
                                'placeholder' => 'Kategori',
                                'value' => $kategori,
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'select',
                                'id' => 'upd-subkategori',
                                'label' => 'Subkategori',
                                'placeholder' => 'Subkategori',
                                'value' => array(),
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


    <!-- Modal Delete-->
    <div class="modal modal-blur fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Data Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-detail-hapus">
                    Yakin akan menghapus data item <span class="text-danger" id="desc_delete"> </span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Batal</button>
                    <form id="form-delete">
                        <input type="hidden" val="" id="del-id-item">
                        <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Hapus Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi -->
    <div class="modal modal-blur fade" id="modal-konfirmasi" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-title">Anda Yakin</div>
                    <div>Anda akan merubah / update data</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary me-auto" id="btn-batal">Batal</button>
                    <button type="button" class="btn btn-success  " id="btn-yes">Ya, Update Data</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi -->
    <div class="modal modal-blur fade" id="modal-konfirmasi-new" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-title">Anda Yakin</div>
                    <div>Anda akan menyimpan item baru</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary me-auto" id="btn-batal-new">Batal</button>
                    <button type="button" class="btn btn-success  " id="btn-yes-new">Ya, Simpan Data</button>
                </div>
            </div>
        </div>
    </div>

</div>