@extends('voyager::master')

@section('page_title', 'Package creation')

@section('content')
  @push('css')
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
  @endpush

  <h1>Package Creation</h1>
  <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
          <label for="name">Title</label>
          <input type="text" name="title" class="form-control" id="name" value="{{old('title')}}" required>
      </div>

      <div class="form-group">
          <label for="description">Description</label>
          <textarea name="description" class="form-control" id="description" value="{{old('description')}}"></textarea>
      </div>

      <div class="form-group">
          <label for="price">Default Price</label>
          <input type="number" name="price" class="form-control" id="price" value="{{old('price')}}" required>
      </div>

      <div id="prices-container" class="mb-3">
          <label class="form-label">Price by countries:</label>
          
          <div class="form-group mb-2 country-price-group">
              <select class="form-control country-select" onchange="updateCountryPrices()" style="max-width: 300px;">
                  <option value="">Choose Country</option>
                  @foreach ($currencies as $currency)
                    <option value="{{$currency}}">{{$currency}}</option>  
                  @endforeach
              </select>
              <input type="number" step="0.01" style="max-width: 300px; display: none;" class="form-control price-input" placeholder="Цена">
          </div>
          
          <button class="btn btn-primary" type="button" onclick="addCountryPrice()">Save</button>
      </div>

      <input type="hidden" name="country_prices" id="country-prices" value="">

      <div class="form-group">
        <label for="tools_included">Tools</label>
        <select name="tools_included[]" id="tools_included" class="form-control" multiple>
          @foreach($tools as $tool)
            <option value="{{ $tool->id }}">{{ $tool->title }}</option>
          @endforeach
        </select>
      </div>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
        </div>
      @endif

      <button type="submit" class="btn btn-primary">Submit</button>
  </form>

  @push('javascript')
    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tools_included').select2();
        });

        document.addEventListener('DOMContentLoaded', function() {
          document.querySelectorAll('.country-select').forEach(function(select) {
              select.addEventListener('change', function() {
                  this.closest('.country-price-group').querySelector('.price-input').value = '';
                  updateCountryPrices(); 
              });
          });
      });

      function addCountryPrice() {
        const country = document.querySelector(".country-select").value;
        const hiddenField = document.querySelector("#country-prices");
        let cp = {};
        
        const price = document.querySelector(".price-input").value;
        
        if (hiddenField && hiddenField.value) {
            try {
                cp = JSON.parse(hiddenField.value);
            } catch (e) {
                console.error("JSON parsing error: ", e);
                cp = {};
            }
        }

        if (country) {
            cp[country] = price;
            hiddenField.value = JSON.stringify(cp); 
            alert('Price is successfully saved');
        }
      }

      function updateCountryPrices() {
        const hiddenField = document.querySelector("#country-prices").value;
        const country = document.querySelector(".country-select").value;

        if(country) {
          document.querySelector(".price-input").style.display = "block";  
        } else {
          document.querySelector(".price-input").style.display = "none";  
        }

        if(hiddenField) {
          const cp = JSON.parse(hiddenField);

          Object.keys(cp).forEach(item => {
            if(item === country) {
              document.querySelector(".price-input").value = cp[item];
            }
          });
        }
      }

      updateCountryPrices();
    </script>
  @endpush
@endsection