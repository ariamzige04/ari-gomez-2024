<main class="registrado registrado__seccion--principal">
    <div class="registrado__contenedor-chico">

        <!-- alerta de exito -->
        <?php 
            if($mostrar_alerta) {
        ?>
            <h3 class="registrado__titulo registrado__titulo--exito">
            Espere hasta que seas contactado
            </h3>
        <?php 
        }
        ?>



        <?php 
            if($requerimiento_nuevo) {
        ?>
            <h1 class="registrado__titulo">
            Crear un nuevo pedido de sitio web
            </h1>
            <form method="POST">
            <div class="formulario__campo">
                <label 
                class="formulario__label" 
                for="descripcion">Describe cómo quieres tu sitio web:
                </label>

                <textarea 
                class="formulario__textarea" 
                id="descripcion" 
                name="descripcion" 
                placeholder="Cuéntanos tus ideas y requerimientos"></textarea>
                
                <button class="formulario__boton--naranja" type="submit" style="width: fit-content; margin-top:3rem;">
                    Enviar
                    <i class="bi bi-arrow-right"></i>
                </button>
            </div>
            </form>
        <?php 
        }
        ?>


        <div class="registrado__requerimiento">
            
            <?php 
                if(empty($requerimientos->requerimientos) && !empty($datos_usuario->descripcion)) {
            ?>
                <h1 class="registrado__titulo">
                Ideas y requerimientos que usted haya escrito
                </h1>
                <p class="registrado__requerimiento-parrafo">
                    <?php echo $datos_usuario->descripcion ?? 'No pusiste descripción para tu sitio web'; ?>
                </p>
            <?php 
            }
            ?>

        </div>

        <?php if($requerimientos->requerimientos) {?>

        <div class="registrado__requerimiento">
            <h2 class="registrado__titulo">
            Descripciones clave del proyecto
            </h2>
            <!-- <p>...</p> -->
            <p class="registrado__requerimiento-parrafo"><?php echo $requerimientos->requerimientos ?? '...'; ?></p>
        </div>
        <?php }?>
    </div>


    
</main>

