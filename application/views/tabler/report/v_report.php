<?php
$judul['view_pinjam'] = '';
$judul['ready'] = 'Pencarian : Dokumen Ready';
$judul['booked'] = 'Pencarian : Dokumen Booked';
$judul['terpakai'] = 'Pencarian : Dokumen Terpakai';
$judul['back_today'] = 'Pencarian : Dokumen Tanggal Kembali Hari Ini';
$judul['terlambat'] = 'Pencarian : Dokumen Terlambat Dikembalikan';
?>
<div class="container-fluid">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Report

                </h2>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">

                <div class="card-body border-bottom py-3">
                    <div class="d-flex flex-wrap">
                        <form action="<?php echo base_url(); ?>report" method="post">
                            <div class="w-100 mb-3">
                                <select id="type-report" name="type" class="form-select">
                                    <option value="">Pilih Jenis Laporan </option>
                                    <?php /*<option value="1" <?php echo ($type == 1 ? 'selected' : ''); ?>>Laporan Total Peminjaman Harian</option>
                                    <option value="2" <?php echo ($type == 2 ? 'selected' : ''); ?>>Laporan Total Peminjaman Bulanan</option> */ ?>
                                    <?php if($this->session->userdata('spc') == 1){ ?>
                                    <option value="3" <?php echo ($type == 3 ? 'selected' : ''); ?>>Jumlah Dokumen per Kategori</option>
                                    <option value="4" <?php echo ($type == 4 ? 'selected' : ''); ?>>Jumlah Dokumen per Subkategori</option>
                                    <?php } ?>
                                    <?php /*<option value="5" <?php echo ($type == 5 ? 'selected' : ''); ?>>Peminjaman Dokumen (Pegawai)</option>
                                    <option value="6" <?php echo ($type == 6 ? 'selected' : ''); ?>>Peminjaman Dokumen (Petugas)</option> */ ?>
                                    <option value="7" <?php echo ($type == 7 ? 'selected' : ''); ?>>History Peminjaman Dokumen</option>
                                </select>
                            </div>
                            <div class="d-flex align-items-center mb-3 d-none" id="s-tanggal">
                                <select name="bulan1" class="form-select me-2" id="cari-bulan1">
                                    <option value="" <?php echo ($bulan1 == '' ? 'selectedx' : ''); ?>>Bulan</option>
                                    <option value="01" <?php echo ($bulan1 == '01' ? 'selected' : ''); ?>>Januari</option>
                                    <option value="02" <?php echo ($bulan1 == '02' ? 'selected' : ''); ?>>Februari</option>
                                    <option value="03" <?php echo ($bulan1 == '03' ? 'selected' : ''); ?>>Maret</option>
                                    <option value="04" <?php echo ($bulan1 == '04' ? 'selected' : ''); ?>>April</option>
                                    <option value="05" <?php echo ($bulan1 == '05' ? 'selected' : ''); ?>>Mei</option>
                                    <option value="06" <?php echo ($bulan1 == '06' ? 'selected' : ''); ?>>Juni</option>
                                    <option value="07" <?php echo ($bulan1 == '07' ? 'selected' : ''); ?>>Juli</option>
                                    <option value="08" <?php echo ($bulan1 == '08' ? 'selected' : ''); ?>>Agustus</option>
                                    <option value="09" <?php echo ($bulan1 == '09' ? 'selected' : ''); ?>>September</option>
                                    <option value="10" <?php echo ($bulan1 == '10' ? 'selected' : ''); ?>>Oktober</option>
                                    <option value="11" <?php echo ($bulan1 == '11' ? 'selected' : ''); ?>>November</option>
                                    <option value="12" <?php echo ($bulan1 == '12' ? 'selected' : ''); ?>>Desember</option>
                                </select>
                                <div class="me-2">s/d</div>
                                <select name="bulan2" class="form-select me-2" id="cari-bulan2">
                                    <option value="" <?php echo ($bulan2 == '' ? 'selectedx' : ''); ?>>Bulan</option>
                                    <option value="01" <?php echo ($bulan2 == '01' ? 'selected' : ''); ?>>Januari</option>
                                    <option value="02" <?php echo ($bulan2 == '02' ? 'selected' : ''); ?>>Februari</option>
                                    <option value="03" <?php echo ($bulan2 == '03' ? 'selected' : ''); ?>>Maret</option>
                                    <option value="04" <?php echo ($bulan2 == '04' ? 'selected' : ''); ?>>April</option>
                                    <option value="05" <?php echo ($bulan2 == '05' ? 'selected' : ''); ?>>Mei</option>
                                    <option value="06" <?php echo ($bulan2 == '06' ? 'selected' : ''); ?>>Juni</option>
                                    <option value="07" <?php echo ($bulan2 == '07' ? 'selected' : ''); ?>>Juli</option>
                                    <option value="08" <?php echo ($bulan2 == '08' ? 'selected' : ''); ?>>Agustus</option>
                                    <option value="09" <?php echo ($bulan2 == '09' ? 'selected' : ''); ?>>September</option>
                                    <option value="10" <?php echo ($bulan2 == '10' ? 'selected' : ''); ?>>Oktober</option>
                                    <option value="11" <?php echo ($bulan2 == '11' ? 'selected' : ''); ?>>November</option>
                                    <option value="12" <?php echo ($bulan2 == '12' ? 'selected' : ''); ?>>Desember</option>
                                </select>
                                <input class="form-control  " type="number" placeholder="Tahun" id="cari-tahun" name="tahun" value="<?php echo $tahun; ?>">

                            </div>
                            <div class="d-flex align-items-center mb-3 d-none" id="s-kat">
                                <select id="qs-kategori" class="form-select me-2" name="kategori">
                                    <option value="">Kategori</option>
                                    <?php
                                    foreach ($data_kategori as $datakat) {
                                        echo '<option value="' . $datakat->kode_kategori . '">' . $datakat->nama_kategori . '</option>';
                                    }
                                    ?>
                                </select>
                                <select id="qs-subkategori" class="form-select" name="subkategori">
                                    <option value="">Subkategori</option>
                                    <?php
                                    if (isset($subkategori)) {
                                        foreach ($data_subkategori as $datasub) {
                                            echo '<option value="' . $datasub->kode_subkategori . '">' . $datasub->nama_subkategori . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="d-flex align-items-center mb-3 d-none" id="s-kec">
                                <select id="qs-kecamatan" class="form-select me-2" name="kecamatan">
                                    <option value="">Kecamatan</option>
                                    <?php
                                    foreach ($data_kecamatan as $datakec) {
                                        echo '<option value="' . $datakec->kode_kecamatan . '">' . $datakec->nama_kecamatan . '</option>';
                                    }
                                    ?>
                                </select>
                                <select id="qs-kelurahan" class="form-select" name="kelurahan">
                                    <option value="">Kelurahan</option>
                                    <?php
                                    if (isset($kecamatan)) {
                                        foreach ($data_kelurahan as $datakel) {
                                            echo '<option value="' . $datakel->kode_kelurahan . '">' . $datakel->nama_kelurahan . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="d-flex align-items-center mb-3 d-none" id="s-peg">
                                <input type="text" placeholder="Nama Pegawai" class="form-control me-2 <?php if($this->session->userdata('spc')==0) echo 'd-none';?>" name="pegawai" id="qs-pegawai" value="<?php echo $pegawai;?>" >
                                <input type="text" placeholder="Nomor Dokumen" class="form-control" name="dokumen" id="qs-dokumen" value="<?php echo $dokumen;?>">

                            </div>
                            
                            <div id="s-btn" class="d-none">
                            <button class="btn btn-danger" id="btn-reset">reset</button>
                                <button type="submit" class="btn btn-primary" id="btn-cari">Cari</button>
                                
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="table-responsive" id="tbl-wrap">
                        <table id="result-report" class="table card-table table-bordered table-vcenter text-nowrap datatable" style="width:100%">
                            <thead>
                                <?php
                                if ($type == '0') {
                                } else if ($type == 1) {
                                ?>
                                    <tr>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Dokumen Keluar</th>
                                    </tr>
                                <?php
                                } else if ($type == '2') {
                                ?>
                                    <tr>
                                        <th class="text-center">Bulan</th>
                                        <th class="text-center">Dokumen Keluar</th>
                                    </tr>

                                <?php
                                } else if ($type == '3') {
                                ?>
                                    <tr>
                                        <th class="text-center">Kode Kategori</th>
                                        <th class="text-center">Deskripsi Kategori</th>
                                        <th class="text-center">Jumlah Dokumen</th>
                                    </tr>
                                <?php
                                } else if ($type == '4') {
                                ?>
                                    <tr>
                                        <th class="text-center">Kode Kategori</th>
                                        <th class="text-center">Deskripsi Kategori</th>
                                        <th class="text-center">Kode Subkategori</th>
                                        <th class="text-center">Deskripsi Subkategori</th>
                                        <th class="text-center">Jumlah Dokumen</th>
                                    </tr>
                                <?php
                                } else if ($type == '5') {
                                ?>
                                    <tr>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Jumlah Peminjaman</th>
                                    </tr>
                                <?php
                                } else if ($type == '6') {
                                ?>
                                    <tr>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Jumlah Serah Terima</th>
                                    </tr>
                                <?php
                                } else if ($type == '7') {
                                ?>
                                    <th class="text-center">Tanggal Pinjam</th>
                                    <th class="text-center">Tanggal Kembali</th>
                                    <th class="text-center">Nama Peminjam</th>
                                    <th class="text-center">Nomor Berkas</th>
                                    <th class="text-center">Keperluan</th>
                                    <th class="text-center">Nomor Dokumen</th>
                                    <th class="text-center">Nama Dokumen</th>
                                    <th class="text-center">Kategori</th>
                                    <th class="text-center">Subkategori</th>
                                    <th class="text-center">Kelurahan</th>
                                    <th class="text-center">Kecamatan</th>
                                    <th class="text-center">Tahun</th>
                                    <th class="text-center">Tahun GU</th>
                                    <th class="text-center">Status Peminjaman</th>
                                    <th class="text-center">Petugas Cari</th>
                                    <th class="text-center">Petugas Penyerah Dok</th>
                                    <th class="text-center">Petugas Terima Dok</th>

                                <?php
                                }
                                ?>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Modal Add data-->
    <div class="modal modal-blur fade" id="modal-new" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Buat kecamatan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-new-user">
                    <div class="modal-body">
                        <div class="">
                            <div class="form-group mb-3 row">
                                <label class="form-label col-3 col-form-label">Kode Kecamatan</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="new-kode-kecamatan" name="kode_kecamatan" placeholder="Kode Kecamatan" required>
                                    <div class="invalid-feedback mb-0" id="iv-kode-kecamatan"></div>
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label class="form-label col-3 col-form-label">Keterangan</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="new-nama-kecamatan" name="nama_kecamatan" placeholder="Nama Kecamatan" required>
                                    <div class="invalid-feedback" id="iv-nama-kecamatan"></div>
                                </div>
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
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Modal update-->
    <div class="modal modal-blur fade" id="modal-update" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pengembalian Dokumen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-update-data">
                    <div class="modal-body">
                        <div class="">
                            <div class="form-group mb-3 row">
                                <label class="form-label col-3 col-form-label">Nomor Berkas</label>
                                <div class="col">
                                    <input type="hidden" id="upd-nomor-pinjam" value="">
                                    <input type="text" class="form-control" id="upd-nomor-berkas" name="nomor_berkas" placeholder="Nomor Berkas" readonly>
                                    <div class="invalid-feedback mb-0" id="iv-upd-nomor-berkas"></div>
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label class="form-label col-3 col-form-label">Nama Peminjam</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="upd-nama" name="peminjam" placeholder="Peminjam" readonly>
                                    <div class="invalid-feedback" id="iv-upd-nama"></div>
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label class="form-label col-3 col-form-label">Tanggal Kembali</label>
                                <div class="col">
                                    <div class="input-icon">
                                        <span class="input-icon-addon">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                                                <line x1="16" y1="3" x2="16" y2="7"></line>
                                                <line x1="8" y1="3" x2="8" y2="7"></line>
                                                <line x1="4" y1="11" x2="20" y2="11"></line>
                                                <line x1="11" y1="15" x2="12" y2="15"></line>
                                                <line x1="12" y1="15" x2="12" y2="18"></line>
                                            </svg>
                                        </span>
                                        <input class="form-control" placeholder="Select a date" id="upd-tanggal-kembali" value="<?php echo date("Y-m-d"); ?>">
                                        <div class="invalid-feedback" id="iv-upd-tanggal-kembali"></div>
                                    </div>
                                </div>
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
                    <h5 class="modal-title">Hapus Data kecamatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-detail-hapus">
                    Yakin akan menghapus data <span class="text-danger" id="desc_delete"> nomor kecamatan</span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Batal</button>
                    <form id="form-hapus">
                        <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Hapus kecamatan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Dokumen di batalkan/buat BA-->
    <div class="modal modal-blur fade" id="modal-pilih" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-body" id="modal-detail-hapus">
                    <div class="row ">
                        <div class="col-12 text-center mb-3">
                            <button class="btn btn-danger w-80" id="btl-pinjam" ci-nik="">Batalkan Peminjaman</button>
                            <div class="hr-text">Atau</div>
                            <form id="form-ba">

                                <div class="">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Keterangan</label>
                                        <div class="col">
                                            <input type="hidden" id="ba-nomor-pinjam" value="">
                                            <input type="text" class="form-control" id="ba-keterangan" name="ba-keterangan" placeholder="Keterangan Dibatalkan" required>
                                            <div class="invalid-feedback mb-0" id="iv-ba-keterangan"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/checkup-list -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                                <rect x="9" y="3" width="6" height="4" rx="2" />
                                                <path d="M9 14h.01" />
                                                <path d="M9 17h.01" />
                                                <path d="M12 16l1 1l3 -3" />
                                            </svg>
                                            Buat Berita Acara
                                        </button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal View-->
    <div class="modal modal-blur fade" id="modal-view" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Data Peminjam</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="">

                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table">
                                        <tbody id="modal-view-detail">
                                            <tr>
                                                <td>
                                                    <div class="skeleton-line"></div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- MODAL SUCCESS warning-->
    <div class="modal modal-blur fade" id="modal-warning" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-warning"></div>
                <div class="modal-body text-center py-4">
                    <!-- Download SVG icon from http://tabler-icons.io/i/info-circle -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-warning icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <circle cx="12" cy="12" r="9" />
                        <line x1="12" y1="8" x2="12.01" y2="8" />
                        <polyline points="11 12 12 12 12 16 13 16" />
                    </svg>
                    <h3>Update Selesai</h3>
                    <div class="text-muted" id="modal-warning-info">...</div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                    Tutup
                                </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL SUCCESS green-->
    <div class="modal modal-blur fade" id="modal-success" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-success"></div>
                <div class="modal-body text-center py-4">
                    <!-- Download SVG icon from http://tabler-icons.io/i/circle-check -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-success icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <circle cx="12" cy="12" r="9" />
                        <path d="M9 12l2 2l4 -4" />
                    </svg>
                    <h3>Update Selesai</h3>
                    <div class="text-muted" id="modal-success-info">...</div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                    Tutup
                                </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL SUCCESS red-->
    <div class="modal modal-blur fade" id="modal-danger" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <!-- Download SVG icon from http://tabler-icons.io/i/circle-x -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <circle cx="12" cy="12" r="9" />
                        <path d="M10 10l4 4m0 -4l-4 4" />
                    </svg>
                    <h3>Update Selesai</h3>
                    <div class="text-muted" id="modal-danger-info">...</div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                    Tutup
                                </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL DOK OK-->