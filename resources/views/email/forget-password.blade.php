<!doctype html>
<html lang="en-US">

<head>
  <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
  <title>Reset Password - EmPex</title>
  <meta name="description" content="Reset Password - EmPex">
  <style type="text/css">
    a:hover {
      text-decoration: underline !important;
    }
  </style>
</head>

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
  <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
    style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: 'Open Sans', sans-serif;">
    <tr>
      <td>
        <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
          align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td style="height:80px;">&nbsp;</td>
          </tr>
          <tr>
            <td style="text-align:center;">
              <a href="{{ url('/') }}" title="logo" target="_blank">
                <img src="{{ url('/') }}/images/logo.png" title="logo" alt="logo" width="400">
              </a>
            </td>
          </tr>
          <tr>
            <td style="height:20px;">&nbsp;</td>
          </tr>
          <tr>
            <td>
              <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                style="max-width:670px;background:#fff; border-radius:3px; text-align:left;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                <tr>
                  <td style="height:40px;">&nbsp;</td>
                </tr>
                <tr>
                  <td style="padding:0 35px;">
                    <div style="margin-bottom: 10px">Hello!</div>
                    <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                      You are receiving this email because we received a password reset request for your account.
                    </p>
                    <p style="text-align: center">
                      <a href="{{ route('reset.password', $token) }}"
                        style="background:#2d9735;text-decoration:none !important; font-weight:500; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;margin-bottom: 10px; margin-left: auto; margin-right:auto; text-align:center">Reset
                        Password</a>
                    </p>
                    <p style="color:#455056; font-size:15px;line-height:24px; margin:0; margin-bottom: 10px;">
                      This password reset link will expire in {{ $date->format('dS M Y, h:i a') }}. (60 minutes)
                    </p>
                    <p style="color:#455056; font-size:15px;line-height:24px; margin:0;margin-bottom: 10px;">
                      If you did not request a password reset, no further action is required.
                    </p>
                    <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                      Regards,
                    </p>
                    <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                      EmpEx
                    </p>

                    <hr>

                    <span style="color:#455056; font-size:14px;line-height:24px; margin:0;">If you're having trouble
                      clicking the "Reset Password" button, copy and paste the URL below into
                      your web browser:</span>
                    <a href="{{ url('/') }}/reset-password/{{ $token }}">{{ url('/') }}/reset-password/{{ $token }}</a>
                  </td>
                </tr>
                <tr>
                  <td style="height:40px;">&nbsp;</td>
                </tr>
              </table>
            </td>
          <tr>
            <td style="height:20px;">&nbsp;</td>
          </tr>
          <tr>
            <td style="text-align:center;">
              <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">
                &copy; <strong>www.empex.mizoram.gov.in</strong></p>
            </td>
          </tr>
          <tr>
            <td style="height:80px;">&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>

</html>