<?php

namespace App\Http\Livewire\Document;

use App\Models\Document;
use App\Models\Person;
use Livewire\Component;
use Livewire\WithFileUploads;

class DocumentForm extends Component
{

    // use
    use WithFileUploads;

    // properties

    // person
    public Person $person;

    // document
    public Document $document;

    // file
    public $file;

    // persons
    public $persons = [];

    // modal state
    public bool $show = false;

    // listeners
    protected $listeners = ['openForm'];

    // rules
    protected $rules = [
        'person.nuip' => 'required|max:20',
        'person.names' => 'required|max:100',
        'person.surnames' => 'required|max:100',
        'person.contact' => 'nullable|max:25',
        'person.email' => 'nullable|max:200',
        'document.name' => 'required|max:250',
        'document.to' => 'required|max:250',
        'file' => 'file|required'
    ];

    // methods

    /**
     * when component is mounted
     */
    public function mount() {
        $this->person = new Person();
        $this->document = new Document();
    }

    /**
     * load a person received as param
     * @param Person $person
     */
    public function loadPerson(Person $person) : void
    {
        if ($person->id) {
            $this->person = $person;
            // call to load document
        } else $this->emit('toast', 'No se pudo cargar los datos de la persona, intentalo nuevamente', 'error');
    }

    /**
     * unselect loaded person model data to reset it and file data
     */
    public function unselectPerson() : void
    {
        $this->person = new Person();
        $this->reset(['persons', 'file']);
    }

    /**
     * autofill persons by filter
     * @param $filter
     */
    public function autofillPerson($filter) : void
    {

        if (strlen($this->person->nuip) >= 3 || strlen($this->person->names) >= 3 || strlen($this->person->surnames) >= 3) {

            switch ($filter) {

                case 'NUIP': $this->persons = Person::whereRaw('LOWER(nuip) LIKE (?)', ["%{$this->person->nuip}%"])->orderBy('names', 'ASC')->get(); break;
                case 'names': $this->persons = Person::whereRaw('LOWER(names) LIKE (?)', ["%{$this->person->names}%"])->orderBy('names', 'ASC')->get(); break;
                case 'surnames': $this->persons = Person::whereRaw('LOWER(names) LIKE (?)', ["%{$this->person->surnames}%"])->orderBy('names', 'ASC')->get(); break;
                default: $this->unselectPerson(); break;

            }

            // if (count($this->persons) === 0) $this->emit('toast', 'No se encontrarón resultados', 'info');

        } else $this->reset(['persons']);

    }

    // events

    // when form is submitted
    public function submit() : void
    {

        $this->validate();

        if ($this->person->save()) {

            if (!$this->document->id && !$this->document->person_id) $this->document->person_id = $this->person->id;

            $this->document->path = $this->file->store('public/uploaded-documents');

            if ($this->document->path) {

                if ($this->document->save()) {

                    $this->emit('toast', 'Datos guardados exitosamente', 'success');
                    $this->unselectPerson();
                    $this->document = new Document();
                    $this->emitUp('loadDocuments');

                } else $this->emit('toast', 'No se pudo guardar la información del documento', 'error');

            } else $this->emit('toast', 'Ocurrio un error al guardar el archivo', 'error');

        } else $this->emit('toast', 'No se pudo guardar la información de la persona', 'error');

    }

    /**
     * listener to open form or show it
     */
    public function openForm() : void
    {
        $this->show = true;
    }

    /**
     * render view of component
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.document.document-form');
    }
}
