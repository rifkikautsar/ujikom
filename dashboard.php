<?php include("functions.php"); 
$db=dbConnect();
if($db->connect_errno==0){
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <center>
            <h1 class="h3 mb-0 text-gray-800">Data Buku</h1>
        </center>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-lg-7 mb-4">
            <!-- Topbar Search -->
            <form action="" method="post"
                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-body border-0 medium" name="keyword"
                        placeholder="Cari Buku..." id="keyword" aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                        aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small"
                                    placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <!-- Content Row -->
    <div id="container">
        <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Tabel Buku</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                            <?php $data = getDataBuku();?>
                                            <?php foreach($data as $row):?>
                                            <tr>
                                                <input type="hidden" class="form-control form-control-sm" name="id_buku"
                                                    id="id_buku" autocomplete="off" value="<?= $row['id_buku'];?>"
                                                    required>
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
                                                            <td colspan="3"><input type="text" class="form-control"
                                                                    readonly name="id_buku" id="id_buku">
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
                                                                <select class="form-control" id="kategori"
                                                                    name="kategori" required>
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
                                                        <td colspan="3"><input type="text" class="form-control"
                                                                name="harga" autocomplete="off" id="harga">
                                                        </td>
                                                        </tr>
                                                        <td>Stok</td>
                                                        <td colspan="3"><input type="text" class="form-control"
                                                                name="stok" autocomplete="off" id="stok">
                                                        </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary close-modal"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success" name="update"
                                                        id="update" value="Update">Update</button>
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
$(document).ready(function() {
    $("#keyword").on('keyup', function() {
        $keyword = $("#keyword").val();
        $("#container").load("cari.php?keyword=" + encodeURI($keyword));
    })
})
</script>