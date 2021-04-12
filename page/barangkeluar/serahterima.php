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

                <?php
                if (isset($_POST['signaturesubmit'])) {
                    $signature = $_POST['signature'];
                    $signatureFileName = uniqid() . '.png';
                    $signature = str_replace('data:image/png;base64,', '', $signature);
                    $signature = str_replace(' ', '+', $signature);
                    $data = base64_decode($signature);
                    $file = 'signatures/' . $signatureFileName;
                    file_put_contents($file, $data);
                    $msg = "<div class='alert alert-success'>Signature Uploaded</div>";
                }
                ?>
                <html>

                <head>
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
                    <style>
                        #canvasDiv {
                            position: relative;
                            border: 2px dashed grey;
                            height: 240px;
                            width: 320px;
                        }
                    </style>
                </head>

                <body>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <br>
                                <?php echo isset($msg) ? $msg : ''; ?>
                                <h2>Tanda Tangan</h2>
                                <hr>
                                <div id="canvasDiv"></div>
                                <br>
                                <button type="button" class="btn btn-danger" id="reset-btn">Clear</button>
                                <button type="button" class="btn btn-success" id="btn-save">Save</button>
                            </div>
                            <form id="signatureform" action="" style="display:none" method="post">
                                <input type="hidden" id="signature" name="signature">
                                <input type="hidden" name="signaturesubmit" value="1">
                            </form>
                        </div>
                    </div>
                </body>
                <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
                <script>
                    $(document).ready(() => {
                        var canvasDiv = document.getElementById('canvasDiv');
                        var canvas = document.createElement('canvas');
                        canvas.setAttribute('id', 'canvas');
                        canvasDiv.appendChild(canvas);
                        $("#canvas").attr('height', $("#canvasDiv").outerHeight());
                        $("#canvas").attr('width', $("#canvasDiv").width());
                        if (typeof G_vmlCanvasManager != 'undefined') {
                            canvas = G_vmlCanvasManager.initElement(canvas);
                        }

                        context = canvas.getContext("2d");
                        $('#canvas').mousedown(function(e) {
                            var offset = $(this).offset()
                            var mouseX = e.pageX - this.offsetLeft;
                            var mouseY = e.pageY - this.offsetTop;

                            paint = true;
                            addClick(e.pageX - offset.left, e.pageY - offset.top);
                            redraw();
                        });

                        $('#canvas').mousemove(function(e) {
                            if (paint) {
                                var offset = $(this).offset()
                                //addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, true);
                                addClick(e.pageX - offset.left, e.pageY - offset.top, true);
                                console.log(e.pageX, offset.left, e.pageY, offset.top);
                                redraw();
                            }
                        });

                        $('#canvas').mouseup(function(e) {
                            paint = false;
                        });

                        $('#canvas').mouseleave(function(e) {
                            paint = false;
                        });

                        var clickX = new Array();
                        var clickY = new Array();
                        var clickDrag = new Array();
                        var paint;

                        function addClick(x, y, dragging) {
                            clickX.push(x);
                            clickY.push(y);
                            clickDrag.push(dragging);
                        }

                        $("#reset-btn").click(function() {
                            context.clearRect(0, 0, window.innerWidth, window.innerWidth);
                            clickX = [];
                            clickY = [];
                            clickDrag = [];
                        });

                        $(document).on('click', '#btn-save', function() {
                            var mycanvas = document.getElementById('canvas');
                            var img = mycanvas.toDataURL("image/png");
                            anchor = $("#signature");
                            anchor.val(img);
                            $("#signatureform").submit();
                        });

                        var drawing = false;
                        var mousePos = {
                            x: 0,
                            y: 0
                        };
                        var lastPos = mousePos;

                        canvas.addEventListener("touchstart", function(e) {
                            mousePos = getTouchPos(canvas, e);
                            var touch = e.touches[0];
                            var mouseEvent = new MouseEvent("mousedown", {
                                clientX: touch.clientX,
                                clientY: touch.clientY
                            });
                            canvas.dispatchEvent(mouseEvent);
                        }, false);


                        canvas.addEventListener("touchend", function(e) {
                            var mouseEvent = new MouseEvent("mouseup", {});
                            canvas.dispatchEvent(mouseEvent);
                        }, false);


                        canvas.addEventListener("touchmove", function(e) {

                            var touch = e.touches[0];
                            var offset = $('#canvas').offset();
                            var mouseEvent = new MouseEvent("mousemove", {
                                clientX: touch.clientX,
                                clientY: touch.clientY
                            });
                            canvas.dispatchEvent(mouseEvent);
                        }, false);



                        // Get the position of a touch relative to the canvas
                        function getTouchPos(canvasDiv, touchEvent) {
                            var rect = canvasDiv.getBoundingClientRect();
                            return {
                                x: touchEvent.touches[0].clientX - rect.left,
                                y: touchEvent.touches[0].clientY - rect.top
                            };
                        }


                        var elem = document.getElementById("canvas");

                        var defaultPrevent = function(e) {
                            e.preventDefault();
                        }
                        elem.addEventListener("touchstart", defaultPrevent);
                        elem.addEventListener("touchmove", defaultPrevent);


                        function redraw() {
                            //
                            lastPos = mousePos;
                            for (var i = 0; i < clickX.length; i++) {
                                context.beginPath();
                                if (clickDrag[i] && i) {
                                    context.moveTo(clickX[i - 1], clickY[i - 1]);
                                } else {
                                    context.moveTo(clickX[i] - 1, clickY[i]);
                                }
                                context.lineTo(clickX[i], clickY[i]);
                                context.closePath();
                                context.stroke();
                            }
                        }
                    })
                </script>

                </html>

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