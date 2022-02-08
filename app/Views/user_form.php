<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ?php include("bootstrap.php");?- -->
    <!-- Bootstrap CSS -->
    <link rel="<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    
</head>
<body>
    <?php include("menu.php");?>   
    <div class="container mt-5">
    
    <?php include("success.php"); ?>
    <?php include("required_filds.php"); ?>

    <!--div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Este CPF não esta cadastrado</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div-->

    <div class="card">
            <div class="card-header">
                Usuário
            </div>
            <div class="card-body">

        <?php echo form_open($save.'/save'); ?>

            <div class="form-row">    
                <div class="form-group col-md-6">
                    <label for="name"><b>Nome</b></label>
                    <br><span id="name_user"></span>
                    <input type="hidden" name="name" >
                    <input type="hidden" name="id_user" id="id_user" >
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">                    
                    <div class="form-group">
                        <label for="exampleFormControlSelect1"><b>Perfil</b></label>
                        <select class="form-control" id="exampleFormControlSelect1" name="id_perfil" onchange="checkPerfil()">
                            <option></option>
                            <option value="2" <?php echo isset($user['id_perfil']) && $user['id_perfil']==2?'selected':'';?>>Cliente</option>
                            <option value="3" <?php echo isset($user['id_perfil']) && $user['id_perfil']==3?'selected':'';?>>Motoboy</option>
                            <option value="1" <?php echo isset($user['id_perfil']) && $user['id_perfil']==1?'selected':'';?>>Administrador</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="perfil"><b>CPF</b></label>
                    <input type="cpf" name="cpf" class="form-control" value="<?php echo isset($user['cpf'])?$user['cpf']:'';?>" onkeyup="maskdocument()" onkeypress="isNumber();maskdocument();"  onblur="ajaxLoadCpf();" maxlength="14">
                </div>                
            </div>
            <div class="form-row">
                
                <!--div class="form-group col-md-6">
                    <label for="password">E-mail</label>
                    <input type="text" name="email" class="form-control" value="<?php echo isset($user['email'])?$user['email']:'';?>">
                </div-->
                
            </div>
            <div class="form-row">
            <div class="form-group col-md-6">
                
                <label for="perfil"><b>Senha</b></label>
                    <input type="password" name="password" class="form-control" >
                </div>

                <div class="form-group col-md-6">
                    <label for="perfil"><b>Confirma a Senha</b></label>
                    <input type="password" name="confirm_password" class="form-control" >
                </div>                
            </div>
            
            <input type="hidden" name="id" value="<?php echo isset($user['id'])?$user['id']:'';?>">
            <input type="submit" value="Salvar" class="btn btn-primary">
            <?php echo form_close(); ?>
        </div>    
        </div>
    </div>
    <footer class="footer mt-auto py-3">
        <div class="container">
        <span class="text-muted"><a href="https://consultordevendassbc.com/" target="_blank">Criado por Consultor de Vendas.</a></span>
        </div>
    </footer>
        
</body>
</html>

<script>
    function maskdocument(){
        var cpf = document.querySelector('[name="cpf"]');
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

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
            evt.preventDefault();
        } else {
            return true;
        }
    }

    function checkPerfil(){
        var id_perfil = document.querySelector('[name="id_perfil"]');
        if(id_perfil.value ==1){
            document.getElementById("name_user").innerHTML = 'Administrador';
            document.getElementById("id_user").value = 0;
        }else{
            document.getElementById("name_user").innerHTML = ''; 
        }
    }

    ajaxLoadCpf();

    function ajaxLoadCpf(){
        var perfil = document.querySelector('[name="id_perfil"]');
        var id_perfil = perfil.value;

        var cpf = document.querySelector('[name="cpf"]');
        var doc = cpf.value;

        if(id_perfil ==''){
            document.querySelector('[name="id_perfil"]').focus();
            cpf.value ='';
            return false;
        }

        if(id_perfil != 1 && perfil.value !='' && cpf.value !=''){
            $.post("/user/ajaxLoadCpf",{cpf: doc, id_perfil: id_perfil}, function(response){  
                const obj = JSON.parse(response);
                console.log(obj);
                if(obj == false){
                    
                    document.getElementById("name_user").innerHTML = 'Este CPF não esta cadastrado.';
                    
                }else{    
                    document.getElementById("name_user").innerHTML = obj.name;
                    var name_user = document.querySelector('[name="name"]');
                        name_user.value = obj.name;
                    document.getElementById("id_user").value = obj.id;
                }

            });
        }
    }   
    
    document.getElementById('cpf_notfound').style.display = 'none';
</script>

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastro não encontrado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Para este perfil é necessário efetuar o cadastro.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>        
            </div>
            </div>
        </div>
        </div>