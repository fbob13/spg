<div class="container-fluid">
  <!-- Page title -->
  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">
          Master Provinsi
        </h2>
      </div>
    </div>
  </div>
</div>
<div class="page-body">
  <div class="container-fluid">
    <div class="row row-cards">
      <div class="col-12">
        <div class="card">

          <div class="card-body border-bottom py-3">
            <div class="d-flex">
              <div class="" id="btn-tambah-data">
                <a href="#" class="btn btn-primary d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-new">
                  <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                  </svg>
                  Tambah Data
                </a>
              </div>
              <div class="ms-auto text-muted  ">
                <div class="ms-2 d-inline-block">
                  <form id="quick_search">
                    <div class="form-group row ">
                      <label class="form-label col-2 col-form-label text-end text-muted">Filter</label>
                      <div class="col col-4  px-1">
                        <input type="text" class="form-control  " aria-label="Pencarian Cepat" placeholder="Filter Data" id="quick_search_data">
                      </div>
                      <div class="col col-4  px-1">
                        <select class="form-select" id="quick_search_kolom">
                          <option value="kode_prov">Kode Provinsi</option>
                          <option value="nama_prov">Nama Provinsi</option>
                        </select>
                      </div>
                      <div class="col col-1  px-1">
                        <button class="btn btn-primary  ">Cari</button>
                      </div>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table card-table table-vcenter table-mobile-md text-nowrap" id='postsList' width="100%" cellspacing="0" ci-aktif-sorting="kode_prov" ci-aktif-order="ASC" ci-aktif-nik="" ci-aktif-nama="" ci-aktif-cari="">
              <thead>
                <tr>
                  <th class="w-1">No.</th>
                  <th><a href="#" class="btn btn-ghost-secondary btn-sm w-100" ci-data-cari="kode_prov" ci-order="DESC"><span></span>Kode Provinsi</a></th>
                  <th><a href="#" class="btn btn-ghost-secondary btn-sm w-100" ci-data-cari="nama_prov" ci-order="DESC"><span></span>Nama Provinsi</a></th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="tabel-body">
                <tr>
                  <td><span class="text-muted">1</span></td>
                  <td>
                    <div class="skeleton-line"></div>
                  </td>
                  <td>
                    <div class="skeleton-line"></div>
                  </td>
                  <td>
                    <div class="skeleton-line"></div>
                  </td>
                </tr>
                <tr>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="card-footer d-flex align-items-center" id='pagination'>
            <ul class="pagination m-0 mx-auto">
              <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                  <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <polyline points="15 6 9 12 15 18" />
                  </svg>
                  prev
                </a>
              </li>
              <li class="page-item"><a class="page-link" href="#">
                  <div class="skeleton-line"></div>
                </a></li>
              <li class="page-item"><a class="page-link" href="#">
                  <div class="skeleton-line"></div>
                </a></li>
              <li class="page-item"><a class="page-link" href="#">
                  <div class="skeleton-line"></div>
                </a></li>
              <li class="page-item">
                <a class="page-link" href="#">
                  next
                  <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <polyline points="9 6 15 12 9 18" />
                  </svg>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Modal Add User-->
  <div class="modal modal-blur fade" id="modal-new" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Buat Provinsi Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="form-new-user">
          <div class="modal-body">
            <div class="">
              <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Kode Provinsi</label>
                <div class="col">
                  <input type="text" class="form-control" id="new-kode-prov" name="kode_prov" placeholder="Kode Provinsi" required>
                  <div class="invalid-feedback mb-0" id="iv-kode-prov"></div>
                </div>
              </div>
              <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Keterangan</label>
                <div class="col">
                  <input type="text" class="form-control" id="new-nama-prov" name="nama_prov" placeholder="Nama Provinsi" required>
                  <div class="invalid-feedback" id="iv-nama-prov"></div>
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
        </form>
      </div>
    </div>
  </div>
  <!--Modal update User-->
  <div class="modal modal-blur fade" id="modal-update" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Provinsi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="form-update-data">
          <div class="modal-body">
            <div class="">
              <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Kode Provinsi</label>
                <div class="col">
                  <input type="text" class="form-control" id="upd-kode-prov" name="kode_prov" placeholder="Kode Provinsi" readonly>
                  <div class="invalid-feedback mb-0" id="iv-upd-kode-prov"></div>
                </div>
              </div>
              <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Nama Provinsi</label>
                <div class="col">
                  <input type="text" class="form-control" id="upd-nama-prov" name="nama_prov" placeholder="Nama Provinsi" required>
                  <div class="invalid-feedback" id="iv-upd-nama-prov"></div>
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
        </form>
      </div>
    </div>
  </div>
  <!-- Modal Delete Kategori-->
  <div class="modal modal-blur fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Hapus Data Provinsi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modal-detail-hapus">
          Yakin akan menghapus data <span class="text-danger" id="desc_delete"> nomor provinsi</span>?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn me-auto" data-bs-dismiss="modal">Batal</button>
          <form id="form-hapus">
            <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Hapus Provinsi</button>
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