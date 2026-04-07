<?php

namespace App\Services;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Support\Arr;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sum;

class SupplierService{
    public function __construct()
    {
        //
    }
    public function createSupplier(array $data,User $user){
        $data['created_by'] = $user->id;
        return Supplier::create($data);
    }
    public function updateSupplier(array $data,Supplier $supplier){
        return $supplier->update($data);
    }
    public function deleteSupplier(Supplier $supplier){
        return $supplier->delete();
    }
}