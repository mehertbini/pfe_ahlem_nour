<?php

namespace App\Http\Controllers\distributor;

use App\Http\Controllers\Controller;
use App\Models\purchase;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class distributorController extends Controller
{
    public function index()
    {
        return view('distributor.statistic');
    }
    public function sales()
    {
        $datas = Stock::where('dist_id',Auth::id())->get();
        return view('distributor.index',compact('datas'));
    }

    public function handleDistributorAddProduct(Request $request)
    {
        $request->validate([
            'cropName' => 'required|string|max:255',
            'qte' => 'required|numeric|min:1',
            'unite' => 'required|string|max:50',
            'harvestDate' => 'required|date',
            'plantDate' => 'required|date|before:harvestDate',
            'health' => 'required|in:Good,Average,Poor',
            'amount'       => 'required|string|max:100',
        ]);
        $distId = Auth::id();

        $data = new Stock();
        $data->cropName = $request->input('cropName');
        $data->qte = $request->input('qte');
        $data->unite = $request->input('unite');
        $data->plantDate = $request->input('plantDate');
        $data->harvestDate = $request->input('harvestDate');
        $data->health = $request->input('health');
        $data->amount = $request->input('amount');
        $data->dist_id = $distId;

        // Save the data to the database
        $data->save();

        return redirect()->back()->with('success', 'Product added successfully.');
    }

    public function handleDistributorDeleteProduct($id)
    {
        Stock::find($id)->delete();

        return back()->with('success', 'Product deleted successfully.');
    }



    // Display all purchases
    public function purchase()
    {
        $stocks = Stock::where('dist_id',Auth::id())->get();
        $purchases = Purchase::latest()->get();

        foreach ($purchases as $purchase) {
            $productIds = json_decode($purchase->product_ids, true);
            $products = Stock::whereIn('id', $productIds)->get();

            $purchase->products = $products;
            $purchase->total_amount = $products->sum('amount');
        }

        return view('distributor.purchases.index', compact('purchases','stocks'));
    }

    public function storePurchase(Request $request)
    {
        $request->validate([
            'type_invoice' => 'required|in:achat,vente',
            'name_customer' => 'required|string|max:255',
            'product_ids' => 'required|array|min:1',
            'status' => 'required|in:1,0',
        ]);

        // Récupérer les produits et calculer le total
        $products = Stock::whereIn('id', $request->product_ids)->get();
        $totalAmount = $products->sum('amount');

        // Sauvegarder la facture
        Purchase::create([
            'type_invoice' => $request->type_invoice,
            'name_customer' => $request->name_customer,
            'product_ids' => json_encode($request->product_ids),
            'status' => $request->status,
        ]);

        return back()->with('success', 'Facture ajoutée avec succès. Total : ' . number_format($totalAmount, 2) . ' TND');
    }

    // Show detailed view of a purchase
    public function show(Purchase $purchase)
    {
        $productIds = json_decode($purchase->product_ids, true); // decode to array
        $products = Stock::whereIn('id', $productIds)->get();

        return view('distributor.purchases.show', compact('purchase', 'products'));
    }

    // Delete a purchase
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return back()->with('success', 'Purchase deleted successfully.');
    }

    // Print a purchase
    public function print(Purchase $purchase)
    {
        $productIds = json_decode($purchase->product_ids, true); // decode to array
        $products = Stock::whereIn('id', $productIds)->get();

        return view('distributor.purchases.print', compact('purchase', 'products'));
    }



    public function showDistributorControllerPageChangeProfile()
    {
        return view('distributor.profile');
    }

    public function showDistributorPageChangePassword()
    {
        return view('distributor.password');
    }
}
