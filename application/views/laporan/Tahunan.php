      <div class="right_col" role="main" id="view">
        <div class="">
          <div class="row">
            <div class="clearfix"></div> 
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Laporan Penjualan</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="<?php echo base_url(); ?>laporan/pdf_tahun" method="POST" target="_blank">
                      <div class="form-group col-md-3 col-sm-3 col-xs-12"> <!-- Date input -->
                        <select id="tahun" name="tahun" class="form-control" placeholder="Tahun" required="required">
                          <option value="">-- Tahun --</option>
                          <?php $tahun = 2018; for ($i=0; $i < 50; $i++) { ?>
                            <option value="<?php echo $tahun; ?>"><?php echo $tahun; ?></option>
                          <?php $tahun++; } ?>
                        </select>
                      </div>
                      <div class="form-group"> <!-- Submit button -->
                        <button class="btn btn-default" id="pdfhr" type="submit"><i class="fa fa-file-pdf-o"></i> PDF</button>
                      </div>
                    </form>
                    <br />
                    <div class="table-responsive">
                    <table id="table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Tanggal</th>
                          <th>Tanggal Bayar</th>
                          <th>Kain</th>
                          <th>QTY</th>
                          <th>Harga</th>
                          <th>Karyawan</th>
                          <th>Pelanggan</th>
                          <th>Ekspedisi</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 0; foreach ($harian as $row): ?>
                        <tr>
                          <td><?php echo $row->TR_TGL; ?></td>
                          <td><?php echo $row->TR_TGLBYR; ?></td>
                          <td><?php echo $row->KN_NAMA; ?></td>
                          <td><?php echo $row->DT_QTY; ?></td>
                          <td><?php echo $row->DT_HARGA; ?></td>
                          <td><?php echo $row->KRY_NAMA; ?></td>
                          <td><?php echo $row->PLG_NAMA; ?></td>
                          <td><?php echo $row->ESK_NAMA; ?></td>
                          <td>
                            <?php if ($row->TR_STATUS == 1) { ?>
                              Menunggu Pembayaran
                            <?php } elseif ($row->TR_STATUS == 2) { ?>
                              Terbayar
                            <?php } elseif ($row->TR_STATUS == 3) { ?>
                              Proses Pengiriman
                            <?php } elseif ($row->TR_STATUS == 4) { ?>
                              Terkirim
                            <?php } elseif ($row->TR_STATUS == 5) { ?>
                              Dibatalkan
                            <?php } ?>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Tanggal</th>
                          <th>Tanggal Bayar</th>
                          <th>Kain</th>
                          <th>QTY</th>
                          <th>Harga</th>
                          <th>Karyawan</th>
                          <th>Pelanggan</th>
                          <th>Ekspedisi</th>
                          <th>Status</th>
                        </tr>
                      </tfoot>
                    </table>
                    </div>
          
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
