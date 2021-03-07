<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran</title>
	<script>
	function halamanawal() {
	location.replace("menu.php")
	}
	function logout() {
	location.replace("login.php")
	}

	</script>
</head>
<style>
body {
	background-image:"jhin.gif";
	background-repeat:no-repeat;
	background-size:cover;
}
table{
	border-radius:5px;
	border-style:groove;
	border-color:#981b98;
	background-color:rgb(200, 200, 200, 0.2);
	color:white;
}
h2{
	color:white;
}
h3{
	color:white;
}
.button {
  background-color: white;
  border: none;
  color: black;
  padding: 5px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  margin: 2px 2px;
  -webkit-transition-duration: 0.9s;
  transition-duration: 0.9s;
  cursor: pointer;
  font-family: Century Schoolbook;
}

.button1 {
  background-color: white; 
  color: black; 
  border: 0px solid #2af598;
  border-radius: 8px;
  box-shadow: 0px 0px 5px grey;
}

.button1:hover {
  background-color: black;
  color: black;
}
label{
	color: white;
}
b{
	color: white;
}
</style>
<body background = "gala.jpg">
<button class="button button1" type="submit" onclick="logout()"><a href="logout.php"><font face='Century Schoolbook' size='3'></a><b>Logout</b></button>
<button class="button button1" type="submit" onclick="halamanawal()"><a href="menu.php"><font face='Century Schoolbook' size='3'></a><b>Kembali</b></button>
<?php
$conn = mysqli_connect("localhost","root","","spp");
function tambah($conn){
    
    if (isset($_POST['btn_simpan'])){
        $tgl_bayar = $_POST['tgl_bayar'];
        $bulan_bayar = $_POST['bulan_bayar'];
        $jml_bayar = $_POST['jml_bayar'];
		$no_induk = $_POST['no_induk'];
        
        if(!empty($tgl_bayar)&&!empty($bulan_bayar)&&!empty($jml_bayar)&&!empty($no_induk)){
            $sql = "INSERT INTO pembayaran (tgl_bayar,bulan_bayar,jml_bayar,no_induk) VALUES('".$tgl_bayar."','".$bulan_bayar."','".$jml_bayar."','".$no_induk."')";
            $simpan = mysqli_query($conn, $sql);
            if($simpan && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'create'){
                    header('location: pembayaran.php');
                }
            }
        }
    }
    ?> 
        <form action="" method="POST">
            <fieldset>
                <legend><h2>Tambah data</h2></legend>
				<label>Tanggal Pembayaran <input type="date" name="tgl_bayar" /></label>
				<br><br>
				<label>Bulan Bayar <input type="text" name="bulan_bayar" /></label>
				<br><br>
				<label>Jumlah Yang Dibayarkan <input type="text" name="jml_bayar" /></label>
				<br><br>
				<label>No Induk Siswa <input type="text" name="no_induk" /></label>
				<br><br>
                <label>
                    <input class="button button1" type="submit" name="btn_simpan" value="Simpan"/>
                </label>
                <br>
                <p><?php echo isset($pesan) ? $pesan : "" ?></p>
            </fieldset>
        </form>
<form action="pembayaran.php" method="get">
<label>Cari :</label>
<input type="text" name="cari">
<input class="button button1" type="submit" value="Cari">
</form>
<?php
	$sql = "SELECT * FROM pembayaran"; 
