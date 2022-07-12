<script>
    $(document).ready(function() {

        tr = '';
        var type_report = <?php echo $type; ?>;
        var col = [];

        if (type_report == '') {

            $('#s-btn').addClass('d-none')
        } else if (type_report == 1) {

            $('#s-btn').removeClass('d-none')
            $('#s-subkat').addClass('d-none')
            $('#s-status').removeClass('d-none')
        } else if (type_report == 2) {

            $('#s-btn').removeClass('d-none')
            $('#s-subkat').addClass('d-none')
            $('#s-status').removeClass('d-none')

        } else if (type_report == 4) {

            $('#s-btn').removeClass('d-none')
            $('#s-subkat').removeClass('d-none')
            $('#s-status').addClass('d-none')
        }



        if (type_report == 1) {

            col = [{
                    data: 'nama_teknisi',
                    className: 'text-center'
                }, {
                    data: 'tanggal_jadwal',
                    className: 'text-center'
                },
                {
                    data: 'tanggal_realisasi',
                    className: 'text-center'
                }, {
                    data: 'nama_gedung',
                    className: 'text-center'
                }, {
                    data: 'nama_ruangan',
                    className: 'text-center'
                }, {
                    data: 'nama_item',
                    className: 'text-center'
                }, {
                    data: 'jenis_pekerjaan',
                    className: 'text-center'
                }, {
                    data: 'status_pekerjaan_text',
                    className: 'text-center'
                }, {
                    data: 'keterangan',
                    className: 'text-center'
                }
            ]
        } else if (type_report == 2) {
            col = [{
                    data: 'nama_teknisi',
                    className: 'text-center'
                }, {
                    data: 'tanggal_laporan',
                    className: 'text-center'
                },
                {
                    data: 'tanggal_perbaikan',
                    className: 'text-center'
                }, {
                    data: 'nama_gedung',
                    className: 'text-center'
                }, {
                    data: 'nama_ruangan',
                    className: 'text-center'
                }, {
                    data: 'nama_item',
                    className: 'text-center'
                }, {
                    data: 'keluhan',
                    className: 'text-center'
                }, {
                    data: 'status_pekerjaan_text',
                    className: 'text-center'
                }, {
                    data: 'keterangan',
                    className: 'text-center'
                }
            ]
        }
        <?php if ($type == '1' || $type == '2') {
        ?>
            $('#qs-teknisi').val('<?php echo $teknisi; ?>')
            $('#qs-tanggal-awal').val('<?php echo $tanggal_awal; ?>')
            $('#qs-tanggal-akhir').val('<?php echo $tanggal_akhir; ?>')
            $('#qs-status').val('<?php echo $status; ?>')

            judul = $('#type-report option:selected').text() + ' / ' + $('#qs-teknisi option:selected').text()
            $('#my-title').text(judul)

            $('#result-report').DataTable({
                ajax: {
                    url: '<?php echo base_url(); ?>report/data',
                    type: 'POST',
                    data: {
                        "type": '<?php echo $type; ?>',
                        "tanggal_awal": $('#qs-tanggal-awal').val(),
                        "tanggal_akhir": $('#qs-tanggal-akhir').val(),
                        "teknisi": $('#qs-teknisi').val(),
                        "status": $('#qs-status').val(),

                    }
                },
                pageLength: 50,
                columns: col,
                dom: "<'row'<'col-sm-12 col-md-12 mb-2'B><'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: [
                    'pdfHtml5',
                    'excel',
                    'print'
                ],
            });
        <?php }
        else if ($type == '4') {
        ?>
            $('#qs-teknisi').val('<?php echo $teknisi; ?>')
            $('#qs-tanggal-awal').val('<?php echo $tanggal_awal; ?>')
            $('#qs-tanggal-akhir').val('<?php echo $tanggal_akhir; ?>')
            $('#qs-subkat').val('<?php echo $id_subkategori; ?>')

            judul = $('#type-report option:selected').text() + ' / ' + $('#qs-teknisi option:selected').text()
            $('#my-title').text(judul)

            $.ajax({
                url: "<?php echo base_url(); ?>report/data",
                type: 'post',
                dataType: 'json',
                data: {
                    "type": '<?php echo $type; ?>',
                    "tanggal_awal": $('#qs-tanggal-awal').val(),
                    "tanggal_akhir": $('#qs-tanggal-akhir').val(),
                    "teknisi": $('#qs-teknisi').val(),
                    "id_subkategori": $('#qs-subkat').val(),

                },
                success: function(response) {
                    if (response.status == 'nok') {
                        $('#result-report thead').html('<th class="text-center">no data</th>')
                    } else {
                        document.location.href = '<?php echo base_url();?>download/' + response.filename;

                    }

                }
            });
        <?php
        } ?>

    });

    $('#btn-reset').on('click', function(e) {
        e.preventDefault();
        $('#qs-teknisi').val('')
        $('#qs-tanggal-awal').val('')
        $('#qs-tanggal-akhir').val('')
        $('#qs-status').val('')
    })

    $('#type-report').on('change', function(e) {
        if ($(this).val() == '') {
            $('#s-btn').addClass('d-none')
        } else if ($(this).val() == 1) {

            $('#s-btn').removeClass('d-none')
            $('#s-subkat').addClass('d-none')
            $('#s-status').removeClass('d-none')
        } else if ($(this).val() == 2) {

            $('#s-btn').removeClass('d-none')
            $('#s-subkat').addClass('d-none')
            $('#s-status').removeClass('d-none')
        } else if ($(this).val() == 4) {

            $('#s-btn').removeClass('d-none')
            $('#s-subkat').removeClass('d-none')
            $('#s-status').addClass('d-none')

        }
    })


    // @formatter:off
    document.addEventListener("DOMContentLoaded", function() {
        window.Litepicker && (new Litepicker({
            element: document.getElementById('qs-tanggal-awal'),
            buttonText: {
                previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
                nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
            },
        }));
    });
    // @formatter:on

    // @formatter:off
    document.addEventListener("DOMContentLoaded", function() {
        window.Litepicker && (new Litepicker({
            element: document.getElementById('qs-tanggal-akhir'),
            buttonText: {
                previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
                nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
            },
        }));
    });
    // @formatter:on
</script>