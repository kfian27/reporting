 <!-- <script src="<?php echo base_url();?>assets/dash/js/app.min.js" type="text/javascript"></script> -->
 <style>
        #image-holder {
            margin-top: 8px;
        }
        
        #image-holder img {
            border: 8px solid #DDD;
            max-width:50%;
        }
    </style>
          <!-- page content -->
      <div class="right_col" role="main">
      <div class="">
          <div class="x_panel">
              <div class="x_title">
                <h2> Kelas <small>form input </small></h2>
                <ul class="nav navbar-right panel_toolbox">
                      <li><button id="tombol-tambah" class="btn btn-primary" onclick="javascript:tambah();"> Tambah <i class="fa fa-plus"></i></button></a>
                      </li>
                    </ul>
                <div class="clearfix"></div>
              </div>
                    <div class="row" id="detail">
                      <div class="col-sm-12">
                        <div class="card-box table-responsive">
                          <table id="datatable-keytable" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Nama kelas</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $a=1; foreach ($kelas as $row): ?>
                            <tr>
                                <td><?php echo $a; ?></td>
                                <td><?php echo $row->nm_kelas; $a++;?></td>
                                <td>
                                    <button type="button" data-title='Delete' data-toggle='modal' onclick="javascript:hapus('mkelas/delete/<?php echo $row->id_kelas; ?>');" class="btn btn-danger pull-right"> Hapus</button>
                                    <button type="button" data-title='Edit' onclick="javasript:ubah('mkelas/get_detail/<?php echo $row->id_kelas; ?>')" class="btn btn-primary pull-right"> Edit</button>
                                </td>
                            </tr>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                <div class="row" id="form-tambah" style="display: none;">
                <form class="form-horizontal"  method="post" id="detail-tambah" name="detail-tambah" enctype="multipart/form-data">
                  <input type="hidden" name="id_kelas" id="id_kelas">
                  <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                      <label for="tiga" class="col-sm-2 control-label"> Nama kelas </label>
                      <div class="col-md-10 col-sm-10 col-xs-10">
                        <input type="text" class="form-control" placeholder="Nama" name="nm_kelas" id="nm_kelas" required>
                      </div>
                  </div>
                   <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                      <label for="tiga" class="col-sm-2 control-label"> tgl kelas </label>
                      <div class="col-md-10 col-sm-10 col-xs-10">
                        <input type="date" class="form-control" placeholder="Nama" name="nm_kelas" id="nm_kelas" required>
                      </div>
                  </div>
                  <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
                          <button class="btn btn-primary" type="button" onclick="javascript:cancel();">Cancel</button>
                          <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success" onclick="javascript:simpan('mkelas/coba_insert');" id="save" name="save">Submit</button>
                        </div>
                      </div>
                  </form>
                </div>
              </div>
            </div>
          <div class="clearfix"></div>
        </div>
      <!-- end page content -->
<script type="text/javascript">
function tambah(){
    $('#detail').hide();
    $('#form-tambah').show();
    $('#tombol-tambah').attr('disabled',true);
    $('#id_kelas').val("");
    $('#nm_kelas').val("");
}
function cancel(){
    $('#detail').show();
    $('#form-tambah').hide();
    $('#tombol-tambah').attr('disabled',false);
}
function simpan(url){
        $('#save').val('saving . . ');
        $('#save').attr('disabled',true);
        $("#detail-tambah").click(function(evt){
            evt.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: "<?php echo base_url()?>" + url,
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
                success: function (response) {
                    alert("Data berhasil masuk");
                    document.location="<?php echo base_url()?>" + 'admin/kelas';
                }
            });
            return false;
        });
    }
function hapus(url){
    $.ajax({
        url : "<?php echo base_url()?>" + url,
        type : 'post',
        dataType : 'json',
        success : function(data)
        {
            if(data.status == 'ok')
            {
                alert("Data berhasil dihapus");
                location.reload();
            }
        },
        error : function(res)
        {
            show_message('Gagal',(res.responseText));
        }
    });
}
function ubah(url){
    $.ajax({
        url : "<?php echo base_url()?>" + url ,
        type : 'post',
        dataType : 'json',
        success : function(data)
        {
            var fotomu  = data.data.ft_post; 
            $('#detail').hide();
            // $.fillToForm("#detail-tambah", data.data);
            $('#nm_kelas').val(data.data.nm_kelas);
            $('#id_kelas').val(data.data.id_kelas);
            $('#form-tambah').show();
        },
        error : function(res)
        {
            show_message('Gagal',(res.responseText));
        }
    });
}
</script>