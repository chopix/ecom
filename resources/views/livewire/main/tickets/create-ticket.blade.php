<section class="content container">
    <h1 class="content__title">Create a ticket</h1>

    <form wire:submit.prevent="submit">
        <div class="form-group mb-4">
            <label for="title">Title</label>
            <input type="text" id="title" class="form-control" wire:model="title">
            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-4">
            <label for="content">Content</label>
            <textarea id="content" class="form-control" wire:model="content"></textarea>
            @error('content') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-4">
            <label for="photos">Photos (Max: 5 units)</label>
            <input type="file" id="photos" class="form-control" wire:model="photos" multiple accept=".jpg,jpeg,.webp,.png">
            @error('photos') <span class="text-danger">{{ $message }}</span> @enderror
            @error('photos.*') <span class="text-danger">{{ $message }}</span> @enderror
            <span wire:loading wire:target="photos">Loading...</span>
            @if ($photos)
                <div class="preview mt-2">
                    @foreach ($photos as $photo)
                        <img src="{{ $photo->temporaryUrl() }}" style="width: 100px; height: auto;">
                    @endforeach
                </div>
            @endif
        </div>

        @if($submitted)
            <div class="alert alert-success my-4" role="alert" id="success-alert">
                {{$submitted}}
            </div>
        @endif

        <button wire:loading.attr="disabled" wire:target="photos" type="submit" class="btn btn-primary">Submit</button>
    </form>
</section>