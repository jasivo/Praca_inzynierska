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
            margin-top: 15px;
        }

        a{
            color: white;
        }
        
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #2196F3;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        .typ{
            font-size: 30px;
            display: inline-block;
            vertical-align: middle;
            padding-top: 35px;
            padding-right: 10px;
            padding-left: 10px;
        }

        #box{
            width: 60%;
            height: 35%;
            padding: 20px;
            align: center;
            background-color: #4A4A4A;
            margin: auto;
            border-radius: 15px;
            border: 2px solid #E6E6E6;
        }
    </style>
    <title>Aplikacja OSP - Dokumenty</title>
</head>
<body>
    <script>
        function reload(){
            var container = document.querySelector('#dane');
            var date1 = document.querySelector('#start').value;
            var date2 = document.querySelector('#end').value;
            var check = document.querySelector('#chk');
            if(check.checked)
                var type = 1;
            else
                var type = 0;
            
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("dane").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "script2.php?start=" + date1 + "&end=" + date2 + "&type=" + type, true);
            xmlhttp.send();
        }
    </script>
    <a href="index.php">
        <div id="back">
            <p id="jeden">Powrót</p>
        </div>
    </a>
    <p id="dwa">Raporty OSP</p>

    <div id="box">

        <div id="selector">
            Pokaż od: <input type="date" id="start" value="2017-01-01" onchange="reload()">
            do: <input type="date" id="end" onchange="reload()"></br>
            <p class='typ'>GENERUJ RAPORT</p>
            <label class="switch">
                <input type="checkbox" id="chk" onclick="reload()">
                <span class="slider round"></span>
            </label>
            <p class='typ'>GENERUJ KARTĘ</p>
            </br>
            </br>
        </div>

        <div id="dane">
            <script>
                document.getElementById('end').valueAsDate = new Date();
                reload();
            </script>
        </div>

    </div>

</body>
</html>