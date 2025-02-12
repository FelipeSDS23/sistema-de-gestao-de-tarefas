@if (session('success'))
<div class="p-4 mb-4 text-sm text-green-700 bg-green-100 border border-green-300 rounded text-center">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 border border-red-300 rounded text-center">
    {{ session('error') }}
</div>
@endif