<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Étudiants</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap"
          rel="stylesheet">
    <style>
        body {
            background-color: whitesmoke;
            font-family: "Tajawal", sans-serif;
        }

        #mother {
            width: 100%;
            font-size: 20px;
        }

        main {
            float: left;
            border: 1px solid gray;
            padding: 5px;
        }

        input {
            padding: 4px;
            border: 2px solid black;
            text-align: center;
            font-size: 17px;
            font-family: "Tajawal", sans-serif;
        }

        aside {
            text-align: center;
            width: 300px;
            float: right;
            border: 1px solid black;
            padding: 10px;
            background-color: silver;
            color: white;
        }

        #tbl {
            width: 890px;
            font-size: 20px;
        }

        #tbl th {
            background-color: silver;
            color: #000;
            font-size: 20px;
            padding: 10px;

        }
        #tbl td  {
            border:1px solid black;
            color: #000;
            font-size: 20px;
            padding: 10px;
            text-align: center;
            background-color: whitesmoke;

        }

        

        aside button {
            width: 190px;
            padding: 8px;
            margin-top: 7px;
            font-size: 17px;
            font-family: "Tajawal", sans-serif;
            font-weight: bold;
        }
    </style>
</head>
<body dir="rtl">
<?php 
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'students';

// Connexion à la base de données
$con = mysqli_connect($host, $user, $pass, $db);
if (!$con) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

// Récupération des données des étudiants
$res = mysqli_query($con, "SELECT * FROM student");
if (!$res) {
    die("Erreur de requête : " . mysqli_error($con));
}

$id = '';
$name = '';
$address = '';

// Récupération des données POST
if (isset($_POST['id'])) {
    $id = $_POST['id'];
}

if (isset($_POST['name'])) {
    $name = $_POST['name'];
}

if (isset($_POST['address'])) {
    $address = $_POST['address'];
}

// Ajout d'un étudiant
if (isset($_POST['add'])) {
    $sqls = "INSERT INTO student (id, name, address) VALUES ('$id', '$name', '$address')";
    if (mysqli_query($con, $sqls)) {
        header("Location: home.php");
    } else {
        die("Erreur d'insertion : " . mysqli_error($con));
    }
}

// Suppression d'un étudiant
if (isset($_POST['del'])) {
    $sqls = "DELETE FROM student WHERE name = '$name'";
    if (mysqli_query($con, $sqls)) {
        header("Location: home.php");
    } else {
        die("Erreur de suppression : " . mysqli_error($con));
    }
}
?>

<div id='mother'>
    <form method="post">
        <aside>
            <div>
                <img src="logo.png" alt="لوجو الموقع" width="200px">
                <h3>لوحة المدير</h3>
                <label>رقم الطالب</label><br>
                <input type="text" name="id" id="id"><br>
                <label>اسم الطالب</label><br>
                <input type="text" name="name" id="name"><br>
                <label>عنوان الطالب</label><br>
                <input type="text" name="address" id="address"><br><br>
                <button name="add">إضافة طالب</button>
                <button name="del"> حذف طالب</button>
            </div>
        </aside>
        <main>
            <table id="tbl">
                <tr>
                    <th>الرقم التسلسلي</th>
                    <th>اسم الطالب</th>
                    <th>عنوان الطالب</th>
                </tr>
                <?php
                while($row = mysqli_fetch_array($res)){
                    echo "<tr>";
                    echo "<td>".$row['id']."</td>";
                    echo "<td>".$row['name']."</td>";
                    echo "<td>".$row['address']."</td>";
                    echo "</tr>";
                }
                ?> 
            </table>
        </main>
    </form>
</div>
</body>
</html>
