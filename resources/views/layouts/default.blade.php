<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.home.head')
    <style>
        #navbar {
            border-bottom: 2px solid;
            border-color: black;
        }
    </style>
</head>
<body>



<div class="content">
    <div class="container">
        @yield('content')
    </div>
</div>
<!-- Footer -->
<footer class="page-footer font-small cyan darken-3 mt-5">


    <!-- Copyright -->
    <div  class="footer-copyright text-center py-3">Developed By <a href="#">PLab</a>
    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->

@include('includes.home.footer')
</body>
</html>
