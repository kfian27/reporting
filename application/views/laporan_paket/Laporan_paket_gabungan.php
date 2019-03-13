      <?php  $this->load->model('mlaporan_paket');?>
        <?php 
        $selesainya_skrk = 0; foreach ($skrknya as $key) {$selesainya_skrk = $key->JUMLAH;}
        $selesainya_imb = 0; foreach ($imbnya as $key) {$selesainya_imb = $key->JUMLAH;}
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
                    <div class="table-responsive">
                          <table id="coba-table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th style="text-align: center;">NAMA PERIZINAN/NON PERIZINAN</th>
                                <th style="text-align: center;">PROSES</th>
                                <th style="text-align: center;">PENDING</th>
                                <th style="text-align: center;">TOLAK</th>
                                <th style="text-align: center;">SELESAI</th>
                                <th style="text-align: center;">JUMLAH BERKAS</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $a=1; foreach ($hasilnya as $row): ?>
                              <?php $JUMLAHNYA = 0; $nama_headernya = $row->NM_HEADER; ?>
                              <?php if($nama_headernya == "Ijin Mendirikan Bangunan"):?>
                                <tr>
                                    <td><?php echo $a; ?></td>
                                    <td><?php echo $row->NM_HEADER;?></td>
                                    <td>
                                     <a type='button' data-title='button' href='<?php echo base_url();?>laporan_paket/proses_detail/<?php echo $tgl_mulai;?>/<?php echo $tgl_akhir;?>/<?php echo $paketnya;?>/IMB/<?php echo $prosesnya_imb;?>' <?php if($prosesnya_imb==0)echo "class='btn btn-default pull-right' disabled";else echo "class='btn btn-primary pull-right'";?>><?php echo $prosesnya_imb;$JUMLAHNYA = $JUMLAHNYA + $prosesnya_imb;?></a>
                                    </td>
                                   <td>
                                     <a type='button' data-title='button' href='<?php echo base_url();?>laporan_paket/pending_detail/<?php echo $tgl_mulai;?>/<?php echo $tgl_akhir;?>/<?php echo $paketnya;?>/IMB/<?php echo $pendingnya_imb;?>' <?php if($pendingnya_imb==0)echo "class='btn btn-default pull-right' disabled";else echo "class='btn btn-primary pull-right'";?>><?php echo $pendingnya_imb;$JUMLAHNYA = $JUMLAHNYA + $pendingnya_imb;?></a>
                                    </td>
                                    <td>
                                     <a type='button' data-title='button' href='<?php echo base_url();?>tolak_detail/<?php echo $tgl_mulai;?>/<?php echo $tgl_akhir;?>/<?php echo $paketnya;?>/IMB/<?php echo $tolaknya_imb;?>' <?php if($tolaknya_imb==0)echo "class='btn btn-default pull-right' disabled";else echo "class='btn btn-primary pull-right'";?>><?php echo $tolaknya_imb;$JUMLAHNYA = $JUMLAHNYA + $tolaknya_imb;?></a>
                                    </td>
                                    <td>
                                     <a type='button' data-title='button' href='<?php echo base_url();?>laporan_paket/selesai_detail/<?php echo $tgl_mulai;?>/<?php echo $tgl_akhir;?>/<?php echo $paketnya;?>/IMB/<?php echo $selesainya_imb;?>' <?php if($selesainya_imb==0)echo "class='btn btn-default pull-right' disabled";else echo "class='btn btn-primary pull-right'";?>><?php echo $selesainya_imb;$JUMLAHNYA = $JUMLAHNYA + $selesainya_imb;?></a>
                                    </td>
                                    <td><?php echo $JUMLAHNYA; $a++;?></td>
                                </tr>
                              <?php elseif($nama_headernya == 'Surat Keterangan Rencana Kota'):?>
                                <tr>
                                  <td><?php echo $a; ?></td>
                                  <td><?php echo $row->NM_HEADER;?></td>
                                  <td>
                                   <a type='button' data-title='button' href='<?php echo base_url();?>laporan_paket/proses_detail/<?php echo $tgl_mulai;?>/<?php echo $tgl_akhir;?>/<?php echo $paketnya;?>/SKRK/<?php echo $prosesnya_skrk;?>' <?php if($prosesnya_skrk==0)echo "class='btn btn-default pull-right' disabled";else echo "class='btn btn-primary pull-right'";?>><?php echo $prosesnya_skrk;$JUMLAHNYA = $JUMLAHNYA + $prosesnya_skrk;?></a>
                                  </td>
                                  <td>
                                   <a type='button' data-title='button' href='<?php echo base_url();?>laporan_paket/pending_detail/<?php echo $tgl_mulai;?>/<?php echo $tgl_akhir;?>/<?php echo $paketnya;?>/SKRK/<?php echo $pendingnya_skrk;?>' <?php if($pendingnya_skrk==0)echo "class='btn btn-default pull-right' disabled";else echo "class='btn btn-primary pull-right'";?>><?php echo $pendingnya_skrk;$JUMLAHNYA = $JUMLAHNYA + $pendingnya_skrk;?></a>
                                  </td>
                                  <td>
                                   <a type='button' data-title='button' href='<?php echo base_url();?>laporan_paket/tolak_detail/<?php echo $tgl_mulai;?>/<?php echo $tgl_akhir;?>/<?php echo $paketnya;?>/SKRK/<?php echo $tolaknya_skrk;?>' <?php if($tolaknya_skrk==0)echo "class='btn btn-default pull-right' disabled";else echo "class='btn btn-primary pull-right'";?>><?php echo $tolaknya_skrk;$JUMLAHNYA = $JUMLAHNYA + $tolaknya_imb;?></a>
                                  </td>
                                  <td>
                                   <a type='button' data-title='button' href='<?php echo base_url();?>laporan_paket/selesai_detail/<?php echo $tgl_mulai;?>/<?php echo $tgl_akhir;?>/<?php echo $paketnya;?>/SKRK/<?php echo $selesainya_skrk;?>' <?php if($selesainya_skrk==0)echo "class='btn btn-default pull-right' disabled";else echo "class='btn btn-primary pull-right'";?>><?php echo $selesainya_skrk;$JUMLAHNYA = $JUMLAHNYA + $selesainya_skrk;?></a>
                                  </td>
                                  <td><?php echo $JUMLAHNYA; $a++;?></td>
                              </tr>
                              <?php else :?>
                                <tr>
                                    <td><?php echo $a; ?></td>
                                    <td><?php echo $row->NM_HEADER;?></td>
                                    <td><?php 
                                    $prosesnya = $this->mlaporan_paket->get_tanggal_proses($tgl_mulainya,$tgl_akhirnya,$paketnya,$nama_headernya);
                                      if (!$prosesnya) {?>
                                        <a type="button" data-title='button' class="btn btn-default pull-right" disabled> 0 </a>
                                      <?php
                                      }
                                      else {  
                                        foreach ($prosesnya as $row){
                                          ?>
                                          <a type="button" data-title='button' class="btn btn-primary pull-right" href='<?php echo base_url();?>laporan_paket/proses_detail/<?php echo $tgl_mulai;?>/<?php echo $tgl_akhir;?>/<?php echo $paketnya;?>/<?php $string = str_replace(' ', '_', $nama_headernya); echo str_replace('/', '.', $string);?>/<?php echo $row->PROSES;?>'> <?php echo $row->PROSES;$JUMLAHNYA = $JUMLAHNYA + $row->PROSES;?> </a>
                                          <?php
                                        }
                                      }
                                    ?></td>
                                    <td><?php 
                                    $pendingnya = $this->mlaporan_paket->get_tanggal_pending($tgl_mulainya,$tgl_akhirnya,$paketnya,$nama_headernya);
                                      if (!$pendingnya) {?>
                                        <a type="button" data-title='button' class="btn btn-default pull-right" disabled> 0 </a>
                                      <?php
                                      }
                                      else {  
                                        foreach ($pendingnya as $row){
                                          ?>
                                          <a type="button" data-title='button' class="btn btn-primary pull-right" href='<?php echo base_url();?>laporan_paket/pending_detail/<?php echo $tgl_mulai;?>/<?php echo $tgl_akhir;?>/<?php echo $paketnya;?>/<?php $string = str_replace(' ', '_', $nama_headernya); echo str_replace('/', '.', $string);?>/<?php echo $row->PENDING;?>'> <?php echo $row->PENDING;$JUMLAHNYA = $JUMLAHNYA + $row->PENDING;?></a>
                                          <?php
                                        }
                                      }
                                    ?></td>
                                    <td><?php 
                                    $tolaknya = $this->mlaporan_paket->get_tanggal_tolak($tgl_mulainya,$tgl_akhirnya,$paketnya,$nama_headernya);
                                      if (!$tolaknya) {?>
                                        <a type="button" data-title='button' class="btn btn-default pull-right" disabled> 0 </a>
                                      <?php
                                      }
                                      else {  
                                        foreach ($tolaknya as $row){
                                          ?>
                                          <a type="button" data-title='button' class="btn btn-primary pull-right" href='<?php echo base_url();?>laporan_paket/tolak_detail/<?php echo $tgl_mulai;?>/<?php echo $tgl_akhir;?>/<?php echo $paketnya;?>/<?php $string = str_replace(' ', '_', $nama_headernya); echo str_replace('/', '.', $string);?>/<?php echo $row->TOLAK;?>'> <?php echo $row->TOLAK;$JUMLAHNYA = $JUMLAHNYA + $row->TOLAK;?></a>
                                          <?php
                                        }
                                      }
                                    ?></td>
                                    <td>
                                      <?php 
                                    $selesainya = $this->mlaporan_paket->get_tanggal_selesai($tgl_mulainya,$tgl_akhirnya,$paketnya,$nama_headernya);
                                      if (!$selesainya) {?>
                                        <a type="button" data-title='button' class="btn btn-default pull-right" disabled> 0 </a>
                                      <?php
                                      }
                                      else {  
                                        foreach ($selesainya as $row){
                                          ?>
                                          <a type="button" data-title='button' class="btn btn-primary pull-right" href='<?php echo base_url();?>laporan_paket/selesai_detail/<?php echo $tgl_mulai;?>/<?php echo $tgl_akhir;?>/<?php echo $paketnya;?>/<?php $string = str_replace(' ', '_', $nama_headernya); echo str_replace('/', '.', $string);?>/<?php echo $row->SELESAI;?>'> <?php echo $row->SELESAI;$JUMLAHNYA = $JUMLAHNYA + $row->SELESAI;?> </a>
                                          <?php
                                        }
                                      }
                                    ?>
                                    </td>
                                    <td><?php echo $JUMLAHNYA; $a++;?></td>
                                </tr>
                              <?php endif;?>
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
               window.location = "<?php echo base_url();?>laporan_paket/hasil_IMB/"+satu+"/"+dua+"/"+empat;
            }
            else if(empat == 23 || empat ==30){
              window.location = "<?php echo base_url();?>laporan_paket/hasil/"+satu+"/"+dua+"/"+empat
            }
            else {
              window.location = "<?php echo base_url();?>laporan_paket/hasil_gabungan/"+satu+"/"+dua+"/"+empat;
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