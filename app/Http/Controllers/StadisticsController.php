<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StadisticsController extends Controller
{

    function __construct()
    {
        $this->google = new GoogleSheetController();    
    }

    function index(){
        $data = $this->google->getSharedFiles();
        return view('pages.index')->with('data', $data);
    }
    function save(string $id){
        $data = $this->google->getAllDataFromSpreadSheet($id);
        $title = $this->google->getGameTitle($id);
        $year = $this->google->getYearFromSpreadSheet($id);
        return view('pages.save')->with('data', $data)->with('title', $title)->with('year', $year);
    }
}
