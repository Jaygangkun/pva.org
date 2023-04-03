@extends('views.layouts.main')

@section('content')
    <main class="main">
        


        <div class="container inner-top-xs">
			  <div class="row">
			    <div class="col-md-12 general-content">
			        
			  <section>
			    <div class="row">
			      <div class="col-md-12 general-content">
			          <div style="text-align: center;padding-bottom:10px;"><span style="font-size:26px;"><br>
			<strong>{!! get_field('head_title') !!}</strong></span></div>

			<div style="text-align: center;"><span style="font-size:18px;">{!! get_field('sub_title') !!}</span><br>
			&nbsp;</div>

			        </div>
			      </div>
			</section>
			

	<div class="contain">
		<div class="row inner-top-xs">
			
		@php
		 /*$rows = get_field('fathers_card_title');
			if( $rows ) {
			    echo '<ul class="slides">';
			    foreach( $rows as $row ) {
			        $card_title = $row['card_title'];
			       echo '<li>';
			            echo wp_get_attachment_image( $image, 'full' );
			            echo wpautop( $row['caption'] );
			        echo '</li>';
			        echo "===".$card_title;
			    }
			    echo '</ul>';
			}*/
		@endphp		

		@php
		$cardLists = get_field('fathers_card_title');
		if($cardLists)
		{
			foreach( $cardLists as $cardData ) 
				{
			        $card_title = $cardData['card_title'];
			        $card_image = $cardData['card_image'];
			        
			        //echo "=>".$card_image;
			            
		@endphp
			<div class="mb-pd-btm col-md-4">
				<section>
					<div class="row">
			      		<div class="col-md-12 general-content">
			          		<div><p style="text-align: center;"><span style="font-size:18px;"><strong>{{$card_title}}</strong></span></p></div>
		          			<img src="{{$card_image}}" style="max-width:100%;max-height: 460px;">		
			        	</div>
			      	</div>
			  </section>
			</div>
		@php
				}
		}

		@endphp

			

		</div>
	</div>
	
	<section>
		<div class="row">
			<div class="col-md-12 general-content">
				<div style="max-width: 400px;">
					{!! get_field('hubspot_code') !!}
				</div>

			        </div>
			      </div>
			  </section>
			    </div>
			  </div>
			</div>

        
    </main>
@endsection
