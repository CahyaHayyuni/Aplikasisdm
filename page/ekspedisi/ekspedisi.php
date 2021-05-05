<a href="?page=ekspedisi&aksi=tambah" class="btn btn-primary" style="margin-top: 8px;">Tambah Data</a>
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Data Ekspedisi
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Singkatan</th>
                                <th>Nama Ekspedisi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            $no = 1;

                            $sql = $koneksi->query("select * from tb_ekspedisi");

                            while ($data = $sql->fetch_assoc()) {

                            ?>

                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $data['singkatan']; ?></td>
                                    <td><?php echo $data['nama_ekspedisi']; ?></td>
                                    <td>
                                        <a href="?page=ekspedisi&aksi=ubah&id=<?php echo $data['id']; ?>" class="btn btn-info">Ubah</a>
                                        <a onclick="return confirm('Anda Yakin Menghapus Data Ini?')" href="?page=ekspedisi&aksi=hapus&id=<?php echo $data['id']; ?>" class="btn btn-danger">Hapus</a>

                                    </td>
                                </tr>


                            <?php } ?>
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>