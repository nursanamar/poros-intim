<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>laporan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    
</head>
<body onload="window.print()">
    <div class="header">
        <h1 style="text-align: center">Laporan Peserta</h1>
    </div>
    <div class="row">
        <div class="container">
            <h2></h2>
            <table style="text-align: center" class="table table-bordered">
                <thead>
                   <tr>
                       <td rowspan="2">
                          Cabang
                       </td>
                       <td  colspan="12">
                           Peserta
                       </td>
                        <td rowspan="2">
                            Total
                        </td>
                   </tr>
                   <tr>
                       <?php foreach ($listPtkin as $value): ?>
                           <td>
                               <?= $value['nama_ptkin'] ?>
                           </td>
                        <?php endforeach; ?>
                        
                   </tr>
                </thead>
                <tbody>
                    <?php foreach ($listCabang as $cabang): ?>
                    <tr>
                        <td>
                            <?= $cabang['nama_cabang'] ?>
                        </td>
                        <?php $total = 0; ?>
                            <?php foreach ($listPtkin as $ptkin): ?>
                            <?php 
                                $jumlah = $this->d->jumlahPeserta($cabang['id_cabang'],$ptkin['id_ptkin']);
                                $total += $jumlah;
                            ?>
                                <td>
                                    <?= $jumlah ?>
                                </td>
                            <?php endforeach; ?>
                        <td>
                            <?= $total ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td>
                            Total
                        </td>
                        <?php
                            $total = 0; 
                         ?>
                        <?php foreach ($listPtkin as $value): ?>
                        <?php 
                            $jumlah = $this->d->jumlahPesertaPtkin($value['id_ptkin']);
                            $total += $jumlah;
                        ?>
                            <td>
                                <?= $jumlah ?>
                            </td>
                        <?php endforeach; ?>
                        <td>
                            <?= $total ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>