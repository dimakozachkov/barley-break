@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <h1>Сделано ходов: <span id="steps">0</span></h1>
        <h1 id="congratulation" style="display: none">Вы выиграли!</h1>
        <a href="{{ route('home') }}">Новая игра</a>
        <br>
        <br>
        <div class="field-wrapper">
            <table>
                <tbody id="field-area">
                </tbody>
            </table>
        </div>
    </div>

    <script>
        let data = {!! json_encode($fields) !!};

        function sendData(row, column) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.post(
                '{{ route('calculate') }}',
                {
                    row: row,
                    column: column,
                    data: JSON.stringify(data),
                },
                (response) => {
                    let steps = $('#steps');
                    let num = Number.parseInt(steps.text());

                    data = JSON.parse(response);

                    steps.text(num + 1);

                    if (response == 'finish') {
                        $.post(
                            '{{ route("score-save") }}',
                            {
                                score: num + 1
                            }
                        );

                        $('#congratulation').show();
                        return;
                    }

                    printField(data);
                }
            );
        }

        function printField(fieldData) {
            let fieldArea = $('#field-area');
            fieldArea.html('');

            for (let i = 0; i < fieldData.length; i++) {
                let tr = document.createElement('tr');
                tr.setAttribute('data-id', i);

                for (let j = 0; j < fieldData[i].length; j++) {
                    let td = document.createElement('td');
                    td.setAttribute('data-id', j);
                    td.setAttribute('onClick', `sendData(${i}, ${j})`);
                    td.innerText = fieldData[i][j];

                    if (fieldData[i][j].isString) {
                        td.setAttribute('class', 'empty');
                    }

                    tr.append(td);
                }

                fieldArea.append(tr);
            }
        }

        printField(data);
    </script>
@endsection