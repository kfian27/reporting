      <div class="right_col" role="main" id="view">
        <div class="">
          <div class="row">
            <div class="clearfix"></div> 
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h1>Surat Ijin Usaha Perdagangan</h1>
                    <h4>Periode Berkas Masuk 1 Januari sampai 31 Desember 2018</h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form class="form-horizontal" action="<?php echo base_url(); ?>laporan/pdf_bulan" method="POST" target="_blank">
                      <div class="col-md-7 col-sm-12 col-xs-12 form-group"> <!-- Date input -->
                        <label for="tiga" class="col-sm-4 control-label" style="text-align: left;"> Jenis Izin </label>
                        <div class="col-md-8 col-sm-12 col-xs-12" style="margin-bottom: 15px;">
                          <select id="uptd" name="uptd" class="form-control" placeholder="Lokasi" required="required">
                            <option value="">-- Lokasi --</option>
                            <?php  for ($i=1; $i < 11 ; $i++) { ?>
                              <option value="<?php echo $i; ?>"><?php echo $i." Baru"; ?></option>
                            <?php }?>
                          </select>
                        </div>
                        <label for="tiga" class="col-sm-4 control-label" style="text-align: left;"> Status Berkas </label>
                        <div class="col-md-8 col-sm-12 col-xs-12" style="margin-bottom: 20px;">
                          <select id="uptd" name="uptd" class="form-control" placeholder="Lokasi" required="required">
                            <option value="">-- Lokasi --</option>
                            <?php  for ($i=1; $i < 11 ; $i++) { ?>
                              <option value="<?php echo $i; ?>"><?php echo "Proses Dinas ".$i; ?></option>
                            <?php }?>
                          </select>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12"> <!-- Submit button -->
                          <div class="col-md-4 col-sm-0 col-xs-0" style="margin-right: 7px;"></div>
                          <button class="btn btn-default col-md-2 col-sm-12 col-xs-12" id="pdfhr" type="submit"><i class="fa fa-search"></i>Search</button>
                        </div>
                      </div>
                      <div class="col-md-5 col-sm-12 col-xs-12 form-group"> <!-- Date input -->
                         <canvas id="pie1" height="150px"></canvas>
                      </div>
                    </form>
                    <br />
                    <div class="table-responsive">
                          <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th style="text-align: center;">NAMA PERIZINAN/NON PERIZINAN</th>
                                <th style="text-align: center;">JUMLAH BERKAS</th>
                                <th style="text-align: center;">ACTION</th>
                              </tr>
                            </thead>
                            <tbody>
                              <!-- <?php $a=1; foreach ($box as $row): ?> -->
                            <tr>
                               <!--  <td><?php echo $a; ?></td>
                                <td><?php echo $row->box_kode; ?></td>
                                <td><?php echo $row->box_detail; ?></td>
                                <td><?php echo $row->box_qty; $a++;?></td> -->
                                <td>
                                    <button type="button" data-title='Delete' data-toggle='modal' onclick="javascript:hapus('mbox/delete/');" class="btn btn-danger pull-right"> Hapus</button>
                                    <button type="button" data-title='Edit' onclick="javasript:ubah('mbox/get_detail/')" class="btn btn-primary pull-right"> Edit</button>
                                </td>
                            </tr>
                              <!-- <?php endforeach; ?> -->
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
          var ctx = document.getElementById("pie1");
          var data = {
          datasets: [{
            data: [12, 17, 69, 2],
            backgroundColor: [
            "#0066ff",
            "#ff9933",
            "#ffcc66",
            "#bfbfbf"
            ],
            label: 'My dataset' // for legend
          }],
          labels: [
            "Cek Berkas Petugas UPTD",
            "Proses Dinas",
            "Berkas Selesai",
            "Penomoran"
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
        </script>
