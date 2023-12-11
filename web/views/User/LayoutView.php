<?php

class LayoutView
{
    public function showMenu()
    {
?>      <nav class="menu">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">News</a></li>
                <li><a href="#">Comparator</a></li>
                <li><a href="#">Brands</a></li>
                <li><a href="#">Reviews</a></li>
                <li><a href="#">Guides</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
        <?php
            }

            public function showFooter()
            {
                ?>
                <nav class="footer-menu">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">News</a></li>
                        <li><a href="#">Comparator</a></li>
                        <li><a href="#">Brands</a></li>
                        <li><a href="#">Reviews</a></li>
                        <li><a href="#">Guides</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </nav>
                <?php
            }
            public function showHeader()
            {
                ?>
                <div class="header-container">
                    <div class="logo">
                        <img src="/Project/public/images/logo1.png" alt="">
                        <h2>AutoVS</h2>
                    </div>
                    <div class="social">
                        <a href="#">
                            <img src="/Project/public/images/facebook.png" alt="facebook">
                        </a>
                        <a href="#">
                            <img src="/Project/public/images/instagram.png" alt="instagram">
                        </a>
                        <a href="#">
                            <img src="/Project/public/images/linkedin.png" alt="linkedin">
                        </a>

                    </div>
                </div>


<?php
            }
        }
