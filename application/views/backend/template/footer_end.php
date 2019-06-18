

  
    <!-- Date time picker! -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/pt-br.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

      <!-- Bootstrap core JavaScript-->
  <script src="<?=base_url("assets/vendor/bootstrap/js/bootstrap.bundle.min.js")?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?=base_url("assets/vendor/jquery-easing/jquery.easing.min.js")?>"></script>

  <!-- Custom scripts for all pages-->
    <script src="<?=base_url("assets/js/sb-admin-2.min.js")?>"></script>
    <script src="<?=base_url("assets/vendor/mask-plugin/src/jquery.mask.js")?>"></script>


  <script>
    let count = 1;

    $("#adicionaMembro").click(function(){
        let aux = `
        <!-- Inicio do secretario -->
        <div class="col-lg-6">
            <div class="card position-relative">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Suplente ${count}</h6>
                </div>
                <div class="card-body form-group">
                    <div class="col-lg-12">
                    <label>Nome</label>
                    <input name="suplente_${count}_nome" class="form-control" placeholder="Digite o nome ">
                </div>
                <br>
                <div class="col-lg-12 row form-group">
                    <div class=" col-lg-6">
                        <label>Matricula</label>
                        <input name="suplente_${count}_matricula" class="form-control" placeholder="ex: 0000000000 ">
                    </div>
                    
                    <div class="col-lg-6">
                        <label>Semestre</label>
                        <input name="suplente_${count}_semestre" class="form-control" placeholder="Somente o numero">
                    </div>
                </div>

                <div class="form-group col-lg-12">
                    <label>Descrição</label>
                    <textarea name="suplente_${count}_descricao" class="form-control" placeholder="Uma breve descrição"></textarea>
                </div>

            </div>
        </div>
    </div>`;
        if(count <= 10){
            if(count % 2 == 1){ //impar
                $("#supl" + count).html(aux);
            }
            else{
                $("#supl" + (count - 1)).append(aux);
                $("#supl" + (count - 1)).after("<br>");
            }

            //atualizar o campo hidden do formulario com o número novo de suplentes

            $("#numero_suplentes").val(count);
        }
        else if(count == 11){
            $(this).before("Número de suplentes máximo atingido<br>");
        }

        count++;
    });

    $(function() {

        $('#dateTimePicker').daterangepicker({
            "timePicker": true,
            "timePicker24Hour": true,
            "drops": "up",
            "opens": "center",
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
    });

    $(function(){
        $("#cpf").mask("999.999.999-99");
    });

    if($(".veri").html() === undefined){
        $("#eleicoes_ativas_user").append('<a class="disabled collapse-item">Nenhuma eleição</a>');
    }

    $(function(){

        $('#mostrar_chave_privada').on("click", function(){
            $(this).hide();
            $("#success_chave_privada").show("slow");
        });

        $('#gerar_pdf').on("click", function(){
            $('#chave_usuario')
            const doc = new jsPDF({
            orientation: 'portrait',
            unit: 'cm',
            format: 'a4'
            });

            const chave_privada = $('#chave_usuario').text();
            
            doc.text("Sua chave privada é:\n" + chave_privada + "\n mantenha em segurança, não é possível gera-la novamente!", 1, 1);
            
            doc.save('chave_privada.pdf');
        
        });
    });
    
    $(function(){
        $("#iniciar_eleicao").on("click", function(){
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
        
    })




</script>
    
    
</body>

</html>