<?php
define("DEVELOPMENT",TRUE);
function dbConnect(){
    global $db;
	$db=new mysqli("localhost","root","artemis47","unibookstore");
	return $db;
}
function getKepala(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT nm_petugas,hak_akses,username,id_petugas from petugas where hak_akses='kepala'";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
function getPetugas(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT nm_petugas,hak_akses,username,id_petugas from petugas where hak_akses='petugas'";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
function getAdmin(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT nm_petugas,hak_akses,username,id_petugas from petugas where hak_akses='admin'";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
function getBarang(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT * from barang";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
function getDataBuku(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT b.id_buku,b.nama_buku,b.harga, b.stok,k.nama_kategori,p.nama_penerbit from buku b join kategori k using(id_kategori) join penerbit p using(id_penerbit)";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
function getDataPengadaan(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT MIN(b.stok) as stok, b.id_buku,b.nama_buku,b.harga, k.nama_kategori,p.nama_penerbit from buku b join kategori k using(id_kategori) join penerbit p using(id_penerbit)";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
function getPenerbit(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT * from penerbit";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
function getKategori(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT * from kategori";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
function getSatuan(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT * from satuan";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
function getIdPinjam(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT p.id_pinjam,a.nm_anggota FROM peminjaman p JOIN anggota a USING(id_anggota) WHERE p.id_pinjam NOT IN 
		(SELECT id_pinjam FROM pengembalian)";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
function getPeminjaman($id_pinjam){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT p.id_pinjam,pt.nm_petugas,a.nm_anggota,b.id_barang,b.nm_barang,r.jml_barang,s.nm_satuan FROM peminjaman p JOIN anggota a USING(id_anggota) join petugas pt using(id_petugas) join rincian_peminjaman r using(id_pinjam) join barang b using(id_barang) join satuan s using(id_satuan) where id_pinjam ='$id_pinjam'";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

function getDataPeminjaman(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT p.id_pinjam,a.nm_anggota,pt.nm_petugas,p.tgl_pinjam 
		FROM peminjaman p JOIN anggota a USING(id_anggota)
		join petugas pt using (id_petugas) where p.id_pinjam not in (SELECT id_pinjam from pengembalian)";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

function getRincianPeminjaman($id_pinjam){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT b.nm_barang,rp.jml_barang,rp.id_pinjam
		from rincian_peminjaman rp join barang b using(id_barang) where rp.id_pinjam = '$id_pinjam'";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

function getDataPengembalian(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT pm.id_pinjam,pm.tgl_pinjam,a.nm_anggota,pt.nm_petugas,pg.tgl_kembali 
		FROM peminjaman pm JOIN pengembalian pg using(id_pinjam)
		join anggota a USING(id_anggota)
		join petugas pt on pg.id_petugas = pt.id_petugas";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
function showError($message){
	?>
<div class="alert alert-danger d-flex align-items-center" role="alert">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
        class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
        <path
            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
    </svg>
    <div>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?=$message;?>
    </div>
</div>
<?php
}