        <div class="container-fluid">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <h2 class="page-title">
                  Jadwal Pekerjaan Rutin
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
                <div class="card">
                  <div class="card-body">
                    <form id="form-head">

                      <?php
                      //Buat form input fungsi ada di file helper/h_form_helper.php
                      echo create_form(array(
                        'type' => 'text',
                        'id' => 'tanggal-jadwal',
                        'label' => 'Tanggal',
                        'placeholder' => 'Tanggal',
                        'value' => date("Y-m-d"),
                        'attr' => 'style="max-width:120px;"'
                      ));

                      echo create_form(array(
                        'type' => 'select',
                        'id' => 'id-user',
                        'label' => 'Nama Terknisi',
                        'placeholder' => 'Nama Teknisi',
                        'value' => $teknisi,
                        'attr' => ' style="max-width:300px;"'
                      ));

                      ?>
                      <div class="form-footer">
                        <button id="draft-ok" type="submit" class="btn btn-cyan">Buat Draft</button>
                      </div>
                    </form>

                    <div class="d-none" id="cont-det">
                      <div class="row">
                        <?php /* FORM INPUT MANUAL */ ?>
                        <div class="col-md-6 col-sm-12">
                          <div class="card ">
                            <div class="card-header bg-blue-lt">
                              <h3 class="card-title">Draft Jadwal</h3>
                            </div>
                            <div class="card-body">
                              <form id="form-draft">

                                <?php
                                //Buat form input fungsi ada di file helper/h_form_helper.php

                                echo create_form(array(
                                  'type' => 'select',
                                  'id' => 'id-gedung',
                                  'label' => 'Gedung',
                                  'placeholder' => 'Pilih Gedung',
                                  'value' => $gedung,
                                  'attr' => ''
                                ));

                                echo create_form(array(
                                  'type' => 'select',
                                  'id' => 'id-ruangan',
                                  'label' => 'Ruangan',
                                  'placeholder' => 'Pilih Ruangan',
                                  'value' => array(),
                                  'attr' => ''
                                ));

                                echo create_form(array(
                                  'type' => 'select',
                                  'id' => 'id-item',
                                  'label' => 'Item',
                                  'placeholder' => 'Pilih Item',
                                  'value' => $item,
                                  'attr' => ''
                                ));

                                echo create_form(array(
                                  'type' => 'select',
                                  'id' => 'id-pkrutin',
                                  'label' => 'Jenis Pekerjaan',
                                  'placeholder' => 'Piilh Jenis Pekerjaan',
                                  'value' => $pkrutin,
                                  'attr' => ''
                                ));


                                ?>

                                <div class="form-footer">
                                  <div class="d-flex flex-nowrap w-full">
                                    <div class="w-100 pe-1"><button type="submit" class="btn btn-success w-full">Tambah Draft</button></div>



                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <?php /* END FORM INPUT MANUAL */ ?>

                        <?php /* FORM UPLOAD */ ?>
                        <div class="col-md-6 col-sm-12">
                          <div class="card ">
                            <div class="card-header bg-blue-lt">
                              <h3 class="card-title">Upload Dokumen Baru</h3>
                            </div>
                            <div class="card-body">
                              <form id="form-upload-dokumen" enctype="multipart/form-data">
                                <div class="form-group mb-3 row">
                                  <label class="form-label col-3 col-form-label">File Dokumen</label>
                                  <div class="col">
                                    <input type="file" class="form-control" aria-describedby="File Dokumen" id='upload-file' name='upload-file'>
                                    <small class="form-hint">
                                      <a href="<?php echo base_url(); ?>upload/template.xlsx" target="_BLANK">Klik untuk download template</a>
                                    </small>
                                    <div class="invalid-feedback mb-0" id="iv-upload-file"></div>
                                  </div>
                                </div>

                                <div class="form-footer">
                                  <button type="submit" class="btn btn-primary">Upload Dokumen</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <?php /* END FORM UPLOAD */ ?>


                      </div>


                      <div class="table-responsive mt-3">
                        <table class="table table-vcenter text-nowrap table-bordered" id='postsList' width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th class="w-1">Aksi</th>
                              <th class="w-1">No.</th>
                              <th>nn</th>
                              <th>nn</th>
                              <th>nn</th>
                              <th>nn</th>
                              <th>nn</th>
                              <th>Gedung</th>
                              <th>Ruangan</th>
                              <th>Item</th>
                              <th>Pekerjaan Rutin</th>

                            </tr>
                          </thead>
                          <tbody id="tabel-body">
                          </tbody>
                        </table>
                      </div>

                      <div class="d-flex flex-nowrap w-full">
                        <div class="pe-1"><button type="submit" class="btn btn-primary" id="btn-save">Simpan Jadwal</button></div>
                        <div class="pe-1"><button type="submit" class="btn btn-danger" id="btn-delete">Hapus Draft</button></div>
                      </div>

                    </div>
                  </div>
                </div>
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

        <!-- Modal Konfirmasi -->
        <div class="modal modal-blur fade" id="modal-konfirmasi-upload" tabindex="-1" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <div class="modal-title">Anda Yakin</div>
                <div>Data akan mengupload jadwal</div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto" id="btn-batal-upload">Batal</button>
                <button type="button" class="btn btn-danger" id="btn-yes-upload">Ya, Upload</button>
              </div>
            </div>
          </div>
        </div>