<?php include("functions.php"); 
$db=dbConnect();
if($db->connect_errno==0){
    if(isset($_POST['submit'])){
        $nama = mysqli_real_escape_string($db, $_POST["nama_kategori"]);   
            if($nama!=""){
                $sql = "INSERT INTO kategori values ('','$nama')";
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
                    <label for="inputnamakategori" class="form-label">Nama Kategori</label>
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm" name="nama_kategori"
                            id="nama_kategori"></input>
                    </div>
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