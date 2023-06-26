window.addEventListener('load', () => {
    const second = document.getElementById('second')
    const centiSecond = document.getElementById('centiSecond')

    const buttonStart = document.getElementById('start')
    const buttonPause = document.getElementById('pause')
    const buttonReset = document.getElementById('reset')

    var s = 0
    var cs = 0

    var intervalTimer;
    var timerOn = false

    buttonStart.onclick = () => {
        if (!timerOn){
            intervalTimer = setInterval(timer, 10)
            timerOn = true
        }
    }

    buttonPause.onclick = () => {
        clearInterval(intervalTimer)
        timerOn = false
    }

    buttonReset.onclick = () => {
        second.innerHTML = '000'
        centiSecond.innerHTML = '00'
        s = 0
        cs = 0

        clearInterval(intervalTimer)
        timerOn = false
    }

    function timer () {
        cs += 1
        if (cs >= 60){
            s += 1
            cs = 0
        }

        centiSecond.innerHTML = (cs < 10) ? '0' + cs : cs
        second.innerHTML = (s < 10) ? '00' + s : (s >= 10 && s < 100) ? '0' + s : s
    }


})