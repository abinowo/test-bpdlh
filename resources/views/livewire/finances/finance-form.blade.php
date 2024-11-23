<div>
    {{-- The best athlete wants his opponent at his best. --}}
    @php
        $isEdit = $action === 'edit';
    @endphp
    <form wire:submit="@if(!$isEdit) onSave @else onUpdate @endif">
        <div class="mb-2">
            <label class="form-label">{{ trFirst('amount') }}</label>
            <input
                type="text"
                name="amount"
                class="form-control @error('amount') is-invalid @enderror"
                placeholder="{{ trFirst('amount') }}"
                wire:model="amount"
            />
            @error('amount')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="form-label">{{ trFirst('type') }}</label>
            <select
                class="form-select @error('category_id') is-invalid @enderror"
                name="type"
                wire:model="type"
            >
                <option value="in">{{ trFirst('in')}} </option>
                <option value="out">{{ trFirst('out')}} </option>
            </select>
            @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            {{ trFirst( $isEdit ? 'edit' : 'create') }}
        </button>
    </form>
</div>
