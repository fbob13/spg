<script type='text/javascript'>
  
    
    function resetForm(){
       $('#new-nik').val('');
       $('#new-username').val('');
       $('#new-role').html('<option value="OPR">User</option><option value="SPV">Power User</option><option value="ADMIN">Administrator</option>');

     }

   $(document).ready(function(){
    var datacari = "";

     // Detect pagination click

     //meload saat pertama kali halaman terbuka
    loadPagination();

     // Load pagination


     function loadPagination(){
       var dataurl='<?php echo base_url();?>setting/kantor_ajax';

        var target = document.getElementById('tabel-body');
         $('#tabel-body tr').attr('style','opacity:0.5;');
       $.ajax({
         url: dataurl,
         type: 'get',
         dataType: 'json',
         success: function(response){
            createTable(response.result);
         }
       });
     }

     // Create table list
     function createTable(result){
       $('#postsList tbody').empty();
      sno =0;
      lihat_view = <?php echo $data_role->vw;?>;
      lihat_edit = <?php echo $data_role->edt;?>;
      lihat_delete = <?php echo $data_role->dlt;?>;
       for(index in result){
          sno+=1;
          var no = sno;
          var kode_kantor = result[index].kode_cabang;
          var nama_kantor = result[index].nama_cabang;
          
          /*
          var tr = '<tr class="link_detail text-center" ;>';
          tr += "<td style=\"vertical-align:middle;\">"+ no +"</td>";
          tr += '<td style=\"vertical-align:middle;\">' + nik + '</td>';
          tr += '<td style=\"vertical-align:middle;\">' + username + '</td>';
          tr += '<td style=\"vertical-align:middle;\">' + role + '</td>';

          tr += '<td><a class="btn btn-success btn-sm mb-2 mr-2" href="#" ci-aksi="update" ci-nik="'+nik+'" ci-username="'+username+'" ci-role="'+role+'"> Update Role</a>';
          tr += '<a class="btn btn-primary   btn-sm mb-2 mr-2" href="#" ci-aksi="reset" ci-nik="'+nik+'" ci-username="'+username+'" > Reset Password </a>';
          tr += '<a class="btn btn-danger btn-sm mb-2" ci-aksi="hapus" href="#" ci-nik="' +nik+ '"> Hapus </a></td>';
          tr += "</tr>";
          $('#postsList tbody').append(tr);
          */

          var tr = '<tr>';
          tr += '  <td>'+ no +'</td>';
          tr += '  <td>' + kode_kantor + '</td>';
          tr += '  <td>' + nama_kantor + '</td>';
          tr += '  <td>';
          tr += '    <div class="btn-list flex-nowrap">';
          if(lihat_edit == 1){
          tr += '      <a href="#" class="btn btn-azure " data-bs-toggle="modal" data-bs-target="#modal-update" ci-aksi="update" ci-nik="'+kode_kantor+'" ci-nama-kantor="'+nama_kantor+'" >';
          tr += '        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" /><path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" /></svg>';
          tr += '        Edit Nama Kantor';
          tr += '      </a>';
          }
          if(lihat_delete == 1){
          tr += '      <a href="#" class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#modal-delete" ci-aksi="hapus" ci-nik="' +kode_kantor+ '" ci-nama-kantor="'+nama_kantor+'" >';
          tr += '        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>';
          tr += '        Hapus';
          tr += '      </a>';
          }
          tr += '    </div>';
          tr += '  </td>';
          tr += '</tr>';
          $('#postsList tbody').append(tr);
        }

      }

      $('#tabel-body').on('click','a',function(e){
        e.preventDefault();
        aksi = $(this).attr('ci-aksi');

        if (aksi =="hapus"){
            $('#modal-detail-hapus').attr('ci-nik',$(this).attr('ci-nik'))
            nama_kantor = $(this).attr('ci-nama-kantor');
            $('#hapus-nama').html(nama_kantor)
            //$('#modal-hapus').modal('show');
        }else if (aksi == "update"){

            kode_kantor = $(this).attr('ci-nik');
            nama_kantor = $(this).attr('ci-nama-kantor');

            $('#upd-kode-kantor').val(kode_kantor)
            $('#upd-nama-kantor').val(nama_kantor)

 

        }else if (aksi == "reset"){
          $('#modal-detail-reset').attr('ci-nik',$(this).attr('ci-nik'))
          $('#modal-detail-reset').html('Yakin akan mereset password <span class="text-primary">' + $(this).attr('ci-username') + '</span> menjadi <span class="text-primary">123456</span ?');
        }

      });
      
      $('#form-update-kantor').submit(function(e){
        e.preventDefault();
        //data_hapus_nik = $('#modal-detail-hapus').attr('ci-nik');
        new_kode_kantor = $('#upd-kode-kantor').val();
        new_nama_kantor = $('#upd-nama-kantor').val();
        
        $.ajax({
          url: "<?php echo base_url();?>setting/kantor_update",
          type: 'post',
          data:{
            'kode_cabang' :new_kode_kantor,
            'nama_cabang' : new_nama_kantor
          },
          dataType: 'json',
          success: function(response){
            if(response.status == 'nok'){

              //if(response.err_nik !== "") {$("#new-kode-kantor").addClass("is-invalid"); $("#iv-kode-kantor").html(response.err_nik)}else{$("#new-kode-kantor").removeClass("is-invalid");$("#iv-kode-kantor").html("")};
              if(response.err_nama !== "") {$("#new-nama-kantor").addClass("is-invalid"); $("#iv-nama-kantor").html(response.err_nama)}else{$("#new-nama-kantor").removeClass("is-invalid");$("#iv-nama-kantor").html("")};
            }else{
              $('#modal-update').modal('hide')

              $('#modal-success-info').empty();
              $('#modal-success-info').html(response.info);   
              $('#modal-success').modal('show') 

              setTimeout(function() {  
              $('#modal-success').modal('hide')
              }, 2000);

              setTimeout(function() {  
                loadPagination();
              }, 2300);  
            }
          
          }
        });    
      });
 

      $('#form-hapus').submit(function(e){
        e.preventDefault();
        data_hapus_kantor = $('#modal-detail-hapus').attr('ci-nik');
        $.ajax({
          url: '<?php echo base_url();?>setting/kantor_delete',
          type: 'post',
          data:{
            'kode_cabang' :data_hapus_kantor
          },
          dataType: 'json',
          success: function(response){
            $('#modal-success-info').empty();
            $('#modal-success').modal('show');
            $('#modal-success-info').html(response.info);     
            setTimeout(function() {  
              $('#modal-success').modal('hide')
            }, 1500);
            setTimeout(function() {  
              loadPagination();
            }, 1700);         
          }
        });     
      });     

      $('#form-new-kantor').submit(function(e){
        e.preventDefault();
        //data_hapus_nik = $('#modal-detail-hapus').attr('ci-nik');
        new_kode_kantor = $('#new-kode-kantor').val();
        new_nama_kantor = $('#new-nama-kantor').val();
        
        $.ajax({
          url: "<?php echo base_url();?>setting/kantor_new",
          type: 'post',
          data:{
            'kode_cabang' :new_kode_kantor,
            'nama_cabang' : new_nama_kantor
          },
          dataType: 'json',
          success: function(response){
            if(response.status == 'nok'){

              if(response.err_nik !== "") {$("#new-kode-kantor").addClass("is-invalid"); $("#iv-kode-kantor").html(response.err_nik)}else{$("#new-kode-kantor").removeClass("is-invalid");$("#iv-kode-kantor").html("")};
              if(response.err_nama !== "") {$("#new-nama-kantor").addClass("is-invalid"); $("#iv-nama-kantor").html(response.err_nama)}else{$("#new-nama-kantor").removeClass("is-invalid");$("#iv-nama-kantor").html("")};
            }else{
              $('#modal-new').modal('hide')

              $('#modal-success-info').empty();
              $('#modal-success-info').html(response.info);   
              $('#modal-success').modal('show') 

              setTimeout(function() {  
              $('#modal-success').modal('hide')
              }, 2000);

              setTimeout(function() {  
                loadPagination();
              }, 2300);  
            }
          
          }
        });     
      });  


    });

    

  </script>