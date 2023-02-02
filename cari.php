<?php
include("functions.php");
$db=dbConnect();
$keyword = urldecode($_GET["keyword"]);
$sql= "SELECT b.id_buku,b.nama_buku,b.harga, b.stok,k.nama_kategori,p.nama_penerbit from buku b join kategori k using(id_kategori) join penerbit p using(id_penerbit)
where b.nama_buku like '%$keyword%'";
$res=$db->query($sql);
$list=$res->fetch_all(MYSQLI_ASSOC);
?>
<div class="row">
    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Buku</h6>
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
                                    <?php foreach($list as $row):?>
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
<script>
$(".edit-data").on("click", function() {
    var id_barang = $(this).attr("id");
    $.ajax({
        url: "../src/getdetail.php",
        method: "post",
        dataType: "json",
        data: {
            id_barang: id_barang
        },
        success: function(resp) {
            if (resp.status === "OK") {
                $("#id_barang").val(resp.data.id_barang);
                $("#nm_barang").val(resp.data.nm_barang);
                $("#kategori").val(resp.data.id_kat);
                $("#supplier").val(resp.data.id_supplier);
                $("#jml").val(resp.data.jumlah);
                $("#satuan").val(resp.data.id_satuan);
                $("#baik").val(resp.data.baik);
                $("#ringan").val(resp.data.rusak);
                $("#berat").val(resp.data.rusak_berat);
                $("#tanggal").val(resp.data.tanggal);
                $("#sumber").val(resp.data.sumber);
                $("#staticBackdrop").modal("show");
            }
        }
    })
})
$("#baik").on("blur", function() {
    var ringan = parseInt($("#ringan").val());
    var jml = parseInt($("#jml").val());
    var baik = parseInt($("#baik").val());
    var berat = parseInt($("#berat").val());
    if (ringan == 0) {
        $("#jml").val(baik + berat);
    } else if (berat == 0) {
        $("#jml").val(baik + ringan);
    } else {
        $("#jml").val(baik + ringan + berat);
    }
})
$("#ringan").on("blur", function() {
    var ringan = parseInt($("#ringan").val());
    var jml = parseInt($("#jml").val());
    var baik = parseInt($("#baik").val());
    var berat = parseInt($("#berat").val());
    if (baik == 0) {
        $("#jml").val(ringan + berat);
    } else if (berat == 0) {
        $("#jml").val(ringan + baik);
    } else {
        $("#jml").val(baik + ringan + berat);
    }
})
$("#berat").on("blur", function() {
    var ringan = parseInt($("#ringan").val());
    var jml = parseInt($("#jml").val());
    var baik = parseInt($("#baik").val());
    var berat = parseInt($("#berat").val());
    if (baik == 0) {
        $("#jml").val(berat + ringan);
    } else if (ringan == 0) {
        $("#jml").val(berat + baik);
    } else {
        $("#jml").val(baik + ringan + berat);
    }
})
$('#insert_form').on("submit", function(event) {
    event.preventDefault();
    if ($("#nm_barang").val() == "") {
        alert("Nama barang tidak boleh kosong");
    } else if ($("#tanggal").val() == '') {
        alert("Tanggal tidak boleh kosong");
    } else {
        $.ajax({
            url: "../src/ubah.php",
            method: "POST",
            data: $('#insert_form').serialize(),
            beforeSend: function() {
                $('#insert').val("Inserting");
            },
            success: function(data) {
                if (data === "OK") {
                    Swal.fire({
                        title: 'Data berhasil diubah',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.location.href = "index.php?page=barang";
                        }
                    })
                } else {
                    Swal.fire({
                        title: 'Data gagal diubah',
                        text: data,
                        icon: 'error',
                        showCloseButton: true,
                    })
                }
            },
        });
    }
})
$(".hapus-data").on("click", function() {
    var id_barang = $(this).attr("id");
    Swal.fire({
        title: 'Apakah anda ingin menghapus data barang?',
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
                url: "../src/delete.php",
                method: "post",
                data: {
                    id_barang: id_barang
                },
                success: function(data) {
                    if (data === "OK") {
                        Swal.fire({
                            title: 'Data berhasil dihapus',
                            icon: 'success',
                            confirmButtonText: `Ok`
                        }).then((result) => {
                            document.location.href =
                                'index.php?page=barang'
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