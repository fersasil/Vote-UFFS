

  
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

</script>


</body>

</html>