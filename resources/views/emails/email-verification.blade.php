<x-layouts.email subtitle="Email verification">
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
                      <td style="padding: 20px;">
                          <p style="margin: 0; color: #131313; font-family: Inter; font-size: 16px; font-weight: 700; margin-bottom: 10px;">Hi {{auth()->user()->name}}</p>
                          <p style="margin: 0; color: #131313; font-family: Inter; font-size: 16px; margin-bottom: 10px;">Please click the button below to verify your email address.</p>
                      </td>
                  </tr>
                  <tr>
                      <td style="padding: 20px; text-align: center;">
                          <p style="margin-top: -30px;">
                            <a href="{{$verificationUrl}}" class="button" style="border-radius: 60px; background: #06F ; padding: 10px 35px; margin-top: 20px; cursor: pointer; width: 80%; color: #FFF;font-family: Raleway;font-size: 16px;font-style: normal;font-weight: 600;line-height: normal;letter-spacing: 0.64px; margin-bottom: -80px;">Verify email</a>
                          </p>  
                      </td>
                  </tr>
              </table>
          </td>
      </tr>
  </table>

</x-layouts.email>