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
        <?php include("menu_client.php");?>

        <br>

        <div class="container">
            

            <div class="row">

            <?php echo anchor('billing/', 'Voltar')?>
            
                <div class="card mb-4" style="width: 100%;" >
                    
                    <div class="card-header">
                        <b>Emprestimo R$<?php echo isset($billing['total'])?$billing['total']:'';?> </b>
                    </div>

                    <div class="card-body">
                    
                    <table id="example" class="table table-responsive table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Parcela</th>
                                    <th>Data</th>                                    
                                    <th>Tipo</th>

                                    <?php if(isset($perfil_moto) && $perfil_moto){?>
                                        <th>PIX</th>
                                        <th>Espécie</th>
                                    <?php } ?>

                                    <th>Status</th>

                                    <th>Ação</th>
                                    
                                    <?php if(isset($perfil_moto) && $perfil_moto){?>
                                        <th>Observação</th>
                                    <?php } ?>

                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($list_installments) && $list_installments){?>
                                    <?php foreach($list_installments as $list){?>
                                        <tr>
                                            <?php $installments = isset($billing['installments'])?$billing['installments']:'';?>
                                            <td><?php echo $list['installment'].'/'.$installments;?></td>
                                            <td><?php echo $list['amount'];?></td>
                                            <td><?php echo $list['payment_date'] !='0000-00-00'?date('d/m/Y', strtotime($list['payment_date'])):'';?></td>
                                            <td>
                                                <?php if($list['status'] !=2 && $list['status'] !=3){?>
                                                    <select class="custom-select" name="type_<?php echo $list['id'];?>">
                                                        <option value="2">PIX</option>
                                                        <option value="3">Espécie</option>
                                                        <option value="4">PIX e Espécie</option>
                                                    </select>
                                                <?php }else{ ?>
                                                    <?php echo $list['type']==3?'Espécie':''; ?>
                                                    <?php echo $list['type']==2?'PIX':''; ?>
                                                    <?php echo $list['type']==4?'PIX e Espécie':''; ?>
                                                <?php } ?>
                                            </td>

                                            <?php if(isset($perfil_moto) && $perfil_moto){?>
                                                <td>
                                                    <?php if($list['status'] ==2){?>
                                                        <input type="text" size="4" placeholder="PIX" id="pix_<?php echo $list['id'];?>" class="form-control" onKeyPress="return(moeda(this,'.',',',event))" maxlength="5">
                                                    <?php }else{ ?>
                                                        <?php echo $list['pix'];?>
                                                    <?php } ?>    
                                                </td>
                                                <td>
                                                    <?php if($list['status'] ==2){?>
                                                        <input type="text" size="4" placeholder="Espécie" id="especie_<?php echo $list['id'];?>" class="form-control" onKeyPress="return(moeda(this,'.',',',event))" maxlength="5">
                                                    <?php }else{ ?>
                                                        <?php echo $list['especie'];?>
                                                    <?php } ?>    
                                                </td>
                                            <?php }?>

                                            <td>
                                                <?php echo $list['status']==2?'<span class="badge badge-success">Pagamento Sinalizado</span>':"";?>
                                                <?php echo $list['status']==3?'<span class="badge badge-primary">Confirmado</span>':"";?>
                                            </td>
                                            <td>
                                                <?php if(isset($perfil_moto) && $perfil_moto){?>
                                                    <?php if($list['status'] ==2){?>
                                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalMotoboy" onclick="motoboy_payment(<?php echo $list['id'];?>)">Confirmar</button>
                                                    <?php } ?>
                                                <?php }else{?>
                                                    <?php if($list['status'] !=2 && $list['status'] !=3){?>
                                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop" onclick="payment(<?php echo $list['id'];?>)">Pagar</button>
                                                    <?php } ?>
                                                <?php }?>
                                            </td>
                                            <?php if(isset($perfil_moto) && $perfil_moto){?>
                                                <td>
                                                    <?php if($list['status'] ==2){?>
                                                        <textarea class="form-control" id="obs_<?php echo $list['id'];?>" placeholder="observação"></textarea>
                                                    <?php }else{ ?>    
                                                        <?php echo $list['obs'];?>
                                                    <?php } ?>    
                                                </td>
                                            <?php } ?>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>                               
                        </table>
                    </div>
                </div>
               
            </div>
        </div>

        </div>


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

        <!-- Motoboy-->
        <div class="modal fade" id="modalMotoboy" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="motoboy_confirm_payment()">Confirmo</button>
            </div>
            </div>
        </div>
        </div>
        <?php $attributes = array('id' => 'form_payment');?>
        <?php echo form_open('billing/payment',$attributes); ?>
            <input type="hidden" name="id_installment">
            <input type="hidden" name="type_payment">
            <input type="hidden" name="advance">
            <input type="hidden" name="detail_id" value="<?php echo $detail_id;?>">
        <?php echo form_close(); ?> 

        <?php $attributes_ = array('id' => 'form_confirm_payment');?>
        <?php echo form_open('billing/confirm_payment',$attributes_); ?>
            <input type="hidden" name="id_installment" id="id_installment_confirm">
            <input type="hidden" name="detail_id" value="<?php echo isset($detail_id)?$detail_id:'';?>">
            <input type="text" name="obs" id="moto_obs">
            <input type="text" name="pix" id="moto_pix">
            <input type="text" name="especie" id="moto_especie">
            <input type="hidden" name="redirect_detail_motoboy" value=1>         
        <?php echo form_close(); ?>

        <script>

            function motoboy_confirm_payment(){
                document.getElementById("form_confirm_payment").submit();                   
            }
            
            function motoboy_payment(id){

                var id_installment = document.querySelector('#id_installment_confirm');
                    id_installment.value = id;

                var obs = document.querySelector('#obs_'+id).value;
                var pix = document.querySelector('#pix_'+id).value;
                var especie = document.querySelector('#especie_'+id).value;

                document.querySelector('#moto_obs').value = obs;
                document.querySelector('#moto_pix').value = pix;
                document.querySelector('#moto_especie').value = especie;
            }

            function payment(id){            
                var id_installment = document.querySelector('[name="id_installment"]');
                    id_installment.value = id; 

                var type_id = document.querySelector('[name="type_'+id+'"]');
                var type_payment = document.querySelector('[name="type_payment"]');
                    type_payment.value = type_id.value;
            }

            function confirm_payment(){
                
                document.getElementById("form_payment").submit();                
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
        </script>
        
  </body>
</html>
