<?php 
session_start();
if (isset($_SESSION["user"])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş yapma sayfası</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h5>Giriş yapma formu</h5><br>
        <?php 
        if(isset($_POST["login"])){
            $username = $_POST["username"];
            $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE username = '$username'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if($user){
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: index.php");
                    die();
                }
                else{
                    echo "<div class='alert alert-danger'>Kullanıcı şifresi yanlış. Lütfen tekrar deneyiniz.</div>";
                }
            }
            else{
                echo "<div class='alert alert-danger'>Kullanıcı adı mevcut değil.</div>";
            }
        }
        
        
        
        
        
        ?>
        <form action="login.php" method="post">
            <div class="from-group">
                <label for="username">Kullanıcı adınız:</label><br>
                <input type="text" class="form-control" name="username" placeholder="Kullanıcı adınız"><br>
            </div>
            <div class="form-group">
                <label for="password">Şifreniz:</label><br>
                <input type="password" class="form-control" name="password" placeholder="Şifreniz"><br>
            </div>
            <div class="form-btn">
                <input type="reset" style="background-color: blue; color: white" class="btn btn.primary" name="reset" value="Formu temizle">
                <input type="submit" style="background-color: blue; color: white" class="btn btn.primary" name="login" value="Giriş yap"><br><br><br>
                <label for="giris">Kayıtlı değil misiniz? O zaman aşağıdaki butona tıklayarak kayıt olabilirsiniz:</label><br><br>
                <a href="registration.php" class="btn btn-warning" name="giris" style="background-color: blue; color: white">Kaydol</a>
            </div>
        </form>
    </div>
    
</body>
</html>