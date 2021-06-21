
<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
            </ul>
            <?php
                $DBUser = new Dao();
                $user = new User();
            if(isset($_SESSION['email'])) {
                $user->setEmail($_SESSION['email']);
                $user->setSessionId(session_id());
                $user->setSessionTime(date('Y-m-d H:i:s'));
            }

            if($DBUser->CheckSession($user) && isset($_SESSION['email'])){
                echo '<div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-lg btn-primary me-md-2" type="button" onclick="location.href = \'templates/registration.php\';">'.$_SESSION['email'].'</button>
                        <button class="btn btn-lg btn-primary" type="button" onclick="location.href = \'templates/logout.php\';">LogOut</button>
                    </div>';
            }
            else{
                echo '<div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-lg btn-primary me-md-2" type="button" onclick="location.href = \'templates/registration.php\';">Registration</button>
                        <button class="btn btn-lg btn-primary" type="button" onclick="location.href = \'templates/login.php\';">LogIn</button>
                    </div>';
            }
            ?>

        </div>
    </div>
</nav>