if(isset($_GET['cari'])){
	$cari = $_GET['cari'];
	echo "<b>Hasil pencarian : ".$cari."</b>";
}
?>
<table border="1">
	<tr>
		<th>Id Bayar</th>
		<th>Tanggal Pembayaran</th>
		<th>Bulan Bayar</th>
        <th>Jumlah Yang Dibayarkan</th>
		<th>No Induk</th>
        <th>Action</th>
	</tr>
	<?php 
	error_reporting(0);
	if(isset($_GET["cari"])){
		$cari = $_GET["cari"];
		$query = mysqli_query($conn, 
		"SELECT* FROM pembayaran WHERE 
		id_bayar LIKE '%".$cari."%' or 
		tgl_bayar LIKE '%".$cari."%' or 
		bulan_bayar LIKE '%".$cari."%' or 
		jml_bayar LIKE '%".$cari."%' or
		no_induk LIKE '%".$cari."%'");
	}
	while($data =mysqli_fetch_array($query)){
	?>
	<tr>
		<td><?php echo $data["id_bayar"]; ?></td>
		<td><?php echo $data["tgl_bayar"]; ?></td>
		<td><?php echo $data['bulan_bayar']; ?></td>
        <td>Rp.<?php echo $data['jml_bayar']; ?></td>                
		<td><?php echo $data['no_induk']; ?></td>
		<td>
            <a href="pembayaran.php?aksi=update&id_bayar=<?php echo $data['id_bayar']; ?>&tgl_bayar=<?php echo $data['tgl_bayar']; ?>&bulan_bayar=<?php echo $data['bulan_bayar']; ?>&jml_bayar=<?php echo $data['jml_bayar']; ?>&no_induk=<?php echo $data['no_induk']; ?>">Ubah</a>
            <a href="pembayaran.php?aksi=delete&id_bayar=<?php echo $data['id_bayar']; ?>">Hapus</a>
        </td>
	</tr>
	<?php } 
	?>
</table>

    <?php
}
function tampil_data($conn){
    $sql = "SELECT * FROM pembayaran";
    $query = mysqli_query($conn, $sql);
    
    echo "<fieldset>";
    echo "<legend><h3>Data Pembayaran</h3></legend>";
    
    echo "<table border='1' cellpadding='5'>";
    echo "<tr>
            <th>Id Bayar</th>
            <th>Tanggal Pembayaran</th>
			<th>Bulan Bayar</th>
            <th>Jumlah Yang Dibayarkan</th>
			<th>No Induk</th>
            <th>Action</th>
          </tr>";
    
    while($data = mysqli_fetch_array($query)){
        ?>
            <tr>
                <td><?php echo $data['id_bayar']; ?></td>
                <td><?php echo $data['tgl_bayar']; ?></td>
                <td><?php echo $data['bulan_bayar']; ?></td>
                <td>Rp.<?php echo $data['jml_bayar']; ?></td>
				<td><?php echo $data['no_induk']; ?></td>                
				<td>
                    <a href="pembayaran.php?aksi=update&id_bayar=<?php echo $data['id_bayar']; ?>&tgl_bayar=<?php echo $data['tgl_bayar']; ?>&bulan_bayar=<?php echo $data['bulan_bayar']; ?>&jml_bayar=<?php echo $data['jml_bayar']; ?>&no_induk=<?php echo $data['no_induk']; ?>">Ubah</a>
                    <a href="pembayaran.php?aksi=delete&id_bayar=<?php echo $data['id_bayar']; ?>">Hapus</a>
                </td>
            </tr>
        <?php
    }
    echo "</table>";
    echo "</fieldset>";
}
function ubah($conn){
    if(isset($_POST['btn_ubah'])){
		$id_bayar= $_POST['id_bayar'];
        $tgl_bayar = $_POST['tgl_bayar'];
        $bulan_bayar = $_POST['bulan_bayar'];
        $jml_bayar = $_POST['jml_bayar'];
        $no_induk = $_POST['no_induk'];
		
        if(!empty($tgl_bayar)&&!empty($bulan_bayar)&&!empty($jml_bayar)&&!empty($no_induk)){
            $perubahan = "tgl_bayar='".$tgl_bayar."',bulan_bayar='".$bulan_bayar."',jml_bayar='".$jml_bayar."',no_induk='".$no_induk."'";
            $sql_update = "UPDATE pembayaran SET ".$perubahan." WHERE id_bayar=$id_bayar";
            $update = mysqli_query($conn, $sql_update);
            if($update && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'update'){
                    header('location: pembayaran.php');
                }
            }
        }
    }
    if(isset($_GET['id_bayar'])){
        ?>
            <a href="pembayaran.php"> &laquo; Kembali</a> | 
            <a href="pembayaran.php?aksi=create">Tambah Data</a>
            <hr>
            
            <form action="" method="POST">
            <fieldset>
                <legend><h2>Ubah data</h2></legend>
                <input type="hidden" name="id_bayar" value="<?php echo $_GET['id_bayar'] ?>"/>
				<label>Tanggal Pembayaran <input type="date" name="tgl_bayar" value="<?php echo $_GET['tgl_bayar'] ?> "/></label>
				<br><br>
				<label>Bulan Bayar <input type="text" name="bulan_bayar" value="<?php echo $_GET['bulan_bayar'] ?> "/></label>
				<br><br>
				<label>Jumlah Yang Dibayarkan <input type="text" name="jml_bayar" value="<?php echo $_GET['jml_bayar'] ?> "/></label>
				<br><br>
				<label>No Induk <input type="text" name="no_induk" value="<?php echo $_GET['no_induk'] ?> "/></label>
				<br><br>
                <label>
                    <input type="submit" name="btn_ubah" value="Simpan Perubahan"/> atau <a href="pembayaran.php?aksi=delete&id_bayar=<?php echo $_GET['id_bayar'] ?>"> (x) Hapus data ini</a>!
                </label>
                <br>
                <p><?php echo isset($pesan) ? $pesan : "" ?></p>
                
            </fieldset>
            </form>
        <?php
    }
    
}
function hapus($conn){
    if(isset($_GET['id_bayar']) && isset($_GET['aksi'])){
        $id_bayar = $_GET['id_bayar'];
        $sql_hapus = "DELETE FROM pembayaran WHERE id_bayar=" . $id_bayar;
        $hapus = mysqli_query($conn, $sql_hapus);
        
        if($hapus){
            if($_GET['aksi'] == 'delete'){
                header('location: pembayaran.php');
            }
        }
    }
    
}
if (isset($_GET['aksi'])){
    switch($_GET['aksi']){
        case "create":
            echo '<a href="pembayaran.php"> &laquo; Home</a>';
            tambah($conn);
            break;
        case "read":
            tampil_data($conn);
            break;
        case "update":
            ubah($conn);
            tampil_data($conn);
            break;
        case "delete":
            hapus($conn);
            break;
        default:
            echo "<h3>Aksi <i>".$_GET['aksi']."</i></h3>";
            tambah($conn);
            tampil_data($conn);
    }
} else {
    tambah($conn);
    tampil_data($conn);
}
?>
</body>
</html>