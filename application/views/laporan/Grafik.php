      <?php $this->load->model('mlaporan'); ?>
      <div class="right_col" role="main" id="view">
        <div class="">
          <div class="row">
            <div class="clearfix"></div> 
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h1>Dashboard Perizinan/Non Perizinan SSW</h1>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <form class="form-horizontal" action="<?php echo base_url(); ?>admin/grafik" method="POST">
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
                      <div class="col-md-12 col-sm-12 col-xs-12"> <!-- Submit button -->
                          <button class="btn btn-default col-md-12 col-sm-12 col-xs-12" id="pdfhr" type="submit"><i class="fa fa-search"></i> Search</button>
                        </div>
                    </form>
                  </div>
                  <div class="col-md-1 col-sm-12 col-xs-12"></div>
                  <div class="col-md-9 col-sm-12 col-xs-12 form-group">
                    <canvas id="graph1" height="200px;"></canvas>
                      <!-- <button id="save-btn">Save Chart Image</button> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
            $labelnya = array("Januari", "Februari", "Maret", "April", "Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
            for ($b=1; $b < 13 ; $b++) { 
              $dash_pending = $this->mlaporan->get_dashboard_pending($tahunnya,$skpdnya,$judul_grafik,$b);
              $dash_proses = $this->mlaporan->get_dashboard_proses($tahunnya,$skpdnya,$judul_grafik,$b);
              $dash_tolak = $this->mlaporan->get_dashboard_tolak($tahunnya,$skpdnya,$judul_grafik,$b);
              $dash_selesai = $this->mlaporan->get_dashboard_selesai($tahunnya,$skpdnya,$judul_grafik,$b);
              if (!$dash_selesai) {
                $datanya[] = 0;
              }
              else{
                foreach ($dash_selesai as $row) {
                  $datanya[] = (float) $row->TOTAL;
                }
              }
              if (!$dash_proses) {
                $datanya1[] = 0;
              }
              else{
                foreach ($dash_proses as $row1) {
                  $datanya1[] = (float) $row1->TOTAL;
                }
              }
              if (!$dash_tolak) {
                $datanya2[] = 0;
              }
              else{
                foreach ($dash_tolak as $row2) {
                  $datanya2[] = (float) $row2->TOTAL;
                }
              }
              if (!$dash_pending) {
                $datanya3[] = 0;
              }
              else{
                foreach ($dash_pending as $row3) {
                  $datanya3[] = (float) $row3->TOTAL;
                }
              }
            }
        ?>
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
          var ctx = document.getElementById("graph1");
          var config = {
            type: 'bar',
            data: {
              labels: <?php echo json_encode($labelnya);?>,
              datasets: [{
                label: 'Selesai',
                backgroundColor: "#00e600",
                data: <?php echo json_encode($datanya);?>
                },{
                label: 'Proses',
                backgroundColor: "#0066ff",
                data: <?php echo json_encode($datanya1);?>
                },
                {
                label: 'Ditolak',
                backgroundColor: "#ff1a1a",
                data: <?php echo json_encode($datanya2);?>
                },
                {
                label: 'Pending',
                backgroundColor: "#ff9933",
                data: <?php echo json_encode($datanya3);?>
                }
              ]
            },
            options: {
              title: {
                display: true,
                fontSize: 14,
                text:'Berkas Masuk <?php echo $judul_grafik." ".$tahunnya;?>'
              },
              tooltips: {
                mode: 'label'
              },
              responsive: true,
              scales: {
                yAxes: [{
                  ticks: {
                  beginAtZero: true
                  }
                }]
              },
              legend: {
                display: true
              },
              // tooltips: {
              //   callbacks: {
              //     label: function(tooltipItem) {
              //        return tooltipItem.yLabel;
              //     }
              //   }
              // }
            }
          };
          var newChart = new Chart(ctx, config);
        </script>