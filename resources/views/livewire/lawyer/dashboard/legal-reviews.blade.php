<x-lawyer.dashboard-layout>
    <div class="max-w-4xl mx-auto p-4">
        <h2 class="text-2xl font-semibold mb-6">Legal Reviews</h2>

        @foreach($contracts as $contract)
            <div class="bg-white shadow-md rounded-lg p-6 mb-4">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <p class="text-lg font-medium">
                            Request from: <span class="text-gray-700">{{ $contract->requester->name ?? 'Unknown' }}</span>
                        </p>
                        <p class="text-sm text-gray-600">
                            Status: <span class="font-semibold capitalize">{{ $contract->status }}</span>
                        </p>
                    </div>

                    <div class="flex flex-col gap-2">
                        @if($contract->status === 'pending')
                            {{-- Livewire Upload --}}
                            <form wire:submit.prevent="uploadDocument({{ $contract->id }})" enctype="multipart/form-data">
                                <input type="file" wire:model="file.{{ $contract->id }}" class="border border-gray-300 rounded px-2 py-1 mb-2">
                                @error("file.$contract->id")
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror

                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                                    Upload Contract
                                </button>
                            </form>

                            {{-- Approve Button --}}
                            <button wire:click="approve({{ $contract->id }})" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                                Mark as Approved
                            </button>



                        @elseif($contract->status === 'approved' && $contract->contract_document)
                            <a href="{{ Storage::url($contract->contract_document) }}" target="_blank" class="text-blue-600 underline hover:text-blue-800">
                                View Contract
                            </a>
                        @else
                            <p class="text-gray-600 italic">No contract document available.</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-lawyer.dashboard-layout>
