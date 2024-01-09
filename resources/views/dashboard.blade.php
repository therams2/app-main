<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
<br><br>


<center>
<img src="img/logomichoacan.png" height="400px;">
</center>



{{-- <div class="container-fluid">
<div class="row"> --}}
            {{-- <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-text card-header-rose">
                  <div class="card-text">
                    <h4 class="card-title"> </h4>
                    <p class="card-category"> </p>
                  </div>
                </div>
                <div class="card-body text-justify"> --}}
              {{--   <div class="row">
                    <div class="col-sm-2"></div>
                  <div class="col-sm-8"><img src="img/logomichoacan.png" class="img-thumbnail"></div>
                   <div class="col-sm-2"></div>
                  {{-- <div class="col-sm-6"> --}}

                  {{--  <h5>
                        
 
 </h5>
                   </div>
                </div>
                <br><br>
                
                </div> --}}
        {{--       </div>
            </div>
          </div>

</div> --}}
 {{-- </div>
</div> --}}
</x-app-layout>


<script>
document.addEventListener('livewire:load', function () {
$("#nav-item-dashboard").addClass("active");
 })
</script>
