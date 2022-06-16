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
       var dataurl='<?php echo base_url();?>setting/user_ajax';

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
      lihat_role = <?php echo $data_role_akses;?>;
       for(index in result){
          sno+=1;
          var no = sno;
          var nik = result[index].nik;
          var username = result[index].username;
          var nama = result[index].nama;
          var nama_cabang = result[index].nama_cabang;
          
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
          tr += '  <td data-label="Username">' + username + '</td>';
          tr += '  <td data-label="Nama">' + nama + '</td>';
          tr += '  <td data-label="Cabang">' + nama_cabang + '</td>';
          tr += '  <td data-label="Aksi">';
          tr += '    <div class="btn-list ">';
          if(lihat_role == 1){
            tr += '      <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-update" ci-aksi="update" ci-nik="'+nik+'" ci-username="'+nama+'" >';
            tr += '        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>';
            tr += '        Hak Akses';
            tr += '      </a>'; 
          }
          if(lihat_edit == 1){
          tr += '      <a href="#" class="btn btn-azure" data-bs-toggle="modal" data-bs-target="#modal-reset" ci-aksi="reset" ci-nik="'+nik+'" ci-username="'+nama+'" >';
          tr += '        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" /><path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" /></svg>';
          tr += '        Reset Password';
          tr += '      </a>';
          }
          if(lihat_delete == 1){
          tr += '      <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-delete" ci-aksi="hapus" ci-nik="' +nik+ '">';
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
            $('#modal-hapus').modal('show');
        }else if (aksi == "update"){
            $("input[name='check_view']").prop('checked',false)
            $("input[name='check_edit']").prop('checked',false)
            $("input[name='check_delete']").prop('checked',false)
            data_nik = $(this).attr('ci-nik');
            data_username = $(this).attr('ci-username');

            $('#modal-detail-table').empty();

            hasil='nok'

            $.ajax({
              url: '<?php echo base_url();?>setting/user_edit_role',
              type: 'post',
              data:{
                  'nik' :data_nik
                },
              dataType: 'json',
              success: function(response){

                  //$('#modal-reset').modal('hide');
                  /*
                  hasil = '<div class="mb-2">'+ data_username +'('+ data_nik +')</div>'
                  hasil += '<input type="hidden" name="role_nik" value="'+ data_nik +'">';
                  hasil += '<div class="row row-cards">'
                  hasil +=  '<div class="col-12">'
                  hasil +='    <div class="card">'
                  hasil +='      <div class="table-responsive">'
                  hasil +='        <table class="table table-vcenter card-table">'
                  hasil +='          <thead>'
                  hasil +='            <tr>'
                  hasil +='              <th>No</th>'
                  hasil +='              <th>Halaman</th>'
                  hasil +='              <th class="text-center">View <br><input type="checkbox" name="check_view" id="check_view" value=""></th>'
                  hasil +='              <th class="text-center">Edit <br><input type="checkbox" name="check_edit" value=""></th>'
                  hasil +='              <th class="text-center">Delete <br><input type="checkbox" name="check_delete" value=""></th>'
                  hasil +='            </tr>'
                  hasil +='          </thead>'
                  hasil +='          <tbody>'
                  */
                 hasil =''; 
                  no = 0;
                  for(index in response.data){
                    no = no + 1;
                    xview = response.data[index].vw  == 1 ? 'checked':'nok';
                    xedit = response.data[index].edt  == 1 ? 'checked':'nok';
                    xdelete = response.data[index].dlt  == 1 ? 'checked':'nok';
                    hasil +='<tr>'
                    hasil +='  <td>' + no + '</td>'
                    hasil +='  <td>'+ response.data[index].nama_role +'</td>'
                    hasil +='  <td class="text-center"><input type="checkbox" name="role_view[]" value="'+ response.data[index].kode_role +'" '+ xview +'></td>'
                    hasil +='  <td class="text-center"><input type="checkbox" name="role_edit[]" value="'+ response.data[index].kode_role +'" '+ xedit +'></td>'
                    hasil +='  <td class="text-center"><input type="checkbox" name="role_delete[]" value="'+ response.data[index].kode_role +'" '+ xdelete +'></td>'
                    hasil +='</tr>'
                              
                  }
                  /*
                  hasil +='          </tbody>'
                  hasil +='        </table>'
                  hasil +='      </div>'
                  hasil +='    </div>'
                  hasil +='  </div>'
                  hasil +='</div>'
                  */
                  $('#role_nik').val(data_nik);
                  $('#modal-detail-table').html(hasil);
                  $('#modal-detail-thead').html(data_username +'('+ data_nik +')');
                  
              }
            });    

        }else if (aksi == "reset"){
          $('#modal-detail-reset').attr('ci-nik',$(this).attr('ci-nik'))
          $('#modal-detail-reset').html('Yakin akan mereset password <span class="text-primary">' + $(this).attr('ci-username') + '</span> menjadi <span class="text-primary">123456</span ?');
        }

      });
      
      $('#form-update').submit(function(e){
        e.preventDefault();
        var role_view = $('input[name="role_view[]"]:checked').map(function(){
          return this.value;
        }).get()
        var role_edit = $('input[name="role_edit[]"]:checked').map(function(){
          return this.value;
        }).get()
        var role_delete = $('input[name="role_delete[]"]:checked').map(function(){
          return this.value;
        }).get()
        update_nik = $('input[name="role_nik"]').val();
        if (update_nik !== ''){
            $.ajax({
            url: '<?php echo base_url();?>setting/user_save_role',
            type: 'post',
            data:{
                'role_view':role_view,
                'role_edit':role_edit,
                'role_delete':role_delete,
                'nik' :update_nik
              },
            dataType: 'json',
            success: function(response){
                //$('#modal-detail').html(response);

                //$('#myModal').modal('hide');
          
                $('#modal-success-info').empty();
                $('#modal-success-info').html(response.message);   
                //console.log(response.message)           
                $('#modal-success').modal('show');
                
                setTimeout(function() {  
                $('#modal-success').modal('hide')
                }, 2000);
                setTimeout(function() {  
                loadPagination();
              }, 2300);
            }
          });     
        } else { alert('Silahkan Memilih Data');} 
      });

      $('#form-reset').submit(function(e){
        e.preventDefault();
        data_update_nik = $('#modal-detail-reset').attr('ci-nik');
            $.ajax({
            url: '<?php echo base_url();?>setting/user_reset_pass',
            type: 'post',
            data:{
                'nik' :data_update_nik
              },
            dataType: 'json',
            success: function(response){

                //$('#modal-reset').modal('hide');
          
                $('#modal-success-info').empty();
                $('#modal-success-info').html(response.message);   
                //console_log(response.message)
                $('#modal-success').modal('show');
                 
                
            }
          });     
      
      });    

      $('#form-hapus').submit(function(e){
        e.preventDefault();
        data_hapus_nik = $('#modal-detail-hapus').attr('ci-nik');
        $.ajax({
          url: '<?php echo base_url();?>setting/user_delete',
          type: 'post',
          data:{
            'nik' :data_hapus_nik
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
              loadPagination();
            }, 1700);         
          }
        });     
      });     

      $('#form-new-user').submit(function(e){
        e.preventDefault();
        //data_hapus_nik = $('#modal-detail-hapus').attr('ci-nik');
        new_nik = $('#new-nik').val();
        new_username = $('#new-username').val();
        new_cabang = $('#new-cabang').val();
        $.ajax({
          url: "<?php echo base_url();?>setting/user_new",
          type: 'post',
          data:{
            'nik' :new_nik,
            'nama' : new_username,
            'kode_cabang' : new_cabang
          },
          dataType: 'json',
          success: function(response){
            if(response.status == 'nok'){
              if(response.err_nik !== "") {$("#new-nik").addClass("is-invalid"); $("#iv-nik").html(response.err_nik)}else{$("#new-nik").removeClass("is-invalid");$("#iv-nik").html("")};
              if(response.err_nama !== "") {$("#new-username").addClass("is-invalid"); $("#iv-username").html(response.err_nama)}else{$("#new-username").removeClass("is-invalid");$("#iv-username").html("")};
              if(response.err_kode_cabang !== "") {$("#new-cabang").addClass("is-invalid"); $("#iv-cabang").html(response.err_kode_cabang)}else{$("#new-cabang").removeClass("is-invalid");$("#iv-cabang").html("")};
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

      $("#check_view").change(function(){
        if(this.checked) {
          $("input[name='role_view[]']").prop('checked',true)
        }else{
          $("input[name='role_view[]']").prop('checked',false)
        }
      })

      $("#check_edit").change(function(){
        if(this.checked) {
          $("input[name='role_edit[]']").prop('checked',true)
        }else{
          $("input[name='role_edit[]']").prop('checked',false)
        }
      })

      $("#check_delete").change(function(){
        if(this.checked) {
          $("input[name='role_delete[]']").prop('checked',true)
        }else{
          $("input[name='role_delete[]']").prop('checked',false)
        }
      })

    });

    

  </script>