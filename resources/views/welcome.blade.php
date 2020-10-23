<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Welcome To Parspack</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 15px;
            }

            .sub-title{
                font-size: 30px;
                margin-bottom: 30px;
            }
            .feature-list{
                text-align: left;
            }
            .access-link{
                margin: 40px auto;
                display: block;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Parspack Platform! 
                </div>
                <div class="sub-title">
                    You can see features' list of this platform below: 
                </div>
                <div class="feature-list">
                    <ul>
                        <li>Sign up :-)</li>
                        <li>Authenticate via token</li>
                        <li>Get list of running processes on the server</li>
                        <li>Create a directory with user's specified name in "/opt/myprogram/" directory</li>
                        <li>Create a file with user's specified name in "/opt/myprogram/" directory.</li>
                        <li>Get list of all directories in "/opt/myprogram/" directory</li>
                        <li>Get list of all files in "/opt/myprogram/" directory</li>
                    </ul> 

                    <strong class="access-link"><a href="/home">Access them all through your panel</a></strong>
                </div>
            </div>
        </div>
    </body>
</html>
