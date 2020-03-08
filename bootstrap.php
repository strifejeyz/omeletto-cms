<?php

function r($name) {
    return call_user_func_array(['Route', 'get'], func_get_args());
}

function v($SD) {

}
