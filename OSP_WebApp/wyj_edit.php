<html>
<head>
    <meta charset="UTF-8"/>
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
        #dane{
            width:40%;
            height:50%;
            text-align:center;
            position: absolute;
            top:20%;
            left:30%;
            color:white;
            font-size:22px;
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
    </style>
    <title>Aplikacja OSP - Edytuj wyjazd</title>
</head>
<body>
    <a href="wyj_show.php">
        <div id="back">
            <p id="jeden">Powrót</p>
        </div>
    </a>
    <p id="dwa">Edytuj Wyjazd</p>
    <div id="dane">
        <?php
            $ind=$_GET["ident"];
            
            function strazak(){
                $polaczenie2=mysqli_connect("localhost","root","","straz")
                or die ("Nie mozna polaczyc z baza");
                $kwerenda2=mysqli_query($polaczenie2,"SET NAMES 'utf8'");
                $zapytanie2="SELECT imie, nazwisko FROM strazacy ORDER BY nazwisko";
                $wynik2=mysqli_query($polaczenie2,$zapytanie2);
                while($res2=mysqli_fetch_array($wynik2))
                {
                    $name2=$res2["imie"]." ".$res2["nazwisko"];
                    echo "<option value='$name2'>$name2</option>";
                }
            }

            $polaczenie=mysqli_connect("localhost","root","","straz")
            or die ("Nie mozna polaczyc z baza");

            $kwerenda=mysqli_query($polaczenie,"SET NAMES 'utf8'");

            $zapytanie="SELECT * FROM wyjazdy WHERE id='$ind'";
            $wynik=mysqli_query($polaczenie,$zapytanie);
            echo "<form method='POST' action=''>";
            echo "<table>";
            while($res=mysqli_fetch_array($wynik))
            {
                echo "<tr>";
                echo "<td>Data: </td><td>".$res['data']."</td><td> <input type='date' name='data'></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Godzina wyjazdu: </td><td>".$res['godz_wyjazdu']."</td><td> <input type='time' name='gwyj'></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Godzina powrotu: </td><td>".$res['godz_powrotu']."</td><td> <input type='time' name='gpow'></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Miejscowość: </td><td>".$res['miejsce']."</td><td> <input type='text' name='miej' placeholder='np. Wrocław'></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Rodzaj: </td><td>".$res['rodzaj']."</td><td> <input type='text' name='rdz' placeholder='np. Pożar budynku'></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Kierowca: </td><td>".$res['strazak1']."</td><td> <select name='str1'>";
                echo "<option value=''>nie zmieniaj</option>";
                strazak();
                echo "</select></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Dowódca: </td><td>".$res['strazak2']."</td><td> <select name='str2'>";
                echo "<option value=''>nie zmieniaj</option>";
                strazak();
                echo "</select></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Strażak 1: </td><td>".$res['strazak3']."</td><td> <select name='str3'>";
                echo "<option value=''>nie zmieniaj</option>";
                strazak();
                echo "</select></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Strażak 2: </td><td>".$res['strazak4']."</td><td> <select name='str4'>";
                echo "<option value=''>nie zmieniaj</option>";
                strazak();
                echo "</select></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Strażak 3: </td><td>".$res['strazak5']."</td><td> <select name='str5'>";
                echo "<option value=''>nie zmieniaj</option>";
                strazak();
                echo "</select></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Strażak 4: </td><td>".$res['strazak6']."</td><td> <select name='str6'>";
                echo "<option value=''>nie zmieniaj</option>";
                strazak();
                echo "</select></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Pojazd: </td><td>".$res['auto']."</td><td> <select name='auto'><option value=''>nie zmieniaj</option><option value='Star M69'>Star M69</option><option value='Ford'>Ford Transit</option></select></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Dysponent: </td><td>".$res['dysponent']."</td><td><select name='dysponent'><option value=''>nie zmieniaj</option><option value='PSP'>PSP</option><option value='GMINA'>Wójt Gminy Kłodzko</option></select></td>";
                echo "</tr>";
            }
            echo "</table></br>";
            echo "<input type='submit' value='Edytuj'>";
            echo "</form>";
            ?>

            <?php
            if(!empty($_POST))
            {
                echo "<meta http-equiv='refresh' content='0'>";

                $data=$_POST["data"];
                $gwyj=$_POST["gwyj"];
                $gprz=$_POST["gpow"];
                $miejsce=$_POST["miej"];
                $rodzaj=$_POST["rdz"];
                $str1=$_POST["str1"];
                $str2=$_POST["str2"];
                $str3=$_POST["str3"];
                $str4=$_POST["str4"];
                $str5=$_POST["str5"];
                $str6=$_POST["str6"];
                $auto=$_POST["auto"];
                $dysponent=$_POST["dysponent"];
            
                $polaczenie3=mysqli_connect("localhost","root","","straz")
                or die ("Nie mozna polaczyc z baza");
    
                $wynik3="";
                if(!empty($data))
                    $wynik3.="data='$data',";
                if(!empty($gwyj))
                    $wynik3.="godz_wyjazdu='$gwyj',";
                if(!empty($gprz))
                    $wynik3.="godz_powrotu='$gprz',";
                if(!empty($miejsce))
                    $wynik3.="miejsce='$miejsce',";
                if(!empty($rodzaj))
                    $wynik3.="rodzaj='$rodzaj',";
                if(!empty($str1))
                    $wynik3.="strazak1='$str1',";
                if(!empty($str2))
                    $wynik3.="strazak2='$str2',";
                if(!empty($str3))
                    $wynik3.="strazak3='$str3',";
                if(!empty($str4))
                    $wynik3.="strazak4='$str4',";
                if(!empty($str5))
                    $wynik3.="strazak5='$str5',";
                if(!empty($str6))
                    $wynik3.="strazak6='$str6',";
                if(!empty($auto))
                    $wynik3.="auto='$auto',";
                if(!empty($dysponent))
                    $wynik3.="dysponent='$dysponent'";
        
                if(empty($dysponent))
                    $wynik3=rtrim($wynik3, ",");;

                $zapytanie3="UPDATE wyjazdy SET ".$wynik3." WHERE id='$ind'";

                $kwerenda3=mysqli_query($polaczenie3,"SET NAMES 'utf8'");
                $result=mysqli_query($polaczenie3,$zapytanie3);

                if($result)
                    echo "<script>alert('Udało się edytować wyjazd!')</script>";
                else
                    echo "<script>alert('Nie udało się edytować rekordu')</script>";
            }

        ?>
    </div>
</body>
</html>