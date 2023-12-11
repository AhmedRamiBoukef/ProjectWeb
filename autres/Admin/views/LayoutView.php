<?php
class LayoutView
{

    public function showNavbar()
    {
?>
        <div class="header-container">
            <div class="logo">
                <img src="/Project/Admin/public/images/logo1.png" alt="">
                <h2>AutoVS</h2>
            </div>
            <a class="logout" href="/Project/Admin/Api/api.php?logout=1">
                <p>Logout</p>
                <img src="/Project/Admin/public/images/logout.png" alt="logout">
            </a>
        </div>
<?php
    }
}
