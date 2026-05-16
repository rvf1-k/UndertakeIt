<div id="navbar">
    <section>
        <ul>
            <li><button>Hoy</button></li>
            <li><button>Próximos 7 días</button></li>
            <li><button>Mis tareas</button></li>
        </ul>
    </section>
    <!-- //TODO: Temporal -->
     <button id="crear-group" type="button">Crear grupo</button>
    <br>
    <hr>
    <br>
    <section id="groups-section">
        <?php GroupController::GroupList(); ?>
    </section>
</div>