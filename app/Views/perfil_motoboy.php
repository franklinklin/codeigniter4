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

            <?php 
                $check = array();
                foreach($paid as $val){ 
                    $check[] = $val['id_billing'];
                }
            ?>
           
            <div class="row">
                <div class="card mb-4" style="width: 100%;" >
                    
                    <div class="card-header">
                        <b>Lista de cobrança</b>
                    </div>

                    <div class="card-body">
                    <?php //echo"<pre>";print_r($billings);?>
                    <table id="example" class="table table-responsive table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Contrato </th>  
                                    <th>Cliente </th>                            
                                    <th>Endereço</th>
                                    <th>Contato</th>
                                    <th>Parcela</th>
                                    <th>a pagar</th>
                                    <th>total</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php if(isset($billings) && $billings){?>
                                <?php foreach($billings as $billing){?>

                                    <?php if (!in_array($billing['id'], $check)) {  ?>
                                        <tr>
                                            <td><?php echo $billing['id'];?></td>
                                            <td><?php echo $billing['name'];?></td>
                                            <td><?php echo $billing['address']." Nº:".$billing['number'].', Bairro:'.$billing['district'].', CEP:'.$billing['zipcode'] ?></td>
                                            <td><?php echo $billing['phone'];?></td>
                                            <td><?php echo $billing['installments'];?></td>
                                            <td><?php echo $billing['amount_paid'];?></td>
                                            <td><?php echo $billing['amount_to_be_paid'];?></td>                                                                                 
                                            <td>
                                                <?php echo anchor('billing/detail_motoboy/'.$billing['id'], '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M9.243 19H21v2H3v-4.243l9.9-9.9 4.242 4.244L9.242 19zm5.07-13.556l2.122-2.122a1 1 0 0 1 1.414 0l2.829 2.829a1 1 0 0 1 0 1.414l-2.122 2.121-4.242-4.242z"/></svg>')?>
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

        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Confirmação de coleta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Sim, confirmo a coleta do dinheiro.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="confirm_collect()">Confirmo</button>
            </div>
            </div>
        </div>
        </div>
        
  </body>

    <?php $attributes = array('id' => 'form_payment');?>
    <?php echo form_open('billing/collect',$attributes); ?>
        <input type="hidden" name="id_collect">
    <?php echo form_close(); ?> 

    <script>
        function collect(id){            
            var id_collect = document.querySelector('[name="id_collect"]');
                id_collect.value = id; 
        }

        function confirm_collect(){
            document.getElementById("form_payment").submit();                
        }
    </script>
</html>
