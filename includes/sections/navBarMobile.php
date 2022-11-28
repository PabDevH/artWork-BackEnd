<header class="header-mobile header-mobile-2 d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="images/icon/logo-white.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Home</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="index.php">Dashboard</a>
                                </li>
                                
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a href="#">
                                <i class="fas fa-certificate"></i>Allowance</a>
                                <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="allowance.php">List / View</a>
                                </li>
                               
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a href="#">
                                <i class="fas fa-picture-o"></i>Art Work NFT</a>
                                <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="listNFT.php">List</a>
                                </li>
                               
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a href="#">
                                <i class="fas fa-picture-o"></i>Gold NFT</a>
                                <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="goldCollections.php">Collections</a>
                                </li>
                                <li>
                                    <a href="myGold.php">My Gold</a>
                                </li>
                                
                            </ul>
                        </li>

                        
                        
                    </ul>
                </div>
            </nav>
        </header>
        <div class="sub-header-mobile-2 d-block d-lg-none">
            <div class="header__tool">
                
                
                <div class="account-wrap">
                    <div class="account-item account-item--style2 clearfix js-item-menu">
                        <div class="image">
                            <img src="images/metmask.png" alt="Metamask" />
                        </div>
                        <div class="content">
                            <a class="js-acc-btn" href="#">Metamask</a>
                        </div>
                        <div class="account-dropdown js-dropdown">
                            
                            <div class="account-dropdown__body">
                                <div class="account-dropdown__item">
                                    <a href="#" onClick="connectMetamask();">
                                        <i class="zmdi zmdi-account"></i><div id="metaMaskStatusMobile"></div></a>
                                </div>
                                <div class="account-dropdown__item">
                                    <a href="#">
                                        <i class="zmdi zmdi-settings"></i><div id="metamaskAccountNameMobile"></div></a>
                                </div>
                                <div class="account-dropdown__item">
                                    <a href="#">
                                        <i class="zmdi zmdi-money-box"></i><div id="metamaskChainNameMobile"></div></a>
                                </div>
                            </div>
                            <div class="account-dropdown__footer">
                                <a href="#">
                                    <i class="zmdi zmdi-power"></i>Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>