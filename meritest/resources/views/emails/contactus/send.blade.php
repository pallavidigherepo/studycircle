<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" style="width:100%;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0">
    <head> 
        <meta charset="UTF-8"> 
        <meta content="width=device-width, initial-scale=1" name="viewport"> 
        <meta name="x-apple-disable-message-reformatting"> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <meta content="telephone=no" name="format-detection"> 
        <title>Contact Us</title> 
        <!--[if (mso 16)]>
            <style type="text/css">
            a {text-decoration: none;}
            </style>
        <![endif]--> 
        <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--> 
        <!--[if gte mso 9]>
        <xml>
            <o:OfficeDocumentSettings>
            <o:AllowPNG></o:AllowPNG>
            <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
        <![endif]-->
        <style>
            #wrapper {
              border: 1px solid #EEEEEE; 
              padding: 10px;
            }
            .center {
              text-align: center;
            }
            .table {
              padding: 5px;
              width: 100%;
            }
            .label{
              width: 90px;
              text-align: left;
              font-weight: bold;
            }
            .table tr {
              border-bottom: 1px solid #eeeeee;
            }
        </style>
    </head> 
    <body> 
        <div id="wrapper"> 
            <div class="center">
                <p>You received a new message from your Meritest solutions contact form.</p>
            </div>
            <hr />
            <div>
                <table class="table">
                    <tr>
                        <td class="label">Name</td>
                        <td>{{ $data['name'] }}</td>
                    </tr>
                    <tr>
                        <td class="label">Email</td>
                        <td>{{ $data['email'] }}</td>
                    </tr>
                    <tr>
                        <td class="label">Mobile</td>
                        <td>{{ $data['mobile_no'] }}</td>
                    </tr>
                    <tr>
                        <td class="label">Address</td>
                        <td>{{ $data['address'] }}</td>
                    </tr>
                    <tr>
                        <td class="label">Heard From</td>
                        <td>{{ $data['heard_from'] }}</td>
                    </tr>
                    <tr>
                        <td class="label">Subject</td>
                        <td>{{ $data['subject'] }}</td>
                    </tr>
                    <tr>
                        <td class="label">Message</td>
                        <td>{{ $data['message'] }}</td>
                    </tr>
                </table>
            </div>
        </div>  
    </body>
</html>