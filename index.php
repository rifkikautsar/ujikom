<?php
include("sidebar.php");

if(isset($_GET['page'])){
    $page = $_GET['page'];
    switch($page){
        case 'admin':
            include("admin.php");
            break;
        case 'buku':
            include("buku.php");
            break;
        case 'penerbit':
            include("penerbit.php");
            break;
        case 'pengadaan':
            include("pengadaan.php");
            break;
        case 'kategori':
            include("kategori.php");
            break;
        case 'tambah-buku':
            include("tambah-buku.php");
            break;
        case 'tambah-penerbit':
            include("tambah-penerbit.php");
            break;
        case 'tambah-kategori':
            include("tambah-kategori.php");
            break;
            default:
            include("404.php");
    }
}else{
    include("dashboard.php");
}
include("footer.php");
?>