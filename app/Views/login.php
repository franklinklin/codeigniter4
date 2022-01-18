<?php //echo 'Versão Atual do PHP: ' . phpversion();?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.80.0">
    <title>Sistema de cobrança</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/sign-in/">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!--link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"-->
    <!--script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script-->
    
    <!-- Bootstrap core CSS -->
  <link href="bootstrap.min.css" rel="stylesheet" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">



    <!-- Favicons -->
<!--link rel="apple-touch-icon" href="/docs/4.6/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/4.6/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/4.6/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/4.6/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/4.6/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
<link rel="icon" href="/docs/4.6/assets/img/favicons/favicon.ico">
<meta name="msapplication-config" content="/docs/4.6/assets/img/favicons/browserconfig.xml">
<meta name="theme-color" content="#563d7c"-->


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
<body class="text-center">

<div class="container">
    <div id="response">        
        
    </div>

<form class="form-signin" id="form">
  <!--img class="mb-4" src="/docs/4.6/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"-->
  <!--h1 class="h3 mb-3 font-weight-normal">Sistema de cobrança</h1-->
  <!--p class="text-muted">Para acessar preencha os campos abaixo.</p-->
  <p class="text-muted">Sistema de cobrança</p>
  <label for="inputEmail" class="sr-only">E-mail</label>
  <input type="text" id="cpf" name="cpf" class="form-control" placeholder="CPF" required autofocus onkeyup="maskdocument('cpf')" onkeypress="isNumber();maskdocument('cpf');" maxlength="14">
  <label for="inputPassword" class="sr-only">Senha</label>
  <input type="password" id="inputPassword" class="form-control" placeholder="Senha" required onkeypress="if(event.key === 'Enter') check()">
  <!--div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label>
  </div-->
  <button class="btn btn-lg btn-primary btn-block" type="button" onclick="check()">Continuar</button>
  <!--p class="mt-5 mb-3 text-muted">Não tem conta? <b>CADASTRE-SE</b></p-->
</form>
<br>

<script>

    function check(){
        let cpf = document.querySelector('#cpf');
        let password = document.querySelector('#inputPassword');
        
        if(cpf==''){
            $('#cpf').focus();
            return false;
        }

        if(password==''){
            $('#inputPassword').focus();
            return false;
        }
        $.post("login/check",{cpf: cpf.value,password: password.value}, function(response){ 
          
          console.log(response);

            if(response !='false'){
                window.location.href = "/billing";
            }else{
            
                $('#response').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Acesso Negado!</strong> <button onclick="close_alert()" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            }
        })
    }

    function close_alert(){
        $('#response').html('');
    }

    function maskdocument(id){
        var cpf = document.querySelector('[name="'+id+'"]');
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
</script>    
    
  </body>
</html>
