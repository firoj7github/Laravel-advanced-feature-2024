<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">LaravelMaster</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a id="copyUrlButton" class="nav-link active" aria-current="page" href="#">Copy Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('invoice.view')}}">Invoice</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('banner.view')}}">Banner</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('favorite.page')}}">Favorite</a>
        </li>
        <li class="header-notification">
                <div class="cart-container">
                    <div class="cart-icon" onclick="toggleCart()">
                    <a href="#" id="updateCart"> <i class="fa-solid fa-cart-shopping"></i></a>
                       
                        <span class="badge" id="cart-count">
                          0
                        </span>
                    </div>
                    <div class="cart-content" id="cart-content" style="height: 200px; overflow:auto">

                        

                        <div id="invoice-section">
                         

                        </div>

                    </div>
                </div>
                </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('login.form')}}">Login</a>
        </li>
        
        
      </ul>
      
    </div>
  </div>
</nav>