@php 
$featured_members = $our_members_class->member_featured();
@endphp
@if($featured_members != NULL)
<section class="member hero">
	<div id="gh" class="gallery" style="background: transparent;">
		<div class="container">
			<div class="cardShuffle-container">
				<div class="cardShuffle-content">
					@foreach($featured_members as $featured_member)
						@php 
						$member_tag_line = get_field('member_tag_line', $featured_member->ID);
						$member_featured_image = get_field('member_featured_image', $featured_member->ID);
						if(!empty($member_tag_line))
						{
							$member_tag_line = ' - ' . $member_tag_line;
						}
						@endphp
						<div class="cardShuffle-single">
							<div class="cardShuffle-single-image" style="background: url({{$member_featured_image['url']}});" title="" role="img" aria-label="">
								<div class="cardShuffle-item-content">
									<h2>{{$featured_member->post_title}}{{$member_tag_line}}</h2>
									<a href="#tile{{$featured_member->ID}}" class="tileTrigger">read more</a>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			<a class="cardShuffle-left" href="javascript:void(0);"><i class="far fa-chevron-left"></i></a>
			<a class="cardShuffle-right" href="javascript:void(0);"><i class="far fa-chevron-right"></i></a>
			</div>
		</div>
	</div>
</section>
@endif