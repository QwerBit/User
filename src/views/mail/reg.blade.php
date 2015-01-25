<html>  
    <head>  
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">  
        <title>{{$title}}</title>  
    </head>  

    <body style="background: #F2F8FF;">  

        <table style="width: 100%;">
        <tbody>    
            <tr>
                <td>
                    <table style="background: none;border-spacing: 0;border-collapse: collapse;vertical-align: top;text-align: inherit;width: 580px;margin: 0 auto;padding: 0;margin:0 auto;">
                    <tbody>
                        <tr>
                            <td>

                                <table style="width: 100%;">
                                <tbody>
                                    <tr>
                                        <td >
                                            @section('top_left')
                                            <a href="#" style="color: #2ba6cb;text-decoration: none;" target="_blank">
                                                <img src="#" width="169" height="48" alt="{{$site_name}}" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;width: auto;max-width: 100%;float: left;clear: both;display: block;border: none;" align="left">
                                            </a>
                                            @show
                                        </td>

                                        <td style="text-align: right;">
                                            @section('top_right')
                                            <p style="color: #222222;font-family: 'Helvetica', 'Arial', sans-serif;font-weight: normal;text-align: right;line-height: 16px;font-size: 12px;margin: 6px 0 8px;padding: 0;" align="right">Ваш домен требует продления</p>
                                            <a href="#" style="color: #2ba6cb;text-decoration: underline;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;" target="_blank">Вход в&nbsp;личный кабинет</a>
                                            @show
                                        </td>
                                    </tr>
                                </tbody>
                                </table>
                                
                                
                                
                                <table   style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top;text-align: left;color: #222222;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;font-weight: normal;line-height: 19px;font-size: 14px;background: #FFD100;margin: 0;width: 100%;margin-top: 20px;">
                                <tbody style="margin: 0;width: 100%">
                                    <tr>
                                        <td style="padding: 10px;">
                                            <table style="margin: 0;width: 100%">
                                            <tbody>
                                                <tr>
                                                    <td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top;text-align: left;color: #222222;font-family: 'Helvetica', 'Arial', sans-serif;font-weight: normal;line-height: 19px;font-size: 14px;background: #fff;margin: 0;padding: 22px 16px 34px;">
                                                    @section('content')
                                                    
                                                        <h1>Вы зарегестрировались</h1>
                                                        <h3>на сайте {{$site_name}} Ваши регестреционые данные</h3>
                                                        <p>Ваш логин: <strong>{{$login}}</strong></p>
                                                        <p>Ваш пароль: <strong>{{$password}}</strong></p>

                                                        
                                                        <table style="width: 100%;">
                                                        <tbody> 
                                                            <tr>
                                                                <td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top;text-align: center;color: #ffffff;font-family: 'Helvetica', 'Arial', sans-serif;font-weight: normal;line-height: 19px;font-size: 14px;display: block;width: auto !important;-webkit-border-radius: 3px;-moz-border-radius: 3px;border-radius: 3px;background: #00b05a;margin: 0;padding: 0;border: 1px solid #00b05a;">
                                                                    <a href="#" style="color: #ffffff;text-decoration: none;font-weight: bold;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size: 24px;display: block;height: 100%;width: 100%;background-color: none !important;padding: 21px 0 18px;" target="_blank">Ссылка</a>
                                                                </td>
                                                            </tr>
                                                        </tbody>    
                                                        </table>
                                                    
                                                    @show
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                                </table>
                                
                                @section('footer')
                                <p style="color: #222222;font-family: 'Helvetica', 'Arial', sans-serif;font-weight: normal;text-align: left;line-height: 24px;font-size: 15px;margin: 10px 0 5px;padding: 0;" align="left">Если у&nbsp;вас есть вопросы, вы&nbsp;можете обратиться в&nbsp;нашу <a href="#" style="color: #2ba6cb;text-decoration: underline;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;" target="_blank">техническую поддержку</a>
                                    <br>Спасибо за&nbsp;то, что вы&nbsp;с&nbsp;нами! Искренне ваш, {{$site_name}}.
                                </p>
                                @show
                                
                            </td>
                        </tr>
                    </tbody>    
                    </table>                    
                </td>
            </tr>
        </tbody>    
        </table>

</body>  
</html>
