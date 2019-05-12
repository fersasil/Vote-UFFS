<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Chapas para <?=$titulo?></h1>



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
                  $alterar = anchor(base_url('/chapas/alterar/01/diversa'), '<div class="btn btn-light">Aprovar</div>');
                  $excluir = anchor(base_url('/chapas/excluir/01/diversa'), '<div class="btn btn-light">Rejeitar</div>');
                  $this->table->set_heading('Informações', 'Aprovar', 'Rejeitar');
                  $this->table->add_row(anchor('chapas/pendentes/1' , 'Diversa'), $alterar, $excluir);
                  $this->table->add_row(anchor('chapas/pendentes/1', 'Plural'), $alterar, $excluir);
                  $this->table->add_row(anchor('chapas/pendentes/1', 'Conserta'), $alterar, $excluir);

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
          //$this->load->library('table');
          $alterar = anchor(base_url('/chapas/alterar/01/diversa'), '<div class="btn btn-light">Alterar</div>');
          $excluir = anchor(base_url('/chapas/excluir/01/diversa'), '<div class="btn btn-light">Excluir</div>');

          $this->table->set_heading('Nome', 'Alterar', 'Excluir');


          
          $this->table->add_row('Diversa', $alterar, $excluir);
          $this->table->add_row('Plural', $alterar, $excluir);
          $this->table->add_row('Conserta', $alterar, $excluir);

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
