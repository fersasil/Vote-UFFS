<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
        <h1>Olá <?=$nome . ' ' .$sobrenome?>, seja bem vindo</h1>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-header">
                Algumas informações importantes!
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 ">
                        <p>
                            Para que possa utilizar essa plataforma sera necessário a utilização de uma chave privada. A chave privada é única e intransferível. Cabe ao usuário mante-la em segredo. 
                        </p>
                        <div class="alert alert-warning" role="alert">
                            <strong>Sua chave privada não podera ser recuperada posteriormente!</strong>
                        </div>
                    </div>
                    <div class="col-md-6 text-center" id="info_chave_privada">
                        <button type="button" name="chave_privada" id="mostrar_chave_privada" class="btn btn-primary" btn-lg btn-block">Conseguir chave privada!</button>
                        <div class="text-center" style="display: none" id="success_chave_privada">
                            <div class="alert alert-success" role="alert">
                                <p><strong>Sua chave privada é:</strong></p>
                                <p id="chave_usuario"><?=$privateKey?></p>
                            </div>
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <a id="gerar_pdf" href="#" class="alert-link"><strong>Gostaria de gerar um pdf? clique aqui</strong></a> 
                            </div>
                        </div>
                    </div>
                    

                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<br>
<br>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs" crossorigin="anonymous"></script>
