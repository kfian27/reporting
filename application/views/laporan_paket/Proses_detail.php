<?php  $this->load->model('mlaporan_paket'); $tanggal = date('Y-m-d', strtotime($tgl_mulai)); $tanggal1 = date('Y-m-d', strtotime($tgl_akhir));?>
      <div class="right_col" role="main" id="view">
        <div class="">
          <div class="row">
            <div class="clearfix"></div> 
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h1><?php echo $judulnya; ?> (PROSES)</h1>
                    <h4><?php echo "Periode Berkas Masuk ".$this->mlaporan_paket->tanggal_indo($tanggal)." Sampai ".$this->mlaporan_paket->tanggal_indo($tanggal1);?></h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <div class="table-responsive">
                      <div style="color: grey;"><?php echo "About ".$jumlah_total." Result";?></div>
                          <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th style="max-width: 10%;">NO</th>
                                <th style="text-align: center; max-width: 25%;">NO PENDAFTARAN</th>
                                <th style="text-align: center; max-width: 25%;">TANGGAL PENDAFTARAN</th>
                                <th style="text-align: center; max-width: 25%;">NAMA PEMOHON</th>
                                <th style="text-align: center; max-width: 25%;"></th>
                                <th>ALAMAT PEMOHON</th>
                                <th>NAMA PERUSAHAAN</th>
                                <th>ALAMAT PERUSAHAAN</th>
                                <th>WAKTU PROSES</th>
                                <th>NOMOR SK</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $a=1; foreach ($hasilnya as $row): ?>
                              <tr>
                                <td><?php echo $a; ?></td>
                                <td><?php echo $row->NO_REGISTRASI;?></td>
                                <td><?php
                                  $tanggalnya = date('Y-m-d', strtotime($row->TGL_REGISTRASI));
                                  echo $this->mlaporan_paket->tanggal_indo($tanggalnya);?>
                                </td>
                                <td><?php echo $row->NAMA;?></td>
                                <td>
                                  <a type="button" style="font-size: 20px" href="#"><i class="fa fa-search-plus"></i></a>
                                </td>
                                <td><?php echo $row->ALAMAT;?></td>
                                <td><?php echo $row->NAMA_PERUSAHAAN;?></td>
                                 <td><?php echo $row->ALAMAT_PT;?></td>
                                <td> Hari kerja
                                </td>
                                <td><?php echo "TIDAK ADA"; $a++;?></td>
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