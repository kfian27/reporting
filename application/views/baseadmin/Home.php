<?php 
  $jumlah_parsial = 0; foreach ($total_parsial as $key) {$jumlah_parsial = $key->JUMLAHNYA;}
  $jumlah_paket = 0; foreach ($total_paket as $key) {$jumlah_paket = $key->JUMLAHNYA;}
?>
<div class="right_col" role="main" id="view">
  <div class="">
    <div class="row">
      <div class="clearfix"></div> 
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_content">
            <div class="x_title">
              <h1>Dashboard Perizinan/Non-Perizinan SSW</h1>
              <div class="clearfix"></div>
           </div>
            <a href="<?php echo base_url(); ?>laporan_mandiri">
              <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="tile-stats" style="background-color: #2d6aa0; border-color: #2d6aa0;">
                  <div class="icon" style="color: #fbfbfb"> <i class="fa fa-file" style="margin-left: 5px;"></i></div>
                  <div class="count" style="color: #fbfbfb"><?php echo $jumlah_parsial;?></div>
                  <h3 style="color: #fbfbfb">Parsial/Mandiri</h3>
                  <p style="color: #fbfbfb">Berkas Masuk Hari Ini</p>
                </div>
              </div>
            </a>
            <a href="<?php echo base_url(); ?>laporan_paket">
              <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="tile-stats" style="background-color: #2d6aa0; border-color: #2d6aa0;">
                  <div class="icon" style="color: #fbfbfb"> <i class="fa fa-file" style="margin-left: 5px;"></i></div>
                  <div class="count" style="color: #fbfbfb"><?php echo $jumlah_paket;?></div>
                  <h3 style="color: #fbfbfb">Paket</h3>
                  <p style="color: #fbfbfb">Berkas Masuk Hari Ini</p>
                </div>
              </div>
            </a>
            <div class="col-md-6 col-sm-12 col-xs-12">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th style="text-align: center;">NAMA PERIZINAN/NON PERIZINAN</th>
                    <th style="text-align: center;">JUMLAH BERKAS</th>
                    <th style="text-align: center;">ACTION</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $a=1; foreach ($detail_parsial as $row): ?>
                  <tr>
                    <td><?php echo $a; ?></td>
                    <td><?php echo $row->NM_HEADER;?></td>
                    <td><?php echo $row->JUMLAHNYA; $a++;?></td>
                    <td>
                      <a href="<?php echo base_url();?>admin/laporan_mandiri_detail/<?php echo date("Y-m-d");?>/<?php echo date("Y-m-d");?>/<?php $string = str_replace(' ', '_', $row->NM_HEADER); echo str_replace('/', '.', $string);?>/<?php echo $row->JUMLAHNYA;?>"><i class="fa fa-search-plus" style="font-size: 15px;"></i> </a>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th style="text-align: center;">NAMA PAKET</th>
                    <th style="text-align: center;">JUMLAH BERKAS</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $a=1; foreach ($detail_paket as $row): ?>
                  <tr>
                    <td><?php echo $a; ?></td>
                    <td><?php echo $row->KETERANGAN;?></td>
                    <td><?php echo $row->JUMLAHNYA; $a++;?></td>
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