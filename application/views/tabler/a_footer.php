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
                        <span class="text-indigo"><?php echo $this->config->item('app_name'); ?></span> | Copyright &copy; <?php $tanggal = time();
                                                                                                                            $tahun = date("Y", $tanggal);
                                                                                                                            echo  $tahun; ?>
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
<script>
    function createNonRutin(gedung, ruangan, keluhan, tanggal, prioritas = "") {

        var star = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="icon" viewBox="0 0 16 16"><path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/></svg>'
        var starfill = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="icon" viewBox="0 0 16 16"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/></svg>'
        var rating = ""
        if (prioritas == 1) rating = starfill + star + star + star + star
        else if (prioritas == 2) rating = starfill + starfill + starfill + star + star
        else if (prioritas == 3) rating = starfill + starfill + starfill + starfill + star
        else if (prioritas == 4) rating = starfill + starfill + starfill + starfill + starfill

        var t_info = ""
        t_info += '<div>'
        t_info += '    <div class="row">'
        t_info += '        <div class="col">'
        t_info += '            <div class="d-flex justify-content-between">'
        t_info += '                <div>' + gedung + '</div>'
        t_info += '                <div>' + tanggal + '</div>'
        t_info += '            </div>'
        t_info += '            <div class="d-flex justify-content-between">'
        t_info += '                <div>' + ruangan + '</div>'
        t_info += '                <div>' + rating + '</div>'
        t_info += '            </div>'
        t_info += '            <div class=""><b>' + keluhan + '</b>'
        t_info += '            </div>'
        t_info += '        </div>'
        t_info += '    </div>'
        t_info += '</div>'

        return t_info;
    }

    function createRutin(gedung, ruangan, item, tanggal, status_pekerjaan, jenis_pekerjaan, uraian_pekerjaan, status_teks) {
        var border = ""
        if (status_pekerjaan == 0) border = "border-danger"
        else if (status_pekerjaan == 1) border = "border-azure"
        else if (status_pekerjaan == 2) border = "border-warning"
        else if (status_pekerjaan == 3) border = "border-success"
        else if (status_pekerjaan == 4) border = "border-purple"
        else if (status_pekerjaan == 5) border = "border-success"

        var t_info = ""
        t_info += '<div>'
        t_info += '    <div class="row">'
        t_info += '        <div class="col border-start border-5 ' + border + '">'
        t_info += '            <div class="d-flex justify-content-between">'
        t_info += '                <div>' + gedung + '</div>'
        t_info += '                <div>' + tanggal + '</div>'
        t_info += '            </div>'
        t_info += '            <div class="d-flex justify-content-between">'
        t_info += '                <div>' + ruangan + '</div>'
        t_info += '                <div>' + status_teks + '</div>'
        t_info += '            </div>'
        t_info += '            <div class="">' + item + '-' + jenis_pekerjaan
        t_info += '            </div>'
        t_info += '            <div class=""><b>' + uraian_pekerjaan + '</b>'
        t_info += '            </div>'
        t_info += '        </div>'
        t_info += '    </div>'
        t_info += '</div>'

        return t_info;
    }


    function getNonRutin() {
        $.ajax({
            url: "<?php echo base_url(); ?>dashboard/info/nonrutin",
            type: 'get',
            dataType: 'json',
            success: function(response) {
                if (response.status == 'nok') {
                    //
                } else {
                    var hasil = response.data
                    $('#container-nonrutin').html('')

                    if (hasil.length == 0) {
                        $('#container-rutin').html('No Data')
                        $('#badge-nonrutin').removeClass('badge bg-red')
                    } else {
                        $('#badge-nonrutin').addClass('badge bg-red')
                        $('#container-rutin').html('')
                        hasil.forEach(function(item, index, arr) {
                        //console.log(arr[index].nama_gedung)

                        $('#container-nonrutin').append(createNonRutin(arr[index].nama_gedung, arr[index].nama_ruangan, arr[index].keluhan, arr[index].tanggal_laporan, arr[index].prioritas))
                    })
                    }
                }
            }
        });
    }

    function getRutin() {
        $.ajax({
            url: "<?php echo base_url(); ?>dashboard/info/rutin",
            type: 'get',
            dataType: 'json',
            success: function(response) {
                if (response.status == 'nok') {
                    //
                } else {
                    var hasil = response.data

                    if (hasil.length == 0) {
                        $('#container-rutin').html('No Data')
                        $('#badge-rutin').removeClass('badge bg-red')
                    } else {
                        $('#badge-rutin').addClass('badge bg-red')
                        $('#container-rutin').html('')
                        hasil.forEach(function(item, index, arr) {
                            //console.log(arr[index].nama_gedung)

                            $('#container-rutin').append(createRutin(arr[index].nama_gedung, arr[index].nama_ruangan, arr[index].nama_item, arr[index].tanggal_jadwal, arr[index].status_pekerjaan, arr[index].jenis_pekerjaan, arr[index].uraian_pekerjaan, arr[index].status_pekerjaan_text))
                            //function createRutin(gedung, ruangan, item, tanggal, status_pekerjaan)
                        })
                    }


                }
            }
        });
    }

    var counter = 0

    function createNotification(icon, pesan) {
        counter = counter + 1
        $('#t-cont').prepend(createToast(icon, pesan, counter))
        var id_show = 'toast-' + counter
        var myToastEl = document.getElementById(id_show)
        var myToast = bootstrap.Toast.getOrCreateInstance(myToastEl)
        myToast.show()
    }

    function createToast(icon, pesan, count) {
        var tstyle = [];
        var ttoast = [];
        tstyle[1] = 'bg-danger'
        tstyle[2] = 'bg-warning'
        tstyle[3] = 'bg-success'

        ttoast[1] = '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><path d="M10 10l4 4m0 -4l-4 4" /></svg>'
        ttoast[2] = '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><line x1="12" y1="8" x2="12" y2="12" /><line x1="12" y1="16" x2="12.01" y2="16" /></svg>'
        ttoast[3] = '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><path d="M9 12l2 2l4 -4" /></svg>'
        //console.log('notif#' + data.flag_icon + '#' + data.header + '#' + data.created_at + '#' + data.info)
        //console.log("create toast")
        wr = ""
        wr += '<div class="toast ' + tstyle[icon] + ' text-white" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-toggle="toast" id="toast-' + count + '">'
        wr += '  <div class="d-flex">'
        wr += '     <div class="toast-body">' + ttoast[icon] + ' '
        wr += pesan
        wr += '     </div>'
        wr += '     <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>'
        wr += '  </div>'
        wr += '   </div>'
        return wr
    }

    $(document).ready(function() {
        var start = 0;

        function playSound() {
            const audio = new Audio('<?php echo base_url(); ?>static/notif2.mp3');
            audio.play();
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




        getNonRutin()
        getRutin()



    });
</script>