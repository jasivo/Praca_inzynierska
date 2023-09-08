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
    <title>Aplikacja OSP - Dodaj strażaka</title>
</head>
<body>
    <a href="str_show.php">
        <div id="back">
            <p id="jeden">Powrót</p>
        </div>
    </a>
    <p id="dwa">DODAJ STRAŻAKA</p>
    <div id="dane">
        <form method="POST" action="">
            Imię</br>
            <input type='text' name='imie' placeholder='Wprowadź imię'></br></br>
            Nazwisko:</br>
            <input type='text' name='nazwisko' placeholder='Wprowadź nazwisko'></br></br>
            Data końca badań okresowych:</br>
            <input type='date' name='data'></br></br>
            <input type="submit" value="Dodaj">
        </form>
        <?php
        if(!empty($_POST))
        {
            $imie=$_POST["imie"];
            $nazwisko=$_POST["nazwisko"];
            $data=$_POST["data"];

            if($imie && $nazwisko)
            {
                $polaczenie=mysqli_connect("localhost","root","","straz")
                or die ("Nie mozna polaczyc z baza");

                if($data)
                    $zapytanie="INSERT INTO strazacy SET imie='$imie', nazwisko='$nazwisko', koniec_badan='$data'";
                else
                    $zapytanie="INSERT INTO strazacy SET imie='$imie', nazwisko='$nazwisko'";    

                $kwerenda=mysqli_query($polaczenie,"SET NAMES 'utf8'");
                $wynik=mysqli_query($polaczenie,$zapytanie);

                if($wynik)
                    echo "Udało się dodać strażaka do bazy!";
                else
                    echo "Nie udało się dodać rekordu";
            }
        }
        ?>
    </div>
</body>
</html>