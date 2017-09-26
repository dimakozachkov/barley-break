<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{

    public function start()
    {
        $game = new Game();
        $fields = $game->start();

        return view('game', compact('fields'));
    }

    public function calculate(Request $request)
    {
        $fields = json_decode($request->input('data'));
        $row = $request->get('row');
        $column = $request->get('column');

        $game = new Game();
        $calc = $game->calculate($fields, $row, $column);

        return response(json_encode($calc));
    }

}
