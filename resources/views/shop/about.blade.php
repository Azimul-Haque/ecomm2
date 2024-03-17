@extends('layouts.index')

@section('title', 'About Us')

@section('css')
  <style type="text/css">
    .padding-bottom-ten {
      padding-bottom: 10%;
    }
    .big-text {
      font-size: 16px;
      text-align: justify;
      text-justify: inter-word;
    }
  </style>
@endsection

@section('content')
  <!-- product section -->
  <section class="content-top-margin page-title page-title-small bg-gray">
      <div class="container">
          <div class="row">
              <!-- section title -->
              <div class="col-md-6 col-sm-6">
                  <span class="text-large letter-spacing-2 black-text font-weight-600 agency-title">About Us</span>
              </div>
              <!-- end section title -->
              <!-- section highlight text -->
              <div class="col-md-6 col-sm-6 text-right xs-text-left">
              </div>
              <!-- end section highlight text -->
          </div>
      </div>
  </section>

  <!-- content section -->
  <section class="padding-three">
      <div class="container">
          <div class="row">
              <div class="col-sm-12">
                  
                  <div class="row padding-bottom-ten">
                      <div class="col-md-12 text-center">
                          <h3 class="section-title">Vision & Mission</h3>
                      </div>
                      <div class="col-md-12">
                          <p class="">
                            <h2>Vision</h2>
                            AL-Mani Food Products aspires to establish itself as the epitome of global excellence in the food industry. Our vision entails achieving international acclaim for unparalleled quality and innovation.<br/><br/>
                            <h2>Mission</h2>
                            Dedicated to precision and perfection, our mission is to meticulously produce and deliver premium offerings, including cookies, rusk toast, cup cakes, puffed rice, snacks, semai, noodles, drinks, chips, spices, and culinary products. Upholding unwavering commitment to the highest standards of production, we aim to exceed customer expectations, foster innovation, and strategically contribute to the global marketplace while upholding the principles of sustainability and corporate responsibility.
                          </p>
                      </div>
                  </div>
              </div>

          </div>
      </div>
  </section>
  <!-- end content section -->
@endsection

@section('js')
<script type="text/javascript">
  $('#search-content').on('keyup', function () {
      //history.pushState(null, null, '/search');
      $("#products_list").hide();
      $("#searched_list").show();
      if($('#search-content').val().length == 0) {
        $("#products_list").show();
        $("#searched_list").hide();
      }
      $value = $(this).val().trim();;
      $.ajax({
          url: "{{ URL::to('search') }}",
          type: "GET",
          data: {'search':$value},
          success: function (data) {
            $("#searched_list").html(data);
          }
      });
  });
  function s_addToCart(id) {
      console.log('Item ID:'+id);
      $title = $('#s_addToCart'+id).data('title');
      console.log('Item Title:'+$title);
      $.ajax({
          url: "/addtocart/"+id,
          type: "GET",
          data: {},
          success: function (data) {
            var response = data;
            console.log(response);
            if(response == 'success') {
              toastr.success($title+' আপনার ব্যাগে যুক্ত করা হয়েছে।', 'সফল (SUCCESS)').css('width','400px');
            }
            var totalInBag = parseInt($("#totalInBag").text());
            if(isNaN(totalInBag)) {
              totalInBag = 0;
            } else {
              totalInBag = totalInBag;
            }
            totalInBag = totalInBag + 1;
            $("#totalInBag").text(totalInBag);
            var totalInBagMobile = parseInt($("#totalInBagMobile").text());
            if(isNaN(totalInBagMobile)) {
              totalInBagMobile = 0;
            } else {
              totalInBagMobile = totalInBagMobile;
            }
            totalInBagMobile = totalInBagMobile + 1;
            $("#totalInBagMobile").text(totalInBagMobile);
          }
      });
  }
</script>
@endsection