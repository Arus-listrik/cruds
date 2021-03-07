<!DOCTYPE html>
<html>
<head>
    <title>Data Siswa</title>
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
	background-image:"galax.jpg";
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
<button class="button button1" type="submit" onclick="logout()"><a href="logout.php"><font face='Century Schoolbook' color='black' size='3'></a><b>Logout</b></button>
<button class="button button1" type="submit" onclick="halamanawal()"><a href="menu.php"><font face='Century Schoolbook' color='black' size='3'></a><b>Bek</b></button>
<?php
$conn = mysqli_connect("localhost","root","","spp");
function tambah($conn){
    
    if (isset($_POST['btn_simpan'])){
        $no_induk = $_POST['no_induk'];
        $nama_siswa = $_POST['nama_siswa'];
        $alamat_siswa = $_POST['alamat_siswa'];
        $no_hp = $_POST['no_hp'];
		$kelas = $_POST['kelas'];
        
        if(!empty($no_induk)&&!empty($nama_siswa)&&!empty($alamat_siswa)&&!empty($no_hp)&&!empty($kelas)){
            $sql = "INSERT INTO siswa (no_induk,nama_siswa,alamat_siswa,no_hp,kelas) VALUES('".$no_induk."','".$nama_siswa."','".$alamat_siswa."','".$no_hp."','".$kelas."')";
            $simpan = mysqli_query($conn, $sql);
            if($simpan && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'create'){
                    header('location: siswa.php');
                }
            }
        }
    }
    ?> 
        <form action="" method="POST">
            <fieldset>
                <legend><h2>Tambah data</h2></legend>
                <label>No Induk <input type="text" name="no_induk" /></label>
				<br><br>
				<label>Nama Siswa <input type="text" name="nama_siswa" /></label>
				<br><br>
				<label>Alamat Siswa <input type="text" name="alamat_siswa" /></label>
				<br><br>
				<label>No Hp Siswa <input type="text" name="no_hp" /></label>
				<br><br>
				<label>Kelas Siswa <br>
				<input type="radio" id="10" name="kelas" value="10">
				<label for="10">10</label><br>
				<input type="radio" id="11" name="kelas" value="11">
				<label for="11">11</label><br>
				<input type="radio" id="12" name="kelas" value="12">
				<label for="12">12</label></label>
				<br><br>
                <label>
                    <input class="button button1" type="submit" name="btn_simpan" value="Simpan"/>
                </label>
                <br>
                <p><?php echo isset($pesan) ? $pesan : "" ?></p>
            </fieldset>
        </form>
<form action="siswa.php" method="get">
<label>Cari :</label>
<input type="text" name="cari">
<input class="button button1" type="submit" value="Cari">
</form>
<?php
	$sql = "SELECT * FROM siswa"; 
