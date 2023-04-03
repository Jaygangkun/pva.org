@php 
$member_sections = $our_members_class->member_sections();
$data_section = 0;
@endphp
@if(!empty($member_sections))
    <section class="default">
        <div id="content" class="row">
            @foreach($member_sections as $member_section)
                @php 
                    $data_id = 1;
                    $data_row = 0;
                @endphp
                <div class="mg-space-init container vert">
                    <style scoped="">
                        .mg-row{margin-bottom:25px}
                    </style>
                    <style scoped="">
                        .mg-row{margin-bottom:25px}
                    </style>
                    <h2> {{$member_section->category_name}} </h2>
                    @if(!empty($member_section->category_description))
                        <p> {!! $member_section->category_description !!} </p>
                    @endif
                    <div class="mg-rows row row-flex" data-cols="4">
                        @foreach($member_section->members as $member)
                            @php 
                                $member_tag_line = get_field('member_tag_line', $member->ID);
                                $member_rank = get_field('member_rank', $member->ID);
                                if(!empty($member_tag_line))
                                {
                                    $member_tag_line = ' - ' . $member_tag_line;
                                }
                                $featured_img_url = get_stylesheet_directory_uri() . '/public/images/member-default-thumbnail.jpg';
                                if ( has_post_thumbnail($member->ID))
                                {
                                    $featured_img_url = get_the_post_thumbnail_url($member->ID, array(600,600));
                                }
                            @endphp
                            <div class="xs-6 sm-4 lg-3 mg-row" data-id="{{$data_id}}" data-section="{{$data_section}}" data-row="{{$data_row}}">
                                <div class="tile-card mg-trigger" id="tile{{$member->ID}}"> <img class="img-responsive" src="{{$featured_img_url}}" alt="" title="">
                                    <div class="tile-card-content"> <span class="tile-card-title">{{$member->post_title}}{{$member_tag_line}}</span> <span class="tile-card-name">{{$member_rank}} </span> </div>
                                </div>
                            </div>
                            @php 
                                if($data_id % 4 == 0)
                                {
                                    $data_row++;
                                }
                                $data_id++;
                            @endphp
                        @endforeach
                    </div>
                    <div class="mg-targets row">
                        @php 
                            $data_id = 1;
                        @endphp
                        @foreach($member_section->members as $member)
                            @php 
                                $member_tag_line = get_field('member_tag_line', $member->ID);
                                if(!empty($member_tag_line))
                                {
                                    $member_tag_line = ' - ' . $member_tag_line;
                                }
                                $featured_img_url = get_stylesheet_directory_uri() . '/public/images/member-default-thumbnail.jpg';
                                if ( has_post_thumbnail($member->ID))
                                {
                                    $featured_img_url = get_the_post_thumbnail_url($member->ID, array(600,600));
                                }
                            @endphp
                            <div class="mg-target" data-id="{{$data_id}}" data-section="{{$data_section}}">
                                <div class="container">
                                    <div class="row row-flex">
                                        <div class="xs-5 sm-5 lg-5"> <img class="img-responsive" src="{{$featured_img_url}}" alt="" title=""> </div>
                                        <div class="xs-7 sm-7 lg-7 ">
                                            <div class="tile-content">
                                                <h2>{{$member->post_title}}{{$member_tag_line}}</h2>
                                                {!! apply_filters( 'the_content', $member->post_content) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php 
                                $data_id++;
                            @endphp
                        @endforeach
                    </div>
                </div>
                @php 
                $data_section++;
                @endphp
            @endforeach
        </div>
    </section>
@endif