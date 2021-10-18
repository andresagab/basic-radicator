<div>
    @if($show)
        <div class="fixed inset-0 overflow-y-auto px-4 py-6 md:py-24 sm:px-0 z-40">

            <div class="fixed inset-0 transform">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <div class="bg-white rounded-lg overflow-hidden transform sm:w-full sm:mx-auto max-w-lg">

                {{-- header --}}
                <div class="shadow py-2 px-4">
                    <div class="flex flex-row items-center">
                        <h3 class="font-semibold text-lg text-gray-800">Confirmar Acción</h3>
                    </div>
                </div>

                {{-- body --}}
                <div class="shadow p-4">

                    <div wire:loading wire:target="delete, deleteAll" class="w-full p-1 font-normal text-sm text-center bg-yellow-500 animate-pulse text-yellow-900 rounded-full">Cargando...</div>

                    {{-- data --}}
                    @if($document->id)
                        <div class="w-full flex flex-col space-y-3 py-2">

                            {{-- card person data --}}
                            <div class="flex flex-col space-y-4 items-start p-2 border border-gray-200 rounded-md shadow">

                                {{-- title --}}
                                <h3 class="font-semibold text-md text-gray-900">Información de Usuario:</h3>

                                {{-- data grid --}}
                                <div class="grid grid-cols-2 gap-1 items-start w-full">

                                    {{-- nuip --}}
                                    <div class="inline-flex items-baseline space-x-1">
                                        <span class="font-semibold text-xs text-gray-800">N° identificación: </span>
                                        <span class="font-normal text-sm text-gray-700">{{ $document->person->nuip }}</span>
                                    </div>

                                    {{-- names and surnamems --}}
                                    <div class="inline-flex items-baseline space-x-1">
                                        <span class="font-semibold text-xs text-gray-800">Nombre: </span>
                                        <span class="font-normal text-sm text-gray-700">{{ $document->person->names }} {{ $document->person->surnames }}</span>
                                    </div>

                                    {{-- contact --}}
                                    <div class="inline-flex items-baseline space-x-1">
                                        <span class="font-semibold text-xs text-gray-800">Contacto: </span>
                                        <span class="font-normal text-sm text-gray-700">{{ $document->person->contact }}</span>
                                    </div>

                                    {{-- email --}}
                                    <div class="inline-flex items-baseline space-x-1">
                                        <span class="font-semibold text-xs text-gray-800">Email: </span>
                                        <span class="font-normal text-sm text-gray-700">{{ $document->person->email }}</span>
                                    </div>

                                    {{-- documents saved by this person --}}
                                    <div class="inline-flex items-baseline space-x-1">
                                        <span class="font-semibold text-xs text-gray-800">Documentos ligados: </span>
                                        <span class="font-normal text-sm text-gray-700">{{ $document->person->documents()->count() }}</span>
                                    </div>

                                </div>

                                {{-- info message --}}
                                <span class="font-normal text-sm text-blue-800">Recuerda que borrarás los datos de la persona y todos los documentos guardados a su nombre:</span>

                                {{-- delete button --}}
                                <button wire:click="deleteAll" wire:loading.attr="disabled" type="button" class="self-end px-2 py-1 rounded-full font-normal text-xs text-white bg-red-500 hover:bg-red-700 hover:shadow focus:shadow transition duration-300 ease select-none">Borrar Todo</button>

                            </div>

                            {{-- card document data --}}
                            <div class="flex flex-col space-y-4 items-start p-2 border border-gray-200 rounded-md shadow">

                                {{-- title --}}
                                <h3 class="font-semibold text-md text-gray-900">Información del documento:</h3>

                                {{-- data grid --}}
                                <div class="grid grid-cols-2 gap-1 items-start w-full">

                                    {{-- id --}}
                                    <div class="inline-flex items-baseline space-x-1">
                                        <span class="font-semibold text-xs text-gray-800">N° Radicado: </span>
                                        <span class="font-normal text-sm text-gray-700">{{ $document->id }}</span>
                                    </div>

                                    {{-- name --}}
                                    <div class="inline-flex items-baseline space-x-1">
                                        <span class="font-semibold text-xs text-gray-800">Nombre: </span>
                                        <span class="font-normal text-sm text-gray-700">{{ $document->name }}</span>
                                    </div>

                                    {{-- to --}}
                                    <div class="inline-flex items-baseline space-x-1">
                                        <span class="font-semibold text-xs text-gray-800">Remitido a: </span>
                                        <span class="font-normal text-sm text-gray-700">{{ $document->to }}</span>
                                    </div>

                                    {{-- created_at --}}
                                    <div class="inline-flex items-baseline space-x-1">
                                        <span class="font-semibold text-xs text-gray-800">Fecha registro: </span>
                                        <span class="font-normal text-sm text-gray-700">{{ $document->created_at }}</span>
                                    </div>

                                    {{-- file --}}
                                    <div class="inline-flex items-baseline space-x-1">
                                        <span class="font-semibold text-xs text-gray-800">Documento: </span>
                                        <a href="{{ \Illuminate\Support\Facades\Storage::url($document->path) }}" target="_blank" class="font-normal text-sm text-green-700">ver</a>
                                    </div>

                                </div>

                                {{-- info message --}}
                                <span class="font-normal text-sm text-blue-800">Recuerda que solo borrarás los datos del documento y el archivo cargado:</span>

                                {{-- delete button --}}
                                <button wire:click="deleteDocument" wire:loading.attr="disabled" type="button" class="self-end px-2 py-1 rounded-full font-normal text-xs text-white bg-red-500 hover:bg-red-700 hover:shadow focus:shadow transition duration-300 ease select-none">Borrar Documento</button>

                            </div>

                        </div>
                    @endif

                </div>

                {{-- footer --}}
                <div class="flex flex-row items-center justify-end space-x-2 py-2 px-4">
                    <button wire:click="closeModal" wire:loading.attr="disabled" type="button" class="px-4 py-1 rounded-full font-normal text-sm text-red-500 hover:bg-red-500 hover:text-white hover:shadow focus:shadow transition duration-300 ease select-none">Cancelar</button>
                    {{--<button wire:loading.attr="disabled" class="px-4 py-1 rounded-full font-normal text-sm text-white bg-green-500 hover:bg-green-700 hover:shadow focus:shadow transition duration-300 ease select-none">Guardar</button>--}}
                </div>

            </div>

        </div>
    @endif
</div>
