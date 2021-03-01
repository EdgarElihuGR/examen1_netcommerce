<x-app-layout>
    <div class="py-6 px-5">
        <div class="py-5 px-8">
            <a href="{{ route('tasks.create') }}" id="create" class="bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full">Nueva Tarea</a>
            <form action="{{ route('search-task') }}" method="get" class="flex mt-5">
                <div class="pt-2 relative mx-auto text-gray-600">
                    <input class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                        type="search" name="search_criteria" placeholder="Search">
                    <button type="submit" class="absolute right-0 top-0 mt-5 mr-4">
                        <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                            viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                            width="512px" height="512px">
                            <path
                            d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
        @isset($tasks)
            <table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
                <thead class="text-white">
                    @foreach($tasks as $task)
                    <tr class="flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                        <th class="p-3 text-left bg-green-400 text-sm">Nombre de tarea</th>
                        <th class="p-3 text-left bg-green-400 text-sm">Usuario asignado</th>
                        <th class="p-3 text-left bg-green-400 text-sm">Usuario creador</th>
                        <th class="p-3 text-left bg-green-400 text-sm">Inicio</th>
                        <th class="p-3 text-left bg-green-400 text-sm">Vencimiento</th>
                        <th class="p-3 text-left bg-green-400 text-sm">Actions</th>
                    </tr>
                    @endforeach
                </thead>
                <tbody class="flex-1 sm:flex-none">
                    @foreach($tasks as $task)
                        <tr class="{{ $task->done == 1 ? 'bg-green-300' : '' }} flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
                            <td class="border-grey-light bg-white border p-3 text-sm">{{ $task->name }}</td>
                            <td class="border-grey-light bg-white border p-3 text-sm">{{ $task->assigned_user->name }}</td>
                            <td class="border-grey-light bg-white border p-3 text-sm">{{ $task->creator_user->name }}</td>
                            <td class="border-grey-light bg-white border p-3 text-sm">{{ $task->start_date }}</td>
                            <td class="border-grey-light bg-white border p-3 text-sm">{{ $task->end_date }}</td>
                            <td class="border-grey-light bg-white border p-3 text-sm">
                                <div class="flex justify-start space-x-1">
                                    <button class="border-2 border-indigo-200 rounded-md p-1">
                                        @if($task->done == 0)
                                            <a href="#"
                                            onclick="event.preventDefault(); document.getElementById('complete-task-{{ $task->id }}-form').submit();"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" class="h-3 w-3 md:h-4 md:w-4">
                                                    <path d="M20.285 2l-11.285 11.567-5.286-5.011-3.714 3.716 9 8.728 15-15.285z"/>
                                                </svg>
                                            </a>
                                            <form id="complete-task-{{ $task->id }}-form" method="POST" action="{{ route('complete-task', ['task' => $task]) }}" class="hidden">
                                                @method("PUT")
                                                @csrf
                                            </form>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" class="h-3 w-3 md:h-4 md:w-4">
                                                <path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6.25 8.891l-1.421-1.409-6.105 6.218-3.078-2.937-1.396 1.436 4.5 4.319 7.5-7.627z"/>
                                            </svg>
                                        @endif
                                    </button>
                                    @can('alter_tasks_access')
                                    <button class="border-2 border-indigo-200 rounded-md p-1">
                                        <a href="{{ route('tasks.edit', ['task' => $task]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-3 w-3 md:h-4 md:w-4 text-gray-500">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </a>
                                    </button>
                                    <button class="border-2 border-red-200 rounded-md p-1">
                                        <a
                                            href="#",
                                            onclick="event.preventDefault(); document.getElementById('destroy-task-{{ $task->id }}-form').submit();"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-3 w-3 md:h-4 md:w-4 text-red-500">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </a>
                                        <form id="destroy-task-{{ $task->id }}-form" method="POST" action="{{ route('tasks.destroy', ['task' => $task]) }}" class="hidden">
                                            @method("DELETE")
                                            @csrf
                                        </form>
                                    </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
		    </table>
        @else
            <h2 class="text-4xl sm:text-6xl lg:text-7xl leading-none font-extrabold tracking-tight text-gray-900 mt-10 mb-8 sm:mt-14 sm:mb-10">No hay tareas registradas</h2>
        @endisset
    </div>
</x-app-layout>