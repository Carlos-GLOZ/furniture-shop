@push('head')
    <link rel="stylesheet" href="{{ asset('../resources/css/filters.css') }}">
    <script src="{{ asset('../resources/js/ajax/filters.js') }}" defer></script>
@endpush

<div class="search-filters" id="main-search-filters">
    <div class="filters-left">
        {{-- Filter Icon --}}
        <div id="filter-icon">
            <i class="fa-solid fa-sliders"></i>
            <p class="filter-text">Filtros</p>
        </div>
        <!-- Filter -->
        <p class="filter-text">Nombre</p>
        <div>
            <input type="text" class="text-filter-input filter-name" placeholder="Search...">
        </div>
    </div>
    <div class="filters-right" class="filters-button-container">
        <!-- Filter -->
        <p class="filter-text">Orden</p>
        <div>
            <select type="text" class="select-filter-input filter-order-column" placeholder="Search...">
                <option value="name" selected>Nombre</option>
                <option value="price">Precio</option>
            </select>
            <button value="ASC" class="toggle-filter-input filter-order-direction"><i class="fa-solid fa-chevron-up"></i></button>
        </div>
    </div>
</div>

{{-- Define path for ajax to send request --}}
<script>const filtersPath = "{{ route('product.show') }}";</script>