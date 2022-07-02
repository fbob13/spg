        <div class="container-fluid">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <h2 class="page-title">
                  Laporan Kerusakan
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
                    <form id="form-new">

                      <?php
                      //Buat form input fungsi ada di file helper/h_form_helper.php
                      echo create_form(array(
                        'type' => 'text',
                        'id' => 'tanggal-laporan',
                        'label' => 'Tanggal',
                        'placeholder' => 'Tanggal',
                        'value' => date("Y-m-d"),
                        'attr' => 'style="max-width:120px;"'
                      ));

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
                        'id' => 'prioritas',
                        'label' => 'Prioritas',
                        'placeholder' => '',
                        'value' => array(
                          array('val' => 1, 'deskripsi' => 'Rendah'),
                          array('val' => 2, 'deskripsi' => 'Menengah'),
                          array('val' => 3, 'deskripsi' => 'Tinggi'),
                          array('val' => 4, 'deskripsi' => 'Urgent'),
                        ),
                        'attr' => ''
                      ));

                      echo create_form(array(
                        'type' => 'textarea',
                        'id' => 'keluhan',
                        'label' => 'Keluhan',
                        'placeholder' => 'Keluhan',
                        'value' => '',
                        'attr' => ''
                      ));




                      ?>
                      <div class="form-footer">
                        <button id="draft-ok" type="submit" class="btn btn-cyan">Simpan</button>
                      </div>
                    </form>

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
                <div>Menyimpan data keluhan baru</div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto" id="btn-batal">Batal</button>
                <button type="button" class="btn btn-success  " id="btn-yes">Ya, Simpan Data</button>
              </div>
            </div>
          </div>
        </div>