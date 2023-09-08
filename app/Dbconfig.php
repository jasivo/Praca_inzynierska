<?php    
    $data = $_POST["data"];    
    $wyjazd = $_POST["wyjazd"];
    $powrot = $_POST["powrot"];    
    $miejsce = $_POST["miejsce"];    
    $pojazd = $_POST["pojazd"];
    $rodzaj = $_POST["rodzaj"];
    $kierowca = $_POST["kierowca"];    
    $dowodca = $_POST["dowodca"];    
    $ratownik1 = $_POST["ratownik1"];    
    $ratownik2 = $_POST["ratownik2"];    
    $ratownik3 = $_POST["ratownik3"];    
    $ratownik4 = $_POST["ratownik4"];
    $dysponent = $_POST["dysponent"];

    $user = "root";    
    $password = "";    
    $host ="localhost";    
    $db_name ="straz";
    $con = mysqli_connect($host,$user,$password,$db_name);    
    $sql = "insert into wyjazdy (data,godz_wyjazdu,godz_powrotu,miejsce,rodzaj,strazak1,strazak2,strazak3,strazak4,strazak5,strazak6,auto,dysponent) values('$data','$wyjazd','$powrot','$miejsce','$rodzaj','$kierowca','$dowodca','$ratownik1','$ratownik2','$ratownik3','$ratownik4','$pojazd', '$dysponent')";

    if(mysqli_query($con,$sql))    
    {    
        echo "Data inserted successfully....";    
    }    
    else     
    {    
        echo "some error occured";    
    }    

    mysqli_close($con);    
?>    