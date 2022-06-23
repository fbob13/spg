          <!-- MODAL warning-->
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
                  <h3 class="text-muted" id="modal-warning-info">...</h3>
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
                  <h3 class="text-muted" id="modal-success-info">...</h3>
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
                  <h3 class="text-muted" id="modal-danger-info">...</h3>
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
          <footer class="footer footer-transparent d-print-none">
            <div class="container-fluid">
              <div class="row text-center align-items-center flex-row-reverse">
                <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                  <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item">
                      <span class="text-indigo"><?php echo $this->config->item('app_name'); ?></span> | Copyright &copy; <?php $tanggal = time () ;$tahun= date("Y",$tanggal);echo  $tahun; ?>
                      <a href="<?php echo base_url(); ?>" class="link-secondary">BPK Perwakilan Papua Barat</a>.
                      All rights reserved.
                    </li>

                  </ul>
                </div>
              </div>
            </div>
          </footer>
          </div>
          </div>

          <!-- Libs JS -->

          <script src="<?php echo base_url(); ?>dist/libs/jquery/jquery-3.6.0.min.js"></script>
          <?php echo $cust_js; ?>
          <!-- Tabler Core -->
          <script src="<?php echo base_url(); ?>dist/js/tabler.min.js"></script>
          <script src="<?php echo base_url(); ?>dist/js/demo.min.js"></script>
          <script type='text/javascript'>
            $(document).ready(function() {
              var start = 0;

              function playSound() {
                const audio = new Audio('<?php echo base_url(); ?>static/notif2.mp3');
                audio.play();
                console.log('plntf')
              }


              //setInterval(getdatapinjam, 60000);
              setInterval(greetings, 10000);
              greetings();

              function greetings() {



                <?php if ($link == "dashboard") { ?>
                  var date = new Date();
                  const nama_u = '<?php echo $this->session->userdata('nama'); ?>'
                  const d = new Date();
                  var hour = d.getHours();
                  salam = ''
                  if (hour >= 4 && hour < 10) {
                    salam = 'Selamat Pagi ' + nama_u
                  } else if (hour >= 10 && hour <= 15) {
                    salam = 'Selamat Siang ' + nama_u
                  } else if (hour >= 16 && hour <= 17) {
                    salam = 'Selamat Sore ' + nama_u
                  } else {
                    salam = 'Selamat Malam ' + nama_u
                  }
                  $('#salam').html(salam);
                <?php } ?>


              }

            });
          </script>