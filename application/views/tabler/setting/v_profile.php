<div class="container-fluid">
  <!-- Page title -->
  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">
          <span class="avatar avatar-xl me-3 avatar-rounded" style="background-image: url(<?php echo base_url(); ?>static/foto/<?php echo $this->session->userdata('avatar'); ?>)"></span> Edit Profile
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
          <form id="form-update-data">
            <input type="hidden" id="upd-nik" value="<?php echo $data_profile->id_user; ?>">
            <div class="form-group mb-3 row">
              <label class="form-label col-3 col-form-label">Username</label>
              <div class="col">
                <input type="text" class="form-control" id="upd-nomor-induk" name="nomor_induk" placeholder="Username" value="<?php echo $data_profile->username; ?>">
                <div class="invalid-feedback mb-0" id="iv-upd-nomor-induk"></div>
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label class="form-label col-3 col-form-label">Nama</label>
              <div class="col">
                <input type="text" class="form-control" id="upd-nama" name="nama" placeholder="Nama" required value="<?php echo $data_profile->nama; ?>">
                <div class="invalid-feedback" id="iv-upd-nama"></div>
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label class="form-label col-3 col-form-label">Jabatan</label>
              <div class="col">
                <input type="text" class="form-control" id="upd-jabatan" name="jabatan" placeholder="Jabatan" required value="<?php echo $data_profile->jabatan; ?>">
                <div class="invalid-feedback" id="iv-upd-jabatan"></div>
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label class="form-label col-3 col-form-label">Telepon</label>
              <div class="col">
                <input type="text" class="form-control" id="upd-telepon" name="telepon" placeholder="Telepon" required value="<?php echo $data_profile->telepon; ?>">
                <div class="invalid-feedback" id="iv-upd-telepon"></div>
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label class="form-label col-3 col-form-label">Jenis Kelamin </label>
              <div class="col">
                <select class="form-select" id="upd-jkelamin" name="jkelamin" value="<?php echo $data_profile->j_kelamin; ?>">
                  <option value="L" selected>Laki-laki</option>
                  <option value="P">Perempuan</option>
                </select>
                <div class="invalid-feedback" id="iv-upd-jkelamin"></div>
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label class="form-label col-3 col-form-label">Alamat</label>
              <div class="col">
                <input type="text" class="form-control" id="upd-alamat" name="alamat" placeholder="Alamat" required value="<?php echo $data_profile->alamat; ?>">
                <div class="invalid-feedback" id="iv-upd-alamat"></div>
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label class="form-label col-3 col-form-label">Email</label>
              <div class="col">
                <input type="email" class="form-control" id="upd-email" name="email" placeholder="Email" required value="<?php echo $data_profile->email; ?>">
                <div class="invalid-feedback" id="iv-upd-email"></div>
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label class="form-label col-3 col-form-label">Foto</label>
              <div class="col">
                <input type="file" class="form-control" id="upd-foto" name="foto">
                <div class="invalid-feedback" id="iv-upd-foto"></div>
              </div>
            </div>
            <div class="form-group mb-3">
              <div class="d-flex">
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
            </div>
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