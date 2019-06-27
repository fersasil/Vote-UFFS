<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="col-md-12">
        <h1 class="h3 mb-4 text-gray-800"><?=$titulo?><a href=""></a></h1>
    </div>

    <!-- Page -->
    <div class="card">
        <div class="card-header">
            Pesquisando histórico de votos de um usuário
        </div>
        <div class="card-body">
            <div class="row justify-content-center align-items-center">    
                <div class="col-6">
                    <!-- formulario de pesquisa -->
                    <?=form_open(base_url("ajuda/pesquisa_chave_publica"))?>
                    <div class="form-group">
                        <label for=""><strong>Digite a chave pública desejada!</strong></label>
                        <input type="text" autocomplete="" class="form-control" name="chavePublica" id="chavePublica" aria-describedby="descricaoEleicao" placeholder="">
                        <small id="descricaoEleicao" class="form-text text-muted">O nome da votação deve ser exatamente o mesmo que consta no sistema! Caso não o possua contate um administrador. Ex:"Eleição teste"</small>
                    </div>

                    <button class=" btn btn-success btn-sm col" type="submit">Pesquisar!</button>
                    <?=form_close()?>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

