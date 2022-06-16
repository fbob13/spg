
  <script type='text/javascript'>

$(document).ready(function(){

  var datacari = "";

   // Detect pagination click
  $('#pagination').on('click','a',function(e){
    e.preventDefault(); 
    var pageno = $(this).attr('data-ci-pagination-page');
    var aorder= $('#postsList').attr('ci-aktif-order');
    var asorting= $('#postsList').attr('ci-aktif-sorting');
    loadPagination(pageno,asorting,aorder);
  });

   //klik sorting
  $('#postsList th').on('click','a',function(e){
    event.preventDefault();
    var psorting = $(this).attr('ci-data-cari');
    var parah = $(this).attr('ci-order');

    $('#postsList').attr('ci-aktif-order',parah);
    $('#postsList').attr('ci-aktif-sorting',psorting);

    loadPagination(0,psorting,parah,datacari);
    
    //menghilangkan icon asc/desc
    $('#postsList th a span').html('');

    //menambah class/attribut untuk header yg di klik
    if(parah == "ASC"){
      $(this).find('span').html('<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="7 11 12 6 17 11" /><polyline points="7 17 12 12 17 17" /></svg>');
      $(this).attr('ci-order','DESC');
    }else{
      $(this).find('span').html('<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="7 7 12 12 17 7" /><polyline points="7 13 12 18 17 13" /></svg>');
      
      $(this).attr('ci-order','ASC');
    }
  });

  //Pencarian Cepat
  $('#quick_search').submit(function(){
    event.preventDefault();
            
    cari_nilai = $('#quick_search_data').val();
    cari_kolom = $('#quick_search_kolom').val();
    
    cari_nilai = cari_nilai.replace(/[^a-zA-Z0-9 ]/g, "") ;
    //cari_kolom = cari_kolom.replace(/[^a-zA-Z0-9 ]/g, "");
    

    if (cari_nilai =='') {
      $('#postsList').attr('ci-aktif-cari','');
    } else {
      $('#postsList').attr('ci-aktif-cari','quick');

    }

    $('th a[href]').attr('href', function(index, href) {
        var param = "/" + datacari + "/0";
        return href + param;
      });

    loadPagination(0,'<?php echo $sorting; ?>','<?php echo $arah; ?>');

  });

  //meload saat pertama kali halaman terbuka
  loadPagination(0,'<?php echo $sorting; ?>','<?php echo $arah; ?>','<?php echo $cari; ?>');

  // Load pagination
  function loadPagination(pagno,sorting,arah){
    var dataurl="";

    cari = $('#postsList').attr('ci-aktif-cari');
    //q_cari = $('#postsList').attr('ci-quick-search');
    if (cari == "") {
      dataurl = '<?=base_url()?>setting/provinsi_ajax/'+sorting + '/' + arah + '/' +pagno + '/' + cari;
    }else if (cari=="quick"){

      cari_nilai = $('#quick_search_data').val();
      cari_kolom = $('#quick_search_kolom').val();
      
      cari_nilai = cari_nilai.replace(/[^a-zA-Z0-9 ]/g, "") ;
      //cari_kolom = cari_kolom.replace(/[^a-zA-Z0-9 ]/g, "");


      datakirim = 'nilaicari=' + cari_nilai + "&kolom=" + cari_kolom;
      //datakirim = datakirim + '&kk=' + cari_kk + '&nama=' + cari_nama + '&oap=' + cari_oap;
      dataurl = '<?=base_url()?>setting/provinsi_ajax/'+sorting + '/' + arah + '/' +pagno + '/' + cari + '/' +pagno+ '?' + datakirim;
    }

    var target = document.getElementById('tabel-body');
    $('#tabel-body tr').attr('style','opacity:0.5;');
    $.ajax({
      url: dataurl,
      type: 'get',
      dataType: 'json',
      success: function(response){
        $('#pagination').html(response.pagination);
        //$('#tabel-body').attr('style','');
        createTable(response.result,response.row);
        $('#postsList').attr('ci-aktif-page',pagno);
      }
    });
  }

  // Create table list setelah load pagination
  function createTable(result,sno){
    sno = Number(sno);

    lihat_view = <?php echo $data_role->vw;?>;
    lihat_edit = <?php echo $data_role->edt;?>;
    lihat_delete = <?php echo $data_role->dlt;?>;

     $('#postsList tbody').empty();
    
     for(index in result){
        var id = result[index].rnum;
        var kode_prov = result[index].kode_prov;
        var nama_prov = result[index].nama_prov;
        
        sno+=1;

        var tr = '<tr class="link_detail">';
        tr += "<td class='text-center'>"+ id +"</td>";
        tr += '<td class="text-center">' + kode_prov + '</td>';
        tr += "<td class='text-center'>"+ nama_prov + "</td>";

        tr += '<td>'
        tr += '    <div class="btn-list flex-nowrap">';

        if(lihat_edit == 1){
          tr += '<a href="#" class="btn btn-icon btn-azure d-inline-block" data-bs-toggle="modal" data-bs-target="#modal-update" ci-aksi="update" ci-nik="'+kode_prov+'" ci-desc="'+nama_prov+'"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg> </a>'
        }
        if(lihat_delete == 1){
          tr += '<a href="#" class="btn btn-icon btn-danger d-inline-block" data-bs-toggle="modal" data-bs-target="#modal-delete" ci-aksi="delete" ci-nik="'+kode_prov+'" ci-desc="'+nama_prov+'"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>'
        }
        tr += '</div>';
        tr += '</td>';
        tr += "</tr>";
        $('#postsList tbody').append(tr);

      }
  }

  //Simpan hasil update (form update)
  $('#form-new-user').submit(function(e){
    e.preventDefault();
    
    new_kode_prov = $('#new-kode-prov').val();
    new_nama_prov = $('#new-nama-prov').val();

    $.ajax({
      url: "<?php echo base_url();?>setting/provinsi_new",
      type: 'post',
      data:{
        'kode_prov' :new_kode_prov,
        'nama_prov' : new_nama_prov,
      },
      dataType: 'json',
      success: function(response){
        if(response.status == 'nok'){
          if(response.err_kode_prov !== "") {$("#new-kode-prov").addClass("is-invalid"); $("#iv-kode-prov").html(response.err_kode_prov)}else{$("#new-kode-prov").removeClass("is-invalid");$("#iv-kode-prov").html("")};
          if(response.err_nama_prov !== "") {$("#new-nama-prov").addClass("is-invalid"); $("#iv-nama-prov").html(response.err_nama_prov)}else{$("#new-nama-prov").removeClass("is-invalid");$("#iv-nama-prov").html("")};

        }else{
          $('#modal-new').modal('hide')

          $('#modal-success-info').empty();
          $('#modal-success-info').html(response.info);   
          $('#modal-success').modal('show') 

          setTimeout(function() {  
          $('#modal-success').modal('hide')
          }, 2000);

          setTimeout(function() {  
            //loadPagination();
            loadPagination(0,'<?php echo $sorting; ?>','<?php echo $arah; ?>','<?php echo $cari; ?>');
          }, 2300);  
        }
        
      }
    });     
  });


  //update user
  $('#form-update-data').submit(function(e){
    e.preventDefault();
    
    new_kode_prov = $('#upd-kode-prov').val();
    new_nama_prov = $('#upd-nama-prov').val();


    $.ajax({
      url: "<?php echo base_url();?>setting/provinsi_update",
      type: 'post',
      data:{
        'kode_prov' :new_kode_prov,
        'nama_prov' : new_nama_prov,
      },
      dataType: 'json',
      success: function(response){
        if(response.status == 'nok'){

          //if(response.kode_kategori !== "") {$("#new-kode-kategori").addClass("is-invalid"); $("#iv-kode-kategori").html(response.err_nomor_induk)}else{$("#new-kode-kategori").removeClass("is-invalid");$("#iv-kode-kategori").html("")};
          //if(response.err_nama_kategori !== "") {$("#upd-nama-kategori").addClass("is-invalid"); $("#iv-upd-nama-kategori").html(response.err_nama_kategori)}else{$("#upd-nama-kategori").removeClass("is-invalid");$("#iv-upd-nama-kategori").html("")};
          if(response.err_nama_prov !== "") {$("#upd-nama-prov").addClass("is-invalid"); $("#iv-upd-nama-prov").html(response.err_nama_prov)}else{$("#upd-nama-prov").removeClass("is-invalid");$("#iv-upd-nama-prov").html("")};

        }else{
          $('#modal-update').modal('hide')

          $('#modal-success-info').empty();
          $('#modal-success-info').html(response.info);   
          $('#modal-success').modal('show') 

          setTimeout(function() {  
          $('#modal-success').modal('hide')
          }, 2000);

          setTimeout(function() {  
            //loadPagination();
            loadPagination(0,'<?php echo $sorting; ?>','<?php echo $arah; ?>','<?php echo $cari; ?>');
          }, 2300);  
        }
        
      }
    });     
  });

  //hapus user
  $('#form-hapus').submit(function(e){
    e.preventDefault();
      data_hapus_nik = $('#modal-delete').attr('ci-nik');
      $.ajax({
        url: '<?php echo base_url();?>master/query_delete',
        type: 'post',
        data:{
          'tabel' :'prov',
          'key' :'kode_prov',
          'value' :data_hapus_nik
        },
        dataType: 'json',
        success: function(response){
          $('#modal-success-info').empty();
          $('#modal-success').modal('show');
          $('#modal-success-info').html(response.message);     
          setTimeout(function() {  
            $('#modal-success').modal('hide')
          }, 1500);
          setTimeout(function() {  
            loadPagination(0,'<?php echo $sorting; ?>','<?php echo $arah; ?>','<?php echo $cari; ?>');
          }, 1700);         
        }
      });      
  });    

  //Tombol Aksi
  $('#tabel-body').on('click','a',function(e){
    e.preventDefault();
    aksi = $(this).attr('ci-aksi');

    if (aksi =="delete"){
      $('#desc_delete').html($(this).attr('ci-desc'))
      $('#modal-delete').attr('ci-nik',$(this).attr('ci-nik'))
      $('#modal-delete').modal('show');
    }else if (aksi == "update"){
      $('#data-show').html($(this).attr('ci-desc'))

      $('#upd-kode-prov').val('')
      $('#upd-nama-prov').val('')

      $('#upd-kode-prov').removeClass("is-invalid")
      $('#upd-nama-prov').removeClass("is-invalid")

      $.ajax({
        url: '<?php echo base_url();?>master/query_view',
        type: 'post',
        data:{
            'tabel' :'prov',
            'key' :'kode_prov',
            'value' :$(this).attr('ci-nik')
          },
        dataType: 'json',
        success: function(response){
          
          $('#upd-kode-prov').val(response.kode_prov)
          $('#upd-nama-prov').val(response.nama_prov)
          
        }
      }); 
    }

  });

  //Bersihkan form tambah data
  $('#btn-tambah-data').on('click','a',function(e){
      $('#new-kode-prov').val('')
      $('#new-nama-prov').val('')

      $('#new-kode-prov').removeClass("is-invalid")
      $('#new-nama-prov').removeClass("is-invalid")
  });
});
  </script>