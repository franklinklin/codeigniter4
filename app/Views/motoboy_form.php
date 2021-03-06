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
        
        <?php include("success.php"); ?>
        <?php include("required_filds.php"); ?>

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
                        <input type="text" name="phone" class="form-control" value="<?php echo isset($user['phone'])?$user['phone']:'';?>" onkeyup="maskphone()" onkeypress="isNumber()" maxlength="15">
                    </div>
                    <div class="form-group col-md-6">
                    <label for="perfil">CPF</label>
                        <input type="text" name="document" class="form-control" value="<?php echo isset($user['document'])?$user['document']:'';?>" onkeyup="maskdocument()" onkeypress="isNumber();maskdocument();" maxlength="14">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mt-2">
            <div class="card-header">
                Endere??o
            </div>
            <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                        <label for="perfil">CEP</label>
                        <input type="text" name="zipcode" class="form-control" value="<?php echo isset($user['zipcode'])?$user['zipcode']:'';?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="perfil">N??mero</label>
                        <input type="text" name="number" class="form-control" value="<?php echo isset($user['number'])?$user['number']:'';?>" onkeypress="isNumber()" >
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="perfil">Endere??o</label>
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
                        <label for="perfil">Propriet??rio</label>
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
                        <input type="text" name="year" class="form-control" value="<?php echo isset($user['year'])?$user['year']:'';?>" onkeypress="isNumber()" maxlength="4">
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
    <footer class="footer mt-auto py-3">
        <div class="container">
        <span class="text-muted"><a href="https://consultordevendassbc.com/" target="_blank">Criado por Consultor de Vendas.</a></span>
        </div>
    </footer>
    <script>
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
                evt.preventDefault();
            } else {
                return true;
            }
        }
        function maskdocument(){
            var cpf = document.querySelector('[name="document"]');
            var doc ='';

            if(cpf.value.length ==3){
                doc = cpf.value;
                cpf.value = doc+".";
            }

            if(cpf.value.length ==7){
                doc = cpf.value;
                cpf.value = doc+".";
            }

            if(cpf.value.length ==11){
                doc = cpf.value;
                cpf.value = doc+"-";
            }
        }

        function maskphone(){
            var phone = document.querySelector('[name="phone"]');
            var num ='';

            if(phone.value.length ==2){
                num = phone.value;
                phone.value = "("+num+") ";
            }

            if(phone.value.length ==10){
                num = phone.value;
                phone.value = num+"-";
            }
        }
    </script>    

</body>
</html>