<?php
if(isset($_POST["buttonSubmit"])) {
    if(isset($_FILES["uploadFile"]) && $_FILES["uploadFile"]["error"] == 0) {
        $extensionsAllowed = ["image/jpeg", "image/png", "image/GIF"];
        $mimeTypeUploadedFile = mime_content_type($_FILES["uploadFile"]["tmp_name"]);
        if(in_array($mimeTypeUploadedFile, $extensionsAllowed)) {
            if($_FILES["uploadFile"]["size"] <= 5000000) {
                $pathInfoUploadedFile = pathinfo($_FILES["uploadFile"]["name"]);
                $newUploadedFileName = uniqid($pathInfoUploadedFile["filename"]);
                $fileExtension = $pathInfoUploadedFile["extension"];
                $targetDirectory = "assets/img/uploaded/";
                $newUploadedFileNamePlusTargetDirectory = $targetDirectory . $newUploadedFileName . "." . $fileExtension;
                if(move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $newUploadedFileNamePlusTargetDirectory)) {
                    $message = "Votre fichier a bien été uploadé !";
                } else {
                    $errorMessage = "Une erreur est survenue lors de l'upload du fichier, veuillez réessayer";
                }
            } else {
                $errorMessage = "Votre fichier est trop lourd, la taille maximale est de 5MB.";
            }
        } else {
            $errorMessage = "Veuillez choisir un fichier image (png, jpeg / jpg ou GIF).";
        }
    } else {
        $errorMessage = "Votre fichier n'a pu être envoyé, veuillez réessayer.";
    }
}
$scanDirCount = count(scandir("assets/img/uploaded")) - 2;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Super TP Upload</title>
</head>

<body>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <label for="uploadFile">Choisissez un fichier à uploader</label>
        <input type="file" name="uploadFile" id="uploadFile">
        <button type="submit" name="buttonSubmit">Envoyer</button>
    </form>
    <?php
    if(isset($message)) {
        ?>
        <p class="alert-success"><?= $message ?></p>
        <?php
    } else if (isset($errorMessage)) {
        ?>
        <p class="alert-danger"><?= $errorMessage ?></p>
        <?php
    } else {
        ?>
        <p>Bienvenu sur le site qui upload des images dans une gallerie ! Commencez à uploader vos images dès maintenant !</p>
        <?php
    }
    ?>
    <a href="gallery.php"><button class="btn btn-dark">Direction la gallerie !</button></a>
    <p class="badge bg-primary"><?= ($scanDirCount < 2) ? $scanDirCount . " image se trouve" : $scanDirCount . " images se trouvent" ?> actuellement dans la gallerie.</p>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
</body>

</html>