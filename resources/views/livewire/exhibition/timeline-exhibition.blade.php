<div id="amcharts-timeline" class="h-screen w-full"></div>

<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/plugins/bullets.js"></script>
<script src="https://cdn.amcharts.com/lib/4/plugins/timeline.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<script>
document.addEventListener('livewire:load', function () {
    am4core.ready(function() {
        am4core.useTheme(am4themes_animated);

        var chart = am4core.create("amcharts-timeline", am4plugins_timeline.SerpentineChart);
        chart.curveContainer.padding(50, 20, 50, 20);
        chart.levelCount = 4;
        chart.yAxisRadius = am4core.percent(25);
        chart.yAxisInnerRadius = am4core.percent(-25);
        chart.maskBullets = false;
        chart.dataSource.url = "{{ route('api.exhibition.timeline') }}"
        chart.dataSource.parser = new am4core.JSONParser();
        chart.dateFormatter.dateFormat = "yyyy-MM-dd";
        chart.dateFormatter.inputDateFormat = "yyyy-MM-dd";
        chart.fontSize = 11;

        var colorSet = new am4core.ColorSet();
        colorSet.saturation = 0.5;

        var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "museum_name";
        categoryAxis.renderer.grid.template.disabled = true;
        categoryAxis.renderer.labels.template.paddingRight = 25;
        categoryAxis.renderer.minGridDistance = 10;
        categoryAxis.renderer.innerRadius = -60;
        categoryAxis.renderer.radius = 60;

        var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
        dateAxis.dataFields.valueY = "began_at";
        dateAxis.renderer.minGridDistance = 70;
        dateAxis.baseInterval = { count: 1, timeUnit: "month" };
        dateAxis.renderer.tooltipLocation = 0;
        dateAxis.startLocation = -0.5;
        dateAxis.renderer.line.strokeDasharray = "1,4";
        dateAxis.renderer.line.strokeOpacity = 0.6;
        dateAxis.tooltip.background.fillOpacity = 0.2;
        dateAxis.tooltip.background.cornerRadius = 5;
        dateAxis.tooltip.label.fill = new am4core.InterfaceColorSet().getFor("alternativeBackground");
        dateAxis.tooltip.label.paddingTop = 7;

        var labelTemplate = dateAxis.renderer.labels.template;
        labelTemplate.verticalCenter = "middle";
        labelTemplate.fillOpacity = 0.7;
        labelTemplate.background.fill = new am4core.InterfaceColorSet().getFor("background");
        labelTemplate.background.fillOpacity = 1;
        labelTemplate.padding(7, 7, 7, 7);

        var series = chart.series.push(new am4plugins_timeline.CurveColumnSeries());
        series.columns.template.height = am4core.percent(20);
        series.columns.template.tooltipText = "{title}: [bold]{began_at}[/] - [bold]{ended_at}[/]";

        series.dataFields.openDateX = "began_at";
        series.dataFields.dateX = "ended_at";
        series.dataFields.categoryY = "museum_slug";
        series.columns.template.propertyFields.fill = "color"; // get color from data
        series.columns.template.propertyFields.stroke = "color";
        series.columns.template.strokeOpacity = 0;

        var bullet = series.bullets.push(new am4charts.CircleBullet());
        bullet.circle.radius = 3;
        bullet.circle.strokeOpacity = 0;
        bullet.propertyFields.fill = "color";
        bullet.locationX = 0;

        var bullet2 = series.bullets.push(new am4charts.CircleBullet());
        bullet2.circle.radius = 3;
        bullet2.circle.strokeOpacity = 0;
        bullet2.propertyFields.fill = "color";
        bullet2.locationX = 1;

        var imageBullet1 = series.bullets.push(new am4plugins_bullets.PinBullet());
        imageBullet1.disabled = true;
        imageBullet1.propertyFields.disabled = "disabled1";
        imageBullet1.locationX = 1;
        imageBullet1.circle.radius = 20;
        imageBullet1.propertyFields.stroke = "color";
        imageBullet1.background.propertyFields.fill = "color";
        imageBullet1.image = new am4core.Image();
        imageBullet1.image.propertyFields.href = "image1";

        var imageBullet2 = series.bullets.push(new am4plugins_bullets.PinBullet());
        imageBullet2.disabled = true;
        imageBullet2.propertyFields.disabled = "disabled2";
        imageBullet2.locationX = 0;
        imageBullet2.circle.radius = 20;
        imageBullet2.propertyFields.stroke = "color";
        imageBullet2.background.propertyFields.fill = "color";
        imageBullet2.image = new am4core.Image();
        imageBullet2.image.propertyFields.href = "image2";


        var eventSeries = chart.series.push(new am4plugins_timeline.CurveLineSeries());
        eventSeries.dataFields.dateX = "began_at";
        eventSeries.dataFields.categoryY = "museum_slug";
        eventSeries.strokeOpacity = 0;

        var flagBullet = eventSeries.bullets.push(new am4plugins_bullets.FlagBullet())
        flagBullet.label.propertyFields.text = "title";
        flagBullet.locationX = 0;
        flagBullet.tooltipText = `{museum_name} :
            {title}`;

        chart.scrollbarX = new am4core.Scrollbar();
        chart.scrollbarX.align = "center"
        chart.scrollbarX.width = am4core.percent(85);

        var cursor = new am4plugins_timeline.CurveCursor();
        chart.cursor = cursor;
        cursor.xAxis = dateAxis;
        cursor.yAxis = categoryAxis;
        cursor.lineY.disabled = true;
        cursor.lineX.strokeDasharray = "1,4";
        cursor.lineX.strokeOpacity = 1;

        dateAxis.renderer.tooltipLocation2 = 0;
        categoryAxis.cursorTooltipEnabled = false;
    }); // end am4core.ready()
});
</script>
