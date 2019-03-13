<?php  $this->load->model('mlaporan'); $tanggal = date('Y-m-d', strtotime($tgl_mulai)); $tanggal1 = date('Y-m-d', strtotime($tgl_akhir));?>
      <div class="right_col" role="main" id="view">
        <div class="">
          <div class="row">
            <div class="clearfix"></div> 
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h1><?php echo $judulnya; ?> (PENDING)</h1>
                    <h4><?php echo "Periode Berkas Masuk ".$this->mlaporan->tanggal_indo($tanggal)." Sampai ".$this->mlaporan->tanggal_indo($tanggal1);?></h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <div class="table-responsive">
                      <div style="color: grey;"><?php echo "About ".$jumlah_total." Result";?></div>
                          <table id="coba-table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th style="max-width: 10%;">NO</th>
                                <th style="text-align: center; max-width: 25%;" data-priority "1">NO PENDAFTARAN</th>
                                <th style="text-align: center; max-width: 25%;">TANGGAL PENDAFTARAN</th>
                                <th style="text-align: center; max-width: 25%;">NAMA PEMOHON</th>
                                <th style="text-align: center; max-width: 25%;">STATUS BERKAS</th>
                                <th>ALAMAT PEMOHON</th>
                                <th>NAMA PERUSAHAAN</th>
                                <th>ALAMAT PERUSAHAAN</th>
                                <th style="max-width: 25%;" data-priority "2"></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $a=1; foreach ($hasilnya as $row): ?>
                              <tr>
                                <td><?php echo $a; ?></td>
                                <td><?php echo $row->NO_OL;?></td>
                                <td><?php
                                  $tanggalnya = date('Y-m-d', strtotime($row->TGL_OL));
                                  echo $this->mlaporan->tanggal_indo($tanggalnya);?>
                                </td>
                                <td><?php echo $row->NAMAPEMOHON;?></td>
                                <td><?php echo substr($row->NAMA_ALUR_PROSES,0,21);?></td>
                                <td><?php echo $row->ALAMATPEMOHON;?></td>
                                <td><?php echo $row->NAMA_PT;?></td>
                                <td><?php echo $row->ALAMAT_PT; $a++;?></td>
                                <td>
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
              ],
              responsive: true
            });
            $('#table-filter').on('change', function(){
              table.search(this.value).draw();   
            });
          });
        </script>