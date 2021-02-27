<div class="shadow overflow-hidden border border-gray-200 sm:rounded-lg m-6">
    @isset($users)
    <table class="w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                </th>

                <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Nombre del Usuario
                </th>

                <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Email
                </th>

                <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Rol
                </th>

                <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody class="bg-white text-xs divide-y divide-gray-200">
            @foreach($users as $user)
            <tr>
                <td class="px-2 py-4 whitespace-nowrap">
                </td>

                <td class="px-2 py-4 whitespace-nowrap">
                    {{ $user->name }}
                </td>

                <td class="px-2 py-4 whitespace-nowrap">
                    {{ $user->email }}
                </td>

                <td class="px-2 py-4 whitespace-nowrap">
                    @foreach ($user->roles as $role)
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            {{ $role->title }}
                        </span>
                    @endforeach
                </td>

                <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">

                    <div class="flex justify-start space-x-1">
                        <button class="border-2 border-indigo-200 rounded-md p-1">
                            <a href="{{ route('users.edit', ['user' => $user]) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </a>
                        </button>
                        <button class="border-2 border-red-200 rounded-md p-1">
                            <a
                                href="#",
                                onclick="event.preventDefault(); document.getElementById('destroy-user-{{ $user->id }}-form').submit();"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 text-red-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </a>
                            <form id="destroy-user-{{ $user->id }}-form" method="POST" action="{{ route('users.destroy', ['user' => $user]) }}" class="hidden">
                                @method("DELETE")
                                @csrf
                            </form>
                        </button>
                    </div>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <h2 class="text-4xl sm:text-6xl lg:text-7xl leading-none font-extrabold tracking-tight text-gray-900 mt-10 mb-8 sm:mt-14 sm:mb-10">No hay usuarios registrados</h2>
    @endisset
</div>
