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
            <select name="account" id="accounts">
                <option value="" selected disabled>Choose account</option>
                @foreach($accounts as $account)
                    <option value="{{ $account->id }}">{{ $account->title }}</option>
                @endforeach
            </select>
            <div id="account_analyze"></div>
        </section>
        <section id="content-tab2">
            <div id="circle">Circle</div>
            <div id="line">Line</div>
            <div id="incomes_line"></div>
            <div id="incomes"></div>
        </section>
        <section id="content-tab3">
            <div id="circle_outcome">Circle</div>
            <div id="line_outcome">Line</div>
            <div id="outcomes_line"></div>
            <div id="outcomes"></div>
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




    <script type="text/javascript">
        document.getElementById('line').addEventListener('click', function () {
            document.getElementById('incomes').style.display = 'none';
            document.getElementById('incomes_line').style.display = 'block';
        });

        document.getElementById('circle').addEventListener('click', function () {
            document.getElementById('incomes').style.display = 'block';
            document.getElementById('incomes_line').style.display = 'none';
        });


        google.charts.load('current', {packages: ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // Define the chart to be drawn.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Element');
            data.addColumn('number', 'Percentage');
            data.addRows({!! $incomes !!});
            var options = {
                width: 800
            };
            // Instantiate and draw the chart.
            var chart = new google.visualization.PieChart(document.getElementById('incomes'));
            chart.draw(data, options);
        }

        google.charts.load('current', {packages: ['corechart', 'line']});
        google.charts.setOnLoadCallback(drawTrendlines);

        function drawTrendlines() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Date');

            data.addColumn('number', 'Income');

            data.addRows({!! $income_trend !!});

            var options = {
                hAxis: {
                    title: 'Date',
                },
                vAxis: {
                    title: 'Sum'
                },

                colors: ['#AB0D06', '#007329'],
                width: 800


            };

            var chart = new google.visualization.LineChart(document.getElementById('incomes_line'));
            chart.draw(data, options);
        }
    </script>
    <script type="text/javascript">

        document.getElementById('line_outcome').addEventListener('click', function () {
            document.getElementById('outcomes').style.display = 'none';
            document.getElementById('outcomes_line').style.display = 'block';
        });

        document.getElementById('circle_outcome').addEventListener('click', function () {
            document.getElementById('outcomes').style.display = 'block';
            document.getElementById('outcomes_line').style.display = 'none';
        });

        google.charts.load('current', {packages: ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // Define the chart to be drawn.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Element');
            data.addColumn('number', 'Percentage');
            data.addRows({!! $outcomes !!});

            var options = {
                width: 800
            };
            // Instantiate and draw the chart.
            var chart = new google.visualization.PieChart(document.getElementById('outcomes'));
            chart.draw(data, options);
        }

        google.charts.load('current', {packages: ['corechart', 'line']});
        google.charts.setOnLoadCallback(drawTrendlines);

        function drawTrendlines() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Date');

            data.addColumn('number', 'Outcome');

            data.addRows({!! $outcome_trend !!});

            var options = {
                hAxis: {
                    title: 'Date',
                },
                vAxis: {
                    title: 'Sum'
                },

                colors: ['#AB0D06', '#007329'],
                width: 800


            };

            var chart = new google.visualization.LineChart(document.getElementById('outcomes_line'));
            chart.draw(data, options);
        }
    </script>
    <script src="{{ asset('js/analyze.js') }}"></script>
@endsection