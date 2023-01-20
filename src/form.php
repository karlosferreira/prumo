<?php function the_form(){ ?>
    <form action="" method="POST">
        <h4>Consulte seu CNPJ</h4>
        <p>by <a href="https://www.cluemediator.com" target="_blank">https://www.cnpj.ws/</a></p>
        <input type="text" id="cnpj" class="p-1" name="cnpj" placeholder="Infomre seu CNPJ" />
        <button type="submit" class="btn btn-primary mb-1" id="datasubmit">Consultar</button>
    </form>
<?php } ?>