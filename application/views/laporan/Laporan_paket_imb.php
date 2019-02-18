      <?php 
        $jumlah_skrk = 0; foreach ($skrknya as $key) {$jumlah_skrk = $key->JUMLAH;}
        $jumlah_imb = 0; foreach ($imbnya as $key) {$jumlah_imb = $key->JUMLAH;}
        $prosesnya_imb = 0; foreach ($proses_imb as $key) {$prosesnya_imb = $key->JUMLAH;}
        $prosesnya_skrk = 0; foreach ($proses_skrk as $key) {$prosesnya_skrk = $key->JUMLAH;}
        $pendingnya_imb = 0; foreach ($pending_imb as $key) {$pendingnya_imb = $key->JUMLAH;}
        $pendingnya_skrk = 0; foreach ($pending_skrk as $key) {$pendingnya_skrk = $key->JUMLAH;}
        $tolaknya_skrk = 0; foreach ($tolak_skrk as $key) {$tolaknya_skrk = $key->JUMLAH;}
        $tolaknya_imb = 0; foreach ($tolak_imb as $key) {$tolaknya_imb = $key->JUMLAH;}
       ?>
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
  ini proses
  <code>SELECT
COUNT( NO_REGISTRASI )
FROM
(
SELECT DISTINCT
* 
FROM
(
SELECT
ID_CKTR,
REGISTER_ULANG.NO_REGISTRASI,
NAMA 
FROM
REGISTER_ULANG,
T_FO_REG_ULANG,
T_FO 
WHERE
REGISTER_ULANG.NO_REGISTRASI = T_FO_REG_ULANG.NO_REGISTRASI 
AND REGISTER_ULANG.TGL_REG = T_FO_REG_ULANG.TGL_REGISTRASI 
AND REGISTER_ULANG.NO_REGISTRASI = T_FO.NO_REGISTRASI 
AND REGISTER_ULANG.TGL_REG = T_FO.TGL_REGISTRASI 
AND REGISTER_ULANG.REG_KE IN T_FO_REG_ULANG.REG_KE 
AND TGL_REG BETWEEN TO_DATE( '2019-01-01', 'yyyy-mm-dd' ) 
AND TO_DATE( '2019-01-31', 'yyyy-mm-dd' ) 
AND REGISTER_ULANG.PERIJINAN = 'IMB' 
AND ID_PAKET = '20' 
) a 
WHERE
ID_CKTR = ( SELECT ID_CKTR FROM ( SELECT * FROM REGISTER_ULANG WHERE REGISTER_ULANG.NO_REGISTRASI = a.NO_REGISTRASI ORDER BY ID_CKTR DESC ) WHERE ROWNUM = 1 ) 
ORDER BY
NO_REGISTRASI ASC 
)</code>
  <br>
  ini pending
  <code>SELECT
COUNT( NO_REGISTRASI )
FROM
(
SELECT DISTINCT
* 
FROM
(
SELECT
ID_CKTR,
REGISTER_ULANG.NO_REGISTRASI,
NAMA 
FROM
REGISTER_ULANG,
T_FO_REG_ULANG,
T_FO 
WHERE
REGISTER_ULANG.NO_REGISTRASI = T_FO_REG_ULANG.NO_REGISTRASI 
AND REGISTER_ULANG.TGL_REG = T_FO_REG_ULANG.TGL_REGISTRASI 
AND REGISTER_ULANG.NO_REGISTRASI = T_FO.NO_REGISTRASI 
AND REGISTER_ULANG.TGL_REG = T_FO.TGL_REGISTRASI 
AND REGISTER_ULANG.REG_KE NOT IN T_FO_REG_ULANG.REG_KE 
AND TGL_REG BETWEEN TO_DATE( '2019-01-01', 'yyyy-mm-dd' ) 
AND TO_DATE( '2019-01-31', 'yyyy-mm-dd' ) 
AND REGISTER_ULANG.PERIJINAN = 'IMB' 
AND ID_PAKET = '20' 
) a 
WHERE
ID_CKTR = ( SELECT ID_CKTR FROM ( SELECT * FROM REGISTER_ULANG WHERE REGISTER_ULANG.NO_REGISTRASI = a.NO_REGISTRASI ORDER BY ID_CKTR DESC ) WHERE ROWNUM = 1 ) 
ORDER BY
NO_REGISTRASI ASC 
)</code>
  <br>
  ini selesai
<code>SELECT
  COUNT (
    VW_SKRK_DETIL.NO_REGISTRASI
  ) AS jumlah
FROM
  VW_SKRK_DETIL,
  T_FO
WHERE
  VW_SKRK_DETIL.NO_REGISTRASI = T_FO.NO_REGISTRASI
