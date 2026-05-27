<div id="navbar">
    <section>
        <ul>
            <li>
                <a href="?page=today">Hoy</a>
            </li>

            <li>
                <a href="?page=next-7-days">Próximos 7 días</a>
            </li>

            <li>
                <a href="?page=my-tasks">Mis tareas</a>
            </li>
        </ul>
    </section>
    <!-- //TODO: Temporal -->
    <button id="crear-group" type="button">Crear grupo</button>
    <br>
    <hr>
    <br>
    <section id="groups-section">
        <?php GroupController::GroupList(); ?>
        <div
            id="edit-group-modal"
            class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center">

            <div
                id="group-modal-content"
                class="bg-white rounded-xl p-6 w-full max-w-lg">

            </div>

        </div>
    </section>
</div>