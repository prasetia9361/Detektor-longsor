const clientId = 'mqttjs_' + Math.random().toString(16).substr(2, 8)
const host = 'wss://privateghofinda:Jqi8J4DAALtisiMk@privateghofinda.cloud.shiftr.io:443'
const options = {
    keepalive: 30,
    clientId: clientId,
    protocolId: 'MQTT',
    protocolVersion: 4,
    clean: true,
    reconnectPeriod: 1000,
    connectTimeout: 30 * 1000,
    will: {
      topic: 'WillMsg',
      payload: 'Connection Closed abnormally..!',
      qos: 0,
      retain: false
    },
    rejectUnauthorized: false
  }

  console.log('menghubungkan ke broker')
  const client = mqtt.connect(host, options)
  client.on('connect', function () {
    console.log('terhubung, ClientId:' + clientId)
    client.subscribe('3013042/longsor/#', { qos: 0 })
  })
  client.on('message', function (topic,payload) {
    if (topic=='3013042/longsor/level') {
      document.getElementById("level").innerHTML = payload;
    }
    if (topic=='3013042/longsor/soil') {
      document.getElementById("soil").innerHTML = payload;
      addData(chartsoil,payload.toString());
    }
    if (topic=='3013042/longsor/mpu') {
      document.getElementById("mpu").innerHTML = payload;
      addData(chartmpu,payload.toString());
    }
  })
  const ctx = document.getElementById('chartsoil');
  const cty = document.getElementById('chartmpu');
  const chartsoil = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [],
        datasets: [{
            label: 'kelembaban',
            data: [],
            backgroundColor:'rgba(60,250,188, 0.9)',
            borderColor:'rgba60,250,188, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
const chartmpu = new Chart(cty, {
  type: 'line',
  data: {
      labels: [],
      datasets: [{
          label: 'kemiringan',
          data: [],
          backgroundColor:'rgba(60,141,188,0.9)',
          borderColor:'rgba(60,141,188,1)',
          borderWidth: 1
      }]
  },
  options: {
      scales: {
          y: {
              beginAtZero: true
          }
      }
  }
});
removeData(chartsoil);
removeData(chartmpu);
  function addData(chart, data) {
    let currentdate = new Date();
    let time =currentdate.getHours()+':'+currentdate.getMinutes()+':'+currentdate.getSeconds();

    chart.data.labels.push(time);
    chart.data.datasets.forEach((dataset) => {
        dataset.data.push(data);
    });
    chart.update();
  }

function removeData(chart) {
    chart.data.labels.pop();
    chart.data.datasets.forEach((dataset) => {
        dataset.data.pop();
    });
    chart.update();
}