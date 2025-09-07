<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Typing Speed Test - Bepa Game Center</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #020202ff;
            color: white;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }
        header {
            background: #333;
            color: #579955ff;
            padding: 20px;
            font-size: 24px;
            margin-bottom: 30px;
        }
        .btn {
            display: inline-block;
            padding: 15px 30px;
            margin: 15px;
            font-size: 18px;
            color: white;
            background: #007BFF;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s;
            cursor: pointer;
        }
        .btn:hover {
            background: #000203ff;
        }
        #game-container {
            background: #1a1a1a;
            padding: 30px;
            border-radius: 10px;
            margin: 20px 0;
            display: none;
        }
        #text-display {
            font-size: 26px;
            line-height: 1.6;
            margin-bottom: 20px;
            padding: 25px;
            background: #2a2a2a;
            border-radius: 8px;
            text-align: left;
            min-height: 120px;
            letter-spacing: 0.5px;
        }
        #input-area {
            width: 100%;
            padding: 20px;
            font-size: 22px;
            border: 2px solid #333;
            border-radius: 8px;
            margin-bottom: 20px;
            background: #333;
            color: white;
            line-height: 1.5;
            resize: none;
        }
        #input-area:focus {
            outline: none;
            border-color: #007BFF;
        }
        #result {
            font-size: 28px;
            margin: 25px 0;
            font-weight: bold;
            color: #579955ff;
        }
        #timer {
            font-size: 32px;
            margin: 25px 0;
            font-weight: bold;
            color: #007BFF;
        }
        .highlight {
            background-color: #007BFF;
            color: white;
            border-radius: 3px;
        }
        .error {
            background-color: #ff4757;
            color: white;
            border-radius: 3px;
        }
        #name-form {
            background: #1a1a1a;
            padding: 30px;
            border-radius: 10px;
            margin: 20px 0;
        }
        input[name="player_name"] {
            padding: 15px;
            font-size: 18px;
            width: 300px;
            margin-right: 15px;
            border: 2px solid #333;
            border-radius: 5px;
            background: #333;
            color: white;
        }
        .leaderboard {
            margin-top: 40px;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #1a1a1a;
            border-radius: 5px;
            overflow: hidden;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #333;
        }
        th {
            background: #333;
            color: #579955ff;
        }
        tr:hover {
            background: #2a2a2a;
        }
        .notification {
            background: #ff4757;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 15px 0;
            display: inline-block;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header>
        <h1>Typing Speed Test</h1>
    </header>

    <div class="container">
        <?php
        // Database configuration
        $servername = "localhost";
        $username = "root"; // Change as needed
        $password = ""; // Change as needed
        $dbname = "bepa_game_center";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Create database if it doesn't exist
        $create_db_sql = "CREATE DATABASE IF NOT EXISTS $dbname";
        if (!$conn->query($create_db_sql)) {
            die("Error creating database: " . $conn->error);
        }

        // Select database
        $conn->select_db($dbname);

        // Create table if it doesn't exist
        $create_table_sql = "CREATE TABLE IF NOT EXISTS typing_records (
            id INT AUTO_INCREMENT PRIMARY KEY,
            player_name VARCHAR(50) NOT NULL UNIQUE,
            highest_wpm INT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";

        if (!$conn->query($create_table_sql)) {
            die("Error creating table: " . $conn->error);
        }

        // Process form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['player_name']) && !empty($_POST['player_name'])) {
                $player_name = trim($_POST['player_name']);
                
                // Validate player name (no spaces)
                if (preg_match('/\s/', $player_name)) {
                    echo "<div class='notification'>Player name cannot contain spaces!</div>";
                } else {
                    // Check if player exists
                    $stmt = $conn->prepare("SELECT highest_wpm FROM typing_records WHERE player_name = ?");
                    $stmt->bind_param("s", $player_name);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $highest_wpm = $row['highest_wpm'];
                    } else {
                        $highest_wpm = 0;
                    }
                    
                    $stmt->close();
                    
                    // Display game with player name
                    echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById('player-name').value = '" . addslashes($player_name) . "';
                            document.getElementById('current-highest').textContent = '" . $highest_wpm . "';
                            document.getElementById('name-form').style.display = 'none';
                            document.getElementById('game-container').style.display = 'block';
                        });
                    </script>";
                }
            }
            
            // Save score if submitted
            if (isset($_POST['save_score']) && isset($_POST['player_name']) && isset($_POST['wpm'])) {
                $player_name = trim($_POST['player_name']);
                $wpm = intval($_POST['wpm']);
                
                // Check if player exists
                $stmt = $conn->prepare("SELECT id, highest_wpm FROM typing_records WHERE player_name = ?");
                $stmt->bind_param("s", $player_name);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result->num_rows > 0) {
                    // Update existing record if new score is higher
                    $row = $result->fetch_assoc();
                    if ($wpm > $row['highest_wpm']) {
                        $update_stmt = $conn->prepare("UPDATE typing_records SET highest_wpm = ? WHERE player_name = ?");
                        $update_stmt->bind_param("is", $wpm, $player_name);
                        $update_stmt->execute();
                        $update_stmt->close();
                    }
                } else {
                    // Insert new record
                    $insert_stmt = $conn->prepare("INSERT INTO typing_records (player_name, highest_wpm) VALUES (?, ?)");
                    $insert_stmt->bind_param("si", $player_name, $wpm);
                    $insert_stmt->execute();
                    $insert_stmt->close();
                }
                
                $stmt->close();
                
                echo "<script>
                    alert('Your score has been saved!');
                    window.location.href = '/onlinegame';
                </script>";
            }
        }

        // Get leaderboard
        $leaderboard_sql = "SELECT player_name, highest_wpm FROM typing_records ORDER BY highest_wpm DESC LIMIT 10";
        $leaderboard_result = $conn->query($leaderboard_sql);
        ?>

        <!-- Player Name Form -->
        <div id="name-form">
            <h2>Enter Your Player Name</h2>
            <p>(No spaces allowed)</p>
            <form method="POST" action="">
                <input type="text" name="player_name" placeholder="Enter your name" required>
                <button type="submit" class="btn">Start Game</button>
            </form>
        </div>

        <!-- Game Container -->
        <div id="game-container">
            <input type="hidden" id="player-name" name="player-name">
            <h2>Current Highest WPM: <span id="current-highest">0</span></h2>
            
            <div id="text-display"></div>
            <textarea id="input-area" rows="5" disabled></textarea>
            <div id="timer">Time: 60s</div>
            <div id="result"></div>
            
            <button id="start-btn" class="btn">Start Test</button>
            <button id="restart-btn" class="btn" style="display: none;">Try Again</button>
        </div>

        <!-- Leaderboard -->
        <div class="leaderboard">
            <h2>Leaderboard</h2>
            <table>
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Player Name</th>
                        <th>Highest WPM</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($leaderboard_result->num_rows > 0) {
                        $rank = 1;
                        while($row = $leaderboard_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $rank . "</td>";
                            echo "<td>" . htmlspecialchars($row['player_name']) . "</td>";
                            echo "<td>" . $row['highest_wpm'] . "</td>";
                            echo "</tr>";
                            $rank++;
                        }
                    } else {
                        echo "<tr><td colspan='3'>No records yet. Be the first to play!</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <a href="/" class="btn">Back to Home</a>
    </div>

    <script>
        // Expanded sample texts for typing test (larger and more varied)
        const sampleTexts = [
            "The quick brown fox jumps over the lazy dog. This sentence contains all the letters in the English alphabet. Practice typing to improve your speed and accuracy.",
            "Programming is the process of creating a set of instructions that tell a computer how to perform a task. Developers use various programming languages like JavaScript, Python, and Java.",
            "Typing speed is typically measured in words per minute. The average typing speed is around 40 WPM, while professional typists can achieve 75 WPM or more with high accuracy.",
            "Practice makes perfect. The more you practice typing, the faster and more accurate you will become. Touch typing without looking at the keyboard is a valuable skill in today's digital world.",
            "Artificial intelligence is the simulation of human intelligence processes by machines, especially computer systems. AI applications include expert systems, natural language processing, and machine vision.",
            "The Internet is a global network of billions of computers and other electronic devices connected together. It allows people to share information and communicate from anywhere in the world.",
            "Video games are electronic games that involve interaction with a user interface to generate visual feedback on a display device. The gaming industry has grown to become larger than movies and music combined.",
            "Cloud computing is the delivery of computing services over the internet including storage, databases, networking, software, and analytics. It offers faster innovation and flexible resources for businesses.",
            "Cybersecurity is the practice of protecting systems, networks, and programs from digital attacks. These attacks are usually aimed at accessing, changing, or destroying sensitive information.",
            "Virtual reality is a simulated experience that can be similar to or completely different from the real world. Applications of VR include entertainment, education, and training simulations.",
            "Machine learning is a method of data analysis that automates analytical model building. It is a branch of artificial intelligence based on the idea that systems can learn from data.",
            "Blockchain technology is a decentralized digital ledger that securely stores records across a network of computers. It is most commonly associated with cryptocurrencies like Bitcoin and Ethereum.",
            "Quantum computing is a type of computation that takes advantage of quantum-mechanical phenomena. Unlike classical computers, quantum computers use qubits instead of bits to process information.",
            "The Internet of Things refers to the network of physical objects embedded with sensors and software. These devices exchange data with other devices and systems over the internet.",
            "Data science is an interdisciplinary field that uses scientific methods and algorithms to extract knowledge from data. Data scientists analyze large amounts of structured and unstructured data.",
            "Augmented reality enhances the real world by overlaying digital information on it. Unlike virtual reality, AR doesn't replace the real world but enhances it with computer-generated elements.",
            "5G technology is the fifth generation of cellular network technology. It promises faster speeds, lower latency, and greater capacity than previous generations, enabling new applications and services.",
            "Self-driving cars use a combination of sensors, cameras, radar, and artificial intelligence to travel between destinations without a human operator. They represent the future of transportation.",
            "Renewable energy comes from natural sources that are constantly replenished, such as sunlight, wind, and water. Transitioning to renewable energy is crucial for addressing climate change.",
            "Biotechnology involves using living organisms to develop products and technologies. Applications include medicine, agriculture, and environmental conservation, improving quality of life globally.",
            "Space exploration is the investigation of outer space by means of astronomy and space technology. Recent developments include private companies launching missions and plans for Mars colonization.",
            "Nanotechnology involves manipulating matter at the atomic or molecular scale. This technology has applications in medicine, electronics, and materials science, creating innovative solutions.",
            "Robotics is an interdisciplinary branch of engineering that involves the design and operation of robots. Robots are increasingly used in manufacturing, healthcare, and even in homes as assistants.",
            "Digital transformation is the integration of digital technology into all areas of a business. It fundamentally changes how businesses operate and deliver value to customers in the digital age.",
            "Edge computing is a distributed computing paradigm that brings computation closer to data sources. This approach reduces latency and bandwidth use, improving response times for applications."
        ];

        let currentText = '';
        let timer = 60;
        let timeLeft = 60;
        let timerInterval;
        let isTestActive = false;
        let startTime;
        let mistakes = 0;

        const textDisplay = document.getElementById('text-display');
        const inputArea = document.getElementById('input-area');
        const timerDisplay = document.getElementById('timer');
        const resultDisplay = document.getElementById('result');
        const startBtn = document.getElementById('start-btn');
        const restartBtn = document.getElementById('restart-btn');
        const gameContainer = document.getElementById('game-container');
        const nameForm = document.getElementById('name-form');

        // Start button event
        startBtn.addEventListener('click', startTest);
        restartBtn.addEventListener('click', restartTest);

        function getRandomText() {
            return sampleTexts[Math.floor(Math.random() * sampleTexts.length)];
        }

        function startTest() {
            // Reset variables
            currentText = getRandomText();
            timeLeft = timer;
            mistakes = 0;
            isTestActive = true;
            
            // Display text
            textDisplay.innerHTML = '';
            const characters = currentText.split('');
            characters.forEach(char => {
                const charSpan = document.createElement('span');
                charSpan.innerText = char;
                textDisplay.appendChild(charSpan);
            });
            
            // Setup input area
            inputArea.value = '';
            inputArea.disabled = false;
            inputArea.focus();
            
            // Start timer
            timerDisplay.textContent = `Time: ${timeLeft}s`;
            clearInterval(timerInterval);
            startTime = new Date().getTime();
            
            timerInterval = setInterval(() => {
                timeLeft--;
                timerDisplay.textContent = `Time: ${timeLeft}s`;
                
                if (timeLeft <= 0) {
                    endTest();
                }
            }, 1000);
            
            // Hide start button, show restart button
            startBtn.style.display = 'none';
            restartBtn.style.display = 'inline-block';
        }

        function endTest() {
            clearInterval(timerInterval);
            isTestActive = false;
            inputArea.disabled = true;
            
            // Calculate WPM
            const endTime = new Date().getTime();
            const timeSpent = (endTime - startTime) / 1000 / 60; // in minutes
            const wordsTyped = inputArea.value.trim().split(/\s+/).length;
            const wpm = Math.round(wordsTyped / timeSpent);
            
            // Display result
            resultDisplay.textContent = `Your typing speed: ${wpm} WPM`;
            
            // Save score
            saveScore(wpm);
        }

        function restartTest() {
            resultDisplay.textContent = '';
            startTest();
        }

        function saveScore(wpm) {
            const playerName = document.getElementById('player-name').value;
            
            if (confirm(`You scored ${wpm} WPM. Do you want to save this score?`)) {
                // Create form and submit via POST
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '';
                
                const nameInput = document.createElement('input');
                nameInput.type = 'hidden';
                nameInput.name = 'player_name';
                nameInput.value = playerName;
                
                const wpmInput = document.createElement('input');
                wpmInput.type = 'hidden';
                wpmInput.name = 'wpm';
                wpmInput.value = wpm;
                
                const saveInput = document.createElement('input');
                saveInput.type = 'hidden';
                saveInput.name = 'save_score';
                saveInput.value = '1';
                
                form.appendChild(nameInput);
                form.appendChild(wpmInput);
                form.appendChild(saveInput);
                
                document.body.appendChild(form);
                form.submit();
            }
        }

        // Real-time character matching
        inputArea.addEventListener('input', () => {
            if (!isTestActive) return;
            
            const inputChars = inputArea.value.split('');
            const textChars = currentText.split('');
            const spans = textDisplay.querySelectorAll('span');
            
            let correctChars = 0;
            let currentIndex = 0;
            
            spans.forEach((span, idx) => {
                if (idx < inputChars.length) {
                    if (inputChars[idx] === textChars[idx]) {
                        span.className = 'highlight';
                        correctChars++;
                    } else {
                        span.className = 'error';
                    }
                    currentIndex = idx + 1;
                } else {
                    span.className = '';
                }
            });
            
            // Check if test is complete
            if (inputArea.value.length >= currentText.length) {
                endTest();
            }
        });

        // Prevent pasting in the input area
        inputArea.addEventListener('paste', function(e) {
            e.preventDefault();
            alert("Pasting is not allowed! Type the text manually to ensure a fair test.");
            return false;
        });

        // Also prevent right-click context menu for additional protection
        inputArea.addEventListener('contextmenu', function(e) {
            e.preventDefault();
            return false;
        });

        // Prevent common keyboard shortcuts for pasting
        inputArea.addEventListener('keydown', function(e) {
            // Prevent Ctrl+V, Cmd+V, Ctrl+Shift+V, Cmd+Shift+V
            if ((e.ctrlKey || e.metaKey) && e.key === 'v') {
                e.preventDefault();
                alert("Pasting is not allowed! Type the text manually to ensure a fair test.");
                return false;
            }
        });
    </script>
</body>
</html>