<div>

    {{-- basic header --}}
    <x-header.header title="{{ 'Documentos' }}">
        <button class="px-3 py-1 font-normal text-sm bg-blue-500 text-white hover:bg-blue-700 hover:shadow transition duration-300 ease select-none rounded-full">NUEVO</button>
    </x-header.header>

    {{-- content --}}
    <div class="flex flex-col px-10">

        {{-- data table --}}
        <div class="mt-10 rounded-md overflow-x-auto bg-white">
            <table class="table table-auto w-full">
                {{-- head --}}
                <tr class="font-semibold text-sm uppercase bg-green-300 text-green-900">
                    <th class="py-1 px-2">N°</th>
                    <th class="py-1 px-2">Persona</th>
                    <th class="py-1 px-2">Contacto</th>
                    <th class="py-1 px-2">Email</th>
                    <th class="py-1 px-2">Documento</th>
                    <th class="py-1 px-2">Dirigído a</th>
                </tr>
                {{-- body --}}
                <tr>

                </tr>
            </table>
        </div>


    </div>


</div>
