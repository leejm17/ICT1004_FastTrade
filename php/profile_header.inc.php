<?php
echo '
    <div class="nk-shop-header">
        <a href="userprofile.php" class="nk-shop-header-back"><span class="nk-icon-arrow-left"></span>Back to My Profile</a>
            <a href="#" class="nk-btn-color-white dropdown-toggle" data-toggle="dropdown">
                Menu
            </a>
            <ul class="dropdown-menu" id="profile_dropdown">
                <li><a class="dropdown-anchor" href="userprofile.php">Profile Overview</a></li>
                <li><a class="dropdown-anchor" href="updateProfile.php">Profile Update</a></li>

                <li class="dropdown-divider"></li>

                <li><a class="dropdown-anchor" href="display-item.php">All My Listings</a></li>
                <li><a class="dropdown-anchor" href="itemsSold.php">Items Sold</a></li>
                <li><a class="dropdown-anchor" href="sell-item.php">Sell An Item</a></li>

                <li class="dropdown-divider"></li>

                <li><a class="dropdown-anchor" href="offersSent.php">Offers Sent</a></li>
                <li><a class="dropdown-anchor" href="offersReceived.php">Offers Received</a></li>

                <li class="dropdown-divider"></li>

                <li><a class="dropdown-anchor" href="offersAccepted.php">Offers Accepted</a></li>
                <li><a class="dropdown-anchor" href="rejectedOffers.php">Offers Rejected</a></li>
            </ul>
        <a href="assets/php/logout.php" class="nk-btn-color-white">
            Logout
        </a>
    </div>
';
?>
