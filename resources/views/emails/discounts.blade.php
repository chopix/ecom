<x-layouts.email subtitle="We have hot discounts">
  @push('links')
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
  @endpush
  @push('styles')
      <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .button {
            display: inline-block;
            padding: 10px 15px;
            font-size: 14px;
            color: #fff;
            background: #007bff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
        a{
          color: inherit;
          text-decoration: none;
        }
        .product-table {
        width: 100%;
        max-width: 600px;
        border-spacing: 10px;
        margin: 0 auto;
    }
    .product-cell {
        background: #ffffff;
        text-align: center;
        vertical-align: top;
        padding: 20px;
        border-radius: 20px;
        width: 38%;
        display: inline-block;
        border-radius: 12px;
        border: 1px solid #BBC0C8;
        margin: 10px;
    }
    .product-cell img {
        width: 100%; /* Adjust as needed */
        height: auto;
        margin-bottom: 10px;
    }
    .product-price {
        font-size: 30px;
        color: #ff5722;
        font-weight: bold;
        margin: 10px 0;
    }
    .original-price {
        font-size: 20px;
        color: #777777;
        text-decoration: line-through;
        margin-bottom: 15px;
    }
    .buy-button {
        display: inline-block;
        background-color: #007bff;
        color: #ffffff;
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 20px;
        font-weight: bold;
    }
    </style>
  @endpush
  <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 600px;">
      <tr>
          <td style="background-color: #ffffff;">
              <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                  <tr>
                    <td><img style="width: 100%;" src="{{asset('/img/email/discounts-banner.png')}}" alt=""></td>
                  </tr>
                  <tr>
                      <td style="padding: 20px;">
                          <p style="margin: 0; color: #131313; font-family: Inter; font-size: 16px; font-weight: 700; margin-bottom: 10px;">Hi {{$user->name}}</p>
                          <div id="content" style="margin: 0; color: #131313; font-family: Inter; font-size: 16px; margin-bottom: 10px;">
                            {!! $content !!}
                          </div>
                          
                      </td>
                  </tr>
                  <tr>
                      <td style="padding: 20px; text-align: center;">
                          <p style="margin-top: -30px;">
                            <a href="{{route('user.profile')}}" class="button" style="border-radius: 60px; background: #06F ; padding: 10px 35px; margin-top: 20px; cursor: pointer; width: 80%; color: #FFF;font-family: Raleway;font-size: 16px;font-style: normal;font-weight: 600;line-height: normal;letter-spacing: 0.64px; margin-bottom: -80px;">View all plans</a>
                          </p>  
                      </td>
                  </tr>
                  <tr>
                    <td style="padding: 20px; text-align: center;">
                      <p style="margin: 0; color: #131313; font-family: Inter; font-size: 16px; font-weight: 700; margin-bottom: 10px; color: #06f;">A selection of offers for you</p>
                      <div class="product-table">
                        @foreach($products as $product)
                          <div class="product-cell">
                            @if (isset($product->productable['image']))
                              <img src="{{asset($product->productable['image'])}}" alt="{{$product->productable['title']}}">  
                            @endif
                              <div>{{$product->productable['title']}}</div>
                              <div class="product-price">{{$product->price}}{{$product->currencySymbol}}</div>
                              <a href="{{route('plans')}}" class="buy-button">Buy</a>
                          </div>  
                        @endforeach
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td style="padding: 20px;">
                      <p style="margin: 0; color: #131313; font-family: Inter; font-size: 16px; margin-bottom: 10px;">Thank you for your trust. We appreciate your choice!</p>
                      <p>With respect, <br> BandledSEO Team</p>
                    </td>
                  </tr>
              </table>
          </td>
      </tr>
  </table>

</x-layouts.email>