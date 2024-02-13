<div class="formulario__campo">
    <label 
    class="formulario__label" 
    for="nombre">Titulo:
    </label>
    <input 
    class="formulario__input" 
    type="text" 
    id="nombre" 
    name="nombre" 
    placeholder="Ingresar titulo"
    value="<?php echo s($portafolio->nombre) ?? ''; ?>"
    >
    <?php if(isset($alertas['error']['nombre'])) { ?>
        <div class="alerta alerta__error">
            <i class="bi bi-exclamation-octagon alerta__icono"></i> <?php echo $alertas['error']['nombre']; ?>
        </div>
    <?php } ?>

</div>


<div class="formulario__campo">
    <label 
    class="formulario__label" 
    for="imagen">Imagen:
    </label>
    <input 
    class="formulario__input" 
    type="file" 
    id="imagen" 
    name="imagen" 
    accept=".jpg, .jpeg, .png"
    value="<?php echo s($portafolio->imagen) ?? ''; ?>"
    >
    <?php if(isset($alertas['error']['imagen'])) { ?>
        <div class="alerta alerta__error">
            <i class="bi bi-exclamation-octagon alerta__icono"></i> <?php echo $alertas['error']['imagen']; ?>
        </div>
    <?php } ?>

</div>

<!-- imagen actual -->
<?php if(isset($portafolio->imagen_actual)) { ?>
    <p class="formulario__texto">Imagen Actual:</p>
    <picture>
        <source srcset="<?php echo '/build/img/portafolios/' . $portafolio->imagen; ?>.webp" type="image/webp">
        <source srcset="<?php echo '/build/img/portafolios/' . $portafolio->imagen; ?>.jpg" type="image/jpg">
        <img class="formulario__imagen" loading="lazy" src="<?php echo '/build/img/portafolios/' . $portafolio->imagen; ?>.jpg" alt="Imagen portafolio">
    </picture>
<?php } ?>

<div class="formulario__campo">
    <label 
    class="formulario__label" 
    for="descripcion">Descripción:
    </label>
    <textarea 
    class="formulario__textarea" 
    name="descripcion" 
    id="descripcion" 
    cols="30" 
    rows="10" 
    placeholder="Ingresar descripción"><?php echo s($portafolio->descripcion) ?? ''; ?></textarea>
    <?php if(isset($alertas['error']['descripcion'])) { ?>
        <div class="alerta alerta__error">
            <i class="bi bi-exclamation-octagon alerta__icono"></i> <?php echo $alertas['error']['descripcion']; ?>
        </div>
    <?php } ?>

</div>

<div class="formulario__campo">
    <label 
    class="formulario__label" 
    for="url">Dominio:
    </label>
    <input 
    class="formulario__input" 
    type="url" 
    id="url" 
    name="url" 
    placeholder="Ingresar url"
    value="<?php echo s($portafolio->url) ?? ''; ?>"
    >
    <?php if(isset($alertas['error']['url'])) { ?>
        <div class="alerta alerta__error">
            <i class="bi bi-exclamation-octagon alerta__icono"></i> <?php echo $alertas['error']['url']; ?>
        </div>
    <?php } ?>

</div>


<div class="formulario__campo">
    <label 
    class="formulario__label" 
    for="id_usuario">ID Usuario:
    </label>
    <select 
    class="formulario__input" 
    id="id_usuario" 
    name="id_usuario">
        <?php if (empty($usuarios)) { ?>
            <option value="" disabled selected>No hay usuarios disponibles</option>
        <?php } else { ?>
            <option value="">Seleccionar un usuario</option>
            <?php foreach ($usuarios as $usuario) { ?>
                <option value="<?php echo $usuario->id; ?>"
                    <?php if ($portafolio->id_usuario == $usuario->id) {
                        echo 'selected';
                    } ?>>
                    <?php echo s($usuario->nombre); ?>
                </option>
            <?php } ?>
        <?php } ?>
    </select>
    <?php if (isset($alertas['error']['id_usuario'])) { ?>
        <div class="alerta alerta__error">
            <i class="bi bi-exclamation-octagon alerta__icono"></i> <?php echo $alertas['error']['id_usuario']; ?>
        </div>
    <?php } ?>
</div>
