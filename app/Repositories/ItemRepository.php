<?php

namespace App\Repositories;

use App\Models\Item;
use Yajra\DataTables\DataTables;

class ItemRepository
{
    public function addItem(array $data)
    {

        $item = new Item();

        $item->name = data_get($data, 'name');
        $item->qty = data_get($data, 'qty');
        $item->brand = data_get($data, 'brand');
        $item->selling_price = data_get($data, 'selling_price');
        $item->buying_price = data_get($data, 'buying_price');
        $item->profit_margin = data_get($data, 'profit_margin');
        $item->warranty = data_get($data, 'warranty');
        $item->status = data_get($data, 'status');
        $item->expiry_date = data_get($data, 'expiry_date');
        $query = $item->save();

        if (!$query) {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        } else {
            return response()->json(['code' => 1, 'msg' => 'New Item has been saved successfully']);
        }
    }

    public function getItemsList(array $data)
    {
        $Items = Item::all();
        return DataTables::of($Items)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                if ($row['status'] == "Active") {
                    $status = "";
                } else {
                    $status = "disabled";
                }
                $str = '"World"';
                // echo trim($str, '"');
                return '<div class="btn-group">
                        <button class="btn btn-sm btn-primary" data-id="' . $row['id'] . '" id="editCompanyBtn">Update Qty</button>
                        <button class="btn btn-sm btn-danger" data-id="' . $row['id'] . '" id="deleteCompanyBtn">Delete</button>
                        </div>';
            })
            ->addColumn('checkbox', function ($row) {
                return '<input type="checkbox" name="company_checkbox" data-id="' . $row['id'] . '"><label></label>';
            })

            ->rawColumns(['actions', 'checkbox'])
            ->make(true);
    }

    public function getItemDetails(array $data)
    {
        $id = $data['id'];
        $ItemDetails = Item::find($id);
        return response()->json(['details' => $ItemDetails]);
    }


    public function updateItemDetails(array $data)
    {
        // if ((!empty($data['trading_name']) &&
        //     !empty($data['company_name']) &&
        //     !empty($data['abn'])) && (!empty($data['email']) || !empty($data['phone']))) {
        //     $status = "Active";
        // } else {
        //     $status = "Incomplete";
        // }

        $item_id = $data['id'];
        $item = Item::find($item_id);
        $item->name = data_get($data, 'name');
        $item->qty = data_get($data, 'qty');
        $item->brand = data_get($data, 'brand');
        $item->selling_price = data_get($data, 'selling_price');
        $item->buying_price = data_get($data, 'buying_price');
        $item->profit_margin = data_get($data, 'profit_margin');
        $item->warranty = data_get($data, 'warranty');
        $item->status = data_get($data, 'status');
        $item->expiry_date = data_get($data, 'expiry_date');
        $query = $item->save();

        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Item Details have Been updated']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }

    public function deleteItem(array $data)
    {
        $item_id = $data['id'];
        $query = Item::find($item_id)->delete();

        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Item has been deleted from database']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }

    public function deleteSelectedItems(array $data)
    {
        $item_id = $data['id'];
        Item::whereIn('id', $item_id)->delete();
        return response()->json(['code' => 1, 'msg' => 'Items have been deleted from database']);
    }
}
