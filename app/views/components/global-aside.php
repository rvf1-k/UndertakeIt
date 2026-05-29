<nav class="h-full flex flex-col items-center py-4 px-2 gap-2 bg-white border-r border-gray-200">

    <ul class="flex flex-col items-center gap-2 flex-1">

        <li>
            <button onclick="window.location.href='?page=today'"
                class="p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition">
                <i class="fa-solid fa-clipboard-list text-xl"></i>
            </button>
        </li>

        <li>
            <button onclick="window.location.href='?page=calendario'"
                class="p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition">
                <i class="fa-solid fa-calendar-days text-xl"></i>
            </button>
        </li>

        <li>
            <button id="add-task"
                class="p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition">
                <i class="fa-solid fa-circle-plus text-xl"></i>
            </button>
        </li>

        <li>
            <button onclick="window.location.href='?page=habitos'"
                class="p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition">
                <i class="fa-solid fa-location-pin text-xl"></i>
            </button>
        </li>

    </ul>

    <div class="pb-4">

        <form action="?page=logout" method="POST">
            <button type="submit"
                class="p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition">
                <i class="fa-solid fa-gear text-xl"></i>
            </button>
            <input type="hidden" name="action" value="logout">
        </form>

    </div>

</nav>