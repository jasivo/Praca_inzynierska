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

<img src="tlo.jpg" id="druk">

<canvas id="plotno" width="4680" height="3308">
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
    // Zmiana 25.06.2020 // Dodanie raportów z wyjazdu na przestrzeni dwóch dni ( przed 24 i po 24)
    if(intval((strtotime($przyjazd)-strtotime($wyjazd))) < 0)
    {
        $dateDiff1 = intval(strtotime("24:00:00")-strtotime($wyjazd))/60;
        $dateDiff2 = intval(strtotime($przyjazd)-strtotime("00:00:00"))/60;
        $dateDiff = intval(($dateDiff1+$dateDiff2));
    }
    else
        $dateDiff = intval((strtotime($przyjazd)-strtotime($wyjazd)))/60;
    //
    $hours = intval($dateDiff/60);
    $minutes = $dateDiff%60;
?>

<script charset="utf-8">

    var canvas = document.getElementById("plotno");
    var ctx = canvas.getContext("2d");

    var druk = document.getElementById("druk");
    ctx.drawImage(druk,0,0)

    var data = "<?php echo $data ?>";
    ctx.font = "53px Arial";
    ctx.fillStyle = "#060e70";
    ctx.fillText(data, 1285, 600);
    ctx.fillText(data, 4033, 1320);

    var str = <?php echo $js_strazacy ?>;
    var czas_wyjazdu = "<?php echo $wyjazd ?>";
    var czas_przyjazdu ="<?php echo $przyjazd ?>";
    var godziny = <?php echo $hours ?>;
    var minuty = <?php echo $minutes ?>;
    for(var i=0;i<str.length;i++){
        ctx.fillText(str[i], 360, (i*155)+1650);
	if(godziny>0)
	{
        	ctx.fillText(czas_wyjazdu.substr(0,5)+" - "+czas_przyjazdu.substr(0,5), 1220, (i*155)+1650);
        	ctx.fillText(godziny+"h "+minuty+"min", 1650, (i*155)+1650);
	}
	else
	{
        	ctx.fillText(czas_wyjazdu.substr(0,5)+" - "+czas_przyjazdu.substr(0,5), 1220, (i*155)+1650);
        	ctx.fillText(minuty+"min", 1650, (i*155)+1650);
	}
    }

    var godziny_calkowite = godziny*str.length;
    var minuty_calkowite = minuty*str.length;
    while(minuty_calkowite>=60)
    {
        minuty_calkowite-=60;
        godziny_calkowite++;
    }
    if(godziny_calkowite>0)
    	ctx.fillText(godziny_calkowite+"h "+minuty_calkowite+"min", 1650, 2750);
    else
	ctx.fillText(minuty_calkowite+"min", 1650, 2750);

    //download.addEventListener("click", function() {
    var imgData = canvas.toDataURL("image/jpeg", 1.0);
    var pdf = new jsPDF('l', 'mm', [1220, 900]);

    pdf.addImage(imgData, 'JPEG', 0, 0);
    pdf.save("raport_strona2.pdf");
    //}, false);

    var id = <?php echo $id ?>;
    window.location.href = "http://localhost/pwjsv2/raport2.php?rap="+id;

</script>

</body>
</html>