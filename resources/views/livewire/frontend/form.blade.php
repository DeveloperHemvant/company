<div>
    @if (session()->has('message'))
        <div class="alert alert-success" id="success-message">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submit">
        @csrf
        <div class="form-group">
            <label for="parent_full_name">Parent's Full Name*</label>
            <input type="text" class="form-control @error('parent_full_name') is-invalid @enderror" id="parent_full_name"
                wire:model="parent_full_name" placeholder="Enter full name">
            @error('parent_full_name')
                <div class="invalid-feedback error-message">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="parent_email">Parent’s Email*</label>
            <input type="email" class="form-control @error('parent_email') is-invalid @enderror" id="parent_email"
                wire:model="parent_email" placeholder="Enter email id">
            @error('parent_email')
                <div class="invalid-feedback error-message">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="parent_mobile">Parent’s Mobile*</label>
            <input type="text" class="form-control @error('parent_mobile') is-invalid @enderror" id="parent_mobile"
                wire:model="parent_mobile" placeholder="+91">
            @error('parent_mobile')
                <div class="invalid-feedback error-message">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="student_name">Student Name*</label>
            <input type="text" class="form-control @error('student_name') is-invalid @enderror" id="student_name"
                wire:model="student_name" placeholder="Enter student’s name">
            @error('student_name')
                <div class="invalid-feedback error-message">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <p>Do you have access to laptop/desktop?</p>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline1" name="has_laptop_desktop" wire:model="has_laptop_desktop" value="yes"
                    class="custom-control-input ">
                <label class="custom-control-label" for="customRadioInline1">Yes</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline2" name="has_laptop_desktop" wire:model="has_laptop_desktop" value="no"
                    class="custom-control-input ">
                <label class="custom-control-label" for="customRadioInline2">No</label>
            </div>
            @error('has_laptop_desktop')
                <div class="invalid-feedback d-block error-message">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-danger">BOOK NOW</button>
        </div>

        <div class="form-group">
            <p>By clicking Submit, you agree to our <a href="{{route('terms')}}">Terms of Use</a> and <a href="{{route('privacypolicy')}}">Privacy Policy</a>.</p>
        </div>
    </form>

</div>
