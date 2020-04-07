@if ((Auth::user() === NULL))
								<input type="hidden" id="recap_response_{!! $id ?? '' !!}" placeholder="" name="g-recaptcha-response">
								<div class="g-recaptcha" data-sitekey="{{ config('services.google.recaptcha.key') }}"></div>
@endif