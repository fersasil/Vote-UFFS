<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Eleição do <?=$titulo?></h1>



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
            <div class="row">
                <div class="col-lg-6 text-center"><img class="img-responsive rounded-circle" src="http://placehold.it/200x200"></div>
                <div class="col-lg-6">
                    <p><h3 class="text-center h5 mb-4 text-gray-800">Diversa</h3></p>
                    <p>Aqui vai uma curta descrição sobre a chapa... ok... Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis sit asperiores illum aliquam? Iste officia sequi hic, expedita facere repellat. Porro earum veniam sequi corrupti repellat? Expedita explicabo perspiciatis perferendis!</p>
                </div>
            </div>

            <hr> <!-- Coloca um traço que separa as chapas   -->

            <!-- Inicio da apresentação da chapa 2 -->
            <div class="row">
                <div class="col-lg-6 text-center"><img class="img-responsive rounded-circle" src="http://placehold.it/200x200"></div>
                <div class="col-lg-6">
                    <p><h3 class="text-center h5 mb-4 text-gray-800">Avante</h3></p>
                    <p>Aqui vai uma curta descrição sobre a chapa... ok... Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis sit asperiores illum aliquam? Iste officia sequi hic, expedita facere repellat. Porro earum veniam sequi corrupti repellat? Expedita explicabo perspiciatis perferendis!</p>
                </div>
            </div>

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
        <form role="form">
            <div class="form-group">
                <label>Chave privada</label>
                <input class="form-control" placeholder="Digite a sua chave privada">
            </div>     
            <div class="form-group">
                <label>Chapa</label>
                <select class="form-control">
                 <option value="" selected disabled hidden>Escolha aqui</option>
                    <option>Diversa</option>
                    <option>Avante</option>
                    <option>Plural</option>
                    <option>Colorida</option>
                    <option>Igualitaria</option>
                </select>
            </div>
            <button type="submit" class="btn btn-default">Cadastrar</button>
            <button type="reset" class="btn btn-default">Limpar</button>
        </form>
      </div>
    </div>

  </div>

  

</div>




</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
