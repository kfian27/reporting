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
                <h2> Master user <small>form input </small></h2>
                <ul class="nav navbar-right panel_toolbox">
                      <li><button class="btn btn-primary" onclick="javascript:tambah();"> Tambah <i class="fa fa-plus"></i></button></a>
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
                                <th>Username</th>
                                <th>Password</th>
                                <th>Last used</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $a=1; foreach ($user as $row): ?>
                            <tr>
                                <td><?php echo $a; ?></td>
                                <td><?php echo $row->username;?></td>
                                <td><?php echo $row->password;?></td>
                                <td><?php echo $row->last_used; $a++;?></td>
                                <td><?php  
                                    if( $row->status_adm==1)echo "<div class='btn btn-success btn-xs'>aktif</div>";
                                    else echo "<div class='btn btn-danger btn-xs'>Tidak aktif</div>";
                                    ?></td>
                                <td>
                                    <?php
                                    if( $row->status_adm==1){?>
                                    <button type="button" data-title='Delete' data-toggle='modal' onclick="javascript:hapus('muser/delete/<?php echo $row->id_adm; ?>/<?php echo $row->ft_adm; ?>');" class="btn btn-danger pull-right"> Hapus</button>
                                   <?php } ?>
                                </td>
                            </tr>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                <div class="row" id="form-tambah" style="display: none;">
                <form class="form-horizontal"  method="post" id="detail-tambah" name="detail-tambah" enctype="multipart/form-data" novalidate>
                  <input type="hidden" name="id_adm" id="id_adm">
                  <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                      <label for="name" class="col-sm-2 control-label"> Username </label>
                      <div class="col-md-10 col-sm-10 col-xs-10">
                        <input type="text" class="form-control" placeholder="Username" name="username" id="username" required="required">
                      </div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                      <label for="password" class="col-sm-2 control-label"> Password </label>
                      <div class="col-md-10 col-sm-10 col-xs-10">
                        <input type="password" class="form-control" data-validate-length="6,8" name="password" id="password" required="required">
                      </div>
                  </div>
                  <!-- <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                      <label for="password" class="col-sm-2 control-label"> Retype Password </label>
                      <div class="col-md-10 col-sm-10 col-xs-10">
                        <input type="password" type="password" name="password2" data-validate-linked="password" class="form-control" required="required">
                      </div>
                  </div> -->
                  <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                      <label for="tiga" class="col-sm-2 control-label"> Foto </label>
                      <div class="col-md-10 col-sm-10 col-xs-10">
                        <input type="hidden" name="fotonya" id="fotonya">
                        <input type="file" accept="image/*" name="ft_adm" class="form-control" id="foto" multiple>
                                <div id="image-holder">
                                  <?php
                                    if(isset($_GET['id']))
                                        echo "<img src='../img/$data[2].'?rand='".rand()."' alt=''>";
                                    ?>
                                </div>
                                <script>
                                    $("#foto").on('change', function () {

                                        //Get count of selected files
                                        var countFiles = $(this)[0].files.length;

                                        var imgPath = $(this)[0].value;
                                        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
                                        var image_holder = $("#image-holder");
                                        image_holder.empty();

                                        var x = document.getElementById("foto");
                                        var file = x.files[0];

                                        if (extn == "png" || extn == "jpg" || extn == "jpeg" || extn == "gif") {
                                            if (typeof (FileReader) != "undefined") {

                                                //loop for each file selected for uploaded.
                                                for (var i = 0; i < countFiles; i++) {

                                                    var reader = new FileReader();
                                                    reader.onload = function (e) {
                                                        $("<img />", {
                                                            "src": e.target.result,
                                                            "class": "thumb-image"
                                                        }).appendTo(image_holder);
                                                    }

                                                    image_holder.show();
                                                    reader.readAsDataURL($(this)[0].files[i]);
                                                }

                                            } else {
                                                alert("This browser does not support FileReader.");
                                            }
                                        } else {
                                            alert("hanya boleh foto bertype PNG, JPG dan GIF");
                                            var control = $("#foto");
                                            control.replaceWith(control.val('').clone(true));
                                        }
                                    });
                  
                                </script>
                      </div>
                  </div>
                  <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
                          <button class="btn btn-primary" type="button" onclick="javascript:cancel();">Cancel</button>
                          <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success" onclick="javascript:simpan('muser/coba_insert');" id="save" name="save">Submit</button>
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
}
function cancel(){
    $('#detail').show();
    $('#form-tambah').hide();
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
                    document.location="<?php echo base_url()?>" + 'admin/muser';
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
            $('#detail').hide();
            // $.fillToForm("#detail-tambah", data.data);
            $('#id_adm').val(data.data.id_adm);
            $('#nm_ktg').val(data.data.nm_ktg);
            $('#ft_adm').val(data.data.ft_adm);
            $('#fotonya').val(data.data.ft_adm);
            $('#form-tambah').show();
        },
        error : function(res)
        {
            show_message('Gagal',(res.responseText));
        }
    });
}
</script>