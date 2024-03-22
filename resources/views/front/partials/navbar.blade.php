<nav>
  <div class="nav nav-tabs" id="games-tab" role="tablist">
    <button class="nav-link" id="nav-all-tab" data-bs-toggle="tab" data-bs-target="#nav-all" type="button" role="tab" aria-controls="nav-all" aria-selected="true">All</button>
  @foreach($category as $catKey => $cat)
    <button class="nav-link" id="nav-{{$cat->slug}}-tab" data-bs-toggle="tab" data-bs-target="#nav-{{$cat->slug}}" type="button" role="tab" aria-controls="nav-{{$cat->slug}}" aria-selected="true">{{$cat->name}}</button>
  @endforeach
  </div>
</nav>