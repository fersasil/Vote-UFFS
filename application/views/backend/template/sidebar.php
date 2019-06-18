<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

<!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=base_url('home')?>">
        <div class="sidebar-brand-icon">
          <!-- <i class="fas fa-laugh-wink"></i> -->
          <img src="<?=base_url('assets/img/logo.png')?>">
        </div>
        <div class="sidebar-brand-text mx-3"> Portal de votação</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="<?=base_url('home')?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Principal
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Eleições</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Votações Disponíveis:</h6>
            <div id="eleicoes_ativas_user">
            <?php
              if(count($eleicoes) == 0){
                echo '<a class="disabled collapse-item">Nenhuma eleição</a>';
              }
              else{
                foreach($eleicoes as $eleicao){
                  if($eleicao->eleicao_ativa){
            ?>
                <a class="veri collapse-item" href="<?=base_url('votacao/votar/' . $eleicao->id_eleicao .'/' . friendly_url($eleicao->nome))?>"><?=$eleicao->nome?></a>
            <?php
                  }
                }
              }
            ?>
            </div>
            <h6 class="collapse-header">Mais:</h6>
            <a class="collapse-item" href="<?=base_url('chapas/cadastrar_chapa')?>">Cadastrar uma chapa</a>
          </div>
        </div>
      </li>

      <hr class="sidebar-divider">

      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Mais</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Ajuda:</h6>
            <a class="collapse-item" href="<?=base_url('/ajuda/gerar_chave_publica')?>">Gerar chave Publica</a>
            <a class="collapse-item" href="<?=base_url('/ajuda/pesquisar_na_blockchain')?>">Pesquisar na blockchain</a>
            <a class="collapse-item" href="<?=base_url('/ajuda/historico_votos')?>">Histórico de votos</a>

            <h6 class="collapse-header">Informações:</h6>
            <a class="collapse-item" href="<?=base_url('/como-votar')?>">Como votar?</a>
            <a class="collapse-item" href="<?=base_url('/como-funciona')?>">Como funciona?</a>
            <a class="collapse-item" href="<?=base_url('/seguranca')?>">Segurança</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Contato:</h6>
            <a class="collapse-item active" href="<?=base_url('/fale-conosco')?>">Fale-conosco</a>
            <!-- <a class="collapse-item" href="blank.html"></a> -->
          </div>
        </div>
      </li>

      <hr class="sidebar-divider">

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="<?=base_url('resultados')?>">
          <i class="fas fa-fw fa-table"></i>
          <span>Resultados</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>

       

      
    <!-- End of Sidebar -->