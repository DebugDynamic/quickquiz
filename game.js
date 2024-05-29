let questions = [];
let currentQuestion = 0;
let score = 0;
let answeredQuestions = [];

async function loadQuestions() {
    const url = `config.json?nocache=${new Date().getTime()}`;
    const response = await fetch(url);
    data = await response.json();
    questions = data.questions;
    loadQuestion();
}

function loadQuestion() {
    if (currentQuestion >= questions.length) {
        document.getElementById('question').innerText = "Well done! You've completed the game.";
        document.getElementById('options').innerHTML = '';
        document.getElementById('next').style.display = 'none';
        return;
    }
    const question = questions[currentQuestion];
    document.getElementById('question').innerText = question.sentence;
    const optionsDiv = document.getElementById('options');
    optionsDiv.innerHTML = '';
    question.options.forEach(option => {
        const button = document.createElement('div');
        button.classList.add('option');
        button.innerText = option;
        button.addEventListener('click', () => checkAnswer(option));
        optionsDiv.appendChild(button);
    });
}

function checkAnswer(selectedOption) {
    const question = questions[currentQuestion];
    // Check if the current question has already been answered
    if (answeredQuestions.includes(currentQuestion)) {
        return;
    }
    const optionsDiv = document.getElementById('options');
    Array.from(optionsDiv.children).forEach(button => {
        button.classList.remove('correct', 'wrong');
        if (button.innerText === question.answer) {
            button.classList.add('correct');
        } else if (button.innerText === selectedOption) {
            button.classList.add('wrong');
        }
        // Disable all option buttons after an answer is selected
        button.removeEventListener('click', () => checkAnswer(button.innerText));
    });
    if (selectedOption === question.answer) {
        score++;
    }
    document.getElementById('score').innerText = `Score: ${score}/${questions.length}`;
    document.getElementById('next').style.display = 'block';
    // Add the current question to the answered questions array
    answeredQuestions.push(currentQuestion);
}

document.getElementById('next').addEventListener('click', () => {
    currentQuestion++;
    loadQuestion();
});

window.onload = () => {
    loadQuestions();
};
