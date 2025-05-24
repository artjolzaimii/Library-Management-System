    <footer class="footer-section fix">
        <?php 
                require("styleAndScripts.php");
        ?>
        <div class="container">
            <div class="footer-widget-wrapper">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-4 wow fadeInUp" data-wow-delay=".2s">
                        <div class="single-footer-widget">
                            <div class="widget-head"><a href="index.html" class="footer-logo">
                                    <img src="../assets/img/logo/logo.png" alt="logo-img">
                                </a>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-4 ps-lg-5 wow fadeInUp" data-wow-delay=".4s">
                        <div class="single-footer-widget">
                            <div class="widget-head">
                                <h3>Costumers Support</h3>
                            </div>
                            <ul class="list-items">
                                <li>
                                    <a href="shopList.php">
                                        Shop List
                                    </a>
                                </li>
                                <li>
                                    <a href="mainPage.php#borrow">
                                        Borrow books
                                    </a>
                                </li>
                                <li>
                                    <a href="mainPage.php#ebook">
                                        E-Books
                                    </a>
                                </li>
                                <li>
                                    <a href="mainPage.php#authors">
                                        Authors
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-4 ps-lg-5 wow fadeInUp" data-wow-delay=".6s">
                        <div class="single-footer-widget">
                            <div class="widget-head">
                                <h3>Categories</h3>
                            </div>
                            <ul class="list-items">
                                <li>
                                    <a href="contact.html">
                                        Novel Books
                                    </a>
                                </li>
                                <li>
                                    <a href="shop.html">
                                        Poetry Books
                                    </a>
                                </li>
                                <li>
                                    <a href="contact.html">
                                        Political Books
                                    </a>
                                </li>
                                <li>
                                    <a href="contact.html">
                                        History Books
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".8s">
                        <div class="single-footer-widget">
                            <div class="widget-head">
                                <h3>Subcribe.</h3>
                            </div>
                            <div class="footer-content">
                                <p class="f-text">Our conversation is just getting started</p>
                                <div class="footer-input">
                                    <input type="email" id="email2" placeholder="Enter Your Email">
                                    <button class="newsletter-btn" type="submit">
                                        <span>Subscribe</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="footer-wrapper">
                    <p>CEN-311 Project -- Epoka University</p>
                </div>
            </div>
        </div>
    </footer>
    <?php ob_end_flush();?>