<?php include("functions.php"); 
$db=dbConnect();
if($db->connect_errno==0){
    if(isset($_POST['update'])){
        $id_buku = mysqli_real_escape_string($db, $_POST["id_buku"]); 
        $nama = mysqli_real_escape_string($db, $_POST["nama_buku"]);  
        $kategori = mysqli_real_escape_string($db, $_POST["kategori"]);  
        $penerbit = mysqli_real_escape_string($db, $_POST["penerbit"]);
        $stok = mysqli_real_escape_string($db, $_POST["stok"]);
        $harga = mysqli_real_escape_string($db, $_POST["harga"]);
            if($id_buku!=""){
                $sql = "UPDATE buku set nama_buku = '$nama', harga = '$harga', stok = '$stok', id_kategori = '$kategori', id_penerbit = '$penerbit' where id_buku = '$id_buku'";
                $res = $db->query($sql);
                if($res){
                    if($db->affected_rows>0){
                        echo "
                        <script>
                        Swal.fire({
                            title: 'Data berhasil diubah',
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
                            title: 'Data gagal diubah',
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
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pengadaan</h1>
    </div>
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Pengadaan</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"
                                style="text-align: center">
                                <thead>
                                    <tr>
                                        <th>ID Buku</th>
                                        <th>Kategori</th>
                                        <th>Nama Buku</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Penerbit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form action="" method="post">
                                        <?php $data = getDataPengadaan(); var_dump($data);?>
                                        <?php foreach($data as $row):?>
                                        <tr>
                                            <input type="hidden" class="form-control form-control-sm" name="id_buku"
                                                id="id_buku" autocomplete="off" value="<?= $row['id_buku'];?>" required>
                                            <td><?= $row['id_buku'];?> </td>
                                            <td><?= $row['nama_kategori'];?></td>
                                            <td><?= $row['nama_buku'];?></td>
                                            <td><?= $row['harga'];?></td>
                                            <td><?= $row['stok'];?></td>
                                            <td><?= $row['nama_penerbit'];?></td>
                                            </td>
                                        </tr>
                                        <?php endforeach;?>
                                    </form>
                                </tbody>
                            </table>
                            <!-- Modal Edit -->
                            <form action="" method="post" id="insert_form">
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Edit Data</h5>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <td>ID Buku</td>
                                                        <td colspan="3"><input type="text" class="form-control" readonly
                                                                name="id_buku" id="id_buku">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nama Buku</td>
                                                        <td colspan="3"><input type="text" class="form-control"
                                                                name="nama_buku" autocomplete="off" id="nama_buku">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kategori</td>
                                                        <td colspan="3">
                                                            <select class="form-control" id="kategori" name="kategori"
                                                                required>
                                                                <?php $kategori = getKategori(); ?>
                                                                <?php foreach($kategori as $row): ?>
                                                                <option value="<?=$row['id_kategori'];?>">
                                                                    <?=$row['nama_kategori'] ?>
                                                                    <?php endforeach; ?>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Penerbit</td>
                                                        <td colspan="3"><select name="penerbit" class="form-control"
                                                                id="penerbit">
                                                                <?php $penerbit = getPenerbit(); ?>
                                                                <?php foreach($penerbit as $row): ?>
                                                                <option value="<?=$row['id_penerbit'];?>">
                                                                    <?=$row['nama_penerbit'] ?>
                                                                    <?php endforeach; ?>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <td>Harga</td>
                                                    <td colspan="3"><input type="text" class="form-control" name="harga"
                                                            autocomplete="off" id="harga">
                                                    </td>
                                                    </tr>
                                                    <td>Stok</td>
                                                    <td colspan="3"><input type="text" class="form-control" name="stok"
                                                            autocomplete="off" id="stok">
                                                    </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary close-modal"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success" name="update" id="update"
                                                    value="Update">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /.container-fluid -->
<?php } ?>
<script>
$(".close-modal").on("click", function() {
    $("#staticBackdrop").modal("hide");
})
$(".edit-data").on("click", function() {
    var id_buku = $(this).attr("id");
    console.log(id_buku)
    $.ajax({
        url: "getdetail.php",
        method: "post",
        dataType: "json",
        data: {
            id_buku: id_buku
        },
        success: function(resp) {
            console.log(resp)
            if (resp.status === "OK") {
                $("#id_buku").val(resp.data.id_buku);
                $("#nama_buku").val(resp.data.nama_buku);
                $("#harga").val(resp.data.harga);
                $("#stok").val(resp.data.stok);
                $("#penerbit").val(resp.data.id_penerbit);
                // $("#nama_penerbit").val(resp.data.nama_penerbit);
                // $("#id_kategori").val(resp.data.id_kategori);
                $("#kategori").val(resp.data.id_kategori);
                $("#staticBackdrop").modal("show");
            }
        }
    })
})
$(".hapus-data").on("click", function() {
    var id_buku = $(this).attr("id");
    Swal.fire({
        title: 'Apakah anda ingin menghapus data buku?',
        icon: 'warning',
        allowOutsideClick: false,
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        cancelButtonText: 'Kembali',
        confirmButtonText: 'Hapus'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "delete.php",
                method: "post",
                data: {
                    id_buku: id_buku
                },
                success: function(data) {
                    if (data === "OK") {
                        Swal.fire({
                            title: 'Data berhasil dihapus',
                            icon: 'success',
                            confirmButtonText: `Ok`
                        }).then((result) => {
                            document.location.href =
                                'index.php?page=buku'
                        })
                    } else {
                        Swal.fire({
                            title: 'Data gagal dihapus',
                            text: data,
                            icon: 'error',
                            showCloseButton: true
                        })
                    }
                }
            })
        }
    })
})
</script>