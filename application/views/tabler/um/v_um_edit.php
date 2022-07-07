<div class="container-fluid">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Edit User Manual
                </h2>
            </div>
            <!-- Page title actions -->
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-fluid">

        <!-- Content here -->
        <div class="row row-cards">
            <div class="col-12">

                <form action="<?php echo base_url(); ?>um/edit" method="post">
                    <textarea name="content" id="editor">
                    <?php echo $content;?>
                    </textarea>
                    <p><input type="submit" value="Submit"></p>
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
                <div>Menyimpan data jadwal baru</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto" id="btn-batal">Batal</button>
                <button type="button" class="btn btn-danger" id="btn-yes">Ya, simpan jadwal</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi -->
<div class="modal modal-blur fade" id="modal-konfirmasi-del" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">Anda Yakin</div>
                <div>Data akan di Hapus</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto" id="btn-batal-del">Batal</button>
                <button type="button" class="btn btn-danger" id="btn-yes-del">Ya, hapus data</button>
            </div>
        </div>
    </div>
</div>