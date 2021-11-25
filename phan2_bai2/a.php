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
                    <td><input type="radio" name="tuongTac" value="lietKe"></td>
                    <td>Liệt kê tất cả các hàng trong bảng</td>
                </tr>
                <tr>
                    <td><input type="radio" name="tuongTac" value="them"></td>
                    <td>Thêm một hàng dữ liệu vào bảng</td>
                </tr>
                <tr>
                    <td><input type="radio" name="tuongTac" value="chinhSua"></td>
                    <td>Chỉnh sửa một hàng trong bảng</td>
                </tr>
                <tr>
                    <td><input type="radio" name="tuongTac" value="xoa"></td>
                    <td>Xóa một hàng trong bảng</td>
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

    function showTable($connect)
    {
        $query = "SELECT * FROM cars";
        $result = mysqli_query($connect, $query);
        echo '<table class="lietKe">';
        echo
        '<tr>
            <th>ID</th>
            <th>Name</th>
            <th>Year</th>
        </tr>';
        while ($table = mysqli_fetch_array($result)) {
            echo
            '<tr>
                <td>' . $table['id'] . '</td>
                <td>' . $table['name'] . '</td>
                <td>' . $table['year'] . '</td>
            </tr>';
        }
        echo '</table>';
    }

    if (!empty($_POST)) {
        if (empty($_POST['tuongTac'])) {
            echo '<script>';
            echo 'alert("Bạn vui lòng chọn hình thức giao tiếp với Database!")';
            echo '</script>';
        } else {
            $action = $_POST['tuongTac'];
            switch ($action) {
                case 'lietKe':
                    ShowTable($connection);
                    echo "<script> display(); </script>";
                    break;
                case 'them':
                    header("Location: b.php");
                    break;
                case 'chinhSua':
                    header("Location: c.php");
                    break;
                case 'xoa':
                    header("Location: d.php");
                    break;
            }
        }
    }

    $connection->close();

    ?>

</body>

</html>