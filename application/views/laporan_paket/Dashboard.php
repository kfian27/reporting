      <div class="right_col" role="main" id="view">
        <div class="">
          <div class="row">
            <div class="clearfix"></div> 
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h1>Laporan Tahunan Perizinan/Non Perizinan SSW Paket</h1>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <form class="form-horizontal"  method="post">
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
                        <label for="tiga" class="col-sm-4 control-label" style="text-align: left;"> Pilih Paket </label>
                        <div class="col-md-8 col-sm-12 col-xs-12">
                          <select id="paket" name="paket" class="form-control" required="required">
                            <option value="">--Pilih Paket--</option>
                            <option value="%">Semua</option>
                            <?php  foreach ($nama_paket as $row): ?>
                              <option value="<?php echo $row->ID_PAKET; ?>"><?php echo $row->KETERANGAN; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12"> <!-- Submit button -->
                          <a class="btn btn-default col-md-12 col-sm-12 col-xs-12" onclick="coba_alert()"><i class="fa fa-search"></i> Search</a>
                        </div>
                    </form>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <script type="text/javascript">
           function coba_alert(){
            var satu = $('#tahun_masuk').val();
            var empat = $('#paket').val();
            if (empat == 20) {
               window.location = "<?php echo base_url();?>laporan_paket/grafik_tahunan_imb/"+satu+"/"+empat;
            }
            else if(empat == 23 || empat ==30){
              window.location = "<?php echo base_url();?>laporan_paket/grafik_tahunan/"+satu+"/"+empat
            }
            else {
              window.location = "<?php echo base_url();?>laporan_paket/grafik_tahunan_gabungan/"+satu+"/"+empat;
            }
          }
        </script>