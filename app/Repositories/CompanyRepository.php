<?php

namespace App\Repositories;

use App\Models\Company;
use Yajra\DataTables\DataTables;

class CompanyRepository
{
    public function addCompany(array $data)
    {

        if ((!empty($data['trading_name']) &&
            !empty($data['company_name']) &&
            !empty($data['abn'])) && (!empty($data['email']) || !empty($data['phone']))) {
            $status = "Active";
        } else {
            $status = "Incomplete";
        }

        $company = new Company();

        $company->trading_name = data_get($data, 'trading_name');
        $company->company_name = data_get($data, 'company_name');
        $company->abn = data_get($data, 'abn');
        $company->address = data_get($data, 'address');
        $company->email = data_get($data, 'email');
        $company->phone = data_get($data, 'phone');
        $company->status = $status;
        $query = $company->save();

        if (!$query) {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        } else {
            return response()->json(['code' => 1, 'msg' => 'New Company has been saved successfully']);
        }
    }

    public function getCompaniesList(array $data)
    {
        $companies = Company::all();
        return DataTables::of($companies)
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
                        <button ' . trim($status, '"') . ' class="btn btn-sm btn-primary" data-id="' . $row['id'] . '" id="" onClick=alert("ELigible")>Pay</button>
                        <button class="btn btn-sm btn-primary" data-id="' . $row['id'] . '" id="editCompanyBtn">Update</button>
                        <button class="btn btn-sm btn-danger" data-id="' . $row['id'] . '" id="deleteCompanyBtn">Delete</button>
                        </div>';
            })
            ->addColumn('checkbox', function ($row) {
                return '<input type="checkbox" name="company_checkbox" data-id="' . $row['id'] . '"><label></label>';
            })

            ->rawColumns(['actions', 'checkbox'])
            ->make(true);
    }

    public function getCompanyDetails(array $data)
    {
        $company_id = $data['company_id'];
        $companyDetails = Company::find($company_id);
        return response()->json(['details' => $companyDetails]);
    }


    public function updateCompanyDetails(array $data)
    {
        if ((!empty($data['trading_name']) &&
            !empty($data['company_name']) &&
            !empty($data['abn'])) && (!empty($data['email']) || !empty($data['phone']))) {
            $status = "Active";
        } else {
            $status = "Incomplete";
        }

        $company_id = $data['cid'];
        $company = Company::find($company_id);
        $company->trading_name = $data['trading_name'];
        $company->company_name = $data['company_name'];
        $company->abn = $data['abn'];
        $company->address = $data['address'];
        $company->email = $data['email'];
        $company->phone = $data['phone'];
        $company->status = $status;
        $query = $company->save();

        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Company Details have Been updated']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }

    public function deleteCompany(array $data)
    {
        $company_id = $data['company_id'];
        $query = Company::find($company_id)->delete();

        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Company has been deleted from database']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }

    public function deleteSelectedCompanies(array $data)
    {
        $company_ids = $data['countries_ids'];
        Company::whereIn('id', $company_ids)->delete();
        return response()->json(['code' => 1, 'msg' => 'Companies have been deleted from database']);
    }
}
