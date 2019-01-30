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
                    <form class="form-horizontal" action="<?php echo base_url(); ?>laporan/pdf_bulan" method="POST" target="_blank">
                      <div class="col-md-12 col-sm-12 col-xs-12 form-group"> <!-- Date input -->
                        <label for="tiga" class="col-sm-4 control-label" style="text-align: left;"> Tahun Berkas Masuk </label>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                          <select id="uptd" name="uptd" class="form-control" placeholder="Lokasi" required="required">
                            <option value="">-- Lokasi --</option>
                            <?php  for ($i=1; $i < 10 ; $i++) { ?>
                              <option value="<?php echo $i; ?>"><?php echo "201".$i; ?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12 form-group"> <!-- Date input -->
                        <label for="tiga" class="col-sm-4 control-label" style="text-align: left;"> Perangkat Daerah </label>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                          <select id="uptd" name="uptd" class="form-control" placeholder="Lokasi" required="required">
                            <option value="">-- Lokasi --</option>
                            <?php  for ($i=1; $i < 11 ; $i++) { ?>
                              <option value="<?php echo $i; ?>"><?php echo "Perangkat ".$i; ?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12 form-group"> <!-- Date input -->
                        <label for="tiga" class="col-sm-4 control-label" style="text-align: left;"> Nama Perizinan/Non Perizinan </label>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                          <select id="uptd" name="uptd" class="form-control" placeholder="Lokasi" required="required">
                            <option value="">-- Lokasi --</option>
                            <?php  for ($i=1; $i < 11 ; $i++) { ?>
                              <option value="<?php echo $i; ?>"><?php echo $i." Hari kerja"; ?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12 form-group"> <!-- Date input -->
                        <label for="tiga" class="col-sm-4 control-label" style="text-align: left;"> Jenis Izin </label>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                          <select id="uptd" name="uptd" class="form-control" placeholder="Lokasi" required="required">
                            <option value="">-- Lokasi --</option>
                            <?php  for ($i=1; $i < 11 ; $i++) { ?>
                              <option value="<?php echo $i; ?>"><?php echo "Berkas selesai (SK Terbit) ".$i; ?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>
                    </form>
                    <br />
                    <div class="col-md-3 col-sm-0 col-xs-0"></div>
                    <div class="col-md-6 col-sm-12 col-xs-12 form-group"> <!-- Date input -->
                      <canvas id="graph1" height="200px;"></canvas>
                      <!-- <button id="save-btn">Save Chart Image</button> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <script src="<?php echo base_url();?>assets/dash/vendors/Chart.js/dist/Chart.min.js"></script>
        <script type="text/javascript">
          $("#save-btn").click(function() {
            $("#graph1").get(0).toBlob(function(blob) {
            saveAs(blob, "chart_1.png");
            });
          });
          var ctx = document.getElementById("graph1");
          var config = {
            type: 'bar',
            data: {
              labels: ["January", "February", "March", "April", "May", "June", "July"],
              datasets: [{
                label: 'Baru',
                backgroundColor: "#0066ff",
                data: [20, 30, 1, 2, 20, 0, 1]
                },
                {
                label: 'Perpanjangan',
                backgroundColor: "#0066ff",
                data: [1, 2, 1, 2, 10, 0, 0]
                },
                {
                label: 'Perubahan',
                backgroundColor: "#0066ff",
                data: [1, 2, 0, 2, 5, 0, 0]
                },
                {
                label: 'Penutupan',
                backgroundColor: "#0066ff",
                data: [1, 1, 0, 2, 15, 0, 1]
                },
                {
                label: 'Mutasi',
                backgroundColor: "#0066ff",
                data: [2, 1, 0, 1, 15, 0, 0]
                }
              ]
            },
            options: {
              title: {
                display: true,
                fontSize: 14,
                text:'Berkas Masuk Surat Izin Usaha Perdagangan 2018'
              },
              tooltips: {
                mode: 'label'
              },
              responsive: true,
              scales: {
                xAxes: [{
                  stacked: true,
                }],
                yAxes: [{
                  stacked: true
                }]
              },
              legend: {
                display: false
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