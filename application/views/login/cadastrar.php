<body class="bg-gradient-success">
<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Crie uma conta</h1>
              </div>
              <!-- <form class="user"> -->
                <?=form_open('usuario/nova_conta')?>
                <?=validation_errors('<div class="alert alert-danger">', '</div>');?>
                <div class="form-group row user">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="nome" id="nome" placeholder="Nome">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="sobrenome" id="sobrenome" placeholder="Sobrenome">
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" name="email" id="email" placeholder="Email">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input pattern="[0-9.]+" type="text" class="form-control form-control-user" name="matricula" id="matricula" placeholder="Matricula">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="cpf" id="cpf" placeholder="CPF">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" name="senha" id="senha" placeholder="Senha">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" name="senha2" id="senha2" placeholder="Repita a senha">
                  </div>
                </div>
                <input type="submit" class="btn btn-primary btn-user btn-block" value="Cria a conta">
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="<?=base_url('esqueceu-senha')?>">Esqueceu a senha?</a>
              </div>
              <div class="text-center">
                <a class="small" href="<?=base_url('entrar')?>">Ja tem uma conta? Entre!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>