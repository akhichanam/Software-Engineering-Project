    <script src="js1/jquery-1.10.2.min.js"></script>
    <script src="js1/jquery-ui.js"></script>
    <script src="js1/bootstrap.min.js"></script>

    <style>
#loading
{
    text-align:center; 
    background: url('../loader.gif') no-repeat center; 
    height: 150px;
}
</style>

<script>

$(document).ready(function(){

    filter_data();

    function filter_data()
    {
        $('#filter_data').html('<div id="loading" style=" " ></div>');
        var action = 'fetch_data';
        var minimum_price = get_filter('minimum_price');
        var maximum_price = get_filter('maximum_price');
        var pricee=get_filter('pricee');
        var brand = get_filter('brand');
        var categoryy = get_filter('categoryy');
        var subcategoryy = get_filter('subcategoryy');
        var subcategoryy1 = get_filter('subcategoryy1');
        var lowprice = get_filter('lowprice');
        var lowprice1 = get_filter('lowprice1');
        var highprice = get_filter('highprice');
        var datelow = get_filter('datelow');
        var datehigh = get_filter('datehigh');
        var az = get_filter('az');
        var za = get_filter('za');
        var v1 = get_filter('v1');
        var i24 = get_filter('i24');
        var v24 = get_filter('v24');
        var v36 = get_filter('v36');
        var v48 = get_filter('v48');
        var v60 = get_filter('v60');
        var v72 = get_filter('v72');
        var v84 = get_filter('v84');
        var v96 = get_filter('v96');
        var v108 = get_filter('v108');
        var v120 = get_filter('v120');
        var v132 = get_filter('v132');
        var v144 = get_filter('v144');
        var v156 = get_filter('v156');
        var v168 = get_filter('v168');
        var v180 = get_filter('v180');
        var v192 = get_filter('v192');
        var v204 = get_filter('v204');
        var v216 = get_filter('v216');
        var v228 = get_filter('v228');
        var v240 = get_filter('v240');
        var v252 = get_filter('v252');
        var v264 = get_filter('v264');
        var v276 = get_filter('v276');
        var v288 = get_filter('v288');
        var v300 = get_filter('v300');
        var availability= get_filter('availability');
        var featured = get_filter('featured');
        var bestseller = get_filter('bestseller');
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price,maximum_price:maximum_price,categoryy:categoryy,pricee:pricee,brand:brand,subcategoryy:subcategoryy,subcategoryy1:subcategoryy1,availability:availability,motherboardplate:motherboardplate,lowprice:lowprice,lowprice1:lowprice1,highprice:highprice,datelow:datelow,datehigh:datehigh,az:az,za:za,v1:v1,i24:i24,v24:v24,v36:v36,v48:v48,v60:v60,v72:v72,v84:v84,v96:v96,v108:v108,v120:v120,v132:v132,v144:v144,v156:v156,v168:v168,v180:v180,v192:v192,v204:v204,v216:v216,v228:v228,v240:v240,v252:v252,v264:v264,v276:v276,v288:v288,v300:v300,featured:featured,bestseller:bestseller},
            success:function(data){
                $('#filter_data').html(data);
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });


});




</script>
