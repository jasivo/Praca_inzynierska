<html>
<head>
    <meta charset="UTF-8"/>
    <style>
        body{
            background-color: #403b3b;
        }
        .big-box{
            position: absolute;
            width: 80%;
            height: 80%;
            top: 10%;
            left: 10%;
        }
        .small-box{
            position: absolute;
            width: 50%;
            height: 50%;
            border: 2px solid white;
            text-align: center;
        }
        #first{
            background-image: url('box1_1.png');
            background-size: 100% 100%;
            top: 0%;
            left: 0%;
        }
        #first:hover{
            background-image: url('box1_2.png');
        }
        #second{
            background-image: url('box2_1.png');
            background-size: 100% 100%;
            top: 0%;
            right: 0%;
        }
        #second:hover{
            background-image: url('box2_2.png');
        }
        #third{
            background-image: url('box3_1.png');
            background-size: 100% 100%;
            bottom: 0%;
            left: 0%;
        }
        #third:hover{
            background-image: url('box3_2.png');
        }
        #fourth{
            background-image: url('box4_1.png');
            background-size: 100% 100%;
            bottom: 0%;
            right: 0%;
        }
        #fourth:hover{
            background-image: url('box4_2.png');
        }
        .content{
            position: absolute;
            top: 15%;
            left: 10%;
            color: white;
            font-weight: bold;
            font-size: 32px;
            text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -2px black;
        }
    </style>
    <title>Aplikacja OSP</title>
</head>
<body>
    <div class="big-box">
        <a href="str_show.php">
            <div class="small-box" id="first">
                <p class="content">Strażacy</p>
            </div>
        </a>
        <a href="wyj_show.php">
            <div class="small-box" id="second">
                <p class="content">Wyjazdy</p>
            </div>
        </a>
        <a href="dokumenty.php">
            <div class="small-box" id="third">
                <p class="content">Dokumenty</p>
            </div>
        </a>
        <a href="spr_show.php">
            <div class="small-box" id="fourth">
                <p class="content">Sprzęt</p>
            </div>
        </a>
    </div>
        <?php
            
            $result = "";
            $polaczenie=mysqli_connect("localhost","root","","straz")
            or die ("Nie mozna polaczyc z baza");

            $kwerenda=mysqli_query($polaczenie,"SET NAMES 'utf8'");

            $zapytanie="SELECT rodzaj, model, koniec_przegladu FROM sprzet WHERE koniec_przegladu BETWEEN curdate() AND curdate() + INTERVAL 3 MONTH OR koniec_przegladu <= CURRENT_DATE() ORDER BY 'rodzaj'";
            $wynik=mysqli_query($polaczenie,$zapytanie);

            if(mysqli_num_rows($wynik) != 0)
            { 
                $result .= 'Należy wykonać przegląd:\n';
                while($res=mysqli_fetch_array($wynik))
                    $result .= $res['rodzaj'].' '.$res['model'].'\n'.$res['koniec_przegladu'].'\n';
                $result .= '\n';
            }

            $zapytanie2="SELECT imie, nazwisko, koniec_badan FROM strazacy WHERE koniec_badan BETWEEN curdate() AND curdate() + INTERVAL 3 MONTH OR koniec_badan <= CURRENT_DATE() ORDER BY nazwisko";
            $wynik2=mysqli_query($polaczenie,$zapytanie2);

            if(mysqli_num_rows($wynik2) != 0)
            { 
                $result .= 'Należy wykonać badania:\n';
                while($res=mysqli_fetch_array($wynik2))
                {
                    $result .= $res['imie'].' '.$res['nazwisko'].'\n'.$res['koniec_badan'].'\n';
                }
            }

            if((mysqli_num_rows($wynik) != 0) || (mysqli_num_rows($wynik2) != 0))
                echo "<script>alert('".$result."')</script>";

            mysqli_close($polaczenie);

        ?>
</body>
</html>