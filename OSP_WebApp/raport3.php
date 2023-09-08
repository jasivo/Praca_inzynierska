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

<img src="kart_dz_rat_gas.jpg" id="druk">

<canvas id="plotno" width="1654" height="2339">
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
        $miejsce = $res['miejsce'];
        $wyjazd = $res['godz_wyjazdu'];
        $przyjazd = $res['godz_powrotu'];
        $strazacy = array();
        if($res['strazak1']!=null)
            array_push($strazacy,$res['strazak1']);
        if($res['strazak2']!=null)    
            array_push($strazacy,$res['strazak2']);
        if($res['strazak3']!=null)
            array_push($strazacy,$res['strazak3']);
        if($res['strazak4']!=null)
            array_push($strazacy,$res['strazak4']);
        if($res['strazak5']!=null)
            array_push($strazacy,$res['strazak5']);
        if($res['strazak6']!=null)
            array_push($strazacy,$res['strazak6']);
    }
    $js_strazacy = json_encode($strazacy);
?>

<script charset="utf-8">

    var canvas = document.getElementById("plotno");
    var ctx = canvas.getContext("2d");

    var druk = document.getElementById("druk");
    ctx.drawImage(druk,0,0)

    var data = "<?php echo $data ?>";
    var wyjazd = "<?php echo $wyjazd ?>";
    var przyjazd = "<?php echo $przyjazd ?>";
    var rodzaj = "<?php echo $rodzaj ?>";
    var miejsce = "<?php echo $miejsce ?>";
    var str = <?php echo $js_strazacy ?>;

    ctx.font = "38px Arial";
    ctx.fillStyle = "#060e70";
    ctx.fillText(data, 435, 317);
    ctx.fillText(wyjazd.substr(0,5), 550, 370);
    ctx.fillText(przyjazd.substr(0,5), 550, 427);
    ctx.fillText(rodzaj,510, 535)
    ctx.fillText(miejsce, 640, 708);
    for(var i=0;i<str.length;i++)
        ctx.fillText(str[i], 310, (i*78)+1070);

    
    
    //download.addEventListener("click", function() {
    var imgData = canvas.toDataURL("image/jpeg", 1.0);
    var pdf = new jsPDF('p', 'mm', [619, 438]);

    pdf.addImage(imgData, 'JPEG', 0, 0);
    pdf.save("karta_dzialan.pdf");
    //}, false);

    window.location.href = "http://localhost/pwjsv2/dokumenty.php";

</script>

</body>
</html>