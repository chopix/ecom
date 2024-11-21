@extends('voyager::master')

@section('page_title', "Ticket {$ticket->id}")

@section('content')
  <div class="container">
    <h2>
        Ticket #{{ $ticket->id }}: {{$ticket->title}}
        @if ($ticket->is_closed)
            (Closed)
        @endif
    </h2>
      <div class="bg-dark p-4 rounded chat-container" style="overflow-y: auto; background-color: rgb(33,37,41); padding: 20px; overflow-x:hidden; max-height: 600px; border-radius: 10px;">
        @foreach ($responses as $response)
            <div 
                @style([
                    'margin-bottom: 10px; display:flex;',
                    'justify-content: flex-end;' => auth()->id() == $response->user_id,
                ])
            >
                <div class="col-9 mb-3" style="width: 75%;">
                    <div 
                        class = "p-3 mb-2 text-white rounded"
                        @style([
                            "padding: 10px; border-radius: 9px; color: white;",
                            'background-color: rgb(13,110,253);' => auth()->id() == $response->user_id, 
                            'background-color: rgb(108,117,125);' => auth()->id() != $response->user_id,
                        ])> 
                        <p class="small mb-1">{{$response->user->name}}</p>
                        <p class="lead fw-bold" style="margin: 0; font-weight: 700;">
                            {{$response->content}}  
                        </p>
                        @if ($response->images)
                            <div class="row" style="margin: 10px 0 0 0;">
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
            <hr>

            <h4>Respond to this Ticket</h4>
            <form action="{{route('support.tickets.response.store', $ticket->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="response_content">Your Response:</label>
                    <textarea class="form-control" id="response_content" name="content" rows="4" required></textarea>
                    @error('content') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="response_images">Attach Images (Max: 5):</label>
                    <input type="file" class="form-control-file" id="response_images" name="images[]" multiple accept=".jpg, .jpeg, .png">
                    <div id="image-preview" class="mt-2"></div>
                    @error('images') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit Response</button>
            </form>
            <form action="{{route('support.tickets.response.store', $ticket->id)}}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger" name="close" value="true">Close ticket</button>
            </form>
        @else
            <form action="{{route('support.tickets.response.store', $ticket->id)}}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success" name="open" value="true">Open ticket</button>
            </form>
        @endif
  </div>

  @push('javascript')
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        let savedImages = @json(session('response_images', []));
        let imagePreview = document.getElementById('image-preview');
        
        savedImages.forEach(function(imageSrc) {
            let img = document.createElement('img');
            img.src = imageSrc;
            img.style.maxWidth = '100px';
            img.style.height = 'auto';
            imagePreview.appendChild(img);
        });

        $('#response_images').change(function() {
            $('#image-preview').empty();
            
            for (let i = 0; i < 5; i++) {
                let file = this.files[i];
                
                if (file.type.match('image.*')) {
                    let reader = new FileReader();
                    
                    reader.onload = function(e) {
                        let img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '100px';
                        img.style.height = 'auto';
                        $('#image-preview').append(img);
                    };
                    
                    reader.readAsDataURL(file);
                }
            }
        });
    });

        var chatContainer = document.querySelector('.chat-container');
        chatContainer.scrollTop = chatContainer.scrollHeight;
    </script>
  @endpush
@endsection