AND VW_SKRK_DETIL.TGL_REGISTRASI = T_FO.TGL_REGISTRASI
AND VW_SKRK_DETIL.STATUS LIKE 'PENGESAHAN SK'
AND VW_SKRK_DETIL.TGL_REGISTRASI BETWEEN TO_DATE ('2019-01-01', 'yyyy-mm-dd')
AND TO_DATE ('2019-01-31', 'yyyy-mm-dd')
AND ID_PAKET = '20''</code>
<br>
ini tolak
<code>SELECT
  COUNT (
    VW_SKRK_DETIL.NO_REGISTRASI
  ) AS jumlah
FROM
  VW_SKRK_DETIL,
  T_FO
WHERE
  VW_SKRK_DETIL.NO_REGISTRASI = T_FO.NO_REGISTRASI
AND VW_SKRK_DETIL.TGL_REGISTRASI = T_FO.TGL_REGISTRASI
AND VW_SKRK_DETIL.STATUS LIKE 'DITOLAK'
AND VW_SKRK_DETIL.TGL_REGISTRASI BETWEEN TO_DATE ('2019-01-01', 'yyyy-mm-dd')
AND TO_DATE ('2019-01-31', 'yyyy-mm-dd')
AND ID_PAKET = '20''</code>
                    <div class="table-responsive">
                          <table id="coba-table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th style="text-align: center;">NAMA PERIZINAN/NON PERIZINAN</th>
                                <th style="text-align: center;">PROSES</th>
                                <th style="text-align: center;">PENDING</th>
                                <th style="text-align: center;">DITOLAK</th>
                                <th style="text-align: center;">SELESAI</th>
                                <th style="text-align: center;">JUMLAH BERKAS</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $total_array = count($hasilnya);$jumlah_total=0;$b=0; $a=1;
                              foreach ($hasilnya as $row){
                                if($b < $total_array - 2 ) {
                                  $jumlah_total = $jumlah_total + $row->JUMLAHNYA;
                                  $b++;
                                }
                                elseif($b < $total_array - 1){
                                  $jumlah_total = $prosesnya_imb + $pendingnya_imb + $tolaknya_imb + $jumlah_imb;
                                  echo "<tr>
                                    <td>".$a."</td>
                                    <td>".$row->NAMA_IJIN."</a></td>
                                    <td><a type='button' data-title='button' class='btn btn-primary pull-right' href='".base_url()."admin/proses_paket_detail/".$tgl_mulai."/".$tgl_akhir."/20/IMB/".$prosesnya_imb."'>".$prosesnya_imb."</a></td>
                                    <td><a type='button' data-title='button' class='btn btn-primary pull-right' href='".base_url()."admin/pending_paket_detail/".$tgl_mulai."/".$tgl_akhir."/20/IMB/".$pendingnya_imb."'>".$pendingnya_imb."</a></td>
                                    <td>".$tolaknya_imb."</td>
                                    <td><a type='button' data-title='button' class='btn btn-primary pull-right' href='".base_url()."admin/selesai_paket_detail/".$tgl_mulai."/".$tgl_akhir."/20/IMB/".$jumlah_imb."'>".$jumlah_imb."</a></td>
                                    <td>".$jumlah_total."</td>
                                </tr>";
                                $a++;$b++;
                                }
                                else{
                                  $jumlah_total = $prosesnya_skrk + $pendingnya_skrk + $tolaknya_skrk + $jumlah_skrk;
                                  echo "<tr>
                                    <td>".$a."</td>
                                    <td>".$row->NAMA_IJIN."</td>
                                    <td><a type='button' data-title='button' class='btn btn-primary pull-right' href='".base_url()."admin/proses_paket_detail/".$tgl_mulai."/".$tgl_akhir."/20/SKRK/".$prosesnya_skrk."'>".$prosesnya_skrk."</a></td>
                                    <td><a type='button' data-title='button' class='btn btn-primary pull-right' href='".base_url()."admin/pending_paket_detail/".$tgl_mulai."/".$tgl_akhir."/20/SKRK/".$pendingnya_skrk."'>".$pendingnya_skrk."</a></td>
                                    <td>".$tolaknya_skrk."</td>
                                    <td><a type='button' data-title='button' class='btn btn-primary pull-right' href='".base_url()."admin/selesai_paket_detail/".$tgl_mulai."/".$tgl_akhir."/20/SKRK/".$jumlah_skrk."'>".$jumlah_skrk."</a></td>
                                    <td>".$jumlah_total."</td>
                                  </tr>";
                                }
                              }?>
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
            else if(empat == 23 || empat ==30){
              window.location = "<?php echo base_url();?>admin/laporan_paket_hasil/"+satu+"/"+dua+"/"+empat
            }
            else {
              window.location = "<?php echo base_url();?>admin/laporan_paket_hasil_gabungan/"+satu+"/"+dua+"/"+empat;
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