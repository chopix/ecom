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
                    <td><img style="width: 100%;" src="{{asset('/img/email/not-been-paid-banner.png')}}" alt=""></td>
                  </tr>
                  <tr>
                      <td style="padding: 20px;">
                          <p style="margin: 0; color: #131313; font-family: Inter; font-size: 16px; font-weight: 700; margin-bottom: 10px;">Hi [Name/Company Name]</p>
                          
                          <p style="margin: 0; color: #131313; font-family: Inter; font-size: 16px;">We would like to draw your attention to the fact that your BandledSEO account has been temporarily suspended due to non-payment of the bill. To restore access to our services and resume your account, please make a payment as soon as possible.</p>
                          <p style="margin: 0; color: #131313; font-family: Inter; font-size: 16px; font-weight: 700; margin-top: 30px; margin-bottom: 10px;">Information on an unpaid bill:</p>
                          <p style="margin: 0; color: #131313; font-family: Inter; font-size: 16px; margin-bottom: 0;">Amount: [amount]</p>
                          <p style="margin: 0; color: #131313; font-family: Inter; font-size: 16px; margin-top: 0;">Date of suspension: [date]</p>
                          <p style="margin: 0; color: #131313; font-family: Inter; font-size: 16px; margin-top: 30px; margin-bottom: 10px;">For the convenience of payment, you can use the  [link to the payment page].  We are confident that with your promptness, this situation will be resolved quickly, and you will be able to enjoy all the possibilities of our services again.</p>
                      </td>
                  </tr>
                  <tr>
                      <td style="padding: 20px; text-align: center;">
                          <p style="margin-top: -30px;">
                            <a href="{{route('user.profile')}}" class="button" style="border-radius: 60px; background: #06F ; padding: 10px 35px; margin-top: 20px; cursor: pointer; width: 80%; color: #FFF;font-family: Raleway;font-size: 16px;font-style: normal;font-weight: 600;line-height: normal;letter-spacing: 0.64px; margin-bottom: -80px;">Go for payment</a>
                          </p>  
                      </td>
                  </tr>
                  <tr>
                    <td style="padding: 20px;">
                      <p>Thank you for your understanding and prompt response.</p>
                      <p>With respect, <br> BandledSEO Team</p>
                    </td>
                  </tr>
              </table>
          </td>
      </tr>
  </table>

</x-layouts.email>