<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Admin Panel SOUQ</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:title" content="" />
        <meta property="og:type" content="" />
        <meta property="og:url" content="" />
        <meta property="og:image" content="" />
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{URL::asset('assets')}}/imgs/icon_suuk_new.png" />
        <!-- Template CSS -->
        <link href="{{URL::asset('assets')}}/css/main.css?v=1.1" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('assets')}}/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('assets')}}/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{URL::asset('assets')}}/vendors/css/forms/select/select2.min.css">
    </head>
    <style type="text/css">
        .dataTables_filter {
            text-align: right;
        }
    </style>

    <body style="zoom: 90%;">
        <div class="screen-overlay"></div>
        <!-- sidebar -->
        @include('components/sidebar')
        <main class="main-wrap">
            
            <header class="main-header navbar">
                <div class="col-search">

                    @if(isset($header_title))
                    <h3 class="content-title card-title"><a href="javascript:history.back()"><i class="material-icons md-arrow_back"></i></a> {{$header_title}}</h3>
                    @endif
                </div>
                <div class="col-nav">
                    <button class="btn btn-icon btn-mobile me-auto" data-trigger="#offcanvas_aside"><i class="material-icons md-apps"></i></button>
                    <ul class="nav">
                        <li class="nav-item d-none">
                            <a class="nav-link btn-icon" href="javascript:void(0)" onclick="toastr.info('Hi! I am info message.');">
                                <i class="material-icons md-notifications animation-shake"></i>
                                <span class="badge rounded-pill">3</span>
                            </a>
                        </li>
                        <li class="dropdown nav-item d-none">
                            <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownLanguage" aria-expanded="false"><i class="material-icons md-public"></i></a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownLanguage">
                                <a class="dropdown-item text-brand" href="#"><img src="{{URL::asset('assets')}}/imgs/theme/flag-us.png" alt="English" />English</a>
                                <a class="dropdown-item" href="#"><img src="{{URL::asset('assets')}}/imgs/theme/flag-fr.png" alt="Français" />Français</a>
                                <a class="dropdown-item" href="#"><img src="{{URL::asset('assets')}}/imgs/theme/flag-jp.png" alt="Français" />日本語</a>
                                <a class="dropdown-item" href="#"><img src="{{URL::asset('assets')}}/imgs/theme/flag-cn.png" alt="Français" />中国人</a>
                            </div>
                        </li>
                        <li class="dropdown nav-item">
                            <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownAccount" aria-expanded="false"> 
                                @if(Auth::guard('admin')->user()->profile != null)
                                <img class="img-xs rounded-circle" src="{{Auth::guard('admin')->user()->profile}}" alt="User" />
                                @else
                                <img class="img-xs rounded-circle" src="{{URL::asset('assets')}}/imgs/people/avatar-2.png" alt="User" />
                                @endif
                            </a>
                            @if(isset(Auth::guard('admin')->user()->id))
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAccount">
                                <a class="dropdown-item" href="/administrator/list-admin/{{ base64_encode(Auth::guard('admin')->user()->id)}}"><i class="material-icons md-perm_identity"></i>Edit Profile</a>
                                <a class="dropdown-item darkmode" href="#"><i class="material-icons md-settings"></i>Ganti Warna</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="/logout"><i class="material-icons md-exit_to_app"></i>Logout</a>
                            </div>
                            @endif
                        </li>
                    </ul>
                </div>
            </header>
            <section class="content-main">
                @yield('content')
            </section>
        </main>
    </body>
</html>