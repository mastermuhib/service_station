<aside class="navbar-aside" id="offcanvas_aside">
    <div class="aside-top">
        <a href="javascript:void(0)" class="brand-wrap">
            <img src="{{URL::asset('assets')}}/imgs/icon_suuk_new.png" class="logo" alt="SOUQ" style="height: 50px;min-width: 50px;" />
        </a>
        <div>
            <button class="btn btn-icon btn-aside-minimize"><i class="text-muted material-icons md-menu_open"></i></button>
        </div>
    </div>
    <nav>
        <ul class="menu-aside">
            <li class="menu-item <?php if ($slug == 'product' ) {echo 'active';} ?>">
                <a class="menu-link" href="/admin/product">
                    <i class="icon material-icons md-shopping_bag"></i>
                    <span class="text">Product</span>
                </a>
            </li>
            <li class="menu-item <?php if ($slug == 'transaction' ) {echo 'active';} ?>">
                <a class="menu-link" href="/admin/transaction">
                    <i class="icon material-icons md-monetization_on"></i>
                    <span class="text">Product</span>
                </a>
            </li>
            <li class="menu-item <?php if ($slug == 'customer' ) {echo 'active';} ?>">
                <a class="menu-link" href="/admin/customer">
                    <i class="icon material-icons md-person"></i>
                    <span class="text">Product</span>
                </a>
            </li>
        </ul>
        <br />
        <br />
    </nav>
</aside>