<input type="text" class="form-control textbox" placeholder="Nombre de usuario" minlength="4" maxlength="20" required="true" name="nombre" title="Este será el nombre que se muestre a los demás usuarios. Debe ser único" <?php $validador->mostrar_nombre() ?>>
<?php
$validador->mostrar_error_nombre();
?>
<input type="email" class="form-control textbox mt-1" placeholder="Email" maxlength="30" required="true" name="email" <?php $validador->mostrar_email() ?>>
<?php
$validador->mostrar_error_email();
?>
<input type="password" class="form-control textbox mt-1" placeholder="Contraseña" maxlength="25" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Debe contener al menos un número, una letra minúscula, una letra mayúscula y al menos 8 caracteres." required="true" name="clave1">
<?php
$validador->mostrar_error_clave1();
?>
<input type="password" class="form-control textbox mt-1" placeholder="Repite la contraseña" maxlength="25" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Debe contener al menos un número, una letra minúscula, una letra mayúscula y al menos 8 caracteres." required="true" name="clave2">
<?php
$validador->mostrar_error_clave2();
?>
<button type="submit" class="btn btn-outline-light me-2 mt-3 flex-fill" name="submit">Aceptar</button>
<button type="reset" class="btn btn-outline-light bg-rosa mt-3">Limpiar formulario</button>