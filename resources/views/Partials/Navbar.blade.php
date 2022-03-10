<nav class="navbar navbar-light bg-light pb-0">
    <div class="container">
        <div class="navbar-brand d-flex">
            <p class=" teks my-auto">Todo List</p>
        </div>
        <div class="dropdown">
            <div class=" dropdown-toggle teks1" href="#" id="dropdownMenuLink" data-bs-toggle="dropdown"
                aria-expanded="false" style="cursor: pointer">
                {{ $email }}
            </div>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="/logout"><i class="bi bi-box-arrow-right"></i>&nbsp;Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
