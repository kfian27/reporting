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
                   <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>admin/laporan_paket">
                      <div class="col-md-12 col-sm-12 col-xs-12 form-group"> <!-- Date input -->
                        <label for="tiga" class="col-sm-2 control-label"> Periode Berkas Masuk </label>
                        <div class="col-md-3 col-sm-10 col-xs-10">
                          <input type="Date" name="tgl_mulai" id="tgl_mulai" class="form-control" required="required">
                        </div>
                        <div style="float: left; margin-right: 10px; margin-top: 2px; font-size: 20px;">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <label class="col-sm-1 control-label" style="text-align: left;"> Sampai </label>
                        <div class="col-md-3 col-sm-10 col-xs-10">
                          <input type="Date" name="tgl_akhir" id="tgl_akhir" class="form-control" required="required">
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
                          <button class="btn btn-default col-md-5 col-sm-12 col-xs-12" id="pdfhr" type="submit"><i class="fa fa-search"></i> Search</button>
                        </div>
                      </div>
                    </form>
                    <br />
                    <code>SELECT
  NAMA_IJIN,
COUNT (NAMA_IJIN) AS JUMLAHNYA
FROM(
SELECT
T_FO.TGL_REGISTRASI,
T_FO.NO_REGISTRASI,
T_FO_SUB_IJIN.KD_IJIN,
MIJIN.NAMA_IJIN
FROM
T_FO,T_FO_SUB_IJIN,MIJIN
WHERE
T_FO.NO_REGISTRASI = T_FO_SUB_IJIN.NO_REGISTRASI
AND T_FO_SUB_IJIN.KD_IJIN = MIJIN.KD_IJIN
AND T_FO.TGL_REGISTRASI BETWEEN TO_DATE ('2018-01-01', 'yyyy-mm-dd')
AND TO_DATE ('2018-12-31', 'yyyy-mm-dd')
AND T_FO.ID_PAKET = 14
)
GROUP BY NAMA_IJIN</code>
                    <div class="table-responsive">
                          <table id="coba-table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th style="text-align: center;">NAMA PERIZINAN/NON PERIZINAN</th>
                                <th style="text-align: center;">JUMLAH BERKAS</th>
                                <th style="text-align: center;">ACTION</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $a=1; foreach ($hasilnya as $row): ?>
                              <tr>
                                  <td><?php echo $a; ?></td>
                                  <td><?php echo $row->NAMA_IJIN;?></td>
                                  <td><?php echo $row->JUMLAHNYA; $a++;?></td>
                                  <td>
                                    <a type="button" data-title='Edit' class="btn btn-primary pull-right" href="<?php echo base_url();?>admin/laporan_mandiri_detail/<?php echo $tgl_mulai;?>/<?php echo $tgl_akhir;?>/<?php $string = str_replace(' ', '_', $row->NAMA_IJIN); echo str_replace('/', '.', $string);?>/<?php echo $row->JUMLAHNYA;?>"  target="_blank"> View Details </a>
                                  </td>
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
        <script type="text/javascript">
          $(document).ready(function() {
             $('#paket').val('<?php echo $paketnya;?>');
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