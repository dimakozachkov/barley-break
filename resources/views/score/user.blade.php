@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <div class="wrapper">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Ходы</th>
                <th>Дата</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 0 ?>
            @foreach($allScore as $score)
                <tr>
                    <th scope="row">{{ ++$i }}</th>
                    <td>{{ $score->score }}</td>
                    <td>{{ date('H:i:s d.m.Y', strtotime($score->created_at)) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection