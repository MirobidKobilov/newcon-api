<?php

namespace App\Http\Controllers;

use App\Company\Actions\CreateCompanyAction;
use App\Company\Actions\DeleteCompanyAction;
use App\Company\Actions\GetCompaniesList;
use App\Company\Actions\GetCompaniesListAction;
use App\Company\Actions\UpdateCompanyAction;
use App\Http\Requests\CreateCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    
    protected $company_list;
    protected $create_company;
    protected $update_company;
    protected $delete_company;

    public function __construct(GetCompaniesListAction $company_list , CreateCompanyAction $create_company , UpdateCompanyAction $update_company , DeleteCompanyAction $delete_company)
    {
        $this->company_list = $company_list;
        $this->create_company = $create_company;
        $this->update_company = $update_company;
        $this->delete_company = $delete_company;
    }

    public function index()
    {
        return ($this->company_list)();
    }

    public function create(CreateCompanyRequest $request)
    {
        return ($this->create_company)($request);
    }

    public function update(UpdateCompanyRequest $request , $id)
    {
        return ($this->update_company)($request , $id);
    }

    public function delete($id)
    {
        return ($this->delete_company)($id);
    }
}
