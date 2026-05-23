</div>

<?php include_once __DIR__ . '/../components/navbar.php'; ?>
<?php include_once __DIR__ . '/../components/groups/add-groups.php'; ?>
<?php include_once __DIR__ . '/../components/task-card.php'; ?>

<nav>
    <ul>
        <li>
            <a href="?page=dashboard"><i class="fa-solid fa-clipboard-list"></i></a>
        </li>
        <li>
            <a href="?page=calendario"><i class="fa-solid fa-calendar-days"></i></a>
        </li>
        <li>
            <button id="add-task" class="link-button">
                <i class="fa-solid fa-circle-plus"></i>
            </button>
        </li>
        <li>
            <a href="?page=habitos"><i class="fa-solid fa-location-pin"></i></a>
        </li>
        <!-- //TODO: Temporal hasta tener pagina de ajustes -->
        <li>
            <form action="?page=logout" method="POST">

                <button type="submit" class="link-button">
                    <i class="fa-solid fa-gear"></i>
                </button>

                <input type="hidden" name="action" value="logout">
            </form>
        </li>
    </ul>
</nav>
</body>
<script type="module" src="assets/js/app.js"></script>

</html>