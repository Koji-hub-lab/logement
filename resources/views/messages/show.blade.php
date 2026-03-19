<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('messages.index') }}" class="text-gray-600 hover:text-gray-900">
                    ←
                </a>
                <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold">
                    {{ substr($interlocuteur->prenom, 0, 1) }}{{ substr($interlocuteur->nom, 0, 1) }}
                </div>
                <div>
                    <h2 class="font-semibold text-xl text-gray-800">
                        {{ $interlocuteur->prenom }} {{ $interlocuteur->nom }}
                    </h2>
                    <p class="text-sm text-gray-600">
                        {{ $interlocuteur->role === 'bailleur' ? '🏠 Bailleur' : '👤 Client' }}
                    </p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col" style="height: 600px;">
                
                <!-- Zone de messages -->
                <div class="flex-1 overflow-y-auto p-6 space-y-4" id="messagesContainer">
                    @foreach($messages as $message)
                    <div class="flex {{ $message->expediteur_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-xs lg:max-w-md">
                            <!-- Info logement si présent -->
                            @if($message->logement && $loop->first)
                            <div class="mb-2 p-3 bg-gray-100 rounded-lg text-sm">
                                <p class="font-semibold text-gray-700">📍 Concernant :</p>
                                <p class="text-gray-600">{{ $message->logement->titre }}</p>
                            </div>
                            @endif

                            <!-- Message -->
                            <div class="rounded-lg px-4 py-3 {{ $message->expediteur_id === auth()->id() 
                                ? 'bg-indigo-600 text-white' 
                                : 'bg-gray-200 text-gray-900' }}">
                                <p class="whitespace-pre-line">{{ $message->contenu }}</p>
                            </div>
                            
                            <!-- Heure -->
                            <p class="text-xs text-gray-500 mt-1 {{ $message->expediteur_id === auth()->id() ? 'text-right' : 'text-left' }}">
                                {{ $message->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Formulaire d'envoi -->
                <div class="border-t border-gray-200 p-4">
                    <form action="{{ route('messages.store', $interlocuteur->id) }}" method="POST" class="flex gap-2">
                        @csrf
                        
                        @if(session('logement_id'))
                        <input type="hidden" name="logement_id" value="{{ session('logement_id') }}">
                        @endif

                        <textarea name="contenu" 
                                  rows="1"
                                  required
                                  placeholder="Écrivez votre message..."
                                  class="flex-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 resize-none"
                                  style="min-height: 42px; max-height: 120px;"
                                  onkeydown="if(event.key === 'Enter' && !event.shiftKey) { event.preventDefault(); this.form.submit(); }"></textarea>
                        
                        <button type="submit" 
                                class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 flex-shrink-0">
                            Envoyer
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        // Scroll automatique vers le bas
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('messagesContainer');
            container.scrollTop = container.scrollHeight;
        });
    </script>
</x-app-layout>