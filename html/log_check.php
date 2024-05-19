<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    echo "<li><a href='logout.php' id='logoutButton'>Kijelentkezés</a></li>";
}
else {
    echo "
    <li>
        <a href='login_html.php' class='user' id='loginLink'><i class='ri-user-fill'></i>Bejelentkezés</a>
    </li>
    <li><a href='register.php'>Regisztráció</a></li>
    ";
} 
?>