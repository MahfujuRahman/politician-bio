<?php

namespace App\Modules\Management\OurPrinciplesManagement\OurPrinciples\Controller;
use App\Modules\Management\OurPrinciplesManagement\OurPrinciples\Actions\GetAllData;
use App\Modules\Management\OurPrinciplesManagement\OurPrinciples\Actions\DestroyData;
use App\Modules\Management\OurPrinciplesManagement\OurPrinciples\Actions\GetSingleData;
use App\Modules\Management\OurPrinciplesManagement\OurPrinciples\Actions\StoreData;
use App\Modules\Management\OurPrinciplesManagement\OurPrinciples\Actions\UpdateData;
use App\Modules\Management\OurPrinciplesManagement\OurPrinciples\Actions\UpdateStatus;
use App\Modules\Management\OurPrinciplesManagement\OurPrinciples\Actions\SoftDelete;
use App\Modules\Management\OurPrinciplesManagement\OurPrinciples\Actions\RestoreData;
use App\Modules\Management\OurPrinciplesManagement\OurPrinciples\Actions\ImportData;
use App\Modules\Management\OurPrinciplesManagement\OurPrinciples\Validations\BulkActionsValidation;
use App\Modules\Management\OurPrinciplesManagement\OurPrinciples\Validations\DataStoreValidation;
use App\Modules\Management\OurPrinciplesManagement\OurPrinciples\Actions\BulkActions;
use App\Modules\Management\OurPrinciplesManagement\OurPrinciples\Actions\GetCustomData;
use App\Http\Controllers\Controller as ControllersController;


class Controller extends ControllersController
{

    public function index( ){

        $data = GetAllData::execute();
        return $data;
    }

    public function store(DataStoreValidation $request)
    {
        $data = StoreData::execute($request);
        return $data;
    }

    public function show($slug)
    {
        $data = GetSingleData::execute($slug);
        return $data;
    }

    public function update(DataStoreValidation $request, $slug)
    {
        $data = UpdateData::execute($request, $slug);
        return $data;
    }
         public function updateStatus()
    {
        $data = UpdateStatus::execute();
        return $data;
    }

    public function softDelete()
    {
        $data = SoftDelete::execute();
        return $data;
    }
    public function destroy($slug)
    {
        $data = DestroyData::execute($slug);
        return $data;
    }
    public function restore()
    {
        $data = RestoreData::execute();
        return $data;
    }
    public function import()
    {
        $data = ImportData::execute();
        return $data;
    }
    public function bulkAction(BulkActionsValidation $request)
    {
        $data = BulkActions::execute($request);
        return $data;
    }

    public function getCustomData()
    {
        $data = GetCustomData::execute();
        return $data;
    }

}