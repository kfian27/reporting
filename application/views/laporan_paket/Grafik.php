      <?php $this->load->model('mlaporan_paket');
        $judulnya= '';
        foreach ($judul as $key) {
          $judulnya = $key->KETERANGAN;
        }
      ?>
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
                    <form class="form-horizontal" method="POST">
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
                          <a class="btn btn-default col-md-12 col-sm-12 col-xs-12" onclick="coba_alert()" id="pdfhr"><i class="fa fa-search"></i> Search</a>
                        </div>
                    </form>
                  </div>
                  <div class="col-md-1 col-sm-12 col-xs-12"></div>
                  <div class="col-md-9 col-sm-12 col-xs-12 form-group">
                    <canvas id="graph1" height="200px;"></canvas>
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
              $dash_selesai = $this->mlaporan_paket->get_dasboard_selesai($tahunnya,$judul_grafik,$b);
              $dash_proses = $this->mlaporan_paket->get_dasboard_proses($tahunnya,$judul_grafik,$b);
              $dash_pending = $this->mlaporan_paket->get_dasboard_pending($tahunnya,$judul_grafik,$b);
              $dash_tolak = $this->mlaporan_paket->get_dasboard_tolak($tahunnya,$judul_grafik,$b);
              if (!$dash_selesai) {
                $datanya[] = 0;
              }
              else{
                foreach ($dash_selesai as $row) {
                  $datanya[] = (float) $row->JUMLAHNYA;
                }
              }
              if (!$dash_proses) {
                $datanya1[] = 0;
              }
              else{
                foreach ($dash_proses as $row) {
                  $datanya1[] = (float) $row->JUMLAHNYA;
                }
              }
              if (!$dash_pending) {
                $datanya2[] = 0;
              }
              else{
                foreach ($dash_pending as $row) {
                  $datanya2[] = (float) $row->JUMLAHNYA;
                }
              }
              if (!$dash_tolak) {
                $datanya3[] = 0;
              }
              else{
                foreach ($dash_tolak as $row) {
                  $datanya3[] = (float) $row->JUMLAHNYA;
                }
              }
            }
        ?>
        <script src="<?php echo base_url();?>assets/dash/vendors/Chart.js/dist/Chart.min.js"></script>
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
          var ctx = document.getElementById("graph1");
          var config = {
            type: 'bar',
            data: {
              labels: <?php echo json_encode($labelnya);?>,
              datasets: [{label: 'Selesai',
                backgroundColor: "#00e600",
                data: <?php echo json_encode($datanya);?>
                },
                {
                label: 'Proses',
                backgroundColor: "#0066ff",
                data: <?php echo json_encode($datanya1);?>
                },
                {
                label: 'Pending',
                backgroundColor: "#ff9933",
                data: <?php echo json_encode($datanya2);?>
                },
                {
                label: 'Ditolak',
                backgroundColor: "#ff1a1a",
                data: <?php echo json_encode($datanya3);?>
                }
              ]
            },
            options: {
              title: {
                display: true,
                fontSize: 14,
                text:'Berkas Masuk <?php echo $judulnya." ".$tahunnya;?>'
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
            }
          };
          var newChart = new Chart(ctx, config);
        </script>