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
                    <td><img style="width: 100%;" src="{{asset('/img/email/payment-reminder-banner.png')}}" alt=""></td>
                  </tr>
                  <tr>
                      <td style="padding: 20px;">
                          <p style="margin: 0; color: #131313; font-family: Inter; font-size: 16px; font-weight: 700; margin-bottom: 10px;">Dear [Username],</p>
                          
                          <p style="margin: 0; color: #131313; font-family: Inter; font-size: 16px; margin-bottom: 10px;">We remind you to make a payment for the services of our company BandledSEO. According to your current tariff plan, we suggest you deposit the amount [amount] before [payment date].</p>
                          <p style="margin: 0; color: #131313; font-family: Inter; font-size: 16px; margin-bottom: 10px;">If there is no payment before the specified date, the service of your account will be suspended from [suspension date].</p>
                          <p style="margin: 0; color: #131313; font-family: Inter; font-size: 16px; margin-bottom: 10px;">We provide various payment methods to make the process as convenient as possible for you. I ask you to make the payment on time in order to continue to enjoy all the benefits of our services.</p>
                          <p style="margin: 0; color: #131313; font-family: Inter; font-size: 16px; font-weight: 700; margin-bottom: 10px; margin-top: 30px;">Payment Information:</p>
                          <p style="margin: 0; color: #131313; font-family: Inter; font-size: 16px;  margin-bottom: 0px; margin-top: 10px;">Payment amount: [amount]</p>
                          <p style="margin: 0; color: #131313; font-family: Inter; font-size: 16px;  margin-bottom: 10px; margin-top: 0px;">Payment term: [date]</p>
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
                      <p>Thank you for your cooperation and prompt attention to this issue.</p>
                      <p>With respect, <br> BandledSEO Team</p>
                    </td>
                  </tr>
              </table>
          </td>
      </tr>
  </table>

</x-layouts.email>