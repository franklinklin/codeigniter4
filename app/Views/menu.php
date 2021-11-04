<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Sistema de cobrança</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('billing');?>">Atendimentos</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Cadastro
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          
            <a class="dropdown-item" href="<?php echo base_url('client');?>">Clientes</a>
            <div class="dropdown-divider"></div>            
            <a class="dropdown-item" href="<?php echo base_url('motoboy');?>">Motoboys</a>
            <div class="dropdown-divider"></div>
            <!--a class="dropdown-item" href="<?php echo base_url('company');?>">Empresas</a>            
            <div class="dropdown-divider"></div--> 
            <a class="dropdown-item" href="<?php echo base_url('user');?>">Usuários</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('log');?>">Log de dados</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('login/logout');?>">Sair</a>
      </li>
    </ul>
    
    <?php echo form_open($search, 'class="form-inline my-2 my-lg-0" id="searchForm"'); ?>
        <input name='search' class="form-control mr-sm-2" type="search" placeholder="digite uma palavra" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" 
                id="btnsearch" 
                type="button" 
                onclick='document.getElementById("searchForm").submit();'>Pesquisa</button>
    <?php echo form_close(); ?>    
  </div>
</nav>
    <!--nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Sistema de cobrança</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
           
            <li class="nav-item">
                <a class="nav-link" href="#">Atendimentos</a>
            </li>
            
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Cadastro
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Clientes</a>
                    <a class="dropdown-item" href="#">Empresas</a>
                    <a class="dropdown-item" href="#">Funcionários</a>
                    <a class="dropdown-item" href="#">Motoboys</a>
                    <a class="dropdown-item" href="#">Serviços</a>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">Log de dados</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">Sair</a>
            </li>
        </ul>
        <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        </div>
    </nav-->
