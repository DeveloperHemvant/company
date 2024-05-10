<?php

namespace App\Livewire;

use App\Models\students;
use Livewire\Component;
use App\Contact;

class ConfirmAlert extends Component
{
    /**
     * Contact Id
     *
     * @var [inf]
     */
    public $emit;
    public $triggerDelete;

    public $contactId;

    public function render()
    {
        return view('livewire.confirm-alert');
    }
    public function destroy($contactId)
    {
        students::find($contactId)->delete();
    }
}
