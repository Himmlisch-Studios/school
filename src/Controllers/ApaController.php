<?php

namespace App\Controllers;

use App\Services\ApaService;

class ApaController
{
    public function form()
    {
        return view('apa');
    }

    public function result()
    {
        $data = filter_input_array(INPUT_GET, [
            'names' => FILTER_DEFAULT,
            'surname' => FILTER_DEFAULT,
            'date' => FILTER_DEFAULT,
            'title' => FILTER_DEFAULT,
            'place' => FILTER_DEFAULT,
            'publisher' => FILTER_DEFAULT,
            'url' => FILTER_DEFAULT,
        ]);
        return view('apa-result', $data);
    }

    function action()
    {
        $data = filter_input_array(INPUT_POST, [
            'url' => FILTER_VALIDATE_URL,
            'guess' => FILTER_VALIDATE_BOOLEAN
        ]);

        if (!$data['url']) {
            flash('El campo "URL" es inválido.', 'error');
            redirect('/apa',);
        }

        $apa = new ApaService();
        try {
            $apa->startGuessing(boolval($data['guess']))
                ->init(strtolower($data['url']));
        } catch (\Throwable $th) {
            flash($th->getMessage());
            redirect('/apa');
        }

        flash('¡Exitosamente generado!', 'success');
        redirect('/apa/result?' . http_build_query($apa->getApaAsArray()));
    }
}
