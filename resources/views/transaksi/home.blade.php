@extends('layouts.transaksi.main')

@section('content')
<header>
    <h1>AsmrProg Food Recipe App</h1>
    <div class="search">
        <input type="text" id="searchInput" placeholder="Enter an ingredient...">
        <button id="searchButton">Search</button>
    </div>
</header>

<div id="mealList" class="meal-list"></div>
<div class="modal-container">
    <button id="recipeCloseBtn" class="close-button">&times;</button>
    <div class="meal-details-content">
        <!-- Content from js will be inserted here -->
    </div>
</div>
@endsection