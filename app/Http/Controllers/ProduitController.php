<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Produit;

class ProduitController extends Controller
{
    private function checkPersonnel()
    {
        if (!Auth::check() || (!Auth::user()->hasRole('admin') && !Auth::user()->hasRole('personnel'))) {
            abort(403, 'Accès réservé aux administrateurs ou aux personnels');
        }
    }

    public function create()
    {
        $this->checkPersonnel();
        return view('produits.ajouter_produit');
    }

    public function store(Request $request)
    {
        $this->checkPersonnel();
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'categorie' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric',
            'quantite' => 'required|integer',
            'date_expiration' => 'nullable|date',
            'eta' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Traitement de l'image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            
            // Enregistrement dans public/uploads/images
            $image->move(public_path('uploads/images'), $filename);

            // Ajout du chemin de l'image aux données validées
            $validatedData['image'] = 'uploads/images/' . $filename;
        }

        Produit::create($validatedData);

        return redirect()->route('produits.crud')->with('success', 'Produit ajouté avec succès.');
    }

    public function verifierStocksFaibles()
    {
        $this->checkPersonnel();
        // Seuil minimum de stock
        $seuil = 5;

        // Produits dont le stock est inférieur ou égal au seuil
        $produitsFaibles = Produit::where('quantite', '<=', $seuil)->get();

        return view('produits.stock_faible', compact('produitsFaibles'));
    }

    public function edit(Produit $produit)
    {
        $this->checkPersonnel();
        return view('produits.modifier_produit', compact('produit'));
    }

    public function update(Request $request, Produit $produit)
    {
        $this->checkPersonnel();
        
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'categorie' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric',
            'quantite' => 'required|integer',
            'date_expiration' => 'nullable|date',
            'eta' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Traitement de l'image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            
            // Enregistrement dans public/uploads/images
            $image->move(public_path('uploads/images'), $filename);

            // Suppression de l'ancienne image si elle existe
            if ($produit->image && file_exists(public_path($produit->image))) {
                unlink(public_path($produit->image));
            }

            // Ajout du chemin de l'image aux données validées
            $validatedData['image'] = 'uploads/images/' . $filename;
        }

        $produit->update($validatedData);

        return redirect()->route('produits.crud')->with('success', 'Produit modifié avec succès.');
    }

    public function index(Request $request)
    {
        $this->checkPersonnel();
        $query = Produit::query();

        if ($request->filled('recherche')) {
            $query->where('nom', 'like', '%' . $request->recherche . '%');
        }

        if ($request->filled('categorie')) {
            $query->where('categorie', $request->categorie);
        }

        if ($request->filled('eta')) {
            $query->where('eta', $request->eta);
        }

        $produits = $query->paginate(9);
        $categories = Produit::select('categorie')->distinct()->pluck('categorie');

        return view('produits.gestion_produits', compact('produits', 'categories'));
    }

    public function destroy(Produit $produit)
    {
        $this->checkPersonnel();
        
        // Suppression de l'image associée si elle existe
        if ($produit->image && file_exists(public_path($produit->image))) {
            unlink(public_path($produit->image));
        }

        $produit->delete();

        return redirect()->route('produits.crud')->with('success', 'Produit supprimé avec succès.');
    }

    public function show(Produit $produit)
    {
        $this->checkPersonnel();
        return view('produits.show', compact('produit'));
    }
}