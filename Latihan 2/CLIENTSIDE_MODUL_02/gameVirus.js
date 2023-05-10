window.addEventListener('load', () => {
    const canvas = document.getElementById('canvas')
    const ctx = canvas.getContext('2d')
    const scoreHtml = document.getElementById('score')

    var currentScore = 0

    canvas.width = 600
    canvas.height = 960

    class InputHandler {
        constructor (game) {
            this.game = game

            window.addEventListener('keydown', e => {
                if((e.key === 'd' || e.key === 'f' || e.key === 'j' || e.key === 'k') && this.game.keys.indexOf(e.key) === -1)
                {
                    this.game.keys.push(e.key)
                }
            })

            window.addEventListener('keyup', e => {
                if (this.game.keys.indexOf(e.key) > -1) {
                    this.game.keys.splice(e.key, 1)
                }
            })
        }
    }

    class Virus {
        constructor (game) {
            this.game = game
            this.width = 150
            this.height = 150
            this.x = 0
            this.y = -100
            this.speed = 5
        }

        update () {
            this.y += this.speed
            if((this.y <= canvas.height && this.y >= canvas.height - 150) && (this.x >= 0 && this.x <= 150 ) && this.game.keys.includes('d')) currentScore += 5
            else if((this.y <= canvas.height && this.y >= canvas.height - 150) && (this.x >= 150 && this.x <= 300 ) && this.game.keys.includes('f')) currentScore += 5
            else if((this.y <= canvas.height && this.y >= canvas.height - 150) && (this.x >= 300 && this.x <= 450 ) && this.game.keys.includes('j')) currentScore += 5
            else if((this.y <= canvas.height && this.y >= canvas.height - 150) && (this.x >= 450 && this.x <= this.game.width ) && this.game.keys.includes('k')) currentScore += 5

            scoreHtml.innerHTML = currentScore
            if (this.y >= this.game.height + 10) {
                this.y = -100
                this.x = Math.floor(Math.random() * 450)
            }
        }

        draw (context) {
            if (this.x >= 0 && this.x <= 150) {
                context.beginPath()
                context.fillStyle = 'black'
                context.fillRect(0, this.y, this.width, this.height)
            }
            else if (this.x >= 150 && this.x <= 300) {
                context.beginPath()
                context.fillStyle = 'black'
                context.fillRect(150, this.y, this.width, this.height)
            }
            else if (this.x >= 300 && this.x <= 450) {
                context.beginPath()
                context.fillStyle = 'black'
                context.fillRect(300, this.y, this.width, this.height)
            }
            else  {
                context.beginPath()
                context.fillStyle = 'black'
                context.fillRect(450, this.y, this.width, this.height)
            }
        }
    }

    class Background {
        constructor (game ,height) {
            this.game = game
            this.x = 0
            this.width = 150
            this.height = height
        }

        draw (context) {
            context.beginPath()
            context.strokeStyle = "#00000";
            context.strokeRect(this.x, 0, this.width, this.height);
            context.beginPath()
            context.strokeStyle = "#00000";
            context.strokeRect(this.x + 150, 0, this.width, this.height);
            context.beginPath()
            context.strokeStyle = "#00000";
            context.strokeRect(this.x + 300, 0, this.width, this.height);
            context.beginPath()
            context.strokeStyle = "#00000";
            context.strokeRect(this.x + 450, 0, this.width, this.height);

            context.beginPath()
            context.fillStyle = 'rgba(255, 0, 0, 0.1)'
            context.fillRect(this.x, this.game.height - 500, this.game.width, 350)

            
            context.beginPath()
            context.fillStyle = this.game.keys.includes('d') ? 'rgba(255, 0, 0, 0.3)' : 'red'
            context.fillRect(this.x, this.height - 150, this.width, 150)
            context.beginPath()
            context.fillStyle = this.game.keys.includes('f') ? 'rgba(0, 255,0, 0.3)' : 'green'
            context.fillRect(this.x + 150, this.height - 150, this.width, 150)
            context.beginPath()
            context.fillStyle = this.game.keys.includes('j') ? 'rgba(0, 0,255, 0.3)' : 'blue'
            context.fillRect(this.x + 300, this.height - 150, this.width, 150)
            context.beginPath()
            context.fillStyle = this.game.keys.includes('k') ? 'rgba(255, 255,255, 0.3)' : 'white'
            context.fillRect(this.x + 450, this.height - 150, this.width, 150)
        }
    }

    class Game {
        constructor (width, height) {
            this.width = width
            this.height = height
            this.virus = new Virus(this)
            this.input = new InputHandler(this)
            this.background = new Background(this, height)
            this.spawnAccess = true
            this.time = 0
            this.keys = []
        }

        update() {
            this.virus.update()
        }

        draw(context) {
            this.virus.draw(context)
            this.background.draw(context)
        }
    }

    const game = new Game(canvas.width, canvas.height)

    function animate () {
        ctx.clearRect(0, 0, canvas.width, canvas.height)
        game.draw(ctx)
        game.update()
        requestAnimationFrame(animate)
    }

    animate()


})