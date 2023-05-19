<?php

    require"connection.php"; #подключение бд

    if (isset($_POST['save'])) { #передаем дату в базу данных
        $stmt = $connect->prepare('INSERT INTO account (fullname,contact,address,email) 
            VALUES(:fullname,:contact,:address,:email)');
        $stmt->bindValue('fullname', $_POST['fullname']);
        $stmt->bindValue('contact', $_POST['contact']);
        $stmt->bindValue('address', $_POST['address']);
        $stmt->bindValue('email', $_POST['email']);

        $stmt->execute();
        header("location:index.php");
    }

    #кнопка удаленияя
    if (isset($_GET['action']) && $_GET['action'] == 'delete') {
        $stmt = $connect->prepare('delete from account where fullname = :fullname');
        $stmt->bindValue('fullname',$_GET['fullname']);
        $stmt->execute();

    }

    $stmt = $connect->prepare('select * from account');
    $stmt->execute();

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>crud eurasia</title>
    <script src="jquery-3.6.4.min.js"></script>
</head>

<body>
<div>
    <form method="post" autocomplete="off"> 
    <fieldset>
        <legend> Регистрация </legend>
        <!-- Таблица регистрации -->
        <table cellpadding="2" cellspacing="2">
            <tr>
                <td>Имя</td>
                <td><input id="fullname" type="text" name="fullname" required></td>
            </tr>
            <tr>
                <td>Номер</td>
                <td><input id="contact" type="text" name="contact" required></td>
            </tr>
            <tr>
                <td>Адрес</td>
                <td><input id="address" type="text" name="address" required></td>
            </tr>
            <tr>
                <td>Почта</td>
                <td><input id="email" type="text" name="email" required></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="save" value="Сохранить"></td>
            </tr>
        </table>
    </fieldset>
    </form>
    </div><br>

<div>
    <!-- Таблица с существующей информацией -->
    <table cellspacing="2" cellpadding="2">
        <tr>
            <th>Имя</th>
            <th>Номер</th>
            <th>Адрес</th>
            <th>Почта</th>
            <th>Действие</th>
        </tr>
        <?php while($account = $stmt->fetch(PDO::FETCH_OBJ)) {?>
        <tr>
            <td><?php echo $account->fullname; ?></td>
            <td><?php echo $account->contact; ?></td>
            <td><?php echo $account->address; ?></td>
            <td><?php echo $account->email; ?></td>
            <td>
                <a onclick="" href="index.php?fullname=<?php echo $account->fullname ?>&action=delete">Удалить</a>
                <a href="edit.php?fullname=<?php echo $account->fullname ?>">Редактировать</a>
            </td>
        </tr>
        <?php }?>
        </table>
</div>
</body>