<head>
<title> Home</title>
<script>
function siswa() {
  location.replace("siswa.php")
}
function pembayaran() {
  location.replace("pembayaran.php")
}
</script>
<style>
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
</head>
<body background = "diana.gif">
<center>
<td>
<h1><font face='Century Schoolbook' color='white' size='5'>MENU</font></h1>
</td>
<button class="button button1" type="submit" onclick="siswa()"><a href="siswa.php"><font face='Century Schoolbook' color='black' size='3'></a><b>Menu Siswa</b></button>
<button class="button button1" type="submit" onclick="pembayaran()"><a href="pembayaran.php"><font face='Century Schoolbook' color='black' size='3'></a><b>Menu Pembayaran</b></button>
</body>