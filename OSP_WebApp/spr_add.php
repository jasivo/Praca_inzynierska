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
        
    </style>
    <title>Aplikacja OSP - Dodaj sprzęt</title>
</head>
<body>
    <a href="spr_show.php">
        <div id="back">
            <p id="jeden">Powrót</p>
        </div>
    </a>
    <p id="dwa">DODAJ SPRZĘT</p>
    <div id="dane">
        <form method="POST" action="">
            Rodzaj</br>
            <input type='text' name='rodzaj' placeholder='np. piła spalinowa'></br></br>
            Producent:</br>
            <input type='text' name='producent' placeholder='np. Stihl'></br></br>
            Model:</br>
            <input type='text' name='model' placeholder='np. MS 271'></br></br>
            Numer seryjny:</br>
            <input type='text' name='nr_seryjny' placeholder='Podaj numer seryjny'></br></br>
            Data końca przeglądu lub terminu przydatności:</br>
            <input type='date' name='koniec_przegladu'></br></br>
            <input type="submit" value="Dodaj">
        </form>
        <?php
        if(!empty($_POST))
        {
            $rodzaj=$_POST["rodzaj"];
            $producent=$_POST["producent"];
            $model=$_POST["model"];
            $nr_seryjny=$_POST["nr_seryjny"];
            $koniec_przegladu=$_POST["koniec_przegladu"];

            if($rodzaj && $koniec_przegladu)
            {
                $polaczenie=mysqli_connect("localhost","root","","straz")
                or die ("Nie mozna polaczyc z baza");

                $zapytanie="INSERT INTO sprzet SET rodzaj='$rodzaj', koniec_przegladu='$koniec_przegladu',";
                
                if(!empty($producent))
                    $zapytanie.="producent='$producent',";
                if(!empty($model))
                    $zapytanie.="model='$model',";
                if(!empty($nr_seryjny))
                    $zapytanie.="nr_seryjny='$nr_seryjny'";

                if(empty($nr_seryjny))
                    $zapytanie=rtrim($zapytanie, ",");;

                $kwerenda=mysqli_query($polaczenie,"SET NAMES 'utf8'");
                $wynik=mysqli_query($polaczenie,$zapytanie);

                if($wynik)
                    echo "Udało się dodać sprzęt do bazy!";
                else
                    echo "Nie udało się dodać rekordu";
            }
        }
        ?>
    </div>
</body>
</html>