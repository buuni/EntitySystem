<?php
/**
 * Author: Demko Igor
 */

namespace Controllers;

class EntityManager extends Controller
{

    public function addDictionary($request, $response, $args)
    {
        $name = $request->getAttribute('csrf_name');
        $value = $request->getAttribute('csrf_value');
    }
}
