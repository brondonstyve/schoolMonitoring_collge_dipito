<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>iai</title>
</head>
<body>
    <form action="<?php echo e(route('generer_edt_path')); ?>" method="post">
        <?php echo e(csrf_field()); ?>

        <input type="submit" value="Generer">
    </form>
</body>
</html>
