<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body style="padding:0px; margin:0px; background-color:#fff;font-family:'Open Sans',sans-serif,arial,helvetica,verdana">

<!-- #region Jssor Slider Begin -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jssor-slider/25.0.8/jssor.slider.min.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function ($) {


    });
</script>
<div id="jssor_ads" style="position:relative;margin:0 auto;top:0px;left:0px;width:700px;height:230px;overflow:hidden;visibility:hidden;">
    <!-- Loading Screen -->
    <div data-u="loading" class="jssorl-004-double-tail-spin" style="position:absolute;top:0px;left:0px;text-align:center;background-color:rgba(0,0,0,0.7);">
        <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="{{ asset('plugins/image-slider/double-tail-spin.svg') }}" />
    </div>
    <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:700px;height:230px;overflow:hidden;">
        @foreach($banner as $item)
            <div>
                <img src="{{ $item }}" width="700px" alt="Image">
            </div>
        @endforeach
        <a data-u="any" href="https://www.jssor.com" style="display:none">responsive slider</a>
    </div>
    <!-- Bullet Navigator -->
    <div data-u="navigator" class="jssorb052" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
        <div data-u="prototype" class="i" style="width:10px;height:10px;">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <circle class="b" cx="8000" cy="8000" r="5800"></circle>
            </svg>
        </div>
    </div>
    <!-- Arrow Navigator -->
    <div data-u="arrowleft" class="jssora053" style="width:25px;height:25px;top:0px;left:25px;" data-autocenter="2" data-scale="0.5" data-scale-left="0.5">
        <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
            <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
        </svg>
    </div>
    <div data-u="arrowright" class="jssora053" style="width:25px;height:25px;top:0px;right:25px;" data-autocenter="2" data-scale="0.5" data-scale-right="0.5">
        <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
            <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
        </svg>
    </div>
</div>
<!-- #endregion Jssor Slider End -->
</body>
</html>
