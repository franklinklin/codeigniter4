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
    <div class="container mt-2">

    <?php include("success.php"); ?>
    <?php include("required_filds.php"); ?>

    <?php echo form_open($save.'/save'); ?>
    <div class="card">
            <div class="card-header">
                Cliente
            </div>
            <div class="card-body">

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Nome</label>
                    <input type="text" name="name" class="form-control" value="<?php echo isset($user['name'])?$user['name']:'';?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="email">E-mail</label>
                    <input type="text" name="email" class="form-control" value="<?php echo isset($user['email'])?$user['email']:'';?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="phone">Contato</label>
                    <input type="text" name="phone" class="form-control" value="<?php echo isset($user['phone'])?$user['phone']:'';?>"  onkeyup="maskphone('phone')" onkeypress="isNumber()" maxlength="15">
                </div>
                <div class="form-group col-md-6">
                <label for="document">CPF</label>
                    <input type="text" name="document" class="form-control" value="<?php echo isset($user['document'])?$user['document']:'';?>" onkeyup="maskdocument()" onkeypress="isNumber();maskdocument();" maxlength="14">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="phone2">2º Contato</label>
                    <input type="text" name="phone2" class="form-control" value="<?php echo isset($user['phone2'])?$user['phone2']:'';?>"  onkeyup="maskphone('phone2')" onkeypress="isNumber()" maxlength="15">
                </div>
                
                <div class="form-group col-md-6">
                    <label for="exampleFormControlSelect1"><b>Motoboy</b></label>
                    <select class="form-control" name="id_motoboy">
                        <?php if(isset($motoboys)){?>
                            <?php foreach($motoboys as $moto){?>
                                <option value="<?php echo $moto['id'];?>" <?php echo isset($user['id_motoboy']) && $moto['id']==$user['id_motoboy']?'selected':'';?> >
                                    <?php echo $moto['name']; ?>
                                </option>
                            <?php } ?>
                        <?php }?>
                    </select>
                </div>
            </div>
            
             </div>    
        </div>

        <div class="card mt-2">
            <div class="card-header">
                Endereço residencial
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="zipcode">CEP</label>
                        <input type="text" name="zipcode" class="form-control" value="<?php echo isset($user['zipcode'])?$user['zipcode']:'';?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="number">Número</label>
                        <input type="text" name="number" class="form-control" value="<?php echo isset($user['number'])?$user['number']:'';?>" onkeypress="isNumber()" onkeyup="isNumber()">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="address">Endereço</label>
                        <input type="text" name="address" class="form-control" value="<?php echo isset($user['address'])?$user['address']:'';?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="district">Bairro</label>
                        <input type="text" name="district" class="form-control" value="<?php echo isset($user['district'])?$user['district']:'';?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="city">Cidade</label>
                        <input type="text" name="city" class="form-control" value="<?php echo isset($user['city'])?$user['city']:'';?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="state">UF</label>
                        <input type="text" name="state" class="form-control" value="<?php echo isset($user['state'])?$user['state']:'';?>">
                    </div>
                </div>
            </div>    
        </div>

        <div class="card mt-2">
            <div class="card-header">
                Endereço comercial
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="zipcode_business">CEP</label>
                        <input type="text" name="zipcode_business" class="form-control" value="<?php echo isset($user['zipcode_business'])?$user['zipcode_business']:'';?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="number_business">Número</label>
                        <input type="text" name="number_business" class="form-control" value="<?php echo isset($user['number_business'])?$user['number_business']:'';?>"  onkeypress="isNumber()" onkeyup="isNumber()">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="address_business">Endereço</label>
                        <input type="text" name="address_business" class="form-control" value="<?php echo isset($user['address_business'])?$user['address_business']:'';?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="district_business">Bairro</label>
                        <input type="text" name="district_business" class="form-control" value="<?php echo isset($user['district_business'])?$user['district_business']:'';?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="city_business">Cidade</label>
                        <input type="text" name="city_business" class="form-control" value="<?php echo isset($user['city_business'])?$user['city_business']:'';?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="state_business">UF</label>
                        <input type="text" name="state_business" class="form-control" value="<?php echo isset($user['state_business'])?$user['state_business']:'';?>">
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

        function maskphone(id){
            var phone = document.querySelector('[name="'+id+'"]');
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