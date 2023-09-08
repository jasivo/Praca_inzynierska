<?php
            $start = $_REQUEST["start"];
            $end = $_REQUEST["end"];
            $type = $_REQUEST["type"];

            $polaczenie=mysqli_connect("localhost","root","","straz")
            or die ("Nie mozna polaczyc z baza");

            $kwerenda=mysqli_query($polaczenie,"SET NAMES 'utf8'");

            //$zapytanie="SELECT * FROM wyjazdy WHERE data > '2022-07-01' ORDER BY data";

            $zapytanie="SELECT * FROM wyjazdy WHERE data BETWEEN '$start' AND '$end' ORDER BY data";

                $wynik=mysqli_query($polaczenie,$zapytanie);
                echo "<div id='content' align='center'>";
                if($type == 0)
                    echo "<form method='get' action='raport.php'>";
                else
                    echo "<form method='get' action='raport3.php'>";
                echo "<select name='rap'>";       
                while($res=mysqli_fetch_array($wynik))
                {
                    $ind=$res['id'];
                    echo "<option value='$ind'>";
                    echo $res['data']." ".$res['rodzaj'];
                    echo "</option>";
                }
                echo "</select></br></br></br></br>";
                echo "<input type='submit' value='Generuj dokument'>";
                echo "</form>";
                echo "</div>";

                if(!$wynik)
                echo "<p id='res'>Nie udało sie pobrać danych z bazy.</p>";
    
                mysqli_close($polaczenie);         
?>