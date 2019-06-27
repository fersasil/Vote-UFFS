<div id="content-wrapper">

<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="<?=base_url()?>">Home</a>
    </li>
    <li class="breadcrumb-item active"><?=$essa_eleicao->nome?></li>
  </ol>

  <!-- Page Content -->


<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 ">Gerenciar Eleição</h1>



<!-- Content Row -->
<div class="row">

  <!-- Conheça as chapas -->
  <div class="col-lg-6">

    <div class="card position-relative">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Chapas pendentes</h6> 
      </div>
        <div class="card-body">
        <?php
            if($res == 1){
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <strong>Chapa Aprovada com sucesso!</strong> 
        </div>
        <?php
            }
            else if($res == md5('rejeitada')){
        ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>Chapa Rejeitada com sucesso!</strong> 
                <hr>
                <p>A chapa foi excluida do sistema!</p>
            </div>
            <?php
            }?>
        
            <!-- Inicio da apresentação da chapa 1 -->
            <div class="row">
            <div class="table-responsive">
                <?
                  $this->table->set_heading('Informações', 'Aprovar', 'Rejeitar');

                  foreach ($chapas as $chapa) {
                    if($chapa->chapa_aprovada == 0){
                      $alterar = anchor(base_url('admin/aprovar_chapa/' . $id_eleicao . '/' . $chapa->id_chapa . '/' . $nome_eleicao), '<div class="btn btn-light">Aprovar</div>');
                      $excluir = anchor(base_url('admin/rejeitar_chapa/' . $id_eleicao . '/' . $chapa->id_chapa . '/' . $nome_eleicao), '<div class="btn btn-light">Rejeitar</div>');
                      $this->table->add_row(anchor('admin/chapa-conf/' . $chapa->id_chapa . '/' , $chapa->nome_chapa), $alterar, $excluir);
                    }
                  }
                
                  $this->table->set_template(array(
                  'table_open' => '<table class="table table-striped">'
                  ));
          
                  echo $this->table->generate();
                ?>
            </div>

        </div>
        </div>
    </div>

  </div>

  <!-- Votar -->
  <div class="col-lg-6">

    <div class="card position-relative">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Chapas aprovadas</h6>
      </div>
      <div class="card-body">
        <?php
        if($res == md5('excluida')){
        ?>
            <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>Chapa excluida com sucesso!</strong> 
                <hr>
                <p>A chapa foi excluida do sistema!</p>
            </div>
        <?php
        }?>
        <!-- Inicio do formulario de votação -->
        <div class="table-responsive">
        <?php
          
          $this->table->set_heading('Nome', 'Alterar', 'Excluir');

          foreach ($chapas as $chapa) {
            if($chapa->chapa_aprovada == 1){
              $alterar = anchor(base_url('chapas/alterar/' . $chapa->id_chapa . '/' . $chapa->nome_chapa), '<div class="btn btn-light">Alterar</div>');
              $excluir = anchor(base_url('admin/excluir_chapa/' . $id_eleicao . '/' . $chapa->id_chapa . '/' . $nome_eleicao), '<div class="btn btn-light">Excluir</div>');
              $this->table->add_row(anchor('chapas/mais/' . $chapa->id_chapa . '/' , $chapa->nome_chapa), $alterar, $excluir);
            }
          }

          $this->table->set_template(array(
            'table_open' => '<table class="table table-striped">'
        ));
          
          echo $this->table->generate();
        ?>

      </div>
    </div>
    </div>


  </div>


</div>

<br>
<!--  -->

<div class="row">

  <div class="col-md-6 pb-4">
    <div id="successAtivarEleicao"></div>
        
        <div class=" btn-group btn-group-toggle" data-toggle="buttons">
            <button id="iniciar_eleicao" class="btn btn-secondary">Iniciar Eleição</button>
            <button  id="contar_votos" class="btn btn-secondary">Contar Votos</button>
            <button  id="encerrar_eleicao" class="btn btn-secondary">Encerrar Eleição</button>
        </div>

        <input type="hidden"  id="nome_eleicao_hidden" value="<?=$essa_eleicao->nome?>">
        <input type="hidden"  id="id_eleicao_hidden" value="<?=$essa_eleicao->id_eleicao?>">
    </div>
    <div class="card-body">
    <!-- Resposta da busca! -->
        <div id="result_card" style="display: none" class="alert alert-secondary alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
            <div class="text-center">
            <strong id="text-res_eleicao" class="h3"></strong> 
            </div>
        <hr>
        <div class="row" id="resPlace"> 
        </div>
        </div>
    </div>

</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


</div>