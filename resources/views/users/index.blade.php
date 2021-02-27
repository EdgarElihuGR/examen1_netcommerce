<x-app-layout>
    <div class="py-6 px-5">
        <a href="{{ route('users.create') }}" class="bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 mb-5 rounded-full">Nuevo Usuario</a>
        <livewire:user-list>
    </div>
</x-app-layout>