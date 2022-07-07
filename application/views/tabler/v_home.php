        <div class="container-fluid">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title">
                  <span id="salam" class="me-1"></span>
                </h2>
                Selamat Datang di <?php echo $this->config->item('app_name') ?>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">

                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="page-body">
          <div class="container-fluid">
            <div class="row row-cards">

              <div class="col-12">
                <div class="card">

                  <div class="card-body">
                    <div class="d-flex">
                      <h3 class="card-title">Grafik jumlah pekerjaan insidentil dan rutin</h3>
                      <div class="ms-auto">
                        <div class="dropdown">
                          <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="pie-bulan">Last 7 days</a>
                          <div class="dropdown-menu dropdown-menu-end" id="pie">
                            <a class="dropdown-item" href="#" id="pie-januari" s-bln="01">Januari</a>
                            <a class="dropdown-item" href="#" id="pie-februari" s-bln="02">Februari</a>
                            <a class="dropdown-item" href="#" id="pie-maret" s-bln="03">Maret</a>
                            <a class="dropdown-item" href="#" id="pie-april" s-bln="04">April</a>
                            <a class="dropdown-item" href="#" id="pie-mei" s-bln="05">Mei</a>
                            <a class="dropdown-item" href="#" id="pie-juni" s-bln="06">Juni</a>
                            <a class="dropdown-item" href="#" id="pie-juli" s-bln="07">Juli</a>
                            <a class="dropdown-item" href="#" id="pie-agustus" s-bln="08">Agustus</a>
                            <a class="dropdown-item" href="#" id="pie-september" s-bln="09">September</a>
                            <a class="dropdown-item" href="#" id="pie-oktober" s-bln="10">Oktober</a>
                            <a class="dropdown-item" href="#" id="pie-november" s-bln="11">November</a>
                            <a class="dropdown-item" href="#" id="pie-desember" s-bln="12">Desember</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div id="chart-demo-pie"></div>

                  </div>
                </div>
              </div>


              <div class="col-md-6 col-sm-12">
                <div class="card">

                  <div class="card-body">
                    <div class="d-flex">
                      <h3 class="card-title">Status pekerjaan insidentil</h3>
                      <div class="ms-auto">
                        <div class="dropdown" >
                          <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="sta-bulan">Last 7 days</a>
                          <div class="dropdown-menu dropdown-menu-end" id="sta">
                            <a class="dropdown-item" href="#" id="sta-januari" s-bln="01">Januari</a>
                            <a class="dropdown-item" href="#" id="sta-februari" s-bln="02">Februari</a>
                            <a class="dropdown-item" href="#" id="sta-maret" s-bln="03">Maret</a>
                            <a class="dropdown-item" href="#" id="sta-april" s-bln="04">April</a>
                            <a class="dropdown-item" href="#" id="sta-mei" s-bln="05">Mei</a>
                            <a class="dropdown-item" href="#" id="sta-juni" s-bln="06">Juni</a>
                            <a class="dropdown-item" href="#" id="sta-juli" s-bln="07">Juli</a>
                            <a class="dropdown-item" href="#" id="sta-agustus" s-bln="08">Agustus</a>
                            <a class="dropdown-item" href="#" id="sta-september" s-bln="09">September</a>
                            <a class="dropdown-item" href="#" id="sta-oktober" s-bln="10">Oktober</a>
                            <a class="dropdown-item" href="#" id="sta-november" s-bln="11">November</a>
                            <a class="dropdown-item" href="#" id="sta-desember" s-bln="12">Desember</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div id="chart-sta"></div>

                  </div>
                </div>
              </div>

              <div class="col-md-6 col-sm-12">
                <div class="card">

                  <div class="card-body">
                    <div class="d-flex">
                      <h3 class="card-title">Prioritas pekerjaan insidentil</h3>
                      <div class="ms-auto">
                        <div class="dropdown">
                          <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="prio-bulan">Last 7 days</a>
                          <div class="dropdown-menu dropdown-menu-end" id="prio">
                            <a class="dropdown-item" href="#" id="prio-januari" s-bln="01">Januari</a>
                            <a class="dropdown-item" href="#" id="prio-februari" s-bln="02">Februari</a>
                            <a class="dropdown-item" href="#" id="prio-maret" s-bln="03">Maret</a>
                            <a class="dropdown-item" href="#" id="prio-april" s-bln="04">April</a>
                            <a class="dropdown-item" href="#" id="prio-mei" s-bln="05">Mei</a>
                            <a class="dropdown-item" href="#" id="prio-juni" s-bln="06">Juni</a>
                            <a class="dropdown-item" href="#" id="prio-juli" s-bln="07">Juli</a>
                            <a class="dropdown-item" href="#" id="prio-agustus" s-bln="08">Agustus</a>
                            <a class="dropdown-item" href="#" id="prio-september" s-bln="09">September</a>
                            <a class="dropdown-item" href="#" id="prio-oktober" s-bln="10">Oktober</a>
                            <a class="dropdown-item" href="#" id="prio-november" s-bln="11">November</a>
                            <a class="dropdown-item" href="#" id="prio-desember" s-bln="12">Desember</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div id="chart-prio"></div>

                  </div>
                </div>
              </div>



            </div>
          </div>