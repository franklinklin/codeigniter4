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

    <?php echo form_open($save.'/save'); ?>
    
    <div class="container mt-2">

        <div class="card">
            <div class="card-header">
                Motoboy
            </div>
            <div class="card-body">
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
                        <label for="perfil">Celular</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo isset($user['phone'])?$user['phone']:'';?>">
                    </div>
                    <div class="form-group col-md-6">
                    <label for="perfil">CPF</label>
                        <input type="text" name="document" class="form-control" value="<?php echo isset($user['document'])?$user['document']:'';?>">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mt-2">
            <div class="card-header">
                Endereço
            </div>
            <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                        <label for="perfil">CEP</label>
                        <input type="text" name="zipcode" class="form-control" value="<?php echo isset($user['zipcode'])?$user['zipcode']:'';?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="perfil">Número</label>
                        <input type="text" name="number" class="form-control" value="<?php echo isset($user['number'])?$user['number']:'';?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="perfil">Endereço</label>
                        <input type="text" name="address" class="form-control" value="<?php echo isset($user['address'])?$user['address']:'';?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="perfil">Bairro</label>
                        <input type="text" name="district" class="form-control" value="<?php echo isset($user['district'])?$user['district']:'';?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="perfil">Cidade</label>
                        <input type="text" name="city" class="form-control" value="<?php echo isset($user['city'])?$user['city']:'';?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="perfil">UF</label>
                        <input type="text" name="state" class="form-control" value="<?php echo isset($user['state'])?$user['state']:'';?>">
                    </div>
                </div>
            </div>
        </div>
    
        <div class="card mt-2">
            <div class="card-header">
                Moto
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="perfil">Proprietário</label>
                        <input type="text" name="owner" class="form-control" value="<?php echo isset($user['owner'])?$user['owner']:'';?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="perfil">CNH</label>
                        <input type="text" name="cnh" class="form-control" value="<?php echo isset($user['cnh'])?$user['cnh']:'';?>">
                    </div>
                </div> 
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="perfil">Ano</label>
                        <input type="text" name="year" class="form-control" value="<?php echo isset($user['year'])?$user['year']:'';?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="perfil">Placa</label>
                        <input type="text" name="license_plate" class="form-control" value="<?php echo isset($user['license_plate'])?$user['license_plate']:'';?>">
                    </div>
                </div>               
            </div>
        </div>

        <input type="hidden" name="id" value="<?php echo isset($user['id'])?$user['id']:'';?>">
        <input type="submit" value="Salvar" class="btn btn-primary mt-2 mb-3">
        <?php echo form_close(); ?>

    </div>      

</body>
</html>