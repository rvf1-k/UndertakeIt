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