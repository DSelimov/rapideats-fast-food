@extends('layouts.app')

@section('content')

    <div class="carousel-container">
        <!-- First Image -->
        <div class="carousel-item active">
            <img src="https://png.pngtree.com/thumb_back/fw800/background/20231007/pngtree-pizza-preparations-exploring-the-art-of-cooking-on-a-dark-textured-image_13606857.png" alt="Pizza Preparation">
        </div>

        <!-- Second Image -->
        <div class="carousel-item">
            <img src="https://static.vecteezy.com/system/resources/previews/026/973/539/non_2x/woman-is-cooking-italian-pizza-free-photo.jpg" alt="Cooking Pizza">
        </div>

        <!-- Third Image -->
        <div class="carousel-item">
            <img src="https://c8.alamy.com/comp/2C1A20G/banner-raw-uncooked-ingredients-for-cooking-pasta-cooking-background-food-banner-2C1A20G.jpg" alt="Pizza Image">
        </div>

        <!-- Carousel Controls (Left and Right Arrows) -->
        <button class="prev" onclick="moveCarousel(-1)">&#8249;</button>
        <button class="next" onclick="moveCarousel(1)">&#8250;</button>
    </div>
    <style>
        .carousel-container {
            position: relative;
            width: 100%;
            height: 650px; /* Set a fixed height for the carousel */
            overflow: hidden;
        }

        .carousel-item {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.7s ease-in-out;
        }

        .carousel-item.active {
            opacity: 1;
        }

        .carousel-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Arrow buttons */
        .prev, .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            font-size: 20px;
            cursor: pointer;
            z-index: 10;
        }

        .prev {
            left: 20px;
        }

        .next {
            right: 20px;
        }
    </style>

    <script>
        let currentIndex = 0;
        const items = document.querySelectorAll('.carousel-item');

        // Function to move the carousel
        function moveCarousel(direction) {
            items[currentIndex].classList.remove('active');
            currentIndex = (currentIndex + direction + items.length) % items.length;
            items[currentIndex].classList.add('active');
        }

        setInterval(() => {
            moveCarousel(1);
        }, 3000);
    </script>

    <div class="container mx-auto px-4 py-12">
        <h2 class="text-center text-4xl font-bold mb-20">Explore Our Delicious Menu!</h2>

        <div class="flex justify-between mb-8">
            <!-- Search Form -->
            <form action="{{ route('pizzas') }}" method="GET" class="flex items-center space-x-2">
                <input type="text" name="search" placeholder="Search for pizzas..."
                       class="border rounded-lg p-2 w-64 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ request()->input('search') }}">
                <button type="submit" class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold py-3 px-6 rounded-lg shadow-lg hover:from-blue-600 hover:to-indigo-700 hover:shadow-xl transition-transform transform hover:scale-105 duration-300 ease-in-out">
                    Search
                </button>
            </form>

            <!-- Sort Form -->
            <form action="{{ route('pizzas') }}" method="GET" class="flex items-center space-x-2">
                <label for="sort_by" class="mr-2">Sort by:</label>
                <select name="sort_by" id="sort_by" onchange="this.form.submit()">
                    <option value="name" {{ request()->input('sort_by') == 'name' ? 'selected' : '' }}>Name</option>
                    <option value="price" {{ request()->input('sort_by') == 'price' ? 'selected' : '' }}>Price</option>
                </select>
                <select name="sort_order" id="sort_order" onchange="this.form.submit()">
                    <option value="asc" {{ request()->input('sort_order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                    <option value="desc" {{ request()->input('sort_order') == 'desc' ? 'selected' : '' }}>Descending</option>
                </select>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($foodItems as $item)
                <div class="bg-white rounded-b-2xl border-4 shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:scale-105">
                    <a href="{{ route('pizzas.show', $item->id) }}">
                        <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-48 object-cover" alt="{{ $item->name }}">
                    </a>
                    <div class="p-4">
                        <h5 class="text-lg font-semibold">
                            <a href="{{ route('pizzas.show', $item->id) }}" class="hover:underline">{{ $item->name }}</a>
                        </h5>
                        <p class="text-gray-700 mt-1">{{ $item->description }}</p>
                        <p class="text-blue-600 font-semibold mt-2"><strong>Price: {{ $item->price }} lv</strong></p>
                        <form action="{{ route('add.to.cart', $item->id) }}" method="POST" class="mt-4 add-to-cart-form">
                            @csrf
                            <button type="submit" class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold py-3 px-6 rounded-lg shadow-lg hover:from-blue-600 hover:to-indigo-700 hover:shadow-xl transition-transform transform hover:scale-105 duration-300 ease-in-out">
                                Add to Cart
                            </button>
                        </form>
                        <div class="add-to-cart-message text-green-500 mt-2 hidden">Pizza added to cart!</div>
                        <a href="{{ route('pizzas.show', $item->id) }}" class="mt-2 inline-block bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold py-3 px-6 rounded-lg shadow-lg hover:from-blue-600 hover:to-indigo-700 hover:shadow-xl transition-transform transform hover:scale-105 duration-300 ease-in-out">
                            Read More
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
