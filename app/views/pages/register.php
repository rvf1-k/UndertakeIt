<div class="min-h-screen bg-gray-100 flex items-center justify-center p-6">

    <div class="w-full max-w-md bg-white border border-gray-200 rounded-xl shadow-sm p-8">

        <div class="mb-8">

            <h1 class="text-3xl font-semibold text-gray-800 mb-2">
                Crear cuenta
            </h1>

            <p class="text-sm text-gray-600">
                Empieza a organizar tus tareas y proyectos.
            </p>

        </div>

        <form action="?page=register" method="POST" class="flex flex-col gap-5">

            <div class="flex flex-col gap-2">

                <label class="text-sm font-medium text-gray-700">
                    Usuario
                </label>

                <input
                    type="text"
                    name="username"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[var(--primary-color)] focus:border-transparent transition">

            </div>

            <div class="flex flex-col gap-2">

                <label class="text-sm font-medium text-gray-700">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[var(--primary-color)] focus:border-transparent transition">

            </div>

            <div class="flex flex-col gap-2">

                <label class="text-sm font-medium text-gray-700">
                    Contraseña
                </label>

                <input
                    type="password"
                    name="password"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[var(--primary-color)] focus:border-transparent transition">

            </div>

            <button
                type="submit"
                class="w-full py-3 px-4 rounded-lg text-white font-medium transition hover:opacity-90"
                style="background-color: var(--primary-color);">

                Registrarse

            </button>

            <p class="text-sm text-gray-600 text-center">

                ¿Ya tienes cuenta?

                <a
                    href="?page=login"
                    class="font-medium transition hover:opacity-80"
                    style="color: var(--primary-color);">

                    Iniciar sesión

                </a>

            </p>

            <input type="hidden" name="action" value="register">

        </form>

    </div>

</div>