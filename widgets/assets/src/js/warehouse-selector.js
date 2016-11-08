$(document).ready(function() {
    getAreas();

});


function getAreas() {
    $.ajax({
        type: "GET",
        url: '/nova-poshta/default/get-areas',
        'success': function (data) {
            var areaSelector = $('#area-selector');

            $($.parseJSON(data).data).each(function(key, value) {
                areaSelector.append($("<option></option>")
                    .attr("value", value.Ref)
                    .text(value.Description));
            });

            areaSelector.change(function () {
                $('#area-selector option:selected').each(function() {

                    getSettlements(this.value);
                });

            });
        }
    });
}

function getSettlements(areaRef) {
    $.ajax({
        type: "GET",
        url: '/nova-poshta/default/get-cities',
        data: 'regionRef=' + areaRef,
        success: function (data) {

            var settlementSelector = $('#settlement-selector');
            $(settlementSelector).empty();

            $($.parseJSON(data).data).each(function(key, value) {
                settlementSelector.append($("<option></option>")
                    .attr("value", value.Ref)
                    .text(value.Description));
            });

            settlementSelector.change(function () {
                $('#settlement-selector option:selected').each(function() {
                    getSettlements(this.value);
                });

                var settlementSelector = $('#settlement');
            });


        }
    });
}


// $(document).ready(function () {
//     var areaRef = getAreaRef();
//     pastePostOfficeToField();
//
// });
//
//
// /*This function gets post office number from warehouse drop down list and paste it field*/
// function pastePostOfficeToField() {
//     var novaPoshtaWidget = $("#nova-poshta");
//
//     var postOfficeField = $('#order-delivery_post_office');
//
//     $(novaPoshtaWidget).change(function () {
//         var selectedValue = $("#useraddress-postoffice").val();
//         $(postOfficeField).val(selectedValue);
//     });
// }
//
// /*This function gets area ref from areas drop down list*/
// function getAreaRef() {
//     var novaPoshtaWidget = $("#nova-poshta");
//
//     $(novaPoshtaWidget).change(function () {
//         return $("#np-areas").val();
//     });
// }