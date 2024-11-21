<div>
    <div class="container-fluid pb-5">
        <h1 class="my-4">
            Ticket #{{$ticket->id}}: {{$ticket->title}}
            @if ($ticket->is_closed)
                (Closed)
            @endif
        </h1>
        <div class="bg-dark p-4 rounded chat-container" style="overflow: auto; max-height: 600px;">
            @foreach ($responses as $response)
                <div 
                    @class([
                        'row',
                        'justify-content-end' => auth()->id() == $response->user_id, 
                        'justify-content-start' => auth()->id() != $response->user_id,
                ])>
                    <div class="col-9 mb-3">
                        <div 
                            @class([
                                'p-3 mb-2 text-white text-right rounded',
                                'bg-primary' => auth()->id() == $response->user_id, 
                                'bg-secondary' => auth()->id() != $response->user_id,
                            ])
                        >
                            <p class="small mb-1">{{$response->user->name}}</p>
                            <p class="lead fw-bold">
                                {{$response->content}}  
                            </p>
                            @if ($response->images)
                                <div class="row">
                                    @foreach (json_decode($response->images, true) as $image)
                                        <a href="{{asset($image)}}" target="_blank" style="width: 200px; heigth: auto;"><img src="{{asset($image)}}" class="w-100" alt="img"></a>
                                    @endforeach
                                </div>
                            @endif  
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @if (!$ticket->is_closed)    
            <div class="row mt-5">
                <div class="col-12">
                    <form wire:submit.prevent="submit">
                        <div class="form-group mb-4">
                            <label for="content">Content</label>
                            <textarea id="content" class="form-control" wire:model="content"></textarea>
                            @error('content') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="photos">Photos (Max: 5)</label>
                            <input type="file" id="photos" class="form-control" wire:model="photos" multiple accept=".jpg,jpeg,.webp,.png" >
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

                        <button wire:loading.attr="disabled" wire:target="photos" type="submit" class="btn btn-primary">Send</button>
                        <button type="button" class="btn btn-danger" wire:click="closeTicket">Close ticket</button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
@push('scripts')
    <script>
        var chatContainer = document.querySelector('.chat-container');
        chatContainer.scrollTop = chatContainer.scrollHeight;
    </script>
@endpush
