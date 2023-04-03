<div class="top-section">
  <header class="header">
    <div class="container">
      <div class="header-holder">
        <strong class="logo">
          <a href="{{get_home_url()}}"><img src="{{get_field('site_logo','options')['url']}}" alt="Paralyzed Veterans Of America"></a>
        </strong>
        <div class="btn-holder">
          
          <a href="{{get_field('donate_button', 'options')}}" target="_blank" class="btn btn-large secondary-background standard-width white">DONATE NOW</a>
        </div>  
      </div>
      <div class="nav-drop">
        <div class="nav-area">
          <ul class="menu list-unstyled">           
            <li><a href="{{get_home_url()}}">Home</a></li>
            @foreach(get_field('menu','options') as $navigation)
            @php $mainloop = $loop->iteration @endphp
            <li class="dropdown">
              <a href="{{$navigation['menu_item']['url']}}">{{$navigation['menu_item']['title']}}</a>
              <a href="#" class="opener"><span class="icon-plus-light1"></span> <span class="icon-minus-light1"></span></a>
              @if($navigation['sub_menu'])
              <div class="dropdown-menu">
                <div class="menu-holder">
                  @foreach($navigation['sub_menu'] as $sub_menu)
                  @php $subloop = $loop->iteration @endphp
                  <div class="menu-col">
                    @if($mainloop == 1 && $subloop == 2 || $mainloop == 3 && $subloop == 4)
                    <strong class="title">{{$sub_menu['sub_menu_head']}}</strong>
                    <ul class="dropdown-list list-unstyled">
                      @foreach($sub_menu['sub_menu_links'] as $sub_menu_item)
                      <li><a href="{{$sub_menu_item['sub_menu_link']['url']}}">{{$sub_menu_item['sub_menu_link']['title']}}</a></li>
                      @endforeach
                    </ul>
                    </div>
                    @else
                    <strong class="title">{{$sub_menu['sub_menu_head']}}</strong>
                    @if($sub_menu['sub_menu_links'])
                    <ul class="dropdown-list list-unstyled">
                      @foreach($sub_menu['sub_menu_links'] as $sub_menu_item)
                      <li><a href="{{$sub_menu_item['sub_menu_link']['url']}}">{{$sub_menu_item['sub_menu_link']['title']}}</a></li>
                      @endforeach
                    </ul>
                    @endif
                    @endif
                  @if($mainloop == 1 && $subloop == 1 || $mainloop == 3 && $subloop == 3)
                  @else
                  </div>
                  @endif
                  @endforeach
                </div>
              </div>
              @endif
            </li>
            @endforeach
          </ul>
          <div class="search-block">
            <a href="#" class="search-opener"><i class="icon-search"></i></a>
            <div class="search-drop slide">
              <form action="{{get_home_url()}}" method="_GET">
                <input type="text" placeholder="" class="text-feild" name="s">
                <button type="submit" class="submit"><i class="icon icon-chevron-left-regular"></i></button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <a href="#" class="menu-opener"><span></span></a>
  </header>
  <!-- <div class="visual-slider">
    <div class="slide">
      <div class="bg-image" style="background-image: url(images/banner1.jpg);"></div>
      <div class="caption">
        <div class="container">
          <div class="image1">
            <a href="#"><img src="images/image8.png" alt="image-description"></a>
          </div>
        </div>
      </div>
    </div>
    <div class="slide">
      <div class="bg-image" style="background-image: url(images/banner2.jpg);"></div>
      <div class="caption add">
        <div class="container"> 
          <div class="image">
            <img src="images/image9.png" alt="image-description">
            <a href="#" class="btn btn-medium secondary-background">DONATE</a>
          </div>  
        </div>
      </div>
    </div>
  </div> -->
</div>