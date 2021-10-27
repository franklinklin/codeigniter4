<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

   <title>Sistema de cobrança</title>
    
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
                Login
            </div>
            <div class="card-body">

        <?php echo anchor(base_url('login/create'),'Novo usuário',['class'=>'btn btn-success mb-3'])?>
        
        <table class="table table-responsive table-striped table-hover">
            <tr>
                <th>ID</th>
                <th>email</th>
                <th>password</th>
                <th>acão</th>
            </tr>
            <?php if(isset($logins) && $logins){ ?>
                <?php foreach($logins as $login):?>
                    <tr>
                        <td><?php echo $login['id'];?></td>
                        <td><?php echo $login['email'];?></td>
                        <td><?php echo $login['password'];?></td>
                        <td>
                            <?php echo anchor('login/edit/'.$login['id'], 'Editar')?>
                            -
                            <?php echo anchor('login/delete/'.$login['id'], 'Excluir',['onclick'=>'return confirma()'])?>
                        </td>
                    </tr> 
                <?php endforeach;?>
            <?php }?>
        </table>
        <?php echo $pager->links('default','bootstrap_pagination');?>
        
        </div>
        </div>

    </div>
    <script src="https://getbootstrap.com/docs/5.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>