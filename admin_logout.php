<?php
session_start();
// Уничтожение всех данных сессии
session_destroy();
// Перенаправление на страницу входа для администратора
header("Location: admin_login.php");
exit();
?>
