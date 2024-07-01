<div class="container">
    <div class="navbar-header">
        <div class="row">
            <div class="col-md-3">
                <a href="{{URL::to('/')}}">
                    <img src="{{url('/image/Logo-SVG.svg')}}" alt="Image"/ class="head-logo">
                </a>
            </div>
            <div class="col-md-9">
                <ul class="navbar-menu" id="mobileMenu">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><a href="{{route('faq.details')}}">FAQs</a></li>
                </ul>

                <button class="navbar-toggler" onclick="toggleMobileMenu()">
                    <span class="navbar-toggler-icon" id="mobileIcon">
                        <span class="first"></span>
                        <span class="second"></span>
                        <span class="third"></span></span>
                </button>
            </div>
            
        </div>
    </div>
</div>



<script>
  function toggleMobileMenu() {
    var mobileMenu = document.getElementById("mobileMenu");
    var menuIco = document.getElementById("mobileIcon");
    mobileMenu.classList.toggle("active"); 
    menuIco.classList.toggle("on");
  }
</script>