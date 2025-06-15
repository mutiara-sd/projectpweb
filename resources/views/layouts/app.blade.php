<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Enhanced UI Styles */
            .enhanced-bg {
                background: linear-gradient(135deg, #FFFBEB 0%, #FEF3C7 25%, #FFFBEB 50%, #FDE68A 75%, #FFFBEB 100%);
                background-size: 400% 400%;
                position: relative;
            }

            .enhanced-bg::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: 
                    radial-gradient(circle at 20% 20%, rgba(251, 191, 36, 0.1) 0%, transparent 50%),
                    radial-gradient(circle at 80% 80%, rgba(245, 158, 11, 0.1) 0%, transparent 50%),
                    radial-gradient(circle at 40% 60%, rgba(252, 211, 77, 0.08) 0%, transparent 50%);
                pointer-events: none;
            }

            .glass-effect {
                background: rgba(255, 255, 255, 0.9);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                box-shadow: 
                    0 8px 32px rgba(0, 0, 0, 0.1),
                    inset 0 1px 0 rgba(255, 255, 255, 0.4);
            }

            .enhanced-header {
                background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(254, 243, 199, 0.95) 100%);
                backdrop-filter: blur(12px);
                border-bottom: 1px solid rgba(251, 191, 36, 0.2);
                box-shadow: 
                    0 4px 20px rgba(0, 0, 0, 0.08),
                    inset 0 1px 0 rgba(255, 255, 255, 0.6);
            }

            .floating-card {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(15px);
                border-radius: 12px;
                border: 1px solid rgba(255, 255, 255, 0.3);
                box-shadow: 
                    0 8px 24px rgba(0, 0, 0, 0.08),
                    0 4px 8px rgba(0, 0, 0, 0.04);
                position: relative;
                overflow: hidden;
            }

            .floating-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 1px;
                background: linear-gradient(90deg, transparent, rgba(251, 191, 36, 0.2), transparent);
            }

            .header-content {
                background: transparent;
                border: none;
                border-radius: 0;
                box-shadow: none;
                backdrop-filter: none;
            }

            .main-content {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(15px);
                border-radius: 12px;
                border: 1px solid rgba(255, 255, 255, 0.3);
                box-shadow: 
                    0 8px 24px rgba(0, 0, 0, 0.08),
                    0 4px 8px rgba(0, 0, 0, 0.04);
            }

            .interactive-hover {
                transition: box-shadow 0.2s ease;
            }

            .interactive-hover:hover {
                box-shadow: 
                    0 12px 32px rgba(0, 0, 0, 0.1),
                    0 6px 12px rgba(0, 0, 0, 0.06);
            }

            .content-wrapper {
                position: relative;
                z-index: 1;
            }

            .decorative-dots {
                position: absolute;
                width: 6px;
                height: 6px;
                background: linear-gradient(45deg, #F59E0B, #FCD34D);
                border-radius: 50%;
                opacity: 0.6;
            }

            .dot-1 { top: 10%; left: 5%; }
            .dot-2 { top: 20%; right: 8%; }
            .dot-3 { top: 60%; left: 3%; }
            .dot-4 { bottom: 20%; right: 5%; }
            .dot-5 { bottom: 40%; left: 7%; }

            .enhanced-main {
                position: relative;
                z-index: 1;
                padding: 2rem 0;
            }

            /* Subtle glow effects */
            .glow-accent {
                position: relative;
            }

            .glow-accent::after {
                content: '';
                position: absolute;
                top: -2px;
                left: -2px;
                right: -2px;
                bottom: -2px;
                background: linear-gradient(45deg, #FCD34D, #F59E0B, #FCD34D);
                border-radius: inherit;
                z-index: -1;
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .glow-accent:hover::after {
                opacity: 0.3;
            }

            /* Interactive elements */
            .pulse-dot {
                position: absolute;
                width: 8px;
                height: 8px;
                background: #F59E0B;
                border-radius: 50%;
                animation: pulse 2s infinite;
            }

            @keyframes pulse {
                0% { transform: scale(1); opacity: 1; }
                50% { transform: scale(1.2); opacity: 0.7; }
                100% { transform: scale(1); opacity: 1; }
            }

            .mesh-gradient {
                background: 
                    radial-gradient(circle at 25% 25%, #FEF3C7 0%, transparent 50%),
                    radial-gradient(circle at 75% 75%, #FDE68A 0%, transparent 50%),
                    linear-gradient(135deg, #FFFBEB 0%, #FEF3C7 100%);
            }

            /* Enhanced typography */
            .enhanced-text {
                color: #374151;
                font-weight: 600;
            }

            /* Layered depth */
            .depth-layer-1 { z-index: 1; }
            .depth-layer-2 { z-index: 2; }
            .depth-layer-3 { z-index: 3; }
        </style>

        <script src="https://unpkg.com/alpinejs" defer></script>

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen enhanced-bg">
            <!-- Decorative elements -->
            <div class="decorative-dots dot-1"></div>
            <div class="decorative-dots dot-2"></div>
            <div class="decorative-dots dot-3"></div>
            <div class="decorative-dots dot-4"></div>
            <div class="decorative-dots dot-5"></div>
            
            <!-- Pulse dots for visual interest -->
            <div class="pulse-dot" style="top: 15%; right: 15%;"></div>
            <div class="pulse-dot" style="bottom: 25%; left: 10%; animation-delay: 1s;"></div>

            <div class="content-wrapper depth-layer-2">
                @include('layouts.navigation')

                <!-- Page Heading -->
                @isset($header)
                    <header class="enhanced-header">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            <div class="header-content">
                                {{ $header }}
                            </div>
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="enhanced-main depth-layer-3">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="main-content interactive-hover p-8">
                            {{ $slot }}
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <script>
            // Enhanced interactivity without animations
            document.addEventListener('DOMContentLoaded', function() {
                // Add subtle hover effects to interactive elements
                const interactiveElements = document.querySelectorAll('.interactive-hover');
                
                interactiveElements.forEach(element => {
                    element.addEventListener('mouseenter', function() {
                        this.style.borderColor = 'rgba(251, 191, 36, 0.2)';
                    });
                    
                    element.addEventListener('mouseleave', function() {
                        this.style.borderColor = 'rgba(255, 255, 255, 0.3)';
                    });
                });

                // Enhanced click feedback
                const clickables = document.querySelectorAll('button, a, [role="button"]');
                clickables.forEach(element => {
                    element.addEventListener('click', function(e) {
                        // Create ripple effect
                        const ripple = document.createElement('span');
                        const rect = this.getBoundingClientRect();
                        const size = Math.max(rect.width, rect.height);
                        const x = e.clientX - rect.left - size / 2;
                        const y = e.clientY - rect.top - size / 2;
                        
                        ripple.style.width = ripple.style.height = size + 'px';
                        ripple.style.left = x + 'px';
                        ripple.style.top = y + 'px';
                        ripple.style.position = 'absolute';
                        ripple.style.borderRadius = '50%';
                        ripple.style.background = 'rgba(251, 191, 36, 0.1)';
                        ripple.style.pointerEvents = 'none';
                        ripple.style.transform = 'scale(0)';
                        ripple.style.transition = 'transform 0.2s ease-out, opacity 0.2s ease-out';
                        ripple.style.opacity = '1';
                        
                        this.style.position = 'relative';
                        this.style.overflow = 'hidden';
                        this.appendChild(ripple);
                        
                        // Trigger ripple effect
                        setTimeout(() => {
                            ripple.style.transform = 'scale(1.5)';
                            ripple.style.opacity = '0';
                        }, 10);
                        
                        // Remove ripple after animation
                        setTimeout(() => {
                            ripple.remove();
                        }, 200);
                    });
                });

                // Dynamic background interaction
                document.addEventListener('mousemove', function(e) {
                    const { clientX, clientY } = e;
                    const x = clientX / window.innerWidth;
                    const y = clientY / window.innerHeight;
                    
                    // Subtle parallax effect on decorative elements
                    const dots = document.querySelectorAll('.decorative-dots');
                    dots.forEach((dot, index) => {
                        const speed = (index + 1) * 0.5;
                        const xOffset = (x - 0.5) * speed;
                        const yOffset = (y - 0.5) * speed;
                        dot.style.transform = `translate(${xOffset}px, ${yOffset}px)`;
                    });
                });

                // Enhanced focus states for accessibility
                const focusableElements = document.querySelectorAll('button, a, input, textarea, select, [tabindex]:not([tabindex="-1"])');
                focusableElements.forEach(element => {
                    element.addEventListener('focus', function() {
                        this.style.outline = '2px solid #F59E0B';
                        this.style.outlineOffset = '2px';
                        this.style.boxShadow = '0 0 0 3px rgba(251, 191, 36, 0.15)';
                    });
                    
                    element.addEventListener('blur', function() {
                        this.style.outline = '';
                        this.style.outlineOffset = '';
                        this.style.boxShadow = '';
                    });
                });

                // Smooth scroll behavior
                document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                    anchor.addEventListener('click', function (e) {
                        e.preventDefault();
                        const target = document.querySelector(this.getAttribute('href'));
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    });
                });
            });
        </script>
    </body>
</html>