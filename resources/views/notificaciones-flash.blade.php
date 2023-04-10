


  @if($message = Session::get('success'))
    <div class="alert alert-success inverse alert-dismissible fade show" role="alert">
    
        <i class="icon-thumb-up alert-center"></i>


        <p>{{$message}}</p>
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  @if($message = Session::get('danger'))
  <div class="alert alert-danger inverse alert-dismissible fade show" role="alert">
    
        <i class="icon-thumb-down"></i>
        <p>{{$message}}</p>
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  @if($message = Session::get('warning'))
  <div class="alert alert-warning inverse alert-dismissible fade show" role="alert">
    
        <i class="icon-bell"></i>

        <p>{{$message}}</p>
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  @if($message = Session::get('info'))
  <div class="alert alert-info inverse alert-dismissible fade show" role="alert">
    
        <i class="icon-help-alt"></i>
    
    
        <p>{{$message}}</p>
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

 





<script src="{{asset('assets/js/height-equal.js')}}"></script>

<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
    }, 5000);
    
    
</script>
