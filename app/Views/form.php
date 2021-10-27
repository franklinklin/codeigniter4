<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
    <div class="container mt-5">
        <?php echo form_open('login/save'); ?>
            <div class="form-group">
                <label for="e-mail">E-mail</label>
                <input type="text" name="email" class="form-control" value="<?php echo isset($user['email'])?$user['email']:'';?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" name="password" class="form-control" value="<?php echo isset($user['password'])?$user['password']:'';?>">
            </div>
            <div class="form-group">
                <label for="perfil">Perfil</label>
                <input type="text" name="perfil" class="form-control" value="<?php echo isset($user['perfil'])?$user['password']:'';?>">
            </div>
            <input type="hidden" name="id" value="<?php echo isset($user['id'])?$user['id']:'';?>">
            <input type="submit" value="Salvar" class="btn btn-primary">
            <?php echo form_close(); ?>
    </div>
</body>
</html>