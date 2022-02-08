<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Sistema de cobrança</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('billing');?>">Cobrança</a>
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
    <?php if(isset($search)){?>
      <?php //print_r($user);?>
      <?php echo form_open($search, 'class="form-inline my-2 my-lg-0" id="searchForm"'); ?>
          <?php if(isset($search_log) && $search_log){ ?>
                <select class="form-control mr-sm-2" name="user_search" >
                    <option></option>
                    <?php if(isset($user) && $user){ ?>
                        <?php foreach($user as $ur){?>
                          <?php 
                              if($ur['id_perfil']==1){
                                $perfil = 'Administrador';

                              }elseif($ur['id_perfil']==2){
                                $perfil = 'Cliente';

                              }elseif($ur['id_perfil']==3){
                                $perfil = 'Motoboy';
                              }                          
                          ?>
                          <option value="<?php echo $ur['id'];?>" <?php echo isset($search_data['user_search']) && $search_data['user_search'] == $ur['id']?'selected':'';?> ><?php echo $ur['name']."-".$perfil;?></option>
                        <?php } ?>
                      <?php } ?>                   
                </select>
                
                <input name='date_search' class="form-control mr-sm-2" type="text" id="datepicker" size=7 value="<?php echo isset($search_data['date_search'])?$search_data['date_search']:'';?>">
                <input name='date_search_end' class="form-control mr-sm-2" type="text" id="datepicker_end" size=7 value="<?php echo isset($search_data['date_search_end'])?$search_data['date_search_end']:'';?>">
          <?php } ?>
          <input name='search' class="form-control mr-sm-2" type="search" placeholder="digite uma palavra" aria-label="Search" value="<?php echo isset($search_data['search'])?$search_data['search']:'';?>">
          <button class="btn btn-outline-success my-2 my-sm-0" 
                  id="btnsearch" 
                  type="button" 
                  onclick='document.getElementById("searchForm").submit();'>Pesquisa</button>
      <?php echo form_close(); ?>  
    <?php } ?>  
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script>  
    $( function() {
    $( "#datepicker, #datepicker_end" ).datepicker({
      dateFormat: 'dd/mm/yy',
      dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
      dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
      dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
      monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
      monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
      nextText: 'Proximo',
      prevText: 'Anterior'
    });
  } );
</script>
