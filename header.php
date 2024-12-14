<header>
    <nav>
        <div class="nav-logo">
            <img src="./images/logo.gif" alt="PageTerner Logo">
            <h1>Page<span>Turner</span></h1>
        </div>
        <div class="nav-item">
            <ul>
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="books.php">Books</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="faq.php">Faq'S</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
            <form action="search.php" class="search">
                
                <button style="background: none;border:none;color:white;padding:10px;font-size:20px;" type="submit" name="submit"><i class="las la-search"></i></button>
                <input type="text" placeholder="Search" name="search">
            </form>
            <ul>
                <li class="user-nav-item">
                    <a href="login.php">
                        <i class="las la-user-plus"></i>
                        <span class="tooltip">Login/Registration</span>
                    </a>

                </li>
                <li>
                    <a href="cart.php">
                        <i class="las la-shopping-cart"></i>
                    </a>
                </li>

                <li>
                    <a href="wish.php">
                        <i class="las la-heart"></i>
                    </a>
                </li>
                <li>
                    <a href="brrow.php">
                        <i class="las la-hand-holding-heart"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>