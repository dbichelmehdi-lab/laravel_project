<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Admin Sidebar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.4s ease-out',
                        'slide-in': 'slideIn 0.5s ease-out',
                        'logo-float': 'logoFloat 3s ease-in-out infinite',
                        'subtle-pulse': 'subtlePulse 2s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(-5px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        slideIn: {
                            '0%': { transform: 'translateX(-100%)', opacity: '0' },
                            '100%': { transform: 'translateX(0)', opacity: '1' }
                        },
                        logoFloat: {
                            '0%, 100%': { transform: 'translateY(0) rotate(0deg)' },
                            '50%': { transform: 'translateY(-2px) rotate(1deg)' }
                        },
                        subtlePulse: {
                            '0%, 100%': { transform: 'scale(1)', opacity: '1' },
                            '50%': { transform: 'scale(1.02)', opacity: '0.9' }
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* Professional hover effects */
        .nav-item {
            position: relative;
            overflow: hidden;
        }

        .nav-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.05), transparent);
            transition: left 0.5s ease;
        }

        .nav-item:hover::before {
            left: 100%;
        }

        /* Subtle shadow animations */
        .logo-container:hover {
            filter: drop-shadow(0 4px 8px rgba(59, 130, 246, 0.2));
        }

        /* Professional focus states */
        .nav-item:focus-within {
            background-color: rgb(248, 250, 252);
            border-left: 3px solid #3b82f6;
        }

        /* Smooth transitions */
        * {
            transition: all 0.2s ease;
        }

        /* Custom scrollbar */
        .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-scroll::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 2px;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- Demo Container -->
    <div class="flex h-screen">
        <!-- Professional Light Sidebar -->
        <aside
            class="w-72 bg-white shadow-lg relative overflow-hidden animate-slide-in sidebar-scroll border-r border-gray-100 flex flex-col">

            <!-- Subtle Background Pattern -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-30">
                <div class="absolute top-20 left-8 w-24 h-24 bg-blue-50 rounded-full blur-xl"></div>
                <div class="absolute top-64 right-4 w-16 h-16 bg-indigo-50 rounded-full blur-lg"></div>
                <div class="absolute bottom-32 left-12 w-20 h-20 bg-slate-50 rounded-full blur-md"></div>
            </div>

            <!-- Header Section -->
            <div class="relative z-10 p-6 border-b border-gray-100">
                <a href="{{url('admin')}}" class="group block">
                    <div class="flex items-center">
                        <!-- Enhanced Professional Logo -->
                        <div class="logo-container relative animate-logo-float">
                            <div
                                class="relative bg-gradient-to-br from-blue-500 to-blue-600 p-3 rounded-2xl shadow-md group-hover:shadow-lg transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                                </svg>
                                <!-- Subtle glow effect -->
                                <div
                                    class="absolute inset-0 bg-blue-400 rounded-2xl blur opacity-20 group-hover:opacity-30 transition-opacity duration-300">
                                </div>
                            </div>
                        </div>

                        <div class="ml-4">
                            <span
                                class="font-bold text-xl text-gray-800 tracking-wide group-hover:text-blue-600 transition-colors duration-300">
                                What a Market
                            </span>
                            <div
                                class="h-0.5 w-0 bg-gradient-to-r from-blue-500 to-blue-600 group-hover:w-full transition-all duration-500 mt-1">
                            </div>
                            <p
                                class="text-xs text-gray-500 mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                Admin Dashboard
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Navigation Section -->
            <nav class="relative z-10 mt-2 px-3 space-y-1 flex-1 overflow-y-auto">
                <!-- Home -->
                <a href="{{url('admin')}}"
                    class="nav-item group flex items-center px-4 py-3 text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all duration-200 rounded-lg">
                    <div
                        class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-blue-200 transition-colors duration-200">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                    <span class="font-medium">Home</span>
                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </div>
                </a>

                <!-- Categories -->
                <a href="{{url('view_category')}}"
                    class="nav-item group flex items-center px-4 py-3 text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all duration-200 rounded-lg">
                    <div
                        class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-purple-200 transition-colors duration-200">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                            </path>
                        </svg>
                    </div>
                    <span class="font-medium">Categories</span>
                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </div>
                </a>

                <!-- Products -->
                <a href="{{url('view_product')}}"
                    class="nav-item group flex items-center px-4 py-3 text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all duration-200 rounded-lg">
                    <div
                        class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-green-200 transition-colors duration-200">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                    </div>
                    <span class="font-medium">Products</span>
                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </div>
                </a>

                <!-- Orders -->
                <a href="{{ route('admin.orders') }}"
                    class="nav-item group flex items-center px-4 py-3 text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all duration-200 rounded-lg">
                    <div
                        class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-orange-200 transition-colors duration-200">
                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                            </path>
                        </svg>
                    </div>
                    <span class="font-medium">Orders</span>
                    <div class="ml-auto">
                        <span
                            class="bg-red-100 text-red-600 px-2 py-1 text-xs rounded-full font-medium animate-subtle-pulse">
                            New
                        </span>
                    </div>
                </a>
            </nav>

            <!-- Bottom Section -->
            <div class="relative z-10 p-4 border-t border-gray-100 bg-gray-50/50">
                <div
                    class="flex items-center space-x-3 p-3 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-200">
                    <div
                        class="w-10 h-10 bg-gradient-to-r from-blue-400 to-blue-500 rounded-full flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>

                    <div class="flex-1">
                        @if(Auth::user())
                            <p class="text-gray-800 font-medium text-sm">{{ Auth::user()->name }}</p>
                        @else
                            <p class="text-gray-800 font-medium text-sm">Admin User</p>
                        @endif
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <p class="text-gray-500 text-xs">Online</p>
                        </div>
                    </div>

                    <!-- Professional Logout Button -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <button
                            class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all duration-200 group"
                            title="Logout">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-200" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Version Info -->
                <div class="mt-3 text-center">
                    <p class="text-xs text-gray-400">Version 2.1.0</p>
                </div>
            </div>
        </aside>


    </div>
</body>

</html>