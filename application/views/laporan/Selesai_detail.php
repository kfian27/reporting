<?php  $this->load->model('mlaporan'); $tanggal = date('Y-m-d', strtotime($tgl_mulai)); $tanggal1 = date('Y-m-d', strtotime($tgl_akhir));?>
      <div class="right_col" role="main" id="view">
        <div class="">
          <div class="row">
            <div class="clearfix"></div> 
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h1><?php echo $judulnya; ?> (SELESAI)</h1>
                    <h4><?php echo "Periode Berkas Masuk ".$this->mlaporan->tanggal_indo($tanggal)." Sampai ".$this->mlaporan->tanggal_indo($tanggal1);?></h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <div class="table-responsive">
                          <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th style="max-width: 10%;">No</th>
                                <th style="text-align: center; max-width: 25%;">NO PENDAFTARAN</th>
                                <th style="text-align: center; max-width: 25%;">TANGGAL PENDAFTARAN</th>
                                <th style="text-align: center; max-width: 25%;">NAMA PEMOHON</th>
                                <th style="text-align: center; max-width: 25%;">STATUS BERKAS</th>
                                <th>Alamat Pemohon</th>
                                <th>Nama Perusahaan</th>
                                <th>Alamat Perusahaan</th>
                                <th>Waktu Proses</th>
                                <th>Nomor SK</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $a=1; foreach ($hasilnya as $row): ?>
                              <tr>
                                <td><?php echo $a; ?></td>
                                <td>
                                  <a type="button" data-title='button' class="btn btn-primary pull-right" href="<?php echo base_url();?>admin/histori_detail/<?php echo $row->NO_OL;?>" target="_blank"> <?php echo $row->NO_OL;?> </a>
                                </td>
                                <td><?php
                                  $tanggal = date('Y-m-d', strtotime($row->TGL_OL));
                                  echo $this->mlaporan->tanggal_indo($tanggal);?>
                                </td>
                                <td><?php echo $row->NAMAPEMOHON;?></td>
                                <td><?php echo $row->NAMA_ALUR_PROSES;?></td>
                                <td><?php echo $row->ALAMATPEMOHON;?></td>
                                <td><?php echo $row->NAMA_PT;?></td>
                                <td><?php echo $row->ALAMAT_PT;?></td>
                                <td><?php echo $row->WAKTU;?></td>
                                <td><?php echo $row->NO_SK; $a++;?></td>
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