window.addEventListener('load', () => {
    const secondHTML = document.getElementById('second')
    const centiSecondHTML = document.getElementById('centiSecond')

    //button
    const buttonStart = document.getElementById('start')
    const buttonPause = document.getElementById('pause')
    const buttonReset = document.getElementById('reset')

    var second = 0
    var centiSecond = 0

    var intervalTime;
    var timerActive = true

    buttonStart.onclick = () => {
        if (timerActive) {
            intervalTime = setInterval(update, 10)
            timerActive = false
        }
    }

    buttonPause.onclick = () => {
        clearInterval(intervalTime)
        timerActive = true
    }

    buttonReset.onclick = () => {
        secondHTML.innerHTML = '000'
        centiSecondHTML.innerHTML = '00'
        second = 0
        centiSecond = 0
        clearInterval(intervalTime)
        timerActive = true
    }

    function update() {
        centiSecond += 1

        if(centiSecond >= 60){
            second += 1
            centiSecond = 0
        }

        secondHTML.innerHTML = (second < 10 )? '00' + second : (second >=10 && second < 100) ? '0' + second : second
        centiSecondHTML.innerHTML = (centiSecond < 10) ? '0' + centiSecond : centiSecond
    }
})