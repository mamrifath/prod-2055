<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use App\Models\Item;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Repositories\ItemRepository;


class ItemController extends Controller
{
    // Items List

    public function index()
    {
        return view('items-list');
    }

    public function addItemNew()
    {
        return view('item-add');
    }

    //ADD NEW Item
    public function addItem(Request $request)
    {
        return (new ItemRepository)->addItem($request->all());
    }

    // GET ALL COUNTRIES
    public function getItemsList(Request $request)
    {
        return (new ItemRepository)->getItemsList($request->all());
    }

    //GET Item DETAILS
    public function getItemDetails(Request $request)
    {
        return (new ItemRepository)->getItemDetails($request->all());
    }

    //UPDATE Item DETAILS
    public function updateItemDetails(Request $request)
    {
        return (new ItemRepository)->updateItemDetails($request->all());
    }

    // DELETE Item RECORD
    public function deleteItem(Request $request)
    {
        return (new ItemRepository)->deleteItem($request->all());
    }


    public function deleteSelectedItems(Request $request)
    {
        return (new ItemRepository)->deleteSelectedItems($request->all());
    }
}