<?php 
if($requerimientos) {

    if($mostrar_pago) {
    ?>


<section class="registrado ">
    <div class="registrado__contenedor-chico">
        <h1 class="registrado__titulo">
            Cantidad a Pagar
        </h1>

        <?php if( $completado == 1) { ?>
            <p class="registrado__parrafo">
            <!-- Aquí <span class="registrado__parrafo--negritas">mostraremos</span> el 
            <span class="registrado__parrafo--negritas">presupuesto</span> que te proporcionaremos. 
            <span class="registrado__parrafo--negritas">Por favor, aguarda</span> unos minutos y 
            <span class="registrado__parrafo--negritas">se revelará</span> el 
            <span class="registrado__parrafo--negritas">costo</span>.  -->
            Para <span class="registrado__parrafo--negritas">iniciar el proyecto</span>, 
            necesitaremos un <span class="registrado__parrafo--negritas">anticipo del 50%</span>.
            </p>

            <p class="registrado__precio-titulo">Primer pago:</p>

        <?php } elseif( $completado == 2) { ?>
            <p class="registrado__parrafo">
            Presentaremos el 
            <span class="registrado__parrafo--negritas"> presupuesto final </span>            
             correspondiente al 
            <span class="registrado__parrafo--negritas">  50%  </span>            
            restante.
            </p>

            <p class="registrado__precio-titulo">Pago final:</p>

        <?php } elseif( $completado == 3) { 
                if(!$requerimientos->extras == -1) {


            ?>
            <p class="registrado__parrafo">
            Aquí <span class="registrado__parrafo--negritas">mostraremos</span> el 
            <span class="registrado__parrafo--negritas"> presupuesto extra.</span>
            </p>

            <p class="registrado__precio-titulo">Pago extra:</p>

        <?php } 
            }
        ?>


        <p class="registrado__precio">
            $ <?php echo $precio ?? ' ???'; ?>
            <span class="registrado__precio--moneda">
                mxn
            </span>
        </p>
        <!-- Boton paypal -->
        <div id="botones__ariweb">
            <div id="smart-button-container">
                <div style="text-align: center;">
                    <div id="paypal-button-container"></div>
                </div>
            </div>
        </div>




    </div>
</section>
<?php }?>
<!-- fin pago -->

<section class="registrado " id="pago">
    <div class="registrado__contenedor-chico">
        <h1 class="registrado__titulo">
        Información del pago
        </h1>

        <p class="registrado__parrafo--negritas">Titulo: </p>
        <p class="registrado__parrafo"><?php echo $requerimientos->titulo;?> 
        </p>
        <p class="registrado__precio-titulo">Pago Total: </p>
        <?php
        $total = $requerimientos->primer_pago + $requerimientos->final_pago;
        ?>

        <p class="registrado__precio">$ <?php echo $total ?>
            <span class="registrado__precio--moneda">
                mxn
            </span>
        </p>


            <p class="registrado__precio-titulo"> Estado del Primer pago $<?php echo $requerimientos->primer_pago ?? '';?>: </p>
            <p class="<?php echo !empty(s($requerimientos->pago_id_pri)) ? 'registrado__exito' : 'registrado__pendiente'; ?>">
                <?php 
                    echo !empty(s($requerimientos->pago_id_pri)) ? 'Éxito' : 'Pendiente';
                ?>
            </p>



            <p class="registrado__precio-titulo">Estado del Pago final $<?php echo $requerimientos->final_pago ?? '';?>:</p>
            <p class="<?php echo !empty(s($requerimientos->pago_id_fin)) ? 'registrado__exito' : 'registrado__pendiente'; ?>">
                <?php 
                    echo !empty(s($requerimientos->pago_id_fin)) ? 'Éxito' : 'Pendiente';
                ?>
            </p>



            <p class="registrado__precio-titulo">
                Estado del Pago extra<?php
                if ($requerimientos->extras >= 0) {
                    echo ' $' . $requerimientos->extras;
                }
                ?>:
            </p>
            <p class="<?php echo ($requerimientos->extras < 0) ? 'registrado__null' : (empty(s($requerimientos->pago_id_ex)) ? 'registrado__pendiente' : 'registrado__exito'); ?>">
                <?php 
                    if ($requerimientos->extras < 0) {
                        echo 'No hay pagos extras';
                    } elseif (empty(s($requerimientos->pago_id_ex))) {
                        echo 'Pendiente';
                    } else {
                        echo 'Éxito';
                    }
                ?>
            </p>





    </div>
</section>


<!-- <script>
  paypal.Buttons({
    createOrder: function(data, actions) {
      // Agrega lógica para crear la orden de PayPal aquí
    },
    onApprove: function(data, actions) {
      // Agrega lógica para manejar la aprobación del pago aquí
    }
  }).render('#paypal-button-container');
</script>
<?php
//$script .= '<script src="https://www.paypal.com/sdk/js?client-id=' . $_ENV['CLIENT_ID'] . '"></script>';
?> -->


<?php if($precio) {?>


<?php
$script = '
<script src="https://www.paypal.com/sdk/js?client-id=' . $_ENV['CLIENT_ID'] . '&enable-funding=venmo&currency=MXN" data-sdk-integration-source="button-factory"></script>

<script>
function initPayPalButton() {
    paypal.Buttons({
    style: {
        shape: "rect",
        color: "gold",
        layout: "vertical",
        label: "pay",
    },
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [
                {
                    amount: {
                        currency_code: "MXN",
                        value: ' . $precio . ',
                    },
                    description: "' . $requerimientos->titulo . '",
                    shipping: {} 
                }
            ]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(orderData) {
        const datos = new FormData();
        datos.append("pago_id", orderData.purchase_units[0].payments.captures[0].id);
        datos.append("id_requerimientos", '. $requerimientos->id . ');
        datos.append("locked", "'. $requerimientos->locked . '");


        const dominio = window.location.origin;
        fetch(dominio + "/pagar", {
            method: "POST",
            body: datos
        })
        .then(respuesta => respuesta.json())
        .then(resultado => {
            console.log(resultado);
            console.log(resultado.resultado);
            if(resultado) {
            console.log("el pago fue exitoso");
            new Swal("¡Pago completado!", "El pago se ha realizado correctamente.", "success")
            .then(() => {
                // Redirige a la página y recarga
                window.location.href = dominio + "/requisitos-informacion#pago";
                location.reload();
            });
            } else {
            console.log("sucedio un error");
            new Swal("¡Error en el pago!", "No se pudo completar el pago, inténtelo de nuevo.", "error");
            }
        });
        });
    },
    onError: function(err) {
        console.log(err);
    }
    }).render("#paypal-button-container");
}
initPayPalButton();
</script>';
?>

<?php }?>

<?php }?>