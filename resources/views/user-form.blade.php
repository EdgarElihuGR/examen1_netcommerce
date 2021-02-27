
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
                Nombre del usuario
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                name="name" 
                type="text"
                value="{{ old('name') ?? $user->name }}">
            @error("name")
                <div class="text-red-500 text-xs italic">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                Email
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                name="email"
                type="email"
                value="{{ old('email') ?? $user->email }}">
            @error("email")
                <div class="text-red-500 text-xs italic">{{ $message }}</div>
            @enderror
        </div>
        <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="roles">
                Rol
            </label>
            <select name="roles[]" id="roles" class="form-multiselect block rounded-md shadow-sm mt-1 block w-full" multiple="multiple">
                @foreach($roles as $id => $role)
                    <option value="{{ $id }}"{{ in_array($id, old('roles', [])) ? ' selected' : '' }}>{{ $role }}</option>
                @endforeach
            </select>
            @error('roles')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
    @isset($update)
    <!-- Do not show on update -->
    @else
    <div class="flex flex-wrap -mx-3 mb-2">
        <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password">
                Contraseña
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                name="password"
                type="password" required>
            @error("password")
                <div class="text-red-500 text-xs italic">{{ $message }}</div>
            @enderror
        </div>
    </div>
    @endisset
    <div class="flex justify-end w-full px-3">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">{{ $txtButton }}</button>
    </div>
</form>