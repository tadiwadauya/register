<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>404 | Not Found.</title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="Whelson IT Register">
    <meta name="author" content="Vincent H Guyo">
    <link rel="icon" href="{{asset('assets\images\favicon.png')}}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <style>
        body {
            font-family: "Raleway",sans-serif;
            font-size: 16px;
            background: #f9a717;
            color: #666;
            margin: 0;
        }
        a {
            color: #fff;
            text-decoration: none;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -ms-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }
        ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        img {
            display: block;
            width: 100%;
        }

        .container {
            position: relative;
            max-width: 800px;
            margin: 0 auto 5%;
            padding: 5%;
            text-align: center;
            color: #fff;
        }
        .container h1 {
            font-weight: normal;
            font-size: 24px;
            margin-bottom: 2em;
        }
        .container a.btn {
            border: 3px solid #fff;
            border-radius: 2px;
            padding: 10px 30px;
            color: #fff;
            text-transform: uppercase;
            text-decoration: none;
            display: inline-block;
        }
        .container a.btn.search {
            border-radius: 0px 2px 2px 0;
        }
        .container a.btn:hover {
            background-color: #fff;
            color: #d88705;
        }
        input[type="text"] {
            border: 3px solid #fff;
            border-right: none;
            border-radius: 2px 0 0 2px;
            padding: 10px 30px;
            color: #fff;
            background-color: transparent;
            display: inline-block;
            outline: none;
            font-size: inherit;
            font-family: inherit;
        }
        .scene {
            padding: 0;
            margin: 0;
        }

        /* DD Bottom Bar */
        .dd-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 15px;
            background-color: rgba(0, 0, 0, 0.3);
            text-align: center;
        }
        .dd-bar ul {
            padding: 0 4%;
        }
        .dd-bar ul li {
            display: inline-block;
            padding: 0 10px;
            font-size: 14px;
        }
        .dd-bar ul li a {
            opacity: 0.6;
        }
        .dd-bar ul li a:hover {
            opacity: 1;
        }

        @media only screen and (max-width: 480px), only screen and (max-width: 480px) {
            input[type="text"] {
                width: 50%;
                padding: 10px;
            }

            .container a.btn {
                padding: 10px 20px;
            }

            .container span {
                display: block;
                margin: 10px 0;
            }
        }
    </style>
</head>
<body>
<div id="container" class="container">
    <ul id="scene" class="scene">
        <li class="layer" data-depth="1.00"><img src="{{asset('images\404-01.png')}}"></li>
        <li class="layer" data-depth="0.60"><img src="{{asset('images\shadows-01.png')}}"></li>
        <li class="layer" data-depth="0.20"><img src="{{asset('images\monster-01.png')}}"></li>
        <li class="layer" data-depth="0.40"><img src="{{asset('images\text-01.png')}}"></li>
        <li class="layer" data-depth="0.10"><img src="{{asset('images\monster-eyes-01.png')}}"></li>
    </ul>
    <h1>Something got lost in the matrix! Or your page might have been moved</h1>

    <a href="{{url('/home')}}" class="btn">You might have better luck going back home </a>
</div>
<!-- Scripts -->
<script src="{{asset('js\parallax.js')}}"></script>
<script>
    // Pretty simple huh?
    var scene = document.getElementById('scene');
    var parallax = new Parallax(scene);
</script>

</body>
</html>
