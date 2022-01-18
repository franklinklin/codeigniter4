<?php //echo"<pre>";print_r($billings);die();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include("bootstrap.php");?>
    
    <script>
            function confirma(){
                if(!confirm('Deseja realmente excluir este registro')){
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
                Cobrança
            </div>
            <div class="card-body">

        <?php echo anchor(base_url($form.'/create'),'Nova Cobrança',['class'=>'btn btn-success mb-3'])?>
        <table class="table table-responsive table-striped table-hover">
            <tr>
                <th>Nome</th>                
                <th>Valor pago</th>
                <th>Valor emprestado</th>
                <th>valor a ser pago</th>
                <th>Ultimo pagamento</th>
                <th>Gerenciar</th>
            </tr>
           
            <?php if(isset($billings) && $billings){ ?>
                <?php foreach($billings as $billing):?>
                    <tr>
                        <td><?php echo $billing['name'];?></td>
                        <td><?php echo 'R$'.$billing['amount_paid'];?></td>
                        <td><?php echo 'R$'.$billing['total'];?></td>
                        <td><?php echo 'R$'.$billing['amount_to_be_paid'];?></td>
                        <?php
                        $data_inicio = new DateTime($billing['last_date']);
                        $data_fim = new DateTime(date('Y-m-d'));

                        // Resgata diferença entre as datas
                        $dateInterval = $data_inicio->diff($data_fim);
                        //$dias = $dateInterval->d + ($dateInterval->y * 12);                       
                        $dias = $dateInterval->days; 
                        if($dias < 3){
                            $flag = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M3 3h9.382a1 1 0 0 1 .894.553L14 5h6a1 1 0 0 1 1 1v11a1 1 0 0 1-1 1h-6.382a1 1 0 0 1-.894-.553L12 16H5v6H3V3z" fill="rgba(47,204,113,1)"/></svg>';
                        }elseif($dias < 4){
                            $flag ='<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M3 3h9.382a1 1 0 0 1 .894.553L14 5h6a1 1 0 0 1 1 1v11a1 1 0 0 1-1 1h-6.382a1 1 0 0 1-.894-.553L12 16H5v6H3V3z" fill="rgba(241,196,14,1)"/></svg>';
                        }elseif($dias > 20){    
                            $flag ='<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M3 3h9.382a1 1 0 0 1 .894.553L14 5h6a1 1 0 0 1 1 1v11a1 1 0 0 1-1 1h-6.382a1 1 0 0 1-.894-.553L12 16H5v6H3V3z" fill="rgba(231,76,60,1)"/></svg>';
                        }
                        ?>

                        <td><?php echo $flag." ".date('d/m/Y', strtotime($billing['last_date']));?></td>
                        <td>
                            <?php echo anchor($form.'/edit/'.$billing['id'], '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M9.243 19H21v2H3v-4.243l9.9-9.9 4.242 4.244L9.242 19zm5.07-13.556l2.122-2.122a1 1 0 0 1 1.414 0l2.829 2.829a1 1 0 0 1 0 1.414l-2.122 2.121-4.242-4.242z"/></svg>')?>                           
                        </td>
                    </tr> 
                <?php endforeach;?>
            <?php }?>
        </table>

        <?php //echo $pager->links('default','bootstrap_pagination');?>
        
        </div>
        </div>

    </div>
    <script src="https://getbootstrap.com/docs/5.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>