<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #success {
            z-index: 100;
            width: 300px;
            height: 40px;
            line-height: 40px;
            background-color: greenyellow;
            color: white;
            font-size: 20px;
            border-radius: 15px;
            font-weight: bold;
            text-align: center;
            position: fixed;
            top: 15px;
            right: 15px;
            transition: 0.5s;
            display: none;
        }

        fieldset {
            margin: auto;
            width: fit-content;
            padding: 10px 30px;
            text-align: center;
        }

        table,
        tr,
        td,
        th {
            border: thin solid black;
        }

        table {
            width: fit-content;
            margin: auto;
            margin-bottom: 40px;
            border-collapse: collapse;
        }

        table td {
            width: fit-content;
            padding: 10px 20px;
            text-align: center;
        }

        input {
            width: 80px;
        }

        .nutBam {
            background-color: red;
            color: white;
            border-radius: 10px;
            width: fit-content;
            height: fit-content;
            font-weight: bold;
            padding: 10px 20px;
        }
    </style>
</head>

<body>
    <div id="success">Thao tác thành công</div>
    <fieldset>
        <legend>Form Insert Row</legend>
        <form action="" method="POST">
            <table>
                <tr>
                    <th colspan="3">Thêm một hàng</th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Year</th>
                </tr>
                <tr>
                    <td><input type="number" id="id" name="themID"></td>
                    <td><input type="text" id="name" name="themName"></td>
                    <td><input type="number" id="year" name="themYear"></td>
                </tr>
            </table>
            <input type="reset" value="Reset" class="nutBam">
            <input type="submit" value="Submit" class="nutBam">
        </form>
    </fieldset>

    <script language="javascript">
        function display() {
            var success = document.getElementById('success');
            success.style.display = 'unset';
            var hidden = function() {
                success.style.display = 'none';
            }
            setTimeout(hidden, 2000);            
        }
    </script>

    <?php

    use function PHPSTORM_META\type;

    $connection = new mysqli('localhost', 'root', '', 'examples');
    mysqli_set_charset($connection, 'utf8');
    if ($connection->connect_error) {
        var_dump($connection->connect_error);
        die();
    }

    if (!empty($_POST)) {
        $themID = $_POST['themID'];
        $themName = $_POST['themName'];
        $themYear = $_POST['themYear'];
        if ($themID == '') {
            echo '<script>';
            echo 'alert("id ở bảng Thêm một hàng không được phép để trống")';
            echo '</script>';
        } else if ((strlen($themName) > 40 || strlen($themName) < 5) || ($themYear < 1990 || $themYear > 2015)) {
            echo '<script>';
            echo 'alert("Name phải nằm trong khoảng 5-40 kí tự và Year phải nằm trong khoảng (1990, 2015)")';
            echo '</script>';
        } else {
            $them = "INSERT INTO cars(id, name, year) VALUES('" . $themID . "', '" . $themName . "', '" . $themYear . "')";
            mysqli_query($connection, $them);
            header("Location: a.php");
        }
    }

    $connection->close();

    ?>
</body>

</html>