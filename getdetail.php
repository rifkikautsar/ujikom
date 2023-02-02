<?php
include("functions.php");
$db=dbConnect();
if($db->connect_errno==0){
    $response = array();
    if(!isset($_POST)){
        $response['status'] = "ERROR";
    }else if(isset($_POST['id_buku'])){
        $id_buku = $db->escape_string($_POST['id_buku']);
        $sql= "SELECT b.id_buku,b.nama_buku,b.harga,b.stok, k.id_kategori, k.nama_kategori, p.id_penerbit, p.nama_penerbit from buku b join kategori k using(id_kategori) join penerbit p using(id_penerbit) where id_buku = '$id_buku'";;
        $res=$db->query($sql);
        if($res){
            if($db->affected_rows>0){
                $data = $res->fetch_assoc();
                $response['status'] = "OK";
                $response['data'] = $data;
            }else{
                $response['status']="ERROR".(DEVELOPMENT?" : ".$db->error:"");
            }
        }else{
            $response['status']= "ERROR".(DEVELOPMENT?" : ".$db->error:"");
        }
    }else if(isset($_POST['id_penerbit'])){
        $id_penerbit = $db->escape_string($_POST['id_penerbit']);
        $sql= "SELECT * from penerbit where id_penerbit = '$id_penerbit'";;
        $res=$db->query($sql);
        if($res){
            if($db->affected_rows>0){
                $data = $res->fetch_assoc();
                $response['status'] = "OK";
                $response['data'] = $data;
            }else{
                $response['status']="ERROR".(DEVELOPMENT?" : ".$db->error:"");
            }
        }else{
            $response['status']= "ERROR".(DEVELOPMENT?" : ".$db->error:"");
        }
    }else if(isset($_POST['id_kategori'])){
        $id_kategori = $db->escape_string($_POST['id_kategori']);
        $sql= "SELECT * from kategori where id_kategori = '$id_kategori'";;
        $res=$db->query($sql);
        if($res){
            if($db->affected_rows>0){
                $data = $res->fetch_assoc();
                $response['status'] = "OK";
                $response['data'] = $data;
            }else{
                $response['status']="ERROR".(DEVELOPMENT?" : ".$db->error:"");
            }
        }else{
            $response['status']= "ERROR".(DEVELOPMENT?" : ".$db->error:"");
        }
    }
}
echo json_encode($response);
?>