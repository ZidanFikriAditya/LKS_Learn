window.addEventListener('load', () => {
    const map = document.getElementById('map')
    const ctx = map.getContext('2d')

    map.width = 500
    map.height = 960

    var animationFrame = true
    var escape = true

    const homePage = document.getElementById('home')
    const gamePage = document.getElementById('game')
    const modal = document.getElementById('modal')
    const modalTwo = document.getElementById('modal2')
    const scoreHTML = document.getElementById('score')
    const timeHTML = document.getElementById('time')
    const homeButton = document.getElementById('homeButton')
    const username = document.getElementById('username')
    const playButton = document.getElementById('play')
    const resume = document.getElementById('resume')

    username.value = localStorage.getItem('username')

    playButton.onclick = () => {
        if (!localStorage.getItem('username') && !username.value){
            return alert('Please set your username first')
        }

        localStorage.setItem('username', username.value)
        gamePage.style.display = 'block'
        homePage.style.display = 'none'

        animate()
    }

    resume.onclick = () => {
        modalTwo.style.display = 'none'
        animationFrame = true
        animate()
    }



    modal.style.display = 'none'
    modalTwo.style.display = 'none'
    gamePage.style.display = 'none'

    homeButton.onclick = () => {
        window.location.reload()
    }

    class Background {
        constructor(game) {
            this.game = game
            this.width = 125
            this.image = new Image()
            this.image.src = 'assets/inject.png'
            this.score = 0
            this.fail = 0
            this.centiSecond = 0
            this.second = 0
            this.minute = 0
            this.time = '00:00'
        }

        update() {
            this.centiSecond += 1
            if (this.centiSecond >= 60) {
                this.centiSecond = 0
                this.second += 1
                if (this.second >= 60) {
                    this.second = 0
                    this.minute += 1
                }
            }

            this.time = `${(this.minute < 10) ? '0' + this.minute : this.minute} : ${(this.second < 10) ? '0' + this.second : this.second}`
        }

        draw(context) {
            if (this.fail === 10){
                scoreHTML.innerHTML = 'Score : ' + this.score
                timeHTML.innerHTML = 'Time : ' + this.time
                modal.style.display = 'block'
                animationFrame = false
            }

            context.beginPath()
            context.strokeStyle = 'gray'
            context.strokeRect(125, -10, this.width, this.game.height + 12)

            context.beginPath()
            context.strokeStyle = 'gray'
            context.strokeRect(250, -10, this.width, this.game.height + 12)


            context.beginPath()
            context.fillStyle = 'skyblue'
            context.lineWidth = 4
            context.rect(0, this.game.height - 200, 125, 200)
            context.fill()
            context.stroke()
            context.closePath()

            context.beginPath()
            context.fillStyle = 'purple'
            context.lineWidth = 4
            context.rect(125, this.game.height - 200, 125, 200)
            context.fill()
            context.stroke()
            context.closePath()

            context.beginPath()
            context.fillStyle = 'skyblue'
            context.lineWidth = 4
            context.rect(250, this.game.height - 200, 125, 200)
            context.fill()
            context.stroke()
            context.closePath()

            context.beginPath()
            context.fillStyle = 'purple'
            context.lineWidth = 4
            context.rect(375, this.game.height - 200, 125, 200)
            context.fill()
            context.stroke()
            context.closePath()

            context.beginPath()
            context.fillStyle = 'gray'
            context.lineWidth = 2
            context.strokeStyle = 'white'
            context.rect(0, this.game.height - 210, this.game.width, 10)
            context.fill()
            context.stroke()

            context.beginPath()
            context.fillStyle = 'rgba(255 ,0 ,0, 0.2)'
            context.fillRect(0, this.game.height - 450, this.game.width, 240)

            textFill('Score', this.score, 10, 20)
            textFill('Fail', this.fail, 10, 40)
            textFill('Time', this.time, 10, 60)

            drwaImage(this.image, 0, this.game.height - 150, 125, 125)
            drwaImage(this.image, 125, this.game.height - 150, 125, 125)
            drwaImage(this.image, 250, this.game.height - 150, 125, 125)
            drwaImage(this.image, 375, this.game.height - 150, 125, 125)

        }
    }

    class Virus {
        constructor(game) {
            this.game = game

            this.image = new Image()
            this.image.src = 'assets/virus.png'

            this.speed = 7

            this.virusOne = true
            this.virusTwo = false
            this.virusThree = false
            this.virusFour = false

            this.yOne = -100
            this.yTwo = -100
            this.yThree = -100
            this.yFour = -100

            this.timeSpawn = 0
            this.randSpawn = 0
            this.maxTime = 1000
        }

        update () {
            this.timeSpawn += 10
            if(this.timeSpawn >= this.maxTime){
                this.timeSpawn = 0
                this.randSpawn = Math.floor(Math.random() * 500)

                if (this.randSpawn >= 0 && this.randSpawn < 125 ){
                    this.virusOne = true
                }
                if (this.randSpawn >= 125 && this.randSpawn < 250 ){
                    this.virusTwo = true
                }
                if (this.randSpawn >= 250 && this.randSpawn < 375 ){
                    this.virusThree = true
                }
                if (this.randSpawn >= 375 && this.randSpawn < 500 ){
                    this.virusFour = true
                }
            }

            if (this.game.keys.includes('d') && (this.yOne > 450 && this.yOne < this.game.height - 210)) {
                this.yOne = -100
                this.virusOne = false
                this.game.background.score += 10
            }

            if (this.game.keys.includes('f') && (this.yTwo > 450 && this.yTwo < this.game.height - 210)) {
                this.yTwo = -100
                this.virusTwo = false
                this.game.background.score += 10
            }

            if (this.game.keys.includes('j') && (this.yThree > 450 && this.yThree < this.game.height - 210)) {
                this.yThree = -100
                this.virusThree = false
                this.game.background.score += 10
            }

            if (this.game.keys.includes('k') && (this.yFour > 450 && this.yFour < this.game.height - 210)) {
                this.yFour = -100
                this.virusFour = false
                this.game.background.score += 10
            }

            if (this.virusOne){
               this.yOne += this.speed
                if (this.yOne > this.game.height - 200){
                    this.yOne = -100
                    this.virusOne = false
                    this.game.background.fail += 1
                }
            }
            if (this.virusTwo){
                this.yTwo += this.speed
                if (this.yTwo > this.game.height - 200){
                    this.yTwo = -100
                    this.virusTwo = false
                    this.game.background.fail += 1
                }
            }
            if (this.virusThree){
                this.yThree += this.speed
                if (this.yThree > this.game.height - 200){
                    this.yThree = -100
                    this.virusThree = false
                    this.game.background.fail += 1
                }
            }
            if (this.virusFour){
                this.yFour += this.speed
                if (this.yFour > this.game.height - 200){
                    this.yFour = -100
                    this.virusFour = false
                    this.game.background.fail += 1
                }
            }
        }

        draw(cx) {
            if (this.virusOne){
                drwaImage(this.image, 10, this.yOne, 100, 100)
            }
            if (this.virusTwo){
                drwaImage(this.image, 135, this.yTwo, 100, 100)
            }
            if (this.virusThree){
                drwaImage(this.image, 260, this.yThree, 100, 100)
            }
            if (this.virusFour){
                drwaImage(this.image, 385, this.yFour, 100, 100)
            }

        }
    }

    class Handler {
        constructor(game) {
            this.game = game

            window.addEventListener('keydown', e => {
                if ((e.key === 'd' || e.key === 'f' || e.key === 'j' || e.key === 'k' || e.key === 'Escape') && this.game.keys.indexOf(e.key) === -1){
                    this.game.keys.push(e.key)
                }
                if (this.game.keys.includes('Escape')) {
                    if (escape){
                        modalTwo.style.display = 'block'
                        animationFrame = false
                        escape = false
                    } else {
                        modalTwo.style.display = 'none'
                        animationFrame = true
                        escape = true
                        animate()
                    }
                }
            })

            window.addEventListener('keyup', e => {
                if (this.game.keys.indexOf(e.key) > -1){
                    this.game.keys.splice(e.key, 1)
                }

            })

        }
    }

    class Game {
        constructor(width, height) {
            this.width = width
            this.height = height
            this.background = new Background(this)
            this.virus = new Virus(this)
            this.handler = new Handler(this)
            this.keys = []
        }

        update () {
            this.background.update()
            this.virus.update()
        }

        draw (context) {
            this.virus.draw(context)
            this.background.draw(context)
        }
    }

    const game = new Game(map.width, map.height)

    function drwaImage(src, dx, dy, w, h) {
        ctx.drawImage(src, dx, dy, w, h)
    }

    function textFill (name, value, x, y,color = 'white') {
        ctx.fillStyle = color
        ctx.font = '14px Arial'
        ctx.fillText(`${name} : ${value}`, x, y)
    }

    function animate() {
        ctx.clearRect(0, 0, map.width, map.height)
        game.update()
        game.draw(ctx)

        if (animationFrame) requestAnimationFrame(animate)
    }
})