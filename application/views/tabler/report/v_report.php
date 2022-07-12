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
                            <div>Jenis Laporan</div>
                                <select id="type-report" name="type" class="form-select">
                                   
                                    <option value="">Pilih Jenis Laporan </option>
                                    <option value="1" <?php echo ($type == 1 ? 'selected' : ''); ?>>Laporan Pekerjaan Rutin</option>
                                    <option value="2" <?php echo ($type == 2 ? 'selected' : ''); ?>>Laporan Kerusakan</option>
                                    <option value="4" <?php echo ($type == 4 ? 'selected' : ''); ?>>Laporan Pemeliharaan Rutin</option>
                                </select>
                            </div>
                            <div class="d-flex align-items-center mb-3" id="s-teknisi">
                                <select id="qs-teknisi" class="form-select" name="qs-teknisi">
                                    <option value="">Semua Teknisi</option>
                                    <?php
                                    foreach ($data_teknisi as $tek) {
                                        echo '<option value="' . $tek->id_user . '">' . $tek->nama . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="d-flex align-items-center mb-3" id="s-tanggal">
                                Tanggal
                                <input type="text" class="ms-2 form-control" id="qs-tanggal-awal" name="qs-tanggal-awal" value="<?php echo $tanggal_awal; ?>" style="max-width:120px;">
                                <div class="mx-2">s/d</div>
                                <input type="text" class="form-control" id="qs-tanggal-akhir" name="qs-tanggal-akhir" value="<?php echo $tanggal_akhir; ?>" style="max-width:120px;">

                            </div>
                            <div class="d-flex align-items-center mb-3" id="s-status">
                                <select id="qs-status" class="form-select" name="qs-status">
                                    <option value="99">Semua Status</option>
                                    <option value="0">Belum Dikerjakan</option>
                                    <option value="1">On Progress</option>
                                    <option value="2">Pending</option>
                                    <option value="3">Selesai</option>
                                    <option value="4">Tidak Dikerjakan</option>
                                </select>
                            </div>

                            <div class="d-flex align-items-center mb-3 d-none" id="s-subkat">
                                <select id="qs-subkat" class="form-select" name="qs-subkat">
                                    <?php foreach($subkategori as $sk){
                                        echo '<option value="'. $sk->val .'">'. $sk->deskripsi .'</option>';
                                    }?>
                                </select>
                            </div>

                            <div id="s-btn" class="d-none">
                                <button class="btn btn-danger" id="btn-reset">reset</button>
                                <button type="submit" class="btn btn-primary" id="btn-cari">Cari</button>

                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="table-responsive" id="tbl-wrap">
                        <table id="result-report" class="table table-bordered table-vcenter text-nowrap datatable" style="width:100%">
                            <thead>
                                <?php
                                if ($type == '0') {
                                } else if ($type == 1 || $type == 2) {
                                ?>
                                    <tr>
                                        <th class="text-center">Teknisi</th>
                                        <th class="text-center">Jadwal</th>
                                        <th class="text-center">Selesai</th>
                                        <th class="text-center">Gedung</th>
                                        <th class="text-center">Ruangan</th>
                                        <th class="text-center">Item</th>
                                        <th class="text-center">Pekerjaan</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Keterangan</th>
                                    </tr>
                                <?php
                                } else if ($type == '3') {
                                ?>
                                    <tr>
                                        <th class="text-center">Teknisi</th>
                                        <th class="text-center">Lapor</th>
                                        <th class="text-center">Selesai</th>
                                        <th class="text-center">Gedung</th>
                                        <th class="text-center">Ruangan</th>
                                        <th class="text-center">Item</th>
                                        <th class="text-center">Keluhan</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Keterangan</th>
                                    </tr>

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
