<div class="container-fluid">
    <div class="row mx-auto">
        <input type="text" class="form-control textbox" placeholder="Título" maxlength="80" required="true" name="titulo" value="<?php echo $validador->mostrar_titulo(); ?>">
        <?php $validador->mostrar_error_titulo(); ?>
    </div>
    <div class="row mx-auto my-2">
        <textarea id="entrada" minlength="20" required="true" name="entrada"><?php echo $validador->mostrar_texto(); ?></textarea>
        <?php $validador->mostrar_error_texto(); ?>
    </div>
    <script>CKEDITOR.replace('entrada');</script>
    <div class="row mx-auto py-1">
        <div class="col-md-8 d-flex flex-fill align-items-center p-0">
            <input type="checkbox" style="height:24px; width:24px" id="activa" name="activa" value="no" <?php if (!$entrada_publica) echo 'checked'; ?>><label class="ms-2" for="activa">Marca esta casilla para guardar la entrada como borrador</label>
        </div>
        <div class="col-md-2 d-flex pe-0">
            <button type="submit" class="btn btn-outline-light flex-fill" name="submit">Editar entrada</button>
        </div>
        <div class="col-md-2 d-flex pe-0">
            <a class="btn btn-outline-light flex-fill rosa" role="button" href="<?php echo RUTA_GESTOR_ENTRADAS ?>">Cancelar</a>
        </div>
    </div>
</div>