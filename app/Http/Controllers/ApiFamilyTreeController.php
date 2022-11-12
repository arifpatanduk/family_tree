<?php

namespace App\Http\Controllers;

use App\Models\Family;
use Illuminate\Http\Request;

class ApiFamilyTreeController extends Controller
{
    public function index()
    {
        $parents = Family::whereNull('parent_id')->get();
        $families = [];

        foreach ($parents as $parent) {
            array_push($families, $parent);
            $this->get_childs($parent->childs);
        }

        return $families;
    }

    public function show($id)
    {
        $childs = [];
        $person = Family::with('childs')->find($id);

        array_push($childs, $person);
        $this->get_childs($person->childs);

        return $childs;
    }

    public function get_childs($persons)
    {
        $data = [];
        foreach ($persons as $person) {
            array_push($data, Family::with('childs')->find($person->id));
            $this->get_childs($person->childs);
        }
        return $data;
    }
}
