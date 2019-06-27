      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Your Website 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pronto para sair?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Aperte em Logout para encerrar a sessão.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-primary" href="<?=base_url('usuario/logout'); ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?=base_url('assets/vendor/jquery/jquery.min.js')?>"></script>
  <script src="<?=base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>

  <!-- Date time picker! -->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/pt-br.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


  <!-- Core plugin JavaScript-->
  <script src="<?=base_url('assets/vendor/jquery-easing/jquery.easing.min.js')?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?=base_url('assets/js/sb-admin.min.js')?>"></script>

  <script>
    
    
    $(function(){
      const naoIniciada = $("#nao_iniciada_admin").children('a');
      const iniciada = $("#iniciada_admin").children('a');

      if(naoIniciada.length === 0){
      naoIniciada.prevObject.append('<small><a class="dropdown-item disabled" href="#">Nada cadastrado</a></small>');
      }

      if(iniciada.length === 0){
        iniciada.prevObject.append('<small><a class="dropdown-item disabled" href="#">Nada cadastrado</a></small>');
      }


      $('#dateTimePicker').daterangepicker({
            "timePicker": true,
            "timePicker24Hour": true,
            "drops": "up"
            //"opens": "center",
            //"startDate": diaDeHoje,
            //"endDate": ultimoDia

        }, function(start, end, label) {
            const data = new Date();
            const diaDeHoje = data.getDate() + "/" + (data.getMonth() + 1)+ "/" + data.getFullYear();
            const ultimoDia = (data.getDate() + 1) + "/" + (data.getMonth() + 1) + "/" + data.getFullYear();
            console.log(start.format().toString())
            document.getElementById("inicioEleicao").value = start.format().toString();
            document.getElementById("fimEleicao").value = end.format().toString();
        });


        $("#dateTimePicker").val("");





        $("#iniciar_eleicao").on("click", function(){
          console.log("OI")
            const idEleicao = $("#id_eleicao_hidden").val();
            const baseUrl = "<?=base_url()?>";
            const sucessoHtml = 
            `<div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Eleição iniciada!</strong> Você pode acompanhar os votos em tempo real!.
            </div>`;
            
            const erroHtml = 
            `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Eleição ja foi iniciada anteriormente!</strong><hr>A eleição foi iniciada previamente pelo sistema ou por algum administrador, ela não pode ser iniciada novamente!
            </div>`;

            $.ajax({
                method: "POST",
                url: baseUrl + "admin/iniciar_eleicao",
                data: { 
                    "id_eleicao": idEleicao,
                    "aut": "0f8f4803790b8f9267fd3920fe277bf9"
                },
                success: function(data){
                    const res = JSON.parse(data);

                    if(res.success === "true"){
                        const lugarHtml = $("#successAtivarEleicao");
                        lugarHtml.append(sucessoHtml);
                    }
                    else{
                        const lugarHtml = $("#successAtivarEleicao");
                        lugarHtml.append(erroHtml);
                    }
                },
                error: function(){

                }
            });


        });

        $("#encerrar_eleicao").on("click", function(){
            const idEleicao = $("#id_eleicao_hidden").val();
            const baseUrl = "<?=base_url()?>";
            const nomeEleicao = $("#nome_eleicao_hidden").val();

            const sucessoHtml = 
            `<div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Eleição Finalizada!</strong> Você pode consultar a eleição no campo resultados!
            </div>`;

            const erroHtml = 
            `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Eleição ja foi encerrada anteriormente!</strong><hr>A eleição foi encerrada previamente pelo sistema ou por algum administrador, ela não pode ser encerrada novamente!
            </div>`;

            //TODO Colocar um modal de confirmação aqui

            $.ajax({
                method: "POST",
                url: baseUrl + "admin/encerrar_eleicao",
                data: { 
                    "id_eleicao": idEleicao,
                    "aut": "0f8f4803790b8f9267fd3920fe277bf9",
                    "nome_eleicao": nomeEleicao
                },
                success: function(data){
                    console.log(data);
                    const res = JSON.parse(data);

                    if(res.success === "true"){
                        const lugarHtml = $("#successAtivarEleicao");
                        lugarHtml.append(sucessoHtml);
                    }
                    else {
                        const lugarHtml = $("#successAtivarEleicao");
                        lugarHtml.append(erroHtml);
                    }
                },
                error: function(){

                }
            });
        });

        let cardTitle;
        let cardText;
        let cardImg = "http://placehold.jp/240x240.png";

        function htmlCard(cardTitle, cardText, cardImg){ 
            return `<div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                  <img class="card-img-top" src="${cardImg}" alt="">
                  <div class="card-body">
                    <h4 class="card-title">${cardTitle}</h4>
                    <p class="card-text">${cardText}</p>
                  </div>
                </div>
              </div>`;
        }

        $("#contar_votos").on("click", function(){
            const nomeEleicao = $("#nome_eleicao_hidden").val();
            const idEleicao = $("#id_eleicao_hidden").val();
            const baseUrl = "<?=base_url()?>";
            console.log(baseUrl + "admin/conta_votos");
            $.ajax({
                method: "POST",
                url: baseUrl + "/admin/conta_votos",
                data: { 
                    "nomeEleicao": nomeEleicao, 
                    "idEleicao": idEleicao,
                    "verificador": "0f8f4803790b8f9267fd3920fe277bf9"
                },
                success: function(data){
                    const res = JSON.parse(data);

                    const lugarHtml = $("#resPlace");

                    res.votos.forEach(function(voto){
                        cardTitle = voto.nomeChapa;
                        cardImg = "http://placehold.jp/240x240.png";
                        maisInfo = "Aqui são informações a serem adicionadas no futuro";

                        cardText = "Votos: <strong>" + voto.votos + "</strong><br>";

                        lugarHtml.append(htmlCard(cardTitle, cardText, cardImg));
                    });

                    $("#text-res_eleicao").append(`Resultado da Eleição:<p>
                        <strong>${res.vencedor.nome}</strong></p>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong class="h4"><small><p>${res.tempo_restante}</p>
                            <p>Número de votos: ${res.numeroDeVotos}<p>
                            </small></strong>
                            
                        </div>
                    `);
                    
                    $("#result_card").show("slow");
                },
                error: function(){

                }
            });
        });

    });
    

  </script>

</body>

</html>

