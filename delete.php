<?php
include("functions.php");
$db=dbConnect();
if($db->connect_errno==0){
    $message="";
    if(isset($_POST['id_buku'])){
    $id_buku = mysqli_real_escape_string($db, $_POST["id_buku"]);
    $sql = "DELETE from buku where id_buku = '$id_buku'";
    $res = $db->query($sql);
        if($res){
            if($db->affected_rows>0){
                $message="OK";
            }else{
                $message="ERROR".(DEVELOPMENT?" : ".$db->error:"");
            }
        }else {
            $message = "ERROR".(DEVELOPMENT?" : ".$db->error:"");
        }
    } else if(isset($_POST['id_penerbit'])){
        $id_penerbit = mysqli_real_escape_string($db, $_POST["id_penerbit"]);
        try{
            $sql = "DELETE from penerbit where id_penerbit = '$id_penerbit'";
            $res = $db->query($sql);
                if($res){
                    if($db->affected_rows>0){
                        $message="OK";
                    }
                }
        }catch(Exception $e){
            $message="ERROR ".(DEVELOPMENT?" : ".$db->error:"Tidak bisa dihapus, terdapat data buku yang berelasi dengan penerbit");
        }

        } else if(isset($_POST['id_kategori'])){
            $id_kategori = mysqli_real_escape_string($db, $_POST["id_kategori"]);
            try{
                $sql = "DELETE from kategori where id_kategori = '$id_kategori'";
                $res = $db->query($sql);
                    if($res){
                        if($db->affected_rows>0){
                            $message="OK";
                        }
                    }
            }catch(Exception $e){
                $message="ERROR ".(DEVELOPMENT?" : ".$db->error:"Tidak bisa dihapus, terdapat data buku yang berelasi dengan kategori");
            }
        }
}echo $message;