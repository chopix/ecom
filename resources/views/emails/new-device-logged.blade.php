<x-layouts.email subtitle="New device login detected">
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
                    <td><img style="width: 100%;" src="{{asset('/img/email/reset-banner.png')}}" alt=""></td>
                  </tr>
                  <tr>
                      <td style="padding: 20px;">
                          <p style="margin: 0; color: #131313; font-family: Inter; font-size: 16px; font-weight: 700; margin-bottom: 10px;">Hi {{$name}}</p>
                          <p style="margin: 0; color: #131313; font-family: Inter; font-size: 16px; margin-bottom: 10px;">We have noticed that you are logging into your account from a new device. If it wasn't you, we recommend that you take immediate action to ensure the security of your account.</p>
                          <p style="margin: 0; color: #06f; font-family: Inter; font-size: 16px; font-weight: 700; margin-bottom: 10px;">Entry Details:</p>
                          <p style="margin: 0; color: #131313; font-family: Inter; font-size: 16px; margin-bottom: 10px;">
                            <p style="margin: 0;">Date and time: {{$date}}</p>
                            <p style="margin: 0;">Platform: {{$platform}}</p>
                            <p style="margin: 0;">Browser: {{$device}}</p>
                            <p style="margin: 0;">IP: {{$ip}}</p>
                          </p>
                          <p style="margin: 0; color: #131313; font-family: Inter; font-size: 16px; margin-bottom: 10px;">If you have not logged in, please reset your password by clicking on the following.</p>
                      </td>
                  </tr>
                  <tr>
                      <td style="padding: 20px; text-align: center;">
                          <p style="margin-top: -30px;">
                            <a href="{{route('password.request')}}" class="button" style="border-radius: 60px; background: #06F ; padding: 10px 35px; margin-top: 20px; cursor: pointer; width: 80%; color: #FFF;font-family: Raleway;font-size: 16px;font-style: normal;font-weight: 600;line-height: normal;letter-spacing: 0.64px; margin-bottom: -80px;">Reset password</a>
                          </p>  
                      </td>
                  </tr>
                  <tr>
                    <td style="padding: 20px;">
                      <p style="margin: 0; color: #131313; font-family: Inter; font-size: 16px; margin-bottom: 10px;">Thank you for paying attention to the security of your account.</p>
                      <p>With respect, <br> BandledSEO Team</p>
                    </td>
                  </tr>
              </table>
          </td>
      </tr>
  </table>

</x-layouts.email>