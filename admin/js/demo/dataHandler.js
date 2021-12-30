Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';


console.log(tempArray); // tempArray dibuat di index.php 
tempArray.sort(function(a, b){return a.bulan - b.bulan});


const format_rupiah = (number)=>{
    return new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR"
    }).format(number);
};
  
const drawBarChart = (canvasnya, datanya) => {
    var myLineChart = new Chart(canvasnya, {
        type: 'bar',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
            label: "Earnings",
            lineTension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 1)",
            borderColor: "rgba(78, 115, 223, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(78, 115, 223, 1)",
            pointBorderColor: "rgba(78, 115, 223, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: datanya,
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
            }
            },
            scales: {
            xAxes: [{
                time: {
                unit: 'date'
                },
                gridLines: {
                display: false,
                drawBorder: false
                },
                ticks: {
                maxTicksLimit: 7
                }
            }],
            yAxes: [{
                ticks: {
                maxTicksLimit: 5,
                padding: 10,
                // Include a dollar sign in the ticks
                callback: function(value, index, values) {
                    return  format_rupiah(value);
                }
                },
                gridLines: {
                color: "rgb(234, 236, 244)",
                zeroLineColor: "rgb(234, 236, 244)",
                drawBorder: false,
                borderDash: [2],
                zeroLineBorderDash: [2]
                }
            }],
            },
            legend: {
            display: false
            },
            tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            intersect: false,
            mode: 'index',
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                return datasetLabel + ': ' + format_rupiah(tooltipItem.yLabel);
                }
            }
            }
        }
        });
};

//fungsi groupby
const groupBy = (array, key) => {    
    return array.reduce((result, currentValue) => {        
        if (!result[currentValue[key]]) {
            result[currentValue[key]] = [];
        }
        result[currentValue[key]].push(currentValue);        
        return result;
    }, {}); // empty object is the initial value for result object
};

//return array yg isi nya data earning setiap bulan urut dari bulan ke 1 sampai 12
const getEarningData = (earningGroup, year) => {
    if(earningGroup[year] == undefined){
        return [0,0,0,0,0,0,0,0,0,0,0,0];
    };
    earningGroup[year].sort(function(a, b){return a.bulan - b.bulan});
    var tmp = [];    
    var ketemu = false; 
    for (let iter = 1; iter <= 12; iter++) {
        for (let index = 0; index < earningGroup[year].length; index++) {            
            if(iter == earningGroup[year][index].bulan){
                ketemu = true;
                tmp.push(earningGroup[year][index].jumlah);
                break;
            }
            if(index == earningGroup[year].length -1){
                ketemu = false
            }                                                                    
        }
        if(!ketemu){
            tmp.push(0);
        }
    }     
    return tmp;
}

var tanggal = new Date();
var currentMonth = tanggal.getMonth() + 1;
var currentYear = tanggal.getFullYear();
const getEarningCurrentMonth = () => {
    
    var earning = earningGroupedByYear[currentYear];
    var answer = 0;
    earning.forEach(element => {
        if(element['bulan'] == currentMonth){
            answer =  element['jumlah'];
        }        
    });
    return answer;    
}

const earningGroupedByYear = groupBy(tempArray, 'tahun');
console.log(earningGroupedByYear)

// const test sebagai data yang dipake di cart earning overview chart-area-demo.js
var test = getEarningData(earningGroupedByYear,'2021');
console.log(test);

//gambar cart nya
drawBarChart(document.getElementById("myAreaChart"),test);


var mydp = $("#datepicker");
var dp = mydp.datepicker({
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years",
    autoclose:true, 
});

mydp.attr("placeholder", currentYear);

dp.on('change', function () {        
    var selected = $(this).val();
    test = getEarningData(earningGroupedByYear,selected);
    console.log(test);
    var coba = document.getElementById("myAreaChart");
    coba.remove();
    $(".chart-area").append('<canvas id="myAreaChart"><canvas>')
    var canvas = document.getElementById("myAreaChart");
    drawBarChart(canvas,test);
 });




document.getElementById("total-order").innerText = todayWaitingOrder;
document.getElementById("on-proses").innerText = todayOngoingOrder;
document.getElementById("earning-daily").innerText = format_rupiah(todaySumEarning);
document.getElementById("earning-monthly").innerText = format_rupiah(getEarningCurrentMonth());




