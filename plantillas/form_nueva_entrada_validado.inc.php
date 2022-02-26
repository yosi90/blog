<div class="form-group">
    <h4><label for="titulo">Título</label></h4>
    <input type="text" name="titulo" class="form-control" id="titulo" style="margin-bottom: 2em;" placeholder="Dale título a tu entrada" required="true"
    <?php $validador -> mostrar_titulo(); ?>>
    <?php $validador -> mostrar_error_titulo(); ?>
</div>
<div class="form-group">
    <h4><label for="texto">Entrada</label></h4>
    <textarea class="ckeditor" name="texto" id="texto"><?php $validador -> mostrar_texto(); ?></textarea>
    <?php $validador -> mostrar_error_texto(); ?>
</div>
<div class="checkbox form-group">
    <label><input type="checkbox" name="activa" value="no" <?php if(!$entrada_publica) echo 'checked';?>>Marca esta casilla para guardar la entrada como borrador</label>
</div>
<div class="form-group text-right">
    <button type="submit" class="btn btn-primary btn-lg" name="guardar">Publicar entrada</button>
    <button type="reset" class="btn btn-default btn-lg" name="limpiar">Limpiar todo</button>
</div>
