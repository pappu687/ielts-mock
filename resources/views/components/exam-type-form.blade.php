@props(['examType' => null, 'isEdit' => false])

@php
    $formId = $isEdit ? 'updateExamTypeForm' : 'createExamTypeForm';
    $formAction = $isEdit && $examType ? route('admin.exam-types.update', $examType->id) : route('admin.exam-types.store');
    $formMethod = 'POST';
    $submitText = $isEdit ? 'Update Exam Type' : 'Create Exam Type';

    $name = old('name', $examType->name ?? '');
    $description = old('description', $examType->description ?? '');
    $duration = old('duration_minutes', $examType->duration_minutes ?? '');
    $pricingTier = old('pricing_tier', $examType->pricing_tier ?? '');
    $skillsIncluded = old('skills_included', $examType->skills_included ?? []);
    if (! is_array($skillsIncluded)) {
        $skillsIncluded = (array) $skillsIncluded;
    }
    $allSkills = ['listening' => 'Listening', 'reading' => 'Reading', 'writing' => 'Writing', 'speaking' => 'Speaking'];
@endphp

<form id="{{ $formId }}" method="{{ $formMethod }}" action="{{ $formAction }}">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Exam type name" value="{{ $name }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Duration (minutes) <span class="text-danger">*</span></label>
            <input type="number" min="1" name="duration_minutes" class="form-control @error('duration_minutes') is-invalid @enderror" placeholder="e.g., 180" value="{{ $duration }}">
            @error('duration_minutes')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror" placeholder="Short description">{{ $description }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Pricing Tier</label>
            <select name="pricing_tier" class="form-select @error('pricing_tier') is-invalid @enderror">
                <option value="" {{ $pricingTier === '' ? 'selected' : '' }}>Default / Free</option>
                <option value="basic" {{ $pricingTier === 'basic' ? 'selected' : '' }}>Basic</option>
                <option value="standard" {{ $pricingTier === 'standard' ? 'selected' : '' }}>Standard</option>
                <option value="premium" {{ $pricingTier === 'premium' ? 'selected' : '' }}>Premium</option>
            </select>
            @error('pricing_tier')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Skills Included</label>
            <div class="d-flex flex-wrap gap-3">
                @foreach ($allSkills as $key => $label)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="skills_included[]" id="skill_{{ $key }}" value="{{ $key }}" {{ in_array($key, $skillsIncluded) ? 'checked' : '' }}>
                        <label class="form-check-label" for="skill_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
            </div>
            @error('skills_included')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-12">
            <button type="submit" class="btn btn-md btn-primary">{{ $submitText }}</button>
            <button type="button" class="btn btn-md btn-outline-secondary ms-2" data-bs-dismiss="modal">Cancel</button>
        </div>
    </div>
</form>

<script>
(function($){
    'use strict';
    const formSelector = '#{{ $formId }}';
    if (!$(formSelector).data('validator')) {
        $(formSelector).validate({
            rules: {
                name: { required: true, minlength: 2, maxlength: 255 },
                duration_minutes: { required: true, number: true, min: 1 },
                description: { maxlength: 2000 },
                pricing_tier: { maxlength: 50 }
            },
            errorElement: 'div',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.addClass('is-invalid');
                error.insertAfter(element);
            },
            success: function(label, element) {
                $(element).removeClass('is-invalid').addClass('is-valid');
                label.remove();
            },
            highlight: function(element) { $(element).removeClass('is-valid').addClass('is-invalid'); },
            unhighlight: function(element) { $(element).removeClass('is-invalid').addClass('is-valid'); },
            submitHandler: function(form) {
                $('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
                form.submit();
            }
        });
    }
})(jQuery);
</script>


