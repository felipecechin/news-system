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
        <form action="paginaPrincipal.php" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Título: <input type="text" name="titulo" required=""></td>
                </tr>
                <tr>
                    <td>Texto: <textarea rows="4" cols="5" required="" name="texto">  </textarea> </td>
                </tr>
                <tr>
                    <td>Imagem: <input type="file" name="img" required=""></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: right;"><input type="submit" value="Enviar"></td>
                </tr>
            </table>
        </form>
        <?php
        if ($_POST) {
            $titulo = $_POST['titulo'];
            $texto = $_POST['texto'];

            $pasta = 'imgs';
            $img = $_FILES['img']['name'];
            $destino = $pasta . '/' . $img;

            move_uploaded_file($_FILES['img']['tmp_name'], $destino);

            $mysqli = new mysqli('localhost', 'root', '', 'noticias');
            $sql = 'INSERT INTO noticias(texto, imagem, titulo) values ("' . $texto . '", "' . $destino . '", "' . $titulo . '")';
            $result = $mysqli->query($sql);
            
            if ($result) {
               echo '<script>alert("Noticia cadastrada.")</script>';
               header('refresh: 1; url="paginaPrincipal.php"', true, 300);
            }
            
        }
        ?>
    </body>
</html>
