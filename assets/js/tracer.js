let loadTracer = () => {
    console.log(locations);

//initialize map to lusaka
var currentPosition = new google.maps.LatLng(-15.416667, 28.283333);


var mapProp = {
  center: currentPosition,
  zoom: 3,
};

var map = new google.maps.Map(document.getElementById("map-trace"), mapProp);

for (let i = 0; i < locations.length; i++) {
    const pin = locations[i];
    const location = pin.location.split(",");

    let marker = new google.maps.Marker({
      position: { lat: parseFloat(location[0]), lng: parseFloat(location[1])},
      map,
      title: pin.label,
    });
    //add listener to open transaction details
    marker.addListener("click", () => {
         
         Transaction.viewTransaction({transactionId:pin.transactionId});
    });
  }


  }

  let filterTransactions = () => {
    let startDate = $('#startDate').val();
    let endDate = $('#endDate').val();
    let searchTerm = $('#searchTerm').val();
  
    Transaction.traceOnMap({
      startDate:startDate,
      endDate: endDate,
      searchTerm: searchTerm
    });
    
  }