

<?php if(isset($success) && $success ){ ?>
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <strong>Salvo com sucesso!</strong>                
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>

<?php if(isset($success_edit) && $success_edit ){ ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Atualizado com sucesso!</strong>                
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>
