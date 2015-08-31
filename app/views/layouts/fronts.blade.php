@include('layouts._header')


<div class="main-container">


<div id="page" @if(strpos(Request::url(),'.html')) class="single" @endif>
<div class="content">

@yield('content')


@aside()

</div>
<!-- End .content -->
</div>
<!-- End #page -->


</div>
<!-- End #main-container -->

@include('layouts._footer')
