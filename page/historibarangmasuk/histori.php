<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Histori Barang & Surat
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP Penerima/Pegawai</th>
                                <th>Nama Penerima/Pegawai</th>
                                <th>Barang</th>
                                <th>Pengirim/Ekspedisi</th>
                                <th>Penerima Fisik</th>
                                <th>Tanggal Terima</th>
                                <th>Tanggal Serah</th>
                                <th>Divisi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            $no = 1;

                            $sql = $koneksi->query("select * from tb_histori_barang_masuk");

                            while ($data = $sql->fetch_assoc()) {

                                $divisi = convert_divisi($data['divisi']);
                            ?>

                                </tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data['nip']; ?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td><?php echo $data['barang']; ?></td>
                                <td><?php echo $data['pengirim']; ?></td>
                                <td><?php echo $data['penerima']; ?></td>
                                <td><?php echo $data['tgl_terima']; ?></td>
                                <td><?php echo $data['tgl_serah']; ?></td>
                                <td><?php echo $divisi; ?></td>
                                <td><a href="?page=historibarangmasuk&aksi=view&id=<?php echo $data['id']; ?>" class="btn btn-info">View</a></td>
                                </tr>


                            <?php } ?>
                        </tbody>


                </div>
            </div>
        </div>
    </div>
</div>