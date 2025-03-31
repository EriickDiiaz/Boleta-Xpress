<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- DataTables CSS - Versión más reciente -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">

    <!-- Custom Styles -->
    <style>
        .navbar-custom {
            background: linear-gradient(90deg, #0B6477 0%, #14919B 35%, #0AD1C8 70%, #45DFB1 100%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: white !important;
            transition: all 0.3s ease;
        }
        
        .navbar-custom .nav-link:hover {
            text-shadow: 0 2px 10px rgba(255, 255, 255, 0.5);
        }
        
        .navbar-custom .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.5);
        }
        
        .navbar-custom .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.75%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
        
        .dropdown-menu {
            border-radius: 0.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
        }
        
        .card {
            border-radius: 0.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }   
      
        .btn-custom {
            background: linear-gradient(90deg, #0B6477 0%, #14919B 100%);
            color: white;
            border: none;
            transition: all 0.3s ease;
        }
        
        .btn-custom:hover {
            background: linear-gradient(90deg, #14919B 0%, #0AD1C8 100%);
            transform: translateY(-2px);
            color: white;
            box-shadow: 0 4px 12px rgba(20, 145, 155, 0.3);
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-custom">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fas fa-graduation-cap me-2"></i>{{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('escuelas') }}"><i class="fas fa-school me-1"></i> Escuela</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('estudiantes') }}"><i class="fas fa-user-graduate me-1"></i> Estudiantes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('boletas') }}"><i class="fas fa-file-alt me-1"></i> Boletas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('administracion') }}"><i class="fas fa-cog me-1"></i> Administración</a>
                            </li>
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt me-1"></i>{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}"><i class="fas fa-user-plus me-1"></i>{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->nombre ?? Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('perfil') }}">
                                        <i class="fas fa-id-card me-1"></i>{{ __('Mi Perfil') }}
                                    </a>
                                    
                                    @can('ver usuarios')
                                    <a class="dropdown-item" href="{{ url('personal') }}">
                                        <i class="fas fa-users-cog me-1"></i>{{ __('Gestionar Personal') }}
                                    </a>
                                    @endcan
                                    
                                    <div class="dropdown-divider"></div>
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-1"></i>{{ __('Cerrar Sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 container">
            @if(session('mensaje'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('mensaje') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @yield('content')
        </main>
        
        <footer class="bg-light py-4 mt-5 border-top">
            <div class="container text-center">
                <p class="mb-0 text-muted">© {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Todos los derechos reservados.</p>
            </div>
        </footer>
    </div>
    
    <!-- jQuery (necesario para DataTables) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <!-- Bootstrap JS Bundle con Popper 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    -->
    <!-- DataTables JS - Versión más reciente -->
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Common DataTables initialization -->
    <script>
        $(document).ready(function() {
            // Inicialización básica de DataTables
            $('.datatable').DataTable({
                responsive: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/es-ES.json'
                }
            });
            
            // DataTable con botones de exportación
            $('.datatable-export').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/es-ES.json'
                }
            });
            
            // Confirm delete
            $('.btn-delete').on('click', function(e) {
                e.preventDefault();
                const form = $(this).closest('form');
                
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción no se puede revertir",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0B6477',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>