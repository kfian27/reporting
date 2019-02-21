  <!-- <?php  $this->load->model('mlaporan_paket'); ?> -->
      <div class="right_col" role="main" id="view">
        <div class="">
          <div class="row">
            <div class="clearfix"></div> 
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h3>Historikal NO Registrasi : <?php echo $nomer_ol;?> Tanggal Registrasi : <?php echo $this->mlaporan_paket->tanggal_indo($tanggalannya);?></h3>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <div class="table-responsive">
                          <table id="coba-table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <!-- <th style="max-width: 10%;">No</th> -->
                                <!-- <th style="text-align: center; max-width: 25%;">NO PENDAFTARAN</th> -->
                                <!-- <th style="text-align: center; max-width: 25%;">TANGGAL PENDAFTARAN</th> -->
                                <th style="text-align: center; max-width: 10%;">NAMA PETUGAS</th>
                                <th style="text-align: center; max-width: 20%;">TANGGAL PROSES</th>
                                <th style="text-align: center; max-width: 10%;">STATUS BERKAS</th>
                                <th style="text-align: center; max-width: 10%;">KETERANGAN</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $a=1; foreach ($hasilnya as $row): ?>
                              <tr>
                                <!-- <td></td> -->
                                <!-- <td><?php echo $a;?></td> -->
                                <td><?php echo $row->NAMA_PETUGAS;?></td>
                                <td><?php
                                // echo $row->TGL_PROSES;
                                  $tanggal = date('Y-m-d', strtotime($row->TGL_PROSES));
                                  echo $this->mlaporan_paket->tanggal_indo($tanggal);
                                  ?>
                                </td>
                                <td><?php echo $row->NAMA_ALUR_PROSES;?></td>
                                <td><?php echo $row->KETERANGAN; $a++;?></td>
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
            $("#coba-table").DataTable({
              order : [[ 1, "desc" ]],
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
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          });
        </script>