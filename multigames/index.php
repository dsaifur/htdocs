<?php
if (preg_match('/Mobile|Android|iP(hone|od|ad)|IEMobile|BlackBerry|Opera Mini/i', $_SERVER['HTTP_USER_AGENT'])) {
    echo '<h1 style="text-align:center; 
                margin-top:20%; 
                font-family: Arial, sans-serif; 
                color:#ff4500; 
                font-size:2em; 
                text-shadow:2px 2px 5px rgba(0,0,0,0.3);">
            📱 Open on bigger screen to enjoy game 🎮
          </h1>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        const icons = [
            "https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f600.svg", // 😀
            "https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f680.svg", // 🚀
            "https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f4a1.svg", // 💡
            "https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f981.svg"  // 🦁
        ];
        const randomIcon = icons[Math.floor(Math.random() * icons.length)];
        const link = document.createElement("link");
        link.rel = "icon";
        link.href = randomIcon;
        document.head.appendChild(link);
    </script>
    <title>Multi-Game Arcade</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        body {
            background: #240505;
            color: #fff;
            min-height: 100vh;
        }
        header {
            background: #160000;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            color: #4CAF50;
        }
        nav {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
            flex-wrap: wrap;
        }
        button {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background 0.3s;
            white-space: nowrap;
        }
        button:hover {
            background: #3e8e41;
        }
        button.active {
            background: #2e7d32;
            transform: scale(1.05);
        }
        /* Home button style - red as requested */
        #home-btn {
            background: #ff4500; /* Red color */
        }
        #home-btn:hover {
            background: #e03e00; /* Darker red on hover */
        }
        .game-container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            min-height: 500px;
            display: none;
        }
        .game-container.active {
            display: block;
        }
        /* Game Mode Selection */
        .game-mode-selection {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 20px 0;
            flex-wrap: wrap;
        }
        .mode-btn {
            padding: 8px 16px;
            font-size: 0.9rem;
        }
        .mode-btn.active {
            background: #2e7d32;
        }
        /* Tic-Tac-Toe Styles */
        #tictactoe-game .game-board {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            max-width: 400px;
            margin: 30px auto;
        }
        .cell {
            width: 100px;
            height: 100px;
            background: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .cell:hover {
            background: #444;
        }
        .cell.x {
            color: #ff5252;
        }
        .cell.o {
            color: #2196F3;
        }
        .status {
            text-align: center;
            font-size: 1.5rem;
            margin: 20px 0;
        }
        .reset-btn {
            display: block;
            margin: 20px auto;
        }
        /* Snake Game Styles */
        #snake-game {
            text-align: center;
        }
        #snake-canvas {
            background: #222;
            display: block;
            margin: 20px auto;
            border: 2px solid #444;
        }
        /* Flappy Bird Styles */
        #flappybird-game {
            text-align: center;
        }
        #flappybird-canvas {
            background: #5a94ff;
            display: block;
            margin: 20px auto;
            border: 2px solid #444;
        }
        /* Ping Pong Styles */
        #pingpong-game {
            text-align: center;
        }
        #pong-canvas {
            background: #222;
            display: block;
            margin: 20px auto;
            border: 2px solid #444;
        }
        /* Math Quiz Styles */
        #mathquiz-game {
            text-align: center;
        }
        .math-problem {
            font-size: 2.5rem;
            margin: 30px 0;
            padding: 20px;
            background: #333;
            border-radius: 10px;
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .answer-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin: 30px 0;
        }
        .answer-btn {
            background: #444;
            color: white;
            border: 2px solid #555;
            padding: 15px;
            border-radius: 8px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s;
        }
        .answer-btn:hover {
            background: #555;
            transform: translateY(-3px);
        }
        .answer-btn.correct {
            background: #4CAF50;
            border-color: #3e8e41;
        }
        .answer-btn.incorrect {
            background: #f44336;
            border-color: #d32f2f;
        }
        .quiz-stats {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
            font-size: 1.2rem;
        }
        .stat-box {
            background: #333;
            padding: 10px 20px;
            border-radius: 8px;
            min-width: 120px;
        }
        .timer-bar {
            width: 100%;
            height: 10px;
            background: #333;
            border-radius: 5px;
            margin: 20px 0;
            overflow: hidden;
        }
        .timer-fill {
            height: 100%;
            background: #4CAF50;
            width: 100%;
            transition: width 0.1s linear;
        }
        .game-controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 20px 0;
        }
        #mathquiz-stop {
            background: #f44336;
        }
        #mathquiz-stop:hover {
            background: #d32f2f;
        }
        /* Score Display */
        .score-display {
            font-size: 2rem;
            margin: 20px 0;
        }
        /* High Score Display */
        .high-score {
            background: #333;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
            text-align: center;
            font-size: 1.2rem;
            color: gold;
            border: 1px solid #444;
        }
        /* Shared Styles */
        .instructions {
            background: #333;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        .control-info {
            font-size: 0.9rem;
            margin-top: 10px;
            color: #aaa;
        }
        .game-info {
            display: flex;
            justify-content: space-between;
            max-width: 500px;
            margin: 20px auto;
            flex-wrap: wrap;
            gap: 10px;
        }
        /* Billiards Styles */
        #billiards-game {
            text-align: center;
        }
        #billiards-canvas {
            background: #0b6e2b; /* Green billiards table */
            display: block;
            margin: 20px auto;
            border: 2px solid #444;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        .billiards-controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 20px 0;
        }
        .billiards-power {
            width: 100%;
            max-width: 300px;
            margin: 10px auto;
        }
        .billiards-power-bar {
            width: 100%;
            height: 20px;
            background: #333;
            border-radius: 10px;
            margin: 5px 0;
            overflow: hidden;
        }
        .billiards-power-fill {
            height: 100%;
            background: linear-gradient(to right, #ff4500, #ffeb3b, #4CAF50);
            width: 0%;
            transition: width 0.1s;
        }
        /* Owner name styling */
        .owner-name {
            position: fixed;
            bottom: 10px;
            left: 10px;
            font-family: 'Arial Black', 'Arial Bold', Gadget, sans-serif;
            font-size: 1.2rem;
            font-weight: bold;
            color: #ff4500;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            background: rgba(22, 0, 0, 0.7);
            padding: 5px 10px;
            border-radius: 5px;
            z-index: 100;
            animation: glow 2s ease-in-out infinite alternate;
        }
        @keyframes glow {
            from {
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5), 0 0 5px #ff4500;
            }
            to {
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5), 0 0 15px #ff4500, 0 0 20px #ff4500;
            }
        }
        /* Bug report notice */
        .bug-report {
            position: fixed;
            bottom: 10px;
            right: 10px;
            font-family: 'Arial', sans-serif;
            font-size: 0.9rem;
            color: #fff;
            background: rgba(22, 0, 0, 0.7);
            padding: 5px 10px;
            border-radius: 5px;
            z-index: 100;
        }
        
        /* Home Page Styles */
        #home-game {
            text-align: center;
        }
        #home-game h2 {
            color: #ffeb3b;
            text-shadow: 0 0 10px rgba(255, 235, 59, 0.7);
            margin-bottom: 30px;
            font-size: 2.5rem;
        }
        .games-showcase {
            background: rgba(30, 30, 30, 0.8);
            padding: 30px;
            border-radius: 15px;
            margin: 25px auto;
            max-width: 750px;
            border: 2px solid #4CAF50;
            box-shadow: 0 0 20px rgba(76, 175, 80, 0.3);
        }
        .games-showcase h3 {
            color: #4CAF50;
            margin-bottom: 25px;
            font-size: 1.8rem;
        }
        .games-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .game-card {
            background: #333;
            padding: 20px;
            border-radius: 10px;
            border-left: 4px solid #ff5252;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .game-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        .game-card h4 {
            margin-bottom: 10px;
            font-size: 1.3rem;
        }
        .game-card:nth-child(1) { border-left-color: #ff5252; }
        .game-card:nth-child(2) { border-left-color: #4CAF50; }
        .game-card:nth-child(3) { border-left-color: #ff9800; }
        .game-card:nth-child(4) { border-left-color: #2196F3; }
        .game-card:nth-child(5) { border-left-color: #9C27B0; }
        .game-card:nth-child(6) { border-left-color: #009688; }
        
        .quick-start {
            margin-top: 30px;
        }
        .quick-start button {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 30px;
            cursor: pointer;
            font-size: 1.2rem;
            font-weight: bold;
            transition: all 0.3s;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .quick-start button:hover {
            background: #3e8e41;
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.3);
        }
        
        /* Developer Section */
        .developer-section {
            background: linear-gradient(135deg, #ff4500, #ff8c00);
            padding: 30px;
            border-radius: 15px;
            margin: 40px auto;
            max-width: 650px;
            text-align: center;
            box-shadow: 0 0 25px rgba(255, 69, 0, 0.5);
            border: 2px solid #ff4500;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { box-shadow: 0 0 25px rgba(255, 69, 0, 0.5); }
            50% { box-shadow: 0 0 35px rgba(255, 69, 0, 0.8); }
            100% { box-shadow: 0 0 25px rgba(255, 69, 0, 0.5); }
        }
        .developer-section h3 {
            color: white;
            font-size: 2rem;
            margin-bottom: 20px;
            text-shadow: 0 0 10px rgba(255,255,255,0.7);
        }
        .bug-report-section {
            background: rgba(0,0,0,0.3);
            padding: 20px;
            border-radius: 10px;
            display: inline-block;
            margin-top: 20px;
        }
        .bug-report-section p {
            color: white;
            font-size: 1.4rem;
            font-weight: bold;
            margin: 0 0 15px 0;
        }
        .bug-report-section a {
            display: inline-block;
            background: #E1306C;
            color: white;
            text-decoration: none;
            padding: 15px 30px;
            border-radius: 30px;
            font-weight: bold;
            font-size: 1.3rem;
            transition: all 0.3s;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .bug-report-section a:hover {
            background: #c1205c;
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.3);
        }
        
        @media (max-width: 600px) {
            .cell {
                width: 80px;
                height: 80px;
                font-size: 2rem;
            }
            .answer-options {
                grid-template-columns: 1fr;
            }
            nav {
                gap: 10px;
            }
            button {
                padding: 8px 12px;
                font-size: 0.8rem;
            }
            .games-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Multi-games arcade</h1>
        <nav>
            <button id="home-btn" class="active">Home</button> <!-- Red Home button added here -->
            <button id="tictactoe-btn">Tic-Tac-Toe</button>
            <button id="snake-btn">Snake</button>
            <button id="flappybird-btn">Flappy Bird</button>
            <button id="pingpong-btn">Ping Pong</button>
            <button id="mathquiz-btn">Math Quiz</button>
            <button id="billiards-btn">Billiards</button>
        </nav>
    </header>
    
    <!-- Home Screen -->
    <div id="home-game" class="game-container active">
        <h2>🎮 Welcome to Multi-Games Arcade! 🎮</h2>
        
        <div class="games-showcase">
            <h3>Available Games</h3>
            
            <div class="games-grid">
                <!-- Tic-Tac-Toe -->
                <div class="game-card">
                    <h4>❌⭕ Tic-Tac-Toe</h4>
                    <p>Classic X & O strategy game. Play against a friend or AI!</p>
                </div>
                
                <!-- Snake -->
                <div class="game-card">
                    <h4>🐍 Snake</h4>
                    <p>Guide the snake to eat food and grow longer without crashing!</p>
                </div>
                
                <!-- Flappy Bird -->
                <div class="game-card">
                    <h4>🐦 Flappy Bird</h4>
                    <p>Tap to fly! Navigate through pipes in this addictive challenge.</p>
                </div>
                
                <!-- Ping Pong -->
                <div class="game-card">
                    <h4>🏓 Ping Pong</h4>
                    <p>Fast-paced table tennis! Play against a friend or the computer.</p>
                </div>
                
                <!-- Math Quiz -->
                <div class="game-card">
                    <h4>🧮 Math Quiz</h4>
                    <p>Test your math skills with timed quizzes and tricky problems!</p>
                </div>
                
                <!-- Billiards -->
                <div class="game-card">
                    <h4>🎱 Billiards</h4>
                    <p>Aim and shoot! Pot balls for points in this classic pool game.</p>
                </div>
            </div>
            
            <div class="quick-start">
                <p style="font-size: 1.2rem; color: #fff; margin-bottom: 15px;">Select any game from the menu above to start playing!</p>
                <button onclick="document.getElementById('tictactoe-btn').click();" style="background: #ff5252;">
                    🎯 Quick Start: Play Tic-Tac-Toe
                </button>
            </div>
        </div>

        <!-- Developer and Bug Report Section -->
        <div class="developer-section">
            <h3>👑 Created with ❤️ by: <strong>Awais_dsaifur</strong></h3>
            <div class="bug-report-section">
                <p>🐞 Found a bug? Report it now!</p>
                <a href="https://instagram.com/disaifur" target="_blank">
                    📸 Instagram: @disaifur
                </a>
            </div>
        </div>
    </div>

    <!-- Tic-Tac-Toe Game -->
    <div id="tictactoe-game" class="game-container">
        <h2 style="text-align: center;">Tic-Tac-Toe</h2>
        <div class="game-mode-selection">
            <button id="tictactoe-pvp" class="mode-btn active">Player vs Player</button>
            <button id="tictactoe-pvc" class="mode-btn">Player vs Computer</button>
        </div>
        <div class="instructions">
            <p>Take turns clicking on the grid to place your mark (X or O). First to get 3 in a row wins!</p>
            <p id="tictactoe-mode-info">You are X. Player 2 is O.</p>
            <p class="control-info">Controls: Click on cells to make moves</p>
        </div>
        <div class="status" id="tictactoe-status">X's turn</div>
        <div class="game-board" id="tictactoe-board">
            <div class="cell" data-index="0"></div>
            <div class="cell" data-index="1"></div>
            <div class="cell" data-index="2"></div>
            <div class="cell" data-index="3"></div>
            <div class="cell" data-index="4"></div>
            <div class="cell" data-index="5"></div>
            <div class="cell" data-index="6"></div>
            <div class="cell" data-index="7"></div>
            <div class="cell" data-index="8"></div>
        </div>
        <button class="reset-btn" id="tictactoe-reset">Reset Game</button>
    </div>
    <!-- Snake Game -->
    <div id="snake-game" class="game-container">
        <h2>Snake Game</h2>
        <div class="game-mode-selection">
            <button id="snake-border" class="mode-btn active">Wrap Around Borders</button>
            <button id="snake-solid" class="mode-btn">Solid Borders</button>
        </div>
        <div class="instructions">
            <p>Use arrow keys or WASD to control the snake. Eat the food to grow longer.</p>
            <p>In Wrap Around mode, the snake will appear on the opposite side when crossing borders.</p>
            <p class="control-info">Controls: Arrow Keys or WASD</p>
        </div>
        <div class="game-info">
            <div>Score: <span id="snake-score">0</span></div>
            <div>High Score: <span id="snake-high-score">0</span></div>
            <button id="snake-start">Start Game</button>
        </div>
        <div class="high-score" id="snake-session-high-score">Session High Score: 0</div>
        <canvas id="snake-canvas" width="400" height="400"></canvas>
    </div>
    <!-- Flappy Bird Game -->
    <div id="flappybird-game" class="game-container">
        <h2>Flappy Bird Clone</h2>
        <div class="instructions">
            <p>Press SPACE, W, or UP ARROW to make the bird fly. Avoid the pipes!</p>
            <p class="control-info">Controls: SPACE, W, or UP ARROW to jump</p>
        </div>
        <div class="game-info">
            <div>Score: <span id="flappybird-score">0</span></div>
            <div>High Score: <span id="flappybird-high-score">0</span></div>
            <button id="flappybird-start">Start Game</button>
        </div>
        <div class="high-score" id="flappybird-session-high-score">Session High Score: 0</div>
        <canvas id="flappybird-canvas" width="400" height="500"></canvas>
    </div>
    <!-- Ping Pong Game -->
    <div id="pingpong-game" class="game-container">
        <h2>Ping Pong</h2>
        <div class="game-mode-selection">
            <button id="pong-pvp" class="mode-btn active">Player vs Player</button>
            <button id="pong-pvc" class="mode-btn">Player vs Computer</button>
        </div>
        <div class="instructions">
            <p id="pong-mode-info">Player 1 (left): W/S keys | Player 2 (right): Up/Down arrows, A/D, or I/K keys</p>
            <p>First to 5 points wins!</p>
            <p class="control-info">Controls: W/S for Player 1, Up/Down arrows, A/D, or I/K for Player 2</p>
        </div>
        <div class="score-display" id="pong-score">0 : 0</div>
        <canvas id="pong-canvas" width="600" height="400"></canvas>
        <button id="pong-start" style="margin-top: 20px;">Start Game</button>
    </div>
    <!-- Math Quiz Game -->
    <div id="mathquiz-game" class="game-container">
        <h2>Math Quiz</h2>
        <div class="instructions">
            <p>Solve math problems by selecting the correct answer from the options.</p>
            <p>Operations include addition, subtraction, multiplication, and division.</p>
            <p class="control-info">Controls: Click on answer options or use number keys 1-4</p>
        </div>
        <div class="quiz-stats">
            <div class="stat-box">Score: <span id="mathquiz-score">0</span></div>
            <div class="stat-box">High Score: <span id="mathquiz-high-score">0</span></div>
            <div class="stat-box">Streak: <span id="mathquiz-streak">0</span></div>
        </div>
        <div class="high-score" id="mathquiz-session-high-score">Session High Score: 0</div>
        <div class="timer-bar">
            <div class="timer-fill" id="mathquiz-timer"></div>
        </div>
        <div class="math-problem" id="mathquiz-problem">Click "Start Quiz" to begin!</div>
        <div class="answer-options" id="mathquiz-options">
            <!-- Answer options will be generated here -->
        </div>
        <div class="game-controls">
            <button id="mathquiz-start" class="reset-btn">Start Quiz</button>
            <button id="mathquiz-stop" class="reset-btn">Stop Quiz</button>
        </div>
    </div>
    <!-- Billiards Game -->
    <div id="billiards-game" class="game-container">
        <h2>Billiards</h2>
        <div class="instructions">
            <p>Use your mouse to aim and click to shoot. Try to pot as many balls as possible!</p>
            <p>Solid balls = 1 point, Striped balls = 2 points, 8-Ball = 5 points</p>
            <p class="control-info">Controls: Mouse to aim, Click to shoot, Space to reset cue ball</p>
        </div>
        <div class="game-info">
            <div>Score: <span id="billiards-score">0</span></div>
            <div>High Score: <span id="billiards-high-score">0</span></div>
            <div>Balls Potted: <span id="billiards-balls-potted">0</span></div>
        </div>
        <div class="high-score" id="billiards-session-high-score">Session High Score: 0</div>
        <div class="billiards-power">
            <label>Power: <span id="billiards-power-value">50</span>%</label>
            <div class="billiards-power-bar">
                <div class="billiards-power-fill" id="billiards-power-fill"></div>
            </div>
        </div>
        <canvas id="billiards-canvas" width="600" height="300"></canvas>
        <div class="billiards-controls">
            <button id="billiards-start">Start New Game</button>
            <button id="billiards-reset-cue">Reset Cue Ball</button>
        </div>
    </div>
    <!-- Owner name and bug report elements -->
    <div class="owner-name"> Owner: Awais_dsaifur</div>
    <div class="bug-report">Report any kind of bugs on Instagram @disaifur</div>
    <script>
        // Local Storage Helper Functions
        function saveHighScore(game, score) {
            try {
                localStorage.setItem(`${game}-high-score`, score);
            } catch (e) {
                console.log("Could not save to localStorage", e);
            }
        }
        function loadHighScore(game) {
            try {
                const score = localStorage.getItem(`${game}-high-score`);
                return score ? parseInt(score) : 0;
            } catch (e) {
                console.log("Could not load from localStorage", e);
                return 0;
            }
        }
        // Game Navigation
        const navButtons = document.querySelectorAll('nav button');
        const gameContainers = document.querySelectorAll('.game-container');
        navButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove active class from all buttons and containers
                navButtons.forEach(btn => btn.classList.remove('active'));
                gameContainers.forEach(container => container.classList.remove('active'));
                // Add active class to clicked button
                button.classList.add('active');
                // Show corresponding game container
                const gameId = button.id.replace('-btn', '');
                document.getElementById(gameId + '-game').classList.add('active');
            });
        });
        // Tic-Tac-Toe Game
        const tictactoe = (() => {
            const board = document.getElementById('tictactoe-board');
            const cells = document.querySelectorAll('.cell');
            const statusDisplay = document.getElementById('tictactoe-status');
            const resetButton = document.getElementById('tictactoe-reset');
            const pvpButton = document.getElementById('tictactoe-pvp');
            const pvcButton = document.getElementById('tictactoe-pvc');
            const modeInfo = document.getElementById('tictactoe-mode-info');
            let gameActive = true;
            let currentPlayer = "X";
            let gameState = ["", "", "", "", "", "", "", "", ""];
            let vsComputer = false;
            const winningConditions = [
                [0, 1, 2],
                [3, 4, 5],
                [6, 7, 8],
                [0, 3, 6],
                [1, 4, 7],
                [2, 5, 8],
                [0, 4, 8],
                [2, 4, 6]
            ];
            function handleCellClick(clickedCellEvent) {
                const clickedCell = clickedCellEvent.target;
                const clickedCellIndex = parseInt(clickedCell.getAttribute('data-index'));
                if (gameState[clickedCellIndex] !== "" || !gameActive ||
                    (vsComputer && currentPlayer === "O")) {
                    return;
                }
                handleCellPlayed(clickedCell, clickedCellIndex);
                handleResultValidation();
                // If vs computer and it's computer's turn
                if (vsComputer && gameActive && currentPlayer === "O") {
                    setTimeout(makeComputerMove, 500);
                }
            }
            function handleCellPlayed(clickedCell, clickedCellIndex) {
                gameState[clickedCellIndex] = currentPlayer;
                clickedCell.textContent = currentPlayer;
                clickedCell.classList.add(currentPlayer.toLowerCase());
            }
            function handleResultValidation() {
                let roundWon = false;
                for (let i = 0; i < winningConditions.length; i++) {
                    const [a, b, c] = winningConditions[i];
                    if (gameState[a] === '' || gameState[b] === '' || gameState[c] === '') {
                        continue;
                    }
                    if (gameState[a] === gameState[b] && gameState[b] === gameState[c]) {
                        roundWon = true;
                        break;
                    }
                }
                if (roundWon) {
                    statusDisplay.textContent = `${currentPlayer} wins!`;
                    gameActive = false;
                    return;
                }
                const roundDraw = !gameState.includes("");
                if (roundDraw) {
                    statusDisplay.textContent = "Game ended in a draw!";
                    gameActive = false;
                    return;
                }
                currentPlayer = currentPlayer === "X" ? "O" : "X";
                statusDisplay.textContent = `${currentPlayer}'s turn`;
            }
            function makeComputerMove() {
                if (!gameActive) return;
                // Try to win
                for (let i = 0; i < gameState.length; i++) {
                    if (gameState[i] === "") {
                        gameState[i] = "O";
                        if (checkWinningMove("O")) {
                            const cell = document.querySelector(`.cell[data-index="${i}"]`);
                            handleCellPlayed(cell, i);
                            handleResultValidation();
                            return;
                        }
                        gameState[i] = "";
                    }
                }
                // Block player from winning
                for (let i = 0; i < gameState.length; i++) {
                    if (gameState[i] === "") {
                        gameState[i] = "X";
                        if (checkWinningMove("X")) {
                            gameState[i] = "O";
                            const cell = document.querySelector(`.cell[data-index="${i}"]`);
                            handleCellPlayed(cell, i);
                            handleResultValidation();
                            return;
                        }
                        gameState[i] = "";
                    }
                }
                // Take center if available
                if (gameState[4] === "") {
                    const cell = document.querySelector(`.cell[data-index="4"]`);
                    handleCellPlayed(cell, 4);
                    handleResultValidation();
                    return;
                }
                // Take a corner if available
                const corners = [0, 2, 6, 8];
                const availableCorners = corners.filter(i => gameState[i] === "");
                if (availableCorners.length > 0) {
                    const randomCorner = availableCorners[Math.floor(Math.random() * availableCorners.length)];
                    const cell = document.querySelector(`.cell[data-index="${randomCorner}"]`);
                    handleCellPlayed(cell, randomCorner);
                    handleResultValidation();
                    return;
                }
                // Take any available space
                const availableSpaces = gameState.map((val, idx) => val === "" ? idx : -1).filter(idx => idx !== -1);
                if (availableSpaces.length > 0) {
                    const randomSpace = availableSpaces[Math.floor(Math.random() * availableSpaces.length)];
                    const cell = document.querySelector(`.cell[data-index="${randomSpace}"]`);
                    handleCellPlayed(cell, randomSpace);
                    handleResultValidation();
                }
            }
            function checkWinningMove(player) {
                for (let i = 0; i < winningConditions.length; i++) {
                    const [a, b, c] = winningConditions[i];
                    if (gameState[a] === player && gameState[b] === player && gameState[c] === player) {
                        return true;
                    }
                }
                return false;
            }
            function handleRestartGame() {
                gameActive = true;
                currentPlayer = "X";
                gameState = ["", "", "", "", "", "", "", "", ""];
                statusDisplay.textContent = `${currentPlayer}'s turn`;
                cells.forEach(cell => {
                    cell.textContent = "";
                    cell.classList.remove('x', 'o');
                });
            }
            function toggleMode(isVsComputer) {
                vsComputer = isVsComputer;
                handleRestartGame();
                if (vsComputer) {
                    modeInfo.textContent = "You are X. Computer is O.";
                } else {
                    modeInfo.textContent = "You are X. Player 2 is O.";
                }
            }
            cells.forEach(cell => cell.addEventListener('click', handleCellClick));
            resetButton.addEventListener('click', handleRestartGame);
            pvpButton.addEventListener('click', () => {
                pvpButton.classList.add('active');
                pvcButton.classList.remove('active');
                toggleMode(false);
            });
            pvcButton.addEventListener('click', () => {
                pvcButton.classList.add('active');
                pvpButton.classList.remove('active');
                toggleMode(true);
            });
            return { init: () => { } };
        })();
        // Snake Game
        const snakeGame = (() => {
            const canvas = document.getElementById('snake-canvas');
            const ctx = canvas.getContext('2d');
            const startButton = document.getElementById('snake-start');
            const scoreDisplay = document.getElementById('snake-score');
            const highScoreDisplay = document.getElementById('snake-high-score');
            const sessionHighScoreDisplay = document.getElementById('snake-session-high-score');
            const borderButton = document.getElementById('snake-border');
            const solidButton = document.getElementById('snake-solid');
            const gridSize = 20;
            const tileCount = canvas.width / gridSize;
            let snake = [];
            let food = {};
            let dx = gridSize;
            let dy = 0;
            let score = 0;
            let highScore = loadHighScore('snake');
            let sessionHighScore = 0;
            let gameInterval;
            let gameRunning = false;
            let wrapAround = true; // Default to wrap around mode
            // Initialize high score display
            highScoreDisplay.textContent = highScore;
            sessionHighScoreDisplay.textContent = `Session High Score: ${sessionHighScore}`;
            function initGame() {
                // Initialize snake
                snake = [
                    { x: 5 * gridSize, y: 5 * gridSize },
                    { x: 4 * gridSize, y: 5 * gridSize },
                    { x: 3 * gridSize, y: 5 * gridSize }
                ];
                // Place food
                placeFood();
                // Reset direction and score
                dx = gridSize;
                dy = 0;
                score = 0;
                scoreDisplay.textContent = score;
                // Clear any existing game loop
                if (gameInterval) clearInterval(gameInterval);
                // Start game loop
                gameRunning = true;
                gameInterval = setInterval(gameLoop, 100);
            }
            function placeFood() {
                food = {
                    x: Math.floor(Math.random() * tileCount) * gridSize,
                    y: Math.floor(Math.random() * tileCount) * gridSize
                };
                // Make sure food doesn't appear on snake
                for (let i = 0; i < snake.length; i++) {
                    if (food.x === snake[i].x && food.y === snake[i].y) {
                        placeFood();
                        break;
                    }
                }
            }
            function gameLoop() {
                // Move snake
                const head = { x: snake[0].x + dx, y: snake[0].y + dy };
                // Handle border collision based on mode
                if (wrapAround) {
                    // Wrap around mode
                    if (head.x < 0) head.x = canvas.width - gridSize;
                    if (head.x >= canvas.width) head.x = 0;
                    if (head.y < 0) head.y = canvas.height - gridSize;
                    if (head.y >= canvas.height) head.y = 0;
                } else {
                    // Solid border mode
                    if (head.x < 0 || head.x >= canvas.width || head.y < 0 || head.y >= canvas.height) {
                        gameOver();
                        return;
                    }
                }
                // Check for collisions with self
                for (let i = 0; i < snake.length; i++) {
                    if (head.x === snake[i].x && head.y === snake[i].y) {
                        gameOver();
                        return;
                    }
                }
                // Add new head
                snake.unshift(head);
                // Check if food eaten
                if (head.x === food.x && head.y === food.y) {
                    score++;
                    scoreDisplay.textContent = score;
                    placeFood();
                } else {
                    // Remove tail if no food eaten
                    snake.pop();
                }
                // Draw everything
                drawGame();
            }
            function drawGame() {
                // Clear canvas
                ctx.fillStyle = '#222';
                ctx.fillRect(0, 0, canvas.width, canvas.height);
                // Draw snake
                ctx.fillStyle = '#4CAF50';
                for (let i = 0; i < snake.length; i++) {
                    ctx.fillRect(snake[i].x, snake[i].y, gridSize - 1, gridSize - 1);
                }
                // Draw head with different color
                ctx.fillStyle = '#2E7D32';
                ctx.fillRect(snake[0].x, snake[0].y, gridSize - 1, gridSize - 1);
                // Draw food
                ctx.fillStyle = '#ff5252';
                ctx.fillRect(food.x, food.y, gridSize - 1, gridSize - 1);
            }
            function gameOver() {
                gameRunning = false;
                clearInterval(gameInterval);
                // Update high scores
                if (score > highScore) {
                    highScore = score;
                    highScoreDisplay.textContent = highScore;
                    saveHighScore('snake', highScore);
                }
                if (score > sessionHighScore) {
                    sessionHighScore = score;
                    sessionHighScoreDisplay.textContent = `Session High Score: ${sessionHighScore}`;
                }
                alert(`Game Over! Your score: ${score}`);
            }
            function handleKeyDown(e) {
                if (!gameRunning) return;
                // Handle both arrow keys and WASD
                switch (e.key) {
                    case 'ArrowUp':
                    case 'w':
                    case 'W':
                        if (dy === 0) {
                            dx = 0;
                            dy = -gridSize;
                        }
                        break;
                    case 'ArrowDown':
                    case 's':
                    case 'S':
                        if (dy === 0) {
                            dx = 0;
                            dy = gridSize;
                        }
                        break;
                    case 'ArrowLeft':
                    case 'a':
                    case 'A':
                        if (dx === 0) {
                            dx = -gridSize;
                            dy = 0;
                        }
                        break;
                    case 'ArrowRight':
                    case 'd':
                    case 'D':
                        if (dx === 0) {
                            dx = gridSize;
                            dy = 0;
                        }
                        break;
                }
            }
            function toggleBorderMode(isWrapAround) {
                wrapAround = isWrapAround;
            }
            startButton.addEventListener('click', initGame);
            document.addEventListener('keydown', handleKeyDown);
            borderButton.addEventListener('click', () => {
                borderButton.classList.add('active');
                solidButton.classList.remove('active');
                toggleBorderMode(true);
            });
            solidButton.addEventListener('click', () => {
                solidButton.classList.add('active');
                borderButton.classList.remove('active');
                toggleBorderMode(false);
            });
            return { init: () => { } };
        })();
        // Flappy Bird Game
        const flappyBirdGame = (() => {
            const canvas = document.getElementById('flappybird-canvas');
            const ctx = canvas.getContext('2d');
            const startButton = document.getElementById('flappybird-start');
            const scoreDisplay = document.getElementById('flappybird-score');
            const highScoreDisplay = document.getElementById('flappybird-high-score');
            const sessionHighScoreDisplay = document.getElementById('flappybird-session-high-score');
            // Game elements
            let bird = {
                x: 50,
                y: canvas.height / 2,
                width: 30,
                height: 24,
                gravity: 0.5,
                velocity: 0,
                jump: -8
            };
            let pipes = [];
            let pipeWidth = 60;
            let pipeGap = 150;
            let pipeSpeed = 2;
            let pipeInterval = 1500; // ms between pipe spawns
            let lastPipeTime = 0;
            let score = 0;
            let highScore = loadHighScore('flappybird');
            let sessionHighScore = 0;
            let gameRunning = false;
            let animationId;
            let startTime;
            let scoredPipes = new Set(); // Track which pipes we've scored on
            // Initialize high score display
            highScoreDisplay.textContent = highScore;
            sessionHighScoreDisplay.textContent = `Session High Score: ${sessionHighScore}`;
            // Background elements
            const background = {
                clouds: []
            };
            // Initialize clouds
            for (let i = 0; i < 5; i++) {
                background.clouds.push({
                    x: Math.random() * canvas.width,
                    y: Math.random() * (canvas.height / 2),
                    width: 50 + Math.random() * 50,
                    height: 30 + Math.random() * 30,
                    speed: 0.5 + Math.random() * 0.5
                });
            }
            function initGame() {
                // Reset bird
                bird.y = canvas.height / 2;
                bird.velocity = 0;
                // Reset pipes
                pipes = [];
                scoredPipes = new Set();
                lastPipeTime = 0;
                // Reset score
                score = 0;
                scoreDisplay.textContent = score;
                // Cancel any existing animation
                if (animationId) {
                    cancelAnimationFrame(animationId);
                }
                // Start game
                gameRunning = true;
                startTime = Date.now();
                gameLoop();
            }
            function gameLoop(timestamp) {
                // Clear canvas
                ctx.fillStyle = '#5a94ff'; // Sky blue background
                ctx.fillRect(0, 0, canvas.width, canvas.height);
                // Update and draw background elements
                updateAndDrawBackground();
                if (!gameRunning) return;
                // Update bird
                bird.velocity += bird.gravity;
                bird.y += bird.velocity;
                // Spawn pipes
                if (timestamp - lastPipeTime > pipeInterval) {
                    spawnPipe();
                    lastPipeTime = timestamp;
                }
                // Update and draw pipes
                updateAndDrawPipes();
                // Draw bird
                drawBird();
                // Check collisions
                if (checkCollisions()) {
                    gameOver();
                    return;
                }
                // Continue game loop
                animationId = requestAnimationFrame(gameLoop);
            }
            function updateAndDrawBackground() {
                // Draw clouds
                ctx.fillStyle = 'rgba(255, 255, 255, 0.8)';
                for (let cloud of background.clouds) {
                    cloud.x -= cloud.speed;
                    // Reset cloud position if it goes off screen
                    if (cloud.x + cloud.width < 0) {
                        cloud.x = canvas.width;
                        cloud.y = Math.random() * (canvas.height / 2);
                    }
                    ctx.beginPath();
                    ctx.arc(cloud.x, cloud.y, cloud.width / 2, 0, Math.PI * 2);
                    ctx.arc(cloud.x + cloud.width / 3, cloud.y - cloud.height / 4, cloud.width / 3, 0, Math.PI * 2);
                    ctx.arc(cloud.x + cloud.width * 2 / 3, cloud.y, cloud.width / 3, 0, Math.PI * 2);
                    ctx.fill();
                }
                // Draw ground
                ctx.fillStyle = '#3a8c3f';
                ctx.fillRect(0, canvas.height - 30, canvas.width, 30);
                // Draw grass details
                ctx.fillStyle = '#2a7c2f';
                for (let i = 0; i < canvas.width; i += 20) {
                    ctx.fillRect(i, canvas.height - 30, 10, 5);
                }
            }
            function spawnPipe() {
                const minHeight = 50;
                const maxHeight = canvas.height - pipeGap - 50 - 30; // 30 is ground height
                const height = minHeight + Math.random() * (maxHeight - minHeight);
                // Create unique ID for this pipe pair
                const pipeId = Date.now() + Math.random();
                pipes.push({
                    x: canvas.width,
                    y: 0,
                    width: pipeWidth,
                    height: height,
                    id: pipeId,
                    scored: false
                });
                pipes.push({
                    x: canvas.width,
                    y: height + pipeGap,
                    width: pipeWidth,
                    height: canvas.height - height - pipeGap - 30, // 30 is ground height
                    id: pipeId,
                    scored: false
                });
            }
            function updateAndDrawPipes() {
                ctx.fillStyle = '#4a9c4f';
                for (let i = 0; i < pipes.length; i++) {
                    const pipe = pipes[i];
                    // Move pipe
                    pipe.x -= pipeSpeed;
                    // Draw pipe
                    ctx.fillRect(pipe.x, pipe.y, pipe.width, pipe.height);
                    // Draw pipe cap
                    ctx.fillStyle = '#3a8c3f';
                    if (pipe.y === 0) {
                        // Top pipe cap
                        ctx.fillRect(pipe.x - 5, pipe.y + pipe.height - 10, pipe.width + 10, 10);
                    } else {
                        // Bottom pipe cap
                        ctx.fillRect(pipe.x - 5, pipe.y, pipe.width + 10, 10);
                    }
                    ctx.fillStyle = '#4a9c4f';
                    // Check if bird passed the pipe (only count once per pipe pair)
                    if (!pipe.scored && pipe.x + pipe.width < bird.x && pipe.y === 0) {
                        pipe.scored = true;
                        score++;
                        scoreDisplay.textContent = score;
                    }
                }
                // Remove pipes that are off screen
                pipes = pipes.filter(pipe => pipe.x + pipe.width > 0);
            }
            function drawBird() {
                // Save context for rotation
                ctx.save();
                // Rotate bird based on velocity
                const rotation = bird.velocity * 0.1;
                ctx.translate(bird.x, bird.y);
                ctx.rotate(rotation);
                ctx.translate(-bird.x, -bird.y);
                // Bird body
                ctx.fillStyle = '#ffff00';
                ctx.beginPath();
                ctx.ellipse(bird.x, bird.y, bird.width / 2, bird.height / 2, 0, 0, Math.PI * 2);
                ctx.fill();
                // Bird eye
                ctx.fillStyle = 'black';
                ctx.beginPath();
                ctx.arc(bird.x + 10, bird.y - 5, 3, 0, Math.PI * 2);
                ctx.fill();
                // Bird beak
                ctx.fillStyle = 'orange';
                ctx.beginPath();
                ctx.moveTo(bird.x + 15, bird.y);
                ctx.lineTo(bird.x + 25, bird.y - 5);
                ctx.lineTo(bird.x + 25, bird.y + 5);
                ctx.closePath();
                ctx.fill();
                // Bird wing
                ctx.fillStyle = '#ffcc00';
                ctx.beginPath();
                ctx.ellipse(bird.x - 5, bird.y + 5, 8, 5, 0, 0, Math.PI * 2);
                ctx.fill();
                // Restore context
                ctx.restore();
            }
            function checkCollisions() {
                // Check if bird hits the ground
                if (bird.y + bird.height / 2 > canvas.height - 30) {
                    return true;
                }
                // Check if bird hits the ceiling
                if (bird.y - bird.height / 2 < 0) {
                    return true;
                }
                // Check if bird hits pipes
                for (let pipe of pipes) {
                    if (
                        bird.x + bird.width / 2 > pipe.x &&
                        bird.x - bird.width / 2 < pipe.x + pipe.width &&
                        bird.y + bird.height / 2 > pipe.y &&
                        bird.y - bird.height / 2 < pipe.y + pipe.height
                    ) {
                        return true;
                    }
                }
                return false;
            }
            function birdJump() {
                if (!gameRunning) return;
                bird.velocity = bird.jump;
            }
            function gameOver() {
                gameRunning = false;
                // Update high scores
                if (score > highScore) {
                    highScore = score;
                    highScoreDisplay.textContent = highScore;
                    saveHighScore('flappybird', highScore);
                }
                if (score > sessionHighScore) {
                    sessionHighScore = score;
                    sessionHighScoreDisplay.textContent = `Session High Score: ${sessionHighScore}`;
                }
                alert(`Game Over! Your score: ${score}`);
            }
            function handleKeyDown(e) {
                // Allow SPACE, W, or UP ARROW to make the bird jump
                if (e.code === 'Space' || e.key === 'w' || e.key === 'W' || e.key === 'ArrowUp') {
                    if (gameRunning) {
                        birdJump();
                    } else if (!gameRunning && document.getElementById('flappybird-game').classList.contains('active')) {
                        // Start game if not running
                        initGame();
                    }
                    e.preventDefault(); // Prevent scrolling
                }
            }
            startButton.addEventListener('click', () => {
                if (!gameRunning) {
                    initGame();
                }
            });
            document.addEventListener('keydown', handleKeyDown);
            return { init: () => { } };
        })();
        // Math Quiz Game
        const mathQuizGame = (() => {
            const problemDisplay = document.getElementById('mathquiz-problem');
            const optionsContainer = document.getElementById('mathquiz-options');
            const startButton = document.getElementById('mathquiz-start');
            const stopButton = document.getElementById('mathquiz-stop');
            const scoreDisplay = document.getElementById('mathquiz-score');
            const highScoreDisplay = document.getElementById('mathquiz-high-score');
            const streakDisplay = document.getElementById('mathquiz-streak');
            const sessionHighScoreDisplay = document.getElementById('mathquiz-session-high-score');
            const timerFill = document.getElementById('mathquiz-timer');
            let score = 0;
            let highScore = loadHighScore('mathquiz');
            let sessionHighScore = 0;
            let streak = 0;
            let currentAnswer = 0;
            let gameActive = false;
            let timerInterval;
            let timeLeft = 100; // percentage for timer bar
            // Initialize high score display
            highScoreDisplay.textContent = highScore;
            sessionHighScoreDisplay.textContent = `Session High Score: ${sessionHighScore}`;
            function initGame() {
                // Reset game state
                score = 0;
                streak = 0;
                scoreDisplay.textContent = score;
                streakDisplay.textContent = streak;
                gameActive = true;
                startButton.textContent = "Restart Quiz";
                startButton.disabled = true;
                stopButton.disabled = false;
                // Generate first problem
                generateProblem();
            }
            function stopGame() {
                gameActive = false;
                startButton.textContent = "Start Quiz";
                startButton.disabled = false;
                stopButton.disabled = true;
                // Clear timer
                if (timerInterval) {
                    clearInterval(timerInterval);
                    timerInterval = null;
                }
                // Reset display
                problemDisplay.textContent = "Quiz stopped. Click 'Start Quiz' to begin again!";
                optionsContainer.innerHTML = '';
                timerFill.style.width = '0%';
                // Update high scores if needed
                if (score > highScore) {
                    highScore = score;
                    highScoreDisplay.textContent = highScore;
                    saveHighScore('mathquiz', highScore);
                }
                if (score > sessionHighScore) {
                    sessionHighScore = score;
                    sessionHighScoreDisplay.textContent = `Session High Score: ${sessionHighScore}`;
                }
                alert(`Quiz stopped! Your final score: ${score}`);
            }
            function generateProblem() {
                // Reset timer
                timeLeft = 100;
                timerFill.style.width = '100%';
                timerFill.style.background = '#4CAF50';
                // Clear previous timer
                if (timerInterval) clearInterval(timerInterval);
                // Start timer
                timerInterval = setInterval(() => {
                    if (!gameActive) {
                        clearInterval(timerInterval);
                        return;
                    }
                    timeLeft -= 1.67; // ~60 seconds to empty
                    timerFill.style.width = `${Math.max(0, timeLeft)}%`;
                    // Change color based on time left
                    if (timeLeft < 25) {
                        timerFill.style.background = '#f44336';
                    } else if (timeLeft < 50) {
                        timerFill.style.background = '#ff9800';
                    }
                    if (timeLeft <= 0) {
                        clearInterval(timerInterval);
                        if (gameActive) {
                            // Time's up
                            streak = 0;
                            streakDisplay.textContent = streak;
                            showAnswer(false);
                            setTimeout(() => {
                                if (gameActive) generateProblem();
                            }, 1500);
                        }
                    }
                }, 100);
                // Operations: 0=addition, 1=subtraction, 2=multiplication, 3=division
                const operation = Math.floor(Math.random() * 4);
                let num1, num2, problem, answer;
                switch (operation) {
                    case 0: // Addition
                        num1 = Math.floor(Math.random() * 50) + 1;
                        num2 = Math.floor(Math.random() * 50) + 1;
                        answer = num1 + num2;
                        problem = `${num1} + ${num2} = ?`;
                        break;
                    case 1: // Subtraction
                        num1 = Math.floor(Math.random() * 50) + 1;
                        num2 = Math.floor(Math.random() * num1) + 1; // Ensure positive result
                        answer = num1 - num2;
                        problem = `${num1} - ${num2} = ?`;
                        break;
                    case 2: // Multiplication
                        num1 = Math.floor(Math.random() * 12) + 1;
                        num2 = Math.floor(Math.random() * 12) + 1;
                        answer = num1 * num2;
                        problem = `${num1} × ${num2} = ?`;
                        break;
                    case 3: // Division
                        num2 = Math.floor(Math.random() * 12) + 1;
                        answer = Math.floor(Math.random() * 12) + 1;
                        num1 = num2 * answer; // Ensure clean division
                        problem = `${num1} ÷ ${num2} = ?`;
                        break;
                }
                currentAnswer = answer;
                // Display problem
                problemDisplay.textContent = problem;
                // Generate answer options
                generateOptions(answer);
            }
            function generateOptions(correctAnswer) {
                // Clear previous options
                optionsContainer.innerHTML = '';
                // Create array of options
                const options = [correctAnswer];
                // Add 3 incorrect options
                while (options.length < 4) {
                    // Generate wrong answer within reasonable range
                    let wrongAnswer;
                    if (correctAnswer <= 10) {
                        wrongAnswer = correctAnswer + Math.floor(Math.random() * 21) - 10;
                    } else {
                        const range = Math.floor(correctAnswer * 0.5);
                        wrongAnswer = correctAnswer + Math.floor(Math.random() * (range * 2 + 1)) - range;
                    }
                    // Ensure wrong answer is not same as correct answer and not already in options
                    if (wrongAnswer !== correctAnswer && !options.includes(wrongAnswer) && wrongAnswer >= 0) {
                        options.push(wrongAnswer);
                    }
                }
                // Shuffle options
                for (let i = options.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [options[i], options[j]] = [options[j], options[i]];
                }
                // Create buttons for options
                options.forEach((option, index) => {
                    const button = document.createElement('button');
                    button.className = 'answer-btn';
                    button.textContent = option;
                    button.dataset.answer = option;
                    button.dataset.index = index + 1; // For keyboard shortcuts
                    button.addEventListener('click', () => {
                        if (!gameActive) return;
                        clearInterval(timerInterval);
                        if (parseInt(option) === correctAnswer) {
                            button.classList.add('correct');
                            score++;
                            streak++;
                            scoreDisplay.textContent = score;
                            streakDisplay.textContent = streak;
                            // Update high scores
                            if (score > highScore) {
                                highScore = score;
                                highScoreDisplay.textContent = highScore;
                                saveHighScore('mathquiz', highScore);
                            }
                            if (score > sessionHighScore) {
                                sessionHighScore = score;
                                sessionHighScoreDisplay.textContent = `Session High Score: ${sessionHighScore}`;
                            }
                            setTimeout(() => {
                                if (gameActive) generateProblem();
                            }, 1000);
                        } else {
                            button.classList.add('incorrect');
                            streak = 0;
                            streakDisplay.textContent = streak;
                            // Show correct answer
                            showAnswer(true);
                            setTimeout(() => {
                                if (gameActive) generateProblem();
                            }, 1500);
                        }
                    });
                    optionsContainer.appendChild(button);
                });
            }
            function showAnswer(hideTimer) {
                if (hideTimer && timerInterval) {
                    clearInterval(timerInterval);
                    timerFill.style.width = '0%';
                }
                // Highlight correct answer
                const buttons = optionsContainer.querySelectorAll('.answer-btn');
                buttons.forEach(button => {
                    if (parseInt(button.dataset.answer) === currentAnswer) {
                        button.classList.add('correct');
                    } else if (!button.classList.contains('correct')) {
                        button.classList.add('incorrect');
                    }
                });
            }
            function handleKeyDown(e) {
                if (!gameActive || !document.getElementById('mathquiz-game').classList.contains('active')) return;
                // Handle number keys 1-4 for answer selection
                if (e.key >= '1' && e.key <= '4') {
                    const index = parseInt(e.key) - 1;
                    const buttons = optionsContainer.querySelectorAll('.answer-btn');
                    if (index < buttons.length) {
                        buttons[index].click();
                    }
                }
            }
            startButton.addEventListener('click', () => {
                if (timerInterval) clearInterval(timerInterval);
                initGame();
            });
            stopButton.addEventListener('click', stopGame);
            // Initialize stop button state
            stopButton.disabled = true;
            document.addEventListener('keydown', handleKeyDown);
            return { init: () => { } };
        })();
        // Ping Pong Game
        const pingPongGame = (() => {
            const canvas = document.getElementById('pong-canvas');
            const ctx = canvas.getContext('2d');
            const startButton = document.getElementById('pong-start');
            const scoreDisplay = document.getElementById('pong-score');
            const pvpButton = document.getElementById('pong-pvp');
            const pvcButton = document.getElementById('pong-pvc');
            const modeInfo = document.getElementById('pong-mode-info');
            const paddleHeight = 100;
            const paddleWidth = 10;
            const ballSize = 10;
            let player1Y = canvas.height / 2 - paddleHeight / 2;
            let player2Y = canvas.height / 2 - paddleHeight / 2;
            let ballX = canvas.width / 2;
            let ballY = canvas.height / 2;
            let ballSpeedX = 5;
            let ballSpeedY = 5;
            let player1Score = 0;
            let player2Score = 0;
            let gameInterval;
            let gameRunning = false;
            let vsComputer = false;
            let computerDifficulty = 0.1; // 0-1, how perfectly computer plays
            function initGame() {
                // Reset positions
                player1Y = canvas.height / 2 - paddleHeight / 2;
                player2Y = canvas.height / 2 - paddleHeight / 2;
                ballX = canvas.width / 2;
                ballY = canvas.height / 2;
                // Randomize initial ball direction
                ballSpeedX = Math.random() > 0.5 ? 5 : -5;
                ballSpeedY = Math.random() * 6 - 3;
                // Reset scores if starting new game
                if (!gameRunning) {
                    player1Score = 0;
                    player2Score = 0;
                    updateScoreDisplay();
                }
                // Clear any existing game loop
                if (gameInterval) clearInterval(gameInterval);
                // Start game loop
                gameRunning = true;
                gameInterval = setInterval(gameLoop, 1000 / 60); // 60 FPS
            }
            function gameLoop() {
                // Move player 1 paddle based on key states (W/S keys)
                if (keys.w && player1Y > 0) player1Y -= 5;
                if (keys.s && player1Y < canvas.height - paddleHeight) player1Y += 5;
                // Move player 2 paddle (either by player or computer)
                if (vsComputer) {
                    // Computer AI
                    const computerPaddleCenter = player2Y + paddleHeight / 2;
                    const ballPaddleDistance = ballY - computerPaddleCenter;
                    // Only move if ball is moving toward computer paddle
                    if (ballSpeedX > 0) {
                        // Add some imperfection to make it beatable
                        const reactionFactor = 1 - (Math.random() * computerDifficulty);
                        const moveDistance = ballPaddleDistance * reactionFactor;
                        if (Math.abs(moveDistance) > 2) {
                            if (moveDistance > 0 && player2Y < canvas.height - paddleHeight) {
                                player2Y += Math.min(5, moveDistance);
                            } else if (moveDistance < 0 && player2Y > 0) {
                                player2Y -= Math.min(5, Math.abs(moveDistance));
                            }
                        }
                    }
                } else {
                    // Player 2 controls (Up/Down arrows or A/D keys or I/K keys)
                    if ((keys.ArrowUp || keys.a || keys.i) && player2Y > 0) player2Y -= 5;
                    if ((keys.ArrowDown || keys.d || keys.k) && player2Y < canvas.height - paddleHeight) player2Y += 5;
                }
                // Move ball
                ballX += ballSpeedX;
                ballY += ballSpeedY;
                // Ball collision with top and bottom
                if (ballY < 0 || ballY > canvas.height - ballSize) {
                    ballSpeedY = -ballSpeedY;
                }
                // Ball collision with paddles
                if (
                    ballX <= paddleWidth &&
                    ballY >= player1Y &&
                    ballY <= player1Y + paddleHeight
                ) {
                    ballSpeedX = -ballSpeedX;
                    // Add some variation to the bounce angle based on where the ball hits the paddle
                    const deltaY = ballY - (player1Y + paddleHeight / 2);
                    ballSpeedY = deltaY * 0.3;
                }
                if (
                    ballX >= canvas.width - paddleWidth - ballSize &&
                    ballY >= player2Y &&
                    ballY <= player2Y + paddleHeight
                ) {
                    ballSpeedX = -ballSpeedX;
                    // Add some variation to the bounce angle based on where the ball hits the paddle
                    const deltaY = ballY - (player2Y + paddleHeight / 2);
                    ballSpeedY = deltaY * 0.3;
                }
                // Score points
                if (ballX < 0) {
                    player2Score++;
                    updateScoreDisplay();
                    checkWinCondition();
                    resetBall();
                } else if (ballX > canvas.width) {
                    player1Score++;
                    updateScoreDisplay();
                    checkWinCondition();
                    resetBall();
                }
                // Draw everything
                drawGame();
            }
            function resetBall() {
                ballX = canvas.width / 2;
                ballY = canvas.height / 2;
                ballSpeedY = Math.random() * 6 - 3;
                ballSpeedX = ballSpeedX > 0 ? 5 : -5;
            }
            function checkWinCondition() {
                if (player1Score >= 5 || player2Score >= 5) {
                    const winner = player1Score >= 5 ? (vsComputer ? "Player" : "Player 1") : (vsComputer ? "Computer" : "Player 2");
                    setTimeout(() => {
                        alert(`${winner} wins the game!`);
                        gameRunning = false;
                        clearInterval(gameInterval);
                    }, 100);
                }
            }
            function updateScoreDisplay() {
                scoreDisplay.textContent = `${player1Score} : ${player2Score}`;
            }
            function drawGame() {
                // Clear canvas
                ctx.fillStyle = '#222';
                ctx.fillRect(0, 0, canvas.width, canvas.height);
                // Draw middle line
                ctx.setLineDash([5, 15]);
                ctx.beginPath();
                ctx.moveTo(canvas.width / 2, 0);
                ctx.lineTo(canvas.width / 2, canvas.height);
                ctx.strokeStyle = 'white';
                ctx.stroke();
                ctx.setLineDash([]);
                // Draw paddles
                ctx.fillStyle = 'white';
                ctx.fillRect(0, player1Y, paddleWidth, paddleHeight); // Player 1
                ctx.fillRect(canvas.width - paddleWidth, player2Y, paddleWidth, paddleHeight); // Player 2/Computer
                // Draw ball
                ctx.fillRect(ballX, ballY, ballSize, ballSize);
            }
            function toggleMode(isVsComputer) {
                vsComputer = isVsComputer;
                if (vsComputer) {
                    modeInfo.textContent = "Player (left): W/S keys | Computer (right)";
                } else {
                    modeInfo.textContent = "Player 1 (left): W/S keys | Player 2 (right): Up/Down arrows, A/D, or I/K keys";
                }
            }
            // Track key states
            const keys = {
                w: false,
                s: false,
                a: false,
                d: false,
                i: false, // Added for Player 2 up
                k: false, // Added for Player 2 down
                ArrowUp: false,
                ArrowDown: false
            };
            document.addEventListener('keydown', (e) => {
                const key = e.key;
                if (['w', 'W', 's', 'S', 'a', 'A', 'd', 'D', 'i', 'I', 'k', 'K', 'ArrowUp', 'ArrowDown'].includes(key)) {
                    // Convert to lowercase for our keys object
                    const normalizedKey = key.toLowerCase();
                    keys[normalizedKey] = true;
                    // Also handle Arrow keys
                    if (key === 'ArrowUp' || key === 'ArrowDown') {
                        keys[key] = true;
                    }
                    e.preventDefault(); // Prevent scrolling
                }
            });
            document.addEventListener('keyup', (e) => {
                const key = e.key;
                if (['w', 'W', 's', 'S', 'a', 'A', 'd', 'D', 'i', 'I', 'k', 'K', 'ArrowUp', 'ArrowDown'].includes(key)) {
                    // Convert to lowercase for our keys object
                    const normalizedKey = key.toLowerCase();
                    keys[normalizedKey] = false;
                    // Also handle Arrow keys
                    if (key === 'ArrowUp' || key === 'ArrowDown') {
                        keys[key] = false;
                    }
                }
            });
            startButton.addEventListener('click', initGame);
            pvpButton.addEventListener('click', () => {
                pvpButton.classList.add('active');
                pvcButton.classList.remove('active');
                toggleMode(false);
            });
            pvcButton.addEventListener('click', () => {
                pvcButton.classList.add('active');
                pvpButton.classList.remove('active');
                toggleMode(true);
            });
            return { init: () => { } };
        })();
        // Billiards Game
        const billiardsGame = (() => {
            const canvas = document.getElementById('billiards-canvas');
            const ctx = canvas.getContext('2d');
            const startButton = document.getElementById('billiards-start');
            const resetCueButton = document.getElementById('billiards-reset-cue');
            const scoreDisplay = document.getElementById('billiards-score');
            const highScoreDisplay = document.getElementById('billiards-high-score');
            const ballsPottedDisplay = document.getElementById('billiards-balls-potted');
            const sessionHighScoreDisplay = document.getElementById('billiards-session-high-score');
            const powerFill = document.getElementById('billiards-power-fill');
            const powerValue = document.getElementById('billiards-power-value');
            // Game variables
            let balls = [];
            let cueBall = {};
            let isAiming = false;
            let aimingAngle = 0;
            let power = 50;
            let powerDirection = 1;
            let score = 0;
            let highScore = loadHighScore('billiards');
            let sessionHighScore = 0;
            let ballsPotted = 0;
            let gameRunning = false;
            let animationId;
            // Ball types for billiards
            const ballTypes = [
                { color: '#ffffff', value: 0, radius: 9, type: 'cue', isCue: true },
                { color: '#ffffff', value: 1, radius: 8, type: 'solid', stripe: false, number: 1 }, // Solid 1
                { color: '#0000ff', value: 1, radius: 8, type: 'solid', stripe: false, number: 2 }, // Solid 2
                { color: '#ff0000', value: 1, radius: 8, type: 'solid', stripe: false, number: 3 }, // Solid 3
                { color: '#800080', value: 1, radius: 8, type: 'solid', stripe: false, number: 4 }, // Solid 4
                { color: '#ffa500', value: 1, radius: 8, type: 'solid', stripe: false, number: 5 }, // Solid 5
                { color: '#008000', value: 1, radius: 8, type: 'solid', stripe: false, number: 6 }, // Solid 6
                { color: '#c0c0c0', value: 1, radius: 8, type: 'solid', stripe: false, number: 7 }, // Solid 7
                { color: '#000000', value: 5, radius: 8, type: 'eight', stripe: false, number: 8 }, // 8-Ball
                { color: '#ffffff', value: 2, radius: 8, type: 'stripe', stripe: true, number: 9 }, // Stripe 9
                { color: '#0000ff', value: 2, radius: 8, type: 'stripe', stripe: true, number: 10 }, // Stripe 10
                { color: '#ff0000', value: 2, radius: 8, type: 'stripe', stripe: true, number: 11 }, // Stripe 11
                { color: '#800080', value: 2, radius: 8, type: 'stripe', stripe: true, number: 12 }, // Stripe 12
                { color: '#ffa500', value: 2, radius: 8, type: 'stripe', stripe: true, number: 13 }, // Stripe 13
                { color: '#008000', value: 2, radius: 8, type: 'stripe', stripe: true, number: 14 }, // Stripe 14
                { color: '#c0c0c0', value: 2, radius: 8, type: 'stripe', stripe: true, number: 15 } // Stripe 15
            ];
            // Pocket positions
            const pockets = [
                { x: 10, y: 10, radius: 15 },           // Top left
                { x: canvas.width / 2, y: 10, radius: 15 },  // Top middle
                { x: canvas.width - 10, y: 10, radius: 15 }, // Top right
                { x: 10, y: canvas.height - 10, radius: 15 }, // Bottom left
                { x: canvas.width / 2, y: canvas.height - 10, radius: 15 }, // Bottom middle
                { x: canvas.width - 10, y: canvas.height - 10, radius: 15 } // Bottom right
            ];
            function initGame() {
                // Reset game state
                balls = [];
                score = 0;
                ballsPotted = 0;
                power = 50;
                isAiming = false;
                // Update displays
                scoreDisplay.textContent = score;
                ballsPottedDisplay.textContent = ballsPotted;
                // Create cue ball
                cueBall = {
                    x: canvas.width / 4,
                    y: canvas.height / 2,
                    radius: 9,
                    color: '#ffffff',
                    vx: 0,
                    vy: 0,
                    isCueBall: true,
                    active: true
                };
                // Create racked balls (simplified triangle)
                createRackedBalls();
                // Start animation
                if (animationId) {
                    cancelAnimationFrame(animationId);
                }
                gameRunning = true;
                gameLoop();
            }
            function createRackedBalls() {
                const rows = 5;
                const startX = canvas.width * 0.7;
                const startY = canvas.height / 2;
                const spacing = 20;
                let ballIndex = 1; // Start from 1 (skip cue ball)
                for (let row = 0; row < rows; row++) {
                    for (let col = 0; col <= row; col++) {
                        if (ballIndex < ballTypes.length) {
                            const ballType = ballTypes[ballIndex];
                            // For row 2 (middle of triangle), place 8-ball
                            if (row === 2 && col === 1) {
                                const eightBall = ballTypes.find(b => b.number === 8);
                                balls.push({
                                    x: startX + row * spacing,
                                    y: startY - (row * spacing / 2) + col * spacing,
                                    radius: eightBall.radius,
                                    color: eightBall.color,
                                    vx: 0,
                                    vy: 0,
                                    value: eightBall.value,
                                    type: eightBall.type,
                                    stripe: eightBall.stripe,
                                    number: eightBall.number,
                                    active: true
                                });
                            } else {
                                balls.push({
                                    x: startX + row * spacing,
                                    y: startY - (row * spacing / 2) + col * spacing,
                                    radius: ballType.radius,
                                    color: ballType.color,
                                    vx: 0,
                                    vy: 0,
                                    value: ballType.value,
                                    type: ballType.type,
                                    stripe: ballType.stripe,
                                    number: ballType.number,
                                    active: true
                                });
                            }
                            ballIndex++;
                        }
                    }
                }
            }
            function gameLoop() {
                if (!gameRunning) return;
                // Update power indicator
                power += 0.5 * powerDirection;
                if (power >= 100 || power <= 10) {
                    powerDirection *= -1;
                }
                powerFill.style.width = `${power}%`;
                powerValue.textContent = Math.round(power);
                // Update ball positions
                updateBalls();
                // Check for collisions
                checkCollisions();
                // Check if balls are potted
                checkPockets();
                // Draw everything
                drawGame();
                // Continue animation
                animationId = requestAnimationFrame(gameLoop);
            }
            function updateBalls() {
                // Update cue ball
                if (cueBall.active) {
                    cueBall.x += cueBall.vx;
                    cueBall.y += cueBall.vy;
                    // Apply friction
                    cueBall.vx *= 0.98;
                    cueBall.vy *= 0.98;
                    // Stop if very slow
                    if (Math.abs(cueBall.vx) < 0.1 && Math.abs(cueBall.vy) < 0.1) {
                        cueBall.vx = 0;
                        cueBall.vy = 0;
                    }
                    // Bounce off walls
                    if (cueBall.x - cueBall.radius < 0) {
                        cueBall.x = cueBall.radius;
                        cueBall.vx = -cueBall.vx * 0.8;
                    }
                    if (cueBall.x + cueBall.radius > canvas.width) {
                        cueBall.x = canvas.width - cueBall.radius;
                        cueBall.vx = -cueBall.vx * 0.8;
                    }
                    if (cueBall.y - cueBall.radius < 0) {
                        cueBall.y = cueBall.radius;
                        cueBall.vy = -cueBall.vy * 0.8;
                    }
                    if (cueBall.y + cueBall.radius > canvas.height) {
                        cueBall.y = canvas.height - cueBall.radius;
                        cueBall.vy = -cueBall.vy * 0.8;
                    }
                }
                // Update other balls
                for (let i = 0; i < balls.length; i++) {
                    if (!balls[i].active) continue;
                    balls[i].x += balls[i].vx;
                    balls[i].y += balls[i].vy;
                    // Apply friction
                    balls[i].vx *= 0.98;
                    balls[i].vy *= 0.98;
                    // Stop if very slow
                    if (Math.abs(balls[i].vx) < 0.1 && Math.abs(balls[i].vy) < 0.1) {
                        balls[i].vx = 0;
                        balls[i].vy = 0;
                    }
                    // Bounce off walls
                    if (balls[i].x - balls[i].radius < 0) {
                        balls[i].x = balls[i].radius;
                        balls[i].vx = -balls[i].vx * 0.8;
                    }
                    if (balls[i].x + balls[i].radius > canvas.width) {
                        balls[i].x = canvas.width - balls[i].radius;
                        balls[i].vx = -balls[i].vx * 0.8;
                    }
                    if (balls[i].y - balls[i].radius < 0) {
                        balls[i].y = balls[i].radius;
                        balls[i].vy = -balls[i].vy * 0.8;
                    }
                    if (balls[i].y + balls[i].radius > canvas.height) {
                        balls[i].y = canvas.height - balls[i].radius;
                        balls[i].vy = -balls[i].vy * 0.8;
                    }
                }
            }
            function checkCollisions() {
                // Cue ball collisions with other balls
                if (cueBall.active) {
                    for (let i = 0; i < balls.length; i++) {
                        if (!balls[i].active) continue;
                        const dx = balls[i].x - cueBall.x;
                        const dy = balls[i].y - cueBall.y;
                        const distance = Math.sqrt(dx * dx + dy * dy);
                        const minDistance = cueBall.radius + balls[i].radius;
                        if (distance < minDistance) {
                            // Collision detected
                            const angle = Math.atan2(dy, dx);
                            const speed = Math.sqrt(cueBall.vx * cueBall.vx + cueBall.vy * cueBall.vy);
                            // Simple collision response
                            const targetSpeed = speed * 0.8;
                            balls[i].vx = Math.cos(angle) * targetSpeed;
                            balls[i].vy = Math.sin(angle) * targetSpeed;
                            // Move balls apart to prevent sticking
                            const overlap = minDistance - distance;
                            const moveX = (overlap / 2) * Math.cos(angle);
                            const moveY = (overlap / 2) * Math.sin(angle);
                            cueBall.x -= moveX;
                            cueBall.y -= moveY;
                            balls[i].x += moveX;
                            balls[i].y += moveY;
                        }
                    }
                }
                // Ball-to-ball collisions
                for (let i = 0; i < balls.length; i++) {
                    if (!balls[i].active) continue;
                    for (let j = i + 1; j < balls.length; j++) {
                        if (!balls[j].active) continue;
                        const dx = balls[j].x - balls[i].x;
                        const dy = balls[j].y - balls[i].y;
                        const distance = Math.sqrt(dx * dx + dy * dy);
                        const minDistance = balls[i].radius + balls[j].radius;
                        if (distance < minDistance) {
                            // Collision detected
                            const angle = Math.atan2(dy, dx);
                            const speed1 = Math.sqrt(balls[i].vx * balls[i].vx + balls[i].vy * balls[i].vy);
                            const speed2 = Math.sqrt(balls[j].vx * balls[j].vx + balls[j].vy * balls[j].vy);
                            // Simple collision response
                            const tempVx = balls[i].vx;
                            const tempVy = balls[i].vy;
                            balls[i].vx = balls[j].vx * 0.8;
                            balls[i].vy = balls[j].vy * 0.8;
                            balls[j].vx = tempVx * 0.8;
                            balls[j].vy = tempVy * 0.8;
                            // Move balls apart to prevent sticking
                            const overlap = minDistance - distance;
                            const moveX = (overlap / 2) * Math.cos(angle);
                            const moveY = (overlap / 2) * Math.sin(angle);
                            balls[i].x -= moveX;
                            balls[i].y -= moveY;
                            balls[j].x += moveX;
                            balls[j].y += moveY;
                        }
                    }
                }
            }
            function checkPockets() {
                // Check if cue ball is potted
                if (cueBall.active) {
                    for (let i = 0; i < pockets.length; i++) {
                        const dx = pockets[i].x - cueBall.x;
                        const dy = pockets[i].y - cueBall.y;
                        const distance = Math.sqrt(dx * dx + dy * dy);
                        if (distance < pockets[i].radius) {
                            // Cue ball potted
                            cueBall.active = false;
                            // Penalize for potting cue ball
                            score = Math.max(0, score - 4); // Minimum score is 0
                            scoreDisplay.textContent = score;
                            break;
                        }
                    }
                }
                // Check if other balls are potted
                for (let i = 0; i < balls.length; i++) {
                    if (!balls[i].active) continue;
                    for (let j = 0; j < pockets.length; j++) {
                        const dx = pockets[j].x - balls[i].x;
                        const dy = pockets[j].y - balls[i].y;
                        const distance = Math.sqrt(dx * dx + dy * dy);
                        if (distance < pockets[j].radius) {
                            // Ball potted
                            balls[i].active = false;
                            score += balls[i].value;
                            ballsPotted++;
                            scoreDisplay.textContent = score;
                            ballsPottedDisplay.textContent = ballsPotted;
                            break;
                        }
                    }
                }
                // Check if all balls are potted
                let activeBalls = balls.filter(ball => ball.active).length;
                if (activeBalls === 0 && !cueBall.active) {
                    endGame();
                }
            }
            function drawGame() {
                // Clear canvas
                ctx.fillStyle = '#0b6e2b'; // Green billiards table
                ctx.fillRect(0, 0, canvas.width, canvas.height);
                // Draw table border
                ctx.strokeStyle = '#5a3b1c';
                ctx.lineWidth = 10;
                ctx.strokeRect(0, 0, canvas.width, canvas.height);
                // Draw pockets
                ctx.fillStyle = '#000000';
                for (let pocket of pockets) {
                    ctx.beginPath();
                    ctx.arc(pocket.x, pocket.y, pocket.radius, 0, Math.PI * 2);
                    ctx.fill();
                }
                // Draw cue ball if active
                if (cueBall.active) {
                    ctx.fillStyle = cueBall.color;
                    ctx.beginPath();
                    ctx.arc(cueBall.x, cueBall.y, cueBall.radius, 0, Math.PI * 2);
                    ctx.fill();
                    // Draw aiming line if aiming
                    if (isAiming) {
                        const lineLength = 100;
                        const endX = cueBall.x + Math.cos(aimingAngle) * lineLength;
                        const endY = cueBall.y + Math.sin(aimingAngle) * lineLength;
                        ctx.strokeStyle = 'rgba(255, 255, 255, 0.5)';
                        ctx.lineWidth = 2;
                        ctx.setLineDash([5, 5]);
                        ctx.beginPath();
                        ctx.moveTo(cueBall.x, cueBall.y);
                        ctx.lineTo(endX, endY);
                        ctx.stroke();
                        ctx.setLineDash([]);
                    }
                }
                // Draw other balls
                for (let ball of balls) {
                    if (!ball.active) continue;
                    // Draw ball base
                    ctx.fillStyle = ball.color;
                    ctx.beginPath();
                    ctx.arc(ball.x, ball.y, ball.radius, 0, Math.PI * 2);
                    ctx.fill();
                    // Draw stripe if it's a striped ball
                    if (ball.stripe) {
                        ctx.fillStyle = '#ffffff';
                        ctx.beginPath();
                        ctx.arc(ball.x, ball.y, ball.radius * 0.6, 0, Math.PI * 2);
                        ctx.fill();
                    }
                    // Draw number
                    if (ball.number > 0) {
                        ctx.fillStyle = ball.stripe ? ball.color : '#ffffff';
                        ctx.font = '8px Arial';
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'middle';
                        ctx.fillText(ball.number.toString(), ball.x, ball.y);
                    }
                }
            }
            function shootCueBall() {
                if (!cueBall.active || !gameRunning) return;
                // Calculate velocity based on power and angle
                const maxSpeed = 15;
                const speed = (power / 100) * maxSpeed;
                cueBall.vx = Math.cos(aimingAngle) * speed;
                cueBall.vy = Math.sin(aimingAngle) * speed;
                isAiming = false;
            }
            function resetCueBall() {
                if (gameRunning) {
                    cueBall.x = canvas.width / 4;
                    cueBall.y = canvas.height / 2;
                    cueBall.vx = 0;
                    cueBall.vy = 0;
                    cueBall.active = true;
                    isAiming = false;
                }
            }
            function endGame() {
                gameRunning = false;
                if (animationId) {
                    cancelAnimationFrame(animationId);
                }
                // Update high scores
                if (score > highScore) {
                    highScore = score;
                    highScoreDisplay.textContent = highScore;
                    saveHighScore('billiards', highScore);
                }
                if (score > sessionHighScore) {
                    sessionHighScore = score;
                    sessionHighScoreDisplay.textContent = `Session High Score: ${sessionHighScore}`;
                }
                alert(`Game Over! Your score: ${score}
Balls potted: ${ballsPotted}`);
            }
            // Event Listeners
            canvas.addEventListener('mousemove', (e) => {
                if (!cueBall.active || !gameRunning) return;
                const rect = canvas.getBoundingClientRect();
                const mouseX = e.clientX - rect.left;
                const mouseY = e.clientY - rect.top;
                // Calculate aiming angle
                const dx = mouseX - cueBall.x;
                const dy = mouseY - cueBall.y;
                aimingAngle = Math.atan2(dy, dx);
                isAiming = true;
            });
            canvas.addEventListener('click', () => {
                if (isAiming && cueBall.active && gameRunning) {
                    shootCueBall();
                }
            });
            document.addEventListener('keydown', (e) => {
                if (e.code === 'Space' && document.getElementById('billiards-game').classList.contains('active')) {
                    e.preventDefault();
                    resetCueBall();
                }
            });
            startButton.addEventListener('click', () => {
                initGame();
            });
            resetCueButton.addEventListener('click', resetCueBall);
            return { init: () => { } };
        })();
        // Initialize all games
        document.addEventListener('DOMContentLoaded', () => {
            tictactoe.init();
            snakeGame.init();
            flappyBirdGame.init();
            pingPongGame.init();
            mathQuizGame.init();
            billiardsGame.init();
        });
    </script>
</body>
</html>