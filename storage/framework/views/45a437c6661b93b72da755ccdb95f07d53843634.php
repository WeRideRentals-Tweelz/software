<header class="container-fluid" style="margin-bottom: 50px; padding-left: 0;padding-right: 0">
	<nav class="navbar navbar-default navbar-static-top">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                <?php echo e(config('app.name', 'Tweelz')); ?>

            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right" style="margin-right: 50px;">
					<li><a href="<?php echo e(url('/')); ?>">Home</a></li>
					<li><a href="<?php echo e(url('/scooters')); ?>">Our scooters</a></li>
					<li><a href="#">About us</a></li>            
                <!-- Authentication Links -->
                <?php if(Auth::guest()): ?>
                    <li><a href="<?php echo e(url('/login')); ?>">Login</a></li>
                    <!-- <li><a href="<?php echo e(url('/register')); ?>">Register</a></li> -->
                <?php else: ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="<?php echo e(url('/home')); ?>">Dashboard</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('/home/bookings')); ?>">Bookings</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('/home/drivers')); ?>">Drivers</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('/logout')); ?>"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="<?php echo e(url('/logout')); ?>" method="POST" style="display: none;">
                                    <?php echo e(csrf_field()); ?>

                                </form>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>   
    </nav>
</header>