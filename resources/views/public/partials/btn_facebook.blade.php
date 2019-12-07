@if($item->facebook)
    <div class="btn-item col-md-6 col-12 p-0">
        <a href="{{ $item->facebook }}" class="btn grey-btn fb-join-btn">
            <svg width="13" height="25" viewBox="0 0 13 25" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M8.31452 24V12.4987H11.5687L12 8.53523H8.31452L8.32005 6.55149C8.32005 5.51777 8.42072 4.96388 9.94255 4.96388H11.977V1H8.72228C4.81288 1 3.43687 2.92269 3.43687 6.15605V8.53567H1V12.4991H3.43687V24H8.31452Z"
                      stroke="#0E293C" stroke-width="1.5"/>
            </svg>
            <span class="text">{{ trans('general.facebook-profile') }}</span>
        </a>
    </div>
@endif                                    