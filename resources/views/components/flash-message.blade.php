@if (session()->has('message'))
    <div 
        x-data='{show: true}' 
        x-init='setTimeout(() => show = false, 2000)' 
        x-show='show' 
        class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-laravel text-white px-20 py-3" 
        style="text-align: center;"
    >
        {{ session('message') }}
    </div>
@endif