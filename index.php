<?php $conn = new PDO("mysql:host=localhost;dbname=students;", "root", ""); ob_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student manager</title>
    <link rel="stylesheet" href="./index.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="icon" href="./assets/profile.png">
</head>
<body>
    <div class="student-manager">
        <aside class="Director-Panel">
            <div class="logo"></div>
            <div  style="display: flex; justify-content: center; align-items: center; width: 100%">
                <h1 class="director-panel" style="border-right: none;">mr <?php 
                session_start();
                if (isset($_SESSION['user'])) {
                    if ($_SESSION['user'] -> admin = "Directeur") {
                        echo $_SESSION['user'] -> firstname. " " .$_SESSION['user'] -> lastname;
                    }
                }
                
                ?></h1>
                <a href="./logout.php" style="width: 30px; height: 30px; cursor: pointer; border-radius: 50%; background: blue; margin-left: 10px; margin-bottom: -4px; border: none;">
                    <ion-icon  style="margin-left: 3px; margin-top: 3px; color: white; width: 30px; height: 22px;" name="log-out-outline"></ion-icon>
                </a>
            </div>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="form">
                    <label for="">full name</label>
                    <input type="text" name="FullName" />
                    <label for="">student code</label>
                    <input type="text" name="StudentCode" />
                    <label for="">national id number</label>
                    <input type="text" name="NationalIDNumber">
                    <label for="">phone</label>
                    <input type="number" name="Phone" />
                    <label for="">date of birth</label>
                    <input type="date" name="DateOfBirth" />
                    <label for="">place of birth</label>
                    <input type="text" name="PlaceOfBirth" />
                    <label for="">e-mail institutionnel</label>
                    <input type="text" name="Adress">
                    <label for="">image</label>
                    <input type="file" name="Image">
                    <div class="btn">
                        <button class="add" type="submit" name="add">add</button>
                    </div>
                </div>
            </form>
            
        </aside>
        <section class="info-student">
            <table class="table">
                <thead class="thead">
                    <tr>
                        <td class="title">image</td>
                        <td class="title">full name</td>
                        <td class="title">student code</td>
                        <td class="title">national id number</td>
                        <td class="title">phone</td>
                        <td class="title">date of birth</td>
                        <td class="title">place of birth</td>
                        <td class="title">e-mail institutionnel</td>
                    </tr>
                </thead>
                <thead class="tbody">
                        <?php 
                            $data = $conn -> prepare("SELECT * FROM student");
                            $data -> execute();
                            $shows = $data -> fetchAll();
                            foreach($shows AS $show) {
                                echo '<tr><td class="title"><div style="background-image: url(./assets/profile_student/'. $show['Image'] .')"></div></td>
                                    <td class="title">'. $show['FullName'] .'</td>
                                    <td class="title">'. $show['StudentCode'] .'</td>
                                    <td class="title">'. $show['NationalIDNumber'] .'</td>
                                    <td class="title">'. $show['Phone'] .'</td>
                                    <td class="title">'. $show['DateOfBirth'] .'</td>
                                    <td class="title">'. $show['PlaceOfBirth'] .'</td>
                                    <td class="title">'. $show['Adress'] .'</td></tr>';
                            }
                        ?>
                </thead>
            </table>
        </section>
    </div>
</body>
</html>




<?php 

if (isset($_POST['add'])) {
    $addStudent = $conn -> prepare("INSERT INTO student(FullName, StudentCode, NationalIDNumber, Phone, DateOfBirth, PlaceOfBirth, Adress, Image) 
    VALUES(:FullName, :StudentCode, :NationalIDNumber, :Phone, :DateOfBirth, :PlaceOfBirth, :Adress, :Image)");

    $fullName = $_POST['FullName'];
    $StudentCode = $_POST['StudentCode'];
    $NationalIDNumber = $_POST['NationalIDNumber'];
    $Phone = $_POST['Phone'];
    $dateOfBirth = $_POST['DateOfBirth'];
    $placeOfBirth = $_POST['PlaceOfBirth'];
    $Adress = $_POST['Adress'];
    $Image = $_FILES['Image']['name'];
    $image_tmp = $_FILES['Image']['tmp_name'];
    move_uploaded_file($image_tmp, './assets/profile_student/' .$Image);
    
    $addStudent -> bindParam('FullName', $fullName);
    $addStudent -> bindParam('StudentCode', $StudentCode);
    $addStudent -> bindParam('NationalIDNumber', $NationalIDNumber);
    $addStudent -> bindParam('Phone', $Phone);
    $addStudent -> bindParam('DateOfBirth', $dateOfBirth);
    $addStudent -> bindParam('PlaceOfBirth', $placeOfBirth);
    $addStudent -> bindParam('Adress', $Adress);
    $addStudent -> bindParam('Image', $Image);
    $addStudent -> execute();
    header("Refresh: 1");
}
?>




