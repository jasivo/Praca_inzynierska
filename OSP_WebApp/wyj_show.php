<html>
<head>
    <meta charset="utf-8" />
    <style>
        body{
            background-color: #403b3b;
        }
        #dane{
            color:white;
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
        #res{
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
        #selector{
            text-align: center;
            font-size: 16px;
            font-family: "Comic Sans MS", cursive, sans-serif;
            color: white;
        }
        a{
            color: white;
        }
    </style>
    <title>Aplikacja OSP - Wyjazdy</title>
</head>
<body>
    <?php
        if(!empty($_GET))
        {
            $del=$_GET["del"];

            $polaczenie=mysqli_connect("localhost","root","","straz")
            or die ("Nie mozna polaczyc z baza");

            $kwerenda=mysqli_query($polaczenie,"SET NAMES 'utf8'");

            $zapytanie="DELETE FROM wyjazdy WHERE id = $del";
            $wynik=mysqli_query($polaczenie,$zapytanie);
        }
    ?>
    <script>
        function reload(){
            var container = document.querySelector('#dane');
            var date1 = document.querySelector('#start').value;
            var date2 = document.querySelector('#end').value;
            
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("dane").innerHTML = this.responseText;
                }
                else{
                    document.getElementById("dane").innerHTML = "Wystąpił błąd";
                }
            };
            xmlhttp.open("GET", "script.php?start=" + date1 + "&end=" + date2, true);
            xmlhttp.send();
        }
    </script>
    <a href="index.php">
        <div id="back">
            <p id="jeden">Powrót</p>
        </div>
    </a>
    <a href="wyj_add.php">
        <div id="next">
            <p id="jeden">Dodaj wyjazd</p>
        </div>
    </a>
    <p id="dwa">LISTA WYJAZDÓW OSP</p></br>
    <div id="selector">
    Pokaż od: <input type="date" id="start" value="2017-01-01" onchange="reload()">
    do: <input type="date" id="end" onchange="reload()">
    </br></br></br>
    </div>
    <div id="dane">
        <script>
            document.getElementById('end').valueAsDate = new Date();
            reload();
        </script>
    </div>
</body>
</html>