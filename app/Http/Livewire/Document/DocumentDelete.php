<?php

namespace App\Http\Livewire\Document;

use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DocumentDelete extends Component
{

    // properties

    // document
    public Document $document;

    // modal state
    public bool $show = false;

    // listeners
    protected $listeners = ['openModal'];

    // methods

    /**
     * when component is mounted
     */
    public function mount() {
        $this->document = new Document();
    }

    /**
     * delete only the loaded document
     */
    public function deleteDocument() : void
    {
        // validate if file of loaded document was deleted
        if (Storage::delete($this->document->path)) {
            // validate if document model data was deleted
            if ($this->document->delete()) {

                // close modal and emit to main component to load documents again
                $this->emit('alert', 'Genial', 'El registro fue eliminado exitosamente', 'success');
                $this->closeModal();
                $this->emitUp('loadDocuments');

            } else $this->emit('alert', 'Uoops', 'No se pudo eliminar la información del documento, intentalo nuevamente', 'error');

        } else $this->emit('alert', 'Uoops', 'No se pudo eliminar el archivo cargado, intentalo nuevamente', 'error');

    }

    /**
     * delete all model data of person, documents and delete all files uploaded
     */
    public function deleteAll() : void
    {

        // load person and documents model data
        $person = $this->document->person;
        $documents = $person->documents;
        // set deleted files on true
        $deletedFiles = true;

        // loop to delete all files of each document model data
        foreach ($documents as $document) {
            if (!Storage::delete($document->path)) {
                $deletedFiles = false;
                $this->emit('alert', 'Uoops', 'Ocurrio un error al eliminar los archivos, intentalo nuevamente', 'error');
                break;
            }
        }

        // validate if files was deleted
        if ($deletedFiles) {
            // validate if all documents model data was deleted
            if ($person->documents()->delete()) {
                // validate if person model data was deleted
                if ($person->delete()) {
                    // close modal and emit to main component to load documents
                    $this->emit('alert', 'Genial', 'Datos de persona, documentos y archivos eliminados exitosamente', 'success');
                    $this->closeModal();
                    $this->emitUp('loadDocuments');
                } else $this->emit('alert', 'Uoops', 'No se pudo eliminar la información de la persona', 'error');

            } else $this->emit('alert', 'Uoops', 'No se pudo eliminar la información de los documentos', 'error');

        }

    }

    // events

    // to close current modal
    public function closeModal() : void
    {
        $this->document = new Document();
        $this->show = false;
    }

    /**
     * listener to open form or show it
     */
    public function openModal(Document $document) : void
    {
        if ($document->id) {
            $this->show = true;
            $this->document = $document;
        } else {
            $this->show = false;
            $this->document = new Document();
            $this->emit('toast', 'No se pudo cargar la información del registro seleccionado, intentalo nuevamente', 'error');
        }
    }

    /**
     * render view of component
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.document.document-delete');
    }
}
