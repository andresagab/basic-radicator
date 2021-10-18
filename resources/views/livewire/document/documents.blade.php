<div>

    {{-- basic header --}}
    <x-header.header title="{{ 'Documentos' }}">
        <button wire:click="openForm" class="px-3 py-1 font-normal text-sm bg-blue-500 text-white hover:bg-blue-700 hover:shadow transition duration-300 ease select-none rounded-full">NUEVO</button>
    </x-header.header>

    {{-- content --}}
    <div class="flex flex-col px-10">

        <div class="flex flex-row items-center space-x-2 px-4 py-2 bg-white rounded-md mt-10 shadow">
            <label for="searcher" class="font-semibold text-sm text-gray-900">Buscador:</label>
            <input wire:model="searcher" wire:change="loadDocuments" id="searcher" type="text" class="w-full font-normal text-sm bg-gray-300 rounded-full px-2 py-1" placeholder="Buscar por N° identificación, nombres, apellidos o nombre de documento">
        </div>

        {{-- data table --}}
        <div class="mt-5 rounded-md overflow-x-auto bg-white">
            <table class="table table-auto w-full">
                {{-- head --}}
                <tr class="font-semibold text-sm uppercase bg-green-300 text-green-900">
                    <th class="py-1 px-2 w-32">N° Radicado</th>
                    <th class="py-1 px-2 text-left">Persona</th>
                    <th class="py-1 px-2 text-left">Contacto</th>
                    <th class="py-1 px-2 text-left">Email</th>
                    <th class="py-1 px-2 text-left">Documento</th>
                    <th class="py-1 px-2 text-left">Dirigído a</th>
                    <th class="py-1 px-2 text-left">Fecha Registro</th>
                    <th class="py-1 px-2 text-center sr-only">edit</th>
                </tr>
                {{-- body --}}

                <tbody class="divide-y divide-gray-300">
                    @foreach($documents as $item)
                        <tr class="text-sm hover:bg-gray-200 hover:shadow transition duration-300 ease select-none">
                            <td class="font-semibold text-center px-2">
                                <span>{{ $item->id }}</span>
                            </td>
                            <td class="font-normal px-2">
                                <div class="flex flex-col items-start justify-start space-y-0">
                                    <span>{{ $item->person->names }} {{ $item->person->surnames }}</span>
                                    <span class="text-xs text-gray-700">{{ $item->person->nuip }}</span>
                                </div>
                            </td>
                            <td class="font-normal text-left px-2">
                                <span>{{ $item->person->contact }}</span>
                            </td>
                            <td class="font-normal text-left px-2">
                                <span>{{ $item->person->email }}</span>
                            </td>
                            <td class="font-normal text-left px-2">
                                <span>{{ $item->name }}</span>
                            </td>
                            <td class="font-normal text-left px-2">
                                <span>{{ $item->to }}</span>
                            </td>
                            <td class="font-normal text-left px-2">
                                <span>{{ $item->created_at }}</span>
                            </td>
                            {{-- actions --}}
                            <td class="px-2">
                                <div class="flex flex-row items-center justify-center space-x-2">
                                    <a href="{{ \Illuminate\Support\Facades\Storage::url($item->path) }}" target="_blank" title="Abrir Archivo" class="material-icons text-red-700 hover:bg-red-700 hover:text-white hover:shadow transition duration-300 ease select-none rounded-full p-1" style="font-size: 18px;">picture_as_pdf</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

            <div class="w-full bg-gray-300 px-4 py-2">
                {{ $documents->links() }}
            </div>

        </div>

    </div>

    <livewire:document.document-form/>

</div>