if(isset($_GET['cari'])){
	$cari = $_GET['cari'];
	echo "<b>Hasil pencarian : ".$cari."</b>";
}
?>
<table border="1">
	<tr>
		<th>No Induk</th>
		<th>Nama Siswa</th>
		<th>Alamat Siswa</th>
        <th>No Hp Siswa</th>
		<th>Kelas Siswa</th>
        <th>Action</th>
	</tr>
	<?php 
	error_reporting(0);
	if(isset($_GET["cari"])){
		$cari = $_GET["cari"];
		$query = mysqli_query($conn, 
		"SELECT* FROM siswa WHERE 
		no_induk LIKE '%".$cari."%' or 
		nama_siswa LIKE '%".$cari."%' or 
		alamat_siswa LIKE '%".$cari."%' or 
		no_hp LIKE '%".$cari."%' or
		kelas LIKE '%".$cari."%'");
	}
	while($data =mysqli_fetch_array($query)){
	?>
	<tr>
		<td><?php echo $data["no_induk"]; ?></td>
		<td><?php echo $data["nama_siswa"]; ?></td>
		<td><?php echo $data['alamat_siswa']; ?></td>
        <td><?php echo $data['no_hp']; ?></td>                
		<td><?php echo $data['kelas']; ?></td>
		<td>
            <a href="siswa.php?aksi=update&no_induk=<?php echo $data['no_induk']; ?>&nama_siswa=<?php echo $data['nama_siswa']; ?>&alamat_siswa=<?php echo $data['alamat_siswa']; ?>&no_hp=<?php echo $data['no_hp']; ?>&kelas=<?php echo $data['kelas']; ?>">Ubah</a>
            <a href="siswa.php?aksi=delete&no_induk=<?php echo $data['no_induk']; ?>">Hapus</a>
        </td>
	</tr>
	<?php } 
	?>
</table>

	<?php
}
function tampil_data($conn){
    $sql = "SELECT * FROM siswa";
    $query = mysqli_query($conn, $sql);
    
    echo "<fieldset>";
    echo "<legend><h3>Data Siswa</h3></legend>";
    echo "<table border='1' cellpadding='5'>";
    echo "<tr>
            <th>No Induk</th>
            <th>Nama Siswa</th>
			<th>Alamat Siswa</th>
            <th>No Hp Siswa</th>
			<th>Kelas Siswa</th>
            <th>Action</th>
          </tr>";
    
    while($data = mysqli_fetch_array($query)){
        ?>
            <tr>
                <td><?php echo $data['no_induk']; ?></td>
                <td><?php echo $data['nama_siswa']; ?></td>
                <td><?php echo $data['alamat_siswa']; ?></td>
                <td><?php echo $data['no_hp']; ?></td>                
				<td><?php echo $data['kelas']; ?></td>
				<td>
                    <a href="siswa.php?aksi=update&no_induk=<?php echo $data['no_induk']; ?>&nama_siswa=<?php echo $data['nama_siswa']; ?>&alamat_siswa=<?php echo $data['alamat_siswa']; ?>&no_hp=<?php echo $data['no_hp']; ?>&kelas=<?php echo $data['kelas']; ?>">Ubah</a>
                    <a href="siswa.php?aksi=delete&no_induk=<?php echo $data['no_induk']; ?>">Hapus</a>
                </td>
            </tr>
        <?php
    }
    echo "</table>";
    echo "</fieldset>";
}
function ubah($conn){
    if(isset($_POST['btn_ubah'])){
		$no_induk = $_POST['no_induk'];
        $nama_siswa = $_POST['nama_siswa'];
        $alamat_siswa = $_POST['alamat_siswa'];
        $no_hp = $_POST['no_hp'];
        $kelas = $_POST['kelas'];
        
        if(!empty($no_induk)&&!empty($nama_siswa)&&!empty($alamat_siswa)&&!empty($no_hp)&&!empty($kelas)){
            $perubahan = "no_induk='".$no_induk."',nama_siswa='".$nama_siswa."',alamat_siswa='".$alamat_siswa."',no_hp='".$no_hp."',kelas='".$kelas."'";
            $sql_update = "UPDATE siswa SET ".$perubahan." WHERE no_induk=$no_induk";
            $update = mysqli_query($conn, $sql_update);
            if($update && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'update'){
                    header('location: siswa.php');
                }
            }
        }
    }
    if(isset($_GET['no_induk'])){
        ?>
            <a href="siswa.php"> &laquo; Kembali</a> | 
            <a href="siswa.php?aksi=create">Tambah Data</a>
            <hr>
            
            <form action="" method="POST">
            <fieldset>
                <legend><h2>Ubah data</h2></legend>
                <label>No Induk <input type="text" name="no_induk" value="<?php echo $_GET['no_induk'] ?> "/></label>
				<br><br>
				<label>Nama Siswa <input type="text" name="nama_siswa" value="<?php echo $_GET['nama_siswa'] ?> "/></label>
				<br><br>
				<label>Alamat Siswa <input type="text" name="alamat_siswa" value="<?php echo $_GET['alamat_siswa'] ?> "/></label>
				<br><br>
				<label>No Hp Siswa <input type="text" name="no_hp" value="<?php echo $_GET['no_hp'] ?> "/></label>
				<br><br>
				<label>Kelas Siswa <br>
				<input type="radio" id="10" name="kelas" value="10">
				<label for="10">10</label><br>
				<input type="radio" id="11" name="kelas" value="11">
				<label for="11">11</label><br>
				<input type="radio" id="12" name="kelas" value="12">
				<label for="12">12</label></label>
				<br><br>
                <label>
                    <input type="submit" name="btn_ubah" value="Simpan Perubahan"/> atau <a href="siswa.php?aksi=delete&no_induk=<?php echo $_GET['no_induk'] ?>"> (x) Hapus data ini</a>!
                </label>
                <br>
                <p><?php echo isset($pesan) ? $pesan : "" ?></p>
                
            </fieldset>
            </form>
        <?php
    }
    
}
function hapus($conn){
    if(isset($_GET['no_induk']) && isset($_GET['aksi'])){
        $no_induk = $_GET['no_induk'];
        $sql_hapus = "DELETE FROM siswa WHERE no_induk=" . $no_induk;
        $hapus = mysqli_query($conn, $sql_hapus);
        
        if($hapus){
            if($_GET['aksi'] == 'delete'){
                header('location: siswa.php');
            }
        }
    }
    
}
if (isset($_GET['aksi'])){
    switch($_GET['aksi']){
        case "create":
            echo '<a href="siswa.php"> &laquo; Home</a>';
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