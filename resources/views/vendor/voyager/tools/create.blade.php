@extends('voyager::master')

@section('page_title', 'Create Tool')

@section('content')
  <h1>Products(Tools) Creation</h1>
  <form action="{{ route('admin.tools.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
          <label for="name">Title</label>
          <input type="text" name="name" class="form-control" id="name" value="{{old('name')}}" >
      </div>

      <div class="form-group">
          <label for="link">Main Link</label>
          <input type="text" name="main_link" class="form-control" id="link">
      </div>

      <div class="form-group" style="margin: 20px;" id="language-link-form">
        <div class="wrapper">
          @if (old('languages_links'))       
            @foreach (json_decode(old('languages_links')[0], true) as $lang => $link)
              <div class="row" style="max-width: 1000px; display: flex; align-items: center;">
                  <div class="col-md-4" style="padding-left: 0;margin-bottom: 0;">
                      <div class="form-group">
                          <label for="link1">Language</label>
                          <input type="text" class="languages form-control" value="{{$lang}}" >
                      </div>
                  </div>
                  <div class="col-md-4" style="margin-bottom: 0;">
                      <div class="form-group">
                          <label for="link2">Link</label>
                          <input type="text" class="links form-control" value="{{$link}}" >
                      </div>
                  </div>
                  <div class="col-md-4" style="margin-bottom: 0;">
                    <button class="btn btn-danger" onclick="removeLangLinkInput(this)" type="button">Remove</button>
                  </div>
              </div>  
            @endforeach
          @else
            <div class="row" style="max-width: 1000px; display: flex; align-items: center;">
                <div class="col-md-4" style="padding-left: 0;margin-bottom: 0;">
                    <div class="form-group">
                        <label for="link1">Language</label>
                        <input type="text" class="languages form-control" >
                    </div>
                </div>
                <div class="col-md-4" style="margin-bottom: 0;">
                    <div class="form-group">
                        <label for="link2">Link</label>
                        <input type="text" class="links form-control" >
                    </div>
                </div>
                <div class="col-md-4" style="margin-bottom: 0;">
                  <button class="btn btn-danger" onclick="removeLangLinkInput(this)" type="button">Remove</button>
                </div>
            </div>
          @endif

        </div>

        <div class="row">
          <button class="btn btn-primary" type="button" onclick="addLanguageLinkInput();">Add more</button>
          <button class="btn btn-primary" type="button" onclick="languagesLinksSave();">Save</button>
        </div>

        <input type="hidden" name="languages_links[]" value="{{old('languages_links') !== null ? old('languages_links')[0] : ''}}">
      </div>

      <div class="form-group">
          <label for="extension">Extension</label>
          <input type="file" name="extension" class="form-control" id="extension">
      </div>
      
      
      <div class="form-group">
          <label for="price">Default Price</label>
          <input type="number" name="price" class="form-control" id="price" value="{{old('price')}}" >
      </div>

      <div id="prices-container" class="mb-3">
          <label class="form-label">Prices by country:</label>
          
          <div class="form-group mb-2 country-price-group">
              <select class="form-control country-select" onchange="updateCountryPrices()" style="max-width: 300px;">
                  <option value="">Choose Country</option>
                  @foreach ($currencies as $currency)
                      <option value="{{$currency}}">{{$currency}}</option>
                  @endforeach
              </select>
              <input type="number" step="0.01" style="max-width: 300px; display: none;" class="form-control price-input" placeholder="Цена">
          </div>
          
          <div>
            <button class="btn btn-primary" type="button" onclick="addCountryPrice()">Save</button>
          </div>
      </div>
      <input type="hidden" name="country_prices" id="country-prices" value="{{old('country_prices') !== null ? old('country_prices') : ''}}">

      <div class="form-group">
          <label for="image">Image</label>
          <input type="file" name="image" class="form-control" id="image"  onchange="previewImage(event)">
          <img id="imagePreview" src="#" alt="Image preview" style="max-width: 200px; margin-top: 10px; display: none;">
      </div>

      <div class="form-group">
          <label for="benefits">Benefits</label>
          <div id="benefitsContainer">

          </div>
          <button type="button" id="addBenefit">Add Benefit</button>
      </div>

      <div class="form-group">
          <label for="description">Description</label>
          <textarea name="description" class="form-control" id="description" value="{{old('description')}}"></textarea>
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
    <script>


      function addLanguageLinkInput() {
        const container = document.querySelector('#language-link-form .wrapper');

        const newFieldGroup = document.createElement('div');
        newFieldGroup.classList.add('row', 'mt-2');
        newFieldGroup.style.maxWidth = '1000px';
        newFieldGroup.style.display = 'flex';
        newFieldGroup.style.alignItems = 'center';
        newFieldGroup.innerHTML = `
              <div class="col-md-4" style="padding-left: 0;margin-bottom: 0;">
                  <div class="form-group">
                      <label for="link1">Language</label>
                      <input type="text" class="languages form-control" >
                  </div>
              </div>
              <div class="col-md-4" style="margin-bottom: 0;">
                  <div class="form-group">
                      <label for="link2">Link</label> 
                      <input type="text" class="links form-control" >
                  </div>
              </div>
              <div class="col-md-4" style="margin-bottom: 0;">
                <button class="btn btn-danger" onclick="removeLangLinkInput(this)" type="button">Remove</button>
              </div>`;

        container.appendChild(newFieldGroup);
      }

      function languagesLinksSave() {
        const container = document.querySelector('#language-link-form .wrapper');

        const languages = container.querySelectorAll('.languages');
        const links = container.querySelectorAll('.links');
        const languageLinkObject = {};

        languages.forEach((languageInput, index) => {
            const language = languageInput.value;
            const link = links[index].value;

            if(language && link) {
              languageLinkObject[language] = link;
            }
        });

        const json = JSON.stringify(languageLinkObject);

        document.querySelector('[name="languages_links[]"]').value = json;

        alert("Successfully saved");
      }

      function removeLangLinkInput(button)
      { 
          button.closest('.row').remove();
      }

      document.getElementById('addBenefit').addEventListener('click', function() {
        var newBenefit = document.createElement('input');
        newBenefit.setAttribute('type', 'text');
        newBenefit.setAttribute('name', 'benefits[]'); 
        newBenefit.classList.add('form-control', 'my-2'); 
        document.getElementById('benefitsContainer').appendChild(newBenefit);
      });

      function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
          var output = document.getElementById('imagePreview');
          output.src = reader.result;
          output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
      }

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