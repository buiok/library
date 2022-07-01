@section('menu')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
   <div class="container">
       <a class="navbar-brand" href="{{ route('materials.index') }}">Test</a>
       <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
               aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse" id="navbarNav">
           <ul class="navbar-nav">
               <li class="nav-item">
                   <a class="nav-link active" aria-current="page" href="#">Материалы</a>
               </li>
               <li class="nav-item">
                   <a class="nav-link" href="#">Теги</a>
               </li>
               <li class="nav-item">
                   <a class="nav-link" href="#">Категории</a>
               </li>
           </ul>
       </div>
   </div>
</nav>