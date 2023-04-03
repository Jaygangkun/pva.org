<div class="news-area">
    <div class="sidebar-widget publications-sidebar">
        @if(get_field('show_download_app_top'))
        <section class="ePub primary-background">
          {!!get_field('download_epub_app','options','options')!!}
        </section>
        @endif
         @if(get_field('show_sidebar_heading_and_content'))
        <div style="background: rgb(14, 102, 150); padding: 12px; color: white;">
            <h2 style="color: white; text-align: center;">
                {!!get_field('publications_sidebar_head','options')!!}
            </h2>
            <div style="text-align: center;">
                {!!get_field('publications_sidebar_description','options')!!}
            </div>
        </div>
        @endif
        @if(get_field('show_latest_publications'))  
        <div class="publications">
            @foreach(get_field('latest_publications','options') as $publications)
            <div class="publication">
                <div class="publication-image">
                    <a href="{{$publications['publication_image_link']}}" target="_blank" title="{{$publications['publication_image_title']}}">
                        <img src="{{$publications['publication_image']['url']}}">
                    </a>
                    <div class="publication-text">
                        <a href="{{$publications['publication_link']}}" target="_blank">
                            <p>{{$publications['publication_description']}}</p>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        @if(get_field('show_download_app_bottom'))
        <section class="ePub primary-background mg-tp-40">
          {!!get_field('download_epub_app','options')!!}
        </section>
        @endif
    </div>
</div>