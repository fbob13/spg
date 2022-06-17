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
                      <div class="hr-text">Draft Jadwal</div>
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
                          'value' => array(),
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
                          <div class="w-100 pe-1"><button type="submit" class="btn btn-success w-full">Tambah Jadwal</button></div>
                          
                          
                          </div>
                        </div>
                      </form>

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
                    </div>
                  </div>
                </div>
              </div>
            </div>


          </div>



        </div>

        