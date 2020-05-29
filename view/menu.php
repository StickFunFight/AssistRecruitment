<?php
    // Checking if user exists

?>
<html lang="en">
    <head>
        <?php
            // including the head
            require("head.php");
        ?>
        <style><?php require("../assests/styling/menu.css"); ?></style>
        <title>Assist Recruitment</title>
        <meta name="author" content="Marvin Vissers">
    </head>

    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar -->
            <div class="border-right" id="sidebar-wrapper">
                <div class="menu list-group list-group-flush">
                    <div class="menu__picture">
                        <a href="../view"><img src="../assests/images/AssistLogoWit.png" class="menu--logo" alt="Logo Assist"></a>
                    </div>

                    <nav class="navbar">
                        <div class="navbar__top">
                            <ul class="navbar__list">
                                <li class="navbar__item">
                                    <i class="fa navbar--icon"><a href="#" class="navbar--link">&#xf1c0;</a></i>
                                </li>

                                <li class="navbar__item">
                                    <i class="fa navbar--icon"><a href="#" class="navbar--link">&#xf067;</a></i>
                                </li>

                                <li class="navbar__item">
                                    <i class="fa navbar--icon" onclick="maintenceSubMenu()"><a href="#" class="navbar--link">&#xf013;</a></i>
                                </li>
                            </ul>
                        </div>

                        <div class="navbar__bottom">
                            <ul class="navbar__list">
                                <li class="navbar__item">
                                    <i class="fa navbar--icon"><a href="profile" class="navbar--link">&#xf007;</a></i>
                                </li>
                                <li class="navbar__item">
                                    <i class="fa navbar--icon"><a href="../functions/handler/logoutHandler" class="navbar--link">&#xf2f5;</a></i>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>

                <div class="submenu" id="maintanceSubmenu">
                    <ul class="submenu__list">
                        <li class="submenu__item"><a href="customer_list" class="submenu--link">Customer</a></li>
                        <li class="submenu__item"><a href="department-list" class="submenu--link">Department</a></li>
                        <li class="submenu__item"><a href="user-list" class="submenu--link">User</a></li>
                        <li class="submenu__item"><a href="scan-list" class="submenu--link">Scan</a></li>
                        <li class="submenu__item"><a href="qa" class="submenu--link">QA</a></li>
                        <li class="submenu__item"><a href="questionair" class="submenu--link">Questonair</a></li>
                        <li class="submenu__item"><a href="Axis" class="submenu--link">Axis</a></li>
                        <li class="submenu__item"><a href="qaTable" class="submenu--link">Average score</a></li>
                    </ul>

                    <div class="submenu__resize">
                        <i class="fas submenu--icon" id="submenuFavicon">&#xf100;</i>
                    </div>
                </div>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper"> 
        </div>
    </body>

    <script>
        // Functie voor openen en sluiten van het submenubalk
        $('.submenu--icon').on('click', function(){
            $('.submenu').toggleClass('submenu--hide');
            $('.submenu--icon').toggleClass('submenu--icon-right');
        });
    </script>
</html>