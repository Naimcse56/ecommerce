  
<?php
    $all_published_slider = DB::table('tbl_slider')
        ->where('publication_status', 1)
        ->get();
?>


  <section id="slider"><!--slider-->
    <div class="container">
      <div class="row"> 
                <div class="col-sm-12">
                <div id="carousel-example-generic" class="carousel slide " data-ride="carousel">
                

                <div class="col-sm-8">
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    @foreach( $all_published_slider as $v_slider )
                        <div class="item {{ $loop->first ? ' active' : '' }}" >
                            <img src="{{ $v_slider->slider_image }}"  style="width: 100%; height: 300px;" ">
                            <img src="{{asset('frontend/images/home/pricing.png')}}"  class="pricing" alt="" />
                        </div>
                    @endforeach
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                </div>

                </div>

         </div>
     </div>
 </section><!--slider-->