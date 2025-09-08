<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nike Premium - Excellence Refined</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-float-delayed {
            animation: float 6s ease-in-out infinite 2s;
        }

        .animate-slide-up {
            animation: slideUp 0.8s ease-out forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        .animate-slide-left {
            animation: slideLeft 0.8s ease-out forwards 0.2s;
            opacity: 0;
            transform: translateX(-30px);
        }

        .animate-slide-right {
            animation: slideRight 0.8s ease-out forwards 0.4s;
            opacity: 0;
            transform: translateX(30px);
        }

        .animate-scale-in {
            animation: scaleIn 0.6s ease-out forwards 0.6s;
            opacity: 0;
            transform: scale(0.8);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .glass-effect {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .hover-glow:hover {
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.4);
            transform: translateY(-2px);
        }

        .product-card:hover {
            transform: translateY(-10px) scale(1.02);
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(2deg);
            }
        }

        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideLeft {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideRight {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes scaleIn {
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .shimmer {
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        .pulse-border {
            animation: pulseBorder 2s ease-in-out infinite;
        }

        @keyframes pulseBorder {

            0%,
            100% {
                border-color: rgba(102, 126, 234, 0.3);
            }

            50% {
                border-color: rgba(102, 126, 234, 0.8);
            }

                    * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            color: #333;
            overflow-x: hidden;
            background: linear-gradient(to bottom, #f8fafc, #ffffff);
        }
        
        .premium-section {
            position: relative;
            overflow: hidden;
        }
        
        .floating-circle {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            filter: blur(40px);
            z-index: 0;
        }
        
        .circle-1 {
            width: 400px;
            height: 400px;
            background: #10b981;
            top: -200px;
            right: -100px;
            animation: float 15s ease-in-out infinite;
        }
        
        .circle-2 {
            width: 300px;
            height: 300px;
            background: #3b82f6;
            bottom: -100px;
            left: -100px;
            animation: float 12s ease-in-out infinite reverse;
        }
        
        .circle-3 {
            width: 250px;
            height: 250px;
            background: #8b5cf6;
            top: 50%;
            left: 30%;
            animation: float 18s ease-in-out infinite;
        }
        
        .feature-card {
            transition: all 0.4s ease;
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        
        .feature-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
            background: rgba(255, 255, 255, 0.95);
        }
        
        .feature-icon {
            transition: all 0.5s ease;
            transform-style: preserve-3d;
        }
        
        .feature-card:hover .feature-icon {
            transform: rotateY(180deg) scale(1.1);
        }
        
        .icon-wrapper {
            transition: all 0.3s ease;
        }
        
        .feature-card:hover .icon-wrapper {
            transform: scale(1.1);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .nike-logo {
            position: absolute;
            opacity: 0.03;
            z-index: 0;
            width: 500px;
            height: 500px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        
        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); }
            33% { transform: translateY(-20px) rotate(5deg); }
            66% { transform: translateY(10px) rotate(-5deg); }
            100% { transform: translateY(0) rotate(0deg); }
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .animate-pulse-slow {
            animation: pulse 4s infinite;
        }
        
        .text-gradient {
            background: linear-gradient(45deg, #1e40af, #3b82f6, #10b981);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-size: 200% 200%;
            animation: gradientShift 5s ease infinite;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .stagger-animate > div {
            opacity: 0;
            transform: translateY(30px);
        }
        
        .shine-effect {
            position: relative;
            overflow: hidden;
        }
        
        .shine-effect::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to bottom right,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0.3) 50%,
                rgba(255, 255, 255, 0) 100%
            );
            transform: rotate(30deg);
            animation: shine 5s infinite;
            opacity: 0;
        }
        
        @keyframes shine {
            0% {
                opacity: 0;
                top: -50%;
                left: -50%;
            }
            10% {
                opacity: 1;
            }
            20% {
                opacity: 0;
                top: 150%;
                left: 150%;
            }
            100% {
                opacity: 0;
                top: 150%;
                left: 150%;
            }
        }
 
        }
    </style>
</head>

<body class="bg-white text-slate-900 overflow-x-hidden">


    <!-- Premium Hero Section -->
    <section class="relative min-h-screen hero-bg overflow-hidden">
        <!-- Elegant Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0"
                style="background-image: radial-gradient(circle at 25% 25%, #3b82f6 0%, transparent 50%), radial-gradient(circle at 75% 75%, #06b6d4 0%, transparent 50%);">
            </div>
        </div>

        <!-- Floating Elements -->
        <div class="absolute top-20 left-10 w-32 h-32 bg-blue-100 rounded-full blur-3xl opacity-30 animate-float"></div>
        <div
            class="absolute bottom-20 right-10 w-48 h-48 bg-cyan-100 rounded-full blur-3xl opacity-40 animate-float delay-1000">
        </div>

        <!-- Main Content -->
        <div
            class="relative z-10 max-w-7xl mx-auto px-6 lg:px-12 flex flex-col lg:flex-row items-center justify-center min-h-screen">

            <!-- Left Content -->
            <div class="lg:w-1/2 space-y-8 lg:pr-12">


                <!-- Main Title -->
                <div class="animate-fade-up delay-200">
                    <h1 class="text-7xl lg:text-8xl font-black leading-tight text-slate-800 text-shadow-light">
                        Nike
                        <br>
                        <span class="gradient-text-light">Premium</span>
                    </h1>
                    <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-cyan-500 mt-4 rounded-full"></div>
                </div>

                <!-- Subtitle -->
                <p class="text-xl lg:text-2xl text-slate-600 max-w-lg leading-relaxed animate-slide-in delay-400">
                    Where innovation meets elegance. Experience the pinnacle of athletic performance with our exclusive
                    premium collection.
                </p>

                <!-- Premium CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 animate-fade-up delay-600">
                    <button
                        class="btn-premium px-10 py-5 text-white rounded-2xl font-semibold transition-all duration-300 hover-lift text-lg">
                        Explore Collection
                    </button>
                    <button
                        class="px-10 py-5 glass-light hover:glass-subtle rounded-2xl font-semibold transition-all duration-300 text-slate-700 hover-lift text-lg">
                        Watch
                    </button>
                </div>

                <!-- Premium Stats -->
                <div class="flex space-x-12 pt-12 animate-fade-in delay-800">
                    <div class="text-center">
                        <div class="text-4xl font-black gradient-text-light">50+</div>
                        <div class="text-sm text-slate-500 font-medium tracking-wide">Years Innovation</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-black gradient-text-light">200M+</div>
                        <div class="text-sm text-slate-500 font-medium tracking-wide">Global Athletes</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-black gradient-text-light">∞</div>
                        <div class="text-sm text-slate-500 font-medium tracking-wide">Possibilities</div>
                    </div>
                </div>

                <!-- Trust Indicators -->
                <div class="flex items-center space-x-6 pt-8 animate-fade-in delay-1000">
                    <div class="flex items-center space-x-2">
                        <div class="w-5 h-5 bg-green-500 rounded-full flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <span class="text-sm text-slate-600 font-medium">Sustainably Made</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-5 h-5 bg-blue-500 rounded-full flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <span class="text-sm text-slate-600 font-medium">Limited Edition</span>
                    </div>
                </div>
            </div>

            <!-- Right Content - Product Showcase -->
            <div class="lg:w-1/2 mt-16 lg:mt-0 flex justify-center animate-fade-up delay-400">
                <div class="relative">
                    <!-- Main Product Card -->
                    <div
                        class="glass-light premium-border rounded-3xl p-10 animate-float hover-lift transition-all duration-500 animate-glow premium-shadow">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=400&auto=format&fit=crop"
                                alt="Nike Premium Shoe" class="w-96 h-96 object-cover rounded-2xl" />

                            <!-- Price Tag -->
                            <div class="absolute -top-4 -right-4 glass-subtle rounded-2xl px-6 py-3">
                                <div class="text-2xl font-bold gradient-text-light"></div>
                                <div class="text-xs text-slate-500 font-medium"></div>
                            </div>

                            <!-- Quick Actions -->


                        </div>

                        <!-- Product Info -->
                        <div class="mt-8 text-center">
                            <h3 class="text-3xl font-bold text-slate-800 mb-2">Air Max Elite Pro</h3>
                            <p class="text-slate-500 font-medium mb-4">Premium • Limited Edition • Sustainable</p>

                            <!-- Rating -->
                            <div class="flex items-center justify-center space-x-1">
                                <div class="flex text-yellow-400">
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                </div>
                                <span class="text-slate-600 font-medium ml-2">(4.9) • 1,247 reviews</span>
                            </div>
                        </div>
                    </div>

                    <!-- Background Decorations -->
                    <div
                        class="absolute -z-10 top-10 -left-10 w-32 h-32 bg-gradient-to-br from-blue-200 to-cyan-200 rounded-full blur-2xl opacity-60">
                    </div>
                    <div
                        class="absolute -z-10 -bottom-10 -right-10 w-40 h-40 bg-gradient-to-br from-purple-200 to-pink-200 rounded-full blur-2xl opacity-50">
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <div class="w-6 h-10 border-2 border-slate-300 rounded-full flex justify-center">
                <div class="w-1 h-3 bg-slate-400 rounded-full mt-2 animate-pulse"></div>
            </div>
        </div>
    </section>

   <!-- Premium Categories Section -->
    <section class="premium-section py-32 bg-gradient-to-b from-slate-50 to-white relative">
        <!-- Background Elements -->
        <div class="floating-circle circle-1"></div>
        <div class="floating-circle circle-2"></div>
        <div class="floating-circle circle-3"></div>
        
        

        <div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
            <div class="text-center mb-20 shine-effect">
                <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 text-gradient">Nike Premium Collection</h2>
                <p class="text-xl text-slate-600 max-w-3xl mx-auto">Experience the pinnacle of innovation, design, and performance with our exclusive premium line.</p>
            </div>

            <!-- Premium Features -->
            <div class="mt-20 text-center stagger-animate">
                <h3 class="text-3xl font-bold text-slate-800 mb-16 text-gradient">Why Choose Nike Premium?</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    <div class="feature-card p-8 rounded-2xl space-y-6">
                        <div class="icon-wrapper w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto animate-pulse-slow">
                            <svg class="w-8 h-8 text-green-600 feature-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-semibold text-slate-800">Sustainable Materials</h4>
                        <p class="text-slate-600">Crafted with eco-friendly materials for a better tomorrow. Our premium line uses recycled polyester, organic cotton, and innovative sustainable fabrics.</p>
                        <div class="pt-4">
                            <span class="inline-block px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                65% Recycled Materials
                            </span>
                        </div>
                    </div>
                    <div class="feature-card p-8 rounded-2xl space-y-6">
                        <div class="icon-wrapper w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto animate-pulse-slow">
                            <svg class="w-8 h-8 text-blue-600 feature-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-semibold text-slate-800">Advanced Technology</h4>
                        <p class="text-slate-600">Cutting-edge innovation in every stitch and sole. Featuring our latest Air Zoom cushioning, adaptive fit systems, and temperature-regulating fabrics.</p>
                        <div class="pt-4">
                            <span class="inline-block px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                                ZoomX Technology
                            </span>
                        </div>
                    </div>
                    <div class="feature-card p-8 rounded-2xl space-y-6">
                        <div class="icon-wrapper w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto animate-pulse-slow">
                            <svg class="w-8 h-8 text-purple-600 feature-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                                </path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-semibold text-slate-800">Exclusive Design</h4>
                        <p class="text-slate-600">Limited editions you won't find anywhere else. Collaborations with top designers and athletes, featuring unique colorways and premium materials.</p>
                        <div class="pt-4">
                            <span class="inline-block px-4 py-2 bg-purple-100 text-purple-800 rounded-full text-sm font-medium">
                                Limited Edition
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="text-center mt-20">
                <button class="bg-black text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-slate-800 transition-colors transform hover:scale-105 shadow-lg">
                    Explore Premium Collection
                </button>
                <p class="text-slate-500 mt-4">Free shipping on all premium orders</p>
            </div>
        </div>
    </section>



    <section id="">
        <div class="py-10 px-4 sm:px-6 bg-gradient-to-b from-gray-50 to-white rounded-xl shadow-sm">
            <h2 class="text-3xl font-extrabold text-center text-slate-900 tracking-tight mb-12">
                Top Categories
            </h2>

            <div class="flex flex-wrap justify-center gap-6" id="products">
                @foreach ($categories as $category)
                    <a href="{{ route('category.products', $category->id) }}#products" class="px-8 py-4 bg-white border border-gray-200 rounded-full shadow-md 
                          text-gray-700 font-semibold text-sm uppercase tracking-wide
                          hover:bg-gray-800 hover:text-white hover:scale-105 hover:shadow-xl
                          transition-all duration-300 ease-in-out transform">
                        {{ $category->category_name }}
                    </a>
                @endforeach

            </div>

        </div>






    </section>



    <!-- Simple JavaScript for Scroll Animations -->
    <script>
        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-up');
                }
            });
        }, observerOptions);

        // Observe all elements with animation classes
        document.addEventListener('DOMContentLoaded', () => {
            const elements = document.querySelectorAll('.animate-fade-up, .animate-fade-in, .animate-slide-in');
            elements.forEach(el => observer.observe(el));
        });

        // Animation on scroll
        document.addEventListener('DOMContentLoaded', function() {
            // Animate elements with stagger effect
            const animatedElements = document.querySelectorAll('.stagger-animate > div');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.style.opacity = 1;
                            entry.target.style.transform = 'translateY(0)';
                            entry.target.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                        }, index * 200);
                    }
                });
            }, {
                threshold: 0.1
            });
            
            animatedElements.forEach(element => {
                observer.observe(element);
            });
            
            // Add continuous subtle animation to feature cards
            const featureCards = document.querySelectorAll('.feature-card');
            
            featureCards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.style.transform = 'translateY(-10px) scale(1.02)';
                });
                
                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'translateY(0) scale(1)';
                });
            });
            
            // Pulse animation for icons
            const icons = document.querySelectorAll('.feature-icon');
            
            setInterval(() => {
                icons.forEach(icon => {
                    icon.classList.add('animate-pulse-slow');
                    setTimeout(() => {
                        icon.classList.remove('animate-pulse-slow');
                    }, 4000);
                });
            }, 8000);
        });

    </script>
</body>

</html>