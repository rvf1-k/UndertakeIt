<section class="flex gap-8 p-8 overflow-x-auto bg-gray-100 min-h-screen">
    <?php
    $groupId = getGroupId();
    if (!GroupController::watchGroup($groupId)) {
        header("Location: ?page=home");
    } else {
        $group = GroupController::getGroup($groupId);
        $users = GroupController::getUsers($groupId);
    }
    ?>
    <form action="?page=edit-group&id=<?= $group['id'] ?>" method="POST" class="group-form">
        <div class="card">
            <h2>Editar grupo</h2>

            <label>
                Título
                <input
                    type="text"
                    name="titulo"
                    value="<?= htmlspecialchars($group['titulo']) ?>"
                    required>
            </label>

            <label>
                Descripción
                <textarea
                    name="descripcion"
                    rows="4"><?= htmlspecialchars($group['descripcion']) ?></textarea>
            </label>

            <button type="submit" name="action" value="edit-group">
                Guardar cambios
            </button>
        </div>
    </form>


    <div class="card">
        <div class="users-header">
            <h2>Usuarios</h2>

            <button
                type="button"
                onclick="document.getElementById('add-user-box').classList.toggle('hidden')">
                + Añadir usuario
            </button>
        </div>

        <div id="add-user-box" class="hidden add-user-box">
            <form method="POST">
                <input
                    type="email"
                    name="new_user_email"
                    placeholder="Correo del usuario">

                <select name="new_user_role">
                    <option value="lector">Lector</option>
                    <option value="editor">Editor</option>
                    <option value="admin">Admin</option>
                </select>

                <button
                    type="submit"
                    name="action"
                    value="add-user">
                    Añadir
                </button>
            </form>
        </div>

        <div class="users-list">
            <form action="?page=edit-group&id=<?= $group['id'] ?>" method="POST" class="group-form">

                <?php foreach ($users as $user): ?>

                    <div class="user-item">

                        <div class="user-info">

                            <div class="user-name">
                                <?= htmlspecialchars($user['username']) ?>
                            </div>

                            <div class="user-email">
                                <?= htmlspecialchars($user['email']) ?>
                            </div>

                        </div>

                        <div class="user-actions">

                            <!-- ROL -->
                            <input type="hidden" name="action" value="edit-group-users">

                            <select
                                name="roles[<?= $user['user_id'] ?>]"
                                onchange="this.form.submit()"
                                <?php if ($user['rol'] == 'owner'): ?> disabled <?php endif; ?>>
                                <option
                                    value="lector"
                                    <?= $user['rol'] === 'lector' ? 'selected' : '' ?>>
                                    Lector
                                </option>

                                <option
                                    value="editor"
                                    <?= $user['rol'] === 'editor' ? 'selected' : '' ?>>
                                    Editor
                                </option>

                                <option
                                    value="admin"
                                    <?= $user['rol'] === 'admin' ? 'selected' : '' ?>>
                                    Admin
                                </option>

                                <!-- No necesita value -->
                                <option disabled
                                    <?= $user['rol'] === 'owner' ? 'selected' : '' ?>>
                                    Owner
                                </option>
                            </select>


                            <?php //TODO: Banear/desbanear usuarios
                            ?>
                            <?php if ($user['rol'] !== 'owner'): ?>
                                <?php if ($user['baneado'] == 0): ?>

                                    <button
                                        type="submit"
                                        name="ban_user_id"
                                        value="<?= $user['user_id'] ?>"
                                        class="danger">
                                        Banear
                                    </button>

                                <?php else: ?>

                                    <button
                                        type="submit"
                                        name="unban_user_id"
                                        value="<?= $user['user_id'] ?>">
                                        Desbanear
                                    </button>

                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                <?php endforeach; ?>

            </form>
        </div>
    </div>

</section>