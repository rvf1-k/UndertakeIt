<form action="?page=login" method="POST">

    Email:
    <input type="email" name="email" required>

    <br>

    Contraseña:
    <input type="password" name="password" required>

    <br>

    <button type="submit">
        Login
    </button>

    <p>Si no tienes cuenta <a href='?page=register'>registrate</a>.</p>

    <input type="hidden" name="action" value="login">
</form>