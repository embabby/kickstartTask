<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmntNF908EMZKE57z0uaj4Bi5LBH6mXzw&libraries=places"
    async defer></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.16.2/axios.js"></script>

<script>
var map;
$(document).ready(function(){
   getFeeds();

getLocation();
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
   map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 0, lng: 0},
          zoom: 2
        });
}

  

  function getFeeds(){

    axios.get('https://spreadsheets.google.com/feeds/list/0Ai2EnLApq68edEVRNU0xdW9QX1BqQXhHRl9sWDNfQXc/od6/public/basic?alt=json')
            .then(function(response) {

                var feed = response.data.feed.entry;

                $.ajax({
                  type: "POST",
                  url: "{{route('feed.filter')}}",
                  data: {feed: feed, _token: "{{ csrf_token() }}"},
                  success: function (response){
                    $.each(response.filteredFeeds, function(i,val){
                    createMarker(val);
                    });
                  }
                });
            })
            .catch(function(error) {
                console.log(error);
            });
    }

    function createMarker(response) {
    var geocoder =  new google.maps.Geocoder();
    geocoder.geocode( { 'address': response.message}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
              // alert("location : " + results[0].geometry.location.lat() + " " +results[0].geometry.location.lng()); 
            
            var LatLng = new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());
            var marker = new google.maps.Marker({
              map: map,
              position: LatLng,
              title : response.message+' '+response.date,
              icon: response.icon,
            });
          }
        });
   }

    });
   
</script>