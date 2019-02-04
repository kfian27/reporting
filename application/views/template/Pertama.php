      <div class="right_col" role="main" id="view">
        <div class="">
          <div class="row">
            <div class="clearfix"></div> 
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h1>Report Perizinan/Non-Perizinan SSW</h1>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>admin/hasil1">
                      <div class="col-md-12 col-sm-12 col-xs-12 form-group"> <!-- Date input -->
                        <label for="tiga" class="col-sm-2 control-label"> Periode Berkas Masuk </label>
                        <div class="col-md-3 col-sm-10 col-xs-10">
                          <input type="Date" name="tgl_mulai" id="tgl_mulai" class="form-control" required="required">
                        </div>
                        <div style="float: left; margin-right: 10px; margin-top: 2px; font-size: 20px;">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <label class="col-sm-1 control-label" style="text-align: left;"> Sampai </label>
                        <div class="col-md-3 col-sm-10 col-xs-10">
                          <input type="Date" name="tgl_akhir" id="tgl_akhir" class="form-control" required="required">
                        </div>
                        <div style="float: left; margin-right: 10px; margin-top: 2px; font-size: 20px;">
                          <i class="fa fa-calendar"></i>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12 form-group"> <!-- Date input -->
                        <label for="tiga" class="col-sm-2 control-label"> Perangkat Daerah </label>
                        <div class="col-md-4 col-sm-10 col-xs-10">
                          <select id="uptd" name="uptd" class="form-control" placeholder="Lokasi" required="required">
                            <option value="">--Nama perangkat daerah--</option>
                            <option value="%">Semua</option>
                            <?php  foreach ($nama_skpd as $row): ?>
                              <option value="<?php echo $row->KD_SKPD; ?>"><?php echo $row->NAMA_SKPD; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="col-md-3 col-sm-10 col-xs-10"> <!-- Submit button -->
                          <button class="btn btn-default col-md-5 col-sm-12 col-xs-12" id="cari" type="Submit"><i class="fa fa-search"></i> Search</button>
                        </div>
                      </div>
                    </form>
                    <br />
                    <div class="table-responsive">
                          <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
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
                                <!-- <td>
                                    <button type="button" data-title='Delete' data-toggle='modal' onclick="javascript:hapus('mbox/delete/');" class="btn btn-danger pull-right"> Hapus</button>
                                    <button type="button" data-title='Edit' onclick="javasript:ubah('mbox/get_detail/')" class="btn btn-primary pull-right"> Edit</button>
                                </td> -->
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
        <script type="text/javascript">
          // render date datewise
          function cobaklik(){
            var asu1 = $('#tgl_mulai').val();
            var asu2 = $('#tgl_akhir').val();
            var asu3 = $('#uptd').val();
            alert(asu1+','+asu2+','+asu3);
          }
        </script>