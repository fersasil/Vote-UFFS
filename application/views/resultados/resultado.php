<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Eleições encerradas</h1>
</div>

<div class="row">
    <?php
      foreach ($eleicoes as $e){
        if(!$e->eleicao_ativa && $e->eleicao_ja_iniciada){
    ?>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card">
        <img class="card-img-top" src="<?=$e->img?>" alt="">
        <div class="card-body">
          <h4 class="card-title">
            <a href="<?=base_url('resultados/eleicao/' . $e->id_eleicao . "/" . friendly_url($e->nome))?>">
              <?=$e->nome?>
            <a>
          </h4>

          <p class="card-text">Finalizada em: <?=$e->fim_eleicao?></p>
        </div>
      </div>
    </div>
  <?php
        }
      }
  ?>



</div>
</div>
</div>
<!-- /.container-fluid -->