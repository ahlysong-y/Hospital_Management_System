<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css">
    
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                    {{ __('ព័ត៌មានគណនីបុគ្គលិក (Admin Profile)') }}
                </h2>
                <p class="text-sm text-slate-500 mt-0.5">{{ __('គ្រប់គ្រងរូបថត Profile ព័ត៌មានផ្ទាល់ខ្លួន និងការផ្លាស់ប្តូរពាក្យសម្ងាត់') }}</p>
            </div>
            <a href="{{ route('dashboard') }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl transition-colors">
                {{ __('ត្រឡប់ទៅ Dashboard') }}
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        @if (session('success'))
        <div class="p-4 bg-teal-50 border border-teal-200 text-teal-800 rounded-2xl flex items-center gap-3">
            <svg class="w-5 h-5 text-teal-700 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-sm font-semibold">{{ session('success') }}</span>
        </div>
        @endif

        <!-- Admin Main Badge Profile Header -->
        <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8 shadow-2xs">
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6">
                <!-- Human Profile Image / Avatar -->
                <div class="relative shrink-0">
                    <img id="main_avatar_header_img" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="w-24 h-24 rounded-2xl object-cover border-2 border-teal-700 shadow-md">
                </div>

                <div class="flex-1 space-y-2">
                    <div class="flex flex-wrap items-center gap-3">
                        <h3 class="text-2xl font-bold text-slate-800">{{ $user->name }}</h3>
                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-teal-50 text-teal-800 border border-teal-100 uppercase tracking-wider">
                            {{ $user->role_name }}
                        </span>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs text-slate-600 font-mono">
                        <div>{{ __('អ៊ីមែល') }} ៖ <span class="font-bold text-slate-800">{{ $user->email }}</span></div>
                        <div>{{ __('លេខទូរស័ព្ទ') }} ៖ <span class="font-bold text-slate-800">{{ $user->phone_number ?? '-' }}</span></div>
                        <div>{{ __('សាខាមន្ទីរពេទ្យ') }} ៖ <span class="font-bold text-slate-800">{{ $user->branch->name ?? __('សាខាកណ្តាល') }}</span></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin System Overview Stats Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs">
                <p class="text-xs font-semibold text-slate-500">{{ __('អ្នកជំងឺសរុប') }}</p>
                <h4 class="text-2xl font-bold text-slate-800 mt-1 font-mono">{{ $stats['total_patients'] ?? 0 }}</h4>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs">
                <p class="text-xs font-semibold text-slate-500">{{ __('វិក្កយបត្រសរុប') }}</p>
                <h4 class="text-2xl font-bold text-teal-800 mt-1 font-mono">{{ $stats['total_invoices'] ?? 0 }}</h4>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs">
                <p class="text-xs font-semibold text-slate-500">{{ __('កាលវិភាគវះកាត់') }}</p>
                <h4 class="text-2xl font-bold text-slate-800 mt-1 font-mono">{{ $stats['total_surgeries'] ?? 0 }}</h4>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs">
                <p class="text-xs font-semibold text-slate-500">{{ __('សំណុំរឿង OPD') }}</p>
                <h4 class="text-2xl font-bold text-slate-800 mt-1 font-mono">{{ $stats['total_records'] ?? 0 }}</h4>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs col-span-2 sm:col-span-1">
                <p class="text-xs font-semibold text-slate-500">{{ __('ឧបករណ៍ពេទ្យ') }}</p>
                <h4 class="text-2xl font-bold text-slate-800 mt-1 font-mono">{{ $stats['total_equipments'] ?? 0 }}</h4>
            </div>
        </div>

        <!-- Hidden form for deleting profile photo -->
        <form id="delete-photo-form" action="{{ route('profile.photo.destroy') }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>

        <!-- Two Column Section for Profile Forms -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- 1. Edit Profile Form & Upload Photo -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8 space-y-6 shadow-2xs">
                <div class="border-b border-slate-100 pb-3 flex justify-between items-center">
                    <div>
                        <h4 class="font-bold text-lg text-slate-800">{{ __('កែប្រែព័ត៌មាន និង រូបថត (Personal Info & Photo)') }}</h4>
                        <p class="text-xs text-slate-500 mt-0.5">{{ __('ធ្វើបច្ចុប្បន្នភាពរូបថត Profile ឈ្មោះ អ៊ីមែល និងលេខទូរស័ព្ទ') }}</p>
                    </div>
                </div>

                <form id="profile_update_form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <!-- Hidden input to hold the actual cropped image file -->
                    <input type="file" name="profile_photo" id="cropped_photo_input" class="hidden">

                    <!-- Upload Profile Photo Input & Interactive Preview -->
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 space-y-3">
                        <label class="block text-sm font-semibold text-slate-700">
                            {{ __('រូបថត Profile (ជ្រើសរើស និង កាត់រូបថត 1:1)') }}
                        </label>

                        <div class="flex items-center gap-4">
                            <!-- Live Form Preview Image -->
                            <img id="form_preview_img" src="{{ $user->profile_photo_url }}" alt="Preview" class="w-16 h-16 rounded-xl object-cover border-2 border-teal-600 shadow-xs shrink-0">

                            <div class="flex-1 space-y-1">
                                <!-- Raw Photo File Picker -->
                                <input type="file" id="raw_photo_input" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-teal-700 file:text-white hover:file:bg-teal-800 cursor-pointer">
                                <p class="text-[11px] text-slate-400">{{ __('ជ្រើសរើសរូបថត សម្រាប់ការកាត់តម្រឹម (Crop) ទំហំ 1:1') }}</p>
                            </div>
                        </div>

                        @if($user->profile_photo)
                        <div class="pt-2 border-t border-slate-200 flex items-center justify-between">
                            <span class="text-xs text-teal-800 font-semibold">✓ {{ __('មានរូបថតបច្ចុប្បន្ន') }}</span>
                            <button type="submit" form="delete-photo-form" class="text-xs text-rose-600 hover:underline font-semibold">
                                {{ __('លុបរូបថតចេញ') }}
                            </button>
                        </div>
                        @endif
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">{{ __('ឈ្មោះពេញ') }} <span class="text-rose-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">{{ __('អ៊ីមែល') }} <span class="text-rose-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">{{ __('លេខទូរស័ព្ទ') }}</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">{{ __('សាខាមន្ទីរពេទ្យ') }} <span class="text-rose-500">*</span></label>
                        <select name="branch_id" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">
                            @foreach($branches as $b)
                            <option value="{{ $b->id }}" {{ $user->branch_id == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full py-2.5 px-4 bg-teal-700 hover:bg-teal-800 text-white font-semibold text-sm rounded-xl transition-colors">
                            {{ __('រក្សាទុកការកែប្រែ') }}
                        </button>
                    </div>
                </form>
            </div>

            <!-- 2. Change Password Form -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8 space-y-6 shadow-2xs">
                <div class="border-b border-slate-100 pb-3">
                    <h4 class="font-bold text-lg text-slate-800">{{ __('ផ្លាស់ប្តូរពាក្យសម្ងាត់ (Change Password)') }}</h4>
                    <p class="text-xs text-slate-500 mt-0.5">{{ __('ដើម្បីសុវត្ថិភាពគណនី សូមប្រើពាក្យសម្ងាត់ដែលមានសុវត្ថិភាព') }}</p>
                </div>

                <form action="{{ route('profile.password') }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">{{ __('ពាក្យសម្ងាត់បច្ចុប្បន្ន (Current Password)') }} <span class="text-rose-500">*</span></label>
                        <div x-data="{ show: false }" class="relative">
                            <input :type="show ? 'text' : 'password'" name="current_password" required placeholder="••••••••" class="w-full pl-4 pr-11 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none transition-all">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 transition-colors focus:outline-none" :title="show ? 'Hide password' : 'Show password'">
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <svg x-show="show" class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.04 10.04 0 013.122-.463c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m-6.09-3.23a3 3 0 11-4.243-4.243"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">{{ __('ពាក្យសម្ងាត់ថ្មី (New Password)') }} <span class="text-rose-500">*</span></label>
                        <div x-data="{ show: false }" class="relative">
                            <input :type="show ? 'text' : 'password'" name="password" required placeholder="••••••••" class="w-full pl-4 pr-11 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none transition-all">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 transition-colors focus:outline-none" :title="show ? 'Hide password' : 'Show password'">
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <svg x-show="show" class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.04 10.04 0 013.122-.463c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m-6.09-3.23a3 3 0 11-4.243-4.243"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">{{ __('បញ្ជាក់ពាក្យសម្ងាត់ថ្មី (Confirm Password)') }} <span class="text-rose-500">*</span></label>
                        <div x-data="{ show: false }" class="relative">
                            <input :type="show ? 'text' : 'password'" name="password_confirmation" required placeholder="••••••••" class="w-full pl-4 pr-11 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none transition-all">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 transition-colors focus:outline-none" :title="show ? 'Hide password' : 'Show password'">
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <svg x-show="show" class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.04 10.04 0 013.122-.463c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m-6.09-3.23a3 3 0 11-4.243-4.243"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full py-2.5 px-4 bg-slate-800 hover:bg-slate-900 text-white font-semibold text-sm rounded-xl transition-colors">
                            {{ __('ផ្លាស់ប្តូរពាក្យសម្ងាត់') }}
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </div>

    <!-- Image Cropping Modal Dialog -->
    <div id="cropModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-slate-950/75 backdrop-blur-sm">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 space-y-4 shadow-2xl border border-slate-200 animate-in fade-in zoom-in duration-200">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-teal-50 text-teal-700 flex items-center justify-center font-bold">
                        ✂️
                    </div>
                    <h3 class="font-bold text-lg text-slate-800">{{ __('កាត់តម្រឹមរូបថត (Crop Profile Image)') }}</h3>
                </div>
                <button type="button" onclick="closeCropModal()" class="text-slate-400 hover:text-slate-600 text-2xl font-bold leading-none">&times;</button>
            </div>

            <!-- Cropper Image Container -->
            <div class="max-h-[55vh] overflow-hidden rounded-2xl bg-slate-900 flex items-center justify-center border border-slate-800">
                <img id="image_to_crop" class="max-w-full block">
            </div>

            <p class="text-xs text-slate-500 text-center">{{ __('សូមបង្វិល ឬ ពង្រីក-បង្រួម រូបថតឱ្យត្រូវតាមទំហំក្រឡាចត្រង្គទម្រង់ 1:1') }}</p>

            <div class="flex justify-end gap-3 pt-2 border-t border-slate-100">
                <button type="button" onclick="closeCropModal()" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs rounded-xl transition-colors">
                    {{ __('បោះបង់') }}
                </button>
                <button type="button" id="crop_and_save_btn" class="px-5 py-2.5 bg-teal-700 hover:bg-teal-800 text-white font-semibold text-xs rounded-xl shadow-md transition-all active:scale-95 flex items-center gap-2">
                    <span>{{ __('កាត់ និងប្រើប្រាស់រូបថត (Crop & Apply)') }}</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Cropper.js Script Integration -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let cropper = null;
            const rawInput = document.getElementById('raw_photo_input');
            const croppedInput = document.getElementById('cropped_photo_input');
            const cropModal = document.getElementById('cropModal');
            const imageToCrop = document.getElementById('image_to_crop');
            const cropSaveBtn = document.getElementById('crop_and_save_btn');
            const mainAvatarHeaderImg = document.getElementById('main_avatar_header_img');
            const formPreviewImg = document.getElementById('form_preview_img');

            if (!rawInput) return;

            rawInput.addEventListener('change', function (e) {
                const files = e.target.files;
                if (files && files.length > 0) {
                    const file = files[0];
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        imageToCrop.src = event.target.result;
                        cropModal.classList.remove('hidden');
                        cropModal.classList.add('flex');

                        if (cropper) {
                            cropper.destroy();
                        }
                        cropper = new Cropper(imageToCrop, {
                            aspectRatio: 1,
                            viewMode: 1,
                            autoCropArea: 0.9,
                            responsive: true,
                            background: false
                        });
                    };
                    reader.readAsDataURL(file);
                }
            });

            window.closeCropModal = function () {
                cropModal.classList.add('hidden');
                cropModal.classList.remove('flex');
                if (cropper) {
                    cropper.destroy();
                    cropper = null;
                }
                rawInput.value = '';
            };

            cropSaveBtn.addEventListener('click', function () {
                if (!cropper) return;

                const canvas = cropper.getCroppedCanvas({
                    width: 500,
                    height: 500,
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high',
                });

                canvas.toBlob(function (blob) {
                    const croppedFile = new File([blob], 'cropped-profile-photo.jpg', { type: 'image/jpeg' });

                    // Put cropped file into the actual input field that gets sent to Laravel
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(croppedFile);
                    croppedInput.files = dataTransfer.files;

                    // Update live preview thumbnails on page
                    const croppedUrl = URL.createObjectURL(blob);
                    if (mainAvatarHeaderImg) mainAvatarHeaderImg.src = croppedUrl;
                    if (formPreviewImg) formPreviewImg.src = croppedUrl;

                    closeCropModal();

                    // Show success notification toast
                    if (window.Swal) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'រូបថតត្រូវបានកាត់រួចរាល់! សូមចុច "រក្សាទុកការកែប្រែ"',
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }
                }, 'image/jpeg', 0.9);
            });
        });
    </script>
</x-app-layout>
