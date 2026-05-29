<section class="min-h-screen bg-gray-100 p-6 md:p-8">

    <?php
    $groupId = getPathId();

    if (!GroupController::watchGroup($groupId)) {
        header("Location: ?page=home");
    } else {
        $group = GroupController::getGroup($groupId);
        $users = GroupController::getUsers($groupId);
    }
    ?>

    <div class="max-w-6xl mx-auto grid grid-cols-1 xl:grid-cols-[400px_1fr] gap-6">

        <!-- EDITAR GRUPO -->
        <form
            action="?page=edit-group&id=<?= $group['id'] ?>"
            method="POST">

            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">

                    <h2 class="text-2xl font-semibold text-gray-800">
                        Editar grupo
                    </h2>

                    <p class="text-sm text-gray-600 mt-1">
                        Modifica la información principal del grupo.
                    </p>

                </div>

                <div class="p-6 flex flex-col gap-6">

                    <div class="flex flex-col gap-2">

                        <label class="text-sm font-medium text-gray-700">
                            Título
                        </label>

                        <input
                            type="text"
                            name="titulo"
                            value="<?= htmlspecialchars($group['titulo']) ?>"
                            required
                            class="input">

                    </div>

                    <div class="flex flex-col gap-2">

                        <label class="text-sm font-medium text-gray-700">
                            Descripción
                        </label>

                        <textarea
                            name="descripcion"
                            rows="5"
                            class="input resize-none"><?= htmlspecialchars($group['descripcion']) ?></textarea>

                    </div>

                </div>

                <div class="px-6 py-5 border-t border-gray-200 bg-white flex justify-end">

                    <button
                        type="submit"
                        name="action"
                        value="edit-group"
                        class="btn btn-primary">

                        Guardar cambios

                    </button>

                </div>

            </div>

        </form>

        <!-- USUARIOS -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden h-fit">

            <div class="flex items-center justify-between px-6 py-5 border-b border-gray-200 bg-gray-50">

                <div>

                    <h2 class="text-2xl font-semibold text-gray-800">
                        Usuarios
                    </h2>

                    <p class="text-sm text-gray-600 mt-1">
                        Gestiona accesos y permisos del grupo.
                    </p>

                </div>

                <button
                    type="button"
                    onclick="document.getElementById('add-user-box').classList.toggle('hidden')"
                    class="btn btn-secondary">

                    <i class="fa-solid fa-plus mr-2"></i>
                    Añadir usuario

                </button>

            </div>

            <!-- AÑADIR USUARIO -->
            <div
                id="add-user-box"
                class="hidden p-6 border-b border-gray-200 bg-gray-50">

                <form method="POST" class="flex flex-col gap-4">

                    <input
                        type="email"
                        name="new_user_email"
                        placeholder="Correo del usuario"
                        class="input">

                    <select
                        name="new_user_role"
                        class="input">

                        <option value="lector">Lector</option>
                        <option value="editor">Editor</option>
                        <option value="admin">Admin</option>

                    </select>

                    <button
                        type="submit"
                        name="action"
                        value="add-user"
                        class="btn btn-primary w-fit">

                        Añadir usuario

                    </button>

                </form>

            </div>

            <!-- LISTA USUARIOS -->
            <div>

                <form
                    action="?page=edit-group&id=<?= $group['id'] ?>"
                    method="POST">

                    <input
                        type="hidden"
                        name="action"
                        value="edit-group-users">

                    <div class="divide-y divide-gray-200">

                        <?php foreach ($users as $user): ?>

                            <div class="p-5 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

                                <div>

                                    <div class="text-base font-medium text-gray-800">
                                        <?= htmlspecialchars($user['username']) ?>
                                    </div>

                                    <div class="text-sm text-gray-500 mt-1">
                                        <?= htmlspecialchars($user['email']) ?>
                                    </div>

                                </div>

                                <div class="flex flex-wrap items-center gap-3">

                                    <!-- ROL -->
                                    <select
                                        name="roles[<?= $user['user_id'] ?>]"
                                        onchange="this.form.submit()"
                                        class="input min-w-[140px]"
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

                                        <option
                                            disabled
                                            <?= $user['rol'] === 'owner' ? 'selected' : '' ?>>
                                            Owner
                                        </option>

                                    </select>

                                    <!-- BAN -->
                                    <?php if ($user['rol'] !== 'owner'): ?>

                                        <?php if ($user['baneado'] == 0): ?>

                                            <button
                                                type="submit"
                                                name="ban_user_id"
                                                value="<?= $user['user_id'] ?>"
                                                class="btn btn-danger">

                                                Banear

                                            </button>

                                        <?php else: ?>

                                            <button
                                                type="submit"
                                                name="unban_user_id"
                                                value="<?= $user['user_id'] ?>"
                                                class="btn btn-secondary">

                                                Desbanear

                                            </button>

                                        <?php endif; ?>

                                    <?php endif; ?>

                                </div>

                            </div>

                        <?php endforeach; ?>

                    </div>

                </form>

            </div>

        </div>

    </div>

</section>