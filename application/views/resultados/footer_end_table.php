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
<!-- Colocar em um arquivo separado depois -->
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
</script>

<!-- <script src="<?php //echo base_url('assets/')?>vendor/chart.js/Chart.min.js"></script> -->

<!-- Page level custom scripts -->
<!-- <script src="<?php //echo base_url('assets/')?>js/demo/chart-area-demo.js"></script> -->
<!-- <script src="<?php //echo base_url('assets/')?>js/demo/chart-pie-demo.js"></script> -->


</body>

</html>