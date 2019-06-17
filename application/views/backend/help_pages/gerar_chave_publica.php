<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="col-md-12">
        <h1 class="h3 mb-4 text-gray-800"><?=$titulo?><a href=""></a></h1>
    </div>

    <!-- Page -->
    <div class="card">
        <div class="card-header">
            Gerando a sua chave pública
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <div id="warningPk" class="alert alert-warning">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos dicta suscipit voluptates ipsum, quasi quidem laborum eaque, maxime qui alias pariatur tempore distinctio, beatae repellendus vitae! Aliquam asperiores assumenda accusamus.
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quaerat quia vero saepe vel ex adipisci explicabo harum enim repellat culpa, ab numquam, pariatur nesciunt ullam! Corrupti mollitia id repudiandae magni.</p>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>Lembre-se de não compartilhar sua chave com nínguem!</strong> Saiba mais sobre chaves clicando <a class="alert-link" href="#">aqui</a>
                    </div>
                    
                    <!-- formulario de pesquisa -->
                    <?=form_open(base_url("ajuda/getting_pub_key"))?>
                    <div class="form-group">
                      <label for=""><strong>Digite aqui a sua chave privada</strong></label>
                      <input type="text" autocomplete="off" class="form-control" name="chavePrivada" id="chavePrivada" aria-describedby="descricaoChave" placeholder="">
                      <small id="descricaoChave" class="form-text text-muted">A sua chave deve ser exatamente igual, há diferenciação de maiúsculas e minusculas, então tome cuidado ao digitar!</small>
                    </div>

                    <button class=" btn btn-success btn-sm col" type="submit">Gerar!</button>
                    <?=form_close()?>
                </div>

            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->


<script>
    const res = "<?php if($pk == null) echo "null"; else echo $pk;?>";

    if(res === "erro"){
        document.getElementById('warningPk').innerHTML = "<p>Verifique a sua chave, ela não é valida</p>";
        document.getElementById("warningPk").classList.remove('alert-warning');
        document.getElementById("warningPk").classList.remove('alert-success');

        document.getElementById("warningPk").classList.add('alert-danger');
    }
    else if(res !== "null"){
        document.getElementById('warningPk').innerHTML = "<p>Chave pública gerada com sucesso!</p><hr>" + res;
        document.getElementById("warningPk").classList.remove('alert-warning');
        document.getElementById("warningPk").classList.remove('alert-danger');

        document.getElementById("warningPk").classList.add('alert-success');
    }

</script>

