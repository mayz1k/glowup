<?php
try {
    // Подключение к базе данных
    $pdo = new PDO("mysql:host=localhost;dbname=beauty_salon;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Подготовка SQL-запроса
    $sql = "INSERT INTO appointments (name, phone, email, service, time)
            VALUES (:name, :phone, :email, :service, :time)";
    $stmt = $pdo->prepare($sql);

    // Выполнение запроса
    $stmt->execute([
        ':name' => $_POST['name'],
        ':phone' => $_POST['phone'],
        ':email' => $_POST['email'],
        ':service' => $_POST['service'],
        ':time' => $_POST['time']
    ]);

    // Перенаправление на форму с флагом успеха
    header("Location: appointment.html?success=1");
    exit();

} catch (Exception $e) {
    // Запись ошибки в лог
    error_log("Ошибка записи: " . $e->getMessage());

    // Перенаправление с флагом ошибки
    header("Location: appointment.html?error=1");
    exit();
}