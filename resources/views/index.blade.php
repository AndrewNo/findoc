@extends('base')

@section('links')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="{{ asset('css/analyze.css') }}">
@endsection

@section('content')
    <h1>Welcome</h1>
    <div class="tabs">

        <input id="tab1" type="radio" name="tabs" checked>
        <label for="tab1" title="Вкладка 1">Accounts</label>

        <input id="tab2" type="radio" name="tabs">
        <label for="tab2" title="Вкладка 2">Incomes</label>

        <input id="tab3" type="radio" name="tabs">
        <label for="tab3" title="Вкладка 3">Outcomes</label>

        <input id="tab4" type="radio" name="tabs">
        <label for="tab4" title="Вкладка 4">Categories</label>

        <input id="tab5" type="radio" name="tabs">
        <label for="tab5" title="Вкладка 5">Subcategories</label>

        <input id="tab6" type="radio" name="tabs">
        <label for="tab6" title="Вкладка 6">Sellers</label>

        <input id="tab7" type="radio" name="tabs">
        <label for="tab7" title="Вкладка 7">Payers</label>

        <section id="content-tab1">
            <label for="accounts">Choose account:</label>
            <select name="account" id="accounts"></select>
        </section>
        <section id="content-tab2">
            <div id="incomes"></div>
        </section>
        <section id="content-tab3">
            <p>
                Здесь размещаете любое содержание....
            </p>
        </section>
        <section id="content-tab4">
            <p>
                Здесь размещаете любое содержание....
            </p>
        </section>
        <section id="content-tab5">
            <p>
                Здесь размещаете любое содержание....
            </p>
        </section>
        <section id="content-tab6">
            <p>
                Здесь размещаете любое содержание....
            </p>
        </section>
        <section id="content-tab7">
            <p>
                Здесь размещаете любое содержание....
            </p>
        </section>
    </div>


    {{--<div id="myPieChart"></div>

    <script type="text/javascript">
        google.charts.load('current', {packages: ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // Define the chart to be drawn.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Element');
            data.addColumn('number', 'Percentage');
            data.addRows([
                ['Nitrogen', 0.78],
                ['Oxygen', 0.21],
                ['Other', 0.01]
            ]);

            // Instantiate and draw the chart.
            var chart = new google.visualization.PieChart(document.getElementById('myPieChart'));
            chart.draw(data, null);
        }
    </script>--}}


    <script type="text/javascript">
        google.charts.load('current', {packages: ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // Define the chart to be drawn.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Element');
            data.addColumn('number', 'Percentage');
            data.addRows({!! $data !!});

            // Instantiate and draw the chart.
            var chart = new google.visualization.PieChart(document.getElementById('incomes'));
            chart.draw(data, null);
        }
    </script>
@endsection