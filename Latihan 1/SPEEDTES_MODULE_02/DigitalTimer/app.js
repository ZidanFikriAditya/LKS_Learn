window.addEventListener('load', function () {
    const second = document.getElementById('second')
    const centiSecond = document.getElementById('centiSecond')

    const buttonStart = document.getElementById('start')
    const pauseButton = document.getElementById('pause')
    const resetButton = document.getElementById('reset')

    var s = 0;
    var cs = 0

    var intervalTime;
    var clickedStart = true

    buttonStart.onclick = () => {
        if (clickedStart){
            intervalTime = setInterval(update, 10)
            clickedStart = false
        }
    }

    pauseButton.onclick = () => {
        clearInterval(intervalTime)
        clickedStart = true
    }

    resetButton.onclick = () => {
        second.innerHTML = '000'
        centiSecond.innerHTML = '00'

        clearInterval(intervalTime)
        clickedStart = true
    }

    function update () {
        cs += 1

        if (cs >= 60) {
            s += 1
            cs = 0
        }

        second.innerHTML = (s < 10) ? '00' + s : (s >= 10 && s < 100) ? '0' + s : s
        centiSecond.innerHTML = (cs < 10) ? '0' + cs : cs
    }
})