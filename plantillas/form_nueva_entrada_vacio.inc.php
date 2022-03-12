<div class="container-fluid">
    <div class="row mx-auto">
        <input type="text" class="form-control textbox" placeholder="Título" maxlength="80" required="true" name="titulo">
    </div>
    <div class="row mx-auto my-2">
        <textarea id="entrada" minlength="20" required="true" name="entrada"></textarea>
    </div>
    <script>CKEDITOR.replace('entrada');</script>
    <div class="row mx-auto py-1">
        <div class="col-md-8 d-flex flex-fill align-items-center p-0">
            <input type="checkbox" style="height:24px; width:24px" id="activa" name="activa" value="no"><label class="ms-2" for="activa">Marca esta casilla para guardar la entrada como borrador</label>
        </div>
        <div class="col-md-2 d-flex pe-0">
            <button type="submit" class="btn btn-outline-light flex-fill" name="submit">Publicar entrada</button>
        </div>
        <div class="col-md-2 d-flex pe-0">
            <button type="reset" class="btn btn-outline-light flex-fill rosa">Reiniciar</button>
        </div>
    </div>
</div>