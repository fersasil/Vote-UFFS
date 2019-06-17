<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="col-md-12">
        <h1 class="h3 mb-4 text-gray-800"><?=$titulo?><a href=""></a></h1>
    </div>

    <div class="col-12">
        <table id="tableResultado" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Votante</th>
                    <th>Voto</th>
                    <th>Data</th>
                </tr>
            </thead>
            
            <tbody id="tableInfo">
                <?php
                    foreach (json_decode($eleicao_info) as $e) {
                        echo "<tr class='even'>";
                        echo '<th>' . $e->publicKey . '</th>';
                        echo '<th>' . $e->candidateNumber . '</th>';
                        echo '<th>' . $e->date . '</th>';
                        echo '</tr>';
                    }

                ?>
            </tbody>

            <tfoot>
                <tr>
                    <th>Votante</th>
                    <th>Voto</th>
                    <th>Data</th>
                </tr>
            </tfoot>
        </table>

    </div>

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->


<script>
    const res = `<?=$eleicao_info?>`;
    const eleicaoDetalhes = JSON.parse(res);
    let aux = "";
    let count = 1;
    const odd = "<tr class='odd' role='row'>";
    const even = "<tr class='even' role='row'>";

    eleicaoDetalhes.forEach(function(e){
        if(count % 2 == 0){
            aux += even;
            console.log("ola")
        }
        else{
            aux += odd;
        }

        aux += "<td>" + e.publicKey + "</td>"; 
        aux += "<td>" + e.candidateNumber + "</td>"; 
        aux += "<td>" + e.date + "</td>";
        aux += "<tr>";

        count++;
        console.log(count % 2)
    });

    //document.getElementById("tableInfo").innerHTML = aux;
    //console.log(aux);
    

</script>

