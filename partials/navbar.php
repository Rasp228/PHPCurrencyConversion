<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'currencylist.php') ? 'active' : ''; ?>"  href="currencylist.php">Lista walut</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'currencyconversion.php') ? 'active' : ''; ?>" href="currencyconversion.php">Przewalutowywanie</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<body class="d-flex flex-column min-vh-100">