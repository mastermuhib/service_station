<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Admin Panel</title>
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:title" content="" />
        <meta property="og:type" content="" />
        <meta property="og:url" content="" />
        <meta property="og:image" content="" />
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{URL::asset('assets_cms')}}/imgs/fav.png" />
        <!-- Template CSS -->
        <link href="{{URL::asset('assets_cms')}}/css/main.css?v=1.1" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <main>
            <header class="main-header style-2 navbar">
                <div class="col-brand">
                    <a href="index.html" class="brand-wrap">
                        <img src="{{URL::asset('assets_cms')}}/imgs/fav.png" class="logo" alt="Admin Souq" />
                    </a>
                </div>
                <div class="col-nav">
                    
                </div>
            </header>
            <section class="content-main mt-80 mb-80">
                <div class="card mx-auto card-login">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Sign in</h4>
                        @if (\Session::has('message'))
                            <div class="alert alert-danger form-group">
                                <ul>
                                    
                                        <li>{!! \Session::get('message') !!}</li>
                                    
                                </ul>
                            </div>
                        @else
                        baik baik
                        @endif
                        <form class="form" novalidate="novalidate" method="post" action="/admin/login">@csrf
                            <div class="mb-3">
                                <input class="form-control" placeholder="Username or email" type="text" name="username" />
                            </div>
                            <!-- form-group// -->
                            <div class="mb-3">
                                <input class="form-control" placeholder="Password" type="password" name="password" />
                            </div>
                            <!-- form-group// -->
                            <div class="mb-3">
                                
                            </div>
                            <!-- form-group form-check .// -->
                            <div class="mb-4">
                                <button type="submit" class="btn btn-primary w-100">Login</button>
                            </div>
                            <!-- form-group// -->
                        </form>
                    </div>
                </div>
            </section>
            <footer class="main-footer text-center">
                <p class="font-xs">
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                    &copy; Admin Panel.
                </p>
                <p class="font-xs mb-30">All rights reserved</p>
            </footer>
        </main>
        <script src="{{URL::asset('assets_cms')}}/js/vendors/jquery-3.6.0.min.js"></script>
        <script src="{{URL::asset('assets_cms')}}/js/vendors/bootstrap.bundle.min.js"></script>
        <script src="{{URL::asset('assets_cms')}}/js/vendors/jquery.fullscreen.min.js"></script>
        <!-- Main Script -->
        <script src="{{URL::asset('assets_cms')}}/js/main.js?v=1.1" type="text/javascript"></script>
    </body>
</html>