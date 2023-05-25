<?php

require "dbBroker.php";
require "model/cas.php";

session_start();

if(empty($_SESSION['ucitelj']) || $_SESSION['ucitelj'] == ''){
	header("Location: login.php");
	die();
}

$result = Cas::sveOdUcitelja($_SESSION['ucitelj'], $conn);

if(!$result){
	echo "Greska kod upita";
}

if($result->num_rows == 0){
	echo "Nema zakazanih casova";
	die();
}



?>

<!DOCTYPE html>
<html>
  <head>
    <title>Добродошао, учитељу</title>
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/homeUcitelj.js"></script>


    <style>
      table {
        width: 100%;
        border-collapse: collapse;
        text-align: center;
      }
      th, td {
        border: 1px solid #ddd;
        padding: 8px;
        background-color: white;
        color: black;
      }
      th {
        background-color: white;
        color: black;
      }

      button{
        background-color: white;
        color: black;
      }

      input[type="text"]{
        background-color: white;
        color: black;
      }

    </style>
  </head>
  <body>
    <h1 style="text-align: center">Листа часова</h1>
	<div>
  <label for="ime">Име:</label>
  <input type="text" id="ime" name="ime">
  <button id="filter-button" style="border: 1px solid white">Филтрирај</button>

</div>

    <table id="casovi-table">
      <tr style="color: black">
        <th>Датум</th>
        <th>Време</th>
        <th>Ученик</th>
      </tr>
      <?php while($row = $result->fetch_assoc()): ?>
        <tr style="color: white">
          <td><?= $row['datum'] ?></td>
          <td><?= $row['vreme'] ?></td>
          <td><?= $row['ime'] ?></td>
        </tr>
      <?php endwhile; ?>
    </table>
    <div style="text-align: center; margin-top: 20px;">
      <form action="logout.php" method="post">
        <button type="submit">Одјавите се</button>
      </form>
    </div>
  </body>
</html>