

<div id="content" class="container ms-0">
  <div class="row">
    
    <div class="col-md-4">
      <div class="flex-shrink-0 p-3 bg-white" style="width: 280px;">
        <a href="/" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
        <svg class="bi me-2" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
        <span class="fs-5 fw-semibold">Categories</span>
        </a>
        {{--         @php dd(/*  $data, */  $categoriesFather, $categoriesChild);    @endphp  
        --}}
        
        <ul class="list-unstyled ps-0">

          @foreach ( $categoriesFather as $categoryFather )
          {{-- Treatment Area --}}
            @php
            $nameToBeId = str_replace(' ', '', $categoryFather['name']);
            $nameCategoryFather = substr_replace($categoryFather['name'] ,"", -8);
            @endphp
          {{-- END - Treatment Area --}}
        

          <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed text-primary" data-bs-toggle="collapse" data-bs-target="#{{ $nameToBeId }}" aria-expanded="false">
            {{ $nameCategoryFather }}
            </button>
            <div class="collapse show" id="{{ $nameToBeId }}">
              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
              @foreach($categoriesChild as $subCategory)
                @if($subCategory['parent_category_id'] == $categoryFather['category_id'])
                  
                  {{-- Treatment Area --}}

                  @php
                  $nameSubToBeId = str_replace(' ', '',  $subCategory['name']);
                  @endphp

                  {{-- END - Treatment Area --}}  

                <li class="mb-1">
                  <button class="btn btn-sm btn-toggle align-items-center rounded collapsed text-success ml-3" data-bs-toggle="collapse" data-bs-target="#{{ $nameSubToBeId }}" aria-controls="{{ $nameSubToBeId }}" aria-expanded="false">
                  {{ $subCategory['name'] }}
                  </button>
                  <div class="collapse show" id="{{ $nameSubToBeId }}">
                  <a href="#" class="link-dark rounded"></a>
                  @foreach($subCategory['products'] as $product)
                    <ul>
                      <li><a href="{{ url('/'.$product) }} " >{{ $product }}</a></li>
                    </ul>
                  @endforeach
                </li>
                @endif
              @endforeach
              </ul>
            </div>
          </li>

          @endforeach
        </ul>
      </div>
    </div>
    