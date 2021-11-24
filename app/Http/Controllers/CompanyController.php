<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Repositories\CompanyRepository;


class CompanyController extends Controller
{
    // Companies List

    public function index()
    {
        return view('companies-list');
    }

    //ADD NEW Company
    public function addCompany(Request $request)
    {
        return (new CompanyRepository)->addCompany($request->all());
    }

    // GET ALL COUNTRIES
    public function getCompaniesList(Request $request)
    {
        return (new CompanyRepository)->getCompaniesList($request->all());
    }

    //GET COMPANY DETAILS
    public function getCompanyDetails(Request $request)
    {
        return (new CompanyRepository)->getCompanyDetails($request->all());
    }

    //UPDATE COMPANY DETAILS
    public function updateCompanyDetails(Request $request)
    {
        return (new CompanyRepository)->updateCompanyDetails($request->all());
    }

    // DELETE COMPANY RECORD
    public function deleteCompany(Request $request)
    {
        return (new CompanyRepository)->deleteCompany($request->all());
    }


    public function deleteSelectedCompanies(Request $request)
    {
        return (new CompanyRepository)->deleteSelectedCompanies($request->all());
    }
}
