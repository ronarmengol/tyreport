
<p class="nav-user"><?php echo $_SESSION['user'] ?? 'guest'; ?></p>
<nav class="main-nav">
    <div class="main-nav-brand">
        tyreport
    </div>
    <ul>
        

        <!-- LOGGED IN USER -->
        <?php if(empty($_SESSION['user'])) : ?>
            <li >
                <a  class="<?php echo isurl('/') ? 'nav-active' : ''  ?>"href="/">home</a>
            </li>
            <li>
                <a class="<?php echo isurl('/login.php') ? 'nav-active' : ''  ?> px-5 py-2 rounded"href="/login.php">login</a>
            </li>
            <li>
                <a class="<?php echo isurl('/contact.php') ? 'nav-active' : ''  ?> px-5 py-2 rounded"href="/contact.php">contact us</a>
            </li>
        <?php else: ?>
        
        <li>
            <a class="<?php echo isurl('/logout.php') ? 'nav-active' : ''  ?> px-5 py-2 rounded"href="/logout.php">logout</a>
        </li>
        <?php endif; ?>
    </ul>
</nav>