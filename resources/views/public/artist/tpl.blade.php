<div class="d-none" id="div-tpl-artist">
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="news-item press-item">

            <div class="img-wrap">
                {{--<div class="label">${category.name}</div>--}}
                <!--<a href="${url}"><img src="${image.small_image_url}" alt="${image.name}"></a>-->
            </div>

            <div class="descr">
                <div class="date">${date}</div>
                <h4 class="news-title">{%if url%}<a target="_blank" href="${url}">${name}</a>{%else%}${name}{%/if%}</h4>
                <div class="short">${excerpt}</div>
            </div>

            <div class="date-box">
                <div class="name">${files}</div>
            </div>

        </div>
    </div>
</div>
