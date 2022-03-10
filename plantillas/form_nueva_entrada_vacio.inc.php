<input type="text" class="form-control textbox" placeholder="Título" maxlength="40" required="true" name="titulo">
<textarea class="form-control textbox mt-1 mh-35" style="height: 35vh; min-height: 10vh;" minlength="20" required="true" name="entrada"></textarea>
<div class="d-flex flex-fill align-items-center p-1">
    <input type="checkbox" id="activa" name="activa" value="no"><label class="ms-2" for="activa">Marca esta casilla para guardar la entrada como borrador</label>
</div>
<button type="submit" class="btn btn-outline-light m-2 flex-fill" name="submit">Publicar entrada</button>
<button type="reset" class="btn btn-outline-light rosa m-2">Reiniciar</button>