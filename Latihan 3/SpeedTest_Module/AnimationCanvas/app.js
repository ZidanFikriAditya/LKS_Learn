window.addEventListener('load', () => {
    const map = document.getElementById('map')
    const ctx = map.getContext('2d')

    map.width = 640
    map.height = 360

    var x = 20
    var y = 180

    var speedX = 2
    var condition = true

    function update() {
        
        if (x === map.width - 20) {
            condition = false
        } else if (x === 20) {
            condition = true
        }

        if (condition) {
            x += speedX
        } else {
            x -= speedX
        }

        ctx.clearRect(0, 0, map.width, map.height)
        draw(x, y)        

        requestAnimationFrame(update)
    }

    function draw (x, y) {
        ctx.beginPath()
        ctx.fillStyle = 'white'
        ctx.arc(x, y, 20, Math.PI * 2, 0)
        ctx.fill()
    }

    update()
})