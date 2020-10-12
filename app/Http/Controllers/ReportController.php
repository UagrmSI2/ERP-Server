<?php

namespace App\Http\Controllers;

use App\DepositProduct;
use App\Product;
use App\PurchaseBills;
use App\PurchaseDetail;
use App\PurchaseNote;
use App\SaleBills;
use App\SaleNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function reportPurchaseBills(Request $request)
    {
        $purchaseBill = PurchaseBills::all();
        return response()->json($purchaseBill);
    }

    public function reportSaleBills()
    {
        $saleBills = SaleBills::all();
        return response()->json($saleBills);
    }

    public function reportPurchaseNotes(){
        $notes = DB::table('purchase_notes')
                ->join('providers', 'purchase_notes.provider_id', 'providers.id')
                ->select(
                    'purchase_notes.id',
                    'providers.empresa',
                    'purchase_notes.fecha',
                    'purchase_notes.monto_total'
                )->get();
        return response()->json($notes, 200);
    }

    public function reportSaleNotes(){
        $notes = DB::table('sale_notes')
                ->join('clients', 'sale_notes.client_id', 'clients.id')
                ->select(
                    'sale_notes.id',
                    'clients.nombre',
                    'clients.apellido',
                    'sale_notes.fecha',
                    'sale_notes.monto_total'
                )->get();
        return response()->json($notes, 200);
    }

    public function reportSaleMes(Request $request){
        $fechaIni = $request->fechaIni;
        $fechaFin = $request->fechaFin;

        $notes = DB::table('sale_notes')
                ->whereBetween('fecha', [$fechaIni, $fechaFin])
                ->get();

        return response()->json($notes, 200);
    }   

    public function reportPurchaseMes(Request $request){
        $fechaIni = $request->fechaIni;
        $fechaFin = $request->fechaFin;

        $notes = DB::table('purchase_notes')
                ->whereBetween('fecha', [$fechaIni, $fechaFin])
                ->get();

        return response()->json($notes, 200);
    }   

}
