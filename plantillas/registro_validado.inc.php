<input class="textbox" type="text" class="form-control" placeholder="Nombre de usuario" maxlength="20" required="true" name="nombre" title="Este será el nombre que se muestre a los demás usuarios. Debe ser único" <?php $validador->mostrar_nombre() ?>>
<?php
$validador->mostrar_error_nombre();
?>
<input class="textbox mt-1" type="email" class="form-control" placeholder="Email" maxlength="30" required="true" name="email" <?php $validador->mostrar_email() ?>>
<?php
$validador->mostrar_error_email();
?>
<input class="textbox mt-1" type="password" class="form-control" placeholder="Contraseña" maxlength="25" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Debe contener al menos un número, una letra minúscula, una letra mayúscula y al menos 8 caracteres." required="true" name="clave1">
<?php
$validador->mostrar_error_clave1();
?>
<input class="textbox mt-1" type="password" class="form-control" placeholder="Repite la contraseña" maxlength="25" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Debe contener al menos un número, una letra minúscula, una letra mayúscula y al menos 8 caracteres." required="true" name="clave2">
<?php
$validador->mostrar_error_clave2();
?>
<button type="submit" class="btn btn-outline-light me-2 mt-3 flex-fill" name="submit">Aceptar</button>
<button type="reset" class="btn btn-outline-light rosa mt-3">Limpiar formulario</button>