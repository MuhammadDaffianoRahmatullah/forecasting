<?php

session_start();
 
require_once ("../sambung.php"); 

if (isset($_POST['hitung_es'])) {
  $nama_user_es = $_SESSION['username'];
  $mpb_es = $_POST['mpb_es'];
  $waat_real_es = $_POST['waat_real_es'];
  $waat_fore_es = $_POST['waat_fore_es'];

  $ESkurang = 1 - 0.1;
  $ES = 0.1 * $waat_real_es + $ESkurang * $waat_fore_es;

  //$kwh = $ES / 1000;
  if ($mpb_es == 900) {
      $token_es = $ES * 1352;
  } elseif ($mpb_es == 1300 || $mpb_es == 2200 || $mpb_es == 3500 || $mpb_es == 5500 || $mpb_es == 6600) {
      $token_es = $ES *1444;
  } 
  //$token_es = $exp * 30;

  $sql_es = "INSERT INTO exponential_smoothing (nama_user_es, mpb_es, waat_real_es, waat_fore_es, hasil_es, token_es) 
  VALUES ('$nama_user_es', '$mpb_es', '$waat_real_es', '$waat_fore_es', '$ES', '$token_es')";
  mysqli_query($konek, $sql_es);

  header("Location: home.php");

}

 ?> 

<!DOCTYPE html>
<html>
<head>
  <title>Exponential Smoothing</title>
  <link rel="shortcut icon" type="image/x-icon" href="img/logo.jpg">
  <link rel="icon" type="image/x-icon" href="img/logo.jpg">
  <link rel="stylesheet" type="text/css" href="../css/style2.css">
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="badan">
  <header>
    <?php 
    echo "<h1>Hai, ".$_SESSION['username']."<br>";
    echo "<h1>Ini Halaman Implementasi Exponential Smoothing</h1>"; 
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
    <h1>Exponential Smoothing</h1>
    <form action="" method="post">
      <label>Kampasitas meter prabayar : </label>
      <input type="radio" name="mpb_es" value="900"><label class="pilih">900 VA</label>
      <input type="radio" name="mpb_es" value="1300"><label class="pilih">1300 VA</label>
      <input type="radio" name="mpb_es" value="2200"><label>2200 VA</label>
      <input type="radio" name="mpb_es" value="3500"><label>3500 VA</label>
      <input type="radio" name="mpb_es" value="5500"><label>5500 VA</label>
      <input type="radio" name="mpb_es" value="6600"><label>6600 VA </label>
      <label>Total pemakaian listrik 1 bulan sebelumnya (kWh) : </label>
      <input type="decimal" id="waat_real_es" name="waat_real_es">
      <label>Hasil prediksi 1 bulan sebelumnya (kWh) : </label>
      <input type="decimal" id="waat_fore_es" name="waat_fore_es">
      <input type="submit" class="button" name="hitung_es" value="hitung prediksi">
    </form>
  </div>
</body>
<center><footer>copyright</footer></center>
<center><footer>Muhammad Daffiano Rahmatullah-1900018081</footer></center>
<center><footer>est 2023</footer></center>
</html>