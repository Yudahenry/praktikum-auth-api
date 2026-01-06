<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    
                    <!-- ===================== -->
                    <!-- STEP 5: ROLE-BASED ACCESS CONTROL -->
                    <!-- Sesuai modul halaman 2 -->
                    <!-- ===================== -->
                    
                    <!-- Tampilkan role user saat ini -->
                    <div class="mt-4 p-4 bg-gray-100 rounded">
                        <p class="font-medium">Role Anda: <span class="text-blue-600">{{ Auth::user()->role }}</span></p>
                    </div>
                    
                    <!-- Conditional untuk admin sesuai modul -->
                    @if(Auth::user()->role === 'admin')
                        <div class="mt-6 p-4 bg-green-50 border border-green-200 rounded">
                            <h3 class="font-bold text-lg text-green-800 mb-2">Admin Controls</h3>
                            <p class="text-green-700 mb-4">Anda memiliki akses sebagai Administrator</p>
                            
                            <!-- Tombol Tambah Produk sesuai modul -->
                            <a href="{{ route('products.create') }}" class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Tambah Produk
                            </a>
                            
                            <!-- Opsional: Link ke halaman admin lainnya -->
                            <div class="mt-4 space-x-2">
                                <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800">
                                    Admin Dashboard
                                </a>
                                <span class="text-gray-400">|</span>
                                <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800">
                                    Kelola Produk
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded">
                            <h3 class="font-bold text-lg text-blue-800 mb-2">User Controls</h3>
                            <p class="text-blue-700">Anda login sebagai User reguler</p>
                        </div>
                    @endif
                    
                    <!-- ===================== -->
                    <!-- END OF STEP 5 -->
                    <!-- ===================== -->
                    
                    <!-- Informasi tambahan -->
                    <div class="mt-8">
                        <h4 class="font-semibold mb-2">Actions:</h4>
                        <div class="flex space-x-4">
                            <a href="{{ route('profile.edit') }}" class="text-blue-600 hover:text-blue-800">
                                Edit Profile
                            </a>
                            <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800">
                                Lihat Produk
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>