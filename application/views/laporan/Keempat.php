  <?php  $this->load->model('mlaporan'); ?>
      <div class="right_col" role="main" id="view">
        <div class="">
          <div class="row">
            <div class="clearfix"></div> 
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <h1><?php echo $judulnya; ?></h1>
                      <h4><?php echo "Periode Berkas Masuk ".date('d F Y', strtotime($tgl_mulai))." Sampai ".date('d F Y', strtotime($tgl_akhir))." Dengan Total Berkas Masuk ".$jumlah_total;?></h4>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12"> <!-- Date input -->
                      <canvas id="pie1" height="150px"></canvas>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <div class="table-responsive">
                          <table id="coba-table" class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                              <tr>
                                <th style="max-width: 10%;">No</th>
                                <th style="text-align: center; max-width: 10%;">NAMA PERIZINAN/NON PERIZINAN</th>
                                <th style="text-align: center; max-width: 10%;">PROSES</th>
                                <th style="text-align: center; max-width: 10%;">PENDING</th>
                                <th style="text-align: center; max-width: 10%;">DITOLAK</th>
                                <th style="text-align: center; max-width: 10%;">SELESAI</th>
                                <th style="text-align: center; max-width: 10%;">TOTAL</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $total_proses=0;$total_pending=0;$total_tolak=0;$total_selesai=0; $a=1; foreach ($hasilnya as $row): ?>
                              <tr>
                                  <td><?php echo $a; ?></td>
                                  <td><?php echo $row->NAMA_IJIN;
                                  $jumlah_total = $row->JUMLAHNYA;
                                  $kode_ijinnya = $row->ID;
                                  $nama_ijinnya = $row->NAMA_IJIN;
                                  ?></td>
                                  <td style="text-align: right;"><?php 
                                  $prosesnya = $this->mlaporan->get_proses($tgl_mulai,$tgl_akhir,$judulnya,$row->ID);
                                    if (!$prosesnya) {?>
                                      <a type="button" data-title='button' class="btn btn-default pull-right" disabled> 0 </a>
                                    <?php
                                    }
                                    else { 
                                      foreach ($prosesnya as $row){
                                        ?>
                                        <a type="button" data-title='button' class="btn btn-primary pull-right" href="<?php echo base_url();?>admin/proses_detail/<?php echo $tgl_mulai;?>/<?php echo $tgl_akhir;?>/<?php $string = str_replace(' ', '_', $nama_ijinnya); echo str_replace('/', '.', $string);?>/<?php echo $kode_ijinnya;?>" target="_blank"> <?php echo $row->PROSESNYA;?> </a>
                                        <?php
                                        $total_proses = $total_proses + $row->PROSESNYA;
                                      }
                                    }
                                  ?>
                                  </td>
                                  <td style="text-align: right;"><?php 
                                  $pendingnya = $this->mlaporan->get_pending($tgl_mulai,$tgl_akhir,$judulnya,$row->ID);
                                    if (!$pendingnya) {?>
                                      <a type="button" data-title='button' class="btn btn-default pull-right" disabled> 0 </a>
                                    <?php
                                    }
                                    else { 
                                      foreach ($pendingnya as $row){
                                        ?>
                                        <a type="button" data-title='button' class="btn btn-primary pull-right" href="<?php echo base_url();?>admin/pending_detail/<?php echo $tgl_mulai;?>/<?php echo $tgl_akhir;?>/<?php $string = str_replace(' ', '_', $nama_ijinnya); echo str_replace('/', '.', $string);?>/<?php echo $kode_ijinnya;?>" target="_blank"> <?php echo $row->PENDINGNYA;?> </a>
                                        <?php
                                        $total_pending = $total_pending + $row->PENDINGNYA;
                                      }
                                    }
                                  ?></td>
                                  <td style="text-align: right;"><?php 
                                  $tolaknya = $this->mlaporan->get_tolak($tgl_mulai,$tgl_akhir,$judulnya,$row->ID);
                                  if (!$tolaknya) {?>
                                      <a type="button" data-title='button' class="btn btn-default pull-right" disabled> 0 </a>
                                    <?php
                                  }
                                  else {
                                    foreach ($tolaknya as $row){
                                      ?>
                                      <a type="button" data-title='button' class="btn btn-primary pull-right" href="<?php echo base_url();?>admin/tolak_detail/<?php echo $tgl_mulai;?>/<?php echo $tgl_akhir;?>/<?php $string = str_replace(' ', '_', $nama_ijinnya); echo str_replace('/', '.', $string);?>/<?php echo $kode_ijinnya;?>" target="_blank"> <?php echo $row->TOLAKNYA;?> </a>
                                      <?php
                                      $total_tolak = $total_tolak + $row->TOLAKNYA;
                                    }
                                  }
                                  ?></td>
                                  <td style="text-align: right;"><?php 
                                  $selesainya = $this->mlaporan->get_selesai($tgl_mulai,$tgl_akhir,$judulnya,$row->ID);
                                    if (!$selesainya) {?>
                                      <a type="button" data-title='button' class="btn btn-default pull-right" disabled> 0 </a>
                                    <?php
                                    }
                                    else {  
                                      foreach ($selesainya as $row){
                                        ?>
                                        <a type="button" data-title='button' class="btn btn-primary pull-right" href="<?php echo base_url();?>admin/selesai_detail/<?php echo $tgl_mulai;?>/<?php echo $tgl_akhir;?>/<?php $string = str_replace(' ', '_', $nama_ijinnya); echo str_replace('/', '.', $string);?>/<?php echo $kode_ijinnya;?>" target="_blank"> <?php echo $row->SELESAINYA;?> </a>
                                        <?php
                                        $total_selesai = $total_selesai + $row->SELESAINYA;
                                      }
                                    }
                                  ?></td>
                                  <td style="text-align: right;"><?php echo $jumlah_total; $a++;?></td>
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
        <script src="<?php echo base_url();?>assets/dash/vendors/Chart.js/dist/Chart.min.js"></script>
        <script type="text/javascript">
          $(document).ready(function() {
          var ctx = document.getElementById("pie1");
          var data = {
          datasets: [{
            data: [<?php echo $total_proses;?>, <?php echo $total_pending;?>, <?php echo $total_tolak;?>, <?php echo $total_selesai;?>],
            backgroundColor: [
            "#0066ff",
            "#ff9933",
            "#ff1a1a",
            "#00e600"
            ],
            label: 'My dataset' // for legend
          }],
          labels: [
            "Proses",
            "Pending",
            "Ditolak",
            "Selesai"
          ]
          };
          var pieChart = new Chart(ctx, {
            data: data,
            type: 'pie',
            otpions: {
              title: {
                display: true,
                fontSize: 12,
                text:'Jumlah Berkas Masuk'
              },
              legend: false
            }
          });
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
                  title: '-<?php echo $judulnya; ?>-',
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          });
        </script>