<div>
    @if($show)
        <div class="fixed inset-0 overflow-y-auto px-4 py-6 md:py-24 sm:px-0 z-40">

            {{--<div class="fixed inset-0 transform" wire:click="$toggle('show')">--}}
            <div class="fixed inset-0 transform">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <form wire:submit.prevent="submit" enctype="multipart/form-data">
                @method('POST')
                @csrf

                <div class="bg-white rounded-lg overflow-hidden transform sm:w-full sm:mx-auto max-w-lg">

                    {{-- header --}}
                    <div class="shadow py-2 px-4">
                        <div class="flex flex-row items-center">
                            <h3 class="font-semibold text-lg text-gray-800">Formulario</h3>
                        </div>
                    </div>

                    {{-- body --}}
                    <div class="shadow p-4">

                        <div wire:loading wire:target="submit, person.nuip, loadPerson, unselectPerson" class="w-full p-1 font-normal text-sm text-center bg-yellow-500 animate-pulse text-yellow-900 rounded-full">Cargando...</div>

                        {{-- user data --}}
                        <div class="w-full flex flex-col space-y-3 border-b border-gray-300 py-2">

                            <h3 class="font-normal text-md text-gray-700">Datos de Usuario</h3>

                            {{-- nuip --}}
                            <div class="flex flex-col space-y-1 items-start justify-start">

                                {!! Form::label('person.nuip', '* N° de Identificación:', ['class' => 'font-normal text-sm text-gray-900']) !!}

                                <div class="flex flex-col items-start w-full">
                                    {{-- input --}}
                                    <div class="flex flex-row items-center space-x-2 w-full">
                                        {!! Form::number('person.nuip', null, ['wire:model.defer' => 'person.nuip', 'wire:keyup' => 'autofillPerson("NUIP")', 'required', 'maxLength' => 20, 'placeholder' => 'Número de identificación', 'class' => 'flex-grow px-3 py-1 w-full rounded-full font-normal text-sm bg-gray-300 focus:bg-gray-400 hover:shadow focus:border-green-200']) !!}
                                        @if($person->id)
                                            <button wire:click="unselectPerson" type="button" class="flex-shrink px-2 py-1 font-normal text-xs text-center rounded-full text-red-500 hover:bg-red-500 hover:text-white transition duration-300 ease select-none w-min">x</button>
                                        @endif
                                    </div>
                                    {{-- autofill list --}}
                                    @if(count($persons) > 0 && !$person->id)
                                        <div class="rounded-md relative flex flex-col w-60 max-h-32 overflow-x-auto overflow-y-auto border border-gray-300 divide-y">
                                            @foreach($persons as $item)
                                                <div class="flex flex-row items-center p-1 hover:bg-gray-300 transition duration-300 ease select-none" wire:click="loadPerson({{ $item }})">
                                                    <span class="flex-grow font-normal text-xs text-gray-800">{{ $item->names }} {{ $item->surnames }} </span>
                                                    <span class="font-normal text-xs text-gray-700">{{ $item->nuip }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                @error('person.nuip')
                                <span class="font-light text-xs text-red-500 italic">{{ $message }}</span>
                                @enderror

                            </div>

                            {{-- names --}}
                            <div class="flex flex-col space-y-1 items-start justify-start">

                                {!! Form::label('person.names', '* Nombres:', ['class' => 'font-normal text-sm text-gray-900']) !!}
                                {!! Form::text('person.names', null, ['wire:model.defer' => 'person.names', 'required', 'maxLength' => 100, 'placeholder' => 'Nombres de la persona', 'class' => 'px-3 py-1 w-full rounded-full font-normal text-sm bg-gray-300 focus:bg-gray-400 hover:shadow focus:border-blue-200']) !!}
                                @error('person.names')
                                <span class="font-light text-xs text-red-500 italic">{{ $message }}</span>
                                @enderror

                            </div>

                            {{-- surnames --}}
                            <div class="flex flex-col space-y-1 items-start justify-start">

                                {!! Form::label('person.surnames', '* Apellidos:', ['class' => 'font-normal text-sm text-gray-900']) !!}
                                {!! Form::text('person.surnames', null, ['wire:model.defer' => 'person.surnames', 'required', 'maxLength' => 100, 'placeholder' => 'Apellidos de la persona', 'class' => 'px-3 py-1 w-full rounded-full font-normal text-sm bg-gray-300 focus:bg-gray-400 hover:shadow focus:border-blue-200']) !!}
                                @error('person.surnames')
                                <span class="font-light text-xs text-red-500 italic">{{ $message }}</span>
                                @enderror

                            </div>

                            {{-- contact --}}
                            <div class="flex flex-col space-y-1 items-start justify-start">

                                {!! Form::label('person.contact', 'Contacto:', ['class' => 'font-normal text-sm text-gray-900']) !!}
                                {!! Form::text('person.contact', null, ['wire:model.defer' => 'person.contact', 'maxLength' => 25, 'placeholder' => 'N° de ceular o teléfono', 'class' => 'px-3 py-1 w-full rounded-full font-normal text-sm bg-gray-300 focus:bg-gray-400 hover:shadow focus:border-blue-200']) !!}
                                @error('person.contact')
                                <span class="font-light text-xs text-red-500 italic">{{ $message }}</span>
                                @enderror

                            </div>

                            {{-- email --}}
                            <div class="flex flex-col space-y-1 items-start justify-start">

                                {!! Form::label('person.email', 'Email:', ['class' => 'font-normal text-sm text-gray-900']) !!}
                                {!! Form::email('person.email', null, ['wire:model.defer' => 'person.email', 'maxLength' => 200, 'placeholder' => 'Correo electrónico', 'class' => 'px-3 py-1 w-full rounded-full font-normal text-sm bg-gray-300 focus:bg-gray-400 hover:shadow focus:border-blue-200']) !!}
                                @error('person.email')
                                <span class="font-light text-xs text-red-500 italic">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>

                        {{-- document data --}}
                        <div class="w-full grid grid-cols-2 gap-3 py-2">

                            <h3 class="col-span-full font-normal text-md text-gray-700">Documento</h3>

                            {{-- name --}}
                            <div class="flex flex-col space-y-1 items-start justify-start">

                                {!! Form::label('document.name', '* Nombre:', ['class' => 'font-normal text-sm text-gray-900']) !!}
                                {!! Form::text('document.name', null, ['wire:model.defer' => 'document.name', 'required', 'maxLength' => 250, 'placeholder' => 'Nombre del documento o tipo de documento', 'class' => 'px-3 py-1 w-full rounded-full font-normal text-sm bg-gray-300 focus:bg-gray-400 hover:shadow focus:border-green-200']) !!}
                                @error('document.name')
                                <span class="font-light text-xs text-red-500 italic">{{ $message }}</span>
                                @enderror

                            </div>

                            {{-- to --}}
                            <div class="flex flex-col space-y-1 items-start justify-start">

                                {!! Form::label('document.to', '* Remitido a:', ['class' => 'font-normal text-sm text-gray-900']) !!}
                                {!! Form::text('document.to', null, ['wire:model.defer' => 'document.to', 'required', 'maxLength' => 250, 'placeholder' => 'Remitido a o Dirigido a', 'class' => 'px-3 py-1 w-full rounded-full font-normal text-sm bg-gray-300 focus:bg-gray-400 hover:shadow focus:border-green-200']) !!}
                                @error('document.to')
                                <span class="font-light text-xs text-red-500 italic">{{ $message }}</span>
                                @enderror

                            </div>

                            {{-- file --}}
                            <div class="flex flex-col space-y-1 items-start justify-start"
                                 x-data="{ isUploading: false, progress: 0 }"

                                 x-on:livewire-upload-start="isUploading = true"

                                 x-on:livewire-upload-finish="isUploading = false"

                                 x-on:livewire-upload-error="isUploading = false"

                                 x-on:livewire-upload-progress="progress = $event.detail.progress"
                            >

                                {!! Form::label('file', '* Remitido a:', ['class' => 'font-normal text-sm text-gray-900']) !!}
                                <input wire:model="file" id="file" name="file" type="file" accept=".pdf" required class="font-normal text-gray-700">
                                {{--{!! Form::text('file', null, ['wire:model.defer' => 'file', 'required', 'maxLength' => 250, 'placeholder' => 'Remitido a o Dirigido a', 'class' => 'px-3 py-1 w-full rounded-full font-normal text-sm bg-gray-300 focus:bg-gray-400 hover:shadow focus:border-green-200']) !!}--}}
                                @error('file')
                                <span class="font-light text-xs text-red-500 italic">{{ $message }}</span>
                                @enderror

                                {{-- progress bar --}}
                                <div x-show="isUploading">

                                    <progress max="100" x-bind:value="progress" class="text-white rounded-full"></progress>

                                </div>

                                {{-- loading state --}}
                                <div wire:loading wire:target="file" class="font-normal text-sm text-blue-700 animate-pulse">Cargando...</div>

                            </div>

                        </div>

                    </div>

                    {{-- footer --}}
                    <div class="flex flex-row items-center justify-end space-x-2 py-2 px-4">
                        <button wire:click="$toggle('show')" wire:loading.attr="disabled" type="button" class="px-4 py-1 rounded-full font-normal text-sm text-red-500 hover:bg-red-500 hover:text-white hover:shadow focus:shadow transition duration-300 ease select-none">Cancelar</button>
                        <button wire:loading.attr="disabled" class="px-4 py-1 rounded-full font-normal text-sm text-white bg-green-500 hover:bg-green-700 hover:shadow focus:shadow transition duration-300 ease select-none">Guardar</button>
                    </div>

                </div>

            </form>

        </div>
    @endif
</div>
