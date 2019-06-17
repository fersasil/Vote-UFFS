<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="col-lg-12">

    <div class="card position-relative">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Cadastrar nova chapa</h6>
      </div>
      <div class="card-body">
          <?php 
            if(count($eleicoes) == 0){
                echo "<p>Nenhuma eleição disponível!</p></div></div></div>";
            }
            else{ //pega todo o resto da pagina
          ?>
          <p>Cadastre uma nova chapa abaixo! Aqui vão ser inseridos textos!</p>
      </div>
    </div>
</div>
<br>
<?=validation_errors('<div class="alert alert-danger">', '</div>');?>

<?php
    if($sucesso){
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    <strong>Chapa cadastrada com sucesso!</strong>
    <hr>
    <p>Agora só falta ser aprovado pela moderação!</p>
</div>
    <?php }?>
<?=form_open(base_url('chapas/cria_nova_chapa'));?>
<div class="col-lg-12 row">
    <div class="col-lg-6">
        <div class="card position-relative">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Eleição</h6>
            </div>
            <div class="card-body">
        <!-- Inicio do formulario de votação -->
                <div class="form-group">
                    <select name="eleicao_id" class="form-control">
                        <option value="-1" selected disabled hidden>Escolha aqui</option>
                    
                    <?php
                        foreach ($eleicoes as $eleicao) {
                    ?>
                        <option value="<?=$eleicao->id_eleicao?>"><?=$eleicao->nome?></option>
                    <?php
                        }
                    ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card position-relative">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Nome da Chapa</h6>
            </div>
            <div class="card-body form-group">
                <input name="nome_chapa" class="form-control" placeholder="Digite o nome ">   
            </div>
        </div>
    </div>
</div>
<br>
<div class="col-lg-12 row">
    <div class="col-lg-6">
        <div class="card position-relative">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Descrição</h6>
            </div>
            <div class="card-body form-group">
                <textarea name="descricao_chapa" class="form-control" placeholder="Breve descrição da chapa"></textarea>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card position-relative">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">CAMPO FOTO CHAPA</h6>
            </div>
            <div class="card-body form-group">
                <textarea name="img_chapa" class="form-control" placeholder="Breve descrição da chapa"></textarea>
            </div>
        </div>
    </div>
</div>

<br>

<div class="col-lg-12 row">
    <!-- Inicio do Presidente -->
    <div class="col-lg-6">
        <div class="card position-relative">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Presidente</h6>
            </div>
            <div class="card-body form-group">
                <div class="col-lg-12">
                <label>Presidente</label>
                <input name="nome_presidente" class="form-control" placeholder="Digite o nome ">
            </div>
            <br>
            <div class="col-lg-12 row form-group">
                <div class=" col-lg-6">
                    <label>Matricula</label>
                    <input name="matricula_presidente" class="form-control" placeholder="ex: 0000000000 ">
                </div>
                
                <div class="col-lg-6">
                    <label>Semestre</label>
                    <input name="semestre_presidente" class="form-control" placeholder="Somente o numero">
                </div>
            </div>

            <div class="form-group col-lg-12">
                <label>Descrição</label>
                <textarea name="descricao_presidente" class="form-control" placeholder="Uma breve descrição"></textarea>
            </div>

        </div>
    </div>
</div>

    
<!-- Inicio do Presidente -->
<div class="col-lg-6">
        <div class="card position-relative">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Vice Presidente</h6>
            </div>
            <div class="card-body form-group">
                <div class="col-lg-12">
                <label>Vice Presidente</label>
                <input name="nome_vice_presidente" class="form-control" placeholder="Digite o nome ">
            </div>
            <br>
            <div class="col-lg-12 row form-group">
                <div class=" col-lg-6">
                    <label>Matricula</label>
                    <input name="matricula_vice_presidente" class="form-control" placeholder="ex: 0000000000 ">
                </div>
                
                <div class="col-lg-6">
                    <label>Semestre</label>
                    <input name="semestre_vice_presidente" class="form-control" placeholder="Somente o numero">
                </div>
            </div>

            <div class="form-group col-lg-12">
                <label>Descrição</label>
                <textarea name="descricao_vice_presidente" class="form-control" placeholder="Uma breve descrição"></textarea>
            </div>

        </div>
    </div>
</div>

<!-- Fim da linha -->
</div>
<br>

<div class="col-lg-12 row">
    <!-- Inicio do secretario -->
    <div class="col-lg-6">
        <div class="card position-relative">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Secretario(a)</h6>
            </div>
            <div class="card-body form-group">
                <div class="col-lg-12">
                <label>Secretario(a)</label>
                <input name="nome_secretario" class="form-control" placeholder="Digite o nome ">
            </div>
            <br>
            <div class="col-lg-12 row form-group">
                <div class=" col-lg-6">
                    <label>Matricula</label>
                    <input name="matricula_secretario" class="form-control" placeholder="ex: 0000000000 ">
                </div>
                
                <div class="col-lg-6">
                    <label>Semestre</label>
                    <input name="semestre_secretario" class="form-control" placeholder="Somente o numero">
                </div>
            </div>

            <div class="form-group col-lg-12">
                <label>Descrição</label>
                <textarea name="descricao_secretario" class="form-control" placeholder="Uma breve descrição"></textarea>
            </div>

        </div>
    </div>
</div>

    
<!-- Inicio do tesoureiro -->
<div class="col-lg-6">
        <div class="card position-relative">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tesoureiro(a)</h6>
            </div>
            <div class="card-body form-group">
                <div class="col-lg-12">
                <label>Tesoureiro(a)</label>
                <input name="nome_tesoureiro" class="form-control" placeholder="Digite o nome ">
            </div>
            <br>
            <div class="col-lg-12 row form-group">
                <div class=" col-lg-6">
                    <label>Matricula</label>
                    <input name="matricula_tesoureiro" class="form-control" placeholder="ex: 0000000000 ">
                </div>
                
                <div class="col-lg-6">
                    <label>Semestre</label>
                    <input name="semestre_tesoureiro" class="form-control" placeholder="Somente o numero">
                </div>
            </div>

            <div class="form-group col-lg-12">
                <label>Descrição</label>
                <textarea name="descricao_tesoureiro" class="form-control" placeholder="Uma breve descrição"></textarea>
            </div>

        </div>
    </div>
</div>

<!-- Fim da linha -->
</div>
<br>

<input type="hidden" id="numero_suplentes" name="numero_suplentes" value="0">
<div id="supl1" class="col-lg-12 row"></div>
<div id="supl3" class="col-lg-12 row"></div>
<div id="supl5" class="col-lg-12 row"></div>
<div id="supl7" class="col-lg-12 row"></div>
<div id="supl9" class="col-lg-12 row"></div>

<br>
<div id="submit_form">
    <button type="submit" class="btn btn-default">Cadastrar</button>
    <button type="reset" class="btn btn-default">Limpar</button>
    <a href="#submit_form" class="btn btn-default" id="adicionaMembro">Adicionar Suplente</a>
</div>
<?php 
    echo form_close();
    } //fecha o else
?>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<br>
<br>

