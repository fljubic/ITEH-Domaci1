<?php
require "dbBroker.php";
require "model/cas.php";
require "model/ucitelj.php";
session_start();


if (isset($_POST['submit'])) {
  $datum = $_POST['datum'];
  $vreme = $_POST['vreme'];
  $ucitelj = $_POST['ucitelj'];
  $ucenik = $_SESSION['ucenik'];

  if (empty($datum)) {
    echo "<script>alert('Molimo odaberite datum!');</script>";
  } else if (strtotime($datum) < strtotime('now')) {
    echo "<script>alert('Datum ne moze biti pre danasnjeg');</script>";
  } else if ($vreme > 22 || $vreme < 10) {
    echo "<script>alert('MOGUCE JE ZAKAZATI SAMO IZMEDJU 10 i 22');</script>";
  } else {
    if (Cas::jelSlobodno($datum, $vreme, $ucitelj, $conn)) {
      $cas = new Cas($datum, $vreme, $ucitelj, $ucenik);
      $cas->dodaj($conn);
      header("location: index.php");
    } else {
      echo "<script>alert('ZAUZET TERMIN, IZABERI NEKI DRUGI');</script>";
    }
  }
}


$ucitelji = Ucitelj::getAll($conn);
?>

<!DOCTYPE html>
<html>

<head>
  <title>Закажи час</title>
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <style>
    /* Centriranje forme */
    form {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    /* textfieldovi da budu na istoj osi */
    input[type="text"],
    input[type="date"],
    select {
      margin: 8px 0;
      width: 20%;
      height: 5%;
      font-size: 1.8em;
    }

    input[type="text"]#vreme {
      background-color: white;
    }

    /* Uvecanje fonta */
    label {
      font-size: 1.6em;
      font-weight: bold;
    }

    input[type="submit"] {
      font-size: 1.4em;
      background-color: saddlebrown;
    }
  </style>
</head>

<body>
  <form method="POST">
    <h1>Закажи час</h1>
    <label for="datum">Датум:</label>
    <input type="date" id="datum" name="datum">
    <br>
    <label for="vreme">Време:</label>
    <input type="text" id="vreme" name="vreme">
    <br>
    <label for="ucitelj">Учитељ:</label>
    <select id="ucitelj" name="ucitelj">
      <?php foreach ($ucitelji as $t) { ?>
        <option value="<?php echo $t['username']; ?>"><?php echo $t['ime']; ?></option>
      <?php } ?>
    </select>
    <br>
    <input type="submit" name="submit" value="Закажи">
  </form>

  <div class="card-footer" style="text-align: center; color:white;">
    <div class="d-flex justify-content-center links">
      ПОВРАТАК <a href="index.php" style="color: white">НАЗАД</a>
    </div>
</body>

</html>