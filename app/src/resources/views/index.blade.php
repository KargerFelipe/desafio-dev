<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CNAB IMPORTER</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" rel="stylesheet">
        <link href="{{ mix('/css/app.css') }}">
    </head>
    <body class="antialiased">
        <div id="main">
            <header-nav></header-nav>
            <file-drop></file-drop>
            <cnab-table></cnab-table>
         </div>
    </body>

    <script src="{{ mix('/js/app.js') }}"></script>
</html>
