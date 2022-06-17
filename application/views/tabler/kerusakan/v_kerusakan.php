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
                        'value' => array(),
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

        