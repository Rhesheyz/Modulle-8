<?php 
    if (isset($_POST['upload'])) {
        include 'config.php';

        $ussername = trim($_POST['tusername']);
        $password = md5(trim($_POST['tpassword']));
        if (empty($ussername) || empty($password)) {
            $message = "Data Not Valid";
        } else {

            $kueri = "select * from pengguna where username='$ussername'";
            $hasil = mysqli_query($conn, $kueri) or die('Error, query failed. ' . mysqli_error($conn));
            $result = mysqli_fetch_array($hasil);
            //
            if ($result != 0) {
                $message = "There is same username";
            } else {


                $query = "insert into pengguna (username, password)" .
                    "VALUES ('$ussername','$password')";

                mysqli_query($conn, $query) or die('Error, query failed' . mysqli_error($conn));
                mysqli_close($conn);

                echo "Add User Administrator '$ussername' SUCCES";
                exit();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>input user</title>
</head>
<body>
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="content">
        <tr>
            <td>
                <center>
                    <font color="#FF0000">
                        <?php if (isset($message)) {
                            echo $message;
                        } ?>
                    </font>
                </center>
            </td>
        </tr>
    </table>
    <form action="<?php $PHP_SELF ?>" method="post" name"uploadform" id="uploadform">
        <table width="90%" border="0" align="center" cellpadding="2" cellspacing="2" class="content">
            <tr bgcolor="#FFDFAA">
                <td colspan="3">
                    <div align="center"><strong>Add User Administrator </strong></div>
                </td>
            </tr>
            <tr>
                <td width="26%"><strong>Username</strong></td>
                <td width="2%">:</td>
                <td width="72"><input type="text" name="tusername" id="tusername" size="20" maxlength="20">
                    <span class="style2">*</span>
                </td>
            </tr>
            <tr>
                <td><strong>Password</strong></td>
                <td>:</td>
                <td><input type="password" name="tpassword" id="tpassword" size="20" maxlength="20">
                    <span class="style2">*</span>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><input type="submit" name="upload" class="box" id="upload" value=" Submit"></td>
            </tr>
            <tr>
                <td><a href="index.php">Kembali Ke Index</a></td>
            </tr>
        </table>
    </form>
</body>
</html>