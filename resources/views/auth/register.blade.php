<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Register Form - Laravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'stagger-1': 'slideUp 0.6s ease-out 0.1s both',
                        'stagger-2': 'slideUp 0.6s ease-out 0.2s both',
                        'stagger-3': 'slideUp 0.6s ease-out 0.3s both',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>
</head>
<body>
<!-- This is the Laravel Blade template with modern styling -->

<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-cyan-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto space-y-8">
        <!-- Logo Section -->
        <div class="text-center animate-fade-in">
            <div class="mx-auto h-16 w-16 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                <!-- Replace this with your x-authentication-card-logo -->
                <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>
            <h2 class="mt-6 text-3xl font-bold text-gray-900">Create Account</h2>
            <p class="mt-2 text-sm text-gray-600">Join us today and get started</p>
        </div>

        <!-- Main Card -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-8 animate-slide-up">
            <!-- Laravel Validation Errors -->
            <div class="mb-4">
                <!-- Replace with your x-validation-errors component but style it like this: -->
                <!-- <x-validation-errors class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg" /> -->
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Name Field -->
                <div class="space-y-2 animate-stagger-1">
                    <label for="name" class="block text-sm font-semibold text-gray-700">
                        {{ __('Name') }}
                    </label>
                    <div class="relative">
                        <input 
                            id="name" 
                            name="name" 
                            type="text" 
                            value="{{ old('name') }}"
                            autocomplete="name"
                            required 
                            autofocus
                            class="block w-full px-4 py-3 pr-12 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-gray-50/50 hover:bg-white focus:bg-white"
                            placeholder="Enter your full name"
                        />
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Email Field -->
                <div class="space-y-2 animate-stagger-1">
                    <label for="email" class="block text-sm font-semibold text-gray-700">
                        {{ __('Email') }}
                    </label>
    
                    <!-- Error Message Above Input -->
                    @error('email')
                    <div class="bg-red-50 border-l-4 border-red-400 p-3 rounded-md animate-fade-in">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 8.414l1.293-1.293a1 1 0 00-1.414-1.414L10 6.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-red-800">{{ $message }}</p>
                            </div>
                        </div>
                    </div>
                    @enderror
    
                    <div class="relative">
                        <input 
                        id="email" 
                        name="email" 
                        type="email" 
                        value="{{ old('email') }}"
                        autocomplete="username"
                        required
                        class="block w-full px-4 py-3 pr-12 border @error('email') border-red-300 bg-red-50 focus:ring-red-500 focus:border-red-500 @else border-gray-200 bg-gray-50/50 focus:ring-indigo-500 focus:border-transparent @enderror rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 transition-all duration-200 hover:bg-white focus:bg-white"
                        placeholder="Enter your email address"/>

                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        @error('email')
                            <svg class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        @else
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        @enderror
                        </div>
                    </div>
                </div>

                <!-- Phone Field -->
                <div class="space-y-2 animate-stagger-2">
                    <label for="phone" class="block text-sm font-semibold text-gray-700">
                        {{ __('Phone') }}
                    </label>
                    <div class="relative">
                        <input 
                            id="phone" 
                            name="phone" 
                            type="number" 
                            value="{{ old('phone') }}"
                            autocomplete="tel" 
                            required
                            class="block w-full px-4 py-3 pr-12 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-gray-50/50 hover:bg-white focus:bg-white"
                            placeholder="Enter your phone number"/>

                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Address Field -->
                <div class="space-y-2 animate-stagger-2">
                    <label for="address" class="block text-sm font-semibold text-gray-700">
                        {{ __('Address') }}
                    </label>
                    <div class="relative">
                        <input 
                            id="address" 
                            name="address" 
                            type="text" 
                            value="{{ old('address') }}"
                            autocomplete="street-address"
                            required
                            class="block w-full px-4 py-3 pr-12 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-gray-50/50 hover:bg-white focus:bg-white"
                            placeholder="Enter your address"/>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Password Field -->
                <div class="space-y-2 animate-stagger-2">
                    <label for="password" class="block text-sm font-semibold text-gray-700">
                        {{ __('Password') }}
                    </label>
                    <div class="relative">
                        <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            autocomplete="new-password"
                            required
                            class="block w-full px-4 py-3 pr-12 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-gray-50/50 hover:bg-white focus:bg-white"
                            placeholder="Create a strong password"/>
                        <button 
                            type="button"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none focus:text-gray-600 transition-colors duration-200"
                            onclick="togglePassword('password')">
                            <svg id="passwordEyeIcon" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Password Confirmation Field -->
                <div class="space-y-2 animate-stagger-3">
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">
                        {{ __('Confirm Password') }}
                    </label>
                    <div class="relative">
                        <input 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            type="password" 
                            autocomplete="new-password"
                            required
                            class="block w-full px-4 py-3 pr-12 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-gray-50/50 hover:bg-white focus:bg-white"
                            placeholder="Confirm your password"
                        />
                        <button 
                            type="button"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none focus:text-gray-600 transition-colors duration-200"
                            onclick="togglePassword('password_confirmation')"
                        >
                            <svg id="confirmPasswordEyeIcon" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Terms and Privacy Policy -->
                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="pt-2 animate-stagger-3">
                    <label for="terms" class="flex items-start">
                        <input 
                            id="terms" 
                            name="terms" 
                            type="checkbox"
                            required
                            class="mt-1 h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded transition-colors duration-200"
                        />
                        <div class="ml-3 text-sm">
                            <span class="text-gray-600">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors duration-200">'.__('Terms of Service').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors duration-200">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </span>
                        </div>
                    </label>
                </div>
                @endif

                <!-- Submit Button -->
                <div class="pt-4 animate-stagger-3">
                    <button 
                        type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-xl text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl"
                    >
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-indigo-300 group-hover:text-indigo-200 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </span>
                        {{ __('Register') }}
                    </button>
                </div>

                <!-- Login Link -->
                <div class="text-center pt-4 animate-stagger-3">
                    <p class="text-sm text-gray-600">
                        <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors duration-200">
                            {{ __('Already registered?') }}
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="text-center animate-fade-in">
            <p class="text-xs text-gray-500">
                © 2025 Your Company. All rights reserved.
            </p> 
        </div>
    </div>
</div>

<script>
    function togglePassword(fieldId) {
        const passwordInput = document.getElementById(fieldId);
        const eyeIconId = fieldId === 'password' ? 'passwordEyeIcon' : 'confirmPasswordEyeIcon';
        const eyeIcon = document.getElementById(eyeIconId);

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 012.011-3.398m2.047-2.184A9.97 9.97 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.97 9.97 0 01-1.52 2.664M15 12a3 3 0 11-6 0 3 3 0 016 0z" />`;
        } else {
            passwordInput.type = 'password';
            eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
        }
    }

    // Add interactive feedback and form validation
    document.addEventListener('DOMContentLoaded', function() {
        // Add focus/blur effects
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-1', 'ring-indigo-200');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-1', 'ring-indigo-200');
            });
        });

        // Password strength indicator (optional)
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('password_confirmation');

        if (passwordInput && confirmPasswordInput) {
            confirmPasswordInput.addEventListener('input', function() {
                if (this.value && passwordInput.value && this.value !== passwordInput.value) {
                    this.classList.add('border-red-300');
                    this.classList.remove('border-gray-200');
                } else {
                    this.classList.remove('border-red-300');
                    this.classList.add('border-gray-200');
                }
            });
        }
    });
</script>

</body>
</html>