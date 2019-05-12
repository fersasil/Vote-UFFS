 <body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

<!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=base_url('admin')?>">
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
        <a class="nav-link" href="<?=base_url('admin')?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

 <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
          Administração
        </div>
        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Gerenciar </span>
        </a>
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="<?=base_url('admin/cadastrar-eleicao')?>">Cadastrar Eleição</a>
            <h6 class="collapse-header">Eleições Disponíveis:</h6>
            <a class="collapse-item" href="<?=base_url('admin/eleicao/0/colegiado-cc')?>">Colegiado CC</a>
            <a class="collapse-item" href="<?=base_url('admin/eleicao/1/dce')?>">DCE</a>
            <a class="collapse-item" href="<?=base_url('admin/eleicao/2/reitoria-uffs')?>">Reitoria UFFS</a>
          </div>
        </div>
      </li>

      <hr class="sidebar-divider">

      <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Ajuda</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?=base_url('admin/cadastrando-eleicao')?>">Cadastrando eleição</a>
            <a class="collapse-item" href="<?=base_url('admin/editando-eleicao')?>">Editando eleição</a>
            <a class="collapse-item" href="<?=base_url('admin/excluindo-eleicao')?>">Excluindo eleição</a>
            <a class="collapse-item" href="<?=base_url('admin/candidatos-chapas')?>">Candidatos e Chapas</a>
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


    <div id="content-wrapper" class="d-flex flex-column">
      <br>
      <br>
      <!-- Main Content -->
      <div id="content">
