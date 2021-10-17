<?php

namespace App\Http\Livewire\Document;

use Livewire\Component;

class Documents extends Component
{

    // properties

    // searcher
    public string $searcher = "";

    // documents
    public $documents = [];

    // listeners
    protected $listeners = ['loadDocuments'];

    // methods

    /**
     * When component is mounted
     */
    public function mount() : void
    {
        $this->loadDocuments();
    }

    /**
     * load all documents model data filtering it by perso nuip, names, surnames or name of document
     */
    private function loadDocuments() : void
    {

        $documents = Documents::join('people as p', 'p.id', '=', 'documents.person_id')
            ->whereRaw("LOWER(p.nuip) LIKE (?)", ["%$this->searcher%"])
            ->orWhereRaw("LOWER(p.names) LIKE (?)", ["%$this->searcher%"])
            ->orWhereRaw("LOWER(p.surnames) LIKE (?)", ["%$this->searcher%"])
            ->orWhereRaw("LOWER(documents.name) LIKE (?)", ["%$this->searcher%"])
            ->select('documents.*')
            ->orderBy('documents.created_at', 'DESC')->get();

        if (strlen($this->searcher) > 0 && count($documents) === 0) {
            // emit alert to not found coincidences
        } elseif (strlen($this->searcher) === 0 && count($documents) === 0) {
            // emit alert to not have data
        }

    }

    // events

    /**
     * render view of component on app-layout
     * @return mixed
     */
    public function render()
    {
        return view('livewire.document.documents')
            ->layout('components.layouts.app-layout');
    }
}
