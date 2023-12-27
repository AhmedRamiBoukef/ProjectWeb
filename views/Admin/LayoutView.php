<?php
class AdminLayoutView
{

    public function showNavbar()
    {
?>
        <div class="header-container">
            <a href="/Project/Admin/" class="logo">
                <img src="/Project/public/images/logo1.png" alt="">
                <h2>AutoVS</h2>
            </a>
            <a class="logout" href="/Project/Api/api.php?logout=1">
                <p>Logout</p>
                <img src="/Project/public/images/logout.png" alt="logout">
            </a>
        </div>
<?php
    }
}
