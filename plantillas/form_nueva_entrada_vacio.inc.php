<div class="form-group">
    <h4><label for="titulo">Título</label></h4>
    <input type="text" name="titulo" class="form-control" id="titulo" style="margin-bottom: 2em;" placeholder="Dale título a tu entrada" required="true">
</div>
<div class="form-group">
    <h4><label for="texto">Entrada</label></h4>
    <textarea class="ckeditor" name="texto" id="texto"></textarea>
</div>
<div class="checkbox form-group">
    <label><input type="checkbox" name="activa" value="no">Marca esta casilla para guardar la entrada como borrador</label>
</div>
<div class="form-group text-right">
    <button type="submit" class="btn btn-primary btn-lg" name="guardar">Publicar entrada</button>
    <button type="reset" class="btn btn-default btn-lg" name="limpiar">Limpiar todo</button>
</div>
