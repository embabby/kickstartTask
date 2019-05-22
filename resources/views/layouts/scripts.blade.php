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


   function createMarker(cityName) {
    var geocoder =  new google.maps.Geocoder();
    geocoder.geocode( { 'address': cityName.data[1]}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            // alert("location : " + results[0].geometry.location.lat() + " " +results[0].geometry.location.lng()); 
          
          var LatLng = new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());
          var marker = new google.maps.Marker({
          map: map,
          position: LatLng,
          title : cityName.data[0],
          icon: cityName.data[2],
          });
          }
        });

   
   }
  



  function getFeeds(){
      axios.get('https://spreadsheets.google.com/feeds/list/0Ai2EnLApq68edEVRNU0xdW9QX1BqQXhHRl9sWDNfQXc/od6/public/basic?alt=json')
            .then(function(response) {
                // console.log(response.data.feed.entry);
                $.each(response.data.feed.entry, function(i,val){
                  // console.log(val.content.$t);
                  axios.get('{{url("/filter/")}}' + '/'+ val.content.$t)
                  .then(function(response) {
                // console.log(response.data[2]);
                createMarker(response);
            })
                });
            })
            .catch(function(error) {
                console.log(error);
            });
    }

    });
   
</script>