<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokedex</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="hero h-72 relative" style="background-image: url(https://w.wallhaven.cc/full/95/wallhaven-95dzld.png);">
        <div class="absolute inset-0 bg-gradient-to-t from-white via-transparent"></div>
        <div class="hero-overlay bg-opacity-50"></div>
        <div class="hero-content text-center text-neutral-content">
            <div class="max-w-md">
                <img src="assets/img/logo.svg" alt="" class="w-80" id="logo">
            </div>
        </div>
    </div>
    <div id="tray" class="h-screen mt-20 px-40 flex flex-wrap justify-center">
        <form action="" method="GET" id="filter" class="w-full flex justify-between items-end ">
            <div class="form-control">
                <div class="input-group">
                    <input type="text" name="q" placeholder="Type here"
                        class="input input-bordered" />
                    <button type="submit" class="btn btn-square">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                  </button>
                </div>
              </div>
            
            <select class="select select-bordered w-full max-w-xs">
                <option disabled selected>Filter</option>
                <option>Lowest Number</option>
                <option>Highest Number</option>
                <option>A to Z</option>
                <option>Z to A</option>
            </select>
        </form>
        <div class="w-full grid grid-cols-4 gap-4 mt-14">
            @foreach ($pokemons as $pokemon)
                <div class="w-60 p-10 flex justify-center items-center flex-col border-2 border-slate-300 rounded-lg">
                    <img src="{{ $pokemon['sprites']['front_default'] }}" alt="">
                    <p class="text-lg">{{ $pokemon['name'] }}</p>
                </div>
            @endforeach
        </div>
        <div id="paginator" class="mt-5 py-10">
            {{ $pokemons->links('vendor.pagination') }}
        </div>
    </div>


</body>

</html>
