
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Minha Assinatura') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($subscription)
                    <p><strong>Plano:</strong> {{ $user->plan()->name ?? ""}}</p> <br>

                        @if ($subscription->cancelled() && $subscription->onGracePeriod())
                            <a href="{{ route('subscriptions.invoice.resume') }}" class="px-5 py-2 border-green-500 border text-green-500 rounded transition duration-300 hover:bg-green-700 hover:text-white focus:outline-none">
                                Reativar Assinatura
                            </a>

                            Seu acesso vai até: {{ $user->access_end }}
                        @elseif (!$subscription->cancelled())
                            <a href="{{ route('subscriptions.invoice.cancel') }}" class="px-5 py-2 border-red-500 border text-red-500 rounded transition duration-300 hover:bg-red-700 hover:text-white focus:outline-none">
                                Cancelar Assinatura
                            </a>
                        @endif

                        @if ($subscription->ended())
                            Assinatura Cancelada
                        @endif
                    @else
                        [Não é assinante]
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3>
                        Olá, essa é a sua Assinatura
                    </h3>
                    <hr class="py-4">

                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4">Data</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4">Preço</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4">Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $invoice )
                                <tr>
                                    <td class="px-6 py-4 border-b text-sm">{{ $invoice->date()->toFormattedDateString()  }}</td>
                                    <td class="px-6 py-4 border-b text-sm">{{ $invoice->total() }}</td>
                                    <td class="px-6 py-4 border-b text-sm">
                                        <a href="{{ route('subscriptions.invoice.download',$invoice->id) }}" class="px-5 py-2 bg-orange-300 border-blue-500 border text-white rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">baixar</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
