<?php

$id = $_GET['id'];

$sql = $koneksi->query("select * from tb_barang_keluar where id='$id'");

$tampil = $sql->fetch_assoc();

$divisi = $tampil['divisi'];
?>

<div class="panel panel-default">
    <div class="panel-heading">
        Serah Terima Barang Keluar
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="container form-group" id="Cam"><b>Camera Preview...</b>
                    <div id="my_camera"></div>
                    <form>
                        <input type="button" value="Ambil Foto" class="btn btn-warning" onClick="take_snapshot()">
                    </form>
                </div>
                <div class="container form-group" id="Prev">
                    <b>Hasil Foto Preview...</b>
                    <div id="results"></div>
                </div>
                <div class="container form-group" id="Saved">
                    <img id="uploaded" src="" />
                    <br>
                    <span id="loading"></span>
                    <strong><span id="saved_text"></span></strong>
                </div>

                <form method="POST">
                    <div class="form-group">
                        <label>Nip Pengirim/Pegawai</label>
                        <input class="form-control" name="nip" value="<?php echo $tampil['nip'] ?>" readonly />
                    </div>

                    <div class="form-group">
                        <label>Nama Pengirim/Pegawai</label>
                        <input class="form-control" name="nama" value="<?php echo $tampil['nama'] ?>" readonly />
                    </div>

                    <div class="form-group">
                        <label>Barang</label>
                        <input class="form-control" name="barang" value="<?php echo $tampil['barang'] ?>" readonly />
                    </div>

                    <div class="form-group">
                        <label>Penerima/Ekspedisi</label>
                        <input class="form-control" name="penerima" />
                    </div>

                    <div class="form-group">
                        <label>Tanggal Terima</label>
                        <input class="form-control" name="tgl_terima" type="date" value="<?php echo $tampil['tgl_terima'] ?>" readonly />
                    </div>

                    <div class="form-group">
                        <label>Tanggal Serah</label>
                        <input class="form-control" name="tgl_serah" type="date" />
                    </div>

                    <div class="form-group">
                        <label>Divisi</label>
                        <select class="form-control" name="divisi" readonly>
                            <option value="it" <?php if ($divisi == 'it') {
                                                    echo "selected";
                                                } ?>>Informasi Teknologi</option>
                            <option value="tnk" <?php if ($divisi == 'tnk') {
                                                    echo "selected";
                                                } ?>>Teknik</option>
                            <option value="kom" <?php if ($divisi == 'kom') {
                                                    echo "selected";
                                                } ?>>Komersial</option>
                            <option value="keu" <?php if ($divisi == 'keu') {
                                                    echo "selected";
                                                } ?>>Keuangan</option>
                            <option value="qrm" <?php if ($divisi == 'qrm') {
                                                    echo "selected";
                                                } ?>>Menegement Resiko & Mutu</option>
                            <option value="tpkb" <?php if ($divisi == 'tpkb') {
                                                        echo "selected";
                                                    } ?>>TPKB</option>
                            <option value="trs" <?php if ($divisi == 'trs') {
                                                    echo "selected";
                                                } ?>>Trisakti</option>
                            <option value="hsse" <?php if ($divisi == 'hsse') {
                                                        echo "selected";
                                                    } ?>>HSSE</option>
                            <option value="umum" <?php if ($divisi == 'umum') {
                                                        echo "selected";
                                                    } ?>>SDM & Umum</option>
                        </select>
                    </div>

                    <div>
                        <input type="hidden" name="id" value=<?= $id ?>>
                        <input type="submit" name="simpan" value="simpan" class="btn btn-primary">

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?php

$id = isset($_POST['id']) ? $_POST['id'] : '';
$nip = isset($_POST['nip']) ? $_POST['nip'] : '';
$nama = isset($_POST['nama']) ? $_POST['nama'] : '';
$barang = isset($_POST['barang']) ? $_POST['barang'] : '';
$penerima = isset($_POST['penerima']) ? $_POST['penerima'] : '';
$tgl_terima = isset($_POST['tgl_terima']) ? $_POST['tgl_terima'] : '';
$tgl_serah = isset($_POST['tgl_serah']) ? $_POST['tgl_serah'] : '';
$simpan = isset($_POST['simpan']) ? $_POST['simpan'] : '';

echo $file_foto;

if ($simpan) {
    $sql = $koneksi->query("insert into tb_histori_barang_keluar (id, nip, nama, barang, penerima, tgl_terima, tgl_serah, divisi) values ('$id', '$nip', '$nama', '$barang', '$penerima', '$tgl_terima', '$tgl_serah', '$divisi')");
    $koneksi->query("delete from tb_barang_keluar where id ='$id'");

    if ($sql) {
?>
        <script type="text/javascript">
            alert("Ubah Berhasil Disimpan");
            window.location.href = "?page=barangkeluar";
        </script>
<?php
    }
}

?>