<html>
<head>
    <meta charset="utf-8" />
    <style>
        body{
            background-color: #403b3b;
        }
        #back{
            color: white;
            background-color: black;
            height: 8%;
            width: 16%;
            top: 25px;
            left: 25px;
            text-align: center; 
            position: absolute;
            border-radius: 50px;
        }
        #next{
            color: white;
            background-color: black;
            height: 8%;
            width: 16%;
            top: 25px;
            right: 25px;
            text-align: center; 
            position: absolute;
            border-radius: 50px;
        }   
        #jeden{
            text-align: center;
            font-family: "Comic Sans MS", cursive, sans-serif;
            font-size: 22px;
        }
        #dwa{
            text-align: center;
            font-size: 34px;
            font-family: "Comic Sans MS", cursive, sans-serif;
            color: white;
            margin-top: 3%;
        }
        table{
            font-family: "Comic Sans MS", cursive, sans-serif;
            border: 2px solid #000000;
            background-color: #4A4A4A;
            width: 100%;
            height: 200px;
            text-align: center;
            border-collapse: collapse;
        }
        tr:nth-child(1) td{
            font-size: 20px;
            font-weight: bold;
            color: #E6E6E6;
            text-align: center;
            border-left: 1px solid #4A4A4A;
        }
        td{
            border: 0px solid #4A4A4A;
            padding: 3px 2px;
        }
        tr:nth-child(even) {
            background: #777778;
        }
        tbody td {
            font-size: 14px;
            color: #E6E6E6;
        }
        a{
            color: white;
        }
    </style>
    <title>Aplikacja OSP - Strażacy</title>
</head>
<body>
    <a href="index.php">
        <div id="back">
            <p id="jeden">Powrót</p>
        </div>
    </a>
    <a href="str_add.php">
        <div id="next">
            <p id="jeden">Dodaj strażaka</p>
        </div>
    </a>
    <p id="dwa">LISTA STRAŻAKÓW OSP</p>
    <div id="dane">
        <?php
            $polaczenie=mysqli_connect("localhost","root","","straz")
            or die ("Nie mozna polaczyc z baza");

            $kwerenda=mysqli_query($polaczenie,"SET NAMES 'utf8'");

            if(!empty($_GET))
            {
                $del=$_GET["del"];
                $zapytanie2="DELETE FROM strazacy WHERE id = $del";
                $wynik2=mysqli_query($polaczenie,$zapytanie2);
            }

            $zapytanie="SELECT * FROM strazacy ORDER BY nazwisko";
            $wynik=mysqli_query($polaczenie,$zapytanie);

            echo "<table>";
            echo "<td>Imię</td><td>Nazwisko</td><td>Koniec badań</td>";
            while($res=mysqli_fetch_array($wynik))
            {
                $ind=$res['id'];
                echo "<tr>";
                echo "<td>".$res['imie']."</td><td>".$res['nazwisko']."</td><td>".$res['koniec_badan']."</td><td><a href='str_edit.php?ident=$ind'>Edytuj</a></td><td><a href='str_show.php?del=$ind'>Usuń</a></td>";
                echo "</tr>";
            }
            echo "</table>";

            if(!$wynik)
               echo "Nie udało sie pobrać danych z bazy.";
                
            mysqli_close($polaczenie);
        ?>
    </div>
</body>
</html>