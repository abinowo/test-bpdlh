<div>
    {{-- The best athlete wants his opponent at his best. --}}
    @php
        $isEdit = $action === 'edit';
    @endphp
    <form wire:submit="@if(!$isEdit) onSave @else onUpdate @endif">
        <div class="mb-2">
            <label class="form-label">{{ trFirst('name') }}</label>
            <input
                type="text"
                name="name"
                class="form-control @error('name') is-invalid @enderror"
                placeholder="{{ trFirst('name') }}"
                wire:model="name"
            />
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="form-label">{{ trFirst('email') }}</label>
            <input
                type="text"
                name="email"
                class="form-control @error('email') is-invalid @enderror"
                placeholder="{{ trFirst('email') }}"
                wire:model="email"
                @disabled($isEdit)
            />
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            {{ trFirst( $isEdit ? 'edit' : 'create') }}
        </button>
    </form>
</div>
