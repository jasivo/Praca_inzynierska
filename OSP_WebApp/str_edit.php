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
    <title>Aplikacja OSP - Edytuj strażaka</title>
</head>
<body>
    <a href="str_show.php">
        <div id="back">
            <p id="jeden">Powrót</p>
        </div>
    </a>
    <p id="dwa">Edytuj Strażaka</p>
    <div id="dane">
        <?php
            $ind=$_GET["ident"];

            $polaczenie=mysqli_connect("localhost","root","","straz")
            or die ("Nie mozna polaczyc z baza");

            $kwerenda=mysqli_query($polaczenie,"SET NAMES 'utf8'");

            $zapytanie="SELECT * FROM strazacy WHERE id='$ind'";
            $wynik=mysqli_query($polaczenie,$zapytanie);
            echo "<form method='POST' action=''>";
            echo "<table>";
            while($res=mysqli_fetch_array($wynik))
            {
                echo "<tr>";
                echo "<td>Imię: </td><td>".$res['imie']."</td><td> <input type='text' name='imie' placeholder='Wprowadź imię'></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Nazwisko: </td><td>".$res['nazwisko']."</td><td> <input type='text' name='nazw' placeholder='Wprowadź nazwisko'></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Koniec badań: </td><td>".$res['koniec_badan']."</td><td> <input type='date' name='data'></td>";
                echo "</tr>";
            }
            echo "</table></br>";
            echo "<input type='submit' value='Edytuj'>";
            echo "</form>";

            if(!empty($_POST))
            {
                echo "<meta http-equiv='refresh' content='0'>";

                $nowe_imie=$_POST["imie"];
                $nowe_nazwisko=$_POST["nazw"];
                $nowa_data=$_POST["data"];
            
                $polaczenie2=mysqli_connect("localhost","root","","straz")
                or die ("Nie mozna polaczyc z baza");
    
                $wynik2="";
                if(!empty($nowe_imie))
                    $wynik2.="imie='$nowe_imie',";
                if(!empty($nowe_nazwisko))
                    $wynik2.="nazwisko='$nowe_nazwisko',";
                if(!empty($nowa_data))
                    $wynik2.="koniec_badan='$nowa_data'";
        
                if(empty($nowa_data))
                    $wynik2=rtrim($wynik2, ",");;

                $zapytanie2="UPDATE strazacy SET ".$wynik2." WHERE id='$ind'";

                $kwerenda2=mysqli_query($polaczenie2,"SET NAMES 'utf8'");
                $result=mysqli_query($polaczenie2,$zapytanie2);

                if($result)
                    echo "<script>alert('Udało się edytować strażaka!')</script>";
                else
                    echo "<script>alert('Nie udało się edytować rekordu')</script>";
            }

        ?>
    </div>
</body>
</html>