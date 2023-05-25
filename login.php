<?php

require "dbBroker.php";
require "model/ucitelj.php";
require "model/ucenik.php";
require "model/cas.php";



session_start();


if (isset($_POST['submit'])) {

  $u = $_POST['username'];
  $p = $_POST['password'];

  Cas::ocisti($conn);

  $result = Ucitelj::login($u, $p, $conn);

  if ($result->num_rows != 0) {
    echo "<script>alert('Uspesno ste se prijavili kao ucitelj!');</script>";
    $_SESSION['ucitelj'] = $u;
    header("Location: homeUcitelj.php");
    exit();

  } else {
    $result = Ucenik::login($u, $p, $conn);

    if ($result->num_rows != 0) {
      echo "<script>alert('Uspesno ste se prijavili kao ucenik!');</script>";
      $_SESSION['ucenik'] = $u;
      $_SESSION['ime'] = Ucenik::vratiIme($u, $conn);
      header("Location: index.php");
      exit();
    } else {
      echo "<script>alert('Netacno ime ili lozinka');</script>";

    }

  }


}

?>

<!DOCTYPE html>

<html>

<head>
  <title>Академија Оксфорд</title>
  <style>
    body {
      background-color: chocolate;
    }

    .form-group {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
    }

    .form-group label {
      width: 120px;
      margin-right: 10px;
    }

    .form-group button {
      margin-left: auto;
    }


    .login-container {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
      position: relative;
      top: 20%;
    }


    form {
      display: flex;
      align-items: center;
    }


    h1 {
      font-size: 72px;
      margin-right: 20px;
      color: white;
    }


    h1::after {
      content: "→";
      font-size: 72px;
      margin-left: 5px;
      animation: blink 1s infinite;
      color: white;
    }

    @keyframes blink {
      0% {
        opacity: 1;
      }

      50% {
        opacity: 0;
      }

      100% {
        opacity: 1;
      }
    }

    input[type="text"],
    input[type="password"],
    button {
      padding: 12px 20px;
      margin: 8px 0;
      width: 200px;
      display: inline-block;
      border: none;
      box-sizing: border-box;
      background-color: bisque;/ color: white;
    }

    img {
      width: 50%;
      display: block;
      margin: 0 auto;
      margin-top: 20px;
    }

    label {
      color: white;
    }
  </style>
</head>

<body>
  <div class="login-container">
    <img src="oxford.jpg" alt="logo">
    <form method="POST">
      <h1>Пријавите се овде</h1>
      <div class="form-container">
        <div class="form-group">
          <label for="username">Корисничко име:</label>
          <input type="text" id="username" name="username">
        </div>
        <div class="form-group">
          <label for="password">Лозинка:</label>
          <input type="password" id="password" name="password">
        </div>
        <div class="form-group">
          <button name="submit" type="submit">Пријавите се</button>
        </div>
      </div>
    </form>
    <!-- </div>
    <div style="text-align: center; margin-top: -8%; color:white;">
  <span>Nemas nalog? <a href="domaci/register.php" style="text-decoration: underline; color: white">Registruj se</a></span>
</div> -->

    <div class="card-footer" style="text-align: center; color:white;">
      <div class="d-flex justify-content-center links">
        Нисте регистровани? <a href="register.php" style="color: white">Региструјте се</a>
      </div>

    </div>
</body>

</html>