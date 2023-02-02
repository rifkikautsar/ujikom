<?php include("functions.php"); 
$db=dbConnect();
if($db->connect_errno==0){
    if(isset($_POST['update'])){
        $id_penerbit = mysqli_real_escape_string($db, $_POST["id_penerbit"]); 
        $nama = mysqli_real_escape_string($db, $_POST["nama_penerbit"]);  
        $alamat = mysqli_real_escape_string($db, $_POST["alamat"]);  
        $kota = mysqli_real_escape_string($db, $_POST["kota"]);
        $telepon = mysqli_real_escape_string($db, $_POST["telepon"]);
            if($id_penerbit!=""){
                $sql = "UPDATE penerbit set nama_penerbit = '$nama', alamat = '$alamat', kota = '$kota', telepon = '$telepon' where id_penerbit = '$id_penerbit'";
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
        <center>
            <h1 class="h3 mb-0 text-gray-800">Data Penerbit</h1>
        </center>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col mb-4">
            <a href="index.php?page=tambah-penerbit" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Data</span>
            </a>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Penerbit</h6>
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
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID Penerbit</th>
                                        <th>Nama Penerbit</th>
                                        <th>Alamat</th>
                                        <th>Kota</th>
                                        <th>Telepon</th>
                                        <th colspan="2">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form action="" method="post">
                                        <?php $data = getPenerbit();?>
                                        <?php foreach($data as $row):?>
                                        <tr>
                                            <td><?= $row['id_penerbit'];?> </td>
                                            <td><?= $row['nama_penerbit'];?></td>
                                            <td><?= $row['alamat'];?></td>
                                            <td><?= $row['kota'];?></td>
                                            <td><?= $row['telepon'];?></td>
                                            <td><button type="button" class="btn btn-primary btn-circle edit-data"
                                                    id="<?=$row['id_penerbit'];?>" name="edit"><i
                                                        class="fas fa-edit"></i></button></td>
                                            <td><button type="button" class="btn btn-danger btn-circle hapus-data"
                                                    name="hapus" id="<?=$row['id_penerbit'];?>"><i
                                                        class="fas fa-trash"></i></button>
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
                                                        <td>ID Penerbit</td>
                                                        <td colspan="3"><input type="text" class="form-control" readonly
                                                                name="id_penerbit" id="id_penerbit">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nama Penerbit</td>
                                                        <td colspan="3"><input type="text" class="form-control"
                                                                name="nama_penerbit" autocomplete="off"
                                                                id="nama_penerbit">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Alamat</td>
                                                        <td colspan="3"><input type="text" class="form-control"
                                                                name="alamat" autocomplete="off" id="alamat">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kota</td>
                                                        <td colspan="3"><input type="text" class="form-control"
                                                                name="kota" autocomplete="off" id="kota">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Telepon</td>
                                                        <td colspan="3"><input type="text" class="form-control"
                                                                name="telepon" autocomplete="off" id="telepon">
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
<!-- /.container-fluid -->
<?php } ?>
<script>
$(".close-modal").on("click", function() {
    $("#staticBackdrop").modal("hide");
})
$(".edit-data").on("click", function() {
    var id_penerbit = $(this).attr("id");
    console.log(id_penerbit)
    $.ajax({
        url: "getdetail.php",
        method: "post",
        dataType: "json",
        data: {
            id_penerbit: id_penerbit
        },
        success: function(resp) {
            console.log(resp)
            if (resp.status === "OK") {
                $("#id_penerbit").val(resp.data.id_penerbit);
                $("#nama_penerbit").val(resp.data.nama_penerbit);
                $("#alamat").val(resp.data.alamat);
                $("#kota").val(resp.data.kota);
                $("#telepon").val(resp.data.telepon);
                $("#staticBackdrop").modal("show");
            }
        }
    })
})
$(".hapus-data").on("click", function() {
    var id_penerbit = $(this).attr("id");
    Swal.fire({
        title: 'Apakah anda ingin menghapus data penerbit?',
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
                    id_penerbit: id_penerbit
                },
                success: function(data) {
                    if (data === "OK") {
                        Swal.fire({
                            title: 'Data berhasil dihapus',
                            icon: 'success',
                            confirmButtonText: `Ok`
                        }).then((result) => {
                            document.location.href =
                                'index.php?page=penerbit'
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