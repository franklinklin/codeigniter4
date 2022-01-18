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
                <div class="card mb-4" style="width: 100%;" >
                    
                    <div class="card-header">
                        <b>Emprestimo</b>
                    </div>

                    <div class="card-body">
                    
                    <table id="example" class="table table-responsive table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>                            
                                    <th>Total</th>
                                    <th>Parcela</th>
                                    <th>A pagar</th>
                                    <th>Gerenciar</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            <?php if(isset($billings) && $billings){ ?>
                                <?php foreach($billings as $billing){?>
                                    <tr>
                                        <td><?php echo $billing['id'];?></td>
                                        <td><?php echo $billing['total'];?></td>
                                        <td><?php echo $billing['installments'];?></td>
                                        <td><?php echo $billing['amount_to_be_paid'];?></td>
                                        <td>
                                            <?php echo anchor('billing/detail/'.$billing['id'], '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M9.243 19H21v2H3v-4.243l9.9-9.9 4.242 4.244L9.242 19zm5.07-13.556l2.122-2.122a1 1 0 0 1 1.414 0l2.829 2.829a1 1 0 0 1 0 1.414l-2.122 2.121-4.242-4.242z"/></svg>')?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>

                        </table>
                    </div>
                </div>
               
            </div>
        </div>
        </div>
  </body>
</html>
