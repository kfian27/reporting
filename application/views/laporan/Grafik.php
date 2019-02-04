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
          if(!$grafiknya){
            $labelnya = array("January", "February", "March", "April", "May","June","July","August","September","October","November","December");
            $datanya = array("0","0","0","0","0","0","0","0","0","0","0","0");
            $jumlah_data = count($labelnya);
          }
          else{
            foreach($grafiknya as $row){
              $labelnya[] = $row->BULAN;
              $datanya[] = (float) $row->TOTAL;
            }
          }
          if(!$grafiknya1){
            // $labelnya1 = array("January", "February", "March", "April", "May","June","July","August","September","October","November","December"); 
            $jumlah_data = count($labelnya);
            for ($i=0; $i <$jumlah_data ; $i++) { 
              $datanya1[] = "0";
            }
          }
          else{
            foreach($grafiknya1 as $row){
              // $labelnya1[] = $row->BULAN;
              $datanya1[] = (float) $row->TOTAL;
            }
            $jumlah_data = count($labelnya);
            $jumlah_data_ini = count($datanya1);
            if ($jumlah_data_ini != $jumlah_data)  {
              $hitungan = $jumlah_data - $jumlah_data_ini;
              for ($i=0; $i < $hitungan; $i++) { 
                $datanya1[] = "0";
              }
            }
          }
          if(!$grafiknya2){
            // $labelnya2 = array("January", "February", "March", "April", "May","June","July","August","September","October","November","December");
            $jumlah_data = count($labelnya);
            for ($i=0; $i <$jumlah_data ; $i++) { 
              $datanya2[] = "0";
            }
          }
          else{
            foreach($grafiknya2 as $row){
              // $labelnya2[] = $row->BULAN;
              $datanya2[] = (float) $row->TOTAL;
            }
            $jumlah_data = count($labelnya);
            $jumlah_data_ini = count($datanya2);
            if ($jumlah_data_ini != $jumlah_data) {
              $hitungan = $jumlah_data - $jumlah_data_ini;
              for ($i=0; $i < $hitungan ; $i++) { 
                $datanya2[] = "0";
              }
            }
          }
          if(!$grafiknya3){
            // $labelnya3 = array("January", "February", "March", "April", "May","June","July","August","September","October","November","December");
            $jumlah_data = count($labelnya);
            for ($i=0; $i <$jumlah_data ; $i++) { 
              $datanya3[] = "0";
            }
          }
          else{
            foreach($grafiknya3 as $row){
              // $labelnya3[] = $row->BULAN;
              $datanya3[] = (float) $row->TOTAL;
            }
            $jumlah_data = count($labelnya);
            $jumlah_data_ini = count($datanya3);
            if ($jumlah_data_ini != $jumlah_data) {
              $hitungan = $jumlah_data - $jumlah_data_ini;
              for ($i=0; $i < $hitungan ; $i++) { 
                $datanya3[] = "0";
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