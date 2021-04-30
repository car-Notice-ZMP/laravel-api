<!DOCTYPE HTML>

<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Comaptible" content="IE=edge,chrome=1">
        <meta name="Robert Klinger">

        <style>

body
    {
    font-family: 'Lato';
    color: #fff;
}

#container
    {
    height: auto;
    width: 500px;
    margin-left: auto;
    margin-right: auto;
    padding: 50px;
    background-color: #303030;
}

#topBox
    {
    height: 70px;
    margin-bottom: 15px;
}

#midBox
    {
    font-size: large;
    margin-bottom: 2rem;
}

        </style>

    </head>
    <body>
        <div id="container">
            <main>
                <div id="topBox">
                    <header>
                        <h1>{{$title}}</h1>
                    </header>
                    <hr>
                </div>

                <div id="midBox">
                    <article>{{$content}}</article>
                </div>
            </main>
        </div>
    </body>
</html>
