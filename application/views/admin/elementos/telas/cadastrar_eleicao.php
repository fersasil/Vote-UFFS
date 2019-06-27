<div id="content-wrapper">

<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="<?=base_url()?>">Home</a>
    </li>
    <li class="breadcrumb-item active">Cadastrar Eleição</li>
  </ol>

  <!-- Page Content -->
  


  <div class="col-lg-12 mb-4 mx-auto">

        <?php
            if($success){
        ?>

        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <strong>Nova Eleição cadastrada com sucesso!</strong> 
          <hr>
          <p>Você pode acessar as inforamções referentes a ela no menu</p>
        </div>

            <?php }?>

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
                <textarea cols="20" rows="5" name="descricao_eleicao" class="form-control" placeholder="Descreva a eleição"></textarea>
            </div>
            <div class="form-group">
                <div class="row">

                    <div class="col-lg-8">
                        <label for="">Inicio e fim da votação</label>
                        <input placeholder="Escolha uma data" autocomplete="off" id="dateTimePicker" class="form-control" type="text" name="daterange" value="" />
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
            <button type="submit" class="btn btn-secondary">Cadastrar</button>
            <button type="reset" class="btn btn-secondary">Limpar</button>
        </form>
      </div>
    </div>

      

</div>



</div>