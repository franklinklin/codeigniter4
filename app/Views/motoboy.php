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
                Motoboy
            </div>
            <div class="card-body">

        <?php echo anchor(base_url($form.'/create'),'Novo Motoboy',['class'=>'btn btn-success mb-3'])?>
        
        <table class="table table-responsive table-striped table-hover">
            <tr>
                <th>Nome</th>                
                <th>email</th>
                <th>Contato</th>
                <th>CPF</th>
                <th>Bairro</th>
                <th>Cidade</th>
                <th>UF</th>
                <th>Ação</th>
            </tr>
            <?php if(isset($clients) && $clients){ ?>
                <?php foreach($clients as $client):?>
                    <tr>
                        <td><?php echo $client['name'];?></td>
                        <td><?php echo $client['email'];?></td>
                        <td><?php echo $client['phone'];?></td>
                        <td><?php echo $client['document'];?></td>
                        <td><?php echo $client['district'];?></td>
                        <td><?php echo $client['city'];?></td>
                        <td><?php echo $client['state'];?></td>
                        <td>
                            <?php echo anchor($form.'/edit/'.$client['id'], '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M9.243 19H21v2H3v-4.243l9.9-9.9 4.242 4.244L9.242 19zm5.07-13.556l2.122-2.122a1 1 0 0 1 1.414 0l2.829 2.829a1 1 0 0 1 0 1.414l-2.122 2.121-4.242-4.242z"/></svg>')?>
                            -
                            <?php echo anchor($form.'/delete/'.$client['id'], '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M4 8h16v13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V8zm3-3V3a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v2h5v2H2V5h5zm2-1v1h6V4H9zm0 8v6h2v-6H9zm4 0v6h2v-6h-2z"/></svg>',['onclick'=>'return confirma()'])?>
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