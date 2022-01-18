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
    <script src="https://getbootstrap.com/docs/5.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>