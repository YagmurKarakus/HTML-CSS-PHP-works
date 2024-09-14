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
    <title>Kayıt olma sayfası</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h5>Kayıt olma formu</h5><br>
        <?php 
        if (isset($_POST["submit"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $repeatedPassword = $_POST["repeat_password"];

            #encryption:
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            #hataları kullanıcılara gösterebilmek için:
            $errors = array();

            if(empty($username) OR empty($password) OR empty($repeatedPassword)){
                array_push($errors,"Bütün alanları doldurmanız gereklidir.");
            }
            if (strlen($password)<4) {
                array_push($errors,"Şifreniz en az 4 karakter uzunluğuna sahip olmalıdır.");
            }
            if($password!==$repeatedPassword){
                array_push($errors,"Şifreler eşleşmedi. Doğru yazarak tekrar deneyiniz.");
            }

            require_once "database.php";
            $sql = "SELECT * FROM users WHERE username = '$username'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if ($rowCount>0) {
                array_push($errors,"Kullanıcı adı zaten kayıtlı bulunmaktadır.");
            }

            #hata yoksa db'ye verileri gönderebiliriz:
            if(count($errors)>0){
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            }
            else{
                #database'e verileri gönder
                $sql = "INSERT INTO users(username, password) VALUES(?, ?)";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                if($prepareStmt){
                    mysqli_stmt_bind_param($stmt,"ss", $username, $passwordHash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>Kaydınız başarılı bir şekilde gerçekleşmiştir.</div>";

                }
                else{
                    die("Bir hata oluştu. Lütfen tekrar deneyiniz.");
                }
            }



        }
        ?>
        <form action="registration.php" method="post">
            <div class="form group">
                <label for="username">Kullanıcı adınız:</label><br>
                <input type="text" class="form-control" name="username" placeholder="Kullanıcı adınız" required><br>
            </div>
            <div class="form group">
                <label for="password">Lütfen bir şifre belirleyiniz:</label><br>
                <input type="password" class="form-control" name="password" placeholder="Şifreniz"><br>
            </div>
            <div class="form group">
                <label for="repeatpassword">Aynı şifreyi tekrar giriniz:</label><br>
                <input type="password" class="form-control" name="repeat_password" placeholder="Şifreniz"><br>
            </div>
            <div class="form-btn">
                <input type="reset" style="background-color: blue; color: white" class="btn btn.primary" name="reset" value="Formu temizle">
                <input type="submit" style="background-color: blue; color: white" class="btn btn.primary" name="submit" value="Kaydol"><br><br><br>
                <label for="cikis">Zaten kayıtlı mısınız? O zaman aşağıdaki butona tıklayarak giriş yapabilirsiniz:</label><br><br>
                <a href="login.php" class="btn btn-warning" name="cikis" style="background-color: blue; color: white">Giriş yap</a>
            </div>
        </form>
    </div>
</body>
</html>




