<button class="navegacion-registro__boton">
    <i class="bi bi-person-circle"></i>
    <i class="bi bi-three-dots-vertical"></i>
</button>

<div class="navegacion-registro">
    <div class="navegacion-registro__contenedor">

        <a href="/admin/dashboard" class="navegacion-registro__enlace">
            <i class="bi bi-house navegacion-registro__icono"></i>
            Panel de administracion
        </a>

        <a href="/admin/portafolio" class="navegacion-registro__enlace">
            <i class="bi bi-briefcase navegacion-registro__icono"></i>
            Mi portafolio 
        </a>

        <a href="/admin/requerimientos" class="navegacion-registro__enlace">
            <!-- <i class="bi bi-people navegacion-registro__icono"></i> -->
            <i class="bi bi-journal navegacion-registro__icono"></i>
            Requerimientos
        </a>

        <a href="/admin/clientes-frecuentes" class="navegacion-registro__enlace">
            <i class="bi bi-people navegacion-registro__icono"></i>
            Clientes frecuentes
        </a>

        <form method="POST" action="/logout">
            <button type="submit" class="navegacion-registro__enlace">
                <i class="bi bi-box-arrow-left navegacion-registro__icono"></i>
                Cerrar Sesión
            </button>
        </form>

    </div>
</div>