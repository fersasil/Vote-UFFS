<div id="content-wrapper">

<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="<?=base_url()?>">Home</a>
    </li>
    <li class="breadcrumb-item">
        <a href="<?=base_url('admin/eleicoes_finalizadas')?>">Eleições Finalizadas</a>
    </li>
    <li class="breadcrumb-item active"><?=$eleicao->nome?></li>
  </ol>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0"><?=$eleicao->nome?></h1>
    </div>

    
<!-- Content Row -->

<div class="row">

<!-- Area Chart -->
<div class="col-xl-12 col-lg-12">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Resumo</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <?=$eleicao->descricao?>
    </div>
  </div>
</div>

<!-- Pie Chart -->

</div>


<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Votos</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
    <table id="tableResultado" class="table table-striped table-bordered" style="width:100%">
      <thead>
          <tr>
              <th>Votante</th>
              <th>Chapa</th>
              <th>Nome</th>
              <th>Data</th>
          </tr>
      </thead>
          
      <tbody id="tableInfo">
          <?php
              foreach ($votos as $v) {
                  echo "<tr class='even'>";
                  echo '<th>' . $v['publicKey'] . '</th>';
                  echo '<th>' . $v['candidateNumber'] . '</th>';
                  echo '<th>' . $v['candidateName'] . '</th>';
                  echo '<th>' . $v['date'] . '</th>';
                  echo '</tr>';
              }
          ?>
      </tbody>

      <tfoot>
          <tr>
              <th>Votante</th>
              <th>Chapa</th>
              <th>Nome</th>
              <th>Data</th>
          </tr>
      </tfoot>
    </table>
    </div>
</div>
</div>

</div>

</div>