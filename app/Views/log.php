<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include("bootstrap.php");?>
    
    <script>
            function confirma(){
                if(!confirm('Deseja realmente excluir este usuário')){
                    return false;
                }
                return true;
            }
    </script>

</head>
<body>

    <?php include("menu.php");?>        

    <div class="container mt-3">
                    
        <div class="card">
            <div class="card-header">
                Registro de ações dos usuários
                <?php //print_r($total_motoboy);?>
                <?php if($total_motoboy){?>
                    <?php
                    $soma_moto = 0;
                    $pix_amount = 0;
                    $especie_amount = 0;
                    $amount = 0;

                       foreach($total_motoboy as $tmoto){

                            if($tmoto['pix'] =='' && $tmoto['especie']==''){

                                $amount = str_replace(".", "", $tmoto['amount']);
                                $amount = str_replace(",", ".", $amount);                
                                $soma_moto = floatval($soma_moto) + floatval($amount);
                            }else{
                                if($tmoto['pix'] !=''){
                                    $amount = str_replace(".", "", $tmoto['pix']);
                                    $amount = str_replace(",", ".", $amount);                
                                    $soma_moto = floatval($soma_moto) + floatval($amount);

                                    $pix = str_replace(".", "", $tmoto['pix']);
                                    $pix = str_replace(",", ".", $pix);                
                                    $pix_amount = floatval($pix_amount) + floatval($pix);
                                }

                                if($tmoto['especie'] !=''){
                                    
                                    $amount = str_replace(".", "", $tmoto['especie']);
                                    $amount = str_replace(",", ".", $amount);
                                    $soma_moto = floatval($amount) + floatval($soma_moto);
                                    
                                    $especie = str_replace(".", "", $tmoto['especie']);
                                    $especie = str_replace(",", ".", $especie);                
                                    $especie_amount = floatval($especie_amount) + floatval($especie);
                                }
                            }
                       } 
                    ?>
                    <span style="float:right;">
                        <b>PIX: </b> R$ <?php echo  number_format($pix_amount, 2, ',', '.');?>
                        <b>Espécie: </b> R$ <?php echo  number_format($especie_amount, 2, ',', '.');?>
                        <b>Total:</b> R$ <?php echo  number_format($soma_moto, 2, ',', '.');?>
                    <span>
                <?php } ?>
            </div>
            <div class="card-body">

        <table class="table table-responsive table-striped table-hover">
            <tr>
                <th>ID</th>    
                <th>Nome</th>
                <th>Perfil</th>
                <th>Modulo</th>                      
                <th>Ação</th>
                <th>Data e hora</th>
            </tr>
            <?php if(isset($logs) && $logs){ ?>
                <?php foreach($logs as $log):?>
                    <tr>
                        <td><?php echo $log['id'];?></td>
                        <td><?php echo $log['user'];?></td>
                        <td><?php echo $log['perfil'];?></td>
                        <td><?php echo $log['module'];?></td>
                        <td><?php echo $log['action'];?></td>
                        <td><?php echo date('d/m/Y H:i:s', strtotime($log['date']));?></td>
                    </tr> 
                <?php endforeach;?>
            <?php }?>
        </table>
        <?php //echo $pager->links('default','bootstrap_pagination');?>
        
        </div>
        </div>

    </div>
    <footer class="footer mt-auto py-3">
        <div class="container">
        <span class="text-muted"><a href="https://consultordevendassbc.com/" target="_blank">Criado por Consultor de Vendas.</a></span>
        </div>
    </footer>
    <script src="https://getbootstrap.com/docs/5.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>