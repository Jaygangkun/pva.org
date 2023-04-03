@extends('views.layouts.main')

@section('content')
@while (have_posts()) @php the_post() @endphp
    <div class="visual-slider">
    		@foreach(get_field('home_slider') as $home_slider)
			<div class="slide @if($home_slider['show_button_on_slide']) add @endif">
				@if($home_slider['mobile_image']) 
				<div class="mob">
					@if($home_slider['slide_link'])
					<a href="{{$home_slider['slide_link']}}">
						<img src="{{$home_slider['mobile_image']['url']}}">
					</a>
					@else
						<img src="{{$home_slider['mobile_image']['url']}}">
					@endif
				</div>
				@endif
				<div class="@if($home_slider['mobile_image']) des @endif">
				<div class="bg-image">
					<img src="{{$home_slider['home_slide_main_image']['url']}}">
				</div>			
				<div class="caption">
					<div class="container">
						<div class="image" 
						@if($home_slider['home_slide_button_alignment'] == 'Left') style="justify-content:flex-start;"
						@elseif($home_slider['home_slide_button_alignment'] == 'Center') style="justify-content:center;"
						@elseif($home_slider['home_slide_button_alignment'] == 'Right') style="justify-content:flex-end;"
						@endif
						>
							
							@if($home_slider['slide_link'] && $home_slider['show_button_on_slide'] == '')
							<a href="{{$home_slider['slide_link']}}">
								<img src="{{$home_slider['home_slide_sub_image']['url']}}" alt="{{$home_slider['home_slide_sub_image']['alt']}}">
							</a>
							@elseif($home_slider['home_slide_sub_image'] && $home_slider['show_button_on_slide'] == '')
							<img src="{{$home_slider['home_slide_sub_image']['url']}}" alt="{{$home_slider['home_slide_sub_image']['alt']}}">

							@elseif($home_slider['home_slide_sub_image'] && $home_slider['slide_link'] != '' && $home_slider['show_button_on_slide'] == '')
							<a href="{{$home_slider['slide_link']}}">
								<img src="{{$home_slider['home_slide_sub_image']['url']}}" alt="{{$home_slider['home_slide_sub_image']['alt']}}">
							</a>

							@elseif($home_slider['show_button_on_slide'] && $home_slider['home_slide_sub_image'])
							<img src="{{$home_slider['home_slide_sub_image']['url']}}" alt="{{$home_slider['home_slide_sub_image']['alt']}}">
							<a href="{{$home_slider['home_slide_button']['url']}}" target="_blank" class="btn btn-medium secondary-background">{{$home_slider['home_slide_button']['title']}}</a>
							@endif
						</div>
					</div>
				</div>
			    </div>
			</div>
			@endforeach
		</div>
		<main class="main">
			<section class="info-section">
				<div class="container-fluid">
					{!!get_field('home_statistics')!!}
				</div>
			</section>
			<section class="topics-blocks">
				<div class="container">
					<div class="row">
						@foreach(get_field('home_featured_posts') as $featured_posts)
						<div class="col-lg-4">
							<h2>{{$featured_posts['home_featured_post_title']}}</h2>
							<div class="image">
								<a href="{{$featured_posts['home_featured_post_button_link']}}">
									<img src="{{$featured_posts['home_featured_post_image']['url']}}" alt="{{$featured_posts['home_featured_post_title']}}">
								</a>
							</div>
							<p>{!!$featured_posts['home_featured_post_description']!!}</p>
							<a href="{{$featured_posts['home_featured_post_button_link']}}" class="btn btn-medium secondary-background standard-width white">{{$featured_posts['home_featured_post_button_title']}}</a>
						</div>
						@endforeach
					</div>
				</div>
			</section>
			
			<style>
				.captcha {
					padding-bottom: 1em !important;
				}
				.wForm .captcha .oneField {
					margin: 0;
					padding: 0;
				}
				.w-forms {
					background: #b3272d;
					position: relative;
					bottom: 0;
					width: 100%;
					z-index: 1;
					display:none;
					padding: 20px 0px 30px;
				}
				.w-forms .wForm .oneField {
					padding: 2px 0px;
				}
				.w-forms .oneField input,.w-forms .required:not(.choices):not(select):not(.wfAutosuggest) {
					padding: 26px 2.5rem!important;
					margin-top: 13px !important;
					margin-right: 10px !important;
					border: 2px solid #951f25 !important;
					width: 100%;
				}
				.w-forms .oneField input#submit_button {
					padding: 13px 30px !important;
					margin-top: 10px !important;
					min-height: 0px !important;
					display: inline-block !important;
					height: 58px;
					margin-left: 7px;
					text-transform: uppercase;
					font-weight: bold;
					border-color: white !important;
					color: white;
					background-color: #b3272d;
					border: 0px;
				}
				#tfa_6-D {
					margin-top: 0px;
				}
				.w-forms h2 {
					margin-bottom: 0px !important;
					overflow: hidden;
					color: white;
				}
				.w-forms .close-informed {position:absolute;top:10px;right:10px;width:20px;height:20px;text-align: center;border-radius: 20px;background:rgb(135 25 31);font-size: 14px;}
				.w-forms .close-informed i {color:white;opacity: .6;position: relative;top:-3px;}
				
				@media  screen and (max-width: 991px) {
					.captcha {
						margin-bottom: 0px !important;
						padding-bottom: 0px !important;
						margin-top: 10px !important;
					}
					
					.w-forms .oneField input#submit_button {
						padding: 13px 30px !important;
						margin-top: 10px !important;
						min-height: 0px !important;
						display: inline-block !important;
						height: 58px;
						margin-left: 0px;
						text-transform: uppercase;
						font-weight: bold;
						border-color: white !important;
						color: white;
						background-color: #b3272d;
						border: 0px;
						margin-bottom: 8px;
					}
					
					.w-forms .oneField input, .w-form .required:not(.choices):not(select):not(.wfAutosuggest) {
						padding: 26px 2.5rem!important;
						margin-top: 13px !important;
						margin-right: 10px !important;
						display: block;
						border: 2px solid #951f25 !important;
						width: 100%;
					}
					
					#tfa_6-D {
						margin-top: 0px;
						flex-direction: column;
					} 
					
				}
				
	/* 			.captcha {
					margin-bottom: 0px !important;
					padding-bottom: 0px !important;
					margin-top: 10px !important;
				}
				
				.w-form .oneField input#submit_button {
					padding: 13px 30px !important;
					margin-top: 10px !important;
					min-height: 0px !important;
					display: inline-block !important;
					height: 58px;
					margin-left: 0px;
					text-transform: uppercase;
					font-weight: bold;
					border-color: white !important;
					color: white;
					background-color: #b3272d;
					border: 0px;
					margin-bottom: 8px;
				}
				
				.w-form {
					background: #b3272d;
					position: fixed;
					bottom: 20px;
					width: 400px;
					border-radius: 10px;
					max-width: 100%;
					right: 20px;
					display:none;
				}
				
				.w-form .oneField input, .w-form .required:not(.choices):not(select):not(.wfAutosuggest) {
					padding: 26px 2.5rem!important;
					margin-top: 13px !important;
					margin-right: 10px !important;
					display: block;
					border: 2px solid #951f25 !important;
					width: 100%;
				}
				
				#tfa_6-D {
					margin-top: 0px;
					flex-direction: column;
				} */

			</style>
		
			<link href="https://pva.tfaforms.net/dist/form-builder/5.0.0/wforms-layout.css?v=673a8c93ede84a9544a419ff58e16a570a7d3527" rel="stylesheet" type="text/css" />
					
				<link href="https://pva.tfaforms.net/uploads/themes/theme-21.css" rel="stylesheet" type="text/css" />
				<link href="https://pva.tfaforms.net/dist/form-builder/5.0.0/wforms-jsonly.css?v=673a8c93ede84a9544a419ff58e16a570a7d3527" rel="alternate stylesheet" title="This stylesheet activated by javascript" type="text/css" />
				<script type="text/javascript" src="https://pva.tfaforms.net/wForms/3.11/js/wforms.js?v=673a8c93ede84a9544a419ff58e16a570a7d3527"></script>
				<script type="text/javascript">
					wFORMS.behaviors.prefill.skip = false;
				</script>
				<script type="text/javascript" src="https://pva.tfaforms.net/wForms/3.11/js/localization-en_US.js?v=673a8c93ede84a9544a419ff58e16a570a7d3527"></script>
				
				<script type="text/javascript">
					// initialize our variables
					var captchaReady = 0;
					var wFORMSReady = 0;
				
					// when wForms is loaded call this
					var wformsReadyCallback = function () {
						// using this var to denote if wForms is loaded
						wFORMSReady = 1;
						// call our recaptcha function which is dependent on both
						// wForms and an async call to google
						// note the meat of this function wont fire until both
						// wFORMSReady = 1 and captchaReady = 1
						onloadCallback();
					}
					var gCaptchaReadyCallback = function() {
						// using this var to denote if captcha is loaded
						captchaReady = 1;
						// call our recaptcha function which is dependent on both
						// wForms and an async call to google
						// note the meat of this function wont fire until both
						// wFORMSReady = 1 and captchaReady = 1
						onloadCallback();
					};
				
					// add event listener to fire when wForms is fully loaded
					document.addEventListener("wFORMSLoaded", wformsReadyCallback);
				
					var enableSubmitButton = function() {
						var submitButton = document.getElementById('submit_button');
						var explanation = document.getElementById('disabled-explanation');
						if (submitButton != null) {
							submitButton.removeAttribute('disabled');
							if (explanation != null) {
								explanation.style.display = 'none';
							}
						}
					};
					var disableSubmitButton = function() {
						var submitButton = document.getElementById('submit_button');
						var explanation = document.getElementById('disabled-explanation');
						if (submitButton != null) {
							submitButton.disabled = true;
							if (explanation != null) {
								explanation.style.display = 'block';
							}
						}
					};
				
					// call this on both captcha async complete and wforms fully
					// initialized since we can't be sure which will complete first
					// and we need both done for this to function just check that they are
					// done to fire the functionality
					var onloadCallback = function () {
						// if our captcha is ready (async call completed)
						// and wFORMS is completely loaded then we are ready to add
						// the captcha to the page
						if (captchaReady && wFORMSReady) {
															grecaptcha.enterprise.render('g-recaptcha-render-div', {
															'sitekey': '6LfMg_EaAAAAAMhDNLMlgqDChzmtYHlx1yU2y7GI',
								'theme': 'light',
								'size': 'normal',
								'callback': 'enableSubmitButton',
								'expired-callback': 'disableSubmitButton'
							})
							var oldRecaptchaCheck = parseInt('1');
							if (oldRecaptchaCheck === -1) {
								var standardCaptcha = document.getElementById("tfa_captcha_text");
								standardCaptcha = standardCaptcha.parentNode.parentNode.parentNode;
								standardCaptcha.parentNode.removeChild(standardCaptcha);
							}
				
							if (!wFORMS.instances['paging']) {
								document.getElementById("g-recaptcha-render-div").parentNode.parentNode.parentNode.style.display = "block";
								//document.getElementById("g-recaptcha-render-div").parentNode.parentNode.parentNode.removeAttribute("hidden");
							}
							document.getElementById("g-recaptcha-render-div").getAttributeNode('id').value = 'tfa_captcha_text';
				
							var captchaError = '';
							if (captchaError == '1') {
								var errMsgText = 'The CAPTCHA was not completed successfully.';
								var errMsgDiv = document.createElement('div');
								errMsgDiv.id = "tfa_captcha_text-E";
								errMsgDiv.className = "err errMsg";
								errMsgDiv.innerText = errMsgText;
								var loc = document.querySelector('.g-captcha-error');
								loc.insertBefore(errMsgDiv, loc.childNodes[0]);
				
								/* See wFORMS.behaviors.paging.applyTo for origin of this code */
								if (wFORMS.instances['paging']) {
									var b = wFORMS.instances['paging'][0];
									var pp = base2.DOM.Element.querySelector(document, wFORMS.behaviors.paging.CAPTCHA_ERROR);
									if (pp) {
										var lastPage = 1;
										for (var i = 1; i < 100; i++) {
											if (b.behavior.isLastPageIndex(i)) {
												lastPage = i;
												break;
											}
										}
										b.jumpTo(lastPage);
									}
								}
							}
						}
					}
				</script>
				<script src='https://www.google.com/recaptcha/enterprise.js?onload=gCaptchaReadyCallback&render=explicit&hl=en_US' async
						defer></script>
								<script type="text/javascript">
					document.addEventListener("DOMContentLoaded", function() {
						var warning = document.getElementById("javascript-warning");
						if (warning != null) {
							warning.parentNode.removeChild(warning);
						}
						var oldRecaptchaCheck = parseInt('1');
						if (oldRecaptchaCheck !== -1) {
							var explanation = document.getElementById('disabled-explanation');
							var submitButton = document.getElementById('submit_button');
							if (submitButton != null) {
								submitButton.disabled = true;
								if (explanation != null) {
									explanation.style.display = 'block';
								}
							}
						}
					});
				</script>
				<script type="text/javascript">
					document.addEventListener("DOMContentLoaded", function(){
						const FORM_TIME_START = Math.floor((new Date).getTime()/1000);
						let formElement = document.getElementById("tfa_0");
						if (null === formElement) {
							formElement = document.getElementById("0");
						}
						let appendJsTimerElement = function(){
							let formTimeDiff = Math.floor((new Date).getTime()/1000) - FORM_TIME_START;
							let cumulatedTimeElement = document.getElementById("tfa_dbCumulatedTime");
							if (null !== cumulatedTimeElement) {
								let cumulatedTime = parseInt(cumulatedTimeElement.value);
								if (null !== cumulatedTime && cumulatedTime > 0) {
									formTimeDiff += cumulatedTime;
								}
							}
							let jsTimeInput = document.createElement("input");
							jsTimeInput.setAttribute("type", "hidden");
							jsTimeInput.setAttribute("value", formTimeDiff.toString());
							jsTimeInput.setAttribute("name", "tfa_dbElapsedJsTime");
							jsTimeInput.setAttribute("id", "tfa_dbElapsedJsTime");
							jsTimeInput.setAttribute("autocomplete", "off");
							if (null !== formElement) {
								formElement.appendChild(jsTimeInput);
							}
						};
						if (null !== formElement) {
							if(formElement.addEventListener){
								formElement.addEventListener('submit', appendJsTimerElement, false);
							} else if(formElement.attachEvent){
								formElement.attachEvent('onsubmit', appendJsTimerElement);
							}
						}
					});
				</script>
			
			<div class="w-forms" style="display: block;">
				<div class="wFormHeader"></div>
				<style type="text/css">
				</style>
				<div class="">
					<div class="wForm container" dir="ltr" id="12-WRPR">
						<div class="codesection" id="code-12"></div>
						<form action="https://pva.tfaforms.net/api_v2/workflow/processor" class="hintsBelow labelsAbove" id="12" method="post" name="12" role="form">
							<div class="htmlSection" id="tfa_5">
								<div class="htmlContent" id="tfa_5-HTML">
									<h2 style="text-align: left;">STAY INFORMED</h2>
								</div>
							</div>
							<div class="oneField field-container-D" id="tfa_6-D">
								<input aria-required="true" class="required" id="tfa_7" name="tfa_7" title="First Name" type="text" value="" placeholder="First Name" aria-label="First Name">
								<input aria-required="true" id="tfa_8" class="required" name="tfa_8" title="Last Name" type="text" value="" placeholder="Last Name" aria-label="Last Name">
								<input aria-required="true" class="required" id="tfa_6" name="tfa_6" title="Email" type="text" value="" placeholder="Email" aria-label="Email">
								<div id="google-captcha" style="display: none">
									<div class="captcha">
										<div class="oneField">
											<div class="g-recaptcha" id="g-recaptcha-render-div"></div>
											<div class="g-captcha-error"></div><br>
										</div>
									</div>
								</div><input class="primaryAction" data-label="Submit" id="submit_button" type="submit" value="Submit">
							</div>
							<div style="clear:both"></div><input id="tfa_dbFormId" name="tfa_dbFormId" type="hidden" value="12"><input id="tfa_dbResponseId" name="tfa_dbResponseId" type="hidden" value=""><input id="tfa_dbControl" name="tfa_dbControl" type="hidden" value="a6fbfc4ec3288be3c2fab2fd4fa7bbc1"><input id="tfa_dbWorkflowSessionUuid" name="tfa_dbWorkflowSessionUuid" type="hidden" value=""><input id="tfa_dbVersionId" name="tfa_dbVersionId" type="hidden" value="7"><input id="tfa_switchedoff" name="tfa_switchedoff" type="hidden" value="">
						</form>
					</div>
				</div>
			</div> 
			
			@if(get_field('show_recent_news'))
			<section class="news-area">
				<div class="container">
					@include('views.partials.recent-news')
				</div>
			</section>
			@endif
		</main>
@endwhile
@endsection
