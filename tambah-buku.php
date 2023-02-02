<?php include("functions.php"); 
$db=dbConnect();
if($db->connect_errno==0){
    if(isset($_POST['submit'])){
        $id_buku = mysqli_real_escape_string($db, $_POST["id_buku"]); 
        $nama = mysqli_real_escape_string($db, $_POST["nm_buku"]);  
        $kategori = mysqli_real_escape_string($db, $_POST["id_kat"]);  
        $penerbit = mysqli_real_escape_string($db, $_POST["id_penerbit"]);
        $stok = mysqli_real_escape_string($db, $_POST["stok"]);
        $harga = mysqli_real_escape_string($db, $_POST["harga"]);
            if($id_buku!=""){
                $sql = "INSERT INTO buku values ('$id_buku','$kategori','$penerbit','$nama','$harga', '$stok')";
                $res = $db->query($sql);
                if($res){
                    if($db->affected_rows>0){
                        echo "
                        <script>
                        Swal.fire({
                            title: 'Data berhasil ditambahkan',
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok!'
                        })
                        </script>";
                    } else {
                        echo (DEVELOPMENT?'ERROR : '.$e->getMessage():'');
                        echo "
                            <script>
                            Swal.fire({
                            title: 'Data gagal ditambahkan',
                            icon: 'error',
                            showCloseButton: true,
                            })
                            </script>
                            ";
                    }
                }
            }
    }
?>
<!-- Begin Page Content -->
<div class="offset-lg-2 col-lg-8">
    <div class="container" style="color:black;">
        <form class="col" action="" method="post" name="f" id="f" enctype="multipart/form-data">
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="inputidbuku" class="form-label">ID Buku</label>
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm" id="id_buku" name="id_buku"
                            autocomplete="off" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="inputidkategori" class="form-label">Kategori</label>
                    <select class="form-control form-control-sm" name="id_kat" id="id_kat" autocomplete="off" required>
                        <option value="">Pilih Kategori</option>
                        <?php $kategori = getKategori(); ?>
                        <?php foreach($kategori as $row):?>
                        <option value="<?=$row['id_kategori']; ?>"><?=$row['nama_kategori'];?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="inputNama-buku" class="form-label">Judul Buku</label>
                    <input type="text" class="form-control form-control-sm" name="nm_buku" id="nm_buku"
                        autocomplete="off" required>
                </div>
                <div class="col-sm-6">
                    <label for="inputidpenerbit" class="form-label">Penerbit</label>
                    <select class="form-control form-control-sm" name="id_penerbit" id="id_penerbit" autocomplete="off"
                        required>
                        <option value="0" selected>Pilih penerbit</option>
                        <?php $penerbit = getPenerbit(); ?>
                        <?php foreach($penerbit as $row):?>
                        <option value="<?= $row['id_penerbit']; ?>"><?=$row['nama_penerbit'];?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="inputStok" class="form-label">Stok</label>
                    <input type="number" class="form-control form-control-sm" name="stok" id="stok" autocomplete="off"
                        required>
                </div>
                <div class="col-sm-6">
                    <label for="inputHarga" class="form-label">Harga</label>
                    <input type="number" class="form-control form-control-sm" name="harga" id="harga" autocomplete="off"
                        required>
                </div>
            </div>
            <div id="warn"></div>
            <div class="mb-3">
                <button class="btn btn-primary" type="submit" name="submit" id="submit">Submit</button>
                <button class="btn btn-danger" type="reset">Reset</button>
            </div>
        </form>
    </div>
</div>

<?php } ?>
<!-- /.container-fluid -->