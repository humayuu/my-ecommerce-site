@php

$tagsEnglish = App\Models\Product::groupBy('product_tags_en')->select('product_tags_en')->get();

$tagsUrdu = App\Models\Product::groupBy('product_tags_urdu')->select('product_tags_urdu')->get();

@endphp





<div class="sidebar-widget product-tag wow fadeInUp">
    <h3 class="section-title">Product tags</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="tag-list">

            @if (session()->get('language') == 'urdu')

            @foreach ($tagsUrdu as $tagUrdu)
            <a class="item active" title="Phone" href="{{ url('product/tag/'.$tagUrdu->product_tags_urdu) }}">{{ str_replace(',',' ',$tagUrdu->product_tags_urdu) }}</a>
            @endforeach

            @else

            @foreach ($tagsEnglish as $tagEn)
            <a class="item active" title="Phone" href="{{ url('product/tag/'.$tagEn->product_tags_en) }}">{{ str_replace(',',' ', $tagEn->product_tags_en) }}</a>
            @endforeach
            @endif

        </div>
        <!-- /.tag-list -->
    </div>
    <!-- /.sidebar-widget-body -->
</div>
