<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Arquivo</title>
</head>
<body>
    <h1>Upload de arquivo</h1>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="files[]" id="file" multiple>
        <button type="submit">Enviar</button>
    </form>

    <br>

    <style>
        a {
            display: inline-block;
            background: #1C1C1C;
            color: white;
            padding: 8px;
            margin: 8px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 10pt;
        }
    </style>
</body>
</html>

<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (!isset($_FILES["files"]["name"][0]) || $_FILES["files"]["error"][0] !== UPLOAD_ERR_OK) {
            echo "Nenhum arquivo foi enviado.";
            exit();
        }
    
        $files = $_FILES["files"];
        echo "<h1>Baixar arquivo traduzido!</h1><br>";
    
        // Loop through each file
        for ($i = 0; $i < count($files["name"]); $i++) {
            $file = array(
                'name' => $files['name'][$i],
                'type' => $files['type'][$i],
                'tmp_name' => $files['tmp_name'][$i],
                'error' => $files['error'][$i],
                'size' => $files['size'][$i]
            );

            $filePath = './' . $file["name"];
            $fileInfo = pathinfo($filePath);

            if ($fileInfo["extension"] == 'txt') {
                if (move_uploaded_file($file["tmp_name"], $filePath)) { 
                    $newFileName = str_replace(' ', '-', $fileInfo["filename"] . '_pt.' . $fileInfo["extension"]);
                    shell_exec("echo \"" . file_get_contents($filePath) . "\" | trans -b -t Portuguese > $newFileName");
    
                    echo "
                        <a href='$newFileName'>Visualizar $newFileName</a><br>
                        <a href='$newFileName' download>Baixar $newFileName</a>
                        <br>
                    ";
                } else {
                    echo "Erro ao fazer upload do arquivo ou o arquivo não possui a extensão .txt!";
                }
            }
        }
    }
?>
