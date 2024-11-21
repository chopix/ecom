<x-layouts.email subtitle="{{$name}}, Welcome to BundledSEO">
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
    </style>
  @endpush
  <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 600px;">
      <tr>
          <td style="background-color: #ffffff;">
              <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                  <tr>
                    <td><img style="width: 100%;" src="{{asset('/img/email/welcome-banner.png')}}" alt=""></td>
                  </tr>
                  <tr>
                      <td style="padding: 20px;">
                          <p style="margin: 0; color: #131313; font-family: Inter; font-size: 16px; font-weight: 700; margin-bottom: 10px;">Hi {{$name}}</p>
                          <p style="margin: 0; color: #06F; font-family: Inter; margin-bottom: 10px;">Welcome to BundledSEO!</p>
                          <p style="margin: 0; color: #131313; font-family: Inter; font-size: 16px; margin-bottom: 10px;">We hope you can have an unforgettable experience and access all the tools you need with us</p>
                          <p style="margin: 0; color: #131313; font-family: Inter; font-size: 16px; margin-bottom: 10px;">If you have any questions or would like to get acquainted with all the capabilities of our platform, we invite you to do so right now!</p>
                      </td>
                  </tr>
                  <tr>
                      <td style="padding: 20px; text-align: center;">
                          <a href="{{route('auth.login')}}" class="button" style="border-radius: 60px; background: #06F ; padding: 10px 35px; margin-top: 20px; cursor: pointer; width: 80%; color: #FFF;font-family: Raleway;font-size: 16px;font-style: normal;font-weight: 600;line-height: normal;letter-spacing: 0.64px;"">Login to the platform</a>
                      </td>
                  </tr>
                  <!-- Repeat blocks below for additional content -->
                  <tr>
                      <td style="background: url('{{ asset('/img/email/welcome-product-packages.jpg') }}') no-repeat center center / cover;">
                        <div style="max-width: 250px; padding: 40px;">
                            <h2 style="margin: 0 0 10px;  color: #06F; font-family: Raleway; font-size: 12px; font-weight: 600; letter-spacing: 0.06px; text-transform: uppercase;">
                              Product packages
                            </h2>
                            <p style="margin: 0; color: #333333; font-family: Inter; font-size: 28px; font-weight: 700;">Get a variety of tools with maximum benefits</p>
                            <a href="{{route('plans')}}" class="button" style="border-radius: 60px; background: #06F ; padding: 10px 35px; margin-top: 20px; cursor: pointer; color: #FFF;font-family: Raleway;font-size: 16px;font-style: normal;font-weight: 600;line-height: normal;letter-spacing: 0.64px;">
                              View all packages
                            </a>
                        </div>
                      </td>
                  </tr>
              </table>
          </td>
      </tr>
  </table>

</x-layouts.email>