<div class="container-fluid">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="d-flex flex-wrap align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Master Subkategori
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
                    <table class="table table-vcenter text-wrap table-bordered" id='postsList' width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="w-1">No.</th>
                                <th>nn</th>
                                <th>nn</th>

                                <th>nn Kap. (PK)</th>
                                <th>nn Arus R</th>
                                <th>nn Arus S</th>
                                <th>nn Arus T</th>
                                <th>nn Tegangan (F - N) R</th>
                                <th>nn Tegangan (F - N) S</th>
                                <th>nn Tegangan (F - N) T</th>
                                <th>nn Teg. (V)</th>
                                <th>nn (PSI)</th>
                                <th>nn Oli</th>
                                <th>nn Solar</th>
                                <th>nn Radiator</th>
                                <th>nn Eng. Hours</th>
                                <th>nn Accu</th>
                                <th>nn Temp.</th>
                                <th>nn kap</th>
                                <th>nn noice</th>
                                <th>nn qty</th>
                                <th>nn vol</th>
                                <th>nn tgl kadaluarsa</th>
                                <th>nn kondisi</th>
                                <th>nn Tindakan</th>


                                <th>Kode Subkategori</th>
                                <th>Uraian Subkategori</th>
                                <th>Uraian Kategori</th>
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
                    <h5 class="modal-title">Buat Subkategori Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-new">
                    <div class="modal-body">
                        <div class="">
                            <?php
                            //Buat form input fungsi ada di file helper/h_form_helper.php

                            echo create_form(array(
                                'type' => 'select',
                                'id' => 'id-kategori',
                                'label' => 'Kategori',
                                'placeholder' => 'Kategori',
                                'value' => $kategori,
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'text',
                                'id' => 'kode-subkategori',
                                'label' => 'Kode Subkategori',
                                'placeholder' => 'Kode Subkategori',
                                'value' => '',
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'text',
                                'id' => 'uraian-subkategori',
                                'label' => 'Uraian Subkategori',
                                'placeholder' => 'Uraian Subkategori',
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
                    <h5 class="modal-title">Update Subkategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-update">
                    <div class="modal-body">
                        <div class="">
                            <input type="hidden" id="upd-id-subkategori" value="">
                            <?php
                            //Buat form input fungsi ada di file helper/h_form_helper.php

                            echo create_form(array(
                                'type' => 'select',
                                'id' => 'upd-id-kategori',
                                'label' => 'Kategori',
                                'placeholder' => 'Kategori',
                                'value' => $kategori,
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'text',
                                'id' => 'upd-kode-subkategori',
                                'label' => 'Kode Subkategori',
                                'placeholder' => 'Kode Subkategori',
                                'value' => '',
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'text',
                                'id' => 'upd-uraian-subkategori',
                                'label' => 'Uraian Subkategori',
                                'placeholder' => 'Uraian Subkategori',
                                'value' => '',
                                'attr' => ''
                            ));

                            ?>

                            <div class="hr-text">Kolom Report</div>
                            <div class="d-flex flex-wrap justify-content-start">
                                <?php
                                function create_f_det($judul, $id, $val)
                                {

                                    $tulis = "";
                                    $tulis = $tulis . '<label class="form-check mx-2" style="min-width :150px;">';
                                    $tulis = $tulis . '<input class="form-check-input" type="checkbox" value="' . $val . '" id="' . $id . '" name="upd-det[]" >';
                                    $tulis = $tulis . '<span class="form-check-label ">' . $judul . '</span>';
                                    $tulis = $tulis . '</label>';


                                    return $tulis;
                                }

                                echo create_f_det('Kap. (PK)', 'upd-pk', 'pk');
                                echo create_f_det('Arus R', 'upd-arus-r', 'arus_r');
                                echo create_f_det('Arus S', 'upd-arus-s', 'arus_s');
                                echo create_f_det('Arus T', 'upd-arus-t', 'arus_t');
                                echo create_f_det('Tegangan (F - N) R', 'upd-teg-r', 'teg_r');
                                echo create_f_det('Tegangan (F - N) S', 'upd-teg-s', 'teg_s');
                                echo create_f_det('Tegangan (F - N) T', 'upd-teg-t', 'teg_t');
                                echo create_f_det('Teg. (V)', 'upd-teg-v', 'teg_v');
                                echo create_f_det(' (PSI)', 'upd-psi', 'psi');
                                echo create_f_det('Oli', 'upd-oli', 'oli');
                                echo create_f_det('Solar', 'upd-solar', 'solar');
                                echo create_f_det('Radiator', 'upd-radiator', 'radiator');
                                echo create_f_det('Eng. Hours', 'upd-eng-hours', 'eng_hours');
                                echo create_f_det('Accu', 'upd-accu', 'accu');
                                echo create_f_det('Temp.', 'upd-temp', 'temp');
                                echo create_f_det('kap', 'upd-kap', 'kap');
                                echo create_f_det('noice', 'upd-noice', 'noice');
                                echo create_f_det('qty', 'upd-qty', 'qty');
                                echo create_f_det('vol', 'upd-vol', 'vol');
                                echo create_f_det('tgl kadaluarsa', 'upd-tgl-kadaluarsa', 'tgl_kadaluarsa');
                                echo create_f_det('kondisi', 'upd-kondisi', 'kondisi');
                                echo create_f_det('Tindakan', 'upd-tindakan', 'tindakan');







                                ?>
                            </div>

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
                    <h5 class="modal-title">Hapus Data Subkategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-detail-hapus">
                    Yakin akan menghapus data data <span class="text-danger" id="desc_delete"> </span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Batal</button>
                    <form id="form-delete">
                        <input type="hidden" val="" id="del-id-subkategori">
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
                    <div>Anda akan menyimpan Subkategori baru</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary me-auto" id="btn-batal-new">Batal</button>
                    <button type="button" class="btn btn-success  " id="btn-yes-new">Ya, Simpan Data</button>
                </div>
            </div>
        </div>
    </div>

</div>