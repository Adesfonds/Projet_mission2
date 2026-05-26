<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Journalisation
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 px-6 space-y-6">

        {{-- SEARCH BAR --}}
        <div class="bg-white shadow-sm rounded-2xl border border-gray-100 p-5">

            <form method="GET" action="{{ route('journal') }}" class="flex flex-col md:flex-row gap-3">

                <div class="relative flex-1">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        🔎
                    </span>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Rechercher une action, IP ou email..."
                        class="w-full pl-10 pr-4 py-2 border rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    />
                </div>

                <button type="submit"
                        class="px-5 py-2 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition">
                    Rechercher
                </button>

                @if(request('search'))
                    <a href="{{ route('journal') }}"
                       class="px-5 py-2 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition text-center">
                        Réinitialiser
                    </a>
                @endif

            </form>

            {{-- RESULT COUNT --}}
            @if(request('search'))
                <p class="mt-3 text-sm text-gray-500">
                    {{ $logs->total() }} résultat(s) pour
                    <span class="font-medium text-gray-700">"{{ request('search') }}"</span>
                </p>
            @endif

        </div>

        {{-- TABLE --}}
        <div class="bg-white shadow-lg rounded-2xl border border-gray-100 overflow-hidden">

            <div class="px-6 py-4 border-b bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-700">
                    Historique des actions
                </h3>
            </div>

            <table class="w-full text-sm text-left">

                <thead class="bg-gray-100 text-xs uppercase text-gray-600">
                <tr>
                    <th class="p-4">Action</th>
                    <th>IP</th>
                    <th>Email</th>
                    <th>Date</th>
                </tr>
                </thead>

                <tbody class="divide-y">

                @forelse($logs as $log)
                    <tr class="hover:bg-gray-50 transition">

                        <td class="p-4 font-medium text-gray-800">
                            {{ $log->action }}
                        </td>

                        <td class="font-mono text-gray-600">
                            {{ $log->ip_adresse }}
                        </td>

                        <td class="text-gray-700">
                            {{ $log->user?->email ?? 'Anonyme' }}
                        </td>

                        <td class="text-gray-500">
                            {{ $log->created_at->format('d/m/Y H:i') }}
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-10 text-gray-500">
                            Aucun log trouvé
                        </td>
                    </tr>
                @endforelse

                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        @if($logs->hasPages())
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
                {{ $logs->appends(request()->query())->links() }}
            </div>
        @endif

    </div>

</x-app-layout>
