<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestion des utilisateurs
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-10 px-6 space-y-10">

        {{-- TABLE USERS --}}
        <div class="bg-white shadow-lg rounded-2xl border border-gray-100 overflow-hidden">

            <div class="px-6 py-4 border-b bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-700">Liste des utilisateurs</h3>
            </div>

            <table class="w-full text-sm text-left">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="p-4">Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th class="text-right pr-6">Action</th>
                </tr>
                </thead>

                <tbody class="divide-y">
                @foreach($users as $user)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4 font-medium text-gray-800">
                            {{ $user->name }}
                        </td>

                        <td class="text-gray-600">
                            {{ $user->email }}
                        </td>

                        <td>
                                <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                    {{ $user->role->libelle_ }}
                                </span>
                        </td>

                        <td class="text-right pr-6">
                            <form action="{{ route('users.delete', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button
                                    class="text-red-600 hover:text-red-800 font-semibold"
                                    onclick="return confirm('Supprimer cet utilisateur ?')"
                                >
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

        {{-- CREATE USER --}}
        <div class="bg-white shadow-lg rounded-2xl border border-gray-100 p-6">

            <h3 class="text-lg font-semibold text-gray-700 mb-6">
                Ajouter un utilisateur
            </h3>

            <form action="{{ route('users.store') }}" method="POST" class="grid md:grid-cols-2 gap-4">
                @csrf

                <input class="border rounded-xl p-3"
                       type="text" name="name" placeholder="Nom" required maxlength="255">

                <input class="border rounded-xl p-3"
                       type="email" name="email" placeholder="Email" required>

                <input class="border rounded-xl p-3 md:col-span-2"
                       type="password" name="password"
                       placeholder="Mot de passe"
                       required minlength="5">

                <select class="border rounded-xl p-3 md:col-span-2" name="role_id" required>
                    <option value="">-- Choisir un rôle --</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id_role }}">
                            {{ $role->libelle_ }}
                        </option>
                    @endforeach
                </select>

                <button class="md:col-span-2 bg-green-700 hover:bg-green-800 text-white py-3 rounded-xl transition">
                    Ajouter
                </button>
            </form>

        </div>

        {{-- UPDATE USERS --}}
        <div class="space-y-6">

            @foreach($users as $user)
                <div class="bg-white shadow-md rounded-2xl border border-gray-100 p-6">

                    <h3 class="text-md font-semibold text-gray-700 mb-4">
                        Mise à jour : {{ $user->name }}
                    </h3>

                    @if ($errors->any())
                        <div class="mb-4 text-red-600 text-sm">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('users.update', $user->id) }}" method="POST"
                          class="grid md:grid-cols-2 gap-4">
                        @csrf
                        @method('PUT')

                        <input class="border rounded-xl p-3"
                               type="text" name="name" value="{{ $user->name }}" required>

                        <input class="border rounded-xl p-3"
                               type="email" name="email" value="{{ $user->email }}" required>

                        <select class="border rounded-xl p-3 md:col-span-2" name="role_id" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->id_role }}"
                                    {{ $user->id_roles == $role->id_role ? 'selected' : '' }}>
                                    {{ $role->libelle_ }}
                                </option>
                            @endforeach
                        </select>

                        <input class="border rounded-xl p-3"
                               type="password" name="password" placeholder="Nouveau mot de passe">

                        <input class="border rounded-xl p-3"
                               type="password" name="password_confirmation" placeholder="Confirmation">

                        <button class="md:col-span-2 bg-blue-700 hover:bg-blue-800 text-white py-3 rounded-xl transition">
                            Mettre à jour
                        </button>
                    </form>

                </div>
            @endforeach

        </div>

    </div>

</x-app-layout>
