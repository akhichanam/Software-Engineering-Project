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
        var v0 = get_filter('v0');
        var v1 = get_filter('v1');
        var systeminterface=get_filter('systeminterface');
        var memory=get_filter('memory');
        var cpucoolertype=get_filter('cpucoolertype');
        var watt=get_filter('watt');
        var cpugeneration=get_filter('cpugeneration');
        var cpusocket=get_filter('cpusocket');
        var ramspeed=get_filter('ramspeed');
        var cabinetfantype=get_filter('cabinetfantype');
        var motherboardgeneration=get_filter('motherboardgeneration');
        var ramcapacity=get_filter('ramcapacity');
        var hddformfactor=get_filter('hddformfactor');
        var graphiccardmemory=get_filter('graphiccardmemory');
        var cpuseries=get_filter('cpuseries');
        var externalhddtype=get_filter('externalhddtype');
        var internalhddcapacity=get_filter('internalhddcapacity');
        var graphiccardcapacity=get_filter('graphiccardcapacity');
        var externalhddinterface=get_filter('externalhddinterface');
        var cabinetcasetype=get_filter('cabinetcasetype');
        var powercapacity=get_filter('powercapacity');
        var rammemorytype=get_filter('rammemorytype');
        var motherboardseries=get_filter('motherboardseries');
        var smpswatt=get_filter('smpswatt');
        var ramtype=get_filter('ramtype');
        var smpscertification=get_filter('smpscertification');
        var internalhddtype=get_filter('internalhddtype');
        var externalhddcapacity=get_filter('externalhddcapacity');
        var interface=get_filter('interface');
        var categoryclear=get_filter('categoryclear');
        var graphiccardseries=get_filter('graphiccardseries');
        var motherboardchipset=get_filter('motherboardchipset');
        var ledlighting=get_filter('ledlighting');
        var motherboardcompatibility = get_filter('motherboardcompatibility');
        var twentyfivedrivebays = get_filter('twentyfivedrivebays');
        var thirthyfivedrivebays = get_filter('thirthyfivedrivebays');
        var formfactor=get_filter('formfactor');
        var graphiccompatibility = get_filter('graphiccompatibility');
        var availability= get_filter('availability');
        var featured = get_filter('featured');
        var bestseller = get_filter('bestseller');
        var storage = get_filter('storage');
                var cpusupport=get_filter('cpusupport');
        var chipset=get_filter('chipset');
        var memorysupporttype=get_filter('memorysupporttype');
        var motherboardplate=get_filter('motherboardplate');
        $.ajax({
            url:"fetch_data2.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price,maximum_price:maximum_price,categoryy:categoryy,pricee:pricee,brand:brand,subcategoryy:subcategoryy,subcategoryy1:subcategoryy1,availability:availability,motherboardchipset:motherboardchipset,memory:memory,cpucoolertype:cpucoolertype,watt:watt,cpugeneration:cpugeneration,cpusocket:cpusocket,ramspeed:ramspeed,cabinetfantype:cabinetfantype,motherboardgeneration:motherboardgeneration,ramcapacity:ramcapacity,hddformfactor:hddformfactor,graphiccardmemory:graphiccardmemory,cpuseries:cpuseries,externalhddtype:externalhddtype,internalhddcapacity:internalhddcapacity,graphiccardcapacity:graphiccardcapacity,externalhddinterface:externalhddinterface,cabinetcasetype:cabinetcasetype,powercapacity:powercapacity,rammemorytype:rammemorytype,motherboardseries:motherboardseries,smpswatt:smpswatt,ramptype:ramtype,smpscertification:smpscertification,internalhddtype:internalhddtype,externalhddcapacity:externalhddcapacity,interface:interface,graphiccardseries:graphiccardseries,ledlighting:ledlighting,motherboardcompatibility:motherboardcompatibility,thirthyfivedrivebays:thirthyfivedrivebays,twentyfivedrivebays:twentyfivedrivebays,formfactor:formfactor,graphiccompatibility:graphiccompatibility,cpusupport:cpusupport,chipset:chipset,memorysupporttype:memorysupporttype,motherboardplate:motherboardplate,lowprice:lowprice,lowprice1:lowprice1,highprice:highprice,datelow:datelow,datehigh:datehigh,az:az,za:za,v0:v0,v1:v1,featured:featured,bestseller:bestseller},
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



$(document).ready(function(){

    filter_data2();

    function filter_data2()
    {
        $('#filter_data2').html('<div id="loading" style=" " ></div>');
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
        var v0 = get_filter('v0');
        var v1 = get_filter('v1');
        var systeminterface=get_filter('systeminterface');
        var memory=get_filter('memory');
        var cpucoolertype=get_filter('cpucoolertype');
        var watt=get_filter('watt');
        var cpugeneration=get_filter('cpugeneration');
        var cpusocket=get_filter('cpusocket');
        var ramspeed=get_filter('ramspeed');
        var cabinetfantype=get_filter('cabinetfantype');
        var motherboardgeneration=get_filter('motherboardgeneration');
        var ramcapacity=get_filter('ramcapacity');
        var hddformfactor=get_filter('hddformfactor');
        var graphiccardmemory=get_filter('graphiccardmemory');
        var cpuseries=get_filter('cpuseries');
        var externalhddtype=get_filter('externalhddtype');
        var internalhddcapacity=get_filter('internalhddcapacity');
        var graphiccardcapacity=get_filter('graphiccardcapacity');
        var externalhddinterface=get_filter('externalhddinterface');
        var cabinetcasetype=get_filter('cabinetcasetype');
        var powercapacity=get_filter('powercapacity');
        var rammemorytype=get_filter('rammemorytype');
        var motherboardseries=get_filter('motherboardseries');
        var smpswatt=get_filter('smpswatt');
        var ramtype=get_filter('ramtype');
        var smpscertification=get_filter('smpscertification');
        var internalhddtype=get_filter('internalhddtype');
        var externalhddcapacity=get_filter('externalhddcapacity');
        var interface=get_filter('interface');
        var categoryclear=get_filter('categoryclear');
        var graphiccardseries=get_filter('graphiccardseries');
        var motherboardchipset=get_filter('motherboardchipset');
        var ledlighting=get_filter('ledlighting');
        var motherboardcompatibility = get_filter('motherboardcompatibility');
        var twentyfivedrivebays = get_filter('twentyfivedrivebays');
        var thirthyfivedrivebays = get_filter('thirthyfivedrivebays');
        var formfactor=get_filter('formfactor');
        var graphiccompatibility = get_filter('graphiccompatibility');
        var availability= get_filter('availability');
        var featured = get_filter('featured');
        var bestseller = get_filter('bestseller');
        var storage = get_filter('storage');
                var cpusupport=get_filter('cpusupport');
        var chipset=get_filter('chipset');
        var memorysupporttype=get_filter('memorysupporttype');
        var motherboardplate=get_filter('motherboardplate');
        $.ajax({
            url:"fetch_data3.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price,maximum_price:maximum_price,categoryy:categoryy,pricee:pricee,brand:brand,subcategoryy:subcategoryy,subcategoryy1:subcategoryy1,availability:availability,motherboardchipset:motherboardchipset,memory:memory,cpucoolertype:cpucoolertype,watt:watt,cpugeneration:cpugeneration,cpusocket:cpusocket,ramspeed:ramspeed,cabinetfantype:cabinetfantype,motherboardgeneration:motherboardgeneration,ramcapacity:ramcapacity,hddformfactor:hddformfactor,graphiccardmemory:graphiccardmemory,cpuseries:cpuseries,externalhddtype:externalhddtype,internalhddcapacity:internalhddcapacity,graphiccardcapacity:graphiccardcapacity,externalhddinterface:externalhddinterface,cabinetcasetype:cabinetcasetype,powercapacity:powercapacity,rammemorytype:rammemorytype,motherboardseries:motherboardseries,smpswatt:smpswatt,ramptype:ramtype,smpscertification:smpscertification,internalhddtype:internalhddtype,externalhddcapacity:externalhddcapacity,interface:interface,graphiccardseries:graphiccardseries,ledlighting:ledlighting,motherboardcompatibility:motherboardcompatibility,thirthyfivedrivebays:thirthyfivedrivebays,twentyfivedrivebays:twentyfivedrivebays,formfactor:formfactor,graphiccompatibility:graphiccompatibility,cpusupport:cpusupport,chipset:chipset,memorysupporttype:memorysupporttype,motherboardplate:motherboardplate,lowprice:lowprice,lowprice1:lowprice1,highprice:highprice,datelow:datelow,datehigh:datehigh,az:az,za:za,v0:v0,v1:v1,featured:featured,bestseller:bestseller},
            success:function(data){
                $('#filter_data2').html(data);
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
        filter_data2();
    });


});


$(document).ready(function(){

    filter_data1();

    function filter_data1()
    {
        $('#filter_data1').html('<div id="loading" style=" " ></div>');
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
        var v0 = get_filter('v0');
        var v1 = get_filter('v1');
        var systeminterface=get_filter('systeminterface');
        var memory=get_filter('memory');
        var cpucoolertype=get_filter('cpucoolertype');
        var watt=get_filter('watt');
        var cpugeneration=get_filter('cpugeneration');
        var cpusocket=get_filter('cpusocket');
        var ramspeed=get_filter('ramspeed');
        var cabinetfantype=get_filter('cabinetfantype');
        var motherboardgeneration=get_filter('motherboardgeneration');
        var ramcapacity=get_filter('ramcapacity');
        var hddformfactor=get_filter('hddformfactor');
        var graphiccardmemory=get_filter('graphiccardmemory');
        var cpuseries=get_filter('cpuseries');
        var externalhddtype=get_filter('externalhddtype');
        var internalhddcapacity=get_filter('internalhddcapacity');
        var graphiccardcapacity=get_filter('graphiccardcapacity');
        var externalhddinterface=get_filter('externalhddinterface');
        var cabinetcasetype=get_filter('cabinetcasetype');
        var powercapacity=get_filter('powercapacity');
        var rammemorytype=get_filter('rammemorytype');
        var motherboardseries=get_filter('motherboardseries');
        var smpswatt=get_filter('smpswatt');
        var ramtype=get_filter('ramtype');
        var smpscertification=get_filter('smpscertification');
        var internalhddtype=get_filter('internalhddtype');
        var externalhddcapacity=get_filter('externalhddcapacity');
        var interface=get_filter('interface');
        var categoryclear=get_filter('categoryclear');
        var graphiccardseries=get_filter('graphiccardseries');
        var motherboardchipset=get_filter('motherboardchipset');
        var ledlighting=get_filter('ledlighting');
        var motherboardcompatibility = get_filter('motherboardcompatibility');
        var twentyfivedrivebays = get_filter('twentyfivedrivebays');
        var thirthyfivedrivebays = get_filter('thirthyfivedrivebays');
        var formfactor=get_filter('formfactor');
        var graphiccompatibility = get_filter('graphiccompatibility');
        var availability= get_filter('availability');
        var featured = get_filter('featured');
        var bestseller = get_filter('bestseller');
        var storage = get_filter('storage');
                var cpusupport=get_filter('cpusupport');
        var chipset=get_filter('chipset');
        var memorysupporttype=get_filter('memorysupporttype');
        var motherboardplate=get_filter('motherboardplate');
        $.ajax({
            url:"fetch_data4.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price,maximum_price:maximum_price,categoryy:categoryy,pricee:pricee,brand:brand,subcategoryy:subcategoryy,subcategoryy1:subcategoryy1,availability:availability,motherboardchipset:motherboardchipset,memory:memory,cpucoolertype:cpucoolertype,watt:watt,cpugeneration:cpugeneration,cpusocket:cpusocket,ramspeed:ramspeed,cabinetfantype:cabinetfantype,motherboardgeneration:motherboardgeneration,ramcapacity:ramcapacity,hddformfactor:hddformfactor,graphiccardmemory:graphiccardmemory,cpuseries:cpuseries,externalhddtype:externalhddtype,internalhddcapacity:internalhddcapacity,graphiccardcapacity:graphiccardcapacity,externalhddinterface:externalhddinterface,cabinetcasetype:cabinetcasetype,powercapacity:powercapacity,rammemorytype:rammemorytype,motherboardseries:motherboardseries,smpswatt:smpswatt,ramptype:ramtype,smpscertification:smpscertification,internalhddtype:internalhddtype,externalhddcapacity:externalhddcapacity,interface:interface,graphiccardseries:graphiccardseries,ledlighting:ledlighting,motherboardcompatibility:motherboardcompatibility,thirthyfivedrivebays:thirthyfivedrivebays,twentyfivedrivebays:twentyfivedrivebays,formfactor:formfactor,graphiccompatibility:graphiccompatibility,cpusupport:cpusupport,chipset:chipset,memorysupporttype:memorysupporttype,motherboardplate:motherboardplate,lowprice:lowprice,lowprice1:lowprice1,highprice:highprice,datelow:datelow,datehigh:datehigh,az:az,za:za,v0:v0,v1:v1,featured:featured,bestseller:bestseller},
            success:function(data){
                $('#filter_data1').html(data);
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
        filter_data1();
    });


});




</script>
