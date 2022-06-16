<script>
    $(document).ready(function() {

        tr = '';
        var type_report = <?php echo $type; ?>;
        var col = [];

        if (type_report == ''){
            $('#s-tanggal').addClass('d-none')
            $('#s-kat').addClass('d-none')
            $('#s-kec').addClass('d-none')
            $('#s-peg').addClass('d-none')
            $('#s-btn').addClass('d-none')
        }
        else if (type_report == 3 || type_report == 4 ){
            $('#s-tanggal').addClass('d-none')
            $('#s-kat').addClass('d-none')
            $('#s-kec').addClass('d-none')
            $('#s-peg').addClass('d-none')
            $('#s-btn').removeClass('d-none')
        }else if (type_report == 7 ){
            $('#s-tanggal').removeClass('d-none')
            $('#s-kat').removeClass('d-none')
            $('#s-kec').removeClass('d-none')
            $('#s-peg').removeClass('d-none')
            $('#s-btn').removeClass('d-none')

        }

        if (type_report == 1) {

            col = [{
                    data: 'tanggal',
                    className: 'text-center'
                },
                {
                    data: 'jumlah_keluar',
                    className: 'text-center'
                }
            ]
        } else if (type_report == 2) {
            col = [{
                    data: 'bulan',
                    className: 'text-center'
                },
                {
                    data: 'jumlah_keluar',
                    className: 'text-center'
                }
            ]
        } else if (type_report == 3) {
            col = [{
                    data: 'kode_kategori',
                    className: 'text-center'
                },
                {
                    data: 'nama_kategori',
                    className: 'text-center'
                },
                {
                    data: 'jumlah',
                    className: 'text-center'
                }
            ]
        } else if (type_report == 4) {
            col = [{
                    data: 'kode_kategori',
                    className: 'text-center'
                },
                {
                    data: 'nama_kategori',
                    className: 'text-center'
                }, {
                    data: 'kode_subkategori',
                    className: 'text-center'
                },
                {
                    data: 'nama_subkategori',
                    className: 'text-center'
                },
                {
                    data: 'jumlah',
                    className: 'text-center'
                }
            ]
        } else if (type_report == 5) {
            col = [{
                    data: 'nama',
                    className: 'text-center'
                },
                {
                    data: 'jumlah',
                    className: 'text-center'
                }
            ]
        } else if (type_report == 6) {
            col = [{
                    data: 'nama_penyerah',
                    className: 'text-center'
                },
                {
                    data: 'jumlah',
                    className: 'text-center'
                }
            ]
        } else if (type_report == 7) {
            col = [{
                    data: 'tanggal_pinjam',
                    className: 'text-center'
                },
                {
                    data: 'tanggal_kembali',
                    className: 'text-center'
                },
                {
                    data: 'nama',
                    className: 'text-center'
                },
                {
                    data: 'nomor_berkas',
                    className: 'text-center'
                },
                {
                    data: 'keperluan',
                    className: 'text-center'
                },
                {
                    data: 'nomor_dokumen',
                    className: 'text-center'
                },
                {
                    data: 'nama_dokumen',
                    className: 'text-center'
                },
                {
                    data: 'kode_kategori',
                    className: 'text-center'
                },
                {
                    data: 'kode_subkategori',
                    className: 'text-center'
                },
                {
                    data: 'nama_kecamatan',
                    className: 'text-center'
                },
                {
                    data: 'nama_kelurahan',
                    className: 'text-center'
                },
                {
                    data: 'tahun',
                    className: 'text-center'
                },{
                    data: 'tahun_lain1',
                    className: 'text-center'
                },
                {
                    data: 'status_kembali',
                    className: 'text-center'
                },
                {
                    data: 'nama_cari',
                    className: 'text-center'
                },
                {
                    data: 'nama_penyerah',
                    className: 'text-center'
                },
                {
                    data: 'nama_terima',
                    className: 'text-center'
                }
            ]
        }
        <?php if ($type <> "") {
        ?>
            $('#qs-subkategori').val('<?php echo $subkategori; ?>')
            $('#qs-kategori').val('<?php echo $kategori; ?>')
            $('#qs-kecamatan').val('<?php echo $kecamatan; ?>')
            $('#qs-kelurahan').val('<?php echo $kelurahan; ?>')
            $('#qs-dokumen').val('<?php echo $dokumen; ?>')
            $('#qs-pegawai').val('<?php echo $pegawai; ?>')
            $('#result-report').DataTable({
                ajax: {
                    url: '<?php echo base_url(); ?>report_ajax',
                    type: 'POST',
                    data: {
                        "type": '<?php echo $type; ?>',
                        "bulan1": $('#cari-bulan1').val(),
                        "bulan2": $('#cari-bulan2').val(),
                        "tahun": $('#cari-tahun').val(),

                        "kecamatan": $('#qs-kecamatan').val(),
                        "kelurahan": $('#qs-kelurahan').val(),
                        "kategori": '<?php echo $kategori; ?>',
                        "subkategori": '<?php echo $subkategori; ?>',
                        "pegawai": $('#qs-pegawai').val(),
                        "dokumen": $('#qs-dokumen').val(),
                    }
                },
                pageLength: 50,
                columns: col,
                dom: 'Bfrtip',
                buttons: [
                    'pdfHtml5',
                    'excel',
                    'print'
                ],
            });
        <?php } ?>




        

    });

    $('#btn-reset').on('click',function(e){
        e.preventDefault();
        $('#qs-kecamatan').val('')
        $('#qs-kelurahan').val('')
        $('#qs-kategori').val('')
        $('#qs-subkategori').val('')
        $('#qs-pegawai').val('')
        $('#qs-dokumen').val('')
    })

    $('#type-report').on('change',function(e){
        if ($(this).val() == ''){
            $('#s-tanggal').addClass('d-none')
            $('#s-kat').addClass('d-none')
            $('#s-kec').addClass('d-none')
            $('#s-peg').addClass('d-none')
            $('#s-btn').addClass('d-none')
        }
        else if ($(this).val() == 3 || $(this).val() == 4 ){
            $('#s-tanggal').addClass('d-none')
            $('#s-kat').addClass('d-none')
            $('#s-kec').addClass('d-none')
            $('#s-peg').addClass('d-none')
            $('#s-btn').removeClass('d-none')
        }else if ($(this).val() == 7 ){
            $('#s-tanggal').removeClass('d-none')
            $('#s-kat').removeClass('d-none')
            $('#s-kec').removeClass('d-none')
            $('#s-peg').removeClass('d-none')
            $('#s-btn').removeClass('d-none')

        }
    })

    $('#qs-kecamatan').on('change', function(e) {
        //$("#cari_kelurahan").empty();
        kode_kecamatan = $('#qs-kecamatan').val();
        dataurl = '<?= base_url() ?>dokumen/query';

        $.ajax({
            url: dataurl,
            type: 'post',
            data: {
                'kode_kecamatan': kode_kecamatan,
                'tabel': 'kelurahan'
            },
            dataType: 'json',
            success: function(response) {

                hasil = "";
                hasil += '<option value="">Kelurahan</option>'
                for (index in response) {
                    kode_kelurahan = response[index].kode_kelurahan;
                    nama_kelurahan = response[index].nama_kelurahan;

                    hasil += '<option value="' + kode_kelurahan + '">' + nama_kelurahan + '</option>'
                }

                $('#qs-kelurahan').html(hasil);
            }
        });
    });

    $('#qs-kategori').on('change', function(e) {
        //$("#cari_kelurahan").empty();
        kode_kategori = $('#qs-kategori').val();
        
        dataurl = '<?= base_url() ?>dokumen/query';

        $.ajax({
            url: dataurl,
            type: 'post',
            data: {
                'kode_kategori': kode_kategori,
                'tabel': 'subkategori'
            },
            dataType: 'json',
            success: function(response) {
                if (response.length >= 1) {
                    hasil = "";
                    hasil += '<option value="">Subkategori</option>'
                    for (index in response) {
                        kode_subkategori = response[index].kode_subkategori;
                        nama_subkategori = response[index].nama_subkategori;

                        hasil += '<option value="' + kode_subkategori + '">' + nama_subkategori + '</option>'
                    }

                    $('#qs-subkategori').html(hasil);
                    $('#qs-subkategori').removeClass("d-none");
                } else {
                    $('#qs-subkategori').addClass("d-none");
                }

            }
        });
    });
</script>