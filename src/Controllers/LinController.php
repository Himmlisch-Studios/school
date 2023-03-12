<?php

namespace App\Controllers;

use App\Services\LinService;

class LinController
{
    function form()
    {
        return view('lin');
    }

    function action()
    {
        $data = filter_input_array(INPUT_POST, [
            'equation' => [
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => [
                    'regexp' => '/' . LinService::REGEX . '/'
                ]
            ],
            'tolerance' => FILTER_VALIDATE_FLOAT,
            'error' => FILTER_VALIDATE_FLOAT,
        ]);

        if (!$data['equation']) {
            flash('Ecuación no válida');
            redirect('/lin');
        }

        $lin = LinService::make();
        dd(
            $lin->setFunction($data['equation'])
                ->setTolerance($data['tolerance'] ?? 0.001)
                ->execute()
                ->getIterations()
        );
    }
}
