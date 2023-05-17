window.addEventListener('load', function () {
    const home = document.getElementById('home')
    const gameWrapper = document.getElementById('game')
    const canvas = document.getElementById('map')
    const pause = document.getElementById('pause')
    const ctx = canvas.getContext('2d')


    canvas.width = 500
    canvas.height = 960

    var animationFrame;

    pause.onclick = function () {
        cancelAnimationFrame(animationFrame)
    }

    const inputUsername = document.getElementById('username')
    const playButton = document.getElementById('buttonPlay')

    gameWrapper.style.display = 'none'
    // home.style.display = 'none'

    inputUsername.value = localStorage.getItem('username')


    playButton.onclick = () => {
        console.log(!inputUsername.value)
        if (!localStorage.getItem('username') && !inputUsername.value){
            alert('Please set your username!')
        } else {
            localStorage.setItem('username', inputUsername.value)
            gameWrapper.style.display = 'block'
            home.style.display = 'none'
            animate()
        }
    }

    class Background {
        constructor(game) {
            this.game = game
            this.width = 125
            this.image = new Image()
            this.image.src = 'assets/inject.png'
            this.image.style.rotate = '90deg'
            this.score = 0
        }

        draw (context) {
            context.beginPath()
            context.strokeStyle = 'gray'
            context.strokeRect(125, -1, this.width, this.game.height)

            context.beginPath()
            context.strokeStyle = 'gray'
            context.strokeRect(250, -1, this.width, this.game.height)

            context.beginPath()
            context.fillStyle = 'red'
            context.fillRect(0, this.game.height - 180, this.width, 180)

            context.beginPath()
            context.fillStyle = 'skyblue'
            context.fillRect(125, this.game.height - 180, this.width, 180)

            context.beginPath()
            context.fillStyle = 'yellow'
            context.fillRect(250, this.game.height - 180, this.width, 180)

            context.beginPath()
            context.fillStyle = 'green'
            context.fillRect(375    , this.game.height - 180, this.width, 180)

            context.beginPath()
            context.fillStyle = 'gray'
            context.fillRect(0, this.game.height - 190, this.game.width, 10)

            // Danger Zone
            context.beginPath()
            context.fillStyle = 'rgba(255, 0 ,0, 0.2)'
            context.fillRect(0, this.game.height - 400, this.game.width, 210)

            // Score
            context.beginPath()
            context.fillStyle = 'white'
            context.font = '14px Arial'
            context.fillText('Score : ' + this.score, 10, 20)

            drawImage(this.image, 0, this.game.height-150, 125, 125)
            drawImage(this.image, 125, this.game.height-150, 125, 125)
            drawImage(this.image, 250, this.game.height-150, 125, 125)
            drawImage(this.image, 375, this.game.height-150, 125, 125)
        }
    }

    class Handler {
        constructor(game) {
            this.game = game

            window.addEventListener('keydown', e => {
                if ((e.key === 'd' || e.key === 'f' || e.key === 'j' || e.key === 'k' || e.key === 'Escape') && this.game.keys.indexOf(e.key) === -1)
                {
                    this.game.keys.push(e.key)
                }
            })

            window.addEventListener('keyup', e => {
                if (this.game.keys.indexOf(e.key) > -1)
                {
                    this.game.keys.splice(e.key, 1)
                }
            })
        }
    }

    class Virus {
        constructor(game) {
            this.game = game
            this.image = new Image()
            this.speed = 10
            this.randSpawn = 0
            this.spwanTime = 0
            this.virusOne = true
            this.virusTwo = false
            this.virusThree = false
            this.virusFour = false

            this.yOne = -100
            this.yTwo = -100
            this.yThree = -100
            this.yFour = -100
        }

        update () {

            // Controller
            if (this.game.keys.includes('d') && (this.yOne >= this.game.height - 400 && this.yOne < this.game.height - 190))
            {
                this.game.background.score += 50
                this.yOne = -100
                this.virusOne = false
            }
            if (this.game.keys.includes('f') && (this.yTwo >= this.game.height - 400 && this.yTwo < this.game.height - 190))
            {
                this.game.background.score += 50
                this.yTwo = -100
                this.virusTwo = false
            }
            if (this.game.keys.includes('j') && (this.yThree >= this.game.height - 400 && this.yThree < this.game.height - 190))
            {
                this.game.background.score += 50
                this.yThree = -100
                this.virusThree = false
            }
            if (this.game.keys.includes('k') && (this.yFour >= this.game.height - 400 && this.yFour < this.game.height - 190))
            {
                this.game.background.score += 50
                this.yFour = -100
                this.virusFour = false
            }


            this.spwanTime += 20
            if (this.spwanTime >= 1000){
                this.spwanTime = 0
                this.randSpawn = Math.floor(Math.random() * 500)
                if (this.randSpawn >= 0 && this.randSpawn < 125)
                {
                    this.virusOne = true
                }
                if (this.randSpawn >= 125 && this.randSpawn < 250)
                {
                    this.virusTwo = true
                }
                if (this.randSpawn >= 250 && this.randSpawn < 375)
                {
                    this.virusThree = true
                }
                if (this.randSpawn >= 375 && this.randSpawn < 500)
                {
                    this.virusFour = true
                }
            }

            if (this.virusOne){
                this.yOne += this.speed
                if (this.yOne > this.game.height - 190){
                    this.yOne = -100
                    this.virusOne = false
                    console.log(pause)
                    pause.click()
                }
            }
            if (this.virusTwo){
                this.yTwo += this.speed
                if (this.yTwo >= this.game.height - 190){
                    this.yTwo = -100
                    this.virusTwo = false
                    cancelAnimationFrame(animationFrame)
                }
            }
            if (this.virusThree){
                this.yThree += this.speed
                if (this.yThree > this.game.height - 190){
                    this.yThree = -100
                    this.virusThree = false
                    cancelAnimationFrame(animationFrame)
                }
            }
            if (this.virusFour){
                this.yFour += this.speed
                if (this.yFour > this.game.height - 190){
                    this.yFour = -100
                    this.virusFour = false
                    cancelAnimationFrame(animationFrame)
                }
            }

        }

        draw () {
            this.image.src = 'assets/virus.png'

            if (this.virusOne){
                drawImage(this.image, 25, this.yOne, 70, 70)
            }

            if (this.virusTwo){
                drawImage(this.image, 150, this.yTwo, 70,70)
            }
            if (this.virusThree){
                drawImage(this.image, 275, this.yThree, 70,70)
            }
            if (this.virusFour){
                drawImage(this.image, 400, this.yFour, 70,70)
            }
        }
    }

    class Game {
        constructor(width, height) {
            this.width = width
            this.height = height
            this.background = new Background(this)
            this.handler = new Handler(this)
            this.virus = new Virus(this)
            this.keys = []
        }

        update() {
            this.virus.update()
        }

        draw (context) {
            this.virus.draw(context)
            this.background.draw(context)
        }
    }

    const game = new Game(canvas.width, canvas.height)

    function drawImage(src, dx, dy, width, height)
    {
        ctx.drawImage(src, dx, dy, width, height)
    }

    function animate () {
        ctx.clearRect(0, 0, canvas.width, canvas.height)
        game.update()
        game.draw(ctx)

        animationFrame = requestAnimationFrame(animate)
    }
})