<?php
$scanDir = scandir("assets/img/uploaded");
$scanDirWithOnlyImages = array_splice($scanDir, 0, 2);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Super Gallerie</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <?php
            foreach($scanDir as $file) {
                ?>
                <div class="col-3">
                    <img src="assets/img/uploaded/<?= $file ?>" alt="<?= $file ?>" class="w-100">
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
</body>

</html>