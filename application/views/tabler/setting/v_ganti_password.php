<div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <h2 class="page-title">
                  Ganti Password
                </h2>
              </div>
            </div>
          </div>
        </div>
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-cards">
              <div class="col-12">
                <div>
                  <?php echo $info;?>
                </div>
                <div class="card">
                  <div class="card-body">
                    <form method="POST" action="<?php echo base_url();?>gpass" autocomplete="off">
                      
                      <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Password Lama</label>
                        <div class="col">
                          <input type="password" class="form-control" name="pass_lama" autocomplete="off">
                          
                        </div>
                      </div>
                      <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Password Baru</label>
                        <div class="col">
                          <input type="password" class="form-control" name="pass_baru" autocomplete="off">
                          <small class="form-hint">
                            Password Minimal 6 karakter, Hanya boleh mengandung Angka (0-9) dan Huruf (A-Z).
                          </small>
                         
                        </div>
                      </div>
                      <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Konfirmasi Password</label>
                        <div class="col">
                          <input type="password" class="form-control" name="pass_conf" autocomplete="off">
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
                      <div class="form-footer">
                        <button type="submit" class="btn btn-primary">Ganti Password</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>