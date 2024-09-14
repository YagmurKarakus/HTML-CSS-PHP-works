<?php 
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Paneli</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Hoşgeldiniz.</h1>
        <h4>Yaptığım bazı çizimleri buraya koydum. Umarım beğenirsiniz :)</h4><br>
        <a href="logout.php" class="btn btn-warning" style="background-color: blue; color: white">Çıkış yap</a><br><br>
        <img src="images/klausflouride.jpg" alt="Klaus Flouride" width="359px" height="450px"><br><p><b>Klaus Flouride</b> (23 Haziran 2024)</p><br><br>
        <img src="images/jellobiafra.jpg" alt="Jello Biafra" width="450px" height="394px"><br><p><b>Jello Biafra</b> (2 Haziran 2024)</p><br><br>
        <img src="images/terrortwins.jpg" alt="Terror Twins" width="350px" height="437px"><br><p><b>Steve Clark & Phil Collen</b> (6 Mayıs 2024)</p><br><br>
        <img src="images/joeelliott.jpg" alt="Joe Elliott" width="450px" height="562px"><br><p><b>Joe Elliott</b> (20 Mart 2024)</p><br><br>
        <img src="images/philcollen.jpg" alt="Phil Collen" width="425px" height="532px"><br><p><b>Phil Collen</b> (1 Şubat 2024)</p><br><br>
        <img src="images/joeelliott2.jpg" alt="Joe Elliott" width="420px" height="420px"><br><p><b>Joe Elliott</b> (26 Ocak 2024)</p><br><br>
        <img src="images/phillynott.jpg" alt="Phil Lynott" width="500px" height="381px"><br><p><b>Phil Lynott</b> (7 Şubat 2020)</p><br><br>
    </div>
</body>
</html>