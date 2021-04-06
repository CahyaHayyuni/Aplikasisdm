<div class="panel panel-default">
    <div class="panel-heading">
        Tambah Data
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">

                <form method="POST">
                    <div class="form-group">
                        <label>Nip</label>
                        <input class="form-control" name="nip" />

                    </div>

                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" name="nama" />

                    </div>

                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input class="form-control" name="tmpt_lahir" />

                    </div>

                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input class="form-control" type="date" name="tgl_lahir" />

                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label><br />
                        <label class="checkbox-inline">
                            <input type="checkbox" value="l" name="jk" /> Laki-laki
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" value="p" name="jk" /> Perempuan
                        </label>

                    </div>

                    <div class="form-group">
                        <label>Divisi</label>
                        <select class="form-control" name="divisi">
                            <option value="it">Informasi Teknologi</option>
<<<<<<< HEAD
                            <option value="tnk">Teknik</option>
                            <option value="kom">Komersial</option>
                            <option value="keu">Keuangan</option>
                            <option value="qrm">Menegement Resiko & Mutu</option>
                            <option value="tpkb">TPKB</option>
                            <option value="trs">Trisakti</option>
                            <option value="hsse">HSSE</option>
                            <option value="umum">SDM & Umum</option>
=======
                            <option value="t">Teknik</option>
>>>>>>> d3a2c8e0f65e209d3470badef6da8e488261d7f3
                            ?>
                        </select>
                    </div>

                    <input type="submit" name="simpan" value="simpan" class="btn btn-primary">
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
//echo $nip . $nama . $tmpt_lahir . $tgl_lahir . $jk . $divisi . $simpan;

if ($simpan) {
    //echo $simpan;
    $sql = $koneksi->query("insert into tb_anggota (nip, nama, tempat_lahir, tgl_lahir, jk, divisi)value('$nip', '$nama', '$tmpt_lahir', '$tgl_lahir', '$jk', '$divisi')");
    //echo $sql;
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