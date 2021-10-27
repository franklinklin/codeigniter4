<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("bootstrap.php");?>
    
</head>
<body>
    <?php include("menu.php");?>   
    <div class="container mt-5">

    <div class="card">
            <div class="card-header">
                Usuário
            </div>
            <div class="card-body">

        <?php echo form_open($save.'/save'); ?>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Nome</label>
                    <input type="text" name="name" class="form-control" value="<?php echo isset($user['name'])?$user['name']:'';?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="password">E-mail</label>
                    <input type="text" name="email" class="form-control" value="<?php echo isset($user['email'])?$user['email']:'';?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="perfil">Perfil</label>
                    <input type="text" name="phone" class="form-control" value="<?php echo isset($user['phone'])?$user['phone']:'';?>">
                </div>
                <div class="form-group col-md-6">
                <label for="perfil">Senha</label>
                    <input type="text" name="document" class="form-control" value="<?php echo isset($user['document'])?$user['document']:'';?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="perfil">Confirma a Senha</label>
                    <input type="text" name="zipcode" class="form-control" value="<?php echo isset($user['zipcode'])?$user['zipcode']:'';?>">
                </div>                
            </div>
            
            <input type="hidden" name="id" value="<?php echo isset($user['id'])?$user['id']:'';?>">
            <input type="submit" value="Salvar" class="btn btn-primary">
            <?php echo form_close(); ?>
        </div>    
        </div>
    </div>
</body>
</html>