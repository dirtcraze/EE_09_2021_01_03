<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twoje BMI</title>
    <link rel="stylesheet" href="styl3.css">
</head>
<body>
    <div id="topnav">
        <div id="logotop">
            <img src="wzor.png" alt="wzór BMI">
        </div>
        <div id="banertop">
            <h1>Oblicz swoje BMI</h1>
        </div>
    </div>
    <div id="mainblock">
        <table>
            <tr>
                <th>Interpretacja BMI</th>
                <th>Wartość minimalna</th>
                <th>Wartość maksymalna</th>
            </tr>
            <?php
            $host = "localhost";
            $username = "root";
            $password = "";
            $db = "egzamin";
            $conn = new mysqli($host, $username, $password, $db);

            $sql = "SELECT `bmi`.`informacja`, `bmi`.`wart_min`, `bmi`.`wart_max` FROM `bmi`;";

            $result = mysqli_query($conn, $sql);

            while($row=mysqli_fetch_assoc($result)) {
                echo
                "<tr>
                    <td>" . $row['informacja'] . "</td>
                    <td>" . $row['wart_min'] . "</td>
                    <td>" .$row['wart_max'] . "</td>
                </tr>";
            }
            ?>
        </table>
    </div>
    <div id="leftblock">
        <h2>Podaj wagę i wzrost</h2>
        <form action="bmi.php" method="POST">
            <label for="weight">Waga: </label>
            <input type="number" name="weight" min="1"><br>
            <label for="height">Wzrost w cm:</label>
            <input type="number" name="height" min="1"><br>
            <button>Oblicz i zapamiętaj wynik</button>
            <?php
            $weight = $_REQUEST['weight'];
            $height = $_REQUEST['height'];
            
            if($weight && $height) {
                $BMI = $weight/pow($height, 2)*10000;
                $BMI_ID = 0;
                echo "<p>Twoja waga: ". $weight . "; Twój wzrost: " . $height . "<br>BMI wynosi: " . $BMI . "</p>";

                if($BMI<18) $BMI_ID = 1;
                elseif($BMI<25) $BMI_ID = 2;
                elseif($BMI<30) $BMI_ID = 3;
                else $BMI_ID = 4;
                $sql2 = "INSERT INTO `wynik`(`bmi_id`, `data_pomiaru`, `wynik`) VALUES($BMI_ID, 2022-10-28, $BMI);";
                $result2 = mysqli_query($conn, $sql2);
                mysqli_close($conn);
            }
            ?>
            
        </form>

    </div>
    <div id="rightblock">
        <img id="scaleimg" src="rys1.png" alt="ćwiczenia">
    </div>
    <div id="footer">
        <span>Autor: 00000000000</span>
        <a href="kwerendy.txt">Zobacz kweredny</a>
    </div>
</body>
</html>