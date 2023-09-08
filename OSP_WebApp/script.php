<?php
            $start = $_REQUEST["start"];
            $end = $_REQUEST["end"];

            $polaczenie=mysqli_connect("localhost","root","","straz")
            or die ("Nie mozna polaczyc z baza");

            $kwerenda=mysqli_query($polaczenie,"SET NAMES 'utf8'");

            $zapytanie="SELECT * FROM wyjazdy WHERE data BETWEEN '$start' AND '$end' ORDER BY data";
            //$zapytanie="SELECT * FROM wyjazdy ORDER BY data";
            $wynik=mysqli_query($polaczenie,$zapytanie);

            if(mysqli_num_rows($wynik) > 0){
            echo "<table>";
            echo "<tr><td>Data</td><td>Wyjazd</td><td>Przyjazd</td><td>Miejsce</td><td>Rodzaj</td><td>Kierowca</td><td>Dowódca</td><td>Strażak 1</td><td>Strażak 2</td><td>Strażak 3</td><td>Strażak 4</td><td>Pojazd</td><td>Dysponent</td></tr>";
            while($res=mysqli_fetch_array($wynik))
            {
                $ind=$res['id'];
                echo "<tr>";
                echo "<td>".$res['data']."</td><td>".$res['godz_wyjazdu']."</td><td>".$res['godz_powrotu']."</td><td>".$res['miejsce']."</td><td>".$res['rodzaj']."</td><td>".$res['strazak1']."</td><td>".$res['strazak2']."</td><td>".$res['strazak3']."</td><td>".$res['strazak4']."</td><td>".$res['strazak5']."</td><td>".$res['strazak6']."</td><td>".$res['auto']."</td><td>".$res['dysponent']."</td><td><a href='wyj_edit.php?ident=$ind'>Edytuj</a></td><td><a href='wyj_show.php?del=$ind'>Usuń</a></td>";
                echo "</tr>";
            }
            echo "</table>";
            }
            else{
                echo "<p id='res'>Brak danych dla podanego przedziału</p>";
            }

            if(!$wynik)
               echo "<p id='res'>Nie udało sie pobrać danych z bazy.</p>";
                
            mysqli_close($polaczenie);
?>