<!doctype html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>first test</title>

        <!-- Fonts -->

    </head>
    <body>
        <form  action="<?php echo e(route('create_root')); ?>"  method="POST" >
            <?php echo e(csrf_field()); ?>


            <input type="submit" value="hgvndb">
        </form>
    </body>
</html>
