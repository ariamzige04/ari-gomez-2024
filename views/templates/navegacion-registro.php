<button class="navegacion-registro__boton">
    <i class="bi bi-person-circle"></i>
    <i class="bi bi-three-dots-vertical"></i>
</button>

<div class="navegacion-registro">
    <div class="navegacion-registro__contenedor">

        <a href="/requisitos-informacion" class="navegacion-registro__enlace">
        <i class="bi bi-info-circle navegacion-registro__icono"></i>
            Información de su sitio web
        </a>

        <!-- <a href="/presupuesto" class="navegacion-registro__enlace">
            <i class="bi bi-wallet2 navegacion-registro__icono"></i>
            Pago del presupuesto
        </a> -->

        <!-- <a href="#" class="navegacion-registro__enlace">
        <i class="bi bi-box-arrow-left navegacion-registro__icono"></i>
            Cerrar sesión
        </a> -->

        <form method="POST" action="/logout">
            <button type="submit" class="navegacion-registro__enlace">
                <i class="bi bi-box-arrow-left navegacion-registro__icono"></i>
                Cerrar Sesión
            </button>
        </form>

    </div>
</div>