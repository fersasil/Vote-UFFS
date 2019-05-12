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
      <div class="card-body">
        <!-- Inicio do formulario de votação -->
        <form role="form">
            <div class="form-group">
                <label>Nome da eleição</label>
                <input class="form-control" placeholder="Digite a sua chave privada">
            </div>
            <div class="form-group">
                <label>Descrição da Eleição</label>
                <textarea class="form-control" placeholder="Descreva a eleição"></textarea>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-4">
                        <label>Duração</label>
                        <input class="form-control" placeholder="Nº de dias">
                    </div>

                    <div class="col-lg-4">
                        <label>Dia da votação</label>
                        <input type="text" class="form-control" placeholder="dia ">
                    </div>

                    <div class="col-lg-4">
                        <label>Nº de Chapas</label>
                        <input type="text" class="form-control" placeholder="ex: 10">
                    </div>
                </div>

            </div>    
            <div class="form-group">
                <label>Tipo de Votação</label>
                <select class="form-control">
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
