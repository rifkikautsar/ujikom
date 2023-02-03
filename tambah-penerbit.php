<?php include("functions.php"); 
$db=dbConnect();
if($db->connect_errno==0){
    if(isset($_POST['submit'])){
        $id_penerbit = mysqli_real_escape_string($db, $_POST["id_penerbit"]); 
        $nama = mysqli_real_escape_string($db, $_POST["nama_penerbit"]);  
        $alamat = mysqli_real_escape_string($db, $_POST["alamat"]);
        $kota = mysqli_real_escape_string($db, $_POST["kota"]);
        $telepon = mysqli_real_escape_string($db, $_POST["telepon"]);  
            if($id_penerbit!=""){
                $sql = "INSERT INTO penerbit values ('$id_penerbit','$nama','$alamat','$kota','$telepon')";
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
                    <label for="inputidpenerbit" class="form-label">ID Penerbit</label>
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm" id="id_penerbit" name="id_penerbit"
                            autocomplete="off" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="inputnamapenerbit" class="form-label">Nama Penerbit</label>
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm" name="nama_penerbit"
                            id="nama_penerbit"></input>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="inputTelepon" class="form-label">Telepon</label>
                    <input type="number" class="form-control form-control-sm" name="telepon" id="telepon"
                        autocomplete="off" required>
                </div>
                <div class="col-sm-6">
                    <label for="inputkota" class="form-label">Kota</label>
                    <input type="text" class="form-control form-control-sm" name="kota" id="kota">
                    </input>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="inputAlamat" class="form-label">Alamat</label>
                    <textarea rows="4" class="form-control form-control-sm" name="alamat" id="alamat" autocomplete="off"
                        required></textarea>
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
</div>
<?php } ?>
<!-- /.container-fluid -->