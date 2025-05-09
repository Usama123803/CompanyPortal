<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title', 'Admin Panel')</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="AdminLTE v4 | Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS."
    />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"
    />
    <!--end::Primary Meta Tags-->
    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
    />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
      integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}" />
    <!--end::Required Plugin(AdminLTE)-->
    <!-- apexcharts -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
      integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0="
      crossorigin="anonymous"
    />
    <!-- jsvectormap -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
      integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4="
      crossorigin="anonymous"
    />
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
            <!-- <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Home</a></li> -->
            <!-- <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Contact</a></li> -->

          </ul>
          <!--end::Start Navbar Links-->
          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
           <!--  <li class="nav-item dropdown">
              <a class="nav-link" data-bs-toggle="dropdown" href="#">
                <i class="bi bi-bell-fill"></i>
                <span class="navbar-badge badge text-bg-warning">15</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-envelope me-2"></i> 4 new messages
                  <span class="float-end text-secondary fs-7">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-people-fill me-2"></i> 8 friend requests
                  <span class="float-end text-secondary fs-7">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                  <span class="float-end text-secondary fs-7">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer"> See All Notifications </a>
              </div>
            </li> -->
            <!--end::Notifications Dropdown Menu-->
            
            @if(Session::has('Company'))
            @else
              <!--begin::Messages Dropdown Menu-->
              <li class="nav-item dropdown">
                  <a class="nav-link" data-bs-toggle="dropdown" href="#">
                      <i class="bi bi-chat-text"></i>
                      <span class="navbar-badge badge text-bg-danger">{{ $messages->count() }}</span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    @forelse($messages as $message)
                        <a href="#" class="dropdown-item">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <h3 class="dropdown-item-title">{{ $message->name }}</h3>
                                    <p class="fs-7">{{ Str::limit($message->subject, 50) }}</p>
                                    <p class="fs-7 text-secondary">
                                        <i class="bi bi-clock-fill me-1"></i> {{ $message->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                    @empty
                        <p>No new messages.</p>
                    @endforelse
                </div>
              </li>
              <!--end::Messages Dropdown Menu-->
            @endif

            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
              <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
              </a>
            </li>
            <!--end::Fullscreen Toggle-->
            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img
                  src="{{ asset('assets/img/user2-160x160.jpg') }}"
                  class="user-image rounded-circle shadow"
                  alt="User Image"
                />
                <span class="d-none d-md-inline">{{ Session::get('user_name') }}</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <!--begin::User Image-->
                <li class="user-header text-bg-primary">
                  <img
                    src="{{ asset('assets/img/user2-160x160.jpg') }}"
                    class="rounded-circle shadow"
                    alt="User Image"
                  />
                  <p>
                    {{ Session::get('user_name') }}
                  </p>
                </li>
                <!--end::User Image-->
                <!--begin::Menu Body-->
                <!-- <li class="user-body">
                  <div class="row">
                    <div class="col-4 text-center"><a href="#">Followers</a></div>
                    <div class="col-4 text-center"><a href="#">Sales</a></div>
                    <div class="col-4 text-center"><a href="#">Friends</a></div>
                  </div>
                </li> -->
                <!--end::Menu Body-->
                <!--begin::Menu Footer-->
                <li class="user-footer">
                  <!-- <a href="#" class="btn btn-default btn-flat">Profile</a> -->
                  @if(Session::has('Company'))
                    <li class="nav-item d-none d-md-block">
                      <form method="POST" action="{{ route('company.logout') }}">
                          @csrf

                          <button type="submit" class="nav-link">Sign out</button>
                      </form>
                    </li>
                  @else
                    <li class="nav-item d-none d-md-block">
                      <form method="POST" action="{{ route('logout') }}">
                          @csrf
                          <button type="submit" class="btn btn-default btn-flat float-end">Sign out</button>
                      </form>
                    </li>
                  @endif
                </li>
                <!--end::Menu Footer-->
              </ul>
            </li>
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
      <!--end::Header-->
      <!--begin::Sidebar-->
      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          @if(Session::has('Company'))
            <a href="{{ route('company.dashboard') }}" class="brand-link">
              <!--begin::Brand Image-->
              <img
                src="{{ asset('assets/img/AdminLTELogo.png') }}"
                alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow"
              />
              <!--end::Brand Image-->
              <!--begin::Brand Text-->
              <span class="brand-text fw-light">Company Portal</span>
              <!--end::Brand Text-->
            </a>
          @else
            <a href="{{ route('admin.dashboard') }}" class="brand-link">
              <!--begin::Brand Image-->
              <img
                src="{{ asset('assets/img/AdminLTELogo.png') }}"
                alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow"
              />
              <!--end::Brand Image-->
              <!--begin::Brand Text-->
              <span class="brand-text fw-light">Admin Portal</span>
              <!--end::Brand Text-->
            </a>
          @endif
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="menu"
              data-accordion="false"
            >
              <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Dashboard
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  
                  @if(Session::has('Company'))
                    <li class="nav-header">Package Code</li>                    
                    <li class="nav-item">
                      <a href="{{ route('company.viewPackageCode') }}" class="nav-link">
                        <i class="nav-icon bi bi-circle-fill"></i>
                        <p>View</p>
                      </a>
                    </li>
                    
                    <li class="nav-header">Reviews</li>                    
                    <li class="nav-item">
                      <a href="{{ route('company.viewReview') }}" class="nav-link">
                        <i class="nav-icon bi bi-circle-fill"></i>
                        <p>View</p>
                      </a>
                    </li>
                  @else
                    <li class="nav-header">Company</li>
                    <li class="nav-item">
                      <a href="{{ route('admin.createCompany') }}" class="nav-link">
                        <i class="nav-icon bi bi-circle-fill"></i>
                        <p>Create</p>
                      </a>
                    </li>

                    <li class="nav-item">
                      <a href="{{ route('admin.viewCompany') }}" class="nav-link">
                        <i class="nav-icon bi bi-circle-fill"></i>
                        <p>View</p>
                      </a>
                    </li>

                    <li class="nav-header">Package Code</li>
                    <li class="nav-item">
                      <a href="{{ route('admin.createPackageCode') }}" class="nav-link">
                        <i class="nav-icon bi bi-circle-fill"></i>
                        <p>Create</p>
                      </a>
                    </li>

                    <li class="nav-item">
                      <a href="{{ route('admin.viewPackageCode') }}" class="nav-link">
                        <i class="nav-icon bi bi-circle-fill"></i>
                        <p>View</p>
                      </a>
                    </li>

                    <li class="nav-header">Reviews</li>                    
                    <li class="nav-item">
                      <a href="{{ route('admin.viewReview') }}" class="nav-link">
                        <i class="nav-icon bi bi-circle-fill"></i>
                        <p>View</p>
                      </a>
                    </li>  
                  @endif
              
                </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar-->