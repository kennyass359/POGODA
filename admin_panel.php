<?php
session_start();
// Проверка, авторизован ли пользователь как администратор
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: admin.php");
    exit();
}

// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chebweath";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Удаление сообщения, если был отправлен запрос на удаление
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_message'])) {
    $message_id = $_POST['delete_message'];
    $sql_delete = "DELETE FROM contact_form WHERE id=$message_id";
    if ($conn->query($sql_delete) === TRUE) {
        echo "Сообщение успешно удалено";
    } else {
        echo "Ошибка при удалении сообщения: " . $conn->error;
    }
}

// Запрос всех сообщений из базы данных
$sql = "SELECT * FROM contact_form";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
    <h2>Панель администратора</h2>
    <a href="admin_logout.php">Выйти</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Email</th>
            <th>Сообщение</th>
            <th>Время</th>
            <th>Удалить</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["id"]."</td>";
                echo "<td>".$row["name"]."</td>";
                echo "<td>".$row["email"]."</td>";
                echo "<td>".$row["message"]."</td>";
                echo "<td>".$row["created_at"]."</td>";
                echo "<td>";
                echo "<form method='post' action='".$_SERVER["PHP_SELF"]."'>";
                echo "<input type='hidden' name='delete_message' value='".$row["id"]."'>";
                echo "<button type='submit'>Удалить</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Нет сообщений</td></tr>";
        }
        ?>
    </table>
</body>
</html>
