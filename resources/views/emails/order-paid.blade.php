<x-layouts.email>
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
                    <td><img style="width: 100%;" src="{{asset('/img/email/order-paid-banner.png')}}" alt=""></td>
                  </tr>
                  <tr>
                      <td style="padding: 20px;">
                          <p style="margin: 0; color: #131313; font-family: Inter; font-size: 16px; font-weight: 700; margin-bottom: 10px;">Hi [Name/Company Name]</p>
                          
                          <p style="margin: 0; color: #131313; font-family: Inter; font-size: 16px;">We notify you that the payment for [product name] in the amount of</p>
                          <p style="margin: 0; color: #06F;font-size: 24px; font-weight: 800; font-family: Inter; margin-top: 0; margin-bottom: 20px;">$49 was successful.</p>
                          <p style="margin: 0; color: #131313; font-family: Inter; font-size: 16px; margin-bottom: 10px;">The product is already available in your personal account.</p>
                      </td>
                  </tr>
                  <tr>
                      <td style="padding: 20px; text-align: center;">
                          <p style="margin-top: -30px;">
                            <a href="{{route('user.profile')}}" class="button" style="border-radius: 60px; background: #06F ; padding: 10px 35px; margin-top: 20px; cursor: pointer; width: 80%; color: #FFF;font-family: Raleway;font-size: 16px;font-style: normal;font-weight: 600;line-height: normal;letter-spacing: 0.64px; margin-bottom: -80px;">Go to your personal account</a>
                          </p>  
                      </td>
                  </tr>
                  <tr>
                    <td style="padding: 20px;">
                      <p>With respect, <br> BandledSEO Team</p>
                    </td>
                  </tr>
                  <tr>
                      <td style="background: url('{{ asset('/img/email/order-paid-find.png') }}') no-repeat center center / cover;">
                        <div style="max-width: 250px; padding: 40px;">
                            <h2 style="margin: 0 0 10px;  color: #06F; font-family: Raleway; font-size: 12px; font-weight: 600; letter-spacing: 0.06px; text-transform: uppercase;">
                              News and updates
                            </h2>
                            <p style="margin: 0; color: #333333; font-family: Inter; font-size: 28px; font-weight: 700;">Find out what's new on our platform</p>
                            <a href="{{route('dashboard')}}" class="button" style="border-radius: 60px; background: #06F ; padding: 10px 35px; margin-top: 20px; cursor: pointer; color: #FFF;font-family: Raleway;font-size: 16px;font-style: normal;font-weight: 600;line-height: normal;letter-spacing: 0.64px;">
                              Find out more
                            </a>
                        </div>
                      </td>
                  </tr>
              </table>
          </td>
      </tr>
  </table>

</x-layouts.email>