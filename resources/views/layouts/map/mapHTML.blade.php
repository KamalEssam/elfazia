


<div class="map-adds">

    <input id="pac-input" class="controls" type="text"
           placeholder="ابحث عن موقع للاعلان على الخريطة">
    <div id="map" style="height: 500px; width:100%;"></div>
    <div id="infowindow-content">
        <span id="place-name"  class="title"></span><br>
        Place ID <span id="place-id"></span><br>
        <span id="place-address"></span>
    </div>
    <input  style="display:none;" value="{{ isset($lng) ? $lng : ''  }}" type="text" id="lngbox" name="lng">
    <input  style="display:none;" value="{{ isset($lat) ? $lat : ''  }}" type="text" id="latbox" name="lat">


</div>