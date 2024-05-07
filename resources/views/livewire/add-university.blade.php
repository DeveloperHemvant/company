<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
    @if (session()->has('status'))
        <div class="alert {{ session('status') ? 'alert-success' : 'alert-danger' }}">
            {{ session('status') }}
        </div>
    @endif


    <form wire:submit.prevent="save">
        <div>
            <label for="name">University Name:</label>
            <input type="text" id="university_name" wire:model="university_name">
            <div>
                @error('university_name')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div>
            <label for="description">University Code:</label>
            <input type="text" id="university_code" wire:model="university_code">
            <div>
                @error('university_code')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <button
            style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
            type="submit">Save</button>
    </form>
</div>
