<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        //dd($request);
        $response = Http::get('https://pokeapi.co/api/v2/pokemon/?limit=40');
        $data = $response->json();

        $pokemons = [];

        if (Cache::has('pokemons')) {
            $pokemons = Cache::get('pokemons');
        } else {

            if ($response->successful()) {

                $data = $response->json();

                if ($data !== null) {

                    foreach ($data['results'] as $pokemon) {
                        $pokemonData = Http::get($pokemon['url']);
                        $pokemonDetails = $pokemonData->json();

                        $pokemons[] = $pokemonDetails;
                    }
                }

                Cache::put('pokemons', $pokemons,  now()->addHour());

            } else {
                return 'Error :' . $response->status();
            }
        }

        // Search
        $keyword = $request->q;
        $pokemons = array_filter($pokemons, function ($item) use ($keyword) {
            return str_contains($item['name'], $keyword);
        });

        // $pokemons = collect($pokemons)->filter(function ($item) {
        //     return str_contains(strtolower($item['name']), 'as');
        // })->values();

        // Pagination
        $currentPage = request()->get('page', 1);

        $slicedData = array_chunk($pokemons, 12);

        $currentPageData = $slicedData[$currentPage - 1] ?? [];

        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $currentPageData,
            count($pokemons),
            12,
            $currentPage, // Halaman saat ini
            ['path' => request()->url()]
        );

        //dd($pokemons);

        return view('index')->with('pokemons', $paginator);
    }
}
