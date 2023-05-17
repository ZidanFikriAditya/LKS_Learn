window.addEventListener('load', () => {
    const map = document.getElementById('map')
    const ctx = map.getContext('2d')


    map.width = 400
    map.height = 320

    var condition = 'right'
    var x = 10

    function animate () {

        ctx.clearRect(0, 0, map.width, map.height)

        if (x === map.width - 20){
            condition = 'left'
        } 
        else if (x === 20) {
            condition = "right"
        }
        if (condition === 'right'){
            ball(x += 5)
        } else {
            ball(x -= 5)
        }

        requestAnimationFrame(animate)
    }

    animate()

    function ball(x){
        ctx.beginPath()
        ctx.fillStyle = 'white'
        ctx.arc(x, 160, 20,Math.PI * 2,0)
        ctx.fill()
    }
})