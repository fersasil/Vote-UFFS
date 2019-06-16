<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Chapas para <?=$titulo?></h1>

<?=var_dump($chapa)?>
<?php die();?>

<!-- Content Row -->
<div class="row">

  <!-- Conheça as chapas -->
  <div class="col-lg-6">

    <div class="card position-relative">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Chapas pendentes</h6>
      </div>
        <div class="card-body">
            <!-- Inicio da apresentação da chapa 1 -->
            <div class="row">
                <?
                  $this->table->set_heading('Informações', 'Aprovar', 'Rejeitar');

                  foreach ($chapas as $chapa) {
                    if($chapa->aprovada == 0){
                      $alterar = anchor(base_url('chapas/aprovar/' . $chapa->id_chapa . $chapa->nome_chapa), '<div class="btn btn-light">Aprovar</div>');
                      $excluir = anchor(base_url('chapas/rejeitar/' . $chapa->id_chapa . $chapa->nome_chapa), '<div class="btn btn-light">Rejeitar</div>');
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

  <!-- Votar -->
  <div class="col-lg-6">

    <div class="card position-relative">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Chapas aprovadas</h6>
      </div>
      <div class="card-body">
        <!-- Inicio do formulario de votação -->
        <?php
          
          $this->table->set_heading('Nome', 'Alterar', 'Excluir');

          foreach ($chapas as $chapa) {
            if($chapa->aprovada == 1){
              $alterar = anchor(base_url('chapas/alterar/' . $chapa->id_chapa . $chapa->nome_chapa), '<div class="btn btn-light">Alterar</div>');
              $excluir = anchor(base_url('chapas/excluir/' . $chapa->id_chapa . $chapa->nome_chapa), '<div class="btn btn-light">Excluir</div>');
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
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
