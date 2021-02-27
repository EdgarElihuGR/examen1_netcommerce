
<div class="w-full text-center">
    <p class="max-w-screen-xg text-lg sm:text-2xl sm:leading-10 font-medium mb-10 sm:mb-5">{{ $title }}</p>
</div>
<form action="{{ $route }}" method="post" class="w-full max-w-lg mx-auto">
    @csrf
    @isset($update)
        @method("PUT")
    @endisset
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                Nombre de tarea
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                name="name" 
                type="text"
                value="{{ old('name') ?? $task->name }}">
            @error("name")
                <div class="text-red-500 text-xs italic">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="start_date">
                Fecha de inicio
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                name="start_date"
                type="date"
                value="{{ old('start_date') ?? $task->start_date }}">
            @error("start_date")
                <div class="text-red-500 text-xs italic">{{ $message }}</div>
            @enderror
        </div>
        <div class="w-full md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="end_date">
                Fecha de vencimiento
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                name="end_date" 
                type="date"
                value="{{ old('end_date') ?? $task->end_date }}">
            @error("end_date")
                <div class="text-red-500 text-xs italic">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-2">
    <div class="w-full px-3">
            @can('assigned_user_access')
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="assigned_user">
                    Usuario asignado a la tarea
                </label>
                <select class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                    name="assigned_user">
                    @isset($users)
                        @foreach($users as $user)
                            @isset($task->assigned_user)
                                @if($user->id == $task->assigned_user->id)
                                <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                @else
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                            @else
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endisset
                        @endforeach
                    @endisset
                </select>
            @endcan
        </div>
    </div>
    <div class="flex justify-end w-full px-3">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">{{ $txtButton }}</button>
    </div>
</form>