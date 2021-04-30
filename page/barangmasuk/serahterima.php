<?php

$id = $_GET['id'];

$sql = $koneksi->query("select * from tb_barang_masuk where id='$id'");

$tampil = $sql->fetch_assoc();

$divisi = $tampil['divisi'];
?>

<div class="panel panel-default">
    <div class="panel-heading">
        Serah Terima Barang Masuk
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

                <form method="POST" id="signatureform">
                    <div class="form-group">
                        <label>Nip Penerima/Pegawai</label>
                        <input class="form-control" name="nip" value="<?php echo $tampil['nip'] ?>" readonly />
                    </div>

                    <div class="form-group">
                        <label>Nama Penerima/Pegawai</label>
                        <input class="form-control" name="nama" value="<?php echo $tampil['nama'] ?>" readonly />
                    </div>

                    <div class="form-group">
                        <label>Barang</label>
                        <input class="form-control" name="barang" value="<?php echo $tampil['barang'] ?>" readonly />
                    </div>

                    <div class="form-group">
                        <label>Ekspedisi</label>
                        <input class="form-control" name="ekspedisi" value="<?php echo $tampil['ekspedisi'] ?>" readonly />
                    </div>

                    <div class="form-group">
                        <label>Penerima Fisik</label>
                        <input class="form-control" name="penerima_fisik" />
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
                        <input type="hidden" name="file_foto" id="file_foto">
                        <input type="hidden" id="signature" name="signature">
                        <input type="submit" name="simpan" value="simpan" class="btn btn-primary" id="btn-save">
                    </div>
            </div>
            <div class="col-md-4">
                <b>Tanda Tangan</b>
                <div id="canvasDiv"></div>
                <br>
                <button type="button" class="btn btn-danger" id="reset-btn">Clear</button>
            </div>
            </form>

        </div>
    </div>
</div>

<?php

$id = isset($_POST['id']) ? $_POST['id'] : '';
$nip = isset($_POST['nip']) ? $_POST['nip'] : '';
$nama = isset($_POST['nama']) ? $_POST['nama'] : '';
$barang = isset($_POST['barang']) ? $_POST['barang'] : '';
$ekspedisi = isset($_POST['ekspedisi']) ? $_POST['ekspedisi'] : '';
$penerima_fisik = isset($_POST['penerima_fisik']) ? $_POST['penerima_fisik'] : '';
$tgl_terima = isset($_POST['tgl_terima']) ? $_POST['tgl_terima'] : '';
$tgl_serah = isset($_POST['tgl_serah']) ? $_POST['tgl_serah'] : '';
$file_foto = isset($_POST['file_foto']) ? $_POST['file_foto'] : '';
$simpan = isset($_POST['simpan']) ? $_POST['simpan'] : '';

if ($simpan) {
    // post tanda tangan
    $signature = $_POST['signature'];
    $signatureFileName = uniqid() . '.png';
    $signature = str_replace('data:image/png;base64,', '', $signature);
    $signature = str_replace(' ', '+', $signature);
    $data_ttd = base64_decode($signature);
    $file_ttd = 'signatures/' . $signatureFileName;
    file_put_contents($file_ttd, $data_ttd);

    //email
    <?php
    ini_set( 'display_errors', 1 );   
    error_reporting( E_ALL );    
    $from = "testing@domainanda.com";    
    $to = "alamatpenerima@domain.com";    
    $subject = "Checking PHP mail";    
    $message = "PHP mail berjalan dengan baik";   
    $headers = "From:" . $from;    
    mail($to,$subject,$message, $headers);    
    echo "Pesan email sudah terkirim.";
?>

    $sql = $koneksi->query("insert into tb_histori_barang_masuk (id, nip, nama, barang, ekspedisi, penerima_fisik, tgl_terima, tgl_serah, divisi, file_foto, file_ttd) values ('$id', '$nip', '$nama', '$barang', '$ekspedisi', '$penerima_fisik', '$tgl_terima', '$tgl_serah', '$divisi', '$file_foto', '$file_ttd')");
    $koneksi->query("delete from tb_barang_masuk where id ='$id'");

    if ($sql) {
?>
        <script type="text/javascript">
            alert("Behasil Disimpan Dihistori");
            window.location.href = "?page=barangmasuk";
        </script>
<?php
    }
}

?>

<script type="text/javascript" src="assets/webcam/webcam.js"></script>
<script language="JavaScript">
    function take_snapshot() {
        Webcam.snap(function(data_uri) {
            document.getElementById('results').innerHTML = '<img id="base64image" src="' + data_uri + '"/><br><button class="btn btn-warning" onclick="SaveSnap();">Simpan Foto</button>';
        });
    }

    function ShowCam() {
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 100
        });
        Webcam.attach('#my_camera');
    }

    function SaveSnap() {
        document.getElementById("loading").innerHTML = "Saving, please wait...";
        var file = document.getElementById("base64image").src;
        var formdata = new FormData();
        formdata.append("base64image", file);
        var ajax = new XMLHttpRequest();
        ajax.addEventListener("load", function(event) {
            uploadcomplete(event);
        }, false);
        ajax.open("POST", "upload.php");
        ajax.send(formdata);
    }

    function uploadcomplete(event) {
        document.getElementById("loading").innerHTML = "";
        var image_return = event.target.responseText;
        var showup = document.getElementById("uploaded").src = image_return;
        document.getElementById("file_foto").value = image_return;
        document.getElementById("saved_text").innerHTML = "Berhasil Tersimpan";
    }
    window.onload = ShowCam;
</script>