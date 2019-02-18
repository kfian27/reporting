      <div class="right_col" role="main" id="view">
        <div class="">
          <div class="row">
            <div class="clearfix"></div> 
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h1>Report Perizinan/Non-Perizinan SSW Paket</h1>
                    <!-- <h5><?php echo "Periode Berkas Masuk ".date('d F Y', strtotime($tgl_mulai))." Sampai ".date('d F Y', strtotime($tgl_akhir));?></h5> -->
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   <form class="form-horizontal" method="post">
                      <div class="col-md-12 col-sm-12 col-xs-12 form-group"> <!-- Date input -->
                        <label for="tiga" class="col-sm-2 control-label"> Periode Berkas Masuk </label>
                        <div class="col-md-3 col-sm-10 col-xs-10">
                          <input type="text" placeholder="dd/mm/yyyy" name="tgl_mulai" id="tgl_mulai" class="form-control" required="required">
                        </div>
                        <div style="float: left; margin-right: 10px; margin-top: 2px; font-size: 20px;">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <label class="col-sm-1 control-label" style="text-align: left;"> Sampai </label>
                        <div class="col-md-3 col-sm-10 col-xs-10">
                          <input type="text" placeholder="dd/mm/yyyy" name="tgl_akhir" id="tgl_akhir" class="form-control" required="required">
                        </div>
                        <div style="float: left; margin-right: 10px; margin-top: 2px; font-size: 20px;">
                          <i class="fa fa-calendar"></i>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12 form-group"> <!-- Date input -->
                        <label for="tiga" class="col-sm-2 control-label"> Pilih Paket </label>
                        <div class="col-md-4 col-sm-10 col-xs-10">
                          <select id="paket" name="paket" class="form-control" placeholder="Lokasi" required="required">
                            <option value="">--Nama Paket--</option>
                            <option value="%">Semua</option>
                            <?php  foreach ($nama_paket as $row): ?>
                              <option value="<?php echo $row->ID_PAKET; ?>"><?php echo $row->KETERANGAN; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="col-md-6 col-sm-10 col-xs-10"> <!-- Submit button -->
                          <a class="btn btn-default col-md-5 col-sm-12 col-xs-12" id="pdfhr" onclick="coba_alert()"><i class="fa fa-search"></i> Search</a>
                        </div>
                      </div>
                    </form>
                    <br />
                    <div class="table-responsive">
                          <table id="coba-table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th style="text-align: center;">NAMA PERIZINAN/NON PERIZINAN</th>
                                <th style="text-align: center;">PROSES</th>
                                <th style="text-align: center;">SELESAI</th>
                                <th style="text-align: center;">JUMLAH BERKAS</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $a=1; foreach ($hasilnya as $row): ?>
                              <tr>
                                  <td><?php echo $a; ?></td>
                                  <td><?php echo $row->NAMA_IJIN;?></td>
                                  <td>0</td>
                                  <td>0</td>
                                  <td><?php echo $row->JUMLAHNYA; $a++;?></td>
                              </tr>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                        </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <script src="<?php echo base_url();?>assets/dash/vendors/moment/min/moment.min.js"></script>   
        <script src="<?php echo base_url();?>assets/dash/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript">
          function coba_alert(){
            var satu = $('#tgl_mulai').val();
            var dua = $('#tgl_akhir').val();
            var empat = $('#paket').val();
            if (empat == 20) {
               window.location = "<?php echo base_url();?>admin/laporan_paket_hasil_IMB/"+satu+"/"+dua+"/"+empat;
            }
            else {
              window.location = "<?php echo base_url();?>admin/laporan_paket_hasil/"+satu+"/"+dua+"/"+empat;
            }
          }
          $(document).ready(function() {
             $('#paket').val('<?php echo $paketnya;?>');
             $('#tgl_mulai').datetimepicker({
                format: 'DD-MM-YYYY'
              });
             $('#tgl_akhir').datetimepicker({
                format: 'DD-MM-YYYY'
              });
             $('#tgl_mulai').val('<?php echo $tgl_mulai;?>');
             $('#tgl_akhir').val('<?php echo $tgl_akhir;?>');
             $("#coba-table").DataTable({
              dom: "Blfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  title: 'Kominfo Reporting',
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          });
        </script>