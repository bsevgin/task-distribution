<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Distribution</title>

    <script src="//getbootstrap.com/docs/5.3/assets/js/color-modes.js"></script>
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .container{
            max-width: 1024px;
            font-size: 12px;
        }
        .card-body{
            padding: 10px;
        }
        .card table td, .card table th{
            padding: 5px;
        }
    </style>
</head>
<body class="bg-body-tertiary">

<div class="container py-3">
    <main>
        <div class="p-3 pb-md-4 mx-auto text-center">
            <h1>Task Distribution Planning</h1>

            @foreach($weeklySprint as $weekName => $sprint)
                <div class="row">
                    <div class="col-md-12 mt-md">
                        <h2 class="mt-4">{{ $weekName }}</h2>
                        <hr class="my-2">

                        <div class="row">
                            @foreach($sprint as $developer)
                                <div class="col">
                                    <div class="card mt-2 rounded-3 shadow-sm">
                                        <div class="card-header py-2">
                                            <h4 class="my-0 fw-normal">{{ $developer['name'] }}</h4>
                                        </div>
                                        <div class="card-body">
                                            <table class="table">
                                                <tr>
                                                    <th scope="row">Task</th>
                                                    <th scope="row">Hour</th>
                                                </tr>
                                                @foreach($developer['task'] as $task)
                                                    <tr>
                                                        <td>{{ $task['name'] }}</td>
                                                        <td>{{ $task['duration'] }}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
</div>

</body>
</html>
