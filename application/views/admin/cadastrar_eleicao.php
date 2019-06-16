<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Eleição do <?=$titulo?></h1>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore non sit explicabo tempora quos laborum corrupti, sequi facere assumenda odio, dignissimos ex a ducimus sint nobis quibusdam! Tempora, totam explicabo!</p>

<div class="col-lg-6">

    <div class="card position-relative">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Criação de uma nova Eleição</h6>
      </div>
      <div class="card-body form">
        <!-- Inicio do formulario de votação -->
        
        <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
        <?=form_open(base_url('admin/nova_eleicao')); ?>
            
            <div class="form-group">
                <label>Nome da eleição</label>
                <input name="nome_eleicao" class="form-control" placeholder="Digite o nome da eleição">
            </div>
            <div class="form-group">
                <label>Descrição da Eleição</label>
                <textarea name="descricao_eleicao" class="form-control" placeholder="Descreva a eleição"></textarea>
            </div>
            <div class="form-group">
                <div class="row">

                    <div class="col-lg-8">
                        <label for="">Inicio e fim da votação</label>
                        <input id="dateTimePicker" class="form-control" type="text" name="daterange" value="" />
                        <input type="hidden" id="inicioEleicao" value="" name="inicioEleicao">
                        <input type="hidden" id="fimEleicao" value="" name="fimEleicao">
                    </div>

                    <div class="col-lg-4">
                        <label>Nº de Chapas</label>
                        <input name="numero_max_chapas" type="text" class="form-control" placeholder="ex: 3">
                    </div>
                </div>

            </div>    
            <div class="form-group">
                <label>Tipo de Votação</label>
                <select name="tipo_votacao" class="form-control">
                    <option value="" selected disabled hidden>Escolha aqui</option>
                    <option>Centro Academico</option>
                    <option>DCE</option>
                    <option>Reitoria</option>
                    <option>Direção</option>
                    <option>Outra</option>
                </select>
            </div>
            <button type="submit" class="btn btn-default">Cadastrar</button>
            <button type="reset" class="btn btn-default">Limpar</button>
        </form>
      </div>
    </div>

      

</div>




</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<br>
<br>
