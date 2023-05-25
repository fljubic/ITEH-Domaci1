<?php

class Cas
{

    public $datum;
    public $vreme;
    public $ucitelj;
    public $ucenik;

    public function __construct($datum, $vreme, $ucitelj, $ucenik)
    {

        $this->datum = $datum;
        $this->vreme = $vreme;
        $this->ucitelj = $ucitelj;
        $this->ucenik = $ucenik;
    }

    public function dodaj(mysqli $conn)
    {
        if (self::jelSlobodno($this->datum, $this->vreme, $this->ucitelj, $conn)) {
            $query = "insert into cas (datum, vreme, ucitelj, ucenik) values ('$this->datum', $this->vreme, '$this->ucitelj', '$this->ucenik');";
            return $conn->query($query);
        } else
            return false;
    }


    public static function jelSlobodno($datum, $vreme, $ucitelj, mysqli $conn)
    {
        $query = "SELECT COUNT(*)
    FROM cas 
    WHERE datum = '$datum' 
    AND vreme = $vreme 
    AND ucitelj = '$ucitelj';";
        $rezultat = $conn->query($query);
        if ($rezultat === false) {
            return false;
        }
        $count = $rezultat->fetch_row()[0];
        if ($count > 0)
            return false;
        return true;
    }


    public static function sveOdUcitelja($ucitelj, mysqli $conn)
    {
        $query = "SELECT cas.datum, cas.vreme, ucenik.ime
    FROM cas
    JOIN ucenik ON cas.ucenik = ucenik.username
    WHERE cas.ucitelj = '$ucitelj'
    ORDER BY cas.datum ASC;";
        return $conn->query($query);
    }

    public static function sveOdUciteljaFilter($ucitelj, mysqli $conn, $ime)
    {
        $query = "SELECT cas.datum, cas.vreme, ucenik.ime FROM cas
JOIN ucenik ON cas.ucenik = ucenik.username WHERE ucenik.ime LIKE '%$ime%' AND cas.ucitelj = '$ucitelj'; ";

        return $conn->query($query);
    }

    public static function sledecicas($ucenik, mysqli $conn)
    {
        $query = "SELECT cas.datum, cas.vreme, ucitelj.ime
            FROM cas
            JOIN ucitelj ON cas.ucitelj = ucitelj.username
            WHERE cas.ucenik = '$ucenik'
            ORDER BY cas.datum ASC
            LIMIT 1;";
        return $conn->query($query);

    }

    public static function otkazicas($ucitelj, $datum, $vreme, mysqli $conn)
    {
        $query = "DELETE FROM cas WHERE ucitelj = '$ucitelj' AND datum = '$datum' AND vreme = $vreme";
        return $conn->query($query);
    }

    public static function ocisti(mysqli $conn)
    {
        $current_date = date('Y-m-d');
        $query = "DELETE FROM cas WHERE datum < '$current_date'";
        $conn->query($query);
    }

    // public function otkazicas(mysqli $conn) {
//     $query = "DELETE FROM cas WHERE ucitelj = '$this->ucitelj' AND datum = '$this->datum' AND vreme = $this->vreme";
//     return $conn->query($query);
// }





}




?>