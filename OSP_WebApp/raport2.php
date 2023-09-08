<html>
<head>
<meta charset="UTF-8"/>
<style>
#druk{
    display: none;
}
</style>
<script src="//cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
</head>
<body>

<img src="tlo2.jpg" id="druk">

<canvas id="plotno" width="3308" height="4680">
</canvas>
<br>
<button id="download">Pobierz Raport</button>

<?php
    $id = $_GET['rap'];
    $polaczenie = mysqli_connect("localhost","root","","straz") or die ("Nie mozna polaczyc z baza");
    $kwerenda = mysqli_query($polaczenie,"SET NAMES 'utf8'");
    $zapytanie = "SELECT * FROM wyjazdy WHERE id = $id";
    $wynik = mysqli_query($polaczenie,$zapytanie);    

    while($res = mysqli_fetch_array($wynik))
    {
        $data = $res['data']; 
        $rodzaj = $res['rodzaj'];
        $auto = $res['auto'];
        $miejsce = $res['miejsce'];
        $dysponent = $res['dysponent'];
    }
?>

<script charset="utf-8">

    var canvas = document.getElementById("plotno");
    var ctx = canvas.getContext("2d");

    var druk = document.getElementById("druk");
    ctx.drawImage(druk,0,0)

    var data = "<?php echo $data ?>";
    var rodzaj = "<?php echo $rodzaj ?>";
    var auto = "<?php echo $auto ?>";
    var miejsce = "<?php echo $miejsce ?>";
    var dysponent = "<?php echo $dysponent ?>";
    ctx.font = "60px Arial";
    ctx.fillStyle = "#060e70";
    ctx.fillText(data, 1060, 1260);
    ctx.fillText(rodzaj, 515, 1530);
    ctx.fillText(auto, 2040, 1970);
    ctx.fillText(miejsce, 2120, 1250);
    ctx.lineWidth = 6;
    ctx.strokeStyle = '#060e70';
    switch(dysponent)
    {
        case "PSP":
        ctx.moveTo(505,1825);
        ctx.lineTo(1815,1825);
        ctx.moveTo(1580,1085);
        ctx.lineTo(2045,1085);
        ctx.moveTo(1100,1745);
        ctx.lineTo(1350,1745);

        break;
        case "GMINA":
        ctx.fillText(data, 1590, 1100);
        ctx.moveTo(505,1745);
        ctx.lineTo(2705,1745);
        break;
    }

    ctx.stroke();
    
    //download.addEventListener("click", function() {
    var imgData = canvas.toDataURL("image/jpeg", 1.0);
    var pdf = new jsPDF('p', 'mm', [900, 1220]);

    pdf.addImage(imgData, 'JPEG', 0, 0);
    pdf.save("raport_strona1.pdf");
    //}, false);

    window.location.href = "http://localhost/pwjsv2/dokumenty.php";

</script>

</body>
</html>