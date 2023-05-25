<?php

require "dbBroker.php";
require "model/cas.php";
require "model/ucenik.php";
require "model/ucitelj.php";

session_start();

if (empty($_SESSION['ucenik']) || $_SESSION['ucenik'] == '') {
  header("Location: login.php");
  die();
}

$ucn = $_SESSION['ucenik'];
$result = Cas::sledeciCas($_SESSION['ucenik'], $conn);

if (!$result) {
  echo "<script>alert('Greska kod upita');</script>";
}

if ($result->num_rows == 0) {
  // echo "<script>alert('Niste zakazali cas');</script>";
  // die();
}

$ucitelji = Ucitelj::getAll($conn);

if (!$ucitelji) {
  echo "<script>alert('Greska kod upita');</script>";
}

if ($ucitelji->num_rows == 0) {
  echo "<script>alert('Nema ucitelja');</script>";
}


?>

<!DOCTYPE html>
<html>

<head>
  <title>Академија Оксфорд</title>
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <style>
    
    body {
      background-color: chocolate;
    }

    .container {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
      position: relative;
      top: 20%;
    }

    
    img {
      width: 10%;
      
      display: block;
      margin: 0 auto;
      
      align-self: flex-start;
      
    }

    
    .text-block {
      background-color: saddlebrown;
      color: white;
      padding: 20px;
      margin: 20px;
      width: 60%;
    }
  </style>
</head>

<body>
  <div class="container">
    <img src="img/logo.jpg" alt="logo">
    <div class="text-block">
      <p>
        <?php echo date('Y-m-d H:i:s'); ?><br>Добродошли
        <?php echo $ucn; ?>!<br>Академија Оксфорд основана је 2008. године и од тада спроводи програме неформалног
        образовања, курсеве страних језика, стручна оспособљавања, преквалификације и доквалификације, преводилачке
        услуге судских тумача. Наши центри се налазе у преко 30 градова у Србији...<br>
        Закажите свој час одмах!
      </p>
      <table>
        <tr>
          <th>Датум</th>
          <th>Време</th>
          <th>Учитељ</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td>
              <?php echo $row['datum']; ?>
            </td>
            <td>
              <?php echo $row['vreme']; ?>
            </td>
            <td>
              <?php echo $row['ime']; ?>
            </td>
          </tr>
          <?php
        }
        ?>
      </table>
      <div class="btns">
        <form action="zakaziCas.php" method="get">
          <input type="submit" value="Закажи час">
        </form>
        <form action="listaucitelja.php" method="get">
          <input type="submit" value="Листа учитеља">
        </form>
      </div>
    </div>
    <style>
      table {
        width: 80%;
        margin: 0 auto;
        border-collapse: collapse;
      }

      th {
        background-color: #343541;
        color: white;
        padding: 10px;
        text-align: left;
      }

      td {
        background-color: #444654;
        color: white;
        padding: 10px;
      }

      button {
        background-color: #343541;
        color: white;
        padding: 10px 20px;
        margin: 10px 0;
        border: none;
        cursor: pointer;
      }

      button:hover {
        background-color: #444654;
      }

      .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
      }

      
      p {
        font-size: 1.6em;
        text-align: center;
        margin: 20px 0;
      }

      / .btns {
        display: flex;
        justify-content: center;
        background-color: white;
      }

      .btns a {
        color: black;
      }
    </style>
    <div class="card-footer" style="text-align: center; color:white;">
      <div class="d-flex justify-content-center links">
        <a href="logout.php" style="color: white">ИЗЛОГУЈТЕ СЕ</a>
      </div>

</body>

</html>