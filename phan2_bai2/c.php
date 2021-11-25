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

        .lietKe {
            position: fixed;
            top: 15px;
            right: 15px;
        }
    </style>
</head>

<body>
    <div id="success">Thao tác thành công</div>
    <fieldset>
        <legend>Form tương tác Database</legend>
        <form action="" method="POST">
            <table>
                <tr>
                    <th colspan="3">Chỉnh sửa một hàng</th>
                </tr>
                <tr>
                    <td>Hàng có ID là:</td>
                    <td colspan="2"><input type="number" name="ID_thayThe"></td>
                </tr>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Year</td>
                </tr>
                <tr>
                    <td><input type="number" id="id" name="chinhSuaID"></td>
                    <td><input type="text" id="name" name="chinhSuaName"></td>
                    <td><input type="number" id="year" name="chinhSuaYear"></td>
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

    <!-- PHP-Start -->

    <?php

    use function PHPSTORM_META\type;

    $connection = new mysqli('localhost', 'root', '', 'examples');
    mysqli_set_charset($connection, 'utf8');
    if ($connection->connect_error) {
        var_dump($connection->connect_error);
        die();
    }

    if (!empty($_POST)) {
        $chinhSuaID = $_POST['chinhSuaID'];
        $chinhSuaName = $_POST['chinhSuaName'];
        $chinhSuaYear = $_POST['chinhSuaYear'];
        $ID_thayThe = (int)$_POST['ID_thayThe'];
        if ($ID_thayThe == 0) {
            echo '<script>';
            echo 'alert("id ở bảng Chỉnh sửa một hàng không được phép để trống")';
            echo '</script>';
        } else {
            if ($chinhSuaName != '') {
                if (strlen($chinhSuaName) > 40 || strlen($chinhSuaName) < 5) {
                    echo '<script>';
                    echo 'alert("Name phải nằm trong khoảng 5-40 kí tự")';
                    echo '</script>';
                } else {
                    $Name = "UPDATE cars SET name = '$chinhSuaName' WHERE id = $ID_thayThe";
                    mysqli_query($connection, $Name);
                }
            }
            if ($chinhSuaYear != '') {
                if ($chinhSuaYear < 1990 || $chinhSuaYear > 2015) {
                    echo '<script>';
                    echo 'alert("Year phải nằm trong khoảng (1990, 2015)")';
                    echo '</script>';
                } else {
                    $Year = "UPDATE cars SET year = $chinhSuaYear WHERE id = $ID_thayThe";
                    mysqli_query($connection, $Year);
                }
            }
            if ($chinhSuaID != '') {
                $ID = "UPDATE cars SET id = $chinhSuaID WHERE id = $ID_thayThe";
                mysqli_query($connection, $ID);
            }
            header("Location: a.php");
        }
    }

    $connection->close();

    ?>

</body>

</html>