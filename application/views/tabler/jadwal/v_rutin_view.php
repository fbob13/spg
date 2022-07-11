<div class="container-fluid">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="d-flex flex-wrap align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Jadwal Pekerjaan Rutin
                </h2>
            </div>
            <div class="d-flex flex-wrap mt-3 mt-md-0">

                <div class="d-flex flex-nowrap">
                    <div class="pe-2">
                        <select class="form-select" id="s-month">
                            <option value="99">Semua Bulan</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="010">November</option>
                            <option value=10>Desember</option>
                        </select>
                    </div>
                    <div class="pe-2">
                        <input type="text" class="form-control" id="s-year" style="width:60px;" value="">
                    </div>

                </div>
                <div class="d-flex flex-nowrap mt-2 mt-md-0">
                    <div class="pe-2">
                        <select class="form-select " id="s-status">
                            <option value="99" selected>Semua Status</option>
                            <option value="0">Belum Dikerjakan</option>
                            <option value="1">On Progress</option>
                            <option value="2">Pending</option>
                            <option value="3">Selesai</option>
                            <option value="4">Tidak Dikerjakan</option>
                            <option value="5">Approved</option>
                        </select>
                    </div>
                    <div>
                        <button class="btn btn-primary" id="btn-query">Query</button>
                    </div>
                </div>

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
                                <th>nn id rutin</th>
                                <th>nn </th>
                                <th>nn status pekerjaan</th>
                                <th>Tanggal</th>
                                <th>Nama Teknisi</th>
                                <th>Gedung</th>
                                <th>Ruangan</th>
                                <th>Item</th>
                                <th>Jenis Pekerjaan</th>
                                <th>Status</th>
                                <th>Keterangan</th>
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
                                'placeholder' => 'Jenis Pekerjaan',
                                'value' => '',
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'text',
                                'id' => 'uraian-pekerjaan',
                                'label' => 'Status Pekerjaan',
                                'placeholder' => 'Uraian Pekerjaan',
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
                    <h5 class="modal-title">Update Status Pekerjaan Rutin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-update">
                    <div class="modal-body">
                        <div class="card mb-3">
                            <table class="table table-vcenter card-table">
                                <tr>
                                    <td class="w-25">Tanggal</td>
                                    <td class="w-1">:</td>
                                    <td id="upd-tanggal-jadwal">-</td>
                                </tr>
                                <tr>
                                    <td>Gedung</td>
                                    <td>:</td>
                                    <td id="upd-gedung">-</td>
                                </tr>
                                <tr>
                                    <td>Ruangan</td>
                                    <td>:</td>
                                    <td id="upd-ruangan">-</td>
                                </tr>
                                <tr>
                                    <td>Item</td>
                                    <td>:</td>
                                    <td id="upd-item">-</td>
                                </tr>
                                <tr>
                                    <td>Jenis Pekerjaan</td>
                                    <td>:</td>
                                    <td id="upd-pekerjaan">-</td>
                                </tr>
                            </table>
                        </div>
                        <div class="">
                            <input type="hidden" id="upd-id-rutin" value="">
                            <?php
                            //Buat form input fungsi ada di file helper/h_form_helper.php


                            echo create_form(array(
                                'type' => 'select',
                                'id' => 'upd-id-user',
                                'label' => 'Teknisi',
                                'placeholder' => '',
                                'value' => $teknisi,
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'select',
                                'id' => 'upd-status-pekerjaan',
                                'label' => 'Status Pekerjaan',
                                'placeholder' => 'Uraian Pekerjaan',
                                'value' => $statuspekerjaan,
                                'attr' => ''
                            ));

                            echo create_form(array(
                                'type' => 'text',
                                'id' => 'upd-keterangan',
                                'label' => 'Keterangan',
                                'placeholder' => 'Keteragan',
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
                        <input type="hidden" val="" id="del-id-rutin">
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
                    <div>Data sebelumnya akan di update</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary me-auto" id="btn-batal">Batal</button>
                    <button type="button" class="btn btn-danger" id="btn-yes">Ya, update data</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Approve -->
    <div class="modal modal-blur fade" id="modal-konfirmasi-approve" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <input type="hidden" value="" id="id-approve">
                <div class="modal-body">
                    <div class="modal-title">Approve data</div>
                    <div class="mb-3">
                        <div class="d-flex flex-column">

                            <div class="d-flex flex-nowrap justify-content-between">
                                <div class="pt-1" id="approve-nama">Nama Teknisi</div>

                                <div class="pt-1" id="approve-tanggal-jadwal">2022-07-07</div>
                            </div>
                            <div class="pt-2" id="approve-gedung">Kantor</div>
                            <div class="pt-1" id="approve-ruangan">Ruangan</div>
                            <div class="pt-1" id="approve-item">AC DAIKIN</div>

                            <div class="pt-1" id="approve-pekerjaan">Cek Freon AC</div>
                            <div class="pt-2">Keterangan : </div>
                            <div class="card mt-1 p-2" id="approve-keterangan">AC sudah di cek dan tidak ada masalah</div>


                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary me-auto" id="btn-batal-approve">Batal</button>
                    <button type="button" class="btn btn-danger" id="btn-no-approve">Tolak</button>
                    <button type="button" class="btn btn-success" id="btn-yes-approve">Ya, approve</button>
                </div>
            </div>
        </div>
    </div>
</div>