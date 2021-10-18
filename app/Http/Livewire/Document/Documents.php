<?php

namespace App\Http\Livewire\Document;

use App\Models\Document;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class Documents extends Component
{

    // use
    use WithPagination;

    // properties

    // searcher
    public string $searcher = "";

    // documents
    private $documents;

    // listeners
    protected $listeners = ['loadDocuments'];

    // methods

    /**
     * When component is mounted
     */
    public function mount() : void
    {

        // init default values
        $this->documents = Collection::empty();
    }

    /**
     * load all documents model data filtering it by perso nuip, names, surnames or name of document
     */
    public function loadDocuments() : void
    {
        $this->documents = Document::join('people as p', 'p.id', '=', 'documents.person_id')
            ->whereRaw("LOWER(p.nuip) LIKE (?)", ["%$this->searcher%"])
            ->orWhereRaw("LOWER(p.names) LIKE (?)", ["%$this->searcher%"])
            ->orWhereRaw("LOWER(p.surnames) LIKE (?)", ["%$this->searcher%"])
            ->orWhereRaw("LOWER(documents.name) LIKE (?)", ["%$this->searcher%"])
            ->orWhereRaw("LOWER(documents.id) LIKE (?)", ["%$this->searcher%"])
            ->select('documents.*')
            ->orderBy('documents.created_at', 'DESC')
            ->with('person')->paginate(20);

        //$this->resetPage();

        //$documents = Document::orderBy('created_at', 'DESC')->get();

        if (strlen($this->searcher) > 0 && count($this->documents) === 0) $this->emit('toast', 'No se encontrarón resultados', 'info');
        elseif (strlen($this->searcher) === 0 && count($this->documents) === 0) $this->emit('toast', 'No hay datos registrados', 'info');

    }

    // events

    public function openForm() : void
    {
        $this->emitTo('document.document-form', 'openForm');
    }

    /**
     * render view of component on app-layout
     * @return mixed
     */
    public function render()
    {

        $this->loadDocuments();
        $documents = $this->documents;

        return view('livewire.document.documents', compact('documents'))
            ->layout('components.layouts.app-layout');
    }
}
