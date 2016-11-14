$(document).ready(function() {
    getCity();

});


function getCity() {

    var cityInput = $('#np-city');

    //Prevents form submission by Enter key
    $(cityInput).on('keydown', function(event) {

        if(event.keyCode == 13) {
            event.preventDefault();
        }
    });

    cityInput.autocomplete({
        source: function(request, response){

            var cityInputValue = cityInput.val();

            $.ajax({
                url: "/nova-poshta/default/get-cities",
                dataType: "json",
                data:{
                    FindByString: cityInputValue
                },
                success: function(data){

                    response($.map(data, function(item) {
                        console.log(cityInputValue);

                        getWarehouse();

                        return {
                            label: item.Description,
                            value: item.Description
                        }
                    }));
                },
                error: function () {
                    console.log('City autocomplete error');
                }
            });
        },
        minLength: 4
    });
}

function getWarehouse() {

    var warehouseInput = $('#np-warehouse');

    warehouseInput.focusin(function() {

        warehouseInput.autocomplete({
            source: function(request, response){

                var warehouseInputValue = warehouseInput.val();

                if (warehouseInputValue) {
                    $.ajax({
                        url: "/nova-poshta/default/get-warehouses",
                        dataType: "json",
                        data:{
                            CityName: $('#np-city').val(),
                            street: warehouseInputValue
                        },
                        success: function(data){
                            response($.map(data, function(item){

                                return {
                                    label: item.Description,
                                    value: item.Description + '(' + item.CityDescription + ')'
                                }
                            }));
                        },
                        error: function () {
                            console.log('Warehouses autocomplete error');
                        }
                    });
                }

            },
            minLength: 1
        });
    });

}
