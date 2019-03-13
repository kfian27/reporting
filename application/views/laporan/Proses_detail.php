<?php  $this->load->model('mlaporan'); $tanggal = date('Y-m-d', strtotime($tgl_mulai)); $tanggal1 = date('Y-m-d', strtotime($tgl_akhir));?>
      <div class="right_col" role="main" id="view">
        <div class="">
          <div class="row">
            <div class="clearfix"></div> 
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h1><?php echo $judulnya; ?> (PROSES)</h1>
                    <h4><?php echo "Periode Berkas Masuk ".$this->mlaporan->tanggal_indo($tanggal)." Sampai ".$this->mlaporan->tanggal_indo($tanggal1);?></h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <form class="form-horizontal">
                      <div class="col-md-12 col-sm-12 col-xs-12 form-group"> <!-- Date input -->
                         <label for="tiga" class="col-sm-2 control-label"> Status Berkas </label>
                         <div class="col-md-4 col-sm-10 col-xs-10">
                          <select id="table-filter" name="table-filter" class="form-control" placeholder="Lokasi" required="required">
                            <option value=" ">Semua</option>
                            <?php  foreach ($nama_proses as $row): ?>
                              <option><?php echo $row->NAMA_ALUR_PROSES; ?></option>
                            <?php endforeach; ?>   
                        </select>
                        </div>
                      </div>
                    </form>
                    <div class="table-responsive">
                      <div style="color: grey;"><?php echo "About ".$jumlah_total." Result";?></div>
                          <table id="coba-table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th width="10%">NO</th>
                                <th style="text-align: center;" width="20%" data-priority "1">NO PENDAFTARAN</th>
                                <th style="text-align: center;" width="20%">TANGGAL PENDAFTARAN</th>
                                <th style="text-align: center;" width="20%">NAMA PEMOHON</th>
                                <th style="text-align: center;" width="20%">STATUS BERKAS</th>
                                <th>ALAMAT PEMOHON</th>
                                <th>NAMA PERUSAHAAN</th>
                                <th>ALAMAT PERUSAHAAN</th>
                                <th>WAKTU PROSES</th>
                                <th>NOMOR SK</th>
                                <th style="text-align: center;" width="10%" data-priority "2"></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $a=1; foreach ($hasilnya as $row): ?>
                              <tr>
                                <td width="10%"><?php echo $a; ?></td>
                                <td width="20%"><?php echo $row->NO_OL;?></td>
                                <td width="20%"><?php
                                  $tanggalnya = date('Y-m-d', strtotime($row->TGL_OL));
                                  echo $this->mlaporan->tanggal_indo($tanggalnya);?>
                                </td>
                                <td width="20%"><?php echo $row->NAMAPEMOHON;?></td>
                                <td width="20%"><?php echo $row->NAMA_ALUR_PROSES;?></td>
                                <td><?php 
                                  if ($row->ALAMATPEMOHON == NULL || $row->ALAMATPEMOHON == 'JL' ) {
                                    echo "tidak ada alamat pemohon";
                                  }
                                  else{
                                    echo $row->ALAMATPEMOHON;
                                  }
                                  ?>
                                  </td>
                                <td><?php 
                                  if ($row->NAMA_PT == NULL) {
                                    echo "tidak ada nama perusahaan";
                                  }
                                  else{
                                    echo $row->NAMA_PT;
                                  };?></td>
                                <td><?php 
                                  if ($row->ALAMAT_PT == NULL) {
                                    echo "tidak ada alamat perusahaan";
                                  }
                                  else{
                                    echo $row->ALAMAT_PT;
                                  }
                                  ?></td>
                                <td>
                                  <?php $prosesnya = $this->mlaporan->get_waktu_proses($tgl_mulai,$tgl_akhir,$row->NO_OL);
                                  foreach ($prosesnya as $key) {
                                    echo $key->TOTAL;}
                                  ?> Hari kerja
                                </td>
                                <td><?php echo $row->NO_SK; $a++;?></td>
                                <td width="10%">
                                  <a type="button" style="font-size: 20px" href="<?php echo base_url();?>laporan_mandiri/histori_detail/<?php echo $tanggalnya;?>/<?php echo $row->NO_OL;?>"><i class="fa fa-search-plus"></i></a>
                                </td>
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
            var table = $("#coba-table").DataTable({
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
                  className: "btn-sm",
                  orientation: 'landscape',
                  pageSize: 'A4'
                },
                {
                  extend: "print",
                  title: '-<?php echo $judulnya; ?>-',
                  className: "btn-sm"
                },
              ]
            });
            $('#table-filter').on('change', function(){
              table.search(this.value).draw();   
            });
          });
        </script>