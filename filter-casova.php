<?php
require "dbBroker.php";
require "model/cas.php";

session_start();
$ime = $_POST['ime'];

$ucitelj = $_SESSION['ucitelj'];

$result = Cas::sveOdUciteljaFilter($ucitelj, $conn, $ime);




if(!$result){
    echo "Грешка код упита";
}

if($result->num_rows == 0){
    echo "Нема заказаних часова";
    die();
}

?>

<tr>
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
