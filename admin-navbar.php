<nav class="navbar navbar-expand-xl navbar-dark bg-dark ">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Star Clusters</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end bg-dark text-white" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Star Clusters</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="list-group navbar-nav justify-content-end gap-2 flex-grow-1">
                    <a class="btn btn-dark text-start" href="admin.php">Admin</a>
                    <a class="btn btn-dark text-start" href="blog-list.php">Blog</a>
                    <a class="btn btn-dark text-start" href="cover.php">Cover</a>
                    <a class="btn btn-dark text-start" href="faq-list.php">FAQ</a>
                    <a class="btn btn-dark text-start" href="website-info.php">Website Info</a>
                    <a class="btn btn-dark text-start" href="message-list.php">Message</a>
                    <a class="btn btn-dark text-start" href="project-list.php">Project</a>
                    <a class="btn btn-dark text-start" href="service-list.php">Service</a>
                    <a class="btn btn-dark text-start" href="team-list.php">Team</a>
                    <?php
                if (!isset($_SESSION['loggedin'])) { ?>
                    <a class="btn btn-dark text-start" href="login.php">Login</a>
                    <?php }?>
                    <?php
                if (isset($_SESSION['loggedin'])) { ?>
                    <a class="btn btn-dark text-start" href="logout.php">Logout</a>
                    <?php }?>
                </ul>
            </div>
        </div>
    </div>
</nav>