<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    </script>


    <title>Sistema de cobrança</title>
  </head>
  <body>
        <?php include("menu.php");?>

        <br>

        <div class="container">

        <?php include("success.php"); ?>
        <?php include("required_filds.php"); ?>

        <?php echo form_open($save.'/save'); ?>
            
            <div class="row">
                <div class="card" style="width: 100%;" >
                    
                    <div class="card-header">
                        <b>Detalhe da cobrança</b>
                    </div>

                    <div class="card-body">
                        <form>
                            <div class="row form-group">
                                <div class="col">
                                    <label for="formGroupExampleInput"><b>Data</b></label>
                                    <?php if(isset($billing['id']) && $billing['id']){?>
                                        <br>
                                        <?php echo isset($billing['contract_date']) && $billing['contract_date']?date('d/m/Y', strtotime($billing['contract_date'])):date('d/m/Y');?>
                                    <?php }else{?>    
                                        <input type="text" name="contract_date" class="form-control" value="<?php echo isset($billing['contract_date']) && $billing['contract_date']?date('d/m/Y', strtotime($billing['contract_date'])):date('d/m/Y');?>" placeholder="Data" onkeyup="maskdate()" onkeypress="isNumber();maskdate();" maxlength="10">
                                    <?php } ?>                                    
                                </div>
                                <div class="col">
                                    <label for="formGroupExampleInput"><b>CPF</b></label>
                                    <?php if(isset($billing['id']) && $billing['id']){?>
                                        <br>
                                        <?php echo isset($billing['document'])?$billing['document']:'';?>
                                    <?php }else{?>    
                                        <input type="text" name="document" id="cpfx" value="<?php echo isset($billing['document'])?$billing['document']:'';?>" class="form-control" placeholder="CPF" onblur="load_cpf()" onkeyup="maskdocument()" onkeypress="isNumber();maskdocument();" maxlength="14">
                                    <?php } ?>
                                </div>
                                <div class="col">
                                    <label for="formGroupExampleInput"><b>Nome</b></label>
                                    
                                    <?php if(isset($billing['id']) && $billing['id']){?>
                                    
                                        <br>
                                        <?php echo isset($client->name)?$client->name:'';?>
                                    <?php }else{?>
                                        <br><span id="span_name"></span> 
                                        <!--input type="text"  name="name" value="<?php echo isset($billing['name'])?$billing['name']:'';?>" class="form-control" placeholder="Nome"-->
                                    <?php } ?>                                    
                                </div>
                                <div class="col">
                                    <label for="formGroupExampleInput"><b>Telefone</b></label>
                                    <br>
                                    <?php echo isset($client->phone)?$client->phone:'';?>
                                    <span id="span_phone"></span> 
                                    <!--input type="text" name="phone" class="form-control" value="<?php echo isset($billing['phone'])?$billing['phone']:'';?>" placeholder="Telefone" onkeyup="maskphone()" onkeypress="isNumber()" maxlength="15"-->
                                </div>
                            </div>
                                                        
                            <div class="row form-group">
                                
                                <div class="col">
                                    <label for="formGroupExampleInput"><b>Valor</b></label>
                                    <?php if(isset($billing['id']) && $billing['id']){?>
                                        <br>
                                        <?php echo isset($billing['total'])?$billing['total']:'';?>    
                                    <?php }else{?>    
                                        <input type="text" name="total" class="form-control" value="<?php echo isset($billing['total'])?$billing['total']:'';?>" placeholder="Valor" onKeyPress="return(moeda(this,'.',',',event))" maxlength="10">
                                    <?php } ?>
                                </div>
                                
                                <div class="col">                                   
                                    <label for="formGroupExampleInput"><b>Juros</b></label>
                                    <?php if(isset($billing['id']) && $billing['id']){?>
                                        <br>
                                        <?php echo isset($billing['fees'])?$billing['fees']:'';?>
                                    <?php }else{?>    
                                        <input type="text" name="fees" class="form-control" value="<?php echo isset($billing['fees'])?$billing['fees']:'';?>" placeholder="Juros" onkeypress="isNumber()" maxlength="5">
                                    <?php } ?>
                                    
                                </div>
                                <div class="col">
                                    <label for="formGroupExampleInput"><b>QTD de parcelas</b></label>
                                    <?php if(isset($billing['id']) && $billing['id']){?>
                                        <br>
                                        <?php echo isset($billing['installments'])?$billing['installments']:'';?>
                                    <?php }else{?>    
                                        <input type="text" name="installments" class="form-control" value="<?php echo isset($billing['installments'])?$billing['installments']:'';?>" placeholder="QTD de parcelas" onkeypress="isNumber()" onblur="calc()" maxlength="5">
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col">
                                    <label for="formGroupExampleInput"><b>Valor da parcela</b></label>
                                    <?php if(isset($billing['id']) && $billing['id']){?>
                                        <br>
                                        <?php echo isset($billing['installments_value'])?$billing['installments_value']:'';?>
                                    <?php }else{?>    
                                        <input type="text" name="installments_value" class="form-control" value="<?php echo isset($billing['installments_value'])?$billing['installments_value']:'';?>" placeholder="Valor da parcela" onKeyPress="return(moeda(this,'.',',',event))" maxlength="10">
                                    <?php } ?>
                                </div>
                                <div class="col">
                                    <label for="formGroupExampleInput"><b>Valor a ser pago</b></label>
                                    <?php if(isset($billing['id']) && $billing['id']){?>
                                        <br>
                                        <?php echo isset($billing['amount_to_be_paid'])?$billing['amount_to_be_paid']:'';?>
                                    <?php }else{?>        
                                        <input type="text" name="amount_to_be_paid" class="form-control" value="<?php echo isset($billing['amount_to_be_paid'])?$billing['amount_to_be_paid']:'';?>" placeholder="Valor a ser pago"  onKeyPress="return(moeda(this,'.',',',event))" maxlength="10">
                                    <?php } ?>
                                    
                                </div>
                                
                                <div class="col">
                                    <label for="formGroupExampleInput"><b>Valor pago</b></label>
                                    <br>
                                    <?php echo isset($billing['amount_paid'])?$billing['amount_paid']:'';?>
                                    <!--input type="text" name="amount_paid" class="form-control" value="<?php echo isset($billing['amount_paid'])?$billing['amount_paid']:'';?>" placeholder="Valor pago" onKeyPress="return(moeda(this,'.',',',event))" maxlength="10"-->
                                </div>
                            </div>
                            <input type="hidden" name="id" class="form-control" value="<?php echo isset($billing['id'])?$billing['id']:'';?>" >
                            <?php if(!isset($billing['id'])){?>   
                                <button type="submit" class="btn btn-success" >Salvar</button>
                            <?php } ?>
                            
                        </form>
                    </div>
                    
                </div>                
            </div>
        <?php echo form_close(); ?>   
            <br>

            <?php if(isset($billing['id']) && $billing['id']){ ?>

                <div class="row">
                    <div class="card mb-4" style="width: 100%;" >
                        
                        <div class="card-body">

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Todos</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Espécie</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">PIX</a>
                            </li>
                        </ul>
                        
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Parcelas</th>                            
                                            <th>Valor pago</th>
                                            <th>Data de pagamento</th>
                                            <th>Pagamento</th>
                                            <th>Status</th>
                                            <th>Gerenciar</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                    
                                    <?php if(isset($list_installments) && $list_installments){?>
                                        <?php foreach($list_installments as $list){?>
                                            <!--todos-->
                                            <tr>
                                                <td><?php echo $list['installment'].'/'.$billing['installments'];?></td>
                                                <td><?php echo $list['amount'];?></td>
                                                <td><?php echo $list['payment_date'] !='0000-00-00'?date('d/m/Y', strtotime($list['payment_date'])):'';?></td>
                                                <td>
                                                    <?php echo $list['type']==3?'Espécie':''; ?>
                                                    <?php echo $list['type']==2?'PIX':''; ?>
                                                </td>
                                                <td>
                                                    <?php echo $list['status']==1?'<span class="badge badge-danger">Pendente</span>':''; ?> 
                                                    <?php echo $list['status']==2?'<span class="badge badge-success">Pagamento Sinalizado</span>':''; ?> 
                                                    <?php echo $list['status']==3?'<span class="badge badge-primary">Confirmado</span>':''; ?>
                                                    <?php echo $list['status']==4?'<span class="badge badge-warning">Motoboy enviado</span>':''; ?>
                                                    <?php echo $list['status']==5?'<span class="badge badge-dark">Coleta efetuada</span>':''; ?>
                                                </td>
                                                <td id="tdSendMotoboy">
                                                    <?php if($list['status'] ==2 && $list['type']==2 ){?>
                                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop" onclick="payment(<?php echo $list['id'];?>)">Confirmar pagamento</button>
                                                    <?php }elseif($list['status'] ==2 && $list['type']==3){ ?>
                                                        <!--button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalmotoboy" onclick="loadInstallment(<?php echo $list['id'];?>)">Enviar motoboy</button-->
                                                    <?php }elseif($list['status'] ==5 && $list['type']==3 ){?>
                                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop" onclick="payment(<?php echo $list['id'];?>)">Confirmar pagamento</button>
                                                    <?php }?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </table>

                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Parcelas</th>                            
                                            <th>Valor pago</th>
                                            <th>Data de pagamento</th>
                                            <th>Pagamento</th>
                                            <th>Status</th>
                                            <th>Gerenciar</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                    
                                    <?php if(isset($list_installments) && $list_installments){?>
                                        <?php foreach($list_installments as $list){?>
                                            <!--espécie-->
                                            <?php if($list['type'] == 3){ ?>
                                                <tr>
                                                    <td><?php echo $list['installment'].'/'.$billing['installments'];?></td>
                                                    <td><?php echo $list['amount'];?></td>
                                                    <td><?php echo $list['payment_date'] !='0000-00-00'?date('d/m/Y', strtotime($list['payment_date'])):'';?></td>
                                                    <td>
                                                        <?php echo $list['type']==3?'Espécie':''; ?>
                                                        <?php echo $list['type']==2?'PIX':''; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $list['status']==1?'<span class="badge badge-danger">Pendente</span>':''; ?> 
                                                        <?php echo $list['status']==2?'<span class="badge badge-success">Pagamento Sinalizado</span>':''; ?> 
                                                        <?php echo $list['status']==3?'<span class="badge badge-primary">Confirmado</span>':''; ?>
                                                        <?php echo $list['status']==4?'<span class="badge badge-warning">Motoboy enviado</span>':''; ?>
                                                        <?php echo $list['status']==5?'<span class="badge badge-dark">Coleta efetuada</span>':''; ?>
                                                    </td>
                                                    <td id="tdSendMotoboy">
                                                        <?php if($list['status'] ==2 && $list['type']==2 ){?>
                                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop" onclick="payment(<?php echo $list['id'];?>)">Confirmar pagamento</button>
                                                        <?php }elseif($list['status'] ==2 && $list['type']==3){ ?>
                                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalmotoboy" onclick="loadInstallment(<?php echo $list['id'];?>)">Enviar motoboy</button>
                                                        <?php }elseif($list['status'] ==5 && $list['type']==3 ){?>
                                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop" onclick="payment(<?php echo $list['id'];?>)">Confirmar pagamento</button>
                                                        <?php }?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            
                                        <?php } ?>
                                    <?php } ?>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Parcelas</th>                            
                                            <th>Valor pago</th>
                                            <th>Data de pagamento</th>
                                            <th>Pagamento</th>
                                            <th>Status</th>
                                            <th>Gerenciar</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                    
                                    <?php if(isset($list_installments) && $list_installments){?>
                                        <?php foreach($list_installments as $list){?>
                                            <!--pix-->
                                            <?php if($list['type'] == 2){ ?>
                                                <tr>
                                                    <td><?php echo $list['installment'].'/'.$billing['installments'];?></td>
                                                    <td><?php echo $list['amount'];?></td>
                                                    <td><?php echo $list['payment_date'] !='0000-00-00'?date('d/m/Y', strtotime($list['payment_date'])):'';?></td>
                                                    <td>
                                                        <?php echo $list['type']==3?'Espécie':''; ?>
                                                        <?php echo $list['type']==2?'PIX':''; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $list['status']==1?'<span class="badge badge-danger">Pendente</span>':''; ?> 
                                                        <?php echo $list['status']==2?'<span class="badge badge-success">Pagamento Sinalizado</span>':''; ?> 
                                                        <?php echo $list['status']==3?'<span class="badge badge-primary">Confirmado</span>':''; ?>
                                                        <?php echo $list['status']==4?'<span class="badge badge-warning">Motoboy enviado</span>':''; ?>
                                                        <?php echo $list['status']==5?'<span class="badge badge-dark">Coleta efetuada</span>':''; ?>
                                                    </td>
                                                    <td id="tdSendMotoboy">
                                                        <?php if($list['status'] ==2 && $list['type']==2 ){?>
                                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop" onclick="payment(<?php echo $list['id'];?>)">Confirmar pagamento</button>
                                                        <?php }elseif($list['status'] ==2 && $list['type']==3){ ?>
                                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalmotoboy" onclick="loadInstallment(<?php echo $list['id'];?>)">Enviar motoboy</button>
                                                        <?php }elseif($list['status'] ==5 && $list['type']==3 ){?>
                                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop" onclick="payment(<?php echo $list['id'];?>)">Confirmar pagamento</button>
                                                        <?php }?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                        
                        </div>
                    </div>
                
                </div>

            <?php } ?>

        </div>


        </div>

        
        <!--div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
        </div-->

         <!-- Modal -->
         <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Confirmar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Sim, confirmo o pagamento.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="confirm_payment()">Confirmo</button>
            </div>
            </div>
        </div>
        </div>

        <?php $attributes = array('id' => 'form_payment');?>
        <?php echo form_open('billing/confirm_payment',$attributes); ?>
            <input type="hidden" name="id_installment">
            <input type="hidden" name="detail_id" value="<?php echo isset($detail_id)?$detail_id:'';?>">    
        <?php echo form_close(); ?>

        <div class="modal fade" id="modalmotoboy" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Lista de motoboy</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Motoboys</label>
                    <select class="form-control" id="id_moto" name="id_moto">
                        <?php if(isset($motoboys)){?>
                            <?php foreach($motoboys as $moto){?>
                                <option value="<?php echo $moto['id'];?>" ><?php echo $moto['name']; ?></option>
                            <?php } ?>
                        <?php }?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="send_motoboy()">Confirmo</button>
            </div>
            </div>
        </div>
        </div>

        <input type="hidden" name="id_installment_moto">

  </body>
</html>

<script>
     function load_cpf(){
        
        var xxx = document.getElementById("cpfx");
        console.log(xxx.value);
        cpf = xxx.value;
        $.post("/billing/ajaxGetCpf",{cpf: cpf}, function(response){  
            const obj = JSON.parse(response);

            document.getElementById("span_name").innerHTML = obj.name;           
            document.getElementById("span_phone").innerHTML = obj.phone;            
        });        
        
    }

    function send_motoboy(){
        var moto = document.querySelector('[name="id_moto"]');
        var motoboy = moto.value;
            if(motoboy ==''){
                document.getElementById("id_moto").focus();
                return false;
            }

        var id_installment_moto = document.querySelector('[name="id_installment_moto"]');
        var id_installment = id_installment_moto.value;

       $.post("/billing/ajaxSendMoto",{id_installment: id_installment, id_motoboy: motoboy}, function(){ 
       });

       $.post("/billing/ajaxStatus",{id_installment: id_installment}, function(){        
       });
    }

    function calc(){
        
        var total = document.querySelector('[name="total"]');
            total = total.value;    
            total = total.replace(".", "");
            total = total.replace(",", ".");

        var fees = document.querySelector('[name="fees"]');
            fees = fees.value;

        var installments = document.querySelector('[name="installments"]');
            installments = installments.value;

        $.post("ajaxCalc",{total: total,fees: fees, installments: installments}, function(response){            
            
            const obj = JSON.parse(response);

            var installments_value = document.querySelector('[name="installments_value"]');
            installments_value.value = obj.installments_value;

            var amount_to_be_paid = document.querySelector('[name="amount_to_be_paid"]');
            amount_to_be_paid.value = obj.amount_to_be_paid;
        })
    }            

    function maskdate(){

        var contract_date = document.querySelector('[name="contract_date"]');
        var day ='';

        if(contract_date.value.length ==2){
            day = contract_date.value;
            contract_date.value = day+"/";
        }

        if(contract_date.value.length ==5){
            day = contract_date.value;
            contract_date.value = day+"/";
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

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
            evt.preventDefault();
        } else {
            return true;
        }
    }

    function maskMoney(money){
        //var mon = document.querySelector('[name="'+money+'"]');
        //var numero = mon.value;
        var numero = 1254545;
        //com R$
        var dinheiro = numero.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
        console.log(dinheiro);
    }

    function moeda(a, e, r, t) {
        let n = ""
        , h = j = 0
        , u = tamanho2 = 0
        , l = ajd2 = ""
        , o = window.Event ? t.which : t.keyCode;
        if (13 == o || 8 == o)
            return !0;
        if (n = String.fromCharCode(o),
        -1 == "0123456789".indexOf(n))
            return !1;
        for (u = a.value.length,
        h = 0; h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r); h++)
            ;
        for (l = ""; h < u; h++)
            -1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
        if (l += n,
        0 == (u = l.length) && (a.value = ""),
        1 == u && (a.value = "0" + r + "0" + l),
        2 == u && (a.value = "0" + r + l),
        u > 2) {
            for (ajd2 = "",
            j = 0,
            h = u - 3; h >= 0; h--)
                3 == j && (ajd2 += e,
                j = 0),
                ajd2 += l.charAt(h),
                j++;
            for (a.value = "",
            tamanho2 = ajd2.length,
            h = tamanho2 - 1; h >= 0; h--)
                a.value += ajd2.charAt(h);
            a.value += r + l.substr(u - 2, u)
        }
        return !1
    }
   
    function payment(id){            
        var id_installment = document.querySelector('[name="id_installment"]');
            id_installment.value = id; 
    }

    function confirm_payment(){
        
        document.getElementById("form_payment").submit();                
    }

    function loadInstallment(id){
        var id_installment_moto = document.querySelector('[name="id_installment_moto"]');
            id_installment_moto.value = id;
    }
   
    <?php if(isset($billing['id']) && $billing['id']){ ?> 
        function checkStaus() {
            
            var id = <?php echo $billing['id'];?>;
            //console.log('refresh'+id);

            $.post("/billing/checkStatus",{id: id}, function(response){        
                const obj = JSON.parse(response);
                console.log(obj.status);
                var text_reload = document.getElementById("text_reload").value;
                if(text_reload=='first_access'){
                    document.getElementById("text_reload").value = obj.status;
                }else{
                    if(text_reload != obj.status){
                        location.reload();
                    }
                }
            });
        }
        setInterval(checkStaus, 6000);
    <?php } ?>

//[] - dominio adicionar dominio

</script>
<input type="hidden" id="text_reload" value="first_access">