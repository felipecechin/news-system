<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="index.php" method="POST">
            <table>
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td>Login: <input type="text" name="login" required=""</td>
                            </tr>
                            <tr>
                                <td>Senha: <input type="password" required="" name="senha"</td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" value="Enviar"></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <?php
                        $mysqli = new mysqli('localhost', 'root', '', 'noticias');
                        $sql = 'SELECT * FROM noticias';
                        $result = $mysqli->query($sql);
                        if ($result) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <table style="border: 1px solid black;width: 300px; ">
                                    <tr>
                                        <td style="text-align: center"><?php echo $row['titulo']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><img src="<?php echo $row['imagem']; ?>" style="width: 100%; height: 300px;"></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $row['texto']; ?></td>
                                    </tr>
                                </table>
                                <?php
                            }
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if ($_POST) {
            $login = $_POST['login'];
            $senha = $_POST['senha'];

            $mysqli = new mysqli('localhost', 'root', '', 'noticias');
            if (mysqli_connect_errno()) {
                echo 'Erro: ' . mysqli_connect_error();
            } else {
                $sql = 'SELECT * FROM login where usuario = "' . $login . '" and senha = "' . $senha . '"';

                if ($result = $mysqli->query($sql)) {
                    while ($row = $result->fetch_assoc()) {
                        session_start();
                        $_SESSION['id'] = $row['id'];
                        header('location: paginaPrincipal.php');
                    }
                } else {
                    echo '<h2 style="color: red;">Usuário ou senha errado.</h2>';
                }
            }
        }
        ?>
    </body>
</html>
