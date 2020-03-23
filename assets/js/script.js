$(document).ready(() => {
  let qc = 0;
  const writeLog = msg => {
    const tm = moment().format("HH:mm:ss.SSS");
    $("#logs").prepend(`<p><code><small>${tm}</small></code> ${msg}</p>`);
  };

  const fetchPrimes = () => {
    const startTM = moment();
    qc++;
    fetch("/kubernetes-php-loadtest/prime.php")
      .then(ret => ret.json())
      .then(data => {
        const diff = (moment() - startTM) / 1000;
        qc--;
        writeLog(`<b>${data.hostname}</b> returned in <i>${diff}s</i>`);
      })
      .catch(err => {
        qc--;

        writeLog("Unable to get response");
        console.error(err);
      });
  };

  const loop = () => {
    if (qc < 5) {
      fetchPrimes();
    }
    setTimeout(() => loop(), 1000);
  };

  loop();
});
