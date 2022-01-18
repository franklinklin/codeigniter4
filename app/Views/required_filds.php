<?php if(isset($required) && $required ){ ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Campos obrigatórios!</strong>
        <?php $ul ="<ul>";
            foreach($required as $req) {
                $ul.="<li>$req</li>";
            }
            $ul.="</ul>";
            echo $ul;
        ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>