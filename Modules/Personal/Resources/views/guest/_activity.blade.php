					<div id="tab-activity" class="tab{{ request()->segment(2) == 'activity' ? ' opened' : '' }}">

						<div class="buttons">
							<button type="submit" class="confirm">
								<a href="{!! route('guest.place.form') !!}">
								{!! trans('personal::guest.button.add_new_place') !!}
								</a>
							</button>
						</div>

					</div>
