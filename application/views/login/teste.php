
    <div class="form-group">


    <?php 
    echo form_open(base_url('home/procura_cidades'));
    echo '<input type="submit" name="btn_enviar" value="Enviar"  class="btn btn-danger" />';
   
    echo form_submit('btn_enviar','Enviar', "class='btn btn-danger'").('</div>');
    echo form_close();
    
    ?>