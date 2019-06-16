<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?=$eleicao->nome?></h1>

<!-- Content Row -->
<div class="row">

  <!-- Conheça as chapas -->
  <div class="col-lg-6">

    <div class="card position-relative">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Conheça as Chapas</h6>
      </div>
        <div class="card-body">
            <!-- Inicio da apresentação da chapa 1 -->
            <?php
              //var_dump($chapas);
              //die();
              if(count($chapas) == 0){
                echo "<p>Nenhuma chapa aprovada!</p></div></div></div>";
              }
              else{
                foreach ($chapas as $chapa) {
                  
                //}
              //}
            ?>
            <div class="row">
                <div class="col-lg-6 text-center"><img class="img-responsive rounded-circle" src="http://placehold.it/200x200"></div>
                <div class="col-lg-6">
                    <p><h3 class="text-center h5 mb-4 text-gray-800"><?=$chapa->nome_chapa?></h3></p>
                    <p><?=$chapa->descricao?></p>
                    <p><a href="<?=base_url('chapa/info/' . $chapa->id_chapa . '/' . friendly_url($chapa->nome_chapa))?>">Saiba mais</a></p>
                </div>
            </div>

            <hr> <!-- Coloca um traço que separa as chapas   -->
            <?php
                }
            ?>

        </div>
    </div>

  </div>

  <!-- Votar -->
  <div class="col-lg-6">

    <div class="card position-relative">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Votar</h6>
      </div>
      <div class="card-body">
        <!-- Inicio do formulario de votação -->
          <?=form_open(base_url('votacao/realizar_votar'))?>
            <div class="form-group form">
                <label>Chave privada</label>
                <input disabled id="chavePrivada" autocomplete="off" name="chavePrivada" class="form-control" placeholder="Digite a sua chave privada">
            </div>     
            <div class="form-group">
                <label>Chapa</label>
                <select disabled id="id_chapa" name="id_chapa" class="custom-select">
                    <option value="-1" selected disabled hidden>Escolha aqui</option>
                    <?php foreach($chapas as $chapa){?>
                      <option value="<?=$chapa->id_chapa?>"><?=$chapa->nome_chapa?></option>
                    <?php }?>
                  </select>
            </div>

            <input type="hidden" name="id_eleicao" value="<?=$id_eleicao?>">
            <input type="hidden" name="nome_eleicao" value="<?=$nome_eleicao?>">

            <div id="info-votation" class="alert alert-warning" role="alert">
                <h4 class="alert-heading">Ainda não!</h4>
                <p>A votação não é hoje! Você pode clicar <a class="alert-link" href="#">aqui</a> para saber mais sobre ela</p>
            </div>

            <div style="display: none" id="info-v-ok" class="alert alert-info" role="alert">
                <h4 class="alert-heading">Ja pode votar!</h4>
                <p>Você só podera votar uma única vez, seu voto é inalterável</p>
                <hr>
                <p>Sua chave privada só funcionára uma vez! Não a jogue fora após a eleição e nem a compartilhe com nimguem</p>
            </div>

            <input disabled value="Votar" id="votarEleicao" type="submit" class="btn btn-default">
            <button type="reset" id="btn-limpar" disabled class="btn btn-default">Limpar</button>
        </form>
      </div>
    </div>

  </div>
  <?php 
              }
  ?>

  

</div>




</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
    const dataServidor = "<?=$dia_de_hoje?>"
    const dataInicioVotacao = "<?=$eleicao->inicio_eleicao?>"
    const dataFimVotacao = "<?=$eleicao->fim_eleicao?>"

 
    const hServidor = new Date(dataServidor);
    const hInicio = new Date(dataInicioVotacao);
    const hFim = new Date(dataFimVotacao);

    if(hServidor >= hInicio && hServidor <= hFim){
        document.getElementById("chavePrivada").disabled = false;
        document.getElementById("id_chapa").disabled = false;
        document.getElementById("votarEleicao").disabled = false;
        document.getElementById("btn-limpar").disabled = false;

        //Alterar a mensagem do campo info 
        document.getElementById("info-votation").style.display = "none";
        document.getElementById("info-v-ok").style.display = "block";
    }

</script>