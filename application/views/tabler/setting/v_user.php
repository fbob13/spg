<div class="container-fluid">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <h2 class="page-title">
                Master Pegawai
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-new">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                    User Baru
                  </a>
                  <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-new" aria-label="Buat Pegawai Baru">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                    
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="page-body">
          <div class="container-fluid">
            <!-- Content here -->
            <div class="row row-cards">
              <div class="col-12">
                <div class="card">
                  <div class="table-responsive">
                    <table class="table table-vcenter table-mobile-md card-table" id='postsList'>
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Username</th>
                          <th>Nama</th>
                          <th>Akses Kantor</th>
                          <th class="w-1"></th>
                        </tr>
                      </thead>
                      <tbody id="tabel-body">
                      <tr>
                        <td data-label="No"><div class="skeleton-line"></div></td>
                        <td data-label="Username"><div class="skeleton-line"></div></td>
                        <td data-label="Nama"><div class="skeleton-line"></div></td>
                        <td data-label="Akses Kantor"><div class="skeleton-line"></div></td>
                        <td data-label="Aksi"><div class="skeleton-line"></div></td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--Modal Update-->
          <div class="modal modal-blur fade" id="modal-update" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Update Data</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-update">
                <div class="modal-body">
                  <div class="" id="modal-detail">
                    <!-- FORM UPDATE ROLE -->
                    <div class="mb-2" id="modal-detail-thead"></div>
                    <input type="hidden" name="role_nik" id="role_nik" value="">
                    <div class="row row-cards">
                      <div class="col-12">
                        <div class="card">
                          <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Halaman</th>
                                  <th class="text-center">View <br><input type="checkbox" name="check_view" id="check_view" value=""></th>
                                  <th class="text-center">Edit <br><input type="checkbox" name="check_edit" id="check_edit" value=""></th>
                                  <th class="text-center">Delete <br><input type="checkbox" name="check_delete" id="check_delete" value=""></th>
                                </tr>
                              </thead>
                              <tbody id="modal-detail-table">
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <a href="#" class="btn" data-bs-dismiss="modal">
                    Batal
                  </a>
                  <button class="btn btn-success ms-auto" data-bs-dismiss="modal" type="submit">
                    <!-- Download SVG icon from http://tabler-icons.io/i/checkup-list -->
	                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><rect x="9" y="3" width="6" height="4" rx="2" /><path d="M9 14h.01" /><path d="M9 17h.01" /><path d="M12 16l1 1l3 -3" /></svg>
                    Simpan Perubahan
                  </button>
                </div>
                </form> 
              </div>
            </div>
          </div>
          <!--Modal Add User-->
          <div class="modal modal-blur fade" id="modal-new" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Buat Data Baru</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-new-user">
                <div class="modal-body">
                  <div class="">
                    <div class="form-group mb-3 row">
                      <label class="form-label col-3 col-form-label">Username</label>
                      <div  class="col">
                        <input type="text" class="form-control" id="new-nik" name="nik" placeholder="Username" required>
                        <div class="invalid-feedback mb-0" id="iv-nik"></div>
                      </div>
                    </div>
                    <div class="form-group mb-3 row">
                      <label class="form-label col-3 col-form-label">Nama</label>
                      <div  class="col">
                        <input type="text" class="form-control" id="new-username" name="nama" placeholder="Nama" required>
                        <div class="invalid-feedback" id="iv-username"></div>
                      </div>
                    </div>
                    <div class="form-group mb-3 row">
                      <label class="form-label col-3 col-form-label">Kantor </label>
                      <div class="col">
                        <select class="form-select" id="new-cabang" name="kode_cabang">
                          <option value="" selected>Pilih Kantor</option>
                          <?php 
                            if( $this->session->userdata('kode_cabang_user') == 'all'){
                              foreach ($cabang as $cb ) 
                            {
                              echo "<option value=\"$cb->kode_cabang\">$cb->nama_cabang</option>";
                            }
                            }else{
                              echo "<option value=\"" . $this->session->userdata('kode_cabang') . "\">".$this->session->userdata('nama_cabang')."</option>";
                            }
                            
                          ?>
                        </select>
                        <div class="invalid-feedback" id="iv-cabang"></div>
                      </div>
                    </div>
                    <div class="form-group mb-3 row">
                      <label class="form-label col-3 col-form-label">Password</label>
                      <div  class="col">
                        <input type="text" class="form-control" id="password" name="password" disabled value="123456">
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
	                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><rect x="9" y="3" width="6" height="4" rx="2" /><path d="M9 14h.01" /><path d="M9 17h.01" /><path d="M12 16l1 1l3 -3" /></svg>
                    Simpan Data
                  </button>
                </div>
                </form>
              </div>
            </div>
          </div>
          <!-- Modal View Pass-->
          <div class="modal modal-blur fade" id="modal-reset" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Reset Password</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="modal-detail-reset" class="modal-body">
                  <!-- Text Reset -->
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn me-auto" data-bs-dismiss="modal">Batal</button>
                  <form id="form-reset">
                    <button class="btn btn-azure" data-bs-dismiss="modal" type="submit">Reset Password</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Modal Delete User-->
          <div class="modal modal-blur fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Hapus User</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-detail-hapus">
                Yakin akan menghapus data?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn me-auto" data-bs-dismiss="modal">Batal</button>
                  <form id="form-hapus">
                    <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Hapus User</button>
                  </form>
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
	                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-warning icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><line x1="12" y1="8" x2="12.01" y2="8" /><polyline points="11 12 12 12 12 16 13 16" /></svg>
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
                	<svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-success icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><path d="M9 12l2 2l4 -4" /></svg>
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
                	<svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><path d="M10 10l4 4m0 -4l-4 4" /></svg>
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

        </div>