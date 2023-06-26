window.addEventListener('load', function () {
    const map = document.getElementById('map')
    const ctx = map.getContext('2d')

    map.width = 600
    map.height = 960

    class InputHendler {
        constructor(game){
            this.game = game

            window.addEventListener('keydown', e => {
                if ((e.key === 'd' || e.key === 'f' || e.key === 'j' || e.key === 'k') && this.game.keys.indexOf(e.key) === -1) {
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
            this.condition1 = true;
            this.condition2 = false;
            this.condition3 = false;
            this.condition4 = false;
            this.x = 0
            this.y = -150
            this.x2 = 150
            this.y2 = -150
            this.x3 = 300
            this.y3 = -150
            this.x4 = 450
            this.y4 = -150
            this.speedY = 6
            this.timeSpawnMax = 5000
            this.timeSpawn = 0
            this.speedTime = 50
            this.randSpawn = 0
        }

        update() {
            this.timeSpawn += this.speedTime

            if (this.y2)


            if (this.timeSpawn >= this.timeSpawnMax) {
                this.timeSpawn = 0
                this.randSpawn = Math.floor(Math.random() * 450)

                if ((this.randSpawn >= 0 && this.randSpawn < 150) && this.y === -150) {
                    this.condition1 = true
                }            
                else if ((this.randSpawn >= 150 && this.randSpawn < 300) && this.y2 === -150) {
                    this.condition2 = true
                }            
                else if ((this.randSpawn >= 300 && this.randSpawn < 450) && this.y3 === -150) {
                    this.condition3 = true
                }            
                else if (this.randSpawn >= 450 && this.y4 === -150 ) {
                    this.condition4 = true
                } 
            }


            if (this.condition1 ) {
                this.y += this.speedY

                if (this.y >= this.game.height - 200) {
                    this.y = -150
                    this.condition1 = false
                }
            }
            if(this.condition2) {
                this.y2 += this.speedY

                if (this.y2 >= this.game.height - 200) {
                    this.y2 = -150
                    this.condition2 = false
                }
            }
            if(this.condition3) {
                this.y3 += this.speedY

                if (this.y3 >= this.game.height - 200) {
                    this.condition3 = false
                    this.y3 = -150
                }
            }
            if (this.condition4){
                this.y4 += this.speedY

                if (this.y4 >= this.game.height - 200) {
                    this.condition4 = false
                    this.y4 = -150
                }
            }

            
        }

        draw (context) {
            if (this.condition1) {
                context.beginPath()
                context.fillStyle = 'pink'
                context.fillRect(this.x, this.y, this.width, this.height)
            }            
            if (this.condition2) {
                context.beginPath()
                context.fillStyle = 'pink'
                context.fillRect(this.x2, this.y2, this.width, this.height)
            }            
            if (this.condition3) {
                context.beginPath()
                context.fillStyle = 'pink'
                context.fillRect(this.x3, this.y3, this.width, this.height)
            }            
            if(this.condition4) {
                context.beginPath()
                context.fillStyle = 'pink'
                context.fillRect(this.x4, this.y4, this.width, this.height)
            }   

            
        }
    }

    class Arena {
        constructor(game) {
            this.game = game
        }

        draw(context) {
            context.beginPath()
            context.strokeStyle = 'gray'
            context.strokeRect(0,0,150,this.game.height)

            context.beginPath()
            context.strokeStyle = 'gray'
            context.strokeRect(150,0,150,this.game.height)

            context.beginPath()
            context.strokeStyle = 'gray'
            context.strokeRect(300,0,150,this.game.height)
            
            context.beginPath()
            context.strokeStyle = 'gray'
            context.strokeRect(450,0,150,this.game.height)

            context.beginPath()
            context.fillStyle = 'red'
            context.fillRect(0, this.game.height - 200, 150, 200)


            context.beginPath()
            context.fillStyle = 'blue'
            context.fillRect(150, this.game.height - 200, 150, 200)
            
            context.beginPath()
            context.fillStyle = 'green'
            context.fillRect(300, this.game.height - 200, 150, 200)
            context.beginPath()
            context.fillStyle = 'purple'
            context.fillRect(450, this.game.height - 200, 150, 200)

            context.beginPath()
            context.fillStyle = 'rgba(255, 0,0, 0.2)'
            context.fillRect(0, this.game.height -500, this.game.width, 300)

        }
    }

    class Game {
        constructor(width, height){
            this.width = width
            this.height = height
            this.virus = new Virus(this)
            this.arena = new Arena(this)
            this.input = new InputHendler(this)
            this.keys = []
        }

        update() {
            this.virus.update()
        }

        draw (context) {
            this.virus.draw(context)
            this.arena.draw(context)
        }
    }

    const game = new Game(map.width, map.height)

    function animate() {
        ctx.clearRect(0,0,map.width, map.height)
        game.draw(ctx)
        game.update()
        requestAnimationFrame(animate)
    }

    animate()
})