      <div class="right_col" role="main" id="view">
        <div class="">
          <div class="row">
            <div class="clearfix"></div> 
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h1>Laporan Tahunan Perizinan/Non Perizinan SSW Parsial/Mandiri</h1>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <form class="form-horizontal"  method="post" action="<?php echo base_url(); ?>laporan_mandiri/grafik_tahunan">
                      <div class="col-md-12 col-sm-12 col-xs-12 form-group"> <!-- Date input -->
                        <label for="tiga" class="col-sm-4 control-label" style="text-align: left;"> Tahun Berkas Masuk </label>
                        <div class="col-md-8 col-sm-12 col-xs-12">
                          <select id="tahun_masuk" name="tahun_masuk" class="form-control" placeholder="Tahun Masuk" required="required">
                            <option value="">--Tahun Masuk--</option>
                            <?php  foreach ($tanggal as $row): ?>
                              <option value="<?php echo $row->TAHUNNYA; ?>"><?php echo $row->TAHUNNYA; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12 form-group"> <!-- Date input -->
                        <label for="tiga" class="col-sm-4 control-label" style="text-align: left;"> Perangkat Daerah </label>
                        <div class="col-md-8 col-sm-12 col-xs-12">
                          <select id="uptd" name="uptd" class="form-control" placeholder="Lokasi" required="required">
                            <option value="">--Nama perangkat daerah--</option>
                            <option value="%">Semua</option>
                            <?php  foreach ($nama_skpd as $row): ?>
                              <option value="<?php echo $row->KD_SKPD; ?>"><?php echo $row->NAMA_SKPD; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12 form-group"> <!-- Date input -->
                        <label for="tiga" class="col-sm-4 control-label" style="text-align: left;"> Nama Perizinan/Non Perizinan </label>
                        <div class="col-md-8 col-sm-12 col-xs-12">
                          <select id="ijinnya" name="ijinnya" class="form-control" placeholder="Ijin" required="required">
                            <!-- <option value="">-- Ijin --</option> -->
                          </select>
                        </div>
                      </div>
                      <!-- <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                        <label for="tiga" class="col-sm-4 control-label" style="text-align: left;"> Jenis Izin </label>
                        <div class="col-md-8 col-sm-12 col-xs-12">
                          <select id="uptd" name="uptd" class="form-control" placeholder="Lokasi" required="required">
                            <option value="">-- Lokasi --</option>
                            <?php//  for ($i=1; $i < 11 ; $i++) { ?>
                              <option value="<?php echo $i; ?>"><?php echo "Berkas selesai (SK Terbit) ".$i; ?></option>
                            <?php// }?>
                          </select>
                        </div>
                      </div> -->
                      <div class="col-md-12 col-sm-12 col-xs-12"> <!-- Submit button -->
                          <button class="btn btn-default col-md-12 col-sm-12 col-xs-12" type="submit"><i class="fa fa-search"></i> Search</button>
                        </div>
                    </form>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <script src="<?php echo base_url();?>assets/dash/vendors/Chart.js/dist/Chart.min.js"></script>
        <script type="text/javascript">
          $("#uptd").change(function(){
            var post_url = '<?php echo base_url(); ?>Laporan/getByDeviceId'
            var uptdnya = $(this).val();
            $.ajax({
                method: 'post',
                url: post_url,
                data : {uptdnya:uptdnya},
                dataType: 'json',
                success: function(response){
                  $('#ijinnya').html(response.list_ijin).show();
                }
            });
          });
          // function coba2(){
          //   var a =  $('#ijinnya').val(); 
          //   var b =  $('#tahun_masuk').val(); 
          //   var c =  $('#uptd').val(); 
          //   alert(a+","+b+","+c);
          // }
        </script>