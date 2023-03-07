<?php $conn = new PDO("mysql:host=localhost;dbname=students;", "root", ""); ?>
<?php 
session_start();
if (isset($_POST['submit'])) {
    $admin = $conn -> prepare("SELECT * FROM user WHERE username = :username AND password = :password");
    $admin -> bindParam("username", $_POST['username']);
    $admin -> bindParam("password", $_POST['password']);
    $admin -> execute();
    if ($admin -> rowCount() === 1) {
        $user = $admin -> fetchObject();
        $_SESSION['user'] = $user;
        if ($user -> admin == "Directeur") {
            header("location: ./student.php", true);
        }
    }
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="./login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
<body style="background: #545050">
    <div class="form">
        <h1>login</h1>
        <p style="color: white;">default username = Mr_AhmedEssa & password = mrahmedessa</p>
        <form method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" style="color: white" class="form-label">username</label>
                <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" style="color: white" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>