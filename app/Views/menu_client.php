<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Sistema de cobrança</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('login/logout');?>">Sair</a>
      </li>
    </ul>
    <?php if(isset($search)){?>
    <?php echo form_open($search, 'class="form-inline my-2 my-lg-0" id="searchForm"'); ?>
        <input name='search' class="form-control mr-sm-2" type="search" placeholder="digite uma palavra" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" 
                id="btnsearch" 
                type="button" 
                onclick='document.getElementById("searchForm").submit();'>Pesquisa</button>
    <?php echo form_close(); ?>    
    <?php } ?>
  </div>
</nav>