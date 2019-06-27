<!-- Sidebar -->
<ul class="sidebar navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="<?=base_url()?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=base_url('admin/cadastrar-eleicao')?>">
          <i class="fas fa-fw fa-calendar-plus"></i>
          <span>Nova Eleição</span></a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Eleições Ativas</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <h6 class="dropdown-header">Já Iniciadas:</h6>
            <div id="iniciada_admin">
              <?php
                foreach ($eleicoes as $e) {
                  if($e->eleicao_ja_iniciada){ ?>
                    <a class="dropdown-item" href="<?=base_url('admin/eleicao/' . $e->id_eleicao .'/' . friendly_url($e->nome))?>"><?=$e->nome?></a> <?php
                    }
                  }
              ?>
            </div>
          <div class="dropdown-divider"></div>
          <h6 class="dropdown-header">Não iniciadas</h6>
          <div id="nao_iniciada_admin">
            <?php
              foreach ($eleicoes as $e) {
                if(!$e->eleicao_ja_iniciada){ ?>
                  <a class="dropdown-item" href="<?=base_url('admin/eleicao/' . $e->id_eleicao .'/' . friendly_url($e->nome))?>"><?=$e->nome?></a> <?php
                  }
                }
            ?>              
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=base_url('admin/eleicoes_finalizadas')?>">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Eleições Finalizadas</span></a>
      </li>
    </ul>