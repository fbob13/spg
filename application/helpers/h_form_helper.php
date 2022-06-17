<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function create_form($arr)
{

    $output = '';
    if ($arr['type'] == 'text') {

        $output = $output . '<div class="form-group mb-3 row">';
        $output = $output . '<label class="form-label col-3 col-form-label">' . $arr['label'] . '</label>';
        $output = $output . '<div class="col">';
        $output = $output . '<input type="text" class="form-control" id="' . $arr['id'] . '" name="' . $arr['id'] . '" placeholder="' . $arr['placeholder'] . '" value="' . $arr['value'] . '" ' . $arr['attr'] . '>';
        $output = $output . '<div class="invalid-feedback mb-0" id="er-' . $arr['id'] . '"></div>';
        $output = $output . '</div>';
        $output = $output . '</div>';
    } elseif ($arr['type'] == 'email') {

        $output = $output . '<div class="form-group mb-3 row">';
        $output = $output . '<label class="form-label col-3 col-form-label">' . $arr['label'] . '</label>';
        $output = $output . '<div class="col">';
        $output = $output . '<input type="email" class="form-control" id="' . $arr['id'] . '" name="' . $arr['id'] . '" placeholder="' . $arr['placeholder'] . '" value="' . $arr['value'] . '" ' . $arr['attr'] . '>';
        $output = $output . '<div class="invalid-feedback mb-0" id="er-' . $arr['id'] . '"></div>';
        $output = $output . '</div>';
        $output = $output . '</div>';
    } elseif ($arr['type'] == 'password') {

        $output = $output . '<div class="form-group mb-3 row">';
        $output = $output . '<label class="form-label col-3 col-form-label">' . $arr['label'] . '</label>';
        $output = $output . '<div class="col">';
        $output = $output . '<input type="password" class="form-control" id="' . $arr['id'] . '" name="' . $arr['id'] . '" placeholder="' . $arr['placeholder'] . '" value="' . $arr['value'] . '" ' . $arr['attr'] . '>';
        $output = $output . '<div class="invalid-feedback mb-0" id="er-' . $arr['id'] . '"></div>';
        $output = $output . '</div>';
        $output = $output . '</div>';
    } elseif ($arr['type'] == 'select') {

        $output = $output . '<div class="form-group mb-3 row">';
        $output = $output . '<label class="form-label col-3 col-form-label">' . $arr['label'] . '</label>';
        $output = $output . '<div class="col">';
        $output = $output . '<select class="form-select" id="' . $arr['id'] . '" name="' . $arr['id'] . '" ' . $arr['attr'] . '>';
        $output = $output . '<option value=""></option>';

        foreach ($arr['value'] as $opt) {
            if (is_object($opt)) {

                $output = $output . '<option value="' . $opt->val . '">' . $opt->deskripsi . '</option>';
            } else {
                $output = $output . '<option value="' . $opt['val'] . '">' . $opt['deskripsi'] . '</option>';
            }
        }

        $output = $output . '</select><div class="invalid-feedback mb-0" id="er-' . $arr['id'] . '"></div>';
        $output = $output . '</div>';
        $output = $output . '</div>';
    }elseif ($arr['type'] == 'textarea') {

        $output = $output . '<div class="form-group mb-3 row">';
        $output = $output . '<label class="form-label col-3 col-form-label">' . $arr['label'] . '</label>';
        $output = $output . '<div class="col">';
        $output = $output . '<textarea class="form-control" name="' . $arr['id'] . '" id="' . $arr['id'] . '" rows="6" placeholder="' . $arr['placeholder'] . '">' . $arr['value'] . '</textarea>';
        //$output = $output . '<input type="password" class="form-control" id="' . $arr['id'] . '" name="' . $arr['id'] . '" placeholder="' . $arr['placeholder'] . '" value="' . $arr['value'] . '" ' . $arr['attr'] . '>';
        $output = $output . '<div class="invalid-feedback mb-0" id="er-' . $arr['id'] . '"></div>';
        $output = $output . '</div>';
        $output = $output . '</div>';

        

    }

    return $output;
}

