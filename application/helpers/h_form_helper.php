<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function create_form($arr)
{

    $output = '';
    $class="";
    if (array_key_exists('class', $arr))
        {
            $class=$arr['class'];
        }
        
    if ($arr['type'] == 'text') {

        $output = $output . '<div class="form-group mb-3 row">';
        $output = $output . '<label class="form-label col-3 col-form-label">' . $arr['label'] . '</label>';
        $output = $output . '<div class="col">';
        $output = $output . '<input type="text" class="form-control '. $class .'" id="' . $arr['id'] . '" name="' . $arr['id'] . '" placeholder="' . $arr['placeholder'] . '" value="' . $arr['value'] . '" ' . $arr['attr'] . '>';
        $output = $output . '<div class="invalid-feedback mb-0" id="er-' . $arr['id'] . '"></div>';
        $output = $output . '</div>';
        $output = $output . '</div>';
    } elseif ($arr['type'] == 'email') {

        $output = $output . '<div class="form-group mb-3 row">';
        $output = $output . '<label class="form-label col-3 col-form-label">' . $arr['label'] . '</label>';
        $output = $output . '<div class="col">';
        $output = $output . '<input type="email" class="form-control '. $class .'" id="' . $arr['id'] . '" name="' . $arr['id'] . '" placeholder="' . $arr['placeholder'] . '" value="' . $arr['value'] . '" ' . $arr['attr'] . '>';
        $output = $output . '<div class="invalid-feedback mb-0" id="er-' . $arr['id'] . '"></div>';
        $output = $output . '</div>';
        $output = $output . '</div>';
    } elseif ($arr['type'] == 'password') {

        $output = $output . '<div class="form-group mb-3 row">';
        $output = $output . '<label class="form-label col-3 col-form-label">' . $arr['label'] . '</label>';
        $output = $output . '<div class="col">';
        $output = $output . '<input type="password" class="form-control '. $class .'" id="' . $arr['id'] . '" name="' . $arr['id'] . '" placeholder="' . $arr['placeholder'] . '" value="' . $arr['value'] . '" ' . $arr['attr'] . '>';
        $output = $output . '<div class="invalid-feedback mb-0" id="er-' . $arr['id'] . '"></div>';
        $output = $output . '</div>';
        $output = $output . '</div>';
    } elseif ($arr['type'] == 'select') {

        $output = $output . '<div class="form-group mb-3 row">';
        $output = $output . '<label class="form-label col-3 col-form-label">' . $arr['label'] . '</label>';
        $output = $output . '<div class="col">';
        $output = $output . '<select class="form-select '. $class .'" id="' . $arr['id'] . '" name="' . $arr['id'] . '" ' . $arr['attr'] . '>';
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

        $row = (isset($arr['row']) ? $arr['row'] : 1);
        $output = $output . '<div class="form-group mb-3 row">';
        $output = $output . '<label class="form-label col-3 col-form-label">' . $arr['label'] . '</label>';
        $output = $output . '<div class="col">';
        $output = $output . '<textarea class="form-control '. $class .'" name="' . $arr['id'] . '" id="' . $arr['id'] . '" rows="'. $row .'" placeholder="' . $arr['placeholder'] . '">' . $arr['value'] . '</textarea>';
        //$output = $output . '<input type="password" class="form-control" id="' . $arr['id'] . '" name="' . $arr['id'] . '" placeholder="' . $arr['placeholder'] . '" value="' . $arr['value'] . '" ' . $arr['attr'] . '>';
        $output = $output . '<div class="invalid-feedback mb-0" id="er-' . $arr['id'] . '"></div>';
        $output = $output . '</div>';
        $output = $output . '</div>';

        

    }elseif ($arr['type'] == 'textarea_history') {

        $row = (isset($arr['row']) ? $arr['row'] : 1);
        $old = (isset($arr['value']) ? $arr['value'] : '');
        $output = $output . '<div class="form-group mb-3 row">';
        $output = $output . '<label class="form-label col-3 col-form-label">' . $arr['label'] . '</label>';
        $output = $output . '<div class="col">';

            //$output = $output . '<div class="card p-2 " style="height:100px !important;overflow-y:auto;"> ' . $old .'</div>';
            $output = $output . '<textarea class="form-control d-none" readonly rows=3 name="' . $arr['id'] . '" id="' . $arr['id'] . '">'. $old .'</textarea>';
        $output = $output . '<textarea class="form-control '. $class .'" name="' . $arr['id'] . '-new" id="' . $arr['id'] . '-new" rows="'. $row .'" placeholder="' . $arr['placeholder'] . '" ' . $arr['attr'] . '></textarea>';
        //$output = $output . '<input type="password" class="form-control" id="' . $arr['id'] . '" name="' . $arr['id'] . '" placeholder="' . $arr['placeholder'] . '" value="' . $arr['value'] . '" ' . $arr['attr'] . '>';
        $output = $output . '<div class="invalid-feedback mb-0" id="er-' . $arr['id'] . '-new"></div>';
        $output = $output . '</div>';
        $output = $output . '</div>';

        

    }elseif ($arr['type'] == 'text-select') {

        $output = $output . '<div class="form-group mb-3 row">';
        $output = $output . '<label class="form-label col-3 col-form-label">' . $arr['label'] . '</label>';
        $output = $output . '<div class="col"><div class="d-flex flex-nowrap">';
        $output = $output . '<input type="text" class="form-control w-75" id="' . $arr['id'] . '" name="' . $arr['id'] . '" placeholder="' . $arr['placeholder'] . '" ' . $arr['attr'] . '>';
        $output = $output . '<select class="form-select w-25" id="' . $arr['id'] . '-sel" name="' . $arr['id'] . '-sel" ' . $arr['attr'] . '>';
        foreach ($arr['value'] as $opt) {
            if (is_object($opt)) {

                $output = $output . '<option value="' . $opt->val . '">' . $opt->deskripsi . '</option>';
            } else {
                $output = $output . '<option value="' . $opt['val'] . '">' . $opt['deskripsi'] . '</option>';
            }
        }

        $output = $output . '</select><div class="invalid-feedback mb-0" id="er-' . $arr['id'] . '"></div></div>';
        $output = $output . '</div>';
        $output = $output . '</div>';

        

    }

    return $output;
}

