<?php
    foreach($alertas as $key => $alerta) {
        foreach($alerta as $mensaje) {
?>
    <div class="alerta alerta__<?php echo $key; ?>">
        <?php if($key === "error") { ?>
            <i class="bi bi-exclamation-octagon alerta__icono"></i> <?php echo $mensaje; ?>
        <?php } else {?>
            <i class="fa-solid fa-circle-check alerta__icono"></i> <?php echo $mensaje; ?>
        <?php } ?>
    </div>
<?php 
        }
    }
?>

