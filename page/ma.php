<?php 

session_start();

require_once ("../sambung.php");

if (isset($_POST['hitung_ma'])) {
  $nama_user_ma = $_SESSION['username'];
	$mpb_ma = $_POST['mpb_ma'];
	$waat1 = $_POST['waat1'];
	$waat2 = $_POST['waat2'];
	$waat3 = $_POST['waat3'];

	$sumMA = $waat1 + $waat2 + $waat3;
	$MA = $sumMA / 3;

  //$kwh = $MA / 1000;
    if ($mpb_ma == 900) {
        $token_ma = $MA * 1352;
    } elseif ($mpb_ma == 1300 || $mpb_ma == 2200 || $mpb_ma == 3500 || $mpb_ma == 5500 || $mpb_ma == 6600) {
        $token_ma = $MA *1444;
    } 
    //$token_ma = $exp * 30;

	$sql_ma = "INSERT INTO moving_average (nama_user_ma, mpb_ma, waat1, waat2, waat3, hasil_ma, token_ma) 
  VALUES ('$nama_user_ma', '$mpb_ma', '$waat1', '$waat2', '$waat3', '$MA', '$token_ma')";
	//$stmt = $konek->prepare($sql_ma);
	mysqli_query($konek, $sql_ma);

	header("Location: home.php");

} 

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Moving Average</title>
  <link rel="shortcut icon" type="image/x-icon" href="img/logo.jpg">
  <link rel="icon" type="image/x-icon" href="img/logo.jpg">
	<link rel="stylesheet" type="text/css" href="../css/style2.css">
</head>
<body class="badan">
  <header>
    <?php 
    echo "<h1>Hai, ".$_SESSION['username']."<br>";
    echo "<h1>Ini Halaman Implementasi Moving Average</h1>"; 
    ?>
  </header>
  <div class="menu">
    <ul>
      <li> <a href="home.php">Home</a> </li>
      <li> <a href="tutorial.php">Tutorial</a></li>
      <li class="dropdown"><a href="#">Forecasting/Prediksi</a>
        <ul class="isi-dropdown">
          <li> <a href="ma.php">Moving Average</a> </li>
          <li> <a href="es.php">Exponential Smoothing</a> </li>
        </ul>
      </li>
      <li><a href="uji.php">Pengujian Forecasting</a></li>
      <li><a href="">Kontak</a></li>
      <li><a href="logout.php">Log Out</a></li>
    </ul>
  </div>
<div class="center">
  <h1>Moving Average</h1>
  <form action="ma.php" method="post">
    <label>Kampasitas meter prabayar : </label>
    <input type="radio" name="mpb_ma" value="900"><label>900 VA</label>
    <input type="radio" name="mpb_ma" value="1300"><label>1300 VA</label>
    <input type="radio" name="mpb_ma" value="2200"><label>2200 VA</label>
    <input type="radio" name="mpb_ma" value="3500"><label>3500 VA</label>
    <input type="radio" name="mpb_ma" value="5500"><label>5500 VA</label>
    <input type="radio" name="mpb_ma" value="6600"><label>6600 VA </label>
    <label>Total pemakaian listrik 3 bulan sebelumnya (kWh) : </label>
    <input type="decimal(4,2)" id="waat1" name="waat1">
    <label>Total pemakaian listrik 2 bulan sebelumnya (kWh) : </label>
    <input type="decimal(4,2)" id="waat2" name="waat2">
    <label>Total pemakaian listrik 1 bulan sebelumnya (kWh) : </label>
    <input type="decimal(4,2)" id="waat3" name="waat3">
    <input type="submit" class="button" id="hitung_ma" name="hitung_ma" value="hitung prediksi">
  </form>
</div>
</body>
<center><footer>copyright</footer></center>
<center><footer>Muhammad Daffiano Rahmatullah-1900018081</footer></center>
<center><footer>est 2023</footer></center>
</html>