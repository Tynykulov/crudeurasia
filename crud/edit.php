<?php

    require"connection.php";
    // поиск логина по имени

    $stmt = $connect->prepare('select * from account where fullname = :fullname');
    $stmt->bindValue('fullname',$_GET['fullname']);
    $stmt->execute();
    $account = $stmt->fetch(PDO::FETCH_OBJ);

    if (isset($_POST['save'])) {
       //обновляем старую информацию на нлвую
        $stmt = $connect->prepare('update account set contact =:contact,address =:address,email =:email where fullname =:fullname');
        $stmt->bindValue('fullname',$_POST['fullname']);
        $stmt->bindValue('contact',$_POST['contact']);
        $stmt->bindValue('address',$_POST['address']);
        $stmt->bindValue('email',$_POST['email']);
        $stmt->execute();

        header("location:index.php");
    }

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
                <legend>Информация</legend>
                <table cellpadding="2" cellspacing="2">
                    <tr>
                        <td>Имя</td>
                        <td><?php echo $account->fullname; ?>
                        <input type="hidden" name="fullname" 
                        value="<?php echo $account->fullname; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Номер</td>
                        <td><input type="" name="contact" value="<?php echo $account->contact; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Адрес</td>
                        <td><input type="text" name="address" value="<?php echo $account->address; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Почта</td>
                        <td><input type="text" name="email" value="<?php echo $account->email; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="save" value="Сохранить"></td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </div>
</body>
</html>
