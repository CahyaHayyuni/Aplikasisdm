<?php


$nip = $_GET['id'];

$sql = $koneksi->query("select * from tb_anggota where nip = '$nip'");

$tampil = $sql->fetch_assoc();

$jkl = $tampil['jk'];
$divisi = $tampil['divisi'];


?>

<div class="panel panel-default">
    <div class="panel-heading">
        Ubah Data
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">

                <form method="POST">
                    <div class="form-group">
                        <label>Nip</label>
                        <input class="form-control" name="nip" value="<?php echo $tampil['nip'] ?>" readonly />

                    </div>

                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" name="nama" value="<?php echo $tampil['nama'] ?>" />

                    </div>

                    <div class=" form-group">
                        <label>Tempat Lahir</label>
                        <input class="form-control" name="tmpt_lahir" value="<?php echo $tampil['tempat_lahir'] ?>" />

                    </div>

                    <div class=" form-group">
                        <label>Tanggal Lahir</label>
                        <input class="form-control" type="date" name="tgl_lahir" value="<?php echo $tampil['tgl_lahir'] ?>" />

                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label><br />
                        <label class="checkbox-inline">
                            <input type="checkbox" value="l" name="jk" <?php echo ($jkl == 'l') ? "checked" : ""; ?>> Laki-laki </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" value="p" name="jk" <?php echo ($jkl == 'p') ? "checked" : ""; ?>> Perempuan </label>

                    </div>

                    <div class="form-group">
                        <label>Divisi</label>
                        <select class="form-control" name="divisi">
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
                            ?>
                        </select>
                    </div>

                    <input type="submit" name="simpan" value="Ubah" class="btn btn-primary">
            </div>
        </div>

        </form>
    </div>
</div>
</div>
</div>

<?php

$nip = isset($_POST['nip']) ? $_POST['nip'] : '';
$nama = isset($_POST['nama']) ? $_POST['nama'] : '';
$tmpt_lahir = isset($_POST['tmpt_lahir']) ? $_POST['tmpt_lahir'] : '';
$tgl_lahir = isset($_POST['tgl_lahir']) ? $_POST['tgl_lahir'] : '';
$jk = isset($_POST['jk']) ? $_POST['jk'] : '';
$divisi = isset($_POST['divisi']) ? $_POST['divisi'] : '';

$simpan = isset($_POST['simpan']) ? $_POST['simpan'] : '';

//echo $simpan;
if ($simpan) {

    $sql = $koneksi->query("update tb_anggota set nama='$nama', tempat_lahir='$tmpt_lahir', tgl_lahir='$tgl_lahir',
    jk='$jk', divisi='$divisi' where nip='$nip'");

    if ($sql) {
?>
        <script type="text/javascript">
            alert("Data Berhasil Disimpan");
            window.location.href = "?page=anggota";
        </script>
<?php
    }
}

?>