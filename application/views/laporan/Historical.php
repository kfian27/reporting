  <?php  $this->load->model('mlaporan'); ?>
      <div class="right_col" role="main" id="view">
        <div class="">
          <div class="row">
            <div class="clearfix"></div> 
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h1>Historikal No OL : <?php echo $nomer_ol;?></h1>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <div class="table-responsive">
                          <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th style="max-width: 10%;">No</th>
                                <!-- <th style="text-align: center; max-width: 25%;">NO PENDAFTARAN</th> -->
                                <!-- <th style="text-align: center; max-width: 25%;">TANGGAL PENDAFTARAN</th> -->
                                <th style="text-align: center; max-width: 10%;">NAMA PETUGAS</th>
                                <th style="text-align: center; max-width: 10%;">TANGGAL PROSES</th>
                                <th style="text-align: center; max-width: 10%;">STATUS BERKAS</th>
                                <th style="text-align: center; max-width: 10%;">KETERANGAN</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $a=1; foreach ($hasilnya as $row): ?>
                              <tr>
                                <!-- <td></td> -->
                                <td><?php echo $a;?></td>
                                <td><?php echo $row->NAMA;?></td>
                                <td><?php
                                  $tanggal = date('Y-m-d', strtotime($row->TGL_PROSES));
                                  echo $this->mlaporan->tanggal_indo($tanggal);?>
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