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
                      <div class="col-md-12 col-sm-12 col-xs-12 form-group"> <!-- Date input -->
                        <label for="tiga" class="col-sm-2 control-label" style="text-align: left;"> Status Berkas </label>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                          <select id="uptd" name="uptd" class="form-control" placeholder="Lokasi" required="required">
                            <option value="">-- Lokasi --</option>
                            <?php  for ($i=1; $i < 11 ; $i++) { ?>
                              <option value="<?php echo $i; ?>"><?php echo "Berkas selesai (SK Terbit) ".$i; ?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12 form-group"> <!-- Date input -->
                        <label for="tiga" class="col-sm-2 control-label" style="text-align: left;"> Waktu Proses </label>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                          <select id="uptd" name="uptd" class="form-control" placeholder="Lokasi" required="required">
                            <option value="">-- Lokasi --</option>
                            <?php  for ($i=1; $i < 11 ; $i++) { ?>
                              <option value="<?php echo $i; ?>"><?php echo $i." Hari kerja"; ?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>
                    </form>
                    <br />
                    <div class="table-responsive">
                          <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th style="text-align: center;">NO PENDAFTARAN</th>
                                <th style="text-align: center;">TANGGAL PENDAFTARAN</th>
                                <th style="text-align: center;">NAMA PEMOHON</th>
                                <th style="text-align: center;">STATUS BERKAS</th>
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
