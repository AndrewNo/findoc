require('./bootstrap');

document.getElementById('accounts').addEventListener('change', function () {

    axios.post('/analyze_account', {
        account_id: this.value
    })
        .then(function (response) {

            google.charts.load('current', {packages: ['corechart', 'bar']});
            google.charts.setOnLoadCallback(drawMultSeries);

            function drawMultSeries() {
                var data = new google.visualization.DataTable();
                data.addColumn('string', '');
                data.addColumn('number', '');
                data.addColumn({type:'string', role:'style'});


                data.addRows(response.data);

                var options = {
                    title: 'Accounts',
                    hAxis: {

                        viewWindow: {
                            min: [7, 30, 0],
                            max: [17, 30, 0]
                        }
                    },
                    vAxis: {
                        title: 'Sum'
                    },
                    legend: { position: "none" }
                };

                var chart = new google.visualization.ColumnChart(
                    document.getElementById('account_analyze'));

                chart.draw(data, options);
            }


        })
        .catch(function (error) {
            console.log(error);
        });

});