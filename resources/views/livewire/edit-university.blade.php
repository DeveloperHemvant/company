<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
    @if (session()->has('status'))
    <div class="alert {{ session('status') ? 'alert-success' : 'alert-danger' }}">
        {{ session('status') }}
    </div>
@endif


    <form wire:submit.prevent="update">
        <div>
            <input type="hidden" name="id" wire:model="id" value="{{$university->id}}">
            <label for="name">University Name:</label>
            <input type="text" id="university_name" wire:model="university_name" value="{{$university->university_name}}">
            <div>@error('university_name') {{ $message }} @enderror</div>
        </div>
        <div>
            <label for="description">University Code:</label>
            <input type="text" id="university_code" wire:model="university_code" value="{{$university->university_code}}">
            <div>@error('university_code') {{ $message }} @enderror</div>
        </div>
        <button type="submit">Update</button>
    </form>
</div>