<body class="bg-gradient-success">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Bem vindo de Volta!</h1>
                  </div>

                    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                    <?php echo form_open(base_url('usuario/realizar_login')); ?>
                    
                    <div class="form-group">
                    
                      <input name="usuario" class="form-control form-control-user" id="email" aria-describedby="emailHelp" placeholder="Coloque seu email...">
                    </div>
                    <div class="form-group">
                      <input name="senha" type="password" class="form-control form-control-user" id="senha" placeholder="Senha">
                    </div>
                    <input type="submit" value="Submit" class="btn btn-primary btn-user btn-block"/>
                  </form>


                  <hr>
                  <div class="text-center">
                    <a class="small" href="<?=base_url("esqueceu-senha")?>">Esqueceu a senha?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="<?=base_url('cadastrar')?>">Criar uma conta!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>