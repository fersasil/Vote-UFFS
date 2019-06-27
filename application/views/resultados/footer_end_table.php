<!-- Bootstrap core JavaScript-->
<script src="<?=base_url('assets/')?>vendor/jquery/jquery.min.js"></script>
<script src="<?=base_url('assets/')?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
<script src="<?=base_url('assets/')?>vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
<script src="<?=base_url('assets/')?>js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
<script src="<?=base_url('assets/')?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url('assets/')?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
<script src="<?=base_url('assets/')?>js/demo/datatables-demo.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<!-- Colocar em um arquivo separado depois -->
<script src="https://cdn.jsdelivr.net/npm/patternomaly@1.3.2/dist/patternomaly.min.js"></script>


<script type="text/javascript">
  $("#dataTable").dataTable({
    "bJQueryUI": true,
    "oLanguage": {
        "sProcessing":   "Processando...",
        "sLengthMenu":   "Mostrar _MENU_ registros",
        "sZeroRecords":  "Não foram encontrados resultados",
        "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
        "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
        "sInfoFiltered": "",
        "sInfoPostFix":  "",
        "sSearch":       "Buscar:",
        "sUrl":          "",
        "oPaginate": {
            "sFirst":    "Primeiro",
            "sPrevious": "Anterior",
            "sNext":     "Seguinte",
            "sLast":     "Último"
        }
    }
});       
</script>

<script type="text/javascript">
  $("#tableResultado").dataTable({
    "bJQueryUI": true,
    "oLanguage": {
        "sProcessing":   "Processando...",
        "sLengthMenu":   "Mostrar _MENU_ registros",
        "sZeroRecords":  "Não foram encontrados resultados",
        "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
        "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
        "sInfoFiltered": "",
        "sInfoPostFix":  "",
        "sSearch":       "Buscar:",
        "sUrl":          "",
        "oPaginate": {
            "sFirst":    "Primeiro",
            "sPrevious": "Anterior",
            "sNext":     "Seguinte",
            "sLast":     "Último"
        }
    }
});


const resultado = (<?=$resultado_json?>);
const nome = "<?=$eleicao->nome?>";
const votos = [];
const nomes = [];
const colors = [];

for(let i in resultado){
  votos.push(resultado[i].votos);
  nomes.push(resultado[i].nomeChapa);
  colors.push('#'+Math.random().toString(16).substr(-6));
}




const ctx = document.getElementById("myChart");
//ctx.width = 1200;
// /ctx.height = 1000;

const myChart = new Chart(ctx, {
  type: 'pie',
  //type: 'doughnut',
  data: {
    labels: nomes,
    datasets: [{ 
        data: votos,
        backgroundColor: colors
      }]
  },
  options: {
        legend: {
            display: true,
            position: 'bottom'
        },
        layout: {
            padding: {
                left: 0,
                right: 0,
                top: 0,
                bottom: 30
            }
        },
        title: {
            display: true,
            text: nome
        },
        maintainAspectRatio: false,
        responsive: true, 
    }
});
</script>

<!-- <script src="<?php //echo base_url('assets/')?>vendor/chart.js/Chart.min.js"></script> -->

<!-- Page level custom scripts -->
<!-- <script src="<?php //echo base_url('assets/')?>js/demo/chart-area-demo.js"></script> -->
<!-- <script src="<?php //echo base_url('assets/')?>js/demo/chart-pie-demo.js"></script> -->


</body>

</html>