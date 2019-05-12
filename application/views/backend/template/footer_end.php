  <!-- Bootstrap core JavaScript-->
  <script src="<?=base_url("assets/vendor/jquery/jquery.min.js")?>"></script>
  <script src="<?=base_url("assets/vendor/bootstrap/js/bootstrap.bundle.min.js")?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?=base_url("assets/vendor/jquery-easing/jquery.easing.min.js")?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?=base_url("assets/js/sb-admin-2.min.js")?>"></script>

  <script>
    let aux = ` <!-- Inicio do scretario -->
                    <div class="form-group">
                        <label>Suplente 1x</label>
                        <input class="form-control" placeholder="Digite o nome ">
                    </div>
                    <div class="row">
                        <div class="form-group col-5">
                            <label>Matricula</label>
                            <input class="form-control" placeholder="Digite o nome ">
                        </div>
                    
                        <div class="form-group col-5">
                            <label>Semestre</label>
                            <input class="form-control" placeholder="Digite o nome ">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Descrição</label>
                        <textarea class="form-control" placeholder="Uma breve descrição"></textarea>
                    </div>
                    <hr>
                    <!-- Fim do presidente -->`;

    $("#adicionaMembro").click(function(){
      $(this).after(aux);

});
</script>

</body>

</html